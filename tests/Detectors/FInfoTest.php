<?php
namespace Tests\ImageMimeTypeGuesser\Detectors;

use \Tests\ImageMimeTypeGuesser\Detectors\BaseDetectorTester;
use \PHPUnit\Framework\TestCase;

class FInfoTest extends TestCase
{
    public function testDoDetect()
    {
        BaseDetectorTester::testDetect($this, 'FInfo');
    }
}
