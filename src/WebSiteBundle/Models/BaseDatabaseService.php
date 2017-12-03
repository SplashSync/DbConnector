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

namespace WebSiteBundle\Models;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @abstract    Core Databases Connectors Service Functions
 * @author Splash Sync       <contact@splashsync.com>
 */
abstract class BaseDatabaseService {
    
    //====================================================================//
    // Define Standard Settings for a User
    private $ServiceDefinition       = array(
            //==============================================================================
            //  Main Database Definition
            'code'                      => Null,
            'name'                      => Null,
            'description'               => 'No description provided...',
            'version'                   => Null,
            //==============================================================================
            //  Objects to Sync
            'Objects'                   => array(
                
            ),
            //==============================================================================
            //  Widgets to Sync
            'Widgets'                   => array(),
    );
    
    private $ServiceRequired       = array('code', 'name', 'version');
    
    /**
     * Validate & Complete Database Listing Array
     *
     * @param array $settings
     *
     * @return User
     */
    public function validateListingArray($settings)
    {
        //==============================================================================
        //  Init Definition Array using OptionResolver
        $resolver = new OptionsResolver();
        $resolver->setDefaults($this->ServiceDefinition);
        $resolver->setRequired($this->ServiceRequired);
        
        //==============================================================================
        //  Update Settings Array using OptionResolver        
        return $resolver->resolve($settings);
    }
    
}
