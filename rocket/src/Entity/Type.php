<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeRepository")
 */
class Type{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id; 

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string")
     */
    private $type;

    public function __construct(){
        $this->createdat = new \Datetime;
    }

    public function getId(){
        return $this->id;
    }

    public function getTitle(){
        return $this->title();
    }

    public function setTitle($title){
        $this->title  = $title;
        return $this;
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
    
    public function setType($type){
        $this->type = $type;
    }

}
