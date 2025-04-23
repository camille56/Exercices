<?php

/**
 * Une élection a eu lieu, chacun et chacune ont déposé leur bulletin secret dans l’urne. Tu dois aider à décompter les bulletins et définir les 2 candidat(e)s qui passeront au tour suivant.
 * Règles
 *
 * Une première chaîne de caractères indique les candidat(e)s qui participent à cette élection. 1 lettre = 1 candidat(e).
 *
 * Une seconde chaîne de caractères indique tous les votes. 1 lettre = 1 vote.
 *
 * Précisions :
 *
 * Certains votes ne correspondent à aucun candidat(e), ce sont des votes blancs.
 * Dans cette élection, les votes blancs ne comptent pas. Il faut donc les décompter du total des votes.
 *
 * Tu dois retourner :
 *
 * Les pourcentages des 2 candidat(e)s qui arrivent en tête, dans l’ordre, sous ce format :
 *
 * A22.1-C19.7
 *
 * Lettre du candidat(e) 1 et son pourcentage arrondi à 1 chiffre après la virgule
 * Séparation avec un tiret « -«
 * Lettre du candidat(e) 2 et son pourcentage arrondi à 1 chiffre après la virgule
 */

//== NE PAS TOUCHER
$candidates = 'JEFYRBSU';
$votes = 'EJSURUUREIFUABUFUYSBAUFUREUBFBSYBFBEEEBBYIQUKWJBEFEERTBEBUEEFBJAUJUBBFSCRSTTURRJFFSETURFUFEFBEUEYSBJUFBFERWEWUY';
//== NE PAS TOUCHER

$nombreVotes=strlen($votes);
$listeVotes=str_split($votes);
$nombreVotesBlancs=0;
$compteCandidates=[];

$listeCandidates=str_split($candidates);
foreach ($listeCandidates as $candidat){
    $compteCandidates[$candidat]=0;
}

foreach ($listeVotes as $vote){
    if (in_array($vote,$listeCandidates)){
        $compteCandidates[$vote]++;
    }else{
        $nombreVotesBlancs++;
    }
}
arsort($compteCandidates);

$premiereCandidate=array_key_first($compteCandidates);
$nombreVotePremiere=$compteCandidates[$premiereCandidate];
$deuxiemeCandidate=array_keys($compteCandidates)[1];
$nombreVoteDeuxieme=$compteCandidates[$deuxiemeCandidate];

$nombreVoteReel=$nombreVotes-$nombreVotesBlancs;
$scorePremiere=round(($nombreVotePremiere/$nombreVoteReel)*100,1);
$scoreDeuxieme=round(($nombreVoteDeuxieme/$nombreVoteReel)*100,1);

echo $premiereCandidate.$scorePremiere."-".$deuxiemeCandidate.$scoreDeuxieme;
