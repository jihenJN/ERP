<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cartecarburant $cartecarburant 
 */
?>
<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script> 
<?php echo $this->Html->script('alert'); ?>
<section class="content-header">
  <h1>
  Carte Carburants
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
        <?php echo $this->Form->create($cartecarburant, ['role' => 'form']); ?>
        <div class="box-body">
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('num');
            ?>
          </div>
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('motdepasse', ['label' => 'Mot De Passe']);
            ?>
          </div>
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('typekiosque', ['label' => 'Type Kiosque']);
            ?>
          </div>
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('typecartecarburant_id', ['label' => 'Type Carte Carburant','options' => $typecartecarburants, 'empty' => 'Veuillez choisir !!']);
            ?>
          </div>
          <button type="submit" class="pull-right btn btn-success btn-sm" id="cc" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
</section>