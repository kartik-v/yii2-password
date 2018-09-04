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
    '{attribute} should contain at least {n, plural, one{one character} other{# characters}} ({found} found)!' => '{attribute} 至少要有 {n} 個字元，目前是 {found} 個字元!',
    '{attribute} should contain at most {n, plural, one{one character} other{# characters}} ({found} found)!' => '{attribute} 最多能有 {n} 個字元，目前是 {found} 個字元!',
    '{attribute} should contain exactly {n, plural, one{one character} other{# characters}} ({found} found)!' => '{attribute} 必須剛好是 {n} 個字元，目前是 {found} 個字元!',
    '{attribute} cannot contain any spaces' => "{attribute} 不能有任何空白字元",
    '{attribute} cannot contain the username' => '{attribute} 不能包含用戶名稱',
    '{attribute} cannot contain an email address' => '{attribute} 不能包含電子郵件',
    '{attribute} must be a string' => '{attribute} 必須是字串',
    '{attribute} should contain at least {n, plural, one{one lower case character} other{# lower case characters}} ({found} found)!' => '{attribute} 至少要有 {n} 個小寫字母，目前是 {found} 個!',
    '{attribute} should contain at least {n, plural, one{one upper case character} other{# upper case characters}} ({found} found)!' => '{attribute} 至少要有 {n} 個大寫字母，目前是 {found} 個!',
    '{attribute} should contain at least {n, plural, one{one numeric / digit character} other{# numeric / digit characters}} ({found} found)!' => '{attribute} 至少要有 {n} 個數字，目前是 {found} 個!',
    '{attribute} should contain at least {n, plural, one{one special character} other{# special characters}} ({found} found)!' => '{attribute} 至少要有 {n} 個特殊符號，目前是 {found} 個!',
];
