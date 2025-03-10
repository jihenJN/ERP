<?php

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Demandeclient> $demandeclients
 */
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->script('hela'); ?>
<?php

use Cake\Datasource\ConnectionManager;
?>

<section class="content-header">
    <header>
        <h1 style="text-align:center;"> Les Visites </h1>
    </header>
</section>


<section class="content-header" style="margin-left:-10px">
    <h1>
        Rapport Visites
    </h1>
</section>
<section class="content" style="width: 99%">
    <div class="box">
        <div class="box-header">
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-3">
                    <!-- Statistics Section -->
                    <div>
                        <p><strong>Total des visites :</strong> <?= $totalVisites ?></p>
                        <p><strong>Visites Effectuées :</strong> <?= $completedVisites ?></p>
                        <p><strong>Visites Non Effectuées :</strong> <?= $pendingVisites ?></p>

                    </div>
                </div>
                <div class="col-xs-4">
                    <div>
                        <p><strong>Taux de Retard :</strong> <?= number_format($tauxRetard, 2) ?>%</p>
                        <p><strong>Taux de Réponse :</strong> <?= number_format($tauxReponse, 2) ?>%</p>
                    </div>
                </div>
                <div class="col-xs-5">
                    <div>
                        <div class="table-responsive" style="max-width: 100%; margin: auto;">

                            <table class="table table-striped table-hover w-auto">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th class="p-2" style="min-width: 150px;"><i class="fa fa-user"></i> Type de
                                            Contact</th>
                                        <th class="p-2 text-center" style="min-width: 120px;"><i
                                                class="fa fa-calendar"></i> Nbre Visites</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($typeContactsData as $row): ?>
                                        <tr>
                                            <td class="p-2"><?= h($row['type_contact']) ?></td>
                                            <td class="p-2 text-center font-weight-bold"><?= h($row['nbre_visites']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>



<?php
/*$add = "";
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
}*/

// if ($add == 1) {
?>
<div class="pull-left" style="margin-left:25px;margin-top: 20px">
    <?php //echo $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm'])
    ?>
</div>
<?php //}
?>
<br>
<section class="content-header">
    <h1>
        Recherche
    </h1>
</section>
<section class="content" style="width:99%">
    <div class="box">
        <div class="box-header">
        </div>
        <div class="box-body">
            <?php echo $this->Form->create($visites, ['id' => 'searchForm', 'type' => 'get']); ?>
            <div class="row">
                <div class="col-xs-3">
                    <label class="control-label" for="name">Date début contact
                    </label>
                    <?php
                    echo $this->Form->input('datedebut', array('required' => 'off', 'label' => 'Date début', 'value' => $this->request->getQuery('datedebut'), 'id' => 'datedebut', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'date'));
                    ?>
                </div>
                <div class="col-xs-3">
                    <label class="control-label" for="name">Date fin contact
                    </label>
                    <?php
                    echo $this->Form->input('datefin', array('required' => 'off', 'label' => 'Date fin', 'value' => $this->request->getQuery('datefin'), 'id' => 'datefin', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'date'));
                    ?>
                </div>
                <div class="col-xs-3">
                    <label class="control-label" for="name">Code Client
                    </label>
                    <select class="form-control select2" id="idclient" name="client_id">
                        <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                        <?php foreach ($clients as $id => $client) {
                        ?>
                            <option
                                <?php if ($this->request->getQuery('client_id') == $client->id) echo 'selected="selected"' ?>
                                value="<?php echo $client->id; ?>">
                                <?php
                                echo $client->Code ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-xs-3">
                    <label class="control-label" for="name">Nom Client
                    </label>
                    <select class="form-control select2" id="idclient1" name="client_id1">
                        <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                        <?php foreach ($clients as $id => $client) {
                        ?>
                            <option
                                <?php if ($this->request->getQuery('client_id') == $client->id) echo 'selected="selected"' ?>
                                value="<?php echo $client->id; ?>"><?php echo $client->Raison_Sociale ?></option>
                        <?php } ?>
                    </select>
                </div>

            </div>
            <br>
            <div class="row">
                <div class="col-xs-3">
                    <label class="control-label" for="name">Numéro Visite</label>
                    <select class="form-control select2" id="numero" name="numero">
                        <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                        <?php foreach ($numeros as $numero): ?>
                            <option value="<?php echo $numero['numero']; ?>"
                                <?php if ($this->request->getQuery('numero') == $numero['numero']) echo 'selected="selected"'; ?>>
                                <?php echo $numero['numero']; ?>
                                <!-- Option label should be the numero -->
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-xs-3">
                    <label class="control-label" for="name">Type contact</label>
                    <select class="form-control select2" id="idtypecontact" name="type_contact_id">
                        <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                        <?php foreach ($typecontacts as $id => $typecontact) {
                        ?>
                            <option
                                <?php if ($this->request->getQuery('type_contact_id') == $typecontact->id) echo 'selected="selected"' ?>
                                value="<?php echo $typecontact->id; ?>">
                                <?php
                                echo $typecontact->libelle ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-xs-3">
                    <label class="control-label" for="name">Visiteur</label>
                    <select class="form-control select2" id="idcommercial" name="commercial_id">
                        <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                        <?php foreach ($commercials as $id => $commercial) {
                        ?>
                            <option
                                <?php if ($this->request->getQuery('commercial_id') == $commercial->id) echo 'selected="selected"' ?>
                                value="<?php echo $commercial->id; ?>">
                                <?php
                                echo $commercial->name ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-xs-2" style="display: flex; justify-content: space-between;">
                    <div class="col-xs-6" style="padding-left: 10px;">
                        <button type="submit" class="btn btn-default custom-width-button" style="width: 100%; height: 39.5px; margin-top: 25px;">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                    <div class="col-xs-6" style="padding-right: 10px;">
                        <?php echo $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-default custom-width-button fa fa-remove', 'style' => 'width: 100%; height: 39.5px; display: flex; justify-content: center; align-items: center; margin-top: 25px;']) ?>
                    </div>
                </div>


                <!-- <?php if ($count != 0) { ?>
                    <div class="col-xs-1">
                        <button onclick="openWindow(1000, 1000, wr+'factureclients/imprimelistefactureclient?datedebut=<?php echo @$datedebut; ?>&datefin=<?php echo @$datefin; ?>&client_id=<?php echo @$client_id; ?>&numdeb=<?php echo @$numdeb; ?>&numfin=<?php echo @$numfin; ?>&reglee=<?php echo @$reglee; ?>')" class="btn btn-primary" style="margin-top: 25px;">
                            <i class="fa fa-print"></i>
                        </button> 
                    </div>
                <?php } ?>-->

            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
    <br>

    <section class="content-header" style="margin-left:-10px">
        <h1>Gestion Visites</h1>
    </section>
    <br>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">

                    <!-- Add Visite Button -->
                    <div style="margin-bottom: 5px; text-align: left;">
                        <a href="<?php echo $this->Url->build(['controller' => 'Visites', 'action' => 'addvisite']); ?>"
                            target="_blank" class="btn btn-success btn-sm">
                            Ajouter Visite
                        </a>
                    </div>


                    <!-- End of Add Visite Button -->
                </div>
                <div class="box-body">
                    <table width="100%" id="example2" class="table table-bordered table-striped">
                        <!-- <table id="example1" class="table-fixed table table-bordered table-striped" style=' display: block;overflow-x: auto;white-space: nowrap;height:500px'> -->
                        <thead style='position: sticky;top: 0; background-color: #3c8dbc;'>
                            <tr style="font-size: 16px;">
                                <th>Numéro</th>
                                <th>Date Contact</th>
                                <th>Type Contact</th>
                                <th>Client</th>
                                <th>Lieu</th>
                                <th>Localisation</th>
                                <th>Délai Palnifie</th>
                                <th>Jours Restants </th>
                                <th>Visiteur</th>
                                <th>Date Visite</th>
                                <th>Commentaire</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($visites as $i => $vv) : $connection = ConnectionManager::get('default'); ?>
                                <tr style="font-size: 16px;">
                                    <td><?= $vv->numero ?></td>
                                    <td><?= $this->Time->format($vv->datecontact, 'dd/MM/y'); ?></td>
                                    <td><?= h($vv->typecontact->libelle)  ?></td>
                                    <td><?= $vv->client->Code . ' ' . h($vv->client->Raison_Sociale) ?></td>
                                    <td><?= h($vv->addresse) ?></td>
                                    <td><?= h($vv->localisation) ?></td>
                                    <td><?= $this->Time->format($vv->dateplanifie, 'dd/MM/y'); ?></td>
                                    <?php
                                    // Calculate remaining days directly in the view
                                    $currentDate = new \DateTime();
                                    $datePrevu = $vv->dateplanifie ? new \DateTime($vv->dateplanifie->toDateString()) : null;
                                    $dateVisite = $vv->date_visite ? new \DateTime($vv->date_visite->toDateString()) : null;
                                    $nbreJoursRestant = 0;

                                    if ($datePrevu && $datePrevu > $currentDate && !$dateVisite) {
                                        $interval = $datePrevu->diff($currentDate);
                                        $nbreJoursRestant = $interval->days;
                                    }
                                    ?>
                                    <td><?= $nbreJoursRestant ?></td>

                                    <td><?= h($vv->commercial->name) ?></td>
                                    <td> <?= $vv->date_visite ? $vv->date_visite->format('d/m/Y') : null ?></td>
                                    <td><?= h($vv->description) ?></td>
                                    <td>
                                        <?php //if ($imp == 1) { 
                                        ?>
                                        <!-- <?php echo $this->Html->Link(
                                                    "<button class='btn btn-xs' style='background-color: #800080; color: white; border: 1px solid #800080;'>
                                                       <i class='fa fa-print'></i>
                                                                 </button>",
                                                    array('action' => 'imprimeviewsmbm', $facture->id),
                                                    array('escape' => false)
                                                ); ?> -->

                                        <?php //} 
                                        ?>
                                        <?php //if ($edit == 1 && $facture->client_id != 12) {
                                        echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $vv->id), array('escape' => false));
                                        //}
                                        ?>
                                        <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $vv->id), array('escape' => false)); ?>
                                        <?php //if ($delete == 1 && $testregler == 0 && $BLTotQte == 0) {
                                        echo $this->Form->postLink("<button class='deleteConfirm btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $vv->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $vv->id));
                                        //}
                                        ?>
                                    </td>
                                </tr>
                                <input type="hidden" value="<?php echo $i; ?>" id="index" />
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <table>
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
    // document.addEventListener('DOMContentLoaded', function() {
    //     // const numeroInput = document.querySelector('input[name="numero"]');
    //     const datedebutInput = document.getElementById('datedebut'); //alert(datedebutInput)
    //     const datefinInput = document.getElementById('datefin');
    //     const clientcIdSelect = document.getElementById('idclient');
    //     const clientnIdSelect = document.getElementById('idclient1');
    //     const regleee = document.getElementById('reglee');
    //     const numdebb = document.querySelector('input[name="numdeb"]');
    //     const numfinn = document.querySelector('input[name="numfin"]');

    //     const searchForm = document.getElementById('searchForm');

    //     console.log('DOM entièrement chargé');

    //     if (datedebutInput && datefinInput && clientcIdSelect && clientnIdSelect && regleee &&  numdebb && numfinn &&  searchForm) {
    //         console.log('Éléments de formulaire trouvés');

    //         // Fonction pour soumettre le formulaire
    //         function submitForm() {
    //             searchForm.submit();
    //         }

    //         // Événement pour soumettre le formulaire lorsqu'Entrée est pressé
    //         searchForm.addEventListener('keydown', function(e) {
    //             if (e.key === 'Enter' && (e.target !== numfinn ||e.target !== numdebb || e.target !== datedebutInput || e.target !== datefinInput ||e.target !== regleee)) {
    //                 e.preventDefault();
    //                 submitForm();
    //             }
    //         });

    //         // Événement pour soumettre le formulaire lorsqu'un changement est apporté au fournisseurIdSelect
    //         clientcIdSelect.addEventListener('change', function() {
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
        const commercial = document.getElementById('idcommercial'); 
        const typecontact = document.getElementById('idtypecontact'); 
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
                    activeElement === commercial ||
                    activeElement === typecontact ||


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
        var link = wr + "Factureclients/imprimeviewb/" + facture_id;
        // alert(link);
        openWindow(1000, 1000, link);
    });

    function openWindow(width, height, url) {
        var left = (screen.width - width) / 2;
        var top = (screen.height - height) / 2;
        window.open(url, '_blank', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=' +
            width + ',height=' + height + ',top=' + top + ',left=' + left);
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
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h +
            ',resizable,scrollbars=yes');
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

<script>
    function resetSearch() {
        window.location.href = "<?= $this->Url->build('/visites') ?>";
    }
</script>

<?php $this->end(); ?>