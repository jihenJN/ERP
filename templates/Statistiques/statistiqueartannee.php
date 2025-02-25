<!-- Content Header (Page header) -->
<!--  <section class="content-header">
      <h1>
        ChartJS
        <small>Preview sample</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Charts</a></li>
        <li class="active">ChartJS</li>
      </ol>
    </section>
 -->
<!-- Main content -->




<?php echo $this->Html->css('select2');
?>

<?php

use Cake\Datasource\ConnectionManager;

$connection = ConnectionManager::get('default'); ?>
<script type="text/javascript" src="js/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<section class="content" style="width: 99%">
    <div class="box">
        <div class="box-header">
        </div>

        <div class="box-body">

            <?php        //echo $datedebut;
            echo $this->Form->create($factureclients, ['type' => 'get']); ?>
            <div class="row">


                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">


                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('anneedebut', ['label' => 'Année debut', 'options' => $anneess, 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2', 'required' => 'off', 'value' => $this->request->getQuery('anneedebut')]); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('anneefin', ['label' => 'Année fin', 'options' => $anneess, 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2', 'required' => 'off', 'value' => $this->request->getQuery('anneefin')]); ?>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">



                        <div class="col-xs-6">
                            <div class="form-group input select required">

                                <label class="control-label" for="depot-id">Articles</label>

                                <select name="article_id" id="article_id" class="form-control select2 control-label ">
                                    <option value="" selected="selected">Veuillez choisir !!</option>

                                    <?php foreach ($articles as $id => $articlee) {
                                    ?>
                                        <option value="<?php echo $articlee->id; ?>" <?php if ($this->request->getQuery('article_id') == $articlee->id) { ?> selected <?php } ?>>
                                            <?php echo $articlee->Code . ' ' . $articlee->Dsignation ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group input select required">

                                <label class="control-label" for="">Clients</label>

                                <select name="client_id" id="client_id" class="form-control select2 control-label " value='<?php $this->request->getQuery('client_id') ?>'>
                                    <option value="" selected="selected">Veuillez choisir !!</option>

                                    <?php foreach ($clients as $id => $cl) {
                                    ?>
                                        <option value="<?php echo $cl->id; ?>" <?php if ($client_id == $cl->id) { ?> selected <?php } ?>>
                                            <?php echo $cl->Code . ' ' . $cl->Raison_Sociale ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php //echo $this->Form->control('client_id', ['class' => 'form-control select2 control-label', 'label' => 'Client', 'value' => $this->request->getQuery('client_id'), 'empty' => 'Veuillez choisir !!', 'required' => 'off']); 
                            ?>


                        </div>

                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('moi_id', ['label' => 'Mois', 'options' => $moiss, 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2', 'required' => 'off', 'value' => $this->request->getQuery('moi_id')]); ?>
                        </div>

                    </div>
                </div>
            </div>

            <br><br>
            <div style="text-align:center">
                <button type="submit" class="btn btn-primary ">Afficher</button>
                <a href="<?php echo $this->Url->build(['action' => 'statistiqueartannee']); ?>" class="btn btn-primary"> Afficher tous</a>
                <!-- <a onclick="openWindow(1000, 1000, '/ERP/statistiques/imprimestatistiqueartclient?datedebut=<?php echo @$datedebut; ?>&datefin=<?php echo @$datefin; ?>&client_id=<?php echo @$this->request->getQuery('client_id'); ?>&article_id=<?php echo @$this->request->getQuery('article_id'); ?>')"
                    class="btn btn-primary">Imprimer</a> -->
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
                    <h3 class="box-title">Etat CA Article/Année</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>

                <div class="box-body" style="height:500px;overflow: auto;">
                    <div class="table-responsive">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr align="center">
                                    <th style='background-color: #3c8dbc;color: white;font-size: 14px; text-align: center;'>Mois/Année</th>
                                    <?php foreach ($annees as $annee => $aa) : ?>
                                        <th style='background-color: #3c8dbc;color: white;font-size: 14px; text-align: center;'><strong><?php echo $aa; ?></strong></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($mois as $m => $moi) :
                                    // debug($m); 
                                ?>
                                    <tr>
                                        <td style='color: #a52a2a;font-size: 14px;'><strong><?php echo $moi; ?><strong></td>
                                        <?php foreach ($annees as $a => $annee) : ?>
                                            <td align="center">
                                                <?php
                                                $ca = 0;

                                                foreach ($tabs as $tab) {

                                                    $tab_mois = date('m', strtotime($tab['date']));
                                                    $tab_annee = date('Y', strtotime($tab['date']));

                                                    if ($tab_mois == $m && $tab_annee == $annee) {

                                                        $ca += $tab['ttc'];
                                                    }
                                                }
                                                echo $ca;
                                                ?>
                                            </td>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>


                </div>
                <!-- /.box-body -->
            </div>


        </div>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">vente article par moins</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="chart">
                        <canvas id="barChart" style="height:230px"></canvas>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>


        </div>
        <div class="col-md-6">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Statistique <?php echo $adeb->name; ?></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <canvas id="pieChart" style="height:250px"></canvas>
                </div>
            </div>
        </div>
        <?php
        // Initialize $totalCA variable
        $totalCA = 0;

        // Check if $tabs array is not empty
        if (!empty($tabs)) {
            // Calculate the total CA from the $tabs array
            $totalCA = array_sum(array_column($tabs, 'ttc'));
        }

        // Define colors for the Pie chart
        $colors = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#ca1f7b', '#008b8b', '#2a8000', '#9acd32', '#ff7f50', '#b94e48'];

        // Initialize PieData array
        $PieData = [];

        // Define an associative array to map month names to their numeric representations
        $monthMap = [
            'janvier' => '01',
            'février' => '02',
            'mars' => '03',
            'avril' => '04',
            'mai' => '05',
            'juin' => '06',
            'juillet' => '07',
            'aout' => '08',
            'septembre' => '09',
            'octobre' => '10',
            'novembre' => '11',
            'décembre' => '12'
        ];

        // Loop through each month in $moiss
        foreach ($moiss as $m) {
            // Initialize CA for the current month
            $ca = 0;

            // Convert month name to numeric format using the $monthMap array
            $monthNumeric = isset($monthMap[strtolower($m)]) ? (int)$monthMap[strtolower($m)] : 0;
           // debug($monthNumeric);
            // Loop through $tabs to calculate CA for the current month
            foreach ($tabs as $tab) {
                $tab_mois = date('m', strtotime($tab['date']));
                // Compare the numeric month extracted from the date with the numeric month of the current month
                if ($tab_mois == $monthNumeric) {
                    $ca += $tab['ttc'];
                }
            }

            // Calculate the percentage value for the current month
            $value = ($totalCA > 0) ? round(($ca / $totalCA) * 100, 2) : 0;

            // Ensure $monthNumeric is within the range of available colors
            $colorIndex = ($monthNumeric - 1) % count($colors); // Use modulo operator to ensure index is within range
            $color = $colors[$colorIndex];

            // Construct data for the current month
            $data = [
                'value' => $value,
                'color' => $color,
                'highlight' => $color,
                'label' => $m
            ];

            // Add the data to PieData array
            $PieData[] = $data;
        }
        ?><?php
    // Initialize $totalCA variable
    $totalCA = 0;

    // Check if $tabs array is not empty
    if (!empty($tabs)) {
        // Calculate the total CA from the $tabs array
        $totalCA = array_sum(array_column($tabs, 'ttc'));
    }

    // Define colors for the Pie chart
    $colors = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#ca1f7b', '#008b8b', '#2a8000', '#9acd32', '#ff7f50', '#b94e48'];

    // Initialize PieData array
    $PieData = [];

    // Define an associative array to map month names to their numeric representations
    $monthMap = [
        'janvier' => '01',
        'février' => '02',
        'mars' => '03',
        'avril' => '04',
        'mai' => '05',
        'juin' => '06',
        'juillet' => '07',
        'août' => '08',
        'septembre' => '09',
        'octobre' => '10',
        'novembre' => '11',
        'décembre' => '12'
    ];

    // Loop through each month in $moiss
    foreach ($moiss as $m) {
        // Initialize CA for the current month
        $ca = 0;

        // Convert month name to numeric format using the $monthMap array
        $monthNumeric = isset($monthMap[strtolower($m)]) ? (int)$monthMap[strtolower($m)] : 0;

        // Loop through $tabs to calculate CA for the current month
        foreach ($tabs as $tab) {
            $tab_mois = date('m', strtotime($tab['date']));
            // Compare the numeric month extracted from the date with the numeric month of the current month
            if ($tab_mois == $monthNumeric) {
                $ca += $tab['ttc'];
            }
        }

        // Calculate the percentage value for the current month
        $value = ($totalCA > 0) ? round(($ca / $totalCA) * 100, 2) : 0;
        // debug($value);
        // Ensure $monthNumeric is within the range of available colors
        $colorIndex = ($monthNumeric) % count($colors); // Use modulo operator to ensure index is within range
        $color = $colors[$colorIndex];

        // Construct data for the current month
        $data = [
            'value' => $value,
            'color' => $color,
            'highlight' => $color,
            'label' => $m
        ];

        // Add the data to PieData array
        $PieData[] = $data;
        // debug($PieData);
    }
    ?>





    </div>
    <!-- /.row -->

</section>

<script>
    function openWindow(h, w, url) {
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var pieChartCanvas = document.getElementById('pieChart');
        var ctx = pieChartCanvas.getContext('2d');

        var pieData = <?php echo json_encode($PieData); ?>;

        var pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                datasets: [{
                    data: pieData.map(function(data) {
                        return data.value;
                    }),
                    backgroundColor: pieData.map(function(data) {
                        return data.color;
                    }),
                    hoverBackgroundColor: pieData.map(function(data) {
                        return data.highlight;
                    })
                }],
                labels: pieData.map(function(data) {
                    return data.label;
                })
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: true,
                    position: 'right'
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var dataset = data.datasets[tooltipItem.datasetIndex];
                            var label = data.labels[tooltipItem.index] || '';
                            var value = dataset.data[tooltipItem.index] || '';

                            return label + ': ' + value + '%';
                        }
                    }
                }
            }
        });
    });
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

    /* .inverted-labels {
    display: flex;
    flex-direction: row-reverse;
} */
</style>
<?php $this->end(); ?>