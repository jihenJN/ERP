<section class="content-header">
  <h1>
    Ligneinventaire
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
            <dt scope="row"><?= __('Inventaire') ?></dt>
            <dd><?= $ligneinventaire->has('inventaire') ? $this->Html->link($ligneinventaire->inventaire->id, ['controller' => 'Inventaires', 'action' => 'view', $ligneinventaire->inventaire->id]) : '' ?></dd>
            <dt scope="row"><?= __('Article') ?></dt>
            <dd><?= $ligneinventaire->has('article') ? $this->Html->link($ligneinventaire->article->id, ['controller' => 'Articles', 'action' => 'view', $ligneinventaire->article->id]) : '' ?></dd>
            <dt scope="row"><?= __('Numerolot') ?></dt>
            <dd><?= h($ligneinventaire->numerolot) ?></dd>
            <dt scope="row"><?= __('Depot') ?></dt>
            <dd><?= $ligneinventaire->has('depot') ? $this->Html->link($ligneinventaire->depot->name, ['controller' => 'Depots', 'action' => 'view', $ligneinventaire->depot->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($ligneinventaire->id) ?></dd>
            <dt scope="row"><?= __('Quantite') ?></dt>
            <dd><?= $this->Number->format($ligneinventaire->quantite) ?></dd>
            <dt scope="row"><?= __('Coutderevien') ?></dt>
            <dd><?= $this->Number->format($ligneinventaire->coutderevien) ?></dd>
            <dt scope="row"><?= __('Prixvente') ?></dt>
            <dd><?= $this->Number->format($ligneinventaire->prixvente) ?></dd>
            <dt scope="row"><?= __('Date') ?></dt>
            <dd><?= h($ligneinventaire->date) ?></dd>
            <dt scope="row"><?= __('Date Exp') ?></dt>
            <dd><?= h($ligneinventaire->date_exp) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
