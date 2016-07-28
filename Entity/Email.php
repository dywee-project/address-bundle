<?php

namespace Dywee\AddressBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Email
 *
 * @ORM\Table(name="email")
 * @ORM\Entity(repositoryClass="Dywee\AddressBundle\Repository\EmailRepository")
 */
class Email
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
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var bool
     *
     * @ORM\Column(name="isMain", type="boolean", nullable=true)
     */
    private $isMain;

    /**
     * @ORM\ManyToOne(targetEntity="Dywee\UserBundle\Entity\User", inversedBy="emails")
     */
    private $user;


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
     * Set email
     *
     * @param string $address
     *
     * @return Email
     */
    public function setEmail($address)
    {
        $this->email = strtolower($address);

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
     * Set isMain
     *
     * @param boolean $isMain
     *
     * @return Email
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

    /**
     * Set user
     *
     * @param \Dywee\UserBundle\Entity\User $user
     *
     * @return Email
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
}
