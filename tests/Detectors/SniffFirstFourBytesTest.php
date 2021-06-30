<?php
namespace Tests\ImageMimeTypeGuesser\Detectors;

use \Tests\ImageMimeTypeGuesser\Detectors\AbstractDetectorTester;
use \ImageMimeTypeGuesser\Detectors\SniffFirstFourBytes;
use \PHPUnit\Framework\TestCase;

include_once 'AbstractDetectorTester.php';  // Not autoloaded, because it does not end with "Test"

class SniffFirstFourBytesTest extends TestCase
{
    static $imagePath = __DIR__ . '/../images/';
    public function testDoDetect()
    {
        AbstractDetectorTester::tryDetect($this, 'SniffFirstFourBytes', false);
    }

    public function testSupported()
    {
        $this->assertEquals(
            SniffFirstFourBytes::detect(self::$imagePath . 'gif-test.gif'),
            'image/gif'
        );

        $this->assertEquals(
            SniffFirstFourBytes::detect(self::$imagePath . 'jpg-test.jpg'),
            'image/jpeg'
        );

        $this->assertEquals(
            SniffFirstFourBytes::detect(self::$imagePath . 'png-test.png'),
            'image/png'
        );

        $this->assertEquals(
            SniffFirstFourBytes::detect(self::$imagePath . 'webp-test.webp'),
            'image/webp'
        );
    }

    public function testUnsupported()
    {
      $this->assertEquals(
          SniffFirstFourBytes::detect(self::$imagePath . 'tif-test.tif'),
          null
      );
    }

}
