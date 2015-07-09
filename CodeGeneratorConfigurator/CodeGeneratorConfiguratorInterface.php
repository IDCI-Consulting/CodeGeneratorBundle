<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\CodeGenerator;

interface CodeGeneratorConfiguratorInterface
{
    /**
     * Get the full character set
     *
     * @return mixed
     */
    public function getFullCharactersSet();
}