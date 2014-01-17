<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2013
 * @package yii2-password
 * @version 1.0.0
 */

namespace kartik\password;

use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\base\InvalidConfigException;

/**
 * PasswordInput widget generates a password input widget with
 * password mask toggle feature and an advanced strength validation
 * meter. The password strength is validated as you type. The client
 * validation routine for the meter is inspired from passwordmeter.com.
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 * @see http://passwordmeter.com
 */
class PasswordInput extends \yii\widgets\InputWidget {

    /**
     * Placement constants for aligning the meter with respect to the input
     */
    const ALIGN_NONE = 'none';
    const ALIGN_RIGHT = 'right';
    const ALIGN_RIGHT_TEMPLATE = <<< 'EOT'
        <div class="row">
            <div class="col-sm-9">
                {input}
            </div>
            <div class="col-sm-3">
                {meter}
            </div>
        </div>
EOT;

    /**
     * Password meter strength verdicts
     */
    const STRENGTH_0 = 0;
    const STRENGTH_1 = 1;
    const STRENGTH_2 = 2;
    const STRENGTH_3 = 3;
    const STRENGTH_4 = 4;
    const STRENGTH_5 = 5;

    /**
     * @var ActiveForm the form object to which this
     * input will be attached to. This is mandatory. 
     * If not passed an exception will be raised
     */
    public $form;

    /**
     * @var boolean whether to display the strength meter
     */
    public $showMeter = true;

    /**
     * @var array the configuration of various strength verdicts 
     * that will be displayed with the strength meter. The array
     * keys are the verdicts and the array values are the CSS class 
     * and titles that will be used to display each verdict
     */
    public $verdicts = [
        self::STRENGTH_0 => ['class' => 'label label-default', 'title' => 'Too Short'],
        self::STRENGTH_1 => ['class' => 'label label-danger', 'title' => 'Very Weak'],
        self::STRENGTH_2 => ['class' => 'label label-warning', 'title' => 'Weak'],
        self::STRENGTH_3 => ['class' => 'label label-info', 'title' => 'Good'],
        self::STRENGTH_4 => ['class' => 'label label-primary', 'title' => 'Strong'],
        self::STRENGTH_5 => ['class' => 'label label-success', 'title' => 'Very Strong'],
    ];

    /**
     * @var alignment of the password strength meter
     */
    public $placement = self::ALIGN_RIGHT;

    /**
     * @var boolean whether to display a checkbox control
     * for hiding/showing the text within the password
     */
    public $toggleMask = true;

    /**
     * @var array options for the toggle checkbox
     */
    public $toggleOptions = [];

    /**
     * @var string the template for displaying the whole input widget
     * if not using a model the template will just display "{input}\n{meter}\n{hint}"
     * @see initTemplate function
     */
    public $template = "{label}\n{input}\n{meter}\n{error}\n{hint}";

    /**
     * @var string the template for displaying the meter
     * this is used to generate the [[_meter]]  content
     * @see [[initTemplate()]]
     * @see [[_meter]]
     */
    public $meterTemplate = "<div class='kv-scorebar-border'>{bar}\n{score}</div>\n{verdict}";

    /**
     * @var array the HTML options for the password input
     */
    public $options = [];

    /**
     * @var array the HTML options for the strength meter
     * The following special options are recognized:
     * - tag: the tag name of the container element. Defaults to "div".
     */
    public $meterOptions = ['class' => 'kv-meter'];

    /**
     * @var array the HTML options for the strength bar
     * The following special options are recognized:
     * - tag: the tag name of the container element. Defaults to "div".
     */
    public $barOptions = ['class' => 'kv-scorebar'];

    /**
     * @var array the HTML options for the strength score
     * The following special options are recognized:
     * - tag: the tag name of the container element. Defaults to "div".
     */
    public $scoreOptions = ['class' => 'kv-score kv-score-0'];

    /**
     * @var array the HTML options for the strength verdict
     * The following special options are recognized:
     * - tag: the tag name of the container element. Defaults to "div".
     */
    public $verdictOptions = ['class' => 'kv-verdict'];

    /**
     * @var array the HTML options for the widget container
     */
    public $containerOptions = ['class' => 'kv-password'];

    /**
     * @var array the the internalization configuration for this widget
     */
    public $i18n = [];

    /**
     * @var string the generated meter content
     */
    private $_meter = '';

    /**
     * @var array the styled HTML verdicts based on [[verdicts]]
     */
    private $_verdicts = [];

    /**
     * Initializes the widget
     * @throw InvalidConfigException
     */
    public function init() {
        parent::init();
        if (!isset($this->form) || !($this->form instanceof \yii\widgets\ActiveForm)) {
            throw new InvalidConfigException("The 'form' property must be set and must be an object of type 'ActiveForm'.");
        }
        Yii::setAlias('@pwdinput', dirname(__FILE__));
        if (empty($this->i18n)) {
            $this->i18n = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@pwdinput/messages'
            ];
        }
        Yii::$app->i18n->translations['pwdinput'] = $this->i18n;
        $this->toggleOptions['title'] = ArrayHelper::getValue($this->toggleOptions, 'title', Yii::t('pwdinput', 'Show / Hide Password'));
        $this->initVerdicts();
        $this->initTemplate();
        $this->registerAssets();
        echo Html::beginTag('div', $this->containerOptions);
    }

    /**
     * Displays the input
     */
    public function run() {
        echo $this->renderField();
        echo Html::endTag('div');
    }

    /**
     * Initialize styled verdicts
     */
    protected function initVerdicts() {
        foreach ($this->verdicts as $verdict) {
            $this->_verdicts[] = Html::tag('div', Yii::t('pwdinput', $verdict['title']), ['class' => $verdict['class']]);
        }
    }

    /**
     * Initializes the template
     */
    protected function initTemplate() {
        $id = $this->options['id'];
        $this->containerOptions['id'] = "{$id}-widget";
        if ($this->showMeter) {
            /* Generate element ids */
            $this->verdictOptions['id'] = ArrayHelper::getValue($this->verdictOptions, 'id', "{$id}-verdict");
            $this->meterOptions['id'] = ArrayHelper::getValue($this->meterOptions, 'id', "{$id}-meter");
            $this->barOptions['id'] = ArrayHelper::getValue($this->barOptions, 'id', "{$id}-bar");
            $this->scoreOptions['id'] = ArrayHelper::getValue($this->scoreOptions, 'id', "{$id}-score");

            /* Generate meter container */
            $meterTag = ArrayHelper::remove($this->meterOptions, 'tag', 'div');
            $barTag = ArrayHelper::remove($this->barOptions, 'tag', 'div');
            $scoreTag = ArrayHelper::remove($this->scoreOptions, 'tag', 'div');
            $verdictTag = ArrayHelper::remove($this->verdictOptions, 'tag', 'div');

            $meter = strtr($this->meterTemplate, [
                '{bar}' => Html::tag($barTag, '&nbsp;', $this->barOptions),
                '{score}' => Html::tag($scoreTag, '0%', $this->scoreOptions),
                '{verdict}' => Html::tag($verdictTag, $this->_verdicts[0], $this->verdictOptions),
            ]);
            $this->_meter = Html::tag($meterTag, $meter, $this->meterOptions);
            if ($this->placement === self::ALIGN_RIGHT) {
                $this->template = "{label}\n" . self::ALIGN_RIGHT_TEMPLATE . "\n{error}\n{hint}";
            }
        }
    }

    /**
     * Renders the password input field
     */
    protected function renderField() {
        $id = $this->options['id'];
        $this->template = strtr($this->template, [
            '{meter}' => $this->_meter,
        ]);
        if ($this->toggleMask) {
            $this->toggleOptions['id'] = ArrayHelper::getValue($this->toggleOptions, 'id', "{$id}-tog");
            $this->toggleOptions['onchange'] = 'togPwdMask("#' .
                    $id . '", "#' .
                    $this->toggleOptions['id'] . '")';
            if ($this->form instanceof \kartik\widgets\ActiveForm) {
                $toggle = Html::tag('span', Html::checkbox($this->toggleOptions['id'], false, $this->toggleOptions));
                return $this->form->field($this->model, $this->attribute, ['template' => $this->template, 'addon' => ['append' => ['content' => $toggle]]])->passwordInput($this->options);
            }

            $toggle = Html::tag('span', Html::checkbox($this->toggleOptions['id'], false, $this->toggleOptions), ['class' => 'input-group-addon']);
            $this->template = strtr($this->template, [
                '{input}' => '<div class="input-group">{input}' . $toggle . '</div>'
            ]);
        }
        return $this->form->field($this->model, $this->attribute, ['template' => $this->template])->passwordInput($this->options);
    }

    /**
     * Registers the needed assets
     */
    public function registerAssets() {
        $view = $this->getView();
        PasswordInputAsset::register($view);
        if ($this->showMeter) {
            $params = Json::encode([
                        'elPwd' => "#" . $this->options['id'],
                        'elBar' => "#" . $this->barOptions['id'],
                        'elScore' => "#" . $this->scoreOptions['id'],
                        'elVerdict' => "#" . $this->verdictOptions['id'],
                        'verdicts' => $this->_verdicts
            ]);
            $this->options['onkeyup'] = "checkPwd(this.value, {$params})";
            $js = "initMeter({$params})";
            $view->registerJs($js);
        }
    }

}
