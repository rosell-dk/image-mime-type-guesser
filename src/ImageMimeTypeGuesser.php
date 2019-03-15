<?php

/**
 * ImageMimeTypeGuesser - Detect / guess mime type of an image
 *
 * @link https://github.com/rosell-dk/image-mime-type-guesser
 * @license MIT
 */

namespace ImageMimeTypeGuesser;

use \ImageMimeTypeGuesser\Detectors\Stack;

class ImageMimeTypeGuesser
{


    /**
     *  Try to detect mime type of image using "stack" detector (all available methods, until one succeeds)
     *
     *  returns:
     *  - null  (if it cannot be determined)
     *  - false (if it can be determined that this is not an image)
     *  - mime  (if it is in fact an image, and type could be determined)
     *  @return  mime type | null | false.
     */
    public static function detect($filePath)
    {
        // Result of the discussion here:
        // https://github.com/rosell-dk/webp-convert/issues/98

        return Stack::detect($filePath);
    }

    /**
     *  Try to detect mime type of image using "stack" detector (all available methods, until one succeeds)
     *  If that fails, fall back to wild west guessing based solely on file extension, which always has an answer
     *  (this method never returns null)
     *
     *  returns:
     *  - false (if it can be determined that this is not an image)
     *  - mime  (if it is in fact an image, and type could be determined)
     *  @return  mime type | false.
     */
    public static function guess($filePath)
    {
        $detectionResult = self::detect($filePath);
        if (!is_null($detectionResult)) {
            return $detectionResult;
        }

        // fall back to the wild west method
        return GuessFromExtension::guessMimeTypeFromExtension($filePath);
    }
}
