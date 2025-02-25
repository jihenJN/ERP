<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Livraisonsanc

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
                  <th scope="col"><?= $this->Paginator->sort('commande_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('numero') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('fournisseur_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('pointdevente_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('depot_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('cartecarburant_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('materieltransport_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('chauffeur') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('convoyeur') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('valide') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('remise') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('tva') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('fodec') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('ttc') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('ht') ?></th>
                  <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($livraisonsanc as $livraisonsanc): ?>
                <tr>
                  <td><?= $this->Number->format($livraisonsanc->id) ?></td>
                  <td><?= $this->Number->format($livraisonsanc->commande_id) ?></td>
                  <td><?= h($livraisonsanc->numero) ?></td>
                  <td><?= h($livraisonsanc->date) ?></td>
                  <td><?= $this->Number->format($livraisonsanc->fournisseur_id) ?></td>
                  <td><?= $this->Number->format($livraisonsanc->pointdevente_id) ?></td>
                  <td><?= $this->Number->format($livraisonsanc->depot_id) ?></td>
                  <td><?= $this->Number->format($livraisonsanc->cartecarburant_id) ?></td>
                  <td><?= $this->Number->format($livraisonsanc->materieltransport_id) ?></td>
                  <td><?= $this->Number->format($livraisonsanc->chauffeur) ?></td>
                  <td><?= $this->Number->format($livraisonsanc->convoyeur) ?></td>
                  <td><?= $this->Number->format($livraisonsanc->valide) ?></td>
                  <td><?= $this->Number->format($livraisonsanc->remise) ?></td>
                  <td><?= $this->Number->format($livraisonsanc->tva) ?></td>
                  <td><?= $this->Number->format($livraisonsanc->fodec) ?></td>
                  <td><?= $this->Number->format($livraisonsanc->ttc) ?></td>
                  <td><?= $this->Number->format($livraisonsanc->ht) ?></td>
                  <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['action' => 'view', $livraisonsanc->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Edit'), ['action' => 'edit', $livraisonsanc->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $livraisonsanc->id], ['confirm' => __('Are you sure you want to delete # {0}?', $livraisonsanc->id), 'class'=>'btn btn-danger btn-xs']) ?>
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