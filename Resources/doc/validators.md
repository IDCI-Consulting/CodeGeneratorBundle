Validators
==========

To ensure a generated code is unique, you can add your own validator.
For example, you might need to check a code does not already exist in a database.

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
    public function validate($code, CodeValidatorContext $context)
    {
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

The CodeGeneratorManager will automatically validate the generated codes with all the tagged validators
