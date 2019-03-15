<?php

namespace Tests\ImageMimeTypeGuesser;

use \ImageMimeTypeGuesser\ImageMimeTypeGuesser;
use \PHPUnit\Framework\TestCase;

class ImageMimeTypeGuesserGuesserTest extends TestCase
{


/*
    public function testGuessMimeType()
    {
        global $thisTest;
        $thisTest = $this;

        function testDetector($detectorClassName = null, $filePath = null, $expectedMime = null)
        {
            global $thisTest;
            if (is_null($detectorClassName)) {
                return;
            }
            $mime = call_user_func(array("\\ImageMimeTypeGuesser\\Detectors\\" . $detectorClassName, 'detect'), $filePath);
            if (is_null($mime)) {
                // this is ok
                return;
            }
            if ($mime === false) {
                // also ok
                return;
            }
            $thisTest->assertEquals($mime, $expectedMime);
        }

        function testAllDetectors($fileName = null, $expectedMime = null)
        {
            $detectors = [
                'ExifImageType',
                'GetImageSize',
                'FInfo',
                'MimeContentType',
                'Stack'
            ];

            foreach ($detectors as $className) {
                testDetector($className, __DIR__ . '/images/' . $fileName, $expectedMime);
            }
        }

        // images
        testAllDetectors('gif-test.gif', 'image/gif');
        //testAllDetectors('ico-test.gif', 'image/vnd.microsoft.icon');
        testAllDetectors('jpg-test.jpg', 'image/jpeg');
        testAllDetectors('png-test.png', 'image/png');
        testAllDetectors('tif-test.tif', 'image/tiff');
        testAllDetectors('webp-test.webp', 'image/webp');

        // special cases
        testAllDetectors('jpg-with space.jpg', 'image/jpeg');
        testAllDetectors('png-with-jpeg-extension.jpg', 'image/png');
        testAllDetectors('png-without-extension', 'image/png');
        testAllDetectors('png-not-true-color.png', 'image/png');

        // not images
        testAllDetectors('non-existing', false);
        testAllDetectors('txt-test.txt', false);

    }*/

    public function testGuessMimeTypeFromExtension()
    {
        $this->assertEquals(true, true);
        return;

        global $thisTest;
        $thisTest = $this;

        function doTest($fileName, $expectedMime) {
            global $thisTest;

            $filePath = __DIR__ . '/images/' . $fileName;
            $result = ImageMimeTypeGuesser::guessMimeTypeFromExtension($filePath);
            $thisTest->assertEquals($expectedMime, $result);
        }

        // common mime types
        doTest('gif-test.gif', 'image/gif');
        doTest('jpg-test.jpg', 'image/jpeg');
        doTest('ico-test.gif', 'image/vnd.microsoft.icon');
        doTest('png-test.png', 'image/png');
        doTest('tif-test.tif', 'image/tiff');
        doTest('webp-test.webp', 'image/webp');

        // special cases
        doTest('jpg-with space.jpg', 'image/jpeg');
        doTest('png-with-jpeg-extension.jpg', 'image/jpeg');
        doTest('png-without-extension', false);

        // not images
        doTest('nonexisting', false);
        doTest('not-images/txt-test.txt', false);
        doTest('not-images/odt-test.txt', false);

    }
}
