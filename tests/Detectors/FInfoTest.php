<?php
namespace Tests\ImageMimeTypeGuesser\Detectors;

use \Tests\ImageMimeTypeGuesser\Detectors\AbstractDetectorTester;
use \PHPUnit\Framework\TestCase;

include_once 'AbstractDetectorTester.php';  // Not autoloaded, because it does not end with "Test"

class FInfoTest extends TestCase
{
    public function testDoDetect()
    {
        AbstractDetectorTester::testDetect($this, 'FInfo');
    }
}
