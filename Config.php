<?php

	class Config {

		/*** DATABASE INFORMATIONS ***/
		const DB_HOST = "localhost";
		const DB_USER = "root";
		const DB_PASS = "Ninj@kid041292";
		const DB_NAME = "song_repository";

		static public $class_folders = array(__DIR__, "Utils/fpdf", "Modele", "Vue", "Controleur", "Utils", "Utils/kint");
		const HOME_CONTROLLER = "ChantController";
		const HOME_METHOD = "homeAction";
		const BASE_URL = "localhost/SongRepository/";
		
		const APP_NAME = "SongRep";
		
	}