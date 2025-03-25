<?php

//== NE PAS TOUCHER
$litrage = 194;
$ingredients = ['Pierre de Terre', 'Extrait de Eau', 'Essence de Feu', 'Essence de Bois', 'Once de Feu', 'Extrait de Feu', 'Extrait de Terre', 'Essence de Feu', 'Extrait de Feu', 'Extrait de Eau', 'Once de Feu', 'Once de Terre', 'Once de Bois', 'Extrait de Feu', 'Once de Bois', 'Essence de Terre'];
//== NE PAS TOUCHER

$ajoutLitre=0;

foreach ($ingredients as $ingredient) {
    if (strpos($ingredient,"Feu")!== false){
        $ajoutLitre+=10;
    }elseif (strpos($ingredient,"Eau")!== false){
        $ajoutLitre+=-5;
    }
}
$reponse=$litrage+$ajoutLitre;

echo $reponse;