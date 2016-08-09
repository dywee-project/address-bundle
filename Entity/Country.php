<?php

namespace Dywee\AddressBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Country
 *
 * @ORM\Table(name="country")
 * @ORM\Entity(repositoryClass="Dywee\AddressBundle\Repository\CountryRepository")
 */
class Country implements CountryInterface
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="iso", type="string", length=10, unique=true)
     */
    private $iso;

    /**
     * @var string
     *
     * @ORM\Column(name="vatRate", type="decimal", precision=4, scale=2, nullable=true)
     */
    private $vatRate;

    /**
     * @var int
     *
     * @ORM\Column(name="phonePrefix", type="smallint")
     */
    private $phonePrefix;

    /**
     * @ORM\OneToMany(targetEntity="City", mappedBy="country")
     */
    private $cities;



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
     * @return Country
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
     * Set iso
     *
     * @param string $iso
     *
     * @return Country
     */
    public function setIso($iso)
    {
        $this->iso = $iso;

        return $this;
    }

    /**
     * Get iso
     *
     * @return string
     */
    public function getIso()
    {
        return $this->iso;
    }

    /**
     * Set vatRate
     *
     * @param string $vatRate
     *
     * @return Country
     */
    public function setVatRate($vatRate)
    {
        $this->vatRate = $vatRate;

        return $this;
    }

    /**
     * Get vatRate
     *
     * @return string
     */
    public function getVatRate()
    {
        return $this->vatRate;
    }

    /**
     * Set phonePrefix
     *
     * @param integer $phonePrefix
     *
     * @return Country
     */
    public function setPhonePrefix($phonePrefix)
    {
        $this->phonePrefix = $phonePrefix;

        return $this;
    }

    /**
     * Get phonePrefix
     *
     * @return int
     */
    public function getPhonePrefix()
    {
        return $this->phonePrefix;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cities = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add city
     *
     * @param \Dywee\AddressBundle\Entity\City $city
     *
     * @return Country
     */
    public function addCity(\Dywee\AddressBundle\Entity\City $city)
    {
        $this->cities[] = $city;
        $city->setCountry($this);

        return $this;
    }

    /**
     * Remove city
     *
     * @param \Dywee\AddressBundle\Entity\City $city
     */
    public function removeCity(\Dywee\AddressBundle\Entity\City $city)
    {
        $this->cities->removeElement($city);
    }

    /**
     * Get cities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCities()
    {
        return $this->cities;
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
}
