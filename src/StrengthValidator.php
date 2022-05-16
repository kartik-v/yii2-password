<?php

/**
 * @package   yii2-password
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2022
 * @version   1.5.8
 */

namespace kartik\password;

use kartik\base\Lib;
use ReflectionException;
use Yii;
use yii\base\Model;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\validators\Validator;
use kartik\base\TranslationTrait;

/**
 * StrengthValidator validates if the attribute value matches a specified set of password strength rules. You can
 * use this validator to validate the password strength as part of your model's validation rules.
 *
 * For example,
 *
 * ```php
 * // add this in your model
 * use kartik\password\StrengthValidator;
 *
 * // use the validator in your model rules
 * public function rules() {
 *     return [
 *            [['username', 'password'], 'required'],
 *            [['password'], StrengthValidator::className(), 'preset'=>'normal', 'userAttribute'=>'username']
 *     ];
 * }
 * ```
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class StrengthValidator extends Validator
{
    use TranslationTrait;

    /**
     * @var string the simple password strength configuration preset
     */
    const SIMPLE = 'simple';
    /**
     * @var string the normal password strength configuration preset
     */
    const NORMAL = 'normal';
    /**
     * @var string the fair password strength configuration preset
     */
    const FAIR = 'fair';
    /**
     * @var string the medium password strength configuration preset
     */
    const MEDIUM = 'medium';
    /**
     * @var string the strong password strength configuration preset
     */
    const STRONG = 'strong';
    /**
     * @var string rule to check the minimum length of the password
     */
    const RULE_MIN = 'min';
    /**
     * @var string rule to check the maximum length of the password
     */
    const RULE_MAX = 'max';
    /**
     * @var string rule to check the password string length
     */
    const RULE_LEN = 'length';
    /**
     * @var string rule to check whether to allow spaces in the password
     */
    const RULE_SPACES = 'allowSpaces';
    /**
     * @var string rule to check whether the password contains the username
     */
    const RULE_USER = 'hasUser';
    /**
     * @var string rule to check whether the password contains the email
     */
    const RULE_EMAIL = 'hasEmail';
    /**
     * @var string rule to check whether the password contains lower case characters
     */
    const RULE_LOW = 'lower';
    /**
     * @var string rule to check whether the password contains upper case characters
     */
    const RULE_UP = 'upper';
    /**
     * @var string rule to check whether the password contains numeric digit characters
     */
    const RULE_NUM = 'digit';
    /**
     * @var string rule to check whether the password contains special characters
     */
    const RULE_SPL = 'special';
    /**
     * @var string rule to check whether the password has repeating characters
     */
    const RULE_REP = 'repeat';
    /**
     * @var string rule to check whether the password is part of `HaveIBeenPwned` database
     */
    const RULE_HIBP = 'haveIBeenPwned';
    /**
     * @var string regex to match email pattern
     */
    const EMAIL_MATCH = '/^([\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+\.)*[\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+@((((([a-z0-9]{1}[a-z0-9\-]{0,62}[a-z0-9]{1})|[a-z])\.)+[a-z]{2,6})|(\d{1,3}\.){3}\d{1,3}(\:\d{1,5})?)$/i';

    /**
     * @var bool check whether password contains the username
     */
    public $hasUser = true;

    /**
     * @var bool check whether password contains an email string
     */
    public $hasEmail = true;

    /**
     * @var int minimum number of characters. If not set, defaults to 4.
     */
    public $min = 4;

    /**
     * @var int maximum length. If not set, it means no maximum length limit.
     */
    public $max;

    /**
     * @var int|array specifies the length limit of the value to be validated. This can be specified in one of the
     *     following forms:
     * - an integer: the exact length that the value should be of;
     * - an array of one element: the minimum length that the value should be of. For example, `[8]`.
     *   This will overwrite [[min]].
     * - an array of two elements: the minimum and maximum lengths that the value should be of.
     *   For example, `[8, 128]`. This will overwrite both [[min]] and [[max]].
     * @see minError for the customized message for a too short string.
     * @see maxError for the customized message for a too long string.
     * @see notEqual for the customized message for a string that does not match desired length.
     */
    public $length;

    /**
     * @var bool whether to allow spaces in the input. Defaults to `false`.
     */
    public $allowSpaces = false;

    /**
     * @var int minimal number of lower case characters
     */
    public $lower = 2;

    /**
     * @var int minimal number of upper case characters
     */
    public $upper = 2;

    /**
     * @var int  minimal number of numeric digit characters
     */
    public $digit = 2;

    /**
     * @var int minimal number of special characters
     */
    public $special = 2;

    /**
     * @var int maximum number of same characters that can be repeated
     */
    public $repeat = 2;

    /**
     * @var bool whether to check the online database of "Have I Been Pwned"
     */
    public $haveIBeenPwned = false;

    /**
     * @var string the api for "Have I Been Pwned" check with trailing slash
     * @see https://haveibeenpwned.com/API/v3#SearchingPwnedPasswordsByRange
     */
    public $apiHIBP = 'https://api.pwnedpasswords.com/range/';

    /**
     * @var string the name of the username attribute
     */
    public $userAttribute = 'username';

    /**
     * @var string the value of the username to cross check for `hasUser` rule. This will override the userAttribute
     * setting if this is set.
     */
    public $usernameValue;

    /**
     * @var string user-defined error message used when the value is not a string
     */
    public $message;

    /**
     * @var string user-defined error message used when the length of the value is smaller than [[min]].
     */
    public $minError;

    /**
     * @var string user-defined error message used when the length of the value is greater than [[max]].
     */
    public $maxError;

    /**
     * @var string user-defined error message used when the length of the value is not equal to [[length]].
     */
    public $lengthError;

    /**
     * @var string user-defined error message used when [[allowSpaces]] is `false` and spaces are found in input
     */
    public $allowSpacesError;

    /**
     * @var string user-defined error message used when [[hasUser]] is true and value contains the username
     */
    public $hasUserError;

    /**
     * @var string user-defined error message used [[hasEmail]] is true and value contains an email
     */
    public $hasEmailError;

    /**
     * @var string user-defined error message used when value contains less than [[lower]] characters
     */
    public $lowerError;

    /**
     * @var string user-defined error message used when value contains less than [[upper]] characters
     */
    public $upperError;

    /**
     * @var string user-defined error message used when value contains less than [[digit]] characters
     */
    public $digitError;

    /**
     * @var string user-defined error message used when value contains more than [[special]] characters
     */
    public $specialError;

    /**
     * @var string user-defined error message used when the number of characters repeated exceeds [[repeat]].
     */
    public $repeatError;

    /**
     * @var string user-defined error message used when password is found in Have I Been Pwned
     */
    public $haveIBeenPwnedError;

    /**
     * @var string preset - one of the preset constants. If this is not null, the preset parameters will override the
     * validator level params
     */
    public $preset;

    /**
     * @var string presets configuration source file defaults to [[presets.php]] in the current directory
     */
    public $presetsSource;

    /**
     * @var array the target strength rule requirements that will be evaluated for displaying the strength meter
     */
    public $strengthTarget = [
        'min' => 8,
        'lower' => 3,
        'upper' => 3,
        'digit' => 3,
        'special' => 3
    ];

    /**
     * @var string the encoding of the string value to be validated (e.g. 'UTF-8'). If this property is not set,
     *     [[\yii\base\Application::charset]] will be used.
     */
    public $encoding;

    /**
     * @var array the default rule settings
     */
    protected static $_rules = [
        self::RULE_MIN => ['int' => true],
        self::RULE_MAX => ['int' => true],
        self::RULE_LEN => ['int' => true],
        self::RULE_SPACES => ['bool' => true],
        self::RULE_USER => ['bool' => true],
        self::RULE_EMAIL => ['match' => self::EMAIL_MATCH, 'bool' => true],
        self::RULE_LOW => ['match' => '![a-z]!', 'int' => true],
        self::RULE_UP => ['match' => '![A-Z]!', 'int' => true],
        self::RULE_NUM => ['match' => '![\d]!', 'int' => true],
        self::RULE_SPL => ['match' => '![\W]!', 'int' => true],
        self::RULE_REP => ['match' => '/(\w)\1{<REP>,}/'], // <REP> flag will be replaced with $repeat
        self::RULE_HIBP => ['bool' => true],
    ];

    /**
     * @var string curl http adapter for HIBP
     */
    private $_adapter;

    /**
     * @inheritdoc
     * @throws ReflectionException
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();
        if ($this->encoding === null) {
            $this->encoding = Yii::$app->charset;
        }
        $this->_msgCat = 'kvpwdstrength';
        $this->initI18N(__DIR__);
        $this->applyPreset();
        $this->checkParams();
        $this->setRuleMessages();
    }

    /**
     * Apply preset parameter if set
     *
     * @return void
     * @throws InvalidConfigException if [[preset]] value is invalid.
     */
    protected function applyPreset()
    {
        if (!isset($this->preset)) {
            return;
        }
        if (!isset($this->presetsSource)) {
            $this->presetsSource = __DIR__.'/presets.php';
        }
        $presets = require($this->presetsSource);
        if (isset($this->preset) && array_key_exists($this->preset, $presets)) {
            foreach ($presets[$this->preset] as $param => $value) {
                $this->$param = $value;
            }
        } else {
            throw new InvalidConfigException("Invalid preset '{$this->preset}'.");
        }
    }

    /**
     * Validates the provided parameters for valid data type and the right threshold for 'max' chars.
     *
     * @throws InvalidConfigException if validation is invalid
     */
    protected function checkParams()
    {
        foreach (self::$_rules as $rule => $setup) {
            if (isset($this->$rule) && !empty($setup['int']) && (!is_int($this->$rule) || $this->$rule < 0)) {
                throw new InvalidConfigException("The property '{$rule}' must be a positive integer.");
            }
            if (isset($this->$rule) && !empty($setup['bool']) && !is_bool($this->$rule)) {
                throw new InvalidConfigException("The property '{$rule}' must be either true or false.");
            }
        }
        if (isset($this->max)) {
            $chars = $this->lower + $this->upper + $this->digit + $this->special;
            if ($chars > $this->max) {
                throw new InvalidConfigException(
                    "Total number of required characters {$chars} is greater than maximum allowed {$this->max}. ".
                    "Validation is not possible!"
                );
            }
        }
    }

    /**
     * Sets the rule message for each rule
     */
    protected function setRuleMessages()
    {
        if ($this->message === null) {
            $this->message = Yii::t('kvpwdstrength', '{attribute} must be a string');
        }
        foreach (self::$_rules as $rule => $setup) {
            $param = "{$rule}Error";
            if ($this->$rule !== null) {
                $message = !isset($this->$param) ? static::getRuleMessage($rule) : $this->$param;
                $this->$param = Yii::t('kvpwdstrength', $message, ['n' => $this->$rule]);
            }
        }
    }

    /**
     * Gets the localized rule message
     *
     * @param  string  $rule  the rule to parse
     *
     * @return string
     */
    protected static function getRuleMessage($rule)
    {
        switch ($rule) {
            case self::RULE_MIN:
                return Yii::t(
                    'kvpwdstrength',
                    '{attribute} should contain at least {n, plural, one{one character} other{# characters}} ({found} found)!'
                );
            case self::RULE_MAX:
                return Yii::t(
                    'kvpwdstrength',
                    '{attribute} should contain at most {n, plural, one{one character} other{# characters}} ({found} found)!'
                );
            case self::RULE_LEN:
                return Yii::t(
                    'kvpwdstrength',
                    '{attribute} should contain exactly {n, plural, one{one character} other{# characters}} ({found} found)!'
                );
            case self::RULE_SPACES:
                return Yii::t('kvpwdstrength', '{attribute} cannot contain any spaces');
            case self::RULE_USER:
                return Yii::t('kvpwdstrength', '{attribute} cannot contain the username');
            case self::RULE_EMAIL:
                return Yii::t('kvpwdstrength', '{attribute} cannot contain an email address');
            case self::RULE_LOW:
                return Yii::t(
                    'kvpwdstrength',
                    '{attribute} should contain at least {n, plural, one{one lower case character} other{# lower case characters}} ({found} found)!'
                );
            case self::RULE_UP:
                return Yii::t(
                    'kvpwdstrength',
                    '{attribute} should contain at least {n, plural, one{one upper case character} other{# upper case characters}} ({found} found)!'
                );
            case self::RULE_NUM:
                return Yii::t(
                    'kvpwdstrength',
                    '{attribute} should contain at least {n, plural, one{one numeric / digit character} other{# numeric / digit characters}} ({found} found)!'
                );
            case self::RULE_SPL:
                return Yii::t(
                    'kvpwdstrength',
                    '{attribute} should contain at least {n, plural, one{one special character} other{# special characters}} ({found} found)!'
                );
            case self::RULE_REP:
                return Yii::t(
                    'kvpwdstrength',
                    '{attribute} cannot contain more than {n, plural, one{one repeating character} other{# repeating characters}}!'
                );
            case self::RULE_HIBP:
                return Yii::t('kvpwdstrength', '{attribute} is present in compromised password list');
        }

        return null;
    }

    /**
     * The main password validation routine
     *
     * @param  array  $params  of model, attribute, and value
     *
     * @return array|null the validated result
     */
    protected function performValidation($params = [])
    {
        /** @var Model $model */
        $model = $attribute = $value = $label = null;
        extract($params);
        $hasModel = $model !== null;
        if ($hasModel) {
            $value = Html::getAttributeValue($model, $attribute);
            if (!is_string($value)) {
                $this->addError($model, $attribute, $this->message);

                return null;
            }
            $label = $model->getAttributeLabel($attribute);
            $username = !$this->hasUser ? '' : (isset($this->usernameValue) ? $this->usernameValue :
                Html::getAttributeValue($model, $this->userAttribute));
        } else {
            if (!is_string($value)) {
                return [$this->message, []];
            }
            $username = !$this->hasUser ? '' : $this->usernameValue;
        }
        $temp = [];
        foreach (self::$_rules as $rule => $setup) {
            $param = "{$rule}Error";
            $ruleValue = isset($this->$rule) ? $this->$rule : null;
            $chkUser = $rule === self::RULE_USER && $ruleValue && !empty($value) && !empty($username) &&
                Lib::strpos($value, $username) !== false;
            $chkEmail = $rule === self::RULE_EMAIL && $ruleValue && Lib::preg_match($setup['match'], $value, $matches);
            $chkSpaces = $rule === self::RULE_SPACES && !$ruleValue && Lib::strpos($value, ' ') !== false;
            if ($rule === self::RULE_REP && $ruleValue && !empty($setup['match'])) {

                $count = Lib::preg_match_all($match, $value, $temp);
                if ($count > $ruleValue) {
                    if ($hasModel) {
                        $this->addError($model, $attribute, $this->$param, ['attribute' => $label, 'found' => $count]);
                    }
                    return [$this->$param, ['found' => $count]];
                }
            }
           if ($chkUser || $chkEmail || $chkSpaces) {
                if ($hasModel) {
                    $this->addError($model, $attribute, $this->$param, ['attribute' => $label]);
                } else {
                    return [$this->$param, []];
                }
            } elseif ($rule !== self::RULE_EMAIL && $rule !== self::RULE_USER && !empty($setup['match'])) {
               $match = $setup['match'];
               if ($rule === self::RULE_REP) {
                   $match = Lib::str_replace('<REP>', $ruleValue, $setup['match']);
               }
               $count = Lib::preg_match_all($match, $value, $temp);
               $failed = $rule === self::RULE_REP ? $count > 0 : $count < $ruleValue;
               if ($failed) {
                    if ($hasModel) {
                        $this->addError($model, $attribute, $this->$param, ['attribute' => $label, 'found' => $count]);
                    } else {
                        return [$this->$param, ['found' => $count]];
                    }
                }
            } elseif ($rule === self::RULE_HIBP && $ruleValue) {
                $hash = isset($value) ? sha1($value) : '';
                $range = Lib::substr($hash, 0, 5);
                $needle = Lib::strtoupper(substr($hash, 5));
                $url = $this->apiHIBP.Lib::urlencode($range);
                $result = empty($url) ? '' : file_get_contents($url);
                $result = empty($result) && $result !== '0' ? '' :
                    Lib::preg_replace('/^([0-9A-Z]+:0)$/m', '', $result);
                if (Lib::strpos($result, $needle) !== false) {
                    if ($hasModel) {
                        $this->addError($model, $attribute, $this->$param, ['attribute' => $label]);
                    } else {
                        return [$this->$param, []];
                    }
                }
            } else {
                $length = isset($value) ? mb_strlen($value, $this->encoding) : 0;
                $test = false;
                if ($rule === self::RULE_LEN) {
                    $test = ($length !== $ruleValue);
                } elseif ($rule === self::RULE_MIN) {
                    $test = ($length < $ruleValue);
                } elseif ($rule === self::RULE_MAX) {
                    $test = ($length > $ruleValue);
                }
                if ($ruleValue !== null && $rule !== self::RULE_REP && $test) {
                    if ($hasModel) {
                        $this->addError($model, $attribute, $this->$param, [
                            'attribute' => $label.' ('.$rule.' , '.$ruleValue.')',
                            'found' => $length,
                        ]);
                    } else {
                        return [$this->$param, ['found' => $length]];
                    }
                }
            }
        }
        return null;
    }

    /**
     * @inheritdoc
     */
    public function validateAttribute($model, $attribute)
    {
        $this->performValidation(['model' => $model, 'attribute' => $attribute]);
    }

    /**
     * @inheritdoc
     */
    protected function validateValue($value)
    {
        return $this->performValidation(['value' => $value]);
    }

    /**
     * @inheritdoc
     */
    public function clientValidateAttribute($model, $attribute, $view)
    {
        $label = $model->getAttributeLabel($attribute);
        $options = [
            'strError' => Html::encode(Yii::t('kvpwdstrength', $this->message, ['attribute' => $label])),
            'userField' => '#'.Html::getInputId($model, $this->userAttribute),
        ];
        foreach (self::$_rules as $rule => $setup) {
            $param = "{$rule}Error";
            if ($this->$rule !== null) {
                $options[$rule] = $this->$rule;
                $options[$param] = Html::encode(Yii::t('kvpwdstrength', $this->$param, ['attribute' => $label]));
            }
        }
        StrengthValidatorAsset::register($view);

        return "kvStrengthValidator.validate(value, messages, ".Json::encode($options).");";
    }
}
