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
class Address implements AddressInterface
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
     * @ORM\ManyToOne(targetEntity="Dywee\UserBundle\Entity\User")
     */
    private $users;

    /**
     * @ORM\OneToOne(targetEntity="Dywee\AddressBundle\Entity\Email", cascade={"persist"})
     */
    private $email;

    /**
     * @ORM\OneToOne(targetEntity="Dywee\AddressBundle\Entity\PhoneNumber", cascade={"persist"})
     */
    private $phone;



    public function __construct()
    {
        $this->users = new ArrayCollection();
    }


    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @inheritdoc
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @inheritdoc
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @inheritdoc
     */
    public function setLine1($line1)
    {
        $this->line1 = $line1;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getLine1()
    {
        return $this->line1;
    }

    /**
     * @inheritdoc
     */
    public function setLine2($line2)
    {
        $this->line2 = $line2;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getLine2()
    {
        return $this->line2;
    }

    /**
     * @inheritdoc
     */
    public function setLine3($line3)
    {
        $this->line3 = $line3;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getLine3()
    {
        return $this->line3;
    }

    /**
     * @inheritdoc
     */
    public function setOther($other)
    {
        $this->other = $other;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getOther()
    {
        return $this->other;
    }

    /**
     * @inheritdoc
     */
    public function setInstruction($instruction)
    {
        $this->instruction = $instruction;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getInstruction()
    {
        return $this->instruction;
    }

    /**
     * @inheritdoc
     */
    public function setCity(CityInterface $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @inheritdoc
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @inheritdoc
     */
    public function setBox($box)
    {
        $this->box = $box;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getBox()
    {
        return $this->box;
    }

    /**
     * @inheritdoc
     */
    public function addUser(User $user)
    {
        $this->users[] = $user;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @inheritdoc
     */
    public function removeUser(User $user)
    {
        $this->users->removeElement($user);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setEmail(Email $email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @inheritdoc
     */
    public function setPhone(PhoneNumberInterface $phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPhone()
    {
        return $this->phone;
    }

    public function __toString()
    {
        return $this->getFirstName(). ' ' . $this->getLastName() . ' - '. $this->getNumber() . ', ' . $this->getLine1() . ' - ' . ($this->getCity() ? $this->getCity()->getName() : '');
    }

}
