<?php

declare(strict_types=1);

namespace Absalon\Application\Talons\Actions;

use Absalon\Application\Talons\Domains\Talon;
use Absalon\Application\Talons\Domains\TalonFactory;
use Laminas\Diactoros\Response\JsonResponse;;
use Psr\Http\Message\ServerRequestInterface;

class TalonShowAction
{
    private $_talon;

    public function __construct(Talon $talon){
        $this->_talon = $talon;
    }
    public function __invoke(ServerRequestInterface $request) : mixed
    {
        $incomingData = json_decode(file_get_contents("php://input"),true) ?: [];
        $result = $this->_talon->init($incomingData)->makePdf();
        if ($result->status === 200){
            $result->body->Output('Talon.pdf', 'I');
        }else{
            return new JsonResponse($result->body, $result->status);
        }
    }
}