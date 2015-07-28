<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\Configuration;

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
     * Constructor.
     *
     * @param GenerationConfiguration $configuration
     * @param array $charsets
     */
    public function __construct(GenerationConfiguration $configuration, array $charsets)
    {
        $this->configuration = $configuration;
        $this->charsets      = $charsets;

        ksort($this->charsets);
    }

    /**
     * Get the full characters set.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    public function getFullCharactersSet()
    {
        $fullCharacters = '';

        $reflector = new \ReflectionClass($this->configuration);
        foreach ($this->charsets as $category => $characters) {
            $isser = sprintf("is%s", ucfirst($category));
            if ($reflector->hasMethod($isser)) {
                if (call_user_func(array($this->configuration, $isser))) {
                    $fullCharacters .= $characters;
                }
            }
        }

        // Add extra characters
        if (null !== $this->configuration->getExtraCharacters()) {
            foreach (str_split($this->configuration->getExtraCharacters()) as $character) {
                if (mb_strlen($character) !== 1) {
                    throw new \RuntimeException(sprintf('The extra character `%s` is invalid ', $character));
                }

                if (false === strpos($fullCharset, $character)) {
                    $fullCharacters .= $character;
                }
            }
        }

        // Remove excluded characters
        if (null !== $this->configuration->getExcludedCharacters()) {
            foreach (str_split($this->configuration->getExcludedCharacters()) as $character) {
                if (mb_strlen($character) !== 1) {
                    throw new \RuntimeException(sprintf('The excluded character `%s` is invalid ', $character));
                }

                $fullCharacters = str_replace($character, '', $fullCharacters);
            }
        }

        return $fullCharacters;
    }

    /**
     * Get a random length between min and max.
     *
     * @return integer
     */
    public function getRandomLength()
    {
        return mt_rand(
            $this->configuration->getMinLength(),
            $this->configuration->getMaxLength()
        );
    }

    /**
     * Get the maximum quantity of codes that can be generated.
     * Example: a code of 3 to 5 characters with the letters 'abc' -> 3^5 + 3^4+ 3^3
     *
     * @return integer
     */
    public function getMaxQuantity()
    {
        $result = 0;
        for ($i = $this->configuration->getMaxLength(); $i >= $this->configuration->getMinLength(); $i--) {
            $result += pow(mb_strlen($this->getFullCharactersSet()), $i);
        }

        return $result;
    }
};