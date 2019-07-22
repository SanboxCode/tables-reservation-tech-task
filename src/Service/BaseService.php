<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * Class BaseService
 */
abstract class BaseService
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var EntityRepository
     */
    protected $repository;

    /**
     * BaseService constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->setRepository();
    }

    /**
     * get all entities
     *
     * @return array
     */
    public function getAll()
    {
        return $this->repository->findAll();
    }

    /**
     * get QueryBuilder
     *
     * @return QueryBuilder
     */
    public function getQueryBuilder(): QueryBuilder
    {
        return $this->repository->createQueryBuilder('e');
    }

    /**
     * flush data to db
     */
    public function flush()
    {
        $this->em->flush();
    }

    /**
     * @param mixed $entity
     * @param bool  $flush
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function update($entity, bool $flush = true)
    {
        try {
            $this->persist($entity);

            if ($flush) {
                $this->flush();
            }

        } catch (\Exception $e) {
            throw $e;
        }

        return $entity;
    }

    /**
     * @param mixed $entity
     * @param bool  $flush
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function create($entity, $flush = true)
    {
        try {
            $this->persist($entity);

            if ($flush) {
                $this->flush();
            }
        } catch (\Exception $e) {
            throw $e;
        }

        return $entity;
    }

    /**
     * @param mixed $entity
     */
    public function persist($entity)
    {
        $this->em->persist($entity);
    }

    /**
     * @return string
     */
    abstract public function getEntityClass(): string;

    /**
     * @param      $entity
     * @param bool $flush
     *
     * @throws \Exception
     */
    public function remove($entity, bool $flush = true)
    {
        try {
            $this->em->remove($entity);

            if ($flush) {
                $this->em->flush();
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * set repository
     */
    private function setRepository(): void
    {
        $this->repository = $this->em->getRepository($this->getEntityClass());
    }

    /**
     * clean repository
     */
    public function clear(): void
    {
        $this->repository->clear();
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function getOneById(int $id)
    {
        return $this->repository->find($id);
    }

    /**
     * @param array      $criteria
     * @param array|null $orderBy
     * @param null       $limit
     * @param null       $offset
     *
     * @return mixed
     */
    public function getBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->repository->findBy($criteria, $orderBy, $limit, $offset);
    }

    public function getByIds(array $ids)
    {
        return $this->repository->find($ids);
    }
}
