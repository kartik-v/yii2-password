<?php

/**
 * @package   yii2-password
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2016
 * @version   1.5.3
 */

namespace kartik\password;

use Yii;
use yii\base\Model;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\validators\Validator;
use kartik\base\TranslationTrait;

/**
 * StrengthValidator validates if the attribute value matches a specified set of password strength rules.
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class StrengthValidator extends Validator
{
    use TranslationTrait;

    // The valid preset constants
    const SIMPLE = 'simple';
    const NORMAL = 'normal';
    const FAIR = 'fair';
    const MEDIUM = 'medium';
    const STRONG = 'strong';

    // The available rule constants
    const RULE_MIN = 'min';
    const RULE_MAX = 'max';
    const RULE_LEN = 'length';
    const RULE_SPACES = 'allowSpaces';
    const RULE_USER = 'hasUser';
    const RULE_EMAIL = 'hasEmail';
    const RULE_LOW = 'lower';
    const RULE_UP = 'upper';
    const RULE_NUM = 'digit';
    const RULE_SPL = 'special';

    // Email pattern match regex
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
     * @var string preset - one of the preset constants as defined in [[self::$_presets]]. If this is not null, the
     *     preset parameters will override the validator level params
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
        'special' => 3,
    ];

    /**
     * @var string the encoding of the string value to be validated (e.g. 'UTF-8'). If this property is not set,
     *     [[\yii\base\Application::charset]] will be used.
     */
    public $encoding;

    /**
     * @var array the the internalization configuration for this widget
     */
    public $i18n = [];

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
        self::RULE_SPL => ['match' => '![\W]!', 'int' => true]
    ];

    /**
     * @var string translation message file category name for i18n
     */
    protected $_msgCat = 'kvpwdstrength';

    /**
     * @var array the list of inbuilt presets and their parameter settings
     */
    private $_presets;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if ($this->encoding === null) {
            $this->encoding = Yii::$app->charset;
        }
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
            $this->presetsSource = __DIR__ . '/presets.php';
        }
        /** @noinspection PhpIncludeInspection */
        $this->_presets = require($this->presetsSource);
        if (array_key_exists($this->preset, $this->_presets)) {
            foreach ($this->_presets[$this->preset] as $param => $value) {
                $this->$param = $value;
            }
        } else {
            throw new InvalidConfigException("Invalid preset '{$this->preset}'.");
        }
    }

    /**
     * Validates the provided parameters for valid data type and the right threshold for 'max' chars.
     *
     * @throw InvalidConfigException if validation is invalid
     */
    protected function checkParams()
    {
        foreach (self::$_rules as $rule => $setup) {
            if (isset($this->$rule) && !empty($setup['int']) && $setup['int'] &&
                (!is_int($this->$rule) || $this->$rule < 0)
            ) {
                throw new InvalidConfigException("The property '{$rule}' must be a positive integer.");
            }
            if (isset($this->$rule) && !empty($setup['bool']) && $setup['bool'] && !is_bool($this->$rule)) {
                throw new InvalidConfigException("The property '{$rule}' must be either true or false.");
            }
        }
        if (isset($this->max)) {
            $chars = $this->lower + $this->upper + $this->digit + $this->special;
            if ($chars > $this->max) {
                throw new InvalidConfigException(
                    "Total number of required characters {$chars} is greater than maximum allowed {$this->max}. " .
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
     * @param string $rule the rule to parse
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
        }
        return null;
    }

    /**
     * The main validation routine based parameters for model & attribute or value
     *
     * @param array $params of model, attribute, and value
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
            $chkUser = $rule === self::RULE_USER && $this->hasUser && !empty($value) && !empty($username) &&
                strpos($value, $username) !== false;
            $chkEmail = $rule === self::RULE_EMAIL && $this->hasEmail && preg_match($setup['match'], $value, $matches);
            $chkSpaces = $rule === self::RULE_SPACES && strpos($value, ' ') !== false;
            if ($chkUser || $chkEmail || $chkSpaces) {
                if ($hasModel) {
                    $this->addError($model, $attribute, $this->$param, ['attribute' => $label]);
                } else {
                    return [$this->$param, []];
                }
            } elseif ($rule !== self::RULE_EMAIL && $rule !== self::RULE_USER && !empty($setup['match'])) {
                $count = preg_match_all($setup['match'], $value, $temp);
                if ($count < $this->$rule) {
                    if ($hasModel) {
                        $this->addError($model, $attribute, $this->$param, ['attribute' => $label, 'found' => $count]);
                    } else {
                        return [$this->$param, ['found' => $count]];
                    }
                }
            } else {
                $length = mb_strlen($value, $this->encoding);
                $test = false;
                if ($rule === self::RULE_LEN) {
                    $test = ($length !== $this->$rule);
                } elseif ($rule === self::RULE_MIN) {
                    $test = ($length < $this->$rule);
                } elseif ($rule === self::RULE_MAX) {
                    $test = ($length > $this->$rule);
                }
                if ($this->$rule !== null && $test) {
                    if ($hasModel) {
                        $this->addError($model, $attribute, $this->$param, [
                            'attribute' => $label . ' (' . $rule . ' , ' . $this->$rule . ')',
                            'found' => $length
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
        $options = ['strError' => Html::encode(Yii::t('kvpwdstrength', $this->message, ['attribute' => $label]))];
        $options['userField'] = '#' . Html::getInputId($model, $this->userAttribute);
        foreach (self::$_rules as $rule => $setup) {
            $param = "{$rule}Error";
            if ($this->$rule !== null) {
                $options[$rule] = $this->$rule;
                $options[$param] = Html::encode(Yii::t('kvpwdstrength', $this->$param, ['attribute' => $label]));
            }
        }
        StrengthValidatorAsset::register($view);
        return "kvStrengthValidator.validate(value, messages, " . Json::encode($options) . ");";
    }
}
