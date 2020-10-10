<?php

namespace Core\Validation\Rules;

class Str implements ValidationInterface
{
    private $inputName, $inputValue, $messageError;
    /**
     * @inheritDoc
     */
    public function __construct(string $inputName, $inputValue, string $messageError = null)
    {
        $this->inputName = $inputName;
        $this->inputValue = $inputValue;
        $this->messageError = $messageError;
    }

    /**
     * @inheritDoc
     */
    public function validate()
    {
        return ! is_string($this->inputValue) ? ($this->messageError) ? $this->messageError : ucfirst($this->inputName)." Must be String " : false ;
    }
}