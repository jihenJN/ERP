<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lignelignebandeconsultation $lignelignebandeconsultation
 */
?>
<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Lignelignebandeconsultation
      <small><?php echo __('Edit'); ?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Home'); ?></a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo __('Form'); ?></h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <?php echo $this->Form->create($lignelignebandeconsultation, ['role' => 'form']); ?>
            <div class="box-body">
              <?php
                echo $this->Form->control('demandeoffredeprix_id', ['options' => $demandeoffredeprixes, 'empty' => true]);
                echo $this->Form->control('fournisseur_id', ['options' => $fournisseurs, 'empty' => true]);
                echo $this->Form->control('nameF');
                echo $this->Form->control('t');
              ?>
            </div>
            <!-- /.box-body -->

          <?php echo $this->Form->submit(__('Submit')); ?>

          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
      </div>
  </div>
  <!-- /.row -->
</section>
