<section class="content-header">
  <h1>
    Lignefactureclient
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
            <dt scope="row"><?= __('Factureclient') ?></dt>
            <dd><?= $lignefactureclient->has('factureclient') ? $this->Html->link($lignefactureclient->factureclient->id, ['controller' => 'Factureclients', 'action' => 'view', $lignefactureclient->factureclient->id]) : '' ?></dd>
            <dt scope="row"><?= __('Article') ?></dt>
            <dd><?= $lignefactureclient->has('article') ? $this->Html->link($lignefactureclient->article->id, ['controller' => 'Articles', 'action' => 'view', $lignefactureclient->article->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($lignefactureclient->id) ?></dd>
            <dt scope="row"><?= __('Qte') ?></dt>
            <dd><?= $this->Number->format($lignefactureclient->qte) ?></dd>
            <dt scope="row"><?= __('Prixht') ?></dt>
            <dd><?= $this->Number->format($lignefactureclient->prixht) ?></dd>
            <dt scope="row"><?= __('Remise') ?></dt>
            <dd><?= $this->Number->format($lignefactureclient->remise) ?></dd>
            <dt scope="row"><?= __('Punht') ?></dt>
            <dd><?= $this->Number->format($lignefactureclient->punht) ?></dd>
            <dt scope="row"><?= __('Tva') ?></dt>
            <dd><?= $this->Number->format($lignefactureclient->tva) ?></dd>
            <dt scope="row"><?= __('Fodec') ?></dt>
            <dd><?= $this->Number->format($lignefactureclient->fodec) ?></dd>
            <dt scope="row"><?= __('Ttc') ?></dt>
            <dd><?= $this->Number->format($lignefactureclient->ttc) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
