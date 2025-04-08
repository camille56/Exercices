<?php

/**
 *
 * Mission
 *
 * Pour garder la confidentialité de l’entreprise cible, celle-ci sera nommée XXXXXXXX.
 *
 * Dans ta tentative de pénétration du système de XXXXXXXX, tu as récupéré une liste partielle de comptes mail de l’entreprise. Pour chaque compte, tu as le mail et le mot de passe crypté.
 *
 * Tu as aussi réussi à mettre la main sur une note interne du service informatique de XXXXXXXX, qui explique comment sont créés les mots de passe par défaut. Pour chaque nouveau compte, le service informatique crée un mot de passe « aléatoire » simple, que le collaborateur est invité à changer rapidement.
 *
 * Voici la façon dont est créé le mot de passe :
 *
 * Le prénom en minuscule
 * Les 3 premières lettres du nom en majuscule
 * Un @
 * Un nombre aléatoire entre 10 et 99
 * Une lettre aléatoire en majuscule
 *
 * Par exemple, Elliot Anderson pourrait avoir le mot de passe : elliotAND@35K ou elliotAND@77E
 * Règles
 *
 * Normalement chaque collaborateur met à jour son mot de passe rapidement… Mais l’un d’entre eux ne l’a pas fait…
 *
 * Tu dois retourner le mot de passe du collaborateur négligent.
 *
 * L’algorithme de cryptage utilisé est sha256.
 */

//== NE PAS TOUCHER
$informations = ['lena.vasseur@XXXXXXXX.com:6bd3c52863cb9a6bae7cae9ba369c7344be7cfedac25bbd1df97e0c1377b9c41', 'marie.duval@XXXXXXXX.com:f2a4b9a5b19b884c3c23c6232aca02081ffca0dffc92db2ee0dd206cd8afa5e1', 'mohamed.huet@XXXXXXXX.com:76c46a35236a7f01b920d4f2954d681733b25f625ef63bb1cd9a0dc7aa1b03b2', 'agathe.poulain@XXXXXXXX.com:dfc3bd99c7edf798a00479c009f548a29723a0e0952d0a9efff68584be69a81a', 'nathan.barbier@XXXXXXXX.com:1060e52776ec51093e8567d72214144f10d97f146840c586144450f382c84447', 'pauline.boyer@XXXXXXXX.com:2a3ba4ecf7aaf04663e6fb7629399de5be062a4fb768f8596580309155ae3554', 'icham.leroux@XXXXXXXX.com:6dc0de10b9d87dc05ee91c40845bf09252374a0041a2923e5a108a9c06577c6a', 'aicha.muller@XXXXXXXX.com:505c312d5f8760d1ce78576494bcec576df930e51a20f1e097ace4e2da6802b3', 'julia.mallet@XXXXXXXX.com:4b9773e231d4135a8ef5a1b1bb7f3bc06b3095dda78888d49d1109a5ca10f94b', 'catherine.lemaire@XXXXXXXX.com:afab4fe63ce83ff4ff614abbb9be453cf9b2d5c68472992bda77ced7868a5b93', 'martine.simon@XXXXXXXX.com:d3383d8f0e54abba4a6680ee1a718250d1347091cd23a06afcf2b4aac30b7f96', 'guillaume.martin@XXXXXXXX.com:7642b7bdfe3bce688bf6fb6f48635e7fdb1ac53c0e3b1ade80a781a000ca74b9', 'walim.aubert@XXXXXXXX.com:38796820afe23030b96f02ecf599546f289110b5e0d53fef1b88392e993dd4aa', 'emma.dupont@XXXXXXXX.com:6197a5ecfb2cc39011ad88ee24fc43ab7bf5b46ed3d1202e8480f8ba705aee67'];
//== NE PAS TOUCHER

foreach ($informations as $compte) {
    $elements = explode(':', $compte);
    $elementNom=explode('.', $elements[0]);
    $prenom=$elementNom[0];
    $elementNom=explode("@",$elementNom[1]);
    $nom=$elementNom[0];
    $mdpSHA256=$elements[1];

    $mdptrouve=chercheMdp($nom,$prenom,$mdpSHA256);

    if (!empty($mdptrouve)){
        echo $mdptrouve;
    }


}

function chercheMdp($nom,$prenom,$mdpCypte): string
{
    $solution="";
    $mdpBase="";
    $mdpBase.=strtolower($prenom);
    $diminutifNom=substr($nom,0,3);
    $mdpBase.=strtoupper($diminutifNom);
    $mdpBase.="@";

    for($i=10;$i<=99;$i++){
        $mdptestChiffre=$mdpBase;
        $mdptestChiffre.=$i;
        for($lettre = ord('A'); $lettre <= ord('Z'); $lettre++){
            $mdpTestLettre=$mdptestChiffre;
            $mdpTestLettre.=chr($lettre);

            $mdp=hash("sha256",$mdpTestLettre);

            if($mdp == $mdpCypte){
                return $mdpTestLettre;
            }

        }
    }
    return $solution;
}