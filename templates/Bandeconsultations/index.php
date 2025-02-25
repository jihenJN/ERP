<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Bandeconsultations

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
                  <th scope="col"><?= $this->Paginator->sort('fournisseur_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('nameF') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('codefrs') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('article_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('designiationA') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('qte') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('prix') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('totalprix') ?></th>
                  <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($bandeconsultations as $bandeconsultation): ?>
                <tr>
                  <td><?= $this->Number->format($bandeconsultation->id) ?></td>
                  <td><?= $this->Number->format($bandeconsultation->demandeoffredeprix_id) ?></td>
                  <td><?= $this->Number->format($bandeconsultation->fournisseur_id) ?></td>
                  <td><?= h($bandeconsultation->nameF) ?></td>
                  <td><?= h($bandeconsultation->codefrs) ?></td>
                  <td><?= $this->Number->format($bandeconsultation->article_id) ?></td>
                  <td><?= h($bandeconsultation->designiationA) ?></td>
                  <td><?= $this->Number->format($bandeconsultation->qte) ?></td>
                  <td><?= $this->Number->format($bandeconsultation->prix) ?></td>
                  <td><?= $this->Number->format($bandeconsultation->totalprix) ?></td>
                  <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['action' => 'view', $bandeconsultation->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Edit'), ['action' => 'edit', $bandeconsultation->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $bandeconsultation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bandeconsultation->id), 'class'=>'btn btn-danger btn-xs']) ?>
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