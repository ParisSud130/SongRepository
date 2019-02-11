<?php


	Class RecueilManager extends Manager{
		/**
		 * 
		 **/
		public function getRecueil(int $recueilId){
			$recueil = null; //Pour l'instant nous n'avons pas de recueil
			$sql = "SELECT recueil.* 
						FROM recueil 
						WHERE recueil.idRecueil = :recueilId";
			//va chercher les infos en bdd
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindValue(':recueilId', $recueilId, PDO::PARAM_INT);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();
			if($count>0){
				$recueil = $this->hydrateRecueil($result);
			}
			return $recueil;
		}

		/**
		 * Récupère le nombre de chants du recueil dont l'identifiant a été passé en paramètre
		 **/
		public function getnumberOfSongsInRecueil(int $recueilId){
			$sql = "SELECT count(*)
						FROM chant
						WHERE chant.idRecueil = :recueilId";
			//va chercher les infos en bdd
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindValue(':recueilId', $recueilId, PDO::PARAM_INT);
			$stmt->execute();
			$count = $stmt->fetch(PDO::FETCH_ASSOC);
			//Kint::dump( $songs );
			//die();
			return $count;
		}
		
		public function getRecueils(){
			$recueils = null; //Pour l'instant nous n'avons pas de recueil
			$sql = "SELECT * FROM recueil";
						
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
			$recueils = array();
			foreach($results as $result) {
				$recueils[] = $this->hydrateRecueil($result);
			}
			return $recueils;
		}

	}


	?>