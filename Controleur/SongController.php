<?php
	class SongController extends Controller{
		
		private $sm;	
		private $tm;	


		public function __construct(){
			$this->sm = new SongManager();
			$this->tm = new ThemeManager();
		}
				
		public function homeAction(){
			$lastSongs = $this->sm->getLastSongs();
			$mostViewedSongs = $this->sm->getMostViewedSongs();
			$intro = "Les dernières chansons ajoutées sur ".Config::APP_NAME;
			$params = array( "songs"=>$lastSongs,  "mostViewedSongs"=>$mostViewedSongs,  "intro"=>$intro);
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

			//shoote la vue
			$params = array( "songs"=>$searchedSongs,  "mostViewedSongs"=>$mostViewedSongs,  "intro"=>$intro );
			new View("accueil.php", Config::APP_NAME, $params);
		}
		
		public function showAction(){
			if (isset($_GET["id"])){
				$id = $_GET["id"];
				$song = $this->sm->getSong($id);
				$mostViewedSongs = $this->sm->getMostViewedSongs();
				if($song != null){
					$intro = $song->getTitre();
					if($song->getRecueil() != NULL){
						if($song->getRecueil()->getNomRecueil() != NULL){
							$nomRecueil = $song->getRecueil()->getNomRecueil();
							$numChant = $song->getNumChant();
							$titre = $song->getTitre();
							$intro = "$nomRecueil #$numChant - $titre";
						}
					}
					$this->sm->songSeen($song);
					$params = array( "song"=>$song,  "mostViewedSongs"=>$mostViewedSongs,  "intro"=>$intro );
					new View("detail.php", Config::APP_NAME." - ".$song->getTitre(), $params);
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