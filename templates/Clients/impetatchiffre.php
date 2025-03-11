<?php $this->layout = 'AdminLTE.print'; ?>
<?php

use Cake\Core\Configure;
use Cake\I18n\FrozenTime;
use Cake\Datasource\ConnectionManager;
?>
<?php $connection = ConnectionManager::get('default'); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<style>
    /* Define your table border style here */
    #example1 {
        border-collapse: collapse;
        /* Collapse borders to avoid double borders */
        border: 2px solid #000;
        /* Example: 2px solid black border */
    }

    /* @media print {
        @page {
            size: landscape;
        }
    } */

    #example1 th,
    #example1 td {
        border: 1px solid #000;
        /* Example: 1px solid black border for table cells */
        padding: 8px;
        /* Adjust cell padding as needed */
    }
</style>
<br>
<!-- <style>
    body {
        font-size: 11px;

    }

    table {
        font-size: 12px;

    }
</style> -->

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
                    <?php echo $societefirst->adresseEntete; ?><br>
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

<h3>
    <div style="margin-left: 5px ;color: #ce2029 ; ">  <?php echo $societefirst->nom; ?></div>


    <div align="center" style="color: #ce2029 ; ">
        Chiffre d'affaire mensuelle par démarcheur</div>
</h3>

<h5 align="center"> <strong> DU </strong><?php echo $datedebut = date('Y-01-01') ?><strong> &nbsp;&nbsp;&nbsp;&nbsp; AU </strong><?php echo $datefin = date('Y-12-t'); ?></h5>
<h5 align="left"> <strong> Année : &nbsp;&nbsp;&nbsp;</strong><?php echo $datedebut = date('Y') ?></h5>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-bordered table-striped table-bottomless" id="example1" border="1">
                    <thead style='position: sticky; top: 0;'>
                        <tr style="font-style: italic; font-weight: bold;">
                            <td>Démarcheur</td>
                            <?php foreach ($mois as $mm) : ?>
                                <td style="font-size: 16px; background-color: #5f9ea0; color: #000000; font-style: italic; font-weight: bold;" align="center"><?php echo $mm; ?></td>
                            <?php endforeach; ?>
                            <td style="font-style: italic; font-weight: bold;">Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $generaltotaltt = 0;
                        foreach ($clients as $client) : ?>
                            <tr>
                                <td style="background-color: #bc987e; color: #000000;"><?php echo $client->Raison_Sociale; ?></td>
                                <?php
                                $totalClient = 0;
                                foreach ($moiss as $mois_id => $mm) :
                                    $mois = $mm->num;
                                    $annee_en_cours = date('Y');
                                    $date_debut = date('Y-m-01 00:00:00', mktime(0, 0, 0, $mois, 1, $annee_en_cours));
                                    $date_fin = date('Y-m-t 23:59:59', mktime(0, 0, 0, $mois, 1, $annee_en_cours));

                                    $listefact = $connection->execute('
                                    SELECT SUM(totalttc) AS sumtotalttc 
                                    FROM factureclients 
                                    WHERE client_id = :client_id
                                    AND date BETWEEN :date_debut AND :date_fin
                                   ', ['client_id' => $client->id, 'date_debut' => $date_debut, 'date_fin' => $date_fin])
                                        ->fetchAll('assoc');

                                    $totalm = 0;
                                    foreach ($listefact as $row) {
                                        $totalm += $row['sumtotalttc'];
                                    }

                                    $bonLivraison = $connection->execute(
                                        '
                                    SELECT SUM(totalttc) AS sumtotalttc 
                                    FROM bonlivraisons 
                                    WHERE client_id = :client_id
                                    AND typebl = 1
                                    AND factureclient_id = 0
                                    AND date BETWEEN :date_debut AND :date_fin',
                                        ['client_id' => $client->id, 'date_debut' => $date_debut, 'date_fin' => $date_fin]
                                    )
                                        ->fetchAll('assoc');

                                    foreach ($bonLivraison as $row) {
                                        $totalm += $row['sumtotalttc'];
                                    }
                                    echo "<td>" . ($totalm == 0 ? '' : number_format($totalm, 2)) . "</td>";

                                    // echo "<td>" . number_format($totalm, 2) . "</td>";
                                    $totalClient += $totalm;
                                endforeach;

                                echo "<td><strong>" . ($totalClient == 0 ? '' : number_format($totalClient, 2)) . "</strong></td>";
                                $generaltotaltt += $totalClient;
                                ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Total</td>
                            <?php
                            foreach ($moiss as $mois_id => $mm) :
                                $mois = $mm->num;
                                $annee_en_cours = date('Y');
                                $date_debut = date('Y-m-01 00:00:00', mktime(0, 0, 0, $mois, 1, $annee_en_cours));
                                $date_fin = date('Y-m-t 23:59:59', mktime(0, 0, 0, $mois, 1, $annee_en_cours));

                                $listefact22 = $connection->execute('
                                SELECT SUM(totalttc) AS sumtotalttc 
                                FROM factureclients 
                                WHERE date BETWEEN :date_debut AND :date_fin
                                ', ['date_debut' => $date_debut, 'date_fin' => $date_fin])
                                    ->fetchAll('assoc');

                                $totalm22 = 0;
                                foreach ($listefact22 as $row) {
                                    $totalm22 += $row['sumtotalttc'];
                                }

                                $bonLivraison22 = $connection->execute(
                                    '
                                SELECT SUM(totalttc) AS sumtotalttc 
                                FROM bonlivraisons 
                                WHERE typebl = 1
                                AND factureclient_id = 0
                                AND date BETWEEN :date_debut AND :date_fin',
                                    ['date_debut' => $date_debut, 'date_fin' => $date_fin]
                                )
                                    ->fetchAll('assoc');

                                foreach ($bonLivraison22 as $row) {
                                    $totalm22 += $row['sumtotalttc'];
                                }

                                echo "<td><strong>" . ($totalm22 == 0 ? '' : number_format($totalm22, 2)) . "</strong></td>";
                            endforeach;
                            ?>
                            <td><strong><?php echo number_format($generaltotaltt, 2); ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
