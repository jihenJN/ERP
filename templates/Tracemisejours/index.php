<!-- Content Header (Page header) -->
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
        <?php echo $this->Form->create($tracemisejours, ['type' => 'get']); ?>

        <div class="col-xs-6">
          <?php
          echo $this->Form->input('historiquede', array('value' => $this->request->getQuery('historiquede'), 'id' => 'historiquede', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'date'));
          ?>
        </div>
        <div class="col-xs-6">
          <?php
          echo $this->Form->input('au', array('value' => $this->request->getQuery('au'), 'id' => 'au', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'date'));
          ?>
        </div>
        <div class="col-xs-6">
          <?php
          echo $this->Form->control('model', ['label' => 'Model', 'value' => $this->request->getQuery('model'), 'required' => 'off']); ?>
        </div>
        <div class="col-xs-6">
          <?php
          echo $this->Form->control('operation', ['label' => 'Operation', 'value' => $this->request->getQuery('operation'), 'required' => 'off']); ?>
        </div>
        <div class="col-xs-6">
          <?php
          echo $this->Form->control('user_id', ['label' => 'User', 'value' => $this->request->getQuery('user_id'), 'required' => 'off',  'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 ']); ?>
        </div>
      </div>
      <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
        <button type="submit" class="btn btn-primary btn-sm">Afficher</button>
        <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>

      </div>
      <?php echo $this->Form->end(); ?>
    </div>
  </div>
</section>
<h1>
  Historique Utilisateur
</h1>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="20%" align="center"><?= ('User') ?></th>
                <th width="20%" align="center"><?= ('Poste') ?></th>

                <th width="20%" align="center"><?= ('Date') ?></th>
                <th width="20%" align="center"><?= ('Operation') ?></th>
                <th width="20%" align="center"><?= ('Model') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($tracemisejours as $tracemisejour) : ?>
                <tr>  
                <td hidden ><?= h($tracemisejour->id) ?></td>
                  <td><?= h($tracemisejour->user->login) ?></td>
                  <td><?= h($tracemisejour->poste) ?></td>
                  <td><?= h($tracemisejour->date) ?>
                    <?= h($tracemisejour->heure) ?> </td>
                  <td><?= h($tracemisejour->operation) ?></td>
                  <td> <?= h($tracemisejour->model) ?></td>
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
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
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
<script>
  $('.select2').select2()
</script>
<?php $this->end(); ?>