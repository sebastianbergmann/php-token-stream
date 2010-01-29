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

require_once 'PHP/Token/Exception.php';

/**
 * A PHP token.
 *
 * @author    Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @copyright 2009-2010 Sebastian Bergmann <sb@sebastian-bergmann.de>
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
    protected $id;

    /**
     * @var string
     */
    protected $scope;

    /**
     * Constructor.
     *
     * @param string           $text
     * @param integer          $line
     * @param PHP_Token_Stream $tokenStream
     * @param integer          $id
     * @param string           $scope
     */
    public function __construct($text, $line, PHP_Token_Stream $tokenStream, $id, $scope)
    {
        $this->text        = $text;
        $this->line        = $line;
        $this->tokenStream = $tokenStream;
        $this->id          = $id;
        $this->scope       = $scope;
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
    public function getLine()
    {
        return $this->line;
    }

    /**
     * Returns the scope of the token.
     *
     * @return string
     */
    public function getScope()
    {
        return $this->scope;
    }
}

class PHP_Token_REQUIRE_ONCE extends PHP_Token {}
class PHP_Token_REQUIRE extends PHP_Token {}
class PHP_Token_EVAL extends PHP_Token {}
class PHP_Token_INCLUDE_ONCE extends PHP_Token {}
class PHP_Token_INCLUDE extends PHP_Token {}
class PHP_Token_LOGICAL_OR extends PHP_Token {}
class PHP_Token_LOGICAL_XOR extends PHP_Token {}
class PHP_Token_LOGICAL_AND extends PHP_Token {}
class PHP_Token_PRINT extends PHP_Token {}
class PHP_Token_SR_EQUAL extends PHP_Token {}
class PHP_Token_SL_EQUAL extends PHP_Token {}
class PHP_Token_XOR_EQUAL extends PHP_Token {}
class PHP_Token_OR_EQUAL extends PHP_Token {}
class PHP_Token_AND_EQUAL extends PHP_Token {}
class PHP_Token_MOD_EQUAL extends PHP_Token {}
class PHP_Token_CONCAT_EQUAL extends PHP_Token {}
class PHP_Token_DIV_EQUAL extends PHP_Token {}
class PHP_Token_MUL_EQUAL extends PHP_Token {}
class PHP_Token_MINUS_EQUAL extends PHP_Token {}
class PHP_Token_PLUS_EQUAL extends PHP_Token {}
class PHP_Token_BOOLEAN_OR extends PHP_Token {}
class PHP_Token_BOOLEAN_AND extends PHP_Token {}
class PHP_Token_IS_NOT_IDENTICAL extends PHP_Token {}
class PHP_Token_IS_IDENTICAL extends PHP_Token {}
class PHP_Token_IS_NOT_EQUAL extends PHP_Token {}
class PHP_Token_IS_EQUAL extends PHP_Token {}
class PHP_Token_IS_GREATER_OR_EQUAL extends PHP_Token {}
class PHP_Token_IS_SMALLER_OR_EQUAL extends PHP_Token {}
class PHP_Token_SR extends PHP_Token {}
class PHP_Token_SL extends PHP_Token {}
class PHP_Token_INSTANCEOF extends PHP_Token {}
class PHP_Token_UNSET_CAST extends PHP_Token {}
class PHP_Token_BOOL_CAST extends PHP_Token {}
class PHP_Token_OBJECT_CAST extends PHP_Token {}
class PHP_Token_ARRAY_CAST extends PHP_Token {}
class PHP_Token_STRING_CAST extends PHP_Token {}
class PHP_Token_DOUBLE_CAST extends PHP_Token {}
class PHP_Token_INT_CAST extends PHP_Token {}
class PHP_Token_DEC extends PHP_Token {}
class PHP_Token_INC extends PHP_Token {}
class PHP_Token_CLONE extends PHP_Token {}
class PHP_Token_NEW extends PHP_Token {}
class PHP_Token_EXIT extends PHP_Token {}
class PHP_Token_IF extends PHP_Token {}
class PHP_Token_ELSEIF extends PHP_Token {}
class PHP_Token_ELSE extends PHP_Token {}
class PHP_Token_ENDIF extends PHP_Token {}
class PHP_Token_LNUMBER extends PHP_Token {}
class PHP_Token_DNUMBER extends PHP_Token {}
class PHP_Token_STRING extends PHP_Token {}
class PHP_Token_STRING_VARNAME extends PHP_Token {}
class PHP_Token_VARIABLE extends PHP_Token {}
class PHP_Token_NUM_STRING extends PHP_Token {}
class PHP_Token_INLINE_HTML extends PHP_Token {}
class PHP_Token_CHARACTER extends PHP_Token {}
class PHP_Token_BAD_CHARACTER extends PHP_Token {}
class PHP_Token_ENCAPSED_AND_WHITESPACE extends PHP_Token {}
class PHP_Token_CONSTANT_ENCAPSED_STRING extends PHP_Token {}
class PHP_Token_ECHO extends PHP_Token {}
class PHP_Token_DO extends PHP_Token {}
class PHP_Token_WHILE extends PHP_Token {}
class PHP_Token_ENDWHILE extends PHP_Token {}
class PHP_Token_FOR extends PHP_Token {}
class PHP_Token_ENDFOR extends PHP_Token {}
class PHP_Token_FOREACH extends PHP_Token {}
class PHP_Token_ENDFOREACH extends PHP_Token {}
class PHP_Token_DECLARE extends PHP_Token {}
class PHP_Token_ENDDECLARE extends PHP_Token {}
class PHP_Token_AS extends PHP_Token {}
class PHP_Token_SWITCH extends PHP_Token {}
class PHP_Token_ENDSWITCH extends PHP_Token {}
class PHP_Token_CASE extends PHP_Token {}
class PHP_Token_DEFAULT extends PHP_Token {}
class PHP_Token_BREAK extends PHP_Token {}
class PHP_Token_CONTINUE extends PHP_Token {}
class PHP_Token_GOTO extends PHP_Token {}

class PHP_Token_FUNCTION extends PHP_Token
{
    protected $id = T_FUNCTION;

    public function getArguments()
    {
        $arguments = array();
        $i         = $this->id + 3;
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
        if ($this->tokenStream[$this->id+2] instanceof PHP_Token_STRING) {
            return (string)$this->tokenStream[$this->id+2];
        }

        if ($this->tokenStream[$this->id+2] instanceof PHP_Token_AMPERSAND &&
                 $this->tokenStream[$this->id+3] instanceof PHP_Token_STRING) {
            return (string)$this->tokenStream[$this->id+3];
        }

        return 'anonymous function';
    }

    public function getStartLine()
    {
    }

    public function getEndLine()
    {
    }

    public function getDocblock()
    {
    }
}

class PHP_Token_CONST extends PHP_Token {}
class PHP_Token_RETURN extends PHP_Token {}
class PHP_Token_TRY extends PHP_Token {}
class PHP_Token_CATCH extends PHP_Token {}
class PHP_Token_THROW extends PHP_Token {}
class PHP_Token_USE extends PHP_Token {}
class PHP_Token_GLOBAL extends PHP_Token {}
class PHP_Token_PUBLIC extends PHP_Token {}
class PHP_Token_PROTECTED extends PHP_Token {}
class PHP_Token_PRIVATE extends PHP_Token {}
class PHP_Token_FINAL extends PHP_Token {}
class PHP_Token_ABSTRACT extends PHP_Token {}
class PHP_Token_STATIC extends PHP_Token {}
class PHP_Token_VAR extends PHP_Token {}
class PHP_Token_UNSET extends PHP_Token {}
class PHP_Token_ISSET extends PHP_Token {}
class PHP_Token_EMPTY extends PHP_Token {}
class PHP_Token_HALT_COMPILER extends PHP_Token {}

class PHP_Token_INTERFACE extends PHP_Token
{
    protected $id = T_INTERFACE;

    public function getName()
    {
        return (string)$this->tokenStream[$this->id + 2];
    }

    public function hasParent()
    {
        return $this->tokenStream[$this->id + 4] instanceof PHP_Token_EXTENDS;
    }

    public function getParent()
    {
        if (!$this->hasParent()) {
            return FALSE;
        }

        $i         = $this->id + 6;
        $className = (string)$this->tokenStream[$i];

        while (!$this->tokenStream[$i+1] instanceof PHP_Token_WHITESPACE) {
            $className .= (string)$this->tokenStream[++$i];
        }

        return $className;
    }
}

class PHP_Token_CLASS extends PHP_Token_INTERFACE {}
class PHP_Token_EXTENDS extends PHP_Token {}
class PHP_Token_IMPLEMENTS extends PHP_Token {}
class PHP_Token_OBJECT_OPERATOR extends PHP_Token {}
class PHP_Token_DOUBLE_ARROW extends PHP_Token {}
class PHP_Token_LIST extends PHP_Token {}
class PHP_Token_ARRAY extends PHP_Token {}
class PHP_Token_CLASS_C extends PHP_Token {}
class PHP_Token_METHOD_C extends PHP_Token {}
class PHP_Token_FUNC_C extends PHP_Token {}
class PHP_Token_LINE extends PHP_Token {}
class PHP_Token_FILE extends PHP_Token {}
class PHP_Token_COMMENT extends PHP_Token {}
class PHP_Token_DOC_COMMENT extends PHP_Token {}
class PHP_Token_OPEN_TAG extends PHP_Token {}
class PHP_Token_OPEN_TAG_WITH_ECHO extends PHP_Token {}
class PHP_Token_CLOSE_TAG extends PHP_Token {}
class PHP_Token_WHITESPACE extends PHP_Token {}
class PHP_Token_START_HEREDOC extends PHP_Token {}
class PHP_Token_END_HEREDOC extends PHP_Token {}
class PHP_Token_DOLLAR_OPEN_CURLY_BRACES extends PHP_Token {}
class PHP_Token_CURLY_OPEN extends PHP_Token {}
class PHP_Token_PAAMAYIM_NEKUDOTAYIM extends PHP_Token {}

class PHP_Token_NAMESPACE extends PHP_Token
{
    protected $id = T_NAMESPACE;

    public function getName()
    {
        $namespace = (string)$this->tokenStream[$this->id+2];

        for ($i = $this->id + 3; ; $i += 2) {
            if (isset($this->tokenStream[$i]) &&
                $this->tokenStream[$i] instanceof PHP_Token_NS_SEPARATOR) {
                $namespace .= '\\' . $this->tokenStream[$i+1];
            } else {
                break;
            }
        }

        return $namespace;
    }
}

class PHP_Token_NS_C extends PHP_Token {}
class PHP_Token_DIR extends PHP_Token {}
class PHP_Token_NS_SEPARATOR extends PHP_Token {}
class PHP_Token_DOUBLE_COLON extends PHP_Token {}
class PHP_Token_OPEN_BRACKET extends PHP_Token {}
class PHP_Token_CLOSE_BRACKET extends PHP_Token {}
class PHP_Token_OPEN_SQUARE extends PHP_Token {}
class PHP_Token_CLOSE_SQUARE extends PHP_Token {}
class PHP_Token_OPEN_CURLY extends PHP_Token {}
class PHP_Token_CLOSE_CURLY extends PHP_Token {}
class PHP_Token_SEMICOLON extends PHP_Token {}
class PHP_Token_DOT extends PHP_Token {}
class PHP_Token_COMMA extends PHP_Token {}
class PHP_Token_EQUAL extends PHP_Token {}
class PHP_Token_LT extends PHP_Token {}
class PHP_Token_GT extends PHP_Token {}
class PHP_Token_PLUS extends PHP_Token {}
class PHP_Token_MINUS extends PHP_Token {}
class PHP_Token_MULT extends PHP_Token {}
class PHP_Token_DIV extends PHP_Token {}
class PHP_Token_QUESTION_MARK extends PHP_Token {}
class PHP_Token_EXCLAMATION_MARK extends PHP_Token {}
class PHP_Token_COLON extends PHP_Token {}
class PHP_Token_DOUBLE_QUOTES extends PHP_Token {}
class PHP_Token_AT extends PHP_Token {}
class PHP_Token_AMPERSAND extends PHP_Token {}
class PHP_Token_PERCENT extends PHP_Token {}
class PHP_Token_PIPE extends PHP_Token {}
class PHP_Token_DOLLAR extends PHP_Token {}
class PHP_Token_CARET extends PHP_Token {}
class PHP_Token_TILDE extends PHP_Token {}
class PHP_Token_BACKTICK extends PHP_Token {}
