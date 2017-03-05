<?php

    require_once("Config.php");
    require_once("Loader.php");
    $loader = new Loader();

    $sbp = 'http://localhost/SongRepository/Utils/SongBooks/fmt4sr'; // chemin des SongBooks
    $sb = ['DLG','JEM1','JEM2','JEM3','PS']; // Nom des SongBooks
    //$sb = ['PS'];
    $extension = 'fmt4sr.json'; // Extension des SongBooks

    // Init BDD
    $db = new Bdd();
    $dbh = $db->getDbh();

    foreach ($sb as $i => $value) {
        
        // CHARGEMENT DU FICHIER JSON
        $file = "$sbp/${sb[$i]}.$extension";
        print("<b>Chargement de $file</b><br>") ;
        $json_data = chargementJSON($file);

        // CREATION NV RECUEIL
        print( "<b>&nbsp;&nbsp;Création du recueil '" . $json_data->Text . "'</b><br>");
        $idRecueil = creationRecueil($json_data->Text);

        // CREATION DES CHANTS
        print("<b>&nbsp;&nbsp;&nbsp;&nbsp;Ajout des chants...</b><br>");
        creationChants($idRecueil, $json_data->Songs);
        print('<br>');

    }

    function chargementJSON($file) {
        $json_source = file_get_contents($file);

        // Suppression des caractères indésirables qui empêchent le chargement

        // This will remove unwanted characters.
        // Check http://www.php.net/chr for details    
        for ($i = 0; $i <= 31; ++$i) { 
            $json_source = str_replace(chr($i), "", $json_source); 
        }
        $json_source = str_replace(chr(127), "", $json_source);

        // This is the most common part
        // Some file begins with 'efbbbf' to mark the beginning of the file. (binary level)
        // here we detect it and we remove it, basically it's the first 3 characters 
        if (0 === strpos(bin2hex($json_source), 'efbbbf')) {
           $json_source = substr($json_source, 3);
        }

        // Décode le JSON
        $json_data = json_decode($json_source,false,512);

        if (json_last_error() != JSON_ERROR_NONE)
            print json_last_error_msg() . '<br>';

        return $json_data;
    }

    function creationRecueil($nomRecueil) {
        global $dbh;
        // Requete d'insertion d'un recueil
        $sql = "INSERT INTO recueil
                    SET nomRecueil = :nomRecueil ";

        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":nomRecueil", $nomRecueil);
        $stmt->execute();

        return $dbh->lastInsertId();
    }

    function creationChants($idRecueil, $songs) {
        global $dbh;
        $numChant = 0;
        foreach ($songs as $i => $value) {
            $chant = $songs[$i];
            if (isset($chant->ID))
                $numChant = $chant->ID;
            else
                $numChant++;
            print("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $numChant . " - " . $chant->Text . "<br>");
            
            // Ajout dans la table Chant
            $sql = "INSERT INTO chant
                        SET numChant = :numChant,
                            auteur = :auteur,
                            compositeur = :compositeur,
                            copyright = :copyright,
                            etat = :etat,
                            idRecueil = :idRecueil,
                            titre = :titre,
                            titreUsuel = :titreUsuel,
                            tonalité = :tonalite,
                            lien = :lien,
                            typeLien = :typeLien,
                            commentaire = :commentaire,
                            dateModification = NOW(),
                            nbConsultations = :nbConsultations";

            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(":numChant", $numChant);
            $stmt->bindValue(":auteur", isset($chant->Author) ? $chant->Author : "");
            $stmt->bindValue(":compositeur", isset($chant->Composer) ? $chant->Composer : "");
            $stmt->bindValue(":copyright", isset($chant->Copyright) ? $chant->Copyright : "");
            $stmt->bindValue(":etat", "à valider");
            $stmt->bindValue(":idRecueil", $idRecueil);
            $stmt->bindValue(":titre", isset($chant->Text) ? $chant->Text : "");
            $stmt->bindValue(":titreUsuel", "");
            $stmt->bindValue(":tonalite", "");
            $stmt->bindValue(":lien", "");
            $stmt->bindValue(":typeLien", "");
            $stmt->bindValue(":commentaire", "");
            $stmt->bindValue(":nbConsultations", "0");
            $stmt->execute();

            $idChant = $dbh->lastInsertId();

            // Ajout dans la table Strophe
            $strophes = $chant->Verses;
            // Tag : 
            // ""  => Strophe (Verse)
            // "1" => Refrain (Chorus)
            // "2" => Pré-Refrain (Pre-chorus)
            // "3" => Pont (Bridge)
            // "4" => Etiquette (Tag)
            // "5" => Intro (Intro)
            // "6" => Sortie (Outro)
            // "7" => Glissade (Slide)
            // "8" => Instrumental (Instrumental)
            // "9" => Autre (Other)
            // ID = 0 : pas de numérotation (ex : refrain unique => ne pas faire apparaître de numéro)
            // Pas d'ID : ID = 1
            $tags = ["1"=>"Refrain", "2"=>"Pré-Refrain", "3"=>"Pont", "4"=>"Etiquette", "5"=>"Intro", "6"=>"Sortie", "7"=>"Glissade", "8"=>"Instrumental", "9"=>"Autre","Chorus"=>"Refrain", "Pre-chorus"=>"Pré-Refrain", "Bridge"=>"Pont", "Tag"=>"Etiquette", "Intro"=>"Intro", "Outro"=>"Sortie", "Slide"=>"Glissade", "Instrumental"=>"Instrumental", "Other"=>"Autre"];
            $nbVerse = 0; // strophe, refrain ou autre
            foreach ($strophes as $j => $value) {
                $strophe = $strophes[$j];
                $sql = "INSERT INTO strophe
                            SET idChant = :idChant,
                                identifiant = :identifiant,
                                position = :position,
                                texte = :texte,
                                type = :type";

                $stmt = $dbh->prepare($sql);
                $stmt->bindValue(":idChant", $idChant);
                
                if (isset($strophe->Tag) && ($strophe->Tag != "")) 
                    $stmt->bindValue(":type", $tags[$strophe->Tag]);
                else
                    $stmt->bindValue(":type", "Strophe");

                if (isset($strophe->ID) && ($strophe->ID != "")) {
                    $stmt->bindValue(":identifiant", $strophe->ID);
                } else {
                    $stmt->bindValue(":identifiant", "1");
                }

                $stmt->bindValue(":position", ++$nbVerse);
                $stmt->bindValue(":texte", isset($strophe->Text) ? $strophe->Text : "");

                $stmt->execute();
                
            }

        }

    }
?>