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
 * @license   http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link      http://github.com/sebastianbergmann/php-token-stream/tree
 * @since     File available since Release 1.1.0
 */

spl_autoload_register(
  function ($class)
  {
      static $classes = NULL;
      static $path = NULL;;

      if ($classes === NULL) {
          $classes = array(
            'php_token' => '/Token.php',
            'php_token_abstract' => '/Token.php',
            'php_token_ampersand' => '/Token.php',
            'php_token_and_equal' => '/Token.php',
            'php_token_array' => '/Token.php',
            'php_token_array_cast' => '/Token.php',
            'php_token_as' => '/Token.php',
            'php_token_at' => '/Token.php',
            'php_token_backtick' => '/Token.php',
            'php_token_bad_character' => '/Token.php',
            'php_token_bool_cast' => '/Token.php',
            'php_token_boolean_and' => '/Token.php',
            'php_token_boolean_or' => '/Token.php',
            'php_token_break' => '/Token.php',
            'php_token_callable' => '/Token.php',
            'php_token_caret' => '/Token.php',
            'php_token_case' => '/Token.php',
            'php_token_catch' => '/Token.php',
            'php_token_character' => '/Token.php',
            'php_token_class' => '/Token.php',
            'php_token_class_c' => '/Token.php',
            'php_token_clone' => '/Token.php',
            'php_token_close_bracket' => '/Token.php',
            'php_token_close_curly' => '/Token.php',
            'php_token_close_square' => '/Token.php',
            'php_token_close_tag' => '/Token.php',
            'php_token_colon' => '/Token.php',
            'php_token_comma' => '/Token.php',
            'php_token_comment' => '/Token.php',
            'php_token_concat_equal' => '/Token.php',
            'php_token_const' => '/Token.php',
            'php_token_constant_encapsed_string' => '/Token.php',
            'php_token_continue' => '/Token.php',
            'php_token_curly_open' => '/Token.php',
            'php_token_dec' => '/Token.php',
            'php_token_declare' => '/Token.php',
            'php_token_default' => '/Token.php',
            'php_token_dir' => '/Token.php',
            'php_token_div' => '/Token.php',
            'php_token_div_equal' => '/Token.php',
            'php_token_dnumber' => '/Token.php',
            'php_token_do' => '/Token.php',
            'php_token_doc_comment' => '/Token.php',
            'php_token_dollar' => '/Token.php',
            'php_token_dollar_open_curly_braces' => '/Token.php',
            'php_token_dot' => '/Token.php',
            'php_token_double_arrow' => '/Token.php',
            'php_token_double_cast' => '/Token.php',
            'php_token_double_colon' => '/Token.php',
            'php_token_double_quotes' => '/Token.php',
            'php_token_echo' => '/Token.php',
            'php_token_else' => '/Token.php',
            'php_token_elseif' => '/Token.php',
            'php_token_empty' => '/Token.php',
            'php_token_encapsed_and_whitespace' => '/Token.php',
            'php_token_end_heredoc' => '/Token.php',
            'php_token_enddeclare' => '/Token.php',
            'php_token_endfor' => '/Token.php',
            'php_token_endforeach' => '/Token.php',
            'php_token_endif' => '/Token.php',
            'php_token_endswitch' => '/Token.php',
            'php_token_endwhile' => '/Token.php',
            'php_token_equal' => '/Token.php',
            'php_token_eval' => '/Token.php',
            'php_token_exclamation_mark' => '/Token.php',
            'php_token_exit' => '/Token.php',
            'php_token_extends' => '/Token.php',
            'php_token_file' => '/Token.php',
            'php_token_final' => '/Token.php',
            'php_token_for' => '/Token.php',
            'php_token_foreach' => '/Token.php',
            'php_token_func_c' => '/Token.php',
            'php_token_function' => '/Token.php',
            'php_token_global' => '/Token.php',
            'php_token_goto' => '/Token.php',
            'php_token_gt' => '/Token.php',
            'php_token_halt_compiler' => '/Token.php',
            'php_token_if' => '/Token.php',
            'php_token_implements' => '/Token.php',
            'php_token_inc' => '/Token.php',
            'php_token_include' => '/Token.php',
            'php_token_include_once' => '/Token.php',
            'php_token_includes' => '/Token.php',
            'php_token_inline_html' => '/Token.php',
            'php_token_instanceof' => '/Token.php',
            'php_token_insteadof' => '/Token.php',
            'php_token_int_cast' => '/Token.php',
            'php_token_interface' => '/Token.php',
            'php_token_is_equal' => '/Token.php',
            'php_token_is_greater_or_equal' => '/Token.php',
            'php_token_is_identical' => '/Token.php',
            'php_token_is_not_equal' => '/Token.php',
            'php_token_is_not_identical' => '/Token.php',
            'php_token_is_smaller_or_equal' => '/Token.php',
            'php_token_isset' => '/Token.php',
            'php_token_line' => '/Token.php',
            'php_token_list' => '/Token.php',
            'php_token_lnumber' => '/Token.php',
            'php_token_logical_and' => '/Token.php',
            'php_token_logical_or' => '/Token.php',
            'php_token_logical_xor' => '/Token.php',
            'php_token_lt' => '/Token.php',
            'php_token_method_c' => '/Token.php',
            'php_token_minus' => '/Token.php',
            'php_token_minus_equal' => '/Token.php',
            'php_token_mod_equal' => '/Token.php',
            'php_token_mul_equal' => '/Token.php',
            'php_token_mult' => '/Token.php',
            'php_token_namespace' => '/Token.php',
            'php_token_new' => '/Token.php',
            'php_token_ns_c' => '/Token.php',
            'php_token_ns_separator' => '/Token.php',
            'php_token_num_string' => '/Token.php',
            'php_token_object_cast' => '/Token.php',
            'php_token_object_operator' => '/Token.php',
            'php_token_open_bracket' => '/Token.php',
            'php_token_open_curly' => '/Token.php',
            'php_token_open_square' => '/Token.php',
            'php_token_open_tag' => '/Token.php',
            'php_token_open_tag_with_echo' => '/Token.php',
            'php_token_or_equal' => '/Token.php',
            'php_token_paamayim_nekudotayim' => '/Token.php',
            'php_token_percent' => '/Token.php',
            'php_token_pipe' => '/Token.php',
            'php_token_plus' => '/Token.php',
            'php_token_plus_equal' => '/Token.php',
            'php_token_print' => '/Token.php',
            'php_token_private' => '/Token.php',
            'php_token_protected' => '/Token.php',
            'php_token_public' => '/Token.php',
            'php_token_question_mark' => '/Token.php',
            'php_token_require' => '/Token.php',
            'php_token_require_once' => '/Token.php',
            'php_token_return' => '/Token.php',
            'php_token_semicolon' => '/Token.php',
            'php_token_sl' => '/Token.php',
            'php_token_sl_equal' => '/Token.php',
            'php_token_sr' => '/Token.php',
            'php_token_sr_equal' => '/Token.php',
            'php_token_start_heredoc' => '/Token.php',
            'php_token_static' => '/Token.php',
            'php_token_stream' => '/Token/Stream.php',
            'php_token_stream_cachingfactory' => '/Token/Stream/CachingFactory.php',
            'php_token_string' => '/Token.php',
            'php_token_string_cast' => '/Token.php',
            'php_token_string_varname' => '/Token.php',
            'php_token_switch' => '/Token.php',
            'php_token_throw' => '/Token.php',
            'php_token_tilde' => '/Token.php',
            'php_token_trait' => '/Token.php',
            'php_token_trait_c' => '/Token.php',
            'php_token_try' => '/Token.php',
            'php_token_unset' => '/Token.php',
            'php_token_unset_cast' => '/Token.php',
            'php_token_use' => '/Token.php',
            'php_token_var' => '/Token.php',
            'php_token_variable' => '/Token.php',
            'php_token_while' => '/Token.php',
            'php_token_whitespace' => '/Token.php',
            'php_token_xor_equal' => '/Token.php',
            'php_tokenwithscope' => '/Token.php',
            'php_tokenwithscopeandvisibility' => '/Token.php'
          );

          $path = dirname(dirname(dirname(__FILE__)));
      }

      $cn = strtolower($class);

      if (isset($classes[$cn])) {
          require $path . $classes[$cn];
      }
  }
);
