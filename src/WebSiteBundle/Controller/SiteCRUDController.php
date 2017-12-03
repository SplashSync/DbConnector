<?php

namespace WebSiteBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;

use Splash\Client\Splash;

class SiteCRUDController extends Controller
{
    public function indexAction()
    {
        return $this->render('WebSiteBundle:CRUD/Site:view.html.twig');
    }
    
    
    /**
     * @param $id
     */
    public function showAction($id = Null)
    {
        //====================================================================//
        // Generic Show Actions        
        //====================================================================//
        
        $request = $this->getRequest();
        $id = $request->get($this->admin->getIdParameter());
        $Site = $this->admin->getObject($id);
        if (!$Site) {
            throw $this->createNotFoundException(sprintf('unable to find the object with id: %s', $id));
        }
        $this->admin->checkAccess('show', $Site);
        $preResponse = $this->preShow($request, $Site);
        if (null !== $preResponse) {
            return $preResponse;
        }
        $this->admin->setSubject($Site);
        
        //====================================================================//
        // Splash Show Actions        
        //====================================================================//

        //====================================================================//
        // Boot Local Splash Module
        Splash::Local()->Boot($this->container, $Site);

        $Results = array();
        
        //====================================================================//
        // Execute Splash Self-Test
        $Results['selftest'] = Splash::SelfTest();
        if ( $Results['selftest'] ) {
            Splash::Log()->msg("Self-Test Passed");
        }
        $SelfTest_Log = Splash::Log()->GetHtmlLog(True);

        //====================================================================//
        // Execute Splash Ping Test
        $Results['ping'] = Splash::Ping();
        $PingTest_Log = Splash::Log()->GetHtmlLog(True);
        
        //====================================================================//
        // Execute Splash Connect Test
        $Results['connect'] = Splash::Connect();
        $ConnectTest_Log = Splash::Log()->GetHtmlLog(True);
       
$this->get('splash.website.manager')->getAvalaibeDatabases();

//==============================================================================
// Create Document Manager 
//$Em = $this->get('splash.website.manager')->getEntityManager( $Site );
//                $this->defaultDocumentManager->getConnection(), $configuration, $this->defaultDocumentManager->getEventManager()
//);
//dump($Em->getRepository("OsPosBundle:OsposPeople")->findAll());

dump(Splash::Object('ThirdParty'));
//dump( $this->get('splash.website.manager')->getEntityManager( $Site ) );
        
        return $this->renderWithExtraParams($this->admin->getTemplate('show'), [
            'action' => 'show',
            'object' => $Site,
            'elements' => $this->admin->getShow(),
            
            "results"   =>  $Results,
            "selftest"  =>  $SelfTest_Log,
            "ping"      =>  $PingTest_Log,
            "connect"   =>  $ConnectTest_Log,
            "objects"   =>  Splash::Objects(),
            "widgets"   =>  Splash::Widgets(),
            
        ], null);
    }
    
}
