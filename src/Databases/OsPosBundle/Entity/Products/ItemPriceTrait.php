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
use Splash\Models\Objects\PricesTrait;

use Databases\OsPosBundle\Entity\OsposItemsTaxes;

/**
 * @abstract    OsPos Product Unit Price Trait
 */
trait ItemPriceTrait {
    
    use PricesTrait;
    
    /**
     * @var string
     *
     * @ORM\Column(name="unit_price", type="decimal", precision=15, scale=2, nullable=false)
     * 
     * @SPL\Field(  
     *          id      =   "unitprice",
     *          type    =   "price",
     *          name    =   "Unit Price",
     *          itemtype=   "http://schema.org/Product", itemprop="price",
     * )
     * 
     */
    private $unitPrice  = 0.0;
    
    /**
     * @var OsposItemsTaxes
     *
     * @ORM\OneToOne(targetEntity="Databases\OsPosBundle\Entity\OsposItemsTaxes", cascade={"persist", "remove", "merge"})
     * @ORM\JoinColumn(name="item_id", referencedColumnName="item_id")
     */
    private $itemTax1 = Null;

    /**
     * @var OsposItemsTaxes
     *
     * @ORM\OneToOne(targetEntity="Databases\OsPosBundle\Entity\OsposItemsTaxes", cascade={"persist", "remove", "merge"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="item_id", referencedColumnName="item_id")
     * })
     */
    private $itemTax2 = Null;
    
    /**
     * Set unitPrice
     *
     * @param array $Price
     *
     * @return OsposItems
     */
    public function setUnitPrice($Price)
    {
        $this->unitPrice = self::Prices()->TaxExcluded($Price);
        
        //====================================================================//
        // Ensure Tax1 Exists
        if ( empty($this->getItemTax1()) ) {
            $Tax1   =    new OsposItemsTaxes();
            $Tax1
                    ->setItem($this)
                    ->setName("VAT")
                    ->setPercent(0)
                    ;
            $this->setItemTax1($Tax1);
        }
        //====================================================================//
        // Check Value is Modified
        if ( self::Prices()->Compare($Price, $this->getUnitPrice()) ) {
            return $this;
        }
        
        //====================================================================//
        // Update Tax Percents
        $this->getItemTax1()->setPercent(self::Prices()->TaxPercent($Price));
        if ( !empty($this->getItemTax2()) ) {
            $this->getItemTax2()->setPercent(0);
        }

        return $this;
    }

    /**
     * Get unitPrice
     *
     * @return array
     */
    public function getUnitPrice()
    {
        $VAT    =   0;
        
        if ( !empty($this->getItemTax1()) ) {
            $VAT    +=  $this->getItemTax1()->getPercent();
        }
        if ( !empty($this->getItemTax2()) ) {
            $VAT    +=  $this->getItemTax2()->getPercent();
        }
        
//dump($this->getItemTax1());
//exit;
//        return self::Prices()->Encode($this->unitPrice, $VAT, Null, $Code, $Symbol, $Name);
        return self::Prices()->Encode( (double) $this->unitPrice, (double) $VAT, Null, "EUR");
    }

    /**
     * Set itemTax1
     *
     * @param OsposItemsTaxes $itemTax
     *
     * @return OsposItems
     */
    public function setItemTax1($itemTax)
    {
        $this->itemTax1 = $itemTax;

        return $this;
    }

    /**
     * Get itemTax1
     *
     * @return OsposItemsTaxes
     */
    public function getItemTax1()
    {
        return $this->itemTax1;
    }

    /**
     * Set itemTax2
     *
     * @param OsposItemsTaxes $itemTax
     *
     * @return OsposItems
     */
    public function setItemTax2($itemTax)
    {
        $this->itemTax2 = $itemTax;

        return $this;
    }

    /**
     * Get itemTax2
     *
     * @return OsposItemsTaxes
     */
    public function getItemTax2()
    {
        return $this->itemTax2;
    }

    
}
