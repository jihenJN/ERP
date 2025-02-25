<section class="content-header">
  <h1>
    Sousfamille3
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
            <dt scope="row"><?= __('Sousfamille2') ?></dt>
            <dd><?= $sousfamille3->has('sousfamille2') ? $this->Html->link($sousfamille3->sousfamille2->name, ['controller' => 'Sousfamille2s', 'action' => 'view', $sousfamille3->sousfamille2->id]) : '' ?></dd>
            <dt scope="row"><?= __('Name') ?></dt>
            <dd><?= h($sousfamille3->name) ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($sousfamille3->id) ?></dd>
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
          <h3 class="box-title"><?= __('Articles') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php if (!empty($sousfamille3->articles)): ?>
          <table class="table table-hover">
              <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Pointdevente Id') ?></th>
                    <th scope="col"><?= __('Famille Id') ?></th>
                    <th scope="col"><?= __('Categorie Id') ?></th>
                    <th scope="col"><?= __('Sousfamille1 Id') ?></th>
                    <th scope="col"><?= __('Sousfamille2 Id') ?></th>
                    <th scope="col"><?= __('Sousfamille3 Id') ?></th>
                    <th scope="col"><?= __('Codefrs') ?></th>
                    <th scope="col"><?= __('Reference') ?></th>
                    <th scope="col"><?= __('Designiation') ?></th>
                    <th scope="col"><?= __('Dimension') ?></th>
                    <th scope="col"><?= __('Etat') ?></th>
                    <th scope="col"><?= __('Unite Id') ?></th>
                    <th scope="col"><?= __('Codeabarre') ?></th>
                    <th scope="col"><?= __('Durevie') ?></th>
                    <th scope="col"><?= __('Puht') ?></th>
                    <th scope="col"><?= __('Fodec') ?></th>
                    <th scope="col"><?= __('Tva') ?></th>
                    <th scope="col"><?= __('Ttc') ?></th>
                    <th scope="col"><?= __('Prixachat') ?></th>
                    <th scope="col"><?= __('Prixafodec') ?></th>
                    <th scope="col"><?= __('Commantaire') ?></th>
                    <th scope="col"><?= __('Poste') ?></th>
                    <th scope="col"><?= __('Colisage') ?></th>
                    <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
              <?php foreach ($sousfamille3->articles as $articles): ?>
              <tr>
                    <td><?= h($articles->id) ?></td>
                    <td><?= h($articles->pointdevente_id) ?></td>
                    <td><?= h($articles->famille_id) ?></td>
                    <td><?= h($articles->categorie_id) ?></td>
                    <td><?= h($articles->sousfamille1_id) ?></td>
                    <td><?= h($articles->sousfamille2_id) ?></td>
                    <td><?= h($articles->sousfamille3_id) ?></td>
                    <td><?= h($articles->codefrs) ?></td>
                    <td><?= h($articles->reference) ?></td>
                    <td><?= h($articles->designiation) ?></td>
                    <td><?= h($articles->dimension) ?></td>
                    <td><?= h($articles->etat) ?></td>
                    <td><?= h($articles->unite_id) ?></td>
                    <td><?= h($articles->codeabarre) ?></td>
                    <td><?= h($articles->durevie) ?></td>
                    <td><?= h($articles->puht) ?></td>
                    <td><?= h($articles->fodec) ?></td>
                    <td><?= h($articles->tva) ?></td>
                    <td><?= h($articles->ttc) ?></td>
                    <td><?= h($articles->prixachat) ?></td>
                    <td><?= h($articles->prixafodec) ?></td>
                    <td><?= h($articles->commantaire) ?></td>
                    <td><?= h($articles->poste) ?></td>
                    <td><?= h($articles->colisage) ?></td>
                      <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['controller' => 'Articles', 'action' => 'view', $articles->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Edit'), ['controller' => 'Articles', 'action' => 'edit', $articles->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['controller' => 'Articles', 'action' => 'delete', $articles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $articles->id), 'class'=>'btn btn-danger btn-xs']) ?>
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
