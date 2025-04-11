<?php

/**
 *
 * Mission
 *
 * Bienvenue à Las Vegas ! Ville du vice, les tables de Poker tournent à plein régime ! Avant d’aller t’asseoir à une de ses tables et de te faire plumer par les « requins » des lieux, je te propose de découvrir tranquillement les différentes combinaisons de cartes qui permettent de déterminer la « force » d’une main.
 * Règles
 *
 * Une main ici, c’est 5 cartes différentes. Plusieurs seront proposées dans la donnée « mains ». Chaque main se présente sous la forme d’une chaine de caractères. Chaque carte est séparée par un espace. Par exemple :
 *
 * 3 4 6 2 9 (aucune combinaison)
 * 3 3 4 as 5 (1 Paire)
 * 3 3 3 roi roi (Full House)
 *
 * Dans ce premier exercice, on laisse les couleurs de côté (trèfle, carreau, pique, coeur).
 *
 * L’objectif est d’identifier les combinaisons suivantes, chacune donnant un nombre de points :
 *
 * Le Carré : 4 cartes pareilles => 200pts
 * Le Full House : 1 Brelan + 1 Paire => 50pts
 * Le Brelan : 3 cartes pareilles => 20pts
 * 2 Paires : 2 fois 2 cartes pareilles => 10pts
 * 1 Paire : 2 cartes pareilles => 5pts
 * Aucune combinaison : 5 cartes différentes => 1pt
 *
 * Tu dois retourner le nombre de points total obtenus avec toutes les mains.
 */

//== NE PAS TOUCHER
$mains = ['dame 5 2 10 9', 'valet 3 6 4 as', 'as 6 6 3 5', '2 4 as dame 7', '10 8 8 9 6', '4 roi 5 10 9', '8 dame 10 roi 4', '8 7 as 6 9', '4 4 valet valet 4', '6 9 2 4 7', '9 10 3 7 3', '8 as roi 8 7', '9 roi 6 as dame', '3 as as 9 4', '8 9 3 dame 6', '7 3 2 dame as', 'dame 9 4 9 2', '10 4 6 7 3', 'as 4 roi 5 as', '7 9 4 dame dame', '6 valet valet 4 dame', '8 9 9 valet 5', '3 3 9 7 valet'];
//== NE PAS TOUCHER

$nombreTotalPoint = 0;
foreach ($mains as $main) {
    $nombreTotalPoint += calculMain($main);
}
echo $nombreTotalPoint;


function calculMain($main)
{
    $points = 0;

    $elements = explode(' ', $main);

    $tableauCombinaison = array_count_values($elements);
    sort($tableauCombinaison);
    $recurrences = array_values($tableauCombinaison);

    $quadruple=false;
    $triple=false;
    $nombrepaire = 0;
    $combinaison="";
    foreach ($recurrences as $recurrence) {

        if ($recurrence == '4') {
            $quadruple = true;
        }
        if ($recurrence == '3') {
            $triple = true;
        }
        if ($recurrence == '2') {
            $nombrepaire++;
        }
    }

    if ($quadruple) {
        $combinaison = "carre";
    } elseif ($triple && $nombrepaire == 0) {
        $combinaison = "brelan";
    } elseif ($triple && $nombrepaire == 1) {
        $combinaison = "full";
    } elseif ($nombrepaire == 2) {
        $combinaison = "2paire";
    } elseif ($nombrepaire == 1) {
        $combinaison = "paire";
    }

    switch ($combinaison) {
        case 'carre':
            $points = 200;
            break;
        case 'full':
            $points = 50;
            break;
        case 'brelan':
            $points = 20;
            break;
        case '2paire':
            $points = 10;
            break;
        case 'paire':
            $points = 5;
            break;
        default:
            $points = 1;
    }
    return $points;
}
