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

final class PHP_Token_CommentTest extends TestCase
{
    /**
     * @see https://github.com/sebastianbergmann/php-token-stream/issues/95
     */
    public function testIssue95(): void
    {
        $tokens = new PHP_Token_Stream(TEST_FILES_PATH . 'issue_95.php');

        $this->assertCount(24, $tokens);
        $this->assertSame(6, $tokens->getLinesOfCode()['loc']);
        $this->assertSame(3, $tokens->getLinesOfCode()['cloc']);
        $this->assertSame(3, $tokens->getLinesOfCode()['ncloc']);

        $i = 1;

        foreach ($tokens as $token) {
            switch ($i) {
                case 18:
                    $this->assertInstanceOf(PHP_Token_COMMENT::class, $token);
                    $this->assertSame("// @codeCoverageIgnoreStart\n", (string) $token);

                    break;

                case 19:
                case 21:
                    $this->assertInstanceOf(PHP_Token_WHITESPACE::class, $token);
                    $this->assertSame('    ', (string) $token);

                    break;

                case 20:
                    $this->assertInstanceOf(PHP_Token_COMMENT::class, $token);
                    $this->assertSame("# ...\n", (string) $token);

                    break;

                case 22:
                    $this->assertInstanceOf(PHP_Token_COMMENT::class, $token);
                    $this->assertSame("// @codeCoverageIgnoreEnd\n", (string) $token);

                    break;
            }

            $i++;
        }
    }
}
