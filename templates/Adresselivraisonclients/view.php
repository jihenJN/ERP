<section class="content-header">
  <h1>
    Adresselivraisonclient
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
            <dd><?= h($adresselivraisonclient->adresse) ?></dd>
            <dt scope="row"><?= __('Client') ?></dt>
            <dd><?= $adresselivraisonclient->has('client') ? $this->Html->link($adresselivraisonclient->client->name, ['controller' => 'Clients', 'action' => 'view', $adresselivraisonclient->client->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($adresselivraisonclient->id) ?></dd>
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
          <h3 class="box-title"><?= __('Bonlivraisons') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php if (!empty($adresselivraisonclient->bonlivraisons)): ?>
          <table class="table table-hover">
              <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Numero') ?></th>
                    <th scope="col"><?= __('Date') ?></th>
                    <th scope="col"><?= __('Client Id') ?></th>
                    <th scope="col"><?= __('Pointdevente Id') ?></th>
                    <th scope="col"><?= __('Depot Id') ?></th>
                    <th scope="col"><?= __('Materieltransport Id') ?></th>
                    <th scope="col"><?= __('Cartecarburant Id') ?></th>
                    <th scope="col"><?= __('Chauffeur Id') ?></th>
                    <th scope="col"><?= __('Convoyeur Id') ?></th>
                    <th scope="col"><?= __('Totalht') ?></th>
                    <th scope="col"><?= __('Totalttc') ?></th>
                    <th scope="col"><?= __('Totalfodec') ?></th>
                    <th scope="col"><?= __('Totalremise') ?></th>
                    <th scope="col"><?= __('Totaltva') ?></th>
                    <th scope="col"><?= __('Factureclient Id') ?></th>
                    <th scope="col"><?= __('Kilometragedepart') ?></th>
                    <th scope="col"><?= __('Kilometragearrive') ?></th>
                    <th scope="col"><?= __('Adresselivraisonclient Id') ?></th>
                    <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
              <?php foreach ($adresselivraisonclient->bonlivraisons as $bonlivraisons): ?>
              <tr>
                    <td><?= h($bonlivraisons->id) ?></td>
                    <td><?= h($bonlivraisons->numero) ?></td>
                    <td><?= h($bonlivraisons->date) ?></td>
                    <td><?= h($bonlivraisons->client_id) ?></td>
                    <td><?= h($bonlivraisons->pointdevente_id) ?></td>
                    <td><?= h($bonlivraisons->depot_id) ?></td>
                    <td><?= h($bonlivraisons->materieltransport_id) ?></td>
                    <td><?= h($bonlivraisons->cartecarburant_id) ?></td>
                    <td><?= h($bonlivraisons->chauffeur_id) ?></td>
                    <td><?= h($bonlivraisons->convoyeur_id) ?></td>
                    <td><?= h($bonlivraisons->totalht) ?></td>
                    <td><?= h($bonlivraisons->totalttc) ?></td>
                    <td><?= h($bonlivraisons->totalfodec) ?></td>
                    <td><?= h($bonlivraisons->totalremise) ?></td>
                    <td><?= h($bonlivraisons->totaltva) ?></td>
                    <td><?= h($bonlivraisons->factureclient_id) ?></td>
                    <td><?= h($bonlivraisons->kilometragedepart) ?></td>
                    <td><?= h($bonlivraisons->kilometragearrive) ?></td>
                    <td><?= h($bonlivraisons->adresselivraisonclient_id) ?></td>
                      <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['controller' => 'Bonlivraisons', 'action' => 'view', $bonlivraisons->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Edit'), ['controller' => 'Bonlivraisons', 'action' => 'edit', $bonlivraisons->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['controller' => 'Bonlivraisons', 'action' => 'delete', $bonlivraisons->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bonlivraisons->id), 'class'=>'btn btn-danger btn-xs']) ?>
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
          <h3 class="box-title"><?= __('Factureclients') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php if (!empty($adresselivraisonclient->factureclients)): ?>
          <table class="table table-hover">
              <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Numero') ?></th>
                    <th scope="col"><?= __('Date') ?></th>
                    <th scope="col"><?= __('Client Id') ?></th>
                    <th scope="col"><?= __('Pointdevente Id') ?></th>
                    <th scope="col"><?= __('Depot Id') ?></th>
                    <th scope="col"><?= __('Materieltransport Id') ?></th>
                    <th scope="col"><?= __('Cartecarburant Id') ?></th>
                    <th scope="col"><?= __('Chauffeur Id') ?></th>
                    <th scope="col"><?= __('Convoyeur Id') ?></th>
                    <th scope="col"><?= __('Totalht') ?></th>
                    <th scope="col"><?= __('Totalremise') ?></th>
                    <th scope="col"><?= __('Totalfodec') ?></th>
                    <th scope="col"><?= __('Totaltva') ?></th>
                    <th scope="col"><?= __('Totalttc') ?></th>
                    <th scope="col"><?= __('Kilometragearrive') ?></th>
                    <th scope="col"><?= __('Kilometragedepart') ?></th>
                    <th scope="col"><?= __('Adresselivraisonclient Id') ?></th>
                    <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
              <?php foreach ($adresselivraisonclient->factureclients as $factureclients): ?>
              <tr>
                    <td><?= h($factureclients->id) ?></td>
                    <td><?= h($factureclients->numero) ?></td>
                    <td><?= h($factureclients->date) ?></td>
                    <td><?= h($factureclients->client_id) ?></td>
                    <td><?= h($factureclients->pointdevente_id) ?></td>
                    <td><?= h($factureclients->depot_id) ?></td>
                    <td><?= h($factureclients->materieltransport_id) ?></td>
                    <td><?= h($factureclients->cartecarburant_id) ?></td>
                    <td><?= h($factureclients->chauffeur_id) ?></td>
                    <td><?= h($factureclients->convoyeur_id) ?></td>
                    <td><?= h($factureclients->totalht) ?></td>
                    <td><?= h($factureclients->totalremise) ?></td>
                    <td><?= h($factureclients->totalfodec) ?></td>
                    <td><?= h($factureclients->totaltva) ?></td>
                    <td><?= h($factureclients->totalttc) ?></td>
                    <td><?= h($factureclients->kilometragearrive) ?></td>
                    <td><?= h($factureclients->kilometragedepart) ?></td>
                    <td><?= h($factureclients->adresselivraisonclient_id) ?></td>
                      <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['controller' => 'Factureclients', 'action' => 'view', $factureclients->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Edit'), ['controller' => 'Factureclients', 'action' => 'edit', $factureclients->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['controller' => 'Factureclients', 'action' => 'delete', $factureclients->id], ['confirm' => __('Are you sure you want to delete # {0}?', $factureclients->id), 'class'=>'btn btn-danger btn-xs']) ?>
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
