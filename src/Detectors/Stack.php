<?php

namespace ImageMimeTypeGuesser\Detectors;

class Stack extends AbstractDetector
{
    /**
     * Try to detect mime type of image using all available detectors.
     *
     * Returns:
     * - mime type (string) (if it is in fact an image, and type could be determined)
     * - false (if it is not an image type that the server knowns about)
     * - void  (if nothing can be determined)
     *
     * @param  string  $filePath  The path to the file
     * @return string|false|void  mimetype (if it is an image, and type could be determined),
     *    false (if it is not an image type that the server knowns about)
     *    or void (if nothing can be determined)
     */
    protected function doDetect($filePath)
    {
        $detectors = [
            'ExifImageType',
            'GetImageSize',
            'FInfo',
            'MimeContentType'
        ];

        foreach ($detectors as $className) {
            $result = call_user_func(
                array("\\ImageMimeTypeGuesser\\Detectors\\" . $className, 'detect'),
                $filePath
            );
            if (!is_null($result)) {
                return $result;
            }
        }

        return;     // undetermined
    }
}
