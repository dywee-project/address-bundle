<?php

namespace Dywee\AddressBundle\Repository;
use Dywee\UserBundle\Entity\User;

/**
 * AddressRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AddressRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAddressForUser(User $user)
    {
        $qb = $this->createQueryBuilder('a')
            ->select('a')
            ->where('a.users = :user')
            ->setParameter('user', $user);

        return $qb->getQuery()->getResult();
    }
}
