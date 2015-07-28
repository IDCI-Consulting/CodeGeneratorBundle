Validators
==========

To ensure a generated code is unique, you can add your own validator.
For example, you might need to check a code does not already exist in a database.

Add a class that implements CodeValidatorInterface:

```php
use IDCI\Bundle\CodeGeneratorBundle\Validation\CodeValidatorInterface;
use IDCI\Bundle\CodeGeneratorBundle\Validation\CodeValidatorContext;

class MyCustomCodeValidator implements CodeValidatorInterface
{
    /**
     * Validate a code
     *
     * @param string $code
     * @return boolean
     */
    public function validate($code)
    {
        // Do your stuff
        // ...
        return true;
    }
}
```

Then register this class as a service with the 'code_validator' tag.

```yml
acme.code_validator.custom:
    class: Acme\Bundle\YourBundle\CodeValidator\MyCustomCodeValidator
    tags:
        - { name: code_validator, alias: code_validator_custom }
```

Now you can use your new validator:

```php
$codes = $this
    ->getContainer()
    ->get('idci_code_generator.manager')
    ->generate(50, $configuration, 'random', array('code_validator_custom')
;
```

You can add as many validators as you want in the array.
Each codes will be tested with each validator before being returned.