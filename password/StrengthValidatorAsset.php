<?php

namespace kartik\password;

use yii\web\AssetBundle;


/**
 * Asset bundle for StrengthValidator
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class StrengthValidatorAsset extends AssetBundle {
    public $sourcePath = '@vendor/kartik-v/yii2-password/kartik/assets';
    public $depends = [
        'yii\web\JqueryAsset'
    ];
	public function init() {
		$this->js = YII_DEBUG ? ['js/strength-validation.js'] : ['js/strength-validation.min.js'];
		parent::init();
	}
}
