<?php

    require_once("Config.php");
    require_once("Loader.php");
    $loader = new Loader();

    $url = 'http://www.guadadvent.org/hymnesetlouanges'; // URL guadadvent.org
    $path = 'Utils/SongBooks/hl';

    // Init BDD
    $db = new Bdd();
    $dbh = $db->getDbh();

    // CREATION RECUEIL HYMNES & LOUANGES
    print( "Création du recueil <b>Hymnes & Louanges</b><br><br>");
    $idRecueil = creationRecueil('Hymnes & Louanges');

    for ($c = 1; $c <=654 ; $c++) {
        
        unset ($numChant);
        unset ($titreChant);
        unset ($parolesChant);
        // TELECHARGEMENT DU CHANT 
        print('Téléchargement de <b>H&L '.str_pad($c,3," ",STR_PAD_LEFT).'</b>...') ;
        $pageChant = file_get_contents("$url/$c");
        print(" OK !\t");
        $chant = extraireChant($pageChant);
        if (count($chant)>3) {
            $numChant = $chant[1];
            $titreChant = $chant[2];
            $parolesChant = $chant[3];
        }
        print($titreChant.'<br>') ;
        //print("<pre>\n". $parolesChant . "\n</pre><br>\n");

        // PARSING DU CHANT
        print("Parsing...<br>\n");
        $parolesChant = parseChant($parolesChant);

        // CREATION DES CHANTS
        //print("<b>&nbsp;&nbsp;&nbsp;&nbsp;Ajout des chants...</b><br>");
        creationChants($idRecueil, $numChant, $titreChant, $parolesChant);
        print('Insertion en base OK !<br>');

    }

    function extraireChant($chantHTML) {
        $patternChant = "/~.+?H(\d{1,3}).+?~.+\n.+?<.+?>(.+)\n.*\n.*\n.*\n.*\n.*\n.*\n.*\n.*\n.*\n.*?<.*?>(.+)</";
        $trouve = preg_match($patternChant, $chantHTML, $chant);
        return $chant;
    }

    function parseChant($paroles) {

        $pattern = ["/(<br>){2,}/"];
        $replacement = ["<br><br>"];
        $replace = preg_replace($pattern, $replacement, $paroles);
        $paroles = $replace;
        
        $matches = preg_match_all("/((?:\w+).+?)(?:<br><br>|$)/", $paroles, $strophes);
        $position = 1;
        if ($matches) {
            $chant = array();
            foreach ($strophes[1] as $key => $value) {
                // RECHERCHE DE STROPHE |REFRAIN | FINAL | PARAGRAPHE SANS ENTETE
                $matches = preg_match("/^(<br>)?(\d+|Refrain|Final).*?<br>(.*)/", $value, $strophe_raw);
                $strophe = new stdClass();
                if ($matches) {
                    if ( ($strophe_raw[2] == 'Refrain') || ($strophe_raw[2] == 'Final') ) {
                        $strophe->type = $strophe_raw[2];
                        $strophe->identifiant = '1';
                        $strophe->Text = $strophe_raw[3].'<br>';
                        $strophe->position = $position++;
                    } else {
                        $strophe->type = 'Strophe';
                        $strophe->identifiant = $strophe_raw[2];
                        $strophe->Text = $strophe_raw[3].'<br>';
                        $strophe->position = $position++;
                    }
                    array_push($chant, $strophe);
                } else {
                    if (count($chant)>0) {
                        $strophe = array_pop($chant);
                        $strophe->Text .= "<br>".$value."<br>";
                    } else {
                        $strophe->type = 'Strophe';
                        $strophe->identifiant = '1';
                        $strophe->Text = $value;
                        $strophe->position = $position++;
                    }
                    array_push($chant, $strophe);
                }
                //print("<pre>\n". $strophe->Text . "\n</pre><br>\n");
            }
            foreach ($chant as $key => $value) {
                $replace = str_replace('<br>','
',$value->Text);
                $value->Text = $replace;
                //var_dump($value);
                //print($value[0]." ".$value[1]."<br>".$value[2]);
                //print"<br>";
            }
        }

        return $chant;
    }

    function creationRecueil($nomRecueil) {
        global $dbh;
        // Requete d'insertion d'un recueil
        $sql = "REPLACE INTO recueil
                    SET nomRecueil = :nomRecueil ";

        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":nomRecueil", $nomRecueil);
        $stmt->execute();

        return $dbh->lastInsertId();
    }

    function creationChants($idRecueil, $numChant, $titreChant, $strophes) {
        global $dbh;
            
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
                            tonalite = :tonalite,
                            lien = :lien,
                            typeLien = :typeLien,
                            commentaire = :commentaire,
                            dateModification = NOW(),
                            nbConsultations = :nbConsultations";

            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(":numChant", $numChant);
            $stmt->bindValue(":auteur", "");
            $stmt->bindValue(":compositeur", "");
            $stmt->bindValue(":copyright", "");
            $stmt->bindValue(":etat", "à valider");
            $stmt->bindValue(":idRecueil", $idRecueil);
            $stmt->bindValue(":titre", $titreChant);
            $stmt->bindValue(":titreUsuel", "");
            $stmt->bindValue(":tonalite", "");
            $stmt->bindValue(":lien", "");
            $stmt->bindValue(":typeLien", "");
            $stmt->bindValue(":commentaire", "");
            $stmt->bindValue(":nbConsultations", "0");
            $stmt->execute();

            $idChant = $dbh->lastInsertId();

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
                
                if (isset($strophe->type) && ($strophe->type != "")) 
                    $stmt->bindValue(":type", $strophe->type);
                else
                    $stmt->bindValue(":type", "Strophe");

                if (isset($strophe->identifiant) && ($strophe->identifiant != "")) {
                    $stmt->bindValue(":identifiant", $strophe->identifiant);
                } else {
                    $stmt->bindValue(":identifiant", "1");
                }

                $stmt->bindValue(":position", isset($strophe->position) ? $strophe->position : "");
                $stmt->bindValue(":texte", isset($strophe->Text) ? $strophe->Text : "");

                $stmt->execute();
                
            }

        

    }
?>