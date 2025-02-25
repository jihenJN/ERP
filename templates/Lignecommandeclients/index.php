<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lignecommandeclients

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
                  <th scope="col"><?= $this->Paginator->sort('commandeclient_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('article_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('qtestock') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('qte') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('prixht') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('remise') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('punht') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('tva') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('fodec') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('ttc') ?></th>
                  <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($lignecommandeclients as $lignecommandeclient): ?>
                <tr>
                  <td><?= $this->Number->format($lignecommandeclient->id) ?></td>
                  <td><?= $this->Number->format($lignecommandeclient->commandeclient_id) ?></td>
                  <td><?= $this->Number->format($lignecommandeclient->article_id) ?></td>
                  <td><?= $this->Number->format($lignecommandeclient->qtestock) ?></td>
                  <td><?= $this->Number->format($lignecommandeclient->qte) ?></td>
                  <td><?= $this->Number->format($lignecommandeclient->prixht) ?></td>
                  <td><?= $this->Number->format($lignecommandeclient->remise) ?></td>
                  <td><?= $this->Number->format($lignecommandeclient->punht) ?></td>
                  <td><?= $this->Number->format($lignecommandeclient->tva) ?></td>
                  <td><?= $this->Number->format($lignecommandeclient->fodec) ?></td>
                  <td><?= $this->Number->format($lignecommandeclient->ttc) ?></td>
                  <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['action' => 'view', $lignecommandeclient->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Edit'), ['action' => 'edit', $lignecommandeclient->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $lignecommandeclient->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lignecommandeclient->id), 'class'=>'btn btn-danger btn-xs']) ?>
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