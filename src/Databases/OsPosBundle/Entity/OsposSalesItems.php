<?php

namespace Databases\OsPosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OsposSalesItems
 *
 * @ORM\Table(name="ospos_sales_items", indexes={@ORM\Index(name="sale_id", columns={"sale_id"}), @ORM\Index(name="item_id", columns={"item_id"}), @ORM\Index(name="item_location", columns={"item_location"})})
 * @ORM\Entity
 */
class OsposSalesItems
{
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="serialnumber", type="string", length=30, nullable=true)
     */
    private $serialnumber;

    /**
     * @var string
     *
     * @ORM\Column(name="quantity_purchased", type="decimal", precision=15, scale=3, nullable=false)
     */
    private $quantityPurchased = '0.000';

    /**
     * @var string
     *
     * @ORM\Column(name="item_cost_price", type="decimal", precision=15, scale=2, nullable=false)
     */
    private $itemCostPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="item_unit_price", type="decimal", precision=15, scale=2, nullable=false)
     */
    private $itemUnitPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="discount_percent", type="decimal", precision=15, scale=2, nullable=false)
     */
    private $discountPercent = '0.00';

    /**
     * @var boolean
     *
     * @ORM\Column(name="print_option", type="boolean", nullable=false)
     */
    private $printOption = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="line", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $line;

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
     * @var \Databases\OsPosBundle\Entity\OsposSales
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Databases\OsPosBundle\Entity\OsposSales")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sale_id", referencedColumnName="sale_id")
     * })
     */
    private $sale;

    /**
     * @var \Databases\OsPosBundle\Entity\OsposStockLocations
     *
     * @ORM\ManyToOne(targetEntity="Databases\OsPosBundle\Entity\OsposStockLocations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="item_location", referencedColumnName="location_id")
     * })
     */
    private $itemLocation;



    /**
     * Set description
     *
     * @param string $description
     *
     * @return OsposSalesItems
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set serialnumber
     *
     * @param string $serialnumber
     *
     * @return OsposSalesItems
     */
    public function setSerialnumber($serialnumber)
    {
        $this->serialnumber = $serialnumber;

        return $this;
    }

    /**
     * Get serialnumber
     *
     * @return string
     */
    public function getSerialnumber()
    {
        return $this->serialnumber;
    }

    /**
     * Set quantityPurchased
     *
     * @param string $quantityPurchased
     *
     * @return OsposSalesItems
     */
    public function setQuantityPurchased($quantityPurchased)
    {
        $this->quantityPurchased = $quantityPurchased;

        return $this;
    }

    /**
     * Get quantityPurchased
     *
     * @return string
     */
    public function getQuantityPurchased()
    {
        return $this->quantityPurchased;
    }

    /**
     * Set itemCostPrice
     *
     * @param string $itemCostPrice
     *
     * @return OsposSalesItems
     */
    public function setItemCostPrice($itemCostPrice)
    {
        $this->itemCostPrice = $itemCostPrice;

        return $this;
    }

    /**
     * Get itemCostPrice
     *
     * @return string
     */
    public function getItemCostPrice()
    {
        return $this->itemCostPrice;
    }

    /**
     * Set itemUnitPrice
     *
     * @param string $itemUnitPrice
     *
     * @return OsposSalesItems
     */
    public function setItemUnitPrice($itemUnitPrice)
    {
        $this->itemUnitPrice = $itemUnitPrice;

        return $this;
    }

    /**
     * Get itemUnitPrice
     *
     * @return string
     */
    public function getItemUnitPrice()
    {
        return $this->itemUnitPrice;
    }

    /**
     * Set discountPercent
     *
     * @param string $discountPercent
     *
     * @return OsposSalesItems
     */
    public function setDiscountPercent($discountPercent)
    {
        $this->discountPercent = $discountPercent;

        return $this;
    }

    /**
     * Get discountPercent
     *
     * @return string
     */
    public function getDiscountPercent()
    {
        return $this->discountPercent;
    }

    /**
     * Set printOption
     *
     * @param boolean $printOption
     *
     * @return OsposSalesItems
     */
    public function setPrintOption($printOption)
    {
        $this->printOption = $printOption;

        return $this;
    }

    /**
     * Get printOption
     *
     * @return boolean
     */
    public function getPrintOption()
    {
        return $this->printOption;
    }

    /**
     * Set line
     *
     * @param integer $line
     *
     * @return OsposSalesItems
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
     * Set item
     *
     * @param \Databases\OsPosBundle\Entity\OsposItems $item
     *
     * @return OsposSalesItems
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

    /**
     * Set sale
     *
     * @param \Databases\OsPosBundle\Entity\OsposSales $sale
     *
     * @return OsposSalesItems
     */
    public function setSale(\Databases\OsPosBundle\Entity\OsposSales $sale)
    {
        $this->sale = $sale;

        return $this;
    }

    /**
     * Get sale
     *
     * @return \Databases\OsPosBundle\Entity\OsposSales
     */
    public function getSale()
    {
        return $this->sale;
    }

    /**
     * Set itemLocation
     *
     * @param \Databases\OsPosBundle\Entity\OsposStockLocations $itemLocation
     *
     * @return OsposSalesItems
     */
    public function setItemLocation(\Databases\OsPosBundle\Entity\OsposStockLocations $itemLocation = null)
    {
        $this->itemLocation = $itemLocation;

        return $this;
    }

    /**
     * Get itemLocation
     *
     * @return \Databases\OsPosBundle\Entity\OsposStockLocations
     */
    public function getItemLocation()
    {
        return $this->itemLocation;
    }
}
