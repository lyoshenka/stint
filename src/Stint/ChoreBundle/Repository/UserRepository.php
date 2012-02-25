<?php
namespace Stint\ChoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{

  public function findUnassignedToChore(\Stint\ChoreBundle\Entity\Chore $chore)
  {
    return $this->createQueryBuilder('u')
      ->leftJoin('u.chores', 'c', 'WITH', 'c.id = :id')
      ->where('c.id IS NULL')
      ->setParameter('id', $chore->getId())
      ->getQuery()
      ->getResult();
  }
}