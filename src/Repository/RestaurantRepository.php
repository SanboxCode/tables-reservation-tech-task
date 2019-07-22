<?php

namespace App\Repository;

use App\Entity\Restaurant\Restaurant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Restaurant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Restaurant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Restaurant[]    findAll()
 * @method Restaurant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RestaurantRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Restaurant::class);
    }

    /**
     * @param array|null $filter
     *
     * @return QueryBuilder
     */
    public function createFiltered(array $filter = null)
    {
        $qb = $this->createQueryBuilder('r');

        if ($filter['titleFilter']) {
            $qb
                ->andwhere($qb->expr()->like('r.title', ':filter'))
                ->setParameter('filter', '%'.$filter['titleFilter'].'%');
        }

        return $qb;
    }
}
