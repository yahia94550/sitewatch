<?php
/**
 * Created by PhpStorm.
 * User: amine.yahia
 * Date: 15/01/19
 * Time: 12:48
 *
 * Convert Excel to CSV
 * V 1.0
 * Dyrk.org
 * (c) Dave Hill 2016 - 2017
 */

namespace Seedmetrix\ImportexcelBundle\Command
;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportFromIdeoExcelCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('fileconvert:xlsx')
            ->setDescription('Convertir un fichier excell au format csv')
            ->addArgument('excel', InputArgument::OPTIONAL, 'chemin vers le fichier à traiter ( format .xlsx )')
            ->addOption('read', null, InputOption::VALUE_NONE, 'Si définie, le résultat ne sera pa écrit dans un fichier')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $argv = $_SERVER['argv'];
        // var_dump($argv);die();
        if (!isset($argv[2]) || !is_file($argv[2]))

            exit("[usage] ./$argv[0] myexcelfile.xlsx\n");
        // On récupére le nom du fichier donner en input sans son extension
        $filenamewithoutextension = $this->getFileNameWithoutExtension($argv[2]);
        // On nomme le fichier de sortie avec l'extension ".csv"
        $outputFile = '/home/amine.yahia@onisep.fr/www/sitewatch/web/uploads/csv/' . $filenamewithoutextension . '.csv';
        // On liste les feuilles du document à traiter
        $sheetinexceldoc = ['xl/worksheets/sheet1.xml'];/*,'xl/worksheets/sheet3.xml','xl/worksheets/sheet4.xml','xl/worksheets/sheet5.xml',
        'xl/worksheets/sheet6.xml', 'xl/worksheets/sheet7.xml', 'xl/worksheets/sheet8.xml', 'xl/worksheets/sheet9.xml', 'xl/worksheets/sheet10.xml'];*/
// Entête de la page
        $headpage = '"id";"1/3";"1/4";"1/5";"1/6";"1/7";"1/8";"2/9";"2/10";"2/11";"2/12";"2/13";"2/14";"3/15";"3/16";"3/17";"3/18";"3/19"';
        $datatoget = [2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19];
        $id=$collegientag=$lyceentag=$etudianttag=$jdtag=$parent=$eepa=$metier=$formationetudes="";
        $emploi=$agendaeve=$procedureorientation=$handicap=$national=$regional=$academique=$multisite=$international="";
//       Text Dictionnary
        $handle = fopen("zip://$argv[2]#xl/sharedStrings.xml", 'r');
        if ($handle) {
            $result = '';
            while (!feof($handle)) $result .= fread($handle, 8192);
            fclose($handle);
            $content = str_replace("\n", "", $result);
            if (preg_match_all('/\<si>(.*?)\<\/si>/s', $result, $match)) {
                $dico = $match[1];
                foreach ($match[1] as $k => $v) $dico[$k] = strip_tags($v);
            }
        }
// On ouvre le fichier de sortie pour écrire
        $fichier_csv = fopen($outputFile, 'a');
        fputs($fichier_csv, $headpage);
        if (($zip = zip_open($argv[2]))) {
            while ($zip_entry = zip_read($zip)) {
                if (!zip_entry_open($zip, $zip_entry)) continue;
                $filename = zip_entry_name($zip_entry);
                if (preg_match("/xl\/worksheets\/sheet([0-9]{0,3}).xml/", $filename, $fileId)) {
                    //     Open File
                    $filesize = intval(zip_entry_filesize($zip_entry));
                    $content = zip_entry_read($zip_entry, $filesize);
//                    echo "\n\n\n\nFilename :; $filename;\n\n\n\n";
                    $rowReg = '/\<row [A-Za-z-0-9^_.:="\' ]{0,200}>(.*?)\<\/row>/s';
                    if (in_array($filename, $sheetinexceldoc)) {
                        echo "\n\n\n\nFilename :; $filename;\n\n\n\n";
                        if (preg_match_all($rowReg, $content, $data)) {
                            $rows = $data[1];
                            //       Read All Data Line
                            foreach ($rows as $k => $v) {
                                $colReg = '/\<c [A-Za-z-0-9^_.:="\' ]{0,200}(\>\<v>(.*?)\<\/v>|\/\>)/s';
                                if (preg_match_all($colReg, $v, $row)) {
                                    $rowData = $row[2];
                                    //  Extract All Record from Line
                                    $allligne = "";
                                    foreach ($rowData as $k => $v) {
                                        if (in_array($k, $datatoget)){
                                            //                                           echo $k . "\n";
                                            if (strstr($row[0][$k], 't="s"')) $v = str_replace("\n", '\n', $dico[$v]);
                                            $objectId = explode(',', $v);
                                            if(2 == $k) {
                                                if( 2 == sizeof($objectId)){
                                                    // echo "\n----------------\n";
                                                    $id = trim(preg_replace('/[^0-9]/', '', $objectId[1]));
                                                    // echo $ligne;
                                                    // echo "\n----------------\n";
                                                }
                                            }elseif(3 == $k && 2 > mb_strlen($v) ){
                                                1 == mb_strlen($v) ? $collegientag = 3 : $collegientag = 0;
                                            }elseif(4 == $k && 2 > mb_strlen($v) ){
                                                1 == mb_strlen($v) ? $lyceentag = 4 : $lyceentag = 0;
                                            }elseif(5 == $k && 2 > mb_strlen($v) ){
                                                1 == mb_strlen($v) ? $etudianttag = 5 : $etudianttag = 0;
                                            }elseif(6 == $k && 2 > mb_strlen($v) ){
                                                1 == mb_strlen($v) ? $jdtag = 6 : $jdtag = 0;
                                            }elseif(7 == $k && 2 > mb_strlen($v) ){
                                                1 == mb_strlen($v) ? $parent = 7 : $parent = 0;
                                            }elseif(8 == $k && 2 > mb_strlen($v) ){
                                                1 == mb_strlen($v) ? $eepa = 8 : $eepa = 0;
                                            }elseif(9 == $k && 2 > mb_strlen($v) ){
                                                1 == mb_strlen($v) ? $metier = 9 : $metier = 0;
                                            }elseif(10 == $k && 2 > mb_strlen($v) ){
                                                1 == mb_strlen($v) ? $formationetudes = 10 : $formationetudes = 0;
                                            }elseif(11 == $k && 2 > mb_strlen($v) ){
                                                1 == mb_strlen($v) ? $emploi = 11 : $emploi = 0;
                                            }elseif(12 == $k && 2 > mb_strlen($v) ){
                                                1 == mb_strlen($v) ? $agendaeve = 12 : $agendaeve = 0;
                                            }elseif(13 == $k && 2 > mb_strlen($v) ){
                                                1 == mb_strlen($v) ? $procedureorientation = 13 : $procedureorientation = 0;
                                            }elseif(14 == $k && 2 > mb_strlen($v) ){
                                                1 == mb_strlen($v) ? $handicap = 14 : $handicap = 0;
                                            }elseif(15 == $k && 2 > mb_strlen($v) ){
                                                1 == mb_strlen($v) ? $national = 15 : $national = 0;
                                            }elseif(16 == $k && 2 > mb_strlen($v) ){
                                                1 == mb_strlen($v) ? $regional = 16 : $regional = 0;
                                            }elseif(17 == $k && 2 > mb_strlen($v) ){
                                                1 == mb_strlen($v) ? $academique = 17 : $academique = 0;
                                            }elseif(18 == $k && 2 > mb_strlen($v) ){
                                                1 == mb_strlen($v) ? $multisite = 18 : $multisite = 0;
                                            }elseif(19 == $k && 2 > mb_strlen($v) ){
                                                1 == mb_strlen($v) ? $international = 19 : $international = 0;
                                            }

                                            //                                       var_dump($v);
//                                        die();
                                            //$ligne = '"' . addslashes(($v == '/>') ? '' : $v) . '";';
                                            //       $ligne = addslashes(($v == '/>') ? '' : $v) . ';';
                                            //       $allligne = $allligne . $ligne;
                                            //  echo $ligne;
                                            //  fputs($fichier_csv, $ligne);
                                        }
                                    }
                                    // if (!preg_match_all($preg, $allligne)) {
                                    //    echo $allligne;
                                    //    echo "\n";
                                    $allligne = $id.";".$collegientag.";".$lyceentag.";".
                                        $etudianttag.";".$jdtag.";".$parent.";".
                                        $eepa.";".$metier.";".$formationetudes.";".
                                        $emploi.";".$agendaeve.";".$procedureorientation.";".
                                        $handicap.";".$national.";".$regional.";".
                                        $academique.";".$multisite.";".$international;
                                    echo $allligne ;
                                    echo "\n" ;
                                    fputs($fichier_csv, $allligne);
                                    fputs($fichier_csv, "\n");
                                    //  }
                                }
                            }
                        }
                    }
                }
                zip_entry_close($zip_entry);
            }
            zip_close($zip);
        }
        fclose($fichier_csv);
    }

    public function getFileNameWithoutExtension($arg)
    {
        $splitepath = explode('/', $arg);
        $filenameinput = $splitepath[count($splitepath) - 1];
        $splitefilename = explode('.', $filenameinput);
        $filenamewithoutextension = $splitefilename[0];
        return $filenamewithoutextension;
    }


}