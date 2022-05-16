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
 * Asset bundle for the [[PasswordInput]] widget.
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class PasswordInputAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->setSourcePath('@vendor/kartik-v/strength-meter');
        $this->setupAssets('css', ['css/strength-meter']);
        $this->setupAssets('js', ['js/strength-meter']);
        parent::init();
    }
}