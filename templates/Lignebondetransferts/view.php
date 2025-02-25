<section class="content-header">
  <h1>
    Lignebondetransfert
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
            <dt scope="row"><?= __('Bondetransfert') ?></dt>
            <dd><?= $lignebondetransfert->has('bondetransfert') ? $this->Html->link($lignebondetransfert->bondetransfert->id, ['controller' => 'Bondetransferts', 'action' => 'view', $lignebondetransfert->bondetransfert->id]) : '' ?></dd>
            <dt scope="row"><?= __('Article') ?></dt>
            <dd><?= $lignebondetransfert->has('article') ? $this->Html->link($lignebondetransfert->article->id, ['controller' => 'Articles', 'action' => 'view', $lignebondetransfert->article->id]) : '' ?></dd>
            <dt scope="row"><?= __('Bondechargement') ?></dt>
            <dd><?= $lignebondetransfert->has('bondechargement') ? $this->Html->link($lignebondetransfert->bondechargement->id, ['controller' => 'Bondechargements', 'action' => 'view', $lignebondetransfert->bondechargement->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($lignebondetransfert->id) ?></dd>
            <dt scope="row"><?= __('Qte') ?></dt>
            <dd><?= $this->Number->format($lignebondetransfert->qte) ?></dd>
            <dt scope="row"><?= __('Qteliv') ?></dt>
            <dd><?= $this->Number->format($lignebondetransfert->qteliv) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
