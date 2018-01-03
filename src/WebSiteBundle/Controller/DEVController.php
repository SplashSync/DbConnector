<?php

namespace WebSiteBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Splash\Server\SplashServer;
use Splash\Client\Splash;

use Splash\Bundle\Controller\DEVController as BaseDEVController;

class DEVController extends BaseDEVController
{

    /**
     * Execute Main External SOAP Requests
     */
    public function debugAction($Type = Null, $ObjectId = Null, $SiteId = Null)
    {
        //====================================================================//  
        // Detect WebSite
        $Site   = $this->getDoctrine()->getRepository("WebSiteBundle:Site")->find($SiteId);
        if ( !$Site ) {
            return new Response("This WebService Provide no Description.");
        }
        //====================================================================//
        // Boot Local Splash Module
        Splash::Local()->Boot($this->container, $Site);
        //====================================================================//
        // Prepare debug Page
        $Params             =   $this->debugPrepare($Type, $ObjectId);        
        $Params['WebSite']  =   $Site;
        return $this->render('WebSiteBundle:Debug:index.html.twig',$Params);         
    }     
    
}
