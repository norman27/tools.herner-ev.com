<?php

namespace App\Screen;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use URLify;

class FilesRepository
{
    /** @var string */
    private $directory = '';

    public function __construct()
    {
        $this->directory = realpath(
                __DIR__
                . DIRECTORY_SEPARATOR . '..'
                . DIRECTORY_SEPARATOR . '..'
                . DIRECTORY_SEPARATOR . '..'
                . DIRECTORY_SEPARATOR . 'public'
                . DIRECTORY_SEPARATOR . 'media'
                . DIRECTORY_SEPARATOR . 'screen'
            ) . '/';
    }

    /**
     * @param string $filename
     */
    public function delete(string $filename)
    {
        unlink($this->directory . $this->simplifyFilename($filename));
    }

    /**
     * @param UploadedFile $file
     */
    public function upload(UploadedFile $file)
    {
        $newFilename = $this->simplifyFilename($file->getClientOriginalName());
        $file->move($this->directory, $newFilename);
    }

    /**
     * @return SplFileInfo[]
     */
    public function getAll(): array
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

    public function getAllNames(): array
    {
        $keys = array_keys($this->getAll());
        return array_combine($keys, $keys);
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