<section class="content-header">
  <h1>
    Lignebonlivraison
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
            <dt scope="row"><?= __('Bonlivraison') ?></dt>
            <dd><?= $lignebonlivraison->has('bonlivraison') ? $this->Html->link($lignebonlivraison->bonlivraison->id, ['controller' => 'Bonlivraisons', 'action' => 'view', $lignebonlivraison->bonlivraison->id]) : '' ?></dd>
            <dt scope="row"><?= __('Article') ?></dt>
            <dd><?= $lignebonlivraison->has('article') ? $this->Html->link($lignebonlivraison->article->id, ['controller' => 'Articles', 'action' => 'view', $lignebonlivraison->article->id]) : '' ?></dd>
            <dt scope="row"><?= __('Commandeclient') ?></dt>
            <dd><?= $lignebonlivraison->has('commandeclient') ? $this->Html->link($lignebonlivraison->commandeclient->id, ['controller' => 'Commandeclients', 'action' => 'view', $lignebonlivraison->commandeclient->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($lignebonlivraison->id) ?></dd>
            <dt scope="row"><?= __('Qte') ?></dt>
            <dd><?= $this->Number->format($lignebonlivraison->qte) ?></dd>
            <dt scope="row"><?= __('Prixht') ?></dt>
            <dd><?= $this->Number->format($lignebonlivraison->prixht) ?></dd>
            <dt scope="row"><?= __('Remise') ?></dt>
            <dd><?= $this->Number->format($lignebonlivraison->remise) ?></dd>
            <dt scope="row"><?= __('Punht') ?></dt>
            <dd><?= $this->Number->format($lignebonlivraison->punht) ?></dd>
            <dt scope="row"><?= __('Tva') ?></dt>
            <dd><?= $this->Number->format($lignebonlivraison->tva) ?></dd>
            <dt scope="row"><?= __('Fodec') ?></dt>
            <dd><?= $this->Number->format($lignebonlivraison->fodec) ?></dd>
            <dt scope="row"><?= __('Ttc') ?></dt>
            <dd><?= $this->Number->format($lignebonlivraison->ttc) ?></dd>
            <dt scope="row"><?= __('Quantiteliv') ?></dt>
            <dd><?= $this->Number->format($lignebonlivraison->quantiteliv) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
