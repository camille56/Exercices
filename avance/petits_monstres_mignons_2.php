<?php

/**
 * Si tu ne l’as pas encore fait, tu peux commencer par Petits monstres mignons #1, le code créé pour ce premier challenge te servira pour celui-ci.
 *
 * On poursuit l’étude de ces mignons petits monstres. Cette fois-ci on va regarder comment ils se comportent en groupe.
 * Règles
 *
 * Ces petits monstres se déplacent toujours en groupe de quelques individus. Et ils sont tellement mignons que lorsqu’ils tombent sur un aliment, c’est le plus petit monstre capable de manger cet aliment qui va le manger (= celui qui a le poids le plus faible).
 *
 * Rappel de la formule mathématique qui décrit comment le monstre va grossir :
 *
 * Poids gagné = a * (poids aliment) + b.
 *
 * a et b sont 2 coefficients entiers inférieurs à 10
 * Dans ce challenge, le poids de l’aliment varie de 1 à 9.
 *
 * Cette fois-ci tu as plus d’informations à disposition :
 *
 * Les monstres sont dans le tableau monsters. Chaque ligne représente toutes les informations du monstre, séparées par « : »
 * Son nom, unique
 * Son poids de départ
 * Sa formule de grossissement
 * Les aliments que le groupe va rencontrer, dans la chaine de caractères foods sous la forme « G3F2R4 » ce qui signifie :
 * Herbe de poids 3 (Grass)
 * Fruit de poids 2 (Fruit)
 * Pierre de poids 4 (Rock)
 *
 * Tu dois retourner :
 *
 * Le nom et le poids final du petit monstre le plus lourd une fois que tous les aliments ont été mangés. Les informations doivent être séparées par un « : ».
 *
 * Attention, pour déterminer le plus petit monstre, ou le plus gros, s’il y a une égalité dans les poids, on prendra toujours le monstre qui vient en premier dans l’ordre alphabétique.
 */

//== NE PAS TOUCHER
$monsters = ['Flix35:3:4W2', 'Cobi88:9:4R6', 'Luno13:9:3G7', 'Qubo37:4:4F8', 'Tiro27:1:4W7', 'Zorp78:4:4F8', 'Cron96:3:4R1', 'Grax38:2:3W9', 'Zela24:4:4F9'];
$foods = 'G3W8W1G8W4W4G5R9G5R3W7G4W4R8W6G1F3F7F3F9';
//== NE PAS TOUCHER

//Création de la liste des repas et de leurs poids.
$dicoAliments = array();
$listeAliments = array();
$listeAliments = str_split($foods, 2);
foreach ($listeAliments as $aliment) {
    $element = str_split($aliment);
    $nomAliment = $element[0];
    $poidsAliment = $element[1];
    $dicoAliments[][$nomAliment] = $poidsAliment;
}

//Création de la liste de monstre sous forme d'objets.
$listeMonstres = array();
foreach ($monsters as $monster) {
    $element = explode(":", $monster);
    $nomMonstre = $element[0];
    $poidsMonstre = (int)$element[1];
    $formuleMonstre = $element[2];

    $elementFormule = str_split($formuleMonstre);
    $coefA = (int)$elementFormule[0];
    $coefB = (int)$elementFormule[2];
    $nomAliment = $elementFormule[1];

    $montre = new Monstre($nomMonstre, $poidsMonstre, $formuleMonstre, $nomAliment);
    $listeMonstres[] = $montre;
}

foreach ($dicoAliments as $aliment) {

    $nomAliment = key($aliment);
    $poidsAliment = (int)current($aliment);

    //On récupère le monstre le plus petit qui peut manger cet aliment.
    $monstre = TrouverLeMonstreLePlusPetitPourAliment($listeMonstres, $nomAliment);

    if(!empty($monstre)){
        $coefA = $monstre->formule[0];
        $coefB = $monstre->formule[2];
        $poidsSupplementaire = calculPriseDePoids($poidsAliment, $coefA, $coefB);
        $monstre->poids += $poidsSupplementaire;
    }
}
$montreLeplusLourd = trouverLeMonstreLePlusLourd($listeMonstres);
echo $montreLeplusLourd->nom . ":" . $montreLeplusLourd->poids;


function trouverLeMonstreLePlusLourd(array $listeMonstre): Monstre
{
    $monstrePlusLourd = $listeMonstre[0];

    foreach ($listeMonstre as $monstre) {
        // Si le poids est plus grand, on remplace directement
        if ($monstre->poids > $monstrePlusLourd->poids) {
            $monstrePlusLourd = $monstre;
        }
        // En cas d'égalité de poids
        elseif ($monstre->poids == $monstrePlusLourd->poids) {
            // Comparaison lexicographique complète, insensible à la casse
            if (strtolower($monstre->nom) < strtolower($monstrePlusLourd->nom)) {
                $monstrePlusLourd = $monstre;
            }
        }
    }
    return $monstrePlusLourd;
}


function TrouverLeMonstreLePlusPetitPourAliment(array $listeMonstre, string $nomAliment): ?Monstre
{
    $listeMonstresConcordants = array();
    foreach ($listeMonstre as $monstre) {
        if ($monstre->aliment == $nomAliment) {
            $listeMonstresConcordants[] = $monstre;
        }
    }
    if (empty($listeMonstresConcordants)) {
        return null;
    }

    $monstrePlusPetit = $listeMonstresConcordants[0];
    foreach ($listeMonstresConcordants as $monstre) {
        if ($monstre->poids < $monstrePlusPetit->poids) {
            $monstrePlusPetit = $monstre;
        }elseif ($monstre->poids==$monstrePlusPetit->poids){
            if (strtolower($monstre->nom)<strtolower($monstrePlusPetit->nom)){
                $monstrePlusPetit = $monstre;
            }
        }
    }
    return $monstrePlusPetit;
}

function calculPriseDePoids($poidsAliment, $coefA, $coefB): int
{
    return ($coefA * $poidsAliment) + $coefB;
}

class Monstre
{
    public string $nom;
    public int $poids;
    public string $formule;
    public string $aliment;

    /**
     * @param string $nom
     * @param int $poids
     * @param string $formule
     * @param string $aliment
     */
    public function __construct(string $nom, int $poids, string $formule, string $aliment)
    {
        $this->nom = $nom;
        $this->poids = $poids;
        $this->formule = $formule;
        $this->aliment = $aliment;
    }
}