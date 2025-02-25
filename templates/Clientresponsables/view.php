<section class="content-header">
  <h1>
    Clientresponsable
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
            <dt scope="row"><?= __('Name') ?></dt>
            <dd><?= h($clientresponsable->name) ?></dd>
            <dt scope="row"><?= __('Mail') ?></dt>
            <dd><?= h($clientresponsable->mail) ?></dd>
            <dt scope="row"><?= __('Poste') ?></dt>
            <dd><?= h($clientresponsable->poste) ?></dd>
            <dt scope="row"><?= __('Client') ?></dt>
            <dd><?= $clientresponsable->has('client') ? $this->Html->link($clientresponsable->client->name, ['controller' => 'Clients', 'action' => 'view', $clientresponsable->client->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($clientresponsable->id) ?></dd>
            <dt scope="row"><?= __('Tel') ?></dt>
            <dd><?= $this->Number->format($clientresponsable->tel) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
