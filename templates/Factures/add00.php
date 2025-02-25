<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Facture $facture
 */
?>
<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Facture
      <small><?php echo __('Add'); ?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Home'); ?></a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo __('Form'); ?></h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <?php echo $this->Form->create($facture, ['role' => 'form']); ?>
            <div class="box-body">
                     <div class="row">
             
              <div class="col-md-6">
                  <?php
                                echo $this->Form->control('livraison_id',['empty' => 'Veuillez choisir !!','options'=>$livraisons,"onChange"=>'get_ligne_livraisons(this.value)',"empty"=>"Veuillez choisir !!"]);

                  ?>
                </div>
                <div class="col-md-6">
                  <?php
                                  echo $this->Form->control('numero',['value'=>sprintf('%04d',$numero),'readonly'=>true]);

                  ?>
                </div>
                <div class="col-md-6">
                  <?php
                                  echo $this->Form->control('date', ["value"=>date('Y-m-d H:i:s',strtotime('+1 hour',strtotime(date('Y-m-d H:i:s'))))]);

                  ?>
                </div>
                <div class="col-md-6">
                  <?php
                                  echo $this->Form->control('fournisseur_id', ['empty' => 'Veuillez choisir !!','options' => $fournisseurs]);

                  ?>
                </div>
                <div class="col-md-6">
                  <?php
                                  echo $this->Form->control('adresselivraisonfournisseur_id', ["label"=>"adresse livraison fournisseur",'empty' => 'Veuillez choisir !!','options' => $adresselivraisonfournisseurs]);

                  ?>
                </div>
                <div class="col-md-6">
                  <?php
                                  echo $this->Form->control('pointdevente_id', ["label"=>"point de vente",'empty' => 'Veuillez choisir !!','options' => $pointdeventes]);

                  ?>
                </div>
                <div class="col-md-6">
                  <?php
                                  echo $this->Form->control('depot_id', ['empty' => 'Veuillez choisir !!','options' => $depots]);

                  ?>
                </div>
            
                <div class="col-md-6">
                  <?php
                                  echo $this->Form->control('cartecarburant_id', ["label"=>"carte carburant",'empty' => 'Veuillez choisir !!','options' => $cartecarburants]);

                  ?>
                </div>
                <div class="col-md-6">
                  <?php
                                  echo $this->Form->control('materieltransport_id', ["label"=>"materiel de transport",'empty' => 'Veuillez choisir !!','options' => $materieltransports]);

                  ?>
                </div>
                <div class="col-md-6">
                  <?php
                                  echo $this->Form->control('kilometragedepart',["label"=>"kilometrage de depart"]);

                  ?>
                </div>
                <div class="col-md-6">
                  <?php
                                  echo $this->Form->control('kilometragearrive',["label"=>"kilometrage d'arrive"]);

                  ?>
                </div>
                <div class="col-md-6">
                  <?php
                                  echo $this->Form->control('chauffeur');

                  ?>
                </div>
                

                <div class="col-md-6">
                  <?php
                                  echo $this->Form->control('convoyeur');

                  ?>
                </div>
                <div class="col-md-6">
                  <?php
                                  echo $this->Form->control('valide');

                  ?>
                </div>
                <div class="col-md-6">
                  <?php
                                  echo $this->Form->control('remise');

                  ?>
                </div>
                <div class="col-md-6">
                  <?php
                                  echo $this->Form->control('tva');

                  ?>
                </div>
                <div class="col-md-6">
                  <?php
                                  echo $this->Form->control('fodec');

                  ?>
                </div>
                <div class="col-md-6">
                  <?php
                                  echo $this->Form->control('ttc');

                  ?>
                </div>
                <div class="col-md-6">
                  <?php
                                  echo $this->Form->control('ht');

                  ?>
                </div>
              </div>
             
            </div>
            <!-- /.box-body -->
            <section class="content-header">
                        <h1 class="box-title"><?php echo __('Ligne Facture'); ?></h1>  
                    </section>  
                    <section class="content" style="width: 99%">
                        <div class="row">
                            <div class="box">
          <input type="hidden" name="nbr_ligne" value="<?= h(1)?>" id="nbrligne">

                                <div class="box-header with-border" >
                                    <a class="btn btn-primary  "   table='addtable' onclick="ajouter_ligne_livraison()" index='index' id='' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                                        <i class="fa fa-plus-circle " ></i> Ajouter ligne</a> 

                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive ls-table">
                                        <table class="table table-bordered table-striped table-bottomless">
                                        <thead>
              <tr>
              <th scope="col">Article</th>
                  <th scope="col">Code Fournisseur</th>
                  
                  <th scope="col">Quantité</th>
                  <th scope="col">Prix HT</th>
                  <th scope="col">Remise</th>
                  <th scope="col">PrixUNHT</th>
                  <th scope="col">Fcodec</th>
                  <th scope="col">TVA</th>
                  <th scope="col">TTC</th>
                  <th scope="col" class="actions text-center"><?= __('Actions') ?></th>                  
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table><br>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </section>
                    <div align="center" id="factureSubmit">

          <?php echo $this->Form->submit(__('Submit')); ?>
           </div>
          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
      </div>
  </div>
  <!-- /.row -->
</section>
<script src="/js/functions.js"></script>
