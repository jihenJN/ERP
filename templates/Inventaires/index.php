<!-- Content Header (Page header) -->
<?php echo $this->Html->script('mahdi'); ?>
<?php echo $this->Html->css('select2'); ?>

<?php echo $this->fetch('script'); ?>
<section class="content-header">
  <header>
    <?php if ($type == 1) { ?>
    <h1 style="text-align:center;">Inventaire Controle</h1>
    <?php } ?>
    <?php if ($type == 2) { ?>
    <h1 style="text-align:center;">Inventaire annuel</h1>
    <?php } ?>
  </header>
</section>

<?php
$add = "";
$edit = "";
$delete = "";
$view = "";
$session = $this->request->getSession();
$abrv = $session->read('abrvv');
$lien = $session->read('lien_stock' . $abrv);
// debug($lien);die;
foreach ($lien as $k => $liens) {
  if (@$liens['lien'] == 'inventaire') {

    $add = $liens['ajout'];
    $edit = $liens['modif'];
    $delete = $liens['supp'];
  }
  // debug($liens);die;
}

if ($add != 0) {
?>
  <div class="pull-left" style="margin-left:25px;margin-top: 20px">
    <?php echo $this->Html->link(__('Ajouter'), ['action' => 'add/' . $type], ['class' => 'btn btn-success btn-sm']) ?>
  </div>
<?php } ?>

<br> <br><br>


<section class="content-header">
  <h1>
    Recherche
  </h1>
</section>
<section class="content" style="width: 99%">
  <div class="box">
    <div class="box-header">
    </div>

    <div class="box-body">
      <div class="row">

        <?php echo $this->Form->create($inventaires, ['type' => 'get']); ?>

        <div class="col-xs-6">
        <label>Date Début</label>

          <?php

          echo $this->Form->input('datedebut', array('label' => 'Date debut', 'value' => $this->request->getQuery('datedebut'), 'id' => 'datedebut', 'div' => 'form-group', 'class' => 'form-control', 'type' => 'date'));
          ?>
        </div>

        <div class="col-xs-6">
        <label>Date Fin</label>

          <?php
          echo $this->Form->input('datefin', array('label' => 'Date fin', 'value' => $this->request->getQuery('datefin'), 'id' => 'datefin', 'div' => 'form-group', 'class' => 'form-control ', 'type' => 'date'));
          ?>
        </div>

        <div class="col-xs-6">

          <?php
                        echo $this->Form->control('depot_id', ['label' => 'Dépot','value' => $this->request->getQuery('depot_id'),  'empty' => 'Choisir depot !!', 'id' => 'depot_id', 'class' => 'form-control select2']); ?>

        
        </div>

        <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
          <button type="submit" class="btn btn-primary btn-sm">Afficher</button>
          <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index/',$type], ['class' => 'btn btn-primary btn-sm']) ?>
        </div>



      </div>







      <?php echo $this->Form->end(); ?>
    </div>
  </div>
</section>
<!-- Main content -->
<section class="content-header">
  <h1>
    Inventaires
  </h1>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">


          <!-- /.box-header -->
          <div class="box-body table-responsive ">
            <table id="example1" class="table table-hover">
              <thead>
                <tr>
                  <th scope="col"><?= h('Numéro') ?></th>
                  <th scope="col"><?= h('Dépot') ?></th>
                  <th scope="col"><?= h('Date') ?></th>
                  <th scope="col"><?= h('Etat') ?></th>
                  <th scope="col"><?= h('Valider') ?></th>


                  <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 0;
                foreach ($inventaires as $inventaire) :
                  //debug($emplacements);die;
                ?>
                  <tr>
                    <td><?= h($inventaire->numero) ?></td>
                    <td><?= h($inventaire->depot->name) ?></td>
                    <td><?php $date = $inventaire->date;
                        echo ($date->i18nFormat('dd/MM/yyyy HH:mm:ss'));
                        ?></td>
                    <td>
                      <?php if ($inventaire->valide == 0) {
                        echo 'En attente';
                      } else {
                        echo 'Validé';
                      } ?>

                    </td>
                    <td>
                      <?php if ($inventaire->valide == 0) { ?>
                        <?php echo $this->Html->link("<button index= '" . $i . "' id='valider" . $i . "' class='btn btn-xs btn-info valider'><i class='fa fa-check'></i></button>", array('action' => 'valider', $inventaire->id), array('confirm' => 'Veuillez confirmer', 'escape' => false));
                        ?>
                      <?php } ?>
                    </td>
                    <td align='center' class="actions">
                      <?php  //echo $this->Form->control('id', ['index' => $i, 'id' => 'did' . $i, 'value' => $inventaire->id, 'label' => '', 'champ' => 'id','type'=>'hidden', 'class' => 'form-control']); 
                      ?>
                      <?php echo $this->Html->link("<button index= '" . $i . "' id='view" . $i . "' class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $inventaire->id), array('escape' => false)); ?>
                      <?php if ($inventaire->valide == 0) { ?>
                        <?php if ($edit != 0) {
                          echo $this->Html->link("<button index= '" . $i . "' id='edit" . $i . "' class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $inventaire->id), array('escape' => false));
                        } ?>
                        <?php if ($delete != 0) {
                          echo $this->Form->postLink("<button index= '" . $i . "' id='delete" . $i . "' class='btn btn-xs btn-danger delete1'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $inventaire->id),  array('confirm' => 'Voulez vous vraiment supprimer cet enregistrement', 'escape' => false));
                        } ?>
                      <?php } ?>
                    </td>
                  </tr>
                <?php $i++;
                endforeach; ?>
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
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
  $(function() {
    $('#example2').DataTable()
    $('#example1').DataTable({
      'paging': true,
      'lengthChange': true,
      'searching': true,
      'ordering': false,
      'info': true,
      'autoWidth': false
    })
  })
  $('.select2').select2()
</script>
<?php $this->end(); ?>