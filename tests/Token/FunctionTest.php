<?php declare(strict_types=1);
/*
 * This file is part of phpunit/php-token-stream.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use PHPUnit\Framework\TestCase;

class PHP_Token_FunctionTest extends TestCase
{
    /**
     * @var PHP_Token_FUNCTION[]
     */
    private $functions;

    protected function setUp(): void
    {
        foreach (new PHP_Token_Stream(TEST_FILES_PATH . 'source.php') as $token) {
            if ($token instanceof PHP_Token_FUNCTION) {
                $this->functions[] = $token;
            }
        }
    }

    public function testGetArguments(): void
    {
        $this->assertEquals([], $this->functions[0]->getArguments());

        $this->assertEquals(
            ['$baz' => 'Baz'],
            $this->functions[1]->getArguments()
        );

        $this->assertEquals(
            ['$foobar' => 'Foobar'],
            $this->functions[2]->getArguments()
        );

        $this->assertEquals(
            ['$barfoo' => 'Barfoo'],
            $this->functions[3]->getArguments()
        );

        $this->assertEquals([], $this->functions[4]->getArguments());

        $this->assertEquals(['$x' => null, '$y' => null], $this->functions[5]->getArguments());
    }

    public function testGetName(): void
    {
        $this->assertEquals('foo', $this->functions[0]->getName());
        $this->assertEquals('bar', $this->functions[1]->getName());
        $this->assertEquals('foobar', $this->functions[2]->getName());
        $this->assertEquals('barfoo', $this->functions[3]->getName());
        $this->assertEquals('baz', $this->functions[4]->getName());
    }

    public function testGetLine(): void
    {
        $this->assertEquals(5, $this->functions[0]->getLine());
        $this->assertEquals(10, $this->functions[1]->getLine());
        $this->assertEquals(17, $this->functions[2]->getLine());
        $this->assertEquals(21, $this->functions[3]->getLine());
        $this->assertEquals(29, $this->functions[4]->getLine());
        $this->assertEquals(37, $this->functions[6]->getLine());
    }

    public function testGetEndLine(): void
    {
        $this->assertEquals(5, $this->functions[0]->getEndLine());
        $this->assertEquals(12, $this->functions[1]->getEndLine());
        $this->assertEquals(19, $this->functions[2]->getEndLine());
        $this->assertEquals(23, $this->functions[3]->getEndLine());
        $this->assertEquals(31, $this->functions[4]->getEndLine());
        $this->assertEquals(41, $this->functions[6]->getEndLine());
    }

    public function testGetDocblock(): void
    {
        $this->assertNull($this->functions[0]->getDocblock());

        $this->assertEquals(
            "/**\n     * @param Baz \$baz\n     */",
            $this->functions[1]->getDocblock()
        );

        $this->assertEquals(
            "/**\n     * @param Foobar \$foobar\n     */",
            $this->functions[2]->getDocblock()
        );

        $this->assertNull($this->functions[3]->getDocblock());
        $this->assertNull($this->functions[4]->getDocblock());
    }

    public function testSignature(): void
    {
        $tokens     = new PHP_Token_Stream(TEST_FILES_PATH . 'source5.php');
        $functions  = $tokens->getFunctions();
        $classes    = $tokens->getClasses();
        $interfaces = $tokens->getInterfaces();

        $this->assertEquals(
            'foo($a, array $b, array $c = array())',
            $functions['foo']['signature']
        );

        $this->assertEquals(
            'm($a, array $b, array $c = array())',
            $classes['c']['methods']['m']['signature']
        );

        $this->assertEquals(
            'm($a, array $b, array $c = array())',
            $classes['a']['methods']['m']['signature']
        );

        $this->assertEquals(
            'm($a, array $b, array $c = array())',
            $interfaces['i']['methods']['m']['signature']
        );
    }

    public function testVisibility(): void
    {
        $this->assertEquals('public', $this->functions[0]->getVisibility());
        $this->assertEquals('public', $this->functions[1]->getVisibility());
        $this->assertEquals('public', $this->functions[2]->getVisibility());
        $this->assertEquals('public', $this->functions[3]->getVisibility());
        $this->assertEquals('public', $this->functions[4]->getVisibility());
        $this->assertEquals('public', $this->functions[5]->getVisibility());
        $this->assertEquals('public', $this->functions[6]->getVisibility());
        $this->assertEquals('protected', $this->functions[7]->getVisibility());
        $this->assertEquals('private', $this->functions[8]->getVisibility());
    }
}
