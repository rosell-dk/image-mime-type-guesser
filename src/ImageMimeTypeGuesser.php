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
     *  - false (if it is not an image that the server knows about)
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
     *  - false (if it is not an image that the server knows about)
     *  - mime  (if it looks like an image)
     *  @return  mime type | false.
     */
    public static function guess($filePath)
    {
        $detectionResult = self::detect($filePath);
        if (!is_null($detectionResult)) {
            return $detectionResult;
        }

        // fall back to the wild west method
        return GuessFromExtension::guess($filePath);
    }

    /**
     *  Try to detect mime type of image using "stack" detector (all available methods, until one succeeds)
     *  But do not take no for an answer, as "no", really only means that the server has not registred that mime type
     *
     *  (this method never returns null)
     *
     *  returns:
     *  - false (if it can be determined that this is not an image)
     *  - mime  (if it looks like an image)
     *  @return  mime type | false.
     */
    public static function lenientGuess($filePath)
    {
        $detectResult = self::detect($filePath);
        if ($detectResult === false) {
            // The server does not recognize this image type.
            // - but perhaps it is because it does not know about this image type.
            // - so we turn to mapping the file extension
            return GuessFromExtension::guess($filePath);
        } elseif (is_null($detectResult)) {
            // the mime type could not be determined
            // perhaps we also in this case want to turn to mapping the file extension
            return GuessFromExtension::guess($filePath);
        }
        return $detectResult;
    }



    public static function guessIsIn($filePath, $mimeTypes)
    {
        return in_array(self::guess($filePath), $mimeTypes);
    }

    public static function detectIsIn($filePath, $mimeTypes)
    {
        return in_array(self::detect($filePath), $mimeTypes);
    }

    public static function lenientGuessIsIn($filePath, $mimeTypes)
    {
        return in_array(self::lenientGuess($filePath), $mimeTypes);
    }
}
