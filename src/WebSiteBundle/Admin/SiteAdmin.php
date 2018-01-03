<?php

/*
 * This file is part of the Splash Sync project.
 *
 * (c) Splash Sync <contact@splashsync.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WebSiteBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin as Admin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

use WebSiteBundle\Services\WebSiteManager;

/**
 * @author Splash Sync <contact@splashsync.com>
 */
class SiteAdmin extends Admin
{
    /**
     * @var WebSiteManager
     */
    private $WebSiteManager;
    
    public function setWebSitemanager(WebSiteManager $Manager){
        $this->WebSiteManager   =   $Manager;
    }


    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
//            ->add('name')
//            ->add('IsActive')
//            ->add('createdAt')
//            ->add('status')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
                
            ->addIdentifier('siteName', null, [ 'route' => [ 'name' => 'show' ] ])
            ->add('enabled', null, array('editable' => true))
            ->add('databaseHost')
            ->add('updatedAt') 
                
            ->add('_action', null, array(
                'actions' => array(

                    // ...

                    'clone' => array(
                        'template' => 'WebSiteBundle:CRUD/Site:list__actions.html.twig'
                    )
                )
            ))
                
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
//            ->add('user')
//            ->add('name')
//            ->add('host')
//            ->add('deleted')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('General') 
                ->with('General', array('class' => 'col-md-6'))
                    ->add('siteName')
                    ->add('serverType', 'choice', array(
                        'choices' => $this->WebSiteManager->getAvalaibeDatabasesChoiceArray(),
                    ))                
                    ->add('enabled')
                    ->add('shortDescription')
                    ->add('longDescription')
                ->end()  
                ->with('Security', array('class' => 'col-md-6'))
                    ->add('accountId')
                    ->add('accountKey')
                ->end()                 
                ->with('Database', array('class' => 'col-md-6'))
                    ->add('databaseHost')
                    ->add('databasePort')
                    ->add('databaseName')
                    ->add('databaseUser')
                    ->add('databasePassword')
                ->end()
            ->end()
            ->tab('Informations') 
                ->with('Company Informations', array('class' => 'col-md-6'))
                    ->add('company')
                    ->add('email')
                    ->add('publicUrl')
                    ->add('phone')
                ->end()      
                ->with('Address Informations', array('class' => 'col-md-6'))
                    ->add('address')
                    ->add('town')
                    ->add('zip')
                    ->add('country')
                ->end()                  
            ->end()
            ->tab('Advanced') 
                ->with('Expert Mode', array('class' => 'col-md-6'))
                    ->add('expertMode')
                    ->add('accountHost')
                ->end()      
            ->end()

        ;
        
        $this->WebSiteManager->populateEditForm($formMapper);
    }

    /**
     * {@inheritdoc}
     */
//    public function getNewInstance()
//    {
//        $object = parent::getNewInstance();
//
////        $inspection = new Inspection();
////        $inspection->setDate(new \DateTime());
////        $inspection->setComment("Initial inspection");
//
////        $object->addInspection($inspection);
//
//        return $object;
//    }
    
    /**
     * {@inheritdoc}
     */
    public function postUpdate($Site)
    {
        $this->WebSiteManager->updateDatabaseTriggers($Site);
    }
    
    
}
