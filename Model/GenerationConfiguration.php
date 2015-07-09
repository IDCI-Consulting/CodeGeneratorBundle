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
     * @var GenerationConfigurationIncludedCharacterSets
     */
    private $includedCharacterSets;

    /**
     * @var array()
     */
    private $excludedCharacterSets;

    /**
     * @var integer
     */
    private $quantity;

    /**
     * Get minLength
     *
     * @return int
     */
    public function getMinLength()
    {
        return $this->minLength;
    }

    /**
     * Set minLength
     *
     * @param int $minLength
     */
    public function setMinLength($minLength)
    {
        $this->minLength = $minLength;
    }

    /**Get maxLength
     *
     * @return int
     */
    public function getMaxLength()
    {
        return $this->maxLength;
    }

    /**
     * Set maxLength
     *
     * @param int $maxLength
     */
    public function setMaxLength($maxLength)
    {
        $this->maxLength = $maxLength;
    }

    /**
     * Get includedCharacterSets
     *
     * @return GenerationConfigurationIncludedCharacterSets
     */
    public function getIncludedCharacterSets()
    {
        return $this->includedCharacterSets;
    }

    /**
     * Set includedCharacterSets
     *
     * @param GenerationConfigurationIncludedCharacterSets $includedCharacterSets
     */
    public function setIncludedCharacterSets($includedCharacterSets)
    {
        $this->includedCharacterSets = $includedCharacterSets;
    }

    /**
     * Get excludedCharacterSets
     *
     * @return array
     */
    public function getExcludedCharacterSets()
    {
        return $this->excludedCharacterSets;
    }

    /**
     * Set excludedCharacterSets
     *
     * @param array $excludedCharacterSets
     */
    public function setExcludedCharacterSets($excludedCharacterSets)
    {
        $this->excludedCharacterSets = $excludedCharacterSets;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set quantity
     *
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
}
