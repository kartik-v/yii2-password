<?php

/**
 * @package   yii2-password
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2022
 * @version   1.5.8
 */

namespace kartik\password;

use Exception;
use kartik\base\InputWidget;
use ReflectionException;
use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * PasswordInput widget is a wrapper for the JQuery Strength meter plugin by Krajee. The plugin converts a password
 * input into a widget with an advanced strength validation meter and toggle mask to show/hide the password. The
 * password strength is validated as you type.
 *
 * For example,
 *
 * ```php
 * // add this in your view
 * use kartik\password\PasswordInput;
 * use kartik\widgets\ActiveForm; // optional
 *
 * $form = ActiveForm::begin(['id' => 'login-form']);
 * echo $form->field($model,'username');
 * echo $form->field($model, 'password')->widget(PasswordInput::classname(), [
 *     'pluginOptions' => [
 *         'showMeter' => true,
 *         'toggleMask' => false
 *     ]
 * ]);
 * ```
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 * @see http://plugins.krajee.com/strength-meter
 */
class PasswordInput extends InputWidget
{
    /**
     * @var string the password strength meter language. If not provided or no translation is available, this will
     * default to `en` (US English).
     */
    public $language;

    /**
     * @var string the password input size. Defaults to medium size ('md'). Can be set 'lg' for large size or 'sm' for
     * small size.
     */
    public $size = 'md';

    /**
     * @var string the toggle mask placement with respect to the password input. Should be 'left' or 'right'. Defaults
     *     to 'right'.
     */
    public $togglePlacement = 'right';

    /**
     * @inheritdoc
     */
    public $pluginName = 'strength';

    /**
     * @inheritdoc
     * @throws ReflectionException
     * @throws Exception
     */
    public function run()
    {
        $this->initLanguage();
        if ($this->hasModel()) {
            $this->name = ArrayHelper::remove(
                $this->options,
                'name',
                Html::getInputName($this->model, $this->attribute)
            );
            $this->value = Html::getAttributeValue($this->model, $this->attribute);
        }
        echo $this->getInput('passwordInput');
        if (empty($this->pluginOptions['inputTemplate'])) {
            $this->pluginOptions['inputTemplate'] = $this->renderInputTemplate();
        }
        $this->registerAssets();
        parent::run();
    }

    /**
     * Renders the input template
     *
     * @return string
     * @throws Exception
     */
    protected function renderInputTemplate()
    {
        $isLeft = $this->togglePlacement === 'left';
        $css = $this->isBs(5) ? 'input-group-text' : 'input-group-addon';
        $tog = '{toggle}';
        if ($this->isBs(4)) {
            $css = $isLeft ? 'input-group-prepend' : 'input-group-append';
            $tog = '<span class="input-group-text">{toggle}</span>';
        }
        $groupOptions = ['class' => 'input-group'];
        $toggle = Html::tag('span', $tog, ['class' => $css]);
        if ($this->size === 'lg' || $this->size === 'sm') {
            Html::addCssClass($groupOptions, 'input-group-'.$this->size);
        }
        $content = $isLeft ? $toggle.'{input}' : '{input}'.$toggle;

        return Html::tag('div', $content, $groupOptions);
    }

    /**
     * Registers the needed assets
     *
     * @throws Exception
     */
    public function registerAssets()
    {
        $view = $this->getView();
        $path = Yii::getAlias("@vendor/kartik-v/strength-meter");
        $this->setLanguage('strength-meter-', $path, 'js/locales');
        if (!empty($this->_langFile)) {
            PasswordInputAsset::register($view)->js[] = $this->_langFile;
        } else {
            PasswordInputAsset::register($view);
        }
        $this->registerPlugin($this->pluginName);
    }
}
