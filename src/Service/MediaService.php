<?php

namespace App\Service;

/**
 * Class MediaService
 */
class MediaService
{
    /**
     * @var string
     */
    private $uploadPath;

    /**
     * MediaService constructor.
     *
     * @param $uploadPath
     */
    public function __construct($uploadPath)
    {
        $this->uploadPath = $uploadPath;
    }

    /**
     * @param string $filename
     *
     * @return string
     */
    public function generateFilenameUploadPath($filename)
    {
        return $this->uploadPath . '/' . $filename;
    }
}
