<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('controle_frs'); ?>
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->css('select2'); ?>
<?php

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
?>

<section class="content-header">
    <header>
        <h1 style="text-align:center;"> Commandes Achats</h1>
    </header>
</section>
<div class="pull-left" style="margin-left:25px;margin-top: 20px">
    <?php echo $this->Html->link(__('Ajouter'), ['action' => 'add/' . $type], ['class' => 'btn btn-success btn-sm']) ?>
</div>
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
            <div class="row">

                <?php echo $this->Form->create($commandes, ['id' => 'searchForm', 'type' => 'get']); ?>
                <div class="col-xs-2">
                    <?php
                    echo $this->Form->control('datedebut', array('label' => 'Date debut', 'value' => $this->request->getQuery('datedebut'), 'id' => 'datedebut', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'date'));
                    ?>
                </div>
                <div class="col-xs-2">
                    <?php
                    echo $this->Form->control('datefin', array('label' => 'Date fin', 'value' => $this->request->getQuery('datefin'), 'id' => 'datefin', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'date'));
                    ?>
                </div>






                <div class="col-xs-3">
                    <div class="form-group input text required">
                        <?php echo $this->Form->control('fournisseur_id', ['options' => $fournisseurs, 'value' => $this->request->getQuery('fournisseur_id'), 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 ', 'id' => 'fournisseur_id', 'required' => 'off']); ?>
                    </div>
                </div>




                <!-- <div class="col-xs-6" hidden>
                    <div class="form-group input text required">
                        <?php echo $this->Form->control('depot_id', ['options' => $depots, 'value' => $this->request->getQuery('depot_id'), 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 ', 'id' => 'depot_id', 'required' => 'off']); ?>
                    </div>
                </div> -->



                <div class="col-xs-2">
                    <?php
                    echo $this->Form->control('numero', array('value' => $this->request->getQuery('numero'), 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control '));
                    ?>
                </div>
                <div class="col-xs-1">
                    <button type="submit" style="margin-top: 25px;" class="btn btn-default custom-width-button">
                        <i class="fa fa-search"></i>
                    </button>

                </div>
                <div class="col-xs-1" style="text-align: center; margin-top: 25px;">
                    <?php echo $this->Html->link(__(''), ['action' => 'index/' . $type], ['class' => 'btn btn-default btn-large fa fa-remove', 'style' => 'width: 37px; height: 35px; display: flex; justify-content: center; align-items: center;']) ?>
                </div>
                <!-- <div class="pull-right" style="margin-right:40%;margin-top: 20px;">
                    <button type="submit" class="btn btn-primary ">Afficher</button>
                    <a href="<?php //echo $this->Url->build(['action' => 'index/'.$type]); 
                                ?>" class="btn btn-primary"> Afficher tous</a>
                </div> -->







                <?php echo $this->Form->end(); ?>
            </div>
        </div>
        <br>

    </div>
    <div class="box">
        <div class="box-header">
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr style="background-color: #4DAAA5;">
                        <!--                <th scope="col"><?= h('id') ?></th>-->
                        <th scope="col"><?= h('Numero') ?></th>
                        <th scope="col"><?= h('Date') ?></th>
                        <th scope="col"><?= h('Fournisseur') ?></th>



                        <!-- <th scope="col"><?= h('Depot') ?></th> -->
                        <th scope="col"><?= h('Total TTC') ?></th>
                        <th scope="col"><?= h('Validation') ?></th>
                        <th scope="col"><?= h('Bon livraison') ?></th>
                        <th scope="col"><?= h('Envoi mail') ?></th>

                        <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    <?php
                    foreach ($commandes as $i => $commande) :


                        $connection = ConnectionManager::get('default');
                        $lignecommandes =  $connection->execute("
                         SELECT * FROM lignecommandefournisseurs where lignecommandefournisseurs.commandefournisseur_id =" . $commande['id'] . ";")->fetchAll('assoc');
                        //  debug($lignecommandes);
                        $test = 1;
                        foreach ($lignecommandes as $j => $ligne) {
                            // debug($ligne);
                            $totalqteliv = [];
                            $totalqtebc = [];
                            if ($ligne['id'] != null) {
                                $totalqteliv =  $connection->execute("
                           SELECT SUM(qteliv) AS total_qteliv
                           FROM lignelivraisons where lignelivraisons.lignecommandefournisseur_id =" . $ligne['id'] . ";")->fetchAll('assoc');
                            }
                            // debug($commande->numero);
                            // debug($totalqteliv[0]['total_qteliv']);
                            if ($ligne['id'] != null) {
                                $totalqtebc =  $connection->execute("
                           SELECT SUM(qte) AS total_qtebc
                           FROM lignecommandefournisseurs where lignecommandefournisseurs.id =" . $ligne['id'] . ";")->fetchAll('assoc');
                            }

                            // debug($totalqtebc[0]['total_qtebc']);
                            if ($totalqtebc[0]['total_qtebc'] - $totalqteliv[0]['total_qteliv'] > 0) {
                                $test = 0;
                            }
                            // debug($test);

                            // echo '----------------';
                        }


                        //debug($commande);
                    ?>
                        <?php ?>
                        <tr>
                            <!--                 <td><?php /*
      if (isset($commande->id))
      {
      echo  h($commande->id);} */ ?>
                          
                          
                          </td>-->

                            <td><?php
                                if (isset($commande->numero)) {
                                    echo h($commande->numero);
                                }
                                ?>
                            </td>

                            <td><?php
                                if (isset($commande->date)) {
                                    echo $this->Time->format(
                                        $commande->date,
                                        'dd/MM/Y'
                                    );
                                }
                                ?>

                            </td>










                            <td><?php
                                if (isset($commande->fournisseur_id)) {
                                    echo h($commande->fournisseur->name);
                                }
                                ?>


                            </td>





                            <!-- 
                            <td><?php
                                if (isset($commande->depot_id)) {
                                    echo h($commande->depot->name);
                                }
                                ?>


                            </td> -->




                            <td><?php
                                if (isset($commande->ttc)) {
                                    echo h($commande->ttc);
                                }
                                ?>


                            </td>















                            <td align="center">
                                <?php
                                if ($commande['valide'] == 0) {

                                    echo $this->Html->link("<button class='btn btn-xs btn-info'><i class='fa fa-check'></i></button>", array('action' => 'validation', $commande['id'], $type), array('escape' => false));
                                }
                                ?>


                            </td>



                            <td align="center">

                                <?php
                                // $test=0;
                                // $Lignecommandefournisseurs = TableRegistry::getTableLocator()->get('Lignecommandefournisseurs');

                                // $lignes = $Lignecommandefournisseurs->find('all', [
                                //     'contain' => ['Articles']
                                // ])
                                //     ->where(['commandefournisseur_id' => $id]);

                                //     foreach ($lignes as $li) {
                                //         if ($li['qte'] < $li['qteliv'])
                                //             $test = 1;
                                //     }
                                //     // debug($test);


                                //echo $commande->valide.'--'.$commande->etatliv ;
                                if ($commande->valide == 1) {
                                    if ($test == 0) {     ?>

                                        <input class="livc" type="checkbox" id="check<?php echo $i; ?>" value="<?php echo $commande['id'] ?>" name="checkbox[]" ligne="<?php echo $i; ?>" />
                                <?php }
                                } ?>







                            </td>
                            <td>
                                <!-- <a href="javascript:void(0);" class="btn btn-xl envoyerbuttonfr"
                                    style="background-color:#A19F9F; border: transparent;color: #fff;margin-right: 10px;"
                                    title='envoyer email' fmail="<?php echo $commande->fournisseur->mail; ?>" namecl="<?php echo $commande->fournisseur->nom; ?>" idcl="<?php echo $commande['fournisseur_id']; ?>">
                                    <i class="fa fa-envelope"></i>
                                </a> -->
                                <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-envelope'></i></button>", array('action' => 'envoyer', $commande->id, $commande->fournisseur_id), array('escape' => false)); ?>
                            </td>
                            <td class="actions text-right" align="center">
                                <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $commande->id), array('escape' => false)); ?>
                                <?php
                                if ($test == 0) {
                                    echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $commande->id, 'type' => 'hidden'), array('escape' => false));
                                }
                                ?>
                                <?php
                                if ($commande['valide'] == 1) {
                                    echo $this->Html->link("<button class='btn btn-xs btn-primary'><i class='fa fa-print'></i></button>", array('action' => 'imprimeview', $commande->id), array('escape' => false));
                                } ?>
                                <?php

                                $connection = ConnectionManager::get('default');
                                $liv1 =  $connection->execute("
                                SELECT * FROM livraisons where livraisons.commandefournisseur_id =" . $commande['id'] . ";")->fetchAll('assoc');

                                if (!$liv1) {
                                    if ($test == 0) {
                                        echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $commande->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $commande->id));
                                    }
                                }
                                ?>

                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <table>
                <input type="hidden" value="<?php echo $i; ?>" id="index" />
                <tr>
                    <td align="center">
                        <?php //if($commande['valide']==1){  
                        ?>
                        <div class="col-md-12  testcheck" style="display:none;">
                            <input type="hidden" name="tes" value="0" class="tespv" />
                            <input type="hidden" name="tes" value="0" class="tes" />
                            <input type="hidden" name="nombre" value="<?php echo @$i; ?>" class="nombre" />
                            <a class="btn btn btn-danger btnbl" id="livraisonadd"> <i class="fa fa-plus-circle"></i> Créer une bon de livraison </a>
                        </div>
                        <?php // }   
                        ?>

                    </td>

                </tr>
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
<?php $this->start('scriptBottom'); ?>
<script>

</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const numeroInput = document.querySelector('input[name="numero"]');
        const datedebutInput = document.getElementById('datedebut'); //alert(datedebutInput)
        const datefinInput = document.getElementById('datefin');
        const fournisseurIdSelect = document.getElementById('fournisseur_id');
        const searchForm = document.getElementById('searchForm');

        console.log('DOM entièrement chargé');

        if (numeroInput && datedebutInput && datefinInput && fournisseurIdSelect && searchForm) {
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
            fournisseurIdSelect.addEventListener('change', function() {
                submitForm();
            });
        } else {
            console.log('Éléments de formulaire non trouvés');
        }
    });
</script>

<script>
    $(function() {
        //Initialize Select2 Elements
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
        //Date range as a button
        $('#daterange-btn').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function(start, end) {
                $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
        )
        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        })
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        })
        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()
        //Timepicker
        $('.timepicker').timepicker({
            showInputs: false
        })
    })
</script>


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
<script>
    $(function() {
        //Initialize Select2 Elements
        // $('.select2').select2()
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
        //Date range as a button
        $('#daterange-btn').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function(start, end) {
                $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
        )
        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        })
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        })
        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()
        //Timepicker
        $('.timepicker').timepicker({
            showInputs: false
        })
    })
</script>









<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<script>
    $(function() {

        $('#example2').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': false,
            'ordering': false,
            'info': true,
            'autoWidth': false
        })
    })
</script>
<?php $this->end(); ?>