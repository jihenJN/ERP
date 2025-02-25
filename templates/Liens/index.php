<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Liens

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
                  <th scope="col"><?= $this->Paginator->sort('utilisateurmenu_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('lien') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('add') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('edit') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('delete') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('imprimer') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('valide') ?></th>
                  <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($liens as $lien): ?>
                <tr>
                  <td><?= $this->Number->format($lien->id) ?></td>
                  <td><?= $this->Number->format($lien->utilisateurmenu_id) ?></td>
                  <td><?= h($lien->lien) ?></td>
                  <td><?= h($lien->add) ?></td>
                  <td><?= h($lien->edit) ?></td>
                  <td><?= h($lien->delete) ?></td>
                  <td><?= h($lien->imprimer) ?></td>
                  <td><?= $this->Number->format($lien->valide) ?></td>
                  <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['action' => 'view', $lien->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Edit'), ['action' => 'edit', $lien->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $lien->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lien->id), 'class'=>'btn btn-danger btn-xs']) ?>
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