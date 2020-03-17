<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User implements UserInterface, \Serializable
{
    const directory = 'upload';

    use Timestampable;
    use Activate;

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
     *      minMessage = "user.nameMin",
     *      maxMessage = "user.nameMax"
     * )
     */
    private $username;

    /**
     * @ORM\Column(type="string")
     * @Assert\Email(
     *     message = "user.email",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     *
     */
    private $password;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $path;

    /**
     * @ORM\Column(type="array")
     */
    protected $roles;

    /**
     * @ORM\Column(type="datetime", name="last_login_at", nullable=true)
     * @GRID\Column(title="Dernière connexion",visible=true, operatorsVisible=false, source=true,filter=false)
     */
    private $lastLoginAt;

    /**
     * @Assert\File(
     *     maxSize = "2M",
     *     mimeTypes = {"image/png","image/jpg","image/jpeg"},
     *     mimeTypesMessage = "file.message"
     * )
     */
    private $image;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Length(
     *      min = 10,
     *      max = 10,
     *      minMessage = "user.phoneMin",
     *      maxMessage = "user.phoneMax"
     * )
     */
    private $phone;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $forgotPasswordKey;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateForgotPassword;

    /**
     * @return mixed
     */
    public function getForgotPasswordKey()
    {
        return $this->forgotPasswordKey;
    }

    /**
     * @param mixed $forgotPasswordKey
     */
    public function setForgotPasswordKey($forgotPasswordKey): void
    {
        $this->forgotPasswordKey = $forgotPasswordKey;
    }

    /**
     * @return mixed
     */
    public function getDateForgotPassword()
    {
        return $this->dateForgotPassword;
    }

    /**
     * @param mixed $dateForgotPassword
     */
    public function setDateForgotPassword($dateForgotPassword): void
    {
        $this->dateForgotPassword = $dateForgotPassword;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->roles = [];
    }

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
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path): void
    {
        $this->path = $path;
    }

    public function asRole($role)
    {
        return (in_array($role, $this->roles) ? $role : false);
    }

    public function addRole($role): void
    {
        if ($this->roles !== null && in_array($role, $this->roles)) {
            return;
        } else {
            array_push($this->roles, $role);
        }
    }

    public function removeRole($role): void
    {
        if (!in_array($role, $this->roles)) {
            return;
        } else {
            $this->roles = array_diff($this->roles, [$role]);
        }
    }

    /**
     * @return mixed
     */
    public function getLastLoginAt()
    {
        return $this->lastLoginAt;
    }

    /**
     * @param mixed $lastLoginAt
     */
    public function setLastLoginAt($lastLoginAt): void
    {
        $this->lastLoginAt = $lastLoginAt;
    }


    /**
     * String representation of object
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        return serialize(
            [
                $this->id,
                $this->username,
                $this->email,
                $this->password,
                $this->path,
                $this->roles,
                $this->phone,
            ]
        );
    }

    /**
     * Constructs the object
     * @link http://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->username,
            $this->email,
            $this->password,
            $this->path,
            $this->roles,
            $this->phone
            ) = unserialize($serialized);
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {

    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {

    }

    public function getAbsolutePath()
    {
        return dirname(__FILE__).'/../../public/'.self::directory.'/'.$this->path;
    }

    public function getWebPath()
    {
        if ($this->path === null) {
            return '/images/user/default.png';
        } else {
            return '/'.self::directory.'/'.$this->path;
        }
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

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
