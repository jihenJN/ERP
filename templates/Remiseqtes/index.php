<?php echo $this->fetch('script'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('salma'); ?>
<?php
$add = "";
$edit = "";
$delete = "";
$view = "";
$session = $this->request->getSession();
$abrv = $session->read('abrvv');

$lien = $session->read('lien_clients' . $abrv);

foreach ($lien as $k => $liens) {
  if (@$liens['lien'] == 'remiseqtes') {
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
<br> <br><br>
<?php  } ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<!-- <section class="content-header">
  <h1>
    Recherche
  </h1>
</section>
<section class="content" style="width: 99%" style="background-color: white ;">
  <div class="box">
    <div class="box-body">
      <div class="row">
        <?php echo $this->Form->create($remiseqtes, ['type' => 'get']); ?>
        <div class="col-xs-6">
          <?php
          echo $this->Form->control('article_id', ['label' => 'Article', 'value' => $this->request->getQuery('article_id'), 'required' => 'off', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 control-label']); ?>
        </div>
        <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
          <button type="submit" class="btn btn-primary btn-sm">Afficher</button>
          <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
        </div>
        <?php echo $this->Form->end(); ?>
      </div>
    </div>
</section> -->

<section class="content-header">
    <h1>
        Remise comptant
    </h1>
</section>
<section class="content">
  <!-- /.box-header -->
  <div class="box">
    <div class="box-body" style="background-color: white ;">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <!-- <th width="20%" align="center"><?= ('Qte MIN') ?></th>
            <th width="20%" align="center"><?= ('Qte MAX') ?></th>
            <th width="20%" align="center"><?= ('Pourcentage %') ?></th> -->
            <th width="20%" align="center" class="actions text-center"><?= ('Code Remise') ?></th>
            <th width="20%" align="center" class="actions text-center"><?= __('Action') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($remiseqtes as $remiseqte) : ?>
            <tr>
              <td hidden><?= h($remiseqte->id) ?></td>
              <td align="center"><?= h($remiseqte->code) ?></td>
              <!-- <td align="center"><?= h($remiseqte->qtemin) ?></td>
              <td align="center"><?= h($remiseqte->qtemax) ?></td>
              <td align="center"><?= h($remiseqte->pourcentage) ?></td> -->
              <td class="actions text" align="center">
                <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $remiseqte->id), array('escape' => false)); ?>
                <!-- <?php if ($edit == 1) {
                  echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $remiseqte->id), array('escape' => false));
                } ?> -->
                <!-- <?php if ($delete == 1) {
                  echo $this->Form->postLink("<button class='btn btn-xs btn-danger'><i class='fa fa-trash-o deleteConfirm'></i></button>", array('action' => 'delete', $remiseqte->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $remiseqte->id));
                } ?> -->
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
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

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
  });
  $('.select2').select2()
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