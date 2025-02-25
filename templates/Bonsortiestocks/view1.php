<section class="content-header">
  <h1>
    Bonsortiestock
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
            <dt scope="row"><?= __('Numero') ?></dt>
            <dd><?= h($bonsortiestock->numero) ?></dd>
            <dt scope="row"><?= __('Pointdevente') ?></dt>
            <dd><?= $bonsortiestock->has('pointdevente') ? $this->Html->link($bonsortiestock->pointdevente->name, ['controller' => 'Pointdeventes', 'action' => 'view', $bonsortiestock->pointdevente->id]) : '' ?></dd>
            <dt scope="row"><?= __('Materieltransport') ?></dt>
            <dd><?= $bonsortiestock->has('materieltransport') ? $this->Html->link($bonsortiestock->materieltransport->id, ['controller' => 'Materieltransports', 'action' => 'view', $bonsortiestock->materieltransport->id]) : '' ?></dd>
            <dt scope="row"><?= __('Cartecarburant') ?></dt>
            <dd><?= $bonsortiestock->has('cartecarburant') ? $this->Html->link($bonsortiestock->cartecarburant->id, ['controller' => 'Cartecarburants', 'action' => 'view', $bonsortiestock->cartecarburant->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($bonsortiestock->id) ?></dd>
            <dt scope="row"><?= __('Kilometragedepart') ?></dt>
            <dd><?= $this->Number->format($bonsortiestock->kilometragedepart) ?></dd>
            <dt scope="row"><?= __('Kilometragearrive') ?></dt>
            <dd><?= $this->Number->format($bonsortiestock->kilometragearrive) ?></dd>
            <dt scope="row"><?= __('Date') ?></dt>
            <dd><?= h($bonsortiestock->date) ?></dd>
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
          <h3 class="box-title"><?= __('Lignebonsortiestocks') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php if (!empty($bonsortiestock->lignebonsortiestocks)): ?>
          <table class="table table-hover">
              <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Bonsortiestock Id') ?></th>
                    <th scope="col"><?= __('Article Id') ?></th>
                    <th scope="col"><?= __('Qtestock') ?></th>
                    <th scope="col"><?= __('Qte') ?></th>
                    <th scope="col"><?= __('Prix') ?></th>
                    <th scope="col"><?= __('Total') ?></th>
                    <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
              <?php foreach ($bonsortiestock->lignebonsortiestocks as $lignebonsortiestocks): ?>
              <tr>
                    <td><?= h($lignebonsortiestocks->id) ?></td>
                    <td><?= h($lignebonsortiestocks->bonsortiestock_id) ?></td>
                    <td><?= h($lignebonsortiestocks->article_id) ?></td>
                    <td><?= h($lignebonsortiestocks->qtestock) ?></td>
                    <td><?= h($lignebonsortiestocks->qte) ?></td>
                    <td><?= h($lignebonsortiestocks->prix) ?></td>
                    <td><?= h($lignebonsortiestocks->total) ?></td>
                      <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['controller' => 'Lignebonsortiestocks', 'action' => 'view', $lignebonsortiestocks->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Edit'), ['controller' => 'Lignebonsortiestocks', 'action' => 'edit', $lignebonsortiestocks->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['controller' => 'Lignebonsortiestocks', 'action' => 'delete', $lignebonsortiestocks->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lignebonsortiestocks->id), 'class'=>'btn btn-danger btn-xs']) ?>
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
