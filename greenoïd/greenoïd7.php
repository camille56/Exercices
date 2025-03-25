<?php
//== NE PAS TOUCHER
$keys = ['ou262v764do8i', '42h3s4xk52', 'e1941kpn67d55', '8t61iu866re48', '1gb5y893e4q15', 'd1sbo6279ba3', '2u2tfgz7223j', '6d1t4s1j77'];
//== NE PAS TOUCHER

$cleFinale = "";

//Passage des clés en binaire sur 8 bits
$resultatsClesBinaires = calculCleBinaire($keys);

//Composition de toutes les clés
$tableauComposition = comparatifCleBinaires($resultatsClesBinaires);


//Tri et repassage en base 10 puis en caractères
$cleFinale = calculValeurCleBase10($tableauComposition);
echo $cleFinale;


/**Prend un tableau de clés binaires en entrée pour les repasser en décimale.
 * Ensuite ces valeurs sont triés puis changés en char suivant leurs valeurs.
 * Retourne un string étant la réponse.
 * @param $tableauCleBinaires
 * @return string
 */
function calculValeurCleBase10($tableauCleBinaires): string
{
    $tableauValeurCleDecimal = array();
    $cleFinale = "";

    foreach ($tableauCleBinaires as $cleCleBinaire) {
        $valeurDecimalCle = bindec($cleCleBinaire);
        $tableauValeurCleDecimal[] = (int)$valeurDecimalCle;
    }
    sort($tableauValeurCleDecimal);

    foreach ($tableauValeurCleDecimal as $cleCroissant) {
        $modulo = $cleCroissant % 36;

        if ($modulo <10) {
            $lettre = $modulo;
        } else {
            $alphabet = range('a', 'z');
            $lettre = $alphabet[$modulo-10];
        }
        $cleFinale .= $lettre;
    }
    return $cleFinale;
}


/**
 * Compare chaque bit de chaque paire d'éléments dans un tableau de valeurs binaires, sans redondance.
 *  La comparaison est effectuée entre les éléments par pairs (c'est-à-dire chaque élément est comparé
 *  avec tous les autres éléments qui viennent après lui dans le tableau), et pour chaque bit,
 *  une comparaison est effectuée pour déterminer s'ils sont égaux ou non.
 * @param $tableauCleBinaires
 * @return array
 */
function comparatifCleBinaires($tableauCleBinaires): array
{
    $tableauComposition=array();
    for ($i = 0; $i < count($tableauCleBinaires); $i++) {
        for ($j = $i+1; $j < count($tableauCleBinaires); $j++) {

            $BitComparaison = "";
            $elementsCleReference = str_split($tableauCleBinaires[$i]);
            $elementsCleCompare = str_split($tableauCleBinaires[$j]);
            $longueurCleBinaires = count($elementsCleReference);

            for ($k = 0; $k < $longueurCleBinaires; $k++) {
                $BitComparaison .= $elementsCleReference[$k]==$elementsCleCompare[$k]? "1" : "0" ;
            }
            $tableauComposition[]=$BitComparaison;

        }
    }
    return $tableauComposition;
}

/** Prends un tableau de clés en entrée et retourne un tableau de ces clés en 8bit.
 * @param $cles
 * @return array
 *
 */
function calculCleBinaire($cles): array
{
    $tableauCleBinaire = array();

    foreach ($cles as $cle) {
        $clebase10 = 0;

        //décomposition de la clé
        $elementsCle = str_split($cle);
        foreach ($elementsCle as $element) {
            $digit = calculLettre($element);
            $clebase10 += $digit;
        }
        $tableauCleBinaire[] = decbin($clebase10);
    }

    return $tableauCleBinaire;
}

/** Prend une lettre en entrée (chiffre en string également) pour retourner sa valeur, "a" vaut 10, "b" 11 etc..
 * @param $element
 * @return int
 */
function calculLettre($element): int
{
    $resultat = 0;
    if (ctype_digit($element)) {
        return (int)$element;

    } else {
        $alphabet = range('a', 'z');
        $n = 10;
        foreach ($alphabet as $lettre) {
            if ($element === $lettre) {
                $resultat = $n;
                return $resultat;
            }
            $n++;
        }
    }
    return $resultat;
}