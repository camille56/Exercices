<?php

/**
 *Tu es un aventurier qui découvre un nouveau monde merveilleux rempli de petits monstres mignons ! Tu décides de ne pas les déranger et de les étudier tranquillement à distance. Tu cherches à comprendre comment ils se comportent, qu’est ce qu’ils mangent, comment ils grandissent, etc.
 *
 * En les observant, tu remarques qu’ils ont 4 types d’alimentation :
 *
 * Certains mangent des pierres (Rocks)
 * Certains mangent de l’herbe (Grass)
 * Certains mangent du bois (Wood)
 * Et certains mangent des fruits (Fruits)
 *
 * Un monstre ne mange qu’un seul type d’aliments.
 *
 * Ces monstres sont rigolos, dès qu’ils mangent, ils grossissent. On va essayer de suivre un petit monstre et comprendre comment il va évoluer.
 * Règles
 *
 * Selon leur forme on peut déduire une formule mathématique qui décrit comment le monstre va grossir :
 *
 * Poids gagné = a * (poids aliment) + b.
 *
 * a et b sont 2 coefficients entiers inférieurs à 10
 * Dans ce challenge, on considérera que le poids de l’aliment est toujours égal à 1.
 *
 * Tu as à ta disposition ces informations :
 *
 * weight : le poids de départ du petit monstre
 * formula : sa formule de grossissement, sous la forme « 2G3 ». Ici cela signifie que a vaut 2, b vaut 3. Et le monstre ne pourra manger que de l’herbe (Grass).
 * foods : une liste d’aliments que va rencontrer le petit monstre
 *
 * Tu dois retourner :
 *
 * Le poids final du petit monstre en considérant qu’il va manger tout ce qui lui est possible de manger. Pour rappel, on considère que chaque aliment pèse 1.
 *
 * Si tu as réussi, tu peux te diriger vers le challenge suivant 😉
 */

//== NE PAS TOUCHER
$weight = 9;
$formula = '4F9';
$foods = 'GRWWFWWWWFGWWRFGFWWRFFWWG';
//== NE PAS TOUCHER


$poidsTotal=$weight;
$poidsAliment=1;
$elements=str_split($formula);
$coefA=$elements[0];
$coefB=$elements[2];
$nomAliment=$elements[1];

$alimentsRencontres=str_split($foods);

foreach ($alimentsRencontres as $aliment){
    if ($aliment==$nomAliment){
        $poidsSupplementaire=calculPriseDePoids($poidsAliment,$coefA,$coefB);
        $poidsTotal+=$poidsSupplementaire;
    }
}
echo $poidsTotal;


function calculPriseDePoids($poidsAliment,$coefA,$coefB):int{
    return ($coefA*$poidsAliment)+$coefB;
}