<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\Generation;

use IDCI\Bundle\CodeGeneratorBundle\Exception\UnexpectedTypeException;

class CodeGeneratorRegistry implements CodeGeneratorRegistryInterface
{
    /**
     * @var array
     */
    protected $codeGenerators;

    /**
     * {@inheritdoc}
     */
    public function setCodeGenerator(CodeGeneratorInterface $codeGenerator, $alias)
    {
        $this->codeGenerators[$alias] = $codeGenerator;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCodeGenerators()
    {
        return $this->codeGenerators;
    }

    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
     */
    public function hasCodeGenerator($alias)
    {
        if (!isset($this->codeGenerators[$alias])) {
            return true;
        }

        return false;
    }
}
