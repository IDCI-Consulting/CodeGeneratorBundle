Introduction
============

This bundle is useful to generate unique codes according to a configuration.
First you need to define the configuration.

```php
$configuration = new GenerationConfiguration();

// Theses are the default values, no need to set them again
$configuration
    ->setMinLength(4)
    ->setMaxLength(8)
    ->setLowercase(true)
    ->setUppercase(true)
    ->setDigits(true)
    ->setPunctuation(true)
    ->setBrackets(false)
    ->setSpace(false)
    ->setSpecialCharacters(false)
    ->setExtraCharacters(null)
    ->setExcludedCharacters(null)
;
```

Then you can generates the codes by using the `idci.code_generator.manager`.
You can override the default quantity, configuration and generation strategy.
 * See the [generators](Resources/doc/generators.md)
part to learn how to add you own generation strategy.
 * See the [validators](Resources/doc/validators.md)
part to learn how to add a validator.

```php
$generatorAlias = 'random';
$validators = array();
$codes = $this
    ->getContainer()
    ->get('idci_code_generator.manager')
    ->generate(60, $configuration, $generatorAlias, $validators)
;
```

The characters for each sets can be overwritten in the config.yml file.

```yml
# Theses are the default values, no need to set them again
idci_code_generator:
    charsets:
        uppercase: 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
        lowercase: 'abcdefghijklmnopqrstuvwxyz'
        digits: '0123456789'
        punctuation: ',?!:;.'
        brackets: '{}[]()'
        space: ' '
        special_characters: ''
```
