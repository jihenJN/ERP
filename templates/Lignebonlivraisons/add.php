<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lignebonlivraison $lignebonlivraison
 */
?>
<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Lignebonlivraison
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
          <?php echo $this->Form->create($lignebonlivraison, ['role' => 'form']); ?>
            <div class="box-body">
              <?php
                echo $this->Form->control('bonlivraison_id', ['options' => $bonlivraisons, 'empty' => true]);
                echo $this->Form->control('article_id', ['options' => $articles, 'empty' => true]);
                echo $this->Form->control('qte');
                echo $this->Form->control('prixht');
                echo $this->Form->control('remise');
                echo $this->Form->control('punht');
                echo $this->Form->control('tva');
                echo $this->Form->control('fodec');
                echo $this->Form->control('ttc');
                echo $this->Form->control('quantiteliv');
                echo $this->Form->control('commandeclient_id', ['options' => $commandeclients]);
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

