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

    @media print {
        @page {
            size: landscape;
        }
    }

    #example1 th,
    #example1 td {
        border: 1px solid #000;
        /* Example: 1px solid black border for table cells */
        padding: 8px;
        /* Adjust cell padding as needed */
    }
</style>
<br>
<style>
    body {
        font-size: 11px;

    }

    table {
        font-size: 12px;

    }
</style>

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


            <?php echo $societes->nom; ?>&nbsp;&nbsp; au Capital : <?php echo $societes->capital; ?> <br>
            <?php echo $societes->adresse; ?> - Tél : <?php echo $societes->tel; ?> -Fax : <?php echo $societes->fax; ?><br>
            TVA : <?php echo $societes->codetva; ?> - E-mail : <?php echo $societes->mail; ?><br>
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
        Etat De Client NON Soldé</div>
</h3>

<h5 align="center"> <strong> DU </strong><?php echo $datedebut = date('Y-01-01') ?><strong> &nbsp;&nbsp;&nbsp;&nbsp; AU </strong><?php echo $datefin = date('Y-12-t'); ?></h6>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-bottomless" id="example1" border="1">
                        <?php date_default_timezone_set('Africa/Tunis');
                        $datedebut = date('Y-01-01');
                        $datefin = date('Y-12-t'); ?>
                        <!-- <table id="example1" class="table-fixed table table-bordered table-striped" style='display: block; overflow-x: auto; white-space: nowrap;'> -->
                        <thead style='position: sticky; top: 0;'>
                            <tr style="font-style: italic; font-weight: bold;height:30px;">
                                <td width="15%">Démarcheur</td>
                                <td>Solde Ini</td>
                                <?php foreach ($mois as $mm) : ?>
                                    <td style="border:1px;font-size: 16px; background-color: #d7837f; color: #000000; font-style: italic; font-weight: bold;" align="center"><?php echo $mm; ?></td>
                                <?php endforeach; ?>
                                <td style="font-style: italic; font-weight: bold;">Encours</td>
                                <td style="font-style: italic; font-weight: bold;">Solde</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sumsoldedebut = 0;
                            $sumencours = 0;
                            $sumsolde = 0;
                            foreach ($clients as $client) :
                                $client_id = $client->id;
                                $sumsoldedebut += $client->soldedebut;

                                $test = $connection->prepare("SELECT SUM(totalttc) as sumtotalttc
                            FROM factureclients
                            WHERE factureclients.client_id = ? AND Date(factureclients.date) BETWEEN ? AND ?");
                                $test->bindValue(1, $client->id);
                                $test->bindValue(2, $datedebut);
                                $test->bindValue(3, $datefin);
                                $test->execute();
                                $resulttest = $test->fetchAll('assoc');
                                $resFacture = $resulttest ? $resulttest[0]['sumtotalttc'] : 0;

                                $statement = $connection->prepare("SELECT SUM(totalttc) as ttc
                                FROM bonlivraisons
                                WHERE bonlivraisons.factureclient_id = 0 AND bonlivraisons.typebl = 1
                                AND bonlivraisons.client_id = ? AND Date(bonlivraisons.date) BETWEEN ? AND ?");
                                $statement->bindValue(1, $client_id);
                                $statement->bindValue(2, $datedebut);
                                $statement->bindValue(3, $datefin);
                                $statement->execute();
                                $test1 = $statement->fetchAll('assoc');
                                $resBL = $test1 ? $test1[0]['ttc'] : 0;

                                $reglementQuery = $connection->prepare("SELECT SUM(lignereglementclients.Montant) AS sumMontant
                            FROM lignereglementclients
                            LEFT JOIN reglementclients 
                            ON lignereglementclients.reglementclient_id = reglementclients.id
                            WHERE reglementclients.client_id = ? AND reglementclients.date BETWEEN ? AND ?");
                                $reglementQuery->bindValue(1, $client_id);
                                $reglementQuery->bindValue(2, $datedebut);
                                $reglementQuery->bindValue(3, $datefin);
                                $reglementQuery->execute();
                                $reglementResult = $reglementQuery->fetchAll('assoc');
                                $resReg = $reglementResult ? $reglementResult[0]['sumMontant'] : 0;

                                $tt = $client->soldedebut + $resFacture + $resBL - $resReg;
                                $sumencours += ($resFacture + $resBL);
                                $sumsolde += $tt;

                                if ($tt != 0) :
                            ?>
                                    <tr style="height:30px;">
                                        <td style="background-color: #8fbc8f; color: #000000;"><?php echo $client->Raison_Sociale; ?></td>
                                        <td><?php echo  h(number_format(abs($client->soldedebut), 3, ',', ' ')) ?></td>
                                        <?php foreach ($moiss as $mois_id => $mm) :

                                            $month_start_date = date('Y-m-01', strtotime("{$mm->num}/01/" . date('Y')));
                                            $month_end_date = date('Y-m-t', strtotime($month_start_date));

                                            // Query for factureclients totalttc for this month
                                            $test = $connection->prepare("SELECT SUM(totalttc) as sumtotalttc
                                        FROM factureclients
                                        WHERE factureclients.client_id = ? AND Date(factureclients.date) BETWEEN ? AND ?");
                                            $test->bindValue(1, $client->id);
                                            $test->bindValue(2, $month_start_date);
                                            $test->bindValue(3, $month_end_date);
                                            $test->execute();
                                            $resulttest = $test->fetchAll('assoc');
                                            $resFacturemoi = $resulttest ? $resulttest[0]['sumtotalttc'] : 0;

                                            // Query for bonlivraisons totalttc for this month
                                            $statement = $connection->prepare("SELECT SUM(totalttc) as ttc 
                                        FROM bonlivraisons 
                                        WHERE bonlivraisons.factureclient_id = 0 AND bonlivraisons.typebl = 1 
                                        AND bonlivraisons.client_id = ? AND Date(bonlivraisons.date) BETWEEN ? AND ?");
                                            $statement->bindValue(1, $client_id);
                                            $statement->bindValue(2, $month_start_date);
                                            $statement->bindValue(3, $month_end_date);
                                            $statement->execute();
                                            $test1 = $statement->fetchAll('assoc');
                                            $resBLmoi = $test1 ? $test1[0]['ttc'] : 0;

                                            // Query for total reglement amount for this month
                                            $reglementQuery = $connection->prepare("SELECT SUM(lignereglementclients.Montant) AS sumMontant
                                            FROM lignereglementclients
                                            LEFT JOIN reglementclients 
                                            ON lignereglementclients.reglementclient_id = reglementclients.id
                                            WHERE reglementclients.client_id = ? AND reglementclients.date BETWEEN ? AND ?");
                                            $reglementQuery->bindValue(1, $client_id);
                                            $reglementQuery->bindValue(2, $month_start_date);
                                            $reglementQuery->bindValue(3, $month_end_date);
                                            $reglementQuery->execute();
                                            $reglementResult = $reglementQuery->fetchAll('assoc');
                                            $resRegmoi = $reglementResult ? $reglementResult[0]['sumMontant'] : 0;

                                            $parmoisdd =  $resFacturemoi + $resBLmoi - $resRegmoi;
                                            $monthly_totals[$mois_id] += $parmoisdd;

                                        ?>
                                            <td><?php if ($parmoisdd != 0) {
                                                    echo  h(number_format(abs($parmoisdd), 3, ',', ' '));
                                                } ?></td>
                                        <?php endforeach; ?>
                                        <td><?php if (($resBL + $resFacture) != 0) {
                                                echo  h(number_format(abs($resBL + $resFacture), 3, ',', ' '));
                                            } ?></td>
                                        <td><?php if ($tt != 0) {
                                                echo  h(number_format(abs($tt), 3, ',', ' '));
                                            } ?></td>
                                    </tr>
                            <?php
                                endif;
                            endforeach;
                            ?>
                        </tbody>
                        <tr style="height:30px;">
                            <td style="background-color: #dcdcdc; font-weight: bold;">Total</td>
                            <td style=" font-weight: bold;"><?php echo  h(number_format(abs($sumsoldedebut), 3, ',', ' ')) ?></td>
                            <?php foreach ($monthly_totals as $total) : ?>
                                <td style="background-color:#F0D2D2; font-weight: bold;"><?php echo h(number_format(abs($total), 3, ',', ' ')); ?></td>
                            <?php endforeach; ?>
                            <td style="font-weight: bold;"> <?php echo h(number_format(abs($sumencours), 3, ',', ' ')); ?></td>
                            <td style="font-weight: bold;background-color:#C7FCC7;"> <?php echo h(number_format(abs($sumsolde), 3, ',', ' ')); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>