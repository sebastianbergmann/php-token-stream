<?php
/**
 * php-token-stream
 *
 * Copyright (c) 2009, Sebastian Bergmann <sb@sebastian-bergmann.de>.
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
 * @author    Stefan Priebsch <stefan@priebsch.de>
 * @copyright 2009 Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @since     File available since Release 1.0.0
 */

require_once 'PHP/Token/Exception.php';

/**
 * A PHP token.
 *
 * @author    Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @author    Stefan Priebsch <stefan@priebsch.de>
 * @copyright 2009 Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version   Release: @package_version@
 * @link      http://github.com/sebastianbergmann/php-token-stream/tree
 * @since     Class available since Release 1.0.0
 */
class PHP_Token
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var integer
     */
    protected $line;

    /**
     * @var array
     */
    protected static $tokens = array(
      '('  => array(501, 'T_OPEN_BRACKET'),
      ')'  => array(502, 'T_CLOSE_BRACKET'),
      '['  => array(503, 'T_OPEN_SQUARE'),
      ']'  => array(504, 'T_CLOSE_SQUARE'),
      '{'  => array(505, 'T_OPEN_CURLY'),
      '}'  => array(506, 'T_CLOSE_CURLY'),
      ';'  => array(507, 'T_SEMICOLON'),
      '.'  => array(508, 'T_DOT'),
      ','  => array(509, 'T_COMMA'),
      '='  => array(510, 'T_EQUAL'),
      '<'  => array(511, 'T_LT'),
      '>'  => array(512, 'T_GT'),
      '+'  => array(513, 'T_PLUS'),
      '-'  => array(514, 'T_MINUS'),
      '*'  => array(515, 'T_MULT'),
      '/'  => array(516, 'T_DIV'),
      '?'  => array(517, 'T_QUESTIONMARK'),
      '!'  => array(518, 'T_EXCLAMATIONMARK'),
      ':'  => array(519, 'T_COLON'),
      '"'  => array(520, 'T_DOUBLE_QUOTES'),
      '@'  => array(521, 'T_AT'),
      '&'  => array(522, 'T_AMPERSAND'),
      '%'  => array(523, 'T_PERCENT'),
      '|'  => array(523, 'T_PIPE'),
      '$'  => array(524, 'T_DOLLAR'),
      '^'  => array(525, 'T_CARET'),
      '~'  => array(526, 'T_TILDE'),
      '`'  => array(527, 'T_BACKTICK'),
    );

    /**
     * Constructor.
     *
     * @param integer $id
     * @param string  $text
     * @param integer $line
     */
    public function __construct($id, $text, $line)
    {
        $this->id   = $id;
        $this->text = $text;
        $this->line = $line;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->text;
    }

    /**
     * @param  string $text
     * @return integer
     * @throws PHP_Token_Exception
     */
    public static function getTokenId($text)
    {
        if (!isset(self::$tokens[$text])) {
            throw new PHP_Token_Exception('Unknown token "' . $text . '"');
        }

        return self::$tokens[$text][0];
    }

    /**
     * Returns the token constant name as a string.
     * IDs below 500 are PHP's built-in tokenizer constants,
     * IDs above 500 are our own custom tokens.
     *
     * @param  integer $id
     * @return string
     * @throws PHP_Token_Exception
     */
    public static function getTokenName($id)
    {
        if ($id < 500) {
            return token_name($id);
        }

        foreach (self::$tokens as $key => $value) {
            if ($value[0] == $id) {
                return $value[1];
            }
        }

        throw new PHP_Token_Exception('Unknown token ' . $id);
    }

    /**
     * Define constants for custom tokens.
     */
    public static function initConstants()
    {
        foreach (self::$tokens as $key => $value) {
            if (!defined($value[1])) {
                define($value[1], $value[0]);
            }
        }
    }
}

PHP_Token::initConstants();
