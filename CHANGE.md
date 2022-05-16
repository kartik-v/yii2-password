Change Log: `yii2-password`
===========================

## Version 1.5.7

**Date:** 16-May-2022

- PHP 8.1 enhancements for native functions.
- (enh #79): Enhancement to input group addons for Bootstrap 5.x.

## Version 1.5.6

**Date:** 15-Jun-2020

- (bug #73, #74): Validate `haveIBeenPwned` correctly and default to `false` for BC.

## Version 1.5.5

**Date:** 08-Jun-2020

- (enh #72): Add support to check password in haveibeenpwned.com online lists.
- (enh #71): Correct German Translations.
- (bug #70): Correct `allowSpaces`.
- (bug #69): Correct code bug (multiple and conditions). 
- (enh #66, #67, #68): Correct `allowSpaces`. 

## Version 1.5.4    

**Date:** 07-Sep-2018

- Add github contribution and issue/PR log templates.
- Updates for Bootstrap v4.x.
- Reorganize source code in `src` directory.
- (enh #61): Update Russian Translations. 
- (enh #60): Add Greek Translations. 
- (enh #58): Add Ukranian Translations. 
- (enh #56): Update Portugese BR Translations. 
- (enh #54): Add Lithuanian Translations. 
- (enh #53): Add Vietnamese Translations. 
- (enh #49): Correct Html::getAttributeValue. 
- (enh #45): Add Traditional Chinese Translations. 
- (enh #44): Add Estonian Translations. 
- (enh #42): Add Serbian Translations. 
- (enh #39): Update Spanish Translations.

## Version 1.5.3

**Date:** 10-Jan-2016

- (enh #37): Enhance code to generate Yii localization messages via config
- (enh #37): Validate username without attribute
    - New `usernameValue` property that will be used without model or `usernameAttribute`. If this is provided the `usernameAttribute` will be skipped.
- Eliminate `StrengthValidator::strError` property (BC Breaking). Use the `StrengthValidator::message` property instead.
- (enh #36): Add Czech translations
- (enh #35): Model is required to have a username attribute (or userAttribute)
- (enh #34): Enhance StrengthValidator to support `validateValue`
- (enh #33): Update Russian Translations
- (enh #32): Correct Polish Translations 
- (enh #31): Fix for short-long language code conflict
- (enh #30): Add Hungarian Translations
- (enh #29): Add Simplified Chinese translation
- (enh #28): Spaces validation via new properties `allowSpaces` and `allowSpacesError`. 

## Version 1.5.2

**Date:** 14-Jul-2015

- (enh #27): Add ability to configure multi-language widgets on same page.

## Version 1.5.1

**Date:** 17-Jun-2015

- (enh #26): Set composer ## Version dependencies.
- (bug #25): Fix strength validator callback.
- (enh #24): Improve validation to retrieve the right translation messages folder.
- Set copyright year to current.
- (enh #22, #23): Updated German Translations.

## Version 1.5.0

**Date:** 12-Jan-2015

- (bug #21): Ensure empty username check when `hasUser` is true.
- Code formatting updates as per Yii2 coding style.
- Change message file category name to begin with `kv` prefix.
- (enh #17): StrengthValidator client validation fix when not using username validation.
- (bug #16): StrengthValidator strpos empty needle error fix.
- (enh #15): Added Portugese Brazilian translations.

## Version 1.4.0

**Date:** 20-Nov-2014

- (enh #14): Enhance strength client validation plugin as a better reusable component.
- (bug #13): Fix errors in client side validation of patterns (digit, special etc.)

## Version 1.3.0

**Date:** 10-Nov-2014

- Set dependency on Krajee base components
- Set release to stable


## Version 1.2.0

**Date:** 31-Oct-2014

- (enh #10): Spanish translations.
- (enh #9): Polish translations.
- (enh #8): Dutch translations.
- (enh #7, enh #11): Validate if translation locale file exists.

## Version 1.1.0

**Date:** 28-Feb-2014

- (enh #6): PasswordInput widget now wraps the enhanced [JQuery Strength Meter Plugin](http://github.com/kartik-v/strength-meter). 
- (enh #4): Fix German translations.
- The strength meter validation routines and rendering have been enhanced and offers ability to configure most options, call events, and methods.
- PSR4 alias change

## Version 1.0.0

Initial release