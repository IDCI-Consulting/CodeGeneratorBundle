<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\CodeGenerator;

class MtRandCodeGenerator implements CodeGeneratorInterface
{
    /**
     * {@inheritDoc}
     */
    public function generate(CodeGeneratorConfiguratorInterface $configurator)
    {
        for($i = 1; $i <= $configuration->getQuantity(); $i++) {
            $stringLength = strlen($string);
            $code = '';
            for ($u = 1; $u <= $codeLength; $u++) {
                $nb = mt_rand(0, ($stringLength - 1));
                $code .= $string[$nb];
            }
        }
    }
}