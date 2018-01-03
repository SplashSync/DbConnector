<?php

/*
 * This file is part of SplashSync Project.
 * 
 * Copyright (C) Splash Sync <www.splashsync.com>
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * @author Bernard Paquier <contact@splashsync.com>
 */

namespace WebSiteBundle\Traits;

/**
 * Just Manage Settings Array
 */
trait SettingsTrait {

    /**
     * @abstract    Settings Array
     * @var array
     * @ORM\Column(name="settings", type="array", nullable=true)
     */  
    private $settings = array();
    
    /**
     * Set setting
     *
     * @param string    $Domain
     * @param mixed     $Value
     *
     * @return User
     */
    public function setSetting($Domain,$Value)
    {
        //==============================================================================
        // Read Full Settings Array
        $Settings = $this->getSettings();
        //==============================================================================
        // Update Domain Setting
        $Settings[$Domain] = $Value;
        //==============================================================================
        // Update Full Settings Array
        $this->setSettings($Settings);
        return $this;
    }
    
    /**
     * Set SubDomain setting
     *
     * @param string    $Domain
     * @param string    $SubDomain
     * @param mixed     $Value
     *
     * @return User
     */
    public function setSubSetting($Domain,$SubDomain,$Value)
    {
        //==============================================================================
        // Read Full Settings Array
        $Settings = $this->getSettings();
        //==============================================================================
        // Update Sub-Domain Setting
        if ( !array_key_exists($Domain, $Settings) ) {
            $Settings[$Domain] = array( $SubDomain => $Value );
        } else {
            $Settings[$Domain][$SubDomain] = $Value;
        }
        //==============================================================================
        // Update Full Settings Array
        $this->setSettings($Settings);
        return $this;
    }
    
    /**
     * Get settings
     *
     * @param string    $Domain
     * @param string    $SubDomain
     * 
     * @return array
     */
    public function getSetting($Domain,$SubDomain = Null)
    {
        //==============================================================================
        // Get Simple Paramaters
        if (array_key_exists($Domain, $this->settings) && is_null($SubDomain)) {
            return $this->settings[$Domain];
        } elseif ( is_null($SubDomain) ) {
            return False;
        //==============================================================================
        // Get Second Level Paramaters
        } elseif (array_key_exists($SubDomain, $this->settings[$Domain])) {
            return $this->settings[$Domain][$SubDomain];
        }
        return array();
    }     
    
    /**
     * Set settings
     *
     * @param array $settings
     *
     * @return User
     */
    public function setSettings($settings)
    {
       $this->settings  =   $settings;
            
        return $this;
    }

    /**
     * Get settings
     *
     * @return array
     */
    public function getSettings()
    {
        if ( is_null($this->settings) ) {
            $this->settings = array();
        } 
        return $this->settings;
    }    
    
}
