<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('salma'); ?>
<?php
$add = "";
$edit = "";
$delete = "";
$view = "";
$session = $this->request->getSession();
$abrv = $session->read('abrvv');
$lien = $session->read('lien_parametrage' . $abrv);
//debug($lien);die;
foreach ($lien as $k => $liens) {
  if (@$liens['lien'] == 'personnels') {
    $add = $liens['ajout'];
    $edit = $liens['modif'];
    $delete = $liens['supp'];
  }
  //debug($liens);die;
}

if ($add == 1) { ?>
  <div class="pull-left" style="margin-left:25px;margin-top: 20px">
    <?php echo $this->Html->link(__('Ajouter'), ['action' => 'Add'], ['class' => 'btn btn-success btn-sm']) ?>
  </div>
<?php  } ?>
<br><br><br>
<section class="content-header">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
  <h1>
    Recherche
  </h1>
</section>
<section class="content" style="width: 99%" style="background-color: white ;">
  <div class="box">
    <div class="box-body">
      <div class="row">
        <?php echo $this->Form->create($personnel, ['type' => 'get']); ?>
        <div class="col-xs-6">
          <?php
          echo $this->Form->control('fonction_id', ['label' => 'Fonction', 'value' => $this->request->getQuery('fonction_id'),  'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 ']); ?>

        </div>
        <div class="col-xs-6">
          <?php
          echo $this->Form->control('pointdevente_id', ['label' => 'Site', 'value' => $this->request->getQuery('pointdevente_id'), 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 ']); ?>

        </div>
        <div class="col-xs-6">
          <?php
          echo $this->Form->control('nom', ['label' => 'nom', 'value' => $this->request->getQuery('nom')]); ?>

        </div>
      </div>
      <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
        <button type="submit" class="btn btn-primary btn-sm">Afficher</button>
        <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
      </div>
      <?php echo $this->Form->end(); ?>
    </div>
  </div>
</section>
<h1>
  Personnels


</h1>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="6%" align="center"><?= __('Fonction') ?></th>
                <th width="6%" align="center"><?= __('Nom') ?></th>
                <th width="6%" align="center"><?= __('Prenom') ?></th>
                <th width="5%" align="center"><?= __('Code') ?></th>
                <th width="8%" align="center"><?= __('Sexe') ?></th>
                <th width="8%" align="center"><?= __('Date Entre') ?></th>
                <th width="8%" align="center"><?= __('Situation Familiale') ?></th>
                <th width="3%" align="center"><?= __('Nombre Enfant') ?></th>
                <th width="8%" align="center"><?= __('Matricule Cnss') ?></th>
                <th width="4%" align="center"><?= __('Age') ?></th>
                <th width="8%" align="center"><?= __('Chef De Famille') ?></th>
                <th width="8%" align="center"><?= __('Type Contrat') ?></th>
                <!-- <th width="8%" align="center"><?= __('Point De Vente') ?></th> -->
                <th width="8%" align="center"><?= __('Action') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($personnel as $i=>$personnel) : ?>
                <tr>
                     <td hidden >


                                                    <?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id' . $i, 'value' => $personnel->id, 'label' => '', 'champ' => 'id', 'class' => 'form-control']); ?>

                                                </td>
              
                  <td><?= h($personnel->fonction->name) ?></td>
                  <td><?= h($personnel->nom) ?></td>
                  <td><?= h($personnel->prenom) ?></td>
                  <td><?= h($personnel->code) ?></td>
                  <td><?= h($personnel->sex->name) ?></td>
                  <td><?= h($personnel->dateentre) ?></td>
                  <td><?= h($personnel->situationfamiliale->name) ?></td>
                  <td><?= $this->Number->format($personnel->nombreenfant) ?></td>
                  <td><?= h($personnel->matriculecnss) ?></td>
                  <td><?= $this->Number->format($personnel->age) ?></td>
                  <td><?= h($personnel->chefdefamille) ?></td>
                  <td><?= h($personnel->typecontrat->name) ?></td>
                    <!-- <td><?= h($personnel->pointdevente->name) ?></td> -->
                  <td class="actions text" align="center">
                    <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $personnel->id), array('escape' => false)); ?>
                    <?php if ($edit == 1) {
                      echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $personnel->id), array('escape' => false));
                    } ?>
                    <?php if ($delete == 1) {
                      echo $this->Html->link("<button  class='btn btn-xs btn-danger deletecon'><i class='fa fa-trash'></i></button>", array('action' => 'delete', $personnel->id), array('escape' => false));?>

                 <?php   } ?>
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
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>

<!-- DataTables -->
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
  $(function() {
    $('.select2').select2()
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
 <script>

$(".deletecon").on("click", function () {
    return confirm("voulez vous supprimer cet enregistrement !!");
  });
        
            </script>
<?php $this->end(); ?>