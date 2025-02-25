<section class="content-header">
  <h1>
    Exercice
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
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($exercice->id) ?></dd>
            <dt scope="row"><?= __('Name') ?></dt>
            <dd><?= $this->Number->format($exercice->name) ?></dd>
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
          <h3 class="box-title"><?= __('Inventaires') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php if (!empty($exercice->inventaires)): ?>
          <table class="table table-hover">
              <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Depot Id') ?></th>
                    <th scope="col"><?= __('Date') ?></th>
                    <th scope="col"><?= __('Numero') ?></th>
                    <th scope="col"><?= __('Exercice Id') ?></th>
                    <th scope="col"><?= __('Valide') ?></th>
                    <th scope="col"><?= __('Type') ?></th>
                    <th scope="col"><?= __('Tournant') ?></th>
                    <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
              <?php foreach ($exercice->inventaires as $inventaires): ?>
              <tr>
                    <td><?= h($inventaires->id) ?></td>
                    <td><?= h($inventaires->depot_id) ?></td>
                    <td><?= h($inventaires->date) ?></td>
                    <td><?= h($inventaires->numero) ?></td>
                    <td><?= h($inventaires->exercice_id) ?></td>
                    <td><?= h($inventaires->valide) ?></td>
                    <td><?= h($inventaires->type) ?></td>
                    <td><?= h($inventaires->tournant) ?></td>
                      <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['controller' => 'Inventaires', 'action' => 'view', $inventaires->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Edit'), ['controller' => 'Inventaires', 'action' => 'edit', $inventaires->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['controller' => 'Inventaires', 'action' => 'delete', $inventaires->id], ['confirm' => __('Are you sure you want to delete # {0}?', $inventaires->id), 'class'=>'btn btn-danger btn-xs']) ?>
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
