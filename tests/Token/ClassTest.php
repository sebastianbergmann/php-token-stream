<?php
/*
 * This file is part of php-token-stream.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use PHPUnit\Framework\TestCase;

class PHP_Token_ClassTest extends TestCase
{
    /**
     * @var PHP_Token_CLASS
     */
    private $class;

    /**
     * @var PHP_Token_FUNCTION
     */
    private $function;

    protected function setUp()
    {
        $ts = new PHP_Token_Stream(TEST_FILES_PATH . 'source2.php');

        foreach ($ts as $token) {
            if ($token instanceof PHP_Token_CLASS) {
                $this->class = $token;
            }

            if ($token instanceof PHP_Token_FUNCTION) {
                $this->function = $token;
                break;
            }
        }
    }

    /**
     * @covers PHP_Token_CLASS::getKeywords
     */
    public function testGetClassKeywords()
    {
        $this->assertEquals('abstract', $this->class->getKeywords());
    }

    /**
     * @covers PHP_Token_FUNCTION::getKeywords
     */
    public function testGetFunctionKeywords()
    {
        $this->assertEquals('abstract,static', $this->function->getKeywords());
    }

    /**
     * @covers PHP_Token_FUNCTION::getVisibility
     */
    public function testGetFunctionVisibility()
    {
        $this->assertEquals('public', $this->function->getVisibility());
    }

    public function testIssue19()
    {
        $ts = new PHP_Token_Stream(TEST_FILES_PATH . 'issue19.php');

        foreach ($ts as $token) {
            if ($token instanceof PHP_Token_CLASS) {
                $this->assertFalse($token->hasInterfaces());
            }
        }
    }

    public function testIssue30()
    {
        $ts = new PHP_Token_Stream(TEST_FILES_PATH . 'issue30.php');
        $this->assertCount(1, $ts->getClasses());
    }

    /**
     * @requires PHP 7
     */
    public function testAnonymousClassesAreHandledCorrectly()
    {
        $ts = new PHP_Token_Stream(TEST_FILES_PATH . 'class_with_method_that_declares_anonymous_class.php');

        $classes = $ts->getClasses();

        $this->assertEquals(['class_with_method_that_declares_anonymous_class'], array_keys($classes));
    }

    /**
     * @requires PHP 7
     * @ticket   https://github.com/sebastianbergmann/php-token-stream/issues/52
     */
    public function testAnonymousClassesAreHandledCorrectly2()
    {
        $ts = new PHP_Token_Stream(TEST_FILES_PATH . 'class_with_method_that_declares_anonymous_class2.php');

        $classes = $ts->getClasses();

        $this->assertEquals(['Test'], array_keys($classes));
        $this->assertEquals(['methodOne', 'methodTwo'], array_keys($classes['Test']['methods']));

        $this->assertEmpty($ts->getFunctions());
    }

    /**
     * @requires PHP 5.6
     */
    public function testImportedFunctionsAreHandledCorrectly()
    {
        $ts = new PHP_Token_Stream(TEST_FILES_PATH . 'classUsesNamespacedFunction.php');

        $this->assertEmpty($ts->getFunctions());
        $this->assertCount(1, $ts->getClasses());
    }
}
