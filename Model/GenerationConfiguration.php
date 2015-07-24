<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\Model;

class GenerationConfiguration
{
    /**
     * @var integer
     */
    private $minLength;

    /**
     * @var integer
     */
    private $maxLength;

    /**
     * [a-z] characters.
     *
     * @var boolean
     */
    private $lowercase;

    /**
     * [A-Z] characters.
     *
     * @var boolean
     */
    private $uppercase;

    /**
     * [0-9] characters.
     *
     * @var boolean
     */
    private $digits;

    /**
     * [,;.!?] characters.
     *
     * @var boolean
     */
    private $punctuation;

    /**
     * [{}[]()] characters.
     *
     * @var boolean
     */
    private $brackets;

    /**
     * Space character.
     *
     * @var boolean
     */
    private $space;

    /**
     * Special characters.
     *
     * @var boolean
     */
    private $specialCharacters;

    /**
     * Extra characters.
     *
     * @var array()
     */
    private $extraCharacters;

    /**
     * @var array()
     */
    private $excludedCharacters;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this
            ->setMinLength(4)
            ->setMaxLength(8)
            ->setLowercase(true)
            ->setUppercase(true)
            ->setDigits(true)
            ->setPunctuation(true)
            ->setBrackets(false)
            ->setSpace(false)
            ->setSpecialCharacters(false)
            ->setExtraCharacters(array())
            ->setExcludedCharacters(array())
        ;
    }

    /**
     * Get min length.
     *
     * @return int
     */
    public function getMinLength()
    {
        return $this->minLength;
    }

    /**
     * Set min Length.
     *
     * @param int $minLength
     *
     * @return GenerationConfiguration
     */
    public function setMinLength($minLength)
    {
        $this->minLength = $minLength;

        return $this;
    }

    /**
     * Get max length.
     *
     * @return int
     */
    public function getMaxLength()
    {
        return $this->maxLength;
    }

    /**
     * Set max length.
     *
     * @param int $maxLength
     *
     * @return GenerationConfiguration
     */
    public function setMaxLength($maxLength)
    {
        $this->maxLength = $maxLength;

        return $this;
    }

    /**
     * Is lowercase.
     *
     * @return boolean
     */
    public function isLowercase()
    {
        return $this->lowercase;
    }

    /**
     * Set lowercase.
     *
     * @param boolean $lowercase
     *
     * @return GenerationConfiguration
     */
    public function setLowercase($lowercase)
    {
        $this->lowercase = $lowercase;

        return $this;
    }

    /**
     * Is uppercase.
     *
     * @return boolean
     */
    public function isUppercase()
    {
        return $this->uppercase;
    }

    /**
     * Set uppercase.
     *
     * @param boolean $uppercase
     *
     * @return GenerationConfiguration
     */
    public function setUppercase($uppercase)
    {
        $this->uppercase = $uppercase;

        return $this;
    }

    /**
     * Is digits.
     *
     * @return boolean
     */
    public function isDigits()
    {
        return $this->digits;
    }

    /**
     * Set digits.
     *
     * @param boolean $digits
     *
     * @return GenerationConfiguration.
     */
    public function setDigits($digits)
    {
        $this->digits = $digits;

        return $this;
    }

    /**
     * Is punctuation.
     *
     * @return boolean
     */
    public function isPunctuation()
    {
        return $this->punctuation;
    }

    /**
     * Set punctuation.
     *
     * @param boolean $punctuation
     *
     * @return GenerationConfiguration
     */
    public function setPunctuation($punctuation)
    {
        $this->punctuation = $punctuation;

        return $this;
    }

    /**
     * Is brackets.
     *
     * @return boolean
     */
    public function isBrackets()
    {
        return $this->brackets;
    }

    /**
     * Set brackets.
     *
     * @param boolean $brackets
     *
     * @return GenerationConfiguration
     */
    public function setBrackets($brackets)
    {
        $this->brackets = $brackets;

        return $this;
    }

    /**
     * Is space.
     *
     * @return boolean
     */
    public function isSpace()
    {
        return $this->space;
    }

    /**
     * Set space.
     *
     * @param boolean $space
     *
     * @return GenerationConfiguration
     */
    public function setSpace($space)
    {
        $this->space = $space;

        return $this;
    }

    /**
     * Is special characters.
     *
     * @return boolean
     */
    public function isSpecialCharacters()
    {
        return $this->specialCharacters;
    }

    /**
     * Set special characters.
     *
     * @param boolean $specialCharacters
     *
     * @return GenerationConfiguration
     */
    public function setSpecialCharacters($specialCharacters)
    {
        $this->specialCharacters = $specialCharacters;

        return $this;
    }

    /**
     * Get extra characters.
     *
     * @return array
     */
    public function getExtraCharacters()
    {
        return $this->extraCharacters;
    }

    /**
     * Set extra characters.
     *
     * @param array $extraCharacters
     *
     * @return GenerationConfiguration
     */
    public function setExtraCharacters(array $extraCharacters)
    {
        $this->extraCharacters = $extraCharacters;

        return $this;
    }

    /**
     * Get excluded characters.
     *
     * @return array
     */
    public function getExcludedCharacters()
    {
        return $this->excludedCharacters;
    }

    /**
     * Set excluded characters.
     *
     * @param array $excludedCharacters
     *
     * @return GenerationConfiguration
     */
    public function setExcludedCharacters($excludedCharacters)
    {
        $this->excludedCharacters = $excludedCharacters;

        return $this;
    }
}
