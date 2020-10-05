<?php


namespace Core\Validation;


use Core\Validation\Rules\ValidationInterface;

class ValidationStrategy
{
    private $validationObject;

    public function __construct(ValidationInterface $validatioObject)
    {
        $this->validationObject = $validatioObject;
    }

    public function validate()
    {
        $this->validationObject->validate();
    }
}