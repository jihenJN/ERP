<?php $this->layout = 'AdminLTE.print'; ?>
<?php
// function chifre_en_lettre($montant, $factureclientse1, $factureclientse2)
// {
//     if (($factureclientse1 == 1)) $dev1 = 'Dinars';
//     if (($factureclientse1 == 2)) $dev1 = 'Dollars';
//     if (($factureclientse1 == 3)) $dev1 = 'Euro';
//     if (($factureclientse1 == 1)) $dev2 = 'Millimes';
//     if (($factureclientse1 == 2)) $dev2 = 'Cent';
//     if (($factureclientse1 == 3)) $dev2 = 'Centimes';
//     $valeur_entiere = intval($montant);
//     $valeur_decimal = (($montant - intval($montant)) * 1000);
//     $dix_c = ($valeur_decimal % 100 / 10);
//     $cent_c = intval($valeur_decimal % 1000 / 100);
//     $unite_c = $valeur_decimal % 10;
//     $unite[1] = $valeur_entiere % 10;
//     $dix[1] = intval($valeur_entiere % 100 / 10);
//     $cent[1] = intval($valeur_entiere % 1000 / 100);
//     $unite[2] = intval($valeur_entiere % 10000 / 1000);
//     $dix[2] = intval($valeur_entiere % 100000 / 10000);
//     $cent[2] = intval($valeur_entiere % 1000000 / 100000);
//     $unite[3] = intval($valeur_entiere % 10000000 / 1000000);
//     $dix[3] = intval($valeur_entiere % 100000000 / 10000000);
//     $cent[3] = intval($valeur_entiere % 1000000000 / 100000000);
//     //echo $unite_c;
//     $chif = array('', 'Un', 'Deux', 'Trois', 'Quatre', 'Cinq', 'Six', 'Sept', 'Huit', 'Neuf', 'Dix', 'Onze', 'Douze', 'Treize', 'Quatorze', 'Quinze', 'Seize', 'Dix-sept', 'Dix-huit', 'Dix-neuf');
//     $secon_c = '';
//     $trio_c = '';
//     for ($i = 1; $i <= 3; $i++) {
//         $prim[$i] = '';
//         $secon[$i] = '';
//         $trio[$i] = '';
//         if ($dix[$i] == 0) {
//             $secon[$i] = '';
//             $prim[$i] = $chif[$unite[$i]];
//         } else if ($dix[$i] == 1) {
//             $secon[$i] = '';
//             $prim[$i] = $chif[($unite[$i] + 10)];
//         } else if ($dix[$i] == 2) {
//             if ($unite[$i] == 1) {
//                 $secon[$i] = 'Vingt et';
//                 $prim[$i] = $chif[$unite[$i]];
//             } else {
//                 $secon[$i] = 'Vingt';
//                 $prim[$i] = $chif[$unite[$i]];
//             }
//         } else if ($dix[$i] == 3) {
//             if ($unite[$i] == 1) {
//                 $secon[$i] = 'Trente et';
//                 $prim[$i] = $chif[$unite[$i]];
//             } else {
//                 $secon[$i] = 'Trente';
//                 $prim[$i] = $chif[$unite[$i]];
//             }
//         } else if ($dix[$i] == 4) {
//             if ($unite[$i] == 1) {
//                 $secon[$i] = 'Quarante et';
//                 $prim[$i] = $chif[$unite[$i]];
//             } else {
//                 $secon[$i] = 'Quarante';
//                 $prim[$i] = $chif[$unite[$i]];
//             }
//         } else if ($dix[$i] == 5) {
//             if ($unite[$i] == 1) {
//                 $secon[$i] = 'Cinquante et';
//                 $prim[$i] = $chif[$unite[$i]];
//             } else {
//                 $secon[$i] = 'Cinquante';
//                 $prim[$i] = $chif[$unite[$i]];
//             }
//         } else if ($dix[$i] == 6) {
//             if ($unite[$i] == 1) {
//                 $secon[$i] = 'Soixante et';
//                 $prim[$i] = $chif[$unite[$i]];
//             } else {
//                 $secon[$i] = 'Soixante';
//                 $prim[$i] = $chif[$unite[$i]];
//             }
//         } else if ($dix[$i] == 7) {
//             if ($unite[$i] == 1) {
//                 $secon[$i] = 'Soixante et';
//                 $prim[$i] = $chif[$unite[$i] + 10];
//             } else {
//                 $secon[$i] = 'Soixante';
//                 $prim[$i] = $chif[$unite[$i] + 10];
//             }
//         } else if ($dix[$i] == 8) {
//             if ($unite[$i] == 1) {
//                 $secon[$i] = 'Quatre-vingt et';
//                 $prim[$i] = $chif[$unite[$i]];
//             } else {
//                 $secon[$i] = 'Quatre-vingt';
//                 $prim[$i] = $chif[$unite[$i]];
//             }
//         } else if ($dix[$i] == 9) {
//             if ($unite[$i] == 1) {
//                 $secon[$i] = 'Quatre-vingt et';
//                 $prim[$i] = $chif[$unite[$i] + 10];
//             } else {
//                 $secon[$i] = 'Quatre-vingt';
//                 $prim[$i] = $chif[$unite[$i] + 10];
//             }
//         }
//         if ($cent[$i] == 1) $trio[$i] = 'Cent';
//         else if ($cent[$i] != 0 || $cent[$i] != '') $trio[$i] = $chif[$cent[$i]] . ' Cents';
//     }
//     $v = "";
//     $chif2 = array('', 'Dix', 'Vingt', 'Trente', 'Quarante', 'Cinquante', 'Soixante', 'Soixante-dix', 'Quatre-vingts', 'Quatre-vingt-dix');
//     $secon_c = $chif2[$dix_c];
//     if ($cent_c == 1) $trio_c = 'Cent';
//     else if ($cent_c != 0 || $cent_c != '') $trio_c = $chif[$cent_c] . ' Cent';
//     if (($cent[3] == 0 || $cent[3] == '') && ($dix[3] == 0 || $dix[3] == '') && ($unite[3] == 1))
//         $v = $v . ' ' . $trio[3] . '  ' . $secon[3] . ' ' . $prim[3] . ' Million ';
//     else if (($cent[3] != 0 && $cent[3] != '') || ($dix[3] != 0 && $dix[3] != '') || ($unite[3] != 0 && $unite[3] != ''))
//         $$v = $v . ' ' . $trio[3] . ' ' . $secon[3] . ' ' . $prim[3] . ' Millions ';
//     else
//         $v = $v . ' ' . $trio[3] . ' ' . $secon[3] . ' ' . $prim[3];
//     if (($cent[2] == 0 || $cent[2] == '') && ($dix[2] == 0 || $dix[2] == '') && ($unite[2] == 1))
//         $v = $v . ' ' . ' Mille ';
//     else if (($cent[2] != 0 && $cent[2] != '') || ($dix[2] != 0 && $dix[2] != '') || ($unite[2] != 0 && $unite[2] != ''))
//         $v = $v . ' ' . $trio[2] . ' ' . $secon[2] . ' ' . $prim[2] . ' Mille ';
//     else
//         $v = $v . ' ' . $trio[2] . ' ' . $secon[2] . ' ' . $prim[2];
//     $v = $v . $trio[1] . ' ' . $secon[1] . ' ' . $prim[1];
//     $v = $v . ' ' . $dev1 . ' ';
//     if (($cent_c == '0' || $cent_c == '') && ($dix_c == '0' || $dix_c == ''))
//         $v = $v; // .' '. '   '. $dev2;
//     else
//         $v = $v . ' et ' . round($valeur_decimal, 0) . ' ' . $dev2;
//     return $v;
// }
function chifre_en_lettre($montant, $devise1, $devise2)
{
    if (($devise1 == 1)) $dev1 = 'Dinars';
    if (($devise1 == 2)) $dev1 = 'Dollars';
    if (($devise1 == 3)) $dev1 = 'Euro';
    if (($devise1 == 1)) $dev2 = 'Millimes';
    if (($devise1 == 2)) $dev2 = 'Cents';
    if (($devise1 == 3)) $dev2 = 'Centimes';
    $valeur_entiere = intval($montant);
    debug($valeur_entiere);//die;
    $valeur_decimal = (($montant - intval($montant)) * 1000);
     debug($valeur_decimal);//die;
    $dix_c = ($valeur_decimal % 100 / 10);
    $cent_c = intval($valeur_decimal % 1000 / 100);
    $unite_c = $valeur_decimal % 10;
    $unite[1] = $valeur_entiere % 10;
    //debug($unite[1]);die;
    $dix[1] = intval($valeur_entiere % 100 / 10);
    $cent[1] = intval($valeur_entiere % 1000 / 100);
    $unite[2] = intval($valeur_entiere % 10000 / 1000);
    $dix[2] = intval($valeur_entiere % 100000 / 10000);
    $cent[2] = intval($valeur_entiere % 1000000 / 100000);
    $unite[3] = intval($valeur_entiere % 10000000 / 1000000);
    $dix[3] = intval($valeur_entiere % 100000000 / 10000000);
    $cent[3] = intval($valeur_entiere % 1000000000 / 100000000);
    //echo $unite_c;
    $chif = array('', 'Un', 'Deux', 'Trois', 'Quatre', 'Cinq', 'Six', 'Sept', 'Huit', 'Neuf', 'Dix', 'Onze', 'Douze', 'Treize', 'Quatorze', 'Quinze', 'Seize', 'Dix-sept', 'Dix-huit', 'Dix-neuf');
    $secon_c = '';
    $trio_c = '';
    for ($i = 1; $i <= 3; $i++) {
        $prim[$i] = '';
        $secon[$i] = '';
        $trio[$i] = '';
        if ($dix[$i] == 0) {
            $secon[$i] = '';
            $prim[$i] = $chif[$unite[$i]];
        } else if ($dix[$i] == 1) {
            $secon[$i] = '';
            $prim[$i] = $chif[($unite[$i] + 10)];
        } else if ($dix[$i] == 2) {
            if ($unite[$i] == 1) {
                $secon[$i] = 'Vingt et';
                $prim[$i] = $chif[$unite[$i]];
            } else {
                $secon[$i] = 'Vingt';
                $prim[$i] = $chif[$unite[$i]];
            }
        } else if ($dix[$i] == 3) {
            if ($unite[$i] == 1) {
                $secon[$i] = 'Trente et';
                $prim[$i] = $chif[$unite[$i]];
            } else {
                $secon[$i] = 'Trente';
                $prim[$i] = $chif[$unite[$i]];
            }
        } else if ($dix[$i] == 4) {
            if ($unite[$i] == 1) {
                $secon[$i] = 'Quarante et';
                $prim[$i] = $chif[$unite[$i]];
            } else {
                $secon[$i] = 'Quarante';
                $prim[$i] = $chif[$unite[$i]];
            }
        } else if ($dix[$i] == 5) {
            if ($unite[$i] == 1) {
                $secon[$i] = 'Cinquante et';
                $prim[$i] = $chif[$unite[$i]];
            } else {
                $secon[$i] = 'Cinquante';
                $prim[$i] = $chif[$unite[$i]];
            }
        } else if ($dix[$i] == 6) {
            if ($unite[$i] == 1) {
                $secon[$i] = 'Soixante et';
                $prim[$i] = $chif[$unite[$i]];
            } else {
                $secon[$i] = 'Soixante';
                $prim[$i] = $chif[$unite[$i]];
            }
        } else if ($dix[$i] == 7) {
            if ($unite[$i] == 1) {
                $secon[$i] = 'Soixante et';
                $prim[$i] = $chif[$unite[$i] + 10];
            } else {
                $secon[$i] = 'Soixante';
                $prim[$i] = $chif[$unite[$i] + 10];
            }
        } else if ($dix[$i] == 8) {
            if ($unite[$i] == 1) {
                $secon[$i] = 'Quatre-vingts et';
                $prim[$i] = $chif[$unite[$i]];
            } else {
                $secon[$i] = 'Quatre-vingts';
                $prim[$i] = $chif[$unite[$i]];
            }
        } else if ($dix[$i] == 9) {
            if ($unite[$i] == 1) {
                $secon[$i] = 'Quatre-vingts et';
                $prim[$i] = $chif[$unite[$i] + 10];
            } else {
                $secon[$i] = 'Quatre-vingts';
                $prim[$i] = $chif[$unite[$i] + 10];
            }
        }
        debug($cent[$i]);
        if ($cent[$i] == 1) $trio[$i] = 'Cent';
        //else if ($cent[$i] != 0 || $cent[$i] != '') $trio[$i] = $chif[$cent[$i]] . ' Cents';
    }
    $v = "";
    $chif2 = array('', 'Dix', 'Vingt', 'Trente', 'Quarante', 'Cinquante', 'Soixante', 'Soixante-dix', 'Quatre-vingts', 'Quatre-vingt-dix');
    $secon_c = $chif2[$dix_c];
    if ($cent_c == 1) $trio_c = 'Cent';
    else if ($cent_c != 0 || $cent_c != '') $trio_c = $chif[$cent_c] . ' Cents';
    if (($cent[3] == 0 || $cent[3] == '') && ($dix[3] == 0 || $dix[3] == '') && ($unite[3] == 1))
        $v = $v . ' ' . $trio[3] . '  ' . $secon[3] . ' ' . $prim[3] . ' Million ';
    else if (($cent[3] != 0 && $cent[3] != '') || ($dix[3] != 0 && $dix[3] != '') || ($unite[3] != 0 && $unite[3] != ''))
        $$v = $v . ' ' . $trio[3] . ' ' . $secon[3] . ' ' . $prim[3] . ' Millions ';
    else
        $v = $v . ' ' . $trio[3] . ' ' . $secon[3] . ' ' . $prim[3];
    if (($cent[2] == 0 || $cent[2] == '') && ($dix[2] == 0 || $dix[2] == '') && ($unite[2] == 1))
        $v = $v . ' ' . ' Mille ';
    else if (($cent[2] != 0 && $cent[2] != '') || ($dix[2] != 0 && $dix[2] != '') || ($unite[2] != 0 && $unite[2] != ''))
        $v = $v . ' ' . $trio[2] . ' ' . $secon[2] . ' ' . $prim[2] . ' Milles ';
    else
        $v = $v . ' ' . $trio[2] . ' ' . $secon[2] . ' ' . $prim[2];
    $v = $v . $trio[1] . ' ' . $secon[1] . ' ' . $prim[1];
    $v = $v . ' ' . $dev1 . ' ';
    if (($cent_c == '0' || $cent_c == '') && ($dix_c == '0' || $dix_c == ''))
        $v = $v . ' ' . ' et z&eacute;ro ' . $dev2;
    else
        $v = $v . ' et ' . round($valeur_decimal, 0) . ' ' . $dev2;
    return $v;
}
?>
<br>
<style>
    body {
        font-size: 12px;
    }

    table {
        font-size: 12px;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<div style="display:flex;margin-top:-18px">
    <div style="margin-left:1%">
        <?php //echo $commande->totalttc;
        echo $this->Html->image('mm.png', ['alt' => 'CakePHP', 'height' => '70px', 'width' => '110px']); ?>
    </div>
    <div style="width: 40%;margin-left:2% ;text-align:center" align="center">
        مصر�? تصنيع وتوزيع
        <br>
        مواد التنظي�?
        <br><br>
        Comptoir de Diffusion et de Fabrication
        <br>
        de Produits d'entretien SARL
    </div>
    <div style="width: 50%;margin-left:8%" align="left">
        <h5>
            <b>Siége Social:</b>3 Rue Mustapha Sfar Tunis Bélvédére 1002 <br>
            <b>Usine:</b>Rte Fouchana Chebedda Naassen 1135 Tunisie <br>
            <b>Tel:</b>+216 71 398 404/<b>Fax:</b>+216 71 398 137<br>
            <b>E-mail:</b>codifa@gnet.tn/<b>WEB:</b> www.codifa.tn <br>
            <b>R.C:</b>B0128802005/<b>M.F:</b>02940/X/A/M/000<br>
            <b>CCB:</b>01100028110500554697 ATB Rue du Plastique-Mégrine
        </h5>
    </div>
</div>
<div style="display:flex;margin-bottom:3px;" align="center">
    <div style="display:flex;width: 1000%;">
        <div style="width: 10000%;border:1px solid black;border-radius: 15px;background-color:#e6ebe3;" align="left">
            <br>
            <b style="margin-left:7% ;"> Code: </b><?= h($commande->client->Code) ?> <br>
            <b style="margin-left:7% ;"> Matricule fiscale :</b><?= h($commande->client->Matricule_Fiscale) ?> <br>
            <b style="margin-left:7% ;"> Client : </b> <?php
                                                        if (isset($commande->client)) {
                                                            echo  h($commande->client->Raison_Sociale);
                                                        } ?><br>
            <b style="margin-left:7% ;"> Adresse :</b><?= h($commande->client->Adresse) ?> <br>
            <!-- <b style="margin-left:7% ;"> Remise : </b><?= h($commande->remise) ?> <br> -->
        </div>
    </div>
    <div style="display:flex ;width:1000%;margin-left:10%;">
        <div style="width: 10000%;border:1px solid black;border-radius: 15px;background-color:#e6ebe3;" align="left">
            <br>
            <b style="margin-left:7% ;"> Facture proformat N° : </b><?= h($commande->numero) ?> <br>
            <b style="margin-left:7% ;"> Date : </b><?= $this->Time->format(
                                                        $commande->date,
                                                        'dd/MM/y'
                                                    ); ?> <br>
            <!-- <b style="margin-left:7% ;"> Paiement comptant : </b><?= h($commande->payementcomptant) ?> <br> -->
            <b style="margin-left:7% ;"> Commercial : </b><?php
                                                            if (isset($commande->commercial_id)) {
                                                                echo  h($commande->commercial->name);
                                                            } ?> <br>
            <!-- <b style="margin-left:7% ;"> Telephone : </b><?= h($commande->client->Tel) ?> <br>
            <b style="margin-left:7% ;"> Observation :</b><?= h($commande->observation) ?> <br> -->
        </div>
    </div>
</div>

<div>
    <div class="panel-body">
        <div>
            <table style="border:1px solid black;width: 100%;border-radius: 15px 15px 15px 15px;border-collapse: collapse;" height="630x">
                <thead>
                    <tr>
                        <td align="center" style="width: 10%;border:1px solid black;background-color:#b5d6d3;"><strong>CODE</strong></td>
                        <td align="center" style="width: 8%;border:1px solid black;background-color:#b5d6d3;"><strong>QTE</strong></td>
                        <td align="center" style="width: 30%;border:1px solid black;background-color:#b5d6d3;"><strong>DESIGNATION</strong></td>
                        <td align="center" style="width: 10%;border:1px solid black;background-color:#b5d6d3;"><strong>P.U.H.T</strong></td>
                        <td align="center" style="width: 8%;border:1px solid black;background-color:#b5d6d3;"><strong>TVA</strong></td>
                        <td align="center" style="width: 8%;border:1px solid black;background-color:#b5d6d3;"><strong>TPE</strong></td>
                        <td align="center" style="width: 8%;border:1px solid black;background-color:#b5d6d3;"><strong>REM</strong></td>
                        <td align="center" style="width: 18%;border:1px solid black;background-color:#b5d6d3;"><strong>Montant HT </strong></td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lignecommandes as $lignecommande) :   ?>
                        <tr class="tr">
                            <td align="center" style="border:1px solid black;vertical-align:top;height:2% !important;">
                                <?= ($lignecommande->article->Code) ?>
                            </td>
                            <td align="center" style="border:1px solid black;vertical-align:top;">
                                <?= $this->Number->format($lignecommande->qte) ?>
                            </td>
                            <td align="center" style="border:1px solid black;vertical-align:top;"><?php
                                                                                                    if (isset($lignecommande->article)) {
                                                                                                        echo  h($lignecommande->article->Dsignation);
                                                                                                    }
                                                                                                    ?></td>
                            <td align="right" style="border:1px solid black;vertical-align:top;text-align:right">
                                <?= $this->Number->format($lignecommande->prix) ?>
                            </td>
                            <td align="center" style="border:1px solid black;vertical-align:top;">
                                <?= $this->Number->format($lignecommande->tva) ?> %
                            </td>
                            <td align="center" style="border:1px solid black;vertical-align:top;">
                                <?= $this->Number->format($lignecommande->tpe) ?>
                            </td>
                            <td align="center" style="border:1px solid black;vertical-align:top;">
                                <?= $this->Number->format($lignecommande->article->remise) ?>
                            </td>
                            <td align="right" style="border:1px solid black;vertical-align:top;text-align:right">
                                <?= $this->Number->format($lignecommande->montantht) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td style="border:1px solid black;vertical-align:top;"></td>
                        <td style="border:1px solid black;vertical-align:top;"></td>
                        <td style="border:1px solid black;vertical-align:top;"></td>
                        <td style="border:1px solid black;vertical-align:top;"></td>
                        <td style="border:1px solid black;vertical-align:top;"></td>
                        <td style="border:1px solid black;vertical-align:top;"></td>
                        <td style="border:1px solid black;vertical-align:top;"></td>
                        <td style="border:1px solid black;vertical-align:top;"></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <div style="display:flex" align="center">
                <div style="width: 58%;margin-right:10px;" align="left">
                    <table style="width: 100%;border-collapse: collapse;border-radius: 15px;">
                        <thead>
                            <tr>
                                <th align="center" style="width: 55%;border:1px solid black;background-color:#b5d6d3;"><strong>CACHET & SIGNATURE DU CLIENT</strong></th>
                                <th align="center" style="width: 15%;border:1px solid black;background-color:#b5d6d3;"><strong>TX.TVA </strong></th>
                                <th align="center" style="width: 15%;border:1px solid black;background-color:#b5d6d3;"><strong>BASE</strong></th>
                                <th align="center" style="width: 15%;border:1px solid black;background-color:#b5d6d3;"><strong>MONTANT</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="tr">
                                <td align="center" height="60px" style="border:1px solid black;">

                                </td>
                                <td align="center" style="border:1px solid black;">
                                    <?= $this->Number->format($lignecommande->tva) ?>
                                </td>
                                <td align="center" style="border:1px solid black;">
                                </td>
                                <td align="center" style="border:1px solid black;width: 20%;">
                                    <?= $this->Number->format($commande->tva + $commande->tpe) ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div style="width: 40%;border:1px solid black;" align="left">

                    <br>
                    <b style="margin-left:7% ;"> Total Hors Taxes: </b><?= $this->Number->format($commande->total) ?> <br>
                    <b style="margin-left:7% ;"> Total Remise: </b><?= $this->Number->format($commande->remise) ?> <br>
                    <b style="margin-left:7% ;"> Total Fodec: </b><?= $this->Number->format($commande->fodec) ?> <br>
                    <b style="margin-left:7% ;"> Total TVA:</b><?= $this->Number->format($commande->tva) ?> <br>
                    <b style="margin-left:7% ;"> Total TPE:</b><?= $this->Number->format($commande->tpe) ?> <br>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div style="display:flex">
        <div style="width:3%;border:1px solid black;border-radius: 15px;height:110px;background-color:#b5d6d3;">

        </div>
        <div style="width: 40%;">
            <strong>Arrêté la Présente Bon de Commande à la Somme de :</strong><br>
            <?php echo chifre_en_lettre($commande->totalttc, 1, 1) ?>
        </div>
        <div style="width: 40%;border:1px solid black;border-radius: 15px;margin-left:10%;height:30px;background-color:#b5d6d3;">
            <br>
            <b style="margin-left:10% ;">NET A PAYER:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?= $this->Number->format($commande->totalttc) ?></b>
        </div>
    </div>
    <br>
    <div style="width: 100%;border:1px solid black;border-radius: 15px;height:40px;">
        <br>

    </div>
</div>
</div>