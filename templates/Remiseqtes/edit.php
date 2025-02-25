<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Societe $societe
 */
?>
<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<section class="content-header">
  <h1>
    Remise/comptant
    <small><?php echo __(''); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
</section>
<br />
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box">

        <!-- /.box-header -->
        <!-- form start -->
        <?php echo $this->Form->create($remiseqtes, [
          'role' => 'form', 'type' => 'file', 'onkeypress' => "return event.keyCode!=13"
        ]); ?>
        <div class="box-body">
          <?php
          echo $this->Form->control('code', ['value' => $remise->code, 'readonly' => 'readonly','label'=>'Remise Code']); ?>
          <a class="btn btn-primary aj33 " data-toggle="modal" data-target="#modal-default" table='addtable' index='index' id='ajouter_ligne3' style="
               float: right;
               margin-bottom: 20px;
               ">
            <i class="fa fa-plus-circle "></i> Ajouter Remise/comptant</a>
          <table class="table table-bordered table-striped table-bottomless" id="tabligne3">
            <thead>
              <tr>
                <th><?= ('Montant MIN') ?></th>
                <th><?= ('Montant MAX') ?></th>
                <th><?= ('Pourcentage') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = -1;
              foreach ($remiseqtes as $i => $remiseqte) :
              ?>
                <tr>
                  <td style="width: 30%;" align="center">
                    <?php echo $this->Form->control('qtemin', ["value" => $remiseqte->qtemin, 'name' => 'data[remiseqtes1][' . $i . '][qtemin]', "champ" => "qtemin", "id" => "qtemin" . $i, "index" =>  $i, "label" => "", "class" => "form-control aj3", "table" => "remiseqtes1"]); ?>
                    <?php echo $this->Form->input('sup', array('champ' => 'sup', 'table' => 'remiseqtes1', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                  </td>
                  <td style="width: 30%;" align="center">
                    <?php echo $this->Form->control('qtemax', ["value" => $remiseqte->qtemax, 'name' => 'data[remiseqtes1][' . $i . '][qtemax]', "champ" => "qtemax", "id" => "qtemax" . $i, "index" =>  $i, "label" => "", "class" => "form-control aj3", "table" => "remiseqtes1"]); ?>
                  </td>
                  <td style="width: 30%;" align="center">
                    <?php echo $this->Form->control('pourcentage', ["value" => $remiseqte->pourcentage, "placeholder" => "99.99", 'name' => 'data[remiseqtes1][' . $i . '][pourcentage]', "champ" => "pourcentage", "id" => "pourcentage" . $i, "index" =>  $i, "label" => "", "class" => "form-control aj3", "table" => "remiseqtes1"]); ?>
                  </td>
                  <td align="center"><i index="<?php echo $i ?>" class="fa fa-times supLigne" style="color: #C9302C;font-size: 22px;"></td>
                </tr>
              <?php endforeach; ?>
              <tr class="tr" style="display: none !important">

                <td align="center">
                  <input type="hidden" name="" id="" champ="sup" table="remiseqtes1" index="" class="form-control">
                  <input table="remiseqtes1" type="text" class="form-control aj3" index="" name="" id="" champ="qtemin">
                </td>
                <td align="center">
                  <input table="remiseqtes1" type="text" class="form-control  aj3" index="" name="" id="" champ="qtemax" value="">
                </td>
                <td align="center">
                  <input table="remiseqtes1" type="text" class="form-control " index="" name="" id="" champ="pourcentage" placeholder="99.99">
                </td>
                <td align="center">
                  <i index="" id="" class="fa fa-times supLigne" style="color: #c9302c;font-size: 22px;"></i>
                </td>
              </tr>
            </tbody>
          </table>
          <input type="hidden" value="<?php echo $i ?>" id="in">
          <br><br>
          <button type="submit" class="pull-right btn btn-success btn-sm" id="pour" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>

          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box-body -->


      </div>
      <!-- /.box -->
    </div>
  </div>
  <!-- /.row -->
</section>
<?php echo $this->Html->script('alert'); ?>