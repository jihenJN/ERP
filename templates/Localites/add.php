

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<?php echo $this->Html->script('salma'); ?>

<?php echo $this->fetch('script'); ?>





<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fournisseur $fournisseur
 */
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>


    Ajout localite

  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i>
        <?php echo __('Retour'); ?></a></li>
  </ol>
</section>



<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box ">
        <div class="box-header with-border">
          <h3 class="box-title"></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?php echo $this->Form->create($localite, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>


        <div class="box-body">
          <div class="row">


          
            <div class="col-xs-6">
              <?php echo $this->Form->control('name',['required' => 'off','id'=>'description','label'=>'Nom']); ?>
            </div>

           










          </div>

          <div align="center">
     
            <button type="submit" class="pull-right btn btn-success " id="" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>

          </div>

          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
</section>


















<!--<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Localites'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="localites form content">
            <?= $this->Form->create($localite) ?>
            <fieldset>
                <legend><?= __('Add Localite') ?></legend>
                <?php
                    echo $this->Form->control('name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>-->
