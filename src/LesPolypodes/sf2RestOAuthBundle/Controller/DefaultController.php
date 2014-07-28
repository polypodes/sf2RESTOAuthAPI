<?php

namespace LesPolypodes\sf2RestOAuthBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('LesPolypodessf2RestOAuthBundle:Default:index.html.twig', array('name' => $name));
    }
}
