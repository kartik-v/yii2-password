<?php

/**
 * @package   yii2-password
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2022
 * @version   1.5.7
 */

namespace kartik\password;

use kartik\base\AssetBundle;

/**
 * Asset bundle for StrengthValidator
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class StrengthValidatorAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->setSourcePath(__DIR__.'/assets');
        $this->setupAssets('js', ['js/strength-validation']);
        parent::init();
    }
}