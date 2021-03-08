<?php

declare(strict_types=1);

namespace Absalon\Application\MedicalDocuments\Domains\Forms;

use Absalon\Application\MedicalDocuments\Domains\Base\MedicalForm;
use Absalon\Application\MedicalDocuments\Domains\DataProviders\IMedicalFormDataProvider;
use Absalon\Application\MedicalDocuments\Domains\Services\DataConverter;

class AmbulatoryCardCover extends MedicalForm
{
    protected $_pdfConfigs = [
        'format' => 'A5-L',
        'margin_left' => 5,
        'margin_right' => 5,
        'margin_top' => 5,
        'margin_bottom' => 5,
    ];
    protected string $_template = 'src/App/MedicalDocuments/Templates/ambulatory.card.cover.php';
    protected string $_stylesheet = 'src/App/MedicalDocuments/Templates/css/ambulatory.card.cover.css';

    public function __construct(IMedicalFormDataProvider $dataProvider)
    {
        parent::__construct($dataProvider);
    }

    /**
     * Могу формирировать любые по сложности данные, конкретно для этого талона и в любом порядке
     *
     * @param array $formData
     * @param array $addressData
     * @return array
     */
    public function prepareFormData(array $formData, array $addressData) : array
    {
        //Дата рождения к виду: 01.01.2001
        $formData['dateBirth'] = DataConverter::getConvertedDate($formData['dateBirth']);
        //Пасспорт
        $formData['passport'] = DataConverter::getFullPassport($formData['passportSerial'], $formData['passportNumber']);
        //Дата выдачи паспорта к виду: 01.01.2001
        $formData['passportDateOfIssue'] = DataConverter::getConvertedDate($formData['passportDateOfIssue']);
        //Дата выдачи свидетельства о рождения к виду: 01.01.2001
        $formData['birthCertificateDateOfIssue'] = DataConverter::getConvertedDate($formData['birthCertificateDateOfIssue']);
        //СНИЛС к виду: 111-222-333 44
        $formData['insuranceCertificate'] = DataConverter::getInsuranceCertificate($formData['insuranceCertificate']);
        //Полис к виду: 1111-2222-3333-4444 / 111-222-333
        $formData['policyNumber'] = DataConverter::getPolicyNumber($formData['policyNumber'], $formData['temporaryPolicyNumber']);
        //Склейка адреса
        $formData['address'] = DataConverter::getFullAddress($addressData);
        //Склейка ФИО и полного адреса
        $formData['fullName'] = $formData['surname'].' '.$formData['firstName'].' '.$formData['secondName'];
        //Склейка имени страховой компаниии ее кода
        $formData['insuranceCompany'] = DataConverter::getInsuranceCompany($formData['insurerCode'], $formData['insuranceCompanyName']);
        //Мето работы и профессия
        $formData['workplace'] = DataConverter::getValueOrNull($formData['workplace']);
        $formData['profession'] = DataConverter::getValueOrNull($formData['profession']);
        return $formData;
    }

}