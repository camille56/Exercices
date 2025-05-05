<?php

/**
 * Ce challenge fait partie de l’histoire originale : Codemind Odyssey.
 *
 * Après avoir jeté les bases en naviguant à travers les émotions, il est temps d’offrir un espace dédié à la relaxation et aux différentes techniques de détente.
 *
 * Tu vas développer un module interactif au cœur de CodeMind, conçu spécialement pour la relaxation et la méditation. Ta mission est de guider les étudiant.e.s dans un parcours de détente, en les initiant à des techniques de respiration, méditation et yoga, pour transformer leur stress en sérénité.
 * Règles
 *
 * L’étudiant démarre à un état émotionnel de 0.
 * Il va rencontrer des évènements (events) plus ou moins forts émotionnellement (valeurs entre 2 et 15) qui vont faire augmenter son état émotionnel.
 *
 * Il faudra alors se relaxer en conséquence, selon certains seuils :
 *
 * Si son état émotionnel atteint ou dépasse 10, il pratique la Respiration, son état redescend de 6.
 * Si son état émotionnel atteint ou dépasse 15, il pratique la Méditation, son état redescend de 9.
 * Si son état émotionnel atteint ou dépasse 20, il pratique le Yoga, son état redescend de 12.
 * Pour valider l’activité de relaxation, il faut indiquer sa première lettre (R pour Respiration, M pour Méditation ou Y pour Yoga).
 * Point particulier, il ne peut se relaxer qu’une seule fois par évènement :
 * Exemple : Notre état émotionnel est à 9, on prend part à un évènement moyennant +15, on se retrouve à 24 points ce qui engendre une séance de Yoga. Mais si on retire les 12 points du yoga on arrive à 12 donc au-dessus du seuil Respiration Mais on ne renseigne que Y dans ce cas.
 *
 * Tu dois retourner…
 *
 * Toutes les pratiques réalisées au fil des évènements, dans le bon ordre, par exemple « RRMYRMY«
 */

//== NE PAS TOUCHER
$events = [2, 7, 3, 14, 14, 8, 8, 2, 15, 3, 10, 3, 12, 5, 15, 8, 6, 3, 2, 7, 7];
//== NE PAS TOUCHER

$etat = 0;
$pratiques = "";

foreach ($events as $event) {
    $etat += $event;
    if ($etat >= 20) {
        $etat -= 12;
        $pratiques .= "Y";
    } elseif ($etat >= 15 && $etat < 20) {
        $etat -= 9;
        $pratiques .= "M";
    } elseif ($etat >= 10 && $etat < 15) {
        $etat -= 6;
        $pratiques .= "R";
    }
}
echo $pratiques;