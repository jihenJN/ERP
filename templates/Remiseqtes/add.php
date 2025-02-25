<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Activite $activite
 */
?>
<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<!--  -->
<section class="content-header">
  <h1>
  Ajouter Remise/comptant
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
        <?php echo $this->Form->create($remiseqte, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
        <div class="box-body">
          <div class="col-xs-6">
            <?php


            echo $this->Form->control('code', ['value' => $code, 'label' => 'Code', 'required' => 'off', 'id' => 'code', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => '', 'readonly' => 'readonly']); ?>
          </div>
          <section class="content" style="width: 99%">
            <div>
              <a class="btn btn-primary aj33 " data-toggle="modal" data-target="#modal-default" table='addtable' index='index' id='ajouter_ligne3' style="
               float: right;
               margin-bottom: 20px;
               ">
                <i class="fa fa-plus-circle "></i> Ajouter Remise/comptant</a>
              <table class="table table-bordered table-striped table-bottomless" id="tabligne3">
                <thead>
                  <tr>
                    <!-- <th><?= ('Article') ?></th> -->
                    <th><?= ('Montant  MIN') ?></th>
                    <th><?= ('Montant  MAX') ?></th>
                    <th><?= ('Pourcentage %') ?></th>
                  </tr>
                </thead>
                <tbody>
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
              <input type="hidden" value=-1 id="in">
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