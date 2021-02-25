<?php

return $dependencies = [
    #DB Connector
    \Vulpix\Engine\Database\Connectors\IConnector::class => DI\create(\Vulpix\Engine\Database\Connectors\MySQLConnector::class),
    #Cards Data Provider
    \Absalon\Application\PatientCard\Card\Domains\ICardDataProvider::class => DI\create(\Absalon\Application\PatientCard\Card\Domains\CardMySQLDataProvider::class)->constructor(DI\get(\Vulpix\Engine\Database\Connectors\IConnector::class)),
    #Search Data Provider
    \Absalon\Application\PatientCard\Search\Domains\ISearchDataProvider::class => DI\create(\Absalon\Application\PatientCard\Search\Domains\SearchMySQLDataProvider::class)->constructor(DI\get(\Vulpix\Engine\Database\Connectors\IConnector::class)),
    #Account Data Provider
    \Absalon\Engine\AAIS\Domains\Account\IAccountDataProvider::class => DI\create(\Absalon\Engine\AAIS\Domains\Account\AccountMySQLDataProvider::class)->constructor(DI\get(\Vulpix\Engine\Database\Connectors\IConnector::class)),
    #Tokens Data Provider
    \Absalon\Engine\AAIS\Domains\Tokens\ITokensDataProvider::class => DI\create(\Absalon\Engine\AAIS\Domains\Tokens\TokensMySQLDataProvider::class)->constructor(DI\get(\Vulpix\Engine\Database\Connectors\IConnector::class)),
    #Fluorography Data Provider
    \Absalon\Application\Fluorography\Domains\IFluorographyDataProvider::class => DI\create(\Absalon\Application\Fluorography\Domains\FluorographyMySQLDataProvider::class)->constructor(DI\get(\Vulpix\Engine\Database\Connectors\IConnector::class)),
    #Vaccinations Data Provider
    \Absalon\Application\Vaccinations\Domains\IVaccinationDataProvider::class => DI\create(\Absalon\Application\Vaccinations\Domains\VaccinationMySQLDataProvider::class)->constructor(DI\get(\Vulpix\Engine\Database\Connectors\IConnector::class)),
    #Fluorography Reports Data Provider
    \Absalon\Application\Reports\Fluorography\Domains\IFluorographyReportsDataProvider::class => DI\create(\Absalon\Application\Reports\Fluorography\Domains\FluorographyReportsMySQLDataProvider::class)->constructor(DI\get(\Vulpix\Engine\Database\Connectors\IConnector::class))
];
