<section class="content-header">

</section>

<!-- Main content -->
<!-- Content Header (Page header) -->
<section class="content-header">

  <h1>
    Societe
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
</section>
<br />
<div class="box">
  <div class="box-header">
  </div>
  <!-- /.box-header -->
  <?php echo $this->Form->create($societe, ['role' => 'form']); ?>
  <div class="box-body">
    <div class="row">
      <div class="col-xs-6">
        <?php
        echo $this->Form->control('nom', ['readonly']); ?>
      </div>
      <div class="col-xs-6">
        <?php echo $this->Form->control('capital', ['readonly']); ?>
      </div>
      <div class="col-xs-6">
        <?php
        echo $this->Form->control('adresse', ['readonly']); ?>
      </div>
      <div class="col-xs-6">
        <?php echo $this->Form->control('tel', ['readonly']); ?>
      </div>
      <div class="col-xs-6">
        <?php
        echo $this->Form->control('mail', ['readonly']); ?>
      </div>
      <div class="col-xs-6">
        <?php echo $this->Form->control('site', ['readonly']); ?>
      </div>
      <div class="col-xs-6">
        <?php
        echo $this->Form->control('rc', ['readonly']); ?>
      </div>
      <div class="col-xs-6">
        <?php echo $this->Form->control('codetva', ['readonly', 'label' => 'Code TVA']); ?>
      </div>
      <div class="col-xs-6">
        <?php
        echo $this->Form->control('fax', ['readonly']); ?>
      </div>
      <div class="col-xs-6">
        <?php echo $this->Form->control('rib', ['readonly']); ?>
      </div>
      <div class="col-xs-6">
        <?php echo $this->Form->control('escompte', ['readonly']); ?>
      </div>
      <div class="col-xs-6">
        <?php echo $this->Form->control('logo', ['readonly']); ?>
      </div>
      <div class="col-xs-6">
        <?php echo $this->Form->control('codepostale', ['readonly', 'label' => 'Code Postale']); ?>
      </div>
      <div class="col-xs-6">
        <?php echo $this->Form->control('codeproducteur', ['readonly','label' => 'Code Producteur']); ?>
      </div>
      <div class="col-xs-6">
        <?php echo $this->Form->control('codepays', ['readonly','label' => 'Code Pays']); ?>
      </div>
      <div align="center" >
        <?php echo $this->Html->image('logo/' . $societe->logo, ['style' => 'max-width:200px;height:200px;margin-top: 100px;margin-right: 36%;']); ?>
        <!-- <input type="file" name="logo" class="form-control" id="exampleInputFile"> -->
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->
</section>
<!-- /.content -->

<!-- DataTables -->