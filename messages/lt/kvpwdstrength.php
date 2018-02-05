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
        '{attribute} turėtų sudaryti bent jau {n, plural, one{simbolis} few{# simboliai} other{# simbolių}}! (Rasta: {found})!',
    '{attribute} should contain at most {n, plural, one{one character} other{# characters}} ({found} found)!' =>
        '{attribute} turėtų sudaryti ne daugiau nei {n, plural, one{simbolis} few{# simboliai} other{# simbolių}}! (Rasta: {found})!',
    '{attribute} should contain exactly {n, plural, one{one character} other{# characters}} ({found} found)!' =>
        '{attribute} turėtų sudaryti lygiai {n, plural, one{vienas simbolis} few{# simboliai} other{# simbolių}}! (Rasta: {found})!',
    '{attribute} cannot contain any spaces' => '{attribute} negali turėti tarpų',
    '{attribute} cannot contain the username' => '{attribute} negali atkartoti vartotojo vardą',
    '{attribute} cannot contain an email address' => '{attribute} negali atkartoti slaptažodį',
    '{attribute} must be a string' => '{attribute} privalo būti eilutė',
    '{attribute} should contain at least {n, plural, one{one lower case character} other{# lower case characters}} ({found} found)!' =>
        '{attribute} turėtų sudaryti bent {n, plural, one{1 mažoji raidė} few{# mažosios raidės} other{# mažųjų raidžių}}! (Rasta: {found})!',
    '{attribute} should contain at least {n, plural, one{one upper case character} other{# upper case characters}} ({found} found)!' =>
        '{attribute} turėtų sudaryti bent {n, plural, one{1 didžioji raidė} few{# didžiosios raidės} other{# didžiųjų raidžių}}! (Rasta: {found})!',
    '{attribute} should contain at least {n, plural, one{one numeric / digit character} other{# numeric / digit characters}} ({found} found)!' =>
        '{attribute} turėtų sudaryti bent {n, plural, one{1 skaitmuo} few{# skaitmenys} other{# skaitmenų}}! (Rasta: {found})!',
    '{attribute} should contain at least {n, plural, one{one special character} other{# special characters}} ({found} found)!' =>
        '{attribute} turėtų sudaryti bent {n, plural, one{1 skiriamasis ženklas} few{# skiriamieji ženklai} other{# skiriamųjų ženklų}} ({found} trouvé)!',
];
