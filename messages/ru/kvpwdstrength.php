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
        '{attribute} должен содержать {n, plural, =1{хотя бы один символ} one{минимум # символ} few{минимум # символа} many{минимум # символов} other{минимум # символов}} ({found} найдено)!',
    '{attribute} should contain at most {n, plural, one{one character} other{# characters}} ({found} found)!' =>
        '{attribute} должен содержать не более {n, plural, one{# символа} other{# символов}} ({found} найдено)!',
    '{attribute} should contain exactly {n, plural, one{one character} other{# characters}} ({found} found)!' =>
        '{attribute} должен содержать ровно {n, plural, one{# символ} few{# символа} many{# символов} other{# символов}} ({found} найдено)!',
    '{attribute} cannot contain any spaces' => "{attribute} не может содержать никаких пробелов",
    '{attribute} cannot contain the username' => '{attribute} не может содержать имя пользователя',
    '{attribute} cannot contain an email address' => '{attribute} не может содержать адрес электронной почты',
    '{attribute} must be a string' => '{attribute} должен быть строкой',
    '{attribute} should contain at least {n, plural, one{one lower case character} other{# lower case characters}} ({found} found)!' =>
        '{attribute} должен содержать минимум {n, plural, one{# строчный символ} few{# строчных символа} many{# строчных символов} other{# строчных символов}} ({found} найдено)!',
    '{attribute} should contain at least {n, plural, one{one upper case character} other{# upper case characters}} ({found} found)!' =>
        '{attribute} должен содержать минимум {n, plural, one{# символ верхнего регистра} few{# символа верхнего регистра} many{# символов верхнего регистра} other{# символов верхнего регистра}} ({found} найдено)!',
    '{attribute} should contain at least {n, plural, one{one numeric / digit character} other{# numeric / digit characters}} ({found} found)!' =>
            '{attribute} должен содержать минимум {n, plural, one{# цифру} few{# цыфры} many{# цифер} many{# цифр} other{# цифр}} ({found} найдено)!',
    '{attribute} should contain at least {n, plural, one{one special character} other{# special characters}} ({found} found)!' =>
        '{attribute} должен содержать минимум {n, plural, one{# специальный символ} few{# специальных символа} many{# специальных символов} other{# специальных символов}} ({found} найдено)!'
];
