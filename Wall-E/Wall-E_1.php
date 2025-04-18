<?php
/**
 * Wall-E est tout seul sur Terre pour nettoyer toute la pagaille qu’on a laissé…
 *
 * Il faut que tu l’aide à gérer tous les déchets !
 *
 * Voici les règles pour controler ce petit robot !
 *
 * Wall-E démarre avec les caractéristiques suivantes :
 *
 * Une force qui permet de déterminer comment il porte les déchets (un entier entre 10 et 20).
 * Une vitesse qui permet de savoir s’il déplace rapidement (un entier entre 5 et 15).
 * Un niveau de batterie, qui va évoluer dans le temps (au départ un entier entre 70 et 100).
 *
 * Wall-E doit traiter chaque déchet présents dans la liste. Chaque valeur de la liste représente le poids du déchet à traiter.
 * Règles
 *
 * Et voici les règles pour traiter les déchets.
 *
 * Chaque traitement de déchet va coûter de la batterie.
 * Si la force de Wall-E est supérieure ou égale au poids du déchet, Wall-E le traite sans soucis. Cela ne lui coute que 1% de batterie.
 * Si Wall-E n’a pas assez de force, il peut puiser dans sa batterie pour augmenter sa force initiale (seulement pour le déchet en cours de traitement) :
 * 1 pt de force supplémentaire coute 2% de batterie.
 * Wall-E ne peut pas dépenser + de la moitié de sa batterie courante pour augmenter sa force.
 * S’il manque 4pt de force à Wall-E, il dépensera donc 8% de batterie pour traiter le déchet (s’il a assez de batterie)
 * Si malgré la batterie, il n’a pas assez de force pour traiter le déchet, Wall-E perd 2% de batterie et ne traite pas le déchet. Il ne sera plus jamais traité.
 * Si la batterie de Wall-E passe sous les 20%, il doit aller se recharger. Cela lui coute autant de batterie qu’il a de vitesse. Si sa vitesse est de 8, il utilise 8% de batterie pour aller se recharger. Il se recharge à 100% et utilise à nouveau de la batterie pour revenir, le même montant. Dans l’exemple, il revient avec 92% de batterie (100 – 8). Mais si la vitesse de Wall-E est supérieure à la batterie restante, alors il tombe en panne et le petit robot s’arrête.
 *
 * Tu dois renvoyer le niveau de batterie final de Wall-E. Ou alors « KO » si Wall-E a puisé la totalité de sa batterie.
 *
 * Le niveau de batterie final ne peut pas être inférieur à 20, il sera forcément allé se recharger avant.
 */

//== NE PAS TOUCHER
$force = 13;
$vitesse = 14;
$batterie = 85;
$dechets = [15, 6, 9, 15, 8, 11, 21, 18, 5, 28, 15, 18, 16, 18, 30, 15, 12, 10, 25, 5];
//== NE PAS TOUCHER


$ko=false;
$i=0;
while($i<count($dechets)&&!$ko){
    $dechet=$dechets[$i];

    //Pour chaque déchet, on vérifie que la batterie ets suffisante pour le traitement.
    if (checkBatterie($batterie)){
        //On effectue le traitement, qu'il soit ok ou non, le niveau de batterie est calculé et on passe au déchet suivant.
        $traitement=traitement($force,$batterie,$dechet);
        $batterie=$traitement[1];
        $i++;
    }else{
        //Si la batterie n'est pas suffisante, on recharge.
        $recharge=recharge($batterie,$vitesse);
        if ($recharge&&$recharge!=0){
            $batterie=$recharge;
        }else{
            $ko=true;
        }
    }

}

echo $ko?"KO":$batterie;

/**
 * @param $force
 * @param $batterie
 * @param $dechet
 * @return array Retourne un tableau, le premier élèment est le succès ou l'échec du traitement, la seconde est le niveau de batterie.
 */
function traitement($force, $batterie, $dechet): array
{
    if($force>=$dechet){
        $batterie--;
    }else {
        $batterieCourante = $batterie;
        $batterieDepensee=0;
        while ($force<$dechet){
            if ($batterieDepensee<($batterieCourante/2)){
                $force++;
                $batterie-=2;
                $batterieDepensee+=2;
            }else{
                $batterie-=2;
                return [false,$batterie];
            }
        }
        $batterie--;
    }
    return [true,$batterie];
}

function checkBatterie($batterie): bool
{
    if ($batterie<20){
        return false;
    }else{
        return true;
    }
}

function recharge($batterie, $vitesse): false|int
{
    if($vitesse>$batterie){
        return false;
    }else{
        return 100-$vitesse;
    }
}