<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\CodeValidator;

class ArrayCodeValidator implements CodeValidatorInterface
{
    /**
     * Validate a code
     *
     * @param string $code
     * @param mixed $codes
     * @return boolean
     */
    public function validate($code, $codes = null) {

        if (in_array($code, $codes)) {
            return false;
        }

        return true;
    }
}