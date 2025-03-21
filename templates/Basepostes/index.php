<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->css('select2'); ?>

<?php
$add = "";
$edit = "";
$delete = "";
$view = "";
$session = $this->request->getSession();
$abrv = $session->read('abrvv');
$lien = $session->read('lien_parametrage' . $abrv);
//debug($lien);die;
foreach ($lien as $k => $liens) {
  if (@$liens['lien'] == 'basepostes') {
    $add = $liens['ajout'];
    $edit = $liens['modif'];
    $delete = $liens['supp'];
  }
  //debug($liens);die;
}

if ($add == 1) { ?>
  <div class="pull-left" style="margin-left:25px;margin-top: 20px">
    <?php echo $this->Html->link(__('Ajouter'), ['action' => 'Add'], ['class' => 'btn btn-success btn-sm']) ?>
  </div>
<?php  } ?>
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

            <?php echo $this->Form->create($basepostes, ['type' => 'get']); ?>
            <div class="row">


                <div class="col-xs-6">
                    <?php echo $this->Form->control('codepostale', ['label' => 'Code postale', 'value' => $this->request->getQuery('codepostale'), 'name', 'required' => 'off']); ?>
                </div>
                <div class="col-xs-6">
                    <?php
                   echo $this->Form->control('gouv_id', ['value' => $this->request->getQuery('gouv_id'),'id'=>'gouver-id' ,'options' => $gouvernorats, 'required' => 'off', 'empty' => true, 'label' => 'Gouvernorat', 'value' => $this->request->getQuery('id_gouv'), 'autocomplete' => 'off', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 control-label gouv']);
                    ?>
                </div>

                </div>

                <div class="row">
                <div class="col-xs-6">
                     <div class="form-group input text " id="delegation">
                      <?php echo $this->Form->control('delegation_id', ['value' => $this->request->getQuery('delegation_id'),'id' => 'deleg', 'name' => 'delegation_id', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 control-label ' ]); ?>

                     </div>
                  </div>

                  <div class="col-xs-6">
                       <div class="form-group input text " id="localite">
                       <?php echo $this->Form->control('localite_id', ['value' => $this->request->getQuery('localite_id'),'name' => 'localite_id', 'id' => 'loc', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 control-label ' ]); ?>
                     </div>

                                </div>
              

              

                </div>

               

           
               
                <div>
                <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
                    <button type="submit" class="btn btn-primary btn-sm">Afficher</button>
                    <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
                </div>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>

        </section>

<section class="content-header">
  <h1>
    Base postes
  </h1>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
              <th><?php echo('Code postal') ;?></th>
              <th><?php echo('Gouvernorat') ;?></th>
              <th><?php echo('Delegation') ;?></th>
              <th><?php echo('Localite') ;?></th>
              <th class="actions" align="center">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($basepostes as $base) : ?>
              <tr>
                <td><?= h($base->codepostale) ?></td>
                <td><?= h($base->gouvernorat->name) ?></td>
                <td><?= h($base->delegation->name) ?></td>
                <td><?= h($base->localite->name) ?></td>

                <td class="actions text" align="center">
                  <?php
                   echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $base->id), array('escape' => false)); ?>
                  <?php if ($edit == 1) {
                   echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $base->id), array('escape' => false)); } ?>
                  <?php if ($delete == 1) { 
                  echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete',  $base->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?',  $base->id)); } ?>


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
      'lengthChange': false,
      'searching': false,
      'ordering': true,
      'info': true,
      'autoWidth': false
    })
  })
  $('.select2').select2()

  //Datemask dd/mm/yyyy
//  $('#datemask').inputmask('dd/mm/yyyy', {
//    'placeholder': 'dd/mm/yyyy'
//  })
//  //Datemask2 mm/dd/yyyy
//  $('#datemask2').inputmask('mm/dd/yyyy', {
//    'placeholder': 'mm/dd/yyyy'
//  })
//  //Money Euro
//  $('[data-mask]').inputmask()

  //Date range picker
//  $('#reservation').daterangepicker()
//  //Date range picker with time picker
//  $('#reservationtime').daterangepicker({
//    timePicker: true,
//    timePickerIncrement: 30,
//    format: 'MM/DD/YYYY h:mm A'
//  })
</script>

<script>
  $(function () {
        $('.gouv').on('change', function () {
            id = $('#gouver-id').val();
           // alert(id) ; 
          
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Basepostes', 'action' => 'getdelegation']) ?>",
                dataType: "json",
                data: {
                  idgouv: id,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (response, status, settings) {
                    $('#delegation').html(response.select);




                }
            })
        });
    });
</script>
<script>
      function getlocalites(id) {

        $.ajax({
            method: "GET",
            url: "<?= $this->Url->build(['controller' => 'Basepostes', 'action' => 'getloc']) ?>",
            dataType: "json",
            data: {
              idDeleg: id,
            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
            },
            success: function (response, status, settings) {
                
                $('#localite').html(response.select);
              

                // uniform_select('localite');
            }
        })

    }
</script>
<?php $this->end(); ?>
