<?php


namespace Core\Validation\Rules;

require_once 'ValidationInterface.php';
class Str implements ValidationInterface
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
        return ! is_string($this->inputValue) ? ($this->messageError) ? $this->messageError : ucfirst($this->inputName)." Must be String " : '' ;
    }
}