<?php

class ChantDeTrame{
	
	private $_idTrame			//Identifiant de la trame
	private $_idChant;			//Identifiant du chant
	private $_ordre;			//Position du chant dans la trame
	private $_commentaire;		//Commentaire
	private $_chant;			//Chant de la classe Chant
	private $_strophes;			//Tableau de strophes de la classe StropheDeChantDeTrame
	
	public function __construct($args){
		// Si notre paramètre est un tableau non vide.
		if(is_array($args) && !empty($args)){
		     // Alors pour chaque clé, on récupère sa valeur.
			foreach($args as $key => $value){
				switch($key){
					
					case "_idTrame":
						$this->_idTrame = $value;
						break;
					case "_idChant":
						$this->_idChant = $value;
						break;
					case "_ordre":
						$this->_ordre = $value;
						break;
					case "_commentaire":
						$this->_commentaire = $value;
						break;
					case "_chant":
						$this->_chant = $value;
						break;
					default:
						break;
				}
		    }
		}
	}

	//getters et setters

		
	public function getIdTrame(){ return $this->_idTrame; }
	public function setIdTrame($idTrame){ $this->_idTrame = $idTrame; }

		
	public function getIdChant(){ return $this->_idChant; }
	public function setIdChant($idChant){ $this->_idChant = $idChant; }

		
	public function getOrdre(){ return $this->_ordre; }
	public function setOrdre($ordre){ $this->_ordre = $ordre; }

		
	public function getCommentaire(){ return $this->_commentaire; }
	public function setCommentaire($commentaire){ $this->_commentaire = $commentaire; }

		
	public function getChant(){ return $this->_chant; }
	public function setChant($chant){ $this->_chant = $chant; }

		
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