<?php
//== NE PAS TOUCHER
$waves = ['AADABSAADDSBD', 'ADASAASAAAABAA', 'DAAAASDSSBSDD', 'SAAASBBBBASBBAA', 'AASSAASAADBBAAASA', 'AASBBAAAAAASSD', 'DSSDBBDBBDAADD', 'ABBSDBBBAAABAAA', 'BBSAAAABASAAAAAAAB', 'BSADDDSABBAAAA', 'SABAABSAAADDBB', 'SBBSAAABBDBADA', 'SDAAASDDSSAD', 'AAABBSSSDAASS', 'DAADDSDAADBDDB', 'SDSDAABASAADSD', 'AABSDBBBDDBSA'];
//== NE PAS TOUCHER

$tableauResultat = array();
$reponse='';

foreach ($waves as $wave) {

    $tab = str_split($wave);
    $previousChar = '';
    $n = 1;

    foreach ($tab as $char) {

        if ($previousChar == $char && $char == 'A') {
            $n++;

        } else {

            if ($n > 1) {
                if (!isset($tableauResultat['X' . $n])) {
                    $tableauResultat['X' . $n] = 1;
                } else {
                    $tableauResultat['X' . $n]++;

                }
            }
            $n = 1;
        }
        $previousChar = $char;
    }
    if ($n > 1) {
        if (!isset($tableauResultat['X' . $n])) {
            $tableauResultat['X' . $n] = 1;
        } else {
            $tableauResultat['X' . $n]++;

        }
    }

}
ksort($tableauResultat);
foreach ($tableauResultat as $key => $value) {

    $reponse.=$key.'_'.$value;
}

echo $reponse;
