<?php
	class ChantController extends Controller{
		
		private $sm;	
		private $tm;
		private $rm;
		


		public function __construct(){
			$this->sm = new ChantManager();
			$this->tm = new ThemeManager();
			$this->rm = new RecueilManager();
			
		}
				
		public function homeAction(){
			$lastSongs = $this->sm->getLastSongs();
			$mostViewedSongs = $this->sm->getMostViewedSongs();
			$recueils = $this->rm->getRecueils();
			$intro = "Les dernières chansons ajoutées sur ".Config::APP_NAME;
			$params = compact( "songs",  "mostViewedSongs",  "intro", "recueils");
			new View("accueil.php", Config::APP_NAME, $params);
		}
	
		public function searchAction(){
			//rcupre les mots-cl saisis par l'utilisateur
			$keywords = (empty($_POST['keywords'])) ? "" : $_POST['keywords'];

			// 1 : On force la conversion en nombre entier
			$numberToSearch = (int) $keywords;
			if ($numberToSearch >= 1 ) {//Si le nombre obtenu est supérieur à 1, c'est un numéro qui a été entré
				$searchedSongs = $this->sm->getSongsByNumChant($numberToSearch);
				$intro = "Les chants ayant pour numéro $numberToSearch";
			}
			else{//Sinon on cherche la chaine telle qu'elle a été saisie
				$searchedSongs = $this->sm->searchSongs($keywords);
				$intro = "Les chants contenant $keywords";
			}

			$mostViewedSongs = $this->sm->getMostViewedSongs();
			$recueils = $this->rm->getRecueils();

			//shoote la vue
			$params = compact("songs", "mostViewedSongs", "intro", "recueils");
			new View("accueil.php", Config::APP_NAME, $params);
		}
		
		public function showAction(){
			if (isset($_GET["id"])){
				$song = $this->sm->getSong($_GET["id"]);
				$mostViewedSongs = $this->sm->getMostViewedSongs();
				if($song != null){
					$numChant = $song->getNumChant();
					$titre = $song->getTitre();
					$urlRecueil = $song->getIdRecueil() == NULL ? "#" : Router::generateRelativeUrl('recueil', 'show', array('id'=>$song->getIdRecueil()));
					if($song->getRecueil() != NULL){
						$nomRecueil = $song->getRecueil()->getNomRecueil() == NULL ? "" : $song->getRecueil()->getNomRecueil();
					}
					$recueils = $this->rm->getRecueils();
					$this->sm->songSeen($song);
					$params = compact("song","mostViewedSongs", "recueils", "urlRecueil", "nomRecueil", "numChant", "titre");
					new View("detail.php", Config::APP_NAME, $params);
				}
				else{ 
					die("chant introuvable; page à coder");
				}
			}
			else{
				$this->homeAction();
			}
		}
}
?>