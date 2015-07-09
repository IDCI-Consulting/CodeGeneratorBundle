<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\CodeGenerator;

interface CodeGeneratorRegistryInterface
{
    /**
     * Sets an code generator identify by a alias.
     *
     * @param string                 $alias         The code generator alias.
     * @param CodeGeneratorInterface $codeGenerator The code generator.
     *
     * @return CodeGeneratorRegistryInterface
     */
    public function setCodeGenerator($alias, CodeGeneratorInterface $codeGenerator);

    /**
     * Returns code generators.
     *
     * @return array
     */
    public function getCodeGenerators();

    /**
     * Returns an code generator by alias.
     *
     * @param string $alias The code generator alias.
     *
     * @return CodeGeneratorRegistryInterface
     *
     * @throws \IDCI\Bundle\CodeGeneratorBundle\Exception\UnexpectedTypeException if the passed alias is not a string.
     * @throws \InvalidArgumentException if the code generator can not be retrieved.
     */
    public function getCodeGenerator($alias);

    /**
     * Returns whether the given code generator is supported.
     *
     * @param string $alias The alias of the code generator.
     *
     * @return bool Whether the code generator is supported.
     */
    public function hasCodeGenerator($alias);
}