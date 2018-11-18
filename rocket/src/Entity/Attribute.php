<?php 

namespace App\Entity;

use App\Entity\Type;


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
     * @ORM\ManyToMany(targetEntity="Type")
     */
    private $type;


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

    public function getType(){
        return $this->type;
    }

    public function setType(Type $type){
        $this->type = $type;
        return $this;
    }

}