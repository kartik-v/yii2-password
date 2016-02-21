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
        '{attribute} treba da sadrži najmanje {n, plural, one{jedan karakter} other{# karaktera}} ({found} pronađeno)!',
    '{attribute} should contain at most {n, plural, one{one character} other{# characters}} ({found} found)!' => 
        '{attribute} treba da sadrži najviše {n, plural, one{jedan karakter} other{# karaktera}} ({found} pronađeno)!',
    '{attribute} should contain exactly {n, plural, one{one character} other{# characters}} ({found} found)!' => 
        '{attribute} treba da sadrži tačno {n, plural, one{jedan karakter} other{# karaktera}} ({found} pronađeno)!',
    '{attribute} cannot contain any spaces' => '{attribute} ne može da sadrži razmake',
    '{attribute} cannot contain the username' => "{attribute} ne može da sadrži korisničko ime",
    '{attribute} cannot contain an email address' => "{attribute} ne može da sadrži email",
    '{attribute} must be a string' => '{attribute} mora da bude skup karaktera',
    '{attribute} should contain at least {n, plural, one{one lower case character} other{# lower case characters}} ({found} found)!' => 
        '{attribute} mora da sadrži bar {n, plural, one{jedno malo slovo} other{# mala slova}} ({found} pronađeno)!',
    '{attribute} should contain at least {n, plural, one{one upper case character} other{# upper case characters}} ({found} found)!' => 
        '{attribute} mora da sadrži bar {n, plural, one{jedno veliko slovo} other{# velika slova}} ({found} pronađeno)!',
    '{attribute} should contain at least {n, plural, one{one numeric / digit character} other{# numeric / digit characters}} ({found} found)!' => 
        '{attribute} mora da sadrži bar {n, plural, one{jedan broj} other{# broja}} ({found} pronađeno)!',
    '{attribute} should contain at least {n, plural, one{one special character} other{# special characters}} ({found} found)!' => 
        '{attribute} mora da sadrži bar {n, plural, one{jedan specijalni karakter} other{# specijalna karaktera}} ({found} pronađeno)!',
];
