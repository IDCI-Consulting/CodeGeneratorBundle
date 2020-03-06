<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\Validation;

use Symfony\Component\OptionsResolver\OptionsResolver;

interface CodeValidatorInterface
{
    /**
     * Sets the default options.
     *
     * @param OptionsResolver $resolver The options resolver.
     */
    public function setDefaultOptions(OptionsResolver $resolver);

    /**
     * Validate a code.
     *
     * @param string $code    The generated code to validate.
     * @param array  $options The validator options to use.
     *
     * @return boolean
     */
    public function validate($code, array $options = array());
}
