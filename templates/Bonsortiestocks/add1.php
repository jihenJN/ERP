<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bonsortiestock $bonsortiestock
 */
?>
<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Bonsortiestock
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
          <?php echo $this->Form->create($bonsortiestock, ['role' => 'form']); ?>
            <div class="box-body">
              <?php
                echo $this->Form->control('numero');
                echo $this->Form->control('date', ['empty' => true]);
                echo $this->Form->control('pointdevente_id', ['options' => $pointdeventes, 'empty' => true]);
                echo $this->Form->control('materieltransport_id', ['options' => $materieltransports, 'empty' => true]);
                echo $this->Form->control('cartecarburant_id', ['options' => $cartecarburants, 'empty' => true]);
                echo $this->Form->control('kilometragedepart');
                echo $this->Form->control('kilometragearrive');
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

