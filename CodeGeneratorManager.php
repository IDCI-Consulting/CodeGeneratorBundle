<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\Service;

use IDCI\Bundle\CodeGeneratorBundle\CodeGenerator\CodeGeneratorConfiguratorBuilder;
use IDCI\Bundle\CodeGeneratorBundle\CodeGenerator\CodeGeneratorRegistry;
use IDCI\Bundle\CodeGeneratorBundle\CodeGenerator\CodeValidatorInterface;
use IDCI\Bundle\CodeGeneratorBundle\CodeGeneratorConfigurator\CodeGeneratorConfigurator;
use IDCI\Bundle\CodeGeneratorBundle\CodeValidator\CodeValidatorRegistry;
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
        /* @var $configurator CodeGeneratorConfigurator */
        $configurator = $this
            ->codeGeneratorConfiguratorBuilder
            ->build($generationConfiguration)
        ;

        if ($configurator->getQuantity() > $configurator->getMaxQuantity()) {
            throw new \Exception(sprintf(
                'It\'s impossible to generate %d codes. Maximum value is %d',
                $configurator->getQuantity(),
                $configurator->getMaxQuantity()
            ));
        }

        // generates the codes
        $codes = $this
            ->codeGeneratorRegistry
            ->getCodeGenerator($alias)
            ->generate($configurator)
        ;

        // validates the codes
        /**
         * @var $validators CodeValidatorInterface[]
         */
        $validators = $this->codeValidatorRegistry->getCodeValidators();
        foreach ($validators as $validator) {
            $errorCodes = $validator->validate($codes);
            if (is_array($errorCodes)) {
                throw new \Exception('Some codes are not valid');
            }
        }

        return $codes;
    }
}