<?php 

namespace App\Services;

class FormErrors{

    public function getErrors($form){
        $error = [];

        foreach($form->all() as $child ){
            if(!$child->isValid())
                $error[$child->getName()] = $child->getError()->getMessage();
        }

        return $error;
    }
}