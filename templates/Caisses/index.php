<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>




<?php
$add = "";
$edit = "";
$delete = "";
$view = "";
$session = $this->request->getSession();
$abrv = $session->read('abrvv');
$lien = $session->read('lien_stock' . $abrv);
//debug($lien);die;
// foreach ($lien as $k => $liens) {
//   if (@$liens['lien'] == 'unites') {
//     $add = $liens['ajout'];
//     $edit = $liens['modif'];
//     $delete = $liens['supp'];
//   }
//   //debug($liens);die;
// }
//if ($add == 1) { ?>
  <div class="pull-left" style="margin-left:25px;margin-top: 20px">
    <?php echo $this->Html->link(__('Ajouter'), ['action' => 'Add'], ['class' => 'btn btn-success btn-sm']) ?>
  </div>
<?php // } ?>
<br> <br><br>



<!-- 
<section class="content-header">
    <h1>
        Recherche
    </h1>
</section>
<section class="content" style="width: 99%">
    <div class="box">


        <div class="box-body">
            <div class="row">

                <?php echo $this->Form->create($unites, ['type' => 'get']); ?>
                <div class="col-xs-6">
                    <?php
                    echo $this->Form->control('name', ['label' => 'Nom', 'value' => $this->request->getQuery('name'), 'name', 'required' => 'off']); ?>
                </div>
                












                <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
          <button type="submit" class="btn btn-primary btn-sm">Afficher</button>
          <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
        </div>








                <?php echo $this->Form->end(); ?>

            </div>
        </div>
    </div>
</section> -->


<section class="content-header">
  
    <h1>
        Caisses
    </h1>
</section>
<section class="content" style="width: 99%">
    <div class="box">
        <div class="box-header">
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
        <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col"><?= h('Nom') ?></th>
                        <th scope="col"><?= h('Date') ?></th>
                        <th scope="col"><?= h('Montant') ?></th>
                        <th scope="col"><?php  ?></th>




                    </tr>
                </thead>
                <tbody>
                    <?php $i=0;
                    foreach ($caisses as $caisse) : ?>
                        <tr>
                        <td >
                <?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id' . $i, 'value' => $caisse->id, 'label' => '', 'champ' => 'id','type'=>'hidden', 'class' => 'form-control']); ?>

                        
                        <?= h($caisse->name) ?></td>
                        <td ><?php echo $this->Time->format($caisse->date ,'dd/MM/y HH:mm:ss'); ?></td>
                        <td > <?= h($caisse->montant) ?></td>



                            <td class="actions text" style="text-align:center">
                                <?php echo $this->Html->link("<button index= '".$i."' id='view".$i."' class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $caisse->id), array('escape' => false)); ?>
                                <?php //if ($edit == 1) {
                                 echo $this->Html->link("<button index= '".$i."' id='edit".$i."' class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $caisse->id), array('escape' => false)); 
                              //  }?>
                                <?php //if ($delete == 1) {
                             echo $this->Form->postLink("<button index= '".$i."' id='delete".$i."' class='btn btn-xs btn-danger delete'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $caisse->id), array('escape' => false, null), __('Voulez vous vraiment supprimer cette enregistrement # {0}?', $caisse->id)); 
                            // }?>
                            </td>
                        </tr>
                    <?php $i++; endforeach; ?>
                </tbody>
            </table>
        </div>
       
      
    </div>
</section>


<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<?php $this->start('scriptBottom'); ?>
<script>

  
    $(function() {

         
  $(".delete").on("click", function () {
    return confirm("Voulez vous vraiment supprimer cet enregistrement");
  });
        $('#example2').DataTable()
        $('#example1').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': false,
            'info': true,
            'autoWidth': false
        })
    })
</script>
<?php $this->end(); ?>
