<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('salma'); ?>


<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="</*?php echo $this->Url->build(['action' => 'index']); */?>"><i class="fa fa-dashboard"></i> </*?php echo __('Home'*/); ?></a></li>
  </ol>

  <div class="row">
    <div class="col-md-12">
      <div style="margin-bottom:10px" type="submit"><?php echo $this->Html->link(__('ajouter'), ['action' => 'add'], ['class' => 'btn btn-success ']) ?></div>

    </div>

</section>



<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box ">
        <div class="box-header with-border">
          <h1 class="box-title">Recherche</h1>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?php echo $this->Form->create($bondereservations, ['type' => 'get']); ?>
        <div class="box ">
          <div class="row">
            <div class="panel-body">
              <div class="col-xs-6">
                <?php echo $this->Form->control('datecreation', ['class' => "form-control pull-right", 'label' => 'Datedeb', 'required' => 'off', 'value' => $this->request->getQuery('datecreation'), 'autocomplete' => 'off']); ?>
              </div>

              <div class="col-xs-6">
                <?php echo $this->Form->control('date', ['class' => "form-control pull-right", 'label' => 'Datefin', 'required' => 'off', 'value' => $this->request->getQuery('date'), 'autocomplete' => 'off']); ?>
              </div>

              <div class="col-xs-6">
                <?php
                echo $this->Form->control('client_id', ['empty' => 'Veuillez choisir !!', 'required' => 'off', 'options' => $clientsoptions, 'label' => 'client', 'value' => $this->request->getQuery('client_id'), 'autocomplete' => 'off']); ?>
              </div>

              <div class="col-xs-6">
                <?php
                echo $this->Form->control('depot_id', ['empty' => 'Veuillez choisir !!', 'required' => 'off', 'options' => $depotsoptions, 'label' => 'depot', 'value' => $this->request->getQuery('depot_id'), 'autocomplete' => 'off']); ?>
              </div>

              <div class="col-xs-6">
                <?php
                echo $this->Form->control('pointdevente_id', ['empty' => 'Veuillez choisir !!', 'required' => 'off', 'options' => $pointsdeventesoptions, 'label' => 'point de vente', 'value' => $this->request->getQuery('pointdevente_id'), 'autocomplete' => 'off']); ?>
              </div>

              <button type="submit" class="btn btn-primary btn-sm">Chercher</button>

              <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>

              <a onclick="openWindow(1000, 1000, 'http://localhost:8765/Bondereservations/imprimerrecherche?datecreation=<?= $datecreation ?>&date=<?= $date ?>&client_id=<?= $client_id ?>&pointdevente_id=<?= $pointdevente_id ?>&depot_id=<?= $depot_id ?>');"><button class="btn btn-primary btn-sm">Imprimer Recherche</button></a>


              <?php echo $this->Form->end(); ?>

              <div>

              </div>
            </div>
          </div>

</section>




<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Bon de reservation</h3>
        </div>
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped" id="ls-editable-table">
            <thead>
              <tr>

                <th>Numero</th>
                <th>Date</th>
                <th> client</th>
                <th>depot</th>
                <th>Point de vente</th>
                <th></th>


              </tr>
            </thead>

            <tbody>

              <?php
              $i = -1;
              foreach ($bondereservations as  $i => $bondereservation) :
              ?>

                <tr class="odd" ligne="<?php $i ?>">


                  <td>
                    <input type="hidden" value="<?php echo $bondereservation->numero ?>" id="numero_id<?php echo $i ?>">

                    <?= h($bondereservation->numero) ?>
                  </td>

                  <td><?= $this->Time->format(
                        $bondereservation->date,
                        'd/MM/y'
                      ) ?></td>
                  <td>

                    <input type="hidden" value="<?php echo $bondereservation->client_id ?>" id="client_id<?php echo $i ?>">
                    <?php echo $this->Html->link($bondereservation->client->Contact, array('controller' => 'Clients', 'action' => 'view', $bondereservation->client_id)); ?>

                  </td>
                  <td>
                    <?php echo $this->Html->link($bondereservation->depot->name, array('controller' => 'Depots', 'action' => 'view', $bondereservation->depot_id)); ?>

                  <td>
                    <?php echo $this->Html->link($bondereservation->pointdevente->name, array('controller' => 'Pointdeventes', 'action' => 'view', $bondereservation->pointdevente_id)); ?>
                  </td>
                  <td>
                    <input type="checkbox" value="<?php echo $bondereservation->id ?>" id="check<?php echo $i ?>" ligne="<?php echo $i ?>" index="<?php echo $i ?>" class="blfbre" />
                  </td>

                  <td class="actions text-right">
                    <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $bondereservation->id), array('escape' => false)); ?>
                    <?php echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $bondereservation->id), array('escape' => false)); ?>
                    <?php echo $this->Form->postLink("<button class='btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete',  $bondereservation->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?',  $bondereservation->id)); ?>
                    <a onclick="openWindow(1000, 1000, 'http://localhost:8765/Bondereservations/imprimer/<?php echo $bondereservation->id; ?>' );"><button class="btn btn-xs btn-info"> <i class="fa fa-print"></i></button></a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>

          </table>
          <input type="hidden" value="<?php echo $i ?>" id="index">

          <table>
          

            <tr>
              <td align="center">
                <div class="col-md-12  testcheck" style="display:none;">
                  <input type="hidden" name="tes" value="0" class="tespv" />
                  <input type="hidden" name="tes" value="0" class="tes" />
                  <input type="hidden" name="nombre" value="<?php echo $i ?>" class="nombre" />
                  <a href="" class="btn btn btn-danger" id="commande"> <i class="fa fa-plus-circle"></i> Créer une bon de commande </a>
                </div>

              </td>


            </tr>
          </table>

        </div>
      </div>
    </div>
  </div>
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
<script>
  function openWindow(h, w, url) {
    leftOffset = (screen.width / 2) - w / 2;
    topOffset = (screen.height / 2) - h / 2;
    window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
  }
</script>