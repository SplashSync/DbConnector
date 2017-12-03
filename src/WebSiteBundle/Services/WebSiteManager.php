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

namespace WebSiteBundle\Services;

use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Doctrine\ORM\EntityManager;

use WebSiteBundle\Entity\Site;

/**
 * @abstract    Splash WebSites Manager
 */
class WebSiteManager
{
    
    /**
     * @var EntityManager
     */
    private $BaseEntityManager;

    /**
     * @var array
     */
    private $AvailableDatabases =   Null;
    
    /**
     * @var EventDispatcherInterface
     */
    private $Dispatcher;
    
    public function __construct(EntityManager $EntityManager, EventDispatcherInterface $Dispatcher) {
        
        $this->BaseEntityManager    =   $EntityManager;
        $this->Dispatcher           =   $Dispatcher;
    
    }
    
    /**
     * @abstract    Get Available Databases List
     * 
     * @return array
     */
    public function getAvalaibeDatabases() {
        if ( is_null($this->AvailableDatabases) ) {
            $this->AvailableDatabases =   $this->Dispatcher->dispatch('splash.databases.list', new GenericEvent());
        }
        return $this->AvailableDatabases;
    }
    
    /**
     * @abstract    Get Available Databases Choice Array for Admin Forms
     * 
     * @return array
     */
    public function getAvalaibeDatabasesChoiceArray() {
        $DatabasesList  =   $this->getAvalaibeDatabases();
        $Response = array();
        foreach ($DatabasesList as $Database) {
            $Text = $Database['name'] . ' - ' . $Database['description'];
            $Response[$Text] = $Database['code'];
        }
        return $Response;
    }    
    
    /**
     * @abstract    Get Website Dedicated Entity Manager
     * 
     * @param Site $WebSite
     * 
     * @return EntityManager
     */
    public function getEntityManager( Site $WebSite ) {
        //==============================================================================
        // Create Entity Manager for a WebSite
        return EntityManager::create( 
                $WebSite->getDatabaseConfiguration($this->BaseEntityManager->getConnection()), 
                $this->BaseEntityManager->getConfiguration() 
            );
    }
    
    /**
     * @abstract    Get Website Dedicated Entity Manager
     * 
     * @param Site $WebSite
     * 
     * @return EntityManager
     */
    public function getObjects( Site $WebSite ) {
        
        $DatabasesList  =   $this->getAvalaibeDatabases();
        
        if ( !isset($DatabasesList[$WebSite->getServerType()]) ) {
            return array();
        }
            
        return $DatabasesList[$WebSite->getServerType()]['Objects'];
    }
    
    
}
