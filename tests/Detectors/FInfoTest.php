<?php
/*
We mock the class_exists function, inspired by this:
https://stackoverflow.com/questions/32007032/is-it-possible-to-mock-the-non-existence-of-a-function-in-phpunit
*/
namespace ImageMimeTypeGuesser\Detectors {
    use Tests\ImageMimeTypeGuesser\Detectors\FInfoTest;

    function class_exists($function)
    {
        if (in_array($function, FInfoTest::$pretendTheseClassesDoesNotExist)) {
            return false;
        }
        return \class_exists($function);
    }
}

namespace Tests\ImageMimeTypeGuesser\Detectors {
    use \Tests\ImageMimeTypeGuesser\Detectors\AbstractDetectorTester;
    use \PHPUnit\Framework\TestCase;

    include_once 'AbstractDetectorTester.php';  // Not autoloaded, because it does not end with "Test"

    class FInfoTest extends TestCase
    {

        public static $pretendTheseClassesDoesNotExist;

        public function testDoDetect()
        {
            self::$pretendTheseClassesDoesNotExist = [];
            AbstractDetectorTester::tryDetect($this, 'FInfo');
        }

        public function testDoDetectFunctionNotExisting()
        {
            self::$pretendTheseClassesDoesNotExist = ['finfo'];
            AbstractDetectorTester::tryDetect($this, 'FInfo', false);
        }

        public function testCanThisBeTested()
        {
            self::$pretendTheseClassesDoesNotExist = [];
            if (!class_exists('finfo')) {
                $this->markTestIncomplete(
                    'finfo class not available, so it cannot be tested'
                );
            } else {
                $this->addToAssertionCount(1);
            }
        }


    }

}
