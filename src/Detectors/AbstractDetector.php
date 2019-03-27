<?php

namespace ImageMimeTypeGuesser\Detectors;

abstract class AbstractDetector
{
    /**
     * Try to detect mime type of image
     *
     * Returns:
     * - mime type (string) (if it is in fact an image, and type could be determined)
     * - false (if it can be determined that this is not an image)
     * - void  (if nothing can be determined)
     *
     * @param  string  $filePath  The path to the file
     * @return string|false|void  mimetype (if it is an image, and type could be determined),
     *    false (if it can be determined that this is not an image)
     *    or void (if nothing can be determined)
     */
    abstract protected function doDetect($filePath);

    /**
     * Create an instance of this class
     *
     * @param  string  $filePath  The path to the file
     * @return \ImageMimeTypeGuesser\AbstractDetector
     */
    public static function createInstance()
    {
        return new static();
    }

    /**
     * Detect mime type of file (for images only)
     *
     * Returns:
     * - void  (if it cannot be determined)
     * - false (if it can be determined that this is not an image)
     * - mime type (string) (if it is in fact an image, and type could be determined)
     *
     * @param  string  $filePath  The path to the file
     * @return string|void|false
     */
    public static function detect($filePath)
    {
        if (!@file_exists($filePath)) {
            return false;
        }
        return self::createInstance()->doDetect($filePath);
    }
}
