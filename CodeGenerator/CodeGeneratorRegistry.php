<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\CodeGenerator;

use IDCI\Bundle\CodeGeneratorBundle\Exception\UnexpectedTypeException;

class CodeGeneratorRegistry implements CodeGeneratorRegistryInterface
{
    /**
     * @var array
     */
    protected $codeGenerators;

    /**
     * {@inheritDoc}
     */
    public function setCodeGenerator(CodeGeneratorInterface $codeGenerator, $alias)
    {
        $this->codeGenerators[$alias] = $codeGenerator;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getCodeGenerators()
    {
        return $this->codeGenerators;
    }

    /**
     * {@inheritDoc}
     */
    public function getCodeGenerator($alias)
    {
        if (!is_string($alias)) {
            throw new UnexpectedTypeException($alias, 'string');
        }
        if (!isset($this->codeGenerators[$alias])) {
            throw new \InvalidArgumentException(sprintf('Could not load code generator "%s"', $alias));
        }
        return $this->codeGenerators[$alias];
    }

    /**
     * {@inheritDoc}
     */
    public function hasCodeGenerator($alias)
    {
        if (!isset($this->codeGenerators[$alias])) {
            return true;
        }
        return false;
    }
}
