<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fonction $fonction
 */
?>
<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<section class="content-header">
  <h1>
    Article Unite
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
        <?php echo $this->Form->create($articleunite, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
        <div class="box-body">
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('article_id', ['options' => $articles, 'empty' =>  'Veuillez choisir !!']); ?>
          </div>
          <div class="col-xs-6">
            <?php echo $this->Form->control('unite_id', ['options' => $unites, 'empty' =>  'Veuillez choisir !!']); ?>
          </div>
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('formule'); ?>
          </div>
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('poids'); ?>
          </div>
          <button type="submit" class="pull-right btn btn-success btn-sm" id="testde" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
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
