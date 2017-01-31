<?php

namespace Lch\MediaBundle\Uploader;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUploader
{
    private $rootDir;

    public function __construct($rootDir)
    {
        $this->rootDir = $rootDir;
    }

    public function upload(UploadedFile $file)
    {
        $rootPath = "/uploads/images/" . date('Y') . "/" . date('m') . "/";

        $imagesDir = "{$this->rootDir}/../web{$rootPath}";

        if(!file_exists($imagesDir)) {
            mkdir($imagesDir, 0755, true);
        }

        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move($imagesDir, $fileName);

        return $rootPath.$fileName;
    }
}