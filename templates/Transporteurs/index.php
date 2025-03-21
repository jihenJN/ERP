
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('salma'); ?>

<?php echo $this->Html->script('controle_frs'); ?>
<?php echo $this->Html->css('select2'); ?>

<?php echo $this->Html->script('salma'); ?>
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
    if (@$liens['lien'] == 'transporteurs') {
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

            <?php echo $this->Form->create($transporteurs, ['type' => 'get']); ?>
            <div class="row">


                <div class="col-xs-6">
                    <?php echo $this->Form->control('name', ['label' => 'Nom', 'value' => $this->request->getQuery('Name'), 'name', 'required' => 'off']); ?>
                </div>

                <div class="col-xs-6">
                    <?php echo $this->Form->control('matricule', ['label' => 'Matricule', 'value' => $this->request->getQuery('matricule'), 'name', 'required' => 'off']); ?>
                </div>
              

                <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
                    <button type="submit" class="btn btn-primary btn-sm">Afficher</button>
                    <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>

            </section>

            <section class="content-header">
                <h1>
                  Transporteur
                </h1>
            </section>







            <section class="content" style="width: 99%">
                <div class="box">
                    <div class="box-header">

                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <!-- <th width=15% scope="col"><?= ('Code') ?></th> -->

                                        <th width=30% scope="col"><?= ('name') ?></th>
                                        <th width=15% scope="col"><?= ('matricule') ?></th>
                                        <th width=15% scope="col"><?= ('Téléphone') ?></th>
                                        <th scope="col"><?= ('') ?></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($transporteurs as $i => $transporteur) : ?>
                                        <tr>
                                            <td hidden  >


                                                <?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id' . $i, 'value' => $transporteur->id, 'label' => '', 'champ' => 'id', 'class' => 'form-control']); ?>

                                            </td>
                                          
                                            <!-- <td><?= h($transporteur->code) ?></td> -->
                                            <td><?= h($transporteur->name) ?></td>
                                            <td><?= h($transporteur->matricule) ?></td>
                                            <td><?= h($transporteur->tel) ?></td>

                                            <td class="actions text" style="text-align:center">
                                                <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $transporteur->id), array('escape' => false)); ?>
                                                <?php
                                                if ($edit == 1) {
                                                    echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $transporteur->id), array('escape' => false));
                                                }
                                                ?>
                                                <?php if ($delete == 1) { 
                                                          echo $this->Form->postLink("<button class='deleteConfirm btn btn-xs btn-danger deletecon'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $transporteur->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $transporteur->id));


                                               } ?>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
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
                function openWindow(h, w, url) {
                    leftOffset = (screen.width / 2) - w / 2;
                    topOffset = (screen.height / 2) - h / 2;
                    window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
                }
                $(function () {
                    $('#example1').DataTable()
                    $('#example2').DataTable({
                        'paging': true,
                        'lengthChange': false,
                        'searching': false,
                        'ordering': false,
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
                });




            </script>
            <?php $this->end(); ?>