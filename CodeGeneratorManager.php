<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle;

use IDCI\Bundle\CodeGeneratorBundle\Configuration\CodeGeneratorConfiguratorBuilderInterface;
use IDCI\Bundle\CodeGeneratorBundle\Generation\CodeGeneratorRegistryInterface;
use IDCI\Bundle\CodeGeneratorBundle\Validation\CodeValidatorRegistryInterface;
use IDCI\Bundle\CodeGeneratorBundle\Model\GenerationConfiguration;
use IDCI\Bundle\CodeGeneratorBundle\Exception\InvalidConfigurationException;

class CodeGeneratorManager
{
    /**
     * @var CodeGeneratorConfiguratorBuilderInterface
     */
    private $configuratorBuilder;

    /**
     * @var CodeGeneratorRegistryInterface
     */
    private $generatorRegistry;

    /**
     * @var CodeValidatorRegistryInterface
     */
    private $validatorRegistry;

    /**
     * Constructor.
     *
     * @param CodeGeneratorConfiguratorBuilderInterface $configuratorBuilder
     * @param CodeGeneratorRegistryInterface            $generatorRegistry
     * @param CodeValidatorRegistryInterface            $validatorRegistry
     */
    public function __construct(
        CodeGeneratorConfiguratorBuilderInterface $configuratorBuilder,
        CodeGeneratorRegistryInterface   $generatorRegistry,
        CodeValidatorRegistryInterface   $validatorRegistry
    )
    {
        $this->configuratorBuilder = $configuratorBuilder;
        $this->generatorRegistry   = $generatorRegistry;
        $this->validatorRegistry   = $validatorRegistry;
    }

    /**
     * Generate codes.
     *
     * @param integer                 $quantity       The quantity of codes to generate.
     * @param GenerationConfiguration $configuration  The generation configuration.
     * @param string                  $alias          The generator alias.
     *
     * @return array $codes The generated codes.
     *
     * @throws InvalidConfigurationException
     */
    public function generate($quantity = 42, GenerationConfiguration $configuration = null, $alias = 'random')
    {
        $configuration = null === $configuration ?
            new GenerationConfiguration() :
            $configuration
        ;

        // Build the configurator
        $configurator = $this
            ->configuratorBuilder
            ->build($configuration)
        ;

        // Ensure we can generate as much codes as asked
        if ($quantity > $configurator->getMaxQuantity()) {
            throw new InvalidConfigurationException(sprintf(
                'The asked codes generation quantity `%d` is upper than max quantity of codes that could be generated `%d`',
                $quantity,
                $configurator->getMaxQuantity()
            ));
        }

        // Generates the codes
        $codes = array();
        while (count($codes) < $quantity) {
            $code = $this
                ->generatorRegistry
                ->getCodeGenerator($alias)
                ->generate($configurator)
            ;

            /* TODO: REWORK !
            // validate the code
            $context = new CodeValidatorContext($codes);
            $validators = $this->codeValidatorRegistry->getCodeValidators();
            foreach ($validators as $validator) {
                $success = $validator->validate($code, $context);
                if ($success) {
                    $codes[] = $code;
                }
            }
            */
            $codes[] = $code;
        }

        return $codes;
    }
}
