<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\Model;

class GenerationConfigurationIncludedCharacterSets
{
    /**
     * [a-z] characters
     *
     * @var boolean
     */
    private $lowercase;

    /**
     * [A-Z] characters
     *
     * @var boolean
     */
    private $uppercase;

    /**
     * [0-9] characters
     *
     * @var boolean
     */
    private $digits;

    /**
     * [,;.!?] characters
     *
     * @var boolean
     */
    private $punctuation;

    /**
     * [{}[]()] characters
     *
     * @var boolean
     */
    private $brackets;

    /**
     * Space character
     *
     * @var boolean
     */
    private $space;

    /**
     * Special characters
     *
     * @var boolean
     */
    private $specialCharacters;

    /**
     * Extra characters
     *
     * @var array()
     */
    private $extraCharacters;

    /**
     * Is lowercase
     *
     * @return boolean
     */
    public function isLowercase()
    {
        return $this->lowercase;
    }

    /**
     * Set lowercase
     *
     * @param boolean $lowercase
     * @return GenerationConfigurationIncludedCharacterSets
     */
    public function setLowercase($lowercase)
    {
        $this->lowercase = $lowercase;

        return $this;
    }

    /**
     * Is uppercase
     *
     * @return boolean
     */
    public function isUppercase()
    {
        return $this->uppercase;
    }

    /**
     * Set uppercase
     *
     * @param boolean $uppercase
     * @return GenerationConfigurationIncludedCharacterSets
     */
    public function setUppercase($uppercase)
    {
        $this->uppercase = $uppercase;

        return $this;
    }

    /**
     * Is digits
     *
     * @return boolean
     */
    public function isDigits()
    {
        return $this->digits;
    }

    /**
     * Set digits
     *
     * @param boolean $digits
     * @return GenerationConfigurationIncludedCharacterSets
     */
    public function setDigits($digits)
    {
        $this->digits = $digits;

        return $this;
    }

    /**
     * Is punctuation
     *
     * @return boolean
     */
    public function isPunctuation()
    {
        return $this->punctuation;
    }

    /**
     * Set punctuation
     *
     * @param boolean $punctuation
     * @return GenerationConfigurationIncludedCharacterSets
     */
    public function setPunctuation($punctuation)
    {
        $this->punctuation = $punctuation;

        return $this;
    }

    /**
     * Is brackets
     *
     * @return boolean
     */
    public function isBrackets()
    {
        return $this->brackets;
    }

    /**
     * Set brackets
     *
     * @param boolean $brackets
     * @return GenerationConfigurationIncludedCharacterSets
     */
    public function setBrackets($brackets)
    {
        $this->brackets = $brackets;

        return $this;
    }

    /**
     * Is space
     *
     * @return boolean
     */
    public function isSpace()
    {
        return $this->space;
    }

    /**
     * Set space
     *
     * @param boolean $space
     * @return GenerationConfigurationIncludedCharacterSets
     */
    public function setSpace($space)
    {
        $this->space = $space;

        return $this;
    }

    /**
     * Is specialCharacters
     *
     * @return boolean
     */
    public function isSpecialCharacters()
    {
        return $this->specialCharacters;
    }

    /**
     * Set specialCharacters
     *
     * @param boolean $specialCharacters
     * @return GenerationConfigurationIncludedCharacterSets
     */
    public function setSpecialCharacters($specialCharacters)
    {
        $this->specialCharacters = $specialCharacters;

        return $this;
    }

    /**
     * Get extraCharacters
     *
     * @return array
     */
    public function getExtraCharacters()
    {
        return $this->extraCharacters;
    }

    /**
     * Set extraCharacters
     *
     * @param array $extraCharacters
     * @return GenerationConfigurationIncludedCharacterSets
     */
    public function setExtraCharacters($extraCharacters)
    {
        $this->extraCharacters = $extraCharacters;

        return $this;
    }


}