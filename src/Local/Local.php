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

        if (is_null($this->site)) {
            $Parameters["WsIdentifier"]         =   "NoUse";
            $Parameters["WsEncryptionKey"]      =   "NoUse";
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
        if ($this->container) {
            $Parameters["ServerPath"]      =   $this->container->get('router')
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
        if ( empty($this->container) ) {
            return Splash::Log()->Err("ErrNoContainer");
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
        $icopath = $this->container->get('kernel')->getRootDir() . "/../web/favicon.ico"; 
        $Response->icoraw           =   Splash::File()->ReadFileContents(
                is_file($icopath) ? $icopath : (dirname(__DIR__) . "/Resources/public/symfony_ico.png")
                );

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
    public static function TestSequences($Name = Null)
    {
////        static::bootKernel();
////        $KernelClass    =   \Splash\Bundle\Tests\Core\C01ClassesTest::getKernelClass();
////        
////        $Kernel new static::$class(
////            isset($options['environment']) ? $options['environment'] : 'test',
////            isset($options['debug']) ? $options['debug'] : true
////        );
//        
////        $WebSites = static::$kernel->getContainer()->get('doctrine');
////        ->get('doctrine')->getRepository('WebSiteBundle:Site')->findAll();
//        
////        $WebSites = static::$kernel->getContainer()->get('doctrine')->getRepository('WebSiteBundle:Site')->findAll();
//        
////echo count($WebSites);
//echo 'SEQUENCES';

        foreach ($WebSites  as $WebSite) {
            echo $WebSite->getName();
        }                

        switch($Name) {
            
            case "ProductVATIncluded":
                update_option("woocommerce_prices_include_tax", "yes");
                update_option("splash_multilang", "on");
                return;
                
            case "Monolangual":
                update_option("woocommerce_prices_include_tax", "no");
                update_option("splash_multilang", "off");
                return;
            
            case "Multilangual":
                update_option("woocommerce_prices_include_tax", "no");
                update_option("splash_multilang", "on");
                return;
            
            case "List":
                


                return array( "ProductVATIncluded" ,"Monolangual", "Multilangual" );
                
        }
    }  
    
//====================================================================//
// *******************************************************************//
//  OVERRIDING CORE MODULE LOCAL FUNCTIONS
// *******************************************************************//
//====================================================================//    
    
    /**
     *      @abstract   Build list of Available Objects
     * 
     *      @return     array       $list           list array including all available Objects Type 
     */
    public function Objects()
    {
        //====================================================================//
        // Load Objects Type List
        return $this->Object()->getAnnotationManager()->getObjectsTypes();
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
        //  Store Container
        $this->container    =   $container;
        //====================================================================//
        //  No WebSite Given
        if ( is_null($WebSite) ) {
            
            //====================================================================//
            //  During Tests
            if ( $container->getParameter("kernel.environment") == 'test' ) {
//                $Websites   =   $this->container->get("doctrine")->getRepository("WebSiteBundle:Site")->findByEnabled(1);
                $Websites   =   $this->container->get("doctrine")->getRepository("WebSiteBundle:Site")->findByEnabled(1);
                $WebSite    =   array_shift($Websites);
            } else {
                return;
            }
        } 
        //====================================================================//
        //  Store Current WebSite
        $this->site         =   $WebSite;
        //====================================================================//
        //  Load Server Parameters
//        $this->config       =   $this->container->getParameter("splash");
        //====================================================================//
        //  Unset Splash Configuration => Will be reloaded uppon next request
        unset(Splash::Core()->conf);
        unset(Splash::Core()->log);
        
        //====================================================================//
        // Setup Annotations Manager
        $WebSiteManager     =    $container->get('splash.website.manager');
        $this->_am = new Annotations(
                $WebSiteManager->getEntityManager($WebSite),
                Null,
                $WebSiteManager->getObjects($WebSite)
            );        
        
    }
    
}

?>
