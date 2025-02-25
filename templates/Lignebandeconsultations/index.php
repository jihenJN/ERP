<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lignebandeconsultations

    <div class="pull-right"><?php echo $this->Html->link(__('New'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?php echo __('List'); ?></h3>

          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control pull-right" placeholder="<?php echo __('Search'); ?>">

                <div class="input-group-btn">
                  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <thead>
              <tr>
                  <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('demandeoffredeprix_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('bandeconsultation_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('lignedemandeoffredeprix_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('fournisseur_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('nameF') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('codefrs') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('article_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('designiationA') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('qte') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('prix') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('ht') ?></th>
                  <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($lignebandeconsultations as $lignebandeconsultation): ?>
                <tr>
                  <td><?= $this->Number->format($lignebandeconsultation->id) ?></td>
                  <td><?= $this->Number->format($lignebandeconsultation->demandeoffredeprix_id) ?></td>
                  <td><?= $this->Number->format($lignebandeconsultation->bandeconsultation_id) ?></td>
                  <td><?= $this->Number->format($lignebandeconsultation->lignedemandeoffredeprix_id) ?></td>
                  <td><?= $this->Number->format($lignebandeconsultation->fournisseur_id) ?></td>
                  <td><?= h($lignebandeconsultation->nameF) ?></td>
                  <td><?= h($lignebandeconsultation->codefrs) ?></td>
                  <td><?= $this->Number->format($lignebandeconsultation->article_id) ?></td>
                  <td><?= h($lignebandeconsultation->designiationA) ?></td>
                  <td><?= $this->Number->format($lignebandeconsultation->qte) ?></td>
                  <td><?= $this->Number->format($lignebandeconsultation->prix) ?></td>
                  <td><?= $this->Number->format($lignebandeconsultation->ht) ?></td>
                  <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['action' => 'view', $lignebandeconsultation->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Edit'), ['action' => 'edit', $lignebandeconsultation->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $lignebandeconsultation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lignebandeconsultation->id), 'class'=>'btn btn-danger btn-xs']) ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>