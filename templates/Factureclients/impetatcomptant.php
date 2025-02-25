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
<?php $this->layout = 'AdminLTE.print'; ?>
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
    </table>
</div>
<br>

Date: <?php
        date_default_timezone_set('Africa/Tunis');

        echo date('d/m/Y H:i:s');
        ?>
<br><br>
<div align="center">
    <h3> Etat Client Comptant</h3>

</div>
<style>
    body {
        font-size: 12px;
    }

    table {
        font-size: 12px;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        border: 1px solid black;
        padding: 8px;
    }

    th {
        /* background-color: #96c8a2;*/
        text-align: center;
    }

    .total-row th {
        background-color: #96c8a2;
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
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr style='background-color:#417dc1!important;'>
                        <!-- <th hidden style="text-align: center;">ID</th> -->
                        <!-- <th style="text-align: center;width:10%">Type</th> -->
                        <th style="text-align: center;width:8%">Date</th>
                        <th style="text-align: center;width:8%">Numéro</th>
                        <th style="text-align: center;width:10%">Personnel</th>
                        <!-- <th style="text-align: center;width:10%">Code</th> -->
                        <th style="text-align: center;width:15%">Client</th>
                        <th style="text-align: center;width:12%">Régler / NON</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $totalfinal = 0;
                    $totalDebits = 0;
                    $totalCredits = 0;
                    $solde = 0;
                    $totalss = 0;
                    usort($clientData, function ($a, $b) {
                        return strtotime($b['date']) - strtotime($a['date']);
                    });
                    // usort($clientData, function ($a, $b) {
                    //     return strtotime($a['date']) - strtotime($b['date']);
                    // });

                    foreach ($clientData as $i => $data) :
                        $totalDebits += (float)$data['debit'];
                        $totalCredits += (float)$data['credit'];
                        $solde -= (float)$data['credit'];
                        $solde += (float)$data['debit'];
                        $totalss += (float)$data['debit'] - (float)$data['credit'];
                        $totalfinal += (float)$data['credit'] + (float)$data['debit'];
                    ?>
                        <tr style="background-color:#b0c4de;">

                            <!-- <td hidden> <?php echo h($data['id']); ?></td> -->
                            <!-- <td align="center"><strong> <?php echo h($data['type']); ?></strong> </td> -->
                            <td align="center">
                                <?php echo $this->Time->format($data['date'], 'dd/MM/y'); ?>
                            </td>
                            <td>
                                <?php
                                if (!empty($data['fac']) && $data['fac'] != 'FAC : ') {
                                    echo '<span style="color:#0000ff; font-weight:bold;">' . h($data['fac']) . '</span>';
                                } elseif (!empty($data['bl']) && $data['bl'] != 'BL : ') {
                                    echo '<span style="color:red; font-weight:bold;">' . h($data['bl']) . '</span>';
                                } else {
                                    echo '';  // Optional
                                }
                                ?>
                            </td>
                            <td>
                                <?php echo h($data['personnel']); ?>
                            </td>
                            <!-- <td align="center">
                                <?php echo h($data['code']); ?>
                            </td> -->
                            <td align="center">
                                <?php echo h($data['name']); ?>
                            </td>
                            <td align="center">
                                <?php
                                if (!empty($data['payerfac']) && $data['payerfac'] != 'RF : ') {
                                    if ($data['payerfac'] === 'RF : Oui') {
                                        echo '<span style="color:green; font-weight:bold;">' . h('OUI') . '</span>';

                                        // echo '<button style="color:white;border:green; background-color:green; font-weight:bold;">OUI</button>';
                                    } else {
                                        echo '<span style="color:red; font-weight:bold;">' . h('NON') . '</span>';

                                        // echo '<button style="color:white;border:red; background-color:red; font-weight:bold;">NON</button>';
                                    }
                                } elseif (!empty($data['payerbl']) && $data['payerbl'] != 'RL : ') {
                                    if ($data['payerbl'] === 'Rl : Oui') {
                                        echo '<span style="color:green;font-weight:bold;">' . h('OUI') . '</span>';
                                    } else {
                                        echo '<span style="color:red;font-weight:bold;">' . h('NON') . '</span>';
                                    }
                                } else {
                                    echo '';
                                }
                                ?>
                            </td>

                            <!-- <td style="text-align:right;padding-right:5px">
                                            <?php
                                            if ($data['index'] == 1) {
                                            ?>
                                                <strong style="color:red"><?php echo sprintf("%01.3f", $data['credit']); ?></strong>
                                            <?php } else { ?>
                                                <strong style="color:blue"><?php echo sprintf("%01.3f", $data['debit']); ?></strong>
                                            <?php }
                                            ?>
                                        </td> -->
                        </tr>

                        <?php
                        // Display lines for each Bonlivraison or Factureclient
                        if ($data['index'] == 1) { // Bonlivraison
                            $lignebl = $connection->execute('SELECT * FROM lignebonlivraisons WHERE bonlivraison_id=' . $data['idbl'] . ';')->fetchAll('assoc');

                            if (!empty($lignebl)) :
                        ?>
                                <tr>
                                    <td colspan="5">
                                        <table id="example1" class="table">
                                            <thead>
                                                <tr style='background-color:#45b1e8;'>
                                                    <th style="text-align: center;">Code</th>
                                                    <th style="text-align: center;">Désignation</th>
                                                    <th style="text-align: center;">Qté</th>
                                                    <th style="text-align: center;">PUTTC</th>
                                                    <th style="text-align: center;">Remise</th>

                                                    <th style="text-align: center;">TTC</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($lignebl as $lineb) :
                                                    $articlee = $connection->execute('SELECT * FROM articles WHERE articles.id=' . $lineb['article_id'] . ';')->fetchAll('assoc');
                                                ?>
                                                    <tr>
                                                        <td><?php echo h($articlee[0]['Code']); ?></td>
                                                        <td><?php echo h($articlee[0]['Dsignation']); ?></td>
                                                        <td><?php echo h($lineb['qte']); ?></td>
                                                        <td><?php echo sprintf("%01.3f", $lineb['puttc']); ?></td>
                                                        <td><?php echo ($lineb['remise']); ?></td>
                                                        <td><?php echo sprintf("%01.3f", $lineb['ttc']); ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            <?php endif;
                        } elseif ($data['index'] == 2) { // Factureclient
                            $lignefac = $connection->execute('SELECT * FROM lignefactureclients WHERE factureclient_id=' . $data['idfac'] . ';')->fetchAll('assoc');

                            if (!empty($lignefac)) :
                            ?>
                                <tr>
                                    <td colspan="5">
                                        <table id="example1" class="table">
                                            <thead>
                                                <tr style='background-color:#45b1e8;'>
                                                    <th style="text-align: center;">Code</th>
                                                    <th style="text-align: center;">Désignation</th>
                                                    <th style="text-align: center;">Qté</th>
                                                    <th style="text-align: center;">PUTTC</th>
                                                    <th style="text-align: center;">Remise</th>

                                                    <th style="text-align: center;">TTC</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($lignefac as $line) :
                                                    $article = $connection->execute('SELECT * FROM articles WHERE articles.id=' . $line['article_id'] . ';')->fetchAll('assoc');
                                                ?>
                                                    <tr>
                                                        <td><?php echo h($article[0]['Code']); ?></td>
                                                        <td><?php echo h($article[0]['Dsignation']); ?></td>
                                                        <td><?php echo h($line['qte']); ?></td>
                                                        <td><?php echo sprintf("%01.3f", $line['puttc']); ?></td>
                                                        <td><?php echo ($line['remise']); ?></td>

                                                        <td><?php echo sprintf("%01.3f", $line['ttc']); ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                        <?php endif;
                        }
                        ?>

                    <?php endforeach; ?>

                    <tr>
                        <td colspan="3" align="center" style='background-color:#417dc1;'><strong>Total</strong></td>
                        <td style="text-align:right;padding-right:5px"><strong><?php echo sprintf("%01.3f", $totalfinal); ?></strong></td>
                    </tr>
                </tbody>
            </table>
            <br>

        </div>
        <br>


    </div>
</div>
<br>