<?php

namespace Dywee\AddressBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Dywee\UserBundle\Entity\User;

/**
 * Address
 *
 * @ORM\Table(name="address")
 * @ORM\Entity(repositoryClass="Dywee\AddressBundle\Repository\AddressRepository")
 */
class Address
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $company;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
*/
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $line1;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $line2;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $box;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $line3;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $other;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $instruction;

    /**
     * @ORM\ManyToOne(targetEntity="City")
     */
    private $city;

    /**
     * @ORM\ManyToMany(targetEntity="Dywee\UserBundle\Entity\User")
     */
    private $users;

    /**
     * @ORM\OneToOne(targetEntity="Dywee\AddressBundle\Entity\Address")
     */
    private $email;



    public function __construct()
    {
        $this->users = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Address
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set company
     *
     * @param string $company
     *
     * @return Address
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Address
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Address
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set line1
     *
     * @param string $line1
     *
     * @return Address
     */
    public function setLine1($line1)
    {
        $this->line1 = $line1;

        return $this;
    }

    /**
     * Get line1
     *
     * @return string
     */
    public function getLine1()
    {
        return $this->line1;
    }

    /**
     * Set line2
     *
     * @param string $line2
     *
     * @return Address
     */
    public function setLine2($line2)
    {
        $this->line2 = $line2;

        return $this;
    }

    /**
     * Get line2
     *
     * @return string
     */
    public function getLine2()
    {
        return $this->line2;
    }

    /**
     * Set line3
     *
     * @param string $line3
     *
     * @return Address
     */
    public function setLine3($line3)
    {
        $this->line3 = $line3;

        return $this;
    }

    /**
     * Get line3
     *
     * @return string
     */
    public function getLine3()
    {
        return $this->line3;
    }

    /**
     * Set other
     *
     * @param string $other
     *
     * @return Address
     */
    public function setOther($other)
    {
        $this->other = $other;

        return $this;
    }

    /**
     * Get other
     *
     * @return string
     */
    public function getOther()
    {
        return $this->other;
    }

    /**
     * Set instruction
     *
     * @param string $instruction
     *
     * @return Address
     */
    public function setInstruction($instruction)
    {
        $this->instruction = $instruction;

        return $this;
    }

    /**
     * Get instruction
     *
     * @return string
     */
    public function getInstruction()
    {
        return $this->instruction;
    }

    /**
     * Set city
     *
     * @param City $city
     *
     * @return Address
     */
    public function setCity(City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set number
     *
     * @param string $number
     *
     * @return Address
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set box
     *
     * @param string $box
     *
     * @return Address
     */
    public function setBox($box)
    {
        $this->box = $box;

        return $this;
    }

    /**
     * Get box
     *
     * @return string
     */
    public function getBox()
    {
        return $this->box;
    }

    /**
     * @param User $user
     * @return $this
     */
    public function addUser(User $user)
    {
        $this->users[] = $user;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param User $user
     * @return $this
     */
    public function removeUser(User $user)
    {
        $this->users->removeElement($user);
        return $this;
    }

    /**
     * @param Email email
     * @return $this
     */
    public function setEmail(Email $email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

}
