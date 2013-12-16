 yii2-password
==============

This extension provides a couple of great password management utilities for Yii Framework 2.0. The extension allows password strength validation through your model. In addition, it provides an advanced password input widget, that allows you to display/hide text , calculate strength as you type, and display a dynamic strength meter. The client validation for the meter is based on idea from [password input meter](http://www.passwordmeter.com/) and modified/extended largely for Yii Framework 2.0. Inbuilt Twitter Bootstrap CSS is used to style the widgets.

### StrengthValidator
[```VIEW DEMO```](http://demos.krajee.com/password-details/strength-validator)  
This is a password strength validator for your model attributes. The strength validator allows you to configure the following parameters for validating passwords or strings.

1. Whether password contains an username
2. Whether password contains an email string
3. Minimum number of characters
4. Maximum number of characters
5. Minimum number of lower space characters
6. Minimum number of upper space characters
7. Minimum number of numeric / digit characters
8. Minimum number of special characters

Other features:
1. Includes 5 presets (simple, normal, fair, medium, and strong). Instead of setting each parameter above, you can call a preset which will auto-set each of the parameters above. 
2. It includes both server and client validation. 
3. This can work with the PasswordInput widget (described next) as per your needs. The strength validation routines for both are a bit different. The PasswordInput widget focuses on displaying the strength only, and does not restrict the user input in any way.

> NOTE: The StrengthValidator does not validate if the password field is required. You need to use Yii's ```required``` operator for this.

### PasswordInput
[```VIEW DEMO```](http://demos.krajee.com/password-details/password-input)  
This is a widget, that can be used directly in your forms. It provides these advanced features and functionality:

1. Allows you to show/ hide a password text (using bootstrap styled input addons). You can configure this option to be shown or not.
2. Allows you to display an advanced password strength meter to calculate and show your password strength as you type. 
3. Allows you to control and position/style your meter based on templates.
4. A password strength meter consists of the meter bar, the score, and the verdict.
5. Uses Twitter Bootstrap 3.0 styling wherever possible with inbuilt Yii 2.0 ActiveField functionality.
6. Works independent and complements the StrengthValidator.
7. If needed, it utilizes the advanced features of [\kartik\widgets\ActiveField] from the [yii2-widgets package](https://github.com/kartik-v/yii2-widgets). It does the validation dynamically, if the current ActiveForm is based on kartik\widgets\ActiveForm.

### Demo
You can see a [demonstration here](http://demos.krajee.com/password) on usage of these functions with documentation and examples.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ php composer.phar require kartik-v/yii2-password "dev-master"
```

or add

```
"kartik-v/yii2-password": "dev-master"
```

to the ```require``` section of your `composer.json` file.

## Usage

### StrengthValidator
```php
// add this to your code to your model
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
// add this to your code in your view
use kartik\password\PasswordInput;
use kartik\widgets\ActiveForm; // optional

$form = ActiveForm::begin(['id' => 'login-form']);

echo $form->field($model,'username');
echo PasswordInput::widget([
   	'model' => $model, 
   	'attribute' => 'password',
   	'form' => $form,
   	'showMeter' => true,
]);
```

## License

**yii2-password** is released under the BSD 3-Clause License. See the bundled `LICENSE.md` for details.
