<?php
	Class Profil{
		private $_idProfil;
		private $_login;
		private $_commentaire;
		
		
		public function __construct($args){
			
		}
		
		public function getLogin(){ return $this -> $_login; }
		
		public function getCommentaire(){
			return $this -> $_commentaire;
		}
		
		
	}
?>