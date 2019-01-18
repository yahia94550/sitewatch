<?php

namespace Seedmetrix\ImportexcelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SeedmetrixImportexcelBundle:Default:index.html.twig');
    }
}
