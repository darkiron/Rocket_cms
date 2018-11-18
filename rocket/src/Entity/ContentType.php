<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Type;
use App\Entity\Attribute;


/**
 * @ORM\Entity
 */
class ContentType extends Type {

    /**
     * @ORM\ManyToMany(targetEntity="Attribute")
     */
    private $attributes;

    public function getAttributes(){
        return $this->attributes;
    }

    public function setAttributes($attributes){
        $this->attributes = $attributes;
        return $this;
    }

    public function addAttribute($attribute){
        $this->attributes[] = $attribute;
        return $this;
    }
}
