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
    protected $validators;

    /**
     * {@inheritDoc}
     */
    public function setCodeValidator(CodeValidatorInterface $codeValidator, $alias)
    {
        $this->validators[$alias] = $codeValidator;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getCodeValidators()
    {
        return $this->validators;
    }

    /**
     * {@inheritDoc}
     */
    public function getCodeValidator($alias)
    {
        if (!is_string($alias)) {
            throw new UnexpectedTypeException($alias, 'string');
        }
        if (!isset($this->validators[$alias])) {
            throw new \InvalidArgumentException(sprintf('Could not load validator "%s"', $alias));
        }

        return $this->validators[$alias];
    }

    /**
     * {@inheritDoc}
     */
    public function hasCodeValidator($alias)
    {
        if (!isset($this->validators[$alias])) {
            return true;
        }

        return false;
    }
}
