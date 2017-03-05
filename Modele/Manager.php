<?php

	class Manager {

		protected $dbh;

		public function __construct(){
			$db = new Bdd();
			$this->dbh = $db->getDbh();
		}

	}