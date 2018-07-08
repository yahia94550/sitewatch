<?php

namespace Seedmetrix\AnalysisBundle\Antispam;

class SeedmetrixAntispam
{
 
    /**
   * Vérifie si le texte est un spam ou non
   *
   * @param string $text
   * @return bool
   */
  public function isSpam($text)
  {
    return strlen($text) < 50;
  }
  
}


