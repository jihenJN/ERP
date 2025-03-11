<?php echo $this->Html->css('select2');
?>
<?php

use Cake\Datasource\ConnectionManager;
use Cake\I18n\FrozenTime;

$connection = ConnectionManager::get('default'); ?>
<script type="text/javascript" src="js/Chart.min.js"></script>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<section class="content">
    <div class="row">

        <div class="col-lg-2 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h1><?php echo $nb_articule ?></h1>
                    <p>Articles</p>
                </div>
                <div class="icon">
                    <i class="fa fa-cubes "></i>
                </div>
            </div>

        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h1><?php echo $nb_fact ?></h1>
                    <p>Facture Ventes</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-xs-6">
            <div class="small-box bg-blue">
                <div class="inner">
                    <h1>
                        <?php echo $nb_client ?></h1>
                    <p>Clients</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user-circle-o"></i>
                </div>
            </div>
        </div>


        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h1>
                        <?php echo $nb_factachat  ?></h1>
                    <p>Factue Achats</p>
                </div>
                <div class="icon">
                    <i class="fa fa-cart-plus"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h1>
                        <?php echo $nb_fournisseur ?></h1>
                    <p>Fournisseurs</p>
                    <!-- <p>Unique Visitors</p> -->
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
            </div>
        </div>
    </div>

</section>
<section class="content">

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
                            <tr style="font-style: italic; font-weight: bold;height:40px;">
                                <td width="15%">Démarcheur</td>
                                <td>Solde Ini</td>
                                <?php foreach ($mois as $mm) : ?>
                                    <td style="font-size: 16px; background-color: #d7837f; color: #000000; font-style: italic; font-weight: bold;" align="center"><?php echo $mm; ?></td>
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
                                    <tr style="height:40px;">
                                        <td style="background-color: #8fbc8f; color: #000000;"><?php echo $client->Raison_Sociale; ?></td>
                                        <td><?php if ($client->soldedebut != 0) {
                                                echo  h(number_format(abs($client->soldedebut), 3, ',', ' '));
                                            } ?></td>
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

                                            $parmoisdd = $resFacturemoi + $resBLmoi - $resRegmoi;
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
                        <tr style="height:40px;">
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
</section>


<section class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Statistique Par Fournisseur</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body" style="overflow: auto;">
                    <div id="chartfournisseur" class="inverted-labels" style="height: 370px; overflow: auto;"></div>


                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
    <?php

    // Initialisez les données clients
    $datafournisseurs = array();

    foreach ($fournisseurss as $key => $fournisseur) {
        $facturess = $connection->execute('SELECT id FROM factures WHERE fournisseur_id =' . $fournisseur['id'] . ';')->fetchAll('assoc');

        $totalqtee = 0;

        if ($facturess) {
            $factureIdss = implode(',', array_column($facturess, 'id'));


            $lgfactclients = $connection->execute('SELECT SUM(qte) as qte FROM lignefactures WHERE facture_id IN (' . $factureIdss . ');')->fetchAll('assoc');

            $totalqtee = $lgfactclients[0]['qte'];
        }

        $datafournisseurs[] = array("label" => $fournisseur['name'], "y" => $totalqtee);
    }
    // var_dump($datafournisseurs);

    ?>







</section>
<section class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Statistique Par Client</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body" style="overflow: auto;">
                    <div id="chartclient" class="inverted-labels" style="height: 370px; overflow: auto;"></div>


                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
    <?php

    // Initialisez les données clients
    $dataclients = array();

    foreach ($clientss as $key => $client) {
        $factures = $connection->execute('SELECT id FROM factureclients WHERE client_id =' . $client['id'] . ';')->fetchAll('assoc');

        $totalqte = 0;

        if ($factures) {
            $factureIds = implode(',', array_column($factures, 'id'));


            $lgfactclients = $connection->execute('SELECT SUM(qte) as qte FROM lignefactureclients WHERE factureclient_id IN (' . $factureIds . ');')->fetchAll('assoc');

            $totalqte = $lgfactclients[0]['qte'];
        }

        $dataclients[] = array("label" => $client['Raison_Sociale'], "y" => $totalqte);
    }
    ?>







</section>

<script>
    window.onload = function() {
        var chartfournisseur = new CanvasJS.Chart("chartfournisseur", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: ""
            },
            axisY: {
                title: "Quantité Article"
            },
            data: [{
                type: "column",
                dataPoints: <?php echo json_encode($datafournisseurs, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chartfournisseur.render();

        var chart1 = new CanvasJS.Chart("chartclient", {
            animationEnabled: true,
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            title: {
                text: ""
            },
            axisY: {
                title: "Quantité Article"
            },
            data: [{
                type: "column",
                dataPoints: <?php echo json_encode($dataclients, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart1.render();
    }
</script>

<!-- /.content -->
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/chart.js/Chart', ['block' => 'script']); ?>

<?php $this->start('scriptBottom'); ?>
<!-- page script -->
<script>
    $('.select2').select2()
</script>
<style type="text/css">
    .canvasjs-chart-credit {
        display: none;
    }
</style>
<?php $this->end(); ?>