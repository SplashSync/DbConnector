<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new AppBundle\AppBundle(),
            new Databases\OsPosBundle\OsPosBundle(),
        ];

        $this->registerFosBundles($bundles);
        $this->registerSonataAdminBundles($bundles);
        
        $this->registerSplashCoreBundles($bundles);
        
        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();

            if ('dev' === $this->getEnvironment()) {
                $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
//                $bundles[] = new Symfony\Bundle\WebServerBundle\WebServerBundle();
            }
        }

        return $bundles;
    }
    
    public function registerFosBundles(&$bundles)
    {
            $bundles[] = new FOS\UserBundle\FOSUserBundle();
    }
    
    public function registerSonataAdminBundles(&$bundles)
    {
            // These are the other bundles the SonataAdminBundle relies on
            $bundles[] = new Sonata\CoreBundle\SonataCoreBundle();
            $bundles[] = new Sonata\BlockBundle\SonataBlockBundle();
            $bundles[] = new Knp\Bundle\MenuBundle\KnpMenuBundle();

            // Sonata Bundle Generator
            $bundles[] = new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle();
            // Sonata User 
            $bundles[] = new Sonata\UserBundle\SonataUserBundle('FOSUserBundle');
            $bundles[] = new Application\Sonata\UserBundle\ApplicationSonataUserBundle();
            
            // And finally, the storage and SonataAdminBundle
            $bundles[] = new Sonata\AdminBundle\SonataAdminBundle();
            $bundles[] = new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle();
                    
    }
    
    public function registerSplashCoreBundles(&$bundles)
    {
        // Splash Core WebService Bundle >> Communication
        $bundles[] = new Splash\Bundle\SplashBundle();
        
        // Splash tasking Bundle >> Changes monitoring
        $bundles[] = new Splash\Tasking\SplashTaskingBundle();
        
        // Local Sites Manager
        $bundles[] = new WebSiteBundle\WebSiteBundle();
        
    }
    
    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
