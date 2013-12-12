yii2-password
=============

This extension is a password input widget for Yii Framework 2.0. It generates a password input with password strength validation by wrapping [jQuery Password Strength Meter for Twitter Bootstrap](https://github.com/ablanco/jquery.pwstrength.bootstrap). This extension extends the [Yii Input Widget](https://github.com/yiisoft/yii2/blob/master/framework/yii/widgets/InputWidget.php) to generate a password input. The widget is styled for Twitter Bootstrap 3.0 and provides rulesets for visually displaying the quality of a users typed in password.

[```VIEW DEMO```](http://demos.krajee.com/password)  

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

```php
// add this to your code to use these classes
use kartik\password\Password;

// without model
echo Password::widget($name, $options);

// with model
echo Password::widget($model, $attribute, $options);
```

## License

**yii2-password** is released under the BSD 3-Clause License. See the bundled `LICENSE.md` for details.
