<?php 

namespace App\Services;

use Twig\Environment;
use Symfony\Component\DependencyInjection\ContainerInterface;

class FormErrors{

    public function __construct(ContainerInterface $container){
       
    }

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
        /** TOOD perform better var set from Symfony\Component\Form\ChoiceList\View\ChoiceView */
        $view = $form->createView();

        $fields = []; 

        foreach ($form->all() as $child) {
            $childView = $view->offsetGet($child->getName());

            $fields[$child->getName()] = [
                'name' => $child->getName(),
                'required' => $child->isRequired(),
                'label' => $child->getConfig()->getOption('label'),
                'type' => get_class($child->getConfig()->getType()->getInnerType()),
                'values' => (array_key_exists('choices', $childView->vars))? $childView->vars['choices'] : $childView->vars['value'],
                'class' => $child->getConfig()->getOption('class'),
            ];
        }

        return $fields;
    }
}
