<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Bridge\Doctrine\RegistryInterface;

use App\Entity\ContentType;
use App\Entity\AttributeType;
use App\Form\DataTransformer\AttributeTypeToNumberTransformer;

class ContentTypeType extends AbstractType{

    private $em;

    private $transformer;

    public function __construct(RegistryInterface $doctrine, AttributeTypeToNumberTransformer $transformer){
        $this->em = $doctrine->getEntityManager();
        $this->transformer = $transformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('title')
            ->add('attributes', EntityType::class,[
                //'invalid_message' => 'The selected attribute does not exist',
                'class' => AttributeType::class,
                'choice_label' => 'title',
                'multiple' => true
            ])
        ;

        $builder->get('attributes')->addModelTransformer($this->transformer);
    }

    public function configureOption(OptionsResolver $resolver){
        $resolver->setDefault(
            [
                'data_class' => ContentType::class,
                'csrf_protection' => false,
            ]
        );
    }
}
