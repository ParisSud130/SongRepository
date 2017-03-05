<?php

	class View {

		public function __construct($template, $title, array $params = NULL){
			if (!empty($params)) { 
				extract($params); 
			}

			//pour simplifier l'accès dans la vue
			$user = false;
			if (!empty($_SESSION['login'])){
				$user = $_SESSION['login'];
			}

			include("layout.php");
		}

		//shortcut pour echo Router::generateUrl pour les vues...
		public function url($controller, $method, array $params = array()){
			//var_dump($params);
			echo Router::generateUrl($controller, $method, $params);
		}
		//shortcut pour echo Router::generateUrl pour les vues...
		public function relativeUrl($controller, $method, array $params = array()){
			//var_dump($params);
			echo Router::generateRelativeUrl($controller, $method, $params);
		}
		

	}

?>