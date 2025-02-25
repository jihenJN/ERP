<?php

use Cake\Datasource\ConnectionManager;

?>
<?php
$add = "";
$edit = "";
$delete = "";
$view = "";
$session = $this->request->getSession();
$abrv = $session->read('abrvv');
$lien = $session->read('lien_projet' . $abrv);
//debug($lien);die;
foreach ($lien as $k => $liens) {
    if (@$liens['lien'] == 'etat') {
        $add = $liens['ajout'];
        $edit = $liens['modif'];
        $delete = $liens['supp'];
    }
    //debug($liens);die;
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('dhouha'); ?>
<?php echo $this->Html->script('js_vieww_projet'); ?>

<section class="content-header">
    <br>
    <br>
    <h1 align="center"> Etat Finance du projet </h1>
    <br>
    <br>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box ">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>
                </div>
                <?php echo $this->Form->create($projet, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('projet_id', ['empty' => 'Veuillez choissir un projet ...', 'class' => 'form-control select2', 'champ' => 'projet', 'id' => 'projet_id', 'label' => 'Projet']); ?>
                        </div>
                    </div>
                    <div align="center">
                        <?php echo $this->Form->submit('Consulter', ['id' => 'form']); ?>
                    </div>
                    <br>
                    <br>
                    <div class="row" id="blocaa">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        Suivi Facture Client
                                    </h3>
                                </div>
                                <div class="panel-body">
                                    <div class="ls-editable-table table-responsive ls-table">
                                        <table class="table table-bordered table-striped table-bottomless tablemulti">
                                            <thead>
                                                <tr>

                                                    <th width="7%">
                                                        <?php echo "Numero" ?>
                                                    </th>
                                                    <th width="10%">
                                                        <?php echo "Date" ?>
                                                    </th>
                                                    <th width="10%">
                                                        <?php echo "Client" ?>
                                                    </th>
                                                    <th width="10%">
                                                        <?php echo "Montant" ?>
                                                    </th>
                                                    <th width="10%">
                                                        <?php echo "Montant Regler" ?>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($factureclients as $j => $factureclient) { //dd( . $factureclient->client_id);
                                                    $connection = ConnectionManager::get('default');

                                                    $client = $connection->execute('SELECT * FROM clients WHERE id = ' . $factureclient->client_id)->fetchAll('assoc');

                                                    // dd($client);
                                                ?>
                                                    <tr>
                                                        <td class="afficherFCetatfinance" index="<?php echo $factureclient['id']; ?>">
                                                            <?php echo h($factureclient->numero) ?>
                                                        </td>
                                                        <td class="afficherFCetatfinance" index="<?php echo $factureclient['id']; ?>">
                                                            <?php echo h($factureclient->date->format('d/m/Y')) ?>
                                                        </td>
                                                        <td class="afficherFCetatfinance" index="<?php echo $factureclient['id']; ?>">
                                                            <?php echo h($client[0]['Raison_Sociale']) ?>
                                                        </td>
                                                        <td class="afficherFCetatfinance" index="<?php echo $factureclient['id']; ?>">
                                                            <?php echo h($factureclient->totalttc) ?>
                                                        </td>
                                                        <td class="afficherFCetatfinance" index="<?php echo $factureclient['id']; ?>">
                                                            <?php echo h($factureclient->Montant_Regler) ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <br><br><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        Suivi Facture Achat
                                    </h3>
                                </div>
                                <div class="panel-body">
                                    <div class="ls-editable-table table-responsive ls-table">
                                        <table class="table table-bordered table-striped table-bottomless">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <?php echo "Numero" ?>
                                                    </th>
                                                    <th>
                                                        <?php echo "Date" ?>
                                                    </th>
                                                    <th>
                                                        <?php echo "Fournisseur" ?>
                                                    </th>
                                                    <th>
                                                        <?php echo "Montant" ?>
                                                    </th>
                                                    <th>
                                                        <?php echo "Montant Regler" ?>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($factures as $i => $facture) { //dd($facture);
                                                    $connection = ConnectionManager::get('default');
                                                    // $client = $connection->execute('SELECT * FROM clients where clients.id = ' . $boncommande->client_id)->fetchAll('assoc');
                                                    $fournisseur = $connection->execute('SELECT * FROM fournisseurs where id = ' . $facture->fournisseur_id)->fetchAll('assoc');
                                                    // debug($fournisseur);
                                                ?>
                                                    <tr>
                                                        <td class="afficherFFetatfinance" index="<?php echo $facture['id']; ?>">
                                                            <?php echo h($facture->numero) ?>
                                                        </td>
                                                        <td class="afficherFFetatfinance" index="<?php echo $facture['id']; ?>">
                                                            <?php echo h($facture->date->format('d/m/Y')) ?>
                                                        </td>
                                                        <td class="afficherFFetatfinance" index="<?php echo $facture['id']; ?>">
                                                            <?php echo h($fournisseur[0]['name']) ?>
                                                        </td>
                                                        <td class="afficherFFetatfinance" index="<?php echo $facture['id']; ?>">
                                                            <?php echo h($facture->ttc) ?>
                                                        </td>
                                                        <td class="afficherFFetatfinance" index="<?php echo $facture['id']; ?>">
                                                            <?php echo h($facture->Montant_Regler) ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <br><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->
</section>
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

<?php $this->start('scriptBottom'); ?>
<style>
    .select2-selection__rendered {
        line-height: 25px !important;
    }

    .select2-container .select2-selection--single {
        height: 35px !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        border-color: #D2D6DE !important;
    }

    .select2-selection__arrow {
        height: 34px !important;
    }

    .select2-selection__choice {
        height: 24px !important;
        color: black !important;
        background-color: white !important;
        font-size: 18px !important;
    }

    .select2-container {
        display: block;
        width: auto !important;
    }
</style>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {
            'placeholder': 'dd/mm/yyyy'
        })
        // $("#verifenr").on("mouseover", function () {
        //   client_id = $("#client_id").val();//alert(client_id)
        //   opportunite_id = $("#opportunite_id").val();
        //   if (client_id == "") {
        //     alert("Veuillez choisir un tier !!", function () { });
        //     return false;
        //   } if (opportunite_id == "") {
        //     alert("Veuillez choisir une Statut opportunit� !!", function () { });
        //     return false;
        //   }
        // });
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
</script>
<?php $this->end(); ?>