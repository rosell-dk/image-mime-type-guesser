<?php
namespace Tests\ImageMimeTypeGuesser\Detectors;

use \Tests\ImageMimeTypeGuesser\Detectors\AbstractDetectorTester;
use \ImageMimeTypeGuesser\Detectors\SignatureSniffer;
use \PHPUnit\Framework\TestCase;

include_once 'AbstractDetectorTester.php';  // Not autoloaded, because it does not end with "Test"

class SignatureSnifferTest extends TestCase
{
    static $imagePath = __DIR__ . '/../images/';
    public function testDoDetect()
    {
        AbstractDetectorTester::tryDetect($this, 'SignatureSniffer', false);
    }

    public function testGif()
    {
        $this->assertEquals(
          'image/gif',
            SignatureSniffer::detect(self::$imagePath . 'gif-test.gif')
        );
    }

    public function testJpeg()
    {
        $this->assertEquals(
            'image/jpeg',
            SignatureSniffer::detect(self::$imagePath . 'jpg-test.jpg')
        );
    }

    public function testPng()
    {
        $this->assertEquals(
            'image/png',
            SignatureSniffer::detect(self::$imagePath . 'png-test.png')
        );
    }

    public function testWebp()
    {
        $this->assertEquals(
            'image/webp',
            SignatureSniffer::detect(self::$imagePath . 'webp-test.webp')
        );
    }

    public function testTiff()
    {
        $this->assertEquals(
            'image/tiff',
            SignatureSniffer::detect(self::$imagePath . 'tif-test.tif')
        );
    }

    public function testJp2()
    {
/*
        $handle = @fopen(self::$imagePath . 'jpeg-2000-jp2-test.jp2', 'r');
        $sampleBin = @fread($handle, 20);
        $firstByte = $sampleBin[0];
        $sampleHex = strtoupper(bin2hex($sampleBin));

        echo 'jp2:' . $sampleHex;
// https://www.file-recovery.com/jp2-signature-format.htm
*/

        $this->assertEquals(
            'image/jp2',
            SignatureSniffer::detect(self::$imagePath . 'jpeg-2000-jp2-test.jp2')
        );
    }

/*
TODO: Find a small jp2 image for test
    public function testJpx()
    {
        $this->assertEquals(
            'image/jpx',
            SignatureSniffer::detect(self::$imagePath . 'balloon.jpf')
        );
    }
    public function testJpx()
    {
        $this->assertEquals(
            'image/jpm',
            SignatureSniffer::detect(self::$imagePath . 'balloon.jpm')
        );
    }*/
    /*public function testMj2()
    {
        // PS: At least one document says it it "video/mjp2" (not "video/mj2"
        // - according to http://fileformats.archiveteam.org/wiki/MJ2
        $this->assertEquals(
            'video/mj2',
            SignatureSniffer::detect(self::$imagePath . 'Speedway.mj2')
        );
    }

    */

/*
    public function testUnsupported()
    {
      $this->assertEquals(
          null,
          SignatureSniffer::detect(self::$imagePath . 'tif-test.tif')
      );
    }*/

}
