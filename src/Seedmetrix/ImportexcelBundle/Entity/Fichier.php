<?php
/**
 * Created by PhpStorm.
 * User: amine.yahia
 * Date: 18/01/19
 * Time: 15:14
 */

namespace Seedmetrix\ImportexcelBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

class Fichier
{

    private $fichier;

    public function getFichier()
    {
        return $this->fichier;
    }

    public function setFichier($fichier)
    {
        $this->fichier = $fichier;

        return $this;
    }
}