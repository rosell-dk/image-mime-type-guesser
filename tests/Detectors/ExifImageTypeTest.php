<?php
namespace Tests\ImageMimeTypeGuesser\Detectors;

use \Tests\ImageMimeTypeGuesser\Detectors\AbstractDetectorTester;
use \PHPUnit\Framework\TestCase;

include_once 'AbstractDetectorTester.php';  // Not autoloaded, because it does not end with "Test"

class ExifImageTypeTest extends TestCase
{
    public function testDoDetect()
    {
        AbstractDetectorTester::tryDetect($this, 'ExifImageType');
    }

    public function testImplicitAssumptionsAboutExistingFunctions()
    {
        // The code implicitly assumes that if 'exif_imagetype()' exists, then 'image_type_to_mime_type()' does too.
        // Make that assumption explicit.
        if (function_exists('exif_imagetype')) {
            $this->assertTrue(function_exists('image_type_to_mime_type'), 'implicit assumption that image_type_to_mime_type() exists on all systems where exif_imagetype() exists does not hold!');
        }
    }

    public function testCanThisBeTested()
    {
        if (!function_exists('exif_imagetype')) {
            $this->markTestIncomplete(
                'exif_imagetype method not available, so it cannot be tested'
            );
        } else {
            $this->addToAssertionCount(1);
        }
    }

    /*
    This test can fail! (it does on Travis, in 5.6 and 7.0, but not on 7.1 and 7.2)
    - This means that just because 'image_type_to_mime_type' exists, it does not neccesarily mean that
      IMAGETYPE_WEBP constant is defined

    public function testWebP()
    {
        if (function_exists('image_type_to_mime_type')) {
            $this->assertEquals(18, IMAGETYPE_WEBP);
            $this->assertEquals('image/webp', image_type_to_mime_type(IMAGETYPE_WEBP));
        }
    }
    */
}
