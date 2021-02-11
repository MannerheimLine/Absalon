<?php

declare(strict_types=1);

namespace Absalon\Application\Fluorography\Middleware;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FluororgraphyValidatorMiddleware implements MiddlewareInterface
{
    private array $_incomingFields;
    private array $_requiredFields = [
        'Дата' => 'FluorographyDate',
        'Тип' => 'FluorographyTypeId',
        'Результат' => 'FluorographyResultId'
    ];
    private array $_emptyFields = [];

    public function __construct(){
        $this->_incomingFields = json_decode(file_get_contents("php://input"),true) ?: [];
    }

    private function validateRequiredFields() : void
    {
        if (!empty($this->_incomingFields)) {
            foreach ($this->_requiredFields as $key => $value) {
                if (!isset($this->_incomingFields[$value])) {
                    $this->_emptyFields[$key] = $value;
                }
            }
        }else{
            $this->_emptyFields = $this->_requiredFields;
        }
    }

    private function sanitizeIncomingFields(){
        foreach ($this->_incomingFields as $key => $value){
            if (is_string($value)){
                $convertedString = mb_convert_encoding($value, "utf-8");
                $this->_incomingFields[$key] = preg_replace ("/[^a-zA-ZА-Яа-я0-9\s-]/ui","", $convertedString);
            }
        }
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
        $this->validateRequiredFields();
        if (!empty($this->_emptyFields)) {
            return new JsonResponse($this->_emptyFields, 200);
        }
        $this->sanitizeIncomingFields();
        $request = $request->withAttribute('ValidatedFields', $this->_incomingFields);
        return $response = $handler->handle($request);
    }
}