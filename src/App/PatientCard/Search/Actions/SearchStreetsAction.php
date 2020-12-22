<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Search\Actions;

use Absalon\Application\PatientCard\Search\Domains\SearchManager;
use Absalon\Application\PatientCard\Search\Responders\SearchStreetsResponder;
use Psr\Http\Message\ServerRequestInterface;

class SearchStreetsAction
{
    private $_searchManager;
    private $_responder;

    public function __construct(SearchManager $searchManager, SearchStreetsResponder $responder){
        $this->_searchManager = $searchManager;
        $this->_responder = $responder;
    }

    public function __invoke(ServerRequestInterface $request){
        $searchString = $request->getAttribute('ValidatedData')['searchString'];
        $limit = $request->getAttribute('ValidatedData')['limit'];
        $result = $this->_searchManager->getStreets($searchString, $limit);
        $response = $this->_responder->respond($request, $result);
        return $response;
    }
}