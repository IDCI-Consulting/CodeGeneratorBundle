# CodeGeneratorBundle
A Symfony2 Bundle to generate unique codes

Installation
============

Add the package to your composer.json

```sh
composer require idci/code-generator-bundle
```

Add the bundle to the AppKernel.php file

Edit your config.yml file

```yml
idci_code_generator:
    charsets: ~
```

Usage
=====

This bundle is useful to generate unique codes according to a configuration. First you need to define the configuration.

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

Then you can generates the codes by using the `idci.code_generator_manager`. You need to pass the generation strategy as well as the configuration.

```php
$codeGeneratorManager = $this->getContainer()->get('idci.code_generator_manager');
$codes = $codeGeneratorManager->generate('code_generator_mtrand', $configuration);
```

How to add new validators and generation strategies?
====================================================

Add a validator
---------------

To ensure a generated code is unique, you can add your own validator. For example, you might need to check a code does not already exist in a database.

Add a class that implements CodeValidatorInterface:

```php
use IDCI\Bundle\CodeGeneratorBundle\CodeValidator\CodeValidatorInterface;
use IDCI\Bundle\CodeGeneratorBundle\CodeValidator\CodeValidatorContext;

class MyCustomCodeValidator implements CodeValidatorInterface
{
    /**
     * Validate a code
     *
     * @param string $code
     * @param CodeValidatorContext $context : contains the list of codes just previously generated
     * @return boolean
     */
    public function validate($code, CodeValidatorContext $context) {

        // Do your stuff
        // ...
        return true;
    }
}
```

Then register that class as a service with the 'code_validator' tag.

```yml
acme.code_validator.custom:
    class: Acme\Bundle\YourBundle\CodeValidator\MyCustomCodeValidator
    tags:
        - { name: code_validator, alias: code_validator_custom }
```

The codeGeneratorManager will automatically validate the generated codes with all the tagged validators

Add a generation strategy
-------------------------

Add a class that implements CodeGeneratorInterface:

```php
use IDCI\Bundle\CodeGeneratorBundle\CodeGenerator\CodeGeneratorInterface;

class MyCustomCodeGenerator implements CodeGeneratorInterface
{
    /**
     * {@inheritDoc}
     */
    public function generate(CodeGeneratorConfigurator $configurator)
    {
        // You can get the configuration information from the configurator object
        // Do your stuff
        // ...
        return $code;
    }
}
```

Then register that class as a service with the 'code_generator' tag.

```yml
acme.code_generator.custom:
    class: Acme\Bundle\YourBundle\CodeGenerator\MyCustomCodeGenerator
    tags:
        - { name: code_generator, alias: code_generator_custom }
```

Now you can use your strategy this way:

```php
$codeGeneratorManager = $this->getContainer()->get('idci.code_generator_manager');
$codes = $codeGeneratorManager->generate('code_generator_custom', $configuration);
```