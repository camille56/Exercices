<?php

/**
 * Ce challenge fait partie de l’histoire originale : L’art du code, la revanche d’Ada.
 *
 * Ada a toujours aimé les films d’espionnage. Elle s’infiltre avec talent parmi les invités, évite les caméras et parvient à glaner de précieuses informations. Après tout, il suffit de tendre l’oreille au bon endroit et au bon moment : « Les toutes nouvelles œuvres de Jeff sont phénoménales, visionnaires, tellement avant-gardistes. D’ailleurs, elles ont déjà été converties en NFT et stockées sur une blockchain. Quel génie ! ».
 *
 * Converties en NFT, ses œuvres ? Elle envoie tout de suite l’info à Charlotte. « Ok, trouve le nom du protocole », lui répond-elle du tac-o-tac. Ada se glisse à côté d’un homme au look futuriste qui semble émerveillé par le travail de Jeff Square, et glisse tout doucement : « ces œuvres sont vraiment extraordinaires, dommage qu’elles ne soient pas protégées par une blockchain de qualité… ». A ces mots, l’homme se raidit : « Je ne peux pas vous laisser dire ça, le protocole Parallélépipèda est le meilleur de tous ! ». Ada sourit. « Oui, excusez-moi, vous avez raison ». Puis, elle s’éclipse discrètement.
 *
 * Charlotte récupère un extrait de cette blockchain qu’elle s’empresse d’étudier…
 * Règles
 *
 * Tu as à ta disposition une liste de blocs. Malheureusement ils ont été complètement désordonnés lors de l’extraction.
 *
 * Chaque bloc est composé de 4 sections de 10 caractères, séparées par des _
 *
 * Par exemple : c001224035_e7ae352efd_065c0dfc82_943615660e
 *
 * Ici, la portion c001224035 est la portion du début, elle représente l’identifiant unique du bloc.
 *
 * 943615660e est la portion de la fin, il représente l’identifiant « source » du bloc. C’est à dire qu’il fait référence à l’id d’un autre bloc, qui se trouve « avant » lui dans la chaine de blocs.
 *
 * On recherche le bloc qui se trouve au bout de la chaine de blocs la plus longue parmi tous les blocs à disposition. C’est forcément là que se trouve la signature des œuvres originelles !
 *
 * Tu dois retourner la longueur de la chaine de blocs et l’id du dernier bloc de la chaine, séparés par un _.
 *
 * Exemple de sortie : 6_6474c7b975 => Une chaine de 6 blocs dont le dernier bloc a l’id 6474c7b975.
 */

//== NE PAS TOUCHER
$blocks = ['11f9de34c9_ebd84bb233_811e9e7bd0_3225a2f33b', '3225a2f33b_b931e182dc_126cf468ff_b3c965d650', '33b757ab11_69a92882a3_1c0442fb8b_ad77c3f3c7', '69c8fdfaf9_a6848867d4_b43b6cc440_1c259ed46e', 'ad77c3f3c7_8185f82bd9_b55b294fbc_56646a8d19', '3f932f3c01_101aab96ce_1ec7030d04_5e1a6fa7e4', '0d088cf642_4d54ae4325_4c092205b3_ffef5dd3ae', 'bf1ce2df82_5092e0d671_2c90192b0f_1660d61635', 'd5d41513bc_996ffa4183_65f41bada8_9f5aab07eb', 'e35bd95c3c_0ee0818172_d30235c3a7_86aed4d734', '069d301352_ad142051f1_aca21f1739_418f19f45c', '081dcdbe42_4a282ecee1_aeec3fd4ee_9fd3af7caa', '56ee0874a2_0e2d18df75_ffdd3eab5b_6f5fa3ed7f', 'ea70a5ad6e_c6160b992b_4f24737fea_d4023b99e0', 'b3c965d650_d01c555151_2f9f757597_a43b5a2fca', '68108d740c_d6ad4560e7_0fd365b8cc_d32340bb66', '3b90c60903_02c0c42a0b_b310b11a51_bf47cde80e', '07572564a7_87d88448b2_5a55688e5d_bdb200173e', 'e38565449a_1e193e9f74_4d2946ba0e_2b309f7101', 'b807b0dd7f_2eb1719d60_85e56b4739_c6bab7542c', 'cd6ba4e18c_49f87d030a_19cd50bf6c_c295c9d20d', '7d16f1633d_6f370a8283_c4a2b78141_58f0d3d3a2', 'a43b5a2fca_47e76b079a_6529fc47f1_495b32b506', 'a2f48f83c9_ae3bf2d10c_a07c3e10a0_56ee0874a2', '75b0458ee3_eacd79fa14_94ae20cfe9_5aa8899f41', 'e109c9ab65_b42b0da2aa_9a1e321285_6903632211', '1649105290_a04d75040e_236abe090d_2601700914', 'd5a757424d_9031cfaeb0_a236d2dcc6_c9fa253f4e', '9e2e1383c8_c65d5869c2_b7232db94f_29c26f99ee', 'bfd439d106_adeedf5595_a496337396_ec456fd3a4', '4f6cea9955_94e604a1e0_26cade123e_d1c5c168a0', '56646a8d19_a8fb0d0c9a_2f5b2006b9_3f215456a2', '392ac18389_fcf6aca64d_bae41385c7_5ff8fcd029', '29c26f99ee_758c7d1a20_1edd086d6b_75b0458ee3', '495b32b506_d6ca3be9a3_d078c753af_a2f48f83c9', '56d9b6e6e3_cac78a9ae5_f4d7e77aa8_c24c3f5a16', 'e915cc315a_0b53d87fab_45f892244f_ebf516defe', '75368b7f7c_2254e6a174_f23d1e9473_8095c2875a', 'c671955166_378aa9aad1_40de02ff81_e4f11a1771', '0e5105640f_e4dec5ed31_cff6bfc31b_3d81513c4a', 'fe6487a86e_91bad9d8cb_9b96daf34a_3f932f3c01', 'd4023b99e0_9f0f84c571_e5600b9667_bf1ce2df82', '42d525dc3c_7b332e77c2_b5d02db302_d74cb7441b', '6f5fa3ed7f_d882c7b6d8_7e8526d047_7e7b7b4475', '1b0dd7db27_ad112e734e_05e7e1e481_42727e645f', '3626ff85a2_714d64a43f_2c50374818_72ca8bca15', 'c29d1116b1_ddbcf1502d_6e27c133b6_4a9b7d8507', 'ec456fd3a4_9e9624a2b6_46d812b550_fe6487a86e', '5aa8899f41_23d2c1dd5f_9447a11419_83bd111ac5', 'b621a6bb9b_87af725d32_807fb47164_0c75779a7e', 'deeabf7898_2995d8d8ad_e7de98c8df_6af5fe5674', '154f5f1a2d_8dbef8e832_c7e722f4fb_ce276f2b62', '3cc556b384_623438809a_40eff6bf37_2791581ad0'];
//== NE PAS TOUCHER

$listeBlocks = array();
foreach ($blocks as $block) {
    $elementsBlock = explode('_', $block);
    $idBlock = $elementsBlock[0];
    $idSource = $elementsBlock[3];

    $objetBlock = new Block($idBlock, $idSource);
    $listeBlocks[$idBlock] = $objetBlock;

}

//Pour chaque block on recréer la blockchain pour voir la taille de la chaine.
$listeBloksOrigine = array();
foreach ($listeBlocks as $idBlock => $block) {
    $elementBlock = TrouveBlockOrigine($block, $listeBlocks, 1);

    if (!empty($elementBlock)) {

        $blockOrigine = null;
        $sourceBlock = $elementBlock[0];
        //On récupere l'id du block précedent le block d'origine de la chaine
        //c'est donc l'idSource du block d'origine. on lecherche dans la liste
        foreach ($listeBlocks as $blockDebut) {
            if ($blockDebut->idSource == $sourceBlock->id) {
                $blockOrigine = $blockDebut;
            }
        }

        $longueurChaine = $elementBlock[1];

        $listeBloksOrigine[$longueurChaine] = $blockOrigine;
    }
}
$longueurMax = max(array_keys($listeBloksOrigine));
$blockOrigine = $listeBloksOrigine[$longueurMax];
$reponse = $longueurMax . "_" . $blockOrigine->id;
echo $reponse;


function TrouveBlockOrigine(Block $blockEtudie, array $listeBlocks, int $compteur)
{

    $blockOrigine = null;
    $blockOrigineTrouve = false;
    foreach ($listeBlocks as $idBlock => $block) {
        if ($blockEtudie->idSource == $idBlock) {
            $blockOrigine = $block;
            $blockOrigineTrouve = true;
        }
    }
    if ($blockOrigineTrouve) {
        $compteur++;
        $elementBlock = TrouveBlockOrigine($blockOrigine, $listeBlocks, $compteur);
        if (!empty($elementBlock)) {
            $compteur = $elementBlock[1];
        }
    } else {
        return $blockOrigine;
    }
    return [$blockOrigine, $compteur];
}

class Block
{
    public string $id;
    public string $idSource;

    /**
     * @param $id
     * @param $idSource
     */
    public function __construct($id, $idSource)
    {
        $this->id = $id;
        $this->idSource = $idSource;
    }
}