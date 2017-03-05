<?php

	class Controller {

		protected function redirect($controller, $method, $params = NULL){
			header("Location: " . Router::generateUrl($controller, $method, $params) );
            die();
		}

	}