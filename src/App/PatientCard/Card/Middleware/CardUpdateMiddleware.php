<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Card\Middleware;

use Absalon\Application\PatientCard\Card\Domains\CardFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use function DI\create;

class CardUpdateMiddleware implements MiddlewareInterface
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
        $dto = CardFactory::create($request->getAttribute('ValidatedFields'));
        $request = $request->withAttribute('DTO', $dto);
        return $response = $handler->handle($request);
    }
}