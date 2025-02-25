<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Societe $societe
 */

use PhpParser\Node\Stmt\Label;
?>
<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<section class="content-header">
  <h1>
    Societe
    <small><?php echo __(''); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box ">
        <?php echo $this->Form->create($societe, [
          'role' => 'form', 'type' => 'file', 'onkeypress' => "return event.keyCode!=13",
        ]); ?>
        <div class="box-body">
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('nom', ['label' => 'nom *']); ?>
          </div>
          <div class="col-xs-6">
            <?php echo $this->Form->control('capital'); ?>
          </div>
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('adresse'); ?>
          </div>
          <div class="col-xs-6">
            <?php echo $this->Form->control('tel'); ?>
          </div>
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('mail'); ?>
          </div>
          <div class="col-xs-6">
            <?php echo $this->Form->control('site'); ?>
          </div>
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('rc'); ?>
          </div>
          <div class="col-xs-6">
            <?php echo $this->Form->control('codetva', ['label' => 'Code TVA']); ?>
          </div>
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('fax'); ?>
          </div>
          <div class="col-xs-6">
            <?php echo $this->Form->control('rib'); ?>
          </div>
          <div class="col-xs-6">
            <?php echo $this->Form->control('escompte'); ?>
          </div>
          <div class="col-xs-6">
            <?php echo $this->Form->control('codepostale', ['label' => 'Code Postale']); ?>
          </div>
          <div class="col-xs-6">
            <?php echo $this->Form->control('codeproducteur', ['label' => 'Code Producteur']); ?>
          </div>
          <div class="col-xs-6">
            <?php echo $this->Form->control('codepays', ['label' => 'Code Pays']); ?>
          </div>
          <div class="col-xs-6">
            <label>Logo</label>
            <input type="file" name="logoo" class="form-control" id="exampleInputFile">
          </div>
          <button type="submit" class="pull-right btn btn-success btn-sm" id="en1" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
</section>
<?php echo $this->Html->script('alert'); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/summernote/summernote.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/summernote/summernote.min', ['block' => 'css']); ?>
<script>
    $(document).ready(function() {
        $('#description').summernote({
            height: 300,

        });
    });
    $('.select2').select2({

    })
</script>