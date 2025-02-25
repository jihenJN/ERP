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
        } else {
            $add = "";
            $edit = "";
            $delete = "";
            $view = "";
            $session = $this->request->getSession();
            $abrv = $session->read('abrvv');
            $lien = $session->read('lien_vente' . $abrv);
            foreach ($lien as $k => $liens) {
                if (@$liens['lien'] == 'offredeprix') {
                    $add = $liens['ajout'];
                    $edit = $liens['modif'];
                    $delete = $liens['supp'];
                    $valide = $liens['valide'];
                    $imp = $liens['imprimer'];
                }
            }
        } ?>
        <?php if ($type == 2) { ?>
            <h1 style="text-align:center;">Facture Proforma </h1>
        <?php }  ?>
        <?php if ($type == 3) { ?>
            <h1 style="text-align:center;">BL retour marchandise</h1>
        <?php }  ?>
        <?php if ($type == 4) { ?>
            <h1 style="text-align:center;">Integration</h1>
        <?php

        }  ?>
    </header>
</section>
<?php



if ($add == 1) {
?>
    <?php //if ($type == 2) {
    ?>
    <div class="pull-left" style="margin-left:25px;margin-top: 20px">
        <?php echo $this->Html->link(__('Ajouter'), ['action' => 'add/' . $type], ['class' => 'btn btn-success btn-sm']) ?>
    </div>
    <?php //}
    ?>
<?php }
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
            <?php echo $this->Form->create($bonlivraisons, ['type' => 'get', 'id' => 'searchForm']); ?>
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
                    <label class="control-label" for="name">Numéro
                    </label>
                    <?php
                    echo $this->Form->input('numero', array('required' => 'off', 'label' => 'Numero', 'value' => $this->request->getQuery('numero'), 'id' => 'num', 'class' => 'form-control '));
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




                <?php if ($type == 1) { ?>
                    <div class="col-xs-2">
                        <?php
                        echo $this->Form->control('facturee', ['label' => 'Facturée ', 'options' => $facturations, 'value' => $this->request->getQuery('facturee'), 'class' => ' form-control select2', 'empty' => 'choisir !!']); ?>
                    </div>

                <?php  } ?>
                <div class="col-xs-1">
                    <button type="submit" style="margin-top: 25px;" class="btn btn-default custom-width-button">
                        <i class="fa fa-search"></i>
                    </button>

                </div>
                <?php if ($type == 1) { ?>
                    <?php //if ($count != 0 ){ 
                    ?>
                    <div class="col-xs-1">

                        <button onclick="openWindow(1000, 1000, wr+'bonlivraisons/imprimelistbl?datedebut=<?php echo @$datedebut; ?>&datefin=<?php echo @$datefin; ?>&client_id=<?php echo @$client_id; ?>&numero=<?php echo @$numero; ?>&facturee=<?php echo @$facturee; ?>')" class="btn btn-primary" style="margin-top: 25px;">
                            <i class="fa fa-print"></i>
                        </button>
                    </div>
                <?php } ?>

                <?php  //} 
                ?>
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
                    <?php
                    if ($type == 2) { ?>
                        <h3 class="box-title">Devis</h3>
                    <?php } ?>
                    <?php
                    if ($type == 3) { ?>
                        <h3 class="box-title">Bon de livraison marchandise</h3>
                    <?php } ?>
                    <?php
                    if ($type == 4) { ?>
                        <h3 class="box-title">Integration</h3>
                    <?php } ?>
                    <?php
                    if ($type == 5) { ?>
                        <h3 class="box-title">Offre de prix</h3>
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

                            <tr style="font-size: 16px;">

                                <th width="6%">Numero</th>
                                <th width="8%">Date</th>
                                <?php if ($type == 1) { ?>
                                    <th hidden width="8%">N° Devis</th>
                                <?php } ?>
                                <?php if ($type == 1) { ?>
                                    <th hidden width="8%">N° BC</th>
                                <?php } ?>
                                <th width="8%">Code</th>

                                <th width="12%">Client</th>

                                <th width="8%">Personnel</th>

                                <th hidden width="7%">Dépot</th>
                                <?php
                                foreach ($bonlivraisons as $i => $bonlivraison) :

                                ?>
                                <?php endforeach; ?>

                                <?php if ($bonlivraison->typebl == 1 || $bonlivraison->typebl == 2) { ?>
                                    <th width="8%">Net à payer</th>
                                <?php } ?>
                                <!-- <?php if ($bonlivraison->typebl == 2) { ?>
                                    <th width="3%">Réglement </th>
                                <?php } ?> -->

                                <?php if ($bonlivraison->typebl == 3) { ?>
                                    <th width="8%">Total HT</th>
                                <?php } ?>
                                <?php if ($bonlivraison->typebl == 2) { ?>
                                    <th width="8%" style='text-align:center !important'>Etat </th>
                                <?php } ?>
                                <?php if ($bonlivraison->typebl == 2) { ?>
                                    <th width="10%">Bon de Livraison </th>
                                <?php } ?>
                                <?php if ($bonlivraison->typebl == 2) { ?>
                                    <th width="12%">Bon de commande </th>
                                <?php } ?>
                                <?php if ($bonlivraison->typebl == 1) { ?>
                                    <th width="6%"> Facture </th>
                                    <!-- <th width="8%"> Agent de Controle </th>
                                    <th width="8%"> Chauffeur </th> -->
                                <?php } ?>
                                <?php if ($bonlivraison->typebl == 1) { ?>
                                    <th hidden width="8%"> Facture Divers </th>
                                    <!-- <th width="8%"> Agent de Controle </th>
                                    <th width="8%"> Chauffeur </th> -->
                                <?php } ?>
                                <?php if ($bonlivraison->typebl == 4) { ?>
                                    <th width="3%"> Offre de prix </th>
                                <?php } ?>
                                <?php if ($type == 5) { ?>
                                    <th width="3%"> Devis </th>
                                <?php } ?>

                                <?php if ($type == 1) { ?>
                                    <th width="7%"> </th>
                                <?php } ?>
                                <th width="7%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $totalnet = 0; //debug($bonlivraisons->toarray());
                            foreach ($bonlivraisons as $i => $bonlivraison) :

                                $totalnet = $totalnet + $bonlivraison->totalttc;
                                if ($bonlivraison->factureclient_id != 0) {
                                    $backgroundColor = "#9dc209"; // Couleur de fond si la condition est vraie
                                } else {
                                    $backgroundColor = ""; // Sinon, pas de couleur de fond spécifique
                                }

                                ////////////////client divers////////////////////////////////////////////
                                $bonlivraison_idd = $bonlivraison->id;
                                $connection = ConnectionManager::get('default');


                                $testblregle = $connection->execute('SELECT bonlivraison_id FROM bonlivraisons 
                                INNER JOIN lignereglementclients ON lignereglementclients.bonlivraison_id = bonlivraisons.id 
                               WHERE bonlivraisons.id = ?', [$bonlivraison_idd])->fetchAll('assoc');

                                $testregler = (!empty($testblregle)) ? 1 : 0;
                                // debug($test);
                                // Si le résultat existe, $test vaut 1, sinon il vaut 0
                                //////////////////////////////////////////////////////////////////////////






                            ?>
                                <tr style="font-size: 16px;background-color: <?php echo $backgroundColor; ?>">

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
                                        <td hidden>&nbsp;&nbsp;<?php
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
                                        <td hidden>&nbsp;&nbsp;<?php
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
                                    <?php
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


                                    // $bonlivraison_id = $bonlivraison->id;
                                    // // debug($commande_id);
                                    // $bon = $connection->execute('SELECT * FROM lignebonlivraisons WHERE bonlivraison_id =' . $bonlivraison_id);

                                    // $test22 = 0;

                                    // foreach ($bon as $livv) {
                                    //     $qtec = $livv['qte'];
                                    //     // debug($qtec);
                                    //     $qtef = $connection->execute('SELECT SUM(quantiteliv) as ss FROM lignebonlivraisons WHERE idlignebonlivraison=' . $livv['id'])->fetch('assoc');
                                    //   // debug($qtef['ss']);
                                    //     if ($qtec != $qtef['ss']) {
                                    //         $test22 = 1;
                                    //         // break; // Exit the loop since we already found a mismatch
                                    //     } else {
                                    //         $test22 = 2;
                                    //         // You may choose to break here if you only want the first matching case
                                    //         // break;
                                    //     }
                                    // }

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
                                    <?php if ($bonlivraison->client_id == 12) { ?>
                                        <td>&nbsp;&nbsp;<?php echo $bonlivraison->client->Code ?></td>
                                        <td>&nbsp;&nbsp;<?php echo $bonlivraison->nomprenom ?></td>

                                    <?php } else { ?>
                                        <td>&nbsp;&nbsp;<?php echo $bonlivraison->client->Code ?></td>
                                        <td>&nbsp;&nbsp;<?php echo $bonlivraison->client->Raison_Sociale ?></td>
                                    <?php } ?>

                                    <!-- <td>&nbsp;&nbsp;<?php echo $bonlivraison->client->Code . ' ' . ($bonlivraison->client->Raison_Sociale) ?></td> -->
                                    <td><?php echo  $mm; ?></td>
                                    <td hidden><?= h($bonlivraison->depot->name) ?></td>

                                    <?php if (($bonlivraison->typebl == 1) || ($bonlivraison->typebl == 2)) { ?>
                                        <td align="center"><?= h($bonlivraison->totalttc) ?></td>
                                    <?php } ?>
                                    <?php if ($bonlivraison->typebl == 3) { ?>
                                        <td align="center"><?= h($bonlivraison->totalht) ?></td>
                                    <?php } ?>

                                    <?php if ($bonlivraison->typebl == 2) {
                                        $id = $bonlivraison->id;
                                        // debug($id);

                                        $commandeTotQte = 0;
                                        $BLTotQte = 0;
                                        $connection = ConnectionManager::get('default');
                                        $thisbl = $connection->execute('SELECT * FROM bonlivraisons WHERE bonlivraisons.id = ' . $id . ';')->fetchAll('assoc');
                                        $commande_id = $thisbl[0]['commande_id'];
                                        if (!empty($commande_id)) {
                                            $commandeTotQte = $connection->execute('SELECT SUM(qte) AS sommeqtecmd FROM lignecommandes WHERE commande_id = :commande_id', ['commande_id' => $commande_id])
                                                ->fetch('assoc');
                                            //  debug($commandeTotQte);
                                        }
                                        if (!empty($commande_id)) {
                                            $bls = $connection->execute('SELECT * FROM bonlivraisons WHERE bonlivraisons.commande_id = ' . $commande_id . ' AND bonlivraisons.typebl=1;')->fetchAll('assoc');

                                            if (!empty($bls)) {
                                                $blsIds = [];
                                                foreach ($bls as $bl) {
                                                    $blsIds[] = $bl['id'];
                                                }

                                                $blsIdsString = implode(',', $blsIds);

                                                $BLTotQte = $connection
                                                    ->execute('SELECT SUM(qte) AS sommeqtebl FROM lignebonlivraisons WHERE bonlivraison_id IN (' . $blsIdsString . ')')
                                                    ->fetch('assoc');

                                                // debug($BLTotQte);
                                            }
                                        }
                                        $articlesId = $connection->execute('SELECT article_id FROM lignebonlivraisons WHERE lignebonlivraisons.bonlivraison_id = ' . $id . ';')->fetchAll('assoc');
                                        $commande = $connection->execute('SELECT * FROM commandes WHERE commandes.bonlivraison_id = ' . $id . ';')->fetchAll('assoc');

                                        // debug($commande_id);

                                    ?>
                                        <!-- <td align="center">
                                            <button class="btn btn-sm custom-button btn-success" type="button"  title="regop" onClick="openWindow(1000, 1000, 'https://sirepprefaprod.isofterp.com/ERP/bonlivraisons/reglementop/<?php echo $id ?>');" champ="" value="0">
                                            <i class='fa fa-bars'></i></button>
                                        </td> -->
                                        <?php if ($bonlivraison->typebl == 2) { ?>
                                            <td align="center">
                                                <?php
                                                if ($livraisonComplete) {
                                                    echo '<button class="btn btn-sm custom-button custom-button" style="background-color: #54A74D; color: white;">Livré</button>';
                                                } elseif ($qtef['ss'] == 0) {
                                                    // echo '<p>Quantité totale devis : ' . $qtec . '</p>';
                                                    //  echo '<p>Quantité totale livrée : ' . $qtef['ss'] . '</p>';  
                                                    echo '<button class="btn btn-sm custom-button custom-button" style="background-color: #F55C43; color: white;">En cours</button>';
                                                } else {
                                                    echo '<button class="btn btn-sm custom-button custom-button" style="background-color: #F99048; color: white;">Livré Partiel</button>';
                                                }
                                                ?>
                                            </td>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php
                                    ?>

                                    <?php if ($bonlivraison->typebl == 1 || $bonlivraison->typebl == 3) {
                                        $reg = $connection->execute('SELECT * FROM lignereglementclients WHERE lignereglementclients.bonlivraison_id = ' . $bonlivraison->id . ';')->fetchAll('assoc');
                                    ?>
                                        <td align="center">
                                            <input id="factureclient_id<?= $i ?>" ligne="<?php echo $i; ?>" class="" type="hidden" value="<?= $bonlivraison->factureclient_id ?>">

                                            <!-- <div <?php //if ($bonlivraison->factureclient_id != 0 && empty($reg)) { 
                                                        ?> style="display:none" <?php // } 
                                                                                ?>> -->
                                            <div>
                                                <?php //if (empty($reg) && $bonlivraison->factureclient_id == 0) {
                                                if ($bonlivraison->factureclient_id == 0) { ?>

                                                    <input id="client_id<?= $i ?>" ligne="<?php echo $i; ?>" class="" type="hidden" value="<?= $bonlivraison->client_id ?>">
                                                    <input id="depot_id<?= $i ?>" ligne="<?php echo $i; ?>" class="" type="hidden" value="<?= $bonlivraison->depot_id ?>">

                                                    <input type="checkbox" id="checkbox6<?php echo $i; ?>" value="<?php echo $bonlivraison['id'] ?>" name="checkbox[]" ligne="<?php echo $i; ?>" class="facc6 facture6" />
                                                <?php } ?>
                                            </div>

                                        </td>
                                        <td align="center" hidden>
                                            <input id="factureclient_id<?= $i ?>" ligne="<?php echo $i; ?>" class="" type="hidden" value="<?= $bonlivraison->factureclient_id ?>">

                                            <div <?php if ($bonlivraison->factureclient_id != 0 || $testregler != 1) { ?> style="display:none" <?php } ?>>


                                                <input id="client_id<?= $i ?>" ligne="<?php echo $i; ?>" class="" type="hidden" value="<?= $bonlivraison->client_id ?>">
                                                <input id="depot_id<?= $i ?>" ligne="<?php echo $i; ?>" class="" type="hidden" value="<?= $bonlivraison->depot_id ?>">

                                                <input type="checkbox" id="checkboxdalanda<?php echo $i; ?>" value="<?php echo $bonlivraison['id'] ?>" name="checkbox[]" ligne="<?php echo $i; ?>" class="faccdalanda facturedalanda" />

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
                                    <?php if ($bonlivraison->typebl == 2) { ?>
                                        <td align="center">
                                            <div>
                                                <?php if (!$livraisonComplete && $bonlivraison->commande_id == 0) { ?>
                                                    <input id="client_id<?= $i ?>" ligne="<?php echo $i; ?>" class="" type="hidden" value="<?= $bonlivraison->client_id ?>">
                                                    <input type="checkbox" id="checkbox11<?php echo $i; ?>" value="<?php echo $bonlivraison['id'] ?>" name="checkbox[]" ligne="<?php echo $i; ?>" class="facc55 facture55" />
                                                <?php } ?>
                                            </div>
                                        </td>



                                    <?php } ?>
                                    <?php if ($bonlivraison->typebl == 2) {
                                        //debug( $bonlivraison->confirme) 
                                    ?>
                                        <td align="center">
                                            <div>

                                                <?php if ($bonlivraison->commande_id == 0 && $bonlivraison->confirme != 0) { ?>
                                                    <input id="client_id<?= $i ?>" ligne="<?php echo $i; ?>" class="" type="hidden" value="<?= $bonlivraison->client_id ?>">
                                                    <input type="checkbox" id="check<?php echo $i; ?>" value="<?php echo $bonlivraison['id'] ?>" name="checkbox[]" ligne="<?php echo $i; ?>" class="fac" <?php if ($bonlivraison->etatliv == '1') { ?> style="display:none" <?php } ?> />




                                                <?php } ?>
                                            </div>
                                            <?php
                                            if ($bonlivraison->commande_id != 0) {
                                                $cmdd = [];

                                                $cmdd = $connection->execute('SELECT * FROM commandes WHERE commandes.id = ' . $bonlivraison->commande_id . ';')->fetchAll('assoc');
                                                echo '<strong>' . $cmdd[0]['numero'] . '</strong>';
                                            } ?>
                                            <?php
                                            if ($bonlivraison->commande_id == 0 && $bonlivraison->idbonlivraison == 0) { ?>

                                                <div>
                                                    <input id="client_id<?= $i ?>" ligne="<?php echo $i; ?>" class="" type="hidden" value="<?= $bonlivraison->client_id ?>">
                                                    <input id="depot_id<?= $i ?>" ligne="<?php echo $i; ?>" class="" type="hidden" value="<?= $bonlivraison->depot_id ?>">

                                                    <input type="checkbox" id="checkbox1<?php echo $i; ?>" value="<?php echo $bonlivraison['id'] ?>" name="checkbox[]" ligne="<?php echo $i; ?>" class="facc5 facture5" />
                                                </div>
                                                <!-- <button style="background-color:black" class="btn btn-success btn-xs glyphicon glyphicon-edit opendialogcycle" index=<?php echo $i ?> id="<?php echo '' ?>"></button> -->
                                            <?php  } ?>
                                        </td>
                                    <?php } ?>

                                    <?php if ($bonlivraison->typebl == 4) { ?>
                                        <td align="center">
                                            <?php if ($bonlivraison->id_offredeprix == 0) { ?>
                                                <div <?php if ($bonlivraison->excel == null) { ?> <?php if ($bonlivraison->factureclient_id != 0) { ?> style="display:none" <?php } ?> <?php if ($bonlivraison->commande_id != 0 and $bonlivraison->typebl == 2) { ?> style="display:none" <?php } ?> <?php if ($bonlivraison->bl == 1) { ?> style="display:none" <?php } ?>>
                                                    <input id="client_id<?= $i ?>" ligne="<?php echo $i; ?>" class="" type="hidden" value="<?= $bonlivraison->client_id ?>">
                                                    <input type="checkbox" id="check<?php echo $i; ?>" value="<?php echo $bonlivraison['id'] ?>" name="checkbox[]" ligne="<?php echo $i; ?>" class="offre" <?php if ($bonlivraison->etatliv == '1') { ?> style="display:none" <?php } ?> />
                                                <?php } ?>
                                                </div>

                                            <?php } ?>
                                        </td>
                                    <?php } ?>

                                    <?php if ($bonlivraison->typebl == 5) { ?>
                                        <td align="center">
                                            <div <?php if ($bonlivraison->excel == null) { ?> <?php if ($bonlivraison->factureclient_id != 0) { ?> style="display:none" <?php } ?> <?php if ($bonlivraison->commande_id != 0 and $bonlivraison->typebl == 2) { ?> style="display:none" <?php } ?> <?php if ($bonlivraison->bl == 1) { ?> style="display:none" <?php } ?>>
                                                <input id="client_id<?= $i ?>" ligne="<?php echo $i; ?>" class="" type="hidden" value="<?= $bonlivraison->client_id ?>">
                                                <input type="checkbox" id="check<?php echo $i; ?>" value="<?php echo $bonlivraison['id'] ?>" name="checkbox[]" ligne="<?php echo $i; ?>" class="devis" <?php if ($bonlivraison->etatliv == '1') { ?> style="display:none" <?php } ?> />
                                            <?php } ?>
                                            </div>
                                        </td>
                                    <?php } ?>




                                    <?php if ($bonlivraison->typebl == 1) { ?>
                                        <td align="center"> <?php if ($bonlivraison->totalttc > $bonlivraison->Montant_Regler && $bonlivraison->client_id == 12) { ?>
                                                <div>
                                                    <a
                                                        href="<?php echo $this->Url->build(['controller' => 'Reglementclients', 'action' => 'addreg', 1, $bonlivraison->client_id, $bonlivraison->id]); ?>"
                                                        target="_blank"
                                                        class="btn btn-sm custom-button"
                                                        style="background-color:#0000ff; border-color:#0000ff;color:white;">
                                                        Réglement
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        </td>
                                    <?php } ?>

                                    <!-------------------------- BL ---------------------->

                                    <?php if ($bonlivraison->typebl == 1) { ?>


                                        <td>
                                            <div style="display: flex;">

                                                <?php if ($type == 1) { ?>
                                                    <div style="margin-right:2px ;">
                                                        <a onclick="openWindow(1000, 1000, wr+'Bonlivraisons/imprimeviewsmbm/<?php echo $bonlivraison->id; ?>')"><button class='btn btn-xs btn-primary ' style="background-color: #bb3385 ; color: white; border-color: white;"><i class='fa fa-print'></i></button></a>
                                                    </div>
                                                    <!-- <div style="margin-right:2px ;">
                                                        <a onclick="openWindow(1000, 1000, wr+'Bonlivraisons/imprimeviewbl/<?php echo $bonlivraison->id; ?>')"><button class='btn btn-xs btn-primary '><i class='fa fa-print'></i>PDF</button></a>
                                                    </div> -->

                                                <?php } else { ?>
                                                    <div style="margin-right:2px ;">
                                                        <a onclick="openWindow(1000, 1000, wr+ 'Bonlivraisons/imprimeview/<?php echo $bonlivraison->id; ?>')"><button class='btn btn-xs btn-primary'><i class='fa fa-print'></i>PDF</button></a>
                                                    </div>
                                                <?php } ?>
                                                <div style="margin-right:2px ;">

                                                    <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $bonlivraison->id), array('escape' => false));
                                                    ?>

                                                </div>
                                                <div style="margin-right:2px ;">
                                                    <?php if ($edit == 1) { ?>
                                                        <div <?php if ($bonlivraison->factureclient_id != 0) { ?> style="display:none" <?php } ?>>
                                                            <?php echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $bonlivraison->id), array('escape' => false)); ?>
                                                        </div>
                                                    <?php } ?>
                                                </div>



                                                <?php if ($delete == 1) { ?>
                                                    <div <?php if ($bonlivraison->factureclient_id != 0) { ?> style="display:none" <?php } ?>>

                                                        <?php echo $this->Form->postLink("<button class=' deleteConfirm btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $bonlivraison->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $bonlivraison->id)); ?>
                                                    </div>
                                                <?php } ?>




                                            </div>

                                        </td>
                                    <?php } ?>


                                    <!--------------------------  Offre de prix ---------------------->
                                    <?php if ($bonlivraison->typebl == 2) { ?>
                                        <td>
                                            <div style="display: flex;" align="center">
                                                <div style="margin-right:2px ;">
                                                    <?php echo $this->Html->Link("<button class='btn btn-xs btn-purple'><i class='fa fa-print'></i></button>", array('action' => 'imprimeproforma', $bonlivraison->id), array('escape' => false)); ?>


                                                </div>
                                                <!-- <div style="margin-right:2px ;">
                                                    <?php echo $this->Html->Link("<button class='btn btn-xs btn-primary'><i class='fa fa-print'></i>PDF</button>", array('action' => 'imprimebacg', $bonlivraison->id), array('escape' => false)); ?>


                                                </div> -->
                                                <div style="margin-right:2px ;">


                                                    <?php //echo $this->Html->Link("<button class='btn btn-xs btn-primary'><i class='fa fa-print'></i></button>", array('action' => 'imprimeview', $bonlivraison->id), array('escape' => false)); 
                                                    ?>

                                                    <!-- <?php echo $this->Html->link("<button class='btn btn-xs btn-primary'><i class='fa fa-print'></i></button>", array('action' => 'imprimeview', $bonlivraison->id), array('escape' => false)); ?> -->
                                                </div>
                                                <div style="margin-right:2px ;">
                                                    <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $bonlivraison->id), array('escape' => false));
                                                    ?>
                                                </div>
                                                <div <?php if ($bonlivraison->commande_id != 0) { ?> style="display:none;margin-right:2px ;" <?php } else { ?> style="margin-right:2px ;" <?php } ?>>

                                                    <?php echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $bonlivraison->id), array('escape' => false)); ?>
                                                </div>




                                                <!-- <div style="margin-right:2px ;">
                                                    <?php echo $this->Html->Link("<button class='btn btn-xs btn-purple'><i class='fa fa-print'></i></button>", array('action' => 'imprimeviewbyfamille', $bonlivraison->id), array('escape' => false)); ?>
                                                </div> -->

                                                <div <?php if ($bonlivraison->commande_id != 0) { ?> style="display:none;margin-right:2px ;" <?php } ?>>

                                                    <?php
                                                    echo ("<button type=button index= '" . $i . "' id='delete" . $i . "' class='btn btn-xs btn-danger deleteverif'><i class='fa fa-trash-o'></i></button>");
                                                    ?>


                                                </div>
                                        </td>

                                    <?php } ?>


                                    <!-------------------------- Integration ---------------------->

                                    <?php if ($bonlivraison->typebl == 4) { ?>

                                        <td>
                                            <div style="display: flex;" align="center">
                                                <?php if ($bonlivraison->excel != null) { ?>
                                                    <div style="margin-right:2px ;">
                                                        <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'viewxcl', $bonlivraison->id), array('escape' => false)); ?>
                                                    </div>

                                                    <?php
                                                    if ($edit == 1) { ?>
                                                        <div style="margin-right:2px ;">
                                                        <?php echo $this->Html->link("<button class='btn btn-xs btn-info'><i class='fa fa-check'></i></button>", array('action' => 'editxcl', $bonlivraison->id), array('escape' => false));
                                                    } ?>
                                                        </div>
                                                        <div <?php
                                                                if ($delete == 1) {
                                                                    if ($bonlivraison->id_offredeprix != 0) { ?> style="display:none;margin-right:2px ;" <?php } ?>>

                                                            <?php echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm'><i class='fa fa-trash-o'></i></button>", array('action' => 'deletebr', $bonlivraison->id), array('escape' => false, null)) ?>
                                                        </div>
                                                    <?php }
                                                            } else { ?>
                                                    <div style="margin-right:2px ;">

                                                        <?php //echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $bonlivraison->id), array('escape' => false)); 
                                                        ?>

                                                    </div>

                                                    <div <?php
                                                                if ($edit == 1) {
                                                                    if ($bonlivraison->id_offredeprix != 0) { ?> style="display:none;margin-right:2px ;margin-left:2px ;" <?php } ?>>

                                                    <?php echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $bonlivraison->id), array('escape' => false));
                                                                } ?>
                                                    </div>


                                                    <div style="margin-right:2px ;">
                                                        <?php echo $this->Html->link("<button class='btn btn-xs btn-primary'><i class='fa fa-print'></i></button>", array('action' => 'imprimeview', $bonlivraison->id), array('escape' => false)); ?>
                                                    </div>

                                                    <?php if ($delete == 1) {  ?>
                                                        <div <?php if ($bonlivraison->id_offredeprix != 0) { ?> style="display:none;margin-right:2px ;" <?php } ?>>

                                                            <?php echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm'><i class='fa fa-trash-o'></i></button>", array('action' => 'deletebr', $bonlivraison->id), array('escape' => false, null)) ?>
                                                        </div>

                                                <?php }
                                                            } ?>
                                            </div>
                                        </td>
                                    <?php } ?>

                                    <!--------------------------  bon livraison marchandise ---------------------->

                                    <?php if ($bonlivraison->typebl == 3) { ?>

                                        <td>
                                            <div style="display: flex;" align="center">
                                                <div style="margin-right:2px ;">

                                                    <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'viewm', $bonlivraison->id), array('escape' => false)); ?>

                                                </div>
                                                <div style="margin-right:2px ;">

                                                    <?php echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'editm', $bonlivraison->id), array('escape' => false)); ?>
                                                </div>



                                                <div>

                                                    <?php echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm'><i class='fa fa-trash-o'></i></button>", array('action' => 'deletebrece', $bonlivraison->id), array('escape' => false, null)) ?>
                                                </div>

                                            </div>
                                        </td>
                                    <?php } ?>





                                </tr>



                            <?php endforeach; ?>
                        </tbody>
                        <?php if ($type == 1) { ?>
                            <tr>
                                <td style="color: #a52a2a ;" colspan="5"><strong>
                                        Total Net à payer</strong>
                                </td>
                                <td align="center" style="background-color:#a52a2a ;color:white ;">
                                    <strong> <?php echo $totalnet; ?></strong>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                    <input type="hidden" value="<?php echo $i; ?>" id="index" />
                    <table>

                        <tr>
                            <!-- <?php //if ($this->request->getQuery('datedebut') != '' && $this->request->getQuery('datefin') != '') : 
                                    ?>
                            <button id="printAllButton" class="btn btn-xs btn-primary"><i class="fa fa-print"></i> Imprimer Tout</button>
                        <?php //endif; 
                        ?> -->
                            <td align="center">

                                <?php if ($bonlivraison->typebl == 2) { ?>
                                    <div class="col-md-6  testcheck1" style="display: none;">
                                        <input type="hidden" name="tes1" value="0" class="tespv1" />
                                        <input type="hidden" name="tes1" value="0" class="tes1" />
                                        <input type="hidden" name="nombre1" value="<?php echo @$i; ?>" class="nombre1" />
                                        <a class="btn btn btn-success btnfac5" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;"> <i class="fa fa-plus-circle"></i> Créer bon de commande </a>
                                    </div>
                                    <div class="col-md-6  testcheck11" style="display: none;">
                                        <input type="hidden" name="tes11" value="0" class="tespv11" />
                                        <input type="hidden" name="tes11" value="0" class="tes11" />
                                        <input type="hidden" name="nombre11" value="<?php echo @$i; ?>" class="nombre11" />
                                        <a class="btn btn btn-warning btnfac55" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;"> <i class="fa fa-plus-circle"></i> Créer bon de Livraison </a>
                                    </div>
                                    <!-- <div class="col-md-12  testcheck" style="display:none;">
                                        <input type="hidden" name="tes" value="0" class="tes" />
                                        <input type="hidden" name="tes" value="0" class="tes" />
                                        <input type="hidden" name="nombre" value="<?php echo @$i; ?>" class="nombre" />

                                        <a class="btn btn btn-success " id="com"> <i class="fa fa-plus-circle"></i> Créer bon de commande </a>

                                    </div> -->
                                <?php } ?>
                                <?php if ($bonlivraison->typebl == 1) { ?>
                                    <!-- <div class="col-md-6 testcheck6">
                                        <?php echo $this->Form->create(null, ['url' => ['controller' => 'Bonlivraisons', 'action' => 'enregistrer'], 'class' => 'form-horizontal', 'id' => 'formAddFacture']); ?>
                                        <input type="text" name="tab" value="" id="tabValues">

                                        <input type="hidden" name="tes6" value="0" class="tespv6" />
                                        <input type="hidden" name="tes6" value="0" class="tes6" />
                                        <input type="hidden" name="nombre6" value="<?php echo @$i; ?>" class="nombre1" />
                                        <button type="submit" class="btn btn btn-success btnfac6" id="testcheck6" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">
                                            <i class="fa fa-plus-circle"></i> Créer Facture
                                        </button>
                                        <?php echo $this->Form->end(); ?>
                                    </div> -->
                                    <?php
                                    ?>


                                    <div class="col-md-6  testcheck6" style="display: none;">
                                        <input type="hidden" name="tes6" value="0" class="test6" />
                                        <input type="hidden" name="tes6" value="0" class="test6" />
                                        <input type="hidden" name="nombre" value="<?php echo @$i; ?>" class="nombre" />
                                        <a class="btn btn btn-primary btnfac6" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;"> <i class="fa fa-plus-circle"></i> Créer Facture </a>
                                    </div>
                                    <input type="hidden" name="tab" value="" id="tabValues">

                                    <!-- <div class="col-md-12  testcheck" style="display:none;">
                                        <input type="hidden" name="tes" value="0" class="tes" />
                                        <input type="hidden" name="tes" value="0" class="tes" />
                                        <input type="hidden" name="nombre" value="<?php echo @$i; ?>" class="nombre" />

                                        <a class="btn btn btn-primary  " id="facture"> <i class="fa fa-plus-circle"></i> Facture </a>

                                    </div> -->


                                    <!-- <div class="col-md-6  testcheckdalanda" style="display: none;">
                                        <input type="hidden" name="tesdalanda" value="0" class="testdalanda" />
                                        <input type="hidden" name="tesdalanda" value="0" class="testdalanda" />
                                        <input type="hidden" name="nombre" value="<?php echo @$i; ?>" class="nombre" />
                                        <a class="btn btn btn-warning btnfacdalanda" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;"> <i class="fa fa-plus-circle"></i> Facturation Divers </a>
                                    </div>
                                    <input type="hidden" name="tabdd" value="" id="tabValuess"> -->

                                <?php } ?>



                                <?php if ($bonlivraison->typebl == 4) { ?>

                                    <div class="col-md-12  testcheck" style="display:none;">
                                        <input type="hidden" name="tes" value="0" class="tes" />
                                        <input type="hidden" name="tes" value="0" class="tes" />
                                        <input type="hidden" name="nombre" value="<?php echo @$i; ?>" class="nombre" />

                                        <a class="btn btn btn-success " id="offrebutton"> <i class="fa fa-plus-circle"></i> Créer offre de prix </a>

                                    </div>
                                <?php } ?>
                                <?php if ($bonlivraison->typebl == 5) { ?>

                                    <div class="col-md-12  testcheck" style="display:none;">
                                        <input type="hidden" name="tes" value="0" class="tes" />
                                        <input type="hidden" name="tes" value="0" class="tes" />
                                        <input type="hidden" name="nombre" value="<?php echo @$i; ?>" class="nombre" />

                                        <a class="btn btn btn-primary  " id="devisbutton"> <i class="fa fa-plus-circle"></i> Créer devis </a>

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
            updateMyButtonVisibility();
            updateTabValues(); // Mise à jour des valeurs des cases cochées
        });

        checkboxes.on("change", function() {
            updateButtonText();
            updateMyButtonVisibility(this);
            updateTabValues(); // Mise à jour des valeurs des cases cochées
        });

        function updateButtonText() {
            selectAllButton.text(checkboxes.filter(":checked").length === checkboxes.length ?
                "Désélectionner Tout" :
                "Sélectionner Tout"
            );
        }

        function updateMyButtonVisibility(checkbox) {
            if (checkboxes.filter(":checked").length > 0) {
                $(".testcheck6").show();
            } else {
                $(".testcheck6").hide();
            }
        }

        // Fonction pour mettre à jour les valeurs de l'input hidden
        // function updateTabValues() {
        //     var tabValues = [];
        //     checkboxes.each(function() {
        //         if ($(this).is(':checked')) {
        //             tabValues.push($(this).val());
        //         }
        //     });
        //     var divid = tabValues.join(',');
        //     $("#tabValues").val(tabValues.join(',')); // Met à jour la valeur de l'input hidden avec les IDs des bons de livraison sélectionnés séparés par des virgules
        // }
        function updateTabValues() {
            var tabValues = [];
            checkboxes.each(function() {
                if ($(this).is(':checked')) {
                    // Check if the corresponding factureclient_id is 0
                    var index = $(this).attr('ligne');
                    if ($("#factureclient_id" + index).val() == 0) {
                        tabValues.push($(this).val());
                    }
                }
            });
            var divid = tabValues.join(',');
            $("#tabValues").val(tabValues.join(',')); // Met à jour la valeur de l'input hidden avec les IDs des bons de livraison sélectionnés séparés par des virgules
        }
    });


    $(document).ready(function() {


   





        // $('.btnfac61704').on('click', function() {
        //     var tabValues = $('#tabValues').val(); // Récupérer les valeurs des cases cochées

        //     $.ajax({
        //         method: "GET",
        //         url: "<?= $this->Url->build(['controller' => 'Bonlivraisons', 'action' => 'getids']) ?>",
        //         dataType: "json",
        //         data: {
        //             tabValues: tabValues
        //         },
        //         success: function(data) {

        //         },

        //     });

        // });
        $('.btnfac6').on('click', function() {
            var tabValues = $('#tabValues').val(); // Récupérer les valeurs des cases cochées
            // Soumettre les données au serveur
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Bonlivraisons', 'action' => 'getids']) ?>",
                dataType: "json",
                data: {
                    tabValues: tabValues
                },
                success: function(data) {
                    alert('Factures Ajoutées avec succès')
                    // Redirect to the same page after successful AJAX request
                    window.location.href = wr + 'Factureclients/index';

                },
                error: function(xhr, status, error) {
                    // Handle errors if needed
                    console.error(xhr.responseText);
                }
            });
        });
        $('.facture6').on('click', function() {

            $('.testcheck6').show();

        });
    });
</script>



<script>
    // $(document).ready(function() {
    //     const selectAllButton = $("#select-all");
    //     const checkboxes = $(".faccdalanda");

    //     selectAllButton.on("click", function() {
    //         checkboxes.prop("checked", !checkboxes.prop("checked"));
    //         updateButtonText();
    //         updateMyButtonVisibility();
    //         updateTabValues(); // Mise à jour des valeurs des cases cochées
    //     });

    //     checkboxes.on("change", function() {
    //         updateButtonText();
    //         updateMyButtonVisibility(this);
    //         updateTabValues(); // Mise à jour des valeurs des cases cochées
    //     });

    //     function updateButtonText() {
    //         selectAllButton.text(checkboxes.filter(":checked").length === checkboxes.length ?
    //             "Désélectionner Tout" :
    //             "Sélectionner Tout"
    //         );
    //     }

    //     function updateMyButtonVisibility(checkbox) {
    //         if (checkboxes.filter(":checked").length > 0) {
    //             $(".testcheckdalanda").show();
    //         } else {
    //             $(".testcheckdalanda").hide();
    //         }
    //     }

    //     function updateTabValues() {
    //         var tabValuess = [];
    //         checkboxes.each(function() {
    //             if ($(this).is(':checked')) {
    //                 // Check if the corresponding factureclient_id is 0
    //                 var index = $(this).attr('ligne');
    //                 if ($("#factureclient_id" + index).val() == 0) {
    //                     tabValuess.push($(this).val());
    //                 }
    //             }
    //         });
    //         var divid = tabValuess.join(',');
    //         $("#tabValuess").val(tabValuess.join(',')); // Met à jour la valeur de l'input hidden avec les IDs des bons de livraison sélectionnés séparés par des virgules
    //     }
    // });



</script>
<script type="text/javascript">
    $('.facc5').on('click', function() {
        /// alert('nfskn')
        //var tab = new Array;
        ligne = $(this).attr('ligne');
        index = $('#index').val();
        // alert(index)
        test = 0;
        for (i = 0; i <= Number(index); i++) {
            if ($('#checkbox1' + i).is(':checked')) {
                //alert('hedh')
                test = 1;
            }
        }
        if (test == 1) {
            $('.testcheck1').show();
            // depot = $('#depot_id' + ligne).val();
            client = $('#client_id' + ligne).val();
            // fournisseur = $('#fournisseur_id' + ligne).val();
            //alert(client);
            if ($('.tes1').val() == 0) {
                $('.tes1').val(client);
            }
            if (($('.tes1').val() != client) && $('.tes1').val() != 0) {
                alert('Il faut choisir des Bon Commandes Client  pour un meme Client SVP !!');
                return false;
            }
        }
        if (test == 0) {
            //alert("fera8");
            $('.tes1').val(0);
            $('.tespv1').val(0);
            $('.testcheck1').hide();
        }




    });


    $('.btnfac5').on('click', function() {

        var tab = new Array;
        conteur = $('.nombre1').val();
        //  ligne = $(this).attr('ligne');

        // client = $('#client_id' + ligne).val();
        for (var i = 0; i <= conteur; i++) {
            val = ($('#checkbox1' + i).attr('checked'));
            v = $('#checkbox1' + i).val();
            if ($('#checkbox1' + i).is(':checked')) {
                tab[i] = v;
                // alert(tab[i]);
                $('#checkbox1' + i).hide();
                //alert('dd');
            }
        }
        var removeItem = undefined;
        tab = jQuery.grep(tab, function(value) {
            return value != removeItem;
        })

        // window.open("https://facturation.isofterp.com/mtd/FactureAchats/addfacture/" + tab);
        window.open(wr + "Commandes/addcommande/" + tab);
        //  alert(tab[i] );
        //$(this).attr("href", "Factureclients/addfacture/" + tab)
        //  $('.testcheck').hidden();
    });


    $('.facture5').on('click', function() {

        $('.testcheck1').show();

    });
    ////////////////facture//////////////////







  




    /////////////////////////////////////
    $('.facc55').on('click', function() {
        /// alert('nfskn')
        //var tab = new Array;
        ligne = $(this).attr('ligne');
        index = $('#index').val();
        // alert(index)
        test = 0;
        for (i = 0; i <= Number(index); i++) {
            if ($('#checkbox11' + i).is(':checked')) {
                //alert('hedh')
                test = 1;
            }
        }
        if (test == 1) {
            $('.testcheck11').show();
            // depot = $('#depot_id' + ligne).val();
            client = $('#client_id' + ligne).val();
            // fournisseur = $('#fournisseur_id' + ligne).val();
            //alert(client);
            if ($('.tes11').val() == 0) {
                $('.tes11').val(client);
            }
            if (($('.tes11').val() != client) && $('.tes11').val() != 0) {
                alert('Il faut choisir des Bon Livraisons  pour un meme Client SVP !!');
                return false;
            }
        }
        if (test == 0) {
            //alert("fera8");
            $('.tes11').val(0);
            $('.tespv11').val(0);
            $('.testcheck11').hide();
        }




    });


    $('.btnfac55').on('click', function() {

        var tab = new Array;
        conteur = $('.nombre11').val();
        //  ligne = $(this).attr('ligne');

        // client = $('#client_id' + ligne).val();
        for (var i = 0; i <= conteur; i++) {
            val = ($('#checkbox11' + i).attr('checked'));
            v = $('#checkbox11' + i).val();
            if ($('#checkbox11' + i).is(':checked')) {
                tab[i] = v;
                // alert(tab[i]);
                $('#checkbox11' + i).hide();
                //alert('dd');
            }
        }
        var removeItem = undefined;
        tab = jQuery.grep(tab, function(value) {
            return value != removeItem;
        })

        // window.open("https://facturation.isofterp.com/mtd/FactureAchats/addfacture/" + tab);
        window.open(wr + "Bonlivraisons/addbonlivraisond/" + tab);
        //  alert(tab[i] );
        //$(this).attr("href", "Factureclients/addfacture/" + tab)
        //  $('.testcheck').hidden();
    });


    $('.facture55').on('click', function() {

        $('.testcheck11').show();

    });
    $(function() {
        $('.deleteverif').on('click', function() {
            ind = $(this).attr('index');
            id = $('#id' + ind).val();

            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Bonlivraisons', 'action' => 'verif']) ?>",
                dataType: "json",
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function(data) {
                    if (data.lignereg != 0) {
                        alert('déjà existe dans un règlement');
                    } else {
                        if (confirm('Voulez-vous vraiment supprimer cet enregistrement')) {
                            window.location = "<?= $this->Url->build(['controller' => 'Bonlivraisons', 'action' => 'deletebr']) ?>/" + id;
                        }
                    }
                }
            })
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const numeroInput = document.querySelector('input[name="numero"]');
        const datedebutInput = document.getElementById('datedebut');
        const datefinInput = document.getElementById('datefin');
        const clientcIdSelect = $('#idclient');
        const clientnIdSelect = $('#idclient1');
        const facturee = document.getElementById('facturee');
        const searchForm = document.getElementById('searchForm');

        console.log('DOM entièrement chargé');

        // Initialize select2 on both dropdowns
        clientcIdSelect.select2();
        clientnIdSelect.select2();

        // Function to submit the form
        function submitForm() {
            searchForm.submit();
        }

        // Event listener for changes on select elements
        clientcIdSelect.on('change', function() {
            clientnIdSelect.val(clientcIdSelect.val()).trigger('change.select2');
        });

        clientnIdSelect.on('change', function() {
            clientcIdSelect.val(clientnIdSelect.val()).trigger('change.select2');
        });

        // Event listener for form submission when pressing Enter
        document.addEventListener('keydown', function(e) {
            // Check if Enter key is pressed
            if (e.key === 'Enter') {
                const activeElement = document.activeElement;

                // Check if active element is one of the inputs or select2 elements
                if (
                    activeElement === numeroInput ||
                    activeElement === datedebutInput ||
                    activeElement === datefinInput ||
                    activeElement === facturee ||
                    $(activeElement).hasClass('select2-search__field') || // Select2 search field
                    $(activeElement).closest('.select2-container').length // Select2 container
                ) {
                    return; // Do nothing if focus is on these elements
                }

                // Prevent default Enter key behavior and submit form
                e.preventDefault();
                submitForm();
            }
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
<script type="text/javascript">
    $j = jQuery.noConflict();

    $(document).ready(function() {


        $j("#dialogcycle").dialog({
            autoOpen: false,
            width: 500,
            modal: true,

            open: function(event, ui) {
                originalContent = $("#dialogcycle").html();
                $j('.ui-widget-overlay').bind('click', function() {

                    $j("#dialogcycle").dialog('close');
                    $("#dialogcycle").html(originalContent);

                });
            }

        });
        $j('.opendialogcycle').on('click', function() {

            index = $(this).attr('index');
            id = $('#id' + index).val();
            $('#iddialog').val(id);
            $j("#dialogcycle").dialog('open');
        });
    });
</script>