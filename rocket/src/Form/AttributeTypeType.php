<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use App\Entity\ContentType;
use App\Entity\Attribute;

class AttributeTypeType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('title')
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'choice' => 'Symfony\Component\Form\Extension\Core\Type\ChoiceType',
                    'text' => 'Symfony\Component\Form\Extension\Core\Type\TextType',
                    'datetime' => 'Symfony\Component\Form\Extension\Core\Type\DateTimeType',
                    'textarea' => 'Symfony\Component\Form\Extension\Core\Type\TextareaType',
                    'file' => 'Symfony\Component\Form\Extension\Core\Type\FileType',
                ]
            ])
        ;
    }

    public function configureOption(OptionsResolver $resolver){
        $resolver->setDefault(
            [
                'data_class' => AttributeType::class,
                'csrf_protection' => false,
            ]
        );
    }
}
