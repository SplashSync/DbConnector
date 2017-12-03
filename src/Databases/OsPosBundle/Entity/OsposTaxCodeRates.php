<?php

namespace Databases\OsPosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OsposTaxCodeRates
 *
 * @ORM\Table(name="ospos_tax_code_rates")
 * @ORM\Entity
 */
class OsposTaxCodeRates
{
    /**
     * @var string
     *
     * @ORM\Column(name="tax_rate", type="decimal", precision=15, scale=4, nullable=false)
     */
    private $taxRate = '0.0000';

    /**
     * @var boolean
     *
     * @ORM\Column(name="rounding_code", type="boolean", nullable=false)
     */
    private $roundingCode = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="rate_tax_code", type="string", length=32)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $rateTaxCode;

    /**
     * @var integer
     *
     * @ORM\Column(name="rate_tax_category_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $rateTaxCategoryId;



    /**
     * Set taxRate
     *
     * @param string $taxRate
     *
     * @return OsposTaxCodeRates
     */
    public function setTaxRate($taxRate)
    {
        $this->taxRate = $taxRate;

        return $this;
    }

    /**
     * Get taxRate
     *
     * @return string
     */
    public function getTaxRate()
    {
        return $this->taxRate;
    }

    /**
     * Set roundingCode
     *
     * @param boolean $roundingCode
     *
     * @return OsposTaxCodeRates
     */
    public function setRoundingCode($roundingCode)
    {
        $this->roundingCode = $roundingCode;

        return $this;
    }

    /**
     * Get roundingCode
     *
     * @return boolean
     */
    public function getRoundingCode()
    {
        return $this->roundingCode;
    }

    /**
     * Set rateTaxCode
     *
     * @param string $rateTaxCode
     *
     * @return OsposTaxCodeRates
     */
    public function setRateTaxCode($rateTaxCode)
    {
        $this->rateTaxCode = $rateTaxCode;

        return $this;
    }

    /**
     * Get rateTaxCode
     *
     * @return string
     */
    public function getRateTaxCode()
    {
        return $this->rateTaxCode;
    }

    /**
     * Set rateTaxCategoryId
     *
     * @param integer $rateTaxCategoryId
     *
     * @return OsposTaxCodeRates
     */
    public function setRateTaxCategoryId($rateTaxCategoryId)
    {
        $this->rateTaxCategoryId = $rateTaxCategoryId;

        return $this;
    }

    /**
     * Get rateTaxCategoryId
     *
     * @return integer
     */
    public function getRateTaxCategoryId()
    {
        return $this->rateTaxCategoryId;
    }
}
