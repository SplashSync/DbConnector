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

namespace Databases\OsPosBundle\Services;

use WebSiteBundle\Models\BaseDatabaseService;
use WebSiteBundle\Models\DatabaseServiceInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Doctrine\ORM\EntityManager;


/**
 * @abstract    OsPos DatabaseManager
 */
class DatabaseManager extends BaseDatabaseService implements DatabaseServiceInterface {

    const CODE      =   'OsPos';
    const NAME      =   'OpenSource POS';
    const VERSION   =   '0.0.1';  

    
    public function onDatabaseListAction(GenericEvent $Event) {
        
        
        $Definition = array(
            
            //==============================================================================
            //  Main Database Definition
            'code'                      => self::CODE,
            'name'                      => self::NAME,
            'description'               => 'Splash Database Connector for OsPOS',
            'version'                   => self::VERSION,
            //==============================================================================
            //  Objects to Sync
            'Objects'                   => array(
//                'Databases\OsPosBundle\Entity\OsposCustomers',
                'Databases\OsPosBundle\Entity\OsposItems',
            ),
            //==============================================================================
            //  Triggers => List of Objects to Monitor
            'Triggers'                   => array(
//                "ThirdParty"    =>  array( 
//                    "ObjectType"    =>  "thirdparty",
//                    "Table"         =>  "ospos_customers",
//                    "IdField"       =>  "person_id",
//                    ),
                "Products"    =>  array( 
                    "ObjectType"    =>  "Product",
                    "Table"         =>  "ospos_items",
                    "IdField"       =>  "item_id",
                    ),
            ),
            //==============================================================================
            //  Widgets to Sync
            'Widgets'                   => array(),
            
        );
        
        $Event[ self::CODE ]  = $this->validateListingArray($Definition);
        
    }
    
    public function onEditFormAction(GenericEvent $Event) {
        
        $Site   =   $Event->getSubject()->getAdmin()->getSubject();
        
        //==============================================================================
        //  Check if Current Database Type
        if ( $Site->getServerType() !== self::CODE ) {
            return;
        }

        //==============================================================================
        //  Read List of Available Warehouses
        $Warehouses = $this->getEntityManager( $Site )->getRepository("OsPosBundle:OsposStockLocations")->findAll();
        $WareHouseChoices   =   array();
        foreach ($Warehouses as $Warehouse) {
            if ($Warehouse->getDeleted()) {
                continue;
            } 
            $WareHouseChoices[$Warehouse->getLocationName()]    =   $Warehouse->getLocationId();
        }
        
        //==============================================================================
        //  Populate WebSite Form
        $formMapper = $Event->getSubject();
        
        $formMapper
                
            ->tab('OsPos Options') 
                ->with('Products Config.', array('class' => 'col-md-6'))
                
                    ->add('items_default_category', 'text', array(
                        'property_path'         => 'settings[items_default_category]',
                        'required'              => True,
                        'label'                 => "Default Category Name",
                        'translation_domain'    => False,
                        'label_render'          => False,
                    ))

                    ->add('items_default_stock', 'choice', array(
                        'property_path'         => 'settings[items_default_location]',
                        'choices'               => $WareHouseChoices,
                        'required'              => True,
                        'label'                 => "Stcok Location to Use",
                        'translation_domain'    => False,
                        'label_render'          => False,
                    ))                
                
                ->end()      
            ->end()
                
            ;
        
    }
    
        
}
