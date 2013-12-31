<?php

namespace kartik\password;

use yii\web\AssetBundle;

/**
 * Asset bundle for PasswordInput Widget
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class PasswordInputAsset extends AssetBundle {

    public $sourcePath = '@vendor/kartik-v/yii2-password/kartik/assets';
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

	public function init() {
		$this->css = YII_DEBUG ? ['css/strength-meter.css'] : ['css/strength-meter.min.css'];
		$this->js = YII_DEBUG ? ['js/strength-meter.js'] : ['js/strength-meter.min.js'];
		parent::init();
	}
	
}
