<?php

	class Bdd {
		
		

		//contiendra la connection à la db
		private $dbh;

		public function __construct(){
			$this->connect();
		}

		public function getDbh(){
			return $this->dbh;
		}

		//connexion à la base de données
		public function connect(){
			try {
				
				$this->dbh = new PDO('mysql:host='.Config::DB_HOST.';dbname='.Config::DB_NAME, Config::DB_USER, Config::DB_PASS, array(
					PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
					PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
				));

			} catch (PDOException $e) {
			    echo 'Erreur de connexion : ' . $e->getMessage();
			}
		}
		
	}