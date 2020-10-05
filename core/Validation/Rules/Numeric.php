<?php


namespace Core\Validation\Rules;

require_once 'ValidationInterface.php';

class Numeric implements ValidationInterface
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
        return ! is_numeric($this->inputValue) ? ($this->messageError) ? $this->messageError : ucfirst($this->inputName)." Must be ". ucfirst(__CLASS__) : '';
    }
}