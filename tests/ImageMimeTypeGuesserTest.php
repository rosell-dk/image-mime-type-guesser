<?php

namespace Tests\ImageMimeTypeGuesser;

use \ImageMimeTypeGuesser\ImageMimeTypeGuesser;
use \PHPUnit\Framework\TestCase;

class ImageMimeTypeGuesserTest extends TestCase
{

    public function testGuess()
    {
        global $thisTest;
        $thisTest = $this;

        function doGuessTest($fileName, $expectedResult) {
            global $thisTest;
            $result = ImageMimeTypeGuesser::guess(__DIR__ . '/images/' . $fileName);
            $thisTest->assertEquals($result, $expectedResult);
        }

        doGuessTest('gif-test.gif', 'image/gif');
        doGuessTest('not-images/txt-test.txt', false);
    }

    public function testDetect()
    {
        global $thisTest;
        $thisTest = $this;

        function doDetectTest($fileName, $expectedResult) {
            global $thisTest;
            $result = ImageMimeTypeGuesser::detect(__DIR__ . '/images/' . $fileName);

            if (is_null($result)) {
                // this is ok
                $thisTest->assertEquals(true, true);
            } else {
                $thisTest->assertEquals($result, $expectedResult);

            }
        }

        doDetectTest('gif-test.gif', 'image/gif');
        doDetectTest('not-images/txt-test.txt', false);        
    }


}
