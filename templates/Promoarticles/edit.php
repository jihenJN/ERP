<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Activite $activite
 */

use function PHPSTORM_META\type;

?>
<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<?php echo $this->Html->css('select2'); ?>

<section class="content-header">

  <h1>
    Promo article
    <small><?php echo __(''); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box">
        <?php echo $this->Form->create($promoarticle, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
        <div class="box-body">
          <div class="col-xs-7">
            <?php
            echo $this->Form->control('typeclient_id', ['label' => 'Type client', 'id' => 'type', "class" => "form-control select2", 'empty' => 'Veuillez choisir !!', 'option' => $typeclients]); ?>
          </div>
          <div class="col-xs-6" style="margin-bottom: 10px;">
            <input style="margin-left: 10%;" type="radio" id="gouv" class="gouven" name="gouv" value=0 <?php if ($promoarticle->gouv == 0) { ?> checked <?php } ?>>&nbsp;&nbsp; Tout Gouvernorat
            <input style="margin-left: 10%;" type="radio" id="gouv1" class="gouven" name="gouv" value=1 <?php if ($promoarticle->gouv == 1) { ?> checked <?php } ?>>&nbsp;&nbsp; Personnalisé
          </div>
          <div class="col-xs-6" style="margin-bottom: 10px;">
            <input style="margin-left: 10%;" type="radio" id="parnat" class="valeur" name="type" value=0 <?php if ($promoarticle->type == 0) { ?> checked <?php } ?>>&nbsp;&nbsp; Par nature
            <input style="margin-left: 10%;" type="radio" id="parval" class="valeur" name="type" value=1 <?php if ($promoarticle->type == 1) { ?> checked <?php } ?>>&nbsp;&nbsp; Par valeur
          </div>
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('datedebut', ['label' => 'Date debut', "class" => "form-control", 'type' => 'date']); ?>
          </div>
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('datefin', ['label' => 'Date fin', "class" => "form-control", 'type' => 'date']); ?>
          </div>
         <section class="content" <?php if ($promoarticle->gouv == 0) { ?> style="display:none;" <?php } ?> id="pro">
            <div class="box-body">
              <table id="tabligne" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width="40%" class=" text-left"><?= ('Gouvernorats') ?></th>
                    <th width="10%" class=" text-center"><button type="button"><i class="fa fa-eye text-red relver"></i></button></th>
                  </tr>
                </thead>
                <tbody class='cli'style="display: none;">

                  <?php
                  foreach ($gouvpromoarticles as $i => $gouvpromoarticle) :
                  ?>
                    <tr>
                      <td hidden>
                        <?php
                        echo $this->Form->control('sup', ["label" => "", "name" => "data[gouvpromoarticles][$i][sup]", "id" => 'sup' . $i, "index" => $i]);
                        ?>
                      </td>
                      <td hidden><?php echo $this->Form->control($gouvpromoarticle->gouvernorat_id, ["value" => $gouvpromoarticle->gouvernorat_id, "label" => "", "name" => "data[gouvpromoarticles][$i][gouvernorat_id]", "id" => 'gouvernorat_id' . $i, "index" => $i]); ?></td>
                      <td align="left"><?php echo $gouvpromoarticle->gouvernorat->name ?></td>
                      <td hidden>
                        <input type="checkbox" index="<?php echo $i ?>" id="gouv<?php echo $i ?>" name="data[gouvpromoarticles][<?php echo $i ?>][toutgouv]" champ="toutgouv" value="0" <?php if ($gouvpromoarticle->toutgouv == 0) { ?> <?php } ?>>
                      </td>
                      <td align="center">
                        <input type="checkbox" index="<?php echo $i ?>" id="gouv<?php echo $i ?>" name="data[gouvpromoarticles][<?php echo $i ?>][toutgouv]" champ="toutgouv" value="1" <?php if ($gouvpromoarticle->toutgouv == 1) { ?> checked <?php } ?>>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                  <input type="hidden" value=<?php echo $i ?> id="index">
                </tbody>
              </table>
            </div>
          </section>
          <section class="content" <?php if ($promoarticle->gouv == 1) { ?> style="display:none;" <?php } ?> id="per">
            <div class="box-body">
              <table id="tabligne" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width="40%" class=" text-center"><?= ('Gouvernorats') ?></th>
                    <th width="10%" class=" text-center"><button type="button"><i class="fa fa-eye text-red relver"></i></button></th>
                  </tr>
                </thead>
                <tbody class='cli' style="display: none;">

                  <?php
                  foreach ($gouvpromoarticles as $i => $gouvpromoarticle) :
                  ?>
                    <tr>
                      <td hidden>
                        <?php
                        echo $this->Form->control('sup', ["label" => "", "name" => "data[gouvpromoarticles][$i][sup]", "id" => 'sup' . $i, "index" => $i]);
                        ?>
                      </td>
                      <td hidden><?php echo $this->Form->control($gouvpromoarticle->gouvernorat_id, ["value" => $gouvpromoarticle->gouvernorat_id, "label" => "", "name" => "data[gouvpromoarticles][$i][gouvernorat_id]", "id" => 'gouvernorat_id' . $i, "index" => $i]); ?></td>
                      <td align="center" readonly><?php echo $gouvpromoarticle->gouvernorat->name ?></td>
                    </tr>
                  <?php endforeach; ?>
                  <input type="hidden" value=<?php echo $i ?> id="index">
                </tbody>
              </table>
            </div>
          </section>
         
          <section class="content" <?php if ($promoarticle->type == 0) { ?> style="display:none;" <?php } ?> id="valeur">
            <div>
              <a class="btn btn-primary aj33 " data-toggle="modal" data-target="#modal-default" table='addtable' index='index' id='ajouter_ligne3' style="
               margin-bottom: 20px;
               margin-top: 50px;
               margin-left: 89%;
               ">
                <i class="fa fa-plus-circle "></i> Ajouter Article promo</a>
              <table class="table table-bordered table-striped table-bottomless" id="tabligne3">
                <thead>
                  <tr>
                    <th width="35%"><?= ('Article') ?></th>
                    <th width="20%"><?= ('MIN') ?></th>
                    <th width="20%"><?= ('MAX') ?></th>
                    <th width="20%"><?= ('Valeur') ?></th>
                    <th width="5%"><?= ('') ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $j = -1;
                  foreach ($lignepromoarticles as $j => $lignepromoarticle) :
                  ?>
                    <tr>
                      <td>
                        <?php echo $this->Form->input('id', array('champ' => 'id', "value" => $lignepromoarticle->id, 'name' => 'data[lignepromoarticles][' . $j . '][id]', 'table' => 'lignepromoarticles', 'class' => 'form-control', 'type' => 'hidden')); ?>
                        <?php echo $this->Form->input('sup0', array('champ' => 'sup0',  'name' => 'data[lignepromoarticles][' . $j . '][sup0]', 'table' => 'lignepromoarticles', "id" => "sup0" . $j, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                        <select table="lignepromoarticles" index champ="article_id" class="form-control " name="data[lignepromoarticles][<?php echo $j ?>][article_id]">
                          <option value="<?php echo $lignepromoarticle->article->id; ?>"><?php echo $lignepromoarticle->article->Code . ' ' . $lignepromoarticle->article->Dsignation ?></option>
                        </select>
                      </td>
                      <td align="center">
                        <?php echo $this->Form->control('min', ["value" => $lignepromoarticle->min, 'name' => 'data[lignepromoarticles][' . $j . '][min]', "champ" => "min", "id" => "min" . $j, "index" =>  $j, "label" => "", "class" => "form-control aj3", "table" => "lignepromoarticles", "step" => "1", "type" => "number"]); ?>
                      </td>
                      <td align="center">
                        <?php echo $this->Form->control('max', ["value" => $lignepromoarticle->max, 'name' => 'data[lignepromoarticles][' . $j . '][max]', "champ" => "max", "id" => "max" . $j, "index" =>  $j, "label" => "", "class" => "form-control aj3", "table" => "lignepromoarticles", "step" => "1", "type" => "number"]); ?>
                      </td>
                      <td align="center">
                        <?php echo $this->Form->control('value', ["value" => $lignepromoarticle->value, 'name' => 'data[lignepromoarticles][' . $j . '][value]', "champ" => "value", "id" => "value" . $j, "index" =>  $j, "label" => "", "class" => "form-control aj3", "table" => "lignepromoarticles"]); ?>
                      </td>
                      <td align="center"><i index="<?php echo $j ?>" class="fa fa-times supLignepromo" style="color: #C9302C;font-size: 22px;"></td>
                    </tr>
                  <?php endforeach; ?>
                  <tr class="tr" style="display: none ;">
                    <td align="center">
                     <input type="hidden" name="" id="" champ="sup0" table="lignepromoarticles" index="" class="form-control">
                      <select table="lignepromoarticles" index champ="article_id" class="form-control ">
                        <option value="" selected="selected">Veuillez choisir !!</option>
                        <?php foreach ($articles as $id => $article) {
                        ?>
                          <option value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                        <?php } ?>
                      </select>
                    </td>
                    <td align="center">
                      <input table="lignepromoarticles" step="1" type="number" class="form-control " index="" name="" id="" champ="min">
                    </td>
                    <td align="center">
                      <input table="lignepromoarticles" step="1" type="number" class="form-control " index="" name="" id="" champ="max">
                    </td>
                    <td align="center">
                      <input table="lignepromoarticles" type="text" class="form-control " index="" name="" id="" champ="value">
                    </td>
                    <td align="center">
                      <i index="" id="" class="fa fa-times supLignepromo" style="color: #c9302c;font-size: 22px;"></i>
                    </td>
                  </tr>
                </tbody>
              </table>
              <input type="hidden" value="<?php echo $j ?>" id="in">
            </div>
          </section>
          <section class="content" <?php if ($promoarticle->type == 1) { ?> style="display:none;" <?php } ?> id="nature">
            <div>
              <a class="btn btn-primary aj33 " data-toggle="modal" data-target="#modal-default" table='addtable' index='index' id='ajouter_promo' style="
               margin-bottom: 20px;
               margin-top: 50px;
               margin-left: 83%;
               ">
                <i class="fa fa-plus-circle "></i> Ajouter Article promo</a>
              <table class="table table-bordered table-striped table-bottomless" id="tabligne333">
                <thead>
                  <tr>
                    <th width="45%"><?= ('Article') ?></th>
                    <th width="30%"><?= ('QTE') ?></th>
                    <th width="20%"><?= ('Valeur') ?></th>
                    <th width="5%"><?= ('') ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $p = -1;
                  foreach ($natlignepromoarticles as $p => $natlignepromoarticle) :
                    //debug($natlignepromoarticle)
                  ?>
                    <tr>
                      <td>
                        <?php echo $this->Form->input('id', array('champ' => 'id', "value" => $natlignepromoarticle->id, 'name' => 'data[natlignepromoarticles][' . $p . '][id]', 'table' => 'natlignepromoarticles', 'class' => 'form-control', 'type' => 'hidden')); ?>
                        <?php echo $this->Form->input('supn', array('champ' => 'supn',  'name' => 'data[natlignepromoarticles][' . $p . '][supn]', 'table' => 'natlignepromoarticles', "id" => "supn" . $p, 'index' => $p, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                        <select table="natlignepromoarticles" index champ="article_id" class="form-control select2 " name="data[natlignepromoarticles][<?php echo $p ?>][article_id]">
                          <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                        <?php foreach ($articles as $id => $article) {
                            ?>
                            <option <?php if ($natlignepromoarticle->article_id == $article->id) { ?> selected="selected" <?php } ?> value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                        <?php } ?>                        </select>
                      </td>
                      <td align="center">
                        <?php echo $this->Form->control('qte', ["value" => $natlignepromoarticle->qte, 'name' => 'data[natlignepromoarticles][' . $p . '][qte]', "champ" => "qte", "id" => "qte" . $p, "index" =>  $p, "label" => "", "class" => "form-control aj3", "table" => "natlignepromoarticles", "step" => "1", "type" => "number"]); ?>
                      </td>
                      <td align="center">
                        <?php echo $this->Form->control('value', ["value" => $natlignepromoarticle->value, 'name' => 'data[natlignepromoarticles][' . $p . '][value]', "champ" => "value", "id" => "value" . $p, "index" =>  $p, "label" => "", "class" => "form-control aj3", "table" => "natlignepromoarticles"]); ?>
                      </td>
                      <td align="center"><i index="<?php echo $p ?>" class="fa fa-times suppromo" style="color: #C9302C;font-size: 22px;"></td>
                    </tr>
                  <?php endforeach; ?>
                  <tr class="tr" style="display: none !important">
                    <td align="center">
                      <input type="hidden" name="" id="" champ="supn" table="natlignepromoarticles" index="" class="form-control">
                      <select table="natlignepromoarticles" index champ="article_id" class="form-control ">
                        <option value="" selected="selected">Veuillez choisir !!</option>
                        <?php foreach ($articles as $id => $article) {
                        ?>
                          <option value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                        <?php } ?>
                      </select>
                    </td>
                    <td align="center">
                      <input table="natlignepromoarticles" step="1" type="number" class="form-control " index="" name="" id="" champ="qte">
                    </td>
                    <td align="center">
                      <input table="natlignepromoarticles" type="text" class="form-control " index="" name="" id="" champ="value">
                    </td>
                    <td align="center">
                      <i index="" id="" class="fa fa-times suppromo" style="color: #c9302c;font-size: 22px;"></i>
                    </td>
                  </tr>
                </tbody>
              </table>
              <input type="hidden" value="<?php echo $p ?>" id="indexx">
            </div>
          </section>
          <button type="submit" class="pull-right btn btn-success " id="pour" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
          
          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
</section>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
  $(function() {
    $('.select2').select2()
    //alert('m')
    $('.gouven').on('change', function() {
      m = 0;
      if ($('#gouv1').is(':checked')) {
        m = 1;
      }
      if ($('#gouv').is(':checked')) {
        m = 2;
      }
      //alert(m)
      if (m == 1) {
        $('#pro').attr('style', "display:true;");
        $('#per').attr('style', "display:none;");
      } else {
        $('#pro').attr('style', "display:none;");
        $('#per').attr('style', "display:true;");
      }
      if (m == 2) {
        $('#per').attr('style', "display:true;");
        $('#pro').attr('style', "display:none;");
      } else {
        $('#per').attr('style', "display:none;");
        $('#pro').attr('style', "display:true;");
      }
    });
    $('.valeur').on('change', function() {
      v = 0;
      if ($('#parval').is(':checked')) {
        v = 1;
      }
      if ($('#parnat').is(':checked')) {
        v = 2;
      }
      //alert(m)
      if (v == 1) {
        $('#valeur').attr('style', "display:true;");
        $('#nature').attr('style', "display:none;");
      }
      if (v == 2) {
        $('#valeur').attr('style', "display:none;");
        $('#nature').attr('style', "display:true;");
      }
    });
  });
</script>
<style>
  .select2-selection__rendered {
    line-height: 25px !important;
  }

  .select2-container .select2-selection--multiple {
    height: auto !important;
    border-radius: 0 !important;
    box-shadow: none !important;
    border-color: #D2D6DE !important;
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
<?php $this->end(); ?>