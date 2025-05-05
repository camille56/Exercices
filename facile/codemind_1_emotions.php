<?php

/**
 *Ce challenge fait partie de l’histoire originale : Codemind Odyssey.
 *
 * Tu es dev dans un groupe d’étudiant.e.s visionnaires qui se rassemble autour d’un projet ambitieux : Donner naissance à CodeMind, une application destinée à révolutionner le quotidien des étudiant.e.s en leur permettant de forger un havre de paix au cœur d’une vie étudiante mouvementée.
 *
 * Ton groupe et toi avez identifié que comprendre les émotions est la clé pour débloquer le bien-être mental.
 * Ta première mission dans cette aventure ?
 *
 * Créer une fonctionnalité pour naviguer dans les émotions et différencier le positif du négatif. Ton équipe a découvert une technique d’analyse sentimentale innovante, mais tu dois encore l’affiner…
 * Règles
 *
 * Devant toi, 3 listes : une liste d’émotions positives et une d’émotions négatives qui te servira à différencier les émotions mélangées dans la 3ème et dernière liste.
 * Ton objectif est double : Identifier les émotions positives et reconnaître les émotions négatives.
 * Tu dois retourner…
 *
 * Le nombre d’émotions positives et le nombre d’émotions négatives trouvées dans la liste d’émotions mélangées, sous la forme 3_7 (valeurs séparées par un _ ).
 *
 * Il y a forcément au moins 1 émotion négative et 1 émotion positive dans la liste.
 */

//== NE PAS TOUCHER
$positives = ['Fierté', 'Émerveillement', 'Admiration', 'Motivation'];
$negatives = ['Indifférence', 'Mépris', 'Impatience', 'Ressentiment'];
$emotions = ['Fierté', 'Indifférence', 'Admiration', 'Fierté', 'Motivation', 'Motivation', 'Émerveillement', 'Indifférence', 'Émerveillement', 'Fierté', 'Prudence', 'Ressentiment', 'Curiosité', 'Émerveillement', 'Indifférence', 'Admiration', 'Mépris', 'Impatience', 'Curiosité', 'Indifférence', 'Prudence', 'Prudence', 'Admiration'];
//== NE PAS TOUCHER

$compteurPositif = 0;
$compteurNegatif = 0;

foreach ($emotions as $emotion) {
    if (in_array($emotion, $positives)) {
        $compteurPositif++;
    }elseif (in_array($emotion, $negatives)){
        $compteurNegatif++;
    }
}

echo $compteurPositif . "_" . $compteurNegatif;