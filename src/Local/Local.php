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

namespace Splash\Local;

//====================================================================//
//  INCLUDES
//====================================================================//

use Symfony\Component\DependencyInjection\ContainerInterface;

use Splash\Core\SplashCore          as Splash;

use WebSiteBundle\Entity\Site;

use Splash\Bundle\Models\BaseLocalClass;
use Splash\Local\Objects\Annotations;

use Splash\Local\Widgets\Annotations    as  WidgetAnnotations;

use Doctrine\ORM\EntityManager;

//====================================================================//
//  CONSTANTS DEFINITION
//====================================================================//

//====================================================================//
//  CLASS DEFINITION
//====================================================================//

/**
  * @abstract   Splash Local Server Class
  */
class Local extends BaseLocalClass
{
    /*
     * @var Site
     */
    private $site       = Null;

    /**
     * @var EntityManager
     */
    private $_em;
    
//====================================================================//
// *******************************************************************//
//  MANDATORY CORE MODULE LOCAL FUNCTIONS
// *******************************************************************//
//====================================================================//
    
    /**
     *      @abstract       Return Local Server Parameters as Aarray
     *                      
     *      THIS FUNCTION IS MANDATORY 
     * 
     *      This function called on each initialisation of the module
     * 
     *      Result must be an array including mandatory parameters as strings
     *         ["WsIdentifier"]         =>>  Name of Module Default Language
     *         ["WsEncryptionKey"]      =>>  Name of Module Default Language
     *         ["DefaultLanguage"]      =>>  Name of Module Default Language
     * 
     *      @return         array       $parameters
     */
    public function Parameters()
    {
        $Parameters       =     array();
        
        //====================================================================//
        //  Safety Check - Ensure Container is Loaded
        if ( is_null($this->getContainer()) ) {
            throw new \Exception("No Container");
        }
        //====================================================================//
        //  Init Parameters For PhpUnit Test
        if ( is_null($this->site) ) {
            $this->InitForTesting();
        }
        //====================================================================//
        //  No Site Already Selected => Empty parameters
        if ( is_null($this->site) ) {
//            throw new \Exception("No WebSite");   // For Debug Purpose Only
            return $Parameters;
        }
        //====================================================================//
        // Server Identification Parameters
        $Parameters["WsIdentifier"]         =   $this->site->getAccountId();
        $Parameters["WsEncryptionKey"]      =   $this->site->getAccountKey();
        //====================================================================//
        // If Expert Mode => Overide of Server Host Address
        if ( !empty($this->site->getExpertMode()) ) {
            $Parameters["WsHost"]           =   $this->site->getAccountHost();
        }
        //====================================================================//
        // Use of Symfony Routes => Overide of Local Server Path Address
        if ($this->getContainer()) {
            $Parameters["ServerPath"]      =   $this->getContainer()->get('router')
                    ->generate("splash_website_soap", ["SiteId" => $this->site->getId()]);
        }
        //====================================================================//
        // If no Server Name => We are in Command Mode
        if ( ( Splash::Input("SCRIPT_NAME") === "app/console" ) 
            || (Splash::Input("SCRIPT_NAME") === "bin/console" ) ){
            $Parameters["ServerHost"]      =   "localhost";
        }        
        return $Parameters;
    }  
    
    /**
     *      @abstract       Return Local Server Self Test Result
     *                      
     *      THIS FUNCTION IS MANDATORY 
     * 
     *      This function called during Server Validation Process
     * 
     *      We recommand using this function to validate all functions or parameters
     *      that may be required by Objects, Widgets or any other modul specific action.
     * 
     *      Use Module Logging system & translation tools to retrun test results Logs
     * 
     *      @return         bool    global test result
     */
    public function SelfTest()
    {
        //====================================================================//
        //  Load Local Translation File
        Splash::Translator()->Load("main@local");          

        //====================================================================//
        //  Verify - Container is Given
        if ( empty($this->getContainer()) ) {
            return Splash::Log()->Err("ErrNoContainer");
        }        
        //====================================================================//
        //  Init Parameters For PhpUnit Test
        if ( is_null($this->site) ) {
            $this->InitForTesting();
        }        
        //====================================================================//
        //  Verify - Server Identifier Given
        if ( empty($this->site->getAccountId()) ) {
            return Splash::Log()->Err("ErrSelfTestNoWsId");
        }        
        
        //====================================================================//
        //  Verify - Server Encrypt Key Given
        if ( empty($this->site->getAccountKey()) ) {
            return Splash::Log()->Err("ErrSelfTestNoWsKey");
        }        
        
        return True;
    }       
    
    /**
     *  @abstract   Update Server Informations with local Data
     * 
     *  @param     arrayobject  $Informations   Informations Inputs
     * 
     *  @return     arrayobject
     */
    public function Informations($Informations)
    {
        //====================================================================//
        // Init Response Object
        $Response = $Informations;
        
        //====================================================================//
        // Company Informations
        $Response->company          =   $this->getParameter("company",      "...", "infos");
        $Response->address          =   $this->getParameter("address",      "...", "infos");
        $Response->zip              =   $this->getParameter("zip",          "...", "infos");
        $Response->town             =   $this->getParameter("town",         "...", "infos");
        $Response->country          =   $this->getParameter("country",      "...", "infos");
        $Response->www              =   $this->getParameter("www",          "...", "infos");
        $Response->email            =   $this->getParameter("email",        "...", "infos");
        $Response->phone            =   $this->getParameter("phone",        "...", "infos");
        
        //====================================================================//
        // Server Logo & Images
//        $icopath = $this->container->get('kernel')->getRootDir() . "/../web/favicon.ico"; 
//        $Response->icoraw           =   Splash::File()->ReadFileContents(
//                is_file($icopath) ? $icopath : (dirname(__DIR__) . "/Resources/public/symfony_ico.png")
//                );

        if ($this->getParameter("logo",Null, "infos")) {
            $Response->logourl      =   (strpos($this->getParameter("logo",Null, "infos"), "http:///") == 0) ? Null : filter_input(INPUT_SERVER, "SERVER_NAME");
            $Response->logourl     .=   $this->getParameter("logo",Null, "infos");
        } else {
            $Response->logourl          =   "http://symfony.com/logos/symfony_black_03.png?v=5";
        }
        
        //====================================================================//
        // Server Informations
        $Response->servertype       =   "Symfony 2";
        $Response->serverurl        =   filter_input(INPUT_SERVER, "SERVER_NAME") ? filter_input(INPUT_SERVER, "SERVER_NAME") : "localhost:8000";
        
        return $Response;
    }    
    
    /**
     *      @abstract       Return Local Server Test Sequences as Aarray
     *                      
     *      THIS FUNCTION IS OPTIONNAL - USE IT ONLY IF REQUIRED
     * 
     *      This function called on each initialization of module's tests sequences.
     *      It's aim is to list different configurations for testing on local system.
     * 
     *      If Name = List, Result must be an array including list of Sequences Names.
     * 
     *      If Name = ASequenceName, Function will Setup Sequence on Local System.
     * 
     *      @return         array       $Sequences
     */    
    public function TestSequences($Name = Null)
    {
        switch($Name) {
            
            case "List":
                //====================================================================//
                // Get List of Active WebSites
                $WebSites = $this->getContainer()->get('doctrine')->getRepository('WebSiteBundle:Site')->findAll();
//                echo 'Init : Found ' . count($WebSites) . " Active Websites \n";
                //====================================================================//
                // Build List of WebSites
                $Response = array();
                foreach ($WebSites as $Website) {
                    $Response[] =   $Website->__toString();
                    
                }
                return $Response;
                
            default:
                //====================================================================//
                // Load Selected WebSite
                $WebSite = $this->getContainer()->get('doctrine')->getRepository('WebSiteBundle:Site')->findOneBySiteName($Name);
                $this->Boot($this->getContainer(),$WebSite);
//                echo 'Init : Found ' . count(Splash::Objects()) . " Objects on Site " . $Name . " \n";
                return;
            
        }
    }  
    
  
//====================================================================//
//  VARIOUS LOW LEVEL FUNCTIONS
//====================================================================//

    /**
     *  @abstract       Local Splash Module Initialisation
     *
     * @param ContainerInterface    $container  Symfony Container Interface 
     * @param Site                  $WebSite    Current WebSite
     * 
     * @return     string
     */
    public function Boot(ContainerInterface $container, Site $WebSite = Null) 
    {
        //====================================================================//
        //  Boot Base Module Class
        parent::Boot($container);
        
        //====================================================================//
        //  No WebSite Given
        if ( is_null($WebSite) ) {
            return;
        } 
        //====================================================================//
        //  Store Current WebSite
        $this->site         =   $WebSite;
        //====================================================================//
        //  Load Server Parameters
        $this->config       =   $this->getContainer()->getParameter("splash");
        //====================================================================//
        // Setup Annotations Manager
        $this->SetupAnnotations();
    }
    
    private function SetupAnnotations() {
        //====================================================================//
        //  Check No WebSite Already Selected
        if ( is_null($this->site) || (is_null($this->getContainer()))) {
            return;
        }
        //====================================================================//
        // Setup Objects Annotations Manager
        $WebSiteManager     =    $this->getContainer()->get('splash.website.manager');
        $this->_am = new Annotations(
                $WebSiteManager->getEntityManager($this->site),
                Null,
                $WebSiteManager->getObjects($this->site)
            );        
        //====================================================================//
        // Setup Widgets Annotations Manager
        $this->_wm = new WidgetAnnotations($WebSiteManager->getWidgets($this->site));        
    }
    
    private function InitForTesting() {
        //====================================================================//
        //  Check No WebSite Already Selected
        if ( !is_null($this->site) || (is_null($this->getContainer()))) {
            return;
        }
        //====================================================================//
        //  Select First WebSite for Basic Tests
        if ($this->getContainer()->getParameter("kernel.environment") == 'test' ) {
            $this->site     =   $this->getContainer()->get("doctrine")->getRepository("WebSiteBundle:Site")->findOneByEnabled(1);
            //====================================================================//
            // Setup Annotations Manager
            $this->SetupAnnotations();
        }        
    }
    
    public function getWebSite() {
        return $this->site;
    }
    
    /**
     * @abstract    Get Website Dedicated Entity Manager
     * 
     * @param Site $WebSite
     * 
     * @return EntityManager
     */
    public function getEntityManager() {
        
        if ( !$this->_em ) {
            //==============================================================================
            // Create Entity Manager for a WebSite
            $this->_em= $this->getContainer()->get('splash.website.manager')->getEntityManager($this->site);
        }         
        
        return $this->_em;
    }    
    
}

?>
