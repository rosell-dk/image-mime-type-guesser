<?php

namespace Tests\ImageMimeTypeGuesser;

use \ImageMimeTypeGuesser\GuessFromExtension;
use \PHPUnit\Framework\TestCase;

class GuessFromExtensionTest extends TestCase
{

    public function testTestingEnvironmentAssumptions()
    {
        $this->assertTrue(file_exists(__DIR__ . '/images/gif-test.gif'), 'Test image is not available! (gif-test.gif)');
        $this->assertTrue(file_exists(__DIR__ . '/images/webp-test.webp'), 'Test image is not available! (webp-test.webp)');
        $this->assertTrue(file_exists(__DIR__ . '/images/button.svg'));
    }

    /*
    public function testGuessAssumptions()
    {
        $this->assertTrue(function_exists('pathinfo'), 'pathinfo is not available! - We thought it was available on all platforms (PHP >= 5.6)');
        $this->assertTrue(defined('PATHINFO_EXTENSION'), 'PATHINFO_EXTENSION is not defined');
    }
    */

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


        // common mime types
        doTest('gif-test.gif', 'image/gif');
        doTest('jpg-test.jpg', 'image/jpeg');
        doTest('ico-test.ico', 'image/x-icon');
        doTest('png-test.png', 'image/png');
        doTest('tif-test.tif', 'image/tiff');
        doTest('webp-test.webp', 'image/webp');
        doTest('button.svg', 'image/svg+xml');

        // upper-case and mixed case
        doTest('UPPERCASE.JPEG', 'image/jpeg');
        doTest('MixedCase.JpEg', 'image/jpeg');

        // special cases
        doTest('jpg-with space.jpg', 'image/jpeg');
        doTest('png-with-jpeg-extension.jpg', 'image/jpeg');
        doTest('.jpg-beginning-with-dot.jpg', 'image/jpeg');
        //doTest('jpg-ending-with-dot.jpg.', null);   Disabled. The mere precence of that file causes checkout error on Windows

        // not images
        doTest('nonexisting', false);
        doTest('not-images/txt-test.txt', false);
        doTest('not-images/odt-test.txt', false);

        // undetermined
        doTest('png-without-extension', null);
        doTest('not-images/unknown-extension.unknown', null);

    }
}
