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

    private function sanitizeFullName(string $string) : string
    {
        $convertedString = mb_convert_encoding($string, "utf-8");
        return preg_replace ("/[^a-zA-ZА-Яа-я0-9\s-]/ui","", $convertedString);
    }

    private function sanitizeDocuments(string $string) : string
    {
        $convertedString = mb_convert_encoding($string, "utf-8");
        return preg_replace ("/[^0-9]/ui","", $convertedString);
    }

    public function sanitize(array $data){
        foreach ($data as $key => $value){
            if(ctype_digit($value) && $key !== 'searchString') {
                $this->_validatedFields[$key] = (int)$value;
            }
            elseif(preg_match("/[\d]+/", $value)) {
                $this->_validatedFields[$key] = $this->sanitizeDocuments($value);
            }
            else{
                $this->_validatedFields[$key] = $this->sanitizeFullName($value);
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
        parse_str(parse_url($_SERVER['REQUEST_URI'])['query'], $output);
        $this->sanitize($output);
        $request = $request->withAttribute('ValidatedData', $this->_validatedFields);
        return $response = $handler->handle($request);
    }
}