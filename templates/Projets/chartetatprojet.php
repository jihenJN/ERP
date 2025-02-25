<?php
error_reporting(E_ERROR | E_PARSE);

?>
<?php

use Cake\Datasource\ConnectionManager;

$connection = ConnectionManager::get('default'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="row">
                <div class="col-md-6 d-flex align-items-center">
                    <?php
                    echo "<script>var progress = $progress;</script>";
                    if ($projet) {
                        $chart_title = "Etat d'avancement du projet " . $name;
                        echo '<h5 class="chart-title" style="text-align: left;">' . $chart_title . '</b></h5>';
                    } else {
                        echo '<h5 class="chart-title">Projet non trouvé</b></h5>';
                    }
                    ?>
                </div>
                <div class="col-md-6 d-flex justify-content-end" id="toggleChart" style="text-align: right; ">
                    <a class="btn btn-primary btn-sm" style=" border: transparent; color: #fff; margin-right: 30px;">
                        <i class="fa fa-eye" style="cursor: pointer;"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="avancementttt" style="display:block ; margin-top: 1px;">
    <section style="width:97%">
        <div class="row">
            <div class="col-md-12">
                <!-- <div class="box ">
                    <div class="chart-container">
                        <canvas id="progress-chart" class="chart-canvas" width="400" height="400"></canvas>
                        <div id="chart-legend"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-3">
                                <div class="color-block">
                                    <div class="color-swatch" style="background-color: #81C784;"></div>
                                    <span>Règlement</span>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="color-block">
                                    <div class="color-swatch" style="background-color: #228B22;"></div>
                                    <span>Facture client</span>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="color-block">
                                    <div class="color-swatch" style="background-color: #FFA500;"></div>
                                    <span>Commande client</span>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="color-block">
                                    <div class="color-swatch" style="background-color: #1E90FF ;"></div>
                                    <span>Offreggb</span>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="color-block">
                                    <div class="color-swatch" style="background-color: #9932CC;"></div>
                                    <span>Facture fournisseur</span>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="color-block">
                                    <div class="color-swatch" style="background-color: #FF4500;"></div>
                                    <span>Commande fournisseur</span>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="color-block">
                                    <div class="color-swatch" style="background-color: #FFD700;"></div>
                                    <span>Demande offre de prix</span>
                                </div>
                            </div>
                            <div class="col-xs-3">

                                <div class="color-block">
                                    <div class="color-swatch" style="background-color: #FF0000;"></div>
                                    <span>Projet</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <?php
                //echo $projet->id;


                $count1 = $connection->execute('SELECT COUNT(demandeoffredeprixes.id) as l1 FROM demandeoffredeprixes where demandeoffredeprixes.projet_id=' . $projet->id . ' ;')->fetch('assoc');
                $c1 = $count1['l1'];
                $count2 = $connection->execute('SELECT COUNT(commandeclients.id) as l1 FROM commandeclients where commandeclients.projet_id=' . $projet->id . ' ;')->fetch('assoc');
                $c2 = $count2['l1'];
                $count3 = $connection->execute('SELECT COUNT(commandefournisseurs.id) as l1 FROM commandefournisseurs where commandefournisseurs.projet_id=' . $projet->id . ';')->fetch('assoc');
                $c3 = $count3['l1'];
                $count4 = $connection->execute('SELECT COUNT(factures.id) as l1 FROM factures where factures.projet_id=' . $projet->id . ';')->fetch('assoc');
                $c4 = $count4['l1'];
                $count5 = $connection->execute('SELECT COUNT(commandeclients.id) as l1 FROM commandeclients where commandeclients.projet_id=' . $projet->id . ' and commandeclients.valider=1 ;')->fetch('assoc');
                $c5 = $count5['l1'];
                $count6 = $connection->execute('SELECT COUNT(factureclients.id) as l1 FROM factureclients where factureclients.projet_id=' . $projet->id . ';')->fetch('assoc');
                $c6 = $count6['l1'];
                $count7 = $connection->execute('SELECT COUNT(reglementclients.id) as l1 FROM reglementclients where reglementclients.projet_id=' . $projet->id . ';')->fetch('assoc');
                $c7 = $count7['l1'];

                if ($c7 != 0) {
                    $cc1 = "y: [12.5, 25]";
                    $cc2 = "y: [25, 37.5]";
                    $cc3 = "y: [37.5, 50]";
                    $cc4 = "y: [50, 62.5]";
                    $cc5 = "y: [62.5, 75]";
                    $cc6 = "y: [75, 87.5]";
                    $cc7 = "y: [87.5, 100]";
                } else {
                    if ($c6 != 0) {
                        $cc1 = "y: [12.5, 25]";
                        $cc2 = "y: [25, 37.5]";
                        $cc3 = "y: [37.5, 50]";
                        $cc4 = "y: [50, 62.5]";
                        $cc5 = "y: [62.5, 75]";
                        $cc6 = "y: [75, 87.5]";
                        $cc7 = "y: [87.5, 87.5]";
                    } else {
                        if ($c5 != 0) {
                            $cc1 = "y: [12.5, 25]";
                            $cc2 = "y: [25, 37.5]";
                            $cc3 = "y: [37.5, 50]";
                            $cc4 = "y: [50, 62.5]";
                            $cc5 = "y: [62.5, 75]";
                            $cc6 = "y: [75, 75]";
                            $cc7 = "y: [87.5, 87.5]";
                        } else {
                            if ($c4 != 0) {
                                $cc1 = "y: [12.5, 25]";
                                $cc2 = "y: [25, 37.5]";
                                $cc3 = "y: [37.5, 50]";
                                $cc4 = "y: [50, 62.5]";
                                $cc5 = "y: [62.5, 62.5]";
                                $cc6 = "y: [75, 75]";
                                $cc7 = "y: [87.5, 87.5]";
                            } else {
                                if ($c3 != 0) {
                                    $cc1 = "y: [12.5, 25]";
                                    $cc2 = "y: [25, 37.5]";
                                    $cc3 = "y: [37.5, 50]";
                                    $cc4 = "y: [50, 50]";
                                    $cc5 = "y: [62.5, 62.5]";
                                    $cc6 = "y: [75, 75]";
                                    $cc7 = "y: [87.5, 87.5]";
                                } else {
                                    if ($c2 != 0) {
                                        $cc1 = "y: [12.5, 25]";
                                        $cc2 = "y: [25, 37.5]";
                                        $cc3 = "y: [37.5, 37.5]";
                                        $cc4 = "y: [50, 50]";
                                        $cc5 = "y: [62.5, 62.5]";
                                        $cc6 = "y: [75, 75]";
                                        $cc7 = "y: [87.5, 87.5]";
                                    } else {
                                        if ($c1 != 0) {
                                            $cc1 = "y: [12.5, 25]";
                                            $cc2 = "y: [25, 25]";
                                            $cc3 = "y: [37.5, 37.5]";
                                            $cc4 = "y: [50, 50]";
                                            $cc5 = "y: [62.5, 62.5]";
                                            $cc6 = "y: [75, 75]";
                                            $cc7 = "y: [87.5, 87.5]";
                                        } else {
                                            $cc1 = "y: [12.5, 12.5]";
                                            $cc2 = "y: [25, 25]";
                                            $cc3 = "y: [37.5, 37.5]";
                                            $cc4 = "y: [50, 50]";
                                            $cc5 = "y: [62.5, 62.5]";
                                            $cc6 = "y: [75, 75]";
                                            $cc7 = "y: [87.5, 87.5]";
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                ?>
                <script>
                    $(document).ready(function() {
                        //  cf = $('#indexcommande').val();
                        //cf=$('#indexcommande').val();
                        //if (cf != -1) {
                        cfy = "y: [25, 37.5]"
                        // }else{
                        //   cfy = "y: [25, 24]"

                        //}
                        var charttest = new CanvasJS.Chart("chartContainertest", {
                            animationEnabled: true,
                            exportEnabled: true,
                            title: {
                                text: "Etat d'avancement du projet"
                            },
                            axisX: {
                                title: "Etapes projet"
                            },
                            axisY: {
                                title: "Avancement en pourcentage",
                                interval: 10,
                                suffix: "%",

                            },
                            data: [{
                                type: "rangeBar",
                                //showInLegend: true,
                                yValueFormatString: "#,##0.00\"%\"",
                                //indexLabel: "{y[#index]}",
                                //legendText: "Department wise Min and Max Salary",
                                toolTipContent: "<b>{label}</b>: {y[0]} to {y[1]}",
                                dataPoints: [{
                                        x: 10,
                                        y: [0, 12.5],
                                        label: "Projet"
                                    },
                                    {
                                        x: 20,
                                        <?php echo $cc1 ?>,
                                        label: "Demande offre de prix"
                                    },
                                    {
                                        x: 30,
                                        <?php echo $cc2 ?>,
                                        label: "Offre ggb"
                                    },
                                    {
                                        x: 40,
                                        <?php echo $cc3 ?>,
                                        label: "Commande fournisseur"
                                    },
                                    {
                                        x: 50,
                                        <?php echo $cc4 ?>,
                                        label: "Facture fournisseur"
                                    },

                                    {
                                        x: 60,
                                        <?php echo $cc5 ?>,
                                        label: "Commande client"
                                    },
                                    {
                                        x: 70,
                                        <?php echo $cc6 ?>,
                                        label: "Facture client"
                                    },
                                    {
                                        x: 80,
                                        <?php echo $cc7 ?>,
                                        label: "Règlement"
                                    }
                                ]
                            }]
                        });
                        charttest.render();

                    });
                </script>
                <div class="box " align="center">
                    <div style="text-align: center;">
                        <div id="chartContainertest" style="height: 400px; width: 100%;"></div>
                        <script type="text/javascript" src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<style>
    .canvasjs-chart-credit {
        display: none !important;
    }
</style>

<style>
    .boutons-container {
        margin-right: 15px;
        padding: 5px 10px;

        display: flex;
        align-items: center;
        justify-content: flex-end;
    }




    .button {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        background-color: #3498db;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-left: 5px;
        margin-right: 5px;
        text-align: center;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .button:hover {
        background-color: #2980b9;
    }
</style>