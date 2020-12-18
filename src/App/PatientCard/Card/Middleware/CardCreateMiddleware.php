<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Card\Middleware;

use Absalon\Application\PatientCard\Card\Domains\CardCreateDTO;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Vulpix\Engine\Database\Connectors\IConnector;

class CardCreateMiddleware implements MiddlewareInterface
{
    private $_connection;
    private $_createCardData;
    private $_requiredFields = [
        'Номер' => 'CardNumber',
        'Фамилия' => 'Surname',
        'Имя' => 'FirstName',
        'Дата рожения' => 'DateBirth',
        'Номер полиса' => 'PolicyNumber',
        'СНИЛС' => 'InsuranceCertificate'
    ];
    private $_emptyFields = [];

    public function __construct(IConnector $connector){
        $this->_connection = $connector::getConnection();
        $this->_createCardData = json_decode(file_get_contents("php://input"),true) ?: [];
    }

    private function validateRequiredFields() : void
    {
        if (!empty($this->_createCardData)) {
            foreach ($this->_requiredFields as $key => $value) {
                if (!isset($this->_createCardData[$value])) {
                    $this->_emptyFields[$key] = $value;
                }
            }
        }else{
            $this->_emptyFields = $this->_requiredFields;
        }
    }

    private function sanitizeRequiredFields(){
        foreach ($this->_createCardData as $key => $value){
            if (is_string($value)){
                $convertedString = mb_convert_encoding($value, "utf-8");
                $this->_createCardData[$key] = preg_replace ("/[^a-zA-ZА-Яа-я0-9\s-]/ui","", $convertedString);
            }
        }
    }

    private function isCardExist(int $policyNumber, string $insuranceCertificate) : array|bool
    {
        $query = ("SELECT `id` 
                   FROM `patient_cards` 
                   WHERE `policy_number` = :policyNumber OR `insurance_certificate` =:insuranceCertificate");
        $result = $this->_connection->prepare($query);
        $result->execute([
            'policyNumber' => $policyNumber,
            'insuranceCertificate' => $insuranceCertificate
            ]);
        if ($result->rowCount() > 0){
            return $result->fetch();
        }
        return false;
    }

    /**
     * Process an incoming server request.
     *
     * Processes an incoming server request in order to produce a response.
     * If unable to produce the response itself, it may delegate to the provided
     * request handler to do so.
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if ($request->getMethod() === 'POST'){
            #Валидирую поля на то, что они заполнены
            $this->validateRequiredFields();
            if (!empty($this->_emptyFields)){
                return new JsonResponse($this->_emptyFields, 200);
            }
            #Очищаю поля по RegEx
            $this->sanitizeRequiredFields();
            #Проверка карты на уникальность
            if($id = $this->isCardExist($this->_createCardData['PolicyNumber'], $this->_createCardData['InsuranceCertificate'])){
                return new JsonResponse($id, 302);
            }
            #Если карта отсуствует в БД, добавляю ее
            $dto = new CardCreateDTO($this->_createCardData);
            $request = $request->withAttribute('DTO', $dto);
        }
        return $response = $handler->handle($request);
    }
}