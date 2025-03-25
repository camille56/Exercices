<?php
//== NE PAS TOUCHER
$waves = ['ASDBDBABBDB', 'SABSSAADBADS', 'BDBBBABDDAA', 'SSBDBDDDSBBAD', 'DDDADABBADB', 'SBBBBSDSDBD', 'SDSBABBADDDB', 'BAASSDBASDDAAAB', 'BBDAADDSDDD', 'BSDDSABSSDBS', 'ABSBADDDAADB', 'BADBABASDADB', 'DABAASSBDBABD', 'SABSDSASABAD', 'DASSSSADDBSSSA', 'BDDSAAABSAS', 'SSASBSADBD', 'DBSBASSSBD', 'SDADDSABAASD', 'SASBBASBBASB', 'ADBDSDSBBSBSS'];
//== NE PAS TOUCHER

$puissanceMax = 0;
foreach ($waves as $wave) {
    $puissanceVague = calculPuissance($wave);
    if ($puissanceVague > $puissanceMax) {
        $puissanceMax = $puissanceVague;
    }
}

echo $puissanceMax;

function calculPuissance($wave)
{
    $tab = str_split($wave);
    $puissanceVague = 0;
    $previousChar = '';
    $bonus = 0;


    foreach ($tab as $char) {

        if ($char == 'A') {
            $puissanceVague += 5;
        }
        if ($char == 'D') {
            $puissanceVague += 3;
        }
        if ($char == 'S') {
            $puissanceVague += 2;
        }
        if ($char == 'B') {
            $puissanceVague += 8;
        }

        if (($char == 'A' || $char == 'B') && $previousChar == $char) {
            $bonus++;
        } else {
            $puissanceVague+=$bonus;
            $bonus = 0;
        }

        $previousChar = $char;

    }

    return $puissanceVague;
}
