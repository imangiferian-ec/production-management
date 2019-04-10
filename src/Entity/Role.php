<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoleRepository")
 */
class Role
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
    * @ORM\Column(type="text", length=100)
    */
    private $roleName;

    /**
    * @ORM\Column(type="text")
    */

    private $description;

    public function getRoleName(){
      return $this->roleName;
    }

    public function setRoleName($roleName)
    {
      $this->roleName = $roleName;
    }

    public function getDescription()
    {
      return $this->description;
    }

    public function setDescription($description){
      $this->description = $description;
    }
}
