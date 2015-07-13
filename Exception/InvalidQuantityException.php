<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\Exception;

class InvalidQuantityException extends \InvalidArgumentException
{
    public function __construct($value, $expectedValue)
    {
        parent::__construct(sprintf(
            'Expected a quantity < to "%s", "%s" given',
            $expectedValue,
            is_object($value) ? get_class($value) : gettype($value)
        ));
    }
}