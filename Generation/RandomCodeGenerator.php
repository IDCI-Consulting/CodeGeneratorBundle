<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\Generation;

use IDCI\Bundle\CodeGeneratorBundle\Configuration\CodeGeneratorConfigurator;

class RandomCodeGenerator implements CodeGeneratorInterface
{
    /**
     * {@inheritdoc}
     */
    public function generate(CodeGeneratorConfigurator $configurator)
    {
        $code = array();
        $characters = $configurator->getFullCharactersSet();

        $codeLength = $configurator->getRandomLength();
        for ($i = 0; $i < $codeLength; $i++) {
            $code[$i] = $characters[mt_rand(0, (mb_strlen($characters) - 1))];
        }

        return implode('', $code);
    }
}