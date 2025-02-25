<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('controle_frs'); ?>
<?php echo $this->Html->css('select2'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Validation de la Commande Achat
    <small><?php echo __(''); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index/' . $type]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box">
        <div class="box-header with-border">

          <section>
            <?php echo $this->Form->create($commande, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
            <div class="box-body">
              <div class="row">
                <div class="row">
                  <div class="col-xs-6">
                    <?php
                    echo $this->Form->control('num', ['name' => 'num', 'label' => 'Numero', 'id' => 'num', 'value' => $numero['num'], 'readonly' => 'readonly']);
                    ?>
                  </div>


                  <div class="col-xs-6">
                    <?php
                    echo $this->Form->control('date', ['name' => 'date', 'readonly' => 'readonly', 'value' => $date, 'label' => 'Date', 'id' => 'datecommande', 'class' => "form-control pull-right"]);
                    echo $this->Form->input('id', array('div' => 'form-group', 'type' => 'hidden', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));                                    ?>
                  </div>
                </div>



                <div class="row">

                  <div class="col-xs-6">
                    <?php echo $this->Form->control('depot_id', ['options' => $depot, 'label' => 'Depot', 'class' => 'form-control select2 control-label', 'id' => 'depot_id']); ?>
                  </div>

                  <div class="col-xs-6">
                    <?php
                    echo $this->Form->control('fournisseur_id', ['readonly' => 'readonly', 'options' => $fournisseurs, 'class' => 'form-control select2 control-label',]);
                    ?>
                  </div>
                </div>

              </div>
            </div>
          </section>






          <section class="content-header">
            <h1 class="box-title"><?php echo __(' Les articles commandés'); ?></h1>
          </section>

          <section class="content" style="width: 99%">
            <div class="row">
              <div class="box">
                <div class="panel-body">
                  <div class="table-responsive ls-table">
                    <table class="table table-bordered table-striped table-bottomless" id="tabligne0">
                      <thead>
                        <tr>
                          <td align="center" style="width: 15%;"><strong> Code</strong></td>
                          <td align="center" style="width: 25%;"><strong> Designation</strong></td>

                          <!--                                                   <td align="center" style="width: 10%;"><strong>Code fournisseur</strong></td>-->
                          <td align="center" style="width: 10%;"><strong>Quantite</strong></td>
                          <td align="center" style="width: 10%;"><strong>PrixHT</strong></td>
                          <td align="center" style="width: 10%;"><strong>PUNHT</strong></td>
                          <td align="center" style="width: 5%;"><strong>Remise</strong></td>
                          <td align="center"  hidden style="width: 5%;"><strong>Fodec</strong></td>
                          <td align="center" style="width: 5%;"><strong>Tva</strong></td>
                          <td align="center" style="width: 10%;"><strong>TTC</strong></td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = -1;
                        $totht = 0;
                        $totttc = 0;
                        //                                     debug($lignes);
                        foreach ($lignes as $i => $ligne) {
                          //debug($ligne);
                          $totht = $totht + $ligne['ht'];
                          $totttc = $totht + $ligne['ttc'];
                          //debug($ligne);
                        ?>
                          <tr>

                            <td align="center">
                              <?php echo $this->Form->input('sup0', array('name' => 'data[ligner][' . $i . '][sup0]', 'id' => 'sup0' . $i, 'champ' => 'sup0', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                              ?>
                              <?php
                              echo $this->Form->input('id', array('value' => $ligne['id'], 'label' => '', 'name' => 'data[ligner][' . $i . '][id]', 'id' => 'id' . $i, 'champ' => 'id', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden'));
                              echo $this->Form->input('article_id', array('value' => $ligne['article']['id'], 'label' => '', 'name' => 'data[ligner][' . $i . '][article_id]', 'id' => 'article_id' . $i, 'champ' => 'article_id', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden'));
                              echo $this->Form->input('designiationA', array('readonly' => 'readonly', 'value' => $ligne['article']['Code'], 'label' => '', 'name' => 'data[ligner][' . $i . '][designiationA]', 'id' => 'designiationA' . $i, 'champ' => 'designiationA', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                              ?>
                            </td>
                            
                            <td align="center">
                             <?php echo $this->Form->input('designiationA', array('readonly' => 'readonly', 'value' => $ligne['article']['Dsignation'], 'label' => '', 'name' => 'data[ligner][' . $i . '][designiationA]', 'id' => 'designiationA' . $i, 'champ' => 'designiationA', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                              ?>
                            </td>
                            <!--                                <td align="center">
                                    <?php
                                    //echo $this->Form->input('codefrs',array('value'=>$ligne['codefrs'],'label'=>'','name'=>'data[ligner]['.$i.'][codefrs]','id'=>'codefrs'.$i,'champ'=>'codefrs','table'=>'ligner','index'=>$i,'div'=>'form-group','between'=>'<div class="col-sm-12">','after'=>'</div>','class'=>'form-control') );
                                    ?>
                                </td>-->
                            <td align="center">
                              <?php
                              echo $this->Form->input('qte', array('value' => $ligne['qte'], 'label' => '', 'name' => 'data[ligner][' . $i . '][qte]', 'id' => 'qte' . $i, 'champ' => 'qte', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc'));
                              ?>
                            </td>
                            <td align="center">
                              <?php
                              echo $this->Form->input('prix', array('value' => $ligne['prix'], 'label' => '', 'name' => 'data[ligner][' . $i . '][prix]', 'id' => 'prix' . $i, 'champ' => 'prix', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc'));
                              ?>
                            </td>
                            <td align="center">
                              <?php
                              echo $this->Form->input('punht', array('value' => $ligne['ht'], 'readonly' => 'readonly', 'label' => '', 'name' => 'data[ligner][' . $i . '][punht]', 'id' => 'punht' . $i, 'champ' => 'punht', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc', 'type' => 'text'));
                              ?>
                            </td>
                            <td align="center">
                              <?php

                              echo $this->Form->input('remisee', array('value' => $ligne['remise'], 'label' => '', 'name' => 'data[ligner][' . $i . '][remise]', 'id' => 'remise' . $i, 'champ' => 'remise', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc', 'type' => 'text'));
                              ?>
                            </td>

                            <td align="center" hidden>
                              <?php
                              echo $this->Form->input('fodec', array('value' => $ligne['fodec'], 'label' => '', 'name' => 'data[ligner][' . $i . '][fodec]', 'id' => 'fodec' . $i, 'champ' => 'fodec', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc', 'type' => 'text'));
                              ?>
                            </td>
                            <td align="center">
                              <?php echo $this->Form->input('tva', array('value' => $ligne['tva'], 'label' => '', 'name' => 'data[ligner][' . $i . '][tva]', 'id' => 'tva' . $i, 'champ' => 'tva', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc', 'type' => 'text')); ?>
                            </td>


                            <td align="center">
                              <?php
                              echo $this->Form->input('ttc', array('readonly' => 'readonly', 'value' => $ligne['ttc'], 'label' => '', 'name' => 'data[ligner][' . $i . '][ttc]', 'id' => 'ttc' . $i, 'champ' => 'ttc', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc', 'type' => 'text'));
                              ?>
                            </td>

                          </tr>
                        <?php } ?>


                        <input type="hidden" value="<?php echo $i ?>" id="index0">

                      </tbody>

                    </table><br>
                  </div>
                </div>
              </div>
            </div>








            <div class="col-md-6">
              <?php

              echo $this->Form->control('remise', array('readonly' => 'readonly', 'value' => sprintf('%.3f', $commande['remise']), 'id' => 'remise', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'text'));
              echo $this->Form->control('tva', array('readonly' => 'readonly', 'value' => sprintf('%.3f', $commande['tva']), 'id' => 'tva', 'label' => 'TVA', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'text'));
              echo $this->Form->control('fodec', array('readonly' => 'readonly', 'value' => sprintf('%.3f', $commande['fodec']), 'id' => 'fodec', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'hidden'));

              ?></div>
            <div class="col-md-6"><?php
                                  echo $this->Form->control('ht', array('id' => 'ht', 'readonly' => 'readonly', 'value' => sprintf('%.3f', $commande['ht']), 'label' => 'HT', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'text'));

                                  echo $this->Form->control('ttc', array('readonly' => 'readonly', 'value' => sprintf('%.3f', $commande['ttc']), 'id' => 'ttc', 'label' => 'TTC', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'text'));

                                  ?>
            </div>

        </div>


        <!-- <div align="center" id="validation" class="testpvde" style="margin-right:auto;margin-top: 20px;margin-bottom:20px;">
          <?php echo $this->Form->submit(__('Valider')); ?>
        </div> -->
        <div align="center" id="validation" class="testpvde">
          <?= $this->Form->button('Enregistrer', ['type' => 'submit', 'id' => 'enr55', 'class' => 'btn btn-success']) ?>
        </div>

      </div>


      <?php echo $this->Form->end(); ?>



</section>
</div>
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
    calculeachat();
  })
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