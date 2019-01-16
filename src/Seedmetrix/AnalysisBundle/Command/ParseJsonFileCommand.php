<?php

namespace Seedmetrix\AnalysisBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ParseJsonFileCommand extends ContainerAwareCommand
{

    //$feuille = $document_excel->getSheet(0);

    protected function configure()
    {
        $this
            ->setName('convert:xlsx')
            ->setDescription('Convertir un fichier excell au format csv')
            ->addArgument('excel', InputArgument::OPTIONAL, 'chemin vers le fichier à traiter ( format .xlsx )')
            ->addOption('read', null, InputOption::VALUE_NONE, 'Si définie, le résultat ne sera pa écrit dans un fichier');
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
        $outputFile = '/home/amine.yahia@onisep.fr/stage3/' . $filenamewithoutextension . '.csv';
        // On liste les feuilles du document à traiter
        $sheetinexceldoc = ['xl/worksheets/sheet1.xml'];/*,'xl/worksheets/sheet3.xml','xl/worksheets/sheet4.xml','xl/worksheets/sheet5.xml',
        'xl/worksheets/sheet6.xml', 'xl/worksheets/sheet7.xml', 'xl/worksheets/sheet8.xml', 'xl/worksheets/sheet9.xml', 'xl/worksheets/sheet10.xml'];*/
        // Entête de la page
        $headpage = '"TITRE de l\'article";"DATE";"ID";"Collégien";"lycéen";"étudiant";"jeune diplômé";' .
            '"parent";"équipe éducative et professionnels accompagnants";"métier";"formation/Etudes";' .
            '"emploi";"agenda-événement";"procédure d’orientation";"handicap";"national";"régional";' .
            '"académique";"multi-site";"international"';
        $preg = "/équipe éducative et professionnels accompagnants/";
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
                                        if (strstr($row[0][$k], 't="s"')) $v = str_replace("\n", '\n', $dico[$v]);
                                        $ligne = '"' . addslashes(($v == '/>') ? '' : $v) . '";';
                                        $allligne = $allligne . $ligne;
                                        //  echo $ligne;
                                        //  fputs($fichier_csv, $ligne);
                                    }
                                    if (!preg_match_all($preg, $allligne)) {
                                        echo $allligne;
                                        echo "\n";
                                        fputs($fichier_csv, $allligne);
                                        fputs($fichier_csv, "\n");
                                    }
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