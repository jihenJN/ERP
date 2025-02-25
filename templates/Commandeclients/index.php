<div class="pull-left" style="margin-left:25px;margin-top: 20px">
  <?php echo $this->Html->link(__('Ajouter'), ['action' => 'Add'], ['class' => 'btn btn-success btn-sm']) ?>
</div>
<br><br><br>
<section class="content-header">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
  <h1>
    Recherche
  </h1>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <?php echo $this->Form->create($commandeclients, ['type' => 'get']); ?>
      <div class="box ">
        <div class="row">
          <div class="panel-body">
            
        <div class="col-xs-6">
          <?php
          echo $this->Form->input('date debut', array('value' => $this->request->getQuery('historiquede'), 'id' => 'historiquede', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'date'));
          ?>
        </div>
        <div class="col-xs-6">
        <?php
          echo $this->Form->input('date fin', array('value' => $this->request->getQuery('au'), 'id' => 'au', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'date'));
          ?>
        </div>  
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('pointdevente_id', ['required' => 'off', 'empty' => true, 'label' => 'points de ventes', 'value' => $this->request->getQuery('pointdevente_id'), 'autocomplete' => 'off', 'empty' => 'Veuillez choisir !!']); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('client_id', ['options' => $clientsoptions, 'required' => 'off', 'empty' => true, 'label' => 'clients', 'value' => $this->request->getQuery('client_id'), 'autocomplete' => 'off', 'empty' => 'Veuillez choisir !!']); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('depot_id', ['options' => $depotsoptions, 'required' => 'off', 'empty' => true, 'label' => 'depots', 'value' => $this->request->getQuery('depot_id'), 'autocomplete' => 'off', 'empty' => 'Veuillez choisir !!']); ?>
            </div>
            <div class="pull-right" style="margin-right:44%;margin-top: 20px;">
        <button type="submit" class="btn btn-primary btn-sm">Afficher</button>
        <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
        <a onclick="openWindow(1000, 1000, 'http://localhost:8765/commandeclients/imprimerrecherche?pointdevente_id=<?= $pointdevente_id ?>&client_id=<?= $client_id ?>&depot_id=<?= $depot_id ?>');"><button class="btn btn-primary btn-sm">Imprimer Recherche</button></a>
      </div>

            <?php echo $this->Form->end(); ?>

            <div>

            </div>
            <!-- /.box -->
          </div>
        </div>
        <!-- /.row -->

</section>
<h1>
  Commande
</h1>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>

                <th>code</th>
                <th>client</th>
                <th>date</th>
                <th>commentaire</th>
                <th>point de vente</th>
                <th>depot</th>
                <th>Action</th>



              </tr>
            </thead>
            <tbody>
            
              <?php foreach ($commandeclients as $commandeclient) : ?>
                <?php  //debug($commandeclient);die;   ?>
                <tr>
                  <td><?= h($commandeclient->code) ?></td>
                  <td><?= h($commandeclient->client->name) ?></td>
                  <td><?= h($commandeclient->date) ?></td>
                  <td><?= h($commandeclient->commentaire) ?></td>
                  <td><?= h($commandeclient->pointdevente->name) ?></td>
                  <td><?= h($commandeclient->depot->name) ?></td>
                  <td class="actions text-right">
                    <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $commandeclient->id), array('escape' => false)); ?>
                    <?php echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $commandeclient->id), array('escape' => false)); ?>
                    <?php echo $this->Html->link("<button class='btn btn-xs btn-primary'><i class='fa fa-print'></i></button>", array('action' => 'imprimeview', $commandeclient->id), array('escape' => false)); ?>

                    <?php echo $this->Form->postLink("<button class='btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $commandeclient->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $commandeclient->id)); ?>
                    
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>

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
  leftOffset = (screen.width/2) - w/2;
  topOffset = (screen.height/2) - h/2;
  window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
}
</script>