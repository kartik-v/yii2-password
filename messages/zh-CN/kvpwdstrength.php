<?php

/**
 * Message translations for \kartik\password\StrengthValidator.
 *
 * It contains the localizable messages extracted from source code.
 * You may modify this file by translating the extracted messages.
 *
 * Each array element represents the translation (value) of a message (key).
 * If the value is empty, the message is considered as not translated.
 * Messages that no longer need translation will have their translations
 * enclosed between a pair of '@@' marks.
 *
 * Message string can be used with plural forms format. Check i18n section
 * of the guide for details.
 *
 * NOTE: this file must be saved in UTF-8 encoding.
 */
return [
    '{attribute} should contain at least {n, plural, one{one character} other{# characters}} ({found} found)!' =>
        '{attribute} 必须至少包含 {n} 个字符, 实际存在{found}个!',
    '{attribute} should contain at most {n, plural, one{one character} other{# characters}} ({found} found)!' =>
        '{attribute} 必须最多包含 {n} 个字符, 实际存在{found}个!',
    '{attribute} should contain exactly {n, plural, one{one character} other{# characters}} ({found} found)!' =>
        '{attribute} 必须正好包含 {n} 个字符, 实际存在{found}个!',
    '{attribute} cannot contain any spaces' => "{attribute} 不能包含任何空格",
    '{attribute} cannot contain the username' => '{attribute} 不能包含用户名',
    '{attribute} cannot contain an email address' => '{attribute} 不能包含Email',
    '{attribute} must be a string' => '{attribute} 必须是个字符串',
    '{attribute} should contain at least {n, plural, one{one lower case character} other{# lower case characters}} ({found} found)!' =>
        '{attribute} 必须至少包含 {n} 个小写字符, 实际存在{found}个!',
    '{attribute} should contain at least {n, plural, one{one upper case character} other{# upper case characters}} ({found} found)!' =>
        '{attribute} 必须至少包含 {n} 个大写字符, 实际存在{found}个!',
    '{attribute} should contain at least {n, plural, one{one numeric / digit character} other{# numeric / digit characters}} ({found} found)!' =>
        '{attribute} 必须至少包含 {n} 个数字, 实际存在{found}个!',
    '{attribute} should contain at least {n, plural, one{one special character} other{# special characters}} ({found} found)!' =>
        '{attribute} 必须至少包含 {n} 个特殊字符, 实际存在{found}个!',
];
