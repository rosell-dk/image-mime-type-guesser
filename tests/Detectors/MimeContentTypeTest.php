<?php
namespace Tests\ImageMimeTypeGuesser\Detectors;

use \Tests\ImageMimeTypeGuesser\Detectors\BaseDetectorTester;
use \PHPUnit\Framework\TestCase;

include_once 'BaseDetectorTester.php';  // Not autoloaded, because it does not end with "Test"

class MimeContentTypeTest extends TestCase
{
    public function testDoDetect()
    {
        BaseDetectorTester::testDetect($this, 'MimeContentType');
    }
}
