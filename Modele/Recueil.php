<?php

class Recueil{

	private $_idRecueil;
	private $_nomRecueil;


	public function __construct($args){
		// Si notre paramètre est un tableau non vide.
		if(is_array($args) && !empty($args)){
		     // Alors pour chaque clé, on récupère sa valeur.
			foreach($args as $key => $value){
				switch($key){
					
					case "_idRecueil":
						$this->_idRecueil = $value;
						break;
					case "_nomRecueil":
						$this->_nomRecueil = $value;
						break;
					default:
						break;
				}
		    }
		}
	}


	public function getIdRecueil(){ return $this->_idRecueil; }
	public function setIdRecueil(int $idRecueil){ $this->_idRecueil = $idRecueil; }

	public function getNomRecueil(){ return $this->_nomRecueil; }
	public function setNomRecueil(string $nomRecueil){ $this->_nomRecueil = $nomRecueil; }


}
?>