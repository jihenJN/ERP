<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lignebonreceptionstocks

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
                  <th scope="col"><?= $this->Paginator->sort('bonreceptionstock_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('article_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('qte') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('prix') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('total') ?></th>
                  <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($lignebonreceptionstocks as $lignebonreceptionstock): ?>
                <tr>
                  <td><?= $this->Number->format($lignebonreceptionstock->id) ?></td>
                  <td><?= $this->Number->format($lignebonreceptionstock->bonreceptionstock_id) ?></td>
                  <td><?= $this->Number->format($lignebonreceptionstock->article_id) ?></td>
                  <td><?= $this->Number->format($lignebonreceptionstock->qte) ?></td>
                  <td><?= $this->Number->format($lignebonreceptionstock->prix) ?></td>
                  <td><?= $this->Number->format($lignebonreceptionstock->total) ?></td>
                  <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['action' => 'view', $lignebonreceptionstock->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Edit'), ['action' => 'edit', $lignebonreceptionstock->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $lignebonreceptionstock->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lignebonreceptionstock->id), 'class'=>'btn btn-danger btn-xs']) ?>
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