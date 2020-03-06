<?php

/**
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\Validation;

use Symfony\Component\OptionsResolver\OptionsResolver;
use IDCI\Bundle\CodeGeneratorBundle\Validation\CodeValidatorInterface;

class NoCodeValidator implements CodeValidatorInterface
{
    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver;
    }

    /**
     * {@inheritDoc}
     */
    public function validate($code, array $options = array())
    {
        return true;
    }
}
