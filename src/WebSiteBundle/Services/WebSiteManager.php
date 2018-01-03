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
use Doctrine\DBAL\Connection;

use Sonata\AdminBundle\Form\FormMapper;

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
     * @var string
     */
    private $DatabaseName       =   Null;
    
    /**
     * @var EventDispatcherInterface
     */
    private $Dispatcher;
    
    public function __construct(EntityManager $EntityManager, EventDispatcherInterface $Dispatcher, $DatabaseName) {
        
        $this->BaseEntityManager    =   $EntityManager;
        $this->Dispatcher           =   $Dispatcher;
        $this->DatabaseName         =   $DatabaseName;
    
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
                $this->BaseEntityManager->getConfiguration(), 
                $this->BaseEntityManager->getEventManager() 
            );
    }
    
    /**
     * @abstract    Get List of Website Objects Classes Names
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

    /**
     * @abstract    Get List of Website Objects Triggers 
     * 
     * @param Site $WebSite
     * 
     * @return EntityManager
     */
    public function getObjectsTriggers( Site $WebSite ) {
        
        $DatabasesList  =   $this->getAvalaibeDatabases();
        
        if ( !isset($DatabasesList[$WebSite->getServerType()]) ) {
            return array();
        }
            
        return $DatabasesList[$WebSite->getServerType()]['Triggers'];
    }

    
    /**
     * @abstract    Get List of Website Widgets Classes Names
     * 
     * @param Site $WebSite
     * 
     * @return EntityManager
     */
    public function getWidgets( Site $WebSite ) {
        
        $DatabasesList  =   $this->getAvalaibeDatabases();
        
        if ( !isset($DatabasesList[$WebSite->getServerType()]) ) {
            return array();
        }

        return array_merge(
                [ "Splash\Local\Widgets\SelfTest" ],
                $DatabasesList[$WebSite->getServerType()]['Widgets'] 
            );
    }
    
    /**
     * @abstract    Populate WebSite Edit Form Using Events Dispatcher
     * 
     * @param   FormMapper  $FormMapper     Site Edit Form Mapper
     * 
     * @return void
     */
    public function populateEditForm( FormMapper $FormMapper ) {
        $this->Dispatcher->dispatch('splash.databases.editform', new GenericEvent($FormMapper));
    }
    
    /**
     * @abstract    Update WebSite Database Triggers
     * 
     * @param   Site  $WebSite     Current Web Site
     * 
     * @return void
     */
    public function updateDatabaseTriggers(Site $WebSite) {
        
        $Triggers = $this->getObjectsTriggers($WebSite);
        $Connection = $this->getEntityManager($WebSite)->getConnection();
        foreach ($Triggers as $Trigger) {
            $this->updateDatabaseTrigger($WebSite, $Connection, $Trigger);            
        }
        
    }

    /**
     * @abstract    Update WebSite Trigger
     * 
     * @param   Site        $WebSite        Current Web Site
     * @param   Connection  $Connection     Web Site Database Connection
     * @param   array       $Trigger        Description
     * 
     * @return void
     */
    public function updateDatabaseTrigger(Site $WebSite, Connection $Connection, $Trigger) {

        //==============================================================================
        // Safety checks
        if ( 
                !isset($Trigger["ObjectType"])  || empty($Trigger["ObjectType"]) ||
                !isset($Trigger["Table"])       || empty($Trigger["Table"]) ||
                !isset($Trigger["IdField"])     || empty($Trigger["IdField"]) 
                ) {
            return;
        }

        //==============================================================================
        // Create Object Create SQL Trigger
        $CREATE =   " DROP TRIGGER IF EXISTS `SPLASH_SYNC_CREATE`;";
        $CREATE.=   " CREATE TRIGGER `SPLASH_SYNC_CREATE` AFTER INSERT ON `" . $Trigger ["Table"]. "` ";
        $CREATE.=   " FOR EACH ROW";
        $CREATE.=   " INSERT INTO `" . $this->DatabaseName . "`.`sites__commits` ( site_id, commitedAt, ObjectType, ObjectId, Action )";
        $CREATE.=   " VALUES ( 1, SYSDATE(), '" . $Trigger["ObjectType"] . "', NEW." . $Trigger["IdField"] . ", 'create' );";
        $Connection->executeQuery($CREATE);
        
        //==============================================================================
        // Create Object Update SQL Trigger
        $UPDATE =   " DROP TRIGGER IF EXISTS `SPLASH_SYNC_UPDATE`;";
        $UPDATE.=   " CREATE TRIGGER `SPLASH_SYNC_UPDATE` AFTER UPDATE ON `" . $Trigger ["Table"]. "` ";
        $UPDATE.=   " FOR EACH ROW";
        $UPDATE.=   " INSERT INTO `" . $this->DatabaseName . "`.`sites__commits` ( site_id, commitedAt, ObjectType, ObjectId, Action )";
        $UPDATE.=   " VALUES ( 1, SYSDATE(), '" . $Trigger["ObjectType"] . "', NEW." . $Trigger["IdField"] . ", 'update' );";
        $Connection->executeQuery($UPDATE);
                
        //==============================================================================
        // Create Object Delete SQL Trigger
        $DELETE =   " DROP TRIGGER IF EXISTS `SPLASH_SYNC_DELETE`;";
        $DELETE.=   " CREATE TRIGGER `SPLASH_SYNC_DELETE` AFTER DELETE ON `" . $Trigger ["Table"]. "` ";
        $DELETE.=   " FOR EACH ROW";
        $DELETE.=   " INSERT INTO `" . $this->DatabaseName . "`.`sites__commits` ( site_id, commitedAt, ObjectType, ObjectId, Action )";
        $DELETE.=   " VALUES ( 1, SYSDATE(), '" . $Trigger["ObjectType"] . "', OLD." . $Trigger["IdField"] . ", 'delete' );";
        $Connection->executeQuery($DELETE);
        
    }   
    
    
}
