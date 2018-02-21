<?php

class Trame{
	
	private $_idTrame;				//Identifiant de la trame
	private $_dateCreation;			//Date de création de la trame
	private $_dateModification;		//Date de dernière modification de la trame
	private $_dateExecution;		//Date d'exécution de la trame
	private $_proprietaire;			//propriétaire/créateur de la trame
	private $_commentaire;			//commentaire 
	private $_chants;				//liste des chants de la trame
	
	public function __construct($args){
		// Si notre paramètre est un tableau non vide.
		if(is_array($args) && !empty($args)){
		     // Alors pour chaque clé, on récupère sa valeur.
			foreach($args as $key => $value){
				switch($key){
					
					case "_idTrame":
						$this->_idTrame = $value;
						break;
					case "_dateCreation":
						$this->_dateCreation = $value;
						break;
					case "_dateModification":
						$this->_dateModification = $value;
						break;
					case "_dateExecution":
						$this->_dateExecution = $value;
						break;
					case "_proprietaire":
						$this->_proprietaire = $value;
						break;
					case "_commentaire":
						$this->_commentaire = $value;
						break;
					default:
						break;
				}
		    }
		}
	}

	//getters et setters

	public function getIdTrame(){ return $this->_idChant; }
	public function setIdTrame($idChant){ $this->_idChant = $idChant; }
		
	public function getDateCreation(){ return $this->_dateCreation; }
	public function setDateCreation($dateCreation){ $this->_dateCreation = $dateCreation; }
		
	public function getDateModification(){ return $this->_dateModification; }
	public function setDateModification($dateModification){ $this->_dateModification = $dateModification; }
		
	public function getIdDateExecution(){ return $this->_idDateExecution; }
	public function setIdDateExecution($idDateExecution){ $this->_idDateExecution = $idDateExecution; }
		
	public function getProprietaire(){ return $this->_proprietaire; }
	public function setProprietaire($proprietaire){ $this->_proprietaire = $proprietaire; }
		
	public function getCommentaire(){ return $this->_commentaire; }
	public function setCommentaire($commentaire){ $this->_commentaire = $commentaire; }

	public function getChants(){ return $this->_chants; }
	public function setChants(array $chants){ 
		if(is_array($chants) && !empty($chants)){
			$this->chants = $chants; 
		}
	}

	public function getChant($numChant){ return $this->_chants[$numChant]; }
}
?>