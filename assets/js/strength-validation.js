/*!
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2013
 * @package yii2-password
 * @version 1.0.0
 *
 * Password Strength Validation
 * Built for Yii Framework 2.0
 * Author: Kartik Visweswaran
 * Copyright: 2013, Kartik Visweswaran, Krajee.com
 * For more Yii related demos visit http://demos.krajee.com
 */

/**
 * Is a value undefined or empty
 * @param string value
 * @param boolean trim
 * @returns boolean
 */
function isEmpty(value, trim) {
    return value === null || value === undefined || value == []
            || value === '' || trim && $.trim(value) === '';
}

/**
 * Adds validation message based on lower, upper, digit, and special patterns
 * @param array messages
 * @param string message
 * @param string valueRequired
 * @param string valueFound
 */
function addPatternMessage(messages, message, valueRequired, valueFound) {
    msg = message.replace(/\{found\}/g, valueFound);
    addMessage(messages, msg, valueRequired);
}

/**
 * Adds validation message for all other cases
 * @param array messages
 * @param string message
 * @param string value
 */
function addMessage(messages, message, value) {
    val = (value == 0) ? 'none' : value;
    messages.push(message.replace(/\{value\}/g, val));
}

/**
 * Finds lower, upper, digit, and special characters
 * @param string str
 * @returns array counts for lower, upper, digit, and special characters
 */
function findPatterns(str) {
    var lower = str.match(/[a-z]/g);
    var upper = str.match(/[A-Z]/g);
    var digit = str.match(/\d/g);
    var special = str.match(/\W/g);

    lower = (isEmpty(lower)) ? 0 : lower;
    upper = (isEmpty(upper)) ? 0 : upper;
    digit = (isEmpty(digit)) ? 0 : digit;
    special = (isEmpty(special)) ? 0 : special;

    return [lower, upper, digit, special];
}

/**
 * Main strength validation routine
 * @param string the attribute value
 * @param array the messages array
 * @param array the client validation options
 */
function checkStrength(value, messages, options) {
    score = 0;
    if (isEmpty(value)) {
        return;
    }
    if (typeof value !== 'string') {
        addMessage(messages, options.strError, value);
        return;
    }
    patterns = findPatterns(value);
    username = $(options.userField).val().toLowerCase();
    if (options.min !== undefined && value.length < options.min) {
        addPatternMessage(messages, options.minError, options.min, value.length);
    }
    if (options.max !== undefined && value.length > options.max) {
        addPatternMessage(messages, options.maxError, options.max, value.length);
    }
    if (options.length !== undefined && value.length > options.length) {
        addPatternMessage(messages, options.lengthError, options.length, value.length);
    }
    if (options.hasUser === true && username && value.toLowerCase().match(username)) {
        addMessage(messages, options.hasUserError, value);
    }
    if (options.hasEmail === true && value.match(/^([\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+\.)*[\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+@((((([a-z0-9]{1}[a-z0-9\-]{0,62}[a-z0-9]{1})|[a-z])\.)+[a-z]{2,6})|(\d{1,3}\.){3}\d{1,3}(\:\d{1,5})?)$/i)) {
        addMessage(messages, options.hasEmailError, value);
    }
    if (options.lower !== undefined && patterns[0] < options.lower) {
        addPatternMessage(messages, options.lowerError, options.lower, patterns[0]);
    }
    if (options.upper !== undefined && patterns[1] < options.upper) {
        addPatternMessage(messages, options.upperError, options.upper, patterns[1]);
    }
    if (options.digit !== undefined && patterns[2] < options.digit) {
        addPatternMessage(messages, options.digitError, options.digit, patterns[2]);
    }
    if (options.special !== undefined && patterns[3] < options.special) {
        addPatternMessage(messages, options.specialError, options.special, patterns[3]);
    }
}
