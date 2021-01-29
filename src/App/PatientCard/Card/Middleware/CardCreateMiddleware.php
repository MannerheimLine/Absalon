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

    public function __construct(IConnector $connector){
        $this->_connection = $connector::getConnection();
    }

    private function isCardExist(string $policyNumber, string $insuranceCertificate) : array|bool
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
        #Проверка карты на уникальность
        $validatedFields = $request->getAttribute('ValidatedFields');
        $policyNumber = $validatedFields['PolicyNumber'];
        $insuranceCertificate = $validatedFields['InsuranceCertificate'];
        if($id = $this->isCardExist($policyNumber, $insuranceCertificate)){
            return new JsonResponse($id, 302);
        }
        #Если карта отсуствует в БД, добавляю ее
        $dto = new CardCreateDTO($validatedFields);
        $request = $request->withAttribute('DTO', $dto);
        return $response = $handler->handle($request);
    }
}