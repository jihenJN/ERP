<!-- Content Header (Page header) -->
<div class="pull-left" style="margin-left:25px;margin-top: 20px">
  <?php echo $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class'=>'btn btn-success btn-sm']) ?>
    </div>
<br> <br><br>
<section class="content-header">
  <h1 >
    Recherche
  </h1>
</section>

<section class="content" style="width: 99%" >
<div class="box">
  <div class="box-header">
  </div>
 
  <div class="box-body" >
      <div class="row">

            <?php echo $this->Form->create();?>
              <div class="col-xs-6" >
             <?php
             
                            echo $this->Form->input('datedebut',array('label'=>'Date debut','value' => $this->request->getQuery('datedebut'),'id'=>'datedebut','div'=>'form-group','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control','type'=>'date') );
            ?>
             </div>
           <div class="col-xs-6" >
              <?php 
 echo $this->Form->input('cartecarburant_id',array('empty' => 'Veuillez choisir !!','label'=>'Carte carburant','options'=>  $cartecarburants,'value' => $this->request->getQuery('	cartecarburant_id'),'div'=>'form-group','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control') );
                  ?>
              
                  </div>
           <div class="col-xs-6">     
            <?php
echo $this->Form->control('',['label' => 'Année', 'options' =>  ['2015','2016','2017','2018','2019','2020','2021'] , 'value' => $this->request->getQuery('annee'),'empty' => 'Veuillez choisir !!', 'autocomplete' => 'on']); ?>
             </div>
          
              <div class="col-xs-6" >
              <?php
       echo $this->Form->input('datefin',array( 'label'=>'Date fin','value' => $this->request->getQuery('datefin'),'id'=>'datefin','div'=>'form-group','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control ','type'=>'date') );
               ?>
                  </div>
            <div class="col-xs-6" >
              <?php 
 echo $this->Form->input('numero',array('value' => $this->request->getQuery('numero'),'div'=>'form-group','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control') );
                  ?>
            </div>
          <div class="col-xs-6">     
            <?php
echo $this->Form->control('',['label' => 'Fournisseur ', 'options'=>$fournisseurs,'value' => $this->request->getQuery('fournisseur'), 'empty' => 'Veuillez choisir !!']); ?>
             </div>
          
         
          
          <div class="col-xs-6" >
              <?php 
 echo $this->Form->input('numero de commande',array('label'=>'Numero de commande','div'=>'form-group','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control') );
                  ?>
                  </div>
          
          
          
          <div class="col-xs-6" >
              <?php 
                  echo $this->Form->input('materieltransport_id',array('value' => $this->request->getQuery('materieltransport_id'),'label'=>'Materiel de transport','empty' => 'Veuillez choisir !!','options'=>$materieltransports,'div'=>'form-group','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control') );
                  ?>
                  </div>
          
          
          
          
          
           <div class="col-xs-6" >
              <?php 
 echo $this->Form->input('pointdevente_id',array('options'=> $pointdeventes,'empty' => 'Veuillez choisir !!','label'=>'Point de vente','value' => $this->request->getQuery('pointdevente_id'),'div'=>'form-group','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control') );
                  ?>
                  </div>
          
          
              <div class="col-xs-6" >
              <?php 
 echo $this->Form->input('chaffeur_id',array('label'=>'Chauffeur','options'=>$chauffeurs,'empty' => 'Veuillez choisir !!','value' => $this->request->getQuery('	chaffeur_id'),'div'=>'form-group','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control') );
                  ?>
                  </div>
          
          
           <div class="col-xs-6" >
              <?php 
    echo $this->Form->input('depot_id',array('label'=>'Depot','empty' => 'Veuillez choisir !!','options'=>$depots ,'value' => $this->request->getQuery('depot_id'),'div'=>'form-group','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control') );
                  ?>
                  </div>
          
             <div class="col-xs-6" >
              <?php 
echo $this->Form->input('convayeur_id',array('label'=>'Confaieurs','options'=>$confaieurs,'empty' => 'Veuillez choisir !!','value' => $this->request->getQuery('convayeur_id'),'div'=>'form-group','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control') );
                  ?>
                  </div>
          
         
          
          <div class="pull-right" style="margin-right:32%;margin-top: 20px;">
        <button type="submit" class="btn btn-primary ">Afficher</button>
        <a href="<?php echo $this->Url->build(['action' => 'index']); ?>" class="btn btn-primary"> Afficher tous</a>
              <button class="btn btn-primary">Imprimer recherche</button>
        </div>
          
          
          
          
          
         
<!--      <div class="col-lg-9 col-lg-offset-3" align="center">
                     <?php/* echo $this->Form->submit(__('afficher'),['class'=>"btn btn-primary"]); */ ?>
           <a href="<?php /*echo $this->Url->build(['action' => 'index']); */?>" class="btn btn-primary"> afficher tous</a>
    
           
         
      </div>-->
           <?php echo $this->Form->end(); ?>
</div>
</div>
</section>















<section class="content" style="width: 99%" >
<div class="box">
  <div class="box-header">
  </div>
  <!-- /.box-header -->
  <div class="box-body" >
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
              <tr>
                  <th scope="col"><?= h('Livraison') ?></th>
                  <th scope="col"><?= h('Numero') ?></th>
                  <th scope="col"><?= h('Date') ?></th>
                  <th scope="col"><?= h('fournisseur') ?></th>
                  <th scope="col"><?=  h('point de vente') ?></th>
                  <th scope="col"><?= h('Depot') ?></th>
              
                  <th scope="col"><?= h('Remise') ?></th>
                  <th scope="col"><?= h('Tva') ?></th>
                  <th scope="col"><?= h('Fodec') ?></th>
                  <th scope="col"><?= h('Ttc') ?></th>
                  <th scope="col"><?= h('Ht') ?></th>
                 
                  <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($factures as $facture): ?>
                <tr>
                  <td><?= h($facture->livraison_id) ?></td>
                  <td><?= h($facture->numero) ?></td>
                  <td><?= h($facture->date) ?></td>
                  <td><?= h($facture->fournisseur->name) ?></td>
                  <td><?= h($facture->pointdevente->name) ?></td>
                  <td><?= h($facture->depot->name) ?></td>
                 
                  <td><?= $this->Number->format($facture->remise) ?></td>
                  <td><?= $this->Number->format($facture->tva) ?></td>
                  <td><?= $this->Number->format($facture->fodec) ?></td>
                  <td><?= $this->Number->format($facture->ttc) ?></td>
                  <td><?= $this->Number->format($facture->ht) ?></td>
                 
                    <td class="actions text-right">
                    
                                           <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $facture->id),array('escape' => false)); ?>
                      <?php echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit',$facture->id),array('escape' => false)); ?>
			<?php echo $this->Form->postLink("<button class='btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete',  $facture->id),array('escape' => false,null), __('Veuillez vraiment supprimer cette enregistrement # {0}?',  $facture->id)); ?>
                                          
                                          
                                          
                                          
                                      
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

<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
  $(function() {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging': true,
      'lengthChange': false,
      'searching': false,
      'ordering': true,
      'info': true,
      'autoWidth': false
    })
  })
</script>
<?php $this->end(); ?>

<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
  $(function() {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging': true,
      'lengthChange': false,
      'searching': false,
      'ordering': true,
      'info': true,
      'autoWidth': false
    })
  })
</script>
<?php $this->end(); ?>