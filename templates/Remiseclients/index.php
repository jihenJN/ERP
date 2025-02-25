<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('salma'); ?>
<section class="content-header">
  <header>
    <h1 style="text-align:center;"> Remise Clients</h1>
  </header>
</section>
<?php
$add = "";
$edit = "";
$delete = "";
$view = "";
$session = $this->request->getSession();
$abrv = $session->read('abrvv');
$lien = $session->read('lien_clients' . $abrv);
//debug($lien);die;
foreach ($lien as $k => $liens) {
  if (@$liens['lien'] == 'remiseclients') {
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

</section>
<!--<h1>
  Remise clients
</h1>-->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?php echo __(''); ?></h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>

                <!-- <th class=" text-center"><?= h('Code') ?></th> -->
                <th class=" text-center"><?= h('Type Client') ?></th>
                <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($remiseclients as $remiseclient) : ?>
                <tr>
                  <td hidden><?= h($remiseclient->id) ?></td>
                  <td align="center" hidden><?= h($remiseclient->code) ?></td>
                  <td align="center"><?= h($remiseclient->typeclient->type) ?></td>
                  <td class="actions text" align="center">
                    <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $remiseclient->id), array('escape' => false)); ?>

                    <?php if ($edit == 1) {
                      echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $remiseclient->id), array('escape' => false));
                    }
                    ?>
                    <?php if ($delete == 1) {
                      echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $remiseclient->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $remiseclient->id));
                    }
                    ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>

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