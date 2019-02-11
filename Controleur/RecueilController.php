<?php


	class RecueilController extends Controller{
		
		private $rm;	
		private $sm;	


		public function __construct(){
			$this->rm = new RecueilManager();
			$this->sm = new ChantManager();
		}
				
		public function showAction(){
    		$mostViewedSongs = $this->sm->getMostViewedSongs();
			if (isset($_GET["id"]) && is_numeric($_GET["id"])){
				$id = $_GET["id"];
				$recueil = $this->rm->getRecueil($id);
				$numberOfSongs = $this->rm->getnumberOfSongsInRecueil($id);
				$recueils = $this->rm->getRecueils();
				if(isset($recueil)){//Si le recueil existe
					if (isset($_GET["page"]) && is_numeric($_GET["page"])){
						$page = $_GET["page"] > 1 ? $_GET["page"] : 1 ;
						$offset = ($page-1)*Config::NUMBER_OF_SONGS_PER_PAGE;
	    				$songs = $this->sm->getSongsByRecueil($id, $offset, Config::NUMBER_OF_SONGS_PER_PAGE);//On récupère les chants du recueil
					} 
					else {
	    				$songs = $this->sm->getSongsByRecueil($id);//On récupère les chants du recueil
					}
	        		$intro = "Les chants du recueil ".$recueil->getNomRecueil();
				}
				else {
		        	$intro = "Le recueil n'existe pas";
		            $songs = $this->sm->getLastSongs();
				}
			} 
			else {
	        	$intro = "Le recueil n'existe pas";
	            $songs = $this->sm->getLastSongs();
			}
			$params = compact( "songs",  "mostViewedSongs",  "intro");
			new View("liste.php", Config::APP_NAME, $params);
		}
}
?>