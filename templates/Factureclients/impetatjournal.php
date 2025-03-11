<?php $this->layout = 'AdminLTE.print'; ?>
<?php

use Cake\Core\Configure;
use Cake\I18n\FrozenTime;
use Cake\Datasource\ConnectionManager;
?>
<?php $connection = ConnectionManager::get('default'); ?>


<style>
    /* Define your table border style here */
    #example1 {
        border-collapse: collapse;
        /* Collapse borders to avoid double borders */
        border: 2px solid #080400;
        /* Example: 2px solid black border */
    }

    #example1 th,
    #example1 td {
        border: 1px solid #080400;
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
    <div style="margin-left: 5px ;color: #a52a2a; ">  <?php echo $societefirst->nom; ?></div>


    <div align="center" style="color: #c71585 ; ">
        Journal de Vente</div>
</h3>

<h5 align="center"> <strong> DU </strong><?= $this->Time->format(
                                                $this->request->getQuery('datedebut'),
                                                'dd/MM/y'
                                            ); ?><strong> &nbsp;&nbsp;&nbsp;&nbsp; AU </strong><?= $this->Time->format(
                                                                                                    $this->request->getQuery('datefin'),
                                                                                                    'dd/MM/y'
                                                                                                ); ?></h6>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table border="1" class="table table-bordered table-striped table-bottomless">

                        <thead>
                            <tr>
                                <th rowspan="2" width="7%" align="center" style="text-align: center;background-color: #4DAAA5;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>Date</strong></span>
                                </th>
                                <th rowspan="2" align="center" width="10%" style="text-align: center;background-color: #4DAAA5;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>Client</strong></span>
                                </th>
                                <th rowspan="2" align="center" width="10%" style="text-align: center;background-color: #4DAAA5;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>Code CL</strong></span>
                                </th>
                                <th rowspan="2" align="center" width="10%" style="text-align: center;background-color: #4DAAA5;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>Net HT</strong></span>
                                </th>
                                <th rowspan="2" align="center" width="5%" style="text-align: center;background-color: #4DAAA5;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>Fodec</strong></span>
                                </th>
                                <th colspan="4" align="center" width="15%" style="text-align: center;background-color: #4DAAA5;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"> <strong>Assujetti à la TVA</strong></span>
                                </th>
                                <th colspan="3" align="center" width="30%" style="text-align: center;background-color: #4DAAA5;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>Non Assujetti à la TVA</strong></span>
                                </th>
                                <th rowspan="2" align="center" width="12%" style="text-align: center;background-color: #4DAAA5;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>Total TVA</strong></span>
                                </th>
                                <th rowspan="2" align="center" width="4%" style="text-align: center;background-color: #4DAAA5;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>Av Imp</strong></span>
                                </th>
                                <th rowspan="2" align="center" width="3%" style="text-align: center;background-color: #4DAAA5;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>Timb</strong></span>
                                </th>
                                <th rowspan="2" align="center" width="8%" style="text-align: center;background-color: #4DAAA5;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>TTC</strong></span>
                                </th>
                            </tr>
                            <tr>
                                <th align="center" width="5%" style="text-align: center;background-color: #4DAAA5;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>00 %</strong></span>
                                </th>
                                <th align="center" width="5%" style="text-align: center;background-color: #4DAAA5;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>07 %</strong></span>
                                </th>
                                <th align="center" width="5%" style="text-align: center;background-color: #4DAAA5;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>13 %</strong></span>
                                </th>
                                <th align="center" width="10%" style="text-align: center;background-color: #4DAAA5;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>19 %</strong></span>
                                </th>
                                <th align="center" width="6%" style="text-align: center;background-color: #4DAAA5;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>7.5 %</strong></span>
                                </th>
                                <th align="center" width="5%" style="text-align: center;background-color: #4DAAA5;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>15 %</strong></span>
                                </th>
                                <th align="center" width="7%" style="text-align: center;background-color: #4DAAA5;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>22.5 %</strong></span>
                                </th>
                            </tr>
                        </thead>



                        <tbody>
                            <?php

                            $totfodec = 0;
                            $tottva = 0;
                            $totttc = 0;
                            $totremise = 0;
                            $totht = 0;
                            $tottimbre = 0;
                            //if (!empty($clientss)) {

                            foreach ($factureclients as $fact) :

                                $idfacture = $fact->id;
                                $totfodec = $totfodec + $fact->totalfodec;
                                $tottva =  $tottva + $fact->totaltva;
                                $totttc =  $totttc + $fact->totalttc;
                                $totremise = $totremise + $fact->totalremise;
                                //$articleid =  $stockdepot['id'];
                                $totht =   $totht + $fact->totalht;
                                $tottimbre =  $tottimbre + $timbre;
                                $connection = ConnectionManager::get('default');

                                $tvaQuery = "
        SELECT 
            tva,
            SUM(CASE WHEN tva = 12 THEN prixht ELSE 0 END) AS tva_12_total,
            SUM(CASE WHEN tva = 7.5 THEN prixht ELSE 0 END) AS tva_7_5_total,

            SUM(CASE WHEN tva = 7 THEN prixht ELSE 0 END) AS tva_7_total,
            SUM(CASE WHEN tva = 15 THEN prixht ELSE 0 END) AS tva_15_total,

            SUM(CASE WHEN tva = 19 THEN prixht ELSE 0 END) AS tva_19_total,
            SUM(CASE WHEN tva = 22.5 THEN prixht ELSE 0 END) AS tva_22_5_total,
            SUM(CASE WHEN tva = 0 THEN prixht ELSE 0 END) AS tva_0_total,
            SUM(CASE WHEN tva = 13 THEN prixht ELSE 0 END) AS tva_13_total

        FROM lignefactureclients l
        WHERE factureclient_id = :factureclient_id
        
        GROUP BY tva
    ";


                                $statementd = $connection->prepare($tvaQuery);
                                $statementd->bindValue('factureclient_id', $idfacture, 'integer');
                                $statementd->execute();
                                $results = $statementd->fetchAll('assoc');
                            ?>
                                <tr>






                                    <td align="center">
                                        <?= $this->Time->format($fact->date, 'dd/MM/y'); ?> <br>
                                        <?= '<strong>F</strong> ' . $fact->numero; ?>
                                    </td>

                                    <td align="center">

                                        <?php
                                        echo  $fact->client->Raison_Sociale;
                                        ?>

                                    </td>
                                    <td align="center">
                                        <?php echo $fact->client->Code;
                                        ?>

                                    </td>
                                    <td align="center">
                                        <?php echo $fact->totalht;
                                        ?>
                                    </td>
                                    <td align="center">
                                        <?php //echo $fact->totalfodec;
                                        ?>
                                    </td>
                                    <td align="center">
                                        <?php if ($results[0]['tva_0_total'] != 0) {
                                            echo $results[0]['tva_0_total'];
                                        } else {
                                        }
                                        ?>
                                    </td>
                                    <td align="center">
                                        <?php if ($results[0]['tva_7_total'] != 0) {
                                            echo $results[0]['tva_7_total'];
                                        } else {
                                        }
                                        ?>
                                    </td>

                                    <td align="center">
                                        <?php
                                        if ($results[0]['tva_13_total'] != 0) {
                                            echo $results[0]['tva_13_total'];
                                        } else {
                                        }
                                        ?>
                                    </td>
                                    <td align="center">
                                        <?php if ($results[0]['tva_19_total']  != 0) {
                                            echo $results[0]['tva_19_total'];
                                        } else {
                                        }
                                        ?>
                                    </td>
                                    <td align="center">
                                        <?php if ($results[0]['tva_7_5_total'] != 0) {
                                            echo $results[0]['tva_7_5_total'];
                                        } else {
                                        }

                                        ?>
                                    </td>
                                    <td align="center">
                                        <?php if ($results[0]['tva_15_total'] != 0) {
                                            echo $results[0]['tva_15_total'];
                                        } else {
                                        }
                                        ?>
                                    </td>
                                    <td align="center">
                                        <?php if ($results[0]['tva_22_5_total'] != 0) {
                                            echo $results[0]['tva_22_5_total'];
                                        } else {
                                        }
                                        ?>
                                    </td>

                                    <td align="center">
                                        <?php echo $fact->totaltva;
                                        ?>
                                    </td>
                                    <td align="center">
                                        <?php // echo $timbre;
                                        ?>
                                    </td>
                                    <td align="center">
                                        <?php echo $timbre;
                                        ?>
                                    </td>
                                    <td align="center">
                                        <?php echo $fact->totalttc;
                                        ?>
                                    </td>

                                </tr>
                            <?php endforeach;
                            // } 
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>