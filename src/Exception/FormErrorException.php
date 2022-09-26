<?php

namespace App\Exception;

use Exception;
use Symfony\Component\Form\FormErrorIterator;
use Throwable;

class FormErrorException extends Exception
{
    public function __construct(FormErrorIterator $errors, $code = 0, Throwable $previous = null)
    {
        $message = $this->convertToJson($errors);

        parent::__construct($message, $code, $previous);
    }

    public function convertToJson($formErrors)
    {
        $errors = [];
        foreach ($formErrors as $key => $error) {
            $template = $error->getMessageTemplate();
            $parameters = $error->getMessageParameters();

            foreach($parameters as $var => $value){
                $template = str_replace($var, $value, $template);
            }

            $errors[$key] = $template;
        }

        return json_encode($errors);
    }
}
