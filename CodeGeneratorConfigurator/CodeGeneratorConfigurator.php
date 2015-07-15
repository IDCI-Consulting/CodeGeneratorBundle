<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\CodeGeneratorConfigurator;

use IDCI\Bundle\CodeGeneratorBundle\Model\GenerationConfiguration;

class CodeGeneratorConfigurator
{
    /**
     * @var GenerationConfiguration
     */
    protected $configuration;

    /**
     * @var array
     */
    protected $charsets;

    /**
     * Constructor
     *
     * @param GenerationConfiguration $configuration
     * @param array $charsets
     */
    public function __construct(GenerationConfiguration $configuration, array $charsets)
    {
        $this->configuration = $configuration;
        $this->charsets = $charsets;
    }

    /**
     * Get the full character set
     *
     * @throws \Exception
     * @return mixed
     */
    public function getFullCharactersSet()
    {
        $fullCharset = '';
        $includedCharsets = $this->configuration->getIncludedCharacterSets();

        foreach ($this->charsets as $key => $value) {
            $isEr = sprintf("is%s", ucfirst($key)); // create the appropriate isEr() function : eg isDigits, isLowercase
            if ($includedCharsets->$isEr()) {
                $fullCharset = sprintf("%s%s", $fullCharset, $value);
            }
        }

        // add extra characters
        $extraCharacters = $this->configuration->getIncludedCharacterSets()->getExtraCharacters();
        foreach ($extraCharacters as $extraCharacter) {
            if (strlen($extraCharacter) !== 1) {
                throw new \Exception(sprintf('%s is an invalid character', $extraCharacter));
            }
            if (strpos($fullCharset, $extraCharacter) === false) {
                $fullCharset = sprintf("%s%s", $fullCharset, $extraCharacter);
            }
        }

        //remove excluded characters
        $excludedCharacters = $this->configuration->getExcludedCharacterSets();
        foreach ($excludedCharacters as $excludedCharacter) {
            if (strlen($excludedCharacter) !== 1) {
                throw new \Exception(sprintf('%s is an invalid character', $excludedCharacter));
            }
            $fullCharset = str_replace($excludedCharacter, '', $fullCharset);
        }

        return $fullCharset;
    }

    /**
     * Get the quantity of code to be generated
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->configuration->getQuantity();
    }

    /**
     * Get a random length between min and max
     *
     * @return int length
     */
    public function getRandomLength()
    {
        return mt_rand(
            $this->configuration->getMinLength(),
            $this->configuration->getMaxLength()
        );
    }

    /**
     * Get the maximum quantity of codes that can be generated
     *
     * Example: a code of 3 to 5 characters with the letters 'abc' -> 3^5 + 3^4+ 3^3
     */
    public function getMaxQuantity()
    {
        $result = 0;
        for ($i = $this->configuration->getMinLength(); $i <= $this->configuration->getMaxLength(); $i++) {
            $result += pow(strlen($this->getFullCharactersSet()), $i);
        }

        return $result;
    }
};