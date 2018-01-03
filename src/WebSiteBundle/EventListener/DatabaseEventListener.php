<?php

namespace WebSiteBundle\EventListener;

use Doctrine\DBAL\Event\ConnectionEventArgs;
use Splash\Tasking\Services\TaskingService;
use Symfony\Component\HttpKernel\Event\PostResponseEvent;
use Symfony\Component\HttpKernel\Event\FinishRequestEvent;

class DatabaseEventListener
{
    /**
     * @var TaskingService
     */
    private $TaskingService;
    
    public function setTaskingService(TaskingService $TaskingService) {
        $this->TaskingService   = $TaskingService;
    }

    /**
     * @abstract    Define IS_SPLASH variable in SQL session to filter changes Triggers
     * @param ConnectionEventArgs $Event
     */
    public function postConnect(ConnectionEventArgs $Event)
    {
        $Event->getConnection()->executeQuery("SET @IS_SPLASH = true;");
    }
    
    /**
     * @abstract    Ensure Tasking Service is Running at the End of HTTP Request
     * @param PostResponseEvent $Event
     */
    public function onKernelTerminate(FinishRequestEvent $Event)
    {
        $this->TaskingService->SupervisorCheckIsRunning();
//        $Event->getKernel()
    }
    
}
