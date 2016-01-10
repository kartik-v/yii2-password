Change Log: `yii2-password`
===========================

## Version 1.5.3

**Date:** 10-Jan-2016

- (enh #28): Spaces validation via new properties `allowSpaces` and `allowSpacesError`. 
- (enh #29): Add Simplified Chinese translation
- (enh #30): Add Hungarian Translations
- (enh #31): Fix for short-long language code conflict
- (enh #32): Correct Polish Translations 
- (enh #33): Update Russian Translations
- (enh #34): Enhance StrengthValidator to support `validateValue`
- (enh #35): Model is required to have a username attribute (or userAttribute)
- (enh #36): Add Czech translations
- (enh #37): Enhance code to generate Yii localization messages via config
- (enh #37): Validate username without attribute
    - New `usernameValue` property that will be used without model or `usernameAttribute`. If this is provided the `usernameAttribute` will be skipped.
- Eliminate `StrengthValidator::strError` property (BC Breaking). Use the `StrengthValidator::message` property instead.

## Version 1.5.2

**Date:** 14-Jul-2015

- (enh #27): Add ability to configure multi-language widgets on same page.

## Version 1.5.1

**Date:** 17-Jun-2015

- (enh #22, #23): Updated German Translations.
- Set copyright year to current.
- (enh #24): Improve validation to retrieve the right translation messages folder.
- (bug #25): Fix strength validator callback.
- (enh #26): Set composer ## Version dependencies.

## Version 1.5.0

**Date:** 12-Jan-2015

- (enh #15): Added Portugese Brazilian translations.
- (bug #16): StrengthValidator strpos empty needle error fix.
- (enh #17): StrengthValidator client validation fix when not using username validation.
- Change message file category name to begin with `kv` prefix.
- Code formatting updates as per Yii2 coding style.
- (bug #21): Ensure empty username check when `hasUser` is true.

## Version 1.4.0

**Date:** 20-Nov-2014

- (bug #13): Fix errors in client side validation of patterns (digit, special etc.)
- (enh #14): Enhance strength client validation plugin as a better reusable component.

## Version 1.3.0

**Date:** 10-Nov-2014

- Set dependency on Krajee base components
- Set release to stable


## Version 1.2.0

**Date:** 31-Oct-2014

- (enh #7, enh #11): Validate if translation locale file exists.
- (enh #8): Dutch translations.
- (enh #9): Polish translations.
- (enh #10): Spanish translations.

## Version 1.1.0

**Date:** 28-Feb-2014

- (enh #4): Fix German translations.
- (enh #6): PasswordInput widget now wraps the enhanced [JQuery Strength Meter Plugin](http://github.com/kartik-v/strength-meter). 
- The strength meter validation routines and rendering have been enhanced and offers ability to configure most options, call events, and methods.
- PSR4 alias change

## Version 1.0.0

Initial release