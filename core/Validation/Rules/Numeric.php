<?php

namespace Core\Validation\Rules;

class Numeric implements ValidationInterface
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
        return ! is_numeric($this->inputValue) ? ($this->messageError) ? $this->messageError : $this->inputName." Must be number" : false;
    }
}