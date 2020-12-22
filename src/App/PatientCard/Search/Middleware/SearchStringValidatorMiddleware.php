<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Search\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class SearchStringValidatorMiddleware implements MiddlewareInterface
{
    private $_validatedFields;

    private function sanitizeToString(string $string) : string
    {
        $convertedString = mb_convert_encoding($string, "utf-8");
        return preg_replace ("/[^a-zA-ZА-Яа-я0-9\s-]/ui","", $convertedString);
    }

    public function sanitize(array $data){
        foreach ($data as $key => $value){
            if (is_string($value)){
                $this->_validatedFields[$key] = $this->sanitizeToString($value);
            }else{
                $this->_validatedFields[$key] = $value;
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
        $this->sanitize(json_decode(file_get_contents("php://input"),true));
        $request = $request->withAttribute('ValidatedData', $this->_validatedFields);
        return $response = $handler->handle($request);
    }
}