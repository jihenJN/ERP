<?php

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Reglementclient> $reglementclients
 */
?>
<?php

use Cake\Datasource\ConnectionManager;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->css('select2'); ?>
<style>
    .btn-purple {
        background-color: purple;
        color: white;
    }
</style>
<?php if ($type == 1) {
    $add = "";
    $edit = "";
    $delete = "";
    $view = "";
    $session = $this->request->getSession();
    $abrv = $session->read('abrvv');
    $lien = $session->read('lien_vente' . $abrv);
    //debug($lien);die;
    foreach ($lien as $k => $liens) {
        if (@$liens['lien'] == 'reglementclientsbl') {
            $add = $liens['ajout'];
            $edit = $liens['modif'];
            $delete = $liens['supp'];
            $imp = $liens['imprimer'];
        }
        //debug($liens);die;
    }


?>
    <section class="content-header">
        <header>
            <h1 style="text-align:center;">Réglements BL</h1>
        </header>
    </section>
<?php }  ?>


<?php if ($type == 2) {

    $add = "";
    $edit = "";
    $delete = "";
    $view = "";
    $session = $this->request->getSession();
    $abrv = $session->read('abrvv');
    $lien = $session->read('lien_vente' . $abrv);
    //debug($lien);die;
    foreach ($lien as $k => $liens) {
        if (@$liens['lien'] == 'reglementclientsfac') {
            $add = $liens['ajout'];
            $edit = $liens['modif'];
            $delete = $liens['supp'];
            $imp = $liens['imprimer'];
        }
        //debug($liens);die;
    }

?>
    <section class="content-header">
        <header>
            <h1 style="text-align:center;">Réglements Facture </h1>
        </header>
    </section>
<?php } ?>

<!----------------------------------------------------------- type = 2 reglement facture where bl = 0 ---------------------------------------------------------------->

<?php

if ($type == 2) {


?>
    <!-- <div class="pull-left" style="margin-left:25px;margin-top: 20px;display: inline-block">
        <?php echo $this->Html->link(__('Ajouter'), ['action' => 'add/' . $type . '/0/0'], ['class' => 'btn btn-success btn-sm']) ?>
    </div> -->

    <?php if ($add == 1) { ?>
        <div class="pull-left" style="margin-left:25px;margin-top: 20px">
            <?php echo $this->Html->link(__('Ajouter'), ['action' => 'add/' . $type], ['class' => 'btn btn-success btn-sm']) ?>
        </div>
    <?php } ?>

    <!-- <div class="" style="margin-left:25px;margin-top: 20px;display: inline-block">
        <?php echo $this->Html->link(__('Ajout Libre'), ['action' => 'addlibre/' . $type . '/0/0'], ['class' => 'btn btn-success btn-sm']) ?>
    </div> -->


    <br> <br><br>

    <section class="content" style="width: 99%">
        <div class="box">
            <div class="box-header">
            </div>

            <div class="box-body">

                <?php echo $this->Form->create($Reglementclients, ['id' => 'searchForm', 'type' => 'get']); ?>
                <div class="row">


                    <div class="col-xs-2">
                        <label>Date Début</label>
                        <?php
                        echo $this->Form->input('datedebut', array('required' => 'off', 'label' => 'Date début', 'value' => $this->request->getQuery('datedebut'), 'id' => 'datedebut', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'date'));
                        ?>
                    </div>


                    <div class="col-xs-2">
                        <label>Date Fin</label>
                        <?php
                        echo $this->Form->input('datefin', array('required' => 'off', 'label' => 'Date fin', 'value' => $this->request->getQuery('datefin'), 'id' => 'datefin', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'date'));
                        ?>

                    </div>




                    <div class="col-xs-2">

                        <?php echo $this->Form->control('numero', ['required' => 'off', 'value' => $this->request->getQuery('numero'),  'name' => 'numero', 'label' => 'Numéro', 'class' => 'form-control']); ?>

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




                    <div class="col-xs-1">
                        <button type="submit" style="margin-top: 25px;" class="btn btn-default custom-width-button">
                            <i class="fa fa-search"></i>
                        </button>

                    </div>
                    <div class="col-xs-1" style="text-align: center; margin-top: 25px;">
                        <?php echo $this->Html->link(__(''), ['action' => 'index/' . $type], ['class' => 'btn btn-default btn-large fa fa-remove', 'style' => 'width: 37px; height: 35px; display: flex; justify-content: center; align-items: center;']) ?>
                    </div>

                    <?php echo $this->Form->end(); ?>











                    <!-- <div style="text-align:center">
                    <button type="submit" class="btn btn-primary ">Afficher</button>
                    <a href="<?php echo $this->Url->build(['action' => 'index/' . $type]); ?>" class="btn btn-primary"> Afficher tous</a>


                   </div> -->


                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table width="100%" id="example2" class="table table-bordered table-striped">

                            <!-- <table id="example1" class="table-fixed table table-bordered table-striped" style=' display: block;overflow-x: auto;white-space: nowrap;height:500px'> -->
                            <thead style='position: sticky;top: 0; background-color: #3c8dbc;'>
                                <tr style="font-size: 16px;">
                                    <th hidden width="10%" align="center"><?= ('id') ?></th>
                                    <th width="10%" align="center"><?= ('Date') ?></th>
                                    <th width="10%" align="center"><?= ('N°') ?></th>
                                    <th width="15%" align="center"><?= ('Client') ?></th>
                                    <th width="15%" align="center"> <?= ('Personnel') ?></th>
                                    <th width="15%" align="center"> <?= ('Montant') ?></th>

                                    <th width="8%" align="center"><?= ('') ?></th>

                                    <th width="8%" align="center"><?= ('Actions') ?></th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($factures as $facture) :
                                    //  debug($facture);die;
                                    $connection = ConnectionManager::get('default');

                                    if ($facture->user_id != null) {
                                        $uu = $connection->execute('SELECT * FROM personnels WHERE personnels.id = ' . $facture->user->personnel_id . ';')->fetchAll('assoc');

                                        //  debug($bonlivraison->user->personnel_id);
                                    }
                                    if ($uu) {
                                        $mm = $uu[0]['code'] . '' . $uu[0]['nom'];
                                    } else {
                                        $mm;
                                    }

                                ?>


                                    <tr style="font-size: 16px;">
                                        <td hidden><?= $this->Number->format($facture->id) ?></td>
                                        <td><?php echo $this->Time->format($facture->date, 'dd/MM/y') ?></td>
                                        <td><?= h($facture->numeroconca) ?></td>
                                        <td><?php if ($facture->client_id == 12) {
                                                echo $facture->nomprenom;
                                            } else {
                                                echo ($facture->client->Raison_Sociale);
                                            } ?>
                                        </td>
                                        <td><?php echo  $mm; ?></td>
                                        <td><?php echo ($facture->Montant) ?></td>

                                        <td align="center">
                                            <!-- <div style="margin-right: 2px;">
                                            <a onclick="openWindow(1000, 1000, '/totenroulour/reglementclients/imprimret/<?= $type ?>/<?= $bonlivraison->id ?>')">
                                                <button class="btn btn-xs btn-primary">
                                                    <i class="fa fa-print"></i>
                                                </button>
                                            </a>


                                            </div> -->
                                            <div style="margin-right: 10px;">
                                                <button class="btn btn-sm btn-primary" type="button" style="margin-left:10%;" title="mode" onClick="openWindow(1000, 1000, wr+'reglementclients/modepaie/<?php echo $facture->id ?>');" champ="orderr" value="0">
                                                    Mode Paiement
                                                </button>
                                            </div>
                                        </td>




                                        <td class="actions text" align="center">
                                            <div style="display: flex;" align="center">
                                                <div style="margin-right:2px ;">
                                                    <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view/' . $type, $facture->id), array('escape' => false)); ?>

                                                </div>

                                                <div>
                                                    <?php
                                                    /*  $connection = ConnectionManager::get('default');

                                                     if ($facture->id != null) {
                                                        $chequepaye = $connection->execute('SELECT * FROM piecereglementclients 
                                                                                    WHERE reglementclient_id = :id 
                                                                                    AND paiement_id = 2 
                                                                                    AND etat_id = 2', 
                                                                                    ['id' => $facture->id])
                                                                         ->fetchAll('assoc');
                                                        // debug ($chequepaye[0]['etat_id']);
                                                       
                                                        if (!empty($chequepaye[0]['etat_id'])) {
                                                            
                                                        }
                                                    }*/

                                                    if ($edit == 1) {

                                                        echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit/' . $type, $facture->id), array('escape' => false));
                                                    }  ?>
                                                </div>
                                                <div style="margin-right:2px ;">
                                                    <?php echo $this->Html->Link("<button class='btn btn-xs btn-purple'><i class='fa fa-print'></i></button>", array('action' => 'imprimeview/' . $type, $facture->id), array('escape' => false)); ?>
                                                </div>

                                                <div>
                                                    <?php
                                                    if ($delete == 1) {
                                                        echo $this->Form->postLink("<button class='deleteConfirm btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete/' . $type, $facture->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $facture->id));
                                                    } ?>
                                                </div>
                                            </div>

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


<?php } else if ($type == 1) { ?>




    <!----------------------------------------------------------- reglement Bon livraison where champ BL = 1 ---------------------------------------------------------------->
<?php  if ($add ==1 ) { ?>
    <div class="pull-left" style="margin-left:25px;margin-top: 20px">
        <?php echo $this->Html->link(__('Ajouter'), ['action' => 'add/' . $type], ['class' => 'btn btn-success btn-sm']) ?>
    </div>
    <?php } ?>


    <br> <br><br>

    <section class="content" style="width: 99%">
        <div class="box">
            <div class="box-header">
            </div>

            <div class="box-body">

                <?php echo $this->Form->create($Reglementclients, ['id' => 'searchForm', 'type' => 'get']); ?>
                <div class="row">


                    <div class="col-xs-2">
                        <label>Date Début</label>
                        <?php
                        echo $this->Form->input('datedebut', array('required' => 'off', 'label' => 'Date début', 'value' => $this->request->getQuery('datedebut'), 'id' => 'datedebut', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'date'));
                        ?>
                    </div>


                    <div class="col-xs-2">
                        <label>Date Fin</label>
                        <?php
                        echo $this->Form->input('datefin', array('required' => 'off', 'label' => 'Date fin', 'value' => $this->request->getQuery('datefin'), 'id' => 'datefin', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'date'));
                        ?>

                    </div>




                    <div class="col-xs-2">

                        <?php echo $this->Form->control('numero', ['required' => 'off', 'value' => $this->request->getQuery('numero'),  'name' => 'numero', 'label' => 'Numéro', 'class' => 'form-control']); ?>

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




                    <div class="col-xs-1">
                        <button type="submit" style="margin-top: 25px;" class="btn btn-default custom-width-button">
                            <i class="fa fa-search"></i>
                        </button>

                    </div>
                    <div class="col-xs-1" style="text-align: center; margin-top: 25px;">
                        <?php echo $this->Html->link(__(''), ['action' => 'index/' . $type], ['class' => 'btn btn-default btn-large fa fa-remove', 'style' => 'width: 37px; height: 35px; display: flex; justify-content: center; align-items: center;']) ?>
                    </div>

                    <?php echo $this->Form->end(); ?>











                    <!-- <div style="text-align:center">
                    <button type="submit" class="btn btn-primary ">Afficher</button>
                    <a href="<?php echo $this->Url->build(['action' => 'index/' . $type]); ?>" class="btn btn-primary"> Afficher tous</a>


                </div> -->


                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table width="100%" id="example2" class="table table-bordered table-striped">

                            <!-- <table id="example1" class="table-fixed table table-bordered table-striped" style=' display: block;overflow-x: auto;white-space: nowrap;height:500px'> -->
                            <thead style='position: sticky;top: 0; background-color: #3c8dbc;'>
                                <tr style="font-size: 16px;">
                                    <th hidden width="10%" align="center"><?= ('id') ?></th>
                                    <th width="10%" align="center"><?= ('Date') ?></th>
                                    <th width="10%" align="center"><?= ('N°') ?></th>

                                    <th width="15%" align="center"><?= ('Client') ?></th>
                                    <th width="15%" align="center"> <?= ('Personnel') ?></th>
                                    <th width="15%" align="center"> <?= ('Montant') ?></th>
                                    <th width="10%" align="center"><?= ('') ?></th>

                                    <th width="8%" align="center"><?= ('Actions') ?></th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bonlivraisons as $bonlivraison) :

                                    $connection = ConnectionManager::get('default');

                                    if ($bonlivraison->user_id != null) {
                                        $uu = $connection->execute('SELECT * FROM personnels WHERE personnels.id = ' . $bonlivraison->user->personnel_id . ';')->fetchAll('assoc');

                                        //  debug($bonlivraison->user->personnel_id);
                                    }
                                    if ($uu) {
                                        $mm = $uu[0]['code'] . '' . $uu[0]['nom'];
                                    } else {
                                        $mm;
                                    }

                                    //debug($reglementclient);die;
                                ?>

                                    <tr style="font-size: 16px;">
                                        <td hidden><?= $this->Number->format($bonlivraison->id) ?></td>
                                        <td><?php echo  $this->Time->format($bonlivraison->date, 'dd/MM/y') ?></td>

                                        <td><?= h($bonlivraison->numeroconca) ?></td>
                                        <td><?php if ($bonlivraison->client_id == 12) {
                                                echo $bonlivraison->nomprenom;
                                            } else {
                                                echo $bonlivraison->client->Raison_Sociale;
                                            } ?>
                                        </td>
                                        <td><?php echo $mm; ?></td>
                                        <td><?= h($bonlivraison->Montant) ?></td>



                                        <td align="center">
                                            <!-- <div style="margin-right: 2px;">
                                            <a onclick="openWindow(1000, 1000, '/totenroulour/reglementclients/imprimret/<?= $type ?>/<?= $bonlivraison->id ?>')">
                                                <button class="btn btn-xs btn-primary">
                                                    <i class="fa fa-print"></i>
                                                </button>
                                            </a>


                                            </div> -->
                                            <div style="margin-right: 10px;">
                                                <button class="btn btn-sm btn-primary" type="button" style="margin-left:10%;" title="mode" onClick="openWindow(1000, 1000, wr+'reglementclients/modepaie/<?php echo $bonlivraison->id ?>');" champ="orderr" value="0">
                                                    Mode Paiement
                                                </button>
                                            </div>
                                        </td>



                                        <td class="actions text" align="center">
                                            <div style="display: flex;" align="center">
                                                <div style="margin-right:2px ;">
                                                    <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view/' . $type, $bonlivraison->id), array('escape' => false)); ?>

                                                </div>


                                                <div>
                                                    <?php if ($edit == 1) {
                                                        echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit/' . $type, $bonlivraison->id), array('escape' => false));
                                                    } ?>
                                                </div>
                                                <div style="margin-right:2px ;">
                                                    <?php echo $this->Html->Link("<button class='btn btn-xs btn-purple'><i class='fa fa-print'></i></button>", array('action' => 'imprimeview/' . $type, $bonlivraison->id), array('escape' => false)); ?>
                                                </div>

                                                <div>
                                                    <?php if ($delete == 1) {
                                                        echo $this->Form->postLink("<button class='deleteConfirm btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete/' . $type, $bonlivraison->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $bonlivraison->id));
                                                    } ?>
                                                </div>
                                            </div>

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
<?php } ?>

<script>
    // document.addEventListener('DOMContentLoaded', function() {
    //     const numeroInput = document.querySelector('input[name="numero"]');
    //     const datedebutInput = document.getElementById('datedebut');
    //     const datefinInput = document.getElementById('datefin');
    //     const clientcIdSelect = document.getElementById('idclient');
    //     const clientnIdSelect = document.getElementById('idclient1');

    //     // const numerofInput = document.querySelector('input[name="facturefournisseur"]');

    //     const searchForm = document.getElementById('searchForm');

    //     console.log('DOM entièrement chargé');

    //     if (numeroInput && datedebutInput && datefinInput && clientnIdSelect && clientcIdSelect  && searchForm) {
    //         console.log('Éléments de formulaire trouvés');

    //         // Fonction pour soumettre le formulaire
    //         function submitForm() {
    //             searchForm.submit();
    //         }

    //         // Événement pour soumettre le formulaire lorsqu'Entrée est pressé
    //         searchForm.addEventListener('keydown', function(e) {
    //             if (e.key === 'Enter' && (e.target !== numeroInput || e.target !== datedebutInput || e.target !== datefinInput )) {
    //                 e.preventDefault();
    //                 submitForm();
    //             }
    //         });

    //         // Événement pour soumettre le formulaire lorsqu'un changement est apporté au fournisseurIdSelect
    //         clientcIdSelect.addEventListener('change', function() {
    //             submitForm();
    //         });
    //         clientnIdSelect.addEventListener('change', function() {
    //             submitForm();
    //         });
    //     } else {
    //         console.log('Éléments de formulaire non trouvés');
    //     }
    // });
    document.addEventListener('DOMContentLoaded', function() {
        // Sélectionner les éléments du formulaire et initialiser Select2
        const numeroInput = document.querySelector('input[name="numero"]');
        const datedebutInput = document.getElementById('datedebut');
        const datefinInput = document.getElementById('datefin');
        const clientcIdSelect = $('#idclient');
        const clientnIdSelect = $('#idclient1');
        // const etatlivv = document.getElementById('reglee');
        // const numdebb = document.querySelector('input[name="numdeb"]');
        // const numfinn = document.querySelector('input[name="numfin"]');
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
                    // activeElement === numdebb ||
                    // activeElement === numfinn ||
                    // activeElement === etatlivv ||
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











































<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>

<!-- DataTables -->
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    $(function() {
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': true,
            'ordering': false,
            'info': true,
            'autoWidth': false
        })
        $('#example1').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': true,
            'ordering': false,
            'info': true,
            'autoWidth': false
        })
    })
    $('.select2').select2()
</script>
<?php $this->end(); ?>
<script>
    function openWindow(h, w, url) {
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }
</script>
<script type="text/javascript">
    $(function() {



        tabe = [];
        tabeminus = [];
        $('#poids-id').val(0);


        $('.getpoids').on('click', function(event) {

            event.stopPropagation();


            p = $('#poids-id').val();
            //alert(p);

            ligne = $(this).attr('ligne'); // alert(ligne);
            index = $('#index').val(); //alert(index)

            if ($('#checkbox' + ligne).is(':checked')) {

                //alert(index) ;
                test = 0;

                for (i = 0; i <= Number(index); i++) {
                    if ($('#checkbox' + i).is(':checked')) {

                        test = test + 1;


                    }
                    if (test >= 1) {
                        $('.preparatif').show();


                    }
                }
                commande_id = $('#checkbox' + ligne).val();

                valpoid = $('#poids' + ligne).val() || 0;
                somme = Number($('#poids-id').val()) + Number(valpoid);

                $('#poids-id').val(somme.toFixed(2));
                $('#nb-id').val(Math.ceil($('#poids-id').val() / 450));


            } else {
                poidtotal = $('#poids-id').val();

                valpoid = $('#poids' + ligne).val() || 0;
                spoids = Number(poidtotal) - Number(valpoid);

                $('#poids-id').val(spoids.toFixed(2));
                $('#nb-id').val(Math.ceil($('#poids-id').val() / 450))

            }

            if (test == 0) {
                $('.preparatif').hide();
            }
        });


        $('.prep').on('click', function() {

            var tab = new Array;
            conteur = $('.nombre').val();
            //alert(conteur) ;

            for (var i = 0; i <= conteur; i++) {
                val = ($('#checkbox' + i).attr('checked'));

                v = $('#checkbox' + i).val();
                if ($('#checkbox' + i).is(':checked')) {

                    tab[i] = v;

                }
            }
            var removeItem = undefined;
            tab = jQuery.grep(tab, function(value) {
                return value != removeItem;
            });
            //alert(tab);

            $(this).attr("href", "Bonlivraisons/addpreparatif/" + tab)
        });

    });
</script>
<script>
    function openWindow(h, w, url) {
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }
</script>
<script>
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
</script>