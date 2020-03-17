<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

trait Activate
{

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    public $activated;

    /**
     * @return mixed
     */
    public function getActivated()
    {
        return $this->activated;
    }

    /**
     * @param mixed $activated
     */
    public function setActivated($activated): void
    {
        $this->activated = $activated;
    }




}