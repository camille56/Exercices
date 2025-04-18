<?php
/**
 * Le système renvoie la liste des coups de ton adversaire sous la forme d’une chaîne de caractères.
 *
 * Ici, on ne rigole pas, ce n’est pas le premier à 3 qui gagne, il faut gagner tous les coups !
 *
 * Si ton adversaire fait Pierre, tu dois faire Feuille, s’il fait Feuille, tu dois faire Ciseaux, s’il fait Ciseaux, tu dois faire Pierre !
 * Règles
 *
 * Chaque coup est représenté par une lettre :
 *
 * Pierre : P
 * Feuille : F
 * Ciseaux : C
 *
 * Par exemple, le système va renvoyer PFCP. 4 coups donc : Pierre, Feuille, Ciseaux, Pierre, il faudra donc retourner FCPF.
 */

//== NE PAS TOUCHER
$coups = 'CPFFCFCPCPCCFFPFPFPPP';
//== NE PAS TOUCHER

$elements=str_split($coups);
$reponse="";
foreach ($elements as $element){
    $counter="";
    switch ($element){
        case 'C':
            $counter="P";
            break;
        case 'P':
            $counter="F";
            break;
        case 'F':
            $counter="C";
            break;
    }
    $reponse.=$counter;
}
echo $reponse;