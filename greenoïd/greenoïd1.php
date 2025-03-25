<?php
//== NE PAS TOUCHER
$serial = '845674385712';
//== NE PAS TOUCHER

$reponse='';
$listeLettre=str_split($serial);

foreach ($listeLettre as $chiffre){

    if ($chiffre%2==0){
        //le chiffre est pair
        $reponse.='R';
    }else{
        $reponse.='L';
    }

}
echo $reponse;