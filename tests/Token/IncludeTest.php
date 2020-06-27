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

class PHP_Token_IncludeTest extends TestCase
{
    /**
     * @var PHP_Token_Stream
     */
    private $ts;

    protected function setUp(): void
    {
        $this->ts = new PHP_Token_Stream(TEST_FILES_PATH . 'source3.php');
    }

    public function testGetIncludes(): void
    {
        $this->assertSame(
            ['test4.php', 'test3.php', 'test2.php', 'test1.php'],
            $this->ts->getIncludes()
        );
    }

    public function testGetIncludesCategorized(): void
    {
        $this->assertSame(
            [
                'require_once' => ['test4.php'],
                'require'      => ['test3.php'],
                'include_once' => ['test2.php'],
                'include'      => ['test1.php'],
            ],
            $this->ts->getIncludes(true)
        );
    }

    public function testGetIncludesCategory(): void
    {
        $this->assertSame(
            ['test4.php'],
            $this->ts->getIncludes(true, 'require_once')
        );
    }
}
