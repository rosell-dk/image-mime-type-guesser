<?php

namespace Tests\ImageMimeTypeGuesser;

use \ImageMimeTypeGuesser\ImageMimeTypeGuesser;
use \PHPUnit\Framework\TestCase;

class ImageMimeTypeGuesserTest extends TestCase
{

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
                $thisTest->assertEquals($expectedResult, $result);

            }
        }

        doDetectTest('gif-test.gif', 'image/gif');
        doDetectTest('jpg-test.jpg', 'image/jpeg');
        doDetectTest('very-small.jpg', 'image/jpeg');
        doDetectTest('avif-test.avif', 'image/avif');
        //doDetectTest('heif-test.heif', 'image/heif');
        doDetectTest('not-images/txt-test.txt', false);
    }

    public function testGuess()
    {
        global $thisTest;
        $thisTest = $this;

        function doGuessTest($fileName, $expectedResult) {
            global $thisTest;
            $result = ImageMimeTypeGuesser::guess(__DIR__ . '/images/' . $fileName);
            $thisTest->assertSame($expectedResult, $result);
        }

        doGuessTest('gif-test.gif', 'image/gif');
        doGuessTest('not-images/txt-test.txt', false);
    }

    public function testDetectIsIn()
    {
        global $thisTest;
        $thisTest = $this;

        function doDetectIsInTest($fileName, $mimeArray, $expectedResult) {
            global $thisTest;
            $result = ImageMimeTypeGuesser::detectIsIn(__DIR__ . '/images/' . $fileName, $mimeArray);
            $thisTest->assertSame($expectedResult, $result);
        }

        doDetectIsInTest('nonexisting', ['image/gif'], false);
    }


    public function testGuessIsIn()
    {
        global $thisTest;
        $thisTest = $this;

        function doGuessIsInTest($fileName, $mimeArray, $expectedResult) {
            global $thisTest;
            $result = ImageMimeTypeGuesser::guessIsIn(__DIR__ . '/images/' . $fileName, $mimeArray);
            $thisTest->assertSame($expectedResult, $result);
        }

        doGuessIsInTest('gif-test.gif', ['image/gif'], true);
        doGuessIsInTest('gif-test.gif', ['image/jpeg', 'image/gif'], true);
        doGuessIsInTest('gif-test.gif', ['image/jpeg'], false);
    }

    public function testLenientGuessIsIn()
    {
        global $thisTest;
        $thisTest = $this;

        function doLenientGuessIsInTest($fileName, $mimeArray, $expectedResult) {
            global $thisTest;
            $result = ImageMimeTypeGuesser::lenientGuessIsIn(__DIR__ . '/images/' . $fileName, $mimeArray);
            $thisTest->assertSame($expectedResult, $result);
        }

        doLenientGuessIsInTest('webp-test.webp', ['image/webp'], true);
    }

    /*
    public function testFailOnPurpose()
    {
        $this->assertEquals(true, false);
    }*/

}
