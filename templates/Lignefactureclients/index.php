<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lignefactureclients

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
                  <th scope="col"><?= $this->Paginator->sort('factureclient_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('article_id') ?></th>
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
              <?php foreach ($lignefactureclients as $lignefactureclient): ?>
                <tr>
                  <td><?= $this->Number->format($lignefactureclient->id) ?></td>
                  <td><?= $this->Number->format($lignefactureclient->factureclient_id) ?></td>
                  <td><?= $this->Number->format($lignefactureclient->article_id) ?></td>
                  <td><?= $this->Number->format($lignefactureclient->qte) ?></td>
                  <td><?= $this->Number->format($lignefactureclient->prixht) ?></td>
                  <td><?= $this->Number->format($lignefactureclient->remise) ?></td>
                  <td><?= $this->Number->format($lignefactureclient->punht) ?></td>
                  <td><?= $this->Number->format($lignefactureclient->tva) ?></td>
                  <td><?= $this->Number->format($lignefactureclient->fodec) ?></td>
                  <td><?= $this->Number->format($lignefactureclient->ttc) ?></td>
                  <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['action' => 'view', $lignefactureclient->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Edit'), ['action' => 'edit', $lignefactureclient->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $lignefactureclient->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lignefactureclient->id), 'class'=>'btn btn-danger btn-xs']) ?>
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