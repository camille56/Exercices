<?php

/**
 *
 * Introduction
 *
 * Bienvenue à Synthéria, une mégalopole futuriste où les gratte-ciel illuminent la nuit. Au cœur de cette cité qui ne dort jamais se trouve le « Spark », LE bar tendance de Synthéria.
 *
 * Au cours d’une soirée des plus banales, la quiétude de la ville fut brusquement rompue par le meurtre brutal de Firan, chef respecté des Cryptosabres : Le gang le plus redouté de toute la ville.
 *
 * Tes compétences de détective sont sollicitées pour démêler ce mystère avant que des représailles mettent la ville à feu et à sang.
 * Mission
 *
 * Ta mission consiste à démasquer le coupable parmi une liste de suspects notables, tous présents au bar ce soir-là. Chaque suspect est identifié par son nom et des caractéristiques physiques générés aléatoirement (tu retrouveras la liste des caractéristiques ci-dessous).
 *
 * À toi de trouver le bon coupable en parcourant les différents lieux où tu trouveras des indices. Ces indices te permettront d’éliminer les personnes non concordantes aux caractéristiques retrouvés.
 *
 * Le but final est de donner le nom du coupable ainsi que le nombre d’indices qu’il t’a fallu pour éliminer les suspects et n’avoir plus qu’un coupable.
 * Règles
 *
 * Analyse les indices disséminés dans le “Spark”, représentés par des caractéristiques comme la couleur des yeux, des cheveux, la taille et le poids.
 * Un indice peut indiquer soit une caractéristique que le coupable possède (is), soit une caractéristique que le coupable ne possède pas (not).
 * Les indices sont structurés de la façon suivante : type_isOrNot_valeur
 * Associe ces indices aux suspects pour réduire la liste des coupables potentiels.
 * Les suspects sont structurés de la façon suivante : nom:valeurNom,yeux:valeurYeux,cheveux:valeurCheveux,taille:valeurTaille,poids:valeurPoids (assemblage clé valeur séparé par « : », chaque assemblage séparé par « , »
 * Il faut consulter les indices dans l’ordre donné.
 * Quand il ne reste plus qu’un seul suspect… c’est que c’est le coupable !
 *
 * Tu dois retourner le nom du coupable et le nombre d’indices qu’il a fallu étudier pour arriver à ce résultat.
 *
 * Le format attendu pour cette réponse est : NOM_NOMBREINDICES (Exemple : Nicolas_4)
 */

//== NE PAS TOUCHER
$indices = ['taille_not_petit', 'poids_is_enrobe', 'cheveux_not_noirs', 'taille_is_geant', 'cheveux_not_bleu', 'taille_not_grand', 'cheveux_not_blonds', 'poids_not_mince', 'cheveux_not_blanc', 'cheveux_not_rouge', 'cheveux_not_chatain', 'taille_not_moyen', 'poids_not_costaud', 'cheveux_is_roux', 'yeux_is_bleus', 'poids_not_moyen'];
$suspects = ['nom:Pierre,yeux:noir,cheveux:chatain,taille:petit,poids:enrobe', 'nom:Sylvie,yeux:vairons,cheveux:chatain,taille:grand,poids:moyen', 'nom:Ethan,yeux:marrons,cheveux:bleu,taille:moyen,poids:moyen', 'nom:Lea,yeux:vairons,cheveux:noirs,taille:moyen,poids:moyen', 'nom:Christian,yeux:marrons,cheveux:noirs,taille:grand,poids:enrobe', 'nom:Kim,yeux:noir,cheveux:chatain,taille:petit,poids:costaud', 'nom:Leon,yeux:verts,cheveux:rouge,taille:grand,poids:moyen', 'nom:Nolan,yeux:bleus,cheveux:roux,taille:geant,poids:enrobe', 'nom:Anna,yeux:gris,cheveux:noirs,taille:grand,poids:mince', 'nom:Juliette,yeux:marrons,cheveux:chatain,taille:moyen,poids:moyen', 'nom:Guillaume,yeux:marrons,cheveux:bleu,taille:geant,poids:enrobe', 'nom:Jade,yeux:gris,cheveux:blanc,taille:moyen,poids:moyen', 'nom:Eden,yeux:marrons,cheveux:bleu,taille:petit,poids:costaud', 'nom:Agathe,yeux:bleus,cheveux:chatain,taille:geant,poids:moyen', 'nom:Arthur,yeux:vairons,cheveux:chatain,taille:moyen,poids:enrobe', 'nom:Rachid,yeux:noir,cheveux:noirs,taille:grand,poids:mince', 'nom:Eve,yeux:vairons,cheveux:vert,taille:moyen,poids:mince', 'nom:Maria,yeux:vairons,cheveux:blanc,taille:moyen,poids:moyen', 'nom:Rose,yeux:verts,cheveux:noirs,taille:moyen,poids:mince', 'nom:Adam,yeux:marrons,cheveux:noirs,taille:petit,poids:moyen'];
//== NE PAS TOUCHER

$listeSuspects = [];
$listeIndicesPlus = [];
$listeIndicesMoins = [];
$nombreIndices = 0;

foreach ($suspects as $suspect) {
    $elements = explode(",", $suspect);

    $sousElementNom = $elements[0];
    $elementNom = explode(":", $sousElementNom);
    $nom = $elementNom[1];

    $sousElementYeux = $elements[1];
    $elementYeux = explode(":", $sousElementYeux);
    $yeux = $elementYeux[1];


    $sousElementCheveux = $elements[2];
    $elementCheveux = explode(":", $sousElementCheveux);
    $cheveux = $elementCheveux[1];

    $SousElementTaille = $elements[3];
    $elementTaille = explode(":", $SousElementTaille);
    $taille = $elementTaille[1];

    $sousElementPoids = $elements[4];
    $elementPoids = explode(":", $sousElementPoids);
    $poids = $elementPoids[1];

    $objetSuspect = new Suspect($nom, $yeux, $cheveux, $taille, $poids);
    $listeSuspects[] = $objetSuspect;

}

foreach ($indices as $indice) {
    $elements = explode("_", $indice);
    $trait = $elements[0];
    $bolleen = $elements[1];
    $adjectif = $elements[2];

    $objectIndice = new indice($trait, $adjectif);

    if ($bolleen == "is") {
        $listeIndicesPlus[] = $objectIndice;

    } else {
        $listeIndicesMoins[] = $objectIndice;
    }
}

foreach ($listeIndicesMoins as $indice) {
    if (count($listeIndicesMoins) > 1) {
        $nombreIndices++;
        foreach ($listeSuspects as $key => $suspect) {

            switch ($indice->strait) {
                case"yeux":
                    if ($suspect->getYeux() == $indice->adjectif) {
                        unset($listeSuspects[$key]);
                    }
                    break;
                case"cheveux":
                    if ($suspect->getCheveux() == $indice->adjectif) {
                        unset($listeSuspects[$key]);
                    }
                    break;
                case"taille":
                    if ($suspect->getTaille() == $indice->adjectif) {
                        unset($listeSuspects[$key]);
                    }
                    break;
                case"poids":
                    if ($suspect->getPoids() == $indice->adjectif) {
                        unset($listeSuspects[$key]);
                    }
                    break;
            }

        }
    }

}

foreach ($listeIndicesPlus as $indice) {
    if (count($listeIndicesPlus) > 1) {
        $nombreIndices++;
        foreach ($listeSuspects as $key => $suspect) {
            switch ($indice->strait) {
                case"yeux":
                    if ($suspect->getYeux() != $indice->adjectif) {
                        unset($listeSuspects[$key]);
                    }
                    break;
                case"cheveux":
                    if ($suspect->getCheveux() != $indice->adjectif) {
                        unset($listeSuspects[$key]);
                    }
                    break;
                case"taille":
                    if ($suspect->getTaille() != $indice->adjectif) {
                        unset($listeSuspects[$key]);
                    }
                    break;
                case"poids":
                    if ($suspect->getPoids() != $indice->adjectif) {
                        unset($listeSuspects[$key]);
                    }
                    break;
            }
        }
    }
}

foreach ($listeSuspects as $suspect) {
    echo $suspect->getNom()."_".$nombreIndices;
}


class indice
{
    public string $strait;
    public string $adjectif;

    public function __construct(string $strait, string $adjectif)
    {
        $this->strait = $strait;
        $this->adjectif = $adjectif;
    }

}


class suspect
{
    private string $nom;
    private string $yeux;
    private string $cheveux;
    private string $taille;
    private string $poids;

    public function __construct(string $nom, string $yeux, string $cheveux, string $taille, string $poids)
    {
        $this->nom = $nom;
        $this->yeux = $yeux;
        $this->cheveux = $cheveux;
        $this->taille = $taille;
        $this->poids = $poids;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getYeux(): string
    {
        return $this->yeux;
    }

    public function getCheveux(): string
    {
        return $this->cheveux;
    }

    public function getTaille(): string
    {
        return $this->taille;
    }

    public function getPoids(): string
    {
        return $this->poids;
    }


}