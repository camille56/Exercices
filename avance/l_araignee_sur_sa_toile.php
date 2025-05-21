<?php

/**
 * Une araignée est reposée tranquillement sur sa toile. Des mouches sont passées par là et se sont fait piéger ! Il est de temps les emballer pour les manger un peu plus tard.
 * Règles
 *
 * La grille fait 10 par 10, l’araignée commence sur la case 0 : 0 (en bas à gauche).
 *
 * L’araignée débute avec 80 d’énergie.
 *
 * Les mouches sont de différentes tailles, représentées par un chiffre de 1 à 5. Cependant les grosses mouches sont plus rares que les petites. Le but de l’araignée est d’emballer toutes les mouches piégées. Elle ne peut pas emballer une mouche si son énergie n’est pas au moins 3 fois supérieure à la taille de la mouche.
 *
 * Elle perd 1 point d’énergie par case parcourue.
 *
 * Emballer une mouche coûte 2 fois sa taille en énergie.
 *
 * L’araignée doit impérativement se diriger vers la mouche la plus proche. Si jamais deux mouches sont à la même distance, alors il faudra aller emballer celle avec l’ID le plus bas.
 *
 * L’araignée n’est pas très futée et ne calcule pas très bien son énergie… Par moment, il est possible qu’elle se retrouve devant une mouche à emballer mais qu’elle n’ait pas assez d’énergie pour le faire. Dans ce cas, elle doit retourner vers la mouche déjà emballée la plus proche pour la manger. Manger une mouche lui fait gagner en énergie : 5 + (5 * taille de la mouche) Vous retournerez l’énergie restante de l’araignée.
 *
 * Les mouches sont dans la variable “flies” sous cette forme ID ; TAILLE : POSITION_X : POSITION_Y
 *
 * Tu dois retourner :
 *
 * L’énergie restante de l’araignée après avoir emballé toutes les mouches.
 */

//== NE PAS TOUCHER
$flies = ['5;1:7:9', '8;1:6:9', '10;1:7:8', '2;2:4:6', '9;1:9:5', '1;1:6:3', '7;3:7:2', '12;1:9:4', '3;1:2:6', '4;2:7:1', '11;3:7:0', '6;2:0:3'];
//== NE PAS TOUCHER


//création de l'airaignée
$araignee = new Araignee("Géraldine");

//création des mouches et de leur liste
$listeMouches = array();
foreach ($flies as $fly) {
    $elementsMouche = explode(';', $fly);
    $idMouche = $elementsMouche[0];
    $sousElementsMouche = explode(':', $elementsMouche[1]);
    $tailleMouche = $sousElementsMouche[0];
    $positionX = $sousElementsMouche[1];
    $positionY = $sousElementsMouche[2];
    $mouche = new Mouche($idMouche, $tailleMouche, $positionX, $positionY);
    $listeMouches[] = $mouche;
}

//création de la toile
$toile = array();
for ($i = 0; $i < 10; $i++) {
    for ($j = 0; $j < 10; $j++) {
        $case = new CaseToile($i, $j);
        $toile[] = $case;
    }
}

//on place les mouches sur les cases. On ne place pas l'araignée sur la toile, elle possède ses coordonnées.
foreach ($toile as $case) {
    foreach ($listeMouches as $mouche) {
        if ($case->position_X == $mouche->positionX && $case->position_Y == $mouche->positionY) {
            $case->mouche = $mouche;
        }
    }
}
$boucle = true;
while ($boucle) {

    $coordonesProchaineCible = rechercheCoordonesMoucheProche($toile, $araignee);

    deplacement($araignee, $coordonesProchaineCible['x'], $coordonesProchaineCible['y']);

    //peut elle emballer la mouche?
    $coordonesX = $araignee->position_X;
    $coordonesY = $araignee->position_Y;
    $mouche = $toile[$coordonesX][$coordonesY]->mouche;
    if ($araignee->energie > $mouche->taille * 2 && !$mouche->emballer && !$mouche->mangee) {
        emballerMouche($toile, $araignee, $coordonesX, $coordonesY);
    } else {
        $coordonesProchaineCible = rechercheCoordonesMoucheProche($toile, $araignee, true);
        deplacement($araignee, $coordonesProchaineCible['x'], $coordonesProchaineCible['y']);
        mangerMouche($mouche, $araignee);
    }

    foreach ($toile as $case) {
        if ($case->mouche!==null && !$case->mouche->emballer ) {
            $boucle=false;
        }
    }
}
echo $araignee->energie;


/**
 * Recherche les coordonnées de la mouche la plus proche sur une toile, en fonction de l'état de l'araignée
 * et du statut des mouches (emballée ou non). Si plusieurs mouches sont à la même distance, celle avec
 * l'ID le plus bas sera sélectionnée.
 *
 * @param array $toile Une matrice représentant la toile, où chaque case peut contenir une mouche.
 * @param Araignee $araignee L'instance de l'araignée recherchant la mouche, avec sa position actuelle.
 * @param bool $emballer Indique si la recherche doit viser les mouches emballées (true) ou non emballées (false).
 * @return array Les coordonnées `x` et `y` de la mouche la plus proche sous la forme d'un tableau associatif.
 */
function rechercheCoordonesMoucheProche(array $toile, Araignee $araignee, bool $emballer = false): array
{


    $coordonesProchaineCible = ['x' => 0, 'y' => 0];
    foreach ($toile as $case) {
        $nombreMouvementsPlusPetit = 100;
        //selon le paramètre de la fonction, on cherche des mouches emballées ou non.
        if ($case->mouche != null && $case->mouche->emballer == $emballer && !$case->mouche->mangee) {
            $position_X_mouche = $case->mouche->positionX;
            $position_Y_mouche = $case->mouche->positionY;

            $diff_x = $position_X_mouche - $araignee->position_X;
            $diff_y = $position_Y_mouche - $araignee->position_Y;
            $nombreMouvementsActuel = $diff_x + $diff_y;

            if ($nombreMouvementsActuel <= $nombreMouvementsPlusPetit) {
                $nombreMouvementsPlusPetit = $nombreMouvementsActuel;
                $coordonesProchaineCible['x'] = $position_X_mouche;
                $coordonesProchaineCible['y'] = $position_Y_mouche;
                $idMoucheProchaineCible = $case->mouche->id;

                //Si deux mouches sont à égal distance alors, on prend celle avec l'id le plus faible.
                if ($nombreMouvementsActuel == $nombreMouvementsPlusPetit) {
                    $idMouche = $case->mouche->id;
                    if ($idMouche < $idMoucheProchaineCible) {
                        $coordonesProchaineCible['x'] = $position_X_mouche;
                        $coordonesProchaineCible['y'] = $position_Y_mouche;
                        $idMoucheProchaineCible = $idMouche;
                    }
                }

            }
        }
    }
    return $coordonesProchaineCible;
}


/**
 * Effectue le déplacement de l'araignée vers une nouvelle position donnée, tout en ajustant
 * son énergie en fonction de la distance parcourue.
 *
 * @param Araignee $araignee L'araignée qui doit être déplacée, avec sa position et son énergie actuelles.
 * @param int $x La coordonnée X de la nouvelle position cible.
 * @param int $y La coordonnée Y de la nouvelle position cible.
 * @return void Cette méthode ne retourne aucune valeur.
 */
function deplacement(Araignee $araignee, int $x, int $y): void
{
    $differenceX = $x - $araignee->position_X;
    $differenceY = $y - $araignee->position_Y;
    $nombreDeplacement = $differenceX + $differenceY;

    $araignee->energie = $araignee->energie - $nombreDeplacement;
    $araignee->position_X = $x;
    $araignee->position_Y = $y;
}


/**
 * Emballe une mouche présente sur la toile à une position donnée, ce qui réduit l'énergie de l'araignée.
 * L'énergie perdue par l'araignée est égale à deux fois la taille de la mouche.
 *
 * @param array $toile La matrice représentant la toile avec toutes les cases et les mouches.
 * @param Araignee $araignee L'araignée qui emballe la mouche, son énergie sera réduite.
 * @param int $x La coordonnée X de la position de la mouche à emballer.
 * @param int $y La coordonnée Y de la position de la mouche à emballer.
 * @return void Cette méthode ne retourne aucune valeur.
 */
function emballerMouche(array $toile, Araignee $araignee, int $x, int $y): void
{
    $mouche = $toile[$x][$y]->mouche;
    $araignee->energie = $araignee->energie - ($mouche->taille * 2);
    $toile[$x][$y]->mouche->emballer = true;

}

/**
 * Permet à l'araignée de manger une mouche pour regagner de l'énergie.
 * L'énergie gagnée est égale à 5 plus 5 fois la taille de la mouche.
 * La mouche est marquée comme mangée après cette opération.
 *
 * @param Mouche $mouche La mouche qui va être mangée par l'araignée.
 * @param Araignee $araignee L'araignée qui mange la mouche, son énergie sera augmentée.
 * @return void Cette méthode ne retourne aucune valeur.
 */
function mangerMouche(Mouche $mouche, Araignee $araignee): void
{

    $energieGagnee = ($mouche->taille * 5)+5;
    $araignee->energie = $araignee->energie + $energieGagnee;
    $mouche->mangee = true;

}

class CaseToile
{
    public int $position_X;
    public int $position_Y;
    public ?Mouche $mouche = null;

    public function __construct(int $position_X, int $position_Y, ?Mouche $mouche = null)
    {
        $this->mouche = $mouche;
        $this->position_X = $position_X;
        $this->position_Y = $position_Y;
    }
}

class Araignee
{
    public string $nom;
    public int $energie;
    public int $position_X;
    public int $position_Y;


    public function __construct(string $nom, int $energie = 80, int $position_X = 0, int $position_Y = 0)
    {
        $this->nom = $nom;
        $this->energie = $energie;
        $this->position_X = $position_X;
        $this->position_Y = $position_Y;
    }
}

class Mouche
{
    public int $id;
    public int $taille;
    public int $positionX;
    public int $positionY;
    public bool $emballer;
    public bool $mangee;

    public function __construct(int $id, int $taille, int $positionX, int $positionY)
    {
        $this->id = $id;
        $this->taille = $taille;
        $this->positionX = $positionX;
        $this->positionY = $positionY;
        $this->emballer = false;
        $this->mangee = false;
    }

}
