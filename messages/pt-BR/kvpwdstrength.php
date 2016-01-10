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
    '{attribute} should contain at least {n, plural, one{one character} other{# characters}} ({found} found)!' => '{attribute} deve conter ao menos {n, plural, one{one caracter} other{# caracteres}} (digitou {found})!',
    '{attribute} should contain at most {n, plural, one{one character} other{# characters}} ({found} found)!' => '{attribute} deve conter no máximo {n, plural, one{one caracter} other{# caracteres}} (digitou {found})!',
    '{attribute} should contain exactly {n, plural, one{one character} other{# characters}} ({found} found)!' => '{attribute} deve conter exatamente {n, plural, one{um caracter} other{# caracteres}} (digitou {found})!',
    '{attribute} cannot contain any spaces' => "{attribute} não pode conter espaços",
    '{attribute} cannot contain the username' => "{attribute} não pode conter o usuário",
    '{attribute} cannot contain an email address' => "{attribute} não pode conter o e-mail",
    '{attribute} must be a string' => '{attribute} deve ter apenas letras',
    '{attribute} should contain at least {n, plural, one{one lower case character} other{# lower case characters}} ({found} found)!' => '{attribute} deve conter ao menos {n, plural, one{um caracter em minúsculo} other{# caracteres em minúsculo}} (digitou {found})!',
    '{attribute} should contain at least {n, plural, one{one upper case character} other{# upper case characters}} ({found} found)!' => '{attribute} deve conter ao menos {n, plural, one{um caracter em maiúsculo} other{# caracteres em maiúsculo}} (digitou {found})!',
    '{attribute} should contain at least {n, plural, one{one numeric / digit character} other{# numeric / digit characters}} ({found} found)!' => '{attribute} deve ter ao menos {n, plural, one{um dígito numérico/caracter} other{# dígitos numéricos/caracteres}} (digitou {found})!',
    '{attribute} should contain at least {n, plural, one{one special character} other{# special characters}} ({found} found)!' => '{attribute} deve conter ao menos {n, plural, one{um caracter especial} other{# caracteres especiais}} (digitou {found})!',
];
