<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ligneinventaire $ligneinventaire
 */
?>
<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Ligneinventaire
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
          <?php echo $this->Form->create($ligneinventaire, ['role' => 'form']); ?>
            <div class="box-body">
              <?php
                echo $this->Form->control('inventaire_id', ['options' => $inventaires, 'empty' => true]);
                echo $this->Form->control('article_id', ['options' => $articles]);
                echo $this->Form->control('quantite');
                echo $this->Form->control('numerolot');
                echo $this->Form->control('coutderevien');
                echo $this->Form->control('date', ['empty' => true]);
                echo $this->Form->control('date_exp', ['empty' => true]);
                echo $this->Form->control('depot_id', ['options' => $depots, 'empty' => true]);
                echo $this->Form->control('prixvente');
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
