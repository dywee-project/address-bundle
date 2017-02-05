<?php

namespace Dywee\AddressBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * City
 *
 * @ORM\Table(name="city")
 * @ORM\Entity(repositoryClass="Dywee\AddressBundle\Repository\CityRepository")
 */
class City implements CityInterface
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="zip", type="string", length=10)
     */
    private $zip;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float")
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float")
     */
    private $longitude;

    /**
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="cities")
     */
    private $country;


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
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @inheritdoc
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @inheritdoc
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @inheritdoc
     */
    public function setCountry(CountryInterface $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getZipName()
    {
        return $this->getZip() . ' - ' . $this->getName();
    }
}
