<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Search\Actions;

use Absalon\Application\PatientCard\Search\Domains\SearchManager;
use Absalon\Application\PatientCard\Search\Responders\SearchRegionsResponder;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class SearchRegionsAction
 * @package Absalon\Application\PatientCard\Search\Actions
 */
class SearchRegionsAction
{
    private $_searchManager;
    private $_responder;

    /**
     * SearchRegionsAction constructor.
     * @param SearchManager $searchManager
     * @param SearchRegionsResponder $responder
     */
    public function __construct(SearchManager $searchManager, SearchRegionsResponder $responder){
        $this->_searchManager = $searchManager;
        $this->_responder = $responder;
    }

    public function __invoke(ServerRequestInterface $request){
        $searchString = $request->getAttribute('ValidatedData')['searchString'];
        $limit = $request->getAttribute('ValidatedData')['limit'];
        $result = $this->_searchManager->getRegions($searchString, $limit);
        $response = $this->_responder->respond($request, $result);
        return $response;
    }

}