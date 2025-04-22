<?php
/**
 * Un voyage en train, on le sait tous, n’est pas toujours un long fleuve tranquille. On sait normalement à quelle heure il part, mais pas toujours à quelle heure il arrive !
 *
 * L’objectif est de déterminer la durée de voyage du train en fonction des évènements du trajet :
 *
 * Arrêts dans des gares (jusque-là rien d’anormal)
 * Coupure(s) de courant
 * Incident(s) naturel(s) sur la voie
 *
 * Règles
 *
 * Le trajet est présenté sous cette forme : (dans la variable « events »)
 *
 * T__N__P____N___T___T
 *
 * Explications :
 *
 * T signifie une gare (Train station)
 * Le trajet commence donc toujours par un T et finit toujours par un T
 * P signifie une coupure de courant (Power break)
 * N signifie un incident naturel sur la voie (Natural incident)
 * Un « _ » signifie que le train roule à pleine vitesse
 *
 * Vitesses du train :
 *
 * À pleine vitesse, le train roule à 200km/h.
 * À l’approche d’une gare, le train roule à 50km/h pendant 5km.
 * Au départ d’une gare, le train roule à 50km/h pendant 5km.
 * Lors d’une coupure de courant, le train roule à 5km/h pendant 10km.
 * Lors d’un incident naturel, le train roule à 10km/h pendant 5km.
 * On ne gère pas de notion d’accélération ou autre, il faut considérer que ce sont des moyennes sur les distances énoncées.
 *
 * Le challenge renvoie également la distance totale à parcourir par le train, en km (dans la variable « distance »)
 *
 * Tu dois retourner :
 *
 * La durée totale, en secondes, du trajet complet du train.
 */

//== NE PAS TOUCHER
$distance = 1204;
$events = 'T_T__NN__T__T__T__NN__T__P__P__T__T_T';
//== NE PAS TOUCHER

//temps en seconde
$tempsTotal = 0;

const VITESSE_MAX = 200;
const VITESSE_GARE_T=50; //pendant 5km avant et après la gare.
const VITESSE_COUPURE_P=5; //pendant 10km.
const VITESSE_INCIDENT_N=10; //pendant 5km.

$listeEvenements=array();
$listeEvenements=str_split($events);

//on retire la premiere et derniere gare qui sont toujours présente.
$listeEvenements=array_slice($listeEvenements,1,-1);

$occurences=array_count_values($listeEvenements);
$nombreGares = $occurences["T"] ?? 0;
$nombreCoupures = $occurences["P"] ?? 0;
$nombreIncidents = $occurences["N"] ?? 0;
$nombreTrajetNormaux = $occurences["_"] ?? 0;

$nombreKmAnormaux=($nombreGares*5*2)+($nombreCoupures*10)+($nombreIncidents*5);
$nombreKmNormaux=$distance-$nombreKmAnormaux-(2*5); //on enleve les 5 premiers et derniers kilometres qui seront calculés à part.
$tailleTroncon=$nombreKmNormaux/$nombreTrajetNormaux;

$tempsTroncon=calculTemps($tailleTroncon,VITESSE_MAX)*$nombreTrajetNormaux;
$tempsGare=calculTemps(5*2,VITESSE_GARE_T)*$nombreGares;
$tempsCoupure=calculTemps(10,VITESSE_COUPURE_P)*$nombreCoupures;
$tempsIncident=calculTemps(5,VITESSE_INCIDENT_N)*$nombreIncidents;

//calcul du temps additionnel pour les gares de début et de fin.
$tempsAdditionnel=calculTemps(5,VITESSE_GARE_T)*2;

$tempsTotal=$tempsTroncon+$tempsGare+$tempsCoupure+$tempsIncident+$tempsAdditionnel;
echo $tempsTotal;

function calculTemps($tailleTronconEnKm,$kmParHeure){
    $tempsTroncon=$tailleTronconEnKm/$kmParHeure;
    return $tempsTroncon*60*60;
}