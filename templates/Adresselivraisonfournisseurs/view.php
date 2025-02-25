<section class="content-header">
  <h1>
    Adresselivraisonfournisseur
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
            <dt scope="row"><?= __('Adresse') ?></dt>
            <dd><?= h($adresselivraisonfournisseur->adresse) ?></dd>
            <dt scope="row"><?= __('Fournisseur') ?></dt>
            <dd><?= $adresselivraisonfournisseur->has('fournisseur') ? $this->Html->link($adresselivraisonfournisseur->fournisseur->name, ['controller' => 'Fournisseurs', 'action' => 'view', $adresselivraisonfournisseur->fournisseur->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($adresselivraisonfournisseur->id) ?></dd>
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
          <h3 class="box-title"><?= __('Factures') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php if (!empty($adresselivraisonfournisseur->factures)): ?>
          <table class="table table-hover">
              <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Livraison Id') ?></th>
                    <th scope="col"><?= __('Numero') ?></th>
                    <th scope="col"><?= __('Date') ?></th>
                    <th scope="col"><?= __('Fournisseur Id') ?></th>
                    <th scope="col"><?= __('Pointdevente Id') ?></th>
                    <th scope="col"><?= __('Depot Id') ?></th>
                    <th scope="col"><?= __('Cartecarburant Id') ?></th>
                    <th scope="col"><?= __('Materieltransport Id') ?></th>
                    <th scope="col"><?= __('Chauffeur') ?></th>
                    <th scope="col"><?= __('Convoyeur') ?></th>
                    <th scope="col"><?= __('Valide') ?></th>
                    <th scope="col"><?= __('Remise') ?></th>
                    <th scope="col"><?= __('Tva') ?></th>
                    <th scope="col"><?= __('Fodec') ?></th>
                    <th scope="col"><?= __('Ttc') ?></th>
                    <th scope="col"><?= __('Ht') ?></th>
                    <th scope="col"><?= __('Adresselivraisonfournisseur Id') ?></th>
                    <th scope="col"><?= __('Kilometragedepart') ?></th>
                    <th scope="col"><?= __('Kilometragearrive') ?></th>
                    <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
              <?php foreach ($adresselivraisonfournisseur->factures as $factures): ?>
              <tr>
                    <td><?= h($factures->id) ?></td>
                    <td><?= h($factures->livraison_id) ?></td>
                    <td><?= h($factures->numero) ?></td>
                    <td><?= h($factures->date) ?></td>
                    <td><?= h($factures->fournisseur_id) ?></td>
                    <td><?= h($factures->pointdevente_id) ?></td>
                    <td><?= h($factures->depot_id) ?></td>
                    <td><?= h($factures->cartecarburant_id) ?></td>
                    <td><?= h($factures->materieltransport_id) ?></td>
                    <td><?= h($factures->chauffeur) ?></td>
                    <td><?= h($factures->convoyeur) ?></td>
                    <td><?= h($factures->valide) ?></td>
                    <td><?= h($factures->remise) ?></td>
                    <td><?= h($factures->tva) ?></td>
                    <td><?= h($factures->fodec) ?></td>
                    <td><?= h($factures->ttc) ?></td>
                    <td><?= h($factures->ht) ?></td>
                    <td><?= h($factures->adresselivraisonfournisseur_id) ?></td>
                    <td><?= h($factures->kilometragedepart) ?></td>
                    <td><?= h($factures->kilometragearrive) ?></td>
                      <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['controller' => 'Factures', 'action' => 'view', $factures->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Edit'), ['controller' => 'Factures', 'action' => 'edit', $factures->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['controller' => 'Factures', 'action' => 'delete', $factures->id], ['confirm' => __('Are you sure you want to delete # {0}?', $factures->id), 'class'=>'btn btn-danger btn-xs']) ?>
                  </td>
              </tr>
              <?php endforeach; ?>
          </table>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-share-alt"></i>
          <h3 class="box-title"><?= __('Livraisons') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php if (!empty($adresselivraisonfournisseur->livraisons)): ?>
          <table class="table table-hover">
              <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Commande Id') ?></th>
                    <th scope="col"><?= __('Numero') ?></th>
                    <th scope="col"><?= __('Date') ?></th>
                    <th scope="col"><?= __('Fournisseur Id') ?></th>
                    <th scope="col"><?= __('Adresselivraisonfournisseur Id') ?></th>
                    <th scope="col"><?= __('Pointdevente Id') ?></th>
                    <th scope="col"><?= __('Depot Id') ?></th>
                    <th scope="col"><?= __('Cartecarburant Id') ?></th>
                    <th scope="col"><?= __('Materieltransport Id') ?></th>
                    <th scope="col"><?= __('Kilometragedepart') ?></th>
                    <th scope="col"><?= __('Kilometragearrive') ?></th>
                    <th scope="col"><?= __('Chauffeur') ?></th>
                    <th scope="col"><?= __('Convoyeur') ?></th>
                    <th scope="col"><?= __('Valide') ?></th>
                    <th scope="col"><?= __('Remise') ?></th>
                    <th scope="col"><?= __('Tva') ?></th>
                    <th scope="col"><?= __('Fodec') ?></th>
                    <th scope="col"><?= __('Ttc') ?></th>
                    <th scope="col"><?= __('Ht') ?></th>
                    <th scope="col"><?= __('Facture Id') ?></th>
                    <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
              <?php foreach ($adresselivraisonfournisseur->livraisons as $livraisons): ?>
              <tr>
                    <td><?= h($livraisons->id) ?></td>
                    <td><?= h($livraisons->commande_id) ?></td>
                    <td><?= h($livraisons->numero) ?></td>
                    <td><?= h($livraisons->date) ?></td>
                    <td><?= h($livraisons->fournisseur_id) ?></td>
                    <td><?= h($livraisons->adresselivraisonfournisseur_id) ?></td>
                    <td><?= h($livraisons->pointdevente_id) ?></td>
                    <td><?= h($livraisons->depot_id) ?></td>
                    <td><?= h($livraisons->cartecarburant_id) ?></td>
                    <td><?= h($livraisons->materieltransport_id) ?></td>
                    <td><?= h($livraisons->kilometragedepart) ?></td>
                    <td><?= h($livraisons->kilometragearrive) ?></td>
                    <td><?= h($livraisons->chauffeur) ?></td>
                    <td><?= h($livraisons->convoyeur) ?></td>
                    <td><?= h($livraisons->valide) ?></td>
                    <td><?= h($livraisons->remise) ?></td>
                    <td><?= h($livraisons->tva) ?></td>
                    <td><?= h($livraisons->fodec) ?></td>
                    <td><?= h($livraisons->ttc) ?></td>
                    <td><?= h($livraisons->ht) ?></td>
                    <td><?= h($livraisons->facture_id) ?></td>
                      <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['controller' => 'Livraisons', 'action' => 'view', $livraisons->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Edit'), ['controller' => 'Livraisons', 'action' => 'edit', $livraisons->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['controller' => 'Livraisons', 'action' => 'delete', $livraisons->id], ['confirm' => __('Are you sure you want to delete # {0}?', $livraisons->id), 'class'=>'btn btn-danger btn-xs']) ?>
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
