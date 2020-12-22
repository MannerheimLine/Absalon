<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Search\Actions;

use Absalon\Application\PatientCard\Search\Domains\SearchManager;
use Absalon\Application\PatientCard\Search\Responders\SearchLocalitiesResponder;
use Psr\Http\Message\ServerRequestInterface;

class SearchLocalitiesAction
{
    private $_searchManager;
    private $_responder;

    public function __construct(SearchManager $searchManager, SearchLocalitiesResponder $responder){
        $this->_searchManager = $searchManager;
        $this->_responder = $responder;
    }

    public function __invoke(ServerRequestInterface $request){
        $searchString = $request->getAttribute('ValidatedData')['searchString'];
        $limit = $request->getAttribute('ValidatedData')['limit'];
        $result = $this->_searchManager->getLocalities($searchString, $limit);
        $response = $this->_responder->respond($request, $result);
        return $response;
    }
}