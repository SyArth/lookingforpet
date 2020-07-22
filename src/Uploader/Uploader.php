<?php

namespace App\Uploader;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * class Uploader
 * @package App\Uploader
 */
class Uploader implements UploaderInterface
{
    /**
     * @var SluggerInterface
     */
    private SluggerInterface $slugger;

    /**
     * @var string
     */
    private string $uploadsRelativeDir;

    /**
     * @var string
     */
    private string $uploadsAbsoluteDir;

    /**
     * Uploader constructor
     * @param Sluggerinterface $slugger
     * @param string $uploadsAbsoluteDir
     * @param string $uploadsRelativeDir
     */
    public function __construct(SluggerInterface $slugger, string $uploadsAbsoluteDir, string $uploadsRelativeDir)
    {
        $this->slugger = $slugger;
        $this->uploadsAbsoluteDir = $uploadsAbsoluteDir;
        $this->uploadsRelativeDir = $uploadsRelativeDir;
    }

    /**
     *
     * @param UploadedFile $file
     * @return string
     */
    public function upload(UploadedFile $file): string
    {
        $filename = sprintf(
            "%s %s %s",
            $this->slugger->slug($file->getClientOriginalName()),
            uniqid(),
            $file->getClientOriginalExtension()
        );
        $file->move($this->uploadsAbsoluteDir, $filename);
        return $this->uploadsRelativeDir . "/" . $filename;
    }
   
}