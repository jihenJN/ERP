<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Bonsortiestocks

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
                  <th scope="col"><?= $this->Paginator->sort('numero') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('pointdevente_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('materieltransport_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('cartecarburant_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('kilometragedepart') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('kilometragearrive') ?></th>
                  <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($bonsortiestocks as $bonsortiestock): ?>
                <tr>
                  <td><?= $this->Number->format($bonsortiestock->id) ?></td>
                  <td><?= h($bonsortiestock->numero) ?></td>
                  <td><?= h($bonsortiestock->date) ?></td>
                  <td><?= $this->Number->format($bonsortiestock->pointdevente_id) ?></td>
                  <td><?= $this->Number->format($bonsortiestock->materieltransport_id) ?></td>
                  <td><?= $this->Number->format($bonsortiestock->cartecarburant_id) ?></td>
                  <td><?= $this->Number->format($bonsortiestock->kilometragedepart) ?></td>
                  <td><?= $this->Number->format($bonsortiestock->kilometragearrive) ?></td>
                  <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['action' => 'view', $bonsortiestock->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Edit'), ['action' => 'edit', $bonsortiestock->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $bonsortiestock->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bonsortiestock->id), 'class'=>'btn btn-danger btn-xs']) ?>
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