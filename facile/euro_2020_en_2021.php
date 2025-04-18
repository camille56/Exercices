<?php

/**
 *
 * Mission
 *
 * La Coupe d’Europe de football a démarré ! Avant la phase finale, les poules ! Détermine le classement des équipes de la poule proposée.
 * Règles
 *
 * 2 données sont disponibles :
 *
 * group contient les trigrammes de chaque équipe participant à la poule
 * scores contient les résultats de chaque double confrontation entre toutes les équipes de la poule
 * Chaque score est organisé de la même façon :
 * Equipe 1
 * Equipe 2
 * Score Equipe 1
 * Score Equipe 2
 *
 * Voici les incidences sur les points d’une équipe :
 *
 * Victoire : 3 pts
 * Match nul : 1 pt
 * Défaite : 0 pt
 *
 * Tu dois retourner l’ordre du classement des équipes, en utilisant leur trigramme.
 *
 * Par exemple, une poule composée de la FRAnce et de la BELgique. La FRAnce est première de la poule, il faut donc retourner : FRABEL.
 *
 * Remarque : 2 équipes n’ont jamais le même nombre de points. Pas besoin de gérer d’éventuelles égalités au moment du classement.
 */

//== NE PAS TOUCHER


$group = ['HON', 'FRA', 'FIN', 'UKR', 'SUI', 'ECO', 'ALL'];
$scores = ['HON_FRA_4_2', 'HON_FIN_1_1', 'HON_UKR_1_0', 'HON_SUI_2_4', 'HON_ECO_2_0', 'HON_ALL_0_2', 'FRA_HON_1_0', 'FRA_FIN_0_0', 'FRA_UKR_0_0', 'FRA_SUI_2_3', 'FRA_ECO_3_0', 'FRA_ALL_3_1', 'FIN_HON_2_1', 'FIN_FRA_1_0', 'FIN_UKR_1_0', 'FIN_SUI_2_1', 'FIN_ECO_1_1', 'FIN_ALL_0_2', 'UKR_HON_1_0', 'UKR_FRA_0_0', 'UKR_FIN_0_1', 'UKR_SUI_0_2', 'UKR_ECO_0_2', 'UKR_ALL_0_2', 'SUI_HON_1_0', 'SUI_FRA_1_2', 'SUI_FIN_0_1', 'SUI_UKR_1_2', 'SUI_ECO_3_2', 'SUI_ALL_2_0', 'ECO_HON_1_0', 'ECO_FRA_3_0', 'ECO_FIN_0_0', 'ECO_UKR_1_0', 'ECO_SUI_1_4', 'ECO_ALL_1_0', 'ALL_HON_0_1', 'ALL_FRA_0_1', 'ALL_FIN_1_0', 'ALL_UKR_2_3', 'ALL_SUI_0_1', 'ALL_ECO_2_1'];
//== NE PAS TOUCHER

$tableauScore=array();
foreach ($group as $key => $value) {
$tableauScore[$value]=0;
}

$reponse = "";
foreach ($scores as $score) {
    $egalite = false;
    $gagnant = "";
    $elementMatch = explode('_', $score);

    if ($elementMatch[2] > $elementMatch[3]) {
        $gagnant = $elementMatch[0];
    } elseif ($elementMatch[2] < $elementMatch[3]) {
        $gagnant = $elementMatch[1];
    } else {
        $egalite = true;
    }

    if (!empty($gagnant)) {
        $tableauScore[$gagnant] += 3;
    } elseif ($egalite) {
        $tableauScore[$elementMatch[0]] += 1;
        $tableauScore[$elementMatch[1]] += 1;
    }
}
arsort($tableauScore);
foreach ($tableauScore as $key => $value) {
    $reponse.=$key;
}

echo $reponse;