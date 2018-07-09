<?php

namespace Seedmetrix\AnalysisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stages
 *
 * @ORM\Table(name="stages", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})})
 * @ORM\Entity
 */
class Stages
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="isvalid", type="blob", length=255, nullable=false)
     */
    private $isvalid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation", type="datetime", nullable=false)
     */
    private $creation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin", type="datetime", nullable=false)
     */
    private $fin;

    /**
     * @var string
     *
     * @ORM\Column(name="membre", type="string", length=225, nullable=false)
     */
    private $membre;

    /**
     * @var string
     *
     * @ORM\Column(name="societe", type="string", length=225, nullable=false)
     */
    private $societe;

    /**
     * @var string
     *
     * @ORM\Column(name="metier", type="string", length=225, nullable=false)
     */
    private $metier;

    /**
     * @var string
     *
     * @ORM\Column(name="duree", type="string", length=105, nullable=false)
     */
    private $duree;

    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=5, nullable=false)
     */
    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=105, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=225, nullable=false)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="string", length=45, nullable=false)
     */
    private $contenu;

    /**
     * @var string|null
     *
     * @ORM\Column(name="profil", type="string", length=225, nullable=true)
     */
    private $profil;

    /**
     * @var float|null
     *
     * @ORM\Column(name="remenuration", type="float", precision=10, scale=0, nullable=true)
     */
    private $remenuration;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_candidat", type="integer", nullable=false)
     */
    private $nbCandidat = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="url", type="string", length=105, nullable=true)
     */
    private $url;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categorie = new \Doctrine\Common\Collections\ArrayCollection();
    }

     //****************************  Getteur et setteur ***********************************************//

    /**
     * Get id
     *
     * @return integer
     */

    public function getId() {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Stage
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * Get IsValid
     *
     * @return boolean
     */

    public function getIsValid() {
        return $this->isvalid;
    }

    /**
     * Set IsValid
     *
     * @param boolean $isvalid
     *
     * @return Stage
     */
    public function setIsValid($isvalid) {
        $this->isvalid = $isvalid;
        return $this;
    }

    /**
     * Get creation
     *
     * @return date
     */

    public function getCreation() {
        return $this->creation;
    }

    /**
     * Set creation
     *
     * @param date $creation
     *
     * @return Stage
     */
    public function setCreation($creation) {
        $this->creation = $creation;
        return $this;
    }

    /**
     * Get fin
     *
     * @return date
     */

    public function getFin() {
        return $this->fin;
    }

    /**
     * Set fin
     *
     * @param date $fin
     *
     * @return Stage
     */
    public function setFin($fin) {
        $this->fin = $fin;
        return $this;
    }

    /**
     * Get membre
     *
     * @return string
     */

    public function getMembre() {
        return $this->membre;
    }

    /**
     * Set membre
     *
     * @param string $membre
     *
     * @return Stage
     */
    public function setMembre($membre) {
        $this->membre = $membre;
        return $this;
    }

    /**
     * Get societe
     *
     * @return string
     */

    public function getSociete() {
        return $this->societe;
    }

    /**
     * Set societe
     *
     * @param string $societe
     *
     * @return Stage
     */
    public function setSociete($societe) {
        $this->societe = $societe;
        return $this;
    }

    /**
     * Get metier
     *
     * @return string
     */

    public function getMetier() {
        return $this->metier;
    }

    /**
     * Set metier
     *
     * @param string $metier
     *
     * @return Stage
     */
    public function setMetier($metier) {
        $this->metier = $metier;
        return $this;
    }

    /**
     * Get duree
     *
     * @return string
     */

    public function getDuree() {
        return $this->duree;
    }

    /**
     * Set duree
     *
     * @param string $duree
     *
     * @return Stage
     */
    public function setDuree($duree) {
        $this->duree = $duree;
        return $this;
    }

    /**
     * Get cp
     *
     * @return string
     */

    public function getCp() {
        return $this->cp;
    }

    /**
     * Set cp
     *
     * @param string $cp
     *
     * @return Stage
     */
    public function setCp($cp) {
        $this->cp = $cp;
        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */

    public function getType() {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Stage
     */
    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */

    public function getLibelle() {
        return $this->libelle;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Stage
     */
    public function setLibelle($libelle) {
        $this->libelle = $libelle;
        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */

    public function getContenu() {
        return $this->contenu;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Stage
     */
    public function setContenu($contenu) {
        $this->contenu = $contenu;
        return $this;
    }

    /**
     * Get profil
     *
     * @return string
     */

    public function getProfil() {
        return $this->profil;
    }

    /**
     * Set profil
     *
     * @param string $profil
     *
     * @return Stage
     */
    public function setProfil($profil) {
        $this->profil = $profil;
        return $this;
    }

    /**
     * Get remenuration
     *
     * @return float
     */

    public function getRemenuration() {
        return $this->remenuration;
    }

    /**
     * Set remenuration
     *
     * @param string $remenuration
     *
     * @return Stage
     */
    public function setRemenuration($remenuration) {
        $this->remenuration = $remenuration;
        return $this;
    }

    /**
     * Get nbCandidat
     *
     * @return float
     */

    public function getNbCandidat() {
        return $this->nbCandidat;
    }

    /**
     * Set nbCandidat
     *
     * @param integer $nbCandidat
     *
     * @return Stage
     */
    public function setNbCandidat($nbCandidat) {
        $this->nbCandidat = $nbCandidat;
        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */

    public function getUrl() {
        return $this->url;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Stage
     */
    public function setUrl($url) {
        $this->url = $url;
        return $this;
    }
}
