<?php

namespace App\Models;


use Symfony\Component\HttpFoundation\File\UploadedFile;
use Intervention\Image\Facades\Image as InterventionImage;

class ImageService {
    const MAX_IMAGE_WIDTH = 100;
    const MAX_IMAGE_HEIGHT = 100;

    public static function store(UploadedFile $uploadedFile) {
        try {
            $imageRoot = self::getImageRootFolder();
            $saveTo = $imageRoot . '/' . $uploadedFile->getClientOriginalName();
            return self::resizeImage($uploadedFile, $saveTo, self::MAX_IMAGE_WIDTH, self::MAX_IMAGE_HEIGHT);
        } catch (\Exception $exception) {
            //TODO: Logging or do something...
            throw $exception;
        }
    }

    public static function resizeImage(UploadedFile $uploadedFile, $saveTo, $maxWidth, $maxHeight) {
        $image = InterventionImage::make($uploadedFile->getRealPath())->orientate();
        $imageWidth = $image->width() > $maxWidth ? $maxWidth : $image->width();
        $imageHeight = $image->height() > $maxHeight ? $maxHeight : $image->height();
        $imageWidth > $imageHeight ? $imageWidth = null : $imageHeight = null;

        $image->resize($imageWidth, $imageHeight, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save($saveTo);
        return self::getRelativePath($saveTo);
    }

    private static function getImageRootFolder() {
        $imageRoot = storage_path('/upload/images/');
        if (!is_dir($imageRoot)) {
            mkdir($imageRoot, 0755, true);
        }
        return is_dir($imageRoot) ? $imageRoot : null;
    }

    private static function getRelativePath($fullPath) {
        return str_replace(storage_path(), '', $fullPath);
    }

}