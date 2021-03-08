<?php

declare(strict_types=1);

namespace Absalon\Application\MedicalDocuments\Domains;

use Absalon\Application\MedicalDocuments\Domains\Base\MedicalForm;
use Absalon\Engine\DataStructures\TransferContainers\HttpResultContainer;
use Mpdf\Mpdf;

class PdfMaker
{
    public function makePdf(MedicalForm $medicalForm, string $cardId) : HttpResultContainer
    {
        $cardData = $medicalForm->getCard($cardId);
        if (!empty($cardData)){
            $address = $medicalForm->getAddress($cardId);
            $formData = $medicalForm->prepareFormData($cardData, $address);
            $stylesheet = $medicalForm->getStyleSheet();
            $html = $medicalForm->getTemplate($formData);
            $mpdf = new Mpdf($medicalForm->getPdfConfigs());
            $mpdf->SetTitle('Карта № '.$formData['cardNumber']);
            $mpdf->WriteHTML($stylesheet,1);
            $mpdf->WriteHTML($html,2);
            return new HttpResultContainer($mpdf, 200) ;
        }
        return new HttpResultContainer('Карта сданным id отсуствует на сервере', 204);
    }
}