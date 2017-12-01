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

use WebSiteBundle\Entity\Commits;

/**
 * @author Splash Sync <contact@splashsync.com>
 */
class CommitsAdmin extends Admin
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
            ->addIdentifier('id')
            ->add('objectType')
            ->add('objectId')
            ->add('action')
            ->add('commitedAt')                
            ->add('notifiedAt')                
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
                ->add('site')
                ->add('objectType')
                ->add('objectId')
                ->add('action', 'choice', array(
                    'choices' => array(
                        'Create'    => SPL_A_CREATE,
                        'Update'    => SPL_A_UPDATE,
                        'Delete'    => SPL_A_DELETE
                    ),
                ))
                
            ->end()
             
            ->with('Timming', array('class' => 'col-md-6'))
                ->add('commitedAt')                
                ->add('notifiedAt')                
                ->add('notified')                
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
