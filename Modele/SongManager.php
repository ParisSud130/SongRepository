<?php


	Class SongManager extends Manager{
		public function songSeen($song){
			$song->setNbConsultations($song->getNbConsultations()+1);
			$this->persistSong($song);
		}
		/**
		 * 
		 **/
		public function getSong($songId){
			$song = null; //Pour l'instant nous n'avons pas de chanson
			$sql = "SELECT chant.*,recueil.nomRecueil 
						FROM chant
						LEFT JOIN recueil ON recueil.idRecueil = chant.idRecueil WHERE chant.idChant = ?";
			//va chercher les infos en bdd
			$stmt = $this->dbh->prepare($sql);
			$stmt->execute(array($songId));
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();
			if($count>0){
				$song = $this->hydrateSong($result);
			}
			//$this->songSeen($song);
			return $song;
		}
		
		/**
		 * Récupère les 3 derniers chants modifiés en base de données
		 **/
		public function getLastSongs(){
		//va chercher les infos en bdd
			$stmt = $this->dbh->prepare("SELECT * FROM chant ORDER BY dateModification DESC LIMIT 3");
			$stmt->execute();
			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$songs = $this->hydrateSongs($results);
			return $songs;
		}
		
		/**
		 * Récupère les 3 chants les plus souvent consultés
		 **/
		public function getMostViewedSongs(){
		//va chercher les infos en bdd
			$stmt = $this->dbh->prepare("SELECT * FROM chant ORDER BY nbConsultations DESC LIMIT 3");
			$stmt->execute();
			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$songs = $this->hydrateSongs($results);
			return $songs;
		}
		
		
		
		/**
		 * Recherche un chant en base de données à partir des mots clés de la chaine de charactères passée en paramètre
		 * retourne les 50 chants qui correspondent le plus
		 **/
		public function searchSongs($keywords){
				
			//converti la chaine en array
			$arr_key = explode(" ", $keywords);
			
			//nombre total de mots-cl
			$nb_key = count($arr_key);
			
			$new_key = array();
			//concatene *  la fin de chaque mot
			for($i=0;$i<$nb_key;$i++){
				$new_key[] = $arr_key[$i]."*";
			}
			
			//ajoute  l'array la possibilit de rechercher la chaine entre telle quelle, et apparait comme les rsultats de recherche les plus pertinentes 
			$new_key[]='>"'.$keywords.'"';
			
			
			//reconverti l'array en chaine
			$str_key = implode($new_key," ");
			
			//va chercher les infos sur cette page en bdd
			$sql = "SELECT DISTINCT chant.idChant, MATCH (chant.titre) AGAINST (':$str_key' IN BOOLEAN MODE) AS score1, MATCH (S1.texte) AGAINST (':$str_key' IN BOOLEAN MODE) AS score2
						FROM strophe S1
						LEFT JOIN chant ON chant.idChant = S1.idChant
						LEFT JOIN recueil ON recueil.idRecueil = chant.idRecueil
						WHERE MATCH (chant.titre) AGAINST (':$str_key' IN BOOLEAN MODE) OR MATCH (S1.texte) AGAINST (':$str_key' IN BOOLEAN MODE) 
						GROUP BY idChant
						ORDER BY score1 DESC, score2 DESC, nbConsultations, numChant, recueil.idRecueil LIMIT 50";
	
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindValue(":str_key", $str_key);
			$stmt->execute();
			$results = $stmt->fetchAll();
						
			$songs = [];
			foreach($results as $result) {
				$song = $this->getSong($result["idChant"]);
				if($song != NULL) {
					$songs[] = $song;
				}
			}
			
			//Kint::dump( $songs );
			//die();
			return $songs;
		}
		
		public function getStrophesForSong($songId){
			//va chercher les infos en bdd
			$stmt = $this->dbh->prepare("SELECT * FROM strophe WHERE idChant = ?");
			$stmt->execute(array($songId));
			$stropheResults = $stmt->fetchAll(PDO::FETCH_ASSOC);	
			if (count($stropheResults, COUNT_RECURSIVE) >1){
				$strophes = $this->hydrateStrophes($stropheResults);
				return $strophes;
			}
			else if (count($stropheResults, COUNT_RECURSIVE) >0){
				$strophe = $this->hydrateStrophe($stropheResults);
				return $strophe;
			}
			
		}

		/******************************************************************************************************************
		*	FONCTION : hydrateSong
		*	PARAMETRES EN ENTREE :	entre de la table chant provenant de la base de donnes
		*	DESCRIPTION : Renvoit une instance de la classe Chant  partir d'une entree de la table chant
		*	VALEUR RETOURNEE : instance de la classe Chant
		*******************************************************************************************************************/
		public function hydrateSong($songResult){
			$nbConsultations = $songResult["nbConsultations"];
			settype($nbConsultations, "integer");

			$infos = array (
	
				'_idChant' => $songResult["idChant"],
				'_titre' => $songResult["titre"],
				'_titreUsuel' => $songResult["titreUsuel"],
				'_idRecueil' => $songResult["idRecueil"],
				'_auteur' => $songResult["auteur"],
				'_compositeur' => $songResult["compositeur"],
				'_copyright' => $songResult["copyright"],
				'_tonalite' => $songResult["tonalite"],
				'_lien' => $songResult["lien"],
				'_typeLien' => $songResult["typeLien"],
				'_commentaire' => $songResult["commentaire"],
				'_etat' => $songResult["etat"],
				'_dateModification' => $songResult["dateModification"],
				'_nbConsultations' => $nbConsultations,
				'_numChant' => $songResult["numChant"] );

			if (array_key_exists('idRecueil', $songResult) && array_key_exists('nomRecueil', $songResult)) {
				$infosRecueil = array (
					'_idRecueil' => $songResult["idRecueil"],
					'_nomRecueil' => $songResult["nomRecueil"]);
				$recueil = new Recueil($infosRecueil);
				$infos['_recueil'] = $recueil;
			}
			$strophes = $this-> getStrophesForSong($songResult["idChant"]);
		
			$song = new Chant($infos);
			$song -> setStrophes($strophes);
	
			return $song;
		}
		
		/******************************************************************************************************************
		*	FONCTION : hydrateSongs
		*	PARAMETRES EN ENTREE :	lignes de la table chant provenant de la base de donnes
		*	DESCRIPTION : Appelle la mthode hydrateSong pour un ensemble de ligne de la table Chant
		*	VALEUR RETOURNEE : arrays contenant des instances de la classe Chant
		*******************************************************************************************************************/
		public function hydrateSongs($results){
			$songs = [];
			foreach($results as $result) {
				$songs[] = $this->hydrateSong($result);
			}
			return $songs;
		}
		
		public function persistSong($song){
            var_dump($song);
            die();
            $sql = "UPDATE chant ";
            $sql = $sql." SET titre = :titre, titreUsuel = :titreUsuel, idRecueil = :idRecueil, auteur = :auteur, compositeur = :compositeur, 
            copyright = :copyright, tonalitÃ© = :tonalitÃ©, lien = :lien, typeLien = :typeLien, commentaire = :commentaire, etat = :etat, dateModification = :dateModification, nbConsultations = :nbConsultations, numChant=:numChant ";
            $sql = $sql." WHERE idChant=:idChant";
            $stmt = $this->dbh->prepare($sql);
            $parameters = array("titre"=>$song->getTitre(), 
            	"titreUsuel"=>$song->getTitreUsuel(),  
            	"idRecueil"=>$song->getIdRecueil(),  
            	"auteur"=>$song->getAuteur(),  
            	"compositeur"=>$song->getCompositeur(),  
            	"copyright"=>$song->getCopyright(),  
            	"tonalitÃ©"=>$song->getTonalite(),  
            	"lien"=>$song->getLien(),  
            	"typeLien"=>$song->getTypeLien(),  
            	"commentaire"=>$song->getCommentaire(),  
            	"etat"=>$song->getEtat(),  
            	"dateModification"=>$song->getDateModification(),  
            	"nbConsultations"=>$song->getNbConsultations(),  
            	"numChant"=>$song->getNumChant(), 
            	"idChant"=>$song->getIdChant());
            $stmt->execute($parameters);
		}
		
		/******************************************************************************************************************
		*	FONCTION : hydrateStrophe
		*	PARAMETRES EN ENTREE :	entre de la table strophe provenant de la base de donnes
		*	DESCRIPTION : Renvoit une instance de la classe Strophe  partir d'une entre de la table strophe
		*	VALEUR RETOURNEE : instance de la classe Chant
		*******************************************************************************************************************/
		public function hydrateStrophe($result){
			$infos = array (
				'_idStrophe' => $result["idStrophe"], 
				'_type' => $result["type"],
				'_identifiant' => $result["identifiant"],
				'_texte' => $result["texte"],
				'_position' => $result["position"],
				'_idChant' => $result["idChant"]);
	
			$strophe = new Strophe($infos);
	
			return $strophe;
		}
		
		/******************************************************************************************************************
		*	FONCTION : hydrateStrophes
		*	PARAMETRES EN ENTREE :	lignes de la table strophe provenant de la base de donnes
		*	DESCRIPTION : Appelle la mthode hydrateStrophe pour un ensemble de ligne de la table strophe
		*	VALEUR RETOURNEE : arrays contenant des instances de la classe strophe
		*******************************************************************************************************************/
		public function hydrateStrophes($results){
			$strophes = [];
			foreach($results as $result) {
				$strophes[] = $this->hydrateStrophe($result);
			}
			return $strophes;
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