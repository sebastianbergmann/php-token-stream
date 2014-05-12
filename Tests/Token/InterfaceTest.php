<?php
/**
 * php-token-stream
 *
 * Copyright (c) 2009-2014, Sebastian Bergmann <sebastian@phpunit.de>.
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
 * @author     Sebastian Bergmann <sebastian@phpunit.de>
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @copyright  2009-2014 Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
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
 * Tests for the PHP_Token_INTERFACE class.
 *
 * @package    PHP_TokenStream
 * @subpackage Tests
 * @author     Sebastian Bergmann <sebastian@phpunit.de>
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @copyright  2009-2014 Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @version    Release: @package_version@
 * @link       http://github.com/sebastianbergmann/php-token-stream/
 * @since      Class available since Release 1.0.0
 */
class PHP_Token_InterfaceTest extends PHPUnit_Framework_TestCase
{
    protected $class;
    protected $interfaces;

    protected function setUp()
    {
        $ts = new PHP_Token_Stream(TEST_FILES_PATH . 'source4.php');
        $i  = 0;
        foreach ($ts as $token) {
            if ($token instanceof PHP_Token_CLASS) {
                $this->class = $token;
            }
            elseif ($token instanceof PHP_Token_INTERFACE) {
                $this->interfaces[$i] = $token;
                $i++;
            }
        }
    }

    /**
     * @covers PHP_Token_INTERFACE::getName
     */
    public function testGetName()
    {
        $this->assertEquals(
            'iTemplate', $this->interfaces[0]->getName()
        );
    }

    /**
     * @covers PHP_Token_INTERFACE::getParent
     */
    public function testGetParentNotExists()
    {
        $this->assertFalse(
            $this->interfaces[0]->getParent()
        );
    }

    /**
     * @covers PHP_Token_INTERFACE::hasParent
     */
    public function testHasParentNotExists()
    {
        $this->assertFalse(
            $this->interfaces[0]->hasParent()
        );
    }

    /**
     * @covers PHP_Token_INTERFACE::getParent
     */
    public function testGetParentExists()
    {
        $this->assertEquals(
            'a', $this->interfaces[2]->getParent()
        );
    }

    /**
     * @covers PHP_Token_INTERFACE::hasParent
     */
    public function testHasParentExists()
    {
        $this->assertTrue(
            $this->interfaces[2]->hasParent()
        );
    }

    /**
     * @covers PHP_Token_INTERFACE::getInterfaces
     */
    public function testGetInterfacesExists()
    {
        $this->assertEquals(
            array('b'),
            $this->class->getInterfaces()
        );
    }

    /**
     * @covers PHP_Token_INTERFACE::hasInterfaces
     */
    public function testHasInterfacesExists()
    {
        $this->assertTrue(
            $this->class->hasInterfaces()
        );
    }
    /**
     * @covers PHP_Token_INTERFACE::getPackage
     */
    public function testGetPackageNamespace() {
        $tokenStream = new PHP_Token_Stream(TEST_FILES_PATH . 'classInNamespace.php');
        foreach($tokenStream as $token) {
            if($token instanceOf PHP_Token_INTERFACE) {
                $package = $token->getPackage();
                $this->assertSame('Foo\\Bar', $package['namespace']);
            }
        }
    }


    public function provideFilesWithClassesWithinMultipleNamespaces() {
        return array(
            array(TEST_FILES_PATH . 'multipleNamespacesWithOneClassUsingBraces.php'),
            array(TEST_FILES_PATH . 'multipleNamespacesWithOneClassUsingNonBraceSyntax.php'),
        );
    }

    /**
     * @dataProvider provideFilesWithClassesWithinMultipleNamespaces
     * @covers PHP_Token_INTERFACE::getPackage
     */
    public function testGetPackageNamespaceForFileWithMultipleNamespaces($filepath) {
        $tokenStream = new PHP_Token_Stream($filepath);
        $firstClassFound = false;
        foreach($tokenStream as $token) {
            if($firstClassFound === false && $token instanceOf PHP_Token_INTERFACE) {
                $package = $token->getPackage();
                $this->assertSame('TestClassInBar', $token->getName());
                $this->assertSame('Foo\\Bar', $package['namespace']);
                $firstClassFound = true;
                continue;
            }
            // Secound class
            if($token instanceOf PHP_Token_INTERFACE) {
                $package = $token->getPackage();
                $this->assertSame('TestClassInBaz', $token->getName());
                $this->assertSame('Foo\\Baz', $package['namespace']);
                return;
            }
        }
        $this->fail("Seachring for 2 classes failed");
    }

    public function testGetPackageNamespaceIsEmptyForInterfacesThatAreNotWithinNamespaces() {
        foreach($this->interfaces as $token) {
            $package = $token->getPackage();
            $this->assertSame("", $package['namespace']);
        }
    }

    /**
     * @covers PHP_Token_INTERFACE::getPackage
     */
    public function testGetPackageNamespaceWhenExtentingFromNamespaceClass() {
        $tokenStream = new PHP_Token_Stream(TEST_FILES_PATH . 'classExtendsNamespacedClass.php');
        $firstClassFound = false;
        foreach($tokenStream as $token) {
            if($firstClassFound === false && $token instanceOf PHP_Token_INTERFACE) {
                $package = $token->getPackage();
                $this->assertSame('Baz', $token->getName());
                $this->assertSame('Foo\\Bar', $package['namespace']);
                $firstClassFound = true;
                continue;
            }
            if($token instanceOf PHP_Token_INTERFACE) {
                $package = $token->getPackage();
                $this->assertSame('Extender', $token->getName());
                $this->assertSame('Other\\Space', $package['namespace']);
                return;
            }
        }
        $this->fail("Searching for 2 classes failed");
    }
}
