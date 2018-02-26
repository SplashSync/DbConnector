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
     * @ORM\OneToMany(targetEntity="Databases\OsPosBundle\Entity\OsposItemsTaxes", cascade={"persist", "remove", "merge"}, mappedBy="item")
     */
    private $itemTaxes;

//    /**
//     * @var OsposItemsTaxes
//     *
//     * @ORM\OneToOne(targetEntity="Databases\OsPosBundle\Entity\OsposItemsTaxes", cascade={"persist", "remove", "merge"})
//     * @ORM\JoinColumns({
//     *   @ORM\JoinColumn(name="item_id", referencedColumnName="item_id")
//     * })
//     */
//    private $itemTax2 = Null;
    
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
        if ( !isset($this->getItemTaxes()[0]) ) {
            $Tax1   =    new OsposItemsTaxes();
            $Tax1
                    ->setItem($this)
                    ->setName("VAT")
                    ->setPercent(0)
                    ;
            $this->addItemTaxes($Tax1);
        }
        //====================================================================//
        // Check Value is Modified
        if ( self::Prices()->Compare($Price, $this->getUnitPrice()) ) {
            return $this;
        }
        
        //====================================================================//
        // Update Tax Percents
        $this->getItemTaxes()[0]->setPercent(self::Prices()->TaxPercent($Price));
        if ( isset($this->getItemTaxes()[1]) ) {
            $this->getItemTaxes()[1]->setPercent(0);
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
        if ( isset($this->getItemTaxes()[0]) ) {
            $VAT    +=  $this->getItemTaxes()[0]->getPercent();
        }
        if ( isset($this->getItemTaxes()[1]) ) {
            $VAT    +=  $this->getItemTaxes()[1]->getPercent();
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
    public function addItemTaxes(OsposItemsTaxes $ItemTax)
    {
        $this->itemTaxes[] = $ItemTax;

        return $this;
    }

    /**
     * Remove TaxItem
     *
     * @param OsposItemsTaxes $ItemTax
     */
    public function removeItemTaxes(OsposItemsTaxes $ItemTax)
    {
        $this->itemTaxes->removeElement($ItemTax);
    }

    /**
     * Get TaxItems
     *
     * @return Collection
     */
    public function getItemTaxes()
    {
//dump($this->itemTaxes->toArray());
        return $this->itemTaxes;
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
