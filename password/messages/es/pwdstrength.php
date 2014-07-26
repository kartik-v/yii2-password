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
    '{attribute} should contain at least {n, plural, one{one character} other{# characters}} ({found} found)!' => '{attribute} debe contener al menos {n, plural, one{un carácter} other{# caracteres}} ({found} encontrados)!',
    '{attribute} should contain at most {n, plural, one{one character} other{# characters}} ({found} found)!' => '{attribute} debe contener como máximo {n, plural, one{un carácter} other{# caracteres}} ({found} encontrados)!',
    '{attribute} should contain exactly {n, plural, one{one character} other{# characters}} ({found} found)!' => '{attribute} debe contener exactamente {n, plural, one{un carácter} other{# caracteres}} ({found} encontrados)!',
    '{attribute} cannot contain the username' => "{attribute} no puede contener el nombre de usuario",
    '{attribute} cannot contain an email address' => "{attribute} no puede contener una dirección de correo electrónico",
    '{attribute} must be a string' => '{attribute} debe ser una cadena de texto',
    '{attribute} should contain at least {n, plural, one{one lower case character} other{# lower case characters}} ({found} found)!' =>
        '{attribute} debe contener al menos {n, plural, one{un carácter en minúscula} other{# caracteres en minúscula}} ({found} encontrados)!',
    '{attribute} should contain at least {n, plural, one{one upper case character} other{# upper case characters}} ({found} found)!' =>
        '{attribute} debe contener al menos {n, plural, one{un carácter en mayúscula} other{# caracteres en mayúscula}} ({found} encontrados)!',
    '{attribute} should contain at least {n, plural, one{one numeric / digit character} other{# numeric / digit characters}} ({found} found)!' =>
        '{attribute} debe contener al menos {n, plural, one{un carácter numérico / dígito} other{# caracteres numéricos / dígitos}} ({found} encontrados)!',
    '{attribute} should contain at least {n, plural, one{one special character} other{# special characters}} ({found} found)!' =>
        '{attribute} debe contener al menos {n, plural, one{un carácter especial} other{# caracteres especiales}} ({found} encontrados)!',
];
