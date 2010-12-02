<?php
/**
 * php-token-stream
 *
 * Copyright (c) 2009-2010, Sebastian Bergmann <sb@sebastian-bergmann.de>.
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
 * @author     Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @copyright  2009-2010 Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @since      File available since Release 1.0.0
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
 * Tests for the PHP_Token_FUNCTION class.
 *
 * @package    PHP_TokenStream
 * @subpackage Tests
 * @author     Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @copyright  2009-2010 Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://github.com/sebastianbergmann/php-token-stream/
 * @since      Class available since Release 1.0.0
 */
class PHP_Token_FunctionTest extends PHPUnit_Framework_TestCase
{
    protected $functions;

    protected function setUp()
    {
        $ts = new PHP_Token_Stream(TEST_FILES_PATH . 'source.php');

        foreach ($ts as $token) {
            if ($token instanceof PHP_Token_FUNCTION) {
                $this->functions[] = $token;
            }
        }
    }

    /**
     * @covers PHP_Token_FUNCTION::getArguments
     */
    public function testGetArguments()
    {
        $this->assertEquals(
          array('$baz' => 'Baz'), $this->functions[0]->getArguments()
        );

        $this->assertEquals(
          array('$foobar' => 'Foobar'), $this->functions[1]->getArguments()
        );
    }

    /**
     * @covers PHP_Token_FUNCTION::getName
     */
    public function testGetName()
    {
        $this->assertEquals('bar', $this->functions[0]->getName());
        $this->assertEquals('foobar', $this->functions[1]->getName());
    }

    /**
     * @covers PHP_Token::getLine
     */
    public function testGetLine()
    {
        $this->assertEquals(7, $this->functions[0]->getLine());
        $this->assertEquals(14, $this->functions[1]->getLine());
    }

    /**
     * @covers PHP_TokenWithScope::getEndLine
     */
    public function testGetEndLine()
    {
        $this->assertEquals(9, $this->functions[0]->getEndLine());
        $this->assertEquals(16, $this->functions[1]->getEndLine());
    }

    /**
     * @covers PHP_Token_FUNCTION::getDocblock
     */
    public function testGetDocblock()
    {
        $this->assertEquals(
          "/**\n     * @param Baz \$baz\n     */",
          $this->functions[0]->getDocblock()
        );

        $this->assertEquals(
          "/**\n     * @param Foobar \$foobar\n     */",
          $this->functions[1]->getDocblock()
        );
    }
}
