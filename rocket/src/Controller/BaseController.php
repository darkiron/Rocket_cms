<?php

namespace App\Controller;

use Symfony\Bridge\Doctrine\RegistryInterface;

class BaseController{

    protected $doctrine;

    public function __construct(RegistryInterface $doctrine){
        $this->doctrine = $doctrine;
    }
}