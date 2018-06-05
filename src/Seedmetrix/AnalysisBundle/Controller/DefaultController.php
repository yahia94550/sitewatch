<?php

namespace Seedmetrix\AnalysisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Analysis/Default/index.html.twig');
    }
}
