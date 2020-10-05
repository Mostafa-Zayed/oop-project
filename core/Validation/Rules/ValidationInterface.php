<?php

namespace Core\Validation\Rules;

interface ValidationInterface
{
    /**
     *
     * @param string $inputName
     * @param mixed $inputValue
     * @param string $messageError
     * @return mixed
    */
    public function __construct(string $inputName, $inputValue, string $messageError);

    /**
     * This Function to Check rule and Validate
    */
    public function validate();
}