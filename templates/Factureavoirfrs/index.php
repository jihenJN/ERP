<?php

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Factureavoirfr> $factureavoirfrs
 */
?>

<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('salma'); ?>

<?php //if ($type== 1) { 
?>
<div class="pull-left" style="margin-left:25px;margin-top: 20px">

  <?php //echo $this->Html->link(__('Ajouter'), ['action' => 'add/1' ], ['class' => 'btn btn-success btn-sm']) 
  ?>
</div>

<?php ///} 
?>

<?php //if ($type== 2) { 
?>
<!-- <div class="pull-left" style="margin-left:25px;margin-top: 20px">

<?php echo $this->Html->link(__('Ajouter'), ['action' => 'add/2'], ['class' => 'btn btn-success btn-sm']) ?>
</div> -->

<?php //} 
?>

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

      <?php echo $this->Form->create($factureavoirfrs, ['type' => 'get', 'onkeypress' => "return event.keyCode!=13"]); ?>
      <div class="row">
        <div class="col-xs-6">
          <?php

          echo $this->Form->control('numero', array('value' => $this->request->getQuery('numero'),  'class' => 'form-control '));

          ?>
        </div>
        <div class="col-xs-6">
          <?php
          echo $this->Form->control('date', array('label' => 'Date ', 'value' => $this->request->getQuery('date'), 'type' => 'date', 'class' => 'form-control '));
          ?>
        </div>
      </div>


      <div class="row">
        <div class="col-xs-6">
          <?php
          echo $this->Form->control('facture_id', array('value' => $this->request->getQuery('facture_id'), 'empty' => 'Veuillez choisir !!', 'class' => 'select2 form-control', 'label' => 'Facture ', 'options' => $factures));
          ?>
        </div>
        <div class="col-xs-6">
          <?php
          echo $this->Form->control('fournisseur_id', ['label' => 'Fournisseur ', 'options' => $fournisseurs, 'value' => $this->request->getQuery('fournisseur_id'), 'empty' => 'Veuillez choisir !!', 'class' => 'select2 form-control']); ?>
        </div>
      </div>

      <div class="pull-right" style="margin-right:40%;margin-top: 20px;">
        <button type="submit" class="btn btn-primary ">Afficher</button>
        <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index'], ['class' => 'btn btn-primary ']) ?>

      </div>
      <?php echo $this->Form->end(); ?>

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
        
          <tr style="background-color: #4DAAA5;">
            <th scope="col"><?= h('Numero') ?></th>
            <th scope="col"><?= h('Date') ?></th>
            <th scope="col"><?= h('Fournisseur') ?></th>
            <th scope="col"><?= h('Facture') ?></th>
            <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($factureavoirfrs as $factureavoirfr):
            // debug($factureavoirfr)  ; 
          ?>
            <tr>
              <td><?= ($factureavoirfr->numero) ?></td>
              <td>
                <?=
                $this->Time->format(
                  $factureavoirfr->date,
                  'dd/MM/y'
                );
                ?></td>
              <td><?= ($factureavoirfr->fournisseur->name) ?></td>
              <td><?= ($factureavoirfr->facture->numero) ?></td>

              <td class="actions text-right">

                <?php //if ($type== 1) { 
                ?>
                <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $factureavoirfr->id), array('escape' => false)); ?>
                <!-- <?php //echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $factureavoirfr->id), array('escape' => false)); 
                      ?> -->
                <?php echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete',  $factureavoirfr->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?',  $factureavoirfr->id)); ?>
                <?php //} 
                ?>
                <?php //if ($type== 2) { 
                ?>
                <?php //echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view/2', $factureavoirfr->id), array('escape' => false)); 
                ?>
                <?php //echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit/2', $factureavoirfr->id), array('escape' => false)); 
                ?>
                <?php  //echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete/2',  $factureavoirfr->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?',  $factureavoirfr->id));
                ?>
                <?php //} 
                ?>




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
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
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
  $('.select2').select2();
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