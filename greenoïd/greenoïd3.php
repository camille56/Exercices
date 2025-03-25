<?php

//== NE PAS TOUCHER
$robots = 'DDDDDDCDDDPPCCDCHDCHPDDDPPCHHDDDHCDDCDPPCDCCPCDDDPHCDHPDPDHHDHHDDDPDDPPDDDDPDDPDDDPPDHDDDCCDDPDCPCHPHDDPDDPHPDDDDD';
//== NE PAS TOUCHER

$listeRobots=str_split($robots);
$tableauEffectif=array();
$reponse="";


foreach ($listeRobots as $robot) {

    if(!isset($tableauEffectif[$robot])){
        $tableauEffectif[$robot]=1;
    }else{
        $tableauEffectif[$robot]++;
    }

}
$plusGrand=0;
$robotReponse='';
foreach($tableauEffectif as $robot=>$value){

    switch ($robot){
        case 'D':
            $robot='DESTROY';
            break;
        case 'C':
            $robot='CREATE';
            break;
        case 'P':
            $robot='PRESERVE';
            break;
        case 'H':
            $robot='HEAL';
            break;
    }

    if($value>$plusGrand){
        $plusGrand=$value;
        $robotReponse=$robot;
    }

}
echo $robotReponse.'_'.$plusGrand;