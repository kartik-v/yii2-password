<?php
namespace kartik\password;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\base\InvalidConfigException;

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
	/* Preset constants to align the meter with respect to the input */
	const ALIGN_RIGHT = 'right';
	const ALIGN_NONE = 'none';

	/* Constants for the strengths to be displayed */
	const STRENGTH_0 = 'Too Short';
	const STRENGTH_1 = 'Very Weak';
	const STRENGTH_2 = 'Weak';
	const STRENGTH_3 = 'Good';
	const STRENGTH_4 = 'Strong';
	const STRENGTH_5 = 'Very Strong';
	
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
	 * that will be displayed with the strength meter
	 */
	 public $verdicts = [
		self::STRENGTH_0 => 'label label-default',
		self::STRENGTH_1 => 'label label-danger',
		self::STRENGTH_2 => 'label label-warning',
		self::STRENGTH_3 => 'label label-info',
		self::STRENGTH_4 => 'label label-primary',
		self::STRENGTH_5 => 'label label-success',
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
	public $toggleOptions = ['title' => 'Show / Hide Password'];
	
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
	public $inputOptions = [];

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
	public $scoreOptions = ['class' => 'kv-score'];

	/**
 	 * @var array the HTML options for the strength verdict
	 * The following special options are recognized:
	 * - tag: the tag name of the container element. Defaults to "div".
	 */
	public $verdictOptions = ['class' => 'kv-verdict'];

	/**
 	 * @var array the HTML options for the entire widget
	 */
	public $options = ['class' => 'kv-password'];
	
	/**
 	 * @var string the generated input id
	 */	
	private $_inputId;
	
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
		/* Generate styled verdicts */
		foreach ($this->verdicts as $verdict => $class) {
			$this->_verdicts[] = "<div class='{$class}'>{$verdict}</div>";
		}
		$this->initTemplate();
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
		if ($this->showMeter) {
			/* Generate element ids */
			$this->_inputId = Html::getInputId($this->model, $this->attribute);
			$this->verdictOptions['id'] = ArrayHelper::getValue($this->verdictOptions, 'id', "{$this->_inputId}-verdict");
			$this->meterOptions['id'] = ArrayHelper::getValue($this->meterOptions, 'id', "{$this->_inputId}-meter");
			$this->barOptions['id'] = ArrayHelper::getValue($this->barOptions, 'id', "{$this->_inputId}-bar");
			$this->scoreOptions['id'] = ArrayHelper::getValue($this->scoreOptions, 'id', "{$this->_inputId}-score");
			$this->options['id'] = ArrayHelper::getValue($this->options, 'id', "{$this->_inputId}-widget");
			
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
			if ($this->placement == self::ALIGN_RIGHT) {
				$adjusted = <<< EOT
					<div class="row">
						<div class="col-sm-9">
							{input}
						</div>
						<div class="col-sm-3">
							{meter}
						</div>
					</div>
EOT;
				$this->template = "{label}\n{$adjusted}\n{error}\n{hint}";
			}
		}
	}
	
	/**
 	 * Renders the password input field
	 */
	protected function renderField() {
		$this->template = strtr($this->template, [
			'{meter}' => $this->_meter,
		]);
		if ($this->toggleMask) {
			$this->toggleOptions['id'] = ArrayHelper::getValue($this->toggleOptions, 'id', "{$this->_inputId}-tog");
			$this->toggleOptions['onchange'] = 'togPwdMask("#' . 
				$this->_inputId . '", "#' . 
				$this->toggleOptions['id'] . '")';
			if ($this->form instanceof \kartik\widgets\ActiveForm) {
				$toggle = Html::tag('span', Html::checkbox($this->toggleOptions['id'], false, $this->toggleOptions));
				return $this->form->field($this->model, $this->attribute, ['template'=>$this->template, 'addon' => ['type' => 'append', 'content' => $toggle]])->passwordInput($this->inputOptions);
			}
			
			$toggle = Html::tag('span', Html::checkbox($this->toggleOptions['id'], false, $this->toggleOptions), ['class' => 'input-group-addon']);
			$this->template = strtr($this->template, [
				'{input}' => '<div class="input-group">{input}' . $toggle . '</div>'
			]);
		}
		return $this->form->field($this->model, $this->attribute, ['template'=>$this->template])->passwordInput($this->inputOptions);
	}
	
	/**
	 * Registers the needed assets
	 */
	public function registerAssets()
	{
		$view = $this->getView();
		PasswordInputAsset::register($view);
		
		if ($this->showMeter) {
			$check = 'checkPwd("#' . 
				$this->_inputId . '", "#' . 
				$this->barOptions['id'] . '", "#' . 
				$this->scoreOptions['id'] . '", "#' . 
				$this->verdictOptions['id'] . '", ' .
				Json::encode($this->_verdicts) . ')';
			$reset = 'initPwdChk("#' . 
				$this->_inputId . '", "#' . 
				$this->barOptions['id'] . '", "#' . 
				$this->scoreOptions['id'] . '", "#' . 
				$this->verdictOptions['id']. '", ' .
				Json::encode($this->_verdicts[0]) . ')';
				
			$js = <<< SCRIPT
				\$('#$this->_inputId').keyup(function() {
					$check;
				});
				\$('#$this->_inputId').closest("form").bind('reset', function() {
					$reset;
				});
SCRIPT;
			$view->registerJs($js);
		}
	}
}
