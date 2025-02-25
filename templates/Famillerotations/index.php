<!-- Content Header (Page header) -->
<?php
$add = "";
$edit = "";
$delete = "";
$view = "";
$session = $this->request->getSession();
$abrv = $session->read('abrvv');
$lien = $session->read('lien_articles' . $abrv);
//debug($lien);die;
foreach ($lien as $k => $liens) {
  if (@$liens['lien'] == 'famillerotation') {
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
        <?php echo $this->Form->create($famillerotations, ['type' => 'get']); ?>
        <div class="col-xs-6">
          <?php
          echo $this->Form->control('code', ['label' => 'Code', 'value' => $this->request->getQuery('code'),   'class' => 'form-control  ', 'required' => 'off']); ?>
        </div>
        <div class="col-xs-6">
          <?php
          echo $this->Form->control('name', ['label' => 'Nom', 'value' => $this->request->getQuery('name'), 'class' => 'form-control  ', 'required' => 'off']); ?>
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
  Familles rotations
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
                <th width="20%" align="center"> Code</th>
                <th width="20%" align="center">Nom </th>
                <th width="20%" align="center"> Taux de minoration</th>
                <th width="20%" align="center">Taux de majoration </th>

                <th width="30%" scope="col" class="actions text-center"> Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($famillerotations as $i => $famillerotation) : ?>
                <tr>
                <td hidden><?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id' . $i, 'value' => $famillerotation->id, 'label' => '', 'champ' => 'id', 'class' => 'form-control verifiercmd']); ?></td>

                  <td hidden><?= h($famillerotation->id) ?></td>

                  <td>
                    <?= h($famillerotation->code) ?>
                  </td>
                  <td><?= h($famillerotation->name) ?></td>
                  <td align="center"><?= $this->Number->format($famillerotation->txmin) ?> %</td>
                  <td align="center"><?= $this->Number->format($famillerotation->txmax) ?> % </td>

                  <td class="actions text" align="center">
                    <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $famillerotation->id), array('escape' => false)); ?>
                    <?php if ($edit == 1) {
                      echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $famillerotation->id), array('escape' => false));
                    } ?>
                    <?php //if ($delete == 1) {
                    //  echo $this->Form->postLink("<button class='btn btn-xs btn-danger verif'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $famillerotation->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $famillerotation->id));
                    // } 


                    ?>
                    <button type='button' index='<?php echo $i; ?>' class='verifiercmd btn btn-xs btn-danger deletecon'><i class='fa fa-trash-o'></i></button>
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
    $('.verifiercmd').on('click', function() {
      // alert('hello');
      ind = $(this).attr('index');
      // alert(ind);
      id = $('#id' + ind).val();
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'verif0509']) ?>",
        dataType: "json",
        data: {
          id: id,
        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data, status, settings) {
          //alert(data.Articles);
          if (data.Articles != 0) {
            alert('existe dans un document');
          } else {
            if (confirm('Voulez-vous supprimer cet enregistrement')) {
              alert('ok supp');
              document.location = "https://sirepprefaprod.isofterp.com/ERP/Articles/delete/" + id;
            }
          }
        }
      })
    });
  });

  $(function() {
    $('.deleteConfirm').on('click', function() {

      return confirm('Voulez vous supprimer cette enregistrement ? ');

    });


  });
</script>

<?php $this->end(); ?>