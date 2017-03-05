<?php

	class Loader {

		public function __construct(){
			spl_autoload_register(function($className){
				$folders = Config::$class_folders;
				foreach($folders as $folder){
					if (file_exists($folder . "/" . $className . ".php")){
						require($folder . "/" . $className . ".php");
					}
				}
			});
		}

	}