<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\Validation;

use IDCI\Bundle\CodeGeneratorBundle\Exception\UnexpectedTypeException;

class CodeValidatorRegistry implements CodeValidatorRegistryInterface
{
    /**
     * @var array
     */
    protected $codeValidators = array();

    /**
     * {@inheritDoc}
     */
    public function setCodeValidator(CodeValidatorInterface $codeValidator, $alias)
    {
        $this->codeValidators[$alias] = $codeValidator;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getCodeValidators()
    {
        return $this->codeValidators;
    }

    /**
     * {@inheritDoc}
     */
    public function getCodeValidator($alias)
    {
        if (!is_string($alias)) {
            throw new UnexpectedTypeException($alias, 'string');
        }
        if (!isset($this->codeValidators[$alias])) {
            throw new \InvalidArgumentException(sprintf('Could not load code validator "%s"', $alias));
        }

        return $this->codeValidators[$alias];
    }

    /**
     * {@inheritDoc}
     */
    public function hasCodeValidator($alias)
    {
        if (!isset($this->codeValidators[$alias])) {
            return true;
        }

        return false;
    }
}
