<?php $this->layout = 'AdminLTE.print'; ?>
<?php


function chifre_en_lettre($montant, $devise1, $devise2)
{
    if (($devise1 == 1))
        $dev1 = 'Dinars';
    if (($devise1 == 2))
        $dev1 = 'Dollars';
    if (($devise1 == 3))
        $dev1 = 'Euro';
    if (($devise1 == 1))
        $dev2 = 'Millimes';
    if (($devise1 == 2))
        $dev2 = 'Cents';
    if (($devise1 == 3))
        $dev2 = 'Centimes';
    $valeur_entiere = intval($montant);
    $valeur_decimal = (($montant - intval($montant)) * 1000);
    $dix_c = ($valeur_decimal % 100 / 10);
    $cent_c = intval($valeur_decimal % 1000 / 100);
    $unite_c = $valeur_decimal % 10;
    $unite[1] = $valeur_entiere % 10;
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
        if ($cent[$i] == 1)
            $trio[$i] = 'Cent';
        else if ($cent[$i] != 0 || $cent[$i] != '')
            $trio[$i] = $chif[$cent[$i]] . ' Cents';
    }
    $v = "";

    $chif2 = array('', 'Dix', 'Vingt', 'Trente', 'Quarante', 'Cinquante', 'Soixante', 'Soixante-dix', 'Quatre-vingts', 'Quatre-vingt-dix');
    $secon_c = $chif2[$dix_c];
    if ($cent_c == 1)
        $trio_c = 'Cent';
    else if ($cent_c != 0 || $cent_c != '')
        $trio_c = $chif[$cent_c] . ' Cents';

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

<?php

use Cake\Datasource\ConnectionManager;
?>
<br><br><br><br><br>
<div style="display:flex;margin-bottom:3px;margin-left:25px;" align="center">
    <div style="display:flex ;width:90%;margin-right:2%;" align="right">
        <div style="width: 90%;border:0px solid black;border-radius: 15px;" align="left">
            <br>

            <b style="margin-left:7%;"> REPUBLIQUE TUNISIENNE <br>
                MINISTERE DU PLAN ET DES FINANCES <br> DIRECTION GENERALE DU CONTRÔLE FISCALE
            </b>

            <br>
            <?php

            // $paiement_id = $bonlivraison->client->paiement_id;
            // if (!empty($paiement_id)) {

            //     $connection = ConnectionManager::get('default');
            //     $paiementname = $connection->execute("SELECT name FROM paiements WHERE id = " . $paiement_id . ";")->fetchAll('assoc');
            // }


            ?>


        </div>
    </div>
    <div style="display:flex;width: 90%;">
        <div style="width: 90%;border:0px solid black;border-radius: 15px;" align="left">
            <br>
            <br>

            <b style="margin-right:7%;"> CERTIFICAT DE RETENUE D'IMPOT SUR LE REVENU OU D'IMPOT SUR LES SOCIETES</b>
        </div>
    </div>
</div>
<br><br>
<div style="display: flex; justify-content: flex-end;">
    <div style="width: 70%; margin-right: 20px; display: flex; align-items: center;">

        <div style="width: 50%; text-align: center; margin-top: 10px;">
            <div>
                <?php setlocale(LC_TIME, 'fr_FR.utf8'); // Set the locale to French

                $date = new DateTime();
                $formattedDate = strftime('%d %B %Y', $date->getTimestamp());

                echo '<div>Retenue effectuée le : ' . $formattedDate . '</div>'; ?>
            </div>
        </div>

        <div style="margin-left: 20px; margin-top: 10px; width: 20%;">
            <div> <?php  // Set your desired start year
                    $endYear = date('Y'); // Get the current year as the end year

                    echo '<div>Exercice: ';

                    echo $endYear . ' ';

                    echo '</div>';
                    ?> </div>
        </div>

    </div>
</div>
<br>
<div style="display: flex; justify-content: flex-end;">
    <div style="width: 95%; margin-right: 20px; display: flex; align-items: center;">

        <div style="width: 40%; text-align: center; margin-top: 10px;">
            <div>
                <p>A-PERSONNE OU ORGANISME PAYEUR</p>
            </div>
        </div>
        <br>

        <div style="margin-left: 10px; margin-top: 10px; width: 55%;">
            <div>
                <table border="1">
                    <thead>
                        <tr>
                            <!--                        <td align="center" style="width: 11%;"><strong>Code</strong></td>-->
                            <td align="center" style="width: 20%;"><strong>Matricule fiscal</strong></td>
                            <td align="center" style="width: 10%;"><strong>Code TVA</strong></td>
                            <td align="center" style="width: 20%;"><strong>Code Catég.</strong></td>
                            <td align="center" style="width: 9%;"><strong>N° établ.</strong></td>

                        </tr>
                    </thead>
                    <tbody>
                        <tr class="tr">
                            <?php
                            $codetva = $societes->codetva;
                            $parts = explode('/', $codetva);

                
                            $combinedPart = $parts[0] . $parts[1]; // "0002940X"

                            // Access the other parts
                            $part3 = $parts[2]; // "A"
                            $part4 = $parts[3]; // "M"
                            $part5 = $parts[4]; // "000"

                           
                            // echo "Combined Part (Part 1 and 2): $combinedPart<br>";
                            // echo "Part 3: $part3<br>";
                            // echo "Part 4: $part4<br>";
                            // echo "Part 5: $part5<br>";
                            ?>
                            <td style="width: 6%;vertical-align:top" align="center"><?php echo  $combinedPart ; ?></td>
                            <td style="width: 6%;vertical-align:top" align="center"><?php echo $part3; ?></td>
                            <td style="width: 6%;vertical-align:top" align="center"> <?php echo $part4; ?></td>
                            <td style="width: 6%;vertical-align:top" align="center"><?php echo $part5; ?></td>
                        </tr>
                    </tbody>
                </table>


            </div>
        </div>

    </div>
</div>
<br><br><br>
<div style="display: flex; justify-content: flex-end;">
    <div style="width: 95%;  display: flex; align-items: center;">

        <!-- <div style="width: 40%; text-align: center; margin-top: 10px;">
            <div>
                <p>A-PERSONNE OU ORGANISME PAYEUR</p>
            </div>
        </div>
        <br>

        <div style="margin-left: 10px; margin-top: 10px; width: 55%;"> -->
        <div>
            <table border="1">
                <thead>
                    <tr>
                        <!--                        <td align="center" style="width: 11%;"><strong>Code</strong></td>-->
                        <td align="center" style="width: 40%;"><strong>B- RETENUES EFFECTUEES SUR :</strong></td>
                        <td align="center" style="width: 10%;">Montant brut</td>
                        <td align="center" style="width: 10%;">Retenue</td>
                        <td align="center" style="width: 9%;">Montant net</td>

                    </tr>
                </thead>
                <tbody>
                    <tr class="tr">

                        <td style="width: 40%;vertical-align:top">
                            - Marchés<br>
                            - Honoraire, commissions, courtages, vacations et loyers <br>
                            - Honoraires régime réel<br>
                            - Redevances <br>
                            - Revenue des comptes spéciaux d'épargne ouverts auprès des banques <br>
                            - Revenue des capitaux mobiliers<br>
                            - Revenus des bons de caisse au porteur</td>

                        <td style="width: 6%;vertical-align:top" align="center"><?php echo $pieces->montant_brut; ?></td>
                        <td style="width: 6%;vertical-align:top" align="center"><?php echo $pieces->montant_net; ?></td>
                        <td style="width: 6%;vertical-align:top" align="center"><?php echo $pieces->montant; ?></td>
                    </tr>
                    <tr class="tr">

                        <td style="width: 40%;vertical-align:top" align="center">
                            <strong>Total Général</strong>
                        </td>

                        <td style="width: 6%;vertical-align:top" align="center"><?php echo $pieces->montant_brut; ?></td>
                        <td style="width: 6%;vertical-align:top" align="center"><?php echo $pieces->montant_net; ?></td>
                        <td style="width: 6%;vertical-align:top" align="center"><?php echo $pieces->montant; ?></td>
                    </tr>
                </tbody>
            </table>


        </div>
        <!-- </div> -->

    </div>
</div>


<br>
<div style="display:flex">
    <!-- <div style="width:3%;border:0px solid black;border-radius: 15px;height:110px">

    </div>
    <br> <br> -->
    <div style="width: 95%;height:110px" align="left">
        N° de la carte d'identité :<br>
        ou de passeport :<br>
        ou de carte séjour pour les étrangers :
        <br><br><br>
        Nom, prénom ou raison sociale : <br>
        Adresse professionnelle :<br>
        Adresse de résidence :

    </div>


</div>


<br>
<br>
<br>
<div style="display:flex">
    <!-- <div style="width:3%;border:0px solid black;border-radius: 15px;height:110px">

    </div>
    <br> <br> -->
    <div style="width: 95%;height:110px">
        Je soussigné, certifie exact les renseignements figurant sur le présent certificat et m'éxpose aux sanctions prévues par la loi pour toute inexactitude.<br>

    </div>


</div>
<br>
<div style="display:flex">
    <!-- <div style="width:3%;border:0px solid black;border-radius: 15px;height:110px">

    </div>
    <br> <br> -->
    <div style="width: 95%;height:110px" align="center">
        <?php date('d/m/y'); ?> <br>
        cachet et signature<br>

    </div>


</div>