<section class="content-header">
  <h1>
    Utilisateurmenu
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
            <dt scope="row"><?= __('Utilisateur') ?></dt>
            <dd><?= $utilisateurmenu->has('utilisateur') ? $this->Html->link($utilisateurmenu->utilisateur->name, ['controller' => 'Utilisateurs', 'action' => 'view', $utilisateurmenu->utilisateur->id]) : '' ?></dd>
            <dt scope="row"><?= __('Menu') ?></dt>
            <dd><?= $utilisateurmenu->has('menu') ? $this->Html->link($utilisateurmenu->menu->name, ['controller' => 'Menus', 'action' => 'view', $utilisateurmenu->menu->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($utilisateurmenu->id) ?></dd>
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
          <h3 class="box-title"><?= __('Liens') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php if (!empty($utilisateurmenu->liens)): ?>
          <table class="table table-hover">
              <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Utilisateurmenu Id') ?></th>
                    <th scope="col"><?= __('Lien') ?></th>
                    <th scope="col"><?= __('Add') ?></th>
                    <th scope="col"><?= __('Edit') ?></th>
                    <th scope="col"><?= __('Delete') ?></th>
                    <th scope="col"><?= __('Imprimer') ?></th>
                    <th scope="col"><?= __('Valide') ?></th>
                    <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
              <?php foreach ($utilisateurmenu->liens as $liens): ?>
              <tr>
                    <td><?= h($liens->id) ?></td>
                    <td><?= h($liens->utilisateurmenu_id) ?></td>
                    <td><?= h($liens->lien) ?></td>
                    <td><?= h($liens->add) ?></td>
                    <td><?= h($liens->edit) ?></td>
                    <td><?= h($liens->delete) ?></td>
                    <td><?= h($liens->imprimer) ?></td>
                    <td><?= h($liens->valide) ?></td>
                      <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['controller' => 'Liens', 'action' => 'view', $liens->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Edit'), ['controller' => 'Liens', 'action' => 'edit', $liens->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['controller' => 'Liens', 'action' => 'delete', $liens->id], ['confirm' => __('Are you sure you want to delete # {0}?', $liens->id), 'class'=>'btn btn-danger btn-xs']) ?>
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
