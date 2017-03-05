<?php
	Class ProfileController extends Controller{
		
		private $pm;


		public function __construct(){
			$this->pm = new ProfileManager();
		}
		

		function goback($error = ""){
			$params = [];
			if($error != ""){
				$params = array ( "error" => $error);
			}
			$sc = new SongController();
			$sc->homeAction();
			die();
		}


		function handleLoginAction(){

			$error="test";
			//redirige vers le formulaire de connexion
			//en cas d'erreurs
			if (empty($_POST)){
				$this->goback("formulaire non soumis");
			}

			//info de connexion vide ?
			if (empty($_POST['login'])){
				$error = "Veuillez entrer un nom d'utilisateur ou un email";
				$this->goback($error);
				die();
			}
			elseif(empty($_POST['password'])){
				$error = "Veuillez entrer votre mot de passe !";
				goback($error);
				die();
			}
			//existe en base ?
			else {
				$hashed_password = hash("sha512", $_POST['password']);
				$loginSuccess = $this->pm->login($_POST['login'], $hashed_password);
				if (!$loginSuccess){
					$this->goback("Erreur d'identification !") ;
				}
				$this->goback() ;
				die();
			}
			$this->goback("Une erreur inconnue s'est produite") ;
		}

		function logoutAction(){

			if(isset($_SESSION)){
				unset($_SESSION);
				session_destroy();
			}
			session_start();

			setcookie("remember_me_user", "", 1, "/");
			setcookie("remember_me_token", "", 1, "/");
			$this->goback();
			die();
		}


	}
?>