Generators
==========

TODO (What is a generator)


Add a generator
---------------

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