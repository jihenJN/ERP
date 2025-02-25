<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Materieltransport $materieltransport
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
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
        <?php echo $this->Form->create($materieltransport, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
        <div class="box-body">
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('code', ['disabled']);
            ?>
          </div>
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('matricule');
            ?>
          </div>
          <div class="col-xs-6">
            <?php

            echo $this->Form->control('designation');
            ?>
          </div>
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('poids', ['label' => 'Max Poids']);
            ?>
          </div>
<!--          <div class="col-xs-6">
            <?php
            echo $this->Form->control('kilometragedepart', ['label' => 'Kilometrage Depart']);
            ?>
          </div>-->
<!--          <div class="col-xs-6">
            <?php
            echo $this->Form->control('kilometragearrive', ['label' => 'Kilometrage Arrive']);
            ?>
          </div>-->
          <button type="submit" class="pull-right btn btn-success btn-sm" id="mdt" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
          <?php echo $this->Form->end(); ?>
        </div>

        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
</section>