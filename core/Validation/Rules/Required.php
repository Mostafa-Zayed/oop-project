<?php

namespace Core\Validation\Rules;

require_once  'ValidationInterface.php';

class Required implements ValidationInterface
{
    private $inputName;
    private $inputValue;
    private $messageError;

    public function __construct(string $inputName, $inputValue, string $messageErrror)
    {
        $this->inputName = $inputName;
        $this->inputValue = $inputValue;
        $this->messageError = $messageErrror;
    }

    public function validate()
    {
//        if (strlen(trim($this->inputValue)) == 0 ) {
//            if ($this->messageErrro)
//                return $this->messageError;
//            else
//                return ucfirst($this->inputName)." Is ". ucfirst(__CLASS__);
//        }
        return strlen(trim($this->inputValue) == 0 ) ? ($this->messageError) ? $this->messageError : ucfirst($this->inputName)." Is ". ucfirst(__CLASS__) : ture ;
    }
}