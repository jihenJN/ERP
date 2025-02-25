<section class="content-header">
  <h1>
  Consulter site
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
      <div class="box ">
        <!-- /.box-header -->
        <?php echo $this->Form->create($pointdevente, ['role' => 'form']); ?>
        
          <div class="box-body">
            <div class="row">
              <div class="col-xs-6">
                <?php
                echo $this->Form->control('code',['readonly']); ?>
              </div>
              <div class="col-xs-6">
                <?php echo $this->Form->control('name',['readonly' ,'label'=>'Nom']); ?>
              </div>
              <div class="col-xs-6">
                <?php
                echo $this->Form->control('adresse',['readonly']); ?>
              </div>
              
              <div class="col-xs-6">
                <?php
                echo $this->Form->control('matriclefiscale',['readonly','label' => 'Matricle Fiscale']); ?>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!-- /.box-body -->
              </div>
      </div>
    </div>
  </div>
</section>