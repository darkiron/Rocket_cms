<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use App\Entity\Content;

class ContentType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('title')
            ->add('description')
        ;
    }

    public function configureOption(OptionsResolver $resolver){
        $resolver->setDefault(
            [
                'data_class' => Content::class,
                'csrf_protection' => false,
            ]
        );
    }
}
