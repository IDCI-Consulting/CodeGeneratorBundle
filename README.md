CodeGeneratorBundle
===================

A Symfony2 Bundle to generate unique codes


Installation
------------

Add dependencies in your `composer.json` file:
```json
"require": {
    ...
    "idci/code-generator-bundle": "dev-master"
},
```

Install these new dependencies in your application using composer:
```sh
$ php composer.phar update
```

Register needed bundles in your application kernel:
```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new IDCI\Bundle\CodeGeneratorBundle\IDCICodeGeneratorBundle(),
    );
}
```

Import the bundle configuration:
```yml
# app/config/config.yml

imports:
    - { resource: @IDCICodeGeneratorBundle/Resources/config/config.yml }
```


Documentation
-------------

* [Introduction](Resources/doc/introduction.md)
* [Architecture](Resources/doc/architecture.md)
* [Validators](Resources/doc/validators.md)
* [Generators](Resources/doc/generators.md)


Tests
-----

Install bundle dependencies:
```sh
$ php composer.phar update
```

To execute unit tests:
```sh
$ phpunit --coverage-text


Todo
----

Rename:
CodeGenerator -> Generation
CodeGeneratorConfigurator -> Configuration
CodeValidator -> Validation

End the documentations !

Add UML Schema (display them in architecture.md).
