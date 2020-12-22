<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Search\Actions;

use Absalon\Application\PatientCard\Search\Domains\SearchManager;
use Absalon\Application\PatientCard\Search\Responders\SearchDistrictsResponder;
use Psr\Http\Message\ServerRequestInterface;

class SearchDistrictsAction
{
    private $_searchManager;
    private $_responder;

    public function __construct(SearchManager $searchManager, SearchDistrictsResponder $responder){
        $this->_searchManager = $searchManager;
        $this->_responder = $responder;
    }

    public function __invoke(ServerRequestInterface $request){
        $searchString = $request->getAttribute('ValidatedData')['searchString'];
        $limit = $request->getAttribute('ValidatedData')['limit'];
        $result = $this->_searchManager->getDistricts($searchString, $limit);
        $response = $this->_responder->respond($request, $result);
        return $response;
    }
}