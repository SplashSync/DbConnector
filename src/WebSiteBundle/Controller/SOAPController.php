<?php

namespace WebSiteBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Splash\Server\SplashServer;
use Splash\Client\Splash;

use Splash\Bundle\Controller\SOAPController as BaseSOAPController;




class SOAPController extends BaseSOAPController
{

    /**
     * Execute Main External SOAP Requests
     */
    public function mainAction(Request $request, $SiteId = Null )
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
        // Return response
        return parent::mainAction($request);        
    }     
    
}
