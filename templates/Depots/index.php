<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->css('select2'); ?>


<section class="content-header">
<header>
        <h1 style="text-align:center;" > Depots</h1>
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
   if (@$liens['lien'] == 'depots') {
     $add = $liens['ajout'];
     $edit = $liens['modif'];
     $delete = $liens['supp'];
  }
//   debug($liens);die;
 }



?>
<div class="pull-left" style="margin-left:25px;margin-top: 20px">
  <?php echo $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
</div>
 <?php  ?>
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

        <?php echo $this->Form->create($depots, ['type' => 'get']); ?>
        <div class="col-xs-6">
          <?php
          echo $this->Form->control('code', ['label' => 'Code', 'value' => $this->request->getQuery('code'), 'name', 'required' => 'off']); ?>
        </div>

        <div class="col-xs-6">
          <?php
          echo $this->Form->control('name', ['label' => 'Nom ', 'required' => 'off', 'value' => $this->request->getQuery('name')]); ?>
        </div>

        <div class="col-xs-6">
          <div class="form-group input text required">
            <label class="control-label" for="name">Site</label>
            <select class="form-control select2" name="pointdevente_id">
              <option value="" selected="selected" disabled>Veuillez choisir !!</option>
              <?php foreach ($pointdeventes as $id => $point) { ?>
                <option value="<?php echo $id; ?>"><?php echo  $point ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
      


        <div class="col-xs-6">
          <?php
          echo $this->Form->control('adresse', ['label' => 'Adresse ', 'required' => 'off', 'value' => $this->request->getQuery('adresse')]); ?>
        </div>



        <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
          <button type="submit" class="btn btn-primary btn-sm">Afficher</button>
          <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
        </div>



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
            <th scope="col"><?= ('Site') ?></th>
            <th scope="col"><?= ('Code') ?></th>
            <th scope="col"><?= ('Nom') ?></th>
            <th scope="col"><?= ('Adresse') ?></th>
           
           
            <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($depots as $depot) : ?>
            <tr>
              <td hidden><?= h($depot->id) ?></td>
              <td><?= h($depot->pointdevente->name) ?></td>
              <td><?= h($depot->code) ?></td>
              <td><?= h($depot->name) ?></td>
              <td><?= h($depot->adresse) ?></td>
             
  
              <td class="actions text" align="center">
                <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $depot->id), array('escape' => false)); ?>
                <?php 
                echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $depot->id), array('escape' => false));
                ?>
                <?php
                echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $depot->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $depot->id));
                ?>
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
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
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