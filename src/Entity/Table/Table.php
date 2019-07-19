<?php

namespace App\Entity\Table;

use App\Entity\Restaurant\Restaurant;
use Doctrine\ORM\Mapping as ORM;

/**
 * For some reason I cant name table 'table', doctrine crashes
 * @ORM\Entity(repositoryClass="App\Repository\TableRepository")
 * @ORM\Table(name="tables")
 */
class Table
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $capacity;

    /**
     * @ORM\Column(type="smallint")
     */
    private $status;

    /**
     * @ORM\Column(type="smallint")
     */
    private $number;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Restaurant\Restaurant", inversedBy="tables")
     * @ORM\JoinColumn(nullable=false)
     */
    private $restaurant;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    /**
     * @param int $capacity
     *
     * @return Table
     */
    public function setCapacity(int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param int $status
     *
     * @return Table
     */
    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getNumber(): ?int
    {
        return $this->number;
    }

    /**
     * @param int $number
     *
     * @return Table
     */
    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return Restaurant|null
     */
    public function getRestaurant(): ?Restaurant
    {
        return $this->restaurant;
    }

    /**
     * @param Restaurant|null $restaurant
     *
     * @return Table
     */
    public function setRestaurant(?Restaurant $restaurant): self
    {
        $this->restaurant = $restaurant;

        return $this;
    }
}
