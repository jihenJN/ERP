x<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->script('hela'); ?>
<?php echo $this->Html->css('select2'); ?>
<section class="content-header">
  <header>
    <h1 style="text-align:center;">Bon de chargements</h1>
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
  if (@$liens['lien'] == 'bondechargements') {
    $add = $liens['ajout'];
    $edit = $liens['modif'];
    $delete = $liens['supp'];
  }
  //   debug($liens);die;
}

if ($add == 1) {
?>
  <div class="pull-left" style="margin-left:25px;margin-top: 20px">
    <?php echo $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
  </div>
<?php } ?>
<br> <br><br>




<section class="content-header">
  <h1>
    Recherche
  </h1>
</section>
<section class="content" style="width: 99%">
  <div class="box">
    <div class="box-header">
    </div>

    <div class="box-body">
      <div class="row">

        <?php echo $this->Form->create($bondechargements, ['type' => 'get']); ?>
        <div class="col-xs-6">





          <?php

          echo $this->Form->input(
            'datedebut',
            array(
              'required' => 'off', 'label' => 'Date debut',
              'value' => $this->request->getQuery('datedebut'),
              'id' => 'datedebut', 'div' => 'form-group',
              'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'date'
            )
          );
          ?>
        </div>
        <div class="col-xs-6">
          <?php
          echo $this->Form->input('datefin', array('required' => 'off', 'label' => 'Date fin', 'value' => $this->request->getQuery('datefin'), 'id' => 'datefin', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'date'));
          ?>
        </div>
        <div class="col-xs-6">
          <?php echo $this->Form->control('pointdevente_id', ['required' => 'off', 'label' => 'Site', 'options' => $pointdeventes, 'class' => 'form-control select2 control-label', 'empty' => 'Veuillez choisir !!', 'value' => $this->request->getQuery('pointdevente_id'), 'data-validity-message' => 'cc']); ?>



        </div>


        <div class="col-xs-6">
          <?php
          echo $this->Form->control('depot_id', ['class' => 'form-control select2 control-label', 'required' => 'off', 'label' => 'Depot ', 'options' =>  $depots, 'empty' => 'Veuillez choisir !!', 'value' => $this->request->getQuery('depot_id')]); ?>
        </div>




        <div class="pull-right" style="margin-right:32%;margin-top: 20px;">
          <button type="submit" class="btn btn-primary ">Afficher</button>
          <a href="<?php echo $this->Url->build(['action' => 'index']); ?>" class="btn btn-primary"> Afficher tous</a>
          <!--              <button class="btn btn-primary">Imprimer recherche</button>-->

          <a onclick="openWindow(1000, 1000, 'http://localhost:8765/bondechargements/imprimerrecherche?datedebut=<?php echo @$datedebut; ?>&datefin=<?php echo @$datefin; ?>&pointdevente_id=<?php echo @$pointdevente_id; ?>&depot_id=<?php echo @$depot_id; ?>')" class="btn btn-primary">Imprimer recherche</a>

        </div>








        <?php echo $this->Form->end(); ?>
      </div>
    </div>
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

            <th scope="col">Numero</th>
            <th scope="col">Date</th>
            <th scope="col">Site</th>
            <th scope="col">Dépot</th>
            <!-- <th scope="col">Bon de transfert</th> -->
            <th scope="col">Actions</th>
          </tr>
        </thead>

        <tbody>


          <?php $i = 0;
          foreach ($bondechargements as $bondechargement) : //debug($bondechargement); 
          ?>
            <tr>
            <td hidden ><?= h($bondechargement->id) ?></td>

              <td><?= h($bondechargement->numero) ?></td>
              <td>
                <?= $this->Time->format(
                  $bondechargement->date,
                  'd/MM/y'
                ); ?></td>
              <td><?= h($bondechargement->pointdevente->name) ?></td>
              <td><?= h($bondechargement->depot->name) ?></td>

              <!-- <td align="center">
                <input type="checkbox" id="check<?php echo $i; ?>" value="<?php echo $bondechargement['id'] ?>" name="checkbox[]" ligne="<?php echo $i; ?>" class="blfbre" <?php if ($bondechargement->etatliv == '1') { ?> style="display:none" <?php } ?> />




                <?php //  $this->Number->format($bondechargement->bondetransfert_id) 
                ?>
              </td> -->
              <td class="actions text" style="text-align:center">
                <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $bondechargement->id), array('escape' => false)); ?>
                <!-- <?= $this->Html->link(__(''), ['action' => 'view', $bondechargement->id], ['class' => 'fa fa-search ']) ?> -->
                <?php if ($edit == 1) {
                  echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $bondechargement->id), array('escape' => false));
                } ?>
                <!-- <?= $this->Html->link(__('Edit'), ['action' => 'edit', $bondechargement->id], ['class' => 'btn btn-warning btn-xs']) ?> -->
                <?php if ($delete == 1) {
                  echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete',  $bondechargement->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?',  $bondechargement->id));
                } ?>
                <a onclick="openWindow(1000, 1000, 'https://codifaerp.isofterp.com/demo/Bondechargements/imprimerBon/<?php echo $bondechargement->id; ?>' );" class="btn btn-xs "><button class="btn btn-xs btn-info"> <i class="fa fa-print"></i></button></a>




              </td>
            </tr>
            <?php $i++ ?>
          <?php endforeach; ?>

        </tbody>
      </table>




      <table>
        <input type="hidden" value="<?php echo $i; ?>" id="index" />
        <tr>
          <td align="center">

            <div class="col-md-12  testcheck" style="display:none;">
              <input type="hidden" name="tes" value="0" class="tespv" />
              <input type="hidden" name="tes" value="0" class="tes" />
              <input type="hidden" name="nombre" value="<?php echo @$i; ?>" class="nombre" />
              <a class="btn btn btn-danger btnbl" id="bontransadd"> <i class="fa fa-plus-circle"></i> Créer un bon de transferts </a>
            </div>

          </td>

        </tr>
      </table>
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