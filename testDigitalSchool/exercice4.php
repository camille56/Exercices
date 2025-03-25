<?php

//== NE PAS TOUCHER
$sortileges = ['Somnium:9:1', 'Legero:3:5', 'Fulgora:1:6', 'NebulaVr:3:4', 'TempusF:9:3', 'ScindoOb:9:1', 'VisioFar:2:6', 'AlarteAs:4:7', 'GelFrap:2:7', 'GelFrap:9:1', 'SonusQui:9:9', 'PaxMente:6:9', 'AccioVen:5:8', 'Expelli:5:4', 'LuxPerpe:4:3', 'Expelli:6:7', 'IgnisFer:6:4'];
//== NE PAS TOUCHER

$reponse="";

foreach ($sortileges as $sortilege) {

    $elements = explode(':', $sortilege);
    $nom = $elements[0];
    $coefMagique = $elements[1];
    $effetMagique = $elements[2];

    $sort= new Sortilege($nom,$coefMagique,$effetMagique);


    $reponse.=$sort->getDiminutif($nom).$sort->getPuissance($coefMagique,$effetMagique);

}

echo $reponse;

class Sortilege{
    private $nom;
    private $coefMagique;
    private $effetMagique;

    public function __construct($nom, $coefMagique, $effetMagique) {
        $this->nom = $nom;
        $this->coefMagique = $coefMagique;
        $this->effetMagique = $effetMagique;
    }

    public function getPuissance($coefMagique,$effetMagique){

        return $coefMagique*3+$effetMagique;
    }

    public function getDiminutif($nom){
        $premiereLettre=substr($nom,0,1);
        $derniereLettre=substr($nom,-1);

        return $premiereLettre.$derniereLettre;
    }

}