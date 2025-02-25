<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Remiseescompte $remiseescompte
 */
?>
<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<section class="content-header">
<?php echo $this->Html->script('alert'); ?>
  <h1>
  Remise/Escompte
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
        <?php echo $this->Form->create($remiseescompte, [
          'role' => 'form', 'type' => 'file', 'onkeypress' => "return event.keyCode!=13"
        ]); ?>
        <div class="box-body">

        <div class="col-xs-6">
          <?php
          echo $this->Form->control('typeclient_id', ['id' => 'typeclient_id', 'options' => $typeclient,  'label' => 'type client ', 'class' => 'form-control ff select2','empty' => 'Veuillez choisir !!']);
          ?>
        </div>

          <a class="btn btn-primary aj33 " data-toggle="modal" data-target="#modal-default" table='addtable' index='index' id='ajouter_ligne3' style="
               float: right;
               margin-bottom: 20px;
               ">
            <i class="fa fa-plus-circle "></i> Remise/Escompte</a>
          <table class="table table-bordered table-striped table-bottomless" id="tabligne3">
            <thead>
              <tr>
                <th><?= ('Montant MIN') ?></th>
                <th><?= ('Montant MAX') ?></th>
                <th><?= ('Pourcentage %') ?></th>
                <th><?= ('') ?></th>
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
                   </td>
                  <td style="width: 30%;" align="center">
                    <?php echo $this->Form->control('qtemax', ["value" => $remiseqte->qtemax, 'name' => 'data[remiseqtes1][' . $i . '][qtemax]', "champ" => "qtemax", "id" => "qtemax" . $i, "index" =>  $i, "label" => "", "class" => "form-control aj3", "table" => "remiseqtes1"]); ?>
                  </td>
                  <td style="width: 30%;" align="center">
                    <?php echo $this->Form->control('pourcentage', ["value" => $remiseqte->pourcentage, "placeholder" => "99.99", 'name' => 'data[remiseqtes1][' . $i . '][pourcentage]', "champ" => "pourcentage", "id" => "pourcentage" . $i, "index" =>  $i, "label" => "", "class" => "form-control aj3", "table" => "remiseqtes1"]); ?>
                  </td>
                  <td align="center"><i index="<?php echo $i ?>" class="fa fa-times supLigne" style="color: #C9302C;font-size: 22px;">
                  <?php echo $this->Form->input('sup', array('name' => 'data[remiseqtes1][' . $i . '][sup]', 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'remiseqtes1', 'index' => $i, 'type' => 'hidden'));?>
                  </td>
                </tr>
              <?php endforeach; ?>
              <tr class="tr" style="display: none !important">

                <td align="center">
                  
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
                  <input type="hidden" name="" id="" champ="sup" table="remiseqtes1" index="" class="form-control">
                </td>
              </tr>
            </tbody>
          </table>
          <input type="hidden" value="<?php echo $i ?>" id="in">
          <br><br>
          <button type="submit" class="pull-right btn btn-success btn-sm" id="test" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>

          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box-body -->


      </div>
      <!-- /.box -->
    </div>
  </div>
  <!-- /.row -->
</section>


<style>
.select2-selection__rendered {
    line-height: 25px !important;
}

.select2-container
.select2-selection--single{
  height: 35px !important;
    border-radius: 0 !important;
    box-shadow: none !important;
    border-color: #d2d6de !important;

}

.select2-selection__arrow {
    height: 34px !important;
   
}
.select2-selection__choice{
  height: 24px !important;
  color: black !important;
  background-color: white !important;
  font-size: 18px !important;
}
.select2-container
{
  display: block;
  width:auto !important;
}
</style>

  <!-- Select2 -->
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>

<?php $this->start('scriptBottom'); ?>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
    </script>
<?php $this->end(); ?>
