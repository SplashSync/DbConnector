<?php

/*
 * Copyright (C) 2011-2018  Splash Sync       <contact@splashsync.com>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, USA.
 */

namespace Databases\OsPosBundle\Entity\Products;

use Doctrine\ORM\Mapping as ORM;
use Splash\Bundle\Annotation as SPL;

use Splash\Core\SplashCore  as Splash;

/**
 * @abstract    OsPos Product Stock Trait
 */
trait ItemStocksTrait {

    /**
     * @var int
     * 
     * @SPL\Field(  
     *          id      =   "stock",
     *          type    =   "int",
     *          name    =   "Current Stock",
     *          itemtype=   "http://schema.org/Offer", itemprop="inventoryLevel",
     * )
     * 
     */
    private $stock;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Databases\OsPosBundle\Entity\OsposStockLocations", inversedBy="item", indexBy="locationId")
     * @ORM\JoinTable(name="ospos_item_quantities",
     *   joinColumns={
     *     @ORM\JoinColumn(name="item_id", referencedColumnName="item_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="location_id", referencedColumnName="location_id")
     *   }
     * )
     */
    private $location;    
    
    /**
     * Get Stock
     *
     * @return integer
     */
    private function loadStock()
    {
        //==============================================================================
        // Load Selected Stock Location
        $LocationId     =   Splash::Local()->getWebsite()->getSetting("items_default_location");
        if ( empty($LocationId) ) {
            return Null;
        }
        //==============================================================================
        // Direct Loading of Stock Form Database
        $rawSql = "SELECT * FROM `ospos_item_quantities` WHERE `item_id` = " . $this->itemId . " AND `location_id` = " . $LocationId;
        $stmt = Splash::Local()->getEntityManager()->getConnection()->prepare($rawSql);
        $stmt->execute([]);
        $Results = $stmt->fetch();
        if ( !array_key_exists("quantity", $Results ) ) {
            return Null;
        }

        return (int) $Results["quantity"];
    }
    
    /**
     * Set Stock
     *
     * @param int $level
     *
     * @return OsposItems
     */
    public function setStock($level)
    {
        //==============================================================================
        // Direct Loading of Stock Form Database
        $Stock  =   $this->loadStock();
        //==============================================================================
        // Compare Values
        if ( !is_null($Stock) && ($Stock === $level) ) {
            return $this;   
        }

        //==============================================================================
        // Load Selected Stock Location
        $LocationId     =   Splash::Local()->getWebsite()->getSetting("items_default_location");
        if ( empty($LocationId) ) {
            return $this;
        }
        
        //==============================================================================
        // Create Create Stock Quantity Query
        if (is_null($Stock) ) {
            $rawSql = "INSERT INTO `ospos_item_quantities` (`item_id`, `location_id`, `quantity`) VALUES ('" . $this->itemId . "', '" . $LocationId . "', '" . (float) trim($level) . "');";
        //==============================================================================
        // Create Update Stock Quantity Query
        } else {
            $rawSql = "UPDATE `ospos_item_quantities` SET `quantity` = '" . (float) trim($level) . "' WHERE `ospos_item_quantities`.`item_id` = " . $this->itemId . " AND `ospos_item_quantities`.`location_id` = " . $LocationId . ";";
        }
        //==============================================================================
        // Execute Query
        Splash::Local()->getEntityManager()->getConnection()->prepare($rawSql)->execute([]);
        
        return $this;
    }
    
    /**
     * Get Stock
     *
     * @return integer
     */
    public function getStock()
    {
        //==============================================================================
        // Direct Loading of Stock Form Database
        $Stock  =   $this->loadStock();
        if (is_null($Stock) ) {
            return 0;
        }

        return (int) $Stock;
    }
}
