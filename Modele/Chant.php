<?php

class Chant{
	
	private $_idChant;			//Identifiant du chant
	private $_titre;			//Titre du chant
	private $_titreUsuel;		//Titre utilisé habituellement si différent du vrai titre 
	private $_idRecueil;		//Identifiant du recueil (voir si je le garde)
	private $_auteur;			
	private $_compositeur;	
	private $_copyright;
	private $_tonalite;
	private $_lien;
	private $_typeLien;
	private $_commentaire;
	private $_etat;
	private $_dateModification;	//Date de dernière modificcation du chant
	private $_nbConsultations;	//Nombre de fois que le chant a été consulté
	private $_numChant;			//Numéro du chant dans le recueil
	private $_strophes;
	private $_recueil;			//Objet recueil associé au chant
	
	public function __construct($args){
		// Si notre paramètre est un tableau non vide.
		if(is_array($args) && !empty($args)){
		     // Alors pour chaque clé, on récupère sa valeur.
			foreach($args as $key => $value){
				switch($key){
					
					case "_idChant":
						$this->_idChant = $value;
						break;
					case "_titre":
						$this->_titre = $value;
						break;
					case "_titreUsuel":
						$this->_titreUsuel = $value;
						break;
					case "_idRecueil":
						$this->_idRecueil = $value;
						break;
					case "_auteur":
						$this->_auteur = $value;
						break;
					case "_compositeur":
						$this->_compositeur = $value;
						break;
					case "_copyright":
						$this->_copyright = $value;
						break;
					case "_tonalite":
						$this->_tonalite = $value;
						break;
					case "_lien":
						$this->_lien = $value;
						break;
					case "_typeLien":
						$this->_typeLien = $value;
						break;
					case "_commentaire":
						$this->_commentaire = $value;
						break;
					case "_etat":
						$this->_etat = $value;
						break;
					case "_dateModification":
						$this->_dateModification = $value;
						break;
					case "_nbConsultations":
						$this->_nbConsultations = $value;
						break;
					case "_numChant":
						$this->_numChant = $value;
						break;
					case "_strophes":
						$this->_strophes = $value;
						break;
					case "_recueil":
						if (is_a($value, 'Recueil')) {
							$this->_recueil = $value;
						}
						break;
					default:
						break;
				}
		    }
		}
	}

	//getters et setters

		
	public function getIdChant(){ return $this->_idChant; }
	public function setIdChant($idChant){ $this->_idChant = $idChant; }

		
	public function getTitre(){ return $this->_titre; }
	public function setTitre($titre){ $this->_titre = $titre; }

		
	public function getTitreUsuel(){ return $this->_titreUsuel; }
	public function setTitreUsuel($titreUsuel){ $this->_titreUsuel = $titreUsuel; }

		
	public function getIdRecueil(){ return $this->_idRecueil; }
	public function setIdRecueil($idRecueil){ $this->_idRecueil = $idRecueil; }

		
	public function getAuteur(){ return $this->_auteur; }
	public function setAuteur($auteur){ $this->_auteur = $auteur; }

		
	public function getCompositeur(){ return $this->_compositeur; }
	public function setCompositeur($compositeur){ $this->_compositeur = $compositeur; }

		
	public function getCopyright(){ return $this->_copyright; }
	public function setCopyright($copyright){ $this->_copyright = $copyright; }

		
	public function getTonalite(){ return $this->_tonalite; }
	public function setTonalite($tonalite){ $this->_tonalite = $tonalite; }

		
	public function getLien(){ return $this->_lien; }
	public function setLien($lien){ $this->_lien = $lien; }

		
	public function getTypeLien(){ return $this->_typeLien; }
	public function setTypeLien($typeLien){ $this->_typeLien = $typeLien; }

		
	public function getCommentaire(){ return $this->_commentaire; }
	public function setCommentaire($commentaire){ $this->_commentaire = $commentaire; }

		
	public function getEtat(){ return $this->_etat; }
	public function setEtat($etat){ $this->_etat = $etat; }

		
	public function getDateModification(){ return $this->_dateModification; }
	public function setDateModification($dateModification){ $this->_dateModification = $dateModification; }

		
	public function getNbConsultations(){ return $this->_nbConsultations; }
	public function setNbConsultations($nbConsultations){ $this->_nbConsultations = $nbConsultations; }

		
	public function getNumChant(){ return $this->_numChant; }
	public function setNumChant($numChant){ $this->_numChant = $numChant; }
	
	
	public function getStrophes(){ return $this->_strophes; }
	public function setStrophes(array $strophes){ 
		if(is_array($strophes) && !empty($strophes)){
			$this->_strophes = $strophes; 
		}
	}
	public function getStrophe($numStrophe){ return $this->_strophes[$numStrophe]; }

	public function getRecueil(){ return $this->_recueil; }
	public function setRecueil(Recueil $recueil){ 
		if (is_a($recueil, 'Recueil')) {
			$this->_recueil = $recueil; 
		}
	}
	
	

}
?>