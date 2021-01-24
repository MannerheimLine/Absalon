<?php

declare(strict_types=1);

namespace Absalon\Engine\AAIS\Middleware;

use Firebase\JWT\JWT;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthorizationMiddleware implements MiddlewareInterface
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
            //Обязательно сделать проверку на null ибо поймал такое значение
            if (!empty($request->getHeader('authorization'))){
                $accessToken = mb_substr(($request->getHeader('authorization')[0]), 7);
                [$header, $payload, $signature] = explode('.', $accessToken);
                $accountId = json_decode(base64_decode($payload))->accountId;
                $keyFile = 'storage/'.$accountId;
                if (file_exists($keyFile)){
                    $secretKey = file_get_contents($keyFile);
                    $decoded = (JWT::decode($accessToken, $secretKey, ['HS256']));
                    $request = $request->withAttribute('AccountId', $decoded->accountId);
                    $request = $request->withAttribute('AccountPermissions', $decoded->accountPermissions);
                }
                $response = $handler->handle($request);
                return $response;
            }else{
                $response = new JsonResponse('Access токен не найден в заголовке Authorization', 401);
                return $response;
            }
        }catch (\Exception $e){
            $response = new JsonResponse('Access токен '.$accessToken.' не валиден '.$e->getMessage(), 400);
            return $response;
        }
    }
}