<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('hechem'); ?>


<section class="content-header">
<header>
<?php if ($type == 1) {
  ?>  
<h1 style="text-align:center;">
  Facture vente
  </h1>
  <?php }?>  
  <?php if ($type == 2) {
  ?>  
<h1 style="text-align:center;">
  Facture avoir vente
  </h1>
  <?php }?>  
  <?php if ($type == 3) {
  ?>  
<h1 style="text-align:center;">
  Facture avoir financier vente
  </h1>
  <?php }?> 
  <?php if ($type == 4) {
  ?>  
<h1 style="text-align:center;">
  Facture achat local
  </h1>
  <?php }?>  
  <?php if ($type == 5) {
  ?>  
<h1 style="text-align:center;">
  Facture achat etranger
  </h1>
  <?php }?>  
  <?php if ($type == 6) {
  ?>  
<h1 style="text-align:center;">
  Facture avoir achat local
  </h1>
  <?php }?>  
 
  </header>
  <?php echo $this->fetch('script'); 
if ($count == 0) 
{ ?>
  <div class="pull-left" style="margin-left:25px;margin-top: 20px">
    <?php echo $this->Html->link(__('Ajouter'), ['action' => 'add/' . $type], ['class' => 'btn btn-success btn-sm']) ?>
  </div>
<?php  } ?>
<br><br><br>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="25%" class="actions text-center"> Journal </th>
                <th width="25%" scope="col" class="actions text-center"> Actions </th>

              </tr>
            </thead>
            <tbody>

              <?php 
              foreach ($parmetreintegrations as $i => $p) :
                 //debug($p)    ; 

                // debug($type);
              ?>
                <tr>
                
                <td class="actions text-center"><?= h($p->journal->name) ?></td>

                  <td class="actions text-center">
                    <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $p->id), array('escape' => false)); ?>
                    <?php
                      echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $p->id), array('escape' => false));
                     ?>

                    <?php //if ($delete == 1) {
                    echo $this->Form->postLink("<button class='btn btn-xs btn-danger  deleteConfirm ' index=$i ><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $p->id) ,array('escape' => false));?></td>
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
<?php echo $this->Html->script('alert'); ?>
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