<section class="content-header">
  <h1>
    Fournisseurbanque
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
            <dt scope="row"><?= __('Banque') ?></dt>
            <dd><?= $fournisseurbanque->has('banque') ? $this->Html->link($fournisseurbanque->banque->name, ['controller' => 'Banques', 'action' => 'view', $fournisseurbanque->banque->id]) : '' ?></dd>
            <dt scope="row"><?= __('Agence') ?></dt>
            <dd><?= h($fournisseurbanque->agence) ?></dd>
            <dt scope="row"><?= __('Code Banque') ?></dt>
            <dd><?= h($fournisseurbanque->code_banque) ?></dd>
            <dt scope="row"><?= __('Swift') ?></dt>
            <dd><?= h($fournisseurbanque->swift) ?></dd>
            <dt scope="row"><?= __('Compte') ?></dt>
            <dd><?= h($fournisseurbanque->compte) ?></dd>
            <dt scope="row"><?= __('Rib') ?></dt>
            <dd><?= h($fournisseurbanque->rib) ?></dd>
            <dt scope="row"><?= __('Document') ?></dt>
            <dd><?= h($fournisseurbanque->document) ?></dd>
            <dt scope="row"><?= __('Fournisseur') ?></dt>
            <dd><?= $fournisseurbanque->has('fournisseur') ? $this->Html->link($fournisseurbanque->fournisseur->name, ['controller' => 'Fournisseurs', 'action' => 'view', $fournisseurbanque->fournisseur->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($fournisseurbanque->id) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
