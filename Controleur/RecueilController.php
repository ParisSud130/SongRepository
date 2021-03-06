<?php


	class RecueilController extends Controller{
		
		private $rm;	
		private $sm;	


		public function __construct(){
			$this->rm = new RecueilManager();
			$this->sm = new ChantManager();
		}
				
		public function showAction(){
			if (isset($_GET["id"])){
				$id = $_GET["id"];
				$recueil = $this->rm->getRecueil($id);
				$recueils = $this->rm->getRecueils();
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
				new View("liste.php", Config::APP_NAME, $params);
			}
		}
}
?>