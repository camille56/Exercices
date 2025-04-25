<?php

/**
 *Ce challenge fait partie de l’histoire originale : Codemind Odyssey.
 *
 * La procrastination, ce fléau bien connu des étudiant.e.s, est souvent le plus grand obstacle à leur réussite et bien-être. Face à un emploi du temps chargé, repousser des tâches peut rapidement transformer l’organisation en chaos, affectant non seulement les délais mais aussi le stress et la qualité du travail.
 *
 * Tu décides de concevoir un module au sein de CodeMind qui t’aide à gérer de manière efficace tes projets. Ce module devra tenir compte des échéances initiales tout en intégrant la possibilité de procrastination, te permettant ainsi de calculer l’impact de chaque report sur ton emploi du temps.
 * Règles
 *
 * Un étudiant a X projets à réaliser, entre le 1er septembre 2023 et le 31 mai 2024.
 *
 * Pour chacun de ses projets, il y a 2 informations :
 *
 * Sa date de démarrage (au format YYYY-mm-dd)
 * Le nombre de jours nécessaires pour réaliser le projet
 *
 * Pour chaque projet, s’il procrastine, le projet va s’étendre dans le temps et se décaler en terme de nombre de jours nécessaires à la réalisation, selon la formule : (On prendra la valeur entière de durée / 10)
 *
 * On cherche à définir combien de fois, pour la période complète, deux (ou plus) projets se superposent le même jour, pour suivre un compteur de surcharge :
 *
 * Si pour une journée, il y a 2 projets qui se superposent, il faut compter +1 jour de surcharge
 * Si pour une journée, il y a 3 projets qui se superposent, il faut compter +2 jours de surcharge
 * Si pour une journée, il y a 4 projets qui se superposent, il faut compter +3 jours de surcharge
 * Et ainsi de suite…
 *
 * Tu dois retourner…
 *
 * Le nombre de jours de surcharge sans jamais procrastiner et le nombre de jours de surcharge en procrastinant tous les projets. Les 2 valeurs doivent être séparées par un “_”.
 *
 * Exemple : 120_132
 */

//== NE PAS TOUCHER
$projets = ['2024-02-03;25', '2023-09-27;27', '2024-03-27;20', '2023-12-05;19', '2024-01-16;17', '2023-12-09;18', '2024-01-16;21', '2024-03-01;17'];
//== NE PAS TOUCHER

$dateDebut = '2023-09-01';
$dateFin = '2024-05-31';
$nombreJoursSurcharge=0;
$nombreJoursSurchargeAvecProcrastination=0;

//création de la période
$debut=new DateTime($dateDebut);
$fin=new DateTime($dateFin);
$interval=new DateInterval('P1D');
$periodeGlobale=new DatePeriod($debut,$interval,$fin);

//pour chaque projet, calcul de la date de fin de projet
$listeProjet=array();
foreach ($projets as $projet){

    $dateDebutProjet="";
    $dateFinProjet="";
    $dateFinProjetSurcharge="";

    $elements=explode(';',$projet);
    $dateDebutProjet=$elements[0];
    $nombreJoursNecessaire=(int)$elements[1];
    $joursSup=calculDecalagee((int)$nombreJoursNecessaire);

    $dateDebutProjet=date_create($dateDebutProjet);
    $dateFinProjet=(clone $dateDebutProjet)->add(new DateInterval(('P'.$nombreJoursNecessaire.'D')));
    $dateFinProjetAvecProcrastination=(clone $dateDebutProjet)->add(new DateInterval(('P'.$nombreJoursNecessaire+$joursSup.'D')));

    $projet=new Projet($dateDebutProjet,$dateFinProjet,$dateFinProjetAvecProcrastination,$joursSup);
    $listeProjet[]=$projet;

}
//trie du tableau de projet par date:
usort($listeProjet, 'comparaisonDate');

//Création d'un tableau de jours associé au nombre de projets en cours.
$calendrierJourSurcharge=array();
$calendrierJourSurchargeProcrastine=array();
$jourString="";
foreach ($periodeGlobale as $jour){
    $jourString=$jour->format('Y-m-d');
    $calendrierJourSurcharge[$jourString]=0;
    $calendrierJourSurchargeProcrastine[$jourString]=0;
}
foreach ($periodeGlobale as $jour){

    foreach ($listeProjet as $projet){
        foreach ($projet->periodeProjet as $jourProjet){
            if ($jourProjet==$jour){
                $jourString=$jourProjet->format('Y-m-d');
                $calendrierJourSurcharge[$jourString]++;
            }
        }
    }

    foreach ($listeProjet as $projet) {
        foreach ($projet->periodeProjetSurcharge as $jourProjet) {
            if ($jourProjet == $jour) {
                $jourString = $jourProjet->format('Y-m-d');
                $calendrierJourSurchargeProcrastine[$jourString]++;
            }
        }
    }
}

//Solution
foreach ($calendrierJourSurcharge as $jour => $nombreDeProjet){
    if ($nombreDeProjet>1){
        $nombreJoursSurcharge+=$nombreDeProjet-1;
    }
}
foreach ($calendrierJourSurchargeProcrastine as $jour => $nombreDeProjet){
    if ($nombreDeProjet>1){
        $nombreJoursSurchargeAvecProcrastination+=$nombreDeProjet-1;
    }
}
echo $nombreJoursSurcharge.'_'.$nombreJoursSurchargeAvecProcrastination;

function calculDecalagee(int $dureeProjet) :int
{
    return floor($dureeProjet/10)+1;
}


function comparaisonDate(Projet $a, Projet $b): int
{
    return $a->dateDebut<=>$b->dateDebut;

}

class Projet{
    public DateTime $dateDebut;
    public DateTime $dateFin;
    public DateTime $dateFinSurcharge;
    public int $nombreJoursSurcharge;

    public DatePeriod $periodeProjet;
    public DatePeriod $periodeProjetSurcharge;

    /**
     * @param $dateDebut
     * @param $dateFin
     * @param $dateFinSurcharge
     * @param $nombreJoursSurcharge
     */
    public function __construct($dateDebut, $dateFin, $dateFinSurcharge, $nombreJoursSurcharge)
    {
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->dateFinSurcharge = $dateFinSurcharge;
        $this->nombreJoursSurcharge = $nombreJoursSurcharge;
        $this->periodeProjet = new DatePeriod($this->dateDebut, new DateInterval('P1D'), $this->dateFin);
        $this->periodeProjetSurcharge = new DatePeriod($this->dateDebut, new DateInterval('P1D'), $this->dateFinSurcharge);
    }

}