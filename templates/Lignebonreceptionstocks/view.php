<section class="content-header">
  <h1>
    Lignebonreceptionstock
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
            <dt scope="row"><?= __('Bonreceptionstock') ?></dt>
            <dd><?= $lignebonreceptionstock->has('bonreceptionstock') ? $this->Html->link($lignebonreceptionstock->bonreceptionstock->id, ['controller' => 'Bonreceptionstocks', 'action' => 'view', $lignebonreceptionstock->bonreceptionstock->id]) : '' ?></dd>
            <dt scope="row"><?= __('Article') ?></dt>
            <dd><?= $lignebonreceptionstock->has('article') ? $this->Html->link($lignebonreceptionstock->article->id, ['controller' => 'Articles', 'action' => 'view', $lignebonreceptionstock->article->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($lignebonreceptionstock->id) ?></dd>
            <dt scope="row"><?= __('Qte') ?></dt>
            <dd><?= $this->Number->format($lignebonreceptionstock->qte) ?></dd>
            <dt scope="row"><?= __('Prix') ?></dt>
            <dd><?= $this->Number->format($lignebonreceptionstock->prix) ?></dd>
            <dt scope="row"><?= __('Total') ?></dt>
            <dd><?= $this->Number->format($lignebonreceptionstock->total) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
