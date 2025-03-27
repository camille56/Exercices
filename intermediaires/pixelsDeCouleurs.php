<?php

/**
 *
 * Mission
 *
 * Ton quadrillage présente un grand nombre de cases blanches (white) et quelques cases rouges (red). Tu dois colorer, en bleu (blue), les cases qui entourent les cases rouges.
 * Règles
 *
 * Tu te trouves sur un quadrillage de 10 lignes et 10 colonnes :
 *
 * La première ligne contient les cases 0 à 9.
 * La deuxième ligne contient les cases 10 à 19.
 * La dernière ligne contient les cases 90 à 99.
 *
 * Pour chaque case rouge, tu dois tenter de colorer les 4 cases adjacentes en bleu :
 *
 * Au-dessus
 * En dessous
 * À droite
 * À gauche
 *
 * Mais attention :
 *
 * Une case déjà rouge ne peut pas être colorée en bleue
 * Une case en début de ligne ne colore pas la dernière case de la ligne précédente. La case 20 ne colore pas la case 19.
 * De même, une case en fin de ligne ne colore pas la première case de la ligne suivante. La case 39 ne colore pas la case 40.
 *
 * Tu dois retourner le nombre de cases bleues présentes après avoir passé en revue toutes les cases du quadrillage.
 */

//== NE PAS TOUCHER
$map = ['w', 'r', 'r', 'w', 'r', 'r', 'w', 'r', 'w', 'w', 'w', 'r', 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'r', 'w', 'w', 'w', 'w', 'w', 'r', 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'r', 'w', 'w', 'w', 'w', 'w', 'r', 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'r', 'w', 'w', 'r', 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'r', 'r', 'w', 'w', 'r', 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'r', 'w', 'w', 'w', 'w', 'w'];
//== NE PAS TOUCHER

$nombreCaseBleu=0;
$tableauDeLigne=array_chunk($map,10);

$indexLigne = 0;
foreach ($tableauDeLigne as &$ligne) {
    $indexLettre=0;
    foreach ($ligne as $lettre) {

        if ($lettre=="r") {

            //gestion des lettres gauche et droite.
            if (isset($ligne[$indexLettre - 1]) && $ligne[$indexLettre - 1] == "w") {
                $ligne[$indexLettre - 1] = "b";
            }
            if (isset($tableauDeLigne[$indexLigne][$indexLettre + 1]) && $tableauDeLigne[$indexLigne][$indexLettre + 1] == "w") {
                $tableauDeLigne[$indexLigne][$indexLettre + 1] = "b";
            }
            //gestion des lettres haut et bas.
            if (isset($tableauDeLigne[$indexLigne - 1][$indexLettre]) && $tableauDeLigne[$indexLigne - 1][$indexLettre] == "w") {
                $tableauDeLigne[$indexLigne - 1][$indexLettre] = "b";
            }
            if (isset($tableauDeLigne[$indexLigne + 1][$indexLettre]) && $tableauDeLigne[$indexLigne + 1][$indexLettre] == "w") {
                $tableauDeLigne[$indexLigne + 1][$indexLettre] = "b";
            }
        }

        $indexLettre++;

    }
    $indexLigne++;
}
unset($ligne);

foreach ($tableauDeLigne as $ligne) {
    foreach ($ligne as $lettre) {
        if ($lettre=="b") {
            $nombreCaseBleu++;
        }
    }
}
echo $nombreCaseBleu;