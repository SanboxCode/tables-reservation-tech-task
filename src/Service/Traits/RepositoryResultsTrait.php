<?php

namespace App\Service\Traits;

use Doctrine\ORM\QueryBuilder;

/**
 * Trait RepositoryResultsTrait
 */
trait RepositoryResultsTrait
{
    /**
     * @var bool
     */
    protected $returnQuery = false;

    /**
     * @param bool $shouldReturnQuery
     *
     * @return RepositoryResultsTrait
     */
    public function setReturnQuery(bool $shouldReturnQuery): self
    {
        $this->returnQuery = $shouldReturnQuery;

        return $this;
    }

    /**
     * @return bool
     */
    public function shouldReturnQuery(): bool
    {
        return $this->returnQuery;
    }

    /**
     * @param QueryBuilder $qb
     *
     * @return array|null
     */
    public function getResult(QueryBuilder $qb): ?array
    {
        $result = $this->returnQuery ? $qb : $qb->getQuery()->getResult();

        $this->setReturnQuery(false);

        return $result;
    }
}
