<!-- Content Header (Page header) -->
<?php echo $this->Html->script('mahdi'); ?>
<?php echo $this->Html->css('select2'); ?>

<?php echo $this->fetch('script'); ?>
<section class="content-header">
    <header>


        <h1 style="text-align:center;"> Critères d'acceptation </h1>

    </header>
</section>

<?php
$add = "";
$edit = "";
$delete = "";
$view = "";
$session = $this->request->getSession();
$abrv = $session->read('abrvv');
$lien = $session->read('lien_controleq' . $abrv);
// debug($lien);die;
foreach ($lien as $k => $liens) {
    if (@$liens['lien'] == 'criteres') {

        $add = $liens['ajout'];
        $edit = $liens['modif'];
        $delete = $liens['supp'];
    }
    // debug($liens);die;
}
$add = 1;
$edit = 1;
$delete = 1;
$view = 1;


if ($add != 0) {
?>
    <div class="pull-left" style="margin-left:25px;margin-top: 20px">
        <?php echo $this->Html->link(__('Ajouter'), ['action' => 'add/' . $type], ['class' => 'btn btn-success btn-sm']) ?>
    </div>
<?php } ?>

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
            <div class="row">

                <?php echo $this->Form->create($criteres, ['type' => 'get']); ?>


                <div class="col-xs-6">
                    <?php
                    echo $this->Form->input('name', array('label' => 'Nom', 'value' => $this->request->getQuery('name'), 'id' => 'name', 'class' => 'form-control '));
                    ?>
                </div>

                <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
                    <button type="submit" class="btn btn-primary btn-sm">Afficher</button>
                    <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index/' . $type], ['class' => 'btn btn-primary btn-sm']) ?>
                </div>



            </div>







            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</section>
<!-- Main content -->
<section class="content-header">
    <h1>
    Critères 
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">


                    <!-- /.box-header -->
                    <div class="box-body table-responsive ">
                        <table id="example1" class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col"><?= h('Nom') ?></th>
                                    <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0;
                                foreach ($criteres as $critere) :
                                    //debug($emplacements);die;
                                ?>
                                    <tr>
                                        <td><?= h($critere->name) ?></td>


                                        <td align='center' class="actions">
                                        <?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id' . $i, 'value' => $critere->id, 'label' => '', 'champ' => 'id','type'=>'hidden', 'class' => 'form-control']); ?>

                                            <?php echo $this->Html->link("<button index= '" . $i . "' id='view" . $i . "' class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $critere->id), array('escape' => false)); ?>

                                            <?php if ($edit == 1) {
                                                echo $this->Html->link("<button index= '" . $i . "' id='edit" . $i . "' class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $critere->id), array('escape' => false));
                                            } ?>
                                            <?php if ($delete == 1) {   
                                                echo "<button index= '".$i."' id='delete".$i."' class='btn btn-xs btn-danger delete'><i class='fa fa-trash-o'></i></button>";

                                               } 
                                            ?>

                                        </td>
                                    </tr>
                                <?php $i++;
                                endforeach; ?>
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

<script type="text/javascript">
    $(function() {
        $('.delete').on('click', function() {
           
            ind = $(this).attr('index');
            id = $('#id' + ind).val();
          
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Criteres', 'action' => 'verif']) ?>",
                dataType: "json",
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function(data) {
                   
                    if(data.parametrearticles!=0)
                    {
                        alert('Critère déja existe dans un article');
                    }
                    else{
                        if(confirm('Voulez vous vraiment supprimer cet enregistrement'))
                        {
                   
                            window.location= wr+"criteres/delete/"+id;
                        }
                        
                    }
                }
            })
        });
    });
</script>
<script>
    $(function() {
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
    $('.select2').select2()
</script>
<?php $this->end(); ?>