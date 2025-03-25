<?php
//== NE PAS TOUCHER
$positionX = 11;
$positionY = 60;
$logs = 'WWWNNEPSCDEEWWPNWENHNNDSSWSSDSESWEWNWWEWE';
//== NE PAS TOUCHER

$reponse="";
$listeLettre=str_split(strrev($logs));

foreach ($listeLettre  as $lettre) {
    switch ($lettre){
        case 'W':
            $positionX+=1;
            break;
        case 'E':
            $positionX+=-1;
            break;
        case 'N':
            $positionY+=-1;
            break;
        case 'S':
            $positionY+=1;
            break;
    }
}
echo $reponse=$positionX.'_'.$positionY;