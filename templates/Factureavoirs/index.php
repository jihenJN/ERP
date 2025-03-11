<?php

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Factureavoirfr> $factureavoirfrs
 */
?>

<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('salma'); ?>


<section class="content-header">
  <?php // if ($type == 1) { 
  ?>

  <header>
    <h1 style="text-align:center;"> Factures avoirs </h1>
  </header>
  <?php //} 
  ?>


  <?php if ($type == 2) { ?>

    <header>
      <h1 style="text-align:center;"> Factures avoirs marchandise </h1>
    </header>
  <?php } ?>
</section>
<?php //if ($type == 1) { 
?>
<div class="pull-left" style="margin-left:25px;margin-top: 20px">
  <?php //echo $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) 
  ?>
</div>
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

      <?php echo $this->Form->create($factureavoirs, ['type' => 'get', 'onkeypress' => "return event.keyCode!=13"]); ?>
      <div class="row">
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

          echo $this->Form->control('numero', array('value' => $this->request->getQuery('numero'),  'class' => 'form-control', 'label' => 'Numéro'));

          ?>
        </div>

        <div class="col-xs-6">

          <div class="form-group input select required">

            <label class="control-label" for="depot-id">Clients</label>

            <select name="client_id" id="client" class="form-control select2 control-label " value='<?php $this->request->getQuery('client_id') ?>'>
              <option value="" selected="selected">Veuillez choisir !!</option>

              <?php foreach ($clients as $client) {
              ?>
                <option <?php if ($client_id == $client->id) { ?> selected="selected" <?php } ?> value="<?php echo $client->id; ?>"><?php echo $client->Code . ' ' . $client->Raison_Sociale ?></option>
              <?php } ?>
            </select>
          </div>
        </div>

      </div>




      <div class="pull-right" style="margin-right:40%;margin-top: 20px;">
        <button type="submit" class="btn btn-primary ">Afficher</button>
        <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index'], ['class' => 'btn btn-primary ']) ?>

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
          <table width="100%" id="example2" class="table table-bordered table-striped">

            <!-- <table id="example1" class="table-fixed table table-bordered table-striped" style=' display: block;overflow-x: auto;white-space: nowrap;height:500px'> -->
            <thead>

              <tr style="font-size: 16px;background-color: #3c8dbc;">
                <th scope="col"><?= h('Numéro') ?></th>
                <th scope="col"><?= h('Date') ?></th>
                <th scope="col"><?= h('Client') ?></th>
                <th scope="col"><?= h('TTC') ?></th>
                <th scope="col"><?= h('Facture') ?></th>

                <th scope="col"><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($factureavoirs as $fac) :
                //debug($fac);
              ?>
                <tr style="font-size: 16px;">
                  <td><?= h($fac->numero) ?></td>
                  <td>
                    <?= $this->Time->format(
                      $fac->date,
                      'dd/MM/y'
                    ); ?></td>
                  <?php if ($fac->client_id == 12) { ?>
                    <td><?php echo $fac->client->Code . ' ' . $fac->nomprenom; ?></td>

                  <?php } else { ?>
                    <td><?= $fac->client->Code . ' ' . h($fac->client->Raison_Sociale) ?></td>

                  <?php } ?>
                  <td><?= h($fac->totalttc) ?></td>
                  <td><?= h($fac->factureclient->numero) ?></td>


                  <td>
                    <?php //if ($imp == 1) {
                    echo $this->Html->link("<button class='btn btn-xs btn-primary'><i class='fa fa-print'></i></button>", array('action' => 'imprimeview', $fac->id), array('escape' => false));
                    //  } 
                    ?>
                    <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $fac->id), array('escape' => false)); ?>
                    <?php //if ($edit == 1) {
                    //  echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $fac->id), array('escape' => false));
                    //} 
                    ?>
                    <?php //if ($delete == 1) {
                    echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete',  $fac->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?',  $fac->id));
                    //} 
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
      'lengthChange': true,
      'searching': true,
      'ordering': false,
      'info': true,
      'autoWidth': true
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