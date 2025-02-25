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
                                if( $tt!=0 || $testfin!=0){
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
                            <?php } endforeach; ?>
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