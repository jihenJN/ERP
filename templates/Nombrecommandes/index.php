<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('salma'); ?><?php
$add = "";
$edit = "";
$delete = "";
$view = "";
$session = $this->request->getSession();
$abrv = $session->read('abrvv');
$lien = $session->read('lien_clients' . $abrv);
//debug($lien);die;
foreach ($lien as $k => $liens) {
  if (@$liens['lien'] == 'nombrecommandes') {
    $add = $liens['ajout'];
    $edit = $liens['modif'];
    $delete = $liens['supp'];
  }
  // debug($liens);die;
}

if ($add == 1) { ?>
  
<div class="pull-left" style="margin-left:25px;margin-top: 20px">
    <?php //echo $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
</div>
<br> <br><br>
<?php  } ?>

<section class="content-header">
    <h1>
        BC Bonifier
    </h1>
</section>
<section class="content">
  <div class="box">
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th scope="col" class="actions text-center"><?= h('Nombre Commande') ?></th>
            <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($nombrecommandes as $nombrecommande): ?>
            <tr>
              <td hidden><?= h($nombrecommande->id) ?></td>
              <td  align="center"><?= h($nombrecommande->nombrecommande) ?></td>
              <td class="actions text" align="center">
                <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $nombrecommande->id), array('escape' => false)); ?>
                <?php if ($edit == 1)  {
                  echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $nombrecommande->id), array('escape' => false));
                } ?>
                <?php if ($delete == 1) {
                //  echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $nombrecommande->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $nombrecommande->id));
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

