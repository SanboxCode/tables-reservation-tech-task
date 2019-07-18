<?php

namespace App\Entity\Media;

/**
 * Interface WithMediaEntityInterface
 */
interface WithMediaEntityInterface
{
    /**
     * @param Media $media
     *
     * @return mixed
     */
    public function setMedia(Media $media);

    /**
     * @return Media
     */
    public function getMedia();

}