<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->fetch('script'); ?>
<section class="content-header">

    <h1>
        Ajout Transferts Caisse/Compte
        <small>
            <?php echo __(''); ?>
        </small>
    </h1>

    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i>
                <?php echo __('Retour'); ?>
            </a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>
                </div>
                <?php echo $this->Form->create($transferecaiss, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13",]); ?>
                <div class="box-body">
                    <div class="row">
                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('numero', ['readonly' => 'readonly', 'value' => $mm, 'label' => 'Numero', 'name', 'required' => 'off']); ?>
                                </div>
                                <!-- <div class="col-xs-6">
                                    <?php $dd = date('Y-m-d H-m-s'); ?>
                                    <?php echo $this->Form->control('date', ['label' => 'Date', 'style' => 'text-align:left', 'class' => 'form-control', 'id' => 'date', 'required' => 'off', 'type' => 'datetime']); ?>
                                </div> -->
                                <div class="col-xs-6">
                                    <?php
                                    date_default_timezone_set('Africa/Tunis');
                                    $now = date('Y-m-d H:i:s');
                                    echo $this->Form->control('date', ['value' => $now]);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                            <div class="row">
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('caisse_id', ['options' => $caisses, 'value' => 5, 'empty' => 'Veuillez choisir !!', 'id' => 'caisse_id', 'required' => 'off', 'label' => 'Caisse ', 'class' => 'form-control select2 control-label ']); ?>
                                </div>
                                <div class="col-xs-2">
                                    <?php echo $this->Form->control('soldecourant', ['readonly', 'id' => 'soldecourant', 'value' => $soldecourant, 'label' => 'Solde courant', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('compte_id', ['options' => $comptes, 'value' => 6, 'empty' => 'Veuillez choisir !!', 'id' => 'compte_id', 'required' => 'off', 'label' => 'Compte ', 'class' => 'form-control select2  control-label']); ?>
                                </div>
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('montant', ['id' => 'montant', 'value' => '', 'label' => 'Montant', 'name', 'required' => 'off']); ?>
                                </div>

                                <!-- 
                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('commandefournisseur_id', ['empty' => 'Veuillez choisir !!', 'id' => 'commandefournisseur_id', 'required' => 'off', 'label' => 'BC', 'class' => 'form-control select2 control-label']); ?>
                                </div>

                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('livraison_id', ['empty' => 'Veuillez choisir !!', 'id' => 'livraison_id', 'required' => 'off', 'label' => 'BL', 'class' => 'form-control select2 control-label']); ?>
                                </div> -->


                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('paiement_id', ['empty' => 'Veuillez choisir !!', 'id' => 'paiement_id', 'required' => 'off', 'label' => 'Mode de paiement', 'value' => 6, 'class' => 'form-control select2 control-label']); ?>
                                </div>
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('observation', ['label' => 'Observation', 'class' => 'form-control', 'type' => 'textarea']); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
                <div align="center">
                    <button type="submit" class="pull-right btn btn-success btn-sm " id="test" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</section>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    $(function() {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    })
    $('.select2').select2({
        width: '100%' // need to override the changed default
    });

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
</script>
<?php $this->end(); ?>
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
<script>
    $(document).ready(function() {
        $('.getmontant').trigger('change');
    });
    $(document).ready(function() {



        $("form").submit(function() {
            $('#test').attr('disabled', 'disabled');
        })
        // $(".getmontant").on("change", function() {
        //     // alert();
        //     getMontant();
        // });

        // function getMontant(id) {
        //     // alert();
        //     caisse_id = $("#caisse_id").val();
        //     // alert(caisse_id);
        //     if (caisse_id != "") {
        //         $.ajax({
        //             method: "GET",
        //             url: "<?= $this->Url->build(['controller' => 'Depenses', 'action' => 'getsolde']) ?>",
        //             dataType: "json",
        //             data: {
        //                 caisse_id: caisse_id,
        //             },
        //             headers: {
        //                 "X-CSRF-Token": $('meta[name="csrfToken"]').attr("content"),
        //             },
        //             success: function(data) {
        //                 $('#soldecourant').val(data.montant);
        //             },
        //         });
        //     } else {
        //         $('#montant').val("");
        //     }
        // }
        $("#test").on("mouseover", function() {
            date = $("#date").val();
            caisse_id = $("#caisse_id").val();
            id_caisse = $("#id_caisse").val();
            montant = $("#montant").val();


            if (date == "") {
                alert("veuillez choisir une date", function() {});
                return false;
            }
            if (caisse_id == "") {
                alert("veuillez choisir la caisse de départ", function() {});
                return false;
            }
            if (id_caisse == "") {
                alert("veuillez choisir la caisse de d'arrivé", function() {});
                return false;
            }
            if (id_caisse == caisse_id) {
                alert("veuillez choisir une autre caisse");
                return false;
            }
            if (montant == "") {
                alert("veuillez saisir le montant", function() {});
                return false;
            }
            if ($("#commandefournisseur_id").val() === "" && $("#livraison_id").val() === "") {
                alert("Veuillez choisir au moins un (BC ou BL)");
                return false;
            }
        });
    });
</script>
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
</script>

<?php $this->end(); ?>