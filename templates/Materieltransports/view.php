<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Materieltransport $materieltransport
 */
?>

<section class="content-header">
  <h1>
    Materiel De Transport
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
        <?php echo $this->Form->create($materieltransport, ['role' => 'form']); ?>
        <div class="box-body">
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('code', ['readonly']);
            ?>
          </div>
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('matricule', ['readonly']);
            ?>
          </div>
          <div class="col-xs-6">
            <?php

            echo $this->Form->control('designation', ['readonly']);
            ?>
          </div>
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('poids', ['readonly','label' => 'Max Poids']);
            ?>
          </div>
<!--          <div class="col-xs-6">
            <?php
            echo $this->Form->control('kilometragedepart', ['readonly','label' => 'Kilometrage Depart']);
            ?>
          </div>-->
<!--          <div class="col-xs-6">
            <?php
            echo $this->Form->control('kilometragearrive', ['readonly','label' => 'Kilometrage Arrive']);
            ?>
          </div>-->
        </div>
        <?php echo $this->Form->end(); ?>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
</section>