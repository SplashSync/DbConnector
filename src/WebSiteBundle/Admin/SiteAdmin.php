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

/**
 * @author Splash Sync <contact@splashsync.com>
 */
class SiteAdmin extends Admin
{
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
            ->addIdentifier('siteName')
            ->add('enabled', null, array('editable' => true))
            ->add('databaseHost')
            ->add('updatedAt')                
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
            ->with('General', array('class' => 'col-md-6'))
                ->add('siteName')
                ->add('enabled')
                ->add('shortDescription')
                ->add('longDescription')
            ->end()
             
            ->with('Database', array('class' => 'col-md-6'))
                ->add('databaseHost')
                ->add('databasePort')
                ->add('databaseName')
                ->add('databaseUser')
                ->add('databasePassword')
            ->end()
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
//            ->with('Encoding', array('class' => 'col-md-6'))
//                ->add('crypt_mode')
//                ->add('crypt_key')
//            ->end()                
//            ->with('inspections', array('class' => 'col-md-12'))
//                ->add('inspections', 'sonata_type_collection', array(
//                    'by_reference'       => false,
//                    'cascade_validation' => true,
//                ), array(
//                    'edit' => 'inline',
//                    'inline' => 'table'
//                ))
            ->end()
        ;
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
}
