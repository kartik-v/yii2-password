<?php
/**
 * @package   yii2-password
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2022
 * @version   1.5.7
 */

namespace kartik\password;

/**
 * List of password rule presets
 */
return [
    StrengthValidator::SIMPLE => [
        'min' => 6,
        'upper' => 0,
        'lower' => 1,
        'digit' => 1,
        'special' => 0,
        'hasUser' => false,
        'hasEmail' => false,
        'haveIBeenPwned' => false,
    ],
    StrengthValidator::NORMAL => [
        'min' => 8,
        'upper' => 1,
        'lower' => 1,
        'digit' => 1,
        'special' => 0,
        'hasUser' => true,
        'hasEmail' => true,
        'haveIBeenPwned' => false,
    ],
    StrengthValidator::FAIR => [
        'min' => 10,
        'upper' => 1,
        'lower' => 1,
        'digit' => 1,
        'special' => 1,
        'hasUser' => true,
        'hasEmail' => true,
        'haveIBeenPwned' => false,
    ],
    StrengthValidator::MEDIUM => [
        'min' => 10,
        'upper' => 1,
        'lower' => 1,
        'digit' => 2,
        'special' => 1,
        'hasUser' => true,
        'hasEmail' => true,
        'haveIBeenPwned' => false,
    ],
    StrengthValidator::STRONG => [
        'min' => 12,
        'upper' => 2,
        'lower' => 2,
        'digit' => 2,
        'special' => 2,
        'hasUser' => true,
        'hasEmail' => true,
        'haveIBeenPwned' => false,
    ],
];
