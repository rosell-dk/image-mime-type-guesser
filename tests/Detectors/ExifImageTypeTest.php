<?php
namespace Tests\ImageMimeTypeGuesser\Detectors;

use \Tests\ImageMimeTypeGuesser\Detectors\AbstractDetectorTester;
use \PHPUnit\Framework\TestCase;

include_once 'AbstractDetectorTester.php';  // Not autoloaded, because it does not end with "Test"

class ExifImageTypeTest extends TestCase
{
    public function testDoDetect()
    {
        AbstractDetectorTester::testDetect($this, 'ExifImageType');
    }

    public function testWebP()
    {
        if (function_exists('image_type_to_mime_type')) {
            $this->assertEquals(18, IMAGETYPE_WEBP);
        }
        $this->assertEquals('image/webp', image_type_to_mime_type(IMAGETYPE_WEBP));
    }
}
