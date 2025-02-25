<section class="content-header"> 
  <h1>
    Pays
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

        <!-- /.box-header -->
        <!-- form start -->
        <?php echo $this->Form->create($pay, ['role' => 'form']); ?>
        <div class="box-body">
          <?php
          echo $this->Form->control('name',['readonly']);
          ?>
        </div>
        <!-- /.box-body -->

        <?php echo $this->Form->submit(__('Enregistrer')); ?>

        <?php echo $this->Form->end(); ?>
      </div>
      <!-- /.box -->
    </div>
  </div>
  <!-- /.row -->
</section>