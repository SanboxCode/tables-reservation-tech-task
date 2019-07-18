<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Trait WithUploadFile
 */
trait WithUploadableFile
{
    /**
     * @var File
     *
     * @Vich\UploadableField(
     *     mapping="file",
     *     fileNameProperty="fileName",
     *     size="fileSize",
     *     mimeType="fileMimeType",
     *     originalName="originalFileName"
     * )
     */
    protected $file;

    /**
     * @ORM\Column(name="file_name", type="string", length=255, nullable=true)
     */
    protected $fileName;

    /**
     * @ORM\Column(name="original_file_name", type="string", length=255, nullable=true)
     */
    protected $originalFileName;

    /**
     * @ORM\Column(name="file_mime_type", type="string", length=255, nullable=true)
     */
    protected $fileMimeType;

    /**
     * @ORM\Column(name="file_size", type="integer", nullable=true)
     */
    protected $fileSize;

    /**
     * @return File
     */
    public function getFile(): ?File
    {
        return $this->file;
    }

    /**
     * @param File $file
     *
     * @return $this
     */
    public function setFile(File $file = null)
    {
        $this->file = $file;

        if ($file) {
            $this->setCreatedAt(new \DateTime('now'));
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    /**
     * @param mixed $fileName
     *
     * @return $this
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalFileName(): string
    {
        return $this->originalFileName;
    }

    /**
     * @param mixed $originalFileName
     *
     * @return $this
     */
    public function setOriginalFileName($originalFileName)
    {
        $this->originalFileName = $originalFileName;

        return $this;
    }

    /**
     * @return string
     */
    public function getFileMimeType(): string
    {
        return $this->fileMimeType;
    }

    /**
     * @param mixed $fileMimeType
     *
     * @return $this
     */
    public function setFileMimeType($fileMimeType)
    {
        $this->fileMimeType = $fileMimeType;

        return $this;
    }

    /**
     * @return int
     */
    public function getFileSize(): int
    {
        return $this->fileSize;
    }

    /**
     * @param mixed $fileSize
     *
     * @return $this
     */
    public function setFileSize($fileSize)
    {
        $this->fileSize = $fileSize;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasFile(): bool
    {
        return !!$this->fileName;
    }
}