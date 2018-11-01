<?php

namespace App\Controller;

use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Form\FormFactoryInterface;

use App\Services\FormErrors;

class BaseController{

    protected $doctrine;

    protected $serializer;

    protected $factory;

    protected $formErrors;

    public function __construct(RegistryInterface $doctrine, SerializerInterface $serializer, FormFactoryInterface $factory, FormErrors $formErrors){
        $this->serializer = $serializer;
        $this->doctrine = $doctrine;
        $this->factory = $factory;
        $this->formErrors = $formErrors;
    }
}