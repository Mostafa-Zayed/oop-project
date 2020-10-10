<?php

namespace Core\Validation;

class Validator
{
    public static function make(array $request)
    {
        $errors = [];
        foreach ($request as $input) {
            $name = $input['name'];
            $value = $input['value'];
            $rules = explode('|',$input['rules']);
            foreach ($rules as $rule) {
                $namspace = str_replace('Validator','Rules',__CLASS__)."\\";
                if ($rule == 'required') {
                    $ValidationClass = $namspace.ucfirst($rule);
                    $error = (new ValidationStrategy(new $ValidationClass($name,$value)))->validate();
                } elseif ($rule == 'numeric') {    
                    $ValidationClass = $namspace.ucfirst($rule);
                    $error = (new ValidationStrategy(new $ValidationClass($name,$value)))->validate();
                } elseif ($rule == 'email') {
                    $ValidationClass = $namspace.ucfirst($rule);
                    $error = (new ValidationStrategy(new $ValidationClass($name,$value)))->validate();
                } elseif ($rule == 'str') {
                    $ValidationClass = $namspace.ucfirst($rule);
                    $error = (new ValidationStrategy(new $ValidationClass($name,$value)))->validate();
                } 
                if (! empty($error))
                    $errors[] = $error;
            }
        }
        return $errors;
    }   
}