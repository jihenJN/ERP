<section class="content-header">
  <h1>
    Clientbanque
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
            <dt scope="row"><?= __('Banque') ?></dt>
            <dd><?= $clientbanque->has('banque') ? $this->Html->link($clientbanque->banque->name, ['controller' => 'Banques', 'action' => 'view', $clientbanque->banque->id]) : '' ?></dd>
            <dt scope="row"><?= __('Agence') ?></dt>
            <dd><?= h($clientbanque->agence) ?></dd>
            <dt scope="row"><?= __('Code Banque') ?></dt>
            <dd><?= h($clientbanque->code_banque) ?></dd>
            <dt scope="row"><?= __('Swift') ?></dt>
            <dd><?= h($clientbanque->swift) ?></dd>
            <dt scope="row"><?= __('Compte') ?></dt>
            <dd><?= h($clientbanque->compte) ?></dd>
            <dt scope="row"><?= __('Rib') ?></dt>
            <dd><?= h($clientbanque->rib) ?></dd>
            <dt scope="row"><?= __('Document') ?></dt>
            <dd><?= h($clientbanque->document) ?></dd>
            <dt scope="row"><?= __('Client') ?></dt>
            <dd><?= $clientbanque->has('client') ? $this->Html->link($clientbanque->client->name, ['controller' => 'Clients', 'action' => 'view', $clientbanque->client->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($clientbanque->id) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
