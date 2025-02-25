<section class="content-header">
  <h1>
    Fournisseurresponsable
    <small><?php echo __('View'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Home'); ?></a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-info"></i>
          <h3 class="box-title"><?php echo __('Information'); ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <dl class="dl-horizontal">
            <dt scope="row"><?= __('Name') ?></dt>
            <dd><?= h($fournisseurresponsable->name) ?></dd>
            <dt scope="row"><?= __('Mail') ?></dt>
            <dd><?= h($fournisseurresponsable->mail) ?></dd>
            <dt scope="row"><?= __('Poste') ?></dt>
            <dd><?= h($fournisseurresponsable->poste) ?></dd>
            <dt scope="row"><?= __('Fournisseur') ?></dt>
            <dd><?= $fournisseurresponsable->has('fournisseur') ? $this->Html->link($fournisseurresponsable->fournisseur->name, ['controller' => 'Fournisseurs', 'action' => 'view', $fournisseurresponsable->fournisseur->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($fournisseurresponsable->id) ?></dd>
            <dt scope="row"><?= __('Tel') ?></dt>
            <dd><?= $this->Number->format($fournisseurresponsable->tel) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
