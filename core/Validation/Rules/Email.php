<?php

namespace Core\Validation\Rules;

class Email implements ValidationInterface
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
        return ! filter_var($this->inputValue, FILTER_VALIDATE_EMAIL) ? ($this->messageError) ? $this->messageError : $this->inputName." Must be Valid email" : false;
    }
}