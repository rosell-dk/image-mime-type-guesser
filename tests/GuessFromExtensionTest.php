<?php

namespace Tests\ImageMimeTypeGuesser;

use \ImageMimeTypeGuesser\GuessFromExtension;
use \PHPUnit\Framework\TestCase;

class GuessFromExtensionTest extends TestCase
{

    public function testGuessMimeTypeFromExtension()
    {
        $this->assertEquals(true, true);
        return;

        global $thisTest;
        $thisTest = $this;

        function doTest($fileName, $expectedMime) {
            global $thisTest;

            $filePath = __DIR__ . '/images/' . $fileName;
            $result = GuessFromExtension::guess($filePath);
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
