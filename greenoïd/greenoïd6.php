<?php
//== NE PAS TOUCHER
$flux = ['V1A:1080', 'V1B:1965', 'V1C:2412'];
$network = ['V1A:V2B,V2A,V2D', 'V1B:V2B,V2D', 'V1C:V2B,V2A', 'V2A:V3G,V3E,V3A,V3F', 'V2B:V3C,V3G,V3D', 'V2C:V3A,V3G,V3D,V3C', 'V2D:V3B,V3C,V3A,V3F,V3E', 'V3A:V4C,V4B,V4G,V4J,V4E', 'V3B:V4D,V4J,V4G,V4A,V4I,V4C', 'V3C:V4G,V4B,V4A,V4K', 'V3D:V4G,V4C,V4D,V4H,V4L,V4F', 'V3E:V4E,V4C,V4J,V4D', 'V3F:V4H,V4K,V4C,V4I,V4E', 'V3G:V4G,V4I,V4B,V4D,V4K'];
//== NE PAS TOUCHER
$reponse = '';

//Création d'un tableau avec toutes les vannes
$listeVannes = array();
for ($i = 1; $i <= 4; $i++) {
    foreach (range('A', 'Z') as $element) {
        $listeVannes['V' . $i . $element] = 0;
    }
}

//création d'un tableau associatif des flux d'entrée
foreach ($flux as $element) {
    $elementsFlux = explode(':', $element);
    $nomFlux = $elementsFlux[0];
    $litreFlux = (int)$elementsFlux[1];

    //initialisation du tableau avec les valeurs $flux.
    foreach ($listeVannes as $key => $value) {
        if ($key == $nomFlux) {
            $listeVannes[$key] = $litreFlux;
        }
    }
}

foreach ($network as $instruction) { //'V1A:V2B,V2A,V2D'

    for ($i = 1; $i <= 4; $i++) {
        //Parmi les instructions, on recherche d'abord toutes celle = à 1, puis 2, etc.
        if ($instruction[1] == $i) {
            $element = explode(':', $instruction);

            //récupération de la liste des valves de destination
            $listeValveDestination = $element[1];
            $elementsValveDestination = explode(',', $listeValveDestination);
            $nombreVannesDeDestination = 0;
            $listeValveDestination = [];
            foreach ($elementsValveDestination as $elementValveDestination) {
                $nombreVannesDeDestination++;
                $listeValveDestination[] = $elementValveDestination;
            }

            //récupération du nom de la valve d'origine
            $valveOrigine = $element[0];
            //récupération du flux grace au nom de la valve d'origine
            $litreADiviser = $listeVannes[$valveOrigine];

            //division des flux
            $litrePourValveCible =floor( $litreADiviser / $nombreVannesDeDestination);

            //application du flux aux prochaines vannes.
            foreach ($listeValveDestination as $vannesDestination) {
                $listeVannes[$vannesDestination] += $litrePourValveCible;
            }

        }
    }
}

//Recherche de la réponse au de la/les vannes ayant le plus de flux.
$listeVannesNiveau4=array(); //On ne va prendre en compte que les vannes de niveau 4.
foreach ($listeVannes as $vanne=>$litre){
    $niveau=$vanne[1];
    if ($niveau=='4') {
        $listeVannesNiveau4[$vanne] =$litre;
        }
}

$vannesfluxMax=array_keys($listeVannesNiveau4,max($listeVannesNiveau4));
$fluxMaxEnLitre=max($listeVannesNiveau4);

if (!empty($vannesfluxMax)){
    $reponse.=$fluxMaxEnLitre."_";
    foreach ($vannesfluxMax as $vannes) {
        $reponse.=$vannes;
    }
}

echo $reponse; //de la forme 826_V4G ou 1132_V4AV4C si égalité