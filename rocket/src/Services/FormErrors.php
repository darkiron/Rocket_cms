<?php 

namespace App\Services;

use Twig\Environment;

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

    public function DiscoverForm($form){

        $fields = []; 

        foreach ($form->all() as $child) {
            $fields[$child->getName()] = [
                'required' => $child->isRequired(),
                'label' => $child->getConfig()->getOption('label'),
                'type' => get_class($child->getConfig()->getType()->getInnerType()),
                'value' => $child->getConfig()->getData(),
            ];
        }

        return $fields;
    }
}
