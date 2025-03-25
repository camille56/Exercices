<?php

/**
 * Comme d’habitude, ça ne rigole pas entre ces 2 la et ça s’envoie des coups sans retenue ! Détermine lequel des 2 tombent au tapis en premier.
 * Règles
 *
 * Les 2 combattants ont des caractéristiques :
 *
 * HP (Health Points) : leurs points de vie de départ
 * F (Force) : la force d’un coup standard
 * S (Special) : la force d’un coup spécial
 *
 * À chaque tour, les 2 combattants échangent chacun 1 coup, qui fait donc perdre l’équivalent de Force aux HP de l’autre.
 *
 * Au fur et à mesure du combat, ils peuvent déclencher des coups spéciaux. Ces coups spéciaux se déclenchent à chaque fois qu’ils perdent 1 000 HP. Et ils font perdre l’équivalent de Spécial aux HP de l’autre.
 *
 * Quelques précisions :
 *
 * Si Végéta déclenche son coup spécial, Sangoku n’attaque pas durant ce tour
 * Si Sangoku déclenche son coup spécial, Végéta n’attaque pas durant ce tour
 * Si les 2 peuvent déclencher, au même tour, leur coup spécial, c’est toujours Végéta qui le déclenche en premier
 * Le compteur des 1000 HP retombe à zéro après avoir déclenché un coup spécial
 * Lors d’un coup spécial, le personnage qui encaisse le coup spécial ne voit pas son compteur des 1000 HP augmenter.
 *
 * Tu dois retourner :
 *
 * Si les 2 combattants ont leur HP qui tombent sous zéro dans le même tour : DRAW_{nombre de tours effectués}. Par exemple : DRAW_57
 * Si Végata gagne : VEGETA_{nombre de tours}_{nombre de coups spéciaux portés par Végéta}. Par exemple : VEGETA_64_9
 * Si Sangoku gagne : SANGOKU_{nombre de tours}_{nombre de coups spéciaux portés par Sangoku}. Par exemple : SANGOKU_45_7
 */

//== NE PAS TOUCHER
$sangoku = 'HP:13000 F:249 S:511';
$vegeta = 'HP:13000 F:199 S:533';
//== NE PAS TOUCHER


$superSangoku = new Personnage($sangoku);
$superVegeta = new Personnage($vegeta);
$nombreTour = 0;

while ($superSangoku->hp > 0 && $superVegeta->hp > 0) {
    $nombreTour++;

    //vérification si une fury doit etre déclenchée.
    if ($superVegeta->fury) {
        $superSangoku->hp -= $superVegeta->special;
        $superVegeta->nombreFury++;
        $superVegeta->fury = false;
    } elseif ($superSangoku->fury) {
        if ($superSangoku->hp > 0) {
            $superVegeta->hp -= $superSangoku->special;
            $superSangoku->nombreFury++;
            $superSangoku->fury = false;
        }

    } else {
        //combat standard
        calculHit($superVegeta, $superSangoku->force);
        calculHit($superSangoku, $superVegeta->force);
    }
}

if ($superSangoku->hp <= 0 && $superVegeta->hp <= 0) {
    echo "DRAW_" . $nombreTour;
} elseif ($superSangoku->hp <= 0) {
    echo "VEGETA_" . $nombreTour . "_" . $superVegeta->nombreFury;
} elseif ($superVegeta->hp <= 0) {
    echo "SANGOKU_" . $nombreTour . "_" . $superSangoku->nombreFury;
}

function calculHit(Personnage $perso, int $hit)
{
    $perso->hp -= $hit;
    $perso->jaugeFury += $hit;
    if ($perso->jaugeFury >= 1000) {
        $perso->fury = true;
        $perso->jaugeFury = 0;
    }
}


class Personnage
{
    public $hp;
    public $force;
    public $special;

    public $fury;
    public $jaugeFury;
    public $nombreFury;

    public function __construct($data)
    {

        $element = explode(" ", $data);
        $hpData = explode(":", $element[0]);
        $forceData = explode(":", $element[1]);
        $specialData = explode(":", $element[2]);

        $this->hp = (int)$hpData[1];
        $this->force = (int)$forceData[1];
        $this->special = (int)$specialData[1];
        $this->fury = false;
        $this->jaugeFury = 0;
        $this->nombreFury = 0;
    }
}