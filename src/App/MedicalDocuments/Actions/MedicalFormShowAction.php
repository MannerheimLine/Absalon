<?php

declare(strict_types=1);

namespace Absalon\Application\MedicalDocuments\Actions;

use Absalon\Application\MedicalDocuments\Domains\MedicalFormFactory;
use Absalon\Application\MedicalDocuments\Domains\PdfMaker;
use Absalon\Application\MedicalDocuments\Responders\MedicalFormShowResponder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class MedicalFormShowAction
{
    private PdfMaker $_pdfMaker;
    private MedicalFormShowResponder $_responder;

    public function __construct(PdfMaker $pdfMaker, MedicalFormShowResponder $responder){
        $this->_pdfMaker = $pdfMaker;
        $this->_responder = $responder;
    }

    public function __invoke(ServerRequestInterface $request) : ResponseInterface
    {
        parse_str(parse_url($_SERVER['REQUEST_URI'])['query'], $configs);
        $cardId = $request->getAttribute('id');
        $formName = json_decode($configs[0], true);
        $medicalForm = MedicalFormFactory::create($formName);
        $result = $this->_pdfMaker->makePdf($medicalForm, $cardId);
        $response = $this->_responder->respond($request, $result);
        return $response;
    }
}