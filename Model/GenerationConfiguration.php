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
     * @return GenerationConfiguration
     */
    public function setMinLength($minLength)
    {
        $this->minLength = $minLength;

        return $this;
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
     * @return GenerationConfiguration
     */
    public function setMaxLength($maxLength)
    {
        $this->maxLength = $maxLength;

        return $this;
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
     * @return GenerationConfiguration
     */
    public function setIncludedCharacterSets($includedCharacterSets)
    {
        $this->includedCharacterSets = $includedCharacterSets;

        return $this;
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
     * @return GenerationConfiguration
     */
    public function setExcludedCharacterSets($excludedCharacterSets)
    {
        $this->excludedCharacterSets = $excludedCharacterSets;

        return $this;
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
     * @return GenerationConfiguration
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }
}
