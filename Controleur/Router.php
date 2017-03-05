<?php

	class Router {

		private $controller;
		private $method;

		public function __construct(){
			$this->analyseUrl();
		}

		public function analyseUrl(){
			$this->controller = Config::HOME_CONTROLLER;
			if (!empty($_GET['c'])){
				$this->controller = ucfirst(strtolower($_GET['c'])) . "Controller";
			}

			$this->method = Config::HOME_METHOD;
			if (!empty($_GET['m'])){
				$this->method = $_GET['m'] . "Action";
			}
		}

		public function go(){
			$controller = new $this->controller();
			call_user_func(array($controller, $this->method));
		}

		public static function generateUrl($controller, $method, $params = array()){
			$url = Config::BASE_URL ."?c=". str_ireplace("controller","",strtolower($controller)) . "&m=" . str_ireplace("action","",strtolower($method));
			if (!empty($params)){
				$url .= "&";
				foreach($params as $k=>$v){
					$url .= $k . "=" . $v . "&";
				}
				$url = substr($url, 0, -1);
			}
			return $url;
		}
		
		public static function generateRelativeUrl($controller, $method, $params = array()){
			$url = "?c=". str_ireplace("controller","",strtolower($controller)) . "&m=" . str_ireplace("action","",strtolower($method));
			if (!empty($params)){
				$url .= "&";
				foreach($params as $k=>$v){
					$url .= $k . "=" . $v . "&";
				}
				$url = substr($url, 0, -1);
			}
			return $url;
		}

	}