<?php

/**
 *
 * Mission
 *
 * Bulma fait l’inventaire à la Capsule Corp.
 *
 * Elle a avec elle un grand nombre de capsules, elle doit trouver lesquelles correspondent aux objets qu’elle a en stock.
 * Règles
 *
 * Dans ce challenge, 2 lots d’informations :
 *
 * objets : contient une liste d’objets identifiés par un code et un poids de l’objet. Le code est un mélange crypté du nom de l’objet et du nom du propriétaire (mais ce n’est pas important).
 * capsules : contient une liste de capsules, qui sont chacune identifiées par un code et un nombre qui correspondent à une version « réduite » du code de l’objet correspondant.
 *
 * Les capsules sont codées de cette façon :
 *
 * Les 2 premières lettres du code de l’objet
 * Les 2 dernières lettres du code de l’objet
 * Un tiret
 * Le poids de l’objet divisé par 10, arrondi à l’entier inférieur
 *
 * Voici quelques exemples :
 *
 * FZRGEEZGERGFAEZDE-134 donne FZDE-13
 * GETIZRZJIECZE-277 donne GEZE-27
 *
 * Le but de ce challenge est de trouver toutes les capsules qui correspondent à des objets présents dans la liste. Tu dois retourner la somme des poids des objets correspondants.
 *
 * Imaginons que mes 2 capsules d’exemple correspondent à des objets dans ma liste, je dois retourner 134 + 277 = 411.
 */

//== NE PAS TOUCHER
$objets = ['QAKTKZSXNNR-523', 'PLEDFDYIHGXB-160', 'LPOKKSERKLQ-106', 'ZSHMVIBFS-404', 'QDBGJNUE-471', 'ACKKNILUU-110', 'ZLGUHPJTHRF-206', 'LKUIPIWG-269', 'QMLXGVDJVT-270', 'CTITMJBD-412', 'YVRUTHRSFO-403', 'GENUEYX-347', 'PDZKNWVA-544', 'IZYCLJUOEHIC-482', 'EGNFIXXDCHV-335', 'XNXTES-438', 'WVJDWBGSM-554', 'FEQNJMRLCSZ-266', 'XCJEHRBI-455', 'MECYAKRJL-214', 'EBJIWUBRIV-444', 'CCTUOP-258', 'BPTRYFGVKLV-420', 'DGZXZGCQPYB-536', 'BNCYBWVSTPL-368', 'WHGDGEFOXE-250', 'QYDYOWRG-244', 'AKRRMZJVLRUH-337', 'XVDVOXIXOLB-147', 'YXTYYXL-168', 'PVKZNBCPFXQA-212', 'UYULTFKYP-388', 'RITGFIEB-433', 'ZLLSQWFQQIU-518', 'LLKQWYJL-300', 'HQYWDGU-352', 'JNYIPXP-504', 'FNBPPVSNQ-355', 'OTQYXZIH-467', 'UGMLWDAFAH-207', 'TTBNUUREOL-356', 'EEVSYXOCUA-252', 'USTRMDQ-224', 'EMBWPLGIFI-194', 'UVRNQCG-263', 'VHMYICANVE-262', 'PVYNPXMBG-185', 'JZTXEBJA-424', 'BYJYTOPAV-201', 'QLOGDKETE-122', 'XXDRNDBQBFK-464', 'TLWRFGAK-106', 'HDZPHMCXZ-499', 'IUNMWZHTOBJN-154', 'YBCBSQ-113', 'MKKVKMBIH-304', 'LWDSGZOGG-465', 'ZUZIJV-243', 'GGNDTVDJAID-251', 'RMUMJALHZ-140', 'JWYREBLHDJHK-505', 'THHAJPUPNRGL-469', 'UDDQQGTBXDQ-286', 'BDNRBDI-438', 'TCUANIL-384', 'WPYRWIH-445', 'RHRFSKT-233', 'JYEOIIPZQURC-535', 'QBQPADAZE-226', 'XHGMSVUP-236', 'MWEHLAP-377', 'YTPXLMSIUIVD-508', 'CMCGTF-344', 'XDNIEMACNOYB-377', 'HRGHYUBPXSR-395', 'GUUBFQHQRRT-379', 'UWQRGFOZ-130', 'CQYEKSMR-457', 'ONIWZUEG-269', 'YBYWJV-242', 'VZVYOYXDYYZ-201', 'KAYEKXQULXVK-395', 'BCWPTWGEUR-207', 'ZMRFNJMXWFH-170', 'PBHYZTJV-353', 'NZIDZUORASCJ-262', 'UBDSQCUNEF-377', 'XJEHIRIQJK-358', 'AXSETIWQLDD-447', 'XRUOKPT-230', 'PYWCLZFSKQ-131', 'BCFVFTL-503', 'RFTTVCKOYQ-223', 'AXDITXIQRFF-309', 'VCTJAONAXVHY-342', 'EBNISHS-137', 'CTBCATGM-302', 'IOGEXO-167', 'LMVXWC-441', 'FYVOUXYUG-126'];
$capsules = ['HDXZ-49', 'JZJA-42', 'DGYB-53', 'HFTM-55', 'ZLRF-20', 'GEJR-39', 'THGL-46', 'EBIV-44', 'IUJN-15', 'USDQ-22', 'UCHT-11', 'PDVA-54', 'PLPX-51', 'MEJL-30', 'AKFV-39', 'ZLRF-44', 'IUJN-47', 'RALJ-52', 'DGYB-27', 'HDLZ-50', 'EGJS-37', 'TQKE-40', 'MEJL-21', 'MKIH-30', 'IOXO-16'];
//== NE PAS TOUCHER

$poidTotal=0;
foreach ($objets as $objet){
    $elements=explode('-',$objet);
    $nomObjet=$elements[0];
    $diminutif="";
    $numero=0;
    $numero=floor($elements[1]/10);
    $premierePartie=substr($nomObjet,0,2);
    $deuxiemepartie=substr($nomObjet,-2);

    $diminutif=$premierePartie.$deuxiemepartie."-".$numero;

    if (in_array($diminutif, $capsules)){
        $poidTotal+=$elements[1];
    }
}
echo $poidTotal;