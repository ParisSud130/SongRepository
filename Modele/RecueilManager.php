<?php


	Class RecueilManager extends Manager{
		/**
		 * 
		 **/
		public function getRecueil($recueilId){
			$song = null; //Pour l'instant nous n'avons pas de chanson
			$sql = "SELECT recueil.* 
						FROM recueil 
						WHERE recueil.idRecueil = ?";
			//va chercher les infos en bdd
			$stmt = $this->dbh->prepare($sql);
			$stmt->execute(array($recueilId));
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();
			if($count>0){
				$recueil = $this->hydrateRecueil($result);
			}
			return $recueil;
		}

		public function hydrateRecueil($result){
			$infos = array (
				'_idRecueil' => $result["idRecueil"],
				'_nomRecueil' => $result["nomRecueil"]);
	
			$recueil = new Strophe($infos);
			return $recueil;
		}

		public function hydrateRecueils($results){
			$recueils = [];
			foreach($results as $result) {
				$recueils[] = $this->hydrateRecueil($result);
			}
			return $recueils;
		}

	}


	?>