<section class="content-header">
  <h1>
    Lignecommande
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
            <dt scope="row"><?= __('Commande') ?></dt>
            <dd><?= $lignecommande->has('commande') ? $this->Html->link($lignecommande->commande->id, ['controller' => 'Commandes', 'action' => 'view', $lignecommande->commande->id]) : '' ?></dd>
            <dt scope="row"><?= __('Fournisseur') ?></dt>
            <dd><?= $lignecommande->has('fournisseur') ? $this->Html->link($lignecommande->fournisseur->name, ['controller' => 'Fournisseurs', 'action' => 'view', $lignecommande->fournisseur->id]) : '' ?></dd>
            <dt scope="row"><?= __('Codefrs') ?></dt>
            <dd><?= h($lignecommande->codefrs) ?></dd>
            <dt scope="row"><?= __('Article') ?></dt>
            <dd><?= $lignecommande->has('article') ? $this->Html->link($lignecommande->article->id, ['controller' => 'Articles', 'action' => 'view', $lignecommande->article->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($lignecommande->id) ?></dd>
            <dt scope="row"><?= __('Qte') ?></dt>
            <dd><?= $this->Number->format($lignecommande->qte) ?></dd>
            <dt scope="row"><?= __('Prix') ?></dt>
            <dd><?= $this->Number->format($lignecommande->prix) ?></dd>
            <dt scope="row"><?= __('Ht') ?></dt>
            <dd><?= $this->Number->format($lignecommande->ht) ?></dd>
            <dt scope="row"><?= __('Remise') ?></dt>
            <dd><?= $this->Number->format($lignecommande->remise) ?></dd>
            <dt scope="row"><?= __('Fodec') ?></dt>
            <dd><?= $this->Number->format($lignecommande->fodec) ?></dd>
            <dt scope="row"><?= __('Tva') ?></dt>
            <dd><?= $this->Number->format($lignecommande->tva) ?></dd>
            <dt scope="row"><?= __('Ttc') ?></dt>
            <dd><?= $this->Number->format($lignecommande->ttc) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
