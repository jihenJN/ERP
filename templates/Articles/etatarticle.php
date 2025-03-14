<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php

use Cake\Datasource\ConnectionManager;

?>
<?php echo $this->Html->css('select2'); ?>
<section class="content-header">
    <header>
        <h1 style="text-align:center;">Articles sans achat</h1>
    </header>
</section>
<?php
$connection = ConnectionManager::get('default');

$add = "";
$edit = "";
$delete = "";
$view = "";
$session = $this->request->getSession();
$abrv = $session->read('abrvv');
$lien = $session->read('lien_clients' . $abrv);
//debug($lien);die;
foreach ($lien as $k => $liens) {
    if (@$liens['lien'] == 'clients') {
        $add = $liens['ajout'];
        $edit = $liens['modif'];
        $delete = $liens['supp'];
    }
    //debug($liens);die;
}

?>



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

            <?php echo $this->Form->create($articles, ['type' => 'get']); ?>
            <div class="row">


                <div class="col-xs-6">
                    <?php echo $this->Form->control('client_id', ['class' => 'form-control select2', 'label' => 'Client', 'value' => $this->request->getQuery('client_id'), 'empty' => 'Veuillez choisir !!', 'name', 'required' => 'off']); ?>
                </div>


                <div class="col-xs-6">
                    <?php echo $this->Form->control('article_id', ['class' => 'form-control select2', 'options' => $vv, 'label' => 'Article', 'value' => $this->request->getQuery('article_id'), 'empty' => 'Veuillez choisir !!', 'name', 'required' => 'off']); ?>
                </div>

                <div class="col-xs-6">
                    <?php echo $this->Form->control('commercial_id', ['class' => 'form-control select2', 'label' => 'Commercial', 'value' => $this->request->getQuery('commercial_id'), 'empty' => 'Veuillez choisir !!', 'name', 'required' => 'off']); ?>
                </div>


                <div class="col-xs-6">
                    <?php echo $this->Form->control('gouvernorat_id', ['class' => 'form-control select2', 'label' => 'Gouvernorat', 'value' => $this->request->getQuery('gouvernorat_id'), 'empty' => 'Veuillez choisir !!', 'name', 'required' => 'off']); ?>
                </div>

                <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
                    <button type="submit" class="btn btn-primary btn-sm">Afficher</button>
                    <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'etatarticle'], ['class' => 'btn btn-primary btn-sm']) ?>
                </div>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>


        <br><br><br><br><br>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th><?php echo ('Client'); ?></th>
                                        <th><?php echo ('Article'); ?></th>
                                        <th><?php echo ('Commercial'); ?></th>
                                        <th><?php echo ('Gouvernorat'); ?></th>
                                        <th><?php echo ('Nb jours sans achat actuel'); ?></th>
                                        <th><?php echo ('Max Nb jours sans achat'); ?></th>
                                        <th><?php echo ('Vue'); ?></th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php



                                    foreach ($articleNotificationsQuery as $i => $art) :

                                        if($art['client_id']==null){
                                            $art['client_id']=0;
                                           }
                                        $vue = $connection->execute("SELECT * FROM alertvues WHERE article_id=" . $art['id'] . " AND client_id=" . $art['client_id'] . " ")->fetchAll('assoc');

                                        if ($art['max_date']) {
                                            $maxDate = new \Cake\I18n\FrozenDate($art['max_date']);
                                            $today = new \Cake\I18n\FrozenDate();
                                            $dateDiff = $maxDate->diff($today)->format('%a');
                                            if ($vue != []) {
                                                $datevue = new \Cake\I18n\FrozenDate($vue[0]['date_time']);

                                                $dateDiffvue = $datevue->diff($today)->format('%a');
                                                if ($dateDiffvue >  $art['nbjoursarticlenonacheter']) {
                                                    $date = date("Y-m-d h:i:s");
                                                    $vueqq = $connection->execute("UPDATE alertvues SET vue=0, date_time='$date' WHERE id=" . $vue[0]['id'] . "")->fetchAll('assoc');
                                                } if ($dateDiff < $art['nbjoursarticlenonacheter']) {
                                                    $date = date("Y-m-d h:i:s");
                                                    $vueqq = $connection->execute("UPDATE alertvues SET vue=1, date_time='$date' WHERE id=" . $vue[0]['id'] . "")->fetchAll('assoc');
                                               
                                                }
                                            }
                                            if ($dateDiff > $art['nbjoursarticlenonacheter']) {
                                                /// debug($client);

                                    ?>
                                                    <tr>
                                                        <td>





                                                            <?php echo ($art['codeclient'] . ' ' . $art['client_name']); ?>&nbsp;</td>

                                                        <td> <?php echo ($art['Code'] . ' ' . $art['Dsignation']); ?>&nbsp;</td>

                                                        <td> <?php echo $art['commercial']; ?>&nbsp;</td>


                                                        <td> <?php echo $art['gouvernorat']; ?>&nbsp;</td>


                                                        <td><?php echo $dateDiff ?>&nbsp;</td>

                                                        <td><?php echo h($art['nbjoursarticlenonacheter']); ?>&nbsp;</td>
                                                       
                                                        <td><?php  if ($vue == [] || $vue[0]['vue'] == 0) { echo $this->Form->postLink("<i class='fa fa-eye'></i>", array('action' => 'vuearticle', $art['id'], $art['client_id']), array('escape' => false));} ?>
                                                            &nbsp;</td>


                                                    </tr>
                                    <?php  
                                            }
                                        }
                                    endforeach;

                                    ?>






                                </tbody>
                            </table>
                            <input type="hidden" value="<?php echo $i ?>" id="index">

                            <table>

                                <tr>
                                    <td align="center">

                                        <div class="col-md-12  testcheck" style="display:none;">
                                            <input type="hidden" name="tes" value="0" class="tespv" />
                                            <input type="hidden" name="tes" value="0" class="tes" />
                                            <input type="hidden" name="nombre" value="<?php echo @$i; ?>" class="nombre" />
                                            <a class="btn btn btn-danger btnbl" id="bonliv"> <i class="fa fa-plus-circle"></i> Créer un bon de transferts </a>
                                        </div>

                                    </td>

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
            $(function() {
                $('.verifiercmd').on('click', function() {
                    // alert('hello');
                    ind = $(this).attr('index');
                    //  alert(ind);
                    id = $('#id' + ind).val();
                    //alert(id);
                    //  alert(id)
                    $.ajax({
                        method: "GET",
                        url: "<?= $this->Url->build(['controller' => 'Clients', 'action' => 'getclientscmd']) ?>",
                        dataType: "json",
                        data: {
                            idfam: id,
                        },
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                        },
                        success: function(data) {
                            //   $('#pays').html(data.pays);
                            //  alert(data.pays);
                            if (data.query != 0) {
                                alert('existe');
                            } else {
                                if (confirm('voulez vs vraiment supp cet enreg')) {
                                    //   alert('ok supp');
                                    document.location = "https://codifaerp.isofterp.com/demo/clients/delete/" + id;
                                }
                            }
                        }
                    })
                });
            });
        </script>







        <script type="text/javascript">
            $(function() {
                $('.verifiercmd').on('click', function() {

                    //    index = $('#index').val();
                    //      ind = $(this).attr('index');

                    ind = $(this).attr('index');
                    //alert(ind);


                    id = $('#id' + ind).val();
                    //alert(id);
                    // $('#gouv').val((id));

                    $.ajax({
                        method: "GET",
                        url: "<?= $this->Url->build(['controller' => 'Clients', 'action' => 'getclientscmd']) ?>",
                        dataType: "json",
                        data: {
                            idclient: id,

                        },
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                        },
                        success: function(response, status, settings) {




                            if (response.query != 0) {
                                alert("Vous ne pouvez pas supprimer cet enregistrement");

                            } else {
                                if (confirm('Voulez vous vraiment supprimer cet enregistrement')) {
                                    //   alert('ok supp');
                                    document.location = "https://codifaerp.isofterp.com/demo/clients/delete/" + id;
                                }
                            }
                            // $('#bureauposte').val(response.query);
                            // uniform_select('delegation');



                            //$('#adresses').val((id));

                        }
                    })
                });
            });
        </script>