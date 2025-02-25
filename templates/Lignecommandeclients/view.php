<section class="content-header">
  <h1>
    Lignecommandeclient
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
            <dt scope="row"><?= __('Commandeclient') ?></dt>
            <dd><?= $lignecommandeclient->has('commandeclient') ? $this->Html->link($lignecommandeclient->commandeclient->id, ['controller' => 'Commandeclients', 'action' => 'view', $lignecommandeclient->commandeclient->id]) : '' ?></dd>
            <dt scope="row"><?= __('Article') ?></dt>
            <dd><?= $lignecommandeclient->has('article') ? $this->Html->link($lignecommandeclient->article->id, ['controller' => 'Articles', 'action' => 'view', $lignecommandeclient->article->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($lignecommandeclient->id) ?></dd>
            <dt scope="row"><?= __('Qtestock') ?></dt>
            <dd><?= $this->Number->format($lignecommandeclient->qtestock) ?></dd>
            <dt scope="row"><?= __('Qte') ?></dt>
            <dd><?= $this->Number->format($lignecommandeclient->qte) ?></dd>
            <dt scope="row"><?= __('Prixht') ?></dt>
            <dd><?= $this->Number->format($lignecommandeclient->prixht) ?></dd>
            <dt scope="row"><?= __('Remise') ?></dt>
            <dd><?= $this->Number->format($lignecommandeclient->remise) ?></dd>
            <dt scope="row"><?= __('Punht') ?></dt>
            <dd><?= $this->Number->format($lignecommandeclient->punht) ?></dd>
            <dt scope="row"><?= __('Tva') ?></dt>
            <dd><?= $this->Number->format($lignecommandeclient->tva) ?></dd>
            <dt scope="row"><?= __('Fodec') ?></dt>
            <dd><?= $this->Number->format($lignecommandeclient->fodec) ?></dd>
            <dt scope="row"><?= __('Ttc') ?></dt>
            <dd><?= $this->Number->format($lignecommandeclient->ttc) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
