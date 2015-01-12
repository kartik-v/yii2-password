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
    '{attribute} should contain at least {n} {chars}, plural, one{one character} other{# characters}} ({found} found)!' =>
        '{attribute} moet minstens {n, plural, one{één karakter} other{# karakters}} ({found} gevonden)!',
    '{attribute} should contain at most {n, plural, one{one character} other{# characters}} ({found} found)!' =>
        '{attribute} mag maximaal {n, plural, one{één karakter} other{# karakters}} ({found} gevonden)!',
    '{attribute} should contain exactly {n, plural, one{one character} other{# characters}} ({found} found)!' =>
        '{attribute} moet precies {n, plural, one{één karakter} other{# karakters}} ({found} gevonden)!',
    '{attribute} cannot contain the username' => '{attribute} mag niet de gebruikersnaam bevatten',
    '{attribute} cannot contain an email address' => '{attribute} mag niet het email-adres bevatten',
    '{attribute} must be a string' => '{attribute} moet een string zijn',
    '{attribute} should contain at least {n, plural, one{one lower case character} other{# lower case characters}} ({found} found)!' =>
        '{attribute} moet minstens {n, plural, one{één kleine letter bevatten} other{# kleine letters bevatten}} ({found} gevonden)!',
    '{attribute} should contain at least {n, plural, one{one upper case character} other{# upper case characters}} ({found} found)!' =>
        '{attribute} moet minstens {n, plural, one{één hoofdletter bevatten} other{# hoofdletters bevatten}} ({found} gevonden)!',
    '{attribute} should contain at least {n, plural, one{one numeric / digit character} other{# numeric / digit characters}} ({found} found)!' =>
        '{attribute} moet minstens {n, plural, one{één cijfer bevatten} other{# cijfers bevatten}} ({found} gevonden)!',
    '{attribute} should contain at least {n, plural, one{one special character} other{# special characters}} ({found} found)!' =>
        '{attribute} moet minstens {n, plural, one{één bijzonder teken} other{# bijzondere tekens}} ({found} gevonden)!',
];
