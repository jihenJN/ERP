<?php

use Cake\Datasource\ConnectionManager;
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('hechem'); ?>
<?php echo $this->Html->script('controle_frs'); ?>
<?php

$titre = "Facture avoir";
$modl = 'avoirfr';
$index = 'index';

?>

<section class="content-header">
  <h1>
    Ajout facture à voir
  </h1>
  <ol class="breadcrumb">
    <?php //if ($type == 1) { 
    ?>
    <a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a>
    <?php //} else if ($type == 2) { 
    ?>
    <!-- <a href="<?php echo $this->Url->build(['action' => 'index/' . $type]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a> -->
    <?php //} 
    ?>
  </ol>
</section>

<!-- Main content -->
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
              echo $this->Form->control('numero', ["value" => $numero, 'readonly' => 'readonly']);


              ?>
            </div>
            <div class="col-xs-6">
              <?php echo $this->Form->control('date', ["value" => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime(date('Y-m-d H:i:s'))))]) ?>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <?php
              echo $this->Form->control('fournisseur_id', ['value' => $fac->fournisseur_id, 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 ']);

              ?>
            </div>
            <div class="col-md-6">
              <?php
              echo $this->Form->control('depot_id', ['value' => $depots, 'class' => 'form-control select2']);

              ?></div>
          </div>

        </div>


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
                      <tr>
                        <th align="center" style="width: 12%; font-size: 16px;">Code</th>
                        <th align="center" style="width: 20%; font-size: 16px;">Désignation</th>
                        <th align="center" style="width: 8%; font-size: 16px;">Qté</th>
                        <th align="center" style="width: 8%; font-size: 16px;color:#ff0000">Qté Av</th>

                        <!-- <th scope="col" >Qté KG</th>
                                                <th scope="col" style="color:#ff0000">Qté KG Av</th> -->

                        <th align="center" style="width: 12%; font-size: 16px;">PUNHT </th>
                        <th align="center" style="width: 5%; font-size: 16px;">Remise</th>
                        <th align="center" style="width: 12%; font-size: 16px;">Prix HT</th>
                        <th align="center" style="width: 5%; font-size: 16px;">Fodec</th>
                        <th align="center" style="width: 5%; font-size: 16px;">TVA</th>
                        <!-- <th scope="col">TTC</th> -->
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $connection = ConnectionManager::get('default');
                       $i=-1;
                    //  var_dump($i);
                      foreach ($lignefactures as  $l) {
                        //debug($l);die;
                     

                        $comliv = $connection->execute('SELECT sum((lignefactureavoirfrs.quantite)) as somqte FROM lignefactureavoirfrs 
                                            WHERE lignefactureavoirfrs.lignefacture_id= ' . $l->id . ' AND lignefactureavoirfrs.article_id= ' . $l->article_id . ' ')->fetchAll('assoc');



                        if ($comliv != array()) {

                          $liv = ($l->qte) - $comliv[0]['somqte'];
                        }
                        if ($liv != 0) { 
                           $i++; 
                          //var_dump($i);?>
                          <tr class="cc">
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
                            <!-- <td>

                              <?php echo $this->Form->control('article_id', array('label' => false,  'value' => $l->article_id, 'options' => $art, 'name' => 'data[Lignefacture][' . $i . '][article_id]', 'id' => 'article_id' . $i,  'index' => $i, 'class' => 'form-control')); ?>

                            </td> -->
                            <td hidden>

                              <div>
                                <!-- <label></label> -->
                                <select name="data[Lignefacture][<?= h($i) ?>][unitearticle_id]" id="unitearticle_id<?= h($i) ?>" style="pointer-events: none;" readonly class="form-control">
                                  <option value="">Veuillez choisir !!</option>
                                  <?php foreach ($unitearticles as $unite) : ?>
                                    <option readonly value="<?= h($unite->id) ?>" <?php if ($unite->id == $l->unitearticle_id) {
                                                                                    echo "selected";
                                                                                  } ?>><?= h($unite->name) ?></option>
                                  <?php endforeach; ?>
                                </select>
                            </td>
                            <td>

                              <?php echo $this->Form->input('id', array('value' => $l->id, 'name' => 'data[Lignefacture][' . $i . '][id]', 'id' => 'id' . $i, 'champ' => 'id', 'table' => $ligne_model, 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'type' => 'hidden', 'after' => '</div>', 'class' => 'form-control htbavoir', 'label' => 'Nom')); ?>
                              <?php

                              if ($comliv != array()) {
                                echo $this->Form->input('somqte', array('value' => $comliv[0]['somqte'], 'label' => '', 'id' => 'somqte' . $i, 'name' => 'data[Lignefacture][' . $i . '][somqte]', 'table' => 'Lignefacture', 'champ' => 'somqte', 'index' => $i,  'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbavoir', 'type' => 'hidden'));

                                $liv = ($l->qte) - $comliv[0]['somqte'];
                              }
                              echo $this->Form->input('qtea', array('name' => 'data[Lignefacture][' . $i . '][qtea]', 'readonly', 'value' => $liv, 'label' => '', 'div' => 'form-group', 'table' => $ligne_model, 'index' => $i, 'id' => 'qtea' . $i, 'champ' => 'qtea', 'type' => 'text', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbavoir')); ?>

                            </td>
                            <td>
                              <?php

                              echo $this->Form->input('quantite', array('value' => '0', 'label' => '', 'name' => 'data[Lignefacture][' . $i . '][quantite]', 'table' => $ligne_model, 'index' => $i, 'id' => 'qte' . $i, 'champ' => 'quantite', 'type' => 'text', 'class' => 'form-control  testqte htbavoir number')); ?>

                            </td>
                            <td>
                              <?php echo $this->Form->input('prix', array('value' => $l->prix, 'label' => '', 'name' => 'data[Lignefacture][' . $i . '][prix]', 'table' => $ligne_model, 'index' => $i, 'id' => 'prix' . $i, 'champ' => 'prix', 'type' => 'text', 'class' => 'form-control htbavoir number  getprixarticle')); ?>


                            </td>
                            <td>
                              <?php echo $this->Form->input('remise', array('value' => $l->remise, 'label' => '', 'name' => 'data[Lignefacture][' . $i . '][remise]', 'table' => $ligne_model, 'index' => $i, 'id' => 'remise' . $i, 'champ' => 'remise', 'type' => 'text', 'class' => 'form-control   htbavoir number ')); ?>
                            </td>


                            <td>

                              <?php echo $this->Form->input('totalht', array('value' => $l->ht, 'readonly' => 'readonly', 'label' => '', 'name' => 'data[Lignefacture][' . $i . '][totalht]', 'table' => $ligne_model, 'index' => $i, 'id' => 'punht' . $i, 'champ' => 'totalht', 'type' => 'text', 'class' => 'form-control  ')); ?>
                            </td>
                            <td>
                              <?php echo $this->Form->input('fodec', array('value' => $l->fodec, 'label' => '', 'name' => 'data[Lignefacture][' . $i . '][fodec]', 'table' => $ligne_model, 'index' => $i, 'id' => 'fodec' . $i, 'champ' => 'fodec', 'type' => 'text', 'class' => 'form-control  htbavoir number ')); ?>
                            </td>
                            <td>
                              <?php echo $this->Form->input('tva', array('value' => $l->tva,  'label' => '', 'name' => 'data[Lignefacture][' . $i . '][tva]', 'table' => $ligne_model, 'index' => $i, 'id' => 'tva' . $i, 'champ' => 'tva', 'class' => 'form-control   htbavoir number ')); ?>

                            </td>
                            <td hidden>
                              <?php echo $this->Form->input('totalttc', array('value' =>  $l->ttc, 'label' => '', 'name' => 'data[Lignefacture][' . $i . '][totalttc]', 'table' => $ligne_model, 'index' => $i, 'id' => 'ttc' . $i, 'champ' => 'totalttc', 'type' => 'text', 'class' => 'form-control  htbavoir number ')); ?>
                            </td>

                          </tr>
                      <?php }
                      } ?>
                    </tbody>
                  </table><br>
                  <input type="hidden" value="<?php echo $i; ?>" id="index" />
                </div>

              </div>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('remise', ['id' => 'remise', 'name' => 'remise', 'class' => 'form-control  ', 'readonly']); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('ht', ['id' => 'ht', 'name' => 'totalht', 'class' => 'form-control  ', 'readonly']); ?>
            </div>

            <div class="col-xs-6">
              <?php
              echo $this->Form->control('fodec', ['id' => 'fodec', 'name' => 'fodec', 'class' => 'form-control', 'readonly']); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('ttc', ['id' => 'ttc', 'name' => 'totalttc', 'class' => 'form-control  ', 'readonly']); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('tva', ['id' => 'tva', 'name' => 'totaltva', 'class' => 'form-control  ', 'readonly']); ?>
            </div>

            <button type="submit" class="pull-right btn btn-success btn-sm " style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
            <?php echo $this->Form->end(); ?>
          </div>
        </section>
      </div>
      <!-- /.box -->
    </div>
  </div>
  <!-- /.row -->
</section>


<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
     $(document).ready(function() {
        $(".testqte").on("keyup", function() {
            const index = $(this).attr('index');
            const qteFacture = parseFloat($("#qtea" + index).val()) || 0;
            const qteAv = parseFloat($("#qte" + index).val()) || 0;

            if (qteFacture < qteAv) {
                alert(`Veuillez vérifier: La quantité facturée (${qteFacture}) ne peut pas être inférieure à la quantité disponible (${qteAv}).`);
                $("#qte" + index).val(0);
            }
        });

    });
  $(document).ready(function() {
    calculeavoir();
    $('.htbavoir').on('keyup', function() {
      //  alert('aaaaaaaaa');
      calculeavoir();

    });
  });

  function calculeavoir() {
    index = $('#index').val(); //alert(index)

    //  alert(index);

    totalremise = 0;
    totalht = 0;
    totalfodec = 0;
    totaltva = 0;
    totalttc = 0;
    for (i = 0; i <= index; i++) {
      // sup = $('#sup0' + i).val() || 0;
      // alert(sup)
      // if (Number(sup) != 1) {


      fodecl = 0;
      ht = 0;
      tval = 0;
      ttcl = 0;
      punht = 0;
      qte = $('#qte' + i).val() || 0;
      prix = $('#prix' + i).val() || 0;
      remise = $('#remise' + i).val() || 0;


      fodec = $('#fodec' + i).val();
      // alert(fodec);
      tva = $('#tva' + i).val();
      // alert(tva);
      punht = punht + (Number(qte) * Number(prix));
      //alert(punht);
      remisel = ((Number(qte) * Number(prix)) * Number(remise / 100));
      //  alert(remisel);
      totalapreremise = punht - remisel;
      $('#montantht' + i).val(Number(totalapreremise).toFixed(3));
      // alert(totalapreremise);
      totalremise = Number(totalremise) + Number(remisel);
      $('#punht' + i).val(Number(punht).toFixed(3));

      ht = (Number(qte) * Number(prix)) - Number(remisel);
      $('#ht' + i).val(Number(ht).toFixed(3));
      // alert(ht); 

      totalht = Number(totalht) + Number(ht);
      fodecl = Number(ht) * Number(fodec / 100);
      totalfodec = Number(totalfodec) + Number(fodecl);
      htfodec = Number(ht) + Number(fodecl);
      tval = Number(htfodec) * Number(tva / 100);
      totaltva = Number(totaltva) + Number(tval);
      ttcl = Number(htfodec) + Number(tval);
      $('#ttc' + i).val(Number(ttcl).toFixed(3));
      totalttc = Number(totalttc) + Number(ttcl);
      // }
    }
    //timbre=$('#timbre').val()||0;
    //totalttc=Number(totalttc)+Number(timbre);
    // $('#punht').val(Number(punht).toFixed(3));
    $('#remise').val(Number(totalremise).toFixed(3));
    $('#ht').val(Number(totalht).toFixed(3));
    $('#fodec').val(Number(totalfodec).toFixed(3));
    $('#tva').val(Number(totaltva).toFixed(3));
    $('#ttc').val(Number(totalttc).toFixed(3));

  }
</script>
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