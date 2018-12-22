<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Type;

/**
 * @ORM\Entity
 */
class AttributeType extends Type{

    /**
     * @ORM\Column(type="text")
     */
    private $type;

    public function getType(){
        return $this->type;
    }
    
    public function setType($type){
        $this->type = $type;
        return $this;
    }
    
}
