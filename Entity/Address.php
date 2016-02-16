<?php

namespace Dywee\AddressBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Address
 *
 * @ORM\Table(name="addresses")
 * @ORM\Entity(repositoryClass="Dywee\AddressBundle\Entity\AddressRepository")
 */
class Address
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="addressName", type="string", length=255, nullable=true)
     * @Assert\DateTime()
     */
    private $addressName;

    /**
     * @var string
     * @ORM\Column(name="companyName", type="string", length=255, nullable=true)
     */
    private $companyName;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255)
     * @Assert\Length(min=2)
     */
    private $firstName;

    /**
     * @var string
     * @ORM\Column(name="lastName", type="string", length=255)
     * @Assert\Length(min=2)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="address1", type="string", length=255)
     * @Assert\Length(min=2, max=32)
     */
    private $address1;

    /**
     * @var string
     *
     * @ORM\Column(name="address2", type="string", length=255, nullable=true)
     * @Assert\Length(min=2, max=32)
     */
    private $address2;

    /**
     * @var string
     *
     * @ORM\Column(name="other", type="string", length=255, nullable=true)
     */
    private $other;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="phone_number", nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="mobile", type="phone_number", nullable=true)
     */
    private $mobile;

    /**
     * @var integer
     *
     * @ORM\Column(name="state", type="smallint", nullable=true)
     */
    private $state;

    /**
     * @var integer
     *
     * @ORM\Column(name="zip", type="string", length=255)
     */
    private $zip;

    /**
     * @var string
     *
     * @ORM\Column(name="citystring", type="string", length=255)
     */
    private $cityString;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Dywee\AddressBundle\Entity\Country", cascade={"persist"})
     */
    private $country;

    /**
     * @ORM\ManyToOne(targetEntity="Dywee\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=true)
     *
     */
    private $user;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="smallint", nullable=true)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="Dywee\WebsiteBundle\Entity\Website")
     */
    private $website;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set addressName
     *
     * @param string $addressName
     * @return Address
     */
    public function setAddressName($addressName)
    {
        $this->addressName = $addressName;

        return $this;
    }

    /**
     * Get addressName
     *
     * @return string 
     */
    public function getAddressName()
    {
        return $this->addressName;
    }

    /**
     * Set companyName
     *
     * @param string $companyName
     * @return Address
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get companyName
     *
     * @return string 
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
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
     * Set email
     *
     * @param string $email
     * @return Address
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set address1
     *
     * @param string $address1
     * @return Address
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;

        return $this;
    }

    /**
     * Get address1
     *
     * @return string 
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * Set address2
     *
     * @param string $address2
     * @return Address
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * Get address2
     *
     * @return string 
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set other
     *
     * @param string $other
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
     * Set phone
     *
     * @param string $phone
     * @return Address
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     * @return Address
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set state
     *
     * @param integer $state
     * @return Address
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return integer 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set zip
     *
     * @param integer $zip
     * @return Address
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get zip
     *
     * @return integer 
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set cityString
     *
     * @param string $cityString
     * @return Address
     */
    public function setCityString($cityString)
    {
        $this->cityString = $cityString;

        return $this;
    }

    /**
     * Get cityString
     *
     * @return string 
     */
    public function getCityString()
    {
        return $this->cityString;
    }

    /**
     * Set idCountry
     *
     * @param string $idCountry
     * @return Address
     */
    public function setIdCountry($idCountry)
    {
        $this->idCountry = $idCountry;

        return $this;
    }

    /**
     * Get idCountry
     *
     * @return string 
     */
    public function getIdCountry()
    {
        return $this->idCountry;
    }

    /**
     * Set user
     *
     * @param \Dywee\UserBundle\Entity\User $user
     * @return Address
     */
    public function setUser(\Dywee\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Dywee\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set type
     *
     * @param integer $oldId
     * @return Address
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set country
     *
     * @param \Dywee\AddressBundle\Entity\country $country
     * @return Address
     */
    public function setCountry(\Dywee\AddressBundle\Entity\country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Dywee\AddressBundle\Entity\country
     */
    public function getCountry()
    {
        return $this->country;
    }

    public function getFormValue()
    {
        return $this->getLastName().' '.$this->getFirstName();
    }

    /**
     * Set website
     *
     * @param \Dywee\WebsiteBundle\Entity\Website $website
     * @return Address
     */
    public function setWebsite(\Dywee\WebsiteBundle\Entity\Website $website = null)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return \Dywee\WebsiteBundle\Entity\Website 
     */
    public function getWebsite()
    {
        return $this->website;
    }
}
