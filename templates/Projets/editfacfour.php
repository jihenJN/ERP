<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Livraison $livraison
 */
?>
<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<?php echo $this->Html->script('js_vieww_projet'); ?>
<?php echo $this->Html->script('controle_frs'); ?>
<section class="content-header">
  <h1>
    Facture
    <small><?php echo __(''); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'vieww/', $project_id]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <?php echo $this->Form->create($facture, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
        <div class="box-body">
          <div class="row">
            <div class="col-xs-2">
              <?php echo $this->Form->control('numero', ['readonly' => 'readonly']); ?>
            </div>
            <div class="col-xs-2">
              <?php echo $this->Form->control('date', ['readonly' => 'readonly', 'empty' => true]); ?>
            </div>
            <div class="col-xs-2">
              <?php echo $this->Form->control('fournisseur_id', ['id' => 'fournisseur_id', 'options' => $fournisseurs, 'class' => 'select2 form-control']); ?>
            </div>
            <div hidden class="col-xs-2">
              <?php echo $this->Form->control('adresselivraisonfournisseur_id', ["label" => "adresse livraison fournisseur", 'class' => 'select2 form-control']); ?>
            </div>
            <div hidden class="col-xs-2">
              <?php echo $this->Form->control('pointdevente_id', ["label" => "point de vente", 'options' => $pointdeventes, 'class' => 'select2 form-control']); ?>
            </div>
            <div hidden class="col-xs-2">
              <?php echo $this->Form->control('depot_id', ['id' => 'depot_id', 'value' => '9', 'class' => 'select2 form-control']); ?>
            </div>
            <div class="col-xs-2">
              <?php echo $this->Form->control('conteneur_id', ['options' => $conteneur, 'class' => 'select2 form-control']); ?>
            </div>
            <div class="col-xs-2">
              <?php echo $this->Form->control('projet_id', ['empty' => 'Veuillez choisir !!', 'value' => $project_id, 'class' => 'form-control select2']); ?>
            </div>
            <div class="col-xs-2">
              <label class="control-label" for="unipxte-id" style="margin-top: 25px;">TVA:</label>
              OUI <input type="radio" name="tvaOnOff" value="1" id="OUI" class="toggleEditfacFour" <?php if ($facture->tvaOnOff == 1) echo "checked"; ?>>
              NON <input type="radio" name="tvaOnOff" value="0" id="NON" class="toggleEditfacFour" <?php if ($facture->tvaOnOff == 0) echo "checked"; ?>>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-2">
            <?php echo $this->Form->control('incoterm_id', ['options' => $incoterms, 'empty' => 'Veuillez choisir !!', 'value' => $facture->incoterm_id, 'id' => 'incoterm_id', 'class' => 'form-control select2']); ?>
          </div>
          <div class="col-xs-2">
            <?php echo $this->Form->control('location_incoterms', ['empty' => 'Veuillez choisir !!', 'value' => $facture->location_incoterms, 'id' => 'location_incoterms', 'class' => 'form-control']); ?>
          </div>
          <div class="col-xs-2">
            <?php echo $this->Form->control('options_incotermtotalpdf', ['options' => $incoterms, 'label' => 'Incoterm du total en pdf', 'empty' => 'Veuillez choisir !!', 'value' => $facture->options_incotermtotalpdf, 'id' => 'options_incotermtotalpdf', 'class' => 'form-control select2']); ?>
          </div>
          <div class="col-xs-6">
            <?php $options_istotaltransportdetaille = [1  => 'Oui', 2 => 'Non'];
            echo $this->Form->control('options_istotaltransportdetaille', ['options' => $options_istotaltransportdetaille, 'label' => 'Détail des montants de transport en pdf ', 'empty' => 'Veuillez choisir !!', 'value' => $facture->options_istotaltransportdetaille, 'id' => 'options_incotermtotalpdf', 'class' => 'form-control select2']); ?>
          </div>
          <div class="col-xs-12">
            <?php echo $this->Form->control('options_indicationenpdf', ['type' => 'textarea', 'label' => 'Transports incoterm entre le port d embarquement et le port de destination', 'empty' => 'Veuillez choisir !!', 'value' => $facture->options_indicationenpdf, 'id' => 'options_indicationenpdf', 'class' => 'form-control']); ?>
          </div>
        </div>
        <section class="content-header">
          <h1 class="box-title"><?php echo __('Ligne Livraison'); ?></h1>
        </section>
        <section class="content" style="width: 99%">
          <div class="row">
            <div class="box">
              <div class="box-header with-border">
                <div class="panel-body">
                  <div class="table-responsive ls-table">
                    <table class="table table-bordered table-striped table-bottomless" id="tabligne3">
                      <thead>
                        <tr>
                          <th scope="col">Article</th>
                          <th scope="col">Quantité</th>
                          <th scope="col">Prix</th>
                          <th scope="col">Remise</th>
                          <th hidden scope="col">Fodec</th>
                          <td id='thtva' align="center" style="display:<?php echo ($facture->tvaOnOff == 1) ? 'table-cell' : 'none'; ?>"><strong>Tva</strong></td>
                          <th scope="col">TTC</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="tr" style="display: none !important" align="center">

                          <td style="width: 15%;" align="center">
                            <input type="hidden" champ="sup" table="tabligne3" index="" class="form-control">
                            <select champ="article_id" class="form-control httbc" table="tabligne3">
                              <option value="">Veuillez choisir !!</option>
                              <?php foreach ($articles as $article) : ?>
                                <option value="<?= h($article->id) ?>"><?= h($article->Dsignation) ?></option>
                              <?php endforeach; ?>
                            </select>
                          </td>
                          <td style="width: 10%;" align="center">
                            <input table="tabligne3" type='number' champ='qte' class='form-control getcalc httbc ' class='input'>
                          </td>
                          <td style="width: 10%;" align="center">
                            <input table="tabligne3" type='number' champ='prix' class='form-control getcalc httbc getprixarticle' class='input'>
                          </td>
                          <td style="width: 10%;" align="center">
                            <input table="tabligne3" type='number' champ='remise' class='form-control getcalc httbc' class='input'>
                          </td>
                          <td style="width: 10%;" align="center">
                            <input table="tabligne3" type='number' champ='ht' class='form-control getcalc httbc' class='input'>
                          </td>
                          <td hidden style="width: 10%;" align="center">
                            <input table="tabligne3" type='number' champ='fodec' class='form-control getcalc httbc' class='input'>
                          </td>
                          <td champ="tdtva" table="tablelignetva" id="" name="" index="" style="display:none;" align="center">
                            <input table="tabligne3" type='number' champ='tva' class='form-control getcalc httbc' class='input'>
                          </td>
                          <td style="width: 10%;" align="center">
                            <input table="tabligne3" type='number' champ='ttc' class='form-control getcalc httbc' class='input'>
                          </td>
                        </tr>
                        <?php foreach ($lignes as $indice => $ligne) : ?>
                          <tr>
                            <td>
                              <div style="display: none ">
                                <input type="" name="data[tabligne3][<?= h($indice) ?>][id]" id="id<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control getcalc" value="<?= h($ligne->id) ?>">
                              </div>
                              <input type="hidden" name="data[tabligne3][<?= h($indice) ?>][sup]" id="sup<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control httbc">
                              <select name="data[tabligne3][<?= h($indice) ?>][article_id]" id="article_id<?= h($indice) ?>" class="form-control select2" onchange="get_article(this.value,1)">
                                <option value="">Veuillez choisir !!</option>
                                <?php foreach ($articles as $article) : ?>
                                  <option readonly value="<?= h($article->id) ?>" <?php if ($article->id == $ligne->article_id) {
                                                                                    echo "selected";
                                                                                  } ?>><?= h($article->Dsignation.' '.$article->Description) ?></option>
                                <?php endforeach; ?>
                              </select>
                            </td>
                            <td>
                              <input type="number" readonly name="data[tabligne3][<?= h($indice) ?>][qte]" id="qte<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control httbc getcalc" value="<?= h($ligne->qte) ?>">
                            </td>
                            <td>
                              <input type="number" name="data[tabligne3][<?= h($indice) ?>][prix]" id="prix<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control httbc getcalc" value="<?= h($ligne->prix) ?>">
                            </td>
                            <td hidden>
                              <input type="number" readonly name="data[tabligne3][<?= h($indice) ?>][punht]" id="punht<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control httbc getcalc" value="<?= h($ligne->punht) ?>">
                            </td>
                            <td>
                              <input type="number" name="data[tabligne3][<?= h($indice) ?>][remise]" id="remise<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control httbc getcalc" value="<?= h($ligne->remise) ?>">
                            </td>
                            <td hidden>
                              <input type="number" name="data[tabligne3][<?= h($indice) ?>][fodec]" id="fodec<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control httbc getcalc" value="<?= h($ligne->fodec) ?>">
                            </td>
                            <td champ="tdtva" table="tablelignetva" id="tdtva<?php echo $indice; ?>" name="data[ligner]['<?php echo $indice; ?>'][tdtva]" index="<?php echo $indice; ?>" style=" display:<?php echo ($facture->tvaOnOff == 1) ? 'table-cell' : 'none'; ?>" align="center">
                              <input type="number" name="data[tabligne3][<?= h($indice) ?>][tva]" id="tva<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control httbc getcalc" value="<?= h($ligne->tva) ?>">
                            </td>
                            <td>
                              <input type="number" readonly name="data[tabligne3][<?= h($indice) ?>][ttc]" id="ttc<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control httbc getcalc" value="<?= h($ligne->ttc) ?>">
                            </td>
                          </tr>
                        <?php endforeach; ?>

                      </tbody>
                      <input type="hidden" value="<?php echo $indice ?>" id="index0">
                    </table><br>
                  </div>
                </div>
              </div>
              <div class="col-xs-2">
                <?php echo $this->Form->control('remise', ['id' => 'totalremise', 'class' => 'form-control httbc getcalc ', 'readonly']); ?>
              </div>
              <div class="col-xs-2">
                <?php echo $this->Form->control('ht', ['label' => 'Ht', 'id' => 'totalht', 'class' => 'form-control httbc getcalc ', 'readonly']); ?>
              </div>
              <div hidden class="col-xs-6">
                <?php echo $this->Form->control('fodec', ['id' => 'totalfodec', 'class' => 'form-control httbc getcalc ', 'readonly']); ?>
              </div>
              <div id="divtva" class="col-xs-2" style="display:<?php echo ($facture->tvaOnOff == 1) ? 'block' : 'none'; ?>">
                <?php echo $this->Form->control('tva', ['id' => 'totaltva', 'class' => 'form-control httbc getcalc ', 'readonly']); ?>
              </div>
              <div class="col-xs-2">
                <?php echo $this->Form->control('timbre', ['readonly' => 'readonly', 'id' => 'timbre_id', 'options' => $timbres, 'value' => '1', 'class' => 'form-control httbc ']); ?>
              </div>
              <div class="col-xs-2">
                <?php echo $this->Form->control('ttc', ['id' => 'totalttc', 'class' => 'form-control httbc getcalc ', 'readonly']); ?>
              </div>
              <div align="center" class="btnEnregEditFacFour" id="e1">
                <button type="submit" class="pull-right btn btn-success " id="livraisonSubmit" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
              </div>
              <?php echo $this->Form->end(); ?>
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

<script>
  $(function() {
    $('#fournisseur-id').on('change', function() {
      //alert('hello');
      id = $('#fournisseur-id').val();
      //alert(id)
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Facture', 'action' => 'getadresselivraison']) ?>",

        dataType: "json",
        data: {
          idfam: id,
        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data) {

          $('#adresselivraisonfournisseur').html(data.select);

        }
      })
    });
  });

  $('.ajouterligne_w').on('click', function() {
    table = $(this).attr('table');
    //alert(table);
    index = $(this).attr('index');
    ajouter_lignee(table, index);
  })
</script>

<script>
  function ajouter_lignee(table, index) {
    ind = Number($('#' + index).val()) + 1;
    // alert(table);
    $ttr = $('#' + table).find('.tr').clone(true);
    $ttr.attr('class', '');
    i = 0;
    tabb = [];
    $ttr.find('input,select,textarea,tr,td,div').each(function() {
      tab = $(this).attr('table'); //alert(tab)
      champ = $(this).attr('champ');
      $(this).attr('index', ind);
      $(this).attr('id', champ + ind);
      $(this).attr('name', 'data[' + tab + '][' + ind + '][' + champ + ']');
      $(this).attr('data-bv-field', 'data[' + tab + '][' + ind + '][' + champ + ']');
      $type = $(this).attr('type');
      $(this).val('');
      if ($type == 'radio') {
        $(this).attr('name', 'data[' + champ + ']');
        $(this).val(ind);
      }
      if ((champ == 'datedebut') || (champ == 'datefin')) {
        $(this).attr('onblur', 'nbrjour(' + ind + ')')
      }
      $(this).removeClass('anc');
      if ($(this).is('select')) {
        tabb[i] = champ + ind;
        i = Number(i) + 1;
      }
    })
    $ttr.find('i').each(function() {
      // alert('hh');
      $(this).attr('index', ind);
    });
    $('#' + table).append($ttr);
    $('#' + index).val(ind);
    $('#' + table).find('tr:last').show();
    for (j = 0; j <= i; j++) {}
  }
</script>
<script>
  $(function() {
    $('#fournisseur-id').on('change', function() {
      //alert('hello');
      id = $('#fournisseur-id').val();
      // alert(id)
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Livraisons', 'action' => 'getadresselivraison']) ?>",
        dataType: "json",
        data: {
          idfam: id,
        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data) {
          // alert(data.ligne.Fodec);
          $('#adresselivraisonfournisseur-id').html(data.select);
          // uniform_select('adresse');
          $('#exofodec').val(data.ligne.Fodec);
          $('#exotva').val(data.ligne.R_TVA);
        }
      })
    });
  });
  $('.ajouterligne_w').on('click', function() {

    table = $(this).attr('table');
    //alert(table);
    index = $(this).attr('index');
    ajouter_ligne(table, index);
  })
  $('.btnajout').on('mouseover', function() {
    //alert('marwa')
    depot = $('#depot-id').val();
    //alert(namepv)
    if (depot == '') {
      alert('choisir depot SVP !!', function() {});
    }
  });
</script>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
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