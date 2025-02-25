<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fournisseurbanque $fournisseurbanque
 */
?>
<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Fournisseurbanque
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
          <?php echo $this->Form->create($fournisseurbanque, ['role' => 'form']); ?>
            <div class="box-body">
              <?php
                echo $this->Form->control('banque_id', ['options' => $banques, 'empty' => true]);
                echo $this->Form->control('agence');
                echo $this->Form->control('code_banque');
                echo $this->Form->control('swift');
                echo $this->Form->control('compte');
                echo $this->Form->control('rib');
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
