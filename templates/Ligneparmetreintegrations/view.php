<section class="content-header">
  <h1>
    Ligneparmetreintegration
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
            <dt scope="row"><?= __('Libelle') ?></dt>
            <dd><?= h($ligneparmetreintegration->libelle) ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($ligneparmetreintegration->id) ?></dd>
            <dt scope="row"><?= __('Nature Id') ?></dt>
            <dd><?= $this->Number->format($ligneparmetreintegration->nature_id) ?></dd>
            <dt scope="row"><?= __('Taxe Id') ?></dt>
            <dd><?= $this->Number->format($ligneparmetreintegration->taxe_id) ?></dd>
            <dt scope="row"><?= __('Auto') ?></dt>
            <dd><?= $this->Number->format($ligneparmetreintegration->auto) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
