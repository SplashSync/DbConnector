<?php

namespace Databases\OsPosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OsposReceivingsItems
 *
 * @ORM\Table(name="ospos_receivings_items", indexes={@ORM\Index(name="item_id", columns={"item_id"}), @ORM\Index(name="IDX_2071E350C8178241", columns={"receiving_id"})})
 * @ORM\Entity
 */
class OsposReceivingsItems
{
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=30, nullable=true)
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
     * @var integer
     *
     * @ORM\Column(name="item_location", type="integer", nullable=false)
     */
    private $itemLocation;

    /**
     * @var string
     *
     * @ORM\Column(name="receiving_quantity", type="decimal", precision=15, scale=3, nullable=false)
     */
    private $receivingQuantity = '1.000';

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
     * @var \Databases\OsPosBundle\Entity\OsposReceivings
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Databases\OsPosBundle\Entity\OsposReceivings")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="receiving_id", referencedColumnName="receiving_id")
     * })
     */
    private $receiving;



    /**
     * Set description
     *
     * @param string $description
     *
     * @return OsposReceivingsItems
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
     * @return OsposReceivingsItems
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
     * @return OsposReceivingsItems
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
     * @return OsposReceivingsItems
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
     * @return OsposReceivingsItems
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
     * @return OsposReceivingsItems
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
     * Set itemLocation
     *
     * @param integer $itemLocation
     *
     * @return OsposReceivingsItems
     */
    public function setItemLocation($itemLocation)
    {
        $this->itemLocation = $itemLocation;

        return $this;
    }

    /**
     * Get itemLocation
     *
     * @return integer
     */
    public function getItemLocation()
    {
        return $this->itemLocation;
    }

    /**
     * Set receivingQuantity
     *
     * @param string $receivingQuantity
     *
     * @return OsposReceivingsItems
     */
    public function setReceivingQuantity($receivingQuantity)
    {
        $this->receivingQuantity = $receivingQuantity;

        return $this;
    }

    /**
     * Get receivingQuantity
     *
     * @return string
     */
    public function getReceivingQuantity()
    {
        return $this->receivingQuantity;
    }

    /**
     * Set line
     *
     * @param integer $line
     *
     * @return OsposReceivingsItems
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
     * @return OsposReceivingsItems
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
     * Set receiving
     *
     * @param \Databases\OsPosBundle\Entity\OsposReceivings $receiving
     *
     * @return OsposReceivingsItems
     */
    public function setReceiving(\Databases\OsPosBundle\Entity\OsposReceivings $receiving)
    {
        $this->receiving = $receiving;

        return $this;
    }

    /**
     * Get receiving
     *
     * @return \Databases\OsPosBundle\Entity\OsposReceivings
     */
    public function getReceiving()
    {
        return $this->receiving;
    }
}
