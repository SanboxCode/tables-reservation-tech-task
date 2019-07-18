<?php

namespace App\Entity\Traits;

use App\Entity\Media\Media;

/**
 * Trait WithMedia
 */
trait WithMedia
{
    /**
     * @var $media Media
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Media\Media", cascade={"persist", "remove"})
     * @ORM\JoinColumn(onDelete="SET NULL", nullable=true)
     *
     */
    private $media;

    /**
     * @return Media
     */
    public function getMedia(): ?Media
    {
        return $this->media;
    }

    /**
     * @param Media|null $media
     *
     * @return $this
     */
    public function setMedia(Media $media = null)
    {
        $this->media = $media;

        return $this;
    }
}
