
<?php echo $this->Html->script('salma'); ?>
<?php
$add = "";
$edit = "";
$delete = "";
$view = "";
$session = $this->request->getSession();
$abrv = $session->read('abrvv');
$lien = $session->read('lien_parametrage' . $abrv);
foreach ($lien as $k => $liens) {
  if (@$liens['lien'] == 'cartecarburants') {
    $add = $liens['ajout'];
    $edit = $liens['modif'];
    $delete = $liens['supp'];
  }
  //debug($liens);die;
}

if ($add == 1) { ?>
  <div class="pull-left" style="margin-left:25px;margin-top: 20px">
    <?php echo $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
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
        <?php echo $this->Form->create($cartecarburants, ['type' => 'get']); ?> 
        <div class="col-xs-6">
          <?php
          echo $this->Form->control('num', ['label' => 'Numéro', 'value' => $this->request->getQuery('num'), 'required' => 'off']); ?>
        </div>
        <div class="col-xs-6">
          <?php
          echo $this->Form->control('typekiosque', ['label' => 'Type Kiosque', 'value' => $this->request->getQuery('typekiosque'), 'empty' => 'Veuillez choisir !!', 'required' => 'off']); ?>
        </div>
        <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
        <button type="submit" class="btn btn-primary btn-sm">Afficher</button>
        <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
        </div>
        <?php echo $this->Form->end(); ?>
      </div>
    </div>
  </div>
</section>
<h1>
Carte Carburants
</h1>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="25%" align="center"><?= ('Numéro') ?></th>
                <th width="25%" align="center"><?= ('Type Kiosque') ?></th>
                <th width="25%" align="center"><?= ('Mot De Passe') ?></th>
                <th width="25%" scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($cartecarburants as $cartecarburant): ?>
                <tr>
                  <td><?= h($cartecarburant->num) ?></td>
                  <td><?= h($cartecarburant->typekiosque) ?></td>
                  <td><?= h($cartecarburant->motdepasse) ?></td>
                  <td class="actions text" align="center">
                    <?php
                     echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $cartecarburant->id), array('escape' => false)); ?>
                    <?php if ( $edit == 1) {
                     echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $cartecarburant->id), array('escape' => false)); }?> 
                    <?php if ( $delete == 1) {
                     echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $cartecarburant->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $cartecarburant->id)); }?>
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
