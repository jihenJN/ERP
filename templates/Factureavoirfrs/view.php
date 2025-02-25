<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Factureavoirfr $factureavoirfr
 * @var string[]|\Cake\Collection\CollectionInterface $utilisateurs
 */
?>
<?php

use Cake\Datasource\ConnectionManager;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('hechem'); ?>


<?php if ($factureavoirfrs->etat == 0) { ?>

  <section class="content-header">
    <h1>
      Consultation facture à voir
    </h1>
    <ol class="breadcrumb">

      <a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a>

    </ol>
  </section>
  <br>


  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box ">

          <?php echo $this->Form->create($factureavoirfrs, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
          <div class="box-body">

            <div class="row">

              <div class="col-md-6">
                <?php
                echo $this->Form->control('numero', ['readonly' => 'readonly']);

                ?>
              </div>
              <div class="col-md-6">
                <?php
                echo $this->Form->control('date', ['empty' => true, 'value' => date("d/m/Y"), 'class' => 'form-control', 'id' => 'date', 'disabled' => true]);

                ?>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <?php
                echo $this->Form->control('fournisseur_id', ['empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 ', 'id' => 'fournisseur', 'disabled' => true]);

                ?>
              </div>
              <div class="col-md-6">
                <?php
                echo $this->Form->control('depot_id', ['value' => $depots, 'class' => 'form-control select2', 'disabled' => true]);

                ?></div>
            </div>

          </div>
          <?php if ($lignefactureavoirfrs) { ?>

            <section class="content-header">
              <h1 class="box-title"><?php echo __('Ligne Facture'); ?></h1>
            </section>
            <section class="content" style="width: 99%">
              <div class="row">
                <div class="box">
                  <div class="box-header with-border">


                  </div>
                  <div class="panel-body">
                    <div class="table-responsive ls-table">
                      <table class="table table-bordered table-striped table-bottomless">
                        <thead>
                          <tr style="background-color: #D8D8D8;width:12px">
                            <td align="center" nowrap="nowrap" width="12%">Code</td>
                            <td align="center" nowrap="nowrap" width="22%">Désignation</td>

                            <!-- <td align="center" nowrap="nowrap" width="15%">Unité</td> -->
                            <td align="center" nowrap="nowrap" width="8%">Qté</td>
                            <td align="center" nowrap="nowrap" style="font-size: 16px;color:#ff0000" width="8%"> Qté AV </td>

                            <td align="center" nowrap="nowrap" width="10%">Prix</td>
                            <td align="center" nowrap="nowrap" width="5%">Rem</td>
                            <td align="center" nowrap="nowrap" width="11%">HT</td>
                            <td align="center" nowrap="nowrap" width="5%">Fodec</td>
                            <td align="center" nowrap="nowrap" width="5%">TVA</td>
                            <td align="center" nowrap="nowrap" width="12%">TTC</td>
                          </tr>
                        </thead>
                        <tbody>

                          <?php   
                          $connection = ConnectionManager::get('default');
                          foreach ($lignefactureavoirfrs as $i => $l) {
                            // $qf = ClassRegistry::init('Lignefacture')->find('first', array('conditions' => array('Lignefacture.id' => $l['Lignefactureavoirfr']['lignefacture_id']), 'recursive' => 0));
                            //debug($l);


                            $qf = $connection->execute('SELECT * FROM lignefactures WHERE lignefactures.id= ' . $l->lignefacture_id . ' ')->fetchAll('assoc');
                            //debug($qf[0]['qte']);
                          ?>
                            <tr class="cc">
                              <!-- <td>

                                <?php echo $this->Form->control('article_id', array('label' => '',  'value' => $l->article_id, 'options' => $art, 'name' => 'data[Lignefacture][' . $i . '][article_id]', 'id' => 'article_id' . $i,  'index' => $i, 'class' => 'form-control', 'disabled' => true)); ?>

                              </td> -->
                              <td>
                              <select readonly table="Lignefacture" name="data[Lignefacture][<?php echo $i ?>][article_id]" index="<?php echo  $i ?>" champ="article_id" class="form-control  ">
                                <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                <?php foreach ($art as $id => $article) {
                                ?>
                                  <option readonly value="<?= h($article->id) ?>" <?php if ($article->id == $l->article_id) {
                                                                                    echo "selected";
                                                                                  } ?>><?= h($article->Code) ?></option>
                                <?php } ?>
                              </select>
                              <?php //echo $this->Form->control('article_id', array('label' => '',  'value' => $l->article->Code, 'options' => $art, 'name' => 'data[Lignefacture][' . $i . '][article_id]', 'id' => 'article_id' . $i,  'index' => $i, 'class' => 'form-control ')); 
                              ?>

                            </td>
                            <td>
                              <select readonly table="Lignefacture" name="data[Lignefacture][<?php echo $i ?>][article_idd]" index="<?php echo  $i ?>" champ="article_idd" class=" form-control   ">
                                <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                <?php foreach ($art as $id => $article) {
                                ?>
                                  <option readonly value="<?= h($article->id) ?>" <?php if ($article->id == $l->article_id) {
                                                                                    echo "selected";
                                                                                  } ?>><?= h($article->Dsignation) ?></option>
                                <?php } ?>
                              </select>
                              <?php //echo $this->Form->control('article_idd', array('label' => '',  'value' => $l->article->Dsignation, 'options' => $art, 'name' => 'data[Lignefacture][' . $i . '][article_idd]', 'id' => 'article_idd' . $i,  'index' => $i, 'class' => 'form-control ')); 
                              ?>

                            </td>
                              <td>
                                <?php echo $this->Form->input('id', array('value' => $l->id, 'name' => 'data[Lignefacture][' . $i . '][id]', 'id' => 'id' . $i, 'champ' => 'id', 'table' => 'Lignefacture', 'index' => $i, 'type' => 'hidden', 'class' => 'form-control', 'label' => 'Nom')); ?>
                                <?php echo $this->Form->input('qtea', array('readonly', 'value' => $qf[0]['qte'], 'label' => '',  'name' => 'data[Lignefacture][' . $i . '][qtea]', 'table' => 'Lignefacture', 'index' => $i, 'id' => 'qtea' . $i, 'champ' => 'qtea', 'type' => 'text', 'class' => 'form-control', 'disabled' => true)); ?>

                              </td>
                              <td>
                                <?php echo $this->Form->input('quantite', array('value' => $l->quantite, 'label' => '',  'name' => 'data[Lignefacture][' . $i . '][quantite]', 'table' => 'Lignefacture', 'index' => $i, 'id' => 'quantite' . $i, 'champ' => 'quantite', 'type' => 'text', 'class' => 'form-control getcalc htb number ', 'disabled' => true)); ?>

                              </td>
                              <td>
                                <?php echo $this->Form->input('prix', array('value' => $l->prix, 'label' => '', 'name' => 'data[Lignefacture][' . $i . '][prix]', 'table' => 'Lignefacture', 'index' => $i, 'id' => 'prixhtva' . $i, 'champ' => 'prixhtva', 'type' => 'text',  'class' => 'form-control htb number getcalc getprixarticle', 'disabled' => true)); ?>
                              </td>
                              <td>
                                <?php echo $this->Form->input('remise', array('value' => $l->remise,  'label' => '', 'name' => 'data[Lignefacture][' . $i . '][remise]', 'table' => 'Lignefacture', 'index' => $i, 'id' => 'remise' . $i, 'champ' => 'remise', 'type' => 'text',   'class' => 'form-control getcalc htb number ', 'disabled' => true)); ?>
                              </td>


                              <td>

                                <?php echo $this->Form->input('totalht', array('value' => $l->totalht, 'label' => '', 'name' => 'data[Lignefacture][' . $i . '][totalht]', 'table' => 'Lignefacture', 'index' => $i, 'id' => 'ht' . $i, 'champ' => 'totalht', 'type' => 'text',  'class' => 'form-control getcalc htb number', 'disabled' => true)); ?>
                              </td>
                              <td>
                                <?php echo $this->Form->input('fodec', array('value' => (int) $l->fodec, 'label' => '', 'name' => 'data[Lignefacture][' . $i . '][fodec]', 'table' => 'Lignefacture', 'index' => $i, 'id' => 'fodec' . $i, 'champ' => 'fodec', 'type' => 'text', 'class' => 'form-control getcalc htb number  ', 'disabled' => true)); ?>
                              </td>
                              <td>
                                <?php echo $this->Form->input('tva', array('value' => $l->tva,  'label' => '', 'name' => 'data[Lignefacture][' . $i . '][tva]', 'table' => 'Lignefacture', 'index' => $i, 'id' => 'tva' . $i, 'champ' => 'tva', 'class' => 'form-control  getcalc htb number ', 'disabled' => true)); ?>

                              </td>
                              <td>
                                <?php echo $this->Form->input('totalttc', array('value' =>  $l->totalttc, 'div' => 'form-group', 'label' => '', 'name' => 'data[Lignefacture][' . $i . '][totalttc]', 'table' => 'Lignefacture', 'index' => $i, 'id' => 'totalttc' . $i, 'champ' => 'totalttc', 'type' => 'text', 'class' => 'form-control getcalc htb number', 'disabled' => true)); ?>
                              </td>

                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                      <input type="hidden" value="<?php echo $i; ?>" id="index" />
                    </div>
                  </div>
                </div>

                <div class="col-xs-6">
                  <?php //debug($factureavoirfrs);
                  echo $this->Form->control('remise', ['id' => 'remise', 'value'=>$factureavoirfrs->remise,'class' => 'form-control  ', 'readonly']); ?>
                </div>
                <div class="col-xs-6">
                  <?php
                  echo $this->Form->control('ht', ['id' => 'ht','value'=>$factureavoirfrs->totalht, 'class' => 'form-control  ', 'readonly']); ?>
                </div>

                <div class="col-xs-6">
                  <?php
                  echo $this->Form->control('fodec', ['id' => 'fodec', 'value'=>$factureavoirfrs->fodec,'class' => 'form-control', 'readonly']); ?>
                </div>
                <div class="col-xs-6">
                  <?php
                  echo $this->Form->control('ttc', ['id' => 'ttc','value'=>$factureavoirfrs->totalttc, 'class' => 'form-control  ', 'readonly']); ?>
                </div>
                <div class="col-xs-6">
                  <?php
                  echo $this->Form->control('tva', ['id' => 'tva','value'=>$factureavoirfrs->totaltva1, 'class' => 'form-control  ', 'readonly']); ?>
                </div>
              <?php } ?>

              <?php echo $this->Form->end(); ?>
              </div>
            </section>
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
  </section>



<?php  } else if ($factureavoirfrs->etat == 1) { ?>
  <section class="content-header">
    <h1>
      Consultation facture à voir
    </h1>
    <ol class="breadcrumb">
      <?php if ($type == 1) { ?>
        <a href="<?php echo $this->Url->build(['action' => 'index/' . $type]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a>
      <?php } else if ($type == 2) { ?>
        <a href="<?php echo $this->Url->build(['action' => 'index/' . $type]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a>
      <?php } ?>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box ">

          <!-- /.box-header -->
          <!-- form start -->
          <?php echo $this->Form->create($factureavoirfrs, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
          <div class="box-body">

            <div class="row">

              <div class="col-md-6">
                <?php
                echo $this->Form->control('numero', ['readonly' => 'readonly', 'disabled' => true]);
                ?>
              </div>
              <div class="col-md-6">
                <?php
                echo $this->Form->control('date', ['empty' => true, 'value' => date("d/m/Y"), 'class' => 'form-control', 'disabled' => true]);

                ?>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <?php
                echo $this->Form->control('fournisseur_id', ['empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 ', 'disabled' => true]);

                ?>
              </div>
              <div class="col-md-6">
                <?php
                echo $this->Form->control('depot_id', ['value' => $depots, 'class' => 'form-control select2', 'disabled' => true]);

                ?></div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <?php
                echo $this->Form->control('totalht', ['class' => 'form-control ', 'disabled' => true]);

                ?>
              </div>
              <div class="col-md-6">
                <?php
                echo $this->Form->control('tauxtva', ['class' => 'form-control ', 'disabled' => true]);

                ?></div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <?php
                echo $this->Form->control('tvaa', ['class' => 'form-control ', 'disabled' => true]);

                ?>
              </div>
              <div class="col-md-6">
                <?php
                echo $this->Form->control('totalttc', ['class' => 'form-control ', 'disabled' => true]);

                ?></div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <?php
                echo $this->Form->control('facture_id', ['class' => 'form-control ', 'disabled' => true]);

                ?>
              </div>

            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
<?php } ?>

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

<style>
  .select2-selection__rendered {
    line-height: 25px !important;
  }

  .select2-container .select2-selection--single {
    height: 35px !important;
    border-radius: 0 !important;
    box-shadow: none !important;
    border-color: #d2d6de !important;

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