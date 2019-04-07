<?php

namespace App\Form\DataTransformer;

use App\Entity\AttributeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class AttributeTypeToNumberTransformer implements DataTransformerInterface{

    private $em;

    public function __construct(EntityManagerInterface $entityManager){
        $this->em = $entityManager;
    }

    public function transform($attributeType){
 
        if (null === $attributeType)
            return [];

            return $attributeType->getId();
    }

    public function reverseTransform($attributeTypeNumber){
        if (!$attributeTypeNumber)
            return;

        $attributeType = $this->em->getRepository(AttributeType::class)->findById($attributeTypeNumber);

        if(null === $attributeType)
            throw new TransformationFailedException(sprintf('Attribute with id %s does not exist!', $attributeTypeNumber));

        return  $attributeType;
    }
}
