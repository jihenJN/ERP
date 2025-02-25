<section class="content-header">
  <h1>
    Typelocalisation
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
            <dd><?= h($typelocalisation->name) ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($typelocalisation->id) ?></dd>
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
          <h3 class="box-title"><?= __('Fournisseurs') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php if (!empty($typelocalisation->fournisseurs)): ?>
          <table class="table table-hover">
              <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Name') ?></th>
                    <th scope="col"><?= __('Typeutilisateur Id') ?></th>
                    <th scope="col"><?= __('Typelocalisation Id') ?></th>
                    <th scope="col"><?= __('Compte Comptable') ?></th>
                    <th scope="col"><?= __('Ville Id') ?></th>
                    <th scope="col"><?= __('Codepostal') ?></th>
                    <th scope="col"><?= __('Region Id') ?></th>
                    <th scope="col"><?= __('Pay Id') ?></th>
                    <th scope="col"><?= __('Activite') ?></th>
                    <th scope="col"><?= __('Secteur') ?></th>
                    <th scope="col"><?= __('Tel') ?></th>
                    <th scope="col"><?= __('Fax') ?></th>
                    <th scope="col"><?= __('Mail') ?></th>
                    <th scope="col"><?= __('Site') ?></th>
                    <th scope="col"><?= __('Paiement Id') ?></th>
                    <th scope="col"><?= __('Devise Id') ?></th>
                    <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
              <?php foreach ($typelocalisation->fournisseurs as $fournisseurs): ?>
              <tr>
                    <td><?= h($fournisseurs->id) ?></td>
                    <td><?= h($fournisseurs->name) ?></td>
                    <td><?= h($fournisseurs->typeutilisateur_id) ?></td>
                    <td><?= h($fournisseurs->typelocalisation_id) ?></td>
                    <td><?= h($fournisseurs->compte_comptable) ?></td>
                    <td><?= h($fournisseurs->ville_id) ?></td>
                    <td><?= h($fournisseurs->codepostal) ?></td>
                    <td><?= h($fournisseurs->region_id) ?></td>
                    <td><?= h($fournisseurs->pay_id) ?></td>
                    <td><?= h($fournisseurs->activite) ?></td>
                    <td><?= h($fournisseurs->secteur) ?></td>
                    <td><?= h($fournisseurs->tel) ?></td>
                    <td><?= h($fournisseurs->fax) ?></td>
                    <td><?= h($fournisseurs->mail) ?></td>
                    <td><?= h($fournisseurs->site) ?></td>
                    <td><?= h($fournisseurs->paiement_id) ?></td>
                    <td><?= h($fournisseurs->devise_id) ?></td>
                      <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['controller' => 'Fournisseurs', 'action' => 'view', $fournisseurs->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Edit'), ['controller' => 'Fournisseurs', 'action' => 'edit', $fournisseurs->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['controller' => 'Fournisseurs', 'action' => 'delete', $fournisseurs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fournisseurs->id), 'class'=>'btn btn-danger btn-xs']) ?>
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
