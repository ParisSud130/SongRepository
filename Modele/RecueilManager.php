<?php


	Class RecueilManager extends Manager{
		/**
		 * 
		 **/
		public function getRecueil($recueilId){
			$recueil = null; //Pour l'instant nous n'avons pas de recueil
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
		
		public function getRecueils(){
			$recueils = null; //Pour l'instant nous n'avons pas de recueil
			$sql = "SELECT *
						FROM recueil";
						
			//va chercher les infos en bdd
			$stmt = $this->dbh->prepare($sql);
			$stmt->execute(array());
			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();
			if($count>0){
				$recueils = $this->hydrateRecueils($results);
			}
			return $recueils;
		}

		public function hydrateRecueil($result){
			$infos = array (
				'_idRecueil' => $result["idRecueil"],
				'_nomRecueil' => $result["nomRecueil"]);
	
			$recueil = new Recueil($infos);
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