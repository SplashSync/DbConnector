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
 * @abstract    OsPos Product Description Trait
 */
trait ItemDescriptionTrait {
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     * 
     * @SPL\Field(  
     *          id      =   "name",
     *          type    =   "varchar",
     *          name    =   "Name",
     *          itemtype=   "http://schema.org/Product", itemprop="name",
     *          inlist  =   true,
     *          required=   true,
     * )
     * 
     */
    private $name;
    
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     * 
     * @SPL\Field(  
     *          id      =   "description",
     *          type    =   "varchar",
     *          name    =   "Item Description",
     *          itemtype=   "http://schema.org/Product", itemprop="description",
     *          asso    =   { "name" },
     * )
     * 
     */
    private $description = "";

    /**
     * Set name
     *
     * @param string $name
     *
     * @return OsposItems
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
     * Set description
     *
     * @param string $description
     *
     * @return OsposItems
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
    
}
