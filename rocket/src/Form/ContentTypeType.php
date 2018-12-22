<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use App\Entity\ContentType;

class ContentTypeType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('title')
        ;
    }

    public function configureOption(OptionsResolver $resolver){
        $resolver->setDefault(
            [
                'data_class' => ContentTypeType::class,
                'csrf_protection' => false,
            ]
        );
    }
}
