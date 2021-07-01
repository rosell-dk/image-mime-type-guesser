<?php
namespace Tests\ImageMimeTypeGuesser\Detectors;

class AbstractDetectorTester
{
    private static $currentTestInstance;
    private static $currentDetectorClassName;
    private static $markIncompleteWhenNull;

    private static function trySingle($fileName, $expectedResult)
    {
        $filePath = __DIR__ . '/../images/' . $fileName;

        $result = call_user_func(array("\\ImageMimeTypeGuesser\\Detectors\\" . self::$currentDetectorClassName, 'detect'), $filePath);

        if (is_null($result)) {
            // the detector could not detect. That is ok.
            //echo 'Notice: ' . self::$currentDetectorClassName . ' could not detect that: ' .
            //$fileName . ' ' . ($expectedResult === false ? 'is not an image' : 'should result in' . $expectedResult) . "\n";

            //self::$currentTestInstance->addToAssertionCount(1);

            if (self::$markIncompleteWhenNull) {
              self::$currentTestInstance->markTestIncomplete(
                self::$currentDetectorClassName . ' could not be tested (file:' .
                $fileName . ')'
              );

            }
        } else {
            // we got either false or a mime type...
            self::$currentTestInstance->assertEquals($expectedResult, $result);
        }

    }

    public static function tryDetect($testInstance, $detectorClassName, $markIncompleteWhenNull = true)
    {
        self::$currentTestInstance = $testInstance;
        self::$currentDetectorClassName = $detectorClassName;
        self::$markIncompleteWhenNull = $markIncompleteWhenNull;

        // PS: GET sample files here:  https://filesamples.com/formats/jp2

        // standard image formats
        self::trySingle('gif-test.gif', 'image/gif');
        //self::trySingle('ico-test.ico', 'image/x-icon'); // disabled because exif says "vnd.microsoft.icon"
        self::trySingle('jpg-test.jpg', 'image/jpeg');
        self::trySingle('png-test.png', 'image/png');
        self::trySingle('tif-test.tif', 'image/tiff');

        // more rare
        self::trySingle('jpeg-2000-jp2-test.jp2', 'image/jp2');

        // Total disagreement over this one:
        // - FInfo, MimeContentTypeTest and Sniffer: image/jpx
        // - ExifImageType: image/jp2
        // - GetImageSizeTest: false
        //self::trySingle('balloon.jpf', 'image/jpx');
        //self::trySingle('balloon.jpm', 'image/jpm');
        //self::trySingle('Speedway.mj2', 'video/mj2');

        // image/webp test is disabled, as it is not added on all servers.
        // Specifically, one of our github actions jobs fails
        // (Ubuntu 16.04, PHP 5.6)
        //self::trySingle('webp-test.webp', 'image/webp');

        // special cases
        self::trySingle('jpg-with space.jpg', 'image/jpeg');
        self::trySingle('png-with-jpeg-extension.jpg', 'image/png');
        self::trySingle('png-without-extension', 'image/png');
        self::trySingle('png-not-true-color.png', 'image/png');
        self::trySingle('png-very-small.png', 'image/png');

        // not images
        self::trySingle('not-images/non-existing', false);
        //self::trySingle('not-images/txt-test.txt', false);

        // For some reason many file functions throws a read error exception on so small files.
        // - GetImageSize fails
        // - ExifImageType fails
        // - FInfo fails
        self::$markIncompleteWhenNull = false;
        self::trySingle('not-images/txt-test-very-small.txt', false);

    }
}
