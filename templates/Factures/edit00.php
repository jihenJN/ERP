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
      <small><?php echo __('Edit'); ?></small>
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
                                echo $this->Form->control('livraison_id',['options'=>$livraisons,"onChange"=>'get_ligne_livraisons(this.value)',"empty"=>"Veuillez choisir !!"]);

                  ?>
                </div>
                <div class="col-md-6">
                  <?php
                                  echo $this->Form->control('numero',['value'=>sprintf('%04d',$facture->numero),'readonly'=>true]);

                  ?>
                </div>
                <div class="col-md-6">
                  <?php
                                  echo $this->Form->control('date', ['empty' => 'Veuillez choisir !!',"value"=>date('Y-m-d H:i:s',strtotime('+1 hour',strtotime(date('Y-m-d H:i:s'))))]);

                  ?>
                </div>
                <div class="col-md-6">
                  <?php
                                  echo $this->Form->control('fournisseur_id', ['options' => $fournisseurs, 'empty' => 'Veuillez choisir !!']);

                  ?>
                </div>
                <div class="col-md-6">
                  <?php
                                  echo $this->Form->control('adresselivraisonfournisseur_id', ["label"=>"adresse livraison fournisseur",'options' => $adresselivraisonfournisseurs, 'empty' => 'Veuillez choisir !!']);

                  ?>
                </div>
                <div class="col-md-6">
                  <?php
                                  echo $this->Form->control('pointdevente_id', ["label"=>"point de vente",'options' => $pointdeventes, 'empty' => 'Veuillez choisir !!']);

                  ?>
                </div>
                <div class="col-md-6">
                  <?php
                                  echo $this->Form->control('depot_id', ['options' => $depots, 'empty' => 'Veuillez choisir !!']);

                  ?>
                </div>
            
                <div class="col-md-6">
                  <?php
                                  echo $this->Form->control('cartecarburant_id', ["label"=>"carte carburant",'options' => $cartecarburants, 'empty' => 'Veuillez choisir !!']);

                  ?>
                </div>
                <div class="col-md-6">
                  <?php
                                  echo $this->Form->control('materieltransport_id', ["label"=>"materiel de transport",'options' => $materieltransports, 'empty' => 'Veuillez choisir !!']);

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
          <input type="hidden" name="nbr_ligne" value="<?= h($count)?>" id="nbrligne">

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
            <?php foreach ($lignes as $indice=>$ligne): ?>

                <tr id="ligne1">
                  <td>
                  <select name="articles_ids[]" id="article_id<?= h($indice+1)?>" class="form-control" onchange="get_article(this.value,1)">
            <option value="">Veuillez choisir !!</option>
           <?php foreach ($articles as $article): ?>
            <option value="<?=h($article->id)?>" <?php if($article->id==$ligne->article_id){echo "selected";}?>><?=h($article->Dsignation)?></option>
            <?php endforeach; ?>

           </select>  
                  </td>
                  <td>
                    <input type="text" name="codef[]" id="codef<?= h($indice+1)?>" class="form-control" value="<?= h($ligne->codefrs)?>">
                  </td>
                  <td>
                    <input type="text" name="qte[]" id="qte<?= h($indice+1)?>" class="form-control" onkeyup="calculer_total_livraison()" value="<?= h($ligne->qteliv)?>">
                  </td>
                  <td>
                  <input type="text" name="prixht[]" id="prixht<?= h($indice+1)?>" class="form-control" onkeyup="calculer_total_livraison()" value="<?= h($ligne->prix)?>">
                  </td>
                  <td>
                  <input type="text" name="remise[]" id="remise<?= h($indice+1)?>" class="form-control" onkeyup="calculer_total_livraison()" value="<?= h($ligne->remise)?>">

                  </td>
                  <td>
                  <input type="text" name="prixunht[]" id="prixunht<?= h($indice+1)?>" class="form-control" value="<?= h($ligne->ht)?>">

                  </td>
                  <td>
                  <input type="text" name="fcodec[]" id="fcodec<?= h($indice+1)?>" class="form-control" value="<?= h($ligne->fodec)?>">

                  </td>
                  <td>
                  <input type="text" name="tva[]" id="tva<?= h($indice+1)?>" class="form-control" value="<?=h($ligne->tva)?>">

                  </td>
                  <td>
                  <input type="text" name="ttc[]" id="ttc<?= h($indice+1)?>" class="form-control" value="<?=h($ligne->ttc)?>">

                  </td>
                  <td class="actions text-right">

                  <i onclick="delete_ligne(<?=h($indice+1)?>)" class="fa fa-times supLigne" style="color: #C9302C;font-size: 22px;" index="0" role="button"></i>
                  </td>
                </tr>  
                <?php endforeach; ?>

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
<script>
  $(document).ready(function(){
    <?php foreach ($lignes as $indice=>$ligne): ?>
      get_article(<?=h($ligne->article_id)?>,<?=h($indice+1)?>)
    <?php endforeach; ?>
  })
</script>