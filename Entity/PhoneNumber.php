<?php

namespace Dywee\AddressBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PhoneNumber
 *
 * @ORM\Table(name="phone_number")
 * @ORM\Entity(repositoryClass="Dywee\AddressBundle\Repository\PhoneNumberRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class PhoneNumber implements PhoneNumberInterface
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
     * @var phone_number
     *
     * @ORM\Column(name="phoneNumber", type="phone_number")
     */
    private $phoneNumber;

    /**
     * @var bool
     *
     * @ORM\Column(name="isMain", type="boolean", nullable=true)
     */
    private $isMain = false;


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
     * Set phoneNumber
     *
     * @param phone_number $phoneNumber
     *
     * @return PhoneNumberInterface
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return phone_number
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set isMain
     *
     * @param boolean $isMain
     *
     * @return PhoneNumberInterface
     */
    public function setIsMain($isMain)
    {
        $this->isMain = $isMain;

        return $this;
    }

    /**
     * Get isMain
     *
     * @return bool
     */
    public function getIsMain()
    {
        return $this->isMain;
    }

    protected $internationalPhoneNumber;

    /**
     * @ORM\PostLoad
     */
    public function setInternationalPhoneNumber()
    {
        $this->internationalPhoneNumber = '+' . $this->getPhoneNumber()->getCountryCode() . $this->getPhoneNumber()->getNationalNumber();

        return $this;
    }

    public function getInternationalPhoneNumber()
    {
        return '+' . $this->getPhoneNumber()->getCountryCode() . $this->getPhoneNumber()->getNationalNumber();
    }
}
