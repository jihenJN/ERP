
<?php $this->layout = 'AdminLTE.print'; ?>


<?php use Cake\Core\Configure;
use Cake\I18n\FrozenTime;
use Cake\Datasource\ConnectionManager;
 ?> 
<?php $connection = ConnectionManager::get('default'); ?>


<br>
<style>
    body {
        font-size: 11px;
       
    }

    table {
        font-size: 12px;
    
    }
    
 


</style>

       
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<?php echo $this->Html->script('hechem'); ?>
<?php echo $this->Html->script('salma'); ?>
<!-- <?php echo $this->Html->script('alert'); ?> -->
<div style="display:flex">
   
    <div >
    <div >
        <?php
        echo $this->Html->image('mm.png', ['alt' => 'CakePHP', 'height' => '110px', 'width' => '200px']); ?>
    </div>
    <div  align="left">
        Société CODIFA <br>
        Rte Fouchana 1.8 km 1135 naassen <br>
        Phone : (+216) 71 398 404 / (+216) 71 398 158 <br>
        Mail : codifa@gnet.tn <br>
    </div>
</div>  
<br><br><br>
<div>
<h2>Liste des ordres de fabrications</h2>
</div>

    <!--------------------------->
   <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          <table  class="table table-bordered table-striped">
              <thead>
          <tr>
            <th scope="col"><?= ('Site') ?></th>
            <th scope="col"><?= ('Numero') ?></th>
            <th scope="col"><?= ('Date') ?></th>
            <th scope="col"><?= ('Depots') ?></th>
            <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($ordrefabrications as $ordrefabrications) : ?>
            <tr>
              <td hidden><?= h($ordrefabrications->id) ?></td>
              <td><?= h($ordrefabrications->pointdevente->name) ?></td>
              <td><?= h($ordrefabrications->numero) ?></td>
              <td><?= h($ordrefabrications->date) ?></td>
              <td><?= h($ordrefabrications->depot->name) ?></td>
              <td class="actions text" align="center">
                <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $ordrefabrications->id), array('escape' => false)); ?>
                <?php
                echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $ordrefabrications->id), array('escape' => false));
                ?>
                <?php
                echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $ordrefabrications->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $ordrefabrications->id));
                ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
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