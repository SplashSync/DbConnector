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
        // Create Object Create SQL Trigger
        $Connection->executeQuery($this->buildDatabaseTriggerSQL($Trigger, 'CREATE'));

        //==============================================================================
        // Create Object Update SQL Trigger
        $Connection->executeQuery($this->buildDatabaseTriggerSQL($Trigger, 'UPDATE'));
                
        //==============================================================================
        // Create Object Delete SQL Trigger
        $Connection->executeQuery($this->buildDatabaseTriggerSQL($Trigger, 'DELETE'));
        
    }   
    
    
    /**
     * @abstract    Build WebSite Trigger SQL CODE
     * 
     * @param   Site        $WebSite        Current Web Site
     * @param   Connection  $Connection     Web Site Database Connection
     * @param   array       $Trigger        Description
     * @param   string      $Mode           Trigger Mode (CREATE / UPDATE / DELETE)
     * 
     * @return void
     */
    public function buildDatabaseTriggerSQL($Trigger, $Mode) {

        //==============================================================================
        // Safety checks
        if ( 
                !isset($Trigger["ObjectType"])  || empty($Trigger["ObjectType"]) ||
                !isset($Trigger["Table"])       || empty($Trigger["Table"]) ||
                !isset($Trigger["IdField"])     || empty($Trigger["IdField"]) 
                ) {
            return;
        }
        
        switch ( $Mode ) {
            case "CREATE":
                $Event      =   "INSERT";
                $Source     =   "NEW";
                break;
            case "DELETE":
                $Event      =   "DELETE";
                $Source     =   "OLD";
                break;
            case "UPDATE":
            default:
                $Event      =   "UPDATE";
                $Source     =   "NEW";
                break;
        }
        
        $SQL    =   "";
        //==============================================================================
        // DROP PREVIOUS TRIGGER 
        $SQL    =   " DROP TRIGGER IF EXISTS `SPLASH_SYNC_" . $Mode . "`;";
        //==============================================================================
        // CREATE TRIGGER 
        $SQL    .=   " CREATE TRIGGER `SPLASH_SYNC_" . $Mode . "` AFTER " . $Event . " ON `" . $Trigger ["Table"]. "` ";
        $SQL    .=   " FOR EACH ROW BEGIN";
        $SQL    .=   " IF @IS_SPLASH IS NULL THEN";
        $SQL    .=   " INSERT INTO `" . $this->DatabaseName . "`.`sites__commits` ( site_id, commitedAt, ObjectType, ObjectId, Action )";
        $SQL    .=   " VALUES ( 1, SYSDATE(), '" . $Trigger["ObjectType"] . "', " . $Source . "." . $Trigger["IdField"] . ", '" . strtolower($Mode) . "' );";
        $SQL    .=   " END IF;";
        $SQL    .=   " END;";
        
        return $SQL;
        
    } 

    
}
