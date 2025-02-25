<section class="content-header">
  <h1>
    Situationfamiliale
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
            <dt scope="row"><?= __('Name') ?></dt>
            <dd><?= h($situationfamiliale->name) ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($situationfamiliale->id) ?></dd>
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
          <h3 class="box-title"><?= __('Personnels') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php if (!empty($situationfamiliale->personnels)): ?>
          <table class="table table-hover">
              <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Fonction Id') ?></th>
                    <th scope="col"><?= __('Nom') ?></th>
                    <th scope="col"><?= __('Prenom') ?></th>
                    <th scope="col"><?= __('Code') ?></th>
                    <th scope="col"><?= __('Sexe Id') ?></th>
                    <th scope="col"><?= __('Dateentre') ?></th>
                    <th scope="col"><?= __('Situationfamiliale Id') ?></th>
                    <th scope="col"><?= __('Nombreenfant') ?></th>
                    <th scope="col"><?= __('Matriculecnss') ?></th>
                    <th scope="col"><?= __('Age') ?></th>
                    <th scope="col"><?= __('Chefdefamille') ?></th>
                    <th scope="col"><?= __('Typecontrat Id') ?></th>
                    <th scope="col"><?= __('Pointdevente Id') ?></th>
                    <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
              <?php foreach ($situationfamiliale->personnels as $personnels): ?>
              <tr>
                    <td><?= h($personnels->id) ?></td>
                    <td><?= h($personnels->fonction_id) ?></td>
                    <td><?= h($personnels->nom) ?></td>
                    <td><?= h($personnels->prenom) ?></td>
                    <td><?= h($personnels->code) ?></td>
                    <td><?= h($personnels->sexe_id) ?></td>
                    <td><?= h($personnels->dateentre) ?></td>
                    <td><?= h($personnels->situationfamiliale_id) ?></td>
                    <td><?= h($personnels->nombreenfant) ?></td>
                    <td><?= h($personnels->matriculecnss) ?></td>
                    <td><?= h($personnels->age) ?></td>
                    <td><?= h($personnels->chefdefamille) ?></td>
                    <td><?= h($personnels->typecontrat_id) ?></td>
                    <td><?= h($personnels->pointdevente_id) ?></td>
                      <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['controller' => 'Personnels', 'action' => 'view', $personnels->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Edit'), ['controller' => 'Personnels', 'action' => 'edit', $personnels->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['controller' => 'Personnels', 'action' => 'delete', $personnels->id], ['confirm' => __('Are you sure you want to delete # {0}?', $personnels->id), 'class'=>'btn btn-danger btn-xs']) ?>
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
