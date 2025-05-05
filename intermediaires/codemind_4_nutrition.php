<?php

/**
 * Ce challenge fait partie de l’histoire originale : Codemind Odyssey.
 *
 * La nutrition joue un rôle indispensable dans le maintien de la santé mentale et du bien-être. Chaque bouchée affecte non seulement notre forme physique, mais aussi notre capacité à nous concentrer, notre humeur, et même la qualité de notre sommeil.
 *
 * Tu élabores dans CodeMind un module nutritionnel. Tu es chargé.e de créer un outil capable d’analyser les habitudes alimentaires des étudiant.e.s et d’évaluer comment ces habitudes influencent leur santé mentale. L’objectif est de traduire ces données en un « Healthy Score », un indicateur simple et intuitif reflétant l’effet de l’alimentation sur le bien-être.
 * Règles
 *
 * L’étudiant débute avec 4 indicateurs de bien-être, chacun pouvant osciller entre minimum 5 et maximum 25 :
 *
 * Forme (F)
 * Concentration (C)
 * Humeur (H)
 * Sommeil (S)
 *
 * L’étudiant dispose d’un panel de 6 repas qui affectent positivement ou négativement les scores des indicateurs ci-dessus :
 *
 * 3 repas à impact positif :
 * Salade Complète (SC)
 * Smoothie Nutritif (SN)
 * Plat Fait Maison (FM)
 * 3 repas à impact négatif :
 * Fast Food (FF)
 * Snack Industriel (SI)
 * Plat ultra Transformé (PT)
 *
 * Chaque repas a son équation qui te permettra de calculer ses bienfaits ou méfaits. Ces équations seront sous la forme ci-dessous et sont générées de manière aléatoire.
 *
 * Exemple pour un repas à impact positif → SC:8F2C3H2S Ce qui signifie que pour la Salade Complète (SC) :
 * +8 en Forme
 * +2 en Concentration
 * +3 en Humeur
 * +2 en Sommeil
 * Exemple pour un repas à impact négatif → SI:3F2S Ce qui signifie que pour le Snack Industriel (SI) :
 * -3 en Forme
 * -2 en Sommeil
 *
 * Attention : Les critères ne sont pas toujours tous présents, et ne sont jamais dans le même ordre ! Par contre, tu as toujours les équations des 6 plats disponibles.
 * Tu dois retourner…
 *
 * Le « Healthy Score », il s’agit du produit des 4 indicateurs de bien-être après avoir consommé tous les repas.
 *
 * Exemple, à la fin des repas, tu as ces valeurs : 22 pour Forme, 7 pour Concentration, 10 pour Humeur et 6 pour Sommeil. Le « Healthy Score » est 22 * 7 * 10 * 6, soit 9240.
 */

//== NE PAS TOUCHER
$forme = 12;
$concentration = 17;
$sommeil = 20;
$humeur = 14;
$equations = ['SC:3C4H3S4F', 'SN:1H3S2F', 'FM:3C7F8H9S', 'FF:3C1S5H1F', 'SI:5S2F1C4H', 'PT:1H1S2F1C'];
$repas = ['SI', 'FM', 'PT', 'SI', 'FM', 'SN', 'SC', 'FM', 'SC', 'FM', 'SC', 'SC', 'FF', 'PT', 'FM', 'PT', 'PT', 'PT', 'PT', 'PT', 'FM', 'FF', 'SI', 'FM', 'SI', 'FF', 'PT', 'SI', 'FM', 'SI', 'SN'];
//== NE PAS TOUCHER

$healthyScore = 0;

$listeRepas = array();
foreach ($equations as $equation) {

    $elements = explode(':', $equation);
    $nomRepas = $elements[0];
    $impacts = str_split($elements[1], 2);

    $listeImpacts = array();
    foreach ($impacts as $impact) {
        $nomCaracteristique = $impact[1];
        $valeurImpact = $impact[0];
        $listeImpacts[$nomCaracteristique] = $valeurImpact;
    }
    $objetRepas = new Repas($nomRepas, $listeImpacts);
    $listeRepas[] = $objetRepas;
}

foreach ($repas as $repasMange) {
    foreach ($listeRepas as $objetRepas) {
        if ($objetRepas->nom == $repasMange) {
            $listeImpacts = $objetRepas->impacts;
            foreach ($listeImpacts as $caracteristique => $valeurImpact) {
                switch ($caracteristique) {
                    case 'F':
                        $objetRepas->positif ? $forme += $valeurImpact : $forme -= $valeurImpact;
                        break;
                    case 'C':
                        $objetRepas->positif ? $concentration += $valeurImpact : $concentration -= $valeurImpact;
                        break;
                    case 'H':
                        $objetRepas->positif ? $humeur += $valeurImpact : $humeur -= $valeurImpact;
                        break;
                    case 'S':
                        $objetRepas->positif ? $sommeil += $valeurImpact : $sommeil -= $valeurImpact;
                        break;
                }
                // On s'assure que chaque indicateur reste entre 5 et 25
                $forme = max(5, min(25, $forme));
                $concentration = max(5, min(25, $concentration));
                $humeur = max(5, min(25, $humeur));
                $sommeil = max(5, min(25, $sommeil));
            }
        }
    }
}
$healthyScore = calculerHealthyScore($forme, $concentration, $humeur, $sommeil);
echo $healthyScore;


function calculerHealthyScore($forme, $concentration, $humeur, $sommeil): float|int
{
    return $forme * $concentration * $humeur * $sommeil;
}

class Repas
{
    public string $nom;
    public array $impacts;
    public bool $positif;

    /**
     * @param string $nom
     * @param array $impacts
     */
    public
    function __construct(string $nom, array $impacts)
    {
        $positif = false;
        if (($nom == "SC") || ($nom == "SN") || ($nom == "FM")) {
            $positif = true;
        }

        $this->impacts = $impacts;
        $this->nom = $nom;
        $this->positif = $positif;
    }


}