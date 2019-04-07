<?php

namespace App\Entity;

use App\Entity\AttributeType;
use App\Entity\Content;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AttributeValueRepository")
 */
class AttributeValue{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"content"})
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"content"})
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="AttributeType")
     * @Groups({"content"})
     */
    private $attribute;

    /**
     * @ORM\Column(type="text")
     * @Groups({"content"})
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

    public function setAttribute(AttributeType $attribute){
        $this->attribute = $attribute;
        return $this;
    }

    public function getAttribute(){
        return $this->attribute;
    }

    public function setValue($value) :self{
        $this->value = $value;
        return $this;
    }

    public function getValue(){
        return $this->value;
    }

    public function getContent(){
        return $this->content;
    }

    public function setContent(Content $content){
        $this->content = $content;
        return $this;
    }
}
