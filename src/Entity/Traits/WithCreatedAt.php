<?php


namespace App\Entity\Traits;

use DateTime;

/**
 * Trait WithCreatedAt
 * @package App\Entity\Traits
 */
trait WithCreatedAt
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @return DateTime|null
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist
     *
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime();
    }
}