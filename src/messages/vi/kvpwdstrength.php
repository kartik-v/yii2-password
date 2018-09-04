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
    '{attribute} should contain at least {n, plural, one{one character} other{# characters}} ({found} found)!' => '{attribute} nên chứa ít nhất {n, plural, one{một ký tự} other{# ký tự}} ({found} tìm thấy)!',
    '{attribute} should contain at most {n, plural, one{one character} other{# characters}} ({found} found)!' => '{attribute} nên chứa nhiều nhất {n, plural, one{một ký tự} other{# ký tự}} ({found} tìm thấy)!',
    '{attribute} should contain exactly {n, plural, one{one character} other{# characters}} ({found} found)!' => '{attribute} nên chứa chính xác {n, plural, one{một ký tự} other{# ký tự}} ({found} tìm thấy)!',
    '{attribute} cannot contain any spaces' => '{attribute} không được chứa khoảng trắng',
    '{attribute} cannot contain the username' => "{attribute} không được chứa tên đăng nhập",
    '{attribute} cannot contain an email address' => "{attribute} không được chứa địa chỉ email",
    '{attribute} must be a string' => '{attribute} phải là chuỗi ký tự',
    '{attribute} should contain at least {n, plural, one{one lower case character} other{# lower case characters}} ({found} found)!' => '{attribute} nên chứa ít nhất {n, plural, one{một ký tự in thường} other{# ký tự in thường}} ({found} tìm thấy)!',
    '{attribute} should contain at least {n, plural, one{one upper case character} other{# upper case characters}} ({found} found)!' => '{attribute} nên chứa ít nhất {n, plural, one{một ký tự in hoa} other{# ký tự in hoa}} ({found} tìm thấy)!',
    '{attribute} should contain at least {n, plural, one{one numeric / digit character} other{# numeric / digit characters}} ({found} found)!' => '{attribute} nên chứa ít nhất {n, plural, one{một số / ký tự số} other{# số / ký tự số}} ({found} tìm thấy)!',
    '{attribute} should contain at least {n, plural, one{one special character} other{# special characters}} ({found} found)!' => '{attribute} nên chứa ít nhất {n, plural, one{một ký tự đặc biệt} other{# ký tự đặc biệt}} ({found} tìm thấy)!',
];
