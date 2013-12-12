<?php
namespace kartik\password;

use yii\web\AssetBundle;

/**
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 */
class PasswordInputAsset extends AssetBundle
{
	public $sourcePath = '@vendor/kartik-v/yii2-password/kartik/assets';
	public $css = [
		'css/pwstrength.css',
	];
	public $js = [
		'js/pwstrength.js',
	];
	public $depends = [
		'yii\web\JqueryAsset',
		'yii\bootstrap\BootstrapAsset',
	];
}
