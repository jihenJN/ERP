<?php
echo $this->Html->css('select2');

use Cake\Datasource\ConnectionManager;
use Cake\I18n\FrozenTime;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<section class="content-header">
    <header>
        <h1 style="text-align:center;"> Etat Echéance Clients </h1>
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
                <?php echo $this->Form->create($etatecheance, ['type' => 'get']);
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

                    <div class="col-xs-6">
                        <div id="" class="form-group input text required">
                            <?php

                            echo $this->Form->control('client_id', ['label' => 'Client ', 'options' => $clientss, 'id' => 'client_id', 'name' => 'client_id', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 ', 'value' => $this->request->getQuery('client_id')]);
                            ?>


                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div id="" class="form-group input text required">
                            <?php

                            echo $this->Form->control('paiement_id', ['label' => 'Réglement Par ', 'options' => $paiementss, 'id' => 'paiement_id', 'name' => 'paiement_id', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 ', 'value' => $this->request->getQuery('paiement_id')]);
                            ?>


                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div id="" class="form-group input text required">
                            <?php

                            echo $this->Form->control('banque_id', ['label' => 'Banque ', 'options' => $Banquess, 'id' => 'banque_id', 'name' => 'banque_id', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 ', 'value' => $this->request->getQuery('banque_id')]);
                            ?>


                        </div>
                    </div>
                </div>




                <br><br>

                <div class="form-group">
                    <div class="col-lg-9 col-lg-offset-3">
                        <button type="submit" style="background-color: #b768a2 ;border:#b768a2 ;" class="btn btn-primary" id="">Afficher</button>
                        <?php
                        // debug($depotalls);
                        if ($this->request->getQuery() != null) {
                        ?>

                            <a onclick="openWindow(1000, 1000, wr+'Factureclients/impetatechance?date1=<?php echo @$date1; ?>&date2=<?php echo @$date2; ?>&client_id=<?php echo @$client_id; ?>&paiement_id=<?php echo @$paiement_id; ?>&banque_id=<?php echo @$banque_id; ?>')"><button class="btn btn-primary " style="background-color: #b768a2 ;border:#b768a2 ;">Imprimer</button></a>
                            <?php //echo $this->Html->link(__(' '), ['action' => 'downloadexceldalanda?date1=' .  $this->request->getQuery('date1') . '&date1=' . $this->request->getQuery('date1') . '&date2=' . $this->request->getQuery('date2')  . ''], ['class' => 'btn btn-primary btn-sm , fa fa-file-excel-o text-white', 'style' => 'height: 33px; width:45px']) 
                            ?>


                        <?php  } else { ?>
                            <a onclick="openWindow(1000, 1000, wr+'Factureclients/impetatechance')"><button class="btn btn-primary " style="background-color: #b768a2 ;border:#b768a2 ;">Imprimer</button></a>
                            <?php //echo $this->Html->link(__(' '), ['action' => 'downloadexceldalanda?date1=' .  $this->request->getQuery('date1') . '&date1=' . $this->request->getQuery('date1') . '&date2=' . $this->request->getQuery('date2')  . ''], ['class' => 'btn btn-primary btn-sm , fa fa-file-excel-o text-white', 'style' => 'height: 33px; width:45px']) 
                            ?>
                        <?php   } ?>
                        <?php echo $this->Html->link(__('Actualiser'), ['action' => '/etatecheance'], ['class' => 'btn btn-primary ', 'style' => 'background-color: #b768a2 ;border:#b768a2 ;']) ?>




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
                                <th width="7%" align="center" style="text-align: center;background-color: #b768a2 ;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>Echéance</strong></span>
                                </th>
                                <th align="center" width="8%" style="text-align: center;background-color: #b768a2;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>Reg N°</strong></span>
                                </th>
                                <th align="center" width="15%" style="text-align: center;background-color: #b768a2;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>Client</strong></span>
                                </th>
                                <th align="center" width="10%" style="text-align: center;background-color: #b768a2;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>Date</strong></span>
                                </th>
                                <th align="center" width="5%" style="text-align: center;background-color: #b768a2;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>Banque</strong></span>
                                </th>
                                <th align="center" width="10%" style="text-align: center;background-color: #b768a2;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"> <strong>Nature</strong></span>
                                </th>
                                <th align="center" width="8%" style="text-align: center;background-color: #b768a2;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>N°</strong></span>
                                </th>
                                <th align="center" width="12%" style="text-align: center;background-color: #b768a2;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>Montant</strong></span>
                                </th>
                                <!-- <th align="center" width="12%" style="text-align: center;background-color: #b768a2;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>Ech.AU</strong></span>
                                </th> -->
                                <th align="center" width="3%" style="text-align: center;background-color: #b768a2;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>Ech.Au</strong></span>
                                </th>
                                <th align="center" hidden width="9%" style="text-align: center;background-color: #b768a2;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>Compte</strong></span>
                                </th>
                            </tr>

                        </thead>



                        <tbody>
                            <?php


                            if (!empty($tablignelachats)) {
                                $runningTotal = 0; 

                                foreach ($tablignelachats as $tab) :

                                    $runningTotal += $tab['Montantreg'];


                                    $connection = ConnectionManager::get('default');


                            ?>
                                    <tr>






                                        <td align="center">
                                            <?= $this->Time->format($tab['echance'], 'dd/MM/y'); ?> <br>

                                        </td>

                                        <td align="center">

                                            <?php
                                            echo  $tab['numero'];
                                            ?>

                                        </td>
                                        <td align="center">
                                            <?php
                                            echo  $tab['client'];
                                            ?>

                                        </td>
                                        <td align="center">
                                            <?php
                                            echo  $tab['date'];
                                            ?>
                                        </td>
                                        <td align="center">
                                            <?php echo  $tab['banque'];
                                            ?>
                                        </td>
                                        <td align="center">
                                            <?php echo  $tab['paiement']; ?>
                                        </td>
                                        <td align="center">
                                            <?php echo  $tab['num']; ?>
                                        </td>
                                        <td align="center">
                                            <?php echo  $tab['Montantreg']; ?>
                                        </td>

                                        <td align="center">
                                        <?php echo  $runningTotal;  ?>
                                        </td>


                                        <td align="center" hidden>
                                            <?php echo  $tab['compte']; ?>
                                        </td>



                                    </tr>
                            <?php endforeach;
                            }
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