<?php
/**
 * Created by PhpStorm.
 * User: amine.yahia
 * Date: 10/01/19
 * Time: 09:59
 */

namespace Seedmetrix\AnalysisBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class ReadFileCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('read:json')
            ->setDescription('read file at json format')
            ->setHelp('This command allows you to display a json file...')
            ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $argv = $_SERVER['argv'];
       // var_dump($argv);die();

//        if (!isset($argv[2]) || ! is_file($argv[2]))
//            exit("[usage] ./$argv[0] <monfichierJson>\n");
       // TODO : Vérifier que le fichier est en format JSON

       // Affichier le contenu du fichier : /home/amine.yahia@onisep.fr/testApi/get_json10.json
       // $count_all_json_source = file_get_contents('http://www.onisep.fr/msel/oniservices/search/(filter)/code_uai=*');
       // $all_json_data = json_decode($count_all_json_source);
       // $all_total_result = $all_json_data->result_count ;
       // $multipleDix = round($all_total_result / 10 ) ;
//        $nbrepq = [] ;
//        for ( $i = 0 ; $i <= $multipleDix ; $i++){
//            $nbrepq[] = $i * 10 ;
//        }
//        $modulo = $all_total_result % 10 ;
//        echo $all_total_result.", ".$multipleDix.", ".$modulo ;
//
//        foreach ($nbrepq as $nb){
//            //echo "http://www.onisep.fr/msel/oniservices/search/$nb/code_uai=*\n";
//            echo $nb."\n";
//        }
//        $i = 90 ;
//        while($i < 100){
//            $i++;
//            $url = "http://www.onisep.fr/msel/oniservices/search/$i/code_uai=*";
//            $json_source = file_get_contents($url);
//            $json_data = json_decode($json_source);
//            $total_result = $json_data->result_count ;
//            echo $i."0 : ".$total_result."\n" ;
//        }
//        die();
        $tabNbResultPerPage = [];
        $etablissements = [] ;
        for ($i = 820 ; $i <= 825; $i++){
            $json_source = file_get_contents("http://www.onisep.fr/msel/oniservices/search/$i/code_uai=*");
            $json_data = json_decode($json_source);
            $total_result = $json_data->result_count ;
            $max_score = $json_data->max_score ;
            if( 0 != $total_result ){
                $tabNbResultPerPage ['result_count_'.$i] = $total_result;
                $tabNbResultPerPage ['max_result_'.$i] = $max_score;
                $etablissement = $this->readJsonFile($json_data);
                echo "non vide : ".$i." : ".$total_result."\n" ;
                $etablissements[$i] = $tabNbResultPerPage ;
                $etablissements[$i][$etablissement['id']] = $etablissement ;
            }
        }
        //var_dump($tabNbResultPerPage);
        var_dump($etablissements);
        die();
    }

    public function readJsonFile($json_data){
//        $json_source = file_get_contents('http://www.onisep.fr/msel/oniservices/search/690/code_uai=*');
//        // Décode le JSON
//        $json_data = json_decode($json_source);
//        $total_result = $json_data->result_count ;
//        $max_score = $json_data->max_score ;
        $etablissement = [] ;
        // var_dump($json_data->list); die();
        foreach($json_data->list as $v){
            $etabId = $v->id;
            $etablissement['id'] = $etabId;
            $etabName = $v->name;
            $etablissement['name'] = $etabName;
            $canonicalUrl = $v->canonical_url ;
            $etablissement['canonical_url'] = $canonicalUrl;
            $classIdentifier = $v->class_identifier ;
            $etablissement['class_identifier'] = $classIdentifier;
            $className = $v->class_name ;
            $etablissement['class_name'] = $className;
            $dataMap = $v->data_map;
            if(!empty($dataMap->nom)){
                $nameInDataMap = $dataMap->nom;
                $etablissement['nom'] = $nameInDataMap;
            }
            if(!empty($dataMap->title)){
                $TitleInDataMap = $dataMap->title;
                $etablissement['title'] = $TitleInDataMap;
            }
            if(!empty($dataMap->code_uai)){
                $codeUaiInDataMap = $dataMap->code_uai;
                $etablissement['code_uai'] = $codeUaiInDataMap;
            }
            if(!empty($dataMap->voie)){
                $adresseVoieInDataMap = $dataMap->voie;
                $etablissement['voie'] = $adresseVoieInDataMap;
            }
            if(!empty($dataMap->code_postal)){
                $adresseCpInDataMap = $dataMap->code_postal;
                $etablissement['code_postal'] = $adresseCpInDataMap;
            }

            $adresseCedexInDataMap = $dataMap->cedex;
            $etablissement['cedex'] = $adresseCedexInDataMap;
            $adresseCommuneInDataMap = $dataMap->commune;
            $etablissement['commune'] = $adresseCommuneInDataMap;
            $adresseArrondissementInDataMap = $dataMap->arrondissement;
            $etablissement['arrondissement'] = $adresseArrondissementInDataMap;
            $adresseBpInDataMap = $dataMap->bp;
            $etablissement['bp'] = $adresseBpInDataMap;
            $adresseDepartementInDataMap = $dataMap->departement;
            $adresseClasseIdentifierInDataMap = $adresseDepartementInDataMap->class_identifier;
            $adresseClasseNameInDataMap = $adresseDepartementInDataMap->class_name;
            $adresseDataMapInDataMap = $adresseDepartementInDataMap->data_map;
            $adresseLibelleInDataMap = $adresseDataMapInDataMap->libelle;
            $adresseCodeDepartementInDataMap = $adresseDataMapInDataMap->code_departement;
            $adresseRegionInDataMap = $dataMap->region;
            $adresseClasseIdentifierInDataMap = $adresseRegionInDataMap->class_identifier;
            $adresseClasseNameInDataMap = $adresseRegionInDataMap->class_name;
            $adresseRegionDataMapInDataMap = $adresseRegionInDataMap->data_map;
            $adresseLibelleRegionDataMapInDataMap = $adresseRegionDataMapInDataMap->libelle ;
            $adresseSynonymeRegionDataMapInDataMap = $adresseRegionDataMapInDataMap->synonyme ;
            $academieInDataMap = $dataMap->academie;
            $academieClasseIdentifierInDataMap = $academieInDataMap->class_identifier;
            $academieClasseNameInDataMap = $academieInDataMap->class_name;
            $academieDataMapInDataMap = $academieInDataMap->data_map;
            $academieLibelleDataMapInDataMap = $academieDataMapInDataMap->libelle;
            $etablissement['ac_name'] = $academieLibelleDataMapInDataMap;
            $lattitudeInDataMap = $dataMap->latitude;
            $etablissement['lattitude'] = $lattitudeInDataMap;
            $longitudeInDataMap = $dataMap->longitude;
            $etablissement['longitude'] = $longitudeInDataMap;
            return $etablissement ;
//            $etablissements[$etabId] = $etablissement;
//            echo "ID : ".$etabId.", Name : ".$etabName." , Code UAI : ".$codeUaiInDataMap.", Commune :".$adresseCommuneInDataMap.", Lattitude : ".$lattitudeInDataMap.", Longitude : ".$longitudeInDataMap."\n";
        }
        // var_dump($etablissements);

    }
}