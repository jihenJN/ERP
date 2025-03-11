<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->css('select2'); ?>

<section class="content-header">
  <header>
    <h1 style="text-align:center;"> Sites</h1>
  </header>
</section><?php
          $add = "";
          $edit = "";
          $delete = "";
          $view = "";
          $session = $this->request->getSession();
          $abrv = $session->read('abrvv');
          $lien = $session->read('lien_parametrage' . $abrv);
          //debug($lien);die;
          foreach ($lien as $k => $liens) {
            if (@$liens['lien'] == 'pointdeventes') {
              $add = $liens['ajout'];
              $edit = $liens['modif'];
              $delete = $liens['supp'];
            }
            //debug($liens);die;
          }

          ?>
<div class="pull-left" style="margin-left:25px;margin-top: 20px">
  <?php echo $this->Html->link(__('Ajouter'), ['action' => 'Add'], ['class' => 'btn btn-success btn-sm']) ?>
</div>
<?php  ?>
<br><br><br>
<section class="content-header" hidden>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
  <h1>
    Recherche
  </h1>
</section>
<section hidden class="content" style="width: 99%" style="background-color: white ;">
  <div class="box">
    <div class="box-body">
      <div class="row">
        <?php echo $this->Form->create($pointdeventes, ['type' => 'get']); ?>
        <div class="col-xs-6">
          <?php
          echo $this->Form->control('code', ['label' => 'Code', 'value' => $this->request->getQuery('code'), 'autocomplete' => 'off']); ?>
        </div>
        <div class="col-xs-6">
          <?php
          echo $this->Form->control('name', ['label' => 'Nom', 'value' => $this->request->getQuery('name'), 'autocomplete' => 'off']); ?>
        </div>
        <div class="col-xs-6">
          <?php
          echo $this->Form->control('adresse', ['label' => 'Adresse', 'value' => $this->request->getQuery('adresse'), 'autocomplete' => 'off']); ?>
        </div>

        <div class="col-xs-6">
          <?php
          echo $this->Form->control('matriclefiscale', ['label' => 'Matricle Fiscale', 'value' => $this->request->getQuery('matriclefiscale'), 'empty' => 'Veuillez choisir !!']); ?>
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
  <div class="box">
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th scope="col"><?= h('Code') ?></th>
            <th scope="col"><?= h('Nom') ?></th>
            <th scope="col"><?= h('Adresse') ?></th>
            <th scope="col"><?= h('Matriclefiscale') ?></th>
            <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pointdeventes as $i=> $pointdevente) : ?>
            <tr>
            <td hidden> 
            <?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id' . $i, 'value' => $pointdevente->id, 'label' => '', 'champ' => 'id', 'class' => 'form-control']); ?>
            </td>
              <td><?= h($pointdevente->code) ?></td>
              <td><?= h($pointdevente->name) ?></td>
              <td><?= h($pointdevente->adresse) ?></td>
              <td><?= h($pointdevente->matriclefiscale) ?></td>
              <td class="actions text" align="center">
                <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $pointdevente->id), array('escape' => false)); ?>
                <?php
                echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $pointdevente->id), array('escape' => false));
                ?>
                <?php
                //echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $pointdevente->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $pointdevente->id));
                ?>
                <button index='<?php echo $i ?>' class='verifier btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button>

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
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
  $('.select2').select2()
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
  $(function() {
    $('.verifier').on('click', function() {
      // alert('hello');
      ind = $(this).attr('index');
      //  alert(ind);
      id = $('#id' + ind).val();
      //  alert(id);
      //  alert(id)
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Pointdeventes', 'action' => 'verif']) ?>",
        dataType: "json",
        data: {
          idfam: id,
        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data) {
          //   $('#pays').html(data.pays);
          //  alert(data.pays);


          if (data.points != 0) {
            alert("Existe dans un autre document");

          } else {
            if (confirm('Voulez vous vraiment supprimer cet enregistrement')) {
              document.location = wr + "pointdeventes/delete/" + id;
            }
          }
        }
      })
    });
  });
</script>
<?php $this->end(); ?>