<?php

namespace Seedmetrix\AnalysisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        //
        
       // return $this->render('@Analysis/Default/index.html.twig');
       //$histo = [];
        // $chart = $this->get('app.chart');
        //$histo  = ['val1' => 2 , 'val2' => 4, 'val3' => 8, 'va14' => 5 ] ;
        //var_dump($histo);
       // die();
        // return $this->render('@Analysis/Default/index.html.twig' , array('histo' => $histo));
      
        $existFile = $this->container->get('filexist');
        // Je pars du principe que $text contient le texte d'un message quelconque
        
        $file = 'C:\wamp64\www\input\exemple.xlsx';
      //  if (!isset($file)) {
      if($existFile->FileExist($file));
        //throw new \Exception('Votre message a été détecté comme spam !');
    //     return $this->render($info, '@Analysis/Default/error.html.twig');
      //  }
       return $this->render('@Analysis/Default/index.html.twig');
    }
}
