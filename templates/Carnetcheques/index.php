<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Carnetcheque[]|\Cake\Collection\CollectionInterface $carnetcheques
 */
?>
<!-- Content Header (Page header) -->

<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->fetch('script'); ?>
<?php echo $this->Html->css('select2'); ?>
<section class="content-header">
  <h1 style="text-align:center;">
    Carnet Chéques

  </h1><br>
  <?php
  $add = "";
  $edit = "";
  $delete = "";
  $view = "";
  $session = $this->request->getSession();
  $abrv = $session->read('abrvv');
  $lien = $session->read('lien_finance' . $abrv);

  foreach ($lien as $k => $liens)
  //debug($liens['lien']);
  {
    if (@$liens['lien'] == 'carnetcheques') {

      $add = $liens['ajout'];
      $edit = $liens['modif'];
      $delete = $liens['supp'];
    }
    //debug($liens);die;
  }

  //if ($add == 1) { ?>

  <div class="pull-left">
    <?php echo $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
  </div>
</section>
<?php  //} ?>
<br>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <?php echo $this->Form->create($carnetcheques, ['type' => 'get']); ?>




          <div class="col-xs-6">
            <?php echo $this->Form->control('compte_id', ['options' => $comptes, 'value' => $this->request->getQuery('compte_id'), 'label' => 'Comptes', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 ', 'id' => 'compte_id', 'required' => 'off']); ?>

          </div>
          <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
            <button type="submit" class="btn btn-primary btn-sm">Afficher</button>
            <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
          </div>
          <?php echo $this->Form->end(); ?>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body" style="background-color: white ;">
        <table id="example1" class="table table-bordered table-striped">


          <thead>
            <tr>

              <th width="10%" align="center">
                <?= __('Numéro') ?>
              </th>
              <!-- <th width="10%" align="center"><?= __('Banque') ?></th> -->
              <th width="10%" align="center">
                <?= __('Compte') ?>
              </th>
              <th width="10%" align="center">
                <?= __('Debut') ?>
              </th>
              <th width="10%" align="center">
                <?= __('Nombre') ?>
              </th>
              <th width="10%" align="center">
                <?= __('Taille') ?>
              </th>




              <th width="10%" align="center">
                <?= __('Actions') ?>
              </th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 0;
            foreach ($carnetcheques as $i => $carnet):
              // debug($carnet->compte_id);
              ?>
              <tr>
                <!-- <td hidden><?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id' . $i, 'value' => $carnet->id, 'label' => '', 'champ' => 'id', 'class' => 'form-control ']); ?></td> -->

                <td>
                  <?= h($carnet->numero) ?>
                </td>
                <!-- <td><?= h($carnet->banque->name) ?></td> -->
                <td>
                  <?= h($carnet->compte->numero) ?>
                </td>
                <td>
                  <?= h($carnet->debut) ?>
                </td>
                <td>
                  <?= h($carnet->nombre) ?>
                </td>
                <td>
                  <?= h($carnet->taille) ?>
                </td>



                <td class="actions text" align="center">
                  <?php echo $this->Html->link("<button index= '" . $i . "' id='view" . $i . "' class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $carnet->id), array('escape' => false)); ?>
                  <?php //if ($edit == 1) {
                    echo $this->Html->link("<button index= '" . $i . "' id='edit" . $i . "' class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $carnet->id), array('escape' => false));
                    //} ?>
                  <?php //if ($delete == 1) {
                    echo $this->Form->postLink("<button index= '" . $i . "' id='delete" . $i . "' class='btn btn-xs btn-danger deleteConfirm'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $carnet->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $carnet->id));
                    //} ?>
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
</section>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>

<!-- DataTables -->
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>

<?php $this->start('scriptBottom'); ?>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging': true,
      'lengthChange': false,
      'searching': false,
      'ordering': true,
      'info': true,
      'autoWidth': false
    })
    $('.select2').select2()
  })
</script>
<script>
  // $(function() {
  //   $('.verifiercmd').on('click', function() {
  //     // alert('hello');
  //     ind = $(this).attr('index');

  //     id = $('#id' + ind).val();
  //     // alert(id);
  //     $.ajax({
  //       method: "GET",
  //       url: "<?= $this->Url->build(['controller' => 'Clients', 'action' => 'verifclient']) ?>",
  //       dataType: "json",
  //       data: {
  //         id: id,
  //       },
  //       headers: {
  //         'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
  //       },
  //       success: function(data, status, settings) {
  //         //  alert(data.Categories);
  //         if (data.Clients != 0) {
  //           alert('existe');
  //         } else {
  //           if (confirm('Voulez-vous supprimer cet enregistrement')) {
  //             alert('ok supp');
  //             document.location = "/Clients/delete/" + id;
  //           }
  //         }
  //       }
  //     })
  //   });
  // });
</script>
<script language="JavaScript" type="text/javascript">
  $(function() {
    $('.deleteConfirm').on('click', function() {

      return confirm('Voulez vous supprimer cette enregistrement? ');

    });


  });
</script>
<?php $this->end(); ?>