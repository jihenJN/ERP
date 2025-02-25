<section class="content-header">
  <h1>
    Lignelignebandeconsultation
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
            <dt scope="row"><?= __('Demandeoffredeprix') ?></dt>
            <dd><?= $lignelignebandeconsultation->has('demandeoffredeprix') ? $this->Html->link($lignelignebandeconsultation->demandeoffredeprix->id, ['controller' => 'Demandeoffredeprixes', 'action' => 'view', $lignelignebandeconsultation->demandeoffredeprix->id]) : '' ?></dd>
            <dt scope="row"><?= __('Fournisseur') ?></dt>
            <dd><?= $lignelignebandeconsultation->has('fournisseur') ? $this->Html->link($lignelignebandeconsultation->fournisseur->name, ['controller' => 'Fournisseurs', 'action' => 'view', $lignelignebandeconsultation->fournisseur->id]) : '' ?></dd>
            <dt scope="row"><?= __('NameF') ?></dt>
            <dd><?= h($lignelignebandeconsultation->nameF) ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($lignelignebandeconsultation->id) ?></dd>
            <dt scope="row"><?= __('T') ?></dt>
            <dd><?= $this->Number->format($lignelignebandeconsultation->t) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
