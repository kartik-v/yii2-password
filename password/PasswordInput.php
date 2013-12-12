<?php
namespace kartik\password;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\base\InvalidParamException;

/**
 * PasswordInput widget generates a password input with password strength 
 * validation based on jQuery Password Strength Meter for Twitter Bootstrap.
 * @see https://github.com/ablanco/jquery.pwstrength.bootstrap
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 *
 */
class PasswordInput extends \yii\widgets\InputWidget 
{
	/**
 	 * @var string the name of the `username` attribute
	 */
	public $userAttribute = 'username';
	
	/**
 	 * @var array the configuration options for the jQuery pwstrength plugin 
	 * @see https://github.com/ablanco/jquery.pwstrength.bootstrap
	 */
	public $config = [];

	/**
 	 * @var array the active form object
	 */
	public $form;
	
	/**
 	 * @var array the options for the password input
	 */
	public $inputOptions = [];

	/**
 	 * @var array the options for the widget container
	 */
	public $options = [];

	/**
 	 * Initializes the widget
	 */	
	public function init() {
		parent::init();
		$this->initPlugin();
		$this->registerAssets();
		echo Html::beginTag('div', $this->options);
	}
	
	/**
 	 * Displays the input
	 */		
	public function run() {
		echo $this->renderField();
		echo Html::endTag('div');
	}
	
	/**
 	 * Initializes the password input plugin
	 * @throws InvalidParamException
	 */
	protected function initPlugin() {
		if (isset($this->form) && !($this->form instanceof \yii\widgets\ActiveForm)) {
			throw new InvalidParamException("The 'form' property must be a object of type 'ActiveForm'.");
		}
		if (isset($this->form) && !$this->hasModel()) {
			throw new InvalidParamException("The 'model' and 'attribute' are mandatory when you pass a 'form' object.");
		}
		$this->config['bootstrap3'] = true;
		$this->config['usernameField'] = '#' . (($this->hasModel()) ? Html::getInputId($this->model, $this->userAttribute) : $this->userAttribute);
		$this->setJs('onLoad');
		$this->setJs('onKeyUp');
		$this->setJs('container');
		$this->setJsArray('viewports');
		$this->setJsArray('validationRules');
	}
	
	/**
 	 * Renders the password input field
	 */
	protected function renderField() {
		if (isset($this->form) && ($this->form instanceof \yii\widgets\ActiveForm)) {
			return $this->form->field($this->model, $this->attribute)->passwordInput($this->inputOptions);
		}
		if ($this->hasModel()) {
			return Html::activePasswordInput($this->model, $this->attribute, $this->inputOptions);
		}
		return Html::passwordInput($this->name, $this->value, $this->inputOptions);
	}
	
	/**
	 * Registers the needed assets
	 */
	public function registerAssets()
	{
		$config = empty($this->config) ? '' : ',' . Json::encode($this->config);
		$id = ($this->hasModel()) ? Html::getInputId($this->model, $this->attribute) : $this->name;
		$js = <<< SCRIPT
        jQuery(document).ready(function () {
            $("#$id").pwstrength($config);
        });
SCRIPT;
		$view = $this->getView();
		PasswordInputAsset::register($view);
		$view->registerJs($js);		
	}
	
	/**
	 * Validate and set js expressions
	 */
	protected function setJs($var) {
		if (!empty($this->config[$var]) && !($this->config[$var] instanceof JsExpression)) {
			$this->config[$var] =  new JsExpression($this->config[$var]);
		}
	}
	
	
	/**
	 * Validate and set js expressions for an array
	 */
	protected function setJsArray($var) {
		if (!empty($this->config[$var]) && is_array($this->config[$var])) {
			foreach ($this->config[$var] as $key => $value) {
				if (!empty($this->config[$var][$key]) && !($this->config[$var][$key] instanceof JsExpression)) {
					$this->config[$var][$key] =  new JsExpression($this->config[$var][$key]);
				}
			}
		}
	} 
}