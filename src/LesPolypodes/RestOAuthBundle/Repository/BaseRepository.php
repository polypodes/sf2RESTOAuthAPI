<?php

namespace LesPolypodes\RestOAuthBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\QueryBuilder;

/**
 * Class BaseRepository
 * @package LesPolypodes\RestOAuthBundle\Repository
 */
abstract class BaseRepository extends EntityRepository
{
    /**
     * used in DQL expressions
     */
    const QUERY_ALIAS = '';

    /** ************* */
    /** F I N D E R S */

    /**
     * findAllOrderByTitle
     *
     * @return ArrayCollection
     */
    public function findAllOrderByTitle()
    {
        return $this
            ->buildOrderByTitle()
            ->getQuery()
            ->execute()
            ;
    }

    /**
     * buildOrderByTitle
     *
     * @param QueryBuilder $qb
     * @param string       $direction
     *
     * @return QueryBuilder
     */
    protected function buildOrderByTitle(QueryBuilder $qb = null, $direction = 'ASC')
    {
        if (null === $qb) {
            $qb = $this->createQueryBuilder(static::QUERY_ALIAS);
        }

        return $qb
            ->orderBy(sprintf("%s.title", static::QUERY_ALIAS), $direction)
            ;
    }

    /**
     * findAllOrderByCreation
     *
     * @return ArrayCollection
     */
    public function findAllOrderByCreation()
    {
        return $this
            ->buildOrderByCreation()
            ->getQuery()
            ->execute()
            ;
    }

    /**
     * buildOrderByCreation
     *
     * @param QueryBuilder $qb
     * @param string       $direction
     *
     * @return QueryBuilder
     */
    private function buildOrderByCreation(QueryBuilder $qb = null, $direction = 'ASC')
    {
        if (null === $qb) {
            $qb = $this->createQueryBuilder(static::QUERY_ALIAS);
        }

        return $qb
            ->orderBy(sprintf("%s.createdAt", static::QUERY_ALIAS), $direction)
            ;
    }

    /** *************** */
    /** B U I L D E R S */

    /**
     * findAllOrderByCreationLimitedBy
     *
     * @param int $limit 10
     *
     * @return ArrayCollection
     */
    public function findAllOrderByCreationLimitedBy($limit = 10)
    {
        $limit = (int) $limit > 0 ? (int) $limit : 1;

        return $this
            ->buildOrderByCreation()
            ->getQuery()
            ->setMaxResults($limit)
            ->execute()
            ;
    }

    /**
     * findAllOrderByCreationAndTitledLike
     *
     * @param  string                    $title
     * @throws \InvalidArgumentException
     *
     * @return ArrayCollection
     */
    public function findAllOrderByCreationAndTitledLike($title)
    {

        if (empty($title)) {
            throw new \InvalidArgumentException("title parameter cannot be empty.");
        }

        $qb = $this->buildOrderByCreation();
        $qb = $this->buildByTitleLike($title, $qb)
        ;

        return $qb
            ->getQuery()
            ->execute()
            ;
    }

    /**
     * buildByTitleLike
     *
     * @param string       $title
     * @param QueryBuilder $qb
     *
     * @return QueryBuilder
     */
    protected function buildByTitleLike($title, QueryBuilder $qb = null)
    {
        if (null === $qb) {
            $qb = $this->createQueryBuilder(static::QUERY_ALIAS);
        }

        return $qb
            ->andWhere(sprintf("%s.title LIKE :title", static::QUERY_ALIAS))
            ->setParameter('title', sprintf("%\%s%", $title))
            ;
    }

}
