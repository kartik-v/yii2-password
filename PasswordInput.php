<?php

/**
 * @package   yii2-password
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2015
 * @version   1.5.3
 */

namespace kartik\password;

use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\base\InvalidConfigException;

/**
 * PasswordInput widget is a wrapper for the JQuery Strength meter plugin by Krajee.
 * The plugin converts a password input into a widget with an advanced strength
 * validation meter and toggle mask to show/hide the password. The password strength
 * is validated as you type.
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 * @see http://plugins.krajee.com/strength-meter
 */
class PasswordInput extends \kartik\base\InputWidget
{
    /**
     * @var string the password strength meter language. If not provided or
     * no translation is available, this will default to `en` (US English).
     */
    public $language;

    /**
     * @var string the password input size. Defaults to medium size ('md').
     * Can be set 'lg' for large size or 'sm' for small size.
     */
    public $size = 'md';

    /**
     * @var string the toggle mask placement with respect to the password input.
     * Should be 'left' or 'right'. Defaults to 'right'.
     */
    public $togglePlacement = 'right';

    /**
     * Initializes the widget
     *
     * @throw InvalidConfigException
     */
    public function init()
    {
        parent::init();
        $this->initLanguage();
        if ($this->hasModel()) {
            $this->name = ArrayHelper::remove($this->options, 'name', Html::getInputName($this->model, $this->attribute));
            $this->value = $this->model[$this->attribute];
        }
        echo $this->getInput('passwordInput');
        if (empty($this->pluginOptions['inputTemplate']) && (
                $this->size === 'lg' ||
                $this->size === 'sm' ||
                $this->togglePlacement === 'left')
        ) {
            $this->pluginOptions['inputTemplate'] = $this->renderInputTemplate();
        }
        $this->registerAssets();
    }

    /**
     * Renders the input template
     *
     * @return string
     */
    protected function renderInputTemplate()
    {
        $class = 'input-group';
        $content = '{input}<span class="input-group-addon">{toggle}</span>';
        if ($this->size === 'lg' || $this->size === 'sm') {
            $class .= ' input-group-' . $this->size;
        }
        if ($this->togglePlacement === 'left') {
            $content = '<span class="input-group-addon">{toggle}</span>{input}';
        }
        return "<div class='{$class}'>{$content}</div>";
    }

    /**
     * Registers the needed assets
     */
    public function registerAssets()
    {
        $view = $this->getView();
        $locale = "js/locales/strength-meter-{$this->language}.js";
        $path = Yii::getAlias("@vendor/kartik-v/strength-meter/{$locale}");
        if (!empty($this->language) && file_exists($path)) {
            PasswordInputAsset::register($view)->js[] = $locale;
        } else {
            PasswordInputAsset::register($view);
        }
        $this->registerPlugin('strength');
    }
}