<?php

namespace Databases\OsPosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('OsPosBundle:Default:index.html.twig');
    }
}
