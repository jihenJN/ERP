<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pointdevente $pointdevente
 */
?>
<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<section class="content-header">
  <h1>
    Modifier site
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


      <!-- /.box-header -->
      <!-- form start -->
      <?php echo $this->Form->create($pointdevente, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>

      <div class="box ">
        <div class="row">
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('code', ['readonly']); ?>
          </div>
          <div class="col-xs-6">
            <?php echo $this->Form->control('name',['label'=>'Nom']); ?>
          </div>
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('adresse'); ?>
          </div>

          <div class="col-xs-6">
            <?php
            echo $this->Form->control('matriclefiscale', ['label' => 'Matricle Fiscale']); ?>
          </div>
          
          <!-- /.box-header -->
          <!-- form start -->
          <!-- /.box-body -->
          <button type="submit" class="pull-right btn btn-success btn-sm" id="pointv" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
          <?php echo $this->Form->end(); ?>
        </div>

      </div>
      <!-- /.box -->
    </div>
  </div>
  <!-- /.row -->
</section>
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<?php $this->start('scriptBottom'); ?>
<?php echo $this->Html->script('alert'); ?>
<script>
  $('.select2').select2()
</script>
<?php $this->end(); ?>