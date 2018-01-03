<?php

/*
 * This file is part of the Splash Sync project.
 *
 * (c) Splash Sync <contact@splashsync.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WebSiteBundle\Jobs;

use Splash\Tasking\Entity\Task;
use Splash\Tasking\Model\AbstractStaticJob;

use Splash\Client\Splash;

/**
 * @abstract    Background Objects Changes Monitoring & Commit Job
 */
class CommitsMonitorJob extends AbstractStaticJob {
    
    /*
     * @abstract    Job Priority
     * @var int
     */    
    const priority      = Task::DO_HIGH;
    
    /*
     * @abstract Job Display Settings
     */    
    protected $settings   = array(
        "label"                 =>      "tasks.co.label",
        "description"           =>      "tasks.co.desc",
        "translation_domain"    =>      "WebSiteBundle",  
        "translation_params"    =>      array()
    );
    
    /**
     * @abstract    Job Token is Used for concurrency Management
     *              You can set it directly by overriding this constant 
     *              or by writing an array of parameters to setJobToken()
     * @var string
     */
    protected $token       = "CHANGES:COMMITS";    
    
    //====================================================================//
    //  User Nodes Refresh MAIN Task
    //====================================================================//

    /**
     *      @abstract    Search for UnCommited Changes & Notify Splash Server
     *                      
     *      @return  bool
     */    
    public function execute() : bool {
        
        //====================================================================//
        //  Track Changes for 55 Seconds
        for ( $i=0 ; $i < 58; $i++) {
            $this->pushUntifiedCommits();
            sleep(1);
        }

        $this->cleanNotifiedCommits();
        return True;
    }   
    
    /**
     *      @abstract    Search for UnCommited Changes & Notify Splash Server
     *                      
     *      @return  bool
     */    
    public function pushUntifiedCommits() : bool 
    {
        //====================================================================//
        //  Load List Of Commits
        $Commits    =   $this->getUnnotifiedCommits();
        if ( empty($Commits) ) {
            return True;
        }
        
        foreach ($Commits as $Commit) {
            //====================================================================//
            //  Setup Splash Client
            Splash::Local()->Boot($this->container, $Commit->getSite());
            //====================================================================//
            //  Push Change To Splash Server
            $Result = Splash::Commit(
                    $Commit->getObjectType(), 
                    $Commit->getObjectId(), 
                    $Commit->getAction(), 
                    'Splash Db Connector', 
                    $Commit->getSite()->getSiteName()
                );
            //====================================================================//
            //  Set Change as Notified
            if ($Result)  {
                $Commit->setNotified();
            }
        }
        //====================================================================//
        //  Save Changes
        $this->container->get('doctrine')->getManager()->flush();
        return True;
    }   
    
    /**
     *      @abstract    Search for All OutDated Users Nodes and Ask for Refresh of their Definitions
     *                      
     *      @return  bool
     */    
    public function getUnnotifiedCommits() : array {
        
        //====================================================================//
        // Get List Of Nodes That Needs To Be Refreshed
        return   $this->container
                            ->get('doctrine')
                            ->getManager()->getRepository('WebSiteBundle:Commits')
                            ->findUncommitedChanges();
        
    } 
    
    public function cleanNotifiedCommits() {
        
        $this->container
            ->get('doctrine')
            ->getManager()->getRepository('WebSiteBundle:Commits')
            ->Clean();
        
    }       
    
}
