<?php

namespace Databases\OsPosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Splash\Bundle\Annotation as SPL;

use Databases\OsPosBundle\Entity\Products\ItemPriceTrait;
use Databases\OsPosBundle\Entity\Products\ItemDescriptionTrait;
use Databases\OsPosBundle\Entity\Products\ItemMetaTrait;
use Databases\OsPosBundle\Entity\Products\ItemStocksTrait;

/**
 * OsposItems
 *
 * @ORM\Table(name="ospos_items", uniqueConstraints={@ORM\UniqueConstraint(name="item_number", columns={"item_number"})}, indexes={@ORM\Index(name="supplier_id", columns={"supplier_id"})})
 * @ORM\Entity
 * 
 * @author Splash Sync <contact@splashsync.com>
 * @SPL\Object( type                    =   "Product",
 *              disabled                =   false,
 *              name                    =   "Product",
 *              description             =   "OsPos Product Object",
 *              icon                    =   "fa fa-product-hunt",
 *              enable_push_created     =    false,
 *              enable_push_deleted     =    false,
 *              target                  =   "Databases\OsPosBundle\Entity\OsposItems",
 *              transformer_service     =   "splash.databases.ospos.transformer"
 * )
 * 
 * @ORM\HasLifecycleCallbacks
 * 
 */
class OsposItems
{
    use ItemPriceTrait;
    use ItemDescriptionTrait;
    use ItemMetaTrait;
    use ItemStocksTrait;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=255, nullable=false)
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="item_number", type="string", length=255, nullable=true)
     * 
     * @SPL\Field(  
     *          id      =   "itemNumber",
     *          type    =   "varchar",
     *          name    =   "Reference",
     *          itemtype=   "http://schema.org/Product", itemprop="model",
     *          inlist  =   true,
     * )
     * 
     */
    private $itemNumber;



    /**
     * @var string
     *
     * @ORM\Column(name="cost_price", type="decimal", precision=15, scale=2, nullable=false)
     * 
     * @SPL\Field(  
     *          id      =   "costPrice",
     *          type    =   "double",
     *          name    =   "Cost Price",
     *          itemtype=   "http://schema.org/Product", itemprop="wholesalePrice",
     * )
     * 
     */
    private $costPrice  = 0.0;

    /**
     * @var integer
     *
     * @ORM\Column(name="deleted", type="integer", nullable=false)
     * 
     */
    private $deleted = '0';
    
    /**
     * @var string
     *
     * @ORM\Column(name="reorder_level", type="decimal", precision=15, scale=3, nullable=false)
     */
    private $reorderLevel = '0.000';

    /**
     * @var string
     *
     * @ORM\Column(name="receiving_quantity", type="decimal", precision=15, scale=3, nullable=false)
     */
    private $receivingQuantity = '1.000';

    /**
     * @var string
     *
     * @ORM\Column(name="pic_filename", type="string", length=255, nullable=true)
     */
    private $picFilename;

    /**
     * @var boolean
     *
     * @ORM\Column(name="allow_alt_description", type="boolean", nullable=false)
     */
    private $allowAltDescription = False;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_serialized", type="boolean", nullable=false)
     */
    private $isSerialized = False;

    /**
     * @var boolean
     *
     * @ORM\Column(name="stock_type", type="boolean", nullable=false)
     */
    private $stockType = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="item_type", type="boolean", nullable=false)
     */
    private $itemType = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="tax_category_id", type="integer", nullable=false)
     */
    private $taxCategoryId = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="custom1", type="string", length=255, nullable=true)
     */
    private $custom1;

    /**
     * @var string
     *
     * @ORM\Column(name="custom2", type="string", length=255, nullable=true)
     */
    private $custom2;

    /**
     * @var string
     *
     * @ORM\Column(name="custom3", type="string", length=255, nullable=true)
     */
    private $custom3;

    /**
     * @var string
     *
     * @ORM\Column(name="custom4", type="string", length=255, nullable=true)
     */
    private $custom4;

    /**
     * @var string
     *
     * @ORM\Column(name="custom5", type="string", length=255, nullable=true)
     */
    private $custom5;

    /**
     * @var string
     *
     * @ORM\Column(name="custom6", type="string", length=255, nullable=true)
     */
    private $custom6;

    /**
     * @var string
     *
     * @ORM\Column(name="custom7", type="string", length=255, nullable=true)
     */
    private $custom7;

    /**
     * @var string
     *
     * @ORM\Column(name="custom8", type="string", length=255, nullable=true)
     */
    private $custom8;

    /**
     * @var string
     *
     * @ORM\Column(name="custom9", type="string", length=255, nullable=true)
     */
    private $custom9;

    /**
     * @var string
     *
     * @ORM\Column(name="custom10", type="string", length=255, nullable=true)
     */
    private $custom10;

    /**
     * @var integer
     *
     * @ORM\Column(name="item_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $itemId;

    /**
     * @var \Databases\OsPosBundle\Entity\OsposSuppliers
     *
     * @ORM\ManyToOne(targetEntity="Databases\OsPosBundle\Entity\OsposSuppliers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="supplier_id", referencedColumnName="person_id")
     * })
     */
    private $supplier;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->location     = new \Doctrine\Common\Collections\ArrayCollection();
        $this->stocks       = new \Doctrine\Common\Collections\ArrayCollection();
        $this->itemTaxes    = new \Doctrine\Common\Collections\ArrayCollection();
    }

    //====================================================================//
    // Splash Specific Getters & Setters
    //====================================================================//

    /**
     * get Object Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->getItemId();
    }

    //====================================================================//
    // Simple Getters & Setters
    //====================================================================//
        


    /**
     * Set category
     *
     * @param string $category
     *
     * @return OsposItems
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set itemNumber
     *
     * @param string $itemNumber
     *
     * @return OsposItems
     */
    public function setItemNumber($itemNumber)
    {
        $this->itemNumber = $itemNumber;

        return $this;
    }

    /**
     * Get itemNumber
     *
     * @return string
     */
    public function getItemNumber()
    {
        return $this->itemNumber;
    }


    /**
     * Set costPrice
     *
     * @param string $costPrice
     *
     * @return OsposItems
     */
    public function setCostPrice($costPrice)
    {
        $this->costPrice = $costPrice;

        return $this;
    }

    /**
     * Get costPrice
     *
     * @return string
     */
    public function getCostPrice()
    {
        return $this->costPrice;
    }

    /**
     * Set reorderLevel
     *
     * @param string $reorderLevel
     *
     * @return OsposItems
     */
    public function setReorderLevel($reorderLevel)
    {
        $this->reorderLevel = $reorderLevel;

        return $this;
    }

    /**
     * Get reorderLevel
     *
     * @return string
     */
    public function getReorderLevel()
    {
        return $this->reorderLevel;
    }

    /**
     * Set receivingQuantity
     *
     * @param string $receivingQuantity
     *
     * @return OsposItems
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
     * Set picFilename
     *
     * @param string $picFilename
     *
     * @return OsposItems
     */
    public function setPicFilename($picFilename)
    {
        $this->picFilename = $picFilename;

        return $this;
    }

    /**
     * Get picFilename
     *
     * @return string
     */
    public function getPicFilename()
    {
        return $this->picFilename;
    }

    /**
     * Set allowAltDescription
     *
     * @param boolean $allowAltDescription
     *
     * @return OsposItems
     */
    public function setAllowAltDescription($allowAltDescription)
    {
        $this->allowAltDescription = $allowAltDescription;

        return $this;
    }

    /**
     * Get allowAltDescription
     *
     * @return boolean
     */
    public function getAllowAltDescription()
    {
        return $this->allowAltDescription;
    }

    /**
     * Set isSerialized
     *
     * @param boolean $isSerialized
     *
     * @return OsposItems
     */
    public function setIsSerialized($isSerialized)
    {
        $this->isSerialized = $isSerialized;

        return $this;
    }

    /**
     * Get isSerialized
     *
     * @return boolean
     */
    public function getIsSerialized()
    {
        return $this->isSerialized;
    }

    /**
     * Set stockType
     *
     * @param boolean $stockType
     *
     * @return OsposItems
     */
    public function setStockType($stockType)
    {
        $this->stockType = $stockType;

        return $this;
    }

    /**
     * Get stockType
     *
     * @return boolean
     */
    public function getStockType()
    {
        return $this->stockType;
    }

    /**
     * Set itemType
     *
     * @param boolean $itemType
     *
     * @return OsposItems
     */
    public function setItemType($itemType)
    {
        $this->itemType = $itemType;

        return $this;
    }

    /**
     * Get itemType
     *
     * @return boolean
     */
    public function getItemType()
    {
        return $this->itemType;
    }

    /**
     * Set taxCategoryId
     *
     * @param integer $taxCategoryId
     *
     * @return OsposItems
     */
    public function setTaxCategoryId($taxCategoryId)
    {
        $this->taxCategoryId = $taxCategoryId;

        return $this;
    }

    /**
     * Get taxCategoryId
     *
     * @return integer
     */
    public function getTaxCategoryId()
    {
        return $this->taxCategoryId;
    }

    /**
     * Set deleted
     *
     * @param integer $deleted
     *
     * @return OsposItems
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return integer
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set custom1
     *
     * @param string $custom1
     *
     * @return OsposItems
     */
    public function setCustom1($custom1)
    {
        $this->custom1 = $custom1;

        return $this;
    }

    /**
     * Get custom1
     *
     * @return string
     */
    public function getCustom1()
    {
        return $this->custom1;
    }

    /**
     * Set custom2
     *
     * @param string $custom2
     *
     * @return OsposItems
     */
    public function setCustom2($custom2)
    {
        $this->custom2 = $custom2;

        return $this;
    }

    /**
     * Get custom2
     *
     * @return string
     */
    public function getCustom2()
    {
        return $this->custom2;
    }

    /**
     * Set custom3
     *
     * @param string $custom3
     *
     * @return OsposItems
     */
    public function setCustom3($custom3)
    {
        $this->custom3 = $custom3;

        return $this;
    }

    /**
     * Get custom3
     *
     * @return string
     */
    public function getCustom3()
    {
        return $this->custom3;
    }

    /**
     * Set custom4
     *
     * @param string $custom4
     *
     * @return OsposItems
     */
    public function setCustom4($custom4)
    {
        $this->custom4 = $custom4;

        return $this;
    }

    /**
     * Get custom4
     *
     * @return string
     */
    public function getCustom4()
    {
        return $this->custom4;
    }

    /**
     * Set custom5
     *
     * @param string $custom5
     *
     * @return OsposItems
     */
    public function setCustom5($custom5)
    {
        $this->custom5 = $custom5;

        return $this;
    }

    /**
     * Get custom5
     *
     * @return string
     */
    public function getCustom5()
    {
        return $this->custom5;
    }

    /**
     * Set custom6
     *
     * @param string $custom6
     *
     * @return OsposItems
     */
    public function setCustom6($custom6)
    {
        $this->custom6 = $custom6;

        return $this;
    }

    /**
     * Get custom6
     *
     * @return string
     */
    public function getCustom6()
    {
        return $this->custom6;
    }

    /**
     * Set custom7
     *
     * @param string $custom7
     *
     * @return OsposItems
     */
    public function setCustom7($custom7)
    {
        $this->custom7 = $custom7;

        return $this;
    }

    /**
     * Get custom7
     *
     * @return string
     */
    public function getCustom7()
    {
        return $this->custom7;
    }

    /**
     * Set custom8
     *
     * @param string $custom8
     *
     * @return OsposItems
     */
    public function setCustom8($custom8)
    {
        $this->custom8 = $custom8;

        return $this;
    }

    /**
     * Get custom8
     *
     * @return string
     */
    public function getCustom8()
    {
        return $this->custom8;
    }

    /**
     * Set custom9
     *
     * @param string $custom9
     *
     * @return OsposItems
     */
    public function setCustom9($custom9)
    {
        $this->custom9 = $custom9;

        return $this;
    }

    /**
     * Get custom9
     *
     * @return string
     */
    public function getCustom9()
    {
        return $this->custom9;
    }

    /**
     * Set custom10
     *
     * @param string $custom10
     *
     * @return OsposItems
     */
    public function setCustom10($custom10)
    {
        $this->custom10 = $custom10;

        return $this;
    }

    /**
     * Get custom10
     *
     * @return string
     */
    public function getCustom10()
    {
        return $this->custom10;
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
     * Set supplier
     *
     * @param \Databases\OsPosBundle\Entity\OsposSuppliers $supplier
     *
     * @return OsposItems
     */
    public function setSupplier(\Databases\OsPosBundle\Entity\OsposSuppliers $supplier = null)
    {
        $this->supplier = $supplier;

        return $this;
    }

    /**
     * Get supplier
     *
     * @return \Databases\OsPosBundle\Entity\OsposSuppliers
     */
    public function getSupplier()
    {
        return $this->supplier;
    }

}
