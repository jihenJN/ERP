<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fournisseur $fournisseur
 */
?>
<?php

use Cake\Datasource\ConnectionManager;

error_reporting(E_ERROR | E_PARSE);

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('mariem'); ?>
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->script('js_vieww_projet'); ?>
<?php echo $this->fetch('script'); ?>
<section class="content-header">
    <h1>
        Visualiser facture client
        <small>
            <?php echo __(''); ?>
        </small>
    </h1>
    <?php if (!empty($project_id)) { ?>
        <ol class="breadcrumb">
            <li><a href="<?php echo $this->Url->build(['action' => 'vieww', $project_id]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
        </ol>
    <?php } else { ?>
        <ol class="breadcrumb">
            <li><a href="<?php echo $this->Url->build(['action' => 'etatfinanceprojet']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
        </ol>
    <?php } ?>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>
                </div>
                <?php echo $this->Form->create($factureclient, ['role' => 'form']); ?>
                <div class="box-body">
                    <div class="row">
                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="col-xs-6">
                                    <?php
                                    echo $this->Form->control('numero', ['readonly' => 'readonly', 'value' => $factureclient->numero, 'label' => 'Numero', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-6">
                                    <?php
                                    echo $this->Form->control('date',  ['readonly' => 'readonly', "value" => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime(date('Y-m-d H:i:s'))))]); ?>
                                </div>
                            </div>
                        </div>
                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                            <div class="row">
                                <div class="col-xs-6">

                                    <?php echo $this->Form->control('client_id', ['style' => "pointer-events: none;",  'readonly', 'value' => $factureclient->client_id, 'id' => 'client', 'options' => $clients, 'empty' => 'Veuillez choisir !!', 'label' => 'Clients', 'class' => 'form-control  control-label']); ?>
                                </div>
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('projet_id', ['style' => "pointer-events: none;",  'readonly', 'value' => $factureclient->projet_id, 'options' => $projets, 'empty' => 'Veuillez choisir !!', 'required' => 'off', 'label' => 'Dépot', 'class' => 'form-control  control-label']); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-2">
                                <?php echo $this->Form->control('incoterm_id', ['options' => $incoterms, 'empty' => 'Veuillez choisir !!', 'value' => $factureclient->incoterm_id, 'id' => 'incoterm_id', 'class' => 'form-control select2']); ?>
                            </div>
                            <div class="col-xs-2">
                                <?php echo $this->Form->control('location_incoterms', ['empty' => 'Veuillez choisir !!', 'value' => $factureclient->location_incoterms, 'id' => 'location_incoterms', 'class' => 'form-control']); ?>
                            </div>
                            <div class="col-xs-2">
                                <?php echo $this->Form->control('options_incotermtotalpdf', ['options' => $options_incotermtotalpdf, 'label' => 'Incoterm du total en pdf', 'empty' => 'Veuillez choisir !!', 'value' => $factureclient->options_incotermtotalpdf, 'id' => 'options_incotermtotalpdf', 'class' => 'form-control select2']); ?>
                            </div>
                            <div class="col-xs-6">
                                <?php
                                $options_istotaltransportdetaille = [1  => 'oui', 2 => 'non'];
                                echo $this->Form->control('options_istotaltransportdetaille', ['options' => $options_istotaltransportdetaille, 'label' => 'Détail des montants de transport en pdf ', 'empty' => 'Veuillez choisir !!', 'value' => $factureclient->options_istotaltransportdetaille, 'id' => 'options_incotermtotalpdf', 'class' => 'form-control select2']); ?>
                            </div>
                            <div class="col-xs-12">
                                <?php echo $this->Form->control('options_indicationenpdf', ['type' => 'textarea', 'label' => 'Transports incoterm entre le port d embarquement et le port de destination', 'empty' => 'Veuillez choisir !!', 'value' => $factureclient->options_indicationenpdf, 'id' => 'options_indicationenpdf', 'class' => 'form-control']); ?>
                            </div>
                        </div>

                        <section class="content-header">
                            <h1 class="box-title">
                                <?php echo __('Ligne facture client'); ?>
                            </h1>
                        </section>
                        <section class="content" style="width: 99%">
                            <div class="row">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive ls-table">
                                            <table class="table table-bordered table-striped table-bottomless" id="addtable">
                                                <thead>
                                                    <tr width:20px>
                                                        <td align="center" style="width: 12%; font: size 20px;">
                                                            <strong>Produit</strong>
                                                        </td>
                                                        <td align="center" style="width: 5%;"><strong>Quantite </strong>
                                                        </td>
                                                        <td align="center" style="width: 3%;"><strong>P.U.H.T</strong>
                                                        </td>
                                                        <td align="center" style="width: 3%;"><strong>Remise</strong>
                                                        </td>
                                                        <td hidden align="center" style="width: 3%;"><strong>Prix HT</strong>
                                                        </td>
                                                        <td align="center" style="width: 1%; font: size 5px;"><strong style="font: size 5px;">TVA</strong></td>
                                                        <td align="center" style="width: 3%;"><strong> Fodec </strong>
                                                        </td>
                                                        <td align="center" style="width: 3%;"><strong> TTC </strong>
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($lignefactureclient as $i => $res) :
                                                    ?>
                                                        <tr>
                                                            <td align="center">
                                                                <?php echo $res->article->Dsignation;
                                                                echo $this->Form->input('sup', array('name' => "data[ligner][" . $i . "][sup]", 'id' => 'supp' . $i, 'champ' => 'sup', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => '', 'class' => 'form-control', 'type' => 'hidden')); ?>
                                                                <?php
                                                                echo $this->Form->input(
                                                                    'id',
                                                                    array(
                                                                        'champ' => 'id',
                                                                        'label' => '',
                                                                        'name' => 'data[ligner][' . $i . '][id]',
                                                                        'value' => $res->id,
                                                                        'type' => 'hidden',
                                                                        'id' => '',
                                                                        'table' => 'ligner',
                                                                        'index' => '',
                                                                        'div' => 'form-group',
                                                                        'between' => '<div class="col-sm-12">',
                                                                        'after' => '</div>',
                                                                        'class' => 'form-control'
                                                                    )
                                                                );
                                                                ?>
                                                            </td>
                                                            <td align="center">
                                                                <?php
                                                                echo $res->qte;
                                                                echo $this->Form->input('qte', array('label' => '', 'value' => $res->qte, 'name' => 'data[ligner][' . $i . '][qte]', 'type' => 'hidden', 'id' => 'qte' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calcullignecommande ', 'index')); ?>
                                                            </td>
                                                            <td hidden align="center">
                                                                <?php
                                                                echo $res->punht;
                                                                echo $this->Form->input('prix', array('label' => '', 'value' => $res->punht, 'name' => 'data[ligner][' . $i . '][prix]', 'type' => 'hidden', 'id' => 'prix' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control pourcentescompte', 'index')); ?>
                                                            </td>
                                                            <td align="center">

                                                                <?php
                                                                echo $res->remise;
                                                                echo $this->Form->input('remise', array('label' => '', 'value' => $res->remise, 'name' => 'data[ligner][' . $i . '][remise]', 'type' => 'hidden', 'id' => 'prix' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control pourcentescompte', 'index')); ?>
                                                            </td>
                                                            <td align="center">
                                                                <?php
                                                                echo $res->prixht;
                                                                echo $this->Form->input('prixht', array('label' => '', 'value' => $res->prixht, 'name' => 'data[ligner][' . $i . '][prixht]', 'type' => 'hidden', 'id' => 'prix' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control pourcentescompte', 'index')); ?>
                                                            </td>
                                                            <td align="center">
                                                                <?php
                                                                echo $res->fodec;
                                                                echo $this->Form->input('fodec', array('label' => '', 'value' => $res->fodec, 'name' => 'data[ligner][' . $i . '][fodec]', 'type' => 'hidden', 'id' => 'fodec' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>
                                                            </td>
                                                            <td align="center">
                                                                <?php
                                                                echo $res->tva;
                                                                echo $this->Form->input('tva', array('value' => $res->tva, 'label' => '', 'name' => 'data[ligner][' . $i . '][tva]', 'type' => 'hidden', 'id' => 'tva' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>
                                                            </td>
                                                            <td align="center">
                                                                <?php
                                                                echo $res->ttc;
                                                                echo $this->Form->input('ttc', array('label' => '', 'value' => $res->ttc, 'name' => 'data[ligner][' . $i . '][ttc]', 'type' => 'hidden', 'id' => 'ttc' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    <input type="hidden" value="<?php echo $i ?>" id="index">
                                                </tbody>
                                            </table><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <table class="table table-bordered table-striped table-bottomless" id="addtable">
                        <thead>
                            <tr>
                                <th align="center"><strong>Brut Ht</strong></th>
                                <th align="center"><strong>Remise</strong></th>
                                <th align="center"><strong>Net HT</strong></th>
                                <th align="center"><strong>Fodec</strong></th>
                                <th align="center"><strong>Base HT</strong></th>
                                <th align="center"><strong>TTC</strong></th>
                                <th align="center"><strong>TVA</strong></th>
                                <th align="center"><strong>Net à payer</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo sprintf("%01.3f", $factureclient->totalht + $factureclient->totalremise); ?></td>
                                <td><?php echo $factureclient->totalremise; ?></td>
                                <td><?php echo $factureclient->totalht; ?></td>
                                <td><?php echo $factureclient->totalfodec; ?></td>
                                <td><?php echo sprintf("%01.3f", $factureclient->totalht + $factureclient->totalfodec); ?></td>
                                <td><?php echo $factureclient->totalttc; ?></td>
                                <td><?php echo $factureclient->totaltva; ?></td>
                                <td><?php echo sprintf("%01.3f", $factureclient->totalttc + $timbre * 1000); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <section hidden class="content" style="width: 99%">
                        <div class="row">
                            <div hidden class="row">
                                <div style=" position: static;">
                                    <div class="col-xs-4">
                                        <?php
                                        echo sprintf("%01.3f", $factureclient->totalht + $factureclient->totalremise);
                                        echo $this->Form->control('brut', ['id' => 'brutHT', 'type' => 'hidden', 'value' => sprintf("%01.3f", $factureclient->totalht + $factureclient->totalremise), 'readonly' => 'readonly', 'label' => 'Brut HT', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4">
                                        <?php echo $this->Form->control('totalremise', ['id' => 'totalremise', 'readonly' => 'readonly', 'value' => $factureclient->totalremise, 'label' => 'Total remise', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4 pull-right">
                                        <?php echo $this->Form->control('netapayer', ['id' => 'netapayer', 'value' => sprintf("%01.3f", $factureclient->totalttc + $timbre * 1000), 'readonly' => 'readonly', 'label' => 'Net à payé', 'name', 'required' => 'off']); ?>
                                    </div>
                                </div>
                            </div>
                            <div hidden class="row">
                                <div style=" position: static;">
                                    <div class="col-xs-4">
                                        <?php echo $this->Form->control('total', ['value' => $factureclient->totalht, 'id' => 'total', 'readonly' => 'readonly', 'label' => 'Net HT', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4">
                                        <?php echo $this->Form->control('fod', ['value' => $factureclient->totalfodec, 'id' => 'fod', 'readonly' => 'readonly', 'label' => 'Taux de marque', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4">
                                        <?php echo $this->Form->control('totalttc', ['value' => $factureclient->totalttc, 'id' => 'totalttccommande', 'readonly' => 'readonly', 'label' => 'TTC', 'name', 'required' => 'off']); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div style=" position: static;">
                                    <div class="col-xs-4">
                                        <?php echo $this->Form->control('base', ['id' => 'baseHT', 'value' => sprintf("%01.3f", $factureclient->totalht + $factureclient->totalfodec), 'readonly' => 'readonly', 'label' => 'Base HT', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4">
                                        <?php echo $this->Form->control('tvacommande', ['value' => $factureclient->totaltva, 'id' => 'tvacommande', 'readonly' => 'readonly', 'label' => 'TVA', 'name', 'required' => 'off']); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-5">
                                <?php echo $this->Form->control('remise', ['value' => $factureclient->client->remise, 'type' => 'hidden', 'id' => 'remise', 'readonly' => 'readonly', 'label' => '', 'name', 'required' => 'off']); ?>
                            </div>
                            <div class="col-xs-5">
                                <?php echo $this->Form->control('comptant', ['type' => 'hidden', 'id' => 'comptant', 'readonly' => 'readonly', 'label' => '', 'name', 'required' => 'off']); ?>
                                <?php echo $this->Form->control('fodeccommande', ['type' => 'hidden', 'id' => 'fodeccommande', 'readonly' => 'readonly', 'label' => '', 'name', 'required' => 'off']); ?>
                                <?php echo $this->Form->control('basetva', ['type' => 'hidden', 'id' => 'basetva', 'readonly' => 'readonly', 'label' => '', 'name', 'required' => 'off']); ?>
                            </div>
                        </div>
                    </section>

                    <section class="content-header">
                        <h1 class="box-title"><?php echo __('Mode de Réglement'); ?></h1>
                    </section>

                    <section class="content" style="width: 99%">
                        <div class="row">

                            <div class="box box-primary">
                                <div class="box box-">

                                    <div class="panel-body">
                                        <div class="table-responsive ls-table">
                                            <table class="table table-bordered table-striped table-bottomless" id="addtable">
                                                <?php $read = "";
                                                $i = -1;
                                                foreach ($piecereglementclients as $i => $piece) {
                                                    $i++;
                                                ?>
                                                    <thead>
                                                        <th>Mode de paiement</th>
                                                        <th>Montant</th>
                                                        <th>Banque</th>
                                                        <th>Date</th>

                                                    </thead>
                                                    <tbody>
                                                        <td><?php echo $piece->paiement->name; ?></td>
                                                        <td><?php echo $piece->montant; ?></td>
                                                        <td><?php echo $piece->banque->name; ?></td>
                                                        <td><?php echo $piece->echance; ?></td>
                                                    </tbody>



                                                    <tr hidden>

                                                        <td colspan="8" style="vertical-align: top;">
                                                            <table>
                                                                <tr>
                                                                    <td>Mode règlement </td>
                                                                    <td><?php
                                                                        echo $this->Form->input(
                                                                            'paiement_id',
                                                                            [
                                                                                'options' => $options,
                                                                                'value' => $piece->paiement_id,
                                                                                'div' => 'form-group',
                                                                                'between' => '<div class="col-sm-10">',
                                                                                'after' => '</div>',
                                                                                'class' => 'form-control  paiement_id limite modereglement2 modereglement select',
                                                                                'label' => '',
                                                                                'index' => $i,
                                                                                'id' => 'paiement_id' . $i,
                                                                                'champ' => 'paiement_id',
                                                                                'table' => 'pieceregelemnt',
                                                                                'name' => 'data[pieceregelemnt][' . $i . '][paiement_id]'
                                                                            ]
                                                                        );
                                                                        ?>
                                                                        <?php echo $this->Form->input('id', array('value' => $piece->id, 'name' => 'data[pieceregelemnt][' . $i . '][id]', 'id' => 'id' . $i, 'champ' => 'id', 'table' => 'pieceregelemnt', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'type' => 'hidden', 'after' => '</div>', 'class' => 'form-control limite', 'label' => 'Nom')); ?>
                                                                        <?php echo $this->Form->input('sup', array('name' => 'data[pieceregelemnt][' . $i . '][sup]', 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'pieceregelemnt', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'type' => 'hidden', 'after' => '</div>', 'class' => 'form-control', 'label' => 'Nom')); ?>
                                                                    </td>
                                                                </tr>
                                                                <tr <?php if ($piece->paiement_id != 5) { ?> style="display:none" <?php } ?> id="trmontantbrut<?php echo $i ?>">
                                                                    <td name="data[piece][<?php echo $i ?>][trmontantbrut]" id="trmontantbruta<?php echo $i ?>" index="<?php echo $i ?>" champ="trmontantbruta" table="piece" class="modecheque">Montant brut</td>
                                                                    <td name="data[piece][<?php echo $i ?>][trmontantbrut]" id="trmontantbrutb<?php echo $i ?>" index="<?php echo $i ?>" champ="trmontantbrutb" table="piece" class="modecheque"><?php
                                                                                                                                                                                                                                                    echo $this->Form->input('montant_brut', array('value' => $piece->montant_brut, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control editmontantbrut', 'label' => '', 'type' => 'text', 'index' => $i, 'champ' => 'montantbrut', 'id' => 'montantbrut' . $i, 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][montant_brut]'));
                                                                                                                                                                                                                                                    ?> </td>
                                                                </tr>
                                                                <tr <?php if ($piece->paiement_id != 5) { ?> style="display:none" <?php } ?> id="trtaux<?php echo $i ?>">
                                                                    <td name="data[piece][<?php echo $i ?>][trtaux]" id="trtauxa<?php echo $i ?>" index="<?php echo $i ?>" champ="trtauxa" table="piece" class="modecheque">Taux</td>
                                                                    <td name="data[piece][<?php echo $i ?>][trtaux]" id="trtauxb<?php echo $i ?>" index="<?php echo $i ?>" champ="trtauxb" table="piece" class="modecheque"><?php
                                                                                                                                                                                                                            echo $this->Form->input('valeur_id', array('value' => $piece->to_id, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'select limite editmontantbrut', 'label' => '', 'index' => $i, 'champ' => 'taux', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][taux]', 'id' => 'taux' . $i, 'empty' => 'Veuillez choisir'));
                                                                                                                                                                                                                            ?> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Montant</td>
                                                                    <td><?php
                                                                        echo $this->Form->input('montant', array('value' => $piece->montant, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control limite testmontantreglementachat  bl calculdiff mnt', 'label' => '', 'index' => $i, 'champ' => 'montant', 'id' => 'montant' . $i, 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][montant]'));
                                                                        ?>
                                                                    </td>
                                                                </tr>

                                                                <tr hidden>
                                                                    <td hidden> Nombre de jours </td> <!-- mnt bl -->
                                                                    <td hidden>
                                                                        <?php
                                                                        echo $this->Form->control('nbjour', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => ' limite form-control ', 'label' => '', 'index' => '', 'champ' => 'nbjour', 'table' => 'pieceregelemnt', 'id' => 'nbjour' . $i, 'name' => ''));
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                                <tr hidden>
                                                                    <td hidden> Date limite de paiement </td>
                                                                    <td hidden>
                                                                        <?php
                                                                        echo $this->Form->control('limite', array('div' => 'form-group', 'type' => 'text', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => ' limite form-control ', 'label' => '', 'index' => '', 'champ' => 'limite', 'table' => 'pieceregelemnt', 'id' => 'limite' . $i, 'name' => ''));
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                                <tr <?php if ($piece->paiement_id != 5) { ?> style="display:none" <?php } ?> id="trmontantnet<?php echo $i ?>">
                                                                    <td name="data[piece][<?php echo $i ?>][trmontantnet]" id="trmontantneta<?php echo $i ?>" index="<?php echo $i ?>" champ="trmontantneta" table="piece" class="modecheque">Montant Net</td>
                                                                    <td name="data[piece][<?php echo $i ?>][trmontantnet]" id="trmontantnetb<?php echo $i ?>" index="<?php echo $i ?>" champ="trmontantnetb" table="piece" class="modecheque"><?php
                                                                                                                                                                                                                                                echo $this->Form->input('montant_net', array('value' => $piece->montant_net, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control limite', 'label' => '', 'type' => 'text', 'index' => $i, 'id' => 'montantnet' . $i, 'champ' => 'montantnet', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][montantnet]'));
                                                                                                                                                                                                                                                ?> </td>
                                                                </tr>
                                                                <tr <?php
                                                                    if (($piece->paiement_id == 1) || ($piece->paiement_id == 5)) { ?> style="display:none" <?php } ?> id="trechances<?php echo $i ?>">
                                                                    <td name="data[piece][<?php echo $i ?>][trechance]" id="trechancea[<?php echo $i ?>" index="[<?php echo $i ?>" champ="trechancea" table="piece" class="modecheque">Echéance</td>
                                                                    <td name="data[piece][<?php echo $i ?>][trechance]" id="trechanceb[<?php echo $i ?>" index="[<?php echo $i ?>" champ="trechanceb" table="piece" class="modecheque">
                                                                        <?php
                                                                        echo $this->Form->input('echance', array('value' => $piece->echance, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control limite depassedate ', 'label' => '', 'type' => 'date', 'index' => 0, 'champ' => 'echance', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][echance]'));
                                                                        ?>
                                                                    </td>

                                                                </tr>
                                                                <tr <?php
                                                                    if ($piece->paiement_id == 1) { ?>style="display:none" <?php } ?> id="trbanque<?php echo $i; ?>">
                                                                    <td name="data[piece][<?php echo $i ?>][trbanque]" id="trbanque<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque">Banque</td>
                                                                    <td name="data[piece][<?php echo $i ?>][trbanque]" id="trbanque<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque">
                                                                        <?php
                                                                        echo $this->Form->control('banque_id', [
                                                                            'class' => 'form-control select2',
                                                                            'label' => '',
                                                                            'empty' => 'Veuillez choisir !!',
                                                                            'value' => $piece->banque_id,
                                                                        ]);
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                                <tr <?php if (($piece->paiement_id == 1)) { ?> style="display:none" <?php } ?> id="trnums<?php echo $i  ?>">
                                                                    <td name="data[piece][<?php echo $i ?>][trnum]" id="trnuma<?php echo $i ?>" index="<?php echo $i ?>" champ="trnuma" table="piece" class="modecheque">Numéro pièce</td>
                                                                    <div class='form-group' id="divnumc<?php echo $i ?>" index="<?php echo $i ?>" champ="divnumc" table="piece" <?php if ($piece->paiement_id != 2) { ?> style="display:none" <?php } ?>>
                                                                        <label class='col-md-2 control-label'></label>
                                                                        <div class="col-sm-10" id="trnumc<?php echo $i ?>" index="<?php echo $i ?>" champ="trnumc" table="piece">
                                                                        </div>
                                                                    </div>
                                                                    <td name="data[piece][<?php echo $i ?>][trcarnetnum]" id="trcarnetnum<?php echo $i ?>" index="<?php echo $i ?>" champ="trcarnetnumb" table="piece" style="display:none" class="modecheque"><?php echo $this->Form->input('carnetcheque_id', array('value' => $piece->carnetcheque_id, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control  getnumcheque  ', 'empty' => 'veuillez choisir', 'label' => '', 'index' => $i, 'champ' => 'carnetcheque_id', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][carnetcheque_id]')); ?></td>
                                                                    <td>
                                                                        <div class='form-group ' id="divnump<?php echo $i ?>" index="<?php echo $i ?>" champ="divnump" table="piece" <?php if ($piece->paiement_id != 2) { ?> style="display:none" <?php } ?>>
                                                                            <div class='col-sm-10'>
                                                                                <?php echo $this->Form->input('num_piece', array('value' => $piece->num, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'label' => '', 'type' => 'text', 'index' => $i, 'id' => 'num_piece' . $i, 'champ' => 'num_piece', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][num_piece]')); ?>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td>
                                                            <i index="<?php echo $i ?>" class="fa fa-times supreg" style="color: #c9302c;font-size: 22px;" />
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                <input type="" value="<?php echo $i ?>" id="index" hidden>
                                                </tbody>
                                            </table><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </section>
                    <div hidden align="center">
                        <button type="submit" class="pull-right btn btn-success btn-sm Testqtestock chauff" id="boutonlivraison" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
</section>
<section hidden class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th><strong> Facture </strong></th>
                            </tr>
                            <tr>
                                <td>N° Facture</td>
                                <td>Date</td>
                                <td>Total TTC</td>
                                <td>Montant réglé</td>
                                <td>Reste</td>
                                <td></td>
                            </tr>
                            <?php
                            $fac = $factureclient;
                            foreach ($lignereglement as $r => $lignesre) {
                                $connection = ConnectionManager::get('default');
                                $mon = $connection->execute("select montantregler(" . $fac->id . " ) as mont")->fetchAll('assoc');
                                $lig = 5;
                                if ($lig) {
                                    $style = "display:yesy";
                                } else {
                                    $style = "display:none";
                                }
                                if ($mon[0]['mont'] == null) {
                                    $montreg = 0;
                                } else {
                                    $montreg = $mon[0]['mont'] - $lig[0]['montant'];
                                }

                                $reste = $fac->totalttc - $montreg;
                            }    ?>
                            <tr>
                                <td><?= h($fac->numero) ?></td>
                                <td><?= h($fac->date) ?></td>
                                <td><?= h($fac->totalttc) ?></td>
                                <td><?= h($montreg) ?></td>
                                <td><?= $reste ?></td>
                                <td>
                                    <?php if ($lignesre->factureclient_id == $fac->id) { ?>
                                        <input type="checkbox" checked name="data[Lignereglementclient][<?php echo $i; ?>][factureclient_id]" id="facture_id<?php echo $i; ?>" index="<?php echo $i; ?>" class=" calculmontantt chekreglementfacachat calculereglementclient afficheinputmontantreglementclient" value="<?php echo $fac->id ?>" mnttounssi="<?php echo $fac->ttc; ?>" mnt="<?php echo $reste; ?>">
                                        <?php
                                        echo @$this->Form->input('Montanttt', array('value' => $lignesre->Montant, 'index' => $i, 'name' => 'data[Lignereglementclient][' . $i . '][Montanttt]', 'id' => 'Montantregler' . $i, 'label' => '', 'type' => 'text', 'class' => 'form-control testmontantreglementclient  testmontantreglementclient1 checkmaxfa calculto  calculmontantt number'));
                                        ?>
                                    <?php } else {
                                    ?>
                                        <input type="checkbox" name="data[Lignereglementclient][<?php echo $i; ?>][factureclient_id]" id="facture_id<?php echo $i; ?>" index="<?php echo $i; ?>" class=" calculmontantt chekreglementfacachat  calculereglementclient  afficheinputmontantreglementclient" value="<?php echo $fac->id ?>" mnttounssi="<?php echo $fac->ttc; ?>" mnt="<?php echo $reste; ?>">
                                        <?php
                                        echo @$this->Form->input('Montanttt', array('value' => '', 'index' => $i, 'name' => 'data[Lignereglementclient][' . $i . '][Montanttt]', 'id' => 'Montantregler' . $i, 'label' => '', 'type' => 'text', 'class' => 'form-control testmontantreglementclient checkmaxfa calculto  testmontantreglementclient1 calculmontantt number'));
                                        ?>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php

                            ?>
                            <!-- <input type="hidden" name="max" value="< ?php echo @$i; ?>" id="max">
                            <tr id="totalefacture">
                                <td colspan="5"> Total factures</td>
                                <td colspan="3">
                                    <input type="number" name="data[Reglementclient][ttpayer]" id="ttpayer" class="form-control" value="<?php echo $mtfact; ?>" readonly>
                                </td>
                            </tr>
                            <tr>
                            </tr>
                            <tr id="montantpayer">
                                <td colspan="5">Montant à payer</td>
                                <td colspan="3">
                                    <input type="number" name="data[Reglementclient][Montant]" id="Montant" class="form-control " value="<?php echo $reglement->Montant; ?>" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5">Differance echange</td>
                                <td colspan="3">
                                    <input type="number" name="data[Reglementclient][differance]" id="difference" class="form-control " value="0.000" readonly>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
<script>
    $(function() {
        var filterFloat = function(value) {
            if (/^(\-|\+)?([0-9]+(\.[0-9]+)?|Infinity)$/
                .test(value))
                return Number(value);
            return NaN;
        }
        $('#client').on('change', function() {
            // alert('hello');
            id = $('#client').val();
            $('#cl_id').val(id);

            date = $('#date').val();
            // alert(date)
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Commandes', 'action' => 'getremise']) ?>",
                dataType: "json",
                data: {
                    idfam: id,
                    date: date,

                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function(data) {
                    // alert(data.select);
                    // alert(data.ligne.Fodec);
                    //  $('#adresselivraison-id').html(data.select);
                    $('#com_id').html(data.select);

                    //alert(data.typeclient);

                    $('#formule').val(data.ligne.prix);
                    $('#form').val(data.ligne.prix);
                    verifprix = data.ligne.prix;

                    if (verifprix == 'PHT+Fodec') {

                        formul = 'PHT+Fod';
                    }
                    if (verifprix == 'PHT') {

                        formul = 'PHT';
                    }
                    if (verifprix == '(PHT-Remise)+Fodec') {

                        formul = '(PHT-R%)+Fod';
                    }
                    if (verifprix == '((PHT-Remise)-Escompte)+Fodec') {

                        formul = '((PHT-R%)-Esc%)+Fod';
                    }
                    $('#prixverif').html(formul);
                    $('#categclient').val(data.valeurcategorie);

                    $('#remise').val(data.ligne.remise);
                    $('#fodecclient').val(data.ligne.Fodec);
                    //typeclient
                    $('#typeclient').val(data.typeclient);
                    $('#typeclientidd').val(data.typeclientid);
                    $('#gouvernerat').val(data.govname);

                    //$client->localite->name.' '.$client->delegation->name.' '.$client->delegation->codepostale
                    $('#typeclientname').val(data.typeclientname);
                    nom = data.typeclientname
                    valnot = data.not;
                    //alert(data.typeclientname);
                    // valgs = Number(data.gs);
                    valgs = data.gs;
                    //alert("kkkkkk");
                    if (data.typeclient == false) {
                        if (valnot != 0) {
                            a = '<a onClick=\'openWindow(1000, 1000,"http://codifaerp.isofterp.com/demo/promoarticles/notgrandsurface/' + valnot + '")\'>' + nom + '</a>'
                            $('#typecli').html(a);
                        } else {
                            a = '<a>' + nom + '</a>'
                            $('#typecli').html(a);

                        }
                    } else if (data.typeclient == true) {
                        if (valgs != 0) {
                            a = '<a onClick=\'openWindow(1000, 1000,"http://codifaerp.isofterp.com/demo/gspromoarticles/grandsurface/' + valgs + '")\'>' + nom + '</a>'
                            $('#typecli').html(a);
                        } else {
                            a = '<a>' + nom + '</a>'
                            $('#typecli').html(a);
                        }
                    }

                    $('#nouv').val(data.ligne.nouveau_client);

                    valrem = Number(data.remcli);
                    valcom = Number(data.remes);
                    if (data.remise == true) {
                        $('#remise-val').val(data.ligne.remise);
                        if (valrem != 0) {
                            a = '<a onClick=\'openWindow(1000, 1000,"http://codifaerp.isofterp.com/demo/remiseclients/consultation/' + valrem + '")\'>avec palier</a>'
                            $('#remi').html(a);
                        } else {
                            a = '<a>avec palier</a>'
                            $('#remi').html(a);
                        }
                    }

                    if (data.remise == false) {
                        $('#remise-val').val(data.ligne.remise);
                        div = '<div >sans palier</div>'
                        $('#remi').html(div);
                    }

                    if (data.escompte == true) {
                        $('#escompte-val').val(data.ligne.escompte);
                        if (valcom != 0) {
                            a = '<a onClick=\'openWindow(1000, 1000,"http://codifaerp.isofterp.com/demo/remiseescomptes/consultation/' + valcom + '")\'>avec palier</a>'
                            $('#com').html(a);
                        } else {
                            a = '<a>avec palier</a>'
                            $('#com').html(a);
                        }
                    }
                    if (data.escompte == false) {
                        $('#escompte-val').val(data.ligne.escompte);
                        div = '<div >sans palier</div>'
                        $('#com').html(div);
                    }

                    bl = Number(data.typeclientbl);
                    if (data.typeclientbl == true) {
                        check = 'OUI <input disabled type="radio" name="checkbl" value="1" id="OUI" style="margin-right: 20px" checked> NON <input disabled type="radio" name="checkbl" value="0" id="NON" >'
                        $('#BL').html(check);
                    } else {
                        check = 'OUI <input disabled type="radio" name="checkbl" value="0" id="OUI" style="margin-right: 20px"> NON <input disabled type="radio" name="checkbl" value="1" id="NON"  checked>'
                        $('#BL').html(check);
                    }

                    $('#adresse').val(data.ligne.Adresse);
                    $('#matriculefiscale').val(data.ligne.Matricule_Fiscale);
                    $('#name').val(data.ligne.Code + " " + data.ligne.Raison_Sociale);
                    $('#telclient').val(data.tel);
                    $('#auto').val(data.autor);
                    $('#solde').val(data.solde);
                    $('#valreste').val(data.valreste);
                    //$('#typeclientid').val(data.typeclientid);
                    $('#blocclient').show();
                    page = $('#page').val() || 0;
                    //if(page=="factureclient"){
                    $('#typeclientid').parent().parent().html(data.select);
                    // uniform_select('typeclientid');

                    $('#fodecclientexo').val(data.exofodec);
                    $('#timbreclientexo').val(data.exotimbre);
                    $('#tvaclientexo').val(data.exotva);
                    $('#tpeclientexo').val(data.exotpe);

                    //   alert(data.exofodec);
                    if (data.exofodec == '' && data.exotva == '' && data.exotpe == '') {
                        $('#typeexenoration').val('Non exoneré');
                    } else {
                        $('#typeexenoration').val(data.exofodec + '/' + data.exotva + '/' + data.exotpe);
                    }

                }

            })

        });
    });

    $(function() {
        $('.calcheck').on('click', function() {

            calculbccheck();

        })
        $('.pourcentescompte').on('keyup', function() {
            //alert('hh');
            index = $(this).attr('index');
            i = $(this).attr('index');
            // alert(index);
            qte = $('#qte' + index).val();
            //alert(article_id);

            //alert(depot_id);
            $.ajax({
                method: "GET",
                type: "GET",
                url: "<?= $this->Url->build(['controller' => 'Commandes', 'action' => 'getescompte']) ?>",
                dataType: "JSON",
                data: {
                    qte: qte,

                },
                success: function(response) {
                    //  alert(response.tab[0]['qtemax']);
                    numbers = response.tab;
                    tpe = $('#tpe' + i).val();
                    tva = Number($('#tva' + i).val()); // alert(tva);
                    fodec = $('#fodec' + i).val(); //alert(tpe);        
                    fodecclientexo = $('#fodecclientexo').val();
                    tpeclientexo = $('#tpeclientexo').val();
                    tvaclientexo = $('#tvaclientexo').val();
                    total = 0;
                    totalremise = 0;
                    remisecommande = 0;
                    montanttpe = 0;
                    montantfodec = 0;
                    montanttva = 0;
                    totalttc = 0;
                    totalCommandettc = 0;
                    motanttotal = 0;
                    ttc = 0;
                    fodeccommandeclient = 0;
                    fod = 0;
                    tpecommandeclient = 0;
                    tpecmd = 0;
                    monatantlignetva = 0;
                    tvacomd = 0;
                    //mahdi-------------------------------
                    baseHT = 0;
                    brutHT = 0;
                    //-------------------------------

                    qteStock = ($('#qteStock' + i).val()) * 1; //alert(qteStock);
                    qte = ($('#qte' + i).val()) * 1; //alert(qte);
                    prix = $('#prix' + i).val(); //alert(prix);
                    remisearticle = $('#remisearticle' + i).val() || 0; //alert(remisearticle);
                    remiseclient = $('#remiseclient' + i).val() || 0;

                    /* if (qte > qteStock) {*/
                    // alert("veuillez enter quantit? inf?rieur a la qunatit? de stock !!");
                    //   $('#qte' + i).val(0);

                    //    }
                    //  else {

                    netbrut = (Number(qte) * Number(prix)); //alert(netbrut);

                    totalremise = Number(remisearticle) + Number(remiseclient);
                    remisefinale = netbrut.toFixed(3) * totalremise / 100; //alert(remisefinale);
                    motanttotal = netbrut - remisefinale; //alert(netht);
                    //   ttc = motanttotal * 1.19 / qte;

                    $('#motanttotal' + i).val(Number(motanttotal).toFixed(3)); // alert(motanttotal);

                    //  }

                    // if ($('#OUI').is(':checked')) {
                    // alert("dhh");
                    //fodec = Number($('#OUI').val());

                    // remisepayementmontant = motanttotal * pourcentageescompte / 100; // alert("hh");
                    //motanttotal = motanttotal - remisepayementmontant;
                    //alert(netht);
                    // alert(remisepayementmontant);
                    // $('#escompte' + i).val(Number(remisepayementmontant).toFixed(2)); //alert(remisepayementmontant)

                    //  } else {
                    // $('#escompte' + i).val('');
                    // }
                    $('#comptant').val(Number(motanttotal).toFixed(3));
                    ttc = motanttotal * (1 + tva) / qte;
                    $('#ttc' + i).val(Number(ttc).toFixed(3));

                    // alert(fodecclientexo);

                    if (fodec != 0 && fodecclientexo == '') {
                        //   alert("cc");
                        montantfodec = motanttotal * fodec / 100;
                        fodeccommandeclient += montantfodec;

                        motanttotal += montantfodec; //alert(motanttotal);
                    }
                    $('#fodeccommande').val(Number(motanttotal).toFixed(3));
                    $('#fodeccommandeclient' + i).val(Number(fodeccommandeclient).toFixed(3));
                    // alert($('#fodeccommandeclient' + i).val());

                    if (tpe != 0 && tpeclientexo == '') {
                        montanttpe = motanttotal * tpe / 100; //alert(montanttpe);
                        motanttotal += montanttpe;
                        tpecommandeclient += montanttpe; //alert(tpecommandeclient);

                    }

                    $('#tpecommandeclient' + i).val(Number(tpecommandeclient).toFixed(3));
                    // alert($('#tpecommandeclient' + i).val());

                    //   alert("tva recup?r? avant if");
                    // alert(tva);
                    if (tva != 0 && tvaclientexo == '') {
                        //   alert("hh");
                        // alert("tva recup?r? apr?s if");
                        // alert(netht);
                        montanttva = motanttotal * tva / 100; //alert(montanttva);
                        totalttc = motanttotal + montanttva;

                    } else {
                        totalttc = motanttotal;
                    }

                    $('#remiseligne' + i).val(Number(remisefinale).toFixed(3));

                    $('#monatantlignetva' + i).val(Number(montanttva).toFixed(3));

                    //  alert($('#monatantlignetva' + i).val());

                    $('#totalttc' + i).val(Number(totalttc).toFixed(2));

                    escompte = 0;

                    index = $('#index').val();
                    for (j = 0; j <= index; j++) {
                        // alert(j);
                        sup = $('#sup' + j).val(); // alert(sup);

                        if (Number(sup) != 1) {
                            total += Number($('#motanttotal' + j).val());
                            //  alert(total);
                            remisecommande += Number($('#remiseligne' + j).val());
                            // alert(totalCommandettc);

                            totalCommandettc += Number($('#totalttc' + j).val()); //alert($('#totalttc' + j).val());
                            fod += Number($('#fodeccommandeclient' + j).val()); // alert(fod);
                            tpecmd += Number($('#tpecommandeclient' + j).val());
                            tvacomd += Number($('#monatantlignetva' + j).val()); // alert(tvacomd);

                            //   escompte += Number($('#escompte' + j).val());

                            //$('#ttc' + i).val(Number(ttc));
                        }
                    }
                    montantescompte = 0

                    maxpourcentage = response.tab[numbers.length - 1]['pourcentage'];
                    maxqte = response.tab[numbers.length - 1]['qtemax'];

                    // m = numbers[numbers.length - 1]['pourcentage'];

                    if ($('#OUI').is(':checked')) {
                        numbers.forEach(myFunction);

                        function myFunction(item) {
                            //  alert(total);
                            //  alert('kk');
                            if (total >= item['qtemin'] && total <= item['qtemax']) {
                                // alert(item['pourcentage']);

                                montantescompte = total * Number(item['pourcentage']) / 100;

                                $('#valeurescompte').val(item['pourcentage']);
                            } else if (total > maxqte) {
                                //alert('hh');
                                montantescompte = total * Number(maxpourcentage) / 100;
                                $('#valeurescompte').val(maxpourcentage);
                            }
                        }
                    }
                    //alert(total);
                    $('#escompte').val(Number(montantescompte).toFixed(3));

                    //mahdi------------------------------------
                    brutHT = total + remisecommande;
                    baseHT = total + fod;

                    $('#netapayer').val(Number(totalCommandettc).toFixed(3));
                    $('#baseHT').val(Number(baseHT).toFixed(3));
                    $('#brutHT').val(Number(brutHT).toFixed(3));

                    //-----------------------------------------

                    $('#totalremise').val(Number(remisecommande).toFixed(3));
                    $('#total').val(Number(total).toFixed(3));
                    $('#totalttccommande').val(Number(totalCommandettc).toFixed(3));
                    $('#fod').val(Number(fod).toFixed(3));
                    $('#tpecommande').val(Number(tpecmd).toFixed(3));
                    $('#tvacommande').val(Number(tvacomd).toFixed(3));

                }
            })
        });
    });

    function calculbccheck() { //alert(index+'index')
        //alert('calculbc')
        ind = Number($('#index').val()); //alert(ind+'ind')
        i = ind;
        //   $('#remisearticle'+index).val(0);
        //            if(ind!=index){
        //                indexpre = Number(index)+1;
        //          // alert(indexpre+"indexpre");
        //                if( $('#articlee' + indexpre).val()!=""){
        //                    $('#sup' + indexpre).val('1');
        //         $(this).parent().parent().hide();
        //        }}

        // alert(index);
        //    articleid = $('#article_id' + index).val(); //alert(articleid)
        //  qte = $('#qte' + index).val();

        //alert(article_id);

        //alert(qte);
        test = 0;
        //if (qte.match(/^(?:[1-9]\d*|0)?(?:\.\d+)?$/)) { 
        //    test = 1;
        //}
        //if (test == 0) {
        //    $("#qte"+index).val("");
        //}

        //alert(depot_id);
        //        $.ajax({
        //            method: "GET",
        //            type: "GET",
        //            async: false,
        //
        //            url: "<?= $this->Url->build(['controller' => 'Commandes', 'action' => 'getescompte']) ?>",
        //            dataType: "JSON",
        //            data: {
        //                qte: qte,
        //
        //            },
        //            success: function(response) {
        //                // alert(response);die;
        //                //  alert(response.tab[0]['qtemax']);
        //                numbers = response.tab;

        //alert(numbers);

        total = 0;
        totalremise = 0;
        remisecommande = 0;
        montanttpe = 0;
        montantfodec = 0;
        montanttva = 0;
        totalttc = 0;
        totalCommandettc = 0;
        motanttotal = 0;
        ttc = 0;
        fodeccommandeclient = 0;
        fod = 0;
        tpecommandeclient = 0;
        tpecmd = 0;
        monatantlignetva = 0;
        tvacomd = 0;
        //mahdi-------------------------------
        baseHT = 0;
        brutHT = 0;
        totrem = 0;
        totbrut = 0;
        totrmt = 0;
        montantescompte = 0;
        // tvacomd=0;
        vacomd = 0;
        totalmontantescompteligne = 0;
        totalmontantescomptelignee = 0;
        totalmotanttotal = 0;
        totaltpecommandeclient = 0;
        tpecommandeclient = 0;
        motanttotaltpe = 0;
        totalpoidsfin = 0;
        totalpoids = 0;
        //-------------------------------
        formule = $('#formule').val();
        nb = 0;
        for (j = 0; j <= ind; j++) {
            // alert(j);
            sup = $('#sup' + j).val(); // alert(sup);

            nb++;

            if (Number(sup) != 1) {
                tpe = $('#tpe' + j).val() || 0;
                tva = Number($('#tva' + j).val()) || 0; // alert(tva);
                fodec = $('#fodec' + j).val() || 0; //alert(tpe);        
                fodecclientexo = $('#fodecclientexo').val();
                tpeclientexo = $('#tpeclientexo').val();
                tvaclientexo = $('#tvaclientexo').val();
                qte = ($('#qte' + j).val()) * 1; //alert(qte+"qte");
                poids = ($('#poids' + j).val()) * 1; //alert(poids+"poids");
                totalpoids = Number(qte) * Number(poids);
                totalpoidsfin += Number(totalpoids);
                prix = $('#prix' + j).val(); // alert(prix);
                qteStock = ($('#qteStock' + j).val()) * 1; //alert(qteStock);

                remisearticle = $('#remisearticle' + j).val() || 0; //alert(remisearticle);

                netbrut = (Number(qte) * Number(prix)); //alert(netbrut);
                //   alert(netbrut);
                totalremise = Number(remisearticle);
                montremise = netbrut * totalremise / 100;
                montcal = netbrut - montremise; //alert(montcal);
                totbrut += Number(prix) * Number(qte); //alert(totbrut+'totbrut')
                //getremsie(totbrut) ;
                remiseclient = $('#remiseclient' + j).val() || 0; //alert(remiseclient+"remiseclient")

                //                        montremiseclient = montcal* remiseclient / 100;//alert(montremiseclient)
                //                        totremiseclient=Number(montremiseclient)+Number(montremise);//alert(totremiseclient)
                //                                //    alert(totremiseclient);
                //                         $('#totremiseclient' + j).val(Number(totremiseclient)); // alert(motanttotal);
                //                        motanttotal=montcal-montremiseclient;//alert(motanttotal+'motanttotalremise');
                //                  
                montremiseclient = Number(netbrut) * (Number(remiseclient) + Number(remisearticle)) / 100; //alert(montremiseclient)
                totremiseclient = Number(montremiseclient); //alert(totremiseclient)
                //    alert(totremiseclient);
                $('#totremiseclient' + j).val(Number(totremiseclient)); // alert(motanttotal);
                motanttotal = netbrut - montremiseclient; //alert(motanttotal+'motanttotalremise');

                $('#motanttotal' + j).val(Number(motanttotal)); // alert(motanttotal);

                totrem = totrem + Number(totremiseclient); //alert(totrem+'totrem');

                totaltotal = Number($('#motanttotal' + j).val()); //alert(Number($('#motanttotal' + j).val())+'total')

                total = Number(total) + Number(totaltotal); //alert(Number($('#motanttotal' + j).val())+'total')

                totremiseclientt = ($('#totremiseclient' + j).val());
                totrmt += Number(totremiseclientt);
                remisecommande += Number($('#remiseligne' + j).val()); //alert(remisecommande+'remisecommande')
                //pourcentageescompte

                if ($('#OUI').is(':checked')) {
                    //   getescompte(total);
                    valeurescompte = $('#valeurescompte').val(); //alert(valeurescompte+"valeurescompte");
                    montantescompte = total * Number(valeurescompte) / 100; //alert(montantescompte);
                    //  $('#valeurescompte').val(montantescompte);
                    //  alert(montantescompte+"esc");
                    //  $('#escompte').val(Number(montantescompte).toFixed(3));
                    montantescompteligne = Number(totaltotal) * Number(valeurescompte) / 100; //alert(montantescompte);
                    totalmontantescompteligne += Number(montantescompteligne);
                    montantescomptelignee = Number(totaltotal) - Number(montantescompteligne);
                    totalmontantescomptelignee += Number(montantescomptelignee); //alert(totalmontantescomptelignee+"totalmontantescomptelignee")
                    montantescompte += Number(montantescompteligne);
                    $('#escompte' + j).val(Number(montantescomptelignee).toFixed(3));
                }
                //alert(total);
                else {
                    $('#valeurescompte').val(0); //alert(valeurescompte+"valeurescompte");
                    valeurescompte = $('#valeurescompte').val();
                    montantescompte = 0; //alert(montantescompte);$('#escompte').val(0);}
                    // alert(montantescompte+"esc");
                    // $('#escompte').val(Number(montantescompte).toFixed(3));
                    montantescompteligne = Number(totaltotal) * Number(valeurescompte) / 100;
                    totalmontantescompteligne += Number(montantescompteligne);
                    montantescomptelignee = Number(totaltotal) - Number(montantescompteligne);
                    totalmontantescomptelignee += Number(montantescomptelignee);
                    montantescompte += Number(montantescompteligne);
                    $('#escompte' + j).val(Number(montantescomptelignee).toFixed(3));
                }
                //  alert(valeurescompte+"valeurescompte");
                //  prixavecformulclient(prix, j, formule, fodec, tva, tpe, valeurescompte, remiseclient, remisearticle)
                if (tpe != 0 && tpeclientexo == '') {
                    // alert(montantescomptelignee);
                    montanttpe = montantescomptelignee * tpe / 100; //alert(montanttpe);
                    motanttotaltpe += montanttpe;
                    $('#tpecommandeclient' + j).val(Number(montanttpe));
                    //                            tpecommandeclient = Number(motanttotal) + Number(montanttpe); //alert(tpecommandeclient);
                    //                            totaltpecommandeclient += Number(tpecommandeclient);

                } else {
                    montanttpe = 0 //alert(montanttpe);
                    motanttotaltpe += montanttpe;
                    $('#tpecommandeclient' + j).val(Number(montanttpe));
                    //                            tpecommandeclient = Number(motanttotal) + Number(montanttpe); //alert(tpecommandeclient);
                    //                            totaltpecommandeclient += Number(tpecommandeclient);
                }
                if (fodec != 0 && fodecclientexo == '') {
                    //   alert("cc");
                    montantfodec = montantescomptelignee * fodec / 100;
                    fod += montantfodec;

                    motanttotal = Number(montantescomptelignee) + Number(montantfodec); //alert(motanttotal);
                    totalmotanttotal += Number(motanttotal);
                    $('#fodeccommandeclient' + j).val(Number(montantfodec));
                } else {
                    montantfodec = 0;
                    fod += montantfodec;
                    $('#fodeccommandeclient' + j).val(Number(montantfodec));
                    motanttotal = Number(montantescomptelignee) + Number(montantfodec); //alert(motanttotal);
                    totalmotanttotal += Number(motanttotal);
                }

                if (tpe != 0 && tpeclientexo == '') {

                    tpecommandeclient = Number(motanttotal) + Number(montanttpe); //alert(tpecommandeclient);
                    totaltpecommandeclient += Number(tpecommandeclient);

                } else {

                    tpecommandeclient = Number(motanttotal) + Number(montanttpe); //alert(tpecommandeclient);
                    totaltpecommandeclient += Number(tpecommandeclient);
                }

                if (tva != 0 && tvaclientexo == '') {
                    montanttva = Number(tpecommandeclient) * tva / 100; //alert(montanttva);
                    tvacomd += Number(montanttva); //alert(montanttva+"alert(montanttva)")
                    $('#monatantlignetva' + j).val(Number(montanttva));
                    totalttc = Number(tpecommandeclient) + Number(montanttva); //alert(totalttc)
                    $('#totalttc' + j).val(Number(totalttc));
                    totalCommandettc += Number(totalttc);

                } else {
                    montanttva = 0;
                    tvacomd += Number(montanttva); //alert(montanttva+"alert(montanttva)")
                    $('#monatantlignetva' + j).val(Number(montanttva));
                    totalttc = Number(tpecommandeclient) + Number(montanttva); //alert(totalttc)
                    totalCommandettc += Number(totalttc);
                    $('#totalttc' + j).val(Number(totalttc));
                }

                //   escompte += Number($('#escompte' + j).val());

                //$('#ttc' + i).val(Number(ttc));
            }
        }

        if ($('#OUI').is(':checked')) {
            // getescompte(total);
            valeurescompte = $('#valeurescompte').val(); //alert(valeurescompte+"valeurescompte");
            montantescompte = total * Number(valeurescompte) / 100; //alert(montantescompte);
            //  $('#valeurescompte').val(montantescompte);
            //    alert(montantescompte+"esc");
            $('#escompte').val(Number(montantescompte).toFixed(3));
        }
        //alert(total);
        else {
            $('#valeurescompte').val(0); //alert(valeurescompte+"valeurescompte");
            valeurescompte = $('#valeurescompte').val();
            montantescompte = 0; //alert(montantescompte);$('#escompte').val(0);}
            $('#escompte').val(Number(montantescompte).toFixed(3));
        }
        mntesc = $('#escompte').val();
        $('#nbligne').val(Number(nb));

        $('#brutHT').val(Number(totbrut).toFixed(3));
        $('#totalremise').val(Number(totrmt).toFixed(3));
        // alert(mntesc+" alert(mntesc);");
        totaltt = Number(totbrut) - Number(totrmt) - Number(mntesc);
        $('#total').val(Number(totaltt).toFixed(3));
        $('#fod').val(Number(fod).toFixed(3));
        $('#tpecommande').val(Number(motanttotaltpe).toFixed(3));
        totaltpecommandeclientt = Number(totaltt) + Number(fod) + Number(motanttotaltpe);
        $('#baseHT').val(Number(totaltpecommandeclientt).toFixed(3));

        $('#tvacommande').val(Number(tvacomd).toFixed(3));
        totaltpecommandeclienttc = Number(totaltpecommandeclientt) + Number(tvacomd);
        $('#totalttccommande').val(Number(totaltpecommandeclienttc).toFixed(3));
        $('#netapayer').val(Number(totaltpecommandeclienttc).toFixed(3));

        //totalpoidsfin

        // $('#escompte').val(Number(totalmontantescompteligne).toFixed(3));
        nbpallete = Number(totalpoidsfin) / 450;
        $('#Poids').val(Number(totalpoidsfin).toFixed(3));
        $('#Coeff').val(Number(nbpallete).toFixed(3));
        pal = Number(450);
        //alert(pal);
        $('#pallette').val(Number(pal));
        //-----------------------------------------
        //alert(total+"total")
        //alert(total+'total');

        //            }
        //        })
    }
</script>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
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
<script>
    function openWindow(h, w, url) {
        //alert()
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }
</script>
<?php $this->end(); ?>