<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\Exception;

class UnexpectedTypeException extends \InvalidArgumentException
{
    public function __construct($value, $expectedType)
    {
        parent::__construct(sprintf(
            'Expected argument of type "%s", "%s" given',
            $expectedType,
            is_object($value) ? get_class($value) : gettype($value)
        ));
    }
}