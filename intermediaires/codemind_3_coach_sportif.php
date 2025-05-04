<?php

/**
 * Ce challenge fait partie de l’histoire originale : Codemind Odyssey.
 *
 * Le sport est une composante clé de la santé mentale et du bien être. Mais au cœur de la vie rythmée d’un.e étudiant.e, trouver le moment parfait pour faire du sport peut ressembler à un casse-tête…
 *
 * Tu décides alors de d’implémenter dans CodeMind un module de coach sportif, pour permettre de trouver le meilleur moment dans la journée pour faire du sport.
 * Règles
 *
 * Déroulé d’une journée et créneaux possibles :
 *
 * La journée de l’étudiant commence à 7h et termine à 19h.
 * Les créneaux sont à trouver soit le matin avant les cours, soit le midi entre les cours, ou le soir après les cours.
 * Pour faire du sport, il faut 3h de libre d’affilé. Comme ça on peut faire du sport 1h au milieu de ce créneau. Si l’étudiant est libre de 7h à 10h, il peut faire du sport de 8h à 9h.
 *
 * Comment choisir les créneaux ?
 *
 * Emploi du temps : À partir de l’emploi du temps mensuel des cours, détermine les jours et heures idéaux pour le sport.
 * Un seul créneau par jour : Si plusieurs moments se présentent, on choisit toujours le premier créneau possible de la journée, l’aurore plutôt que le crépuscule (la vie appartient à ceux qui se lèvent tôt).
 * Rythme bi-quotidien : Un jour sur deux seulement, pour laisser le corps récupérer. Attention, vendredi et lundi sont comptés comme des jours consécutifs.
 * Pas de recherche de performance : On ne cherche pas à maximiser le nombre de créneaux, s’il y a un créneau possible dès le lundi 1 matin, on le prend comme point de départ. Pour un jeu de données, il n’y a donc qu’une seule réponse possible.
 *
 * Format des données d’entrée (days) :
 *
 * Les données sont présentées sous la forme « L1 8-10 12-16 », il faut comprendre :
 *
 * Le lundi 1er
 * L’étudiant a cours de 8h à 10h
 * Puis l’étudiant a cours de 12h à 16h
 *
 * Sur cette journée, l’étudiant peut faire du sport seulement le soir de 17h à 18h.
 * Tu dois retourner…
 *
 * La liste des créneaux de sport, sous la forme ci-dessous.
 *
 * Format attendu : « Jour_du_mois:heure_debut-heure_fin »
 * Exemple : L1:17-18 (Le lundi 1 de 17h à 18h)
 *
 * Pour terminer, les créneaux trouvés doivent être séparés par un espace.
 *
 * Dernière indication : prends le temps de bien observer les données et les exemples de résolution. Ce challenge est moins compliqué techniquement qu’il en a l’air 😉
 */


//== NE PAS TOUCHER
$days = ['L1 8-12 15-19', 'M2 9-13 16-18', 'M3 8-12 14-18', 'J4 10-13 16-20', 'V5 8-11 14-17', 'L8 10-13 16-18', 'M9 9-11 12-16', 'M10 8-10 11-16', 'J11 8-12 14-16', 'V12 8-10 12-16', 'L15 10-13 15-19', 'M16 8-10 12-16', 'M17 8-11 13-17', 'J18 9-11 13-17', 'V19 8-12 15-19', 'L22 9-11 13-16', 'M23 8-12 14-16', 'M24 9-13 16-19', 'J25 8-12 15-18', 'V26 9-11 13-17', 'L29 8-12 14-16', 'M30 9-11 14-17', 'M31 9-12 14-16'];
//== NE PAS TOUCHER

$JoursEtHorairesSport = "";

//création de la liste de jours.
$listeJours = array();
foreach ($days as $day) {
    $element = explode(" ", $day);
    $jour = $element[0];
    $horaireMatin = $element[1];
    $horaireSoir = $element[2];
    $listeJours[$jour] = [$horaireMatin, $horaireSoir];
}

$dernierJourDeSport = "";
$derniereDateDeSport = 0;
foreach ($listeJours as $Jour => $dates) {

    $nomJour=substr($Jour,0,1);
    $dateJour=substr($Jour,1);

    $elementMatin = explode("-", $dates[0]);
    $debutMatin = $elementMatin[0];
    $finMatin = $elementMatin[1];

    $elementSoir = explode("-", $dates[1]);
    $debutSoir = $elementSoir[0];
    $finSoir = $elementSoir[1];

    if ($dateJour > ($derniereDateDeSport+1) || $derniereDateDeSport == 0) {

        if ($dernierJourDeSport == "V" && $nomJour == "L") {
            $heureSport = false;
        } else {

            //calcul si un horaire de sport est possible selon les horaires de cours.
            $heureSport = "";
            if (($debutMatin - 3) >= 7) {
                $heureSport = 8;
            } elseif ($debutSoir - $finMatin >= 3) {
                $heureSport = $finMatin + 1;
            } elseif (($finSoir + 3) <= 19) {
                $heureSport = $finSoir + 1;
            } else {
                $heureSport = false;
            }

            if ($heureSport) {
                $dernierJourDeSport = $nomJour;
                $derniereDateDeSport = $dateJour;

                $JoursEtHorairesSport.=$nomJour.$dateJour.":".$heureSport."-".($heureSport+1)." ";
            }
        }
    }
}
$JoursEtHorairesSport=substr($JoursEtHorairesSport,0,-1);
echo $JoursEtHorairesSport;