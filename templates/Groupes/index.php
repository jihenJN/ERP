<!-- Content Header (Page header) -->
<?php echo $this->Html->css('select2'); ?>





  <section class="content-header">
<header>
        <h1 style="text-align:center;" >Groupes</h1>
    </header>
    </section>

<div class="pull-left" style="margin-left:25px;margin-top: 20px">
    <?php echo $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
</div>
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




                <?php echo $this->Form->create($groupes, ['type' => 'get']); ?>


                
                <div class="col-xs-6">
                    <?php
                    echo $this->Form->control('client_id', ['options' => $clients, 'required' => 'off', 'empty' => true, 'label' => 'Clients', 'value' => $this->request->getQuery('client_id'), 'autocomplete' => 'off', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 control-label']);
                    ?>
                </div>

                <div class="pull-right" style="margin-right:44%;margin-top: 20px;">
                    <button type="submit" class="btn btn-primary ">Afficher</button>
                    <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index'], ['class' => 'btn btn-primary ']) ?>
                    <!--          <a onclick="openWindow(1000, 1000, 'http://localhost:8765/commandes/imprimerrecherche?commercial_id=<?= $commercial_id ?>&client_id=<?= $client_id ?>&numero=<?= $numero ?>');"><button class="btn btn-primary btn-sm">Imprimer Recherche</button></a>-->
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</section>
<br> <br><br>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="6%" align="center">Client</th>



                <th width="8%" align="center"><?= __('') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($groupes as $groupe) : ?>
                <tr>
                  <td><?= h($groupe->client->Raison_Sociale) ?></td>



                  <td class="actions text" align="center">

                    <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $groupe->id), array('escape' => false)); ?>
                    <?php echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $groupe->id), array('escape' => false)); ?>
                    <?php echo $this->Form->postLink("<button class='btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $groupe->id), array('escape' => false, 'confirm' => __('Etes-vous sûr que vous voulez supprimer # {0}?', $groupe->client->Raison_Sociale))); ?>

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
