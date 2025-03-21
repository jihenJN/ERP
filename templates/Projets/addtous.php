<?php $this->layout = 'def'; ?>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Client $client
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->script('hechem'); ?>
<?php echo $this->Html->script('dhouha'); ?>
<?php echo $this->Html->css('select2'); ?>
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
    <h1>

        Nouveau tiers (Prospect, Client, Fournisseur)
    </h1>
    <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'indexall']); ?>"><i class="fa fa-reply"></i>
        <?php echo __('Retour'); ?></a></li>
  </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box ">
                <?php echo $this->Form->create($client, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13", 'type' => 'file']); ?>
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('nom', ['class' => 'form-control', 'label' => 'Nom du tiers']); ?>
                            </div>
                            <div class="col-xs-6">
                            <?php echo $this->Form->control('Raison_Sociale', ['class' => 'form-control', 'label' => 'Nom alternatif (commercial, marque, ...)']); ?>
                        </div>
                       
                    </div>
                </div>
<!--                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('Raison_Sociale', ['class' => 'form-control', 'label' => 'Nom alternatif (commercial, marque, ...)']); ?>
                        </div>
                    </div>
                </div>-->
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('prospect_id', ['empty' => 'Veuillez choisissez !!!!', 'class' => 'form-control select2', 'label' => 'Prospect / Client']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('codeclient', ['class' => 'form-control', 'label' => 'Code client']); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <span><strong>Fournisseur</strong></span>
                            <select name="fournisseur" class="form-control select2 control-label" id="fournisseur">
                                <option value="">Veuillez choisir !!</option>
                                <option value="1">OUI </option>
                                <option value="0">NON</option>

                            </select>
                            <?php //echo $this->Form->control('fournisseur', ['class' => 'form-control select2', 'label' => 'Fournisseur']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('codefr', ['class' => 'form-control', 'label' => 'Code fournisseur']); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <span><strong>Etats</strong></span>
                            <select name="etat" class="form-control select2 control-label" id="etat">
                                <option value="">Veuillez choisir !!</option>
                                <option value="0">Clos </option>
                                <option value="1">Ouvert</option>

                            </select>
                            <?php //echo $this->Form->control('etat', ['class' => 'form-control', 'label' => 'Etats']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('devise_id', ['empty' => 'Veuillez choisissez devise !!!!', 'class' => 'form-control select2', 'label' => 'Devise']); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('Adresse', ['type' => 'textarea', 'class' => 'form-control', 'label' => 'Adresse']); ?>
                        </div>
                           <div class="col-xs-6">
                            <?php echo $this->Form->control('port', ['type' => 'textarea', 'class' => 'form-control', 'label' => 'Port']); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('Code', ['class' => 'form-control', 'label' => 'Code Postal']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('Code_Ville', ['label' => 'Ville', 'class' => 'form-control']); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                        <div class="col-xs-6">
                            <?php echo $this->Form->control('pay_id', ['label' => 'Pays', 'empty' => 'Veuillez choisir !!', 'id' => 'pay_id', 'class' => 'form-control select2 control-label pays']); ?>
                        </div>
                        <div class="col-xs-6" id="divgouv">
                            <?php echo $this->Form->control('gouvernorat_id', ['label' => 'Département / Canton', 'id' => 'gouvernorat', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 control-label gouv']); ?>
                        </div>
                    </div>
                </div>
<!--                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6" id="divgouv">
                            <?php echo $this->Form->control('gouvernorat_id', ['label' => 'Département / Canton', 'id' => 'gouvernorat', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 control-label gouv']); ?>
                        </div>
                    </div>
                </div>-->
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('Tel', ['class' => 'form-control', 'type' => 'text', 'label' => 'Telephone']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('Fax', ['label' => 'Fax', 'class' => 'form-control']); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('Email', ['class' => 'form-control', 'type' => 'text', 'label' => 'Email']); ?>
                        </div>
                         <div class="col-xs-6">
                            <?php echo $this->Form->control('Contact', ['class' => 'form-control', 'type' => 'text', 'label' => 'Web']); ?>
                        </div>
                    </div>
                </div>
<!--                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('Contact', ['class' => 'form-control', 'type' => 'text', 'label' => 'Web']); ?>
                        </div>
                    </div>
                </div>-->
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('RC', ['class' => 'form-control', 'type' => 'text', 'label' => 'Id. prof. 1 (RC)']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('Matricule_Fiscale', ['label' => 'Id. prof. 2 (Matricule fiscal)', 'class' => 'form-control']); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('codedouane', ['class' => 'form-control', 'type' => 'text', 'label' => 'Id. prof. 3 (Code en douane)']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('BAN', ['label' => 'Id. prof. 4 (BAN)', 'class' => 'form-control']); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <span><strong>Assujetti à la TVA</strong></span>
                            <select name="R_TVA" class="form-control select2 control-label" id="R_TVA">
                                <option value="">Veuillez choisir !!</option>
                                <option value="1">OUI </option>
                                <option value="0">NON</option>

                            </select>
                            <?php //echo $this->Form->control('R_TVA', ['class' => 'form-control', 'type' => 'text', 'label' => 'Assujetti à la TVA']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('numerotva', ['label' => 'Numéro de TVA', 'class' => 'form-control']); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('typetier_id', ['empty' => 'Veuillez choisissez Type tier !!!!', 'class' => 'form-control select2', 'label' => 'Type du tiers']); ?>
                        </div>
                        <div class="col-xs-6">

                            <?php echo $this->Form->control('salari_id', ['empty' => 'Veuillez choisissez !!!!', 'label' => 'Salariés', 'class' => 'form-control select2']); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('typeentite_id', ['empty' => 'Veuillez choisissez !!!!', 'class' => 'form-control select2', 'label' => 'Type d\'entité légale']); ?>
                        </div>
                         <div class="col-xs-6">
                            <?php echo $this->Form->control('Capital', ['class' => 'form-control', 'type' => 'text', 'label' => 'Capital']); ?>
                        </div>
                    </div>
                </div>
<!--                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('Capital', ['class' => 'form-control', 'type' => 'text', 'label' => 'Capital']); ?>
                        </div>
                    </div>
                </div>-->
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('incoterm_id', ['empty' => 'Veuillez choisissez !!!!', 'class' => 'form-control select2', 'label' => 'Incoterms']); ?>
                        </div>
                          <div class="col-xs-6">
                            <?php echo $this->Form->control('tag_id', ['class' => 'form-control select2 control-label ', 'label' => 'Tags clients/prosp.']); ?>
                        </div>
                    </div>
                </div>
<!--                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('tag_id', ['class' => 'form-control select2 control-label ', 'label' => 'Tags clients/prosp.']); ?>
                        </div>
                    </div>
                </div>-->
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                       
                         <div class="col-xs-6">
                            <?php echo $this->Form->control('commercial_id', ['empty' => 'Veuillez choissisez un commercial', 'class' => 'form-control select2', 'label' => 'Affecter un commercial']); ?>
                        </div>
                         <div class="col-xs-6">
                            <?php echo $this->Form->control('logo', ['class' => 'form-control', 'type' => 'file', 'label' => 'Logo']); ?>
                        </div>
                    </div>
                </div>
<!--                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-12">
                            <?php echo $this->Form->control('port', ['type' => 'textarea', 'class' => 'form-control', 'label' => 'Port']); ?>
                        </div>
                    </div>
                </div>-->
<!--                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-12">
                            <?php echo $this->Form->control('commercial_id', ['empty' => 'Veuillez choissisez un commercial', 'class' => 'form-control', 'label' => 'Affecter un commercial']); ?>
                        </div>
                    </div>
                </div>-->
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                      
                    </div>
                </div>
                <div align="center">

                    <!-- <button type="submit" class="pull-right btn btn-primary btn-sm  chauff" id="addclient"
                        style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
                        <button  class="pull-right btn btn-primary btn-sm" 
                        style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button> -->

                    <div class="pull-right" style="margin-right:40%;margin-top: 20px;">
                        <button type="submit" class="btn btn-primary" id="addclient">Créer Tiers</button>
                        <a href="<?php echo $this->Url->build(['action' => 'indexall']); ?>"
                            class="btn btn-primary">Retour</a>
                    </div>
                </div>
                <?php /* echo $this->Form->submit(__('Enregistrer')); */?>

                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">

    $('#code').on('keyup', function () {
        code = $('#code').val();
        $('#compte').val(code);
    })




    $(function () {
        $('.pays').on('change', function () {
            // alert('hello');
            id = $('#pay_id').val();
            // alert(id)
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Clients', 'action' => 'getgouv']) ?>",
                dataType: "json",
                data: {
                    id: id,

                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (data) {
                    //alert(data.select);
                    $('#divgouv').html(data.select);
                    $('#gouvernorat').select2();
                    // uniform_select('sousfamille1_id');


                }

            })

        });
    }); 







</script>

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