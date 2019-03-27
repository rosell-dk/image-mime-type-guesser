<?php

namespace ImageMimeTypeGuesser\Detectors;

class MimeContentType extends AbstractDetector
{

    /**
     * Try to detect mime type of image using *mime_content_type()*
     *
     * Returns:
     * - mime type (string) (if it is in fact an image, and type could be determined)
     * - false (if it can be determined that this is not an image)
     * - void  (if nothing can be determined)
     *
     * @param  string  $filePath  The path to the file
     * @return string|void|false  mimetype (if it is an image, and type could be determined),
     *    false (if it can be determined that this is not an image)
     *    or void (if nothing can be determined)
     */
    protected function doDetect($filePath)
    {
        // mime_content_type supposedly used to be deprecated, but it seems it isn't anymore
        // it may return false on failure.
        if (function_exists('mime_content_type')) {
            try {
                $result = mime_content_type($filePath);
                if ($result !== false) {
                    if (strpos($result, 'image/') === 0) {
                        return $result;
                    } else {
                        return false;
                    }
                }
            } catch (\Exception $e) {
                // we are unstoppable!
            }
        }
    }
}
