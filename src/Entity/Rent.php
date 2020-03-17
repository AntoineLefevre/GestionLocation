<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="rent")
 */
class Rent
{
    use Timestampable;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(
     *      min = 3,
     *      max = 30,
     *      minMessage = "rent.libelleMin",
     *      maxMessage = "rent.libelleMax"
     * )
     */
    private $libelle;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $city;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $department;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(
     *      min = 5,
     *      max = 5,
     *      minMessage = "rent.zipcodeMin",
     *      maxMessage = "rent.zipcodeMax"
     * )
     *
     */
    private $zipcode;

    /**
     * @ORM\Column(type="string",nullable= true)
     * @Assert\Length(
     *      max = 250,
     *      maxMessage = "rent.descMax"
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $available = true;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     */
    private $owner;

    /**
     * @ORM\ManyToOne(targetEntity="RentType")
     * @ORM\JoinColumn(name="rent_type_id", referencedColumnName="id")
     *
     */
    private $rentType;

    /**
     * @ORM\ManyToOne(targetEntity="Rate")
     * @ORM\JoinColumn(name="rate_id", referencedColumnName="id")
     *
     */
    private $rate;

    /**
     * @OneToMany(targetEntity="Image", mappedBy="rent")
     * @JoinTable(name="rent_image",
     *      joinColumns={@JoinColumn(name="rent_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="image_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $images;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $libelle
     */
    public function setLibelle($libelle): void
    {
        $this->libelle = $libelle;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city): void
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * @param mixed $department
     */
    public function setDepartment($department): void
    {
        $this->department = $department;
    }

    /**
     * @return mixed
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * @param mixed $zipcode
     */
    public function setZipcode($zipcode): void
    {
        $this->zipcode = $zipcode;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getAvailable()
    {
        return $this->available;
    }

    /**
     * @param mixed $available
     */
    public function setAvailable($available): void
    {
        $this->available = $available;
    }

    /**
     * @return mixed
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param mixed $owner
     */
    public function setOwner($owner): void
    {
        $this->owner = $owner;
    }

    /**
     * @return mixed
     */
    public function getRentType()
    {
        return $this->rentType;
    }

    /**
     * @param mixed $rentType
     */
    public function setRentType($rentType): void
    {
        $this->rentType = $rentType;
    }

    /**
     * @return mixed
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @param mixed $rate
     */
    public function setRate($rate): void
    {
        $this->rate = $rate;
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

    /**
     * @return mixed
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param mixed $images
     */
    public function setImages($images): void
    {
        $this->images = $images;
    }
}
