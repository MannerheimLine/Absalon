<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Search\Actions;

use Absalon\Application\PatientCard\Search\Domains\SearchManager;
use Absalon\Application\PatientCard\Search\Responders\SearchCardsResponder;
use Psr\Http\Message\ServerRequestInterface;

class SearchCardsAction
{
    private $_searchManager;
    private $_responder;

    public function __construct(SearchManager $searchManager, SearchCardsResponder $responder){
        $this->_searchManager = $searchManager;
        $this->_responder = $responder;
    }

    public function __invoke(ServerRequestInterface $request){
        $searchString = $request->getAttribute('ValidatedData')['searchString'];
        $page = $request->getAttribute('ValidatedData')['page'];
        $offset = $request->getAttribute('ValidatedData')['offset'];
        $result = $this->_searchManager->getCards($searchString, $page, $offset);
        $response = $this->_responder->respond($request, $result);
        return $response;
    }

}