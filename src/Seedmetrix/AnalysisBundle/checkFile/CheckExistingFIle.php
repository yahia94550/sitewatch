<?php

namespace Seedmetrix\AnalysisBundle\checkFile;
use Symfony\Component\Finder\SplFileInfo ;
class CheckExistingFIle
{
 
    /**
   * Vérifie la présence d'un fichier , et renvoi le chemin et le nom du fichier
   *
   * @param string $text
   * @return bool
   */
  public function FileExist($path)
    {
      
        if(is_file($path)){
          // echo $path."\n" ;
           // Récupérer le nom du fichier
           $filename = basename($path);
           // Récupérer le chemin du fichier
           $pathname = dirname($path);
           $info = new SplFileInfo($filename , "", "" );
           //$extension = pathinfo($info->getFilename(), PATHINFO_EXTENSION);
           // Récupérer l'extension 
           $extension = $info->getExtension();
           //var_dump($extension);
        
           echo $pathname." + ".$filename." + ".$extension ;
    }
  }
  
}
