<?php

namespace Databases\OsPosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OsposItemKits
 *
 * @ORM\Table(name="ospos_item_kits")
 * @ORM\Entity
 */
class OsposItemKits
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="item_id", type="integer", nullable=false)
     */
    private $itemId = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="kit_discount_percent", type="decimal", precision=15, scale=2, nullable=false)
     */
    private $kitDiscountPercent = '0.00';

    /**
     * @var boolean
     *
     * @ORM\Column(name="price_option", type="boolean", nullable=false)
     */
    private $priceOption = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="print_option", type="boolean", nullable=false)
     */
    private $printOption = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="item_kit_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $itemKitId;



    /**
     * Set name
     *
     * @param string $name
     *
     * @return OsposItemKits
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
     * Set itemId
     *
     * @param integer $itemId
     *
     * @return OsposItemKits
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;

        return $this;
    }

    /**
     * Get itemId
     *
     * @return integer
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * Set kitDiscountPercent
     *
     * @param string $kitDiscountPercent
     *
     * @return OsposItemKits
     */
    public function setKitDiscountPercent($kitDiscountPercent)
    {
        $this->kitDiscountPercent = $kitDiscountPercent;

        return $this;
    }

    /**
     * Get kitDiscountPercent
     *
     * @return string
     */
    public function getKitDiscountPercent()
    {
        return $this->kitDiscountPercent;
    }

    /**
     * Set priceOption
     *
     * @param boolean $priceOption
     *
     * @return OsposItemKits
     */
    public function setPriceOption($priceOption)
    {
        $this->priceOption = $priceOption;

        return $this;
    }

    /**
     * Get priceOption
     *
     * @return boolean
     */
    public function getPriceOption()
    {
        return $this->priceOption;
    }

    /**
     * Set printOption
     *
     * @param boolean $printOption
     *
     * @return OsposItemKits
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
     * Set description
     *
     * @param string $description
     *
     * @return OsposItemKits
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
     * Get itemKitId
     *
     * @return integer
     */
    public function getItemKitId()
    {
        return $this->itemKitId;
    }
}
