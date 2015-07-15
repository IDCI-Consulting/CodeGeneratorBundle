<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle;

use IDCI\Bundle\CodeGeneratorBundle\CodeGeneratorConfigurator\CodeGeneratorConfiguratorBuilder;
use IDCI\Bundle\CodeGeneratorBundle\CodeGenerator\CodeGeneratorRegistry;
use IDCI\Bundle\CodeGeneratorBundle\CodeValidator\CodeValidatorContext;
use IDCI\Bundle\CodeGeneratorBundle\CodeValidator\CodeValidatorRegistry;
use IDCI\Bundle\CodeGeneratorBundle\Exception\InvalidQuantityException;
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
     * Constructor
     *
     * @param CodeGeneratorRegistry            $codeGeneratorRegistry
     * @param CodeValidatorRegistry            $codeValidatorRegistry
     * @param CodeGeneratorConfiguratorBuilder $codeGeneratorConfiguratorBuilder
     */
    public function __construct(
        CodeGeneratorRegistry $codeGeneratorRegistry,
        CodeValidatorRegistry $codeValidatorRegistry,
        CodeGeneratorConfiguratorBuilder $codeGeneratorConfiguratorBuilder
    )
    {
        $this->codeGeneratorRegistry = $codeGeneratorRegistry;
        $this->codeValidatorRegistry = $codeValidatorRegistry;
        $this->codeGeneratorConfiguratorBuilder = $codeGeneratorConfiguratorBuilder;
    }

    /**
     * Generate codes
     *
     * @param string                  $alias
     * @param GenerationConfiguration $generationConfiguration
     * @throws \Exception
     * @return array                  $codes
     */
    public function generate($alias, GenerationConfiguration $generationConfiguration)
    {
        // build the configurator
        $configurator = $this
            ->codeGeneratorConfiguratorBuilder
            ->build($generationConfiguration)
        ;

        // ensure we can generate as much codes as asked
        if ($configurator->getQuantity() > $configurator->getMaxQuantity()) {
            throw new InvalidQuantityException(
                $configurator->getQuantity(),
                $configurator->getMaxQuantity()
            );
        }

        // generates the codes
        $codes = array();
        while (count($codes) < $configurator->getQuantity()) {
            $code = $this
                ->codeGeneratorRegistry
                ->getCodeGenerator($alias)
                ->generate($configurator)
            ;

            // validate the code
            $context = new CodeValidatorContext($codes);
            $validators = $this->codeValidatorRegistry->getCodeValidators();
            foreach ($validators as $validator) {
                $success = $validator->validate($code, $context);
                if ($success) {
                    $codes[] = $code;
                }
            }
        }

        return $codes;
    }
}
