<?php
namespace Tests\ImageMimeTypeGuesser\Detectors;

class AbstractDetectorTester
{
    private static $currentTestInstance;
    private static $currentDetectorClassName;

    private static function testDetectSingle($fileName, $expectedResult)
    {
        $filePath = __DIR__ . '/../images/' . $fileName;

        $result = call_user_func(array("\\ImageMimeTypeGuesser\\Detectors\\" . self::$currentDetectorClassName, 'detect'), $filePath);

        if (is_null($result)) {
            // the detector could not detect. That is ok.
            echo 'Warning: ' . self::$currentDetectorClassName . ' could not detect that: ' .
            $fileName . ' should result in ' . ($expectedResult === false ? 'false' : $expectedResult) . "\n";
            self::$currentTestInstance->assertEquals(true, true);
        } else {
            // we got either false or a mime type...
            self::$currentTestInstance->assertEquals($expectedResult, $result);
        }

    }

    public static function testDetect($testInstance, $detectorClassName)
    {
        self::$currentTestInstance = $testInstance;
        self::$currentDetectorClassName = $detectorClassName;

        // standard image formats
        self::testDetectSingle('gif-test.gif', 'image/gif');
        //self::testDetectSingle('ico-test.ico', 'image/vnd.microsoft.icon');
        self::testDetectSingle('jpg-test.jpg', 'image/jpeg');
        self::testDetectSingle('png-test.png', 'image/png');
        self::testDetectSingle('tif-test.tif', 'image/tiff');
        // self::testDetectSingle('webp-test.webp', 'image/webp');      // Disabled webp test, as the image/webp mime type is not on travis...

        // special cases
        self::testDetectSingle('jpg-with space.jpg', 'image/jpeg');
        self::testDetectSingle('png-with-jpeg-extension.jpg', 'image/png');
        self::testDetectSingle('png-without-extension', 'image/png');
        self::testDetectSingle('png-not-true-color.png', 'image/png');
        self::testDetectSingle('png-very-small.png', 'image/png');

        // not images
        self::testDetectSingle('not-images/non-existing', false);
        self::testDetectSingle('not-images/txt-test.txt', false);

    }
}
