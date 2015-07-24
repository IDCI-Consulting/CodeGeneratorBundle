<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle;

use IDCI\Bundle\CodeGeneratorBundle\Configuration\CodeGeneratorConfiguratorBuilder;
use IDCI\Bundle\CodeGeneratorBundle\Generation\CodeGeneratorRegistry;
use IDCI\Bundle\CodeGeneratorBundle\Validation\CodeValidatorContext;
use IDCI\Bundle\CodeGeneratorBundle\Validation\CodeValidatorRegistry;
use IDCI\Bundle\CodeGeneratorBundle\Model\GenerationConfiguration;

class CodeGeneratorManager
{
    /**
     * @var CodeGeneratorRegistry
     */
    private $codeGeneratorRegistry;

    /**
     * @var CodeValidatorRegistry
     */
    private $codeValidatorRegistry;

    /**
     * @var CodeGeneratorConfiguratorBuilder
     */
    private $codeGeneratorConfiguratorBuilder;

    /**
     * Constructor.
     *
     * @param CodeGeneratorRegistry            $codeGeneratorRegistry
     * @param CodeValidatorRegistry            $codeValidatorRegistry
     * @param CodeGeneratorConfiguratorBuilder $codeGeneratorConfiguratorBuilder
     */
    public function __construct(
        CodeGeneratorRegistry            $codeGeneratorRegistry,
        CodeValidatorRegistry            $codeValidatorRegistry,
        CodeGeneratorConfiguratorBuilder $codeGeneratorConfiguratorBuilder
    )
    {
        $this->codeGeneratorRegistry            = $codeGeneratorRegistry;
        $this->codeValidatorRegistry            = $codeValidatorRegistry;
        $this->codeGeneratorConfiguratorBuilder = $codeGeneratorConfiguratorBuilder;
    }

    /**
     * Generate codes.
     *
     * @param string                  $alias          The generator alias.
     * @param GenerationConfiguration $configuration  The generation configuration.
     *
     * @return array $codes The generated codes.
     *
     * @throws InvalidConfigurationException
     */
    public function generate($alias, GenerationConfiguration $configuration)
    {
        // Build the configurator
        $configurator = $this
            ->codeGeneratorConfiguratorBuilder
            ->build($configuration)
        ;

        // Ensure we can generate as much codes as asked (TODO: $configuration->isValid())

        // Generates the codes
        $codes = array();
        while (count($codes) < $configurator->getQuantity()) {
            $code = $this
                ->codeGeneratorRegistry
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
        }

        return $codes;
    }
}
