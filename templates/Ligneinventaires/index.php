<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Ligneinventaires

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
                  <th scope="col"><?= $this->Paginator->sort('inventaire_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('article_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('quantite') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('numerolot') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('coutderevien') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('date_exp') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('depot_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('prixvente') ?></th>
                  <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($ligneinventaires as $ligneinventaire): ?>
                <tr>
                  <td><?= $this->Number->format($ligneinventaire->id) ?></td>
                  <td><?= $this->Number->format($ligneinventaire->inventaire_id) ?></td>
                  <td><?= $this->Number->format($ligneinventaire->article_id) ?></td>
                  <td><?= $this->Number->format($ligneinventaire->quantite) ?></td>
                  <td><?= h($ligneinventaire->numerolot) ?></td>
                  <td><?= $this->Number->format($ligneinventaire->coutderevien) ?></td>
                  <td><?= h($ligneinventaire->date) ?></td>
                  <td><?= h($ligneinventaire->date_exp) ?></td>
                  <td><?= $this->Number->format($ligneinventaire->depot_id) ?></td>
                  <td><?= $this->Number->format($ligneinventaire->prixvente) ?></td>
                  <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['action' => 'view', $ligneinventaire->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ligneinventaire->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $ligneinventaire->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ligneinventaire->id), 'class'=>'btn btn-danger btn-xs']) ?>
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