<section class="content-header">
  <h1>
    Clientexoneration
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
            <dt scope="row"><?= __('Typeexon') ?></dt>
            <dd><?= $clientexoneration->has('typeexon') ? $this->Html->link($clientexoneration->typeexon->name, ['controller' => 'Typeexons', 'action' => 'view', $clientexoneration->typeexon->id]) : '' ?></dd>
            <dt scope="row"><?= __('Document') ?></dt>
            <dd><?= h($clientexoneration->document) ?></dd>
            <dt scope="row"><?= __('Client') ?></dt>
            <dd><?= $clientexoneration->has('client') ? $this->Html->link($clientexoneration->client->name, ['controller' => 'Clients', 'action' => 'view', $clientexoneration->client->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($clientexoneration->id) ?></dd>
            <dt scope="row"><?= __('Num Att Taxes') ?></dt>
            <dd><?= $this->Number->format($clientexoneration->num_att_taxes) ?></dd>
            <dt scope="row"><?= __('Date Debut') ?></dt>
            <dd><?= h($clientexoneration->date_debut) ?></dd>
            <dt scope="row"><?= __('Date Fin') ?></dt>
            <dd><?= h($clientexoneration->date_fin) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
