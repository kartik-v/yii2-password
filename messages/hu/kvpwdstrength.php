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
    '{attribute} should contain at least {n, plural, one{one character} other{# characters}} ({found} found)!' => '{attribute} mezőnek legalább {n, plural, one{egy} other{#}} karaktert kell tartalmaznia (most {found} darabot tartalmaz)!',
    '{attribute} should contain at most {n, plural, one{one character} other{# characters}} ({found} found)!' => '{attribute} mező legfeljebb {n, plural, one{egy} other{#}} karaktert tartalmazhat (most {found} darabot tartalmaz)!',
    '{attribute} should contain exactly {n, plural, one{one character} other{# characters}} ({found} found)!' => '{attribute} mező pontosan {n, plural, one{egy} other{#}} karaktert tartalmazhat (most {found} darabot tartalmaz)!',
    '{attribute} cannot contain any spaces' => "{attribute} nem tartalmazhat szóközt",
    '{attribute} cannot contain the username' => '{attribute} mező nem tartalmazhatja a felhasználónevet',
    '{attribute} cannot contain an email address' => '{attribute} mező nem tartalmazhat email címet',
    '{attribute} must be a string' => '{attribute} mező csak szöveges lehet',
    '{attribute} should contain at least {n, plural, one{one lower case character} other{# lower case characters}} ({found} found)!' => '{attribute} mezőnek legalább {n, plural, one{egy} other{#}} kisbetűt kell tartalmaznia (most {found} darabot tartalmaz)!',
    '{attribute} should contain at least {n, plural, one{one upper case character} other{# upper case characters}} ({found} found)!' => '{attribute} mezőnek legalább {n, plural, one{egy} other{#}} nagybetűt kell tartalmaznia (most {found} darabot tartalmaz)!',
    '{attribute} should contain at least {n, plural, one{one numeric / digit character} other{# numeric / digit characters}} ({found} found)!' => '{attribute} mezőnek legalább {n, plural, one{egy} other{#}} számot kell tartalmaznia (most {found} darabot tartalmaz)!',
    '{attribute} should contain at least {n, plural, one{one special character} other{# special characters}} ({found} found)!' => '{attribute} mezőnek legalább {n, plural, one{egy} other{#}} speciális karaktert kell tartalmaznia (most {found} darabot tartalmaz)!',
];
