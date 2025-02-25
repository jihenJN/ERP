<?php echo $this->Html->script('hechem'); ?>
<?php echo $this->Html->css('select2'); ?>
<section class="content-header">
  <header>
    <h1 style="text-align:center;"> Bon sortie stock</h1>
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
//debug($lien);die;
foreach ($lien as $k => $liens) {
  if (@$liens['lien'] == 'bonsortiestocks') {
    $add = $liens['ajout'];
    $edit = $liens['modif'];
    $delete = $liens['supp'];
  }
  //debug($liens);die;
}

if ($add == 1) {
?>
  <div class="pull-left" style="margin-left:25px;margin-top: 20px">
    <?php echo $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
  </div>
<?php } ?>
<br> <br><br>

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
        <?php echo $this->Form->create($bonsortiestocks, ['type' => 'get']); ?>
        <div class="col-xs-6">
          <?php
          echo $this->Form->control('datedebut', ['label' => 'Date de debut', "class" => "form-control", 'type' => 'date', 'value' => $this->request->getQuery('datedebut'), 'autocomplete' => 'off']); ?>
        </div>
        <div class="col-xs-6">
          <?php
          echo $this->Form->control('datefin', ['label' => 'Date de fin', "class" => "form-control", 'type' => 'date', 'value' => $this->request->getQuery('datefin'), 'autocomplete' => 'off']); ?>
        </div>
        <div class="col-xs-6">
          <?php
          echo $this->Form->control('pointdevente_id', ['label' => 'Site', 'value' => $this->request->getQuery('pointdevente_id'), 'empty' => 'Veuillez choisir !!', 'option' => $pointdeventes, 'class' => 'form-control select2']); ?>
        </div>

        <div class="col-xs-6">
          <?php
                                      echo $this->Form->control('depot_id', ['label' => 'Dépot',  'empty' => 'Veuillez choisir !!', 'id' => 'depot_id', 'class' => 'form-control select2', 'options' => $depots, 'value' => $this->request->getQuery('depot_id')]); ?>
                                    
        </div>

      </div>
    
      <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
        <button type="submit" class="btn btn-primary btn-sm">Afficher</button>
        <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
      </div>
      <?php echo $this->Form->end(); ?>
    </div>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">

          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm" style="width: 150px;">

              </div>
            </form>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table id="example1" class="table table-hover">
            <thead>
              <tr>
                <th scope="col"><?= h('Numéro') ?></th>
                <th scope="col"><?= h('Date') ?></th>
                <th scope="col"><?= h('Site') ?></th>
                <th scope="col"><?= h('Depot') ?></th>
                <th scope="col"><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($bonsortiestocks as $bonsortiestock) : ?>
                <tr>
                <td hidden><?= h($bonsortiestock->id) ?> </td>
                  <td><?= h($bonsortiestock->numero) ?></td>
                  <td>
                    <?= $this->Time->format(
                      $bonsortiestock->date,
                      'dd/MM/y'
                    ); ?></td>
                  <td><?= h($bonsortiestock->pointdevente->name) ?></td>
                  <td><?= h($bonsortiestock->depot->name) ?></td>


                  <td>
                    <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $bonsortiestock->id), array('escape' => false)); ?>
                    <?php if ($edit == 1) {
                      echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $bonsortiestock->id), array('escape' => false));
                    } ?>
                    <?php if ($delete == 1) {
                      echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete',  $bonsortiestock->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?',  $bonsortiestock->id));
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





<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
  function openWindow(h, w, url) {
    leftOffset = (screen.width / 2) - w / 2;
    topOffset = (screen.height / 2) - h / 2;
    window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
  }











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
  $('.select2').select2()

  //Datemask dd/mm/yyyy
  $('#datemask').inputmask('dd/mm/yyyy', {
    'placeholder': 'dd/mm/yyyy'
  })
  //Datemask2 mm/dd/yyyy
  $('#datemask2').inputmask('mm/dd/yyyy', {
    'placeholder': 'mm/dd/yyyy'
  })
  //Money Euro
  $('[data-mask]').inputmask()

  //Date range picker
  $('#reservation').daterangepicker()
  //Date range picker with time picker
  $('#reservationtime').daterangepicker({
    timePicker: true,
    timePickerIncrement: 30,
    format: 'MM/DD/YYYY h:mm A'
  })
</script>
<?php $this->end(); ?>