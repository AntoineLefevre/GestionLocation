<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

trait Timestampable
{

    /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    public $createdAt;

    /**
     * @ORM\Column(type="datetime", name="updated_at")
     */
    public $updatedAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->updatedAt = new \DateTime('now');
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }



}