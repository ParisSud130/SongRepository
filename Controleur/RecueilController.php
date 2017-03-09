<?php


	class RecueilController extends Controller{
		
		private $rm;	
		private $sm;	


		public function __construct(){
			$this->rm = new RecueilManager();
			$this->sm = new SongManager();
		}
				
		public function showAction(){
			if (isset($_GET["id"])){
				$id = $_GET["id"];
				$recueil = $this->rm->getRecueil($id);
    			$mostViewedSongs = $this->sm->getMostViewedSongs();
				if(isset($recueil)){//Si le recueil existe
    				
        			$intro = "Les chants du recueil ".$recueil->getNomRecueil();
    			    $songs = $this->sm->getSongsByRecueil($id);//On récupère les chants du recueil
				}
				else{//Sinon
        			$intro = "Le recueil n'existe pas";
                    $songs = $this->sm->getLastSongs();
				}
			    $params = array( "songs"=>$songs,  "mostViewedSongs"=>$mostViewedSongs,  "intro"=>$intro );
        		new View("accueil.php", Config::APP_NAME, $params);
			}
		}
}
?>