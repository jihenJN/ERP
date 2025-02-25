<?php error_reporting(E_ERROR | E_PARSE); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<?php echo $this->Html->script('controle_frs'); ?>
<?php echo $this->Html->script('js_vieww_projet'); ?>
<?php echo $this->Html->css('select2'); ?>
<section class="content-header">
  <h1>
    Factures
    <small>
      <?php echo __(''); ?>
    </small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'vieww/' . $project_id]); ?>"><i class="fa fa-reply"></i>
        <?php echo __('Retour'); ?>
      </a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <?php echo $this->Form->create($facture, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]);
        ?>
        <div class="box-body">
          <div class="row">
            <div class="col-xs-2">
              <?php echo $this->Form->control('numero', ["value" => "FAC" . sprintf('%04d', $numero + 1), 'readonly' => 'readonly']); ?>
            </div>
            <div class="col-xs-2">
              <?php echo $this->Form->control('date', ['readonly' => 'readonly', 'empty' => true, "value" => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime(date('Y-m-d H:i:s'))))]); ?>
            </div>
            <div class="col-xs-2">
              <input name="fournisseur_id" value="<?php echo $livraison->fournisseur_id ?>" type="hidden">
              <?php echo $this->Form->control('fournisseur_id', ['id' => 'fournisseur_id', 'disabled' => true, 'options' => $fournisseurs, 'empty' => 'Veuillez choisir !!', 'value' => $livraison->fournisseur_id, 'class' => 'form-control select2']); ?>
            </div>
            <div class="col-xs-2" hidden>
              <?php echo $this->Form->control('depot_id', ['' => true, 'options' => $depots, 'empty' => 'Veuillez choisir !!', 'value' => $livraison->depot_id, 'class' => 'form-control select2']); ?>
            </div>
            <div class="col-xs-2">
              <?php echo $this->Form->control('conteneur_id', ['' => true, 'options' => $conteneur, 'empty' => 'Veuillez choisir !!', 'value' => $livraison->conteneur_id, 'class' => 'form-control select2']); ?>
            </div>
            <div class="col-xs-2">
              <?php echo $this->Form->control('projet_id', ['' => true, 'options' => $projets, 'empty' => 'Veuillez choisir !!', 'value' => $livraison->projet_id, 'id' => 'projet_id', 'class' => 'form-control select2']); ?>
            </div>
            <div class="col-xs-2">
              <label class="control-label" for="unipxte-id" style="margin-top: 25px;">TVA:</label>
              OUI <input type="radio" name="tvaOnOff" value="1" id="OUI" class="Toggleaddindcfff"
                style="margin-right: 20px" <?php if ($livraison->tvaOnOff == 1)
                  echo "checked"; ?>>
              NON <input type="radio" name="tvaOnOff" value="0" id="NON" class="Toggleaddindcfff " <?php if ($livraison->tvaOnOff == 0)
                echo "checked"; ?>>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-2">
              <?php //debug($livraison);
               echo $this->Form->control('incoterm_id', ['options' => $incoterms, 'empty' => 'Veuillez choisir !!', 'value' => $livraison->incoterm_id, 'id' => 'incoterm_id', 'class' => 'form-control select2']); ?>
            </div>
            <div class="col-xs-2">
              <?php echo $this->Form->control('location_incoterms', ['empty' => 'Veuillez choisir !!', 'value' => $livraison->location_incoterms, 'id' => 'location_incoterms', 'class' => 'form-control']); ?>
            </div>
            <div class="col-xs-2">
              <?php echo $this->Form->control('options_incotermtotalpdf', ['options' => $incoterms, 'label' => 'Incoterm du total en pdf', 'empty' => 'Veuillez choisir !!', 'value' => $livraison->options_incotermtotalpdf, 'id' => 'options_incotermtotalpdf', 'class' => 'form-control select2']); ?>
            </div>
            <div class="col-xs-6">
              <?php
              $options_istotaltransportdetaille = [1 => 'Oui', 2 => 'Non'];
              echo $this->Form->control('options_istotaltransportdetaille', ['options' => $options_istotaltransportdetaille, 'label' => 'Détail des montants de transport en pdf ', 'empty' => 'Veuillez choisir !!', 'value' => $livraison->options_istotaltransportdetaille, 'id' => 'options_incotermtotalpdf', 'class' => 'form-control select2']); ?>
            </div>
            <div class="col-xs-12">
              <?php echo $this->Form->control('options_indicationenpdf', ['type' => 'textarea', 'label' => 'Transports incoterm entre le port d embarquement et le port de destination', 'empty' => 'Veuillez choisir !!', 'value' => $livraison->options_indicationenpdf, 'id' => 'options_indicationenpdf', 'class' => 'form-control']); ?>
            </div>
          </div>
        </div>
      </div>
      <section class="content-header">
        <h1 class="box-title">
          <?php echo __('Ligne Facture'); ?>
        </h1>
      </section>
      <section class="content" style="width: 99%">
        <div class="row">
          <div class="box">
            <input type="hidden" name="nbr_ligne" id="nbrligne">
            <div class="panel-body">
              <div class="table-responsive ls-table">
                <table class="table table-bordered table-striped table-bottomless">
                  <thead>
                    <tr>
                      <th scope="col">Article</th>
                      <th scope="col">Quantité</th>
                      <th scope="col">PrixHT</th>
                      <th scope="col">Remise</th>
                      <th scope="col">PrixUNHT</th>
                      <th hidden scope="col">Fodec</th>
                      <td id='thtva' align="center"
                        style="display:<?php echo ($livraison->tvaOnOff == 1) ? 'table-cell' : 'none'; ?>">
                        <strong>Tva</strong>
                      </td>
                      <th scope="col">TTC</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $indice = -1;
                    foreach ($lignelivraisons as $ligne) {
                      $indice++;
                      ?>
                      <tr id="ligne1">
                        <td>
                          <select name="data[ligner][<?= h($indice) ?>][article_id]" id="article_id<?= h($indice) ?>"
                            class="form-control" onchange="get_article(this.value,1)">
                            <option value="">Veuillez choisir !!</option>
                            <?php foreach ($articles as $article): ?>
                              <option readonly value="<?= h($article->id) ?>" <?php if ($article->id == $ligne->article_id) {
                                  echo "selected";
                                } ?>><?= h($article->Dsignation) ?>
                              </option>
                            <?php endforeach; ?>
                          </select>
                        </td>
                        <td>
                          <input type="number" name="data[ligner][<?= h($indice) ?>][qte]" id="qte<?= h($indice) ?>"
                            class="form-control httbc" readonly value="<?= h($ligne->qte) ?>">
                        </td>
                        <td>
                          <input type="number" name="data[ligner][<?= h($indice) ?>][prix]" id="prix<?= h($indice) ?>"
                            class="form-control httbc" value="<?= h($ligne->prix) ?>">
                        </td>
                        <td>
                          <input type="number" name="data[ligner][<?= h($indice) ?>][remise]" id="remise<?= h($indice) ?>"
                            class="form-control httbc" value="<?= h($ligne->remise) ?>">
                        </td>
                        <td>
                          <input type="number" name="data[ligner][<?= h($indice) ?>][punht]" id="punht<?= h($indice) ?>"
                            class="form-control httbc" value="<?= h($ligne->ht) ?>">
                        </td>
                        <td hidden>
                          <input type="number" name="data[ligner][<?= h($indice) ?>][fodec]" id="fodec<?= h($indice) ?>"
                            class="form-control httbc" value="<?= h($ligne->fodec) ?>">
                        </td>
                        <td champ="tdtva" table="tablelignetva" id="tdtva<?php echo $indice; ?>"
                          name="data[ligner]['<?php echo $indice; ?>'][tdtva]" index="<?php echo $indice; ?>"
                          style=" display:<?php echo ($livraison->tvaOnOff == 1) ? 'table-cell' : 'none'; ?>"
                          align="center">
                          <input type="number" name="data[ligner][<?= h($indice) ?>][tva]" id="tva<?= h($indice) ?>"
                            class="form-control httbc" value="<?= h($ligne->tva) ?>">
                        </td>
                        <td>
                          <input type="number" readonly name="data[ligner][<?= h($indice) ?>][ttc]"
                            id="ttc<?= h($indice) ?>" class="form-control" value="<?= h($ligne->ttc) ?>">
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                  <input type="hidden" value="<?php echo $indice ?>" id="index0">
                </table><br>
              </div>


              <div class="col-xs-3">
                <?php echo $this->Form->control('remise', ['id' => 'totalremise', 'class' => 'form-control httbc ', 'readonly', 'value' => $livraison->remise]); ?>
              </div>
              <div class="col-xs-3">
                <?php echo $this->Form->control('ht', ['id' => 'totalht', 'class' => 'form-control httbc ', 'readonly', 'value' => $livraison->ht]); ?>
              </div>
              <div hidden class="col-xs-6">
                <?php echo $this->Form->control('fodec', ['id' => 'totalfodec', 'class' => 'form-control httbc ', 'readonly', 'value' => $livraison->fodec]); ?>
              </div>

              <div id="divtva" class="col-xs-3"
                style="display:<?php echo ($livraison->tvaOnOff == 1) ? 'block' : 'none'; ?>">
                <?php echo $this->Form->control('tva', ['id' => 'totaltva', 'class' => 'form-control httbc ', 'readonly', 'value' => $livraison->tva]); ?>
              </div>
              <div class="col-xs-3">
                <?php echo $this->Form->control('timbre', ['readonly' => 'readonly', 'id' => 'timbre_id', 'value' => $tab1['timbre'], 'class' => 'form-control httbc ']); ?>
              </div>
              <div class="col-xs-3">
                <?php echo $this->Form->control('ttc', ['id' => 'totalttc', 'class' => 'form-control httbc ', 'readonly', 'value' => $livraison->ttc + 0.6]); ?>
              </div>



              <div align="center" class="addindcfff" id="e1">
                <button type="submit" class="pull-right btn btn-success " id="livraisonSubmit"
                  style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
              </div>
              <?php echo $this->Form->end(); ?>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  </div>
</section>
<style>
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  ;

  input[type="number"] {
    -moz-appearance: textfield;
  }
</style>
<script src="/js/functions.js"></script>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
  $(function () {
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