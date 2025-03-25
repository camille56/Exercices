<?php
//== NE PAS TOUCHER
$co2 = [87, 51, 65, 50, 83, 63, 58, 63, 89];
$water = [881, 944, 931, 829, 987, 738, 527, 769, 698];
$deforestation = [6378, 8478, 8094, 8370, 7433, 6807, 7508, 7286, 6932];
$agricultural = [9, 13, 10, 9, 5, 9, 10, 12];
$plastic = [1844, 1722, 2251, 2504, 3032, 1810, 1543, 1557, 3238];
$renewable = [11, 18, 11, 13, 13, 20, 8, 19, 5];
//== NE PAS TOUCHER

sort($co2);
$co2Filtre=array_slice($co2,1,-1);
$co2Moyen=calculMoyenne($co2Filtre);
sort($water);
$waterFiltre=array_slice($water,1,-1);
$waterMoyen=calculMoyenne($waterFiltre);
sort($deforestation);
$deforestationFiltre=array_slice($deforestation,1,-1);
$deforestationMoyen=calculMoyenne($deforestationFiltre);
sort($agricultural);
$agriculturalFiltre=array_slice($agricultural,1,-1);
$agricultureMoyenne=calculMoyenne($agriculturalFiltre);
sort($plastic);
$plasticFiltre=array_slice($plastic,1,-1);
$plasticMoyen=calculMoyenne($plasticFiltre);
sort($renewable);
$renewableFiltre=array_slice($renewable,1,-1);
$renewableMoyen=calculMoyenne($renewableFiltre);

$P=floor((($co2Moyen+($plasticMoyen/1000))/2)*(1-($renewableMoyen/100)));

$R=floor((((100-($waterMoyen/10))+(100-($deforestationMoyen/100)))+($agricultureMoyenne+$renewableMoyen))/4);


$P<$R?$reponse=$P.'_'.$R:$reponse=$R.'_'.$P;

echo $reponse;

function calculMoyenne($array) :int{
    $total=0;
    $n=0;
    if (empty($array)) {
        return 0;
    }
    foreach ($array as $value){
        $n++;
        $total+=$value;
    }
    return floor($total/$n);
}