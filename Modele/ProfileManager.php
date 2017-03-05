<?php

	Class ProfileManager extends Manager{


		public function login($login, $hashed_password){
			//echo $login . " " . $hashed_password;
			//requete pour rechercher l'utilisateur dans la base des profils
			$sql = "SELECT *
					FROM profil
					WHERE login = :login
					LIMIT 1";

			$stmt = $this->dbh->prepare($sql);
			$stmt->bindValue(":login", $_POST['login']);
			$stmt->execute();
			$user = $stmt->fetch();

			if (empty($user)){
				return false;
			}
			//utilisateur trouvé !
			else {
				if ($hashed_password === $user['motDePasse']){
					//mot de passe ok
					
					//conserve en session la validité de cet user
					$_SESSION['valid_user'] = true;
					$_SESSION['login'] = $user['login'];
					return true;
				}
				else {
					return false;
				}
			}
			return false;
		}
	}
?>