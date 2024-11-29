<?php

namespace Model;

defined('ROOTPATH') OR exit('Access DENIED!');

/**
 * {CLASSNAME} CLASS
 * *
 */

class {CLASSNAME} {

  # IMPORTING MODEL TRAIT  --------
  use Model;
  # ------  ./IMPORTING MODEL TRAIT

  # Properties  --------
  protected $table             = '{table}';
  protected $primaryKey        = 'id';
  protected $loginUniqueColumn = 'email';

  protected $allowedColumns = [
    'username',
    'email',
    'password',
  ];

  /**********************************
   * VALIDATION RULES includes:
      required
      alpha
      alpha_space
      alpha_numeric
      alpha_numeric_symbol
      alpha_symbol
      email
      numeric
      unique
      symbol
      not_less_than_8_chars
   * Other VALIDATION RULES may be added
   *********************************/
  protected $onInsertValidationRules = [
    'email' => [
      'email',
      'unique',
      'required',
    ],
    'username' => [
      'alpha',
      'required',
    ],
    'password' => [
      'not_less_than_8_chars',
      'required',
    ],
  ];

  protected $onUpdateValidationRules = [
    'email' => [
      'email',
      'unique',
      'required',
    ],
    'username' => [
      'alpha',
      'required',
    ],
    'password' => [
      'not_less_than_8_chars',
      'required',
    ],
  ];
  # ------  ./Properties
}
# ----------  ./User
