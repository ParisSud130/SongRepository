<?php

class Strophe{		//Appelée Strophe par manque de meilleur mot, Cela correspond plutôt à une "partie de chant" quelconque
	
	private $_idStrophe;	//Identifiant de la partie de chant
	private $_type;			//Type de la partie de chant : strophe, refrain, pont...
	private $_identifiant;	//Identifiant de cette partie de chant
	private $_texte;		//Paroles de la partie du chant
	private $_position;		//Position de la partie dans le chant
	private $_idChant;		//Identifiant du chant dont la strophe fait partie
	
	public function __construct($args){
		// Si notre paramètre est un tableau non vide.
		if(is_array($args) && !empty($args)){
		     // Alors pour chaque clé, on récupère sa valeur.
			foreach($args as $key => $value){
				switch($key){
					
					case "_idStrophe":
						$this->_idStrophe = $value;
						break;
					case "_type":
						$this->_type = $value;
						break;
					case "_identifiant":
						$this->_identifiant = $value;
						break;
					case "_texte":
						$this->_texte = $value;
						break;
					case "_position":
						$this->_position = $value;
						break;
					case "_idChant":
						$this->_idChant = $value;
						break;
					default:
						break;
				}
		    }
		}
	}
	

	//getters et setters
		
	public function getIdStrophet(){ return $this->_idStrophe; }
	public function setIdStrophet($idStrophe){ $this->_idStrophe = $idStrophe; }
		
	public function getType(){ return $this->_type; }
	public function setType($type){ $this->_type = $type; }
		
	public function getIdentifiant(){ return $this->_identifiant; }
	public function setIdentifiant($identifiant){ $this->_identifiant = $identifiant; }
		
	public function getTexte(){ return $this->_texte; }
	public function setTexte($texte){ $this->_texte = $texte; }
		
	public function getPosition(){ return $this->_position; }
	public function setPosition($position){ $this->_position = $position; }
		
	public function getIdChant(){ return $this->_idChant; }
	public function setIdChant($idChant){ $this->_idChant = $idChant; }
	
}
?>