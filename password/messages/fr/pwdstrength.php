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
    '{attribute} should contain at least {n, plural, one{one character} other{# characters}} ({found} found)!' => '{attribute} devrait contenir au moins {n, plural, one{un caractère} other{# caractères}}! ({found} trouvé)!',
    '{attribute} should contain at most {n, plural, one{one character} other{# characters}} ({found} found)!' => '{attribute} devrait contenir au plus {n, plural, one{un caractère} other{# caractères}}! ({found} trouvé)!',
    '{attribute} should contain exactly {n, plural, one{one character} other{# characters}} ({found} found)!' => '{attribute} devrait contenir exactly {n, plural, one{un caractère} other{# caractères}}! ({found} trouvé)!',
    '{attribute} cannot contain the username' => "{attribute} ne peut pas contenir le nom d'utilisateur",
    '{attribute} cannot contain an email address' => "{attribute} ne peut pas contenir l'adresse e-mail",
    '{attribute} must be a string' => '{attribute} doit être une chaîne',
    '{attribute} should contain at least {n, plural, one{one lower case character} other{# lower case characters}} ({found} found)!' =>
        '{attribute} {n, plural, one{devrait contenir au moins un caractère en minuscule} other{# doit contenir au moins caractères minuscules}}! ({found} trouvé)!',
    '{attribute} should contain at least {n, plural, one{one upper case character} other{# upper case characters}} ({found} found)!' =>
        '{attribute} {n, plural, one{devrait contenir au moins une lettre majuscule} other{# doit contenir au moins caractères majuscules}}! ({found} trouvé)!',
    '{attribute} should contain at least {n, plural, one{one numeric / digit character} other{# numeric / digit characters}} ({found} found)!' =>
        '{attribute} {n, plural, one{devrait contenir au moins un caractère numérique / chiffres} other{# doit contenir au moins caractères numérique / chiffres}}! ({found} trouvé)!',
    '{attribute} should contain at least {n, plural, one{one special character} other{# special characters}} ({found} found)!' => '{attribute} {n, plural, one{devrait contenir au moins un caractère spécial} other{# doit contenir au moins caractères spéciaux}} ({found} trouvé)!',
];
