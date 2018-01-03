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

/**
 * @abstract    OsPos Product Stock Trait
 */
trait ItemStocksTrait {

//    /**
//     * @var int
//     * 
//     * @ORM\ManyToMany(targetEntity="Databases\OsPosBundle\Entity\OsposStockLocations", inversedBy="item")
//     * @ORM\JoinTable(name="ospos_item_quantities",
//     *   joinColumns={
//     *     @ORM\JoinColumn(name="item_id", referencedColumnName="item_id")
//     *   },
//     *   inverseJoinColumns={
//     *     @ORM\JoinColumn(name="location_id", referencedColumnName="location_id")
//     *   }
//     * )
//     * 
//     */
//    private $stocks;
    
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
     * Set Stock
     *
     * @param int $level
     *
     * @return OsposItems
     */
    public function setStock($level)
    {
        $this->stock = $level;

        return $this;
    }

    /**
     * Get Stock
     *
     * @return integer
     */
    public function getStock()
    {
        return $this->stock;
    }
    
    
}
