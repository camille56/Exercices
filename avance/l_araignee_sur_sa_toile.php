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

//on place les mouches sur les cases. On Ne place pas l'araignée sur la toile, elle possède ses coordonnées.
foreach ($toile as $case) {
    foreach ($listeMouches as $mouche) {
        if ($case->position_X == $mouche->positionX && $case->position_Y == $mouche->positionY) {
            $case->mouche = $mouche;
        }
    }
}



//fonction recherche la mouche la plus proche
//pour toutes les coordonées de mouche, on soustrait celle de la mouche et la plus faible est la plus près
function rechercheMouchePlusProche(array $toile, Araignee $araignee)
{
    $prochaineCible=null;
    $diff_x_plus_petite=0;
    $diff_y_plus_petite=0;
    foreach ($toile as $case) {
        if ($case->mouche != null) {
            $position_X_mouche = $case->mouche->positionX;
            $position_Y_mouche = $case->mouche->positionY;

            $diff_x = $position_X_mouche - $araignee->position_X;
            $diff_y = $position_Y_mouche - $araignee->position_Y;

            if ($diff_x < $diff_x_plus_petite || $diff_x == $diff_x_plus_petite ) {
                $diff_x_plus_petite = $diff_x;
            }
            if ($diff_y < $diff_y_plus_petite || $diff_y == $diff_y_plus_petite ) {
                $diff_y_plus_petite = $diff_y;
            }
        }
    }
}

//fonction déplacement (avec perte d'energie)

//fonction mangeLaMouche (il faudra sortir la mouche de la toile)

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