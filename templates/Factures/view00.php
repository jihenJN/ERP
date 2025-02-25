<section class="content-header">
  <h1>
    Facture
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
        <div class="row">
             
             <div class="col-md-6">
                 <?php
                               echo $this->Form->control('livraison_id',["readonly"=>true,"type"=>"text","value"=>$facture->livraison_id]);

                 ?>
               </div>
               <div class="col-md-6">
                 <?php
                                 echo $this->Form->control('numero',["readonly"=>true,"type"=>"text","value"=>$facture->numero]);

                 ?>
               </div>
               <div class="col-md-6">
                 <?php
                                 echo $this->Form->control('date', ["readonly"=>true,"type"=>"text","value"=>$facture->date]);

                 ?>
               </div>
               <div class="col-md-6">
                 <?php
                                 echo $this->Form->control('fournisseur_id',["readonly"=>true,"type"=>"text","value"=>$facture->fournisseur->name]);

                 ?>
               </div>
               <div class="col-md-6">
                 <?php
                                 echo $this->Form->control('adresselivraisonfournisseur_id',["label"=>"adresse livraison fournisseur","readonly"=>true,"type"=>"text","value"=>$facture->adresselivraisonfournisseur->adresse]);

                 ?>
               </div>
               <div class="col-md-6">
                 <?php
                                 echo $this->Form->control('pointdevente_id',["label"=>"point de vente","readonly"=>true,"type"=>"text","value"=>$facture->pointdevente->name]);

                 ?>
               </div>
               <div class="col-md-6">
                 <?php
                                 echo $this->Form->control('depot_id',["readonly"=>true,"type"=>"text","value"=>$facture->has('depot') ? $facture->depot->name:""]);

                 ?>
               </div>
           
               <div class="col-md-6">
                 <?php
                                 echo $this->Form->control('cartecarburant_id',["label"=>"carte carburant","readonly"=>true,"type"=>"text","value"=>$facture->has('cartecarburant') ? $facture->cartecarburant->id: ""]);

                 ?>
               </div>
               <div class="col-md-6">
                 <?php
                                 echo $this->Form->control('materieltransport_id',["label"=>"materiel du transport","readonly"=>true,"type"=>"text","value"=>$facture->has('materieltransport') ? $facture->materieltransport->id: ""]);

                 ?>
               </div>
               <div class="col-md-6">
                 <?php
                                 echo $this->Form->control('kilometragedepart',["label"=>"kilometrage de depart","readonly"=>true,"type"=>"text","value"=>$facture->kilometragedepart]);

                 ?>
               </div>
               <div class="col-md-6">
                 <?php
                                 echo $this->Form->control('kilometragearrive',["label"=>"kilometrage d'arrive","readonly"=>true,"type"=>"text","value"=>$facture->kilometragearrive]);

                 ?>
               </div>
               <div class="col-md-6">
                 <?php
                                 echo $this->Form->control('chauffeur',["readonly"=>true,"type"=>"text","value"=>$facture->chauffeur]);

                 ?>
               </div>
               

               <div class="col-md-6">
                 <?php
                                 echo $this->Form->control('convoyeur',["readonly"=>true,"type"=>"text","value"=>$facture->convoyeur]);

                 ?>
               </div>
               <div class="col-md-6">
                 <?php
                                 echo $this->Form->control('valide',["readonly"=>true,"type"=>"text","value"=>$facture->valide]);

                 ?>
               </div>
               <div class="col-md-6">
                 <?php
                                 echo $this->Form->control('remise',["readonly"=>true,"type"=>"text","value"=>$facture->remise]);

                 ?>
               </div>
               <div class="col-md-6">
                 <?php
                                 echo $this->Form->control('tva',["readonly"=>true,"type"=>"text","value"=>$facture->tva]);

                 ?>
               </div>
               <div class="col-md-6">
                 <?php
                                 echo $this->Form->control('fodec',["readonly"=>true,"type"=>"text","value"=>$facture->fodec]);

                 ?>
               </div>
               <div class="col-md-6">
                 <?php
                                 echo $this->Form->control('ttc',["readonly"=>true,"type"=>"text","value"=>$facture->ttc]);

                 ?>
               </div>
               <div class="col-md-6">
                 <?php
                                 echo $this->Form->control('ht',["readonly"=>true,"type"=>"text","value"=>$facture->ht]);

                 ?>
               </div>
               
             </div>
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
          <?php if (!empty($facture->livraisons)): ?>
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
              <?php foreach ($facture->livraisons as $livraisons): ?>
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
  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-share-alt"></i>
          <h3 class="box-title"><?= __('Lignefactures') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php if (!empty($facture->lignefactures)): ?>
          <table class="table table-hover">
              <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Facture Id') ?></th>
                    <th scope="col"><?= __('Fournisseur Id') ?></th>
                    <th scope="col"><?= __('Codefrs') ?></th>
                    <th scope="col"><?= __('Article Id') ?></th>
                    <th scope="col"><?= __('Qte') ?></th>
                    <th scope="col"><?= __('Prix') ?></th>
                    <th scope="col"><?= __('Ht') ?></th>
                    <th scope="col"><?= __('Remise') ?></th>
                    <th scope="col"><?= __('Fodec') ?></th>
                    <th scope="col"><?= __('Tva') ?></th>
                    <th scope="col"><?= __('Ttc') ?></th>
                    <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
              <?php foreach ($facture->lignefactures as $lignefactures): ?>
              <tr>
                    <td><?= h($lignefactures->id) ?></td>
                    <td><?= h($lignefactures->facture_id) ?></td>
                    <td><?= h($lignefactures->fournisseur_id) ?></td>
                    <td><?= h($lignefactures->codefrs) ?></td>
                    <td><?= h($lignefactures->article_id) ?></td>
                    <td><?= h($lignefactures->qte) ?></td>
                    <td><?= h($lignefactures->prix) ?></td>
                    <td><?= h($lignefactures->ht) ?></td>
                    <td><?= h($lignefactures->remise) ?></td>
                    <td><?= h($lignefactures->fodec) ?></td>
                    <td><?= h($lignefactures->tva) ?></td>
                    <td><?= h($lignefactures->ttc) ?></td>
                      <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['controller' => 'Lignefactures', 'action' => 'view', $lignefactures->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Edit'), ['controller' => 'Lignefactures', 'action' => 'edit', $lignefactures->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['controller' => 'Lignefactures', 'action' => 'delete', $lignefactures->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lignefactures->id), 'class'=>'btn btn-danger btn-xs']) ?>
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
