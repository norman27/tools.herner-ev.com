<?php

namespace AppBundle\Repository;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class FilesRepository {
    const EXTENSION_JPG = 'jpg';
    const EXTENSION_JPEG = 'jpeg';
    const EXTENSION_PNG = 'png';
    const EXTENSION_MP4 = 'mp4';

    /** @var string */
    private $rootDir = '';

    public function __construct() {
        $this->rootDir = realpath(__DIR__ . '/../../../web/media') . '/';
    }

    /**
     * @param string $origName
     * @return string
     */
    public function simplifyFilename($origName) {
        return strtolower(str_replace(' ', '_', $origName));
    }

    /**
     * @param string $filename
     */
    public function delete($filename) {
        unlink($this->rootDir . $filename);
    }

    /**
     * @return SplFileInfo[]
     */
    public function getAllFiles() {
        $finder = new Finder();

        /** @var SplFileInfo[] $foundFiles */
        $foundFiles = $finder->files()->in(realpath($this->rootDir));

        $files = [];
        foreach ($foundFiles as $file) {
            $files[$file->getFilename()] = $file;
        }

        ksort($files);

        return $files;
    }

    /**
     * @return SplFileInfo[]
     */
    public function getAllImages() {
        $foundFiles = $this->getAllFiles();

        foreach ($foundFiles as $name => $file) {
            if (!$this->isImage($file)) {
                unset($foundFiles[$name]);
            }
        }

        return $foundFiles;
    }

    /**
     * @return SplFileInfo[]
     */
    public function getAllVideos() {
        $foundFiles = $this->getAllFiles();

        foreach ($foundFiles as $name => $file) {
            if (!$this->isVideo($file)) {
                unset($foundFiles[$name]);
            }
        }

        return $foundFiles;
    }

    /**
     * @param SplFileInfo $file
     * @return boolean
     */
    private function isImage(SplFileInfo $file) {
        return in_array(strtolower($file->getExtension()), [self::EXTENSION_JPG, self::EXTENSION_JPEG, self::EXTENSION_PNG]);
    }

    /**
     * @param SplFileInfo $file
     * @return boolean
     */
    private function isVideo(SplFileInfo $file) {
        return in_array(strtolower($file->getExtension()), [self::EXTENSION_MP4]);
    }
}