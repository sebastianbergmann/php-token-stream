<?php
/**
 * php-token-stream
 *
 * Copyright (c) 2009-2012, Sebastian Bergmann <sb@sebastian-bergmann.de>.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Sebastian Bergmann nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package    PHP_TokenStream
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @copyright  2009-2012 Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @since      File available since Release 1.0.2
 */

if (!defined('TEST_FILES_PATH')) {
    define(
      'TEST_FILES_PATH',
      dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR .
      '_files' . DIRECTORY_SEPARATOR
    );
}

require_once 'PHP/Token/Stream.php';

/**
 * Tests for the PHP_Token_CLASS class.
 *
 * @package    PHP_TokenStream
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @copyright  2009-2012 Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @version    Release: @package_version@
 * @link       http://github.com/sebastianbergmann/php-token-stream/
 * @since      Class available since Release 1.0.2
 */
class PHP_Token_ClassTest extends PHPUnit_Framework_TestCase
{
    protected $class;
    protected $function;

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
}
