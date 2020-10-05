<?php

namespace Core\Validation\Rules;
require_once "ValidationInterface.php";
class Email implements ValidationInterface
{
    private $inputName, $inputValue, $messageError;
    /**
     * @inheritDoc
     */
    public function __construct(string $inputName, $inputValue, string $messageError)
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
        return ! filter_var($this->inputValue, FILTER_VALIDATE_EMAIL) ? ($this->messageError) ? $this->messageError : ucfirst($this->inputName)." Must be Valid ".ucfirst(__CLASS__) : '';
    }
}