<?php

namespace AppBundle\Repository;

use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\EntityRepository;

/**
 * LinkRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LinkRepository extends EntityRepository
{
    public function getAllLinksByUserId($id)
    {
        /**
         * @var $qb QueryBuilder
         */
        $qb = $this->getEntityManager()->createQueryBuilder();
        $q = $qb->select('l.id, l.url, l.code, l.clicks')
            ->from('AppBundle:Link', 'l')
            ->where('l.user_id = ?1')
            ->setParameter(1, $id)
            ->getQuery();

        return $q->execute();
    }

    public function getLink(string $code)
    {
        /**
         * @var $qb QueryBuilder
         */
        $qb = $this->getEntityManager()->createQueryBuilder();

        $q = $qb->select('l.id, l.url, l.code, l.clicks')
            ->from('AppBundle:Link', 'l')
            ->where('l.code = ?1')
            ->setParameter(1, $code)
            ->setMaxResults(1)
            ->getQuery();

        return $q->execute()[0];
    }
}
