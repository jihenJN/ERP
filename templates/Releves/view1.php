<section class="content-header">
  <h1>
    Relef
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
            <dt scope="row"><?= __('Numclt') ?></dt>
            <dd><?= h($relef->numclt) ?></dd>
            <dt scope="row"><?= __('Client') ?></dt>
            <dd><?= $relef->has('client') ? $this->Html->link($relef->client->id, ['controller' => 'Clients', 'action' => 'view', $relef->client->id]) : '' ?></dd>
            <dt scope="row"><?= __('Numero') ?></dt>
            <dd><?= h($relef->numero) ?></dd>
            <dt scope="row"><?= __('Exercice') ?></dt>
            <dd><?= $relef->has('exercice') ? $this->Html->link($relef->exercice->name, ['controller' => 'Exercices', 'action' => 'view', $relef->exercice->id]) : '' ?></dd>
            <dt scope="row"><?= __('Typ') ?></dt>
            <dd><?= h($relef->typ) ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($relef->id) ?></dd>
            <dt scope="row"><?= __('Debit') ?></dt>
            <dd><?= $this->Number->format($relef->debit) ?></dd>
            <dt scope="row"><?= __('Credit') ?></dt>
            <dd><?= $this->Number->format($relef->credit) ?></dd>
            <dt scope="row"><?= __('Impaye') ?></dt>
            <dd><?= $this->Number->format($relef->impaye) ?></dd>
            <dt scope="row"><?= __('Reglement') ?></dt>
            <dd><?= $this->Number->format($relef->reglement) ?></dd>
            <dt scope="row"><?= __('Avoir') ?></dt>
            <dd><?= $this->Number->format($relef->avoir) ?></dd>
            <dt scope="row"><?= __('Solde') ?></dt>
            <dd><?= $this->Number->format($relef->solde) ?></dd>
            <dt scope="row"><?= __('Nbligneimp') ?></dt>
            <dd><?= $this->Number->format($relef->nbligneimp) ?></dd>
            <dt scope="row"><?= __('Date') ?></dt>
            <dd><?= h($relef->date) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-text-width"></i>
          <h3 class="box-title"><?= __('Type') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <?= $this->Text->autoParagraph($relef->type); ?>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-text-width"></i>
          <h3 class="box-title"><?= __('Typeimp') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <?= $this->Text->autoParagraph($relef->typeimp); ?>
        </div>
      </div>
    </div>
  </div>
</section>
