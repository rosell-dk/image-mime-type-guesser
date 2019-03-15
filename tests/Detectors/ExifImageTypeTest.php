<?php
namespace Tests\ImageMimeTypeGuesser\Detectors;

use \Tests\ImageMimeTypeGuesser\Detectors\BaseDetectorTester;
use \PHPUnit\Framework\TestCase;

class ExifImageTypeTest extends TestCase
{
    public function testDoDetect()
    {
        BaseDetectorTester::testDetect($this, 'ExifImageType');
    }
}
