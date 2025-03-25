<?php
//== NE PAS TOUCHER
$sequences = ['CHPPCPDCPHH', 'HHCDDDHDPDH', 'CHHHCCPPDP', 'HDHPHCHDHHDH', 'PDPDCCHDDC', 'CCHHPHCHDD', 'PHCPHCPDDDC', 'DCCDDDDDDHPD', 'CHDDHDHCHDD', 'HHCHPHDDDP'];
$storages = ['DHCCPD', 'HPPC', 'PPCHHC', 'HDDPDD', 'DHPHD'];
//== NE PAS TOUCHER

$stringSequencemax='';
$tempsMaxSeq=0;
$tempsMax=0;

$stringStorageMax='';
$tempstotalStor=0;
$tempsMaxStor=0;

foreach ($sequences as $sequence) {
    $tabLettre=str_split($sequence);
    $tempsSequence=calculTemps($tabLettre);

    if ($tempsSequence>$tempsMaxSeq){
        $tempsMaxSeq=$tempsSequence;
        $stringSequencemax=$sequence;
    }
}
foreach ($storages as $storage){
    $tabLettre=str_split($storage);
    $tempsStorage=calculTemps($tabLettre);

    if ($tempsStorage>$tempsMaxStor){
        $tempsMaxStor=$tempsStorage;

        $stringStorageMax=$storage;
    }
}

$tempsMax=$tempsMaxSeq+$tempsMaxStor;

echo $stringSequencemax.$stringStorageMax.'_'.(string)$tempsMax;


function calculTemps( $array): int
{
    $tempsTotal=0;

    $preserve=1;
    $heal=2;
    $create=3;
    $destroy=4;

    foreach ($array as $lettre) {
        $temps=0;

        switch ($lettre) {
            case 'C':
                $temps = $create;
                break;
            case 'H':
                $temps = $heal;
                break;
            case 'P':
                $temps = $preserve;
                break;
            case 'D':
                $temps = $destroy;
                break;
        }
        $tempsTotal+=$temps;
    }

    return $tempsTotal;
}