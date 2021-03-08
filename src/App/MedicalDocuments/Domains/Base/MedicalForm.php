<?php

declare(strict_types=1);

namespace Absalon\Application\MedicalDocuments\Domains\Base;

use Absalon\Application\MedicalDocuments\Domains\DataProviders\IMedicalFormDataProvider;

abstract class MedicalForm
{
    private $_dataProvider;

    public function __construct(IMedicalFormDataProvider $dataProvider)
    {
        $this->_dataProvider = $dataProvider;
    }

    public function getAddress(string $cardId) : array
    {
        return $this->_dataProvider->getAddress($cardId);
    }

    public function getCard(string $cardId) : array
    {
        return $this->_dataProvider->getCard($cardId);
    }

    public function getPdfConfigs() : array
    {
        return $this->_pdfConfigs;
    }

    public function getStyleSheet() : string
    {
        return file_get_contents($this->_stylesheet);
    }

    public function getTemplate(array $formData) : string
    {
        ob_start();
        include $this->_template;
        $html = ob_get_clean();
        return $html;
    }

    abstract public function prepareFormData(array $formData, array $addressData) : array;

}