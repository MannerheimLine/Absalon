<?php

declare(strict_types=1);

namespace Absalon\Application\Fluorography\Middleware;

use Absalon\Application\Fluorography\Domains\FluorographyCreateDTO;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FluorographyCreateMiddleware implements MiddlewareInterface
{
    /**
     * Process an incoming server request.
     *
     * Processes an incoming server request in order to produce a response.
     * If unable to produce the response itself, it may delegate to the provided
     * request handler to do so.
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $validatedFields = $request->getAttribute('ValidatedFields');
        $dto = new FluorographyCreateDTO($validatedFields);
        $request = $request->withAttribute('DTO', $dto);
        return $response = $handler->handle($request);

    }
}