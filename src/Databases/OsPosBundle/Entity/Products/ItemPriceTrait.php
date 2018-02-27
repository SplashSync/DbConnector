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
use Doctrine\Common\Collections\Collection;

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
     * @var Array
     *
     * @ORM\OneToMany(targetEntity="Databases\OsPosBundle\Entity\OsposItemsTaxes", cascade={"persist", "remove"}, mappedBy="item")
     */
    private $taxes;
   
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
        if ( !$this->getTax(0) ) {
            $Tax1   =    new OsposItemsTaxes();
            $Tax1
                    ->setItem($this)
                    ->setName("VAT")
                    ->setPercent(self::Prices()->TaxPercent($Price))
                    ;
            $this->addTaxes($Tax1);
        }
        //====================================================================//
        // Check Value is Modified
        if ( self::Prices()->Compare($Price, $this->getUnitPrice()) ) {
            return $this;
        }
        
        //====================================================================//
        // Update Tax Percents
        if ( $this->getTax(0) ) {
            $this->getTax(0)->setPercent(self::Prices()->TaxPercent($Price));
        }
        if ( $this->getTax(1) ) {
            $this->getTax(1)->setPercent(0);
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
        //====================================================================//
        // Fetch Items Taxes
        $VAT    =   0;
        if ( $this->getTax(0) ) {
            $VAT    +=  $this->getTax(0)->getPercent();
        }
        if ( $this->getTax(1) ) {
            $VAT    +=  $this->getTax(1)->getPercent();
        }
        //====================================================================//
        // Encode Price Array
        return self::Prices()->Encode( (double) $this->unitPrice, (double) $VAT, Null, "EUR");
    }
    
    /**
     * Add TaxItem
     *
     * @param OsposItemsTaxes $ItemTax
     *
     * @return OsposItems
     */
    public function addTaxes(OsposItemsTaxes $ItemTax)
    {
        if ( $this->getId() ) {
            $this->taxes[]      = $ItemTax;
        } else {
            $this->new_taxes[]  = $ItemTax;
        }
        
        return $this;
    }

    /**
     * Remove TaxItem
     *
     * @param OsposItemsTaxes $ItemTax
     */
    public function removeTaxes(OsposItemsTaxes $ItemTax)
    {
        $this->taxes->removeElement($ItemTax);
    }

    /**
     * Get TaxItems
     *
     * @return Collection
     */
    public function getTaxes()
    {
        return $this->taxes;
    }
    
    /**
     * Get TaxItem
     *
     * @return OsposItemsTaxes | Null
     */
    public function getTax($Index)
    {
        if ( $this->taxes->containsKey($Index) ) {
            return $this->taxes[$Index];
        }
        return Null;
    }
    
}
