<?php
/*
We mock the function_exists function, as described here:
https://stackoverflow.com/questions/32007032/is-it-possible-to-mock-the-non-existence-of-a-function-in-phpunit

This allows us to test the code when function does not exist.

Btw: a similar technique is described here:
https://marcelog.github.io/articles/php_mock_global_functions_for_unit_tests_with_phpunit.html
*/
namespace {
    $pretendTheseFunctionDoesNotExist = [];
    $hasDeclaredMockFunction = false;
}

namespace ImageMimeTypeGuesser\Detectors {
    use Tests\ImageMimeTypeGuesser\Detectors\GetImageSizeTest;

    global $hasDeclaredMockFunction;
    if(!$hasDeclaredMockFunction)  {
        $hasDeclaredMockFunction = true;
        function function_exists($function) {
            global $pretendTheseFunctionDoesNotExist;
            if (in_array($function, $pretendTheseFunctionDoesNotExist)) {
                return false;
            }
            return \function_exists($function);
        }
    }

}


namespace Tests\ImageMimeTypeGuesser\Detectors {

    use \Tests\ImageMimeTypeGuesser\Detectors\AbstractDetectorTester;
    use \PHPUnit\Framework\TestCase;

    include_once 'AbstractDetectorTester.php';  // Not autoloaded, because it does not end with "Test"

    class GetImageSizeTest extends TestCase
    {

        public function testDoDetect()
        {
            global $pretendTheseFunctionDoesNotExist;
            $pretendTheseFunctionDoesNotExist = [];
            AbstractDetectorTester::tryDetect($this, 'GetImageSize');
        }

        public function testDoDetectFunctionNotExisting()
        {
            global $pretendTheseFunctionDoesNotExist;
            $pretendTheseFunctionDoesNotExist = ['getimagesize'];
            AbstractDetectorTester::tryDetect($this, 'GetImageSize', false);
        }

        public function testCanThisBeTested()
        {
            global $pretendTheseFunctionDoesNotExist;
            $pretendTheseFunctionDoesNotExist = [];
            if (!function_exists('getimagesize')) {
                $this->markTestIncomplete(
                    'getimagesize class not available, so it cannot be tested'
                );
            } else {
                $this->addToAssertionCount(1);
            }
        }

    }

}
