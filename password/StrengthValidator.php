<?php

namespace kartik\password;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 * StrengthValidator validates if the attribute value matches a specified
 * set of password strength rules. It builds over the Yii StringValidator.
 * 
 * @see yii\validators\StringValidator
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class StrengthValidator extends \yii\validators\Validator {
    /* The valid preset constants */

    const SIMPLE = 'simple';
    const NORMAL = 'normal';
    const FAIR = 'fair';
    const MEDIUM = 'medium';
    const STRONG = 'strong';

    /* The available rule constants */
    const RULE_MIN = 'min';
    const RULE_MAX = 'max';
    const RULE_LEN = 'length';
    const RULE_USER = 'hasUser';
    const RULE_EMAIL = 'hasEmail';
    const RULE_LOW = 'lower';
    const RULE_UP = 'upper';
    const RULE_NUM = 'digit';
    const RULE_SPL = 'special';

    /**
     * @var boolean check whether password contains the username
     */
    public $hasUser = true;

    /**
     * @var boolean check whether password contains an email string
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
     * @var int specifies the exact length that the value should be of
     */
    public $length;

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
     * @var string user-defined error message used when the value is not a string
     */
    public $strError;

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
     * @var string preset - one of the preset constants,
     * @see $_presets
     * If this is not null, the preset parameters will override 
     * the validator level params
     */
    public $preset;

    /**
     * @var string presets configuration source file
     * defaults to [[presets.php]] in the current directory
     */
    public $presetsSource;

    /**
     * @var array the target strength rule requirements that will
     * be evaluated for displaying the strength meter
     */
    public $strengthTarget = [
        'min' => 8,
        'lower' => 3,
        'upper' => 3,
        'digit' => 3,
        'special' => 3,
    ];

    /**
     * @var array the list of inbuilt presets and their parameter settings
     */
    private $_presets;

    /**
     * @var array the default rule settings
     */
    private static $_rules = [
        self::RULE_MIN => [
            'msg' => '{attribute} should contain at least {required} ({found} found)',
            'int' => true
        ],
        self::RULE_MAX => [
            'msg' => '{attribute} should contain at most {required} ({found} found)',
            'int' => true
        ],
        self::RULE_LEN => [
            'msg' => '{attribute} should contain exactly {required} ({found} found)',
            'int' => true
        ],
        self::RULE_USER => [
            'msg' => '{attribute} cannot contain the username',
            'bool' => true
        ],
        self::RULE_EMAIL => [
            'msg' => '{attribute} cannot contain an email address',
            'match' => '/^([\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+\.)*[\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+@((((([a-z0-9]{1}[a-z0-9\-]{0,62}[a-z0-9]{1})|[a-z])\.)+[a-z]{2,6})|(\d{1,3}\.){3}\d{1,3}(\:\d{1,5})?)$/i',
            'bool' => true
        ],
        self::RULE_LOW => [
            'msg' => '{attribute} should contain at least {required} ({found} found)',
            'title' => 'lower case',
            'match' => '![a-z]!',
            'int' => true
        ],
        self::RULE_UP => [
            'msg' => '{attribute} should contain at least {required} ({found} found)',
            'title' => 'upper case',
            'match' => '![A-Z]!',
            'int' => true
        ],
        self::RULE_NUM => [
            'msg' => '{attribute} should contain at least {required} ({found} found)',
            'title' => 'numeric / digit',
            'match' => '![\d]!',
            'int' => true
        ],
        self::RULE_SPL => [
            'msg' => '{attribute} should contain at least {required} ({found} found)',
            'title' => 'special',
            'match' => '![\W]!',
            'int' => true
        ]
    ];

    /**
     * Initialize the validator component
     */
    public function init() {
        $this->applyPreset();
        $this->checkParams();
        $this->setRuleMessages();
    }

    /**
     * Sets the rule message for each rule
     */
    protected function setRuleMessages() {
        if ($this->strError === null) {
            $this->strError = Yii::t('app', '{attribute} must be a string.');
        }
        foreach (self::$_rules as $rule => $setup) {
            $param = "{$rule}Error";
            if ($this->$rule !== null) {
                $title = empty($setup['title']) ? ' ' : $setup['title'] . ' ';
                $required = ($this->$rule == 1) ? "one {$title}character" : "{$this->$rule} {$title}characters";
                $message = (!isset($this->$param) || $this->$param === null) ? $setup['msg'] : $this->$param;
                $this->$param = Yii::t('app', $message, ['required' => $required]);
            }
        }
    }

    /**
     * Apply preset parameter if set
     * @return void
     * @throws InvalidConfigException if [[preset]] value is invalid.
     */
    protected function applyPreset() {
        if (!$this->preset) {
            return;
        }
        if (!isset($this->presetsSource)) {
            $this->presetsSource = __DIR__ . '/presets.php';
        }
        $this->_presets = require($this->presetsSource);

        if (array_key_exists($this->preset, $this->_presets)) {
            foreach ($this->_presets[$this->preset] As $param => $value) {
                $this->$param = $value;
            }
        }
        else {
            throw new InvalidConfigException("Invalid preset '{$this->preset}'.");
        }
    }

    /**
     * Validates the provided parameters for valid data type
     * and the right threshold for 'max' chars.
     * @throw InvalidConfigException if validation is invalid
     */
    protected function checkParams() {
        foreach (self::$_rules as $rule => $setup) {
            if (isset($this->$rule) && !empty($setup['int']) && $setup['int'] &&
                    (!is_int($this->$rule) || $this->$rule < 0)) {
                throw new InvalidConfigException("The property '{$rule}' must be a positive integer.");
            }
            if (isset($this->$rule) && !empty($setup['bool']) && $setup['bool'] &&
                    !is_bool($this->$rule)) {
                throw new InvalidConfigException("The property '{$rule}' must be either true or false.");
            }
        }
        if (isset($this->max)) {
            $chars = $this->lower + $this->upper + $this->digit + $this->special;
            if ($chars > $this->max) {
                throw new InvalidConfigException("Total number of required characters {$chars} is greater than maximum allowed {$this->max}. Validation is impossible!");
            }
        }
    }

    /**
     * Validation of the attribute
     * @param Model $object
     * @param string $attribute
     */
    public function validateAttribute($object, $attribute) {
        $value = $object->$attribute;
        if (!is_string($value)) {
            $this->addError($object, $attribute, $this->strError);
            return;
        }
        $label = $object->getAttributeLabel($attribute);
        $username = $object[$this->userAttribute];
        $temp = [];

        foreach (self::$_rules as $rule => $setup) {
            $param = "{$rule}Error";
            if ($rule === self::RULE_USER && $this->hasUser && strpos($value, $username) > 0) {
                $this->addError($object, $attribute, $this->$param, ['attribute' => $label]);
            }
            elseif ($rule === self::RULE_EMAIL && $this->hasEmail && preg_match($setup['match'], $value, $matches)) {
                $this->addError($object, $attribute, $this->$param, ['attribute' => $label]);
            }
            elseif (!empty($setup['match']) && $rule !== self::RULE_EMAIL  && $rule !== self::RULE_USER) {
                $title = empty($setup['title']) ? '' : $setup['title'];
				$count = preg_match_all($setup['match'], $value, $temp);
				if ($count < $this->$rule) {
					$this->addError($object, $attribute, $this->$param, [
						'attribute' => $label,
						'title' => $title,
						'found' => $count
					]);
				}
            }
            else {
                $length = strlen($value);
                $test = false;

                if ($rule === self::RULE_LEN) {
                    $test = ($length !== $this->$rule);
                }
                elseif ($rule === self::RULE_MIN) {
                    $test = ($length < $this->$rule);
                }
                elseif ($rule === self::RULE_MAX) {
                    $test = ($length > $this->$rule);
                }

                if ($this->$rule !== null && $test) {
                    $this->addError($object, $attribute, $this->$param, [
                        'attribute' => $label . ' (' . $rule . ' , ' . $this->$rule . ')',
                        'found' => $length
                    ]);
                }
            }
        }
    }

    /**
     * Client validation
     * @param Model $object
     * @param string $attribute
     * @param View $view
     * @return string javascript method
     */
    public function clientValidateAttribute($object, $attribute, $view) {
        $label = $object->getAttributeLabel($attribute);
        $options = ['strError' => Html::encode(Yii::t('app', $this->message, ['attribute' => $label]))];
        $options['userField'] = '#' . Html::getInputId($object, $this->userAttribute);

        foreach (self::$_rules as $rule => $setup) {
            $param = "{$rule}Error";
            if ($this->$rule !== null) {
                $title = empty($setup['title']) ? '' : $setup['title'];
                $options[$rule] = $this->$rule;
                $options[$param] = Html::encode(Yii::t('app', $this->$param, [
                                    'attribute' => $label,
                                    'title' => $title
                ]));
            }
        }
        StrengthValidatorAsset::register($view);
        return "checkStrength(value, messages, " . Json::encode($options) . ");";
    }

}
