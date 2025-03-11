<?php
echo $this->Html->css('select2');

use Cake\Datasource\ConnectionManager;
use Cake\I18n\FrozenTime;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<section class="content-header">
    <header>
        <h1 style="text-align:center;"> Journal de Vente </h1>
    </header>
</section>
<br>
<section class="content-header">
    <h1>
        Recherche
    </h1>
</section>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-body">
                <?php echo $this->Form->create($etatjournal, ['type' => 'get']);
                ?>
                <div class="row">

                    <div class="col-xs-6">
                        <?php

                        echo $this->Form->control('date1', array('value' => @$date1, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control datePickerOnly ', 'type' => 'date', 'label' => 'Date de'));
                        ?>

                    </div>


                    <div class="col-xs-6">

                        <?php
                        echo $this->Form->control('date2', array('value' => @$date2, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control datePickerOnly', 'type' => 'date', 'label' => "Jusqu'à "));

                        ?>

                    </div>

                    <!-- <div class="col-xs-6" hidden>
                        <div id="" class="form-group input text required">
                            <?php

                            // echo $this->Form->control('client_id', ['label' => 'Client ', 'options' => $clientss, 'id' => 'client_id', 'name' => 'client_id', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 ', 'value' => $this->request->getQuery('client_id')]); 
                            ?>


                        </div>
                    </div> -->

                </div>




                <br><br>

                <div class="form-group">
                    <div class="col-lg-9 col-lg-offset-3">
                        <button type="submit" style="background-color: #4DAAA5;border:#4DAAA5;" class="btn btn-primary" id="">Afficher</button>
                        <?php
                        // debug($depotalls);
                        if ($factureclients != null) {
                        ?>
                                                                                                                                                        ?>')"><button class="btn btn-primary ">Imprimer</button></a> -->

                            <a onclick="openWindow(1000, 1000, wr+'Factureclients/impetatjournal?date1=<?php echo @$date1; ?>&date2=<?php echo @$date2; ?>')"><button class="btn btn-primary " style="background-color: #4DAAA5;border:#4DAAA5;">Imprimer</button></a>
                            <?php ///echo $this->Html->link(__(' '), ['action' => 'downloadexceldalanda?date1=' .  $this->request->getQuery('date1') . '&date1=' . $this->request->getQuery('date1') . '&date2=' . $this->request->getQuery('date2')  . ''], ['class' => 'btn btn-primary btn-sm , fa fa-file-excel-o text-white', 'style' => 'height: 33px; width:45px']) 
                            ?>


                        <?php }  ?>
                        <?php echo $this->Html->link(__('Actualiser'), ['action' => '/etatjournal'], ['class' => 'btn btn-primary ', 'style' => 'background-color: #4DAAA5;border:#4DAAA5;']) ?>




                    </div>
                </div>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>
<br><input type="hidden" id="page" value="1" />
<h3 style="margin-left: 5px ;">
    Tous Les Clients
</h3>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <!-- overflow-y: auto;white-space: nowrap; height:400px  " -->
                <div class="ls-editable-table table-responsive ls-table" style="width:98%;">
                    <table class="table table-bordered table-striped table-bottomless">

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
                                <th colspan="3" align="center"  width="30%" style="text-align: center;background-color: #4DAAA5;">
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
    // $('.pourcentescompte').trigger('keyup');
    $(function() {
        $('#pointdevente_id').on('change', function() {
            //var idfamm = this.value;
            // alert('ddddddddd');
            var idfamm = $(this).val();

            // alert(idfamm) // Directly use the value without jQuery

            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Stockdepots', 'action' => 'getdepot']) ?>",
                dataType: "json",
                data: {
                    idfam: idfamm,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function(data) {
                    //  alert(data.select);
                    $('#divdepot').html(data.select);
                }
            });
        });
    });
    $(function() {

        $('#famille_id').on('change', function() {

            idfam = $('#famille_id').val();

            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Stockdepots', 'action' => 'getsousfamille1']) ?>",
                dataType: "json",
                data: {
                    idfam: idfam,

                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function(data) {
                    // alert(data.select1);
                    $('#divsousfam1').html(data.select);

                }

            })

        });
























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
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': false,
            'info': true,
            'autoWidth': false
        })
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