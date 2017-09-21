<?php

	class Config {

		/*** DATABASE INFORMATIONS ***/
		const DB_HOST = "localhost";
		const DB_USER = "songRep";
		const DB_PASS = "songRep";
		const DB_NAME = "song_repository";

		static public $class_folders = array(__DIR__, "Utils/fpdf", "Modele", "Vue", "Controleur", "Utils", "Utils/kint");
		const HOME_CONTROLLER = "ChantController";
		const HOME_METHOD = "homeAction";
		const BASE_URL = "localhost/SongRepository/";
		
		const APP_NAME = "SongRep";
		
	}