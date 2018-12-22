<?php

namespace App\Entity;

use App\Entity\Attribute;
use App\Entity\Content;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AttributeValueRepository")
 */
class AttributeValue{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="Attribute")
     */
    private $attribute;

    /**
     * @ORM\Column(type="text")
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="Content")
     */
    private $content;

    public function __construct(){
        $this->createdAt = new \Datetime;
    }

    public function getId(){
        return $this->id;
    }

    public function setCreatedAt(\Datetime $date){
        $this->createdAt = $date;
        return $this;
    }

    public function getCreatedAt(){
        return $this->createdAt;
    }

    public function setAttribute(Attribute $attribute){
        $this->attribute = $attribute;
        return $this;
    }

    public function getAttribute(){
        return $this->attribute;
    }

    public function setValue($value){
        $this->value = $value;
    }

    public function getValue(){
        return $value;
    }

    public function getContent(){
        return $this->content;
    }

    public function setContent(Content $content){
        $this->content = $content;
        return $this;
    }
}
