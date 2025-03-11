<?php

use Cake\Datasource\ConnectionManager; ?>
<section class="content-header">
    <header>
        <h1 style="text-align:center;"> Demandes offres de prix</h1>
    </header>
</section>
<script>
    function openWindow(h, w, url) {
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');

    }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('controle_frs'); ?>
<?php echo $this->Html->script('hela'); ?>
<?php
$add = "";
$edit = "";
$delete = "";
$view = "";
$session = $this->request->getSession();
$abrv = $session->read('abrvv');
$lien = $session->read('lien_achat' . $abrv);
// debug($lien);die;
foreach ($lien as $k => $liens) {
    if (@$liens['lien'] == 'demandeoffredeprixes') {
        $add = $liens['ajout'];
        $edit = $liens['modif'];
        $delete = $liens['supp'];
        $valide = $liens['valide'];
        $imp = $liens['imprimer'];
    }
    //debug($liens);die;
}


?>
<?php if ($add = 1) {  ?>
    <div class="pull-left" style="margin-left:25px;margin-top: 20px">
        <?php echo $this->Html->link(__('Ajouter'), ['action' => 'add/' . $typeof], ['class' => 'btn btn-success btn-sm']) ?>
    </div>
<?php }  ?>
<br> <br><br>
<section class="content-header">
    <h1>
        Recherche
    </h1>
</section>
<section class="content">
    <div class="box">

        <div class="box-header">
        </div>
        <div class="box-body">
            <div class="row">


                <?php
                echo $this->Form->create($recherches, ['id' => 'submitForm', 'type' => 'get', 'onkeypress' => "return event.keyCode!=13"]);
                ?>

                <div class="col-xs-3">
                    <?php
                    echo $this->Form->control('datedebut', array('label' => 'Date debut', 'value' => $this->request->getQuery('datedebut'), 'id' => 'datedebut', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'date'));
                    ?>
                </div>
                <div class="col-xs-3">
                    <?php
                    echo $this->Form->control('datefin', array('label' => 'Date fin', 'value' => $this->request->getQuery('datefin'), 'id' => 'datefin', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'date'));
                    ?>
                </div>


                <div class="col-xs-3">
                    <?php
                    echo $this->Form->control('numero', array('value' => $this->request->getQuery('numero'), 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                    ?>
                </div>


                <div class="col-xs-1">
                    <button type="submit" style="margin-top: 25px;" id="searchButton" class="btn btn-default custom-width-button">
                        <i class="fa fa-search"></i>
                    </button>

                </div>
                <div class="col-xs-1" style="text-align: center; margin-top: 25px;">
                    <?php echo $this->Html->link(__(''), ['action' => 'index/' . $typeof], ['class' => 'btn btn-default btn-large fa fa-remove', 'style' => 'width: 37px; height: 35px; display: flex; justify-content: center; align-items: center;']) ?>
                </div>

                <!-- <div class="col-lg-9 col-lg-offset-3" align="center">
                    <button type="submit" class="btn btn-primary">afficher</button>
                    <a href="/ERP/demandeoffredeprixes/index/<?php echo @$typeof; ?>" class="btn btn-primary"> afficher tous</a>
                     <a onclick="openWindow(1000, 1000, '/demo/demandeoffredeprixes/imprimerrecherche/<?php echo @$typeof; ?>?datedebut=<?php echo @$datedebut; ?>&datefin=<?php echo @$datefin; ?>&numero=<?php echo @$numero; ?>')" class="btn btn-primary">Imprimer recherche</a> 
                     </div> -->
                <?php echo $this->Form->end(); ?>


            </div>
        </div>
        <br>
    </div>
    <br>
    <div class="box">

        <div class="box-body">
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr style="background-color: #4DAAA5;">

                        <!-- <th scope="col" class=" text-center"><?= h('Date') ?></th> -->
                        <th scope="col" class=" text-center"><?= h('Date') ?></th>
                        <th scope="col" class=" text-center"><?= h('Numero') ?></th>

                        <th scope="col" class="text-center"><?= h('Consultation') ?></th>
                        <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recherches as $demandeoffredeprix) :
                        $id_demande = $demandeoffredeprix['id'];
                        $connection = ConnectionManager::get('default');
                        $lignedemandeoffredeprix = $connection->execute("SELECT * FROM lignedemandeoffredeprixes WHERE lignedemandeoffredeprixes.demandeoffredeprix_id = $id_demande GROUP BY lignedemandeoffredeprixes.nameF;")->fetchAll('assoc'); ?>
                        <tr>
                            <!-- <td><?= h($demandeoffredeprix->date) ?></td> -->
                            <td><?=
                                $this->Time->format(
                                    $demandeoffredeprix->date,
                                    'dd/MM/y'
                                );


                                ?>
                            </td>

                            <td><?= h($demandeoffredeprix->numero) ?></td>




                            <td align="center">
                                <?php
                                if ($demandeoffredeprix['consultation'] == 0 && $demandeoffredeprix['commande'] == 0) {
                                    echo $this->Html->link("<button class='btn btn-xs btn-info'><i class='fa fa-eye'></i></button>", array('action' => 'bandeconsultation', $typeof, $demandeoffredeprix->id), array('escape' => false));
                                } elseif ($demandeoffredeprix['consultation'] == 1 && $demandeoffredeprix['commande'] == 0) {
                                    echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-check'></i></button>", array('action' => 'etatcomparatif', $typeof, $demandeoffredeprix->id), array('escape' => false));
                                }
                                ?>
                            </td>









                            <td align="center">
                                <?php
                                // if ($demandeoffredeprix['consultation'] == 1) {
                                //     echo $this->Html->link("<button class='btn btn-xs btn-primary'><i class='fa fa-print'></i></button>", array('action' => 'imprimeview', $typeof, $demandeoffredeprix->id), array('escape' => false));
                                // }
                                ?>
                                <?php foreach ($lignedemandeoffredeprix as $ligne) :
                                    $four_id = $ligne['fournisseur_id'];
                                    $four_name = $ligne['nameF'];
                                    // debug($ligne['fournisseur_id']);
                                ?>

                                    <a onclick='openWindow(1000, 1000, `/ERP/demandeoffredeprixes/imprimeview/<?php echo @$typeof . "/" . @$demandeoffredeprix->id . "/"; ?><?php if (!empty($four_name)) : ?><?php echo $four_name; ?><?php endif; ?>`)' class="btn btn-xs btn-primary">
                                        <i class='fa fa-print'></i>
                                    </a>
                                    <!-- <a onclick="openWindow(1000, 1000, 'http://localhost:8765/demandeoffredeprixes/imprimeview/<?php echo @$typeof, '/', @$demandeoffredeprix->id, '/'; ?><?php echo ($four_name !== null) ? $four_id . '/' . $four_name : $four_id; ?>')"
                                            class="btn btn-xs btn-primary">
                                            <i class='fa fa-print'></i>
                                        </a> -->

                                <?php endforeach; ?>
                                <?php //if ($demandeoffredeprix['consultation'] != 1 && $edit == 1) {
                                // echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-print'></i></button>", array('action' => 'imprimerr', $demandeoffredeprix->id), array('escape' => false));
                                //}
                                if ($demandeoffredeprix['consultation'] == 1) {
                                    //echo $this->Html->link("<button class='btn btn-xs btn-primary'><i class='fa fa-print'></i></button>", array('action' => 'imprimeview', $demandeoffredeprix->id), array('escape' => false));
                                }
                                ?>
                                <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $typeof, $demandeoffredeprix->id), array('escape' => false)); ?>

                                <?php //if ($demandeoffredeprix['consultation']==0)
                                ///  { if ($edit == 1) { 
                                echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $typeof, $demandeoffredeprix->id), array('escape' => false));
                                // } //if ($delete == 1) {
                                ?>
                                <?php
                                $connection = ConnectionManager::get('default');
                                $dem1 =  $connection->execute("
                                 SELECT * FROM commandefournisseurs where commandefournisseurs.demandeoffredeprix_id =" . $demandeoffredeprix->id . ";")->fetchAll('assoc');

                                if (!$dem1) {

                                    echo $this->Form->postLink(
                                        "<button class='deleteConfirm btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button>",
                                        ['action' => 'delete', $typeof, $demandeoffredeprix->id],
                                        ['escape' => false, 'confirm' => __('Veuillez vraiment supprimer cette enregistrement # {0}?', $demandeoffredeprix->id)]
                                    );
                                }
                                ?>




                            </td>







                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</section>




<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-daterangepicker/daterangepicker', ['block' => 'css']); ?>
<!-- bootstrap datepicker -->
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min', ['block' => 'css']); ?>
<!-- iCheck for checkboxes and radio inputs -->
<?php echo $this->Html->css('AdminLTE./plugins/iCheck/all', ['block' => 'css']); ?>
<!-- Bootstrap Color Picker -->
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min', ['block' => 'css']); ?>
<!-- Bootstrap time Picker -->
<?php echo $this->Html->css('AdminLTE./plugins/timepicker/bootstrap-timepicker.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<!-- InputMask -->
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask.date.extensions', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask.extensions', ['block' => 'script']); ?>
<!-- date-range-picker -->
<?php echo $this->Html->script('AdminLTE./bower_components/moment/min/moment.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-daterangepicker/daterangepicker', ['block' => 'script']); ?>
<!-- bootstrap datepicker -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min', ['block' => 'script']); ?>
<!-- bootstrap color picker -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min', ['block' => 'script']); ?>
<!-- bootstrap time picker -->
<?php echo $this->Html->script('AdminLTE./plugins/timepicker/bootstrap-timepicker.min', ['block' => 'script']); ?>
<!-- iCheck 1.0.1 -->
<?php echo $this->Html->script('AdminLTE./plugins/iCheck/icheck.min', ['block' => 'script']); ?>

<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    $(function() {



        $('#example2').DataTable({
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const numeroInput = document.querySelector('input[name="numero"]');
        const datedebutInput = document.getElementById('datedebut');
        const datefinInput = document.getElementById('datefin');
        // const fournisseurIdSelect = document.getElementById('fournisseur_id');
        const searchForm = document.getElementById('searchForm');

        console.log('DOM entièrement chargé');

        if (numeroInput && datedebutInput && datefinInput && searchForm) {
            console.log('Éléments de formulaire trouvés');

            // Fonction pour soumettre le formulaire
            function submitForm() {
                searchForm.submit();
            }

            // Événement pour soumettre le formulaire lorsqu'Entrée est pressé
            searchForm.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && (e.target !== numeroInput || e.target !== datedebutInput || e.target !== datefinInput)) {
                    e.preventDefault();
                    submitForm();
                }
            });

            // Événement pour soumettre le formulaire lorsqu'un changement est apporté au fournisseurIdSelect
            // datedebutInput.addEventListener('change', function() {
            //     submitForm();
            // });
        } else {
            console.log('Éléments de formulaire non trouvés');
        }
    });
</script>
<?php $this->end(); ?>