<?php echo $this->fetch('script'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('salma'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('controle_frs'); ?>
<?php echo $this->Html->script('hela'); ?>
<?php
$add = "";
$edit = "";
$delete = "";
$view = "";
$session = $this->request->getSession();
$abrv = $session->read('abrvv');
$lien = $session->read('lien_parametrage' . $abrv);
// debug($lien);
foreach ($lien as $k => $liens) {
  if (@$liens['lien'] == 'coefficientclients') {
    $add = $liens['ajout'];
    $edit = $liens['modif'];
    $delete = $liens['supp'];
    // debug($liens);die;
  }
}
if ($add == 1) { ?>
  <div class="pull-left" style="margin-left:25px;margin-top: 20px">
    <?php //echo $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
  </div>
<?php  } ?>
<br> <br><br>
<section class="content-header">
  <h1>
    Coefficient Client
  </h1>
</section>
<section class="content" style="width: 99%">
  <div class="box">
    <div class="box-header">
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th width="35%" align="center"><?= h('Valeur') ?></th>
            <th width="30%" align="center"><?= h('Action') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($coefficientclients as $coefficientclient) : ?>
            <tr>
              <td hidden><?= h($coefficientclient->id) ?></td>
              <td><?= h($coefficientclient->name) ?></td>
              <td class="actions text" align="center">
                <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $coefficientclient->id), array('escape' => false)); ?>
                <?php if ($edit == 1) {
                  echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $coefficientclient->id), array('escape' => false));
                } ?>
                <?php /*if ($delete == 1) {
                  echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm '><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $coefficientclient->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $coefficientclient->id));
                } */?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
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
<script>
  function flvFPW1() {
    var v1 = arguments,
      v2 = v1[2].split(","),
      v3 = (v1.length > 3) ? v1[3] : false,
      v4 = (v1.length > 4) ? parseInt(v1[4]) : 0,
      v5 = (v1.length > 5) ? parseInt(v1[5]) : 0,
      v6, v7 = 0,
      v8, v9, v10, v11, v12, v13, v14, v15, v16;
    v11 = new Array("width,left," + v4, "height,top," + v5);
    for (i = 0; i < v11.length; i++) {
      v12 = v11[i].split(",");
      l_iTarget = parseInt(v12[2]);
      if (l_iTarget > 1 || v1[2].indexOf("%") > -1) {
        v13 = eval("screen." + v12[0]);
        for (v6 = 0; v6 < v2.length; v6++) {
          v10 = v2[v6].split("=");
          if (v10[0] == v12[0]) {
            v14 = parseInt(v10[1]);
            if (v10[1].indexOf("%") > -1) {
              v14 = (v14 / 100) * v13;
              v2[v6] = v12[0] + "=" + v14;
            }
          }
          if (v10[0] == v12[1]) {
            v16 = parseInt(v10[1]);
            v15 = v6;
          }
        }
        if (l_iTarget == 2) {
          v7 = (v13 - v14) / 2;
          v15 = v2.length;
        } else if (l_iTarget == 3) {
          v7 = v13 - v14 - v16;
        }
        v2[v15] = v12[1] + "=" + v7;
      }
    }
    v8 = v2.join(",");
    v9 = window.open(v1[0], v1[1], v8);
    if (v3) {
      v9.focus();
    }
    document.MM_returnValue = false;
    return v9;
  }
</script>