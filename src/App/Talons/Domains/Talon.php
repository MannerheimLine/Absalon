<?php

declare(strict_types=1);

namespace Absalon\Application\Talons\Domains;

use Absalon\Engine\DataStructures\TransferContainers\HttpResultContainer;
use Absalon\Engine\Exceptions\UnknownPropertyException;
use Mpdf\Mpdf;
use Vulpix\Engine\Database\Connectors\IConnector;

class Talon
{
    private $_cardId;
    private $_connection;
    private $_template;
    private $_stylesheet;
    private $_pdfConfigs; /*= [
        'format' => 'A5-P',
        'margin_left' => 5,
        'margin_right' => 5,
        'margin_top' => 5,
        'margin_bottom' => 5,
    ];*/

    public function __construct(IConnector $connector){
        $this->_connection = $connector::getConnection();
    }

    private function getCardData(string $cardId) : array
    {
        $query = ("SELECT `patient_cards`.`id` AS `cardId`,`patient_cards`.`card_number` AS `cardNumber`, 
       `patient_cards`.`surname` AS `surname`, `patient_cards`.`first_name` AS `firstName`, `patient_cards`.`second_name` AS `secondName`, 
       `genders`.`description` AS `genderDescription`, `patient_cards`.`insurance_certificate` AS `insuranceCertificate`, 
       `patient_cards`.`date_birth` AS `dateBirth`, `patient_cards`.`policy_number` AS `policyNumber`, 
       `patient_cards`.`temporary_policy_number` AS `temporaryPolicyNumber`, `insurance_companies`.`insurance_company_name` AS insuranceCompanyName, 
       `insurance_companies`.`insurer_code` AS `insurerCode`, `patient_cards`.`passport_serial` AS `passportSerial`, 
       `patient_cards`.`passport_number` AS `passportNumber`, `patient_cards`.`passport_date_of_issue` AS `passportDateOfIssue`,
       `patient_cards`.`fms_department` AS `fmsDepartment`, `patient_cards`.`birth_certificate_serial` AS `birthCertificateSerial`, 
       `patient_cards`.`birth_certificate_number` AS `birthCertificateNumber`, 
       `patient_cards`.`birth_certificate_date_of_issue` AS `birthCertificateDateOfIssue`,
       `patient_cards`.`registry_office` AS `registryOffice`, `patient_cards`.`workplace` AS `workplace`, 
       `patient_cards`.`profession` AS `profession`
       FROM `patient_cards` 
       LEFT JOIN `genders` ON `patient_cards`.`gender` = `genders`.`id`
       LEFT JOIN `insurance_companies` ON `patient_cards`.`insurance_company_id` = `insurance_companies`.`id`
       WHERE `patient_cards`.`id` = :id");
        $result = $this->_connection->prepare($query);
        $result->execute(['id' => $cardId]);
        return $result->fetch() ?: [];
    }

    private function getAddresses(string $cardId) : array
    {

    }

    private function prepareTalonData(array $talonData) : array
    {
        //Дата рождения к виду: 01.01.2001
        $talonData['dateBirth'] = date("d.m.Y", strtotime($talonData['dateBirth']));
        //Дата выдачи паспорта к виду: 01.01.2001
        if (isset( $talonData['passportDateOfIssue'])){
            $talonData['passportDateOfIssue'] = date("d.m.Y", strtotime($talonData['passportDateOfIssue']));
        }
        //Дата выдачи свидетельства о рождения к виду: 01.01.2001
        if (isset($talonData['birthCertificateDateOfIssue'])){
            $talonData['birthCertificateDateOfIssue'] = date("d.m.Y", strtotime($talonData['birthCertificateDateOfIssue']));
        }
        //СНИЛС к виду: 111-222-333 44
        if (isset($talonData['insuranceCertificate'])){
            $splited = str_split($talonData['insuranceCertificate'], 3);
            $talonData['insuranceCertificate'] =  implode('-', array_splice($splited, 0 ,3)).' '.$splited[0];
        }
        //Полис к виду: 1111-2222-3333-4444
        if(isset($talonData['policyNumber'])){
            $talonData['policyNumber'] = implode('-', str_split($talonData['policyNumber'], 4));
        }
        //Временный полис к виду: 111-222-333
        if (isset($talonData['temporaryPolicyNumber'])){
            $talonData['temporaryPolicyNumber'] = implode('-', str_split($talonData['temporaryPolicyNumber'], 3));
        }
        //Склейка ФИО и полного адреса
        $talonData['fullName'] = $talonData['surname'].' '.$talonData['firstName'].' '.$talonData['secondName'];
        $talonData['address'] = '';
        return $talonData;
    }

    private function getTemplate(array $talonData)
    {
        ob_start();
        include $this->_template;
        $html = ob_get_clean();
        return $html;
    }

    public function init(array $data) : Talon
    {
        if (!empty($data)){
            $this->_cardId = $data['cardId'];
            $this->_template = 'src/App/Talons/Templates/'.$data['talon'].'.talon.php';
            $this->_stylesheet = 'src/App/Talons/Templates/css/'.$data['talon'].'.talon.css';
            $this->_pdfConfigs = $data['configs'];
            return $this;
        }
        throw new \InvalidArgumentException('Ожидался массив данных, пришел пустой массив');
    }

    public function makePdf() : HttpResultContainer
    {
        $talonData = $this->getCardData($this->_cardId);
        if (!empty($talonData)){
            $talonData = $this->prepareTalonData($talonData);
            $html = $this->getTemplate($talonData);
            $mpdf = new Mpdf($this->_pdfConfigs);
            $stylesheet = file_get_contents($this->_stylesheet);
            $mpdf->SetTitle('Карта № '.$talonData['cardNumber']);
            $mpdf->WriteHTML($stylesheet,1);
            $mpdf->WriteHTML($html,2);
            return new HttpResultContainer($mpdf, 200) ;
        }
        return new HttpResultContainer('Карта сданным id отсуствует на сервере', 404);
    }

}