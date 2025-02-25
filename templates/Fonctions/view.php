<section class="content-header">
  <h1>
    Fonction
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
      <div class="box box-solid">
        <!-- /.box-header -->
        <div class="box-body">
        <?php echo $this->Form->create($fonction, ['role' => 'form']); ?>
            <div class="box-body">
              <?php
                echo $this->Form->control('name',['readonly']);
              ?>
            </div>
        </div>
      </div>
    </div>
  </div>
</section>