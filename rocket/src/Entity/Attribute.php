<?php 

namespace App\Entity;

use App\Entity\Type;
use App\Entity\Content;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AttributeRepository")
 */
class Attribute{

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
    private $value;

    /**
     * @ORM\ManyToMany(targetEntity="Type")
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity="Content")
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

    public function setValue($value){
        $this->value = $value;
        return $this;
    }

    public function getValue(){
        return $this->value;
    }

    public function getType(){
        return $this->type;
    }

    public function setType(Type $type){
        $this->type = $type;
        return $this;
    }

    public function getContent(){
        return $this->content;
    }

    public function setContent(Content $content){
        $this->content = $content;
        return $this;
    }
}