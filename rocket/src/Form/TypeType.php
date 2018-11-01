<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use App\Entity\Type;

class TypeType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('title')
            ->add('type')
        ;
    }

    public function configureOption(OptionsResolver $resolver){
        $resolver->setDefault(
            [
                'data_class' => Type::class,
                'csrf_protection' => false,
            ]
        );
    }
}