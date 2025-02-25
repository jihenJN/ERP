<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->script('hela'); ?>
<?php

use Cake\Datasource\ConnectionManager;
?>

<section class="content-header">
    <header>
        <h1 style="text-align:center;">Facture Comptant</h1>
    </header>
</section>

<?php
$add = "";
$edit = "";
$delete = "";
$view = "";
$session = $this->request->getSession();
$abrv = $session->read('abrvv');
$lien = $session->read('lien_vente' . $abrv);
//debug($lien);die;
foreach ($lien as $k => $liens) {
    if (@$liens['lien'] == 'bonlivraisons') {
        $add = $liens['ajout'];
        $edit = $liens['modif'];
        $delete = $liens['supp'];
        $imp = $liens['imprimer'];
    }
    //debug($liens);die;
}

// if ($add == 1) { 
?>
<div class="pull-left" style="margin-left:25px;margin-top: 20px">
    <?php echo $this->Html->link(__('Ajouter'), ['action' => 'addf/2'], ['class' => 'btn btn-success btn-sm']) ?>
</div>
<?php //} 
?>
<br><br>


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

            <?php echo $this->Form->create($factureclients, ['id' => 'searchForm', 'type' => 'get']); ?>
            <div class="row">


                <div class="col-xs-2">
                    <label class="control-label" for="name">Date début
                    </label>
                    <?php
                    echo $this->Form->input('datedebut', array('required' => 'off', 'label' => 'Date début', 'value' => $this->request->getQuery('datedebut'), 'id' => 'datedebut', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'date'));
                    ?>
                </div>


                <div class="col-xs-2">
                    <label class="control-label" for="name">Date fin
                    </label>
                    <?php
                    echo $this->Form->input('datefin', array('required' => 'off', 'label' => 'Date fin', 'value' => $this->request->getQuery('datefin'), 'id' => 'datefin', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'date'));
                    ?>

                </div>



                <div class="col-xs-2">


                    <label class="control-label" for="name">Code Client
                    </label>
                    <select class="form-control select2" id="idclient" name="client_id">
                        <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                        <?php foreach ($clients as $id => $client) {
                        ?>

                            <option <?php if ($this->request->getQuery('client_id') == $client->id) echo 'selected="selected"' ?> value="<?php echo $client->id; ?>"><?php
                                                                                                                                                                        echo $client->Code ?></option>
                        <?php } ?>
                    </select>
                </div>


                <div class="col-xs-2">


                    <label class="control-label" for="name">Nom Client
                    </label>
                    <select class="form-control select2" id="idclient1" name="client_id1">
                        <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                        <?php foreach ($clients as $id => $client) {
                        ?>

                            <option <?php if ($this->request->getQuery('client_id') == $client->id) echo 'selected="selected"' ?> value="<?php echo $client->id; ?>"><?php
                                                                                                                                                                        echo $client->Raison_Sociale ?></option>
                        <?php } ?>
                    </select>
                </div>








                <div class="col-xs-2">
                    <label class="control-label" for="name">Numéro début
                    </label>
                    <?php
                    echo $this->Form->input('numdeb', array('required' => 'off', 'label' => 'Numero', 'value' => $this->request->getQuery('numdeb'), 'id' => 'num1', 'class' => 'form-control '));
                    ?>

                </div>
                <div class="col-xs-2">
                    <label class="control-label" for="name">Numéro Fin
                    </label>
                    <?php
                    echo $this->Form->input('numfin', array('required' => 'off', 'label' => 'Numero', 'value' => $this->request->getQuery('numfin'), 'id' => 'num', 'class' => 'form-control '));
                    ?>

                </div>

                <?php //if ($type == 1) { 
                ?>
                <div class="col-xs-2">
                    <?php
                    echo $this->Form->control('reglee', ['label' => 'Réglée ', 'options' => $regle, 'id' => 'reglee', 'value' => $this->request->getQuery('reglee'), 'class' => ' form-control select2', 'empty' => 'choisir !!']); ?>
                </div>

                <?php  //} 
                ?>
                <div class="col-xs-1">
                    <button type="submit" style="margin-top: 25px;" class="btn btn-default custom-width-button">
                        <i class="fa fa-search"></i>
                    </button>

                </div>
                <?php if ($count != 0) { ?>
                    <div class="col-xs-1">

                        <button onclick="openWindow(1000, 1000, wr+'factureclients/imprimelistefactureclientf?datedebut=<?php echo @$datedebut; ?>&datefin=<?php echo @$datefin; ?>&client_id=<?php echo @$client_id; ?>&numdeb=<?php echo @$numdeb; ?>&numfin=<?php echo @$numfin; ?>&reglee=<?php echo @$reglee; ?>')" class="btn btn-primary" style="margin-top: 25px;">
                            <i class="fa fa-print"></i>
                        </button>
                    </div>
                <?php } ?>
                <!-- <div class="col-xs-1">
                <a onClick="openWindow(1000, 1000, wr+'factureclients/imprimelistefactureclient?datedebut=<?php echo @$datedebut; ?>&datefin=<?php echo @$datefin; ?>&client_id=<?php echo @$client_id; ?>&numdeb=<?php echo @$numdeb; ?>&numfin=<?php echo @$numfin;
                                                                                                                                                                                                                                                                            ?>')" class="btn btn-primary">Imprimer recherche</a>



                </div> -->
                <div class="col-xs-1" style="text-align: center; margin-top: 25px;">
                    <?php echo $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-default btn-large fa fa-remove', 'style' => 'width: 37px; height: 35px; display: flex; justify-content: center; align-items: center;']) ?>
                </div>

                <?php echo $this->Form->end(); ?>
            </div>

        </div>


    </div>
    <br>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Facture</h3>
                </div>
                <div class="box-body">
                    <table width="100%" id="example2" class="table table-bordered table-striped">

                        <!-- <table id="example1" class="table-fixed table table-bordered table-striped" style=' display: block;overflow-x: auto;white-space: nowrap;height:500px'> -->
                        <thead style='position: sticky;top: 0; background-color: #3c8dbc;'>

                            <tr style="font-size: 16px;">


                                <th>Numero</th>
                                <th>Date</th>
                                <th>Client</th>
                                <th>Personnel</th>

                                <th hidden>Dépot</th>
                                <th>Net à payer</th>
                                <th hidden> Etat </th>

                                <th> Avoir</th>

                                <th> Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($factureclients as $i => $facture) :
                                // debug($facture);
                                //'value'=>sprintf("%01.3f",$factureclient->totalttc+$timbre * 1000)
                                //debug($timbre);
                                $connection = ConnectionManager::get('default');
                                $factureclient_id = $facture->id;
                                if ($facture->user_id != null) {
                                    $uu = $connection->execute('SELECT * FROM personnels WHERE personnels.id = ' . $facture->user->personnel_id . ';')->fetchAll('assoc');

                                    //  debug($bonlivraison->user->personnel_id);
                                }
                                if ($uu) {
                                    $mm = $uu[0]['code'] . '' . $uu[0]['nom'];
                                } else {
                                    $mm;
                                }

                                $testblregle = $connection->execute('SELECT factureclient_id FROM factureclients 
                                INNER JOIN lignereglementclients ON lignereglementclients.factureclient_id = factureclients.id 
                               WHERE factureclients.id = ?', [$factureclient_id])->fetchAll('assoc');

                                $testregler = (!empty($testblregle)) ? 1 : 0;



                                /*****************************************************************/

                                $connection = ConnectionManager::get('default');
                                $id = $facture->id;

                                $commandeTotQte = 0;
                                $BLTotQte = 0;

                                if (!empty($id)) {
                                    $commandeTotQteResult = $connection->execute(
                                        'SELECT SUM(qte) AS sommeqtecmd FROM lignefactureclients WHERE factureclient_id = :factureclient_id',
                                        ['factureclient_id' => $id]
                                    )->fetch('assoc');
                                    $commandeTotQte = !empty($commandeTotQteResult['sommeqtecmd']) ? $commandeTotQteResult['sommeqtecmd'] : 0;
                                }

                                if (!empty($id)) {
                                    $bls = $connection->execute(
                                        'SELECT id FROM factureavoirs WHERE factureclient_id = :factureclient_id',
                                        ['factureclient_id' => $id]
                                    )->fetchAll('assoc');

                                    if (!empty($bls)) {
                                        $blsIds = array_column($bls, 'id');
                                        $blsIdsString = implode(',', $blsIds);

                                        $BLTotQteResult = $connection->execute(
                                            'SELECT SUM(quantite) AS sommeqtebl FROM lignefactureavoirs WHERE factureavoir_id IN (' . $blsIdsString . ')'
                                        )->fetch('assoc');
                                        $BLTotQte = !empty($BLTotQteResult['sommeqtebl']) ? $BLTotQteResult['sommeqtebl'] : 0;
                                    }
                                }

                            ?>
                                <tr style="font-size: 16px;">

                                    <td><?= h($facture->numero) ?></td>
                                    <td><?=
                                        $this->Time->format(
                                            $facture->date,
                                            'dd/MM/y'
                                        );
                                        ?>
                                    </td>
                                    <td><?= $facture->client->Code . ' ' . h($facture->client->Raison_Sociale) ?></td>
                                    <td><?php echo  $mm; ?></td>

                                    <td hidden><?= h($facture->depot->name) ?></td>

                                    <td><?= h(sprintf("%01.3f", $facture->totalttc)) ?></td>
                                    <td width="14%" align="center" hidden>
                                        <?php
                                        if ($BLTotQte > 0 && $BLTotQte == $commandeTotQte) {
                                            echo '<button class="btn btn-sm custom-button" style="background-color: #54A74D; color: white;">Livré</button>';
                                        } elseif ($BLTotQte == 0) {
                                            echo '<button class="btn btn-sm custom-button" style="background-color: #F55C43; color: white;">En cours</button>';
                                        } elseif ($BLTotQte > 0 && $BLTotQte < $commandeTotQte) {
                                            echo '<button class="btn btn-sm custom-button" style="background-color: #F99048; color: white;">Livré Partiel</button>';
                                        } else {
                                            echo '<button class="btn btn-sm custom-button" style="background-color: #F55C43; color: white;">En cours</button>';
                                        }
                                        ?>
                                    </td>

                                    <td align="center">
                                        <?php
                                        if ($BLTotQte != $commandeTotQte) { ?>
                                            <!-- <button
                                                class="btn btn-xs btn-dark"
                                                style="background-color: black;"
                                                onclick="window.open('<?= $this->Url->build(['controller' => 'Factureavoirs', 'action' => 'addfacavoir', $facture->id]) ?>', '_blank');">
                                                <i class="fa fa-plus" style="color: white;"></i>
                                            </button> -->

                                        <?php echo $this->Html->link(
                                                "<button class='btn btn-xs btn-dark' style='background-color: black;'><i class='fa fa-plus' style='color:white;'></i></button>",
                                                ['controller' => 'Factureavoirs', 'action' => 'addfacavoir', $facture->id],
                                                ['escape' => false]
                                            );
                                        }
                                        ?>
                                    </td>


                                    <td>
                                        <input index="<?php echo $i ?>" type="hidden" value="<?php echo $factureclient_id ?>" id="factureclient_id<?php echo $i ?>" />



                                        <?php if ($imp == 1) { ?>
                                            <?php echo $this->Html->Link(
                                                "<button class='btn btn-xs' style='background-color: #800080; color: white; border: 1px solid #800080;'>
                                                       <i class='fa fa-print'></i>
                                                                 </button>",
                                                array('action' => 'imprimeviewsmbm', $facture->id),
                                                array('escape' => false)
                                            ); ?>


                                            <!-- <a onclick="openWindow(1000, 1000, wr+'Factureclients/imprimeviewf/<?php echo $facture->id; ?>')"><button class='btn btn-xs btn-warning' style='background-color: #cb4154; color: white; border: 1px solid #cb4154;'><i class='fa fa-print'></i>PDF</button></a> -->

                                         

                                        <?php } ?>

                                        <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'viewf', $facture->id), array('escape' => false)); ?>
                                        <?php if ($edit == 1  && $testregler == 0 && $BLTotQte == 0) {
                                            echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'editf', $facture->id), array('escape' => false));
                                        } ?>
                                        <?php if ($delete == 1  && $testregler == 0 && $BLTotQte == 0) {
                                            echo $this->Form->postLink("<button class='deleteConfirm btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button>", array('action' => 'deletef', $facture->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $facture->id));
                                        } ?>

                                    </td>
                                </tr>


                                <input type="hidden" value="<?php echo $i; ?>" id="index" />
                            <?php endforeach; ?>
                        </tbody>

                    </table>

                    <table>


                        <?php if ($this->request->getQuery('datedebut') != '' && $this->request->getQuery('datefin') != '') : ?>
                            <button id="printAllButton" class="btn btn-xs btn-primary"><i class="fa fa-print"></i> Imprimer Tout</button>
                        <?php endif; ?>

                        <tr>
                            <td align="center">

                                <div class="col-md-12  testcheck" style="display:none;">
                                    <input type="hidden" name="tes" value="0" class="tespv" />
                                    <input type="hidden" name="tes" value="0" class="tes" />
                                    <input type="hidden" name="nombre" value="<?php echo @$i; ?>" class="nombre" />
                                    <a class="btn btn btn-danger btnbl" id="facture"> <i class="fa fa-plus-circle"></i> Créer facture </a>
                                </div>

                            </td>

                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>



<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>

<?php $this->start('scriptBottom'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sélectionner les éléments du formulaire et initialiser Select2
        const numeroInput = document.querySelector('input[name="numero"]');
        const datedebutInput = document.getElementById('datedebut');
        const datefinInput = document.getElementById('datefin');
        const clientcIdSelect = $('#idclient');
        const clientnIdSelect = $('#idclient1');
        const etatlivv = document.getElementById('reglee');
        const numdebb = document.querySelector('input[name="numdeb"]');
        const numfinn = document.querySelector('input[name="numfin"]');
        const searchForm = document.getElementById('searchForm');

        console.log('DOM entièrement chargé');

        // Initialiser Select2 sur les dropdowns
        clientcIdSelect.select2();
        clientnIdSelect.select2();

        // Fonction pour soumettre le formulaire
        function submitForm() {
            searchForm.submit();
        }

        // Écouteur d'événements pour les changements sur les dropdowns clients
        clientcIdSelect.on('change', function() {
            clientnIdSelect.val(clientcIdSelect.val()).trigger('change.select2');
        });

        clientnIdSelect.on('change', function() {
            clientcIdSelect.val(clientnIdSelect.val()).trigger('change.select2');
        });

        // Écouteur d'événements pour soumettre le formulaire lors de la pression sur Entrée
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                const activeElement = document.activeElement;

                // Vérifier si l'élément actif est l'un des éléments spécifiés ou un champ Select2
                if (
                    activeElement === numeroInput ||
                    activeElement === datedebutInput ||
                    activeElement === datefinInput ||
                    activeElement === numdebb ||
                    activeElement === numfinn ||
                    activeElement === etatlivv ||
                    $(activeElement).hasClass('select2-search__field') || // Champ de recherche Select2
                    $(activeElement).closest('.select2-container').length // Conteneur Select2
                ) {
                    return; // Permettre le comportement par défaut si le focus est sur ces éléments
                }

                // Empêcher le comportement par défaut de la touche Entrée et soumettre le formulaire
                e.preventDefault();
                submitForm();
            }
        });
    });
</script>
<script>
    $('.urlimprimeview').on('click', function() {
        index = $(this).attr("index");
        // alert(index)

        facture_id = $("#factureclient_id" + index).val();
        var currentUrl = window.location.href;
        var parentUrl = currentUrl.split('/').slice(0, -2).join('/');
        var link = parentUrl + "/ERP/Factureclients/imprimeviewb/" + facture_id;
        // alert(link);
        openWindow(1000, 1000, link);
    });

    function openWindow(width, height, url) {
        var left = (screen.width - width) / 2;
        var top = (screen.height - height) / 2;
        window.open(url, '_blank', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=' + width + ',height=' + height + ',top=' + top + ',left=' + left);
    }
    $(document).ready(function() {

        $('#idclient1').change(function() {
            var selectedcodename = $(this).val();
            $("#idclient").select2('destroy');
            $("#idclient").val(selectedcodename);
            $("#idclient").select2();

        });
        $('#idclient').change(function() {
            var selectedcodename = $(this).val();
            $("#idclient1").select2('destroy');
            $("#idclient1").val(selectedcodename);
            $("#idclient1").select2();

        });
    });


    $(document).ready(function() {
        $('#printAllButton').click(function() {
            var factureIds = [];
            <?php foreach ($factureclients as $facture) : ?>
                factureIds.push(<?php echo $facture->id; ?>);
            <?php endforeach; ?>

            // if (factureIds.length > 0) {
            var printURL = wr + 'Factureclients/imprimeviewall/' + factureIds.join(',');
            window.open(printURL, '_blank');
            //}
        });
    });


   
</script>

<script>
    function openWindow(h, w, url) {
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }
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