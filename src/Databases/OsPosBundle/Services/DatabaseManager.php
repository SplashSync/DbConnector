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
                'Databases\OsPosBundle\Entity\OsposCustomers'
            ),
            //==============================================================================
            //  Widgets to Sync
            'Widgets'                   => array(),
            
        );
        
        $Event[ self::CODE ]  = $this->validateListingArray($Definition);
        
    }
        
}
