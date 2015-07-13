<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\CodeGenerator;

use IDCI\Bundle\CodeGeneratorBundle\CodeGeneratorConfigurator\CodeGeneratorConfigurator;

class MtRandCodeGenerator implements CodeGeneratorInterface
{
    /**
     * {@inheritDoc}
     */
    public function generate(CodeGeneratorConfigurator $configurator)
    {
        $chartsetString = $configurator->getFullCharactersSet();
        $stringLength = strlen($chartsetString);
        $code = '';
        for ($codeLength = 1; $codeLength <= $configurator->getRandomLength(); $codeLength++) {
            $nb = mt_rand(0, ($stringLength - 1));
            $code = sprintf("%s%s", $code, $chartsetString[$nb]);
        }

        return $code;
    }
}