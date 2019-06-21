<?php

namespace AppBundle\Screen;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use URLify;

class FilesRepository
{
    /** @var string */
    private $directory = '';

    /**
     * @param string $directory
     */
    public function __construct($directory)
    {
        $this->directory = realpath($directory) . '/';
    }

    /**
     * @param string $filename
     */
    public function delete($filename)
    {
        unlink($this->directory . $this->simplifyFilename($filename));
    }

    /**
     * @param UploadedFile $file
     */
    public function upload(UploadedFile $file) {
        $file->move(
            $this->directory,
            $this->simplifyFilename($file->getClientOriginalName())
        );
    }

    /**
     * @return SplFileInfo[]
     */
    public function getAll()
    {
        $finder = new Finder();

        /** @var SplFileInfo[] $foundFiles */
        $foundFiles = $finder->files()->in(realpath($this->directory));

        $files = [];
        foreach ($foundFiles as $file)
        {
            $files[$file->getFilename()] = $file;
        }

        ksort($files);
        return $files;
    }

    /**
     * @param string $origName
     * @return string
     */
    private function simplifyFilename($origName)
    {
        return URLify::filter($origName, 60, '', true);
    }
}