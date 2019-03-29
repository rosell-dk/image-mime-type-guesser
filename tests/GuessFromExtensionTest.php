<?php

namespace Tests\ImageMimeTypeGuesser;

use \ImageMimeTypeGuesser\GuessFromExtension;
use \PHPUnit\Framework\TestCase;

class GuessFromExtensionTest extends TestCase
{

    public function testGuess()
    {

        global $thisTest;
        $thisTest = $this;

        function doTest($fileName, $expectedResult) {
            global $thisTest;

            $filePath = __DIR__ . '/images/' . $fileName;
            $result = GuessFromExtension::guess($filePath);
            $thisTest->assertSame($expectedResult, $result);
        }

/*
        function doTest2($fileName) {
            return GuessFromExtension::guess(__DIR__ . '/images/' . $fileName);
        }
*/

//        $this->assertEquals('image/gif', doTest2('gif-test.gif'));
//        $this->assertEquals('image/gif', GuessFromExtension::guess(__DIR__ . '/images/' . 'gif-test.gif'));

//        $this->assertSame(false, GuessFromExtension::guess2());


        // common mime types
        doTest('gif-test.gif', 'image/gif');
        doTest('jpg-test.jpg', 'image/jpeg');
        doTest('ico-test.ico', 'image/vnd.microsoft.icon');
        doTest('png-test.png', 'image/png');
        doTest('tif-test.tif', 'image/tiff');
        doTest('webp-test.webp', 'image/webp');
        doTest('button.svg', 'image/svg+xml');


        // special cases
        doTest('jpg-with space.jpg', 'image/jpeg');
        doTest('png-with-jpeg-extension.jpg', 'image/jpeg');

        // not images
        doTest('nonexisting', false);
        doTest('not-images/txt-test.txt', false);
        doTest('not-images/odt-test.txt', false);

        // undetermined
        doTest('png-without-extension', null);
        doTest('not-images/unknown-extension.unknown', null);

    }
}
