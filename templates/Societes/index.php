<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
  <?php echo $this->Html->script('alert'); ?>
<?php
$add = "";
$edit = "";
$delete = "";
$view = "";
$session = $this->request->getSession();
$abrv = $session->read('abrvv');
$lien = $session->read('lien_parametrage' . $abrv);
foreach ($lien as $k => $liens) {
  if (@$liens['lien'] == 'societes') {
    $add = $liens['ajout'];
    $edit = $liens['modif'];
    $delete = $liens['supp'];
  }
  //debug($liens);die;
}

if ($add == 1) { ?>
  <!-- <div class="pull-left" style="margin-left:25px;margin-top: 20px">
    <?php echo $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
  </div> -->
<?php  } ?>
<section class="content-header">
<header>
        <h1 style="text-align:center;" > Société</h1>
    </header>
    </section>
<section class="content-header" hidden>

  <h1>
    Recherche
  </h1>
</section>
<section hidden class="content" style="width: 99%" style="background-color: white ;">
  <div class="box">
    <div class="box-body">
      <div class="row">
        <?php echo $this->Form->create($societes, ['type' => 'get']); ?>
        <div class="col-xs-6">
          <?php
          echo $this->Form->control('nom', ['label' => 'Nom', 'value' => $this->request->getQuery('nom'), 'autocomplete' => 'off']); ?>
        </div>
        <div class="col-xs-6">
          <?php
          echo $this->Form->control('rc', ['label' => 'RC', 'value' => $this->request->getQuery('rc'), 'autocomplete' => 'off']); ?>
        </div>
        <div class="col-xs-6">
          <?php
          echo $this->Form->control('site', ['label' => 'Site', 'value' => $this->request->getQuery('site'), 'autocomplete' => 'off']); ?>
        </div>
        <div class="col-xs-6">
          <?php
          echo $this->Form->control('codetva', ['label' => 'Code TVA', 'value' => $this->request->getQuery('codetva'), 'autocomplete' => 'off']); ?>
        </div>
        <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
          <button type="submit" class="btn btn-primary btn-sm">Afficher</button>
          <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
        </div>
        <?php echo $this->Form->end(); ?>
      </div>
    </div>
</section>
<!-- <h1>
  Societes
</h1> -->
<section class="content">
  <!-- /.box-header -->
  <div class="box">
    <div class="box-body" style="background-color: white ;">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th width="10%" align="center"><?= __('Nom') ?></th>
            <th width="10%" align="center"><?= __('Capital') ?></th>
            <th width="10%" align="center"><?= __('Adresse') ?></th>
            <th width="10%" align="center"><?= __('Tel') ?></th>
            <th width="10%" align="center"><?= __('Mail') ?></th>
            <th width="10%" align="center"><?= __('Site') ?></th>
            <th width="10%" align="center"><?= __('Rc') ?></th>
            <th width="10%" align="center"><?= __('Code TVA') ?></th>
            <th width="10%" align="center"><?= __('Action') ?></th>
          </tr>

        </thead>
        <tbody>
          <?php foreach ($societes as $societe) : ?>
            <tr>
              <td hidden><?= h($societe->id) ?></td>
              <td><?= h($societe->nom) ?></td>
              <td><?= h($societe->capital) ?></td>
              <td><?= h($societe->adresse) ?></td>
              <td><?= h($societe->tel) ?></td>
              <td><?= h($societe->mail) ?></td>
              <td><?= h($societe->site) ?></td>
              <td><?= h($societe->rc) ?></td>
              <td><?= h($societe->codetva) ?></td>
              <td class="actions text" align="center">
                <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $societe->id), array('escape' => false)); ?>
                <?php if ($edit == 1) {
                  echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $societe->id), array('escape' => false));
                } ?>
                <?php if ($delete == 1) {
                 // echo $this->Form->postLink("<button class='btn btn-xs btn-danger deletecon'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $societe->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $societe->id));
                } ?>
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
  <!-- /.col -->
  </div>
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->

<!-- DataTables -->
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