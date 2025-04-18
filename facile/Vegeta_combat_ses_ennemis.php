<?php
/**
 * Tu vas devoir suivre la force de Végéta tout au long de ses combats.
 * Règles
 *
 * Végéta démarre avec une certaine force. Il démarre toujours au niveau 1.
 *
 * Il va affronter un certain nombre d’ennemis, identifiés par leur puissance respective. Les ennemis sont affrontés dans l’ordre du tableau.
 *
 * Lorsqu’il combat, c’est sa puissance qui rentre en compte. Sa puissance est égale à sa force multipliée par son niveau actuel.
 *
 * Végéta gagne son combat dès que sa puissance est supérieure ou égale à celle de l’ennemi.
 *
 * Lorsque Végéta terrasse un ennemi sa force augmente. Il récupère alors 10% de la puissance de son ennemi vaincu.
 *
 * Mais si Végéta n’a pas la puissance nécessaire pour battre l’ennemi, alors il se transforme en super Sayan et augmente son niveau de 1. Il peut augmenter son niveau autant que nécessaire, hors de question que le prince Sayan ne se fasse battre par un vulgaire combattant !
 *
 * Tu dois retourner la puissance finale de Végéta, une fois qu’il a terrassé son dernier adversaire.
 *
 * Précision : La force récupérée sur chaque adversaire doit être arrondie à l’entier inférieur.
 */

//== NE PAS TOUCHER
$ennemis = [144, 185, 294, 307, 695, 963, 1054, 1249, 1263, 1296, 1317, 1323, 1483];
$force_vegeta = 135;
//== NE PAS TOUCHER

$niveauVegeta = 1;
$forceCombat = 0;

foreach ($ennemis as $ennemie) {

    $reussite = false;
    while ($reussite == false) {
        $forceCombat = $force_vegeta * $niveauVegeta;
        $combat = combat($forceCombat, $ennemie);
        $reussite=$combat;
        if(!$combat){
            $niveauVegeta++;
        }else{
            $force_vegeta=$force_vegeta+(floor($ennemie*0.1));
        }
    }
}
echo $force_vegeta*$niveauVegeta;

function combat($forceCombat, $ennemie): bool
{
    if ($forceCombat >= $ennemie) {
        return true;
    } else {
        return false;
    }
}