<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Activite $activite
 */
?>
<!-- Content Header (Page header) -->

<section class="content-header">
  <h1>
    Activite
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
      <?php echo $this->Form->create($activite, ['role' => 'form']); ?>
        <div class="box-body">
          <div >
            <?php
            echo $this->Form->control('name', ['readonly']);
            ?>
          </div>
        </div>
        <?php echo $this->Form->end(); ?>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
</section>