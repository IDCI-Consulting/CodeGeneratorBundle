<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\CodeGenerator;

interface CodeValidatorInterface
{
    /**
     * Validate generated codes
     *
     * @param array() $codes
     * @return mixed : the false codes if any, else true
     */
    public function validate(array $codes);
}