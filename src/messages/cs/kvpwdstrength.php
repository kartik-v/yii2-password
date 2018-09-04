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
    '{attribute} should contain at least {n, plural, one{one character} other{# characters}} ({found} found)!' => '{attribute} musí obsahovat minimálně {n, plural, one{jeden znak} two{2 znaky} three{3 znaky} four{4 znaky} other{# znaků}} ({found} nalezeno)!',
    '{attribute} should contain at most {n, plural, one{one character} other{# characters}} ({found} found)!' => '{attribute} musí obsahovat maximálně {n, plural, one{jeden znak} two{2 znaky} three{3 znaky} four{4 znaky} other{# znaků}} ({found} nalezeno)!',
    '{attribute} should contain exactly {n, plural, one{one character} other{# characters}} ({found} found)!' => '{attribute} musí obsahovat přesně {n, plural, one{jeden znak} two{2 znaky} three{3 znaky} four{4 znaky} other{# znaků}} ({found} nalezeno)!',
    '{attribute} cannot contain any spaces' => '{attribute} nemůže obsahovat žádné mezery',
    '{attribute} cannot contain the username' => '{attribute} nemůže obsahovat uživatelské jméno',
    '{attribute} cannot contain an email address' => '{attribute} nemůže obsahovat emailovou adresu',
    '{attribute} must be a string' => '{attribute} must be a string',
    '{attribute} should contain at least {n, plural, one{one lower case character} other{# lower case characters}} ({found} found)!' => '{attribute} musí obsahovat minimálně {n, plural, one{jedno malé písmeno} two{2 malá písmena} three{3 malá písmena} four{4 malá písmena} other{# malých písmen}} ({found} nalezeno)!',
    '{attribute} should contain at least {n, plural, one{one upper case character} other{# upper case characters}} ({found} found)!' => '{attribute} musí obsahovat minimálně {n, plural, one{jedno velké písmeno} two{2 velká písmena} three{3 velká písmena} four{4 velká písmena} other{# velkých písmen}} ({found} nalezeno)!',
    '{attribute} should contain at least {n, plural, one{one numeric / digit character} other{# numeric / digit characters}} ({found} found)!' => '{attribute} musí obsahovat minimálně {n, plural, one{jeden numerický / číselný znak} two{2 numerické / číselné znaky} three{3 numerické / číselné znaky} four{4 numerické / číselné znaky} other{# numerických / číselných znaků}} ({found} nalezeno)!',
    '{attribute} should contain at least {n, plural, one{one special character} other{# special characters}} ({found} found)!' => '{attribute} musí obsahovat minimálně {n, plural, one{1 speciální znak} two{2 speciální znaky} three{3 speciální znaky} four{4 speciální znak} other{# speciálních znaků}} ({found} nalezeno)!'
];
