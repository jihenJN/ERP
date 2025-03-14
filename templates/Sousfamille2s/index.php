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
    if (@$liens['lien'] == 'sousousfamille') {
        $add = $liens['ajout'];
        $edit = $liens['modif'];
        $delete = $liens['supp'];
    }
    //debug($liens);die;
}

if ($add == 1) {
    ?>
    <div class="pull-left" style="margin-left:25px;margin-top: 20px">
        <?php echo $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
    </div>
<?php } ?>
<br><br><br>
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

            <?php echo $this->Form->create($sousfamille2s, ['type' => 'get']); ?>
            <div class="row">


                <div class="col-xs-6">
                    <?php echo $this->Form->control('name', ['label' => 'Nom', 'value' => $this->request->getQuery('Name'), 'name', 'required' => 'off']); ?>
                </div>


<!--                <div class="col-xs-6">
                    <div class="form-group input text required">
                        <label class="control-label" for="name">Sous Familles</label>
                        <select class="form-control select2"   name="famille_id" value='<?php $this->request->getQuery('sousfamille1_id') ?>'>
                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                            <?php foreach ($sousfamille1s as $id => $sousfamille1) { ?>
                                <option value="<?php echo $id; ?>" ><?php echo $sousfamille1 ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>-->

                
                
               
              <div class="row">
                <div class="col-xs-6">
                    <?php
                   echo $this->Form->control('famille_id', ['options' => $familles, 'required' => 'off', 'empty' => true, 'label' => 'Famille', 'value' => $this->request->getQuery('famille_id'), 'autocomplete' => 'off', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 control-label famille1']);
                    ?>
                </div>

                <div class="col-xs-6" id="divsous">
                    <?php
                    echo $this->Form->control('sousfamille1_id', ['required' => 'off','label' => 'Sous famille', 'value' => $this->request->getQuery('sousfamille1_id'), 'autocomplete' => 'off', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 control-label']);
                    ?>
                </div>
                </div>
                
             
                <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
                    <button type="submit" class="btn btn-primary btn-sm">Afficher</button>
                    <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>

            </section>

            <h1>
                Sous Sous Familles
            </h1>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="35%" align="center"><?= ('Sous Famille') ?></th>
                                            <th width="35%" align="center"><?= ('Nom') ?></th>
                                            <th width="30%" scope="col" class="actions text-center"><?= __('Actions') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($sousfamille2s as $i => $sousfamille2) : ?>
                                            <tr>
                                                <td hidden >


                                                    <?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id' . $i, 'value' => $sousfamille2->id, 'label' => '', 'champ' => 'id', 'class' => 'form-control']); ?>

                                                </td>
                                                <td align="center"><?= h($sousfamille2->sousfamille1->name) ?></td>
                                                <td align="center"><?= h($sousfamille2->name) ?></td>
                                                <td class="actions text" align="center">
                                                    <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $sousfamille2->id), array('escape' => false)); ?>
                                                    <?php
                                                  if ($edit == 1) {
                                                        echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $sousfamille2->id), array('escape' => false));
                                                 }
                                                    ?>
                                                    <?php if ($delete == 1) { ?>
                    <!--                                    // echo $this->Form->postLink("<button class='deleteConfirm btn btn-xs btn-danger deletecon'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $famille->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $famille->id));-->
                                                        <button index='<?php echo $i ?>' class='verifier btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button>


                                                    <?php } ?>
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


            <script>


                $(function () {
                    $('.verifier').on('click', function () {
                        // alert('hello');
                        ind = $(this).attr('index');
                        //  alert(ind);
                        id = $('#id' + ind).val();
                        //  alert(id);
                        //  alert(id)
                        $.ajax({
                            method: "GET",
                            url: "<?= $this->Url->build(['controller' => 'Sousfamille2s', 'action' => 'verif']) ?>",
                            dataType: "json",
                            data: {
                                idfam: id,
                            },
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                            },
                            success: function (data) {
                                //   $('#pays').html(data.pays);
                                //  alert(data.pays);
                                if (data.familles != 0)
                                {
                                    alert('Vous ne pouvez pas supprimer cet enregistrement');
                                } else {
                                    if (confirm('Voulez-vous vraiment supprimer cet enregistrement?'))
                                    {
                                        //   alert('ok supp');
                                        document.location = "https://codifaerp.isofterp.com/demo/sousfamille2s/delete/" + id;
                                    }
                                }
                            }
                        })
                    });
                });
            </script>


<script>

$(function () {
        $('.famille1').on('change', function () {
            // alert('hello');
            id = $('#famille-id').val();
             //alert(id)
             $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'getsousfamille1']) ?>",
                dataType: "json",
                data: {
                    idfam: id,

                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (data) {
                    // alert(data.vente);
                    $('#divsous').html(data.select);

                    $('#divsoussous').html(data.select1);

                 



                

                }

            })
        });
    });


</script>