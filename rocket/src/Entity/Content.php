<?php 

namespace App\Entity;

use App\Entity\AttributeValue;
use App\Entity\ContentType;
use Symfony\Component\Serializer\Annotation\Groups;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContentRepository")
 */
class Content{

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
     * @ORM\ManyToOne(targetEntity="ContentType")
     * @Groups({"content"})
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity="AttributeValue", cascade={"persist"})
     * @ORM\JoinTable(name="content_attributevalue",
     *      joinColumns={@ORM\JoinColumn(name="content_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="attributevalue_id", referencedColumnName="id", unique=true)}
     *      )
     * @Groups({"content"})
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

    public function setType(ContentType $type) :self {
        $this->type = $type;
        return $this;
    }

    public function getType(){
        return $this->type;
    }

    public function setAttributes($attributes){
        $this->attributes = $attributes;
        return $this;
    }

    public function addAttribute(AttributeValue $value) :self {
        $this->attributes[] = $value;
        return $this;
    }

    public function getAttributes(){
        return $this->attributes;
    }

}
