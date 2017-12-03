<?php

namespace Databases\OsPosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OsposTaxCodes
 *
 * @ORM\Table(name="ospos_tax_codes")
 * @ORM\Entity
 */
class OsposTaxCodes
{
    /**
     * @var string
     *
     * @ORM\Column(name="tax_code_name", type="string", length=255, nullable=false)
     */
    private $taxCodeName = '';

    /**
     * @var boolean
     *
     * @ORM\Column(name="tax_code_type", type="boolean", nullable=false)
     */
    private $taxCodeType = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=false)
     */
    private $city = '';

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255, nullable=false)
     */
    private $state = '';

    /**
     * @var string
     *
     * @ORM\Column(name="tax_code", type="string", length=32)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $taxCode;



    /**
     * Set taxCodeName
     *
     * @param string $taxCodeName
     *
     * @return OsposTaxCodes
     */
    public function setTaxCodeName($taxCodeName)
    {
        $this->taxCodeName = $taxCodeName;

        return $this;
    }

    /**
     * Get taxCodeName
     *
     * @return string
     */
    public function getTaxCodeName()
    {
        return $this->taxCodeName;
    }

    /**
     * Set taxCodeType
     *
     * @param boolean $taxCodeType
     *
     * @return OsposTaxCodes
     */
    public function setTaxCodeType($taxCodeType)
    {
        $this->taxCodeType = $taxCodeType;

        return $this;
    }

    /**
     * Get taxCodeType
     *
     * @return boolean
     */
    public function getTaxCodeType()
    {
        return $this->taxCodeType;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return OsposTaxCodes
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return OsposTaxCodes
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Get taxCode
     *
     * @return string
     */
    public function getTaxCode()
    {
        return $this->taxCode;
    }
}
