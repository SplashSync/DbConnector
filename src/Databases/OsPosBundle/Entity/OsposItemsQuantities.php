<?php

namespace Databases\OsPosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Databases\OsPosBundle\Entity\OsposItems;
use Databases\OsPosBundle\Entity\OsposStockLocations;

/**
 * OsposItemsTaxes
 *
 * @ORM\Entity
 * @ORM\Table(
 *          name="ospos_item_quantities",
 *          uniqueConstraints={ @ORM\UniqueConstraint( columns={"item_id", "location_id"} ) }
 *      )
 * 
 * @ORM\HasLifecycleCallbacks
 * 
 */
class OsposItemsQuantities
{
    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity = 0;

    /**
     * @var OsposStockLocations
     * 
     * @ORM\Id
     * @ORM\Column(name="location_id", type="integer") 
     */
    private $location;

    /**
     * @var int
     * 
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE") 
     * @ORM\Column(name="item_id", type="integer") 
     */
    private $item_id;
    
    /**
     * @var OsposItems
     * 
     * @ORM\ManyToOne(targetEntity="Databases\OsPosBundle\Entity\OsposItems", inversedBy="stocks")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="item_id")
     */
    private $item;

    /**
     * Set Quantity
     *
     * @param   int     $Quantity
     *
     * @return self
     */
    public function setQuantity($Quantity)
    {
        $this->quantity = $Quantity;

        return $this;
    }

    /**
     * Get Quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }


    /**
     * Set item
     *
     * @param OsposItems $item
     *
     * @return self
     */
    public function setItem(OsposItems $item)
    {
        $this->item     =   $item;
        $this->item_id  =   $item->getId();
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
     * Set Location Id
     *
     * @param OsposItems $Location
     *
     * @return self
     */
    public function setLocation($Location)
    {
        $this->location     = $Location;
        return $this;
    }

    /**
     * Get Location Id
     *
     * @return int
     */
    public function getLocation()
    {
        return $this->location;
    }    
    
    
    /**
     * Set item id
     *
     * @param int $ItemId
     *
     * @return OsposItemsTaxes
     */
    public function setItemId($ItemId)
    {
        $this->item_id     = $ItemId;
        return $this;
    }

    /**
     * Get item id
     *
     * @return OsposItems
     */
    public function getItemId()
    {
        return $this->item_id;
    }
    
}
