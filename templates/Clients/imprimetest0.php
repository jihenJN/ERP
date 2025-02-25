<?php

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

?>


<?php
$connection = ConnectionManager::get('default');
?>
<?php $this->layout = 'AdminLTE.print'; ?>
<?php
function int2str($a)
{
    $joakim = explode('.', $a);

    if (isset($joakim[1]) && $joakim[1] != '') {
        if (($joakim[1] != '000')) {
            if ($joakim[0] == '0') {
                return 'zero Dinars et ' . ($joakim[1]) . ' Millimes';
            }
            return int2str($joakim[0]) . ' Dinars et ' . ($joakim[1]) . ' Millimes';
        } else {
            return int2str($joakim[0]) . ' Dinars et 0 Millimes';
        }
    }


    if ($a == 0)
        return '';
    if ($a < 0)
        return 'moins ' . int2str(-$a);
    if ($a < 17) {
        switch ($a) {
            case 0:
                return 'zero';
            case 1:
                return 'un';
            case 2:
                return 'deux';
            case 3:
                return 'trois';
            case 4:
                return 'quatre';
            case 5:
                return 'cinq';
            case 6:
                return 'six';
            case 7:
                return 'sept';
            case 8:
                return 'huit';
            case 9:
                return 'neuf';
            case 10:
                return 'dix';
            case 11:
                return 'onze';
            case 12:
                return 'douze';
            case 13:
                return 'treize';
            case 14:
                return 'quatorze';
            case 15:
                return 'quinze';
            case 16:
                return 'seize';
        }
    } else if ($a < 20) {
        return 'dix-' . int2str($a - 10);
    } else if ($a < 100) {
        if ($a % 10 == 0) {
            switch ($a) {
                case 20:
                    return 'vingt';
                case 30:
                    return 'trente';
                case 40:
                    return 'quarante';
                case 50:
                    return 'cinquante';
                case 60:
                    return 'soixante';
                case 70:
                    return 'soixante-dix';
                case 80:
                    return 'quatre-vingt';
                case 90:
                    return 'quatre-vingt-dix';
            }
        } elseif (substr($a, -1) == 1) {
            if (((int) ($a / 10) * 10) < 70) {
                return int2str((int) ($a / 10) * 10) . '-et-un';
            } elseif ($a == 71) {
                return 'soixante-et-onze';
            } elseif ($a == 81) {
                return 'quatre-vingt-un';
            } elseif ($a == 91) {
                return 'quatre-vingt-onze';
            }
        } elseif ($a < 70) {
            return int2str($a - $a % 10) . '-' . int2str($a % 10);
        } elseif ($a < 80) {
            return int2str(60) . '-' . int2str($a % 20);
        } else {
            return int2str(80) . '-' . int2str($a % 20);
        }
    } else if ($a == 100) {
        return 'cent';
    } else if ($a < 200) {
        return int2str(100) . ' ' . int2str($a % 100);
    } else if ($a < 1000) {
        return int2str((int) ($a / 100)) . ' ' . int2str(100) . ' ' . int2str($a % 100);
    } else if ($a == 1000) {
        return 'mille';
    } else if ($a < 2000) {
        return int2str(1000) . ' ' . int2str($a % 1000) . ' ';
    } else if ($a < 1000000) {
        return int2str((int) ($a / 1000)) . ' ' . int2str(1000) . ' ' . int2str($a % 1000);
    }
}
?>


<style>
    body {
        font-size: 12px;
    }

    table {
        font-size: 14px;
    }


  
    .print-container {
        /* background-size: cover;
        background-position: center; */
        height: 1058px;
        width: 812px;
    }

    .page-break {
        page-break-before: always;
    }

    @media print {

        /* Masquer l'en-tête et le pied de page sur chaque page */
        .content {
            display: block !important;
            /* Afficher normalement */
            page-break-inside: avoid;
            /* Éviter les sauts de page à l'intérieur du contenu */
        }

        .page-break {
            page-break-before: always;
            /* Forcer un saut de page avant chaque section */
        }

        /* .table-container {
        max-height: 500px; 
        overflow-y: auto; 
         }*/
    }
</style>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>

<?php

// $lignebonlivraisonsArray = $lignebonlivraisons->toArray();

$maxLinesPerPage = 23;
// $totalLines = count($lignebonlivraisonsArray);
// var_dump($totalLines);
//debug($tabligne);die;
$totalLines = 100;
$totalLines = count($tabligne);
//echo $totalLines;

$totalPages = ceil($totalLines / $maxLinesPerPage);
// var_dump($totalLines);
$societe = $connection->execute('SELECT * FROM societes where societes.id=1;')->fetchAll('assoc');

$statement = $connection->prepare("SELECT SUM(totalttc) as ttc FROM bonlivraisons WHERE bonlivraisons.factureclient_id = 0 AND bonlivraisons.typebl = 1 AND bonlivraisons.client_id = ? ");
$statement->bindValue(1, $client['id']);
$statement->execute();
$test1 = $statement->fetchAll('assoc');
$encours = $test1 ? $test1['0']['ttc'] : 0;
//echo $totalPages;
?>

<?php



for ($page = 0; $page < $totalPages; $page++): ?>
    <div class="print-container" style="width: 100%;">

        <section class="content"
            style="font-family: 'Times New Roman', Times, serif;<?php echo $page > 0 ? ' page-break' : ''; ?>">
            <table cellpadding="0" cellspacing="0"
                style=" border: 0px solid #002E50; border-left:none; border-right:none; border-collapse: collapse; width: 100%;">
                <tbody>
                    <tr>
                        <td align="start" style="width: 38%;border: none;">
                            <b style="font-size: 17px!important; display: block; margin-bottom: 0.5em;">
                                <?php echo $societe[0]['nom']; ?>
                            </b>
                            <b
                                style="font-size: 13px!important; font-weight: normal; display: block; margin-bottom: 0.5em;">
                                <?php echo 'RTE MAHDIA KM 10 3011 SFAX'; ?>
                            </b>
                        </td>
                        <td align="end" style="width: 38%;border: none;">
                            <b style="font-size: 17px!important; display: block; margin-bottom: 0.5em;">
                                <?php echo ' '; ?>
                            </b>
                            <br>
                            <b
                                style="font-size: 13px!important; font-weight: normal; display: block; margin-bottom: 0.5em;">
                                <?php echo '23/09/2024 10:22'; ?>
                            </b>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div style="display:flex;">
                <table cellpadding="0" cellspacing="0"
                    style="border: 0px solid #002E50; border-left:none; border-right:none; border-collapse: collapse; width: 100%;">
                    <tbody>
                        <tr>
                            <td align="center" style="width: 38%;border: none;"></td>
                            <td align="center" style="width: 27%;border: none;height:4% !important;">
                                <b style="font-size: 17px!important; display: block; margin-bottom: 0.5em;">
                                    <?php echo 'Fiche Client'; ?>
                                </b>

                            </td>
                            <td align="left" style="width: 35%;border: none;font-size: 15px;height:4% !important;">

                            </td>

                        </tr>
                    </tbody>
                </table>


            </div>
            <div style="display:flex;">
                <table cellpadding="0" cellspacing="0"
                    style="border: 0px solid #002E50; border-left:none; border-right:none; border-collapse: collapse; width: 100%;">
                    <tbody>
                        <tr>
                            <td align="start" style="width: 50%;border: none;">
                                <b style="display: flex;">
                                    <span style="font-size: 15px!important; display: block; margin-bottom: 0.5em;">
                                        <?php echo ' Client : '; ?> </span>&nbsp;&nbsp;&nbsp; <span
                                        style="    margin-top: 0.5%;font-size: 13px!important; font-weight: normal; display: block; margin-bottom: 0.5em;"><?php echo $client->Code ?>&nbsp;
                                        &nbsp;&nbsp;<?php echo $client->Raison_Sociale; ?></span>
                                </b>

                            </td>
                            <td align="center" style="width: 20%;border: none;height:4% !important;">

                            </td>
                            <td align="end" style="width: 30%;border: none;font-size: 15px;height:4% !important;">
                                <b style="display: flex;    justify-content: space-between;">
                                    <span style="font-size: 14px!important; display: block; margin-bottom: 0.5em;">
                                        <?php echo ' Encours : '; ?> </span>&nbsp;&nbsp;&nbsp; <span
                                        style="    margin-top: 0.5%;font-size: 13px!important; font-weight: normal; display: block; margin-bottom: 0.5em;">&nbsp;
                                        &nbsp;&nbsp;<?php echo sprintf("%01.3f", abs($encours)); ?></span>
                                </b>
                                <b style="display: flex;    justify-content: space-between;">
                                    <span style="font-size: 14px!important; display: block; margin-bottom: 0.5em;">
                                        <?php echo ' Solde : '; ?> </span>&nbsp;&nbsp;&nbsp; <span
                                        style="    margin-top: 0.5%;font-size: 13px!important; font-weight: normal; display: block; margin-bottom: 0.5em;">&nbsp;
                                        &nbsp;&nbsp;<?php echo sprintf("%01.3f", abs($soldef)); ?></span>
                                </b>
                                <b style="display: flex;    justify-content: space-between;">
                                    <span style="font-size: 14px!important; display: block; margin-bottom: 0.5em;">
                                        <?php echo ' Total : '; ?> </span>&nbsp;&nbsp;&nbsp; <span
                                        style="    margin-top: 0.5%;font-size: 13px!important; font-weight: normal; display: block; margin-bottom: 0.5em;">&nbsp;
                                        &nbsp;&nbsp;<?php //echo $client->Raison_Sociale; ?></span>
                                </b>
                                <b style="display: flex;    justify-content: space-between;">
                                    <span style="font-size: 14px!important; display: block; margin-bottom: 0.5em;">
                                        <?php echo ' Echéancier : '; ?> </span>&nbsp;&nbsp;&nbsp; <span
                                        style="    margin-top: 0.5%;font-size: 13px!important; font-weight: normal; display: block; margin-bottom: 0.5em;">&nbsp;
                                        &nbsp;&nbsp;<?php //echo $client->Raison_Sociale; ?></span>
                                </b>
                            </td>
                        </tr>
                    </tbody>
                </table>


            </div>
            <div>
                <table border="0" style="border-width: 0px;  width: 100%; border-collapse: collapse;">


                    <tbody>
                        <td style="width: 30%;">
                            <b style="display: flex;    justify-content:  flex-start;">
                                <span style="font-size: 14px!important; display: block; margin-bottom: 0.5em;">
                                    <?php echo ' Date Du : '; ?> </span>&nbsp;&nbsp;&nbsp; <span
                                    style="    margin-top: 0.5%;font-size: 13px!important; font-weight: normal; display: block; margin-bottom: 0.5em;">&nbsp;
                                    &nbsp;&nbsp;<?php echo $date1; ?></span>
                            </b>
                        </td>

                        <td style="width: 30%;">
                            <b style="display: flex;    justify-content:  flex-start;">
                                <span style="font-size: 14px!important; display: block; margin-bottom: 0.5em;">
                                    <?php echo ' Au : '; ?> </span>&nbsp;&nbsp;&nbsp; <span
                                    style="    margin-top: 0.5%;font-size: 13px!important; font-weight: normal; display: block; margin-bottom: 0.5em;">&nbsp;
                                    &nbsp;&nbsp;<?php echo $date2; ?></span>
                            </b>
                        </td>
                        <td style="width: 40%;">
                            <b style="display: flex;    justify-content:  flex-start;">
                                <span style="font-size: 14px!important; display: block; margin-bottom: 0.5em;">
                                    <?php echo ' Tel : '; ?> </span>&nbsp;&nbsp;&nbsp; <span
                                    style="    margin-top: 0.5%;font-size: 13px!important; font-weight: normal; display: block; margin-bottom: 0.5em;">&nbsp;
                                    &nbsp;&nbsp;<?php echo $societe[0]['tel']; ?></span>
                            </b>
                        </td>
                    </tbody>
                </table>
            </div>
            <div style="margin-top: ;">
                <table border="0" style="border-width: 0px;  width: 100%; border-collapse: collapse;">
                    <thead>
                        <td align="center" style="border: 1px solid #000407;width: 12%; ">Date</td>
                        <td align="center" style="border: 1px solid #000407;width: 10%;">Numéro Mvt</td>
                        <td align="center" style="border: 1px solid #000407;width: 35%;">Libellé</td>
                        <td align="center" style="border: 1px solid #000407;width: 13%;">Debit</td>
                        <td align="center" style="border: 1px solid #000407;width: 15%;">Crédit</td>
                        <td align="center" style="border: 1px solid #000407;width: 15%;">Solde</td>
                    </thead>

                    <tbody>
                        <?php
                        $start = $page * $maxLinesPerPage;
                        //  var_dump($page);
                        $end = min(($page + 1) * $maxLinesPerPage, $totalLines);
                        //  var_dump($end);
                        $pp = 0;
                        // echo $totalLines;
                        debug($tabligne);
                        usort($tabligne, function ($a, $b) {
                            return strcmp($a['date'], $b['date']);
                        });
                        $solde = 0;
                        $totcredit = 0;
                        $totdebit = 0;
                        for ($i = $start; $i < $end; $i++):
                            $pp++;
                            $lignetab = $tabligne[$i];
                            ///  debug( $lignecommande);
                            //var_dump($lignetab) ;
                            $totcredit += (float) $lignetab['credit'];
                            $totdebit += (float) $lignetab['debit'];
                            $solde += (float) $lignetab['debit'];
                            $solde -= (float) $lignetab['credit'];
                            ?>
                            <tr height="25px" style="font-size: 15px!important;">

                                <td align="center"
                                    style="vertical-align:top; border-left: 1px solid #000407;border-right: 1px solid #000407;">
                                    <b style="text-align: left;font-weight: normal;margin-left: 1% !important;">
                                        <?php
                                        echo $lignetab['date'];//->format("Y-m-d");
                                
                                        ?>
                                    </b>
                                </td>

                                <td align="center" style="vertical-align:top;border-right: 1px solid #000407;">
                                    <b style="font-weight: normal;">
                                        <?php

                                        echo $lignetab['numero']; ?>
                                    </b>
                                </td>
                                <td align="start" style=" vertical-align:top;border-right: 1px solid #000407;">
                                    <b style="font-weight: normal;">
                                        <?php echo $lignetab['type']; ?>
                                    </b>
                                </td>


                                <td align="end" style=" vertical-align:top;border-right: 1px solid #000407;">
                                    <b style="font-weight: normal;">
                                        <?php
                                        // $this->Number->format($lignecommande->punht) 
                                        echo number_format(abs((float) $lignetab['debit']), 3, ',', ' '); ?>
                                    </b>
                                </td>


                                <td align="end" style="vertical-align:top;border-right: 1px solid #000407;">
                                    <b style="font-weight: normal;">
                                        <?php
                                        echo number_format(abs((float) $lignetab['credit']), 3, ',', ' '); ?>

                                    </b>
                                </td>

                                <td align="end" style="vertical-align:top;border-right: 1px solid #000407;">
                                    <b style="font-weight: normal;">
                                        <?php // $this->Number->format($montant)  
                                                echo number_format((float) abs($solde), 3, ',', ' '); ?></b>
                                </td>

                            </tr>

                            <?php
                        endfor;
                        ?>
                        <tr>
                            <td colspan="6"
                                style="border-bottom: 1px solid #000407;border-left: 1px solid #000407;border-right: 1px solid #000407;">
                            </td>
                        </tr>
                        <tr style="    height: 40px;">
                            <td colspan="3" align="end">
                                <b style="font-weight: normal;">
                                    <strong> Total :</strong>
                                </b>
                            </td>
                            <td align="end"><b style="font-weight: normal;">
                                    <strong>
                                        <?php
                                        // $this->Number->format($lignecommande->punht) 
                                        echo number_format(abs((float) $totdebit), 3, ',', ' '); ?>
                                    </strong>
                                </b></td>
                            <td align="end"><b style="font-weight: normal;">
                                    <strong>
                                        <?php
                                        // $this->Number->format($lignecommande->punht) 
                                        echo number_format(abs((float) $totcredit), 3, ',', ' '); ?>
                                    </strong>
                                </b></td>
                            <td align="end"><b style="font-weight: normal;">
                                    <strong>
                                        <?php
                                        // $this->Number->format($lignecommande->punht) 
                                        echo number_format(abs((float) $solde), 3, ',', ' '); ?>
                                    </strong>
                                </b></td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <?php     //var_dump($page);
                //  echo $page .'=='. ($totalPages - 1) ;
                if ($page == ($totalPages - 1)) {

                    ?>
                <!-- <div style="display:flex; margin-left:8%;    margin-top: -45px;">

                    <table border="0"
                        style="width: 33%; border-collapse: collapse; border-radius: 15px; margin-top: 4%; margin-left:175px !important;">
                        <thead>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: left; width: 10%; vertical-align: top;">
                                    <br>
                                    <b style="width: 30px;margin-left:-20!important"><?php echo 'Total HT:'; ?><br></b>
                                    <b style=" width: 20px;margin-left:-20!important"><?php echo 'Rem Mt:'; ?><br></b>
                                    <b style="width: 30px;margin-left:-2!important"><?php echo 'Total TVA:'; ?><br></b>
                                    <b
                                        style="width: 30px;margin-left:-20!important;white-space:nowrap !important;"><?php echo 'Timbre:'; ?><br></b>
                                    <b style="width: 30px;margin-left:-20!important"><?php //echo 'Total TTC:'; ?><br></b>
                                    <b><br></b>
                                </td>
                                <td style="text-align: left; width: 20%; vertical-align: top;">
                                    <br>
                                    <b style="display: inline-block; width: 130px; text-align: right;">
                                        <?php echo number_format(abs($bonlivraison->totalht), 2, ',', ' '); ?><br>
                                    </b>
                                    <b style="display: inline-block; width: 130px; text-align: right;">
                                        <?php echo number_format(abs($bonlivraison->totalremise), 2, ',', ' '); ?><br>
                                    </b>

                                    <b style="display: inline-block; width: 130px; text-align: right;">
                                        <?php if (!empty($bonlivraison->totaltva))
                                            echo number_format(abs($bonlivraison->totaltva), 2, ',', ' ');
                                        else
                                            echo "0.000" ?><br>
                                        </b>
                                        <b style="display: inline-block; width: 130px; text-align: right;">
                                        <?php echo $timbre; ?><br>
                                    </b>
                                    <b
                                        style="font-size: 15px!important; margin-top: -7px!important; font-weight: bold; display: inline-block; width: 130px; text-align: right;">
                                        <br> <?php echo number_format(abs($bonlivraison->totalttc + $timbre), 3, ',', ' '); ?>
                                    </b>
                                </td>

                            </tr>
                        </tbody>
                    </table>



                </div> -->
                <!-- <table style="width: 65%;border-collapse: collapse;border-radius: 15px;margin-top:-5%;margin-left:-5%;">
                    <thead>
                    </thead>
                    <tbody>
                        <?php
                        ?>
                        <tr class="tr">
                            <td align="center" height="20px">
                                <?php ///echo  'Arrêté  le présent BL  à la somme de :'; 
                                        ?>
                            </td>
                        </tr>
                        <tr class="tr">

                            <td align="center" height="20px">
                                <b style="font-weight: normal;margin-top:5% !important;font-size: 18px;!important">
                                    <?php echo int2str($bonlivraison->totalttc + $timbre, 1, 1) ?></b>
                            </td>

                        </tr>
                        <?php
                        ?>

                    </tbody>
                </table> -->
            <?php }
                ?>

        </section>

    </div>
<?php endfor; ?>