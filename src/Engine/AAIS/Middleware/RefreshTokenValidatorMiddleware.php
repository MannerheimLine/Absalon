<?php

declare(strict_types=1);

namespace Absalon\Engine\AAIS\Middleware;

use Absalon\Engine\Utility\Assert\Assert;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RefreshTokenValidatorMiddleware implements MiddlewareInterface
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
        try {
            parse_str(parse_url($_SERVER['REQUEST_URI'])['query'], $token);
            Assert::uuid($token['RefreshToken']);
            $request= $request->withAttribute('ValidatedToken', $token['RefreshToken']);
            return $response = $handler->handle($request);
        }catch (\Exception $e){
            return new JsonResponse('Передан неверный токен', 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
}