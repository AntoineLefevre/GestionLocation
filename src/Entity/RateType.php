<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity as UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="ratetype")
 * @UniqueEntity(
 *     fields={"libelle"},
 *     message="rateType.unique")
 */
class RateType
{
    use Timestampable;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "rateType.libelleMin",
     *      maxMessage = "rateType.libelleMax"
     * )
     */
    private $libelle;
}