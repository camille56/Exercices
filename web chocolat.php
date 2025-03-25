<?php
$painChoc=20.00;
$schocko=3.00;



$heuresReunionSemaine=0;
$painsMange=0;
$totalGrammesChocSemaine=0;
$totalKilo=0;
$totalSemaineEquipe=0;

foreach($members as $member){
    $totalSemaineEmploye=0;
    $painsMange=1;
    $heuresReunionSemaine=0;
    if($member=='CDP'){
        $heuresReunionSemaine=6;
    }

    elseif($member=='DEV'){
        $heuresReunionSemaine=4;

    }

    elseif($member=='DIR'){
        $heuresReunionSemaine=8;
        $painsMange=2;

    }
    $totalSemaineEmploye=($heuresReunionSemaine*$schocko*2)+($painsMange*$painChoc);
    $totalSemaineEquipe+=$totalSemaineEmploye;

}
$totalGramme=$totalSemaineEquipe*45;

$totalKilo=number_format($totalGramme / 1000, 2, '.', '') . 'kg';

echo $totalKilo;