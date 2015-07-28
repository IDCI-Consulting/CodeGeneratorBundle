Generators
==========

By adding you own generator, you can change the logic behind the code generation.  
In other words, you can choose the algorithm you want to generate codes from a given configuration.

Add a generator
---------------

Add a class that implements CodeGeneratorInterface:

```php
use IDCI\Bundle\CodeGeneratorBundle\Generation\CodeGeneratorInterface;
use IDCI\Bundle\CodeGeneratorBundle\Configuration\CodeGeneratorConfigurator;

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

Now you can use your new generator:

```php
$codes = $this
    ->getContainer()
    ->get('idci_code_generator.manager')
    ->generate(50, $configuration, 'code_generator_custom')
;
```
