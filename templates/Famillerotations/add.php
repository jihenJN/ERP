<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Personnel $personnel
 */
?>
<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<section class="content-header">
  <h1>
  Famille de roation
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
      <div class="box ">

        <!-- /.box-header -->
        <!-- form start -->
        <?php echo $this->Form->create($famillerotation, ['role' => 'form']); ?>
        <div class="box-body">
          <div class="row">
          <div class="col-xs-6">
              <?php
              echo $this->Form->control('code', ['value' => $code, 'label' => 'Code', 'required' => 'off', 'id' => 'code', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => '', 'readonly' => 'readonly']); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('name'); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('txmin',['placeholder'=>'99.99','label' => 'Taux de minoration']); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('txmax',['placeholder'=>'99.99','label' => 'Taux de majoration']); ?>
            </div>
            <button type="submit" class="pull-right btn btn-success btn-sm " id="testpersonnel" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
            <?php echo $this->Form->end(); ?>
          </div>
          <!-- /.box-body -->
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
