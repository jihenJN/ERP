<section class="content-header">
  <h1>
    Bandeconsultation
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
            <dd><?= $bandeconsultation->has('demandeoffredeprix') ? $this->Html->link($bandeconsultation->demandeoffredeprix->id, ['controller' => 'Demandeoffredeprixes', 'action' => 'view', $bandeconsultation->demandeoffredeprix->id]) : '' ?></dd>
            <dt scope="row"><?= __('Fournisseur') ?></dt>
            <dd><?= $bandeconsultation->has('fournisseur') ? $this->Html->link($bandeconsultation->fournisseur->name, ['controller' => 'Fournisseurs', 'action' => 'view', $bandeconsultation->fournisseur->id]) : '' ?></dd>
            <dt scope="row"><?= __('NameF') ?></dt>
            <dd><?= h($bandeconsultation->nameF) ?></dd>
            <dt scope="row"><?= __('Codefrs') ?></dt>
            <dd><?= h($bandeconsultation->codefrs) ?></dd>
            <dt scope="row"><?= __('Article') ?></dt>
            <dd><?= $bandeconsultation->has('article') ? $this->Html->link($bandeconsultation->article->id, ['controller' => 'Articles', 'action' => 'view', $bandeconsultation->article->id]) : '' ?></dd>
            <dt scope="row"><?= __('DesigniationA') ?></dt>
            <dd><?= h($bandeconsultation->designiationA) ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($bandeconsultation->id) ?></dd>
            <dt scope="row"><?= __('Qte') ?></dt>
            <dd><?= $this->Number->format($bandeconsultation->qte) ?></dd>
            <dt scope="row"><?= __('Prix') ?></dt>
            <dd><?= $this->Number->format($bandeconsultation->prix) ?></dd>
            <dt scope="row"><?= __('Totalprix') ?></dt>
            <dd><?= $this->Number->format($bandeconsultation->totalprix) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-share-alt"></i>
          <h3 class="box-title"><?= __('Lignebandeconsultations') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php if (!empty($bandeconsultation->lignebandeconsultations)): ?>
          <table class="table table-hover">
              <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Demandeoffredeprix Id') ?></th>
                    <th scope="col"><?= __('Bandeconsultation Id') ?></th>
                    <th scope="col"><?= __('Lignedemandeoffredeprix Id') ?></th>
                    <th scope="col"><?= __('Fournisseur Id') ?></th>
                    <th scope="col"><?= __('NameF') ?></th>
                    <th scope="col"><?= __('Codefrs') ?></th>
                    <th scope="col"><?= __('Article Id') ?></th>
                    <th scope="col"><?= __('DesigniationA') ?></th>
                    <th scope="col"><?= __('Qte') ?></th>
                    <th scope="col"><?= __('Prix') ?></th>
                    <th scope="col"><?= __('Ht') ?></th>
                    <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
              <?php foreach ($bandeconsultation->lignebandeconsultations as $lignebandeconsultations): ?>
              <tr>
                    <td><?= h($lignebandeconsultations->id) ?></td>
                    <td><?= h($lignebandeconsultations->demandeoffredeprix_id) ?></td>
                    <td><?= h($lignebandeconsultations->bandeconsultation_id) ?></td>
                    <td><?= h($lignebandeconsultations->lignedemandeoffredeprix_id) ?></td>
                    <td><?= h($lignebandeconsultations->fournisseur_id) ?></td>
                    <td><?= h($lignebandeconsultations->nameF) ?></td>
                    <td><?= h($lignebandeconsultations->codefrs) ?></td>
                    <td><?= h($lignebandeconsultations->article_id) ?></td>
                    <td><?= h($lignebandeconsultations->designiationA) ?></td>
                    <td><?= h($lignebandeconsultations->qte) ?></td>
                    <td><?= h($lignebandeconsultations->prix) ?></td>
                    <td><?= h($lignebandeconsultations->ht) ?></td>
                      <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['controller' => 'Lignebandeconsultations', 'action' => 'view', $lignebandeconsultations->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Edit'), ['controller' => 'Lignebandeconsultations', 'action' => 'edit', $lignebandeconsultations->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['controller' => 'Lignebandeconsultations', 'action' => 'delete', $lignebandeconsultations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lignebandeconsultations->id), 'class'=>'btn btn-danger btn-xs']) ?>
                  </td>
              </tr>
              <?php endforeach; ?>
          </table>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
