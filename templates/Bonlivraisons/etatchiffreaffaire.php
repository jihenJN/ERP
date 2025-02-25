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

<?php
echo $this->Html->css('select2');

use Cake\I18n\FrozenTime;
?>
<style>
    /* Define your table border style here */
    #example1 {
        border-collapse: collapse;
        /* Collapse borders to avoid double borders */
        border: 2px solid #000;
        /* Example: 2px solid black border */
    }

    #example1 th,
    #example1 td {
        border: 1px solid #000;
        /* Example: 1px solid black border for table cells */
        padding: 8px;
        /* Adjust cell padding as needed */
    }
</style>
<section class="content-header">
    <header>
        <h1 style="text-align:center;"> Chiffre d'affaire mensuelle par démarcheur</h1>
    </header>
</section>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-body">
                <?php echo $this->Form->create(null, ['type' => 'get']);
                ?>

                <div class="row">

                    <div class="col-xs-6">
                        <?php
                        date_default_timezone_set('Africa/Tunis');
                        // Définir la date de début sur le premier jour du mois
                        $datedebut = date('Y-01-01 00:00:00');
                        echo $this->Form->control('datedebut', [
                            'label' => 'Date début',
                            'value' => $datedebut,
                            'max' => $datedebut,
                            'type' => 'datetime',
                            'readonly' => 'readonly',
                            'empty' => 'Veuillez choisir !!',
                            'class' => 'form-control',
                            'required' => 'off'
                        ]);
                        ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        // Définir la date de fin sur le dernier jour du mois
                        $datefin = date('Y-12-t 23:59:59');
                        echo $this->Form->control('datefin', [
                            'label' => 'Date fin',
                            'value' => $datefin,
                            'max' => $datefin,
                            'type' => 'datetime',
                            'readonly' => 'readonly',
                            'empty' => 'Veuillez choisir !!',
                            'class' => 'form-control',
                            'required' => 'off'
                        ]);
                        ?>
                    </div>



                </div>



                <br>
                <div class="form-group">
                    <!-- <div class="col-lg-9 col-lg-offset-3"> -->
                        <div class="text-center">
                            <a onClick="openWindow(1000, 1000, wr+'bonlivraisons/impchiffreaffaire')">
                                <button class="btn btn-primary">Imprimer</button>
                            </a>
                            <?php echo $this->Html->link(__('Actualiser'), ['action' => '/etatchiffreaffaire'], ['class' => 'btn btn-primary ']) ?>

                        </div>
                    <!-- </div> -->

                </div>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>

<br><input type="hidden" id="page" value="1" />
<h3 style="margin-left: 5px ;">
    Etat Chiffre d'affaire
</h3>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <!-- <div class="ls-editable-table table-responsive ls-table"> -->

                <!-- <table class="table table-bordered table-striped table-bottomless" id="example1" border="1"> -->
                <table id="example1" class="table-fixed table table-bordered table-striped" style=' display: block;overflow-x: auto;white-space: nowrap;'>
                        <thead style='position: sticky;top: 0;'>
                    <!-- <thead> -->
                        <tr style="font-style: italic; font-weight: bold;">
                            <td> Démarcheur</td>
                            <?php foreach ($mois as $mm) : ?>
                                <td style="font-size: 16px;background-color: #4DAAA5; color: #000000; font-style: italic; font-weight: bold;" align="center"><?php echo $mm; ?></td>
                            <?php endforeach; ?>
                            <td style="font-style: italic; font-weight: bold;"> Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php //debug($mois);

                        $total = 0;
                        $totalm = 0;
                        $totalparmois = 0;

                        foreach ($personnels as $personnel) :
                            $personnel_id = $personnel->id;
                            // debug($personnel_id);die;
                        ?>
                            <tr>
                                <td style="background-color: #a9ba9d ; color: #000000;"><?php echo $personnel->nom; ?></td>

                                <?php
                                foreach ($moiss as $mois_id => $mm) :

                                    $mois = $mm->num;
                                    $annee_en_cours = date('Y');
                                    //debug($annee_en_cours);die;
                                    $date_debut = date('Y-m-01 00:00:00', mktime(0, 0, 0, $mois, 1, $annee_en_cours));
                                    $date_fin = date('Y-12-t 23:59:59', mktime(0, 0, 0, $mois, 1, $annee_en_cours));

                                    //    debug($date_debut);
                                    // debug($date_fin);die;

                                    $listebl = $connection->execute('SELECT SUM(totalttc) AS sumtotalttc FROM bonlivraisons 
                                    INNER JOIN users ON bonlivraisons.user_id = users.id
                                    WHERE MONTH(bonlivraisons.date) = ' . $mois . ' 
                                    AND bonlivraisons.typebl = 1 
                                    AND users.personnel_id = ' . $personnel_id . '
                                    AND bonlivraisons.date BETWEEN \'' . $date_debut . '\' AND \'' . $date_fin . '\'')
                                        ->fetchAll('assoc');

                                    $total = $total + $listebl[0]['sumtotalttc'];
                                    // Afficher le total pour chaque mois
                                    foreach ($listebl as $row) {

                                        $totalm =  $totalm +  $row['sumtotalttc'];
                                        echo "<td>" . $row['sumtotalttc'] . "</td>";
                                    }



                                ?>
                                <?php endforeach;
                                ?>

                                <td> <?php echo  $totalm;
                                        ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tr>
                        <td></td>

                        <?php
                        foreach ($moiss as $mois_id => $mm) :

                            $mois = $mm->num;
                            $annee_en_cours = date('Y');
                            //debug($annee_en_cours);die;
                            $date_debut = date('Y-m-01 00:00:00', mktime(0, 0, 0, $mois, 1, $annee_en_cours));
                            $date_fin = date('Y-12-t 23:59:59', mktime(0, 0, 0, $mois, 1, $annee_en_cours));

                            //    debug($date_debut);
                            // debug($date_fin);die;

                            $listebl2 = $connection->execute('SELECT SUM(totalttc) AS sumtotalttc FROM bonlivraisons 
                                    INNER JOIN users ON bonlivraisons.user_id = users.id
                                    WHERE MONTH(bonlivraisons.date) = ' . $mois . ' 
                                    AND bonlivraisons.typebl = 1 
                                   
                                    AND bonlivraisons.date BETWEEN \'' . $date_debut . '\' AND \'' . $date_fin . '\'')
                                ->fetchAll('assoc');

                            $totalparmois = $listebl2[0]['sumtotalttc'];
                            // Afficher le total pour chaque mois
                            foreach ($listebl as $row) {


                                echo "<td><strong>" .  $totalparmois . "</strong></td>";
                            }



                        ?>
                        <?php endforeach; ?>

                        <td><strong><?php echo $total; ?></strong></td>


                    </tr>
                </table>




                <!-- </div> -->
            </div>
        </div>
    </div>
</div>

<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-daterangepicker/daterangepicker', ['block' => 'css']); ?>
<!-- bootstrap datepicker -->
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min', ['block' => 'css']); ?>
<!-- iCheck for checkboxes and radio inputs -->
<?php echo $this->Html->css('AdminLTE./plugins/iCheck/all', ['block' => 'css']); ?>
<!-- Bootstrap Color Picker -->
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min', ['block' => 'css']); ?>
<!-- Bootstrap time Picker -->
<?php echo $this->Html->css('AdminLTE./plugins/timepicker/bootstrap-timepicker.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<!-- InputMask -->
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask.date.extensions', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask.extensions', ['block' => 'script']); ?>
<!-- date-range-picker -->
<?php echo $this->Html->script('AdminLTE./bower_components/moment/min/moment.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-daterangepicker/daterangepicker', ['block' => 'script']); ?>
<!-- bootstrap datepicker -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min', ['block' => 'script']); ?>
<!-- bootstrap color picker -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min', ['block' => 'script']); ?>
<!-- bootstrap time picker -->
<?php echo $this->Html->script('AdminLTE./plugins/timepicker/bootstrap-timepicker.min', ['block' => 'script']); ?>
<!-- iCheck 1.0.1 -->
<?php echo $this->Html->script('AdminLTE./plugins/iCheck/icheck.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>

<?php $this->start('scriptBottom'); ?>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {
            'placeholder': 'dd/mm/yyyy'
        })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {
            'placeholder': 'mm/dd/yyyy'
        })
        //Money Euro
        $('[data-mask]').inputmask()

        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            format: 'MM/DD/YYYY h:mm A'
        })
        //Date range as a button
        $('#daterange-btn').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function(start, end) {
                $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
        )

        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        })

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        })

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        //Timepicker
        $('.timepicker').timepicker({
            showInputs: false
        })
    })


    $(function() {
        $('#example2').DataTable()
        $('#example1').DataTable({
            'paging': false,
            'lengthChange': true,
            'searching': false,
            'ordering': false,
            'info': true,
            'autoWidth': false
        })
    })
</script>

<script>
    $(function() {



        $('.alertHisto').on('click', function() {

            d1 = $('#datedebut').val();
            d2 = $('#datefin').val();
            depot = $('#depot_id').val();
            article = $('#article_id').val();
            ///  client = $('#client_id').val();


            if (d1 == '') {
                alert("Veuillez choisir le date de début SVP !!")
                return false;

            } else if (d2 == '') {
                alert("Veuillez choisir le date du fin SVP !!")
                return false;

                // } else if (depot == '') {
                //     alert("Veuillez choisir un dépot SVP  !!")
                //     return false;

                // } else if (article == '') {
                //     alert("Veuillez choisir un article SVP  !!")
                //     return false;

            }
            //else if (client == '') {
            //     alert("Veuillez choisir un client SVP  !!")
            // }

        });
    })
</script>
<script>
    // $(function() {



    //     $('.alertdep').on('mouseover', function() {

    //         depot = $('#depot_id').val();
    //         article = $('#article_id').val();
    //         ///  client = $('#client_id').val();
    //         if (depot == '') {
    //             alert("Veuillez choisir un dépot SVP  !!")
    //         }
    //         //  else if (article == '') {
    //         //     alert("Veuillez choisir un article SVP  !!")
    //         // }


    //     });
    // })
</script>
<script>
    function openWindow(h, w, url) {
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }
</script>
<?php $this->end(); ?>
<script>
    function openWindow(h, w, url) {
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
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

    /* .inverted-labels {
    display: flex;
    flex-direction: row-reverse;
} */
</style>
<?php $this->end(); ?>