<?php $this->layout = 'AdminLTE.print'; ?>
<?php


use Cake\ORM\TableRegistry;

?>


<?php

$societeTable = TableRegistry::getTableLocator()->get('Societes');

$societe = $societeTable->find()->where('id=1')->first();

use Cake\Core\Configure;
use Cake\I18n\FrozenTime;
use Cake\Datasource\ConnectionManager;

?>

<?php
$connection = ConnectionManager::get('default');
?>
<?php
function int2str($a)
{
    $joakim = explode('.', $a);

    if (isset($joakim[1]) && $joakim[1] != '') {
        if (($joakim[1] != '000')) {
            if ($joakim[0] == '0') {
                return  'zero Dinars et ' . ($joakim[1]) . ' Millimes';
            }
            return int2str($joakim[0]) . ' Dinars et ' . ($joakim[1]) . ' Millimes';
        } else {
            return int2str($joakim[0]) . ' Dinars et 0 Millimes';
        }
    }


    if ($a == 0) return '';
    if ($a < 0) return 'moins ' . int2str(-$a);
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
            if (((int)($a / 10) * 10) < 70) {
                return int2str((int)($a / 10) * 10) . '-et-un';
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
        return int2str((int)($a / 100)) . ' ' . int2str(100) . ' ' . int2str($a % 100);
    } else if ($a == 1000) {
        return 'mille';
    } else if ($a < 2000) {
        return int2str(1000) . ' ' . int2str($a % 1000) . ' ';
    } else if ($a < 1000000) {
        return int2str((int)($a / 1000)) . ' ' . int2str(1000) . ' ' . int2str($a % 1000);
    }
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>

<table width="100%" style="border: none;">
    <thead>
        <tr>
            <td>
                <div style="display:flex;">
                    <table border="1" cellpadding="0" cellspacing="0" style="border: 2px solid #002E50; border-left:none;border-right:none;border-collapse: collapse; width: 100%; ">


                        <td align="center" style="width: 25%;border: none;">
                            <div>
                                <?php
                                echo $this->Html->image('logoSMBM.png', ['alt' => 'CakePHP', 'height' => '80px', 'width' => '100%']); ?>
                            </div>
                        </td>
                        <td align="center" style="width: 10%;border: none;">
                            <!-- <div>
                        <?php
                        echo $this->Html->image('ISO-9001.png', ['alt' => 'CakePHP', 'height' => '50px', 'width' => '100%']); ?>

                     </div> -->
                        </td>
                        <td align="center" style="width: 50%; border: none; color: #002E50; font-weight: bold;">
                            <?php echo $societe->adresseEntete; ?>
                            <br>
                        </td>
                        <td align="center" style="width: 25%;border: none;">
                            <div>
                                <?php
                                // echo $this->Html->image('ISO-9001.png', ['alt' => 'CakePHP', 'height' => '50px', 'width' => '100%']); 
                                ?>

                            </div>
                        </td>

            </td>
        </tr>
</table>


</td>
</tr>
</thead>
<tr>
    <td>
        <br>

        Date: <?php
                date_default_timezone_set('Africa/Tunis');

                echo date('d/m/Y H:i:s');
                ?>
        <br><br>
        <div align="center">
            <h3> Historique Caisse</h3>

        </div>
        <style>
            body {
                font-size: 12px;
            }

            table {
                font-size: 12px;
            }

            /* table {
                border-collapse: collapse;
                width: 100%;
            } */

            th,
            td {
                /* border: 1px solid black; */
                padding: 8px;
            }

            th {
                /* background-color: #b0c24a; */
                text-align: center;
            }


            .total-row {
                border: none;
                /* Ensure no border on the row */
            }

            .total-row td {
                border: none;
                /* Ensure no border on the cells */
            }
        </style>

        <br>

        <div>
            <div class="panel-body">
                <div>
                    <table>
                        <thead>
                            <tr style='background-color:#b0c24a;'>
                                <th hidden style="text-align: center;">id</th>
                                <th style="text-align: center;width:7%">Type</th>
                                <th style="text-align: center;width:10%">Mode</th>
                                <th style="text-align: center;width:38%">Client/Caisses</th>
                                <th style="text-align: center;width:6%">Référence</th>
                                <th style="text-align: center;width:10%">Piece (BL/FC)</th>

                                <!-- <th style="text-align: center;width:6%">Mode paiement</th> -->
                                <th style="text-align: center;width:8%">Date</th>
                                <!-- <th style="text-align: center;width:15%">Observation</th> -->


                                <th style="text-align: center;width:10%">Montant réglé</th>
                                <!-- <th style="text-align: center;width:10%">Crédit</th> -->
                                <th style="text-align: center;width:12%">Solde</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $totalDebits = 0;
                            $totalCredits = 0;
                            $total = 0;
                            $solde = 0;
                            $totalss = 0;

                            usort($clientData, function ($a, $b) {
                                return strtotime($a['date']) - strtotime($b['date']);
                            });
                            // debug($clientData);

                            foreach ($clientData as $i => $data) :
                                // $totalDebits += $data['debit'];
                                $totalDebits += (float)$data['debit'];
                                $totalCredits += (float)$data['credit'];



                                $solde -= (float)$data['credit'];
                                $solde += (float)$data['debit'];
                                $totalss += (float)$data['debit'] - (float)$data['credit'];
                            ?>
                                <tr>
                                    <td hidden></td>
                                    <td align="center"> <?php echo ($data['type']) ?> </td>
                                    <td align="center"> <?php echo ($data['paiement_name']) ?> </td>
                                    <td align="center">
                                        <?php
                                        if ($data['index'] == 2) {
                                            echo ($data['name']);
                                        }
                                        if ($data['index'] == 4) {
                                            echo ($data['caissedep'] . '=>' . $data['caissearr']);
                                        }
                                        // if ($data['index'] == 5) {
                                        //     echo ($data['caissedep'] . '=>' . $data['caissearr']);
                                        // }
                                        if ($data['index'] == 3) {
                                            echo ($data['caissedep']);
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo ($data['num']) ?>
                                    </td>

                                    <td>
                                        <?php
                                        if ($data['numfact']) {
                                            foreach ($data['numfact'] as $nn => $valfact) {

                                                if (strpos($valfact, 'FAC N°') !== false) {
                                                    echo '<span style="color:#8b0000; font-weight:bold;">' . ($valfact) . '</span><br>';
                                                } else if (strpos($valfact, 'BL N°') !== false) {
                                                    echo '<span style="color:#0000ff; font-weight:bold;">' . ($valfact) . '</span><br>';
                                                } else if (strpos($valfact, 'CMD N°') !== false) {
                                                    echo '<span style="color:#29ab87; font-weight:bold;">' . ($valfact) . '</span><br>';
                                                } else {
                                                    echo '';
                                                }
                                            }
                                        }

                                        ?>
                                    </td>

                                    <td align="center">
                                        <?php echo $this->Time->format($data['date'], 'dd/MM/y'); ?>
                                    </td>
                                    <td align="center" hidden>
                                        <?php echo ($data['observation']) ?>
                                    </td>

                                    <!-- <td style="text-align:right;padding-right:5px">
                                <?php
                                //echo sprintf("%01.3f", $data['debit']);

                                ?>
                                <?php
                                if ($data['index'] == 1) {
                                ?>
                                    <strong style="color:green"><?php echo sprintf("%01.3f", $data['debit']); ?></strong>
                                <?php } else {
                                    echo sprintf("%01.3f", $data['debit']);
                                }

                                // $solde += $data['credit'];
                                // $solde -= $data['debit'];

                                ?>
                            </td> -->
                                    <td style="text-align:right;padding-right:5px">
                                        <?php
                                        if ($data['debit'] != '') {
                                        ?>
                                            <?php
                                            if ($data['index'] == 1) {
                                            ?>
                                                <strong
                                                    style="color:green"><?php echo sprintf("%01.3f", $data['debit']); ?></strong>
                                            <?php } else {
                                                echo sprintf("%01.3f", $data['debit']);
                                            }


                                            ?>
                                        <?php   } else  if ($data['credit'] != '') {
                                            echo sprintf("%01.3f", -$data['credit']);
                                        }



                                        ?>
                                    </td>
                                    <td style="text-align:right;padding-right:5px">
                                        <?php
                                        echo sprintf("%01.3f", $solde);

                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            <tr class="total-row">

                                <td hidden></td>
                                <td colspan="5"></td>

                                <td colspan="3" style="width: 100%;">
                                    <table style="width: 100%;">
                                        <tr style='background-color:#b0c24a;border:solid 1px'>
                                            <th colspan="3" style="text-align: center;">Total Période :</th>
                                        </tr>
                                        <!-- <tr style='background-color:#b0c24a;border:solid 1px'>
                                    <th style="text-align: center;">Débit :</th>
                                    <th style="text-align: center;">Crédit :</th>
                                    <th style="text-align: center;">Solde :</th>


                                </tr> -->
                                        <tr>
                                            <!-- <td style="width: 33%;">
                                        <?php echo sprintf("%01.3f", $totalDebits) ?>
                                    </td>

                                    <td style="width: 33%;">
                                        <?php echo sprintf("%01.3f", $totalCredits) ?>
                                    </td> -->

                                            <td style="width: 33%;border:solid 1px;text-align:right;padding-right:5px;">
                                                <?php echo sprintf("%01.3f", $totalDebits - $totalCredits) ?>
                                            </td>
                                        </tr>
                                    </table>
                                </td>

                            </tr>
                            <!-- <tr class="total-row">

                        <td hidden></td>
                        <td colspan="5"></td>

                        <td colspan="3" style="width: 100%;">
                            <table style="width: 100%;">
                                <tr style='background-color:#b0c24a;;border:solid 1px'>
                                    <th colspan="3" style="text-align: center;">Total :</th>
                                </tr>

                                <tr style='background-color:#b0c24a;border:solid 1px'>
                                    <th style="text-align: center;">Débit :</th>
                                    <th style="text-align: center;">Crédit :</th>
                                    <th style="text-align: center;">Solde :</th>


                                </tr>
                                <tr>
                                    <td style="width: 33%;">
                                        <?php echo sprintf("%01.3f", $debit_all) ?>
                                    </td>
                                    <td style="width: 33%;">
                                        <?php echo sprintf("%01.3f", $credit_all) ?>
                                    </td>

                                    <td style="width: 33%;">
                                        <?php echo sprintf("%01.3f", $debit_all - $credit_all) ?>
                                    </td>

                                </tr>
                            </table>
                        </td>

                    </tr> -->

                        </tbody>
                    </table>
                    <br>

                </div>
                <br>


            </div>
        </div>
        <br>
    </td>
</tr>
</table>