<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lignelivraisons

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
                  <th scope="col"><?= $this->Paginator->sort('Livraison_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('commande_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('fournisseur_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('codefrs') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('article_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('qte') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('qteliv') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('prix') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('ht') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('remise') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('fodec') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('tva') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('ttc') ?></th>
                  <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($lignelivraisons as $lignelivraison): ?>
                <tr>
                  <td><?= $this->Number->format($lignelivraison->id) ?></td>
                  <td><?= $this->Number->format($lignelivraison->Livraison_id) ?></td>
                  <td><?= $this->Number->format($lignelivraison->commande_id) ?></td>
                  <td><?= $this->Number->format($lignelivraison->fournisseur_id) ?></td>
                  <td><?= h($lignelivraison->codefrs) ?></td>
                  <td><?= $this->Number->format($lignelivraison->article_id) ?></td>
                  <td><?= $this->Number->format($lignelivraison->qte) ?></td>
                  <td><?= $this->Number->format($lignelivraison->qteliv) ?></td>
                  <td><?= $this->Number->format($lignelivraison->prix) ?></td>
                  <td><?= $this->Number->format($lignelivraison->ht) ?></td>
                  <td><?= $this->Number->format($lignelivraison->remise) ?></td>
                  <td><?= $this->Number->format($lignelivraison->fodec) ?></td>
                  <td><?= $this->Number->format($lignelivraison->tva) ?></td>
                  <td><?= $this->Number->format($lignelivraison->ttc) ?></td>
                  <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['action' => 'view', $lignelivraison->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Edit'), ['action' => 'edit', $lignelivraison->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $lignelivraison->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lignelivraison->id), 'class'=>'btn btn-danger btn-xs']) ?>
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