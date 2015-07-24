<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\Validation;

interface CodeValidatorInterface
{
    /**
     * Validate a code.
     *
     * @param string               $code
     * @param CodeValidatorContext $context
     *
     * @return boolean
     */
    public function validate($code, CodeValidatorContext $context);
}