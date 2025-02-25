<section class="content-header">
  <h1>
    Livraisonsanc
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
            <dd><?= $livraisonsanc->has('commande') ? $this->Html->link($livraisonsanc->commande->id, ['controller' => 'Commandes', 'action' => 'view', $livraisonsanc->commande->id]) : '' ?></dd>
            <dt scope="row"><?= __('Numero') ?></dt>
            <dd><?= h($livraisonsanc->numero) ?></dd>
            <dt scope="row"><?= __('Fournisseur') ?></dt>
            <dd><?= $livraisonsanc->has('fournisseur') ? $this->Html->link($livraisonsanc->fournisseur->name, ['controller' => 'Fournisseurs', 'action' => 'view', $livraisonsanc->fournisseur->id]) : '' ?></dd>
            <dt scope="row"><?= __('Pointdevente') ?></dt>
            <dd><?= $livraisonsanc->has('pointdevente') ? $this->Html->link($livraisonsanc->pointdevente->name, ['controller' => 'Pointdeventes', 'action' => 'view', $livraisonsanc->pointdevente->id]) : '' ?></dd>
            <dt scope="row"><?= __('Depot') ?></dt>
            <dd><?= $livraisonsanc->has('depot') ? $this->Html->link($livraisonsanc->depot->name, ['controller' => 'Depots', 'action' => 'view', $livraisonsanc->depot->id]) : '' ?></dd>
            <dt scope="row"><?= __('Cartecarburant') ?></dt>
            <dd><?= $livraisonsanc->has('cartecarburant') ? $this->Html->link($livraisonsanc->cartecarburant->id, ['controller' => 'Cartecarburants', 'action' => 'view', $livraisonsanc->cartecarburant->id]) : '' ?></dd>
            <dt scope="row"><?= __('Materieltransport') ?></dt>
            <dd><?= $livraisonsanc->has('materieltransport') ? $this->Html->link($livraisonsanc->materieltransport->id, ['controller' => 'Materieltransports', 'action' => 'view', $livraisonsanc->materieltransport->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($livraisonsanc->id) ?></dd>
            <dt scope="row"><?= __('Chauffeur') ?></dt>
            <dd><?= $this->Number->format($livraisonsanc->chauffeur) ?></dd>
            <dt scope="row"><?= __('Convoyeur') ?></dt>
            <dd><?= $this->Number->format($livraisonsanc->convoyeur) ?></dd>
            <dt scope="row"><?= __('Valide') ?></dt>
            <dd><?= $this->Number->format($livraisonsanc->valide) ?></dd>
            <dt scope="row"><?= __('Remise') ?></dt>
            <dd><?= $this->Number->format($livraisonsanc->remise) ?></dd>
            <dt scope="row"><?= __('Tva') ?></dt>
            <dd><?= $this->Number->format($livraisonsanc->tva) ?></dd>
            <dt scope="row"><?= __('Fodec') ?></dt>
            <dd><?= $this->Number->format($livraisonsanc->fodec) ?></dd>
            <dt scope="row"><?= __('Ttc') ?></dt>
            <dd><?= $this->Number->format($livraisonsanc->ttc) ?></dd>
            <dt scope="row"><?= __('Ht') ?></dt>
            <dd><?= $this->Number->format($livraisonsanc->ht) ?></dd>
            <dt scope="row"><?= __('Date') ?></dt>
            <dd><?= h($livraisonsanc->date) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
