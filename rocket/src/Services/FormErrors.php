<?php 

namespace App\Services;

class FormErrors{

    public function getErrors($form){
        $error = [];

        foreach($form->all() as $child ){
            if(!$child->isValid())
                foreach($child->getErrors() as $err){
                    $error[$child->getName()] = $err->getMessage();
                }
        }

        return $error;
    }
}