<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Facture $facture
 */
?>
<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<?php echo $this->Html->script('controle_frs'); ?>
<?php echo $this->Html->css('select2'); ?>
<section class="content-header">
  <h1>
    Facture Achat
    <small><?php echo __(''); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['controller' => 'Livraisons', 'action' => 'index/' . $type]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box">

        <!-- /.box-header -->
        <!-- form start -->
        <?php echo $this->Form->create($facture, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
        <div class="box-body">
          <div class="row">


            <div class="col-md-6">
              <?php
             // echo $this->Form->control('numero', ["value" => $b, 'readonly' => 'readonly']);
             echo $this->Form->control('numero', ['label' => 'Numéro']);

              ?>
            </div>
            <div class="col-md-6">
              <?php
              echo $this->Form->control('date', ['readonly' => 'readonly', 'empty' => true, "value" => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime(date('Y-m-d H:i:s'))))]);

              ?>
            </div>
            <div class="col-md-6">
              <?php
              echo $this->Form->control('fournisseur_id', ['readonly', 'style' => 'pointer-events:none', 'options' => $fournisseurs, 'empty' => 'Veuillez choisir !!', 'value' => $livraison->fournisseur_id, 'class' => 'form-control select2']);

              ?>
            </div>


            <div class="col-md-6">
              <?php
              echo $this->Form->control('depot_id', ['readonly', 'style' => 'pointer-events:none', 'options' => $depots, 'empty' => 'Veuillez choisir !!', 'value' => $livraison->depot_id, 'class' => 'form-control select2']);

              ?>
            </div>

            <div class="col-xs-6" hidden>
            <?php
            echo $this->Form->control('service_id', [
              'label' => 'Service',
              'value' => $livraison['service_id'],
              'required' => 'off',
              'empty' => 'Veuillez choisir!!!',
              'class' => 'form-control select2 ',
              'type' => 'select',
              'options' => $services

            ]);
            ?>
          </div>
          <div class="col-xs-6" hidden>
            <?php
            echo $this->Form->control('machine_id', [
              'label' => 'Machine',
              'value' => $livraison['machine_id'],
              'required' => 'off',
              'empty' => 'Veuillez choisir!!!',
              'class' => 'form-control select2 ',
              'type' => 'select',
              'options' => $machines

            ]);
            ?>
          </div>

          <div class="col-md-6" hidden >
              <?php
               echo $this->Form->control('facturefournisseur', ["label" => "N° Facture fournisseur", 'class'=>'form-control']);

              ?>
            </div>

            <div class="col-md-6" hidden>
              <?php
               echo $this->Form->control('datefournisseur', ["label" => "Date Facture fournisseur", 'class'=>'form-control']);

              ?>
            </div>

          <div class="col-xs-6" hidden>
            <?php echo $this->Form->control('observation', ['label' => 'Commentaire', 'class' => 'form-control', 'type' => 'textarea']); ?>
          </div>

          <!--            <div class="col-md-6">
              <?php
              echo $this->Form->control('cartecarburant_id', ["label" => "carte carburant", 'options' => $cartecarburants, 'empty' => 'Veuillez choisir !!', 'value' => $livraison->cartecarburant_id]);

              ?>
            </div>-->
          <!--            <div class="col-md-6">
              <?php
              echo $this->Form->control('materieltransport_id', ["label" => "materiel du transport", 'options' => $materieltransports, 'empty' => 'Veuillez choisir !!', 'value' => $livraison->materieltransport_id]);

              ?>
            </div>
            <div class="col-md-6">
              <?php
              echo $this->Form->control('kilometragedepart', ['label' => "kilometrage de depart", 'value' => $livraison->kilometragedepart]);

              ?>
            </div>
            <div class="col-md-6">
              <?php
              echo $this->Form->control('kilometragearrive', ['label' => "kilometrage d'arrive", 'value' => $livraison->kilometragearrive]);

              ?>
            </div>-->
          <!--            <div class="col-md-6">
              <div class="form-group input text required">
                <label class="control-label" for="name">Conffaieur</label>
                <select class="form-control select2" name="convoyeur_id" id="convoyeur_id">
                  <option value="" disabled>Veuillez choisir !!</option>
                  <?php foreach ($conffaieurs as $id => $conffaieur) {
                  ?>

                    <option value="<?php echo $conffaieur->id; ?>"><?php echo $conffaieur->code . ' ' . $conffaieur->nom . ' ' . $conffaieur->prenom ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-xs-6">
              <div class="form-group input text required">
                <label class="control-label" for="name">Chauffeurs</label>
                <select class="form-control select2" name="chauffeur_id" id="chauffeur_id">
                  <option value="" disabled>Veuillez choisir !!</option>
                  <?php

                  foreach ($chauffeurs as $idd => $chauffeur) {

                  ?>
                    <option value="<?php echo $chauffeur->id; ?>"><?php echo $chauffeur->code . ' ' . $chauffeur->nom . ' ' . $chauffeur->prenom ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>-->


          <!-- <div class="col-md-6">
              <?php
              echo $this->Form->control('conffaieur_id', ['options' => $conffaieurs, 'empty' => 'Veuillez choisir !!', 'value' => $livraison->conffaieur_id]);
              ?>
            </div>
            <div class="col-md-6">
              <?php
              echo $this->Form->control('chauffeur_id', ['options' => $chauffeurs, 'empty' => 'Veuillez choisir !!', 'value' => $livraison->chauffeur_id]);
              ?>

            </div> -->

        </div>

      </div>
      <!-- /.box-body -->
      <section class="content-header">
        <h1 class="box-title"><?php echo __('Ligne Facture'); ?></h1>
      </section>
      <section class="content" style="width: 99%">
        <div class="row">
          <div class="box">
            <input type="hidden" name="nbr_ligne" id="nbrligne">
            <!-- <div class="box-header with-border">
                <a class="btn btn-primary  " table='addtable' onclick="ajouter_ligne_livraison()" index='index' id='' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                  <i class="fa fa-plus-circle "></i> Ajouter ligne</a>

              </div> -->
            <div class="panel-body">
              <div class="table-responsive ls-table">
                <table class="table table-bordered table-striped table-bottomless">
                  <thead>
                    <tr>
          
                      <td align="center" style="width: 15%;"><strong>Code</strong> </td>
                        <td align="center" style="width: 25%;"><strong>Designation</strong> </td>
                        <td align="center" style="width: 6%;"><strong> Quantité</strong></td>
                      
                        <td align="center" style="width: 12%;"><strong>Prix HT </strong></td>
                        <td align="center" style="width: 8%;"><strong> Remise </strong></td>
                        <td align="center" style="width: 12%;"><strong> PUNHT</strong></td>
                        <th hidden scope="col">Fodec</th>
                        <td align="center" style="width: 6%;"><strong>TVA </strong></td>
                        <td align="center" style="width: 12%;"><strong> TTC </strong></td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $indice = -1;
                    //   debug($lignelivraisons);
                    foreach ($lignelivraisons as $ligne) {

                      $indice++;
                      if ($ligne['qteliv'] != 0) {
                        //debug($tab1['timbre']);
                    ?>
                        <tr id="ligne1">
                          <td>
                            <select name="data[ligner][<?= h($indice) ?>][article_id]" id="article_id<?= h($indice) ?>" class="form-control" onchange="get_article(this.value,1)">
                              <option value="">Veuillez choisir !!</option>
                              <?php foreach ($articles as $article) : ?>
                                <option readonly value="<?= h($article->id) ?>" <?php if ($article->id == $ligne->article_id) {
                                                                                  echo "selected";
                                                                                } ?>><?= h($article->Code) ?></option>
                              <?php endforeach; ?>

                            </select>
                          </td>
                          <td>
                            <select name="data[ligner][<?= h($indice) ?>][article_idd]" id="article_id<?= h($indice) ?>" class="form-control" onchange="get_article(this.value,1)">
                              <option value="">Veuillez choisir !!</option>
                              <?php foreach ($articles as $article) : ?>
                                <option readonly value="<?= h($article->id) ?>" <?php if ($article->id == $ligne->article_id) {
                                                                                  echo "selected";
                                                                                } ?>><?= h($article->Dsignation) ?></option>
                              <?php endforeach; ?>

                            </select>
                          </td>
                          
                          <td>
                            <input type="text" name="data[ligner][<?= h($indice) ?>][qte]" id="qte<?= h($indice) ?>" class="form-control httbc" readonly value="<?= h($ligne->qteliv) ?>">
                          </td>
                          <td>
                            <input type="text" name="data[ligner][<?= h($indice) ?>][prix]" id="prix<?= h($indice) ?>" class="form-control httbc" value="<?= h($ligne->prix) ?>">
                          </td>
                          <td>
                            <input type="text" name="data[ligner][<?= h($indice) ?>][remise]" id="remise<?= h($indice) ?>" class="form-control httbc" value="<?= h($ligne->remise) ?>">

                          </td>
                          <td>
                            <input type="text" name="data[ligner][<?= h($indice) ?>][punht]" id="punht<?= h($indice) ?>" class="form-control httbc" value="<?= h($ligne->punht) ?>">

                          </td>
                          <td hidden>
                            <input type="text" name="data[ligner][<?= h($indice) ?>][fodec]" id="fodec<?= h($indice) ?>" class="form-control httbc" value="<?= h($ligne->fodec) ?>">

                          </td>
                          <td>
                            <input type="text" name="data[ligner][<?= h($indice) ?>][tva]" id="tva<?= h($indice) ?>" class="form-control httbc" value="<?= h($ligne->tva) ?>">

                          </td>
                          <td>
                            <input type="text" readonly name="data[ligner][<?= h($indice) ?>][ttc]" id="ttc<?= h($indice) ?>" class="form-control" value="<?= h($ligne->ttc) ?>">

                          </td>
                          <!--                          <td class="actions text-right">

                            <i onclick="delete_ligne(<?= h($indice + 1) ?>)" class="fa fa-times supLigne" style="color: #C9302C;font-size: 22px;" index="0" role="button"></i>
                          </td>-->
                        </tr>
                      <?php } ?>
                    <?php } ?>

                  </tbody>
                  <input type="hidden" value="<?php echo $indice ?>" id="index0">

                </table><br>
              </div>
            </div>
          </div>
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('remise', ['id' => 'totalremise', 'class' => 'form-control httbc ', 'readonly', 'value' => $livraison->remise]); ?>
          </div>
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('ht', ['id' => 'totalht', 'class' => 'form-control httbc ', 'readonly', 'value' => $livraison->ht]); ?>
          </div>
          <div class="col-xs-6" hidden>
            <?php
            echo $this->Form->control('fodec', ['id' => 'totalfodec', 'class' => 'form-control httbc ', 'readonly', 'value' => $livraison->fodec]); ?>
          </div>
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('tva', ['id' => 'totaltva', 'class' => 'form-control httbc ', 'readonly', 'value' => $livraison->tva]); ?>
          </div>
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('timbre', ['readonly' => 'readonly', 'id' => 'timbre_id', 'value' => $tab1['timbre'], 'class' => 'form-control httbc ']); ?>
          </div>
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('ttc', ['id' => 'totalttc', 'class' => 'form-control httbc ', 'readonly', 'value' => $livraison->ttc]); ?>
          </div>

          <button type="submit" class="pull-right btn btn-success " id="livraisonSubmit" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>







          <?php echo $this->Form->end(); ?>
        </div>
      </section>

    </div>
  </div>
  </div>

</section>
<script>
  $(document).ready(function() {
    $("form").submit(function() {
      $('#livraisonSubmit').attr('disabled', 'disabled');
    })
    
    calculeachatavctimbre();
  })
</script>
<script src="/js/functions.js"></script>

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
  $('.select2').select2();

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