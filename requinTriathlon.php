<?php
//== NE PAS TOUCHER
$repartition = ['1:338', '2:52', '3:130', '4:312', '5:416', '6:260', '7:182', '8:390', '9:494'];
$positions = ['6L', '5G', '8A', '8S', '5X', '4N', '5Y', '6B', '2I', '3V', '9B', '2F', '1J', '7I', '9A', '4Q', '8I', '5A', '8M'];
//== NE PAS TOUCHER

$tableauTronconNbrPersonne=array();
$nombreMange=0;

foreach ($repartition as $couloir) {
    $element=explode(":", $couloir);
    $numeroCouloir=$element[0];
    $nombrePersonneTroncon=($element[1])/26;

    $tableauTronconNbrPersonne[$numeroCouloir]=$nombrePersonneTroncon;

}
foreach ($positions as $position) {
    $NomCouloir=substr($position,0,1);
    $nombreMange+=$tableauTronconNbrPersonne[$NomCouloir];
}

echo $nombreMange;