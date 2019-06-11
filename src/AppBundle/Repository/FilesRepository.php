<?php

namespace AppBundle\Repository;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use URLify;

class FilesRepository
{
    const EXTENSION_JPG = 'jpg';
    const EXTENSION_JPEG = 'jpeg';
    const EXTENSION_PNG = 'png';

    /** @var string */
    private $rootDir = '';

    /**
     * @param string $directory
     */
    public function __construct($directory)
    {
        $this->rootDir = realpath($directory);
    }

    /**
     * @param string $origName
     * @return string
     */
    public function simplifyFilename($origName)
    {
        return URLify::filter($origName, 60, '', true);
    }

    /**
     * @param string $filename
     */
    public function delete($filename)
    {
        unlink($this->rootDir . $filename);
    }

    /**
     * @return SplFileInfo[]
     */
    public function getAllFiles()
    {
        $finder = new Finder();

        /** @var SplFileInfo[] $foundFiles */
        $foundFiles = $finder->files()->in(realpath($this->rootDir));

        $files = [];
        foreach ($foundFiles as $file)
        {
            $files[$file->getFilename()] = $file;
        }

        ksort($files);

        return $files;
    }

    /**
     * @return SplFileInfo[]
     */
    public function getAllImages()
    {
        $foundFiles = $this->getAllFiles();

        foreach ($foundFiles as $name => $file)
        {
            if (!$this->isImage($file))
            {
                unset($foundFiles[$name]);
            }
        }

        return $foundFiles;
    }

    /**
     * @param SplFileInfo $file
     * @return boolean
     */
    private function isImage(SplFileInfo $file)
    {
        return in_array(
            strtolower($file->getExtension()),
            [self::EXTENSION_JPG, self::EXTENSION_JPEG, self::EXTENSION_PNG]
        );
    }
}