<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2013
 * @package yii2-password
 * @version 1.0.0
 */

namespace kartik\password;

use yii\web\AssetBundle;

/**
 * Asset bundle for StrengthValidator
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class StrengthValidatorAsset extends AssetBundle {

    public $depends = [
        'yii\web\JqueryAsset'
    ];

    public function init() {
        $this->sourcePath = __DIR__ . '/../assets';
        $this->js = YII_DEBUG ? ['js/strength-validation.js'] : ['js/strength-validation.min.js'];
        parent::init();
    }

}
