<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('salma'); ?>

<section class="content-header">
<header>
    <h1 style="text-align:center;" > Prévision vente N-1</h1>
</header>
</section>
<?php
$add =1;
$edit = 1;
$delete = 1;
//$session = $this->request->getSession();
//$abrv = $session->read('abrvv');
//$lien = $session->read('lien_achat' . $abrv);
//foreach ($lien as $k => $liens) {
//  if (@$liens['lien'] == 'previsionachats') {
//    $add = $liens['ajout'];
//    $edit = $liens['modif'];
//    $delete = $liens['supp'];
//  }
// 
//}

if ($add == 1  && $count == 0) 
{ ?>
  <div class="pull-left" style="margin-left:25px;margin-top: 20px">
    <?php echo $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
  </div>
<?php  } ?>
<br><br><br>

<section class="content" style="width: 99%" style="background-color: white ;">
    

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>  
                  <th  class="actions text-center"><?php echo('Numero') ;?></th>
                  <th  class="actions text-center "><?php echo('Date') ;?></th>

 
              <th class="actions text-center "align="center"> Actions</th>
            </tr>
          </thead>
          <tbody>

                <?php foreach ($previsionachats as $prev): ?>
                <tr>
                  
                    <td   align="center"   ><?= h($prev->numero) ?></td>
                    <td  align="center"  ><?=
                                        $this->Time->format(
                                                $prev->date,
                                                'dd/MM/y'
                                        );
                                        ?></td>                  
                    
                     <td class="actions text" align="center">
                  <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $prev->id), array('escape' => false)); ?>
                  <?php if ($edit == 1) {
                  echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $prev->id), array('escape' => false)); } ?>
                  <?php   if ($delete == 1) {
                  echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete',  $prev->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?',  $prev->id)); } ?>


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

