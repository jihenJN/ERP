<section class="content-header">
  <h1>
    Lignebandeconsultation
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
            <dt scope="row"><?= __('Demandeoffredeprix') ?></dt>
            <dd><?= $lignebandeconsultation->has('demandeoffredeprix') ? $this->Html->link($lignebandeconsultation->demandeoffredeprix->id, ['controller' => 'Demandeoffredeprixes', 'action' => 'view', $lignebandeconsultation->demandeoffredeprix->id]) : '' ?></dd>
            <dt scope="row"><?= __('Bandeconsultation') ?></dt>
            <dd><?= $lignebandeconsultation->has('bandeconsultation') ? $this->Html->link($lignebandeconsultation->bandeconsultation->id, ['controller' => 'Bandeconsultations', 'action' => 'view', $lignebandeconsultation->bandeconsultation->id]) : '' ?></dd>
            <dt scope="row"><?= __('Lignedemandeoffredeprix') ?></dt>
            <dd><?= $lignebandeconsultation->has('lignedemandeoffredeprix') ? $this->Html->link($lignebandeconsultation->lignedemandeoffredeprix->id, ['controller' => 'Lignedemandeoffredeprixes', 'action' => 'view', $lignebandeconsultation->lignedemandeoffredeprix->id]) : '' ?></dd>
            <dt scope="row"><?= __('Fournisseur') ?></dt>
            <dd><?= $lignebandeconsultation->has('fournisseur') ? $this->Html->link($lignebandeconsultation->fournisseur->name, ['controller' => 'Fournisseurs', 'action' => 'view', $lignebandeconsultation->fournisseur->id]) : '' ?></dd>
            <dt scope="row"><?= __('NameF') ?></dt>
            <dd><?= h($lignebandeconsultation->nameF) ?></dd>
            <dt scope="row"><?= __('Codefrs') ?></dt>
            <dd><?= h($lignebandeconsultation->codefrs) ?></dd>
            <dt scope="row"><?= __('Article') ?></dt>
            <dd><?= $lignebandeconsultation->has('article') ? $this->Html->link($lignebandeconsultation->article->id, ['controller' => 'Articles', 'action' => 'view', $lignebandeconsultation->article->id]) : '' ?></dd>
            <dt scope="row"><?= __('DesigniationA') ?></dt>
            <dd><?= h($lignebandeconsultation->designiationA) ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($lignebandeconsultation->id) ?></dd>
            <dt scope="row"><?= __('Qte') ?></dt>
            <dd><?= $this->Number->format($lignebandeconsultation->qte) ?></dd>
            <dt scope="row"><?= __('Prix') ?></dt>
            <dd><?= $this->Number->format($lignebandeconsultation->prix) ?></dd>
            <dt scope="row"><?= __('Ht') ?></dt>
            <dd><?= $this->Number->format($lignebandeconsultation->ht) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
