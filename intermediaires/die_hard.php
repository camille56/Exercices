<?php

/**
 *
 * Mission
 *
 * John doit neutraliser les terroristes présents dans le célèbre building et sauver le réveillon de Noël. Pour cela, il utilise des stratagèmes élaborés !
 *
 * Les terroristes sont dispersés dans les étages, John doit les éliminer un par un pour arriver tout en haut de l’hôtel, à l’étage 100.
 *
 * C’est son copain policier en bas, qui lui envoie la position des ennemis par radio.
 * Règles
 *
 * John démarre à un étage aux alentours de l’étage 50.
 *
 * On récupère la position de tous les ennemis.
 *
 * Il n’y a jamais d’ennemi à l’étage de départ de John.
 * John ne fait que monter, il ne s’intéressera pas aux ennemis qui se trouvent aux étages sous son étage de départ.
 * Dans la séquence, il faut indiquer l’étage de départ de John.
 * Il faut aussi indiquer l’étage d’arrivée qui est toujours 100 et où il n’y a jamais d’ennemis.
 *
 * John ne s’arrête à un étage que pour neutraliser un ennemi, en respectant ces règles :
 *
 * Au départ, il y a au maximum 1 ennemi par étage, mais ils vont se déplacer…
 * Lors des combats, John fait du bruit… Tous les ennemis qui se trouvent dans les 3 étages supérieurs descendent alors d’un étage, pour voir ce qui se passe… Si John combat à l’étage 51, les ennemis se trouvant aux étages 52, 53, et 54 descendent chacun d’un étage par rapport à leur étage de départ. Celui à l’étage 52 descend à l’étage 51. Celui à l’étage 53 descend à l’étage 52. Et celui à l’étage 54 descend à l’étage 53.
 * Un ennemi peut alors descendre à l’étage où se trouve déjà John, et un second combat démarre. Il faudra l’indiquer dans la séquence finale en indiquant plusieurs fois l’étage.
 * Selon la disposition des ennemis, John peut enchainer jusqu’à 4 combats à un même étage.
 *
 * Exemple d’une séquence
 *
 * John démarre à l’étage 50
 * Il y a 5 ennemis aux étages 55, 62, 63, 70, 72
 * John monte à l’étage 55 et neutralise l’ennemi
 * Les ennemis aux étages supérieurs n’ont rien entendu
 * John monte à l’étage 62 et neutralise l’ennemi
 * Celui à l’étage 63 descend à l’étage 62 et John le neutralise
 * Les ennemis aux étages 70 et 72 n’ont rien entendu
 * John monte à l’étage 70 et neutralise l’ennemi
 * Celui à l’étage 72 a entendu et descend à l’étage 71
 * John monte à l’étage 71 et neutralise l’ennemi
 * Il n’y a plus d’ennemi, John monte à l’étage 100
 * La séquence finale est donc 50-55-62-62-70-71-100
 *
 * Tu dois retourner la séquence que John doit effectuer pour arriver au dernier étage. Le format attendu est 50-55-62-62-70-71-100
 */

//== NE PAS TOUCHER
$john = 45;
$ennemis = [91, 35, 70, 95, 49, 57, 84, 96, 99, 82, 54, 77, 55, 73, 37, 98, 65, 56, 78, 34, 58, 92, 71, 44, 51, 63, 97];
//== NE PAS TOUCHER

$reponse = "";
$combats=array();
$listeEtageAvecEnnemi = $ennemis;
//On retire les étages inutiles.
foreach ($ennemis as $ennemi) {
    if ($ennemi <= $john) {
        $clef = array_search($ennemi, $ennemis);
        unset($listeEtageAvecEnnemi[$clef]);
    }
}
$listeEtageAvecEnnemi = array_values($listeEtageAvecEnnemi);
sort($listeEtageAvecEnnemi);

$combats = [$john];
$etageJohn = $john;

while (!empty($listeEtageAvecEnnemi)) {

    //john arrive au prochain étage avec un ennemi et combat.
    $etageJohn = $listeEtageAvecEnnemi[0];
    $combats[] = $listeEtageAvecEnnemi[0];
    //on retire le premier élèment du tableau.
    array_shift($listeEtageAvecEnnemi);

    //pour les 3 étages suivant (s'ils sont dans la range des 3 étages), on fait descendre les ennemis.
    for ($i = 0; $i <= 3; $i++) {

        if (isset($listeEtageAvecEnnemi[$i])&&($listeEtageAvecEnnemi[$i] <= $etageJohn + 3)) {
            $listeEtageAvecEnnemi[$i]--;
        }
    }
    //on re-index le tableau.
    $listeEtageAvecEnnemi=array_values($listeEtageAvecEnnemi);
}

foreach ($combats as $etage) {
    $reponse.=$etage."-";
}
echo $reponse."100";
