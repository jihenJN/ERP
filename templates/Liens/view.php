<section class="content-header">
  <h1>
    Lien
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
            <dt scope="row"><?= __('Utilisateurmenu') ?></dt>
            <dd><?= $lien->has('utilisateurmenu') ? $this->Html->link($lien->utilisateurmenu->id, ['controller' => 'Utilisateurmenus', 'action' => 'view', $lien->utilisateurmenu->id]) : '' ?></dd>
            <dt scope="row"><?= __('Lien') ?></dt>
            <dd><?= h($lien->lien) ?></dd>
            <dt scope="row"><?= __('Add') ?></dt>
            <dd><?= h($lien->add) ?></dd>
            <dt scope="row"><?= __('Edit') ?></dt>
            <dd><?= h($lien->edit) ?></dd>
            <dt scope="row"><?= __('Delete') ?></dt>
            <dd><?= h($lien->delete) ?></dd>
            <dt scope="row"><?= __('Imprimer') ?></dt>
            <dd><?= h($lien->imprimer) ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($lien->id) ?></dd>
            <dt scope="row"><?= __('Valide') ?></dt>
            <dd><?= $this->Number->format($lien->valide) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
