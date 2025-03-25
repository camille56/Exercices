<?php
//== NE PAS TOUCHER
$waves = ['DASSBDDBASSSS', 'SDABSABAADS', 'BASBABDSDDBS', 'AABSDBDBDSSAA', 'ADDASDBASABA', 'DDSASSSDSDDS', 'DSSBABSSBSBBB', 'BDSDAADSBSS', 'ASASDBADDBBBA', 'SBDBDDSBBADD', 'AASBBADAAB', 'BBSDDAADAA', 'DSSASADSAAAAB', 'SDSDDBAAADB', 'ASBABSSADBBA', 'SBDBABBBAA', 'DDABSDDBASS', 'ASBDABAAASBABBD', 'DAAADDSSSSD', 'ADDASBDDSBDB', 'DDBDSADSASB'];
//== NE PAS TOUCHER

$nombreDef=0;

foreach($waves as $wave){
    $tabString=str_split($wave);
    foreach($tabString as $char){
        if($char='D'){
            $nombreDef++;
        }
    }
}
echo $nombreDef;