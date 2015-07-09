<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\CodeValidator;

use IDCI\Bundle\CodeGeneratorBundle\CodeGenerator\CodeValidatorInterface;

interface CodeValidatorRegistryInterface
{
    /**
     * Sets an code Validator identify by a alias.
     *
     * @param string                 $alias         The code Validator alias.
     * @param CodeValidatorInterface $codeValidator The code Validator.
     *
     * @return CodeValidatorRegistryInterface
     */
    public function setCodeValidator($alias, CodeValidatorInterface $codeValidator);

    /**
     * Returns code Validators.
     *
     * @return array
     */
    public function getCodeValidators();

    /**
     * Returns an code Validator by alias.
     *
     * @param string $alias The code Validator alias.
     *
     * @return CodeValidatorRegistryInterface
     *
     * @throws \IDCI\Bundle\CodeGeneratorBundle\Exception\UnexpectedTypeException if the passed alias is not a string.
     * @throws \InvalidArgumentException if the code Validator can not be retrieved.
     */
    public function getCodeValidator($alias);

    /**
     * Returns whether the given code Validator is supported.
     *
     * @param string $alias The alias of the code Validator.
     *
     * @return bool Whether the code Validator is supported.
     */
    public function hasCodeValidator($alias);
}