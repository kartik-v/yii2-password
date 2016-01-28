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
    '{attribute} should contain at least {n, plural, one{one character} other{# characters}} ({found} found)!' => '{attribute} powinno zawierać przynajmniej {n, plural, one{jeden znak} few{# znaki} other{# znaków}}  (wpisano {found})!',
    '{attribute} should contain at most {n, plural, one{one character} other{# characters}} ({found} found)!' => '{attribute} powinno zawierać najwyżej {n, plural, one{jeden znak} few{# znaki} other{# znaków}}  (wpisano {found})!' ,
    '{attribute} should contain exactly {n, plural, one{one character} other{# characters}} ({found} found)!' => '{attribute} powinno zawierać dokładnie {n, plural, one{jeden znak} few{# znaki} other{# znaków}}  (wpisano {found})!',
    '{attribute} cannot contain any spaces' => "{attribute} nie może zawierać żadnych spacji",
    '{attribute} cannot contain the username' => "{attribute} nie może zawierać nazwy użytkownika",
    '{attribute} cannot contain an email address' => "{attribute} nie może zawierać adresu e-mail",
    '{attribute} must be a string' => '{attribute} musi być ciągiem znaków',
    '{attribute} should contain at least {n, plural, one{one lower case character} other{# lower case characters}} ({found} found)!' => '{attribute} powinno zawierać przynajmniej {n, plural, one{jedną małą literę} few{# małe litery} other{# małych liter}}  ({found} znaleziono)!',
    '{attribute} should contain at least {n, plural, one{one upper case character} other{# upper case characters}} ({found} found)!' => '{attribute} powinno zawierać przynajmniej {n, plural, one{jedną wielką literę} few{# wielkie litery} other{# wielkich liter}}  ({found} znaleziono)!',
    '{attribute} should contain at least {n, plural, one{one numeric / digit character} other{# numeric / digit characters}} ({found} found)!' => '{attribute} powinno zawierać przynajmniej {n, plural, one{jedną cyfrę} few{# cyfry} other{# cyfr}}  ({found} znaleziono)!',
    '{attribute} should contain at least {n, plural, one{one special character} other{# special characters}} ({found} found)!' => '{attribute} powinno zawierać przynajmniej {n, plural, one{jeden znak specjalny} few{# znaki specjalne} other{# znaków specjalnych}}  ({found} znaleziono)!',
];
