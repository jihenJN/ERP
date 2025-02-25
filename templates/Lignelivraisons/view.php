<section class="content-header">
  <h1>
    Lignelivraison
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
            <dt scope="row"><?= __('Livraison') ?></dt>
            <dd><?= $lignelivraison->has('livraison') ? $this->Html->link($lignelivraison->livraison->id, ['controller' => 'Livraisons', 'action' => 'view', $lignelivraison->livraison->id]) : '' ?></dd>
            <dt scope="row"><?= __('Commande') ?></dt>
            <dd><?= $lignelivraison->has('commande') ? $this->Html->link($lignelivraison->commande->id, ['controller' => 'Commandes', 'action' => 'view', $lignelivraison->commande->id]) : '' ?></dd>
            <dt scope="row"><?= __('Fournisseur') ?></dt>
            <dd><?= $lignelivraison->has('fournisseur') ? $this->Html->link($lignelivraison->fournisseur->name, ['controller' => 'Fournisseurs', 'action' => 'view', $lignelivraison->fournisseur->id]) : '' ?></dd>
            <dt scope="row"><?= __('Codefrs') ?></dt>
            <dd><?= h($lignelivraison->codefrs) ?></dd>
            <dt scope="row"><?= __('Article') ?></dt>
            <dd><?= $lignelivraison->has('article') ? $this->Html->link($lignelivraison->article->id, ['controller' => 'Articles', 'action' => 'view', $lignelivraison->article->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($lignelivraison->id) ?></dd>
            <dt scope="row"><?= __('Qte') ?></dt>
            <dd><?= $this->Number->format($lignelivraison->qte) ?></dd>
            <dt scope="row"><?= __('Qteliv') ?></dt>
            <dd><?= $this->Number->format($lignelivraison->qteliv) ?></dd>
            <dt scope="row"><?= __('Prix') ?></dt>
            <dd><?= $this->Number->format($lignelivraison->prix) ?></dd>
            <dt scope="row"><?= __('Ht') ?></dt>
            <dd><?= $this->Number->format($lignelivraison->ht) ?></dd>
            <dt scope="row"><?= __('Remise') ?></dt>
            <dd><?= $this->Number->format($lignelivraison->remise) ?></dd>
            <dt scope="row"><?= __('Fodec') ?></dt>
            <dd><?= $this->Number->format($lignelivraison->fodec) ?></dd>
            <dt scope="row"><?= __('Tva') ?></dt>
            <dd><?= $this->Number->format($lignelivraison->tva) ?></dd>
            <dt scope="row"><?= __('Ttc') ?></dt>
            <dd><?= $this->Number->format($lignelivraison->ttc) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
