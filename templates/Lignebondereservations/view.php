<section class="content-header">
  <h1>
    Lignebondereservation
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
            <dt scope="row"><?= __('Article') ?></dt>
            <dd><?= $lignebondereservation->has('article') ? $this->Html->link($lignebondereservation->article->id, ['controller' => 'Articles', 'action' => 'view', $lignebondereservation->article->id]) : '' ?></dd>
            <dt scope="row"><?= __('Bondereservation') ?></dt>
            <dd><?= $lignebondereservation->has('bondereservation') ? $this->Html->link($lignebondereservation->bondereservation->id, ['controller' => 'Bondereservations', 'action' => 'view', $lignebondereservation->bondereservation->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($lignebondereservation->id) ?></dd>
            <dt scope="row"><?= __('Quantite') ?></dt>
            <dd><?= $this->Number->format($lignebondereservation->quantite) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
