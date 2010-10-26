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
 * @package   PHP_TokenStream
 * @author    Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @copyright 2009-2010 Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @since     File available since Release 1.0.0
 */

require_once 'PHP/Token.php';

/**
 * A stream of PHP tokens.
 *
 * @author    Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @copyright 2009-2010 Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version   Release: @package_version@
 * @link      http://github.com/sebastianbergmann/php-token-stream/tree
 * @since     Class available since Release 1.0.0
 */
class PHP_Token_Stream implements ArrayAccess, Countable, SeekableIterator
{
    /**
     * @var array
     */
    protected static $customTokens = array(
      '(' => 'PHP_Token_OPEN_BRACKET',
      ')' => 'PHP_Token_CLOSE_BRACKET',
      '[' => 'PHP_Token_OPEN_SQUARE',
      ']' => 'PHP_Token_CLOSE_SQUARE',
      '{' => 'PHP_Token_OPEN_CURLY',
      '}' => 'PHP_Token_CLOSE_CURLY',
      ';' => 'PHP_Token_SEMICOLON',
      '.' => 'PHP_Token_DOT',
      ',' => 'PHP_Token_COMMA',
      '=' => 'PHP_Token_EQUAL',
      '<' => 'PHP_Token_LT',
      '>' => 'PHP_Token_GT',
      '+' => 'PHP_Token_PLUS',
      '-' => 'PHP_Token_MINUS',
      '*' => 'PHP_Token_MULT',
      '/' => 'PHP_Token_DIV',
      '?' => 'PHP_Token_QUESTION_MARK',
      '!' => 'PHP_Token_EXCLAMATION_MARK',
      ':' => 'PHP_Token_COLON',
      '"' => 'PHP_Token_DOUBLE_QUOTES',
      '@' => 'PHP_Token_AT',
      '&' => 'PHP_Token_AMPERSAND',
      '%' => 'PHP_Token_PERCENT',
      '|' => 'PHP_Token_PIPE',
      '$' => 'PHP_Token_DOLLAR',
      '^' => 'PHP_Token_CARET',
      '~' => 'PHP_Token_TILDE',
      '`' => 'PHP_Token_BACKTICK'
    );

    /**
     * @var array
     */
    protected $tokens = array();

    /**
     * @var integer
     */
    protected $position = 0;

    /**
     * @var array
     */
    protected $linesOfCode = array('loc' => 0, 'cloc' => 0, 'ncloc' => 0);

    /**
     * @var array
     */
    protected $classes;

    /**
     * @var array
     */
    protected $functions;

    /**
     * Constructor.
     *
     * @param string $sourceCode
     */
    public function __construct($sourceCode)
    {
        if (is_file($sourceCode)) {
            $sourceCode = file_get_contents($sourceCode);
        }

        $this->scan($sourceCode);
    }

    /**
     * Scans the source for sequences of characters and converts them into a
     * stream of tokens.
     *
     * @param string $sourceCode
     */
    protected function scan($sourceCode)
    {
        $line      = 1;
        $tokens    = token_get_all($sourceCode);
        $numTokens = count($tokens);

        for ($i = 0; $i < $numTokens; ++$i) {
            $token = $tokens[$i];
            unset($tokens[$i]);

            if (is_array($token)) {
                $text       = $token[1];
                $tokenClass = 'PHP_Token_' . substr(token_name($token[0]), 2);
            } else {
                $text       = $token;
                $tokenClass = self::$customTokens[$token];
            }

            $this->tokens[] = new $tokenClass($text, $line, $this, $i);
            $lines          = substr_count($text, "\n");
            $line          += $lines;

            if ($tokenClass == 'PHP_Token_HALT_COMPILER') {
                break;
            }

            else if ($tokenClass == 'PHP_Token_COMMENT' ||
                $tokenClass == 'PHP_Token_DOC_COMMENT') {
                $this->linesOfCode['cloc'] += $lines + 1;
            }
        }

        $this->linesOfCode['loc']   = substr_count($sourceCode, "\n");
        $this->linesOfCode['ncloc'] = $this->linesOfCode['loc'] -
                                      $this->linesOfCode['cloc'];
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $buffer = '';

        foreach ($this as $token) {
            $buffer .= $token;
        }

        return $buffer;
    }

    /**
     * @return integer
     */
    public function count()
    {
        return count($this->tokens);
    }

    /**
     * @return PHP_Token[]
     */
    public function tokens()
    {
        return $this->tokens;
    }

    /**
     * @return array
     */
    public function getClasses()
    {
        if ($this->classes !== NULL) {
            return $this->classes;
        }

        $this->parseClassesFunctions();

        return $this->classes;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        if ($this->functions !== NULL) {
            return $this->functions;
        }

        $this->parseClassesFunctions();

        return $this->functions;
    }

    protected function parseClassesFunctions()
    {
        $this->classes   = array();
        $this->functions = array();
        $class           = FALSE;
        $classEndLine    = FALSE;

        foreach ($this->tokens as $token) {
            switch (get_class($token)) {
                case 'PHP_Token_CLASS': {
                    $class        = $token->getName();
                    $classEndLine = $token->getEndLine();

                    $this->classes[$class] = array(
                      'methods'   => array(),
                      'docblock'  => $token->getDocblock(),
                      'startLine' => $token->getLine(),
                      'endLine'   => $classEndLine
                    );
                }
                break;

                case 'PHP_Token_FUNCTION': {
                    $name = $token->getName();
                    $tmp  = array(
                      'docblock'  => $token->getDocblock(),
                      'signature' => $token->getSignature(),
                      'startLine' => $token->getLine(),
                      'endLine'   => $token->getEndLine(),
                      'ccn'       => $token->getCCN()
                    );

                    if ($class === FALSE) {
                        $this->functions[$name] = $tmp;
                    } else {
                        $this->classes[$class]['methods'][$name] = $tmp;
                    }
                }
                break;

                case 'PHP_Token_CLOSE_CURLY': {
                    if ($classEndLine !== FALSE &&
                        $classEndLine == $token->getLine()) {
                        $class        = FALSE;
                        $classEndLine = FALSE;
                    }
                }
                break;
            }
        }
    }

    /**
     * @return array
     */
    public function getLinesOfCode()
    {
        return $this->linesOfCode;
    }

    /**
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * @return boolean
     */
    public function valid()
    {
        return isset($this->tokens[$this->position]);
    }

    /**
     * @return integer
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * @return PHP_Token
     */
    public function current()
    {
        return $this->tokens[$this->position];
    }

    /**
     */
    public function next()
    {
        $this->position++;
    }

    /**
     * @param mixed $offset
     */
    public function offsetExists($offset)
    {
        return isset($this->tokens[$offset]);
    }

    /**
     * @param  mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->tokens[$offset];
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->tokens[$offset] = $value;
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->tokens[$offset]);
    }

    /**
     * Seek to an absolute position.
     *
     * @param  integer $position
     * @throws OutOfBoundsException
     */
    public function seek($position)
    {
        $this->position = $position;

        if (!$this->valid()) {
            throw new OutOfBoundsException('Invalid seek position');
        }
    }
}
