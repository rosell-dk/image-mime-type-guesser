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

    public function testGif()
    {
        $this->assertEquals(
          'image/gif',
            SniffFirstFourBytes::detect(self::$imagePath . 'gif-test.gif')
        );
    }

    public function testJpeg()
    {
        $this->assertEquals(
            'image/jpeg',
            SniffFirstFourBytes::detect(self::$imagePath . 'jpg-test.jpg')
        );
    }

    public function testPng()
    {
        $this->assertEquals(
            'image/png',
            SniffFirstFourBytes::detect(self::$imagePath . 'png-test.png')
        );
    }

    public function testWebp()
    {
        $this->assertEquals(
            'image/webp',
            SniffFirstFourBytes::detect(self::$imagePath . 'webp-test.webp')
        );
    }

    public function testTiff()
    {
        $this->assertEquals(
            'image/tiff',
            SniffFirstFourBytes::detect(self::$imagePath . 'tif-test.tif')
        );
    }

/*
    public function testUnsupported()
    {
      $this->assertEquals(
          null,
          SniffFirstFourBytes::detect(self::$imagePath . 'tif-test.tif')
      );
    }*/

}
