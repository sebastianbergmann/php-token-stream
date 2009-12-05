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
 * @copyright 2009 Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @since     File available since Release 1.0.0
 */

require_once 'PHP/Token/Exception.php';

define('T_OPEN_BRACKET', 501);
define('T_CLOSE_BRACKET', 502);
define('T_OPEN_SQUARE', 503);
define('T_CLOSE_SQUARE', 504);
define('T_OPEN_CURLY', 505);
define('T_CLOSE_CURLY', 506);
define('T_SEMICOLON', 507);
define('T_DOT', 508);
define('T_COMMA', 509);
define('T_EQUAL', 510);
define('T_LT', 511);
define('T_GT', 512);
define('T_PLUS', 513);
define('T_MINUS', 514);
define('T_MULT', 515);
define('T_DIV', 516);
define('T_QUESTION_MARK', 517);
define('T_EXCLAMATION_MARK', 518);
define('T_COLON', 519);
define('T_DOUBLE_QUOTES', 520);
define('T_AT', 521);
define('T_AMPERSAND', 522);
define('T_PERCENT', 523);
define('T_PIPE', 524);
define('T_DOLLAR', 525);
define('T_CARET', 526);
define('T_TILDE', 527);
define('T_BACKTICK', 528);

/**
 * A PHP token.
 *
 * @author    Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @copyright 2009 Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version   Release: @package_version@
 * @link      http://github.com/sebastianbergmann/php-token-stream/tree
 * @since     Class available since Release 1.0.0
 */
abstract class PHP_Token
{
    /**
     * @var string
     */
    protected $text;

    /**
     * @var integer
     */
    protected $line;

    /**
     * @var PHP_Token_Stream
     */
    protected $tokenStream;

    /**
     * @var integer
     */
    protected $tokenStreamId;

    /**
     * Constructor.
     *
     * @param string  $text
     * @param integer $line
     */
    public function __construct($text, $line, PHP_Token_Stream $tokenStream = NULL, $tokenStreamId = NULL)
    {
        $this->text          = $text;
        $this->line          = $line;
        $this->tokenStream   = $tokenStream;
        $this->tokenStreamId = $tokenStreamId;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->text;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return integer
     */
    public function getLine()
    {
        return $this->line;
    }
}

class PHP_Token_REQUIRE_ONCE extends PHP_Token
{
    protected $id = T_REQUIRE_ONCE;
}

class PHP_Token_REQUIRE extends PHP_Token
{
    protected $id = T_REQUIRE;
}

class PHP_Token_EVAL extends PHP_Token
{
    protected $id = T_EVAL;
}

class PHP_Token_INCLUDE_ONCE extends PHP_Token
{
    protected $id = T_INCLUDE_ONCE;
}

class PHP_Token_INCLUDE extends PHP_Token
{
    protected $id = T_INCLUDE;
}

class PHP_Token_LOGICAL_OR extends PHP_Token
{
    protected $id = T_LOGICAL_OR;
}

class PHP_Token_LOGICAL_XOR extends PHP_Token
{
    protected $id = T_LOGICAL_XOR;
}

class PHP_Token_LOGICAL_AND extends PHP_Token
{
    protected $id = T_LOGICAL_AND;
}

class PHP_Token_PRINT extends PHP_Token
{
    protected $id = T_PRINT;
}

class PHP_Token_SR_EQUAL extends PHP_Token
{
    protected $id = T_SR_EQUAL;
}

class PHP_Token_SL_EQUAL extends PHP_Token
{
    protected $id = T_SL_EQUAL;
}

class PHP_Token_XOR_EQUAL extends PHP_Token
{
    protected $id = T_XOR_EQUAL;
}

class PHP_Token_OR_EQUAL extends PHP_Token
{
    protected $id = T_OR_EQUAL;
}

class PHP_Token_AND_EQUAL extends PHP_Token
{
    protected $id = T_AND_EQUAL;
}

class PHP_Token_MOD_EQUAL extends PHP_Token
{
    protected $id = T_MOD_EQUAL;
}

class PHP_Token_CONCAT_EQUAL extends PHP_Token
{
    protected $id = T_CONCAT_EQUAL;
}

class PHP_Token_DIV_EQUAL extends PHP_Token
{
    protected $id = T_DIV_EQUAL;
}

class PHP_Token_MUL_EQUAL extends PHP_Token
{
    protected $id = T_MUL_EQUAL;
}

class PHP_Token_MINUS_EQUAL extends PHP_Token
{
    protected $id = T_MINUS_EQUAL;
}

class PHP_Token_PLUS_EQUAL extends PHP_Token
{
    protected $id = T_PLUS_EQUAL;
}

class PHP_Token_BOOLEAN_OR extends PHP_Token
{
    protected $id = T_BOOLEAN_OR;
}

class PHP_Token_BOOLEAN_AND extends PHP_Token
{
    protected $id = T_BOOLEAN_AND;
}

class PHP_Token_IS_NOT_IDENTICAL extends PHP_Token
{
    protected $id = T_IS_NOT_IDENTICAL;
}

class PHP_Token_IS_IDENTICAL extends PHP_Token
{
    protected $id = T_IS_IDENTICAL;
}

class PHP_Token_IS_NOT_EQUAL extends PHP_Token
{
    protected $id = T_IS_NOT_EQUAL;
}

class PHP_Token_IS_EQUAL extends PHP_Token
{
    protected $id = T_IS_EQUAL;
}

class PHP_Token_IS_GREATER_OR_EQUAL extends PHP_Token
{
    protected $id = T_IS_GREATER_OR_EQUAL;
}

class PHP_Token_IS_SMALLER_OR_EQUAL extends PHP_Token
{
    protected $id = T_IS_SMALLER_OR_EQUAL;
}

class PHP_Token_SR extends PHP_Token
{
    protected $id = T_SR;
}

class PHP_Token_SL extends PHP_Token
{
    protected $id = T_SL;
}

class PHP_Token_INSTANCEOF extends PHP_Token
{
    protected $id = T_INSTANCEOF;
}

class PHP_Token_UNSET_CAST extends PHP_Token
{
    protected $id = T_UNSET_CAST;
}

class PHP_Token_BOOL_CAST extends PHP_Token
{
    protected $id = T_BOOL_CAST;
}

class PHP_Token_OBJECT_CAST extends PHP_Token
{
    protected $id = T_OBJECT_CAST;
}

class PHP_Token_ARRAY_CAST extends PHP_Token
{
    protected $id = T_ARRAY_CAST;
}

class PHP_Token_STRING_CAST extends PHP_Token
{
    protected $id = T_STRING_CAST;
}

class PHP_Token_DOUBLE_CAST extends PHP_Token
{
    protected $id = T_DOUBLE_CAST;
}

class PHP_Token_INT_CAST extends PHP_Token
{
    protected $id = T_INT_CAST;
}

class PHP_Token_DEC extends PHP_Token
{
    protected $id = T_DEC;
}

class PHP_Token_INC extends PHP_Token
{
    protected $id = T_INC;
}

class PHP_Token_CLONE extends PHP_Token
{
    protected $id = T_CLONE;
}

class PHP_Token_NEW extends PHP_Token
{
    protected $id = T_NEW;
}

class PHP_Token_EXIT extends PHP_Token
{
    protected $id = T_EXIT;
}

class PHP_Token_IF extends PHP_Token
{
    protected $id = T_IF;
}

class PHP_Token_ELSEIF extends PHP_Token
{
    protected $id = T_ELSEIF;
}

class PHP_Token_ELSE extends PHP_Token
{
    protected $id = T_ELSE;
}

class PHP_Token_ENDIF extends PHP_Token
{
    protected $id = T_ENDIF;
}

class PHP_Token_LNUMBER extends PHP_Token
{
    protected $id = T_LNUMBER;
}

class PHP_Token_DNUMBER extends PHP_Token
{
    protected $id = T_DNUMBER;
}

class PHP_Token_STRING extends PHP_Token
{
    protected $id = T_STRING;
}

class PHP_Token_STRING_VARNAME extends PHP_Token
{
    protected $id = T_STRING_VARNAME;
}

class PHP_Token_VARIABLE extends PHP_Token
{
    protected $id = T_VARIABLE;
}

class PHP_Token_NUM_STRING extends PHP_Token
{
    protected $id = T_NUM_STRING;
}

class PHP_Token_INLINE_HTML extends PHP_Token
{
    protected $id = T_INLINE_HTML;
}

class PHP_Token_CHARACTER extends PHP_Token
{
    protected $id = T_CHARACTER;
}

class PHP_Token_BAD_CHARACTER extends PHP_Token
{
    protected $id = T_BAD_CHARACTER;
}

class PHP_Token_ENCAPSED_AND_WHITESPACE extends PHP_Token
{
    protected $id = T_ENCAPSED_AND_WHITESPACE;
}

class PHP_Token_CONSTANT_ENCAPSED_STRING extends PHP_Token
{
    protected $id = T_CONSTANT_ENCAPSED_STRING;
}

class PHP_Token_ECHO extends PHP_Token
{
    protected $id = T_ECHO;
}

class PHP_Token_DO extends PHP_Token
{
    protected $id = T_DO;
}

class PHP_Token_WHILE extends PHP_Token
{
    protected $id = T_WHILE;
}

class PHP_Token_ENDWHILE extends PHP_Token
{
    protected $id = T_ENDWHILE;
}

class PHP_Token_FOR extends PHP_Token
{
    protected $id = T_FOR;
}

class PHP_Token_ENDFOR extends PHP_Token
{
    protected $id = T_ENDFOR;
}

class PHP_Token_FOREACH extends PHP_Token
{
    protected $id = T_FOREACH;
}

class PHP_Token_ENDFOREACH extends PHP_Token
{
    protected $id = T_ENDFOREACH;
}

class PHP_Token_DECLARE extends PHP_Token
{
    protected $id = T_DECLARE;
}

class PHP_Token_ENDDECLARE extends PHP_Token
{
    protected $id = T_ENDDECLARE;
}

class PHP_Token_AS extends PHP_Token
{
    protected $id = T_AS;
}

class PHP_Token_SWITCH extends PHP_Token
{
    protected $id = T_SWITCH;
}

class PHP_Token_ENDSWITCH extends PHP_Token
{
    protected $id = T_ENDSWITCH;
}

class PHP_Token_CASE extends PHP_Token
{
    protected $id = T_CASE;
}

class PHP_Token_DEFAULT extends PHP_Token
{
    protected $id = T_DEFAULT;
}

class PHP_Token_BREAK extends PHP_Token
{
    protected $id = T_BREAK;
}

class PHP_Token_CONTINUE extends PHP_Token
{
    protected $id = T_CONTINUE;
}

class PHP_Token_GOTO extends PHP_Token
{
    protected $id = T_GOTO;
}

class PHP_Token_FUNCTION extends PHP_Token
{
    protected $id = T_FUNCTION;

    public function getArguments()
    {
        $arguments = array();
        $i         = $this->tokenStreamId + 3;
        $typeHint  = NULL;

        while (!$this->tokenStream[$i] instanceof PHP_Token_CLOSE_BRACKET) {
            if ($this->tokenStream[$i] instanceof PHP_Token_STRING) {
                $typeHint = (string)$this->tokenStream[$i];
            }

            else if ($this->tokenStream[$i] instanceof PHP_Token_VARIABLE) {
                $arguments[(string)$this->tokenStream[$i]] = $typeHint;
                $typeHint                                  = NULL;
            }

            $i++;
        }

        return $arguments;
    }

    public function getName()
    {
        if ($this->tokenStream[$this->tokenStreamId + 2] instanceof PHP_Token_STRING) {
            return (string)$this->tokenStream[$this->tokenStreamId + 2];
        }

        else if ($this->tokenStream[$this->tokenStreamId + 2] == '&' &&
                 $this->tokenStream[$this->tokenStreamId + 3] instanceof PHP_Token_STRING) {
            return (string)$this->tokenStream[$this->tokenStreamId + 3];
        }

        return 'anonymous function';
    }
}

class PHP_Token_CONST extends PHP_Token
{
    protected $id = T_CONST;
}

class PHP_Token_RETURN extends PHP_Token
{
    protected $id = T_RETURN;
}

class PHP_Token_TRY extends PHP_Token
{
    protected $id = T_TRY;
}

class PHP_Token_CATCH extends PHP_Token
{
    protected $id = T_CATCH;
}

class PHP_Token_THROW extends PHP_Token
{
    protected $id = T_THROW;
}

class PHP_Token_USE extends PHP_Token
{
    protected $id = T_USE;
}

class PHP_Token_GLOBAL extends PHP_Token
{
    protected $id = T_GLOBAL;
}

class PHP_Token_PUBLIC extends PHP_Token
{
    protected $id = T_PUBLIC;
}

class PHP_Token_PROTECTED extends PHP_Token
{
    protected $id = T_PROTECTED;
}

class PHP_Token_PRIVATE extends PHP_Token
{
    protected $id = T_PRIVATE;
}

class PHP_Token_FINAL extends PHP_Token
{
    protected $id = T_FINAL;
}

class PHP_Token_ABSTRACT extends PHP_Token
{
    protected $id = T_ABSTRACT;
}

class PHP_Token_STATIC extends PHP_Token
{
    protected $id = T_STATIC;
}

class PHP_Token_VAR extends PHP_Token
{
    protected $id = T_VAR;
}

class PHP_Token_UNSET extends PHP_Token
{
    protected $id = T_UNSET;
}

class PHP_Token_ISSET extends PHP_Token
{
    protected $id = T_ISSET;
}

class PHP_Token_EMPTY extends PHP_Token
{
    protected $id = T_EMPTY;
}

class PHP_Token_HALT_COMPILER extends PHP_Token
{
    protected $id = T_HALT_COMPILER;
}

class PHP_Token_INTERFACE extends PHP_Token
{
    protected $id = T_INTERFACE;

    public function getName()
    {
        return (string)$this->tokenStream[$this->tokenStreamId + 2];
    }
}

class PHP_Token_CLASS extends PHP_Token_INTERFACE
{
    protected $id = T_CLASS;
}

class PHP_Token_EXTENDS extends PHP_Token
{
    protected $id = T_EXTENDS;
}

class PHP_Token_IMPLEMENTS extends PHP_Token
{
    protected $id = T_IMPLEMENTS;
}

class PHP_Token_OBJECT_OPERATOR extends PHP_Token
{
    protected $id = T_OBJECT_OPERATOR;
}

class PHP_Token_DOUBLE_ARROW extends PHP_Token
{
    protected $id = T_DOUBLE_ARROW;
}

class PHP_Token_LIST extends PHP_Token
{
    protected $id = T_LIST;
}

class PHP_Token_ARRAY extends PHP_Token
{
    protected $id = T_ARRAY;
}

class PHP_Token_CLASS_C extends PHP_Token
{
    protected $id = T_CLASS_C;
}

class PHP_Token_METHOD_C extends PHP_Token
{
    protected $id = T_METHOD_C;
}

class PHP_Token_FUNC_C extends PHP_Token
{
    protected $id = T_FUNC_C;
}

class PHP_Token_LINE extends PHP_Token
{
    protected $id = T_LINE;
}

class PHP_Token_FILE extends PHP_Token
{
    protected $id = T_FILE;
}

class PHP_Token_COMMENT extends PHP_Token
{
    protected $id = T_COMMENT;
}

class PHP_Token_DOC_COMMENT extends PHP_Token
{
    protected $id = T_DOC_COMMENT;
}

class PHP_Token_OPEN_TAG extends PHP_Token
{
    protected $id = T_OPEN_TAG;
}

class PHP_Token_OPEN_TAG_WITH_ECHO extends PHP_Token
{
    protected $id = T_OPEN_TAG_WITH_ECHO;
}

class PHP_Token_CLOSE_TAG extends PHP_Token
{
    protected $id = T_CLOSE_TAG;
}

class PHP_Token_WHITESPACE extends PHP_Token
{
    protected $id = T_WHITESPACE;
}

class PHP_Token_START_HEREDOC extends PHP_Token
{
    protected $id = T_START_HEREDOC;
}

class PHP_Token_END_HEREDOC extends PHP_Token
{
    protected $id = T_END_HEREDOC;
}

class PHP_Token_DOLLAR_OPEN_CURLY_BRACES extends PHP_Token
{
    protected $id = T_DOLLAR_OPEN_CURLY_BRACES;
}

class PHP_Token_CURLY_OPEN extends PHP_Token
{
    protected $id = T_CURLY_OPEN;
}

class PHP_Token_PAAMAYIM_NEKUDOTAYIM extends PHP_Token
{
    protected $id = T_PAAMAYIM_NEKUDOTAYIM;
}

class PHP_Token_NAMESPACE extends PHP_Token
{
    protected $id = T_NAMESPACE;

    public function getName()
    {
        $namespace = (string)$this->tokenStream[$this->tokenStreamId + 2];

        for ($i = $this->tokenStreamId + 3; ; $i += 2) {
            if (isset($this->tokenStream[$i]) &&
                $this->tokenStream[$i] instanceof PHP_Token_NS_SEPARATOR) {
                $namespace .= '\\' . $this->tokenStream[$i + 1];
            } else {
                break;
            }
        }

        return $namespace;
    }
}

class PHP_Token_NS_C extends PHP_Token
{
    protected $id = T_NS_C;
}

class PHP_Token_DIR extends PHP_Token
{
    protected $id = T_DIR;
}

class PHP_Token_NS_SEPARATOR extends PHP_Token
{
    protected $id = T_NS_SEPARATOR;
}

class PHP_Token_DOUBLE_COLON extends PHP_Token
{
    protected $id = T_DOUBLE_COLON;
}

class PHP_Token_OPEN_BRACKET extends PHP_Token
{
    protected $id = T_OPEN_BRACKET;
}

class PHP_Token_CLOSE_BRACKET extends PHP_Token
{
    protected $id = T_CLOSE_BRACKET;
}

class PHP_Token_OPEN_SQUARE extends PHP_Token
{
    protected $id = T_OPEN_SQUARE;
}

class PHP_Token_CLOSE_SQUARE extends PHP_Token
{
    protected $id = T_CLOSE_SQUARE;
}

class PHP_Token_OPEN_CURLY extends PHP_Token
{
    protected $id = T_OPEN_CURLY;
}

class PHP_Token_CLOSE_CURLY extends PHP_Token
{
    protected $id = T_CLOSE_CURLY;
}

class PHP_Token_SEMICOLON extends PHP_Token
{
    protected $id = T_SEMICOLON;
}

class PHP_Token_DOT extends PHP_Token
{
    protected $id = T_DOT;
}

class PHP_Token_COMMA extends PHP_Token
{
    protected $id = T_COMMA;
}

class PHP_Token_EQUAL extends PHP_Token
{
    protected $id = T_EQUAL;
}

class PHP_Token_LT extends PHP_Token
{
    protected $id = T_LT;
}

class PHP_Token_GT extends PHP_Token
{
    protected $id = T_GT;
}

class PHP_Token_PLUS extends PHP_Token
{
    protected $id = T_PLUS;
}

class PHP_Token_MINUS extends PHP_Token
{
    protected $id = T_MINUS;
}

class PHP_Token_MULT extends PHP_Token
{
    protected $id = T_MULT;
}

class PHP_Token_DIV extends PHP_Token
{
    protected $id = T_DIV;
}

class PHP_Token_QUESTION_MARK extends PHP_Token
{
    protected $id = T_QUESTION_MARK;
}

class PHP_Token_EXCLAMATION_MARK extends PHP_Token
{
    protected $id = T_EXCLAMATION_MARK;
}

class PHP_Token_COLON extends PHP_Token
{
    protected $id = T_COLON;
}

class PHP_Token_DOUBLE_QUOTES extends PHP_Token
{
    protected $id = T_DOUBLE_QUOTES;
}

class PHP_Token_AT extends PHP_Token
{
    protected $id = T_AT;
}

class PHP_Token_AMPERSAND extends PHP_Token
{
    protected $id = T_AMPERSAND;
}

class PHP_Token_PERCENT extends PHP_Token
{
    protected $id = T_PERCENT;
}

class PHP_Token_PIPE extends PHP_Token
{
    protected $id = T_PIPE;
}

class PHP_Token_DOLLAR extends PHP_Token
{
    protected $id = T_DOLLAR;
}

class PHP_Token_CARET extends PHP_Token
{
    protected $id = T_CARET;
}

class PHP_Token_TILDE extends PHP_Token
{
    protected $id = T_TILDE;
}

class PHP_Token_BACKTICK extends PHP_Token
{
    protected $id = T_BACKTICK;
}
