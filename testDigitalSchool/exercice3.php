<?php

//== NE PAS TOUCHER
$cristaux = 846;
$recettes = [3, 3, 4, 3, 4, 2, 3, 1, 4, 2, 2, 3, 3, 4, 2, 4, 3, 4, 2, 1, 1];
//== NE PAS TOUCHER

$totalCristaux=0;
foreach ($recettes as $recette){
    $cristauxCree=fabricationPotion($recette,$cristaux);
    $totalCristaux+=$cristauxCree;
    $cristaux--;
}

echo $totalCristaux;

function fabricationPotion($recette,$cristaux){
    $nombreCristaux=0;

    switch ($recette){
        case 1:
            $nombreCristaux=($cristaux*2)-50;
            break;
        case 2:
            $nombreCristaux=$cristaux+40;
            break;
        case 3:
            $nombreCristaux=$cristaux-10;
            break;
        case 4:
            $nombreCristaux=$cristaux*3;
            break;
    }

    return $nombreCristaux;
}