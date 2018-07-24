<?php

namespace Seedmetrix\AnalysisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    const ACTION_TYPE_READ="01";
    Const MYCONST_TYPE="03" ;
    public function indexAction()
    {
        return $this->render('@Analysis/Default/index.html.twig');
    }

    public function findCollegeAction(Request $request){

        $results = "";
       // if($request->isXmlHttpRequest()) {
            $collegestr = $request->request->get("collegestr");
            if (!empty($collegestr)) {
                $url = "http://rcu.onisep.fr:8080/rcuWS/service/client/etablissements/";
                $ch = curl_init($url);
                $params = array(
                    "recherche" => $collegestr ,
                    "traitementApplication" => "Ecran saisie commandes",
                    "typeAction" => "01",
                    "codeApplication" => "01"
                );
                // encodage en json de notre objet
                $content = json_encode($params, JSON_FORCE_OBJECT);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen($content))
                );
                curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

                //execute post
                $results = curl_exec($ch);
                //var_dump($results);
                //close connection
                curl_close($ch);
            }
      //  }

        return $this->render('@Analysis/Default/index.html.twig', array(
            'villes' => $results
        ));
    }

    public function rechercheAction(Request $request)
    {
        $colleges = array();
        $collegestr = $request->request->get("mot_cle");
        $url = "http://rcu.onisep.fr:8080/rcuWS/service/client/etablissements/";
        $ch = curl_init($url);
        $params = array(
            "recherche" => $collegestr,
            "traitementApplication" => "Ecran saisie commandes",
            "typeAction" => "01",
            "codeApplication" => "01"
        );
        if (!empty($collegestr)) {
            $content = json_encode($params, JSON_FORCE_OBJECT);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                    'Content-Length: ' . strlen($content))
            );
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            $results = curl_exec($ch);
            if (!$results) {
               // echo curl_error($ch); ( to do ecrire la function error($ch) //
            } else {
                $data = json_decode($results);
                $nb = 0 ;
                while ($nb < 10) {
                    foreach ($data as $key => $value) {
                        //$colleges [] = $value;
                        //$nb += 1;
                        foreach ($value as $val) {
                            if($nb < 10) {
                               // echo "<br>" . $nb . "<br>";
                                $nb = $nb + 1;
                                $colleges[] = $val;
                            }
                        }
                    }
                }
            }
            //var_dump($colleges) ;
            //close connection
            curl_close($ch);
            $villes = $colleges;


        }
        return $this->render('@Analysis/Default/error.html.twig', array(
            'villes' => $colleges
        ));
    }

}