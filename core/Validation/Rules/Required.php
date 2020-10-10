<?php

namespace Core\Validation\Rules;

class Required implements ValidationInterface
{
    private $inputName;
    private $inputValue;
    private $messageError;

    public function __construct(string $inputName, $inputValue, string $messageErrror = null)
    {
        $this->inputName = $inputName;
        $this->inputValue = $inputValue;
        $this->messageError = $messageErrror;
    }

    public function validate()
    {
        return strlen(trim($this->inputValue)) == 0 ? ($this->messageError) ? $this->messageError : $this->inputName." is required " : false ;
    }
}