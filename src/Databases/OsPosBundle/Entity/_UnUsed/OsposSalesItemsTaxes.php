<?php

namespace Databases\OsPosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OsposSalesItemsTaxes
 *
 * @ORM\Table(name="ospos_sales_items_taxes", indexes={@ORM\Index(name="sale_id", columns={"sale_id"}), @ORM\Index(name="item_id", columns={"item_id"})})
 * @ORM\Entity
 */
class OsposSalesItemsTaxes
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="tax_type", type="boolean", nullable=false)
     */
    private $taxType = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="rounding_code", type="boolean", nullable=false)
     */
    private $roundingCode = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="cascade_tax", type="boolean", nullable=false)
     */
    private $cascadeTax = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="cascade_sequence", type="boolean", nullable=false)
     */
    private $cascadeSequence = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="item_tax_amount", type="decimal", precision=15, scale=4, nullable=false)
     */
    private $itemTaxAmount = '0.0000';

    /**
     * @var integer
     *
     * @ORM\Column(name="line", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $line;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="percent", type="decimal")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $percent;

    /**
     * @var \Databases\OsPosBundle\Entity\OsposSalesItems
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Databases\OsPosBundle\Entity\OsposSalesItems")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sale_id", referencedColumnName="sale_id")
     * })
     */
    private $sale;

    /**
     * @var \Databases\OsPosBundle\Entity\OsposItems
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Databases\OsPosBundle\Entity\OsposItems")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="item_id", referencedColumnName="item_id")
     * })
     */
    private $item;



    /**
     * Set taxType
     *
     * @param boolean $taxType
     *
     * @return OsposSalesItemsTaxes
     */
    public function setTaxType($taxType)
    {
        $this->taxType = $taxType;

        return $this;
    }

    /**
     * Get taxType
     *
     * @return boolean
     */
    public function getTaxType()
    {
        return $this->taxType;
    }

    /**
     * Set roundingCode
     *
     * @param boolean $roundingCode
     *
     * @return OsposSalesItemsTaxes
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
     * Set cascadeTax
     *
     * @param boolean $cascadeTax
     *
     * @return OsposSalesItemsTaxes
     */
    public function setCascadeTax($cascadeTax)
    {
        $this->cascadeTax = $cascadeTax;

        return $this;
    }

    /**
     * Get cascadeTax
     *
     * @return boolean
     */
    public function getCascadeTax()
    {
        return $this->cascadeTax;
    }

    /**
     * Set cascadeSequence
     *
     * @param boolean $cascadeSequence
     *
     * @return OsposSalesItemsTaxes
     */
    public function setCascadeSequence($cascadeSequence)
    {
        $this->cascadeSequence = $cascadeSequence;

        return $this;
    }

    /**
     * Get cascadeSequence
     *
     * @return boolean
     */
    public function getCascadeSequence()
    {
        return $this->cascadeSequence;
    }

    /**
     * Set itemTaxAmount
     *
     * @param string $itemTaxAmount
     *
     * @return OsposSalesItemsTaxes
     */
    public function setItemTaxAmount($itemTaxAmount)
    {
        $this->itemTaxAmount = $itemTaxAmount;

        return $this;
    }

    /**
     * Get itemTaxAmount
     *
     * @return string
     */
    public function getItemTaxAmount()
    {
        return $this->itemTaxAmount;
    }

    /**
     * Set line
     *
     * @param integer $line
     *
     * @return OsposSalesItemsTaxes
     */
    public function setLine($line)
    {
        $this->line = $line;

        return $this;
    }

    /**
     * Get line
     *
     * @return integer
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return OsposSalesItemsTaxes
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
     * Set percent
     *
     * @param string $percent
     *
     * @return OsposSalesItemsTaxes
     */
    public function setPercent($percent)
    {
        $this->percent = $percent;

        return $this;
    }

    /**
     * Get percent
     *
     * @return string
     */
    public function getPercent()
    {
        return $this->percent;
    }

    /**
     * Set sale
     *
     * @param \Databases\OsPosBundle\Entity\OsposSalesItems $sale
     *
     * @return OsposSalesItemsTaxes
     */
    public function setSale(\Databases\OsPosBundle\Entity\OsposSalesItems $sale)
    {
        $this->sale = $sale;

        return $this;
    }

    /**
     * Get sale
     *
     * @return \Databases\OsPosBundle\Entity\OsposSalesItems
     */
    public function getSale()
    {
        return $this->sale;
    }

    /**
     * Set item
     *
     * @param \Databases\OsPosBundle\Entity\OsposItems $item
     *
     * @return OsposSalesItemsTaxes
     */
    public function setItem(\Databases\OsPosBundle\Entity\OsposItems $item)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return \Databases\OsPosBundle\Entity\OsposItems
     */
    public function getItem()
    {
        return $this->item;
    }
}
