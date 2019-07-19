<?php

namespace App\Entity\Restaurant;

use App\Entity\Table\Table;
use App\Entity\Traits\WithCreatedAt;
use App\Entity\Traits\WithMedia;
use App\Entity\Traits\WithUpdatedAt;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RestaurantRepository")
 */
class Restaurant
{
    use WithMedia;
    use WithCreatedAt;
    use WithUpdatedAt;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="smallint")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Table\Table", mappedBy="restaurant", orphanRemoval=true)
     */
    private $tables;

    /**
     * Restaurant constructor.
     */
    public function __construct()
    {
        $this->tables = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return Restaurant
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

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
     * @return Restaurant
     */
    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|Table[]
     */
    public function getTables(): Collection
    {
        return $this->tables;
    }

    /**
     * @param Table $table
     *
     * @return Restaurant
     */
    public function addTable(Table $table): self
    {
        if (!$this->tables->contains($table)) {
            $this->tables[] = $table;
            $table->setRestaurant($this);
        }

        return $this;
    }

    /**
     * @param Table $table
     *
     * @return Restaurant
     */
    public function removeTable(Table $table): self
    {
        if ($this->tables->contains($table)) {
            $this->tables->removeElement($table);
            // set the owning side to null (unless already changed)
            if ($table->getRestaurant() === $this) {
                $table->setRestaurant(null);
            }
        }

        return $this;
    }

    public function getActiveTables()
    {
        $count = 0;

        foreach ($this->getTables() as $table) {
            if ($table->getStatus()) {
                $count++;
            }
        }

        return $count;
    }

}
