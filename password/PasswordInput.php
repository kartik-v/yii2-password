<?php
namespace kartik\password;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
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
 	 * @var object, the active form object
	 */
	public $form;

	/**
 	 * @var string the template for displaying the input widget
	 */
	public $template = "{label}\n{input}\n{verdict}\n{meter}\n{error}\n{hint}";
	
	/**
 	 * @var array the options for the password input
	 */
	public $inputOptions = [];

	/**
 	 * @var array the options for the strength meter
	 */
	public $meterOptions = [];

	/**
 	 * @var array the options for the strength verdict
	 */
	public $verdictOptions = [];

	/**
 	 * @var array the options for the strength errors
	 */
	public $errorOptions = [];
	
	/**
 	 * @var array the options for the widget container
	 */
	public $options = [];

	/**
 	 * @var string the generated input id
	 */	
	private $_inputId;
	
	/**
 	 * @var string the final generated template
	 */	
	private $_template;
	
	/**
 	 * Initializes the widget
	 */	
	public function init() {
		parent::init();
		if (isset($this->form) && !($this->form instanceof \yii\widgets\ActiveForm)) {
			throw new InvalidParamException("The 'form' property must be a object of type 'ActiveForm'.");
		}
		if (isset($this->form) && !$this->hasModel()) {
			throw new InvalidParamException("The 'model' and 'attribute' are mandatory when you pass a 'form' object.");
		}
		$this->initTemplate();
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
 	 * Initializes the template
	 */
	protected function initTemplate() {
		/* Generate element ids */
		$this->_inputId = ($this->hasModel()) ? Html::getInputId($this->model, $this->attribute) : $this->name;
		$this->verdictOptions['id'] = ArrayHelper::getValue($this->verdictOptions, 'id', "{$this->_inputId}-verdict");
		$this->meterOptions['id'] = ArrayHelper::getValue($this->meterOptions, 'id', "{$this->_inputId}-meter");
		$this->errorOptions['id'] = ArrayHelper::getValue($this->errorOptions, 'id', "{$this->_inputId}-error");
		$this->options['id'] = ArrayHelper::getValue($this->options, 'id', "{$this->_inputId}-widget");
		
		/* Add classes for each element */
		Html::addCssClass($this->verdictOptions, 'kv-verdict');
		Html::addCssClass($this->meterOptions, 'kv-meter');
		Html::addCssClass($this->errorOptions, 'kv-error');
		Html::addCssClass($this->options, 'kv-password-widget');
		
		$this->_template = strtr($this->template, [
			'{verdict}' => Html::tag('div', '', $this->verdictOptions),
			'{meter}' => Html::tag('div', '', $this->meterOptions),
			'{error}' => Html::tag('div', '{error}', $this->errorOptions),
		]);
	}
	
	/**
 	 * Initializes the password input plugin configuration
	 */
	protected function initPlugin() {
		$this->config['bootstrap3'] = true;
		$this->config['usernameField'] = '#' . (($this->hasModel()) ? Html::getInputId($this->model, $this->userAttribute) : $this->userAttribute);
		$this->config['viewports']['verdict'] = '#' . $this->verdictOptions['id'];
		$this->config['viewports']['progress'] = '#' . $this->meterOptions['id'];
		$this->config['viewports']['errors'] = '#' . $this->errorOptions['id'];
		$this->config['container'] = '#' . $this->options['id'];
		
		$this->config['onKeyUp'] = new JsExpression('function (evt) {
			$(evt.target).pwstrength("outputErrorList");
		}');
		
		$this->setDefault('minChar', 5);
		
		$this->setDefaultError('password_too_short', 'The password is too short');
		$this->setDefaultError('email_as_password', 'Do not use your email as your password');
		$this->setDefaultError('same_as_username', 'Your password cannot contain your username');
			
		$this->setJs('onLoad');
		$this->setJsArr('validationRules');
	}
	
	/**
 	 * Renders the password input field
	 */
	protected function renderField() {
		if (isset($this->form) && ($this->form instanceof \yii\widgets\ActiveForm)) {
			return $this->form->field($this->model, $this->attribute, ['template' => $this->_template])->passwordInput($this->inputOptions);
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
		$config = empty($this->config) ? '' : Json::encode($this->config);
		$js = "jQuery('#{$this->_inputId}').pwstrength({$config});";
		$view = $this->getView();
		PasswordInputAsset::register($view);
		$view->registerJs($js);		
	}
	
	/**
	 * Validate and set default value to config array
	 */
	protected function setDefault($var, $value) {
		if (empty($this->config[$var])) {
			$this->config[$var] =  $value;
		}
	}
	
	
	/**
	 * Validate and set default value to config array
	 */
	protected function setDefaultError($var2, $value) {
		if (empty($this->config['errorMessages'][$var2])) {
			$this->config['errorMessages'][$var2] =  Html::tag('span', $value);
		}
	}
	
	/**
	 * Validate and set js expressions in config array
	 */
	protected function setJs($var) {
		if (!empty($this->config[$var]) && !($this->config[$var] instanceof JsExpression)) {
			$this->config[$var] =  new JsExpression($this->config[$var]);
		}
	}
		
	/**
	 * Validate and set an array of js expressions in config array
	 */
	protected function setJsArr($var) {
		if (!empty($this->config[$var]) && is_array($this->config[$var])) {
			foreach ($this->config[$var] as $key => $value) {
				if (!empty($this->config[$var][$key]) && !($this->config[$var][$key] instanceof JsExpression)) {
					$this->config[$var][$key] =  new JsExpression($this->config[$var][$key]);
				}
			}
		}
	} 
}