<?php
/**
 * Created by PhpStorm.
 * User: Olivier
 * Date: 6/08/16
 * Time: 10:43
 */
namespace Dywee\AddressBundle\Entity;
use Dywee\CoreBundle\Model\PersistableInterface;


interface CityInterface extends PersistableInterface
{
    /**
     * Set name
     *
     * @param string $name
     *
     * @return City
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set zip
     *
     * @param string $zip
     *
     * @return City
     */
    public function setZip($zip);

    /**
     * Get zip
     *
     * @return string
     */
    public function getZip();

    /**
     * Set latitude
     *
     * @param float $latitude
     *
     * @return City
     */
    public function setLatitude($latitude);

    /**
     * Get latitude
     *
     * @return float
     */
    public function getLatitude();

    /**
     * Set longitude
     *
     * @param float $longitude
     *
     * @return City
     */
    public function setLongitude($longitude);

    /**
     * Get longitude
     *
     * @return float
     */
    public function getLongitude();

    /**
     * Set country
     *
     * @param CountryInterface $country
     *
     * @return City
     */
    public function setCountry(CountryInterface $country = null);

    /**
     * Get country
     *
     * @return CountryInterface
     */
    public function getCountry();

    public function getZipName();
}