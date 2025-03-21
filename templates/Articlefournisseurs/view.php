<section class="content-header">
  <h1>
    Articlefournisseur
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
            <dt scope="row"><?= __('Fournisseur') ?></dt>
            <dd><?= $articlefournisseur->has('fournisseur') ? $this->Html->link($articlefournisseur->fournisseur->name, ['controller' => 'Fournisseurs', 'action' => 'view', $articlefournisseur->fournisseur->id]) : '' ?></dd>
            <dt scope="row"><?= __('Code') ?></dt>
            <dd><?= h($articlefournisseur->code) ?></dd>
            <dt scope="row"><?= __('Article') ?></dt>
            <dd><?= $articlefournisseur->has('article') ? $this->Html->link($articlefournisseur->article->id, ['controller' => 'Articles', 'action' => 'view', $articlefournisseur->article->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($articlefournisseur->id) ?></dd>
            <dt scope="row"><?= __('Prix') ?></dt>
            <dd><?= $this->Number->format($articlefournisseur->prix) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
