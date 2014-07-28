<?php

namespace LesPolypodes\RestOAuthBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('LesPolypodesRestOAuthBundle:Default:index.html.twig', array('name' => $name));
    }
}
