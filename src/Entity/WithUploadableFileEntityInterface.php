<?php

namespace App\Entity;

use Symfony\Component\HttpFoundation\File\File;

/**
 * Interface WithUploadableFileEntityInterface
 */
interface WithUploadableFileEntityInterface
{
    /**
     * @return File
     */
    public function getFile(): ?file;

    /**
     * @param File $file
     *
     * @return $this
     */
    public function setFile(File $file);

    /**
     * @return string
     */
    public function getFileName(): ?string;

    /**
     * @param mixed $fileName
     *
     * @return $this
     */
    public function setFileName($fileName);

    /**
     * @return mixed
     */
    public function getOriginalFileName(): string;

    /**
     * @param mixed $originalFileName
     *
     * @return $this
     */
    public function setOriginalFileName($originalFileName);

    /**
     * @return mixed
     */
    public function getFileMimeType(): string;

    /**
     * @param mixed $fileMimeType
     *
     * @return $this
     */
    public function setFileMimeType($fileMimeType);

    /**
     * @return mixed
     */
    public function getFileSize(): int;

    /**
     * @param mixed $fileSize
     *
     * @return $this
     */
    public function setFileSize($fileSize);

    /**
     * @return bool
     */
    public function hasFile(): bool;
}