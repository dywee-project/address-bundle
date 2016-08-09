<?php
/**
 * Created by PhpStorm.
 * User: Olivier
 * Date: 6/08/16
 * Time: 10:44
 */
namespace Dywee\AddressBundle\Entity;
use Dywee\CoreBundle\Model\PersistableInterface;


interface CountryInterface extends PersistableInterface
{

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Country
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set iso
     *
     * @param string $iso
     *
     * @return Country
     */
    public function setIso($iso);

    /**
     * Get iso
     *
     * @return string
     */
    public function getIso();

    /**
     * Set vatRate
     *
     * @param string $vatRate
     *
     * @return Country
     */
    public function setVatRate($vatRate);

    /**
     * Get vatRate
     *
     * @return string
     */
    public function getVatRate();

    /**
     * Set phonePrefix
     *
     * @param integer $phonePrefix
     *
     * @return Country
     */
    public function setPhonePrefix($phonePrefix);

    /**
     * Get phonePrefix
     *
     * @return int
     */
    public function getPhonePrefix();

    /**
     * Add city
     *
     * @param \Dywee\AddressBundle\Entity\City $city
     *
     * @return Country
     */
    public function addCity(\Dywee\AddressBundle\Entity\City $city);

    /**
     * Remove city
     *
     * @param \Dywee\AddressBundle\Entity\City $city
     */
    public function removeCity(\Dywee\AddressBundle\Entity\City $city);

    /**
     * Get cities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCities();

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers();
}