<?php

namespace Databases\OsPosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OsposSalesTaxes
 *
 * @ORM\Table(name="ospos_sales_taxes", indexes={@ORM\Index(name="print_sequence", columns={"sale_id", "print_sequence", "tax_type", "tax_group"})})
 * @ORM\Entity
 */
class OsposSalesTaxes
{
    /**
     * @var string
     *
     * @ORM\Column(name="sale_tax_basis", type="decimal", precision=15, scale=4, nullable=false)
     */
    private $saleTaxBasis;

    /**
     * @var string
     *
     * @ORM\Column(name="sale_tax_amount", type="decimal", precision=15, scale=4, nullable=false)
     */
    private $saleTaxAmount;

    /**
     * @var boolean
     *
     * @ORM\Column(name="print_sequence", type="boolean", nullable=false)
     */
    private $printSequence = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="tax_rate", type="decimal", precision=15, scale=4, nullable=false)
     */
    private $taxRate;

    /**
     * @var string
     *
     * @ORM\Column(name="sales_tax_code", type="string", length=32, nullable=false)
     */
    private $salesTaxCode = '';

    /**
     * @var boolean
     *
     * @ORM\Column(name="rounding_code", type="boolean", nullable=false)
     */
    private $roundingCode = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="sale_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $saleId;

    /**
     * @var integer
     *
     * @ORM\Column(name="tax_type", type="smallint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $taxType;

    /**
     * @var string
     *
     * @ORM\Column(name="tax_group", type="string", length=32)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $taxGroup;



    /**
     * Set saleTaxBasis
     *
     * @param string $saleTaxBasis
     *
     * @return OsposSalesTaxes
     */
    public function setSaleTaxBasis($saleTaxBasis)
    {
        $this->saleTaxBasis = $saleTaxBasis;

        return $this;
    }

    /**
     * Get saleTaxBasis
     *
     * @return string
     */
    public function getSaleTaxBasis()
    {
        return $this->saleTaxBasis;
    }

    /**
     * Set saleTaxAmount
     *
     * @param string $saleTaxAmount
     *
     * @return OsposSalesTaxes
     */
    public function setSaleTaxAmount($saleTaxAmount)
    {
        $this->saleTaxAmount = $saleTaxAmount;

        return $this;
    }

    /**
     * Get saleTaxAmount
     *
     * @return string
     */
    public function getSaleTaxAmount()
    {
        return $this->saleTaxAmount;
    }

    /**
     * Set printSequence
     *
     * @param boolean $printSequence
     *
     * @return OsposSalesTaxes
     */
    public function setPrintSequence($printSequence)
    {
        $this->printSequence = $printSequence;

        return $this;
    }

    /**
     * Get printSequence
     *
     * @return boolean
     */
    public function getPrintSequence()
    {
        return $this->printSequence;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return OsposSalesTaxes
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set taxRate
     *
     * @param string $taxRate
     *
     * @return OsposSalesTaxes
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
     * Set salesTaxCode
     *
     * @param string $salesTaxCode
     *
     * @return OsposSalesTaxes
     */
    public function setSalesTaxCode($salesTaxCode)
    {
        $this->salesTaxCode = $salesTaxCode;

        return $this;
    }

    /**
     * Get salesTaxCode
     *
     * @return string
     */
    public function getSalesTaxCode()
    {
        return $this->salesTaxCode;
    }

    /**
     * Set roundingCode
     *
     * @param boolean $roundingCode
     *
     * @return OsposSalesTaxes
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
     * Set saleId
     *
     * @param integer $saleId
     *
     * @return OsposSalesTaxes
     */
    public function setSaleId($saleId)
    {
        $this->saleId = $saleId;

        return $this;
    }

    /**
     * Get saleId
     *
     * @return integer
     */
    public function getSaleId()
    {
        return $this->saleId;
    }

    /**
     * Set taxType
     *
     * @param integer $taxType
     *
     * @return OsposSalesTaxes
     */
    public function setTaxType($taxType)
    {
        $this->taxType = $taxType;

        return $this;
    }

    /**
     * Get taxType
     *
     * @return integer
     */
    public function getTaxType()
    {
        return $this->taxType;
    }

    /**
     * Set taxGroup
     *
     * @param string $taxGroup
     *
     * @return OsposSalesTaxes
     */
    public function setTaxGroup($taxGroup)
    {
        $this->taxGroup = $taxGroup;

        return $this;
    }

    /**
     * Get taxGroup
     *
     * @return string
     */
    public function getTaxGroup()
    {
        return $this->taxGroup;
    }
}
