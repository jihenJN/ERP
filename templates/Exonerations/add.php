<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Exoneration $exoneration
 */
?>
<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Exoneration
      <small><?php echo __('Add'); ?></small>
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
          <?php echo $this->Form->create($exoneration, ['role' => 'form']); ?>
            <div class="box-body">
              <?php
                echo $this->Form->control('typeexon_id', ['options' => $typeexons]);
                echo $this->Form->control('num_att_taxes');
                echo $this->Form->control('date_debut');
                echo $this->Form->control('date_fin');
                echo $this->Form->control('document');
                echo $this->Form->control('fournisseur_id', ['options' => $fournisseurs]);
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

