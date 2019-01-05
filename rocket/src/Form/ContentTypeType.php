<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Bridge\Doctrine\RegistryInterface;

use App\Entity\ContentType;
use App\Entity\AttributeType;

class ContentTypeType extends AbstractType{

    private $em;

    public function __construct(RegistryInterface $doctrine){
        $this->em = $doctrine->getEntityManager();
    }

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('title')
            ->add('attributes', EntityType::class, [
                'class' => AttributeType::class,
                'choice_label' => 'title',
                'multiple' => true,
                /* 'data' => $this->em->getRepository(AttributeType::class)->findAll(),
                'entry_type' => AttributeTypeType::class, 
                 'entry_options' => [
                    'label' => false,
                ], 
                'allow_add' => true 
                */
            ])
        ;
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
