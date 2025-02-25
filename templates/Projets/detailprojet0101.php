<?php
error_reporting(E_ERROR | E_PARSE);
use Cake\Datasource\ConnectionManager; ?>
<div id="projets" style="display:block;margin-top: 1px;">
    <?php echo $this->Form->create($projet, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13", 'type' => 'file']); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="box ">
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-3">
                            <label> Nom Tiers </label>
                            <div>
                                <?php echo ($projet->client->nom); ?>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <label>Nom Projets</label>
                            <div>
                                <?php echo ($projet->name); ?>
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <label> Libelle Projets </label>
                            <div>
                                <?php
                                echo ($projet->libelle); ?>
                            </div>
                        </div>
                        <div id="toggleinformation" class="pull-right" style="margin-right: 50px;">
                            <a class="btn btn-sm btn-primary" style=" border: transparent; color: #fff; text-align: right;">
                                <i class="far fa-eye" style="cursor: pointer;"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div id="information" style="display:none ; margin-top: 1px;">
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
                                    <h5 class="card-title"><strong>Nombre factures Achat : </strong><?php echo $countachat; ?></h5>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="card-body">
                                    <h5 class="card-title"><strong>Nombre factures Vente : </strong><?php echo $countvente; ?></h5>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="card-body">
                                    <h5 class="card-title"><strong>Total factures Achat : </strong><?php echo $totalMontantAchat; ?></h5>
                                </div>
                            </div>

                            <div class="col-xs-3">
                                <div class="card-body">
                                    <h5 class="card-title"><strong>Total factures Vente : </strong><?php echo $totalMontantVente; ?></h5>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="card-body">
                                    <h5 class="card-title"><strong>Total reglement achat : </strong><?php echo $totalReglementAchat; ?></h5>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="card-body">
                                    <h5 class="card-title"><strong>Total reglement vente : </strong><?php echo $totalReglementVente; ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="boutons-container">
        <a href="<?php echo $this->Url->build(['action' => 'index']); ?>" class="button">Email</a>
        <a href="<?php echo $this->Url->build(['action' => 'edit/', $project_id]); ?>" class="button">Modifier</a>
        <a href="<?php echo $this->Url->build(['action' => 'duplicateprojet/', $project_id]); ?>" class="button">Dupliquer </a>
        <a href="<?php echo $this->Url->build(['action' => 'index']); ?>" class="button">Annuler</a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="row">
                    <div class="col-md-6 d-flex align-items-center">
                        <?php
                        echo "<script>var progress = $progress;</script>";
                        if ($projet) {
                            $chart_title = "Etat d'avancement du projet " . $name;
                            echo '<h5 class="chart-title" style="text-align: left;">' . $chart_title . '</h5>';
                        } else {
                            echo '<h5 class="chart-title">Projet non trouvé</h5>';
                        }
                        ?>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end" id="toggleChart" style="text-align: right; ">
                        <a class="btn btn-primary btn-sm" style=" border: transparent; color: #fff; margin-right: 30px;">
                            <i class="far fa-eye" style="cursor: pointer;"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="avancementttt" style="display:none ; margin-top: 1px;">
        <section>
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
    </div>
    <!-- <div class="row"> -->
    <div class="box">
        <div class="panel-body row">
            <div class="col-md-6">
                <h4><strong>Fichier et Responsables</strong></h4>
            </div>
            <div class="col-md-6 text-right">
                <div id="togglefichier" style="margin-right: 5px;">
                    <a class="btn btn-sm btn-primary" style="border: transparent; margin-bottom: 5px; color: #fff;">
                        <i class="far fa-eye" style="cursor: pointer;"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- </div> -->
    <div id="fichier" style="display:none ;margin-top: 1px;">
        <div class="box">
            <section class="content" style="width: 97%">
                <div class="row">
                    <div class="box">
                        <div class="col-md-12 d-flex align-items-center">
                            <div class="box-header with-border">
                                <a class="btn btn-primary  " table='addtable' index='index' id='ajouter_pdf' style=" float: right; margin-bottom: 5px;">
                                    <i class="fa fa-plus-circle "></i> Ajouter fichier</a>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive ls-table">
                                    <table class="table table-bordered table-striped table-bottomless" id="tabfichier">
                                        <thead style="display:'none'">
                                            <tr width:"20px">
                                                <td align="center" style="width: 75%;"><strong>Fichier</strong></td>
                                                <td align="center" style="width: 25%;"></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($fichierpdfs as $f => $fichierpdf) :
                                            ?>
                                                <tr>
                                                    <td align="center">
                                                        <input table="fichier" id="sup1<?php echo $f ?>" name="data[fichier][<?php echo $f ?>][sup1]" champ="sup1" index="<?php echo $f ?>" class="form-control" type="hidden">
                                                        <input type="hidden" value="<?php echo $fichierpdf['id']; ?>" name="data[fichier][<?php echo $f ?>][id]">
                                                        <?php echo $this->Form->control('pdff', ['name' => "data[fichier][$f][pdf]", 'class' => 'form-control', 'value' => $fichierpdf['fichier'], 'index' => $f, 'type' => 'file', 'label' => '', 'champ' => 'pdf', 'table' => 'fichier', 'width' => '50%']); ?>
                                                        <button type="button">
                                                            <?php $url = $_SERVER['HTTP_HOST']; ?>
                                                            <a onclick="openWindow(1000, 1000,'/genuis/img/logoclients/<?php echo $fichierpdf['fichier']; ?>');">
                                                                <i class="fa fa-eye text-orange"></i>
                                                            </a>
                                                        </button>
                                                        <!-- <?php echo $this->Html->image('logoclients/' . $fichierpdf['fichier'], ['style' => 'max-width:150px;height:100px;']); ?> -->
                                                        <p name="data[fichier][$f][pdf]">Fichier actuel : <?= h($fichierpdf['fichier']) ?></p>
                                                    </td>
                                                    <td align="center">
                                                        <i index="<?php echo $f ?>" id="" name="" class="fa fa-times supLigne1" style="color: #c9302c;font-size: 22px;"></i>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <tr class="tr" style="display: none !important">

                                                <td align="center" style="width: 25%;">
                                                    <input table="fichier" id="" name="" champ="sup1" index="" class="form-control" type="hidden">
                                                    <?php echo $this->Form->control('pdf', ['class' => 'form-control', 'type' => 'file', 'label' => '', 'champ' => 'pdf', 'table' => 'fichier',]); ?>
                                                </td>
                                                <td align="center" style="width: 25%;">
                                                    <i index="0" id="" name="" class="fa fa-times supLigne1" style="color: #c9302c;font-size: 22px;"></i>
                                                </td>
                                            </tr>
                                            <input type="hidden" value="<?php echo $f ?>" id="indexfichier">
                                        </tbody>
                                    </table><br>
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
            <section class="content" style="width: 97%">
                <div class="row">
                    <div class="box">
                        <div class="box-header with-border">
                            <a class="btn btn-primary  " table='addtable' index='index' id='ajouter_ligne_responsable' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                                <i class="fa fa-plus-circle "></i> Ajouter responsable</a>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive ls-table">
                                <table class="table table-bordered table-striped table-bottomless" id="tabligne0">
                                    <thead>
                                        <tr width:"20px">
                                            <td align="center" style="width: 25%;"><strong>Nom du responsable</strong></td>

                                            <td align="center" style="width: 25%;"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        foreach ($lignes as $i => $ligne) :
                                        ?>
                                            <tr>
                                                <td align="center">
                                                    <input table="ligne" id="sup1<?php echo $i ?>" name="data[ligne][<?php echo $i ?>][sup1]" champ="sup1" index="<?php echo $i ?>" class="form-control" type="hidden">
                                                    <?php echo $this->Form->control('personnel_id', ['value' => $ligne['personnel_id'], 'required' => 'off', 'index' => $i, 'id' => 'personnel_id' . $i, 'name' => 'data[ligne][' . $i . '][personnel_id]', 'champ' => 'personnel_id', 'table' => 'ligne', 'empty' => 'Veuillez choisir !!!!', 'class' => 'form-control', 'label' => '']); ?>
                                                </td>
                                                <td align="center">
                                                    <i index="<?php echo $i ?>" id="" name="" class="fa fa-times supligneresponsable" style="color: #c9302c;font-size: 22px;"></i>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr class="tr" style="display: none !important">
                                            <td align="left">
                                                <input table="ligne" id="" name="" champ="sup1" index="" class="form-control" type="hidden">
                                                <?php echo $this->Form->control('personnel_id', ['required' => 'off', 'index' => '', 'id' => '', 'name' => '', 'champ' => 'personnel_id', 'table' => 'ligne', 'empty' => 'Veuillez choisir !!!!', 'class' => 'form-control', 'label' => '']); ?>
                                            </td>
                                            <td align="center">
                                                <i index="" id="" class="fa fa-times supligneresponsable" style="color: #c9302c;font-size: 22px;"></i>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table><br>
                                <input type="hidden" value="<?php echo $i ?>" id="index0">
                            </div>
                        </div>
                    </div>

                </div>
            </section>
            <div align="center">
                <?php echo $this->Form->submit('Enregistrer'); ?>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
    <section style="margin-left:15px; width: 97%">
        <div class="row">
            <div class="box">
                <div class="panel-body">
                    <div class="table-responsive ls-table">
                        <table>
                            <thead>
                                <tr>
                                    <th style="text-align: left;" colspan="3">
                                        <h5> Liste des Demande offre de prix associées au projet</h5>
                                    </th>
                                    <?php
                                    $l = -1;
                                    foreach ($listdemandeoffre as $l => $item) {
                                    } ?>
                                    <th style="text-align: right;">
                                        <?php

                                        if ($l >= 0) {

                                        ?>
                                            <button type="button" id="toggleDemandeOffredeprix" class="btn btn-primary btn-sm "><i class="far fa-eye" style="cursor: pointer;"></i></button>
                                        <?php } ?>

                                    </th>
                                </tr>
                                <tr>
                                    <th>Code</th>
                                    <th>Date</th>
                                    <th>Consultation</th>
                                    <th>Actions</th>
                                </tr>

                            </thead>
                            <tbody id="Body__demande_offredeprix" style="display: none;">
                                <?php
                                foreach ($listdemandeoffre as $do => $item) { ?>
                                    <tr>
                                        <td hidden>
                                            <?php echo $this->Form->control('id', ['index' => $do, 'id' => 'id' . $do, 'value' => $item->id, 'label' => '', 'champ' => 'id', 'type' => '', 'class' => 'form-control']); ?>
                                        </td>

                                        <td>
                                            <?php echo $item->numero;
                                            echo $this->Form->input('numero', ['readonly' => 'readonly', 'value' => $item->numero, 'champ' => 'numero', 'label' => false, 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'class' => 'form-control getprixht']); ?>
                                        </td>
                                        <td>
                                            <?php
                                            $date = date('d/m/Y', strtotime($item->date));
                                            echo $date;
                                            echo $this->Form->input('date', ['readonly' => 'readonly', 'value' => $date, 'champ' => 'fodec', 'label' => '', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht']); ?>
                                        </td>
                                        <td>
                                            <?php echo $this->Html->link("<button type='button' class='btn btn-xs btn-info'><i class='fa fa-eye'></i></button>", array('action' => 'bandeconsultation', $item->id, $project_id), array('escape' => false));
                                            ?>
                                        </td>
                                        <td class="actions text" align="center">
                                            <?php echo $this->Html->link('<button type="button" class="btn btn-xs btn-success"><i class="fa fa-search"></i></button>', ['action' => 'viewdof', $item->id], ['escape' => false]); ?>
                                            <?php echo $this->Html->link('<button type="button" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></button>', ['action' => 'editdof', $item->id], ['escape' => false]); ?>
                                            <?php echo ("<button type=button index='" . $do . "' id='delete" . $do . "' class='btn btn-xs btn-danger deletedof'><i class='fa fa-trash'></i></button>"); ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <table>
                            <thead>
                                <tr>
                                    <th style="text-align: left;" colspan="5">
                                        <h5 style="margin: 0; padding: 2px;">Liste des Commandes Fournisseurs associées au projet </h5>
                                    </th>

                                    <?php
                                    $cf = -1;
                                    foreach ($commandefournisseurs as $cf => $item) {
                                    } ?>

                                    <th style="text-align: right;">
                                        <?php
                                        if ($cf  >= 0) {
                                        ?>
                                            <button type="button" id="toggleCommandeFournisseur" class="btn btn-primary btn-sm "><i class="far fa-eye" style="cursor: pointer;"></i></button>
                                        <?php } ?>

                                    </th>
                                </tr>
                                <tr>
                                    <th>Code</th>
                                    <th>Date</th>
                                    <th>Fournisseur</th>

                                    <th>Total TTC</th>
                                    <th>Facture</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="Body__commande_fournisseur" style="display: none;">
                                <?php $i = 0;
                                foreach ($commandefournisseurs as $item) {
                                ?>
                                    <tr align="centrer">
                                        <td align="centrer">
                                            <?php
                                            echo $item->numero;
                                            echo $this->Form->input('code', ['readonly' => 'readonly', 'value' => $item->numero, 'champ' => 'fodec', 'label' => '', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht']); ?>
                                        </td>
                                        <td>
                                            <?php
                                            $date = date('d/m/Y', strtotime($item->date));
                                            echo $date;
                                            echo $this->Form->input('date', ['readonly' => 'readonly', 'value' => $date, 'champ' => 'fodec', 'label' => '', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht']);
                                            ?>
                                        </td>
                                        <td align="centrer">
                                            <?php
                                            echo $item->fournisseur->name; ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo $item->ttc;
                                            echo $this->Form->input('totalttc', ['readonly' => 'readonly', 'value' => $item->ttc, 'champ' => 'fodec', 'label' => '', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht']); ?>
                                        </td>
                                        <td align="center">
                                            <?php if ($item->facture_id == null) { ?>
                                                <input type="checkbox" class="checkboxxxx" id="facture<?php echo $i ?>" value="<?php echo $item->id ?>" index="<?php echo $i ?>">
                                            <?php } ?>
                                        </td>
                                        <td class="actions" align="center">
                                            <?php
                                            echo $this->Html->link('<button type="button" class="btn btn-xs btn-success"><i class="fa fa-search"></i></button>', ['action' => 'viewcomfour', $item->id], ['escape' => false]); ?>
                                            <?php
                                            if ($commande['etatliv'] != 2) {
                                                echo $this->Html->link('<button type="button" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></button>', ['action' => 'editcomfour', $item->id], ['escape' => false]);
                                            } ?>
                                            <?php
                                            if ($commande['valide'] != 1) {
                                                echo $this->Form->postLink("<button style='display:none' type='button' class='btn btn-xs btn-danger'><i class='fa fa-trash'></i></button>", array('action' => 'deletecomfour', $item->id, $project_id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $item->id));
                                            } ?>
                                            <?php echo $this->Form->postLink(
                                                "<button type='button' class='btn btn-xs btn-danger'><i class='fa fa-trash'></i></button>",
                                                ['action' => 'deletecomfour', $item->id, $project_id],
                                                ['escape' => false],
                                                __('Veuillez vraiment supprimer cet enregistrement #{0}?', $item->id)
                                            );
                                            ?>
                                        </td>
                                    </tr>
                                <?php $i++;
                                } ?>

                            </tbody>
                            <input type="hidden" id="index_commande_fournisseur" name="tes" value="<?php echo $i ?>" class="nombre" />

                        </table>
                        <div>
                            <div class="btnfournisseur" style="display: none;">
                                <input type="hidden" name="tes" value="1000" class="nombre" />
                                <a class='btn btn-warning' id="livraisonaddfacture" href>Facture</a>
                            </div>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th style="text-align: left;" colspan="5">
                                        <h5 style="margin: 0; padding: 2px 0;">Liste des Factures Fournisseur associées au projet </h5>
                                    </th>
                                    <?php
                                    $f = -1;
                                    foreach ($facturefournisseurs as $f => $item) {
                                    } ?>

                                    <th style="text-align: right;">
                                        <?php
                                        if ($f  >= 0) {
                                        ?>
                                            <button type="button" id="toggleFactureFournisseur" class="btn btn-primary btn-sm"><i class="far fa-eye" style="cursor: pointer;"></i></button>
                                        <?php } ?>
                                    </th>

                                </tr>
                                <tr>
                                    <th>Code</th>
                                    <th>Date</th>
                                    <th>Total TTC</th>
                                    <th>Montant Regler</th>
                                    <th>Reglements</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="Body__facture_fournisseur" style="display: none;">
                                <?php foreach ($facturefournisseurs as $i => $item) { ?>
                                    <tr>
                                        <td class="afficher_fournisseur" index="<?php echo $item['id']; ?>">
                                            <?php echo $this->Form->control('id', ['index' => $i, 'id' => 'idfacfour' . $i, 'value' => $item->id, 'label' => '', 'champ' => 'id', 'type' => 'hidden', 'class' => 'form-control']); ?>
                                            <?php
                                            echo $item->numero;
                                            echo $this->Form->input('code', ['readonly' => 'readonly', 'value' => $item->numero, 'champ' => 'fodec', 'label' => '', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht']); ?>
                                        </td>
                                        <td class="afficher_fournisseur" index="<?php echo $item['id']; ?>">
                                            <?php $date = date('d/m/Y', strtotime($item->date));
                                            echo $date;
                                            echo $this->Form->input('date', ['readonly' => 'readonly', 'value' => $date, 'champ' => 'fodec', 'label' => '', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht']); ?>
                                        </td>
                                        <td class="afficher_fournisseur" index="<?php echo $item['id']; ?>">
                                            <?php
                                            echo $item->ttc;
                                            echo $this->Form->input('totalttc', ['readonly' => 'readonly', 'value' => $item->ttc, 'champ' => 'fodec', 'label' => '', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht']); ?>
                                        </td>
                                        <td class="afficher_fournisseur" index="<?php echo $item['id']; ?>">
                                            <?php echo $item->Montant_Regler ?>
                                        </td>
                                        <td>
                                            <?php if ($item->ttc > $item->Montant_Regler) {
                                            ?>
                                                <?php echo $this->Html->link("<button type='button' class='btn btn-xs btn-success'><i class='fa fa-money'></i></button>", array('action' => 'addindregfour', $project_id, $item->fournisseur_id, $item->id), array('escape' => false)); ?>
                                            <?php }
                                            ?>
                                        </td>
                                        <td class="actions text" align="center">
                                            <?php echo $this->Html->link('<button type="button" class="btn btn-xs btn-success"><i class="fa fa-search"></i></button>', ['action' => 'viewfacfour', $item->id], ['escape' => false]); ?>
                                            <?php echo $this->Html->link('<button type="button" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></button>', ['action' => 'editfacfour', $item->id], ['escape' => false]); ?>
                                            <?php
                                            echo ("<button type=button index= '" . $i . "' id='delete" . $i . "' class='btn btn-xs btn-danger deletefacfour'><i class='fa fa-trash'></i></button>");
                                            // echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm'><i class='fa fa-trash'></i></button>", array('action' => 'deletefacfour', $item->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $item->id)); 
                                            ?>

                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <table>
                            <thead>
                                <tr>
                                    <th style="text-align: left;" colspan="5">
                                        <h5 style="margin: 0; padding: 2px 0;"> Liste des Reglements Fournisseur associées au projet</h5>
                                    </th>
                                    <?php
                                    $rf = -1;
                                    foreach ($reglementfournisseur as $rf => $item) {
                                    } ?>
                                    <th style="text-align: right;">
                                        <?php
                                        if ($rf  >= 0) {
                                        ?>
                                            <button type="button" id="toggleReglementFournisseur" class="btn btn-primary btn-sm"><i class="far fa-eye" style="cursor: pointer;"></i></button>
                                        <?php } ?>
                                    </th>

                                </tr>
                                <tr>
                                    <th>Code</th>
                                    <th>Numero Facture</th>
                                    <th>Date</th>
                                    <th>TOT.Facture</th>
                                    <th>Montant</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="Body__reglement_fournisseur" style="display: none;">
                                <?php foreach ($reglementfournisseur as $item) {  ?>
                                    <tr>
                                        <td class="afficher_reglement_fournisseur" index="<?php echo $item['reglement_id']; ?>">
                                            <?php
                                            echo $item->reglement->numeroconca;
                                            echo $this->Form->input('code', ['readonly' => 'readonly', 'value' => $item->reglment->numeroconca, 'champ' => 'fodec', 'label' => '', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht']); ?>
                                        </td>
                                        <td class="afficher_reglement_fournisseur" index="<?php echo $item['reglement_id']; ?>">
                                            <?php echo $item->facture->numero;    ?>
                                        </td>
                                        <td class="afficher_reglement_fournisseur" index="<?php echo $item['reglement_id']; ?>">
                                            <?php $date = date('d/m/Y', strtotime($item->reglement->Date));
                                            echo $date;
                                            echo $this->Form->input('date', ['readonly' => 'readonly', 'value' => $date, 'champ' => 'fodec', 'label' => '', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht']); ?>
                                        </td>
                                        <td class="afficher_reglement_fournisseur" index="<?php echo $item['reglement_id']; ?>">
                                            <?php echo $item->facture->ttc;    ?>
                                        </td>
                                        <td class="afficher_reglement_fournisseur" index="<?php echo $item['reglement_id']; ?>">
                                            <?php
                                            echo $item->Montant;
                                            echo $this->Form->input('Montant', ['readonly' => 'readonly', 'value' => $item->Montant, 'champ' => 'fodec', 'label' => '', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht']); ?>
                                        </td>
                                        <td class="actions text" align="center">
                                            <?php echo $this->Html->link('<button type="button" class="btn btn-xs btn-success"><i class="fa fa-search"></i></button>', ['action' => 'viewregfour', $item->reglement_id, $project_id], ['escape' => false]); ?>
                                            <?php echo $this->Html->link('<button type="button" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></button>', ['action' => 'editregfour', $item->reglement_id, $project_id], ['escape' => false]); ?>
                                            <?php echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm'><i class='fa fa-trash'></i></button>", array('action' => 'deleteregfour', $item->reglement_id, $project_id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $item->id)); ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section style="margin-left:15px; width: 97%">
        <div class="row">
            <div class="box">
                <div class="panel-body">
                    <div class="table-responsive ls-table">
                        <table>
                            <thead>
                                <tr>
                                    <th style="text-align: left;" colspan="5">
                                        <h5 style="margin: 0; padding: 2px 0;"> Liste des OFFRE GGB associées au projet</h5>
                                    </th>
                                    <?php
                                    $o = -1;
                                    foreach ($offreggb as $o => $item) {
                                    } ?>
                                    <th style="text-align: right;">

                                        <?php
                                        if ($o  >= 0) {
                                        ?>
                                            <button type="button" id="toggleButtonOffreGGB" class="btn btn-primary btn-sm"><i class="far fa-eye" style="cursor: pointer;"></i></button>
                                        <?php } ?>
                                    </th>

                                </tr>
                                <tr>
                                    <th>Code</th>
                                    <th>Date</th>
                                    <th>client</th>

                                    <th>Total TTC</th>
                                    <th align="centrer">Bon de commande</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="Body__offre_ggb" style="display: none;">
                                <?php foreach ($offreggb as $item) {
                                ?>
                                    <tr>
                                        <td>
                                            <?php
                                            echo $item->code;
                                            echo $this->Form->input('code', ['readonly' => 'readonly', 'value' => $item->code, 'champ' => 'fodec', 'label' => '', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht']); ?>
                                        </td>
                                        <td>
                                            <?php
                                            $date = $this->Time->format($item->datedecreation, 'dd/MM/y');
                                            echo $date;
                                            echo $this->Form->input('date', ['readonly' => 'readonly', 'value' => $date, 'champ' => 'fodec', 'label' => '', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht']); ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo $item->client->nom; ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo $item->totalttc;
                                            echo $this->Form->input('totalttc', ['readonly' => 'readonly', 'value' => $item->totalttc, 'champ' => 'fodec', 'label' => '', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht']); ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($item->valider != 1) { ?>
                                                <?php echo $this->Html->link('<button type="button" class="btn btn-xs btn-info"><i class="fa fa-check"></i></button>', ['action' => 'devalidation', $item->id, '?' => ['project_id' => $project_id]], ['escape' => false]); ?>
                                            <?php } else { ?>
                                                <button style="background-color:#777799; border: transparent;color:#fff"> BC </button>
                                            <?php } ?>
                                        </td>
                                        <td class="actions text" align="center">
                                            <?php echo $this->Html->link('<button type="button" class="btn btn-xs btn-info"><i class="fa fa-clone"></i></button>', array('action' => 'duplicate', $item->id, $project_id), array('escape' => false)); ?>
                                            <?php echo $this->Html->link('<button type="button" class="btn btn-xs btn-success"><i class="fa fa-search"></i></button>', ['action' => 'viewcomcli', $item->id], ['escape' => false]); ?>
                                            <?php echo $this->Html->link('<button type="button" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></button>', ['action' => 'editcomcli', $item->id], ['escape' => false]); ?>
                                            <?php if ($item->valider != 1) { ?>
                                                <?php echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm'><i class='fa fa-trash'></i></button>", array('action' => 'deletecomcli', $item->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $item->id)); ?>
                                            <?php } ?>

                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <table>
                            <thead>
                                <tr>
                                    <th style="text-align: left;" colspan="5">
                                        <h5 style="margin: 0; padding: 2px 0;"> Liste des Commandes Client associées au projet</h5>
                                    </th>
                                    <?php
                                    $cl = -1;
                                    foreach ($commandeclients as $cl => $item) {
                                    } ?>
                                    <th style="text-align: right;">
                                        <?php
                                        if ($cl  >= 0) {
                                        ?>
                                            <button type="button" id="toggleButtonCommandeClient" class="btn btn-primary btn-sm"><i class="far fa-eye" style="cursor: pointer;"></i></button>
                                        <?php } ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Code</th>
                                    <th>Date</th>
                                    <th>Nom Client</th>
                                    <th>Total TTC</th>
                                    <th>Facture</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="bodycommandeclient" style="display: none;">
                                <?php $i = 0;
                                foreach ($commandeclients as $item) { ?>

                                    <tr align="centrer">
                                        <td align="centrer">
                                            <?php
                                            echo $item->code;
                                            echo $this->Form->input('code', ['readonly' => 'readonly', 'value' => $item->code, 'champ' => 'fodec', 'label' => '', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht']); ?>
                                        </td>
                                        <td>
                                            <?php
                                            $date =   $this->Time->format($item->datedecreation, 'dd/MM/y');
                                            echo $date;
                                            echo $this->Form->input('date', ['readonly' => 'readonly', 'value' => $date, 'champ' => 'fodec', 'label' => '', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht']); ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo $item->client->nom; ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo $item->totalttc;
                                            echo $this->Form->input('totalttc', ['readonly' => 'readonly', 'value' => $item->totalttc, 'champ' => 'fodec', 'label' => '', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht']); ?>
                                        </td>
                                        <td class="actions text" style="text-align: center;">
                                            <?php if ($item->facture_id == null) { ?>
                                                <input type="checkbox" style=" margin-left: 50px; padding-left: 50px; left: 70px;" class="checkbox livraisonadd" id="commande<?php echo $i ?>" value="<?php echo $item->id ?>" index="<?php echo $i ?>">
                                            <?php } ?>
                                        </td>

                                        <td class="actions text" align="center">

                                            <?php

                                            echo $this->Html->link("<button type='button' class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'viewboncommandecli', $item->id), array('escape' => false)); ?>
                                        </td>
                                    </tr>
                                <?php $i++;
                                } ?>

                            </tbody>
                            <input type="hidden" name="project_id" id="project_id" value="<?php echo $project_id ?>" />

                            <input type="hidden" name="tes" value="<?php echo $i ?>" class="nombre" />
                        </table>
                        <div class="btnfacture" style="display: none;">
                            <a class='btn btn-sm btn-warning' id="livraisonadd" href>Facture Clients</a>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th style="text-align: left;" colspan="5">
                                        <h5 style="margin: 0; padding: 2px 0;">Liste des Factures Clients associées au projet</h5>
                                    </th>
                                    <?php
                                    $fc = -1;
                                    foreach ($factureclients as $fc => $item) {
                                    } ?>
                                    <th style="text-align: right;">

                                        <?php
                                        if ($fc  >= 0) {
                                        ?>

                                            <button type="button" id="toggleButton" class="btn btn-primary btn-sm"><i class="far fa-eye" style="cursor: pointer;"></i></button>
                                        <?php } ?>

                                    </th>
                                </tr>
                                <tr>
                                    <th>Code</th>
                                    <th>Date</th>
                                    <th>Total TTC</th>
                                    <th>Montant_Regler</th>
                                    <th>Reglement</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="invoiceBody" style="display: none;">
                                <?php foreach ($factureclients as $i => $item) { ?>
                                    <tr>
                                        <?php echo $this->Form->control('id', ['index' => $i, 'id' => 'idfaccli' . $i, 'value' => $item->id, 'label' => '', 'champ' => 'id', 'type' => 'hidden', 'class' => 'form-control']); ?>
                                        <td class="afficher" index="<?php echo $item['id']; ?>">
                                            <?php
                                            echo $item->numero;
                                            echo $this->Form->input('code', ['readonly' => 'readonly', 'value' => $item->numero, 'champ' => 'numero', 'label' => '', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht']); ?>
                                        </td>
                                        <td class="afficher" index="<?php echo $item['id']; ?>">
                                            <?php $date = date('d/m/Y', strtotime($item->date));
                                            echo $date;
                                            echo $this->Form->input('date', ['readonly' => 'readonly', 'value' => $date, 'champ' => 'date', 'label' => '', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht']); ?>
                                        </td>
                                        <td class="afficher" index="<?php echo $item['id']; ?>">
                                            <?php
                                            echo $item->totalttc;
                                            echo $this->Form->input('totalttc', ['readonly' => 'readonly', 'value' => $item->totalttc, 'champ' => 'totalttc', 'label' => '', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht']); ?>
                                        </td>
                                        <td class="afficher" index="<?php echo $item['id']; ?>">
                                            <?php
                                            echo $item->Montant_Regler;
                                            echo $this->Form->input('Montant_Regler', ['readonly' => 'readonly', 'value' => $item->Montant_Regler, 'champ' => 'Montant_Regler', 'label' => '', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht']); ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($item->totalttc > $item->Montant_Regler) {
                                            ?>
                                                <?php echo $this->Html->link("<button type='button' class='btn btn-xs btn-success'><i class='fa fa-money'></i></button>", array('action' => 'addindirectreg', $project_id, $item->id, $item->client_id), array('escape' => false)); ?>
                                            <?php }
                                            ?>
                                        </td>
                                        <td class="actions text" align="center">
                                            <?php echo $this->Html->link('<button type="button" class="btn btn-xs btn-success"><i class="fa fa-search"></i></button>', ['action' => 'viewfaccli', $item->id], ['escape' => false]); ?>
                                            <?php echo $this->Html->link('<button type="button" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></button>', ['action' => 'editfaccli', $item->id], ['escape' => false]); ?>

                                            <?php
                                            echo ("<button type=button index= '" . $i . "' id='delete" . $i . "' class='btn btn-xs btn-danger deletefacclient'><i class='fa fa-trash'></i></button>");
                                            // echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm'><i class='fa fa-trash'></i></button>", array('action' => 'deletefaccli', $item->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $item->id)); 
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <table>
                            <thead>
                                <tr>
                                    <th style="text-align: left;" colspan="5">
                                        <h5 style="margin: 0; padding: 2px 0;"> Liste des Reglements Clients associées au projet</h5>
                                    </th>
                                    <?php
                                    $rc = -1;
                                    foreach ($reglementclients as $rc => $item) {
                                    } ?>
                                    <th style="text-align: right;">

                                        <?php
                                        if ($rc  >= 0) {
                                        ?>

                                            <button type="button" id="toggleButton_reglement_client" class="btn btn-primary btn-sm"><i class="far fa-eye" style="cursor: pointer;"></i></button>
                                        <?php } ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Code</th>
                                    <th>Numero Facture</th>
                                    <th>Date</th>
                                    <th>TOT.Facture</th>
                                    <th>Montant</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="Body_reglement_client" style="display: none;">
                                <?php foreach ($reglementclients as $item) { ?>
                                    <tr>
                                        <td class="afficher_reglement_client" index="<?php echo $item['reglementclient_id']; ?>">
                                            <?php
                                            echo $item->reglementclient->numeroconca; ?>
                                        </td>
                                        <td class="afficher_reglement_client" index="<?php echo $item['reglementclient_id']; ?>">
                                            <?php
                                            echo $item->factureclient->numero; ?>
                                        </td>
                                        <td class="afficher_reglement_client" index="<?php echo $item['reglementclient_id']; ?>">
                                            <?php $date = date('d/m/Y', strtotime($item->reglementclient->Date));
                                            echo $date; ?>
                                        </td>
                                        <td class="afficher_reglement_client" index="<?php echo $item['reglementclient_id']; ?>">
                                            <?php
                                            echo $item->factureclient->totalttc; ?>
                                        </td>
                                        <td class="afficher_reglement_client" index="<?php echo $item['reglementclient_id']; ?>">
                                            <?php
                                            echo $item->Montant; ?>
                                        </td>
                                        <td class="actions text" align="center">
                                            <?php echo $this->Html->link('<button type="button" class="btn btn-xs btn-success"><i class="fa fa-search"></i></button>', ['action' => 'viewregcli', $item->reglementclient_id, $project_id], ['escape' => false]); ?>
                                            <?php echo $this->Html->link('<button type="button" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></button>', ['action' => 'editregcli', $item->reglementclient_id, $project_id], ['escape' => false]); ?>
                                            <?php echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm'><i class='fa fa-trash'></i></button>", array('action' => 'deleteregcli', $item->reglementclient_id, $project_id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?',  $item->reglementclient_id)); ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section style="margin-left:15px; width: 97%">
        <div class="row">
            <div class="box">
                <div class="panel-body">
                    <div class="table-responsive ls-table">
                        <table class="table table-bordered table-striped table-bottomless" id="tabligne0">

                            <table>
                                <thead>
                                    <tr>
                                        <th style="text-align: left;" colspan="5">
                                            <h5>Liste des Tâches associées au projet</h5>
                                        </th>
                                        <th style="text-align: right;">
                                            <?php
                                            $ta = -1;
                                            foreach ($taches as $item) {
                                                $ta++;
                                            }
                                            if ($ta >= 0) {
                                            ?>
                                                <button type="button" id="toggletaches" class="btn btn-primary btn-sm"><i class="far fa-eye" style="cursor: pointer;"></i></button>
                                            <?php } ?>
                                        </th>
                                    </tr>
                                    <?php if ($ta >= 1) { ?>
                                        <tr>
                                            <td align="center" style="width: 10%;" hidden> id </td>
                                            <td align="center" style="width: 10%;"> Ref </td>
                                            <td align="center" style="width: 20%;"> Libelle </td>
                                            <td align="center" style="width: 10%;"> Date Debut </td>
                                            <td align="center" style="width: 20%;"> Date Fin </td>
                                            <td align="center" style="width: 20%;"> Temps estimé </td>
                                            <td align="center" style="width: 20%;"> Actions </td>
                                        </tr>
                                    <?php } ?>
                                </thead>
                                <tbody id="Body__tache" style="display:none">
                                    <?php
                                    foreach ($taches as $ta => $item) {
                                    ?>
                                        <tr>
                                            <td hidden>
                                                <?php
                                                echo $item->id;
                                                echo $this->Form->control('id', ['index' => $ta, 'id' => 'id' . $ta, 'value' => $item->id, 'label' => '', 'champ' => 'id', 'type' => '', 'class' => 'form-control']); ?>
                                            </td>
                                            <td> <?php echo $item->ref; ?> </td>
                                            <td>
                                                <?php echo $item->libelle; ?> </td>
                                            <td>
                                                <?php
                                                $dated = $item->dated;
                                                echo $dated; ?>
                                            </td>
                                            <td>
                                                <?php
                                                $datefin = $item->datefin;
                                                echo $datefin; ?>
                                            </td>
                                            <td>
                                                <?php
                                                $tempsestime = $item->duree . ':' . $item->dureem;
                                                echo $tempsestime; ?>
                                            </td>
                                            <td class="actions text" align="center">
                                                <?php echo $this->Html->link('<button type="button" class="btn btn-xs btn-success"><i class="fa fa-search"></i></button>', ['action' => 'viewtache', $item->id, $project_id], ['escape' => false]); ?>
                                                <?php echo $this->Html->link('<button type="button" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></button>', ['action' => 'edittache', $item->id, $project_id], ['escape' => false]); ?>
                                                <?php echo $this->Form->postLink("<button  type='button' class='btn btn-xs btn-danger'><i class='fa fa-trash'></i></button>", array('action' => 'deletetache', $item->id, $project_id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $item->id)); ?>
                                            </td>
                                        </tr>
                                        <?php
                                        $connection = ConnectionManager::get('default');
                                        $tacheassignsql = $connection->execute('SELECT * FROM tacheassigns where tache_id=' . $item->id . ';')->fetchAll('assoc');
                                        $tacheassigncount = $connection->execute('SELECT count(*) FROM tacheassigns where tache_id=' . $item->id . ';')->fetchAll('assoc');
                                        ?>
                                        <?php if ($tacheassigncount['0']['count(*)'] > 0) { ?>
                                            <tr>
                                                <td align="center" style="width: 10%;"> </td>
                                                <td align="center" style="width: 10%;"> Numero </td>
                                                <td align="center" style="width: 20%;"> Date Debut </td>
                                                <td align="center" style="width: 20%;"> Date Fin </td>
                                                <td align="center" style="width: 20%;"> Temps consommé </td>
                                                <td align="center" style="width: 20%;"> Actions </td>
                                            </tr>
                                        <?php
                                        }
                                        foreach ($tacheassignsql as $ta => $item) {
                                        ?>
                                            <tr>
                                                <td> </td>
                                                <td hidden>
                                                    <?php echo $this->Form->control('id', ['index' => $ta, 'id' => 'id' . $ta, 'value' => $item->id, 'label' => '', 'champ' => 'id', 'type' => '', 'class' => 'form-control']); ?>
                                                </td>
                                                <td> <?php echo $item['numero']; ?> </td>
                                                <td>
                                                    <?php
                                                    $datedebut = date('d/m/Y', strtotime($item['datedebut']));
                                                    echo $datedebut; ?> </td>

                                                <td>
                                                    <?php
                                                    $datefin = date('d/m/Y', strtotime($item['datefin']));
                                                    echo $datefin; ?> </td>
                                                </td>
                                                <td>
                                                    <?php
                                                    $totHH = $totHH  + $item['HH'];
                                                    $totMM = $totMM  + $item['MM'];
                                                    $extraHours = floor($totMM / 60);
                                                    $totHH += $extraHours;
                                                    $totMM = $totMM % 60;
                                                    $tempsconsomme = $item['HH'] . ':' . $item['MM'];
                                                    echo $tempsconsomme; ?>
                                                </td>
                                                <td class="actions text" align="center">
                                                    <?php
                                                    echo $this->Html->link('<button type="button" class="btn btn-xs btn-success"><i class="fa fa-search"></i></button>', ['action' => 'viewtempcons', $item['id'], $project_id], ['escape' => false]); ?>
                                                    <?php echo $this->Html->link('<button type="button" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></button>', ['action' => 'edittempcons', $item['id'], $project_id], ['escape' => false]); ?>
                                                    <?php echo $this->Form->postLink("<button  type='button' class='btn btn-xs btn-danger'><i class='fa fa-trash'></i></button>", array('action' => 'deletetempcons', $item['id'], $project_id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $item->id)); ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <table>
                                <thead>
                                    <tr>
                                        <th style="text-align: left;" colspan="7">
                                            <h5>Liste des Contrats associées au projet</h5>
                                        </th>
                                        <th style="text-align: right;">
                                            <?php
                                            $ca = -1;
                                            foreach ($contrats as $item) {
                                                $ca++;
                                            }
                                            if ($ca >= 0) {
                                            ?>
                                                <button type="button" id="togglecontrats" class="btn btn-primary btn-sm"><i class="far fa-eye" style="cursor: pointer;"></i></button>
                                            <?php } ?>
                                        </th>
                                    </tr>

                                    <tr>
                                        <th scope="col">
                                            <?= ('Numero') ?>
                                        </th>
                                        <th scope="col">
                                            <?= ('Projet') ?>
                                        </th>
                                        <th scope="col">
                                            <?= ('Ref_client') ?>
                                        </th>
                                        <th scope="col">
                                            <?= ('Ref_fournisseur') ?>
                                        </th>
                                        <th scope="col">
                                            <?= ('Tiers') ?>
                                        </th>
                                        <th scope="col">
                                            <?= ('Commercial de suivi') ?>
                                        </th>
                                        <th scope="col">
                                            <?= ('Commercial signature de contrat') ?>
                                        </th>
                                        <th scope="col" class="actions text-center">
                                            <?= __('Actions') ?>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="Body__contrats" style="display:none">
                                    <?php foreach ($contrats as $contrat) :
                                        $commercial_suivi_id = $contrat->commercial_suivi_id;
                                        $query = $connection->prepare('SELECT nom FROM personnels WHERE id = :id');
                                        $query->bindValue('id', $commercial_suivi_id, 'integer');
                                        $query->execute();
                                        $commercial_suivi_id_name = $query->fetchAll('assoc');
                                        $commercial_signataire_contrat_id = $contrat->commercial_signataire_contrat_id;
                                        $query2 = $connection->prepare('SELECT nom FROM personnels WHERE id = :id');
                                        $query2->bindValue('id', $commercial_signataire_contrat_id, 'integer');
                                        $query2->execute();
                                        $commercial_signataire_contrat_id_name = $query2->fetchAll('assoc');
                                    ?>
                                        <tr>
                                            <td>
                                                <?= $contrat->numero ?></td>
                                            </td>
                                            <td>
                                                <?= $contrat->projet->name ?></td>
                                            </td>
                                            <td>
                                                <?= $contrat->ref_client ?></td>
                                            </td>
                                            <td>
                                                <?= $contrat->ref_fournisseur ?></td>
                                            </td>
                                            <td>
                                                <?= $contrat->client->nom ?></td>
                                            </td>

                                            <td>
                                                <?= $commercial_suivi_id_name[0]['nom'] ?></td>
                                            </td>
                                            <td>
                                                <?= $commercial_signataire_contrat_id_name[0]['nom'] ?></td>
                                            </td>
                                            <td class="actions text" align="center">
                                                <?php
                                                echo $this->Html->link('<button type="button" class="btn btn-xs btn-success"><i class="fa fa-search"></i></button>', ['action' => 'viewcontrat', $item['id'], $project_id], ['escape' => false]); ?>
                                                <?php echo $this->Html->link('<button type="button" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></button>', ['action' => 'editcontrat', $item['id'], $project_id], ['escape' => false]); ?>
                                                <?php echo $this->Form->postLink("<button  type='button' class='btn btn-xs btn-danger'><i class='fa fa-trash'></i></button>", array('action' => 'deletecontrat', $item['id'], $project_id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $item->id)); ?>
                                            </td>
                                            <!-- <td class="actions text" align="center">
                                                <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'viewcontrat', $contrat->id), array('escape' => false)); ?>
                                                <?php /* if ($edit == 1) { */ echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'editcontrat', $contrat->id), array('escape' => false));                                                ?>
                                                <?php /* if ($delete == 1) { */
                                                echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteCon'><i class='fa fa-trash'></i></button>", array('action' => 'deletecontrat', $contrat->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $contrat->id));
                                                ?>
                                            </td> -->
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
</div>
<script>
    $(function() {
        $('.deletedof').on('click', function() {
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
                success: function(data) {
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
        $('.deletefacclient').on('click', function() {
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
                success: function(data) {
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
        $('.deletefacfour').on('click', function() {
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
                success: function(data) {
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
        display: flex;

        align-items: center;
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