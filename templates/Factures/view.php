<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Livraison $livraison
 */
?>
<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<?php echo $this->Html->css('select2'); ?>

<?php echo $this->Html->script('controle_frs'); ?>

<section class="content-header">
  <h1>
    Facture Achat
    <small><?php echo __(''); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index', $typef, $typefac]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
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
              echo $this->Form->control('numero', ['readonly' => 'readonly', 'label' => 'Numéro']);

              ?>
            </div>
            <div class="col-md-6">
              <?php
              echo $this->Form->control('date', ['readonly' => 'readonly', 'empty' => true]);

              ?>
            </div>
            <div class="col-md-6">
              <?php
              echo $this->Form->control('fournisseur_id', ['options' => $fournisseurs, 'class' => 'select2 form-control']);

              ?>
            </div>
            <div class="col-md-6">
              <?php
              // echo $this->Form->control('adresselivraisonfournisseur_id', ["label" => "adresse livraison fournisseur", 'class'=>'select2 form-control']);

              ?>
            </div>
            <div class="col-md-6">
              <?php
              // echo $this->Form->control('pointdevente_id', ["label" => "point de vente", 'options' => $pointdeventes, 'class'=>'select2 form-control']);

              ?>
            </div>
            <div class="col-md-6">
              <?php
              echo $this->Form->control('depot_id', ['options' => $depots, 'class' => 'select2 form-control']);

              ?>
            </div>

            <div class="col-xs-6" hidden>
              <?php
              echo $this->Form->control('service_id', [
                'label' => 'Service',
                'required' => 'off',
                'empty' => 'Veuillez choisir!!!',
                'class' => 'form-control select2 ',
                'type' => 'select',
                'options' => $services,
                'disabled' => true

              ]);
              ?>
            </div>
            <div class="col-xs-6" hidden>
              <?php
              echo $this->Form->control('machine_id', [
                'label' => 'Machine',
                'required' => 'off',
                'empty' => 'Veuillez choisir!!!',
                'class' => 'form-control select2 ',
                'type' => 'select',
                'options' => $machines,
                'disabled' => true

              ]);
              ?>
            </div>

            <!-- <div class="col-md-6">
              <?php
              echo $this->Form->control('facturefournisseur', ["label" => "N° Facture fournisseur", 'readonly', 'class' => 'form-control']);

              ?>
            </div> -->

            <!-- <div class="col-md-6">
              <?php
              echo $this->Form->control('datefournisseur', ["label" => "Date Facture fournisseur", 'readonly', 'class' => 'form-control']);

              ?>
            </div> -->


            <!-- <div class="col-xs-6">
              <?php echo $this->Form->control('observation', ['readonly', 'label' => 'Commentaire', 'class' => 'form-control', 'type' => 'textarea']); ?>
            </div> -->






          </div>

        </div>
        <!-- /.box-body -->
        <section class="content-header">
          <h1 class="box-title"><?php echo __('Ligne Livraison'); ?></h1>
        </section>
        <section class="content" style="width: 99%">
          <div class="row">
            <div class="box">
              <div class="box-header with-border">


              </div>
              <div class="panel-body">
                <div class="table-responsive ls-table">
                  <table class="table table-bordered table-striped table-bottomless" id="tabligne3">
                    <thead>
                      <tr>
                        <td align="center" style="width: 15%;"><strong>Code</strong> </td>
                        <td align="center" style="width: 25%;"><strong>Designation</strong> </td>
                        <td align="center" style="width: 6%;"><strong> Qté</strong></td>
                        <td align="center" style="width: 12%;"><strong>Prix HT </strong></td>
                        <td align="center" style="width: 12%;"><strong> PUNHT</strong></td>
                        <td align="center" style="width: 8%;"><strong> Remise </strong></td>

                        <th hidden scope="col">Fodec</th>

                        <td align="center" style="width: 6%;"><strong>TVA </strong></td>
                        <td align="center" style="width: 12%;"><strong> TTC </strong></td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="tr" style="display: none !important;font-size: 18px;font-weight: bold;" align="center">

                        <td style="width: 15%;" align="center">
                          <input type="hidden" champ="sup" table="tabligne3" index="" class="form-control">
                          <select champ="article_id" class="form-control " table="tabligne3">
                            <option value="">Veuillez choisir !!</option>
                            <?php foreach ($articles as $article) : ?>
                              <option value="<?= h($article->id) ?>"><?= h($article->Code) ?></option>
                            <?php endforeach; ?>
                          </select>
                        </td>
                        <td style="width: 15%;" align="center">
                          <input type="hidden" champ="sup" table="tabligne3" index="" class="form-control">
                          <select champ="article_id" class="form-control " table="tabligne3">
                            <option value="">Veuillez choisir !!</option>
                            <?php foreach ($articles as $article) : ?>
                              <option value="<?= h($article->id) ?>"><?= h($article->Dsignation) ?></option>
                            <?php endforeach; ?>
                          </select>
                        </td>
                        <!--                        <td style="width: 10%;" align="center">
                          <input table="tabligne3" type='text' champ='codefrs' class='form-control httbc getprixarticle' class='input'>
                        </td>-->
                        <td style="width: 10%;" align="center">
                          <input table="tabligne3" type='text' champ='qte' class='form-control httbc ' class='input'>
                        </td>

                        <td style="width: 10%;" align="center">
                          <input table="tabligne3" type='text' champ='prix' class='form-control httbc getprixarticle' class='input'>
                        </td>

                        <td style="width: 10%;" align="center">
                          <input table="tabligne3" type='text' champ='remise' class='form-control httbc' class='input'>
                        </td>

                        <td style="width: 10%;" align="center">
                          <input table="tabligne3" type='text' champ='ht' class='form-control httbc' class='input'>
                        </td>
                        <td style="width: 10%;" align="center" hidden>
                          <input table="tabligne3" type='text' champ='fodec' class='form-control httbc' class='input'>
                        </td>
                        <td style="width: 10%;" align="center">
                          <input table="tabligne3" type='text' champ='tva' class='form-control httbc' class='input'>
                        </td>
                        <td style="width: 10%;" align="center">
                          <input table="tabligne3" type='text' champ='ttc' class='form-control httbc' class='input'>
                        </td>

                      </tr>
                      <?php foreach ($lignes as $indice => $ligne) : ?>

                        <tr>
                          <td>

                            <div style="display: none ">
                              <input type="" name="data[tabligne3][<?= h($indice) ?>][id]" id="id<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control httbc" value="<?= h($ligne->id) ?>">
                            </div>



                            <input type="hidden" name="data[tabligne3][<?= h($indice) ?>][sup]" id="sup<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control ">

                            <select  disabled name="data[tabligne3][<?= h($indice) ?>][article_id]" id="article_id<?= h($indice) ?>" class="form-control" onchange="get_article(this.value,1)">
                              <option value="">Veuillez choisir !!</option>
                              <?php foreach ($articles as $article) : ?>
                                <option readonly value="<?= h($article->id) ?>" <?php if ($article->id == $ligne->article_id) {
                                                                                  echo "selected";
                                                                                } ?>><?= h($article->Code) ?></option>
                              <?php endforeach; ?>

                            </select>
                          </td>
                          <td>

                          
                            <select  disabled name="data[tabligne3][<?= h($indice) ?>][article_id]" id="article_id<?= h($indice) ?>" class="form-control" onchange="get_article(this.value,1)">
                              <option value="">Veuillez choisir !!</option>
                              <?php foreach ($articles as $article) : ?>
                                <option readonly value="<?= h($article->id) ?>" <?php if ($article->id == $ligne->article_id) {
                                                                                  echo "selected";
                                                                                } ?>><?= h($article->Dsignation) ?></option>
                              <?php endforeach; ?>

                            </select>
                          </td>
                          <td>
                            <input type="text" readonly name="data[tabligne3][<?= h($indice) ?>][qte]" id="qte<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control httbc" value="<?= h($ligne->qte) ?>">
                          </td>
                          <td>
                            <input type="text" name="data[tabligne3][<?= h($indice) ?>][prix]" id="prix<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control httbc" value="<?= h($ligne->prix) ?>">
                          </td>
                          <td>
                            <input type="text" readonly name="data[tabligne3][<?= h($indice) ?>][punht]" id="punht<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control httbc" value="<?= h($ligne->punht) ?>">

                          </td>
                          <td>
                            <input type="text" name="data[tabligne3][<?= h($indice) ?>][remise]" id="remise<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control httbc" value="<?= h($ligne->remise) ?>">

                          </td>

                          <td hidden>
                            <input type="text" name="data[tabligne3][<?= h($indice) ?>][fodec]" id="fodec<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control httbc" value="<?= h($ligne->fodec) ?>">

                          </td>
                          <td>
                            <input type="text" name="data[tabligne3][<?= h($indice) ?>][tva]" id="tva<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control httbc" value="<?= h($ligne->tva) ?>">

                          </td>
                          <td>
                            <input type="text" readonly name="data[tabligne3][<?= h($indice) ?>][ttc]" id="ttc<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control httbc" value="<?= h($ligne->ttc) ?>">

                          </td>

                        </tr>
                      <?php endforeach; ?>

                    </tbody>
                    <input type="hidden" value="<?php echo $indice ?>" id="index0">
                  </table><br>
                </div>
              </div>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('remise', ['id' => 'totalremise', 'class' => 'form-control httbc ', 'readonly']); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('punht', ['label' => 'Ht', 'id' => 'totalht', 'class' => 'form-control httbc ', 'readonly']); ?>
            </div>

            <div class="col-xs-6" hidden>
              <?php
              echo $this->Form->control('fodec', ['id' => 'totalfodec', 'class' => 'form-control httbc ', 'readonly']); ?>
            </div>

            <div class="col-xs-6">
              <?php
              echo $this->Form->control('tva', ['id' => 'totaltva', 'class' => 'form-control httbc ', 'readonly']); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('timbre', ['readonly' => 'readonly', 'id' => 'timbre_id', 'value' => $timbre, 'class' => 'form-control httbc ']); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('ttc', ['id' => 'totalttc', 'class' => 'form-control httbc ', 'readonly']); ?>
            </div>
            <?php echo $this->Form->end(); ?>
          </div>

        </section>
      </div>
      <!-- /.box -->
    </div>
  </div>
  <!-- /.row -->
</section>
<script>
  $(document).ready(function() {
    calculeachatavctimbre();
  })
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
<script>
  $(document).ready(function() {
    // Disable all input and select elements
    $('input, select').prop('disabled', true);
  });
</script>
<?php $this->end(); ?>