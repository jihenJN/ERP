
<?php echo $this->fetch('script'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('salma'); ?>

<?php
$add = "";
$edit = "";
$delete = "";
$view = "";
$session = $this->request->getSession();
$abrv = $session->read('abrvv');
$lien = $session->read('lien_clients' . $abrv);
//debug($lien);die;
foreach ($lien as $k => $liens) {
  if (@$liens['lien'] == 'typeclients') {
    $add = $liens['ajout'];
    $edit = $liens['modif'];
    $delete = $liens['supp'];
  }
  //debug($liens);die;
}

if ($add == 1) { ?>
  <div class="pull-left" style="margin-left:25px;margin-top: 20px">
  <?php echo $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
</div>
<br> <br><br>
<?php  } ?>
<br>
<section class="content-header">
  <h1>
    Type clients
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
                <th  align="center" class="actions text-center"><?php echo ('Type'); ?></th>
                <th  align="center" class="actions text-center"><?php echo ('Grand surface'); ?></th>
                <th width="30%" scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($typeclients as $i=>$typeclient) : ?>
                <tr>
                <td hidden><?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id' . $i, 'value' => $typeclient->id, 'label' => '', 'champ' => 'id', 'class' => 'form-control']); ?></td>
                  <td align="center"><?= h($typeclient->type) ?></td>
                  <?php if($typeclient->grandsurface == 1){ ?>
                  <td align="center">oui</td>
                  <?php }else{ ?>
                    <td align="center">non</td>
                  <?php } ?>
                  <td class="actions text" align="center">
                    <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $typeclient->id), array('escape' => false)); ?>
                    <?php if ($edit == 1) {
                      echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $typeclient->id), array('escape' => false));
                    } ?>
                    <?php if ($delete == 1) {
                      echo $this->form->postLink("<button index='".$i ."' class='verifiercmd btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button>",array('action' => ''), array('escape' => false,null));
                    } ?>
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

<script>
  $(function() {
    $('.verifiercmd').on('click', function() {
      //alert('hello');
      ind = $(this).attr('index');
      //alert(ind);
      id = $('#id' + ind).val();
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Typeclients', 'action' => 'verif']) ?>",
        dataType: "json",
        data: {
          id: id,
        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data) {
          //alert('hello');
          if (data.Typeclients!= 0) { 
            alert('Exist');
           
          } else {
            if (confirm('Voulez vous supprimer cet enregistrement ?')) {
              //   alert('ok supp');
              document.location = "/demo/Typeclients/delete/"+ id;
            }
          }
        }
      })
    });
  });
</script>