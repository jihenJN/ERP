<!-- Content Header (Page header) -->
<?php
$add = "";
$edit = "";
$delete = "";
$view = "";
$session = $this->request->getSession();
$abrv = $session->read('abrvv');
$lien = $session->read('lien_commercialmenus' . $abrv);
//debug($lien);die;
foreach ($lien as $k => $liens) {
  if (@$liens['lien'] == 'categories') {
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
<!-- <section class="content-header">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
  <h1>
    Recherche
  </h1>
</section>
<section class="content" style="width: 99%" style="background-color: white ;">
  <div class="box">
    <div class="box-body">
      <div class="row">
        <?php echo $this->Form->create($users, ['type' => 'get']); ?>
        <div class="col-xs-6">
          <?php
          echo $this->Form->control('utilisateur_id', ['label' => 'Utilisateur', 'value' => $this->request->getQuery('utilisateur_id'),  'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 ']); ?>
        </div>
        <div class="col-xs-6">
          <?php
          echo $this->Form->control('personnel_id', ['label' => 'Personnel', 'value' => $this->request->getQuery('personnel_id'),  'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 ']); ?>
        </div>
        <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
          <button type="submit" class="btn btn-primary btn-sm">Afficher</button>
          <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
        </div>
        <?php echo $this->Form->end(); ?>
      </div>
    </div>
  </div>
</section> -->
<h1>
  Categories
  <small><?php echo __(''); ?></small>
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
                <th width="25%"   class="actions text-center" align="center"><?= ('Nom') ?></th>
                <th width="25%"  class="actions text-center" align="center"><?= ('Valeur') ?></th>
                <th width="25%" scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($categories as $categorie) : ?>
                <tr>
                  <td hidden><?= h($categorie->id) ?></td>
                  <td  class="actions text-center"><?= h($categorie->name) ?></td>
                  <td  class="actions text-center"><?= h($categorie->valeur) ?></td>
                  <td class="actions text" align="center">
                    <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $categorie->id), array('escape' => false)); ?>
                    <?php if ($edit == 1) {
                      echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $categorie->id), array('escape' => false));
                    } ?>
                    <?php if ($delete == 1) {
                  
                      echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm '   ><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $categorie->id) ,array('escape' => false));
                    } ?></td>
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
<?php echo $this->Html->script('alert'); ?>
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
<script language="JavaScript" type="text/javascript">

$(function() {
  $('.deleteConfirm').on('click', function () {

    return confirm('Voulez vous supprimer cette enregistrement? ');

  });


});

</script>
<script>
  $('.select2').select2()
</script>
<?php $this->end(); ?>