/*!
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014
 * @package yii2-password
 * @version 1.5.3
 *
 * Password Strength Validation
 * Built for Yii Framework 2.0
 * Author: Kartik Visweswaran
 * Copyright: 2014, Kartik Visweswaran, Krajee.com
 * For more Yii related demos visit http://demos.krajee.com
 */
var kvStrengthValidator = {};
(function ($) {
    "use strict";
    var emailRegExp = /^([\w!#$%&'\*\+\-\/=\?\^`{\|}~]+\.)*[\w!#$%&'\*\+\-\/=\?\^`{\|}~]+@((((([a-z0-9]{1}[a-z0-9\-]{0,62}[a-z0-9]{1})|[a-z])\.)+[a-z]{2,6})|(\d{1,3}\.){3}\d{1,3}(:\d{1,5})?)$/i;
    kvStrengthValidator = {
        isEmpty: function (value, trim) {
            return value === null || value === undefined || value.length === 0 || trim && $.trim(value) === '';
        },
        addMessage: function (messages, message, value) {
            var val = this.isEmpty(value) ? 'none' : value;
            messages.push(message.replace(/\{value}/g, val));
        },
        addError: function (messages, message, valueRequired, valueFound) {
            var self = this, msg = message.replace(/\{found}/g, valueFound);
            self.addMessage(messages, msg, valueRequired);
        },
        findPatterns: function (str) {
            var self = this, isEmpty = self.isEmpty,
                lower = str.match(/[a-z]/g),
                upper = str.match(/[A-Z]/g),
                digit = str.match(/\d/g),
                special = str.match(/\W/g);
            return {
                lower: isEmpty(lower) ? 0 : lower.length,
                upper: isEmpty(upper) ? 0 : upper.length,
                digit: isEmpty(digit) ? 0 : digit.length,
                special: isEmpty(special) ? 0 : special.length
            };
        },
        compare: function (from, operator, to) {
            var chk = (from !== undefined) && (to !== undefined);
            if (operator === '<') {
                return chk && (from < to);
            }
            if (operator === '>') {
                return chk && (from > to);
            }
            return chk && (from === to);
        },
        validate: function (value, messages, options) {
            var self = this, compare = self.compare;
            /** @namespace options.minError */
            /** @namespace options.maxError */
            /** @namespace options.lengthError */
            /** @namespace options.allowSpaces */
            /** @namespace options.allowSpacesError */
            /** @namespace options.userField */
            /** @namespace options.hasUser */
            /** @namespace options.hasUserError */
            /** @namespace options.hasEmail */
            /** @namespace options.hasEmailError */
            /** @namespace options.lowerError */
            /** @namespace options.upperError */
            /** @namespace options.digitError */
            /** @namespace options.specialError */
            /** @namespace options.strError */
            if (self.isEmpty(value)) {
                return;
            }
            if (typeof value !== 'string') {
                self.addMessage(messages, options.strError, value);
                return;
            }
            var patterns = self.findPatterns(value), len = value.length || 0,
                username = $(options.userField).val();
            if (compare(len, '<', options.min)) {
                self.addError(messages, options.minError, options.min, len);
            }
            if (compare(len, '>', options.max)) {
                self.addError(messages, options.maxError, options.max, len);
            }
            if (compare(len, '>', options['length'])) { // jshint ignore:line
                self.addError(messages, options.lengthError, options['length'], len); // jshint ignore:line
            }
            if (options.allowSpaces === false && value.indexOf(' ') !== -1) {
                self.addMessage(messages, options.allowSpacesError, value);
            }
            if (options.hasUser && username && value.toLowerCase().match(username.toLowerCase())) {
                self.addMessage(messages, options.hasUserError, value);
            }
            if (options.hasEmail && value.match(emailRegExp)) {
                self.addMessage(messages, options.hasEmailError, value);
            }
            if (compare(patterns.lower, '<', options.lower)) {
                self.addError(messages, options.lowerError, options.lower, patterns.lower);
            }
            if (compare(patterns.upper, '<', options.upper)) {
                self.addError(messages, options.upperError, options.upper, patterns.upper);
            }
            if (compare(patterns.digit, '<', options.digit)) {
                self.addError(messages, options.digitError, options.digit, patterns.digit);
            }
            if (compare(patterns.special, '<', options.special)) {
                self.addError(messages, options.specialError, options.special, patterns.special);
            }
        }
    };
})(window.jQuery);