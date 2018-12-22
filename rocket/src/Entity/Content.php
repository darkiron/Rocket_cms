<?php 

namespace App\Entity;

use App\Entity\AttributeValue;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContentRepository")
 */
class Content{

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
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="AttributeValue")
     * @ORM\JoinTable(name="content_attributevalue",
     *      joinColumns={@ORM\JoinColumn(name="content_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="attributevalue_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $attributes;

    public function __construct(){
        $this->createdAt = new \Datetime;
    }

    public function getId(){
        return $this->id;
    }

    public function getCreatedAt(){
        return $this->createdAt;
    }

    public function setCreatedAt(\Datetime $date){
        $this->createdAt = $date;
        return $this;
    }

    public function setTitle($title){
        $this->title = $title;
        return $this;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
        return $this;
    }

    public function setAttributes($attributes){
        $this->attributes = $attributes;
        return $this;
    }

    public function getAttributes(){
        return $this->attributes;
    }

}
