<?php

use App\Model\Entity\Demandeoffredeprix;

error_reporting(E_ERROR | E_PARSE);

use Cake\Datasource\ConnectionManager; 
$wr =$this->Url->build('/', ['fullBase' => true]);?>
<section style="width: 99%">

    <div id="projets" style="display:block;margin-top: 1px;">
        <?php
        $session = $this->request->getSession();
        $com = $session->write('com', null);
        echo $this->Form->create($projet, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13", 'type' => 'file']); 
        echo $this->Form->hidden('form_name', ['value' => 'detailprojet']);  ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box ">
                    <div class="box-body" style="font-size: 15px;">
                        <div class="row">
                            <div class="col-xs-3" style="margin-top:3%;margin-left:2%; width: 80px;">
                                <img src="<?php echo $wr; ?>/webroot/img/projeticon.png" alt="Image du projet"
                                    style="max-width: 50px; max-height: 50px;">
                            </div>
                            <div class="col-xs-8" style="margin:1%">
                                <div style="font-size: 15px;"><b>
                                        <?php echo ($projet->libelle); ?>
                                    </b></div>
                                <div style="font-size: 15px;">
                                    <?php echo ($projet->name); ?>
                                </div>
                                <div style="font-size: 15px;"> <label> Tiers: </label>
                                <a href="#" style="" onclick="window.open('../../Clients/view/<?php echo $projet->client->id; ?>', '_blank')"><?php echo $projet->client->Raison_Sociale ?></a>


                                    <?php //echo $this->Html->link($projet->client->nom, ['controller' => 'Clients', 'action' => 'view', $projet->client->id], ['escape' => false]); ?>

                                    <?php //echo ($projet->client->nom); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <table style="width: 99%; margin: 2%;" class="table table-bordered table-striped">
                                    <tr>
                                        <td style="width: 20%; text-align: left; vertical-align: middle;">USAGE</td>
                                        <td style="width: 80%; text-align: left;font-family: arial;">
                                            <div class="form-check">
                                                <?php echo $this->Form->control('suivre_opportunite', ['disabled' => 'disabled', 'type' => 'checkbox', 'label' => 'Suivre Opportunite', 'checked' => $projet->suivre_opportunite == 1, 'class' => 'form-check-input', 'id' => 'suivre_opportunite']); ?>
                                            </div>
                                            <div class="form-check">
                                                <?php echo $this->Form->control('suivre_tache', ['disabled' => 'disabled', 'type' => 'checkbox', 'label' => 'Suivre Tache', 'checked' => $projet->suivre_tache == 1, 'class' => 'form-check-input', 'id' => 'suivre_tache']); ?>
                                            </div>
                                            <div class="form-check">
                                                <?php echo $this->Form->control('facturer_temps_passe', ['disabled' => 'disabled', 'type' => 'checkbox', 'label' => 'Facturer Temps Passe', 'checked' => $projet->facturer_temps_passe == 1, 'class' => 'form-check-input', 'id' => 'facturer_temps_passe']); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 10%; text-align: left; vertical-align: middle;">Visibilité
                                        </td>
                                        <td style="width: 20%; text-align: left;font-family: arial;">
                                            <?php if ($projet->visibilite == 0) { ?>
                                                <?php echo ('Contacts Projets') ?>
                                            <?php } else if ($projet->visibilite == 1) { ?>
                                                <?php echo ('Tout le monde') ?>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 10%; text-align: left; vertical-align: middle;">Date début -
                                            Date fin</td>
                                        <td style="width: 20%; text-align: left;font-family: arial;">
                                            <?php echo ($this->Time->format($projet->date,'dd/MM/y')) . ' - ' . ($this->Time->format($projet->datefin,'dd/MM/y')); ?>
                                        </td>
                                    </tr>


                                 
                                    <tr>
                                        <td style="width: 10%; text-align: left; vertical-align: middle;">Description
                                        </td>
                                        <td style="width: 20%; text-align: left;font-family: arial;">
                                            <?php echo $projet->description; ?>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div id="information" style="display:none ; margin-top: 1px;">
        <div class="box-body">
            <div class="row">
                <div class="col-xs-3">
                    <span><strong>Visibilité</strong></span>
                    <div>
                        <?php
                        if ($projet->visibilite == 0) {
                            echo 'Contacts projet';
                        } elseif ($projet->visibilite == 1) {
                            echo 'Tout le monde';
                        }
                        ?>
                    </div>
                </div>

                <div class="col-xs-3">
                    <label> Date Debut</label>
                    <div>
                        <?php echo ($projet->date); ?>
                    </div>
                </div>
                <div class="col-xs-3">
                    <label> Date Fin </label>
                    <div>
                        <?php echo ($projet->datefin); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    <label> Statut opportunité </label>
                    <div>
                        <?php echo ($projet->opportunite->name); ?>
                    </div>
                </div>
                <div class="col-xs-3">
                    <label> Commercial </label>
                    <div>
                        <?php echo ($projet->personnel->nom); ?>
                    </div>
                </div>
                <div class="col-xs-3">
                    <label> Description </label>
                    <div>
                        <?php echo ($projet->description); ?>
                    </div>
                </div>
            </div>
            <div class="card-group">
                <div class="col-xs-3">
                    <div class="card-body">
                        <h5 class="card-title"><strong>Nombre factures Achat : </strong><?php echo $countachat; ?></b></h5>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="card-body">
                        <h5 class="card-title"><strong>Nombre factures Vente : </strong><?php echo $countvente; ?></b></h5>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="card-body">
                        <h5 class="card-title"><strong>Total factures Achat : </strong><?php echo $totalMontantAchat; ?></b></h5>
                    </div>
                </div>

                <div class="col-xs-3">
                    <div class="card-body">
                        <h5 class="card-title"><strong>Total factures Vente : </strong><?php echo $totalMontantVente; ?></b></h5>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="card-body">
                        <h5 class="card-title"><strong>Total reglement achat : </strong><?php echo $totalReglementAchat; ?></b></h5>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="card-body">
                        <h5 class="card-title"><strong>Total reglement vente : </strong><?php echo $totalReglementVente; ?></b></h5>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
        <div>
            <div class="box">
                <div class="row">
                    <div class="boutons-container">
                        <?php if ($mail == 1) { ?>
                            <!-- <a href="<?php echo $this->Url->build(['action' => 'index']); ?>" class="button"><i
                                    class="fa fa-envelope"></i> Email</a> -->
                        <?php } ?>
                        <?php if ($validation == 1) { ?>
                            <a href="<?php echo $this->Url->build(['action' => 'edit/', $project_id]); ?>" class="button"><i
                                    class="fa fa-edit"></i> Modifier</a>
                            <a href="<?php echo $this->Url->build(['action' => 'duplicateprojet/', $project_id]); ?>"
                                class="button"><i class="fa fa-copy"></i> Dupliquer</a>
                        <?php } ?>

                        <a href="<?php echo $this->Url->build(['action' => 'index']); ?>" class="button"><i
                                class="fa fa-times"></i> Annuler</a>
                    </div>

                </div>
            </div>
        </div>
        <!--  <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-center">
                            <?php
                            echo "<script>var progress = $progress;</script>";
                            if ($projet) {
                                $chart_title = "Etat d'avancement du projet " . $name;
                                echo '<h5 class="chart-title" style="text-align: left;">' . $chart_title . '</b></h5>';
                            } else {
                                echo '<h5 class="chart-title">Projet non trouvé</b></h5>';
                            }
                            ?>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end" id="toggleChart" style="text-align: right; ">
                            <a class="btn btn-primary btn-sm" style=" border: transparent; color: #fff; margin-right: 30px;">
                                <i class="fa fa-eye" style="cursor: pointer;"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="avancementttt" style="display:none ; margin-top: 1px;">
            <section style="width: 97%">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box ">
                            <div class="chart-container">
                                <canvas id="progress-chart" class="chart-canvas" width="400" height="400"></canvas>
                                <div id="chart-legend"></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="col-xs-3">
                                        <div class="color-block">
                                            <div class="color-swatch" style="background-color: #81C784;"></div>
                                            <span>Règlement</span>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="color-block">
                                            <div class="color-swatch" style="background-color: #228B22;"></div>
                                            <span>Facture client</span>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="color-block">
                                            <div class="color-swatch" style="background-color: #FFA500;"></div>
                                            <span>Commande client</span>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="color-block">
                                            <div class="color-swatch" style="background-color: #1E90FF ;"></div>
                                            <span>Offreggb</span>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="color-block">
                                            <div class="color-swatch" style="background-color: #9932CC;"></div>
                                            <span>Facture fournisseur</span>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="color-block">
                                            <div class="color-swatch" style="background-color: #FF4500;"></div>
                                            <span>Commande fournisseur</span>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="color-block">
                                            <div class="color-swatch" style="background-color: #FFD700;"></div>
                                            <span>Demande offre de prix</span>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">

                                        <div class="color-block">
                                            <div class="color-swatch" style="background-color: #FF0000;"></div>
                                            <span>Projet</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div> -->
        <div hidden>
            <?php include('chartetatprojet.php'); ?>

        </div>

        <!-- <div class="row"> -->

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="panel-body row">
                        <div class="col-md-6">
                            <h5><b><strong>Fichier et Responsables</strong></b></h5>
                        </div>
                        <div class="col-md-6 text-right">
                            <div id="togglefichier" style="margin-right: 5px;">
                                <a class="btn btn-sm btn-primary"
                                    style="border: transparent; margin-bottom: 5px; color: #fff;">
                                    <i class="fa fa-eye" style="cursor: pointer;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- </div> -->
                <div id="fichier" style="display:none ;margin-top: 1px;">
                    <div class="box">
                        <section style="width: 99%">
                            <div class="row">
                                <div class="box">
                                    <div class="col-md-12 d-flex align-items-center">
                                        <div class="box-header with-border">
                                            <a class="btn btn-primary  " table='addtable' index='index' id='ajouter_pdf'
                                                style=" float: right; margin-bottom: 5px;">
                                                <i class="fa fa-plus-circle "></i> Ajouter fichier</a>
                                        </div>
                                        <div class="panel-body">
                                            <div class="table-responsive ls-table">
                                                <table class="table table-bordered table-striped table-bottomless"
                                                    id="tabfichier">
                                                    <thead style="display:'none'">
                                                        <tr width:"20px">
                                                            <td align="center" style="width: 75%;">
                                                                <strong>Fichier</strong>
                                                            </td>
                                                            <td align="center" style="width: 25%;"></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($fichierpdfs as $f => $fichierpdf): ?>
                                                            <tr>
                                                                <td align="center">
                                                                    <input table="fichier" id="sup1<?php echo $f ?>"
                                                                        name="data[fichier][<?php echo $f ?>][sup1]"
                                                                        champ="sup1" index="<?php echo $f ?>"
                                                                        class="form-control" type="hidden">
                                                                    <input type="hidden"
                                                                        value="<?php echo $fichierpdf['id']; ?>"
                                                                        name="data[fichier][<?php echo $f ?>][id]">
                                                                    <?php echo $this->Form->control('pdff', ['name' => "data[fichier][$f][pdf]", 'class' => 'form-control', 'value' => $fichierpdf['fichier'], 'index' => $f, 'type' => 'file', 'label' => '', 'champ' => 'pdf', 'table' => 'fichier', 'width' => '50%']); ?>
                                                                    <button type="button">
                                                                        <?php $url = $_SERVER['HTTP_HOST']; ?>
                                                                        <a
                                                                            onclick="openWindow(1000, 1000,'<?php echo $wr; ?>/img/logoclients/<?php echo $fichierpdf['fichier']; ?>');">
                                                                            <i class="fa fa-eye text-orange"></i>
                                                                        </a>
                                                                    </button>
                                                                    <!-- <?php echo $this->Html->image('logoclients/' . $fichierpdf['fichier'], ['style' => 'max-width:150px;height:100px;']); ?> -->
                                                                    <p name="data[fichier][$f][pdf]">Fichier actuel :
                                                                        <?= h($fichierpdf['fichier']) ?>
                                                                    </p>
                                                                </td>
                                                                <td align="center">
                                                                    <i index="<?php echo $f ?>" id="" name=""
                                                                        class="fa fa-times supLigne1"
                                                                        style="color: #c9302c;font-size: 22px;"></i>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                        <tr class="tr" style="display: none !important">
                                                            <td align="center" style="width: 25%;">
                                                                <input table="fichier" id="" name="" champ="sup1"
                                                                    index="" class="form-control" type="hidden">
                                                                <?php echo $this->Form->control('pdf', ['class' => 'form-control', 'type' => 'file', 'label' => '', 'champ' => 'pdf', 'table' => 'fichier',]); ?>
                                                            </td>
                                                            <td align="center" style="width: 25%;">
                                                                <i index="0" id="" name="" class="fa fa-times supLigne1"
                                                                    style="color: #c9302c;font-size: 22px;"></i>
                                                            </td>
                                                        </tr>
                                                        <input type="hidden" value="<?php echo $f ?>" id="indexfichier">
                                                    </tbody>
                                                </table>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="content-header">
                            <h1 class="box-title">
                                <?php echo __('Les responsables'); ?>
                            </h1>
                        </section>
                        <section style="width: 99%">
                            <div class="row">
                                <div class="box">
                                    <div class="box-header with-border">
                                        <a class="btn btn-primary  " table='addtable' index='index'
                                            id='ajouter_ligne_responsable' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                                            <i class="fa fa-plus-circle "></i> Ajouter responsable</a>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive ls-table">
                                            <table class="table table-bordered table-striped table-bottomless"
                                                id="tabligne0">
                                                <thead>
                                                    <tr width:"20px">
                                                        <td align="center" style="width: 25%;"><strong>Nom du
                                                                responsable</strong></td>

                                                        <td align="center" style="width: 25%;"></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 0;
                                                    foreach ($lignes as $i => $ligne):
                                                        ?>
                                                        <tr>
                                                            <td align="center">
                                                                <input table="ligne" id="sup1<?php echo $i ?>"
                                                                    name="data[ligne][<?php echo $i ?>][sup1]" champ="sup1"
                                                                    index="<?php echo $i ?>" class="form-control"
                                                                    type="hidden">
                                                                <?php echo $this->Form->control('personnel_id', ['value' => $ligne['personnel_id'], 'required' => 'off', 'index' => $i, 'id' => 'personnel_id' . $i, 'name' => 'data[ligne][' . $i . '][personnel_id]', 'champ' => 'personnel_id', 'table' => 'ligne', 'empty' => 'Veuillez choisir !!!!', 'class' => 'form-control', 'label' => '']); ?>
                                                            </td>
                                                            <td align="center">
                                                                <i index="<?php echo $i ?>" id="" name=""
                                                                    class="fa fa-times supligneresponsable"
                                                                    style="color: #c9302c;font-size: 22px;"></i>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    <tr class="tr" style="display: none !important">
                                                        <td align="left">
                                                            <input table="ligne" id="" name="" champ="sup1" index=""
                                                                class="form-control" type="hidden">
                                                            <?php echo $this->Form->control('personnel_id', ['required' => 'off', 'index' => '', 'id' => '', 'name' => '', 'champ' => 'personnel_id', 'table' => 'ligne', 'empty' => 'Veuillez choisir !!!!', 'class' => 'form-control', 'label' => '']); ?>
                                                        </td>
                                                        <td align="center">
                                                            <i index="" id="" class="fa fa-times supligneresponsable"
                                                                style="color: #c9302c;font-size: 22px;"></i>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table><br>
                                            <input type="hidden" value="<?php echo $i ?>" id="index0">
                                        </div>
                                    </div>
                                </div>
                                <div align="center">
                                    <?php echo $this->Form->submit('Enregistrer'); ?>
                                    <?php echo $this->Form->end(); ?>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>


    

   
    </div>

</section>
<script>
    $(document).ready(function () {
        $('.envoyerbuttonfr').on('click', function () {

            id = $(this).attr("demande"); //alert(id)
            type = $(this).attr("typeof");
            idf = $(this).attr("idf");
            idfour = $(this).attr("idfour");
            fmail = $(this).attr("fmail");
            $('#id_demande').val(id);
            $('#typeof').val(type);
            $('#name').val(idf);
            $('#email').val(fmail);
            $('#four_id').val(idfour);
            //console.log(id)
            //document.getElementById('action-button').addEventListener('click', function() {
            //});
            togglePopup111111();

        });
        $('.envoyerbuttoncom').on('click', function () {
            // alert('2222');
            id = $(this).attr("demande"); //alert(id)
            type = $(this).attr("typeof");
            idf = $(this).attr("idf");
            idfour = $(this).attr("idfour");
            fmail = $(this).attr("fmail");
            $('#id_comm').val(id);
            $('#typecom').val(type);
            $('#namecom').val(idf);
            $('#emailcom').val(fmail);
            $('#fourni_id').val(idfour);
            //console.log(id)
            //document.getElementById('action-button').addEventListener('click', function() {
            //});
            togglePopupcom();
        });
        $('.impfichier').on('click', function () {

            idprojet = $(this).attr("index"); //alert(id)
            idcommande = $(this).attr("indexx");
            $('#projectid').val(idprojet);
            $('#commandeclientid').val(idcommande);
            popupOverlayimp();
        });
        $('.envoyerbuttoncomcli').on('click', function () {
            // alert('2222');
            id = $(this).attr("demande"); //alert(id)
            type = $(this).attr("typeof");
            idf = $(this).attr("idf");
            idfour = $(this).attr("idfour");
            fmail = $(this).attr("fmail");
            $('#id_commcli').val(id);
            $('#typecomcli').val(type);
            $('#namecomcli').val(idf);
            $('#emailcomcli').val(fmail);
            $('#cli_id').val(idfour);
            //console.log(id)
            //document.getElementById('action-button').addEventListener('click', function() {
            //});
            togglePopupcomcli();
        });
        $('.envoyer').on('click', function () {
            // imprimer();
            id = $('#id_demande').val(); //alert(id)
            type = $('#typeof').val(); //alert(type)
            name = $('#name').val(); //alert(name)
            mail = $('#email').val(); //alert(mail)
            four_id = $('#four_id').val(); //alert(mail)
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'commandefournisseurs', 'action' => 'envoyer']) ?>",
                dataType: "html",
                data: {
                    id: id,
                    type: type,
                    name: name,
                    mail: mail,
                    four_id: four_id,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (data) {
                    togglePopup111111();
                    //$('#categclient').val(data.valeurcategorie);
                }
            })
        });
        $('.envoyercom').on('click', function () {
            // imprimer();
            id = $('#id_comm').val(); //alert(id)
            type = $('#typecom').val(); //alert(type)
            name = $('#namecom').val(); //alert(name)
            mail = $('#emailcom').val(); //alert(mail)
            four_id = $('#fourni_id').val(); //alert(mail)
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'commandefournisseurs', 'action' => 'envoyercom']) ?>",
                dataType: "html",
                data: {
                    id: id,
                    type: type,
                    name: name,
                    mail: mail,
                    four_id: four_id,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (data) {
                    togglePopupcom();
                    //$('#categclient').val(data.valeurcategorie);
                }
            })
        });
        $('.envoyercomcli').on('click', function () {
            // imprimer();
            id = $('#id_commcli').val(); //alert(id)
            type = $('#typecomcli').val(); //alert(type)
            name = $('#namecomcli').val(); //alert(name)
            mail = $('#emailcomcli').val(); //alert(mail)
            four_id = $('#cli_id').val(); //alert(mail)
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'commandeclients', 'action' => 'envoyercomcli']) ?>",
                dataType: "html",
                data: {
                    id: id,
                    type: type,
                    name: name,
                    mail: mail,
                    four_id: four_id,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (data) {
                    togglePopupcomcli();
                    //$('#categclient').val(data.valeurcategorie);
                }
            })
        });
    });

    function togglePopup111111() {

        //console.log(id)
        const overlay = document.getElementById('popupOverlay');
        overlay.classList.toggle('show');
    }

    function togglePopupcom() {
        //console.log(id)
        const overlay = document.getElementById('popupOverlaycom');
        overlay.classList.toggle('show');
    }

    function togglePopupcomcli() {
        //console.log(id)
        const overlay = document.getElementById('popupOverlaycomcli');
        overlay.classList.toggle('show');
    }
    function popupOverlayimp() {
        const overlay = document.getElementById('popupOverlayimp');
        overlay.classList.remove('hide'); // Assurez-vous que 'hide' est retiré
        overlay.classList.add('show'); // Ajoutez 'show'
    }

    function despopupOverlayimp() {
        const overlay = document.getElementById('popupOverlayimp');
        overlay.classList.remove('show'); // Assurez-vous que 'show' est retiré
        overlay.classList.add('hide'); // Ajoutez 'hide'
    }
    /*   function popupOverlayimp() {
           //console.log(id)
           
           const overlay = document.getElementById('popupOverlayimp');
           overlay.classList.toggle('show');
       }   function despopupOverlayimp() {
           //console.log(id)
           const overlay = document.getElementById('popupOverlayimp');
           overlay.classList.toggle('hide');
       }*/
</script>
<div id="popupOverlay" class="overlay-container">
    <div class="popup-box">
        <h2 style="color: green;">Envoyer vers le fournisseur</h2>
        <div class="form-container">
            <label class="form-label" for="name">
                Nom du Fournisseur:
            </label>
            <input class="form-input" type="text" placeholder="Enter Your Fournisseur" id="name" name="name" required>

            <label class="form-label" for="email">Email:</label>
            <input class="form-input" type="email" placeholder="Enter Your Email" id="email" name="email" required>
            <input class="form-input" type="hidden" id="id_demande" name="id_demande">
            <input class="form-input" type="hidden" id="typeof" name="typeof">
            <input class="form-input" type="hidden" id="four_id" name="four_id">
            <button class="btn-envoyer envoyer">
                Envoyer
            </button>
        </div>

        <button class="btn-close-popup" onclick="togglePopup111111()">
            Close
        </button>
    </div>
</div>
<div id="popupOverlaycom" class="overlay-container">
    <div class="popup-box">
        <h2 style="color: green;">Envoyer vers le fournisseur</h2>
        <div class="form-container">
            <label class="form-label" for="namecom">
                Nom du Fournisseur:
            </label>
            <input class="form-input" type="text" placeholder="Enter Your Fournisseur" id="namecom" name="namecom"
                required>

            <label class="form-label" for="emailcom">Email:</label>
            <input class="form-input" type="email" placeholder="Enter Your Email" id="emailcom" name="emailcom"
                required>
            <input class="form-input" type="hidden" id="id_comm" name="id_comm">
            <input class="form-input" type="hidden" id="typecom" name="typecom">
            <input class="form-input" type="hidden" id="fourni_id" name="fourni_id">
            <button class="btn-envoyer envoyercom">
                Envoyer
            </button>
        </div>

        <button class="btn-close-popup" onclick="togglePopupcom()">
            Close
        </button>
    </div>
</div>
<div id="popupOverlaycomcli" class="overlay-container">
    <div class="popup-box">
        <h2 style="color: green;">Envoyer vers le Client</h2>
        <div class="form-container">
            <label class="form-label" for="namecomcli">
                Nom du Client:
            </label>
            <input class="form-input" type="text" placeholder="Enter Your Client" id="namecomcli" name="namecomcli"
                required>

            <label class="form-label" for="emailcomcli">Email:</label>
            <input class="form-input" type="email" placeholder="Enter Your Email" id="emailcomcli" name="emailcomcli"
                required>
            <input class="form-input" type="hidden" id="id_commcli" name="id_commcli">
            <input class="form-input" type="hidden" id="typecomcli" name="typecomcli">
            <input class="form-input" type="hidden" id="cli_id" name="cli_id">
            <button class="btn-envoyer envoyercomcli">
                Envoyer
            </button>
        </div>

        <button class="btn-close-popup" onclick="togglePopupcomcli()">
            Close
        </button>
    </div>
</div>
<div id="popupOverlayimp" class="overlay-container">

    <div class="popup-box">
        <a class="closepop" style="background-color:red;" onclick="despopupOverlayimp()">
            <i class="fa fa-times" style="color:white;"></i>
        </a>
        <h4 style="    color: crimson;">Affichage les remises dans l'impression</h4>
        <br><br>

        <div class="form-container">
            <?php echo $this->Form->create($commandeclient, [
                'role' => 'form',
                'onkeypress' => "return event.keyCode!=13",
                'url' => ['action' => 'saveetat']
            ]); ?>
            <div style="display:flex;text-align: left;">
                <div style="    width: 63%;">
                    <label class="form-label" for="">
                        Remise Transport
                    </label>
                    <label class="form-label" for="">
                        Remise Globale
                    </label>

                </div>
                <div>
                    <input type="radio" name="activeremisetransport" value="1" id="" checked>OUI
                    <input type="radio" name="activeremisetransport" value="2" id="">NON
                    <br><br>
                    <input type="radio" name="activeremise" value="1" checked>OUI
                    <input type="radio" name="activeremise" value="2" id="">NON


                </div>
            </div>


            <!-- <select name="activeremise" id="" class="form-control select2">
                <option value="1">OUI</option>
                <option value="2">NON</option>
            </select> -->
            <div></div>
            <input type="hidden" name="commandeclientid" id="commandeclientid">
            <input type="hidden" name="projectid" id="projectid">
            <br>

            <button class="btn-envoyer enrgimp">
                Imprimer
            </button>
            <?php echo $this->Form->end(); ?>
        </div>


    </div>
</div>
<script>
    $(document).ready(function () {
        var param;
        $(".closepop").on("click", function () {
            //alert(client);

            despopupOverlayimp();
        });
        $(".besach").on("click", function () {
            ligne = $(this).attr("ligne");
            // alert(ligne);
            index = $("#indexx").val();
            // alert(index);
            param = $('#projet_id' + ligne).val();
            // alert(param);
            test = 0;
            for (i = 0; i <= Number(index); i++) {
                if ($("#check" + i).is(":checked")) {
                    test = test + 1;
                    // alert(test);
                }
            }
            if (test == 1) {
                // alert();
                $('.testcheck').show();
                fournisseur = $('#fournisseur_id' + ligne).val();
                article = $('#article_id').val();
                if ($('.tes').val() == 0) {
                    $('.tes').val(fournisseur);
                    $('.tes').val(article);
                }
            }
            if (test == 0) {
                $('.tes').val(0);
                $('.testcheck').hide();
            }
        });


    });
    $('input').on('keyup', function () {
        $('.btn').show();
    });
    $('input').on('keyup', function () {
        $('.btn').show();
    });
    $('#commandee').on('click', function () {

        // console.log(ind);
        param = $('#projet_id' + ligne).val();
        // console.log(param);
        var tab = new Array;
        var conteur = $('.nombre').val();
        for (var i = 0; i <= conteur; i++) {
            var val = ($('#check' + i).attr('checked'));
            var v = $('#check' + i).val();
            if ($('#check' + i).is(':checked')) {
                tab[i] = v;
            }
        }
        var removeItem = undefined;
        tab = jQuery.grep(tab, function (value) {
            return value != removeItem;
        });
        var client = $('.tes').val();
        // alert(tab);
        var currentUrl = window.location.href;
        var parentUrl = currentUrl.split('/').slice(0, -3).join('/');
        // window.open("https://codifaerp.isofterp.com/demo/demandeoffredeprixes/etatcomparatif/" + param + "/" + tab);
        window.location.href = parentUrl+"/projets/etatcomparatif/" + tab + "/" + param;

    });
    $('input').on('keyup', function () {
        $('.btn').show();
    });
    $('input').on('keyup', function () {
        $('.btn').show();
    });
</script>

<!-- <script>
    $(document).ready(function () {
        $('.envoyerbutton').on('click', function () {
            id = $(this).attr("demande");
            type = $(this).attr("typeof");
            $('#id_demande').val(id);
            $('#typeof').val(type);
            //console.log(id)
            togglePopup();

        });
        $('.envoyer').on('click', function () {

            id = $('#id_demande').val();
            type = $('#typeof').val();
            name = $('#name').val();
            mail = $('#email').val();
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Projets', 'action' => 'envoyer']) ?>",
                dataType: "html",
                data: {
                    id: id,
                    type: type,
                    name: name,
                    mail: mail,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (data) {
                    togglePopup();
                    //$('#categclient').val(data.valeurcategorie);
                }
            })

        });

    });
    function togglePopup() {

        //console.log(id)
        const overlay = document.getElementById('popupOverlay');
        overlay.classList.toggle('show');
    }
</script> -->
<style>
    .btn-open-popup:hover {
        background-color: #4C58AF;
    }

    .overlay-container {
        display: none;
        position: fixed;
        top: 20%;
        left: 0;
        width: 100%;
        height: 100%;
        background: transparent;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        margin-left: 40%;

    }

    .popup-box {
        background: #fff;
        padding: 24px;
        border-radius: 12px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
        width: 320px;
        text-align: center;
        opacity: 0;
        transform: scale(0.8);
        animation: fadeInUp 0.5s ease-out forwards;
    }

    .form-container {
        display: flex;
        flex-direction: column;
    }

    .form-label {
        margin-bottom: 10px;
        font-size: 16px;
        color: #444;
        text-align: left;
    }

    .form-input {
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 16px;
        width: 100%;
        box-sizing: border-box;
    }

    .btn-envoyer,
    .btn-close-popup {
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-envoyer {
        background-color: green;
        color: #fff;
    }

    .btn-close-popup {
        margin-top: 12px;
        background-color: #e74c3c;
        color: #fff;
    }

    .btn-envoyer:hover,
    .btn-close-popup:hover {
        background-color: #4caf50;
    }

    /* Keyframes for fadeInUp animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Animation for popup */
    .overlay-container.show {
        display: flex;
        opacity: 1;
    }

    .btn-purple {
        background-color: #43899E;
        /* Changer la couleur de fond en violet */
        color: white;
        /* Changer la couleur du texte en blanc ou autre couleur lisible */
    }
</style>

<script>
    $(function () {
        $('.deletedof').on('click', function () {
            ind = $(this).attr('index');
            id = $('#id' + ind).val();
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Projets', 'action' => 'verifdeldof']) ?>",
                dataType: "json",
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (data) {
                    if (data.bande != 0) {
                        alert('Demande offre de prix  déja existe dans un bande de consultation');
                    } else {
                        if (confirm('Voulez vous vraiment supprimer cet enregistrement')) {
                            var currentUrl = window.location.href;
                            var parentUrl = currentUrl.split('/').slice(0, -3).join('/');
                            var link = parentUrl + "/Projets/deletedof/" + id;
                            window.location.href = link;
                        }
                    }
                }
            })
        });
        $('.deletefacclient').on('click', function () {
            ind = $(this).attr('index');
            id = $('#idfaccli' + ind).val();
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Projets', 'action' => 'veriffacclient']) ?>",
                dataType: "json",
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (data) {
                    if (data.lignereg != 0) {
                        alert('Facture déja existe dans un reglement');
                    } else {
                        if (confirm('Voulez vous vraiment supprimer cet enregistrement')) {
                            var currentUrl = window.location.href;
                            var parentUrl = currentUrl.split('/').slice(0, -3).join('/');
                            var link = parentUrl + "/Projets/deletefaccli/" + id;
                            window.location.href = link;
                        }
                    }
                }
            })
        });
        // $('.telimp').on('click', function () {
        //     id = $(this).attr('index');
        //     var currentUrl = window.location.href;
        //     var parentUrl = currentUrl.split('/').slice(0, 4).join('/');
        //     var link = parentUrl + "/Projets/downloadPdfimp/" + id;
        //     window.location.href = link;
        // });
        $('.deletefacfour').on('click', function () {
            ind = $(this).attr('index');
            id = $('#idfacfour' + ind).val();
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Projets', 'action' => 'veriffacfour']) ?>",
                dataType: "json",
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (data) {
                    if (data.regl != 0) {
                        alert('Facture achat  déja existe dans un reglement');
                    } else {
                        if (confirm('Voulez vous vraiment supprimer cet enregistrement')) {
                            var currentUrl = window.location.href;
                            var parentUrl = currentUrl.split('/').slice(0, -3).join('/');
                            var link = parentUrl + "/Projets/deletefacfour/" + id;
                            window.location.href = link;
                        }
                    }
                }
            })
        });
    });
</script>
<style>
    .boutons-container {
        margin-right: 15px;
        padding: 5px 10px;

        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .color {
        background-color: #2A8403;
        color: green;
    }



    .button {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        background-color: #3498db;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-left: 5px;
        margin-right: 5px;
        text-align: center;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .button:hover {
        background-color: #2980b9;
    }
</style>
<style>
    .btn-animated {
        animation: moveInBottom 5s ease-out;
        animation-fill-mode: backwards;
    }

    @keyframes moveInBottom {
        0% {
            opacity: 0;
            transform: translateY(30px);
        }

        100% {
            opacity: 1;
            transform: translateY(0px);
        }
    }
</style>
<div id="popupOverlay" class="overlay-container">
    <div class="popup-box">
        <h2 style="color: green;">Envoyer vers le fournisseur</h2>
        <div class="form-container">
            <label class="form-label" for="name">
                Nom du Fournisseur:
            </label>
            <input class="form-input" type="text" placeholder="Enter Your Fournisseur" id="name" name="name" required>

            <label class="form-label" for="email">Email:</label>
            <input class="form-input" type="email" placeholder="Enter Your Email" id="email" name="email" required>
            <input class="form-input" type="hidden" id="id_demande" name="id_demande">
            <input class="form-input" type="hidden" id="typeof" name="typeof">

            <button class="btn-envoyer envoyer">
                Envoyer
            </button>
        </div>

        <button class="btn-close-popup" onclick="togglePopup()">
            Close
        </button>
    </div>
</div>