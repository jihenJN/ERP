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

<h3>
    <div style="margin-left: 5px ;color: #ce2029 ; "> <?php echo $societe->nom ?></div>


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
                        $datedebut = date('Y-01-01 00:00:00');
                        $datefin = date('Y-12-t 23:59:59'); ?>
                        <!-- <table id="example1" class="table-fixed table table-bordered table-striped" style='display: block; overflow-x: auto; white-space: nowrap;'> -->
                        <thead style='position: sticky; top: 0;'>
                            <tr style="font-style: italic; font-weight: bold;">
                                <td width="15%">Démarcheur</td>
                                <td>Solde Ini</td>
                                <?php foreach ($mois as $mm) : ?>
                                    <td style="font-size: 16px; background-color: #d7837f; color: #000000; font-style: italic; font-weight: bold;" align="center"><?php echo $mm; ?></td>
                                <?php endforeach; ?>
                                <td style="font-style: italic; font-weight: bold;">Encours</td>
                                <td style="font-style: italic; font-weight: bold;">Total</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $totalini = 0;
                            $totalencours = 0;
                            $generaltotaltt = 0;
                            foreach ($clients as $client) :
                                $client_id = $client->id;
                                $date = date('Y') - 1;
                                $test = $connection->prepare("SELECT SUM(totalttc) as sumtotalttc
                                                          FROM factureclients
                                                          LEFT JOIN lignereglementclients ON lignereglementclients.factureclient_id = factureclients.id
                                                          WHERE YEAR(factureclients.date) = ? AND factureclients.client_id = ?");
                                $test->bindValue(1, $date);
                                $test->bindValue(2, $client->id);
                                $test->execute();
                                $resulttest = $test->fetchAll('assoc');

                                $res = $resulttest ? $resulttest[0]['sumtotalttc'] : 0;
                                $totalini += $res + $client->soldedebut;

                                date_default_timezone_set('Africa/Tunis');
                                $datedebut = date('Y-01-01 00:00:00');
                                $datefin = date('Y-12-t 23:59:59');
                                $statement = $connection->prepare("SELECT SUM(totalttc) as ttc FROM bonlivraisons WHERE bonlivraisons.factureclient_id = 0 AND bonlivraisons.typebl = 1 AND bonlivraisons.client_id = ? AND bonlivraisons.date BETWEEN ? AND ?");
                                $statement->bindValue(1, $client_id);
                                $statement->bindValue(2, $datedebut);
                                $statement->bindValue(3, $datefin);
                                $statement->execute();
                                $test1 = $statement->fetchAll('assoc');
                                $testfin = $test1 ? $test1['0']['ttc'] : 0;


                                $parmoisdd = 0;
                                foreach ($moiss as $mois_id => $mm) {
                                    $mois = $mm->num;
                                    $annee_en_cours = date('Y');
                                    $date_debut = date('Y-m-01 00:00:00', mktime(0, 0, 0, $mois, 1, $annee_en_cours));
                                    $date_fin = date('Y-m-t 23:59:59', mktime(0, 0, 0, $mois, 1, $annee_en_cours));

                                    $listefact = $connection->execute('SELECT SUM(totalttc) AS sumtotalttc FROM factureclients 
                                        WHERE factureclients.client_id = ' . $client->id . '
                                        AND factureclients.date BETWEEN \'' . $date_debut . '\' AND \'' . $date_fin . '\'
                                        AND factureclients.id NOT IN (
                                            SELECT factureclient_id FROM lignereglementclients
                                            WHERE lignereglementclients.factureclient_id = factureclients.id
                                        )')
                                        ->fetchAll('assoc');
                                    $totalm = 0;
                                    foreach ($listefact as $row) {
                                        $totalm += $row['sumtotalttc'];
                                        $parmoisdd += $row['sumtotalttc'];
                                    }
                                }
                                $tt = $client->soldedebut + $res + $parmoisdd + $testfin;
                                if ($tt != 0 || $testfin != 0) {
                                    $totalencours += $testfin;
                            ?>
                                    <tr>
                                        <td style="background-color: #8fbc8f; color: #000000;"><?php echo $client->Raison_Sociale; ?></td>
                                        <td>
                                            <?php

                                            echo $client->soldedebut + $res;
                                            ?>
                                        </td>
                                        <?php
                                        $parmoisdd = 0;
                                        foreach ($moiss as $mois_id => $mm) :
                                            $mois = $mm->num;
                                            $annee_en_cours = date('Y');
                                            $date_debut = date('Y-m-01 00:00:00', mktime(0, 0, 0, $mois, 1, $annee_en_cours));
                                            $date_fin = date('Y-m-t 23:59:59', mktime(0, 0, 0, $mois, 1, $annee_en_cours));

                                            $listefact = $connection->execute('SELECT SUM(totalttc) AS sumtotalttc FROM factureclients 
                                        WHERE factureclients.client_id = ' . $client->id . '
                                        AND factureclients.date BETWEEN \'' . $date_debut . '\' AND \'' . $date_fin . '\'
                                        AND factureclients.id NOT IN (
                                            SELECT factureclient_id FROM lignereglementclients
                                            WHERE lignereglementclients.factureclient_id = factureclients.id
                                        )')
                                                ->fetchAll('assoc');

                                            //$totalm = 0;
                                            foreach ($listefact as $row) {
                                                // $totalm += $row['sumtotalttc'];
                                                // $parmoisdd += $row['sumtotalttc'];
                                                echo "<td>" . $row['sumtotalttc'] . "</td>";
                                            }
                                        endforeach;





                                        $generaltotaltt += $tt;
                                        ?>
                                        <td><?php echo $testfin; ?></td>
                                        <td><?php echo $tt; ?></td>
                                    </tr>
                            <?php }
                            endforeach; ?>
                        </tbody>
                        <tr>
                            <td></td>
                            <td><strong><?php echo $totalini; ?></strong></td>
                            <?php
                            foreach ($moiss as $mois_id => $mm) :
                                $mois = $mm->num;
                                $annee_en_cours = date('Y');
                                $date_debut = date('Y-m-01 00:00:00', mktime(0, 0, 0, $mois, 1, $annee_en_cours));
                                $date_fin = date('Y-m-t 23:59:59', mktime(0, 0, 0, $mois, 1, $annee_en_cours));

                                $listefact22 = $connection->execute('SELECT SUM(totalttc) AS sumtotalttc FROM factureclients 
                                WHERE factureclients.date BETWEEN \'' . $date_debut . '\' AND \'' . $date_fin . '\'
                                AND factureclients.id NOT IN (
                                    SELECT factureclient_id FROM lignereglementclients
                                    WHERE lignereglementclients.factureclient_id = factureclients.id
                                )')
                                    ->fetchAll('assoc');

                                $totalm22 = 0;
                                foreach ($listefact22 as $row) {
                                    $totalm22 += $row['sumtotalttc'];
                                    echo "<td><strong>" . $row['sumtotalttc'] . "</strong></td>";
                                }
                            endforeach;
                            ?>
                            <td><strong><?php echo $totalencours; ?></strong></td>
                            <td><strong><?php echo $generaltotaltt; ?></strong></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>