<?php echo $this->Html->script('safa'); ?>


<?php echo $this->Html->css('select2'); ?>
<section class="content-header">
  <header>
    <h1 style="text-align:center;"> Plan commercial Industriel</h1>
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
        <?php echo $this->Form->create($plancommercialindustriels, ['type' => 'get']); ?>

        <div class="col-xs-6">
          <?php
          echo $this->Form->control('datedebut', ['required' => 'off', 'label' => 'Date debut', 'value' => $this->request->getQuery('datedebut'), 'autocomplete' => 'off', 'type' => 'date', 'class' => 'form-control control-label']);
          ?>
        </div>
        <div class="col-xs-6">
          <?php
          echo $this->Form->control('datefin', ['required' => 'off', 'label' => 'Date fin', 'value' => $this->request->getQuery('datefin'), 'autocomplete' => 'off', 'type' => 'date', 'class' => 'form-control control-label']);
          ?>
        </div>
        <div class="col-xs-6">
          <label> Mois Du </label>
          <select id="moisdu" class="form-control select2 verifdate" name="moisdu_id" value="<?php echo $moisdu ?>">
            <option value="<?php echo  $moisdu ?>" selected="selected">Veuillez choisir </option>
            <?php foreach ($mois as $j => $moi) {
            ?>
              <option <?php if ($moi->id == $moisdu) { ?> selected="selected" <?php } ?> value="<?php echo $moi->id; ?>"><?php echo $moi->name ?></option>
            <?php } ?>

          </select>
        </div>
        <div class="col-xs-6">
          <label> Mois Au </label>
          <select id="moisau" class="form-control select2  verifdate plan" name="moisau_id" value="<?php echo $moisau ?>">
            <option value="<?php echo  $moisau ?>" selected="selected">Veuillez choisir </option>
            <?php foreach ($mois as $j => $moi) {
            ?>
              <option <?php if ($moi->id == $moisau) { ?> selected="selected" <?php } ?> value="<?php echo $moi->id; ?>"><?php echo $moi->name ?></option>
            <?php } ?>

          </select>

        </div>

        <div class="col-xs-6">
          <?php echo $this->Form->control('marge', ['required' => 'off', 'id' => 'marge', 'label' => 'Marge(%)', 'div' => 'form-group', 'between' => '<div class="col-sm-10" >', 'after' => '</div>', 'class' => 'form-control']); ?>
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
            <th scope="col"><?= ('Date') ?></th>
            <th scope="col"><?= ('Mois du ') ?></th>
            <th scope="col"><?= ('Mois au') ?></th>
            <th scope="col"><?= ('Marge') ?></th>

            <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($plancommercialindustriels as $plancommercialindustriel) : ?>


            <tr>
              <td hidden><?= h($plancommercialindustriel->id) ?></td>
              <td>
                <?=
                $this->Time->format(
                  $plancommercialindustriel->date,
                  'dd/MM/y'
                );
                ?></td>



              <td><?php
                  foreach ($mois as $m) {
                    if ($plancommercialindustriel->moisdu_id == $m->id) {
                      echo $m->name;
                    }
                  }
                  ?></td>
              <td><?php
                  foreach ($mois as $m) {
                    if ($plancommercialindustriel->moisau_id == $m->id) {
                      echo $m->name;
                    }
                  }
                  ?></td>
              <td><?= h($plancommercialindustriel->marge) ?></td>


              <td class="actions text" align="center">
                <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $plancommercialindustriel->id), array('escape' => false)); ?>
                <?php
                echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $plancommercialindustriel->id), array('escape' => false));
                ?>
                <?php
                echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $plancommercialindustriel->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $plancommercialindustriel->id));
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