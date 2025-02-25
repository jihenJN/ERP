<?php echo $this->Html->css('select2');
?>

<?php

use Cake\Datasource\ConnectionManager;

$connection = ConnectionManager::get('default'); ?>
<script type="text/javascript" src="js/Chart.min.js"></script>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<section class="content" style="width: 99%">
    <div class="box">
        <div class="box-header">
        </div>

        <div class="box-body">

            <?php echo $this->Form->create($factureclients, ['type' => 'get']); ?>
            <div class="row">


                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">



                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->input('datedebut', array('required' => 'off', 'label' => 'Date début', 'value' => $datedebut, 'id' => 'datefin', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'date'));
                            ?>

                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->input('datefin', array('required' => 'off', 'label' => 'Date fin', 'value' => $datefin, 'id' => 'datefin', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'date'));
                            ?>
                        </div>


                    </div>
                </div>
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">



                        <div class="col-xs-6">
                            <div class="form-group input select required">

                                <label class="control-label" for="depot-id">Articles</label>

                                <select name="article_id" id="article_id" class="form-control select2 control-label "
                                    value='<?php $this->request->getQuery('article_id') ?>'>
                                    <option value="" selected="selected">Veuillez choisir !!</option>

                                    <?php foreach ($articles as $id => $articlee) {
                                        ?>
                                        <option value="<?php echo $articlee->id; ?>" <?php if ($this->request->getQuery('article_id') == $articlee->id) { ?>
                                                selected <?php } ?>>
                                            <?php echo $articlee->Code . ' ' . $articlee->Dsignation ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('gouvernorat_id', ['class' => 'form-control select2 control-label', 'label' => 'Gouvernorat', 'value' => $this->request->getQuery('gouvernorat_id'), 'empty' => 'Veuillez choisir !!', 'required' => 'off']); ?>


                        </div>
                    </div>
                </div>
            </div>










            <div style="text-align:center">
                <button type="submit" class="btn btn-primary ">Afficher</button>
                <a href="<?php echo $this->Url->build(['action' => 'statistiquegouvernorat']); ?>"
                    class="btn btn-primary"> Afficher tous</a>
                <a onclick="openWindow(1000, 1000, 'https://codifaerp.isofterp.com/demo/Statistiques/imprimestatistiquegouvernorat?datedebut=<?php echo @$datedebut; ?>&datefin=<?php echo @$datefin; ?>&gouvernorat_id=<?php echo @$this->request->getQuery('gouvernorat_id'); ?>&article_id=<?php echo @$this->request->getQuery('article_id'); ?>')"
                    class="btn btn-primary">Imprimer</a>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>


</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Statistique Par Gouvernorat</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body" style="height:500px;overflow: auto;">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead style='background-color: #3c8dbc;'>
                            <tr>

                                <th>Article</th>




                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($tabs as $i => $art):

                                /// debug($bonlivraison);
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $art['nom']; ?>
                                    </td>
                                    <td>
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="81%">Gouvernortas</th>
                                                    <th width="19%">Quantité</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($art['client'] as $j => $cl) { //debug($cl);die;?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $cl['name']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $cl['qte']; ?>
                                                        </td>
                                                    </tr>
                                                <?php }
                                                ; //die; ?>
                                            </tbody>
                                        </table>

                                    </td>


                                </tr>



                            <?php endforeach; ?>
                        </tbody>

                    </table>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- LINE CHART -->

            <!-- /.box -->

            <!-- BAR CHART -->

            <!-- /.box -->

        </div>
    </div>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Statistique Par Gouvernorat</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body" style="overflow: auto;">
                    <div id="chartContainer" class="inverted-labels" style="height: 370px; overflow: auto;"></div>


                </div>
                <!-- /.box-body -->
            </div>
            <!-- LINE CHART -->

            <!-- /.box -->

            <!-- BAR CHART -->

            <!-- /.box -->

        </div>

    </div>
    <?php
    // $dataPoints = array();
    
    // foreach ($gouvernoratss as $key => $gov) {
//     // Assurez-vous de remplacer $totalttc, $cout et $benefice par les valeurs appropriées pour chaque itération.
//     // $totalttc = obtenirTotalTTC($gov); // Remplacez cela par votre logique pour obtenir le total TTC.
//     // $cout = obtenirCout($gov); // Remplacez cela par votre logique pour obtenir le coût.
//     // $benefice = obtenirBenefice($gov); // Remplacez cela par votre logique pour obtenir le bénéfice.
    
    //     $clients = $connection->execute('SELECT id FROM clients WHERE gouvernorat_id='.$gov['id'].';')->fetchAll('assoc');
//     //debug($clients);
//     if ($clients) {
//         //debug($clients);
//         $detcl2 = '';
//         foreach ($clients as $cli) {
//             if ($cli['id'] != null) {
//                 $detcl2 = $detcl2 . ',' . $cli['id'];
//             }
//         }
//         $det2 = substr($detcl2, 1);
//     }
    
    //     $det22="";
//     if ($det2!='') {
//         $factclients = $connection->execute('SELECT id FROM factureclients WHERE client_id IN ('.$det2.') '.$cond2.' '.$cond3.';')->fetchAll('assoc');
//         if ($factclients) {
//             $detcl22 = '';
//             foreach ($factclients as $factc) {
//                 if ($factc['id'] != null) {
//                     $detcl22 = $detcl22 . ',' . $factc['id'];
//                 }
//             }
//             $det22 = substr($detcl22, 1);
//         }
//     }
    
    //     $totalqte=0;
//     if ($det22!="") {
//         $factclients = $connection->execute('SELECT sum(qte) as qte FROM lignefactureclients WHERE factureclient_id IN ('.$det22.')  '.$cond.' ;')->fetchAll('assoc');
//          $totalqte=$factclients['0']['qte'];
    
    //     }else if ($det22=="" && $condd!="") {
//         $factclients = $connection->execute('SELECT sum(qte) as qte FROM lignefactureclients WHERE '.$condd.' ;')->fetchAll('assoc');
//         $totalqte=$factclients['0']['qte'];
    
    //     }
//     // else if ($factt!=""){
//     //     $factclients = $connection->execute('SELECT sum(qte) as qte FROM lignefactureclients WHERE  ;')->fetchAll('assoc');
//     //     $totalqte=$factclients['0']['qte'];
    
    //     // }
//     // Ajoutez chaque élément au tableau $dataPoints.
//     $dataPoints[] = array("label" => $gov['name'], "y" => $totalqte);
//     // $dataPoints[] = array("label" => "Cout", "y" => $cout);
//     // $dataPoints[] = array("label" => "Bénéfice", "y" => $benefice);
// }
// ?>
    <?php
    $dataPoints = array();

    foreach ($tabs1 as $key => $gov) {

        foreach ($gov['client'] as $j => $cl) {
            $dataPoints[] = array("label" => $cl['name'], "y" => $cl['qte']);
        }
    }
    ?>

    <!-- /.row -->
    <?php


    ?>
</section>
<script>function openWindow(h, w, url) {
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }</script>
<script>
    window.onload = function () {
        var chart1 = new CanvasJS.Chart("chartContainer", {
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
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
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
    $(function () {
        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */

        //--------------
        //- AREA CHART -
        //--------------

        // Get context with jQuery - using jQuery's .get() method.
        var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
        // This will get the first returned node in the jQuery collection.
        var areaChart = new Chart(areaChartCanvas)

        var areaChartData = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [
                {
                    label: 'Electronics',
                    fillColor: 'rgba(210, 214, 222, 1)',
                    strokeColor: 'rgba(210, 214, 222, 1)',
                    pointColor: 'rgba(210, 214, 222, 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: [65, 59, 80, 81, 56, 55, 40]
                },
                {
                    label: 'Digital Goods',
                    fillColor: 'rgba(60,141,188,0.9)',
                    strokeColor: 'rgba(60,141,188,0.8)',
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: [28, 48, 40, 19, 86, 27, 90]
                }
            ]
        }

        var areaChartOptions = {
            //Boolean - If we should show the scale at all
            showScale: true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines: false,
            //String - Colour of the grid lines
            scaleGridLineColor: 'rgba(0,0,0,.05)',
            //Number - Width of the grid lines
            scaleGridLineWidth: 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines: true,
            //Boolean - Whether the line is curved between points
            bezierCurve: true,
            //Number - Tension of the bezier curve between points
            bezierCurveTension: 0.3,
            //Boolean - Whether to show a dot for each point
            pointDot: false,
            //Number - Radius of each point dot in pixels
            pointDotRadius: 4,
            //Number - Pixel width of point dot stroke
            pointDotStrokeWidth: 1,
            //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
            pointHitDetectionRadius: 20,
            //Boolean - Whether to show a stroke for datasets
            datasetStroke: true,
            //Number - Pixel width of dataset stroke
            datasetStrokeWidth: 2,
            //Boolean - Whether to fill the dataset with a color
            datasetFill: true,
            //String - A legend template
            legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
            //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: true,
            //Boolean - whether to make the chart responsive to window resizing
            responsive: true
        }

        //Create the line chart
        areaChart.Line(areaChartData, areaChartOptions)

        //-------------
        //- LINE CHART -
        //--------------
        var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
        var lineChart = new Chart(lineChartCanvas)
        var lineChartOptions = areaChartOptions
        lineChartOptions.datasetFill = false
        lineChart.Line(areaChartData, lineChartOptions)

        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        var pieChart = new Chart(pieChartCanvas)
        var PieData = [
            {
                value: 700,
                color: '#f56954',
                highlight: '#f56954',
                label: 'Chrome'
            },
            {
                value: 500,
                color: '#00a65a',
                highlight: '#00a65a',
                label: 'IE'
            },
            {
                value: 400,
                color: '#f39c12',
                highlight: '#f39c12',
                label: 'FireFox'
            },
            {
                value: 600,
                color: '#00c0ef',
                highlight: '#00c0ef',
                label: 'Safari'
            },
            {
                value: 300,
                color: '#3c8dbc',
                highlight: '#3c8dbc',
                label: 'Opera'
            },
            {
                value: 100,
                color: '#d2d6de',
                highlight: '#d2d6de',
                label: 'Navigator'
            }
        ]
        var pieOptions = {
            //Boolean - Whether we should show a stroke on each segment
            segmentShowStroke: true,
            //String - The colour of each segment stroke
            segmentStrokeColor: '#fff',
            //Number - The width of each segment stroke
            segmentStrokeWidth: 2,
            //Number - The percentage of the chart that we cut out of the middle
            percentageInnerCutout: 50, // This is 0 for Pie charts
            //Number - Amount of animation steps
            animationSteps: 100,
            //String - Animation easing effect
            animationEasing: 'easeOutBounce',
            //Boolean - Whether we animate the rotation of the Doughnut
            animateRotate: true,
            //Boolean - Whether we animate scaling the Doughnut from the centre
            animateScale: false,
            //Boolean - whether to make the chart responsive to window resizing
            responsive: true,
            // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: true,
            //String - A legend template
            legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        pieChart.Doughnut(PieData, pieOptions)

        //-------------
        //- BAR CHART -
        //-------------
        //         var barChartCanvas = $('#barChart').get(0).getContext('2d')
        //         var barChart = new Chart(barChartCanvas)
        //         // var barChartData = ["Ventes", "Cout", "Beneficie"];
        //         var barChartData = {
        //             labels: ["Ventes", "Cout", "Beneficie"],
        //             datasets: [
        //                 {
        //                     label: 'Electronics',
        //                     fillColor: 'rgba(210, 214, 222, 1)',
        //                     strokeColor: 'rgba(210, 214, 222, 1)',
        //                     pointColor: 'rgba(210, 214, 222, 1)',
        //                     pointStrokeColor: '#c1c7d1',
        //                     pointHighlightFill: '#fff',
        //                     pointHighlightStroke: 'rgba(220,220,220,1)',
        //                     data: [65, 59, 80, 81, 56, 55, 40]
        //                 },
        //                 {
        //                     label: 'Digital Goods',
        //                     fillColor: 'rgba(60,141,188,0.9)',
        //                     strokeColor: 'rgba(60,141,188,0.8)',
        //                     pointColor: '#3b8bba',
        //                     pointStrokeColor: 'rgba(60,141,188,1)',
        //                     pointHighlightFill: '#fff',
        //                     pointHighlightStroke: 'rgba(60,141,188,1)',
        //                     data: [28, 48, 40, 19, 86, 27, 90]
        //                 }
        //             ]
        //         }
        //         barChartData.datasets[0].data = [75, 45, 60, 70, 80, 65, 55];
        // barChartData.datasets[1].data = [30, 50, 35, 45, 60, 40, 55];
        //         barChartData.datasets[1].fillColor = '#00a65a'
        //         barChartData.datasets[1].strokeColor = '#00a65a'
        //         barChartData.datasets[1].pointColor = '#00a65a'
        //         var barChartOptions = {
        //             //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        //             scaleBeginAtZero: true,
        //             //Boolean - Whether grid lines are shown across the chart
        //             scaleShowGridLines: true,
        //             //String - Colour of the grid lines
        //             scaleGridLineColor: 'rgba(0,0,0,.05)',
        //             //Number - Width of the grid lines
        //             scaleGridLineWidth: 1,
        //             //Boolean - Whether to show horizontal lines (except X axis)
        //             scaleShowHorizontalLines: true,
        //             //Boolean - Whether to show vertical lines (except Y axis)
        //             scaleShowVerticalLines: true,
        //             //Boolean - If there is a stroke on each bar
        //             barShowStroke: true,
        //             //Number - Pixel width of the bar stroke
        //             barStrokeWidth: 2,
        //             //Number - Spacing between each of the X value sets
        //             barValueSpacing: 5,
        //             //Number - Spacing between data sets within X values
        //             barDatasetSpacing: 1,
        //             //String - A legend template
        //             legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
        //             //Boolean - whether to make the chart responsive
        //             responsive: true,
        //             maintainAspectRatio: true
        //         }

        //         barChartOptions.datasetFill = false
        //         barChart.Bar(barChartData, barChartOptions)
    })
</script>
<style type="text/css">
    .canvasjs-chart-credit {
        display: none;
    }

    /* .inverted-labels {
    display: flex;
    flex-direction: row-reverse;
} */
</style>
<?php $this->end(); ?>