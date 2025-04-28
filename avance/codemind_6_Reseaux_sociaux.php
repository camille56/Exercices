<?php

/**
 * Ce challenge fait partie de l’histoire originale : Codemind Odyssey.
 *
 * Les premiers tests de CodeMind en conditions réelles sont concluants, les étudiant.e.s te font toutes et tous des retours très positifs ! Bravo pour le chemin déjà parcouru !
 *
 * Dans ce sixième et dernier chapitre de l’aventure, l’exploration se porte sur l’influence significative des messages reçus via les réseaux sociaux sur la santé mentale. Il est évident que les mots ont un pouvoir considérable, capable soit d’améliorer, soit de dégrader le bien-être de celles et ceux qui les reçoivent.
 *
 * Tu cherches à modéliser l’effet domino provoqué par la diffusion d’un message. Ta tâche est de développer une fonctionnalité au sein de CodeMind capable de prédire l’impact des messages échangés entre les utilisateurs d’un réseau social sur leur bien-être mental.
 *
 * En analysant l’historique de milliers de messages d’un échantillon de personnes, tu arrives à définir certains comportements et à mettre en place une mécanique d’alerte…
 * Règles
 *
 * Tous ces comportements sont dans la variable “impacts” qui explique comment les utilisateurs vont s’impacter les uns les autres lors de leurs échanges.
 *
 * Chaque ligne commence par 2 informations :
 *
 * L’identifiant de l’émetteur, une lettre, de A à Z (RGPD oblige, les données ont été anonymisées)
 * Un impact sur la santé mentale, un entier entre 1 et 9
 *
 * Puis des impacts Positifs et Négatifs sur d’autres personnes :
 *
 * PA ⇒ impact Positif sur la personne “A”
 * NS ⇒ impact Négatif sur la personne “S”
 * Lors de la diffusion d’un message, un émetteur a au minimum 1 impact Positif sur 1 personne et 1 impact Négatif sur 1 autre personne.
 *
 * Mécaniques :
 *
 * La variable « messages » contient tous les émetteurs des prochains messages.
 * Chaque personne commence avec une santé mentale de 100.
 * La santé mentale d’une personne est comprise entre 0 et 100.
 * Si l’émetteur du message est A, il faut trouver la ligne d’impact de A :
 * Appliquer l’impact positivement (+) aux personnes P… avec un coefficient (x2)
 * Appliquer l’impact négativement (-) aux personnes N…
 * Malheureusement, toutes les personnes impactées négativement vont à leur tour réagir avec un message “seulement” négatif, à leurs personnes N… avec un coefficient (-1) et ainsi de suite jusqu’à ce qu’il n’y ait plus d’impact (c’est à dire quand l’impact sera de 0).
 *
 * Si ce n’est pas clair, voici un exemple pas à pas de cet effet domino :
 *
 * A:3:PC:PE:NB “La personne A a un impact de 3, positif pour C et E et négatif pour B”
 * B:4:NC:NE:PF “La personne B a un impact de 4, positif sur F, négatif sur C et E”
 * C:5:PA:PE:ND
 * Lorsque A émet un message :
 * C voit sa santé mentale augmentée de 6 (3×2)
 * E voit sa santé mentale augmentée de 6 (3×2)
 * B voit sa santé mentale diminuée de 3
 * B a un impact négatif sur C et E, ce qui va donc impacter leur santé mentale de 2 chacun (3-1)
 * C a un impact négatif sur D et va donc impacter sa santé mentale de 1 (2-1)
 * On s’arrête là car le prochain impact serait de 0 (1-1)
 *
 * Tu dois retourner…
 *
 * Le moment précis où un ou plusieurs utilisateurs basculent vers un état de risque, marqué par une santé mentale dangereusement basse (inférieure ou égale à 20). Fournis le dernier émetteur et l’identité de l’utilisateur ou des utilisateurs en danger. On utilisera « _ » comme séparateur entre le dernier émetteur et le ou les personnes en danger.
 *
 * Exemple de réponse :
 *
 * “D_V” = Le dernier émetteur est “D” et la personne à risque est la personne “V”
 * “T_CA” = Le dernier émetteur est “T” et 2 personnes sont à risque : “C” et “A”
 */


//== NE PAS TOUCHER
$impacts = ['N:4:PG:NI:NB', 'B:5:PI:PV:NH', 'P:3:PR:PL:NB:NC', 'Q:6:PW:PO:NA:NF', 'V:3:PX:PU:PZ:NR:NL', 'U:7:PA:NF', 'O:5:PL:PU:PI:NF:NK', 'J:5:PW:PG:PH:NP', 'I:6:PQ:PW:PH:NP:NJ', 'Y:6:PR:NJ', 'M:5:PR:NG:NB', 'H:3:PJ:NW:NE', 'F:5:PD:PO:NG', 'T:6:PW:PP:NQ', 'S:5:PD:PA:PE:NT', 'D:8:PK:PM:NF:NH', 'X:5:PR:PC:NH:NZ', 'W:6:PK:PE:NQ:NG', 'A:4:PQ:PS:PK:NM', 'E:4:PF:PN:ND', 'R:5:PS:PJ:NI', 'Z:7:PS:PQ:NH', 'L:7:PS:PD:PC:NT:NN', 'K:3:PS:PY:PB:NG', 'C:3:PS:PG:NQ', 'G:3:PS:NX:NT'];
$messages = 'CWWVFCBDSUPSPXLELMTI';
//== NE PAS TOUCHER

//construction de la liste de personnes.
$listePersonnes = array();

foreach ($impacts as $impact) {
    $listeCibles = array();
    $elements = explode(':', $impact);
    //récupération de l'id et impact.
    $id = $elements[0];
    $impact = $elements[1];
    //récupération des cibles
    for ($i = 2; $i < count($elements); $i++) {
        $listeCibles[] = $elements[$i];
    }
    $personne = new Personne($id, $impact, $listeCibles);
    $listePersonnes[] = $personne;
}

//Analyse de la chaine de message et répercution sur les personnes
$listeSourcesMessages = str_split($messages);

foreach ($listeSourcesMessages as $personneSource) {
    foreach ($listePersonnes as $personne) {

        if ($personne->id == $personneSource) {
            foreach ($personne->cibles as $cible) {
                impactRecursif(true, $cible, $personne->impacts, $listePersonnes);
                $reponse = verificationSante($listePersonnes, $personne->id);
                if ($reponse) {
                    echo $reponse;
                    exit;
                }
            }
        }
    }
}

/**
 * Applique l'impact positif ou négatif d'un message sur la santé mentale des personnes ciblées
 * et propage cet impact récursivement aux cibles secondaires en cas d'impact négatif.
 *
 * @param bool $premierImpact Indique si l'impact positif est appliqué pour la première fois.
 *                            True pour le premier impact, false pour les itérations suivantes.
 * @param string $cible Une chaîne définissant le type d'impact (P pour positif, N pour négatif)
 *                      suivi de la lettre identifiant la personne cible.
 * @param int $impact La valeur de l'impact à appliquer, un entier positif.
 *                    Réduit de 1 à chaque niveau de propagation récursive.
 * @param array $listePersonnes La liste de toutes les personnes concernées par les impacts,
 *                      contenant des objets avec au minimum les propriétés "id", "sante" et "cibles".
 *
 * @return void Cette fonction ne retourne aucune valeur, elle modifie directement l'état des objets dans $listePersonnes.
 */
function impactRecursif(bool $premierImpact, string $cible, int $impact, array $listePersonnes): void
{

    $cible = str_split($cible);
    $lettreImpact = $cible[0]; // P ou N
    $lettrePersonneCible = $cible[1];  // lettre de la personne cible
    $cibles = array();
    $tabkeauDeCibles=array();

    if ($impact <= 0) {
        return;
    } else {
        //l'impact positif n'a lieu que la premiere fois
        if ($premierImpact && $lettreImpact == "P") {

            foreach ($listePersonnes as $personne) {
                if ($personne->id == $lettrePersonneCible) {
                    $personne->sante = $personne->sante + ($impact * 2);
                    //la santé ne peut etre supérieur à 100;
                    if ($personne->sante > 100) {
                        $personne->sante = 100;
                    }
                }
            }
        } elseif ($lettreImpact == "N") {
            foreach ($listePersonnes as $personne) {
                if ($personne->id == $lettrePersonneCible) {
                    $personne->sante = $personne->sante - $impact;
                    $tabkeauDeCibles[] = $personne->cibles;
                }
            }
        }

    }
    foreach ($tabkeauDeCibles as $cibles) {
        foreach ($cibles as $cible) {
            $premierImpact = false;
            impactRecursif($premierImpact, $cible, $impact - 1, $listePersonnes);
        }
    }
}


/**
 * Analyse la liste des personnes pour identifier celles dont la santé est en danger,
 * et retourne une chaîne formatée à partir des identifiants des personnes à risque.
 *
 * @param array $listePersonnes Liste d'objets représentant des personnes, chaque objet doit inclure un attribut 'sante' (niveau de santé) et 'id' (identifiant de la personne).
 * @param string $personneOrigine Identifiant de la personne à l'origine de l'analyse.
 * @return false|string Retourne une chaîne contenant l'identifiant de la personne d'origine suivi des identifiants des personnes à risque concaténés, ou false si aucune personne n'est à risque.
 */
function verificationSante($listePersonnes, $personneOrigine): false|string
{
    $listePersonnesRisque = array();
    foreach ($listePersonnes as $personne) {
        if ($personne->sante <= 20) {
            $personneRisque = $personne->id;
            $listePersonnesRisque[] = $personneRisque;
        }
    }
    if (!empty($listePersonnesRisque)) {
        return $personneOrigine . "_" . implode('', $listePersonnesRisque);
    } else {
        return false;
    }
}

class Personne
{
    public string $id;
    public int $sante;
    public int $impacts;
    public array $cibles;

    public function __construct(string $id, int $impacts, array $cibles = [])
    {
        $this->id = $id;
        $this->sante = 100;
        $this->impacts = $impacts;
        $this->cibles = $cibles;
    }
}
