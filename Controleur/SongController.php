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
			$searchedSongs = $this->sm->searchSongs($keywords);
			$mostViewedSongs = $this->sm->getMostViewedSongs();
			//shoote la vue
			$intro = "Les chants contenant $keywords";
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
					die();
				}
			}
			die("chant introuvable; page à coder");
		}
}
?>