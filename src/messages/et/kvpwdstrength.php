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
    '{attribute} should contain at least {n, plural, one{one character} other{# characters}} ({found} found)!' => '{attribute} peab sisaldama vähemalt {n, plural, one{ühte tähemärki} other{# tähemärki}} ({found} leitud)!',
    '{attribute} should contain at most {n, plural, one{one character} other{# characters}} ({found} found)!' => '{attribute} võib sisaldada kõige enam {n, plural, one{ühte tähemärki} other{# tähemärki}} ({found} leitud)!',
    '{attribute} should contain exactly {n, plural, one{one character} other{# characters}} ({found} found)!' => '{attribute} peaks sisaldama täpselt {n, plural, one{ühte tähemärki} other{# täehemärki}} ({found} leitud)!',
    '{attribute} cannot contain any spaces' => '{attribute} ei tohi sisaldada tühikuid',
    '{attribute} cannot contain the username' => '{attribute} ei tohi sisaldada kasutajanime',
    '{attribute} cannot contain an email address' => '{attribute} ei tohi sisaldada e-posti aadressi',
    '{attribute} must be a string' => '{attribute} peab olema tekst',
    '{attribute} should contain at least {n, plural, one{one lower case character} other{# lower case characters}} ({found} found)!' => '{attribute} peaks sisaldama vähemalt {n, plural, one{ühte väiketähte} other{# väiketeähte}} ({found} leitud)!',
    '{attribute} should contain at least {n, plural, one{one upper case character} other{# upper case characters}} ({found} found)!' => '{attribute} peaks sisaldama vähemalt {n, plural, one{ühte suurtähte} other{# suurtähte}} ({found} leitud)!',
    '{attribute} should contain at least {n, plural, one{one numeric / digit character} other{# numeric / digit characters}} ({found} found)!' => '{attribute} peaks sisaldama vähemalt {n, plural, one{ühte numbrit} other{# numbrit}} ({found} leitud)!',
    '{attribute} should contain at least {n, plural, one{one special character} other{# special characters}} ({found} found)!' => '{attribute} pesks sisaldama vähemalt {n, plural, one{ühte erimärki} other{# erimärki}} ({found} leitud)!',
];
