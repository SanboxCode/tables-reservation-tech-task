<?php

namespace App\Service;

use App\Entity\Restaurant\Restaurant;
use App\Service\Traits\RepositoryResultsTrait;

/**
 * Class PrizeService
 */
class RestaurantService extends BaseService
{
    use RepositoryResultsTrait;

    /**
     * @return string
     */
    public function getEntityClass(): string
    {
        return Restaurant::class;
    }

    /**
     * @param array|null $filters
     *
     * @return array
     */
    public function getAllFiltered(array $filters = null): array
    {
        return $this->getResult($this->repository->createFiltered($filters));
    }

}
