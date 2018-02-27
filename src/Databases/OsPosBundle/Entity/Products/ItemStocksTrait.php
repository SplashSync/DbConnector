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

use Databases\OsPosBundle\Entity\OsposItemsQuantities;
use Databases\OsPosBundle\Entity\OsposInventory;

/**
 * @abstract    OsPos Product Stock Trait
 */
trait ItemStocksTrait {

    /**
     * @var Array
     *
     * @ORM\OneToMany(targetEntity="Databases\OsPosBundle\Entity\OsposItemsQuantities", cascade={"persist", "remove"}, mappedBy="item")
     * 
     * @SPL\Field(  
     *          id      =   "stock",
     *          type    =   "int",
     *          name    =   "Current Stock",
     *          itemtype=   "http://schema.org/Offer", itemprop="inventoryLevel",
     * )
     * 
     */
    private $stocks;
    
    
    /**
     * @var Array
     *
     * @ORM\OneToMany(targetEntity="Databases\OsPosBundle\Entity\OsposInventory", cascade={"persist", "remove"}, mappedBy="transItems")
     * 
     */
    private $inventory;
    
    /**
     * @var OsposInventory
     */
    private $new_inventory;
    
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
        // Load Selected Stock Location
        $StockQuantity =  $this->getStockByLocation();
        //==============================================================================
        // Compare Values
        if ( !empty( $StockQuantity ) && ($StockQuantity->getQuantity() === $level) ) {
            return $this;   
        }        

        //==============================================================================
        // Add Stock Change to Item Inventory
        $this->addInventoryChange($level, $StockQuantity ); 
                
        //==============================================================================
        // Update Stock Quantity Item
        if ( !empty( $StockQuantity ) ) {
            $StockQuantity->setQuantity($level);
            return $this;
        }
            
        //==============================================================================
        // Load Default Stock Location
        if ( empty( Splash::Local()->getWebsite()->getSetting("items_default_location") ) ) {
            Splash::Log()->War("No default Stock Location Selected, Product Stock NOT Updated");
            return $this;
        }

        //==============================================================================
        // Create Stock Quantity Item
        $NewStockQuantity  =   new OsposItemsQuantities();
        $NewStockQuantity
                ->setItem($this)
                ->setLocation(Splash::Local()->getWebsite()->getSetting("items_default_location"))
                ->setQuantity($level)
                ;

        $this->addStockQuantity( $NewStockQuantity );
        
        return $this;
    }
    
    /**
     * Get Stock
     *
     * @return integer
     */
    public function getStock()
    {
        $StockQuantity =  $this->getStockByLocation();
        if ( empty( $StockQuantity ) ) {
            return 0;
        }    
//dump($this->inventory->toArray());
        return $StockQuantity->getQuantity();
    }
    
    /**
     * Get Stock Location
     *
     * @return OsposItemsQuantities | Null
     */
    public function getStockByLocation( $LocationId = Null )
    {
        //==============================================================================
        // Load Selected Stock Location
        if ( is_null($LocationId) ) {
            $LocationId     =   Splash::Local()->getWebsite()->getSetting("items_default_location");
        }        
        if ( empty($LocationId) ) {
            return Null;
        }        
        //==============================================================================
        // Search for Stock Quantity Object
        foreach ($this->stocks as $StockQuantity) {
            if ( $StockQuantity->getLocation() == $LocationId ) {
                return $StockQuantity;
            }
        }
        return Null;
    }
    
    /**
     * Add Items Quantities
     *
     * @param OsposItemsQuantities $ItemsQuantities
     *
     * @return OsposItems
     */
    public function addStockQuantity(OsposItemsQuantities $ItemsQuantities)
    {
        if ( $this->getId() ) {
            $this->stocks[]     = $ItemsQuantities;
        } else {
            $this->new_stocks[] = $ItemsQuantities;
        }
        return $this;
    }

    /**
     * Remove Items Quantities
     *
     * @param OsposItemsQuantities $ItemsQuantities
     */
    public function removeStockQuantity(OsposItemsQuantities $ItemsQuantities)
    {
        $this->stocks->removeElement($ItemsQuantities);
    }    
    
    /**
     * Add Stock Update to Inventory
     *
     * @param int                   $Level              New Stock Value
     * @param OsposItemsQuantities  $ItemsQuantities    Current Stock Quantity
     *
     * @return boid
     */
    public function addInventoryChange($Level, OsposItemsQuantities $ItemsQuantities = Null ) 
    {
        //==============================================================================
        // Evaluate Quantity Change        
        if ( $ItemsQuantities ) {
            $Delta  =  $Level - $ItemsQuantities->getQuantity();  
        } else {
            $Delta  =  $Level;  
        }
        if( !$Delta ) {
            return;
        } 
        //==============================================================================
        // Load WebService User
        if ( empty( Splash::Local()->getWebsite()->getSetting("splash_user") ) ) {
            Splash::Log()->War("No WebService User Selected, Product Inventory NOT Updated");
            return;
        }        
        //==============================================================================
        // Load Default Stock Location
        if ( empty( Splash::Local()->getWebsite()->getSetting("items_default_location") ) ) {
            Splash::Log()->War("No default Stock Location Selected, Product Stock NOT Updated");
            return;
        }
        //==============================================================================
        // Create Inventory Object
        $Inventory  =   new OsposInventory;
        $Inventory
                ->setTransItems($this)
                ->setTransDate(new \DateTime())
                ->setTransLocation(Splash::Local()->getWebsite()->getSetting("items_default_location"))
                ->setTransUser(Splash::Local()->getWebsite()->getSetting("splash_user"))
                ->setTransComment("Updated By Splash Sync")
                ->setTransInventory($Delta)
                ;
        
        if ( $this->getId() ) {
            $this->inventory[]      = $Inventory;
        } else {
            $this->new_inventory    = $Inventory;
        }
    }
}
