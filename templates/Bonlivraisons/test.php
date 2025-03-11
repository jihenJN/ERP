<section class="content-header">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
</section>

<?php

use Cake\Datasource\ConnectionManager;

echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('salma'); ?>
<style>
    .btn-purple {
        background-color: purple;
        color: white;
    }
</style>
<section class="content-header">
    <header>
        <?php if ($type == 1) { ?>
            <h1 style="text-align:center;">Bon de livraison</h1>
        <?php
            $add = "";
            $edit = "";
            $delete = "";
            $view = "";
            $session = $this->request->getSession();
            $abrv = $session->read('abrvv');
            $lien = $session->read('lien_vente' . $abrv);
            foreach ($lien as $k => $liens) {
                if (@$liens['lien'] == 'bonlivraisons') {
                    $add = $liens['ajout'];
                    $edit = $liens['modif'];
                    $delete = $liens['supp'];
                    $valide = $liens['valide'];
                    $imp = $liens['imprimer'];
                }
            }
        }  ?>
        <?php if ($type == 2) { ?>
            <h1 style="text-align:center;">Devis </h1>
        <?php }  ?>
       
    </header>
</section>
<?php



//if ($add == 1) { 
?>
<?php //if ($type == 2) {
?>
<div class="pull-left" style="margin-left:25px;margin-top: 20px">
    <?php echo $this->Html->link(__('Ajouter'), ['action' => 'add/' . $type], ['class' => 'btn btn-success btn-sm']) ?>
</div>
<?php //}
?>
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
            <?php echo $this->Form->create($bonlivraisons, ['type' => 'get']); ?>
            <div class="row">

                <div class="col-xs-2">


                    <label class="control-label" for="name">Date début
                    </label>
                    <?php
                    echo $this->Form->input('datedebut', array('required' => 'off', 'label' => 'Date début', 'value' => $this->request->getQuery('datedebut'), 'id' => 'datefin', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'date'));
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
                    <label class="control-label" for="name">Numéro
                    </label>
                    <?php
                    echo $this->Form->input('numero', array('required' => 'off', 'label' => 'Numero', 'value' => $this->request->getQuery('numero'), 'id' => 'num', 'class' => 'form-control '));
                    ?>

                </div>
                <div class="col-xs-1">
                    <button type="submit" style="margin-top: 25px;" class="btn btn-default custom-width-button">
                        <i class="fa fa-search"></i>
                    </button>

                </div>
                <div class="col-xs-1" style="text-align: center; margin-top: 25px;">
                    <?php echo $this->Html->link(__(''), ['action' => 'index', $type], ['class' => 'btn btn-default btn-large fa fa-remove', 'style' => 'width: 37px; height: 35px; display: flex; justify-content: center; align-items: center;']) ?>
                </div>

                <?php echo $this->Form->end(); ?>
            </div>

        </div>


    </div>

    <!-- <div style="text-align:center">
            <button type="submit" class="btn btn-primary btn-sm">Afficher</button>

            <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index', $type], ['class' => 'btn btn-primary btn-sm']) ?>
        </div> -->

    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <?php
                    if ($type == 1) { ?>
                        <h3 class="box-title">Bon livraison</h3>
                    <?php } ?>
                
                </div>
                <div class="box-body">
                    <div class="box-header pull-right with-border" style="margin-right: 10px;">
                        <?php if ($this->request->getQuery('datedebut') != 0 && $this->request->getQuery('datefin') != 0 && $type == 1) {  ?>
                            <div class="select-all-container" style="margin-right: 10px;">
                                <button type="button" id="select-all" class="btn btn-primary select-all-button" style="background-color: #861C67;border: 1px solid #861C67;">
                                    Sélectionner Tout
                                </button>
                            </div>

                        <?php } ?>
                    </div>
                    <!-- <table width="100%" id="example1" class="table-fixed table table-bordered table-striped" style=' display: block;overflow-x: auto;white-space: nowrap;height:500px'> -->
                    <table width="100%" id="example2" class="table table-bordered table-striped">

                        <thead style='position: sticky;top: 0; background-color: #3c8dbc;'>

                            <tr>

                                <th width="8%">Numero</th>
                                <th width="8%">Date</th>
                                <?php if ($type == 1) { ?>
                                    <th width="8%">N° Devis</th>
                                <?php } ?>
                                <?php if ($type == 1) { ?>
                                    <th width="8%">N° BC</th>
                                <?php } ?>
                                <th width="15%">Client</th>
                                <th width="10%">Personnel</th>

                                <th width="7%">Dépot</th>
                                <?php
                                foreach ($bonlivraisons as $i => $bonlivraison) :

                                ?>
                                <?php endforeach; ?>

                                <?php if ($bonlivraison->typebl == 1 || $bonlivraison->typebl == 2) { ?>
                                    <th width="8%">Net à payer</th>
                                <?php } ?>
                        
                             
                                <?php if ($bonlivraison->typebl == 1) { ?>
                                    <th width="3%"> Facture </th>
                                    <!-- <th width="8%"> Agent de Controle </th>
                                    <th width="8%"> Chauffeur </th> -->
                                <?php } ?>



                                <th width=10%>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  //debug($bonlivraisons->toarray());
                            foreach ($bonlivraisons as $i => $bonlivraison) :
                            ?>
                                <tr>

                                    <?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id' . $i, 'value' => $bonlivraison->id, 'label' => '', 'champ' => 'id', 'type' => 'hidden', 'class' => 'form-control']); ?>


                                    <?php if ($type == 2) { ?>
                                        <?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id' . $i, 'value' => $bonlivraison->id, 'label' => '', 'champ' => 'id', 'type' => 'hidden', 'class' => 'form-control']); ?>
                                        <?php echo $this->Form->control('tre', ['index' => $i, 'id' => 'treilles' . $i, 'value' => $bonlivraison->treilles, 'label' => '', 'champ' => 'treilles', 'type' => 'hidden', 'class' => 'form-control']); ?>
                                        <?php echo $this->Form->control('aut', ['index' => $i, 'id' => 'autorisation' . $i, 'value' => $bonlivraison->autorisation, 'label' => '', 'champ' => 'autorisation', 'type' => 'hidden', 'class' => 'form-control']); ?>
                                    <?php } ?>

                                    <td><?= h($bonlivraison->numero) ?></td>
                                    <td>&nbsp;&nbsp;
                                        <?=
                                        $this->Time->format(
                                            $bonlivraison->date,
                                            'dd/MM/y'
                                        );
                                        ?></td>

                                    <?php if ($type == 1) { ?>
                                        <td>&nbsp;&nbsp;<?php
                                                        $connection = ConnectionManager::get('default');

                                                        $devis = [];
                                                        // if ($bonlivraison->idbonlivraison == null) {
                                                        $devis = $connection->execute('SELECT * FROM bonlivraisons WHERE bonlivraisons.idbonlivraison = ' . $bonlivraison->id . ' AND bonlivraisons.typebl = 2 ;')->fetchAll('assoc');
                                                        // debug($devis);

                                                        // }
                                                        if ($devis) {
                                                            echo $devis[0]['numero'];
                                                        } else {
                                                            echo '';
                                                        }



                                                        ?></td>
                                    <?php } ?>
                                    <?php if ($type == 1) { ?>
                                        <td>&nbsp;&nbsp;<?php
                                                        $connection = ConnectionManager::get('default');

                                                        $cmd = [];
                                                        if ($bonlivraison->commande_id != null) {
                                                            $cmd = $connection->execute('SELECT * FROM commandes WHERE commandes.id = ' . $bonlivraison->commande_id . ';')->fetchAll('assoc');
                                                        }
                                                        if ($cmd) {
                                                            echo $cmd[0]['numero'];
                                                        } else {
                                                            echo '';
                                                        }



                                                        ?></td>
                                    <?php } ?>
                                    <?php $connection = ConnectionManager::get('default');

                                    if ($bonlivraison->user_id != null) {
                                        $uu = $connection->execute('SELECT * FROM personnels WHERE personnels.id = ' . $bonlivraison->user->personnel_id . ';')->fetchAll('assoc');

                                        //  debug($bonlivraison->user->personnel_id);
                                    }
                                    if ($uu) {
                                        $mm = $uu[0]['code'] . '' . $uu[0]['nom'];
                                    } else {
                                        $mm;
                                    }


                                   

                                    $bonlivraison_id = $bonlivraison->id;
                                    $bon = $connection->execute('SELECT * FROM lignebonlivraisons WHERE bonlivraison_id =' . $bonlivraison_id);
                                    $livraisonComplete = true; // Supposons que la livraison est complète par défaut

                                    foreach ($bon as $livv) {
                                        $qtec = $livv['qte'];
                                        $qtef = $connection->execute('SELECT SUM(quantiteliv) as ss FROM lignebonlivraisons WHERE idlignebonlivraison=' . $livv['id'])->fetch('assoc');

                                        if ($qtef['ss'] < $qtec) {
                                            $livraisonComplete = false;
                                            // break; // Si une seule ligne n'est pas complète, on arrête la boucle
                                        }
                                    }
                                    ?>

                                    <td>&nbsp;&nbsp;<?php echo $bonlivraison->client->Code . ' ' . ($bonlivraison->client->Raison_Sociale) ?></td>
                                    <td><?php echo  $mm; ?></td>
                                    <td><?= h($bonlivraison->depot->name) ?></td>

                                    <?php if (($bonlivraison->typebl == 1) || ($bonlivraison->typebl == 2)) { ?>
                                        <td><?= h($bonlivraison->totalttc) ?></td>
                                    <?php } ?>
                                  
                                       
                                       
                                
                                    <?php
                                    ?>

                                    <?php if ($bonlivraison->typebl == 1 || $bonlivraison->typebl == 3) { ?>
                                        <td align="center">
                                            <input id="factureclient_id<?= $i ?>" ligne="<?php echo $i; ?>" class="" type="hidden" value="<?= $bonlivraison->factureclient_id ?>">

                                            <div <?php if ($bonlivraison->factureclient_id != 0) { ?> style="display:none" <?php } ?>>


                                                <input id="client_id<?= $i ?>" ligne="<?php echo $i; ?>" class="" type="hidden" value="<?= $bonlivraison->client_id ?>">
                                                <input id="depot_id<?= $i ?>" ligne="<?php echo $i; ?>" class="" type="hidden" value="<?= $bonlivraison->depot_id ?>">

                                                <input type="checkbox" id="checkbox6<?php echo $i; ?>" value="<?php echo $bonlivraison['id'] ?>" name="checkbox[]" ligne="<?php echo $i; ?>" class="facc6 facture6" />

                                            </div>
                                        </td>

                                        <!-- <td align="center">
                                            <?php echo $bonlivraison->personnel->nom . ' ' . $bonlivraison->personnel->prenom ?>
                                        </td>

                                        <td align="center">

                                            <?php

                                            if ($bonlivraison->typetransport_id == 1 || $bonlivraison->typetransport_id == 3) {
                                                echo $bonlivraison->chauffeurname;
                                            } else {
                                                $chauffeur = [];
                                                if ($bonlivraison->chauffeur_id != null) {
                                                    $connection = ConnectionManager::get('default');

                                                    $chauffeur = $connection->execute('SELECT * FROM personnels WHERE personnels.id = ' . $bonlivraison->chauffeur_id . ';')->fetchAll('assoc');
                                                }
                                                if ($chauffeur) {
                                                    echo $chauffeur[0]['nom'] . ' ' . $chauffeur[0]['prenom'];
                                                } else echo '';
                                            } ?>
                                        </td> -->



                                    <?php } ?>
                             
                            

                              






                                    <!-------------------------- BL ---------------------->

                                    <?php if ($bonlivraison->typebl == 1) { ?>


                                        <td>
                                            <div style="display: flex;">
                                                <div style="margin-right:2px ;">

                                                    <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $bonlivraison->id), array('escape' => false)); ?>

                                                </div>
                                                <div style="margin-right:2px ;">
                                                    <?php if ($edit == 1) { ?>
                                                        <div <?php if ($bonlivraison->factureclient_id != 0) { ?> style="display:none" <?php } ?>>
                                                            <?php echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $bonlivraison->id), array('escape' => false)); ?>
                                                        </div>
                                                    <?php } ?>
                                                </div>

                                                <?php if ($type == 1) { ?>

                                                    <div style="margin-right:2px ;">
                                                        <a onclick="openWindow(1000, 1000, 'https://smbm.mtd-erp.com/ERP/Bonlivraisons/imprimeviewbl/<?php echo $bonlivraison->id; ?>')"><button class='btn btn-xs btn-primary'><i class='fa fa-print'></i></button></a>
                                                    </div>

                                                <?php } else { ?>
                                                    <div style="margin-right:2px ;">
                                                        <a onclick="openWindow(1000, 1000, 'https://smbm.mtd-erp.com/ERP/Bonlivraisons/imprimeview/<?php echo $bonlivraison->id; ?>')"><button class='btn btn-xs btn-primary'><i class='fa fa-print'></i></button></a>
                                                    </div>
                                                <?php } ?>

                                                <?php if ($delete == 1) { ?>
                                                    <div <?php if ($bonlivraison->factureclient_id != 0) { ?> style="display:none" <?php } ?>>

                                                        <?php echo $this->Form->postLink("<button class=' deleteConfirm btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $bonlivraison->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $bonlivraison->id)); ?>
                                                    </div>
                                                <?php } ?>




                                            </div>

                                        </td>
                                    <?php } ?>




                                






                                </tr>



                            <?php endforeach; ?>
                        </tbody>

                    </table>
                    <input type="hidden" value="<?php echo $i; ?>" id="index" />
                    <table>

                        <tr>
                      
                            <td align="center">

                               
                                <?php if ($bonlivraison->typebl == 1) { ?>
                                    <div class="col-md-6 testcheck6">
                                        <?php echo $this->Form->create(null, ['url' => ['controller' => 'Bonlivraisons', 'action' => 'addfacture'], 'class' => 'form-horizontal']); ?>
                                        <!-- Ajoutez un champ hidden pour stocker les IDs des bons de livraison sélectionnés -->
                                        <input type="text" name="tab" value="" id="tabValues">
                                        <!-- Autres champs hidden nécessaires -->
                                        <input type="hidden" name="tes6" value="0" class="tespv6" />
                                        <input type="hidden" name="tes6" value="0" class="tes6" />
                                        <input type="hidden" name="nombre6" value="<?php echo @$i; ?>" class="nombre1" />
                                        <!-- Bouton de soumission du formulaire -->
                                        <button type="submit" class="btn btn btn-success" id="transf" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">
                                            <i class="fa fa-plus-circle"></i> Créer Facture
                                        </button>
                                        <?php echo $this->Form->end(); ?>
                                    </div>


                                <?php } ?>



                           
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




<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>

<script>
    $(document).ready(function() {
        const selectAllButton = $("#select-all");
        const checkboxes = $(".facc6");

        selectAllButton.on("click", function() {
            checkboxes.prop("checked", !checkboxes.prop("checked"));
            updateButtonText();
            updateMyButtonVisibility(); // Call the function here
        });

        checkboxes.on("change", function() {
            updateButtonText();
            updateMyButtonVisibility(this); // Pass the checkbox element to the function
        });

        function updateButtonText() {
            selectAllButton.text(checkboxes.filter(":checked").length === checkboxes.length ?
                "Désélectionner Tout" :
                "Sélectionner Tout"
            );
        }

        function updateMyButtonVisibility(checkbox) {
            // if (checkbox) { // Ensure checkbox is defined
            //     const ligne = checkbox.getAttribute('ligne'); // Accessing ligne attribute of the checkbox
            //     alert(ligne);
            //     const dd = $('#factureclient_id' + ligne).val();
            // Check for both conditions: if any checkbox is checked and factureclient_id is 0
            if (checkboxes.filter(":checked").length > 0) {
                $(".testcheck6").show();
            } else {
                $(".testcheck6").hide();
            }
            // }
        }
    });
    $(document).ready(function() {
        $('.facc6').on('click', function() {
            /// alert('nfskn')
            //var tab = new Array;
            ligne = $(this).attr('ligne');
            index = $('#index').val();
            // alert(index)
            test = 0;
            for (i = 0; i <= Number(index); i++) {
                if ($('#checkbox6' + i).is(':checked')) {
                    //alert('hedh')
                    test = 1;
                }
            }
            if (test == 1) {
                $('.testcheck6').show();
                // depot = $('#depot_id' + ligne).val();
                client = $('#client_id' + ligne).val();
                // fournisseur = $('#fournisseur_id' + ligne).val();
                //alert(client);
                if ($('.tes6').val() == 0) {
                    $('.tes6').val(client);
                }
                if (($('.tes6').val() != client) && $('.tes6').val() != 0) {
                    alert('Il faut choisir des Factures Client  pour un meme Client SVP !!');
                    return false;
                }
            }
            if (test == 0) {
                //alert("fera8");
                $('.tes6').val(0);
                $('.tespv6').val(0);
                $('.testcheck6').hide();
            }




        });



        $('.btnfac6').on('click', function() {
              

            var tab = new Array;
            conteur = $('.nombre1').val();
            //  ligne = $(this).attr('ligne');

            // client = $('#client_id' + ligne).val();
            for (var i = 0; i <= conteur; i++) {
                val = ($('#checkbox6' + i).attr('checked'));
                v = $('#checkbox6' + i).val();
                if ($('#checkbox6' + i).is(':checked')) {
                    tab[i] = v;
                    // alert(tab[i]);
                    $('#checkbox6' + i).hide();
                    //alert('dd');
                }
            }
            var removeItem = undefined;
            tab = jQuery.grep(tab, function(value) {
                return value != removeItem;
            })


            window.open("https://smbm.mtd-erp.com/ERP/Factureclients/addfacture/" + tab);

        });



        $('.facture6').on('click', function() {

            $('.testcheck6').show();

        });
    });
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
