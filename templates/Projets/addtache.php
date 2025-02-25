<?php $this->layout = 'def'; ?>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Projet $projet
 */
?>
<section class="content-header">
    <h1>
        Nouvelle taches
    </h1>
    <!-- <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i>
        <?php echo __('Retour'); ?>
      </a></li>
  </ol> -->
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box ">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>
                </div>
                <?php echo $this->Form->create($tach, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('ref', ['class' => 'form-control ', 'champ' => 'ref', 'label' => 'Réf.']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('libelle', ['class' => 'form-control ', 'champ' => 'libelle', 'label' => 'Libellé.']); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('projet_id', ['value' => $project_id, 'class' => 'form-control select2', 'champ' => 'projet_id', 'label' => 'Fille du projet/tâche']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('progression_id', ['empty' => 'Veuillez choisir une pourcentage !!', 'required' => 'off', 'id' => 'date', 'class' => 'form-control select2', 'label' => 'Progression déclarée']); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('dated', ['required' => 'off', 'id' => 'date', 'type' => 'datetime', 'class' => 'form-control', 'label' => 'Date début']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('datefin', ['required' => 'off', 'id' => 'date', 'type' => 'datetime', 'class' => 'form-control', 'label' => 'Date fin']); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('description', ['required' => 'off', 'type' => 'textarea', 'id' => 'opportunite_id', 'class' => 'form-control', 'label' => 'Description']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('contact', ['required' => 'off', 'id' => 'contact', 'type' => 'textarea', 'class' => 'form-control', 'label' => 'Contact']); ?>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xs-3">
                            <label>Charge de travail prévue :</label>
                            <?php echo $this->Form->control('duree', ['required' => 'off', 'id' => 'duree', 'type' => 'number', 'class' => 'form-control', 'label' => '', 'placeholder' => 'Heures']); ?>
                            <?php echo $this->Form->control('dureem', ['required' => 'off', 'id' => 'dureem', 'type' => 'number', 'class' => 'form-control', 'label' => '', 'placeholder' => 'Minutes']); ?>
                        </div>
                    </div>

                    <div align="center">
                        <?php echo $this->Form->submit('Ajouter', ['id' => 'submitBtn']); ?>
                    </div>

                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
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
<!-- <script>
    document.getElementById('submitBtn').addEventListener('click', function(event) {
        var ref = document.getElementById('ref').value;
        var libelle = document.getElementById('libelle').value;
        var projetId = document.getElementById('projet_id').value;
        if (ref.trim() === '' || libelle.trim() === '' || projetId.trim() === '') {
            event.preventDefault();
            alert('Please fill in all required fields.');
        }
    });
</script> -->

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