<section class="content-header">
  <h1>
    Lignebonchargement
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
            <dt scope="row"><?= __('Bondechargement') ?></dt>
            <dd><?= $lignebonchargement->has('bondechargement') ? $this->Html->link($lignebonchargement->bondechargement->id, ['controller' => 'Bondechargements', 'action' => 'view', $lignebonchargement->bondechargement->id]) : '' ?></dd>
            <dt scope="row"><?= __('Article') ?></dt>
            <dd><?= $lignebonchargement->has('article') ? $this->Html->link($lignebonchargement->article->id, ['controller' => 'Articles', 'action' => 'view', $lignebonchargement->article->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($lignebonchargement->id) ?></dd>
            <dt scope="row"><?= __('Prix') ?></dt>
            <dd><?= $this->Number->format($lignebonchargement->prix) ?></dd>
            <dt scope="row"><?= __('Qte') ?></dt>
            <dd><?= $this->Number->format($lignebonchargement->qte) ?></dd>
            <dt scope="row"><?= __('Total') ?></dt>
            <dd><?= $this->Number->format($lignebonchargement->total) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
