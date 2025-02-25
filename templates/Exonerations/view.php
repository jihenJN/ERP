<section class="content-header">
  <h1>
    Exoneration
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
            <dd><?= $exoneration->has('typeexon') ? $this->Html->link($exoneration->typeexon->name, ['controller' => 'Typeexons', 'action' => 'view', $exoneration->typeexon->id]) : '' ?></dd>
            <dt scope="row"><?= __('Document') ?></dt>
            <dd><?= h($exoneration->document) ?></dd>
            <dt scope="row"><?= __('Fournisseur') ?></dt>
            <dd><?= $exoneration->has('fournisseur') ? $this->Html->link($exoneration->fournisseur->name, ['controller' => 'Fournisseurs', 'action' => 'view', $exoneration->fournisseur->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($exoneration->id) ?></dd>
            <dt scope="row"><?= __('Num Att Taxes') ?></dt>
            <dd><?= $this->Number->format($exoneration->num_att_taxes) ?></dd>
            <dt scope="row"><?= __('Date Debut') ?></dt>
            <dd><?= h($exoneration->date_debut) ?></dd>
            <dt scope="row"><?= __('Date Fin') ?></dt>
            <dd><?= h($exoneration->date_fin) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
