<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cartecarburant $cartecarburant 
 */
?>
<!-- Content Header (Page header) -->
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
            echo $this->Form->control('num', ['readonly']);
            ?>
          </div>
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('motdepasse', ['label' => 'Mot De Passe','readonly']);
            ?>
          </div>
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('typekiosque', ['label' => 'Type Kiosque','readonly']);
            ?>
          </div>
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('typecartecarburant_id', ['label' => 'Type Carte Carburant','options' => $typecartecarburants, 'readonly']);
            ?>
          </div>
          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
</section>