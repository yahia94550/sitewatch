<?php

namespace Seedmetrix\ImportexcelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Seedmetrix\ImportexcelBundle\Entity\Fichier;
use Seedmetrix\ImportexcelBundle\Form\FichierType;

class DefaultController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('SeedmetrixImportexcelBundle:Default:index.html.twig');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function importAction(Request $request)
    {
       // voir  https://symfony.com/doc/current/controller/upload_file.html
    }
}
