<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Client $client
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<?php //echo $this->Html->script('salma'); ?>
<?php echo $this->Html->script('hechem'); ?>
<?php //echo $this->Html->script('dhouha'); ?>
<?php echo $this->Html->css('select2');
//echo $this->Html->css('vieww'); ?>
<style>
    .select2-selection__rendered {
        line-height: 31px !important;
    }

    .select2-container .select2-selection--single {
        height: 35px !important;
    }

    .select2-selection__arrow {
        height: 34px !important;
    }

    .select2-container {
        display: block;
        width: auto !important;
    }
</style>
<section class="content-header">

    <td colspan="3">
        <!-- <div style="float: left;font-size: 12px;margin-left:10px;"><strong> Modification tiers (prospect, client, fournisseur)
            </strong></div> -->
        <div style="float: right;font-size: 12px;margin-right:10px;">

            <ol class="breadcrumb">
                <li><a href="<?php echo $this->Url->build(['action' => 'indexall']); ?>"><i
                            class="fa fa-reply"></i>
                        <?php echo __('Retour'); ?></a></li>
            </ol>

            <?php ?>
        </div>
    </td>
</section>
<section class="content">
    <div class="row" style="font-size: 12px;">
        <div class="col-md-12" style="font-size: 12px;">
            <div class="box ">
                <div class="choisir" align="center" style="margin-left:50px; margin-top:20px;">
                    <button type="button" style="width: 160px;" data-toggle="tab" class="btn btn-primary btn-sm active "
                        onclick="afficherDiv('fiche')">Fiche </button>
                    <button type="button" style="width: 160px; " data-toggle="tab" class="btn btn-primary btn-sm"
                        onclick="afficherDiv('responsable')">Responsabilité</button>

                </div>
                <div class="column-responsive column-120">
                    <div class="box" style="margin-left: 10px;width: 98%;/*margin-top: 50px;*/background-color:#f3f4f7;">
                        <div class="box-body">
                            <?php include('fiche.php'); ?>
                            <?php include('listeprojet.php'); ?>
                            <?php include('modepaiement.php'); ?>
                            <?php include('contact.php'); ?>
                            <?php include('clienttttt.php'); ?>
                            <?php include('responsable.php'); ?>
                        </div>
                    </div>
                </div>
                <!-- <div class="row">


                    <div align="center">
                        <div class="pull-right" style="margin-right:40%;margin-bottom: 5%;">
                            <button type="submit" class="btn btn-primary" id="addclient">Créer Tiers</button>
                            <a href="<?php echo $this->Url->build(['action' => 'index', $dhouha]); ?>"
                                class="btn btn-primary">Annuler</a>
                        </div>
                    </div>
                </div> -->
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('[data-toggle="tab"]');
        buttons.forEach(button => {
            button.addEventListener('click', function () {

                // Désactiver tous les boutons
                buttons.forEach(btn => {
                    btn.classList.remove('active');
                });

                // Activer le bouton cliqué
                button.classList.add('active');
            });
        });

        // Gestionnaire d'événements global pour maintenir le bouton actif lors de clics en dehors
        document.addEventListener('click', function (event) {
            if (!event.target.matches('[data-toggle="tab"]')) {
                const activeButton = document.querySelector('.btn.active');
                if (activeButton) {
                    activeButton.classList.add('active');
                }
            }
        });
    });
    function afficherDiv(id) {
        // Masquer tous les divs
        const divs = document.getElementsByClassName('tab-content');

        for (let i = 0; i < divs.length; i++) {
            divs[i].style.display = 'none';
        }

        // Afficher le div correspondant
        document.getElementById(id).style.display = 'block';

    }
    $(function () {
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
            function (start, end) {
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