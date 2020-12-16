<?php

return $dependencies = [
    #DB Connector
    \Vulpix\Engine\Database\Connectors\IConnector::class => DI\create(\Vulpix\Engine\Database\Connectors\MySQLConnector::class),
    #Cards Data Provider
    \Absalon\Application\PatientCard\Card\Domains\ICardDataProvider::class => DI\create(\Absalon\Application\PatientCard\Card\Domains\CardMySQLDataProvider::class)->constructor(DI\get(\Vulpix\Engine\Database\Connectors\IConnector::class))
];
