<section class="content-header">
  <h1>
    Lignefacture
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
            <dt scope="row"><?= __('Facture') ?></dt>
            <dd><?= $lignefacture->has('facture') ? $this->Html->link($lignefacture->facture->id, ['controller' => 'Factures', 'action' => 'view', $lignefacture->facture->id]) : '' ?></dd>
            <dt scope="row"><?= __('Fournisseur') ?></dt>
            <dd><?= $lignefacture->has('fournisseur') ? $this->Html->link($lignefacture->fournisseur->name, ['controller' => 'Fournisseurs', 'action' => 'view', $lignefacture->fournisseur->id]) : '' ?></dd>
            <dt scope="row"><?= __('Codefrs') ?></dt>
            <dd><?= h($lignefacture->codefrs) ?></dd>
            <dt scope="row"><?= __('Article') ?></dt>
            <dd><?= $lignefacture->has('article') ? $this->Html->link($lignefacture->article->id, ['controller' => 'Articles', 'action' => 'view', $lignefacture->article->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($lignefacture->id) ?></dd>
            <dt scope="row"><?= __('Qte') ?></dt>
            <dd><?= $this->Number->format($lignefacture->qte) ?></dd>
            <dt scope="row"><?= __('Prix') ?></dt>
            <dd><?= $this->Number->format($lignefacture->prix) ?></dd>
            <dt scope="row"><?= __('Ht') ?></dt>
            <dd><?= $this->Number->format($lignefacture->ht) ?></dd>
            <dt scope="row"><?= __('Remise') ?></dt>
            <dd><?= $this->Number->format($lignefacture->remise) ?></dd>
            <dt scope="row"><?= __('Fodec') ?></dt>
            <dd><?= $this->Number->format($lignefacture->fodec) ?></dd>
            <dt scope="row"><?= __('Tva') ?></dt>
            <dd><?= $this->Number->format($lignefacture->tva) ?></dd>
            <dt scope="row"><?= __('Ttc') ?></dt>
            <dd><?= $this->Number->format($lignefacture->ttc) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
