<?php

declare(strict_types=1);

namespace Absalon\Application\MedicalDocuments\Domains;

use Absalon\Application\MedicalDocuments\Domains\Base\MedicalForm;
use Absalon\Engine\DI\PhpDIDecorator;
use Absalon\Engine\Exceptions\UnknownClassException;
use Absalon\Engine\Utility\Converter\Converter;

class MedicalFormFactory
{
    public static function create(string $formName) : MedicalForm
    {
        $className = '\Absalon\Application\MedicalDocuments\Domains\Forms\\'.Converter::camelize($formName, '.');
        if (PhpDIDecorator::has($className)){
            return PhpDIDecorator::build($className);
        }
        throw new UnknownClassException('Класс '.$className.' не зарегистрированв системе');
    }
}