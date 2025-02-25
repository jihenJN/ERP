<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('salma'); ?>
<div class="pull-left" style="margin-left:25px;margin-top: 20px">
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
  if (@$liens['lien'] == 'delegations') {
    $add = $liens['ajout'];
    $edit = $liens['modif'];
    $delete = $liens['supp'];
  }
  //debug($liens);die;
}

if ($add == 1) { ?>
  <?php echo $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
</div>
<?php }?>
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

            <?php echo $this->Form->create($delegations, ['type' => 'get']); ?>
            <div class="row">


                <div class="col-xs-6">
                    <?php echo $this->Form->control('name', ['label' => 'Nom', 'value' => $this->request->getQuery('name'), 'name', 'required' => 'off']); ?>
                </div>
                <div class="col-xs-6">
                    <?php echo $this->Form->control('codepostale', ['label' => 'Code postale', 'value' => $this->request->getQuery('codepostale'), 'name', 'required' => 'off']); ?>
                </div>

                

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
    Delegations
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
                  <th><?php echo('Nom') ;?></th>
              <th><?php echo('Code postale') ;?></th>
              <th><?php echo('Actions') ;?></th>

              
              
              
              <th class="actions" align="center"></th>
            </tr>
          </thead>
          <tbody>



                <?php foreach ($delegations as $i => $delegation): ?>
                <tr>
                <?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id'.$i, 'value' => $delegation->id, 'label' => '', 'type'=>'hidden','champ' => 'id', 'class' => 'form-control']); ?>

                    <td><?= h($delegation->name) ?></td>
                    <td><?php echo ($delegation->codepostale); ?></td>
                    
                     <td class="actions text" >
                  <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $delegation->id), array('escape' => false)); ?>
                  <?php if ($edit == 1) { echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $delegation->id), array('escape' => false));} ?>
                  <?php if ($delete == 1) { ?>                        
                   <button index='<?php echo $i?>' class='verifierdg btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button>       
                  <?php } ?>

                </td>
                </tr>
               <?php endforeach; ?>
          </tbody>
        </table>



     <table>

            <tr>
             

            </tr>
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


<script type="text/javascript">
   $(function () {
        $('.verifierdg').on('click', function () {

            ind = $(this).attr('index');
            id = $('#id'+ind).val();

            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Delegations', 'action' => 'getdgbase']) ?>",
                dataType: "json",
                data: {
                  idDg: id,

                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (response, status, settings) {
                    
                   if (response.query !=0)
                   {
                        alert("Vous ne pouvez pas supprimer cet enregistrement");
                   }
                   else {
                       if(confirm('Voulez vous vraiment supprimer cet enregistrement'))
                        {
                        
                          document.location = wr+"delegations/delete/"+id;
                        }
                   }
                   

                }
            })
        });
    });

</script>