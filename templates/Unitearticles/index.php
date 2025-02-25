
<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>


<?php echo $this->Html->script('salma'); ?>

<?php
$add = "";
$edit = "";
$delete = "";
$view = "";
$session = $this->request->getSession();
$abrv = $session->read('abrvv');
$lien = $session->read('lien_articles' . $abrv);
//debug($lien);die;
foreach ($lien as $k => $liens) {
    if (@$liens['lien'] == 'unitearticle') {
        $add = $liens['ajout'];
        $edit = $liens['modif'];
        $delete = $liens['supp'];
    }
    //debug($liens);die;
}
if ($add == 1)
{
    ?>
    <div class="pull-left" style="margin-left:25px;margin-top: 20px">
        <?php echo $this->Html->link(__('Ajouter'), ['action' => 'Add'], ['class' => 'btn btn-success btn-sm']) ?>
    </div>
<?php } ?>
<br><br><br>
<section class="content-header">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

</section>
<h1>
    Article Unites


</h1>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?php echo __(''); ?></h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>

                                <th class=" text-center"><?= h('Nom') ?></th>
                                <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($unitearticles as $i => $unitearticle) : ?>
                            <td hidden > <?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id' . $i, 'value' => $unitearticle->id, 'label' => '', 'champ' => 'id', 'class' => 'form-control']); ?>
                            <td align="center"> <?= h($unitearticle->name) ?></td>
                            <td class="actions text" align="center">
                                <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $unitearticle->id), array('escape' => false)); ?>

                                <?php if ($edit == 1)  {
                                    echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $unitearticle->id), array('escape' => false));
                                }
                                //if ($delete == 1){ 
                                ?>
                                <button index='<?php echo $i ?>' class='verifiercmd btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button>
                                <?php //} ?>
                            </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

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
    $(function () {
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


    $(function() {
    $('.verifiercmd').on('click', function() {
      // alert('hello');
      ind = $(this).attr('index');
      // alert(ind);
      id = $('#id' + ind).val();
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'verif05092']) ?>",
        dataType: "json",
        data: {
          id: id,
        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data, status, settings) {
          //alert(data.Articles);
          if (data.Articles != 0) {
            alert('existe dans un document');
          } else {
            if (confirm('Voulez-vous supprimer cet enregistrement')) {
              alert('ok supp');
              document.location = "https://sirepprefaprod.isofterp.com/ERP/Articles/delete/" + id;
            }
          }
        }
      })
    });
  });

    // $(function () {
    //     $('.verifier').on('click', function () {
    //         // alert('hello');
    //         ind = $(this).attr('index');
    //         //  alert(ind);
    //         id = $('#id' + ind).val();
    //         //   alert(id);
    //         //  alert(id)
    //         $.ajax({
    //             method: "GET",
    //             url: "<?= $this->Url->build(['controller' => 'Unitearticles', 'action' => 'verif']) ?>",
    //             dataType: "json",
    //             data: {
    //                 idfam: id,
    //             },
    //             headers: {
    //                 'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
    //             },
    //             success: function (data) {
    //                 //   $('#pays').html(data.pays);
    //                 //  alert(data.pays);
    //                 if (data.articles != 0)
    //                 {
    //                     alert('Vous ne pouvez pas supprimer cet enregistrement');
    //                 } else {
    //                     if (confirm('Voulez-vous vraiment supprimer cet enregistrement?'))
    //                     {
    //                         //   alert('ok supp');
    //                         document.location = "https://sirepprefaprod.isofterp.com/ERP/unitearticles/delete/" + id;
    //                     }
    //                 }
    //             }
    //         })
    //     });
    // });

</script>
<?php $this->end(); ?>