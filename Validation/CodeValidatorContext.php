<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\Validation;

class CodeValidatorContext
{
    /**
     * @var array
     */
    private $codes;

    /**
     * Constructor.
     *
     * @param array $codes
     */
    public function __construct($codes)
    {
        $this->codes = $codes;
    }

    /**
     * Get the codes
     *
     * @return array
     */
    public function getCodes() {

        return $this->codes;
    }

    /**
     * Set codes
     *
     * @param array $codes
     *
     * @return CodeValidatorContext
     */
    public function setCodes($codes)
    {
        $this->codes = $codes;
    }

    /**
     * Add a code
     *
     * @param integer $code
     *
     * @return CodeValidatorContext
     */
    public function addCode($code)
    {
        $this->codes[] = $code;

        return $this;
    }
}