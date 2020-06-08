<h1 align="center">
    <a href="http://demos.krajee.com" title="Krajee Demos" target="_blank">
        <img src="http://kartik-v.github.io/bootstrap-fileinput-samples/samples/krajee-logo-b.png" alt="Krajee Logo"/>
    </a>
    <br>
    yii2-password
    <hr>
    <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=DTP3NZQ6G2AYU"
       title="Donate via Paypal" target="_blank">
        <img src="http://kartik-v.github.io/bootstrap-fileinput-samples/samples/donate.png" alt="Donate"/>
    </a>
</h1>

[![Stable Version](https://poser.pugx.org/kartik-v/yii2-password/v/stable)](https://packagist.org/packages/kartik-v/yii2-password)
[![Untable Version](https://poser.pugx.org/kartik-v/yii2-password/v/unstable)](https://packagist.org/packages/kartik-v/yii2-password)
[![License](https://poser.pugx.org/kartik-v/yii2-password/license)](https://packagist.org/packages/kartik-v/yii2-password)
[![Total Downloads](https://poser.pugx.org/kartik-v/yii2-password/downloads)](https://packagist.org/packages/kartik-v/yii2-password)
[![Monthly Downloads](https://poser.pugx.org/kartik-v/yii2-password/d/monthly)](https://packagist.org/packages/kartik-v/yii2-password)
[![Daily Downloads](https://poser.pugx.org/kartik-v/yii2-password/d/daily)](https://packagist.org/packages/kartik-v/yii2-password)

This extension provides a couple of great password management utilities for Yii Framework 2.0. The extension allows password strength validation through your model. In addition, it provides an advanced password input widget, that allows you to display/hide text and show the password strength.

### Release Changes
Refer the [CHANGE LOG](https://github.com/kartik-v/yii2-password/blob/master/CHANGE.md) for details of various releases.

### Prerequisites

- Ensure you have the right version of jQuery loaded (> v1.9.0).
- In case you are upgrading from an older release, its recommended that you clean up your web assets, local browser cache, and restart your browsers before using the extension.

### StrengthValidator
[```VIEW DEMO```](http://demos.krajee.com/password-details/strength-validator)  
This is a password strength validator for your model attributes. The strength validator allows you to configure the following parameters for validating passwords or strings.

1. Whether password contains an username
2. Whether password contains an email string
3. Minimum number of characters
4. Maximum number of characters
5. Whether spaces are allowed
6. Minimum number of lower space characters
7. Minimum number of upper space characters
8. Minimum number of numeric / digit characters
9. Minimum number of special characters
10. Whether password is compromised and part of [Have I Been Pwned](https://haveibeenpwned.com/) lists.

Other features:

1. Includes 5 presets (simple, normal, fair, medium, and strong). Instead of setting each parameter above, you can call a preset which will auto-set each of the parameters above. 
2. It includes both server and client validation. 
3. This can work with the PasswordInput widget (described next) as per your needs. The strength validation routines for both are a bit different. The PasswordInput widget focuses on displaying the strength only, and does not restrict the user input in any way.

> NOTE: The StrengthValidator does not validate if the password field is required. You need to use Yii's ```required``` rule for this.

### PasswordInput
[```VIEW DEMO```](http://demos.krajee.com/password-details/password-input)  
This is an advanced password input widget with configurable options and a dynamic strength meter based on the [Strength Meter JQuery Plugin](http://plugins.krajee.com/strength-meter) by Krajee. The widget provides various features as mentioned below:

1. Allows you to show/ hide a password text (using bootstrap styled input addons). You can configure this option to be shown or not.
2. Allows you to display an advanced password strength meter to calculate and show your password strength as you type. 
3. Allows you to control and position/style your meter based on templates.
4. A password strength meter consists of the meter bar, the score, and the verdict.
5. Uses Bootstrap 3.0 styling wherever possible with inbuilt Yii 2.0 ActiveField functionality.
6. Works independent and complements the StrengthValidator.

### Demo
You can see a [demonstration here](http://demos.krajee.com/password) on usage of these functions with documentation and examples.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

> Note: Check the [composer.json](https://github.com/kartik-v/yii2-password/blob/master/composer.json) for this extension's requirements and dependencies. 
Read this [web tip /wiki](http://webtips.krajee.com/setting-composer-minimum-stability-application/) on setting the `minimum-stability` settings for your application's composer.json.

Either run

```
$ php composer.phar require kartik-v/yii2-password "@dev"
```

or add

```
"kartik-v/yii2-password": "@dev"
```

to the ```require``` section of your `composer.json` file.

## Usage

### StrengthValidator
```php
// add this in your model
use kartik\password\StrengthValidator;

// use the validator in your model rules
public function rules() {
    return [
       	[['username', 'password'], 'required'],
       	[['password'], StrengthValidator::className(), 'preset'=>'normal', 'userAttribute'=>'username']
    ];
}
```

### PasswordInput
```php
// add this in your view
use kartik\password\PasswordInput;
use kartik\widgets\ActiveForm; // optional

$form = ActiveForm::begin(['id' => 'login-form']);
echo $form->field($model,'username');
echo $form->field($model, 'password')->widget(PasswordInput::classname(), [
    'pluginOptions' => [
        'showMeter' => true,
        'toggleMask' => false
    ]
]);
```

## License

**yii2-password** is released under the BSD-3-Clause License. See the bundled `LICENSE.md` for details.