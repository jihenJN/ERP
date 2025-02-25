<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Paiement $paiement
 */
?>
<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Paiement
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
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo __(''); ?></h3>
          </div>
             <table class="table table-bordered table-striped table-bottomless" id="tabligne">
                <tbody>
                    <tr class="tr" style="display: none !important">
          <?php echo $this->Form->create($paiement, ['role' => 'form']); ?>
            <div class="box-body">
                <div class="col-xs-6">
              <?php
              echo $this->Form->control('name',['table'=>'lignead','champ'=>'name']); ?> </div>
                <div class="col-xs-6">
              <?php
                echo $this->Form->control('typepaiement_id', ['label'=>'Type paiement','table'=>'lignead','champ'=>'typepaiement_id ','options' => $typepaiements,'empty' => 'Veuillez choisir !!',]);
                ?> </div>
            </div>
            <!-- /.box-body -->

       <div align="center" id="e1">
<?php echo $this->Form->submit(__('Enregistrer')); ?>
                    </div>

          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
      </div>
  </div>
  <!-- /.row -->
</section>

