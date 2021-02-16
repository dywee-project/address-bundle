<?php
/**
 * Created by PhpStorm.
 * User: Olivier
 * Date: 6/08/16
 * Time: 10:53
 */
namespace Dywee\AddressBundle\Entity;


/**
 * PhoneNumber
 */
interface PhoneNumberInterface
{
    /**
     * Get id
     *
     * @return int
     */
    public function getId();

    /**
     * Set phoneNumber
     *
     * @param phone_number $phoneNumber
     *
     * @return PhoneNumberInterface
     */
    public function setPhoneNumber($phoneNumber);

    /**
     * Get phoneNumber
     *
     * @return phone_number
     */
    public function getPhoneNumber();

    /**
     * Set isMain
     *
     * @param boolean $isMain
     *
     * @return PhoneNumberInterface
     */
    public function setIsMain($isMain);

    /**
     * Get isMain
     *
     * @return bool
     */
    public function getIsMain();


    /**
     * @ORM\PostLoad
     */
    public function setInternationalPhoneNumber();

    public function getInternationalPhoneNumber();
}
