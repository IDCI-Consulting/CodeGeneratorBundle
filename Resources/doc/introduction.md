Introduction
============

This bundle is useful to generate unique codes according to a configuration.
First you need to define the configuration.

```php
$generationConfiguration = new GenerationConfiguration();

$includedCharacterSets = new GenerationConfigurationIncludedCharacterSets();
$includedCharacterSets
    ->setUppercase(true)
    ->setLowercase(true)
    ->setDigits(true)
    ->setBrackets(false)
    ->setExtraCharacters(array())
    ->setPunctuation(false)
    ->setSpace(false)
    ->setSpecialCharacters(false)
;

$generationConfiguration
    ->setMinLength(5)
    ->setMaxLength(8)
    ->setQuantity(5000)
    ->setExcludedCharacterSets(array())
    ->setIncludedCharacterSets($includedCharacterSets)
;
```

The includedCharacterSets object allows you to specify which characters you want to include in your codes.
The characters for each sets can be over written in the config.yml file.

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

Then you can generates the codes by using the `idci.code_generator_manager`.
You need to pass the generation strategy as well as the configuration.

```php
$codeGenerator = $this->getContainer()->get('idci.code_generator_manager');
$codes = $codeGenerator->generate('code_generator_mtrand', $configuration);
```