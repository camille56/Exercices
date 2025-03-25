<?php
//== NE PAS TOUCHER
$piments = ['piment-carolina-reaper:2', 'piment-carolina-reaper:3', 'cayenne:15', 'poivron:20', 'piment-scotch-bonnet:9', 'jalapeno:19', 'piment-komodo-dragon:3', 'cayenne:10', 'piment-madagascar:5', 'piment-cayenne-thailandais:13', 'pepper-x:3', 'piment-anaheim:17', 'piment-carolina-reaper:2', 'piment-dragons-breath:3', 'piment-carolina-reaper:2', 'piment-trinidad-moruga-scorpion:2', 'piment-habanero:6'];
$grammes = 804;
//== NE PAS TOUCHER


$pimentsSco=[
"poivron:0",
"piment-anaheim:1500",
"piment-poblano:1500",
"piment-banane:250",
"piment-cubanelle:550",
"jalapeno:5250",
"piment-serrano:16500",
"cayenne:40000",
"piment-tabasco:40000",
"piment-cayenne-thailandais:75000",
"piment-madagascar:125000",
"piment-habanero:225000",
"piment-scotch-bonnet:225000",
"piment-bhut-jolokia:950000",
"piment-7-pot-douglah:1400000",
"piment-komodo-dragon:1800000",
"piment-trinidad-moruga-scorpion:1600000",
"piment-carolina-reaper:1800000",
"piment-dragons-breath:2480000",
"pepper-x:3180000",
];

$scovilleTotal=0;
$tabPimentScoville=[];
        //Création du tableau avec nom piment et scoville:
    foreach ($pimentsSco as $piment){
        $element='';
        $element=explode(":", $piment);
        $tabPimentScoville[$element[0]]=$element[1];
    }

foreach ($piments as $piment){

    $scovillePiment=0;

    $element=explode(":", $piment);
    $nomPiment=$element[0];
    $grammesPiment=(int)$element[1];


    if (!empty($nomPiment)){
        $scovillePiment=$tabPimentScoville[$nomPiment];
    }

    $scovilleTotal+=ceil($scovillePiment*$grammesPiment/$grammes);
}

echo $scovilleTotal;

