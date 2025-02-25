<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Commandeclient $commandeclient
 * @var string[]|\Cake\Collection\CollectionInterface $clients
 * @var string[]|\Cake\Collection\CollectionInterface $pointdeventes
 * @var string[]|\Cake\Collection\CollectionInterface $depots
 * @var string[]|\Cake\Collection\CollectionInterface $cartecarburants
 * @var string[]|\Cake\Collection\CollectionInterface $materieltransports
 * @var string[]|\Cake\Collection\CollectionInterface $bonlivraisons
 */
use Cake\Datasource\ConnectionManager;

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<?php echo $this->Html->script('js_vieww_projet'); ?>

<section class="content-header">
    <h1>
        Duplication Offre GGB
        <small>
            <?php echo __(''); ?>
        </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'vieww/', $project_id]); ?>"><i class="fa fa-reply"></i>
                <?php echo __('Retour'); ?>
            </a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box ">
                <?php echo $this->Form->create($commandeclient, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]);
                //debug($commandeclient); 
                $tauxchan = 1;
                if ($commandeclient->tauxdechange) {
                    $tauxchan = (float) $commandeclient->tauxdechange;

                }
                ?>
                <div class="box-body">
                    <div class="row">

                        <div class="col-md-6">

                            <?php echo $this->Form->control('code', ['readonly', 'disabled' => true]); ?>
                        </div>
                        <div class="col-md-6">
                            <input type="hidden" id="codetauxdechange" value="<?php echo $code; ?>">
                            <?php
                            echo $this->Form->control('client_id', ['id' => 'client_id', 'empty' => 'Veuillez choisir !!!', 'class' => "form-control select2", 'options' => $clients]);
                            ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->input('datedecreation', array('value' => $this->Time->format('now', 'd-m-Y'), 'label' => 'Date de creation', 'type' => 'date', 'placeholder' => '', 'class' => 'form-control', 'required')); ?>

                        </div>
                        <div class="col-md-6">
                            <?php
                            echo $this->Form->control('date',['value' => $this->Time->format('now', 'd-m-Y')]);
                            ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->control('commentaire', ['rows' => 1]); ?>
                        </div>
                        <div class="col-md-6">
                            <?php
                            echo $this->Form->control('projet_id', ['empty' => 'Veuillez choisir !!!', 'class' => "form-control select2",]);

                            ?>
                        </div>
                        <div hidden class="col-md-6">
                            <?php
                            echo $this->Form->control('depot_id', ['options' => $depots, 'empty' => 'Veuillez choisir !!!', 'class' => "form-control select2",]);

                            ?>
                        </div>
                        <div class="col-md-6">
                            <div height="60px">
                                <label class="control-label" for="unipxte-id">TVA:</label>
                                OUI <input type="radio" value="1" id="OUI" name='tvaOnOff' class="toggleEditcomclient"
                                    <?php if ($commandeclient->tvaOnOff == 1)
                                        echo "checked"; ?>>
                                NON <input type="radio" value="0" id="NON" class="toggleEditcomclient" name='tvaOnOff'
                                    <?php if ($commandeclient->tvaOnOff == 0)
                                        echo "checked"; ?>>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <?php echo $this->Form->input('paiement_id', ['value' => $gg, 'name' => 'paiement_id', 'class' => 'form-control select2 ', 'multiple' => 'multiple', 'id' => 'paiement_id', 'label' => 'Mode de reglèment', 'options' => $paiements, 'empty' => false]); ?>
                        </div>

                        <div class="col-md-6">
                            <?php echo $this->Form->input('duree_validite', ['type' => 'number', 'value' => '15', 'class' => 'form-control', 'id' => 'duree_validite', 'label' => 'Duree de validite en Jours']); ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->input('pay', ['type' => 'text', 'class' => 'form-control ', 'id' => 'pay_id', 'label' => 'Pay']); ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->input('incoterm_id', ['value' => $commandeclient->incoterm_id, 'class' => 'form-control', 'id' => 'incoterm_id', 'label' => 'Incoterm ', 'empty' => 'Veuillez choisir !!']); ?>
                        </div>

                        <div class="col-md-6">
                            <?php echo $this->Form->input('incotermpdf_id', ['value' => $commandeclient->incotermpdf_id, 'class' => 'form-control', 'id' => 'incotermpdf_id', 'label' => 'Total Incoterm ', 'empty' => 'Veuillez choisir !!']); ?>
                        </div>

                        <div class="col-md-6 deviseSelect">
                            <?php echo $this->Form->input('devisachat_id', ['value' => $commandeclient->devisachat_id, 'empty' => 'Veuillez choisir !!', 'class' => 'form-control', 'id' => 'devisachat_id', 'label' => 'Devises Achat ', 'options' => $devises]); ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->control('tauxachat', ['label' => "Taux de change achat", 'value' => 1, 'id' => 'tauxachat', 'class' => 'form-control ']); ?>

                        </div>

                        <div class="col-md-6 deviseSelect">
                            <?php echo $this->Form->input('devis_id', ['value' => $commandeclient->devis_id, 'class' => 'form-control', 'id' => 'devis_id', 'label' => 'Devises Vente', 'options' => $devises]); ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->control('tauxdechange', ['label' => 'Taux de change achat vente', 'value' => $commandeclient->tauxdechange, 'id' => 'tauxChange', 'class' => 'form-control getprixhtdupp']); ?>
                            <div id="message"></div>
                        </div>
                        <div class="col-xs-6" id="deviseSelect2">
                            <?php echo $this->Form->input('devis2_id', ['value' => $commandeclient->devis2_id, 'class' => 'form-control', 'id' => 'devis_id2', 'label' => 'Devises par rapport au dinar', 'options' => $devises, 'empty' => 'Veuillez choisir !!']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('tauxdechange2', ['value' => $commandeclient->tauxdechange2, 'label' => 'Taux de change de devise  en dinar ', 'id' => 'tauxChange2', 'class' => 'form-control', 'readonly']); ?>
                            <div id="message2"></div>
                        </div>


                        <div class="col-md-6">
                            <?php echo $this->Form->input('conditionreglement_id', ['value' => $commandeclient->conditionreglement_id, 'class' => 'form-control select2', 'id' => 'conditionreglement_id', 'label' => 'Condition de reglement', 'empty' => 'Veuillez choisir !!']); ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->input('delailivraison_id', ['value' => $commandeclient->delailivraison_id, 'class' => 'form-control select2', 'id' => 'delailivraison_id', 'label' => 'Délai de livraison', 'empty' => 'Veuillez choisir !!']); ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->input('methodeexpedition_id', ['value' => $commandeclient->methodeexpedition_id, 'class' => 'form-control select2', 'id' => 'methodeexpedition_id', 'label' => 'Méthode d`expédition', 'empty' => 'Veuillez choisir !!']); ?>
                        </div>

                        <div class="col-md-6">
                            <?php echo $this->Form->input('datelivraison', array('value' => $commandeclient->datelivraison, 'type' => 'date', 'label' => 'Date de livraison', 'id' => 'datelivraison', 'div' => 'form-group ', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control')); ?>
                        </div>

                        <!-- <div class="col-md-6">
                            <?php echo $this->Form->control('remisetotal', ['value' => $commandeclient->remisetotal, 'id' => 'remisetotal', 'label' => 'Remise relative sur le total', 'id' => 'remisetotal', 'type' => 'text', 'min' => 0, 'max' => 100, 'class' => 'form-control number getprixhtdup']); ?>
                        </div> -->
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">

                            <?php echo $this->Form->input('modetransport_id', ['value' => $commandeclient->modetransport_id, 'class' => 'form-control select2', 'id' => 'modetransport_id', 'label' => 'Mode transports', 'empty' => 'Veuillez choisir !!']); ?>

                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->control('nbfergule', ['value' => $commandeclient->nbfergule, 'label' => 'Nombre de chiffre aprés le firgule', 'id' => 'nbfergule', 'min' => 0, 'max' => 5, 'type' => 'number', 'class' => 'form-control number']); ?>
                        </div>
                        <div class="col-md-6">
                            <?php //echo $this->Form->control('banque_id', ['required' => 'off', 'empty' => 'Veuillez choisir !!!! ', 'id' => 'banque_id', 'class' => 'form-control select2', 'label' => 'Banque']); 
                            ?>
                        </div>
                        <div class="col-md-6">
                            <div height="60px">
                                <label class="control-label" style="margin-top: 25px;">Détait des montant de transport
                                    en pdf:</label>
                                OUI <input type="radio" name="detaittransport" value="1" id="OUItransport"
                                    class="toggleOffreGGBtransport " <?php if ($commandeclient->detaittransport == 1)
                                        echo "checked"; ?> style="margin-right: 17px">
                                NON <input type="radio" name="detaittransport" value="0" id="NONtransport"
                                    class="toggleOffreGGBtransport " <?php if ($commandeclient->detaittransport == 0)
                                        echo "checked"; ?>>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <?php echo $this->Form->control('banque_id', ['value' => $commandeclient->banque_id, 'required' => 'off', 'empty' => 'Veuillez choisir !!!! ', 'id' => 'banque_id', 'class' => 'form-control select2', 'label' => 'Banque']); ?>
                        </div>
                        <div class="col-md-6">
                            <?php //echo $this->Form->control('banque_id', ['required' => 'off', 'empty' => 'Veuillez choisir !!!! ', 'id' => 'banque_id', 'class' => 'form-control select2', 'label' => 'Banque']); 
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <div id="Compteee_id">
                                <label for="">Comptes bancaires</label>
                                <select name="comptesBank_id" id="comptesBank_id" class="form-control select2">
                                    <option value="">Veuillez choisir !!!!</option>
                                    <?php

                                    foreach ($comptesBanks as $key => $comptesBan) {
                                        $connection = ConnectionManager::get('default');

                                        $dev = $connection->execute('SELECT * FROM devises where id=' . $comptesBan['devise_id'] . ';')->fetchAll('assoc');

                                        ?>
                                        <option value="<?php echo $comptesBan['id'] ?>" <?php if ($comptesBan['id'] == $commandeclient->comptesBank_id)
                                               echo 'selected'; ?>>
                                            <?php echo $comptesBan['compte'] . ' ' . $dev[0]['symbole'] ?>
                                            <?php ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <?php // $this->Form->control('comptesBank_id', ['required' => 'off', 'empty' => 'Veuillez choisir !!!!', 'id' => 'comptesBank_id', 'class' => 'form-control select2', 'label' => 'Comptes bancaires', 'options' => $comptesBanks]); 
                                ?>
                            </div>


                        </div>
                    </div>

                    <section class="content-header">
                        <h1 class="box-title">
                            <?php echo __('Ligne demande client produit'); ?>
                        </h1>
                    </section>
                    <section class="content" style="width: 99%">
                        <div class="row">
                            <div class="box">
                                <div class="box-header with-border">
                                    <a class="btn btn-primary  " table='addtable' index='index' id='ajouter_ligne33s'
                                        style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                                        <i class="fa fa-plus-circle "></i> Ajouter ligne produit</a>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive ls-table">
                                        <table class="table table-bordered table-striped table-bottomless"
                                            id="tabligne3">
                                            <?php
                                            $margemarque = "";

                                            if (!empty($lignecommandeclients)) {
                                                $res = current($lignecommandeclients);
                                                if ($res->tauxdemarque != null) {
                                                    $margemarque = " Taux de marque";
                                                } else {
                                                    $margemarque = " Taux de marge";
                                                }
                                            }
                                            ?>
                                            <thead>
                                                <tr width:20px>
                                                    <td align="center" nowrap="nowrap"><strong>Fournisseur</strong></td>

                                                    <td align="center" nowrap="nowrap">
                                                        <strong>&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;Produit
                                                            &thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;</strong>
                                                    </td>
                                                    <td align="center" nowrap="nowrap">
                                                        <strong>&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;Description&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;</strong>
                                                    </td>
                                                    <!-- <td align="center" nowrap="nowrap"><strong>Unité</strong></td> -->
                                                    <td align="center" nowrap="nowrap"><strong>Quantite</strong> </td>
                                                    <td align="center" nowrap="nowrap" style="width: 10% !important;"><strong>&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;Pr A
                                                    &thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp; &thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;  <!-- <span id="diviseachat">      <?php echo $deviseprojet ?></span>  -->
                                                        </strong></td>
                                                        <td align="center" nowrap="nowrap" style="width: 10% !important;"><strong>&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;Pr R
                                                    &thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp; &thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;   <!-- <span class="deviseprojet2"> <?php echo $deviseprojet2 ?></span> -->
                                                        </strong></td>
                                                    <?php if ($parametretaus->tauxdemarge == 1) { ?>
                                                        <td align="center" nowrap="nowrap"><strong>Taux de marge</strong>
                                                        </td>
                                                    <?php }
                                                    if ($parametretaus->tauxmarque == 1) { ?>
                                                        <td align="center" nowrap="nowrap"><strong>Taux de marque</strong>
                                                        </td>
                                                    <?php } ?>

                                                    <td align="center" nowrap="nowrap" style="width: 30% !important;/* word-wrap: break-word;white-space: normal; */"><strong>&thinsp; &thinsp;
                                                            &thinsp; &thinsp; &thinsp; Pr V&thinsp; &thinsp;
                                                            &thinsp;
                                                            &thinsp; &thinsp; </strong></td>
                                                    <!-- 
                                                    <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp;
                                                            &thinsp; &thinsp; &thinsp;Type remise&thinsp; &thinsp;
                                                            &thinsp;
                                                            &thinsp; &thinsp; </strong></td> -->

                                                    <td align="center" nowrap="nowrap" style="    width: 12%;">
                                                        <strong>&thinsp; &thinsp;&thinsp; &thinsp;
                                                            &thinsp; &thinsp; &thinsp; &thinsp; &thinsp; &thinsp;
                                                            &thinsp; &thinsp; &thinsp; &thinsp; &thinsp; &thinsp;Remise
                                                            &thinsp; &thinsp; &thinsp; &thinsp; &thinsp;
                                                            &thinsp;
                                                            &thinsp; &thinsp; </strong>
                                                    </td>

                                                    <!-- <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp; &thinsp; PUNHT&thinsp; &thinsp; &thinsp; </strong></td> -->
                                                    <td nowrap="nowrap" id='thtva' align="center"
                                                        style="display:<?php echo ($commandeclient->tvaOnOff == 1) ? 'table-cell' : 'none'; ?>">
                                                        <strong>&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; Tva&thinsp;
                                                            &thinsp; &thinsp;&thinsp; &thinsp; </strong>
                                                    </td>

                                                    <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp;
                                                            &thinsp; &thinsp; &thinsp; TTC&thinsp; &thinsp; &thinsp;
                                                            &thinsp; &thinsp; </strong></td>

                                                    <td align="center" nowrap="nowrap"></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = -1;
                                                // $margemarque = "";
                                                foreach ($lignecommandeclients as $res):
                                                    $i++;
                                                    // debug($res);
                                                
                                                    ?>
                                                    <tr>
                                                        <td style="width: 15%;" align="center">
                                                            <div style="display:flex">
                                                                <div style="    width: 85%;">
                                                                    <?php
                                                                    echo $this->Form->control('fournisseur_id', ['empty' => 'Veuillez choisir !!!', 'index' => $i, 'id' => 'fournisseur_id' . $i, 'options' => $fournisseurs, 'value' => $res['fournisseur_id'], 'name' => 'data[lignecommandeclients][' . $i . '][fournisseur_id]', 'label' => '', 'table' => 'lignecommandeclients', 'champ' => 'fournisseur_id', 'class' => 'form-control select2 frarticle ']); ?>

                                                                </div>
                                                                <div style="    width: 15%;">
                                                                    <br>
                                                                    <i style="color:#3c8dbc;font-size: 25px; "
                                                                        id="frsarticles<?php echo $i ?>"
                                                                        index="<?php echo $i ?>"
                                                                        class="fa fa fa-plus frsarticles"></i>&thinsp;
                                                                    &thinsp; &thinsp;&thinsp; &thinsp; &thinsp;&thinsp;
                                                                    &thinsp; &thinsp;&thinsp; &thinsp; &thinsp;&thinsp;
                                                                    &thinsp; &thinsp;

                                                                </div>


                                                            </div>

                                                            <?php
                                                            // echo $this->Form->control('fournisseur_id', ['empty' => 'Veuillez choisir !!!', 'index' => $i, 'id' => 'fournisseur_id' . $i, 'options' => $fournisseurs, 'value' => $res['fournisseur_id'], 'name' => 'data[lignecommandeclients][' . $i . '][fournisseur_id]', 'label' => '', 'table' => 'lignecommandeclients', 'champ' => 'fournisseur_id', 'class' => 'form-control  select2 frarticle ']); ?>
                                                        </td>
                                                        <td style="width: 15%;" align="center">

                                                            <?php
                                                            echo $this->Form->input('sup0', array('name' => 'data[lignecommandeclients][' . $i . '][sup0]', 'id' => 'sup0' . $i, 'champ' => 'sup0', 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                            echo $this->Form->input('id', array('label' => '', 'value' => $res['id'], 'name' => 'data[lignecommandeclients][' . $i . '][id]', 'type' => 'hidden', 'id' => 'id' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                            echo $this->Form->control('article_id', ['empty' => 'Veuillez choisir !!!', 'index' => $i, 'id' => 'article_id' . $i, 'options' => $articles, 'value' => $res['article_id'], 'name' => 'data[lignecommandeclients][' . $i . '][article_id]', 'label' => '', 'table' => 'lignecommandeclients', 'champ' => 'article_id', 'class' => 'form-control select2 getprixarticle  ']); ?>
                                                        </td>
                                                        <td style="width: 15%;">
                                                            <?php //echo $this->Form->input('description', array('label' => '', 'value' => $res['description'], 'name' => 'data[lignecommandeclients][' . $i . '][description]', 'id' => 'description' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  ')); ?>
                                                            <br>
                                                            <div style="display:flex">

                                                                <input type="text" id="description<?php echo $i ?>"
                                                                    class="form-control  " index="<?php echo $i ?>"
                                                                    name="data[lignecommandeclients][<?php echo $i ?>][description]"
                                                                    value="<?php echo $res['description'] ?>">
                                                                <a class="btn btn-primary description "
                                                                    id="button<?php echo $i ?>" index="<?php echo $i ?>">
                                                                    <i class="fa fa-edit"></i></a>
                                                                <?php //echo $this->Form->input('description', array('label' => '', 'value' => $res['description'], 'name' => 'data[lignecommandeclients][' . $i . '][description]', 'id' => 'description' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  ')); ?>

                                                            </div>

                                                            <?php echo $this->Form->input('type', array('label' => '', 'type' => 'hidden', 'value' => $res['type'], 'name' => 'data[lignecommandeclients][' . $i . '][type]', 'id' => 'type' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  ')); ?>



                                                        </td>

                                                        <td style="width: 8%;" hidden>
                                                            <br>
                                                            <select champ="unite_id" id="unite_id<?php echo $i; ?>"
                                                                index="<?php echo $i; ?>"
                                                                name="data[lignecommandeclients][<?php echo $i; ?>][unite_id]"
                                                                table="lignecommandeclients" class="form-control select2">
                                                                <option value=""></option>
                                                                <?php foreach ($unites as $key => $unit) {

                                                                    ?>
                                                                    <option value="<?php echo $unit['id'] ?>" <?php if ($unit['id'] == $res['unite_id']) {
                                                                           echo "selected";
                                                                       } ?>>
                                                                        <?php echo $unit['name'] ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>

                                                        </td>
                                                        <td style="width: 6%;" align="center">
                                                            <?php echo $this->Form->input('qte', array('label' => '', 'value' => $res['qte'], 'name' => 'data[lignecommandeclients][' . $i . '][qte]', 'type' => 'text', 'id' => 'qte' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtdupp ')); ?>
                                                        </td>
                                                        <td style="width: 8%;" align="center">
                                                            <?php echo $this->Form->input('coutrevient', array('label' => '', 'value' => $res['coutrevient'], 'champ' => 'coutrevient', 'name' => 'data[lignecommandeclients][' . $i . '][coutrevient]', 'type' => 'text', 'id' => 'coutrevient' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculprix')); ?>
                                                            <?php echo $this->Form->input('coutrevientt', array('label' => '', 'value' => $res['coutrevient'], 'name' => 'data[lignecommandeclients][' . $i . '][coutrevientt]', 'type' => 'hidden', 'id' => 'coutrevientt' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtdup')); ?>

                                                        </td>
                                                        <td align="center">
                                                            <?php echo $this->Form->input('coutrevientdev', array('label' => '', 'champ' => 'coutrevientdev', 'value' => sprintf("%01." . $commandeclient->nbfergule . "f", $res['coutrevient'] * $tauxchan), 'name' => 'data[lignecommandeclients][' . $i . '][coutrevientdev]', 'type' => 'text', 'id' => 'coutrevientdev' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  number  calculprix')); ?>
                                                        </td>
                                                        <?php if ($parametretaus->tauxdemarge == 1) { ?>
                                                            <td style="width: 8%;" align="center">
                                                                <?php echo $this->Form->input('tauxdemarge', array('label' => '', 'champ' => 'tauxdemarge', 'value' => $res['tauxdemarge'], 'name' => 'data[lignecommandeclients][' . $i . '][tauxdemarge]', 'type' => 'text', 'id' => 'tauxdemarge' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  calculprix')); ?>
                                                            </td>
                                                        <?php }
                                                        if ($parametretaus->tauxmarque == 1) { ?>
                                                            <td style="width: 8%;" align="center">
                                                                <?php echo $this->Form->input('tauxdemarque', array('label' => '', 'champ' => 'tauxdemarque', 'value' => $res['tauxdemarque'], 'name' => 'data[lignecommandeclients][' . $i . '][tauxdemarque]', 'type' => 'text', 'id' => 'tauxdemarque' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  calculprix')); ?>
                                                            </td>
                                                        <?php } ?>
                                                        <!-- <td style="width: 8%;" align="center"> -->
                                                        <!-- <?php echo $this->Form->input('prixht', array('label' => '', 'value' => $res['prixht'], 'name' => 'data[lignecommandeclients][' . $i . '][prixht]', 'type' => 'text', 'id' => 'prixht' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtdupp ')); ?> -->
                                                        <!-- </td> -->
                                                        <td align="center">
                                                            <?php

                                                            // if ($res['tauxdemarge'] !== null) {
                                                        
                                                            //     echo $this->Form->input('prixht', array('label' => '', 'value' => intval($res['prixht']), 'name' => 'data[lignecommandeclients][' . $i . '][prixht]', 'type' => 'text', 'id' => 'prixht' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtdup '));
                                                            // } else {
                                                            echo $this->Form->input('prixht', array('label' => '', 'champ' => 'prixht', 'value' => sprintf("%01.3f", $res['prixht']), 'name' => 'data[lignecommandeclients][' . $i . '][prixht]', 'type' => 'text', 'id' => 'prixht' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculinversepp '));
                                                            //}
                                                            ?>

                                                        </td>
                                                        <td>
                                                            <div style="display:flex">
                                                                <div>
                                                                    <?php echo $this->Form->control('typeremise_id', ['label' => '', 'value' => $res['typeremise_id'], 'name' => 'data[lignecommandeclients][' . $i . '][typeremise_id]', 'id' => 'typeremise_id' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'class' => "form-control select2 typeremise_idl", 'options' => $typeremises]);
                                                                    ?>
                                                                </div>

                                                                <div id="divremise<?php echo $i; ?>" style="display:<?php if ($res['typeremise_id'] == 1) {
                                                                       echo "block";
                                                                   } else {
                                                                       echo "none";
                                                                   } ?> " table="lignecommandeclients"
                                                                    index="<?php echo $i; ?>">
                                                                    <?php echo $this->Form->input('remise', array('label' => '', 'value' => $res['remise'], 'name' => 'data[lignecommandeclients][' . $i . '][remise]', 'type' => 'text', 'id' => 'remise' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtdupp number testremise')); ?>
                                                                    <!-- <i style="    margin-top: 26%;font-size: 18px;" class="fa fa-percent"></i>&thinsp;&thinsp;&thinsp; -->

                                                                </div>
                                                                <div id="divremiseval<?php echo $i; ?>" style="display:<?php if ($res['typeremise_id'] == 2) {
                                                                       echo "block";
                                                                   } else {
                                                                       echo "none";
                                                                   } ?> " table="lignecommandeclients"
                                                                    index="<?php echo $i; ?>">
                                                                    <?php echo $this->Form->input('remiseval', array('label' => '', 'value' => $res['remiseval'], 'name' => 'data[lignecommandeclients][' . $i . '][remiseval]', 'type' => 'text', 'id' => 'remiseval' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtdupp number testremise')); ?>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <!-- <td style="width: 8%;" align="center">
                                                            <?php echo $this->Form->input('remise', array('label' => '', 'value' => $res['remise'], 'name' => 'data[lignecommandeclients][' . $i . '][remise]', 'type' => 'text', 'id' => 'remise' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtdup ')); ?>
                                                        </td> -->
                                                        <td style="width: 8%;" align="center" hidden>
                                                            <?php echo $this->Form->input('punht', array('label' => '', 'value' => $res['punht'], 'name' => 'data[lignecommandeclients][' . $i . '][punht]', 'type' => 'text', 'id' => 'punht' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtdupp ')); ?>
                                                        </td>
                                                        <td champ="tdtva" table="tablelignetva" id="tdtva<?php echo $i; ?>"
                                                            name="data[ligner]['<?php echo $i; ?>'][tdtva]"
                                                            index="<?php echo $i; ?>"
                                                            style=" display:<?php echo ($commandeclient->tvaOnOff == 1) ? 'table-cell' : 'none'; ?>"
                                                            align="center">
                                                            <?php echo $this->Form->input('tva', array('label' => '', 'value' => $res->tva, 'name' => 'data[lignecommandeclients][' . $i . '][tva]', 'type' => 'text', 'id' => 'tva' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtdupp ')); ?>
                                                        </td>

                                                        <!-- <td style="width: 12%;" align="center">
                                                                <?php echo $this->Form->input('fodec', array('label' => '', 'value' => $res->fodec, 'name' => 'data[lignecommandeclients][' . $i . '][fodec]', 'type' => 'text', 'id' => 'fodec' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtdupp ')); ?>
                                                            </td> -->
                                                        <td style="width: 8%;" align="center">
                                                            <?php echo $this->Form->input('ttc', array('readonly', 'label' => '', 'value' => $res['ttc'], 'name' => 'data[lignecommandeclients][' . $i . '][ttc]', 'type' => 'text', 'id' => 'ttc' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtdupp '));
                                                            $totalttc = $totalttc + $res['ttc']; ?>
                                                        </td>
                                                        <td style="width:2%" align="center"><i index="<?php echo $i ?>"
                                                                class="fa fa-times supLigne"
                                                                style="color: #C9302C;font-size: 22px;"></td>
                                                    </tr>
                                                <?php endforeach; ?>

                                                <tr class='tr' style="display: none !important">
                                                    <td style="width: 20%;" align="center">
                                                        <?php
                                                        echo $this->Form->input('type', array('value' => 1, 'name' => '', 'id' => '', 'champ' => 'type', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                                                        <div style="display:flex;width:100%">
                                                            <div style="width:85%">
                                                                <?php echo $this->Form->control('fournisseur_id', ['options' => $fournisseurs, 'empty' => 'Veuillez choisir !!', 'label' => '', 'table' => 'lignecommandeclients', 'champ' => 'fournisseur_id', 'class' => 'form-control  frarticle']); ?>
                                                            </div>
                                                            <div>
                                                                <br>
                                                                <i style="color:#3c8dbc;font-size: 25px;"
                                                                    champ="frsarticles" table="lignecommandeclients"
                                                                    class="fa fa fa-plus frsarticles"></i>
                                                            </div>

                                                        </div>
                                                    </td>
                                                    <!-- <td style="width: 15%;" align="center">
                                                        <?php
                                                        echo $this->Form->control('fournisseur_id', ['options' => $fournisseurs, 'empty' => 'Veuillez choisir !!', 'label' => '', 'table' => 'lignecommandeclients', 'champ' => 'fournisseur_id', 'class' => 'form-control frarticle']);
                                                        echo $this->Form->input('type', array('name' => '', 'id' => '', 'champ' => 'type', 'value' => '1', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden')); ?>

                                                    </td> -->
                                                    <td style="width: 15%;" align="center">
                                                        <?php echo $this->Form->input('id', array('champ' => 'id', 'label' => '', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                        <?php
                                                        echo $this->Form->input('sup0', array('name' => '', 'id' => '', 'champ' => 'sup0', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden'));
                                                        echo $this->Form->control('article_id', ['options' => $articles, 'empty' => 'Veuillez choisir !!', 'label' => '', 'table' => 'lignecommandeclients', 'champ' => 'article_id', 'class' => 'form-control']); ?>
                                                    </td>
                                                    <td style="width: 15%;">
                                                        <br>

                                                        <div style="display:flex">

                                                            <input type="text" champ="description"
                                                                table="lignecommandeclients" class="form-control  ">
                                                            <a class="btn btn-primary description " champ="buttondesc"
                                                                table="lignecommandeclients">
                                                                <i class="fa fa-edit"></i></a>

                                                        </div>
                                                        <?php //echo $this->Form->input('description', array('champ' => 'description', 'label' => '', 'name' => '', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  ')); ?>
                                                    </td>
                                                    <td style="width: 8%;" hidden>
                                                        <br>
                                                        <select champ="unite_id" table="lignecommandeclients"
                                                            class="form-control " id="">
                                                            <option value=""></option>
                                                            <?php foreach ($unites as $key => $unit) {

                                                                ?>
                                                                <option value="<?php echo $unit['id'] ?>">
                                                                    <?php echo $unit['name'] ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>

                                                    </td>

                                                    <td align="center" style="width: 6%;">
                                                        <?php echo $this->Form->input('qte', array('champ' => 'qte', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtdupp ')); ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('coutrevient', array('champ' => 'coutrevient', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  calculprix')); ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('coutrevientdev', array('champ' => 'coutrevientdev', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number  calculprix ')); ?>
                                                    </td>
                                                    <?php if ($parametretaus->tauxdemarge == 1) { ?>
                                                        <td align="center">
                                                            <?php echo $this->Form->input('tauxdemarge', array('champ' => 'tauxdemarge', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  calculprix')); ?>
                                                        </td>
                                                    <?php }
                                                    if ($parametretaus->tauxmarque == 1) { ?>
                                                        <td align="center">
                                                            <?php echo $this->Form->input('tauxdemarque', array('champ' => 'tauxdemarque', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  calculprix')); ?>
                                                        </td>
                                                    <?php } ?>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('prixht', array('champ' => 'prixht', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtdupp ')); ?>
                                                    </td>

                                                    <td>
                                                        <div style="display:flex">
                                                            <div>
                                                                <?php
                                                                echo $this->Form->control('typeremise_id', ['champ' => 'typeremise_id', 'label' => '', 'name' => '', 'table' => 'lignecommandeclients', 'class' => "form-control  typeremise_idl ", 'options' => $typeremises]); ?>

                                                            </div>

                                                            <div champ="divremise" table="lignecommandeclients">
                                                                <?php echo $this->Form->input('remise', array('champ' => 'remise', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtdupp testremise')); ?>
                                                            </div>
                                                            <div champ="divremiseval" table="lignecommandeclients"
                                                                style="display:none">
                                                                <?php echo $this->Form->input('remiseval', array('champ' => 'remiseval', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtdupp testremise')); ?>

                                                            </div>
                                                        </div>


                                                    </td>

                                                    <td align="center" hidden>
                                                        <?php echo $this->Form->input('punht', array('champ' => 'punht', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtdupp ')); ?>
                                                    </td>
                                                    <td champ="tdtva" table="tablelignetva" id="" name="" index=""
                                                        style="display:none;" align="center">
                                                        <?php echo $this->Form->input('tva', array('champ' => 'tva', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtdupp ')); ?>
                                                    </td>
                                                    <!-- <td align="center">
                                                          <?php echo $this->Form->input('fodec', array('champ' => 'fodec', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtdupp ')); ?>
                                                        </td> -->
                                                    <td align="center">

                                                        <?php echo $this->Form->input('ttc', array('champ' => 'ttc', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtdupp ')); ?>
                                                    </td>
                                                    <td style="width:2%" align="center"><i id=""
                                                            class="fa fa-times supLigne"
                                                            style="color: #C9302C;font-size: 22px;"></td>
                                                </tr>
                                            </tbody>
                                        </table><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="content-header">
                        <h1 class="box-title">
                            <?php echo __('Ligne demande client Service'); ?>
                        </h1>
                    </section>
                    <section class="content" style="width: 99%">
                        <div class="row">
                            <div class="box">
                                <div class="box-header with-border">
                                    <a class="btn btn-primary  " table='addtable' index='index' id='ajouter_ligne33m'
                                        style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                                        <i class="fa fa-plus-circle "></i> Ajouter ligne service</a>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive ls-table">
                                        <table class="table table-bordered table-striped table-bottomless"
                                            id="tabligne3m">
                                            <?php
                                            $margemarque = "";

                                            if (!empty($lignecommandeclients)) {
                                                $res = current($lignecommandeclients);
                                                if ($res->tauxdemarque != null) {
                                                    $margemarque = " Taux de marque";
                                                } else {
                                                    $margemarque = " Taux de marge";
                                                }
                                            }
                                            ?>
                                            <thead>
                                                <tr width:20px>

                                                    <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp;
                                                            &thinsp; Service&thinsp; &thinsp; &thinsp; </strong></td>
                                                    <td align="center" nowrap="nowrap">
                                                        <strong>&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;Description&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;</strong>
                                                    </td>
                                                    <!-- <td align="center" nowrap="nowrap"><strong>Unité</strong></td> -->
                                                    <td align="center" nowrap="nowrap"><strong>Quantite</strong>
                                                    </td>
                                                    <td align="center" nowrap="nowrap" style="width: 10% !important;"><strong>&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;Pr A
                                                    &thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp; &thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;  <!-- <span id="diviseachat">      <?php echo $deviseprojet ?></span>  -->
                                                        </strong></td>
                                                        <td align="center" nowrap="nowrap" style="width: 10% !important;"><strong>&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;Pr R
                                                    &thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp; &thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;   <!-- <span class="deviseprojet2"> <?php echo $deviseprojet2 ?></span> -->
                                                        </strong></td>
                                                    <?php if ($parametretaus->tauxdemarge == 1) { ?>
                                                        <td align="center" nowrap="nowrap"><strong>Taux de marge</strong>
                                                        </td>
                                                    <?php }
                                                    if ($parametretaus->tauxmarque == 1) { ?>
                                                        <td align="center" nowrap="nowrap"><strong>Taux de marque</strong>
                                                        </td>
                                                    <?php } ?>

                                                    <td align="center" nowrap="nowrap" style="/* word-wrap: break-word;white-space: normal; */"><strong>&thinsp; &thinsp;
                                                            &thinsp; &thinsp; &thinsp; Pr V&thinsp; &thinsp;
                                                            &thinsp;
                                                            &thinsp; &thinsp; </strong></td>
                                                    <!-- 
                                                    <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp;
                                                            &thinsp; &thinsp; &thinsp;Type remise&thinsp; &thinsp;
                                                            &thinsp;
                                                            &thinsp; &thinsp; </strong></td> -->

                                                    <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp;
                                                            &thinsp; &thinsp; &thinsp; Remise &thinsp; &thinsp;
                                                            &thinsp;
                                                            &thinsp; &thinsp; </strong></td>
                                                    <!-- <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; PUNHT&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; </strong></td> -->
                                                    <td nowrap="nowrap" id='thtva' align="center"
                                                        style="display:<?php echo ($commandeclient->tvaOnOff == 1) ? 'table-cell' : 'none'; ?>">
                                                        <strong>&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; Tva&thinsp;
                                                            &thinsp; &thinsp; &thinsp; &thinsp; </strong>
                                                    </td>

                                                    <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp;
                                                            &thinsp; &thinsp; &thinsp; TTC&thinsp; &thinsp; &thinsp;
                                                            &thinsp; &thinsp; </strong></td>

                                                    <td align="center" nowrap="nowrap"></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                // $margemarque = "";
                                                foreach ($lignecommandeclient2s as $res):
                                                    $i++;
                                                    // debug($res);
                                                
                                                    ?>
                                                    <tr>

                                                        <td style="width: 15%;" align="center">
                                                            <?php echo $this->Form->input('type', array('label' => '', 'type' => 'hidden', 'value' => $res['type'], 'name' => 'data[lignecommandeclients][' . $i . '][type]', 'id' => 'type' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  ')); ?>

                                                            <?php
                                                            echo $this->Form->input('sup0', array('name' => 'data[lignecommandeclients][' . $i . '][sup0]', 'id' => 'sup0' . $i, 'champ' => 'sup0', 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                            echo $this->Form->input('id', array('label' => '', 'value' => $res['id'], 'name' => 'data[lignecommandeclients][' . $i . '][id]', 'type' => 'hidden', 'id' => 'id' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                            echo $this->Form->control('article_id', ['empty' => 'Veuillez choisir !!!', 'index' => $i, 'id' => 'article_id' . $i, 'options' => $articleservises, 'value' => $res['article_id'], 'name' => 'data[lignecommandeclients][' . $i . '][article_id]', 'label' => '', 'table' => 'lignecommandeclients', 'champ' => 'article_id', 'class' => 'form-control select2 getprixarticle Testdep  ']); ?>
                                                        </td>
                                                        <td style="width: 15%;">
                                                            <?php //echo $this->Form->input('description', array('label' => '', 'value' => $res['description'], 'name' => 'data[lignecommandeclients][' . $i . '][description]', 'id' => 'description' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  ')); ?>
                                                            <br>
                                                            <div style="display:flex">

                                                                <input type="text" id="description<?php echo $i ?>"
                                                                    class="form-control  " index="<?php echo $i ?>"
                                                                    name="data[lignecommandeclients][<?php echo $i ?>][description]"
                                                                    value="<?php echo $res['description'] ?>">
                                                                <a class="btn btn-primary description "
                                                                    id="button<?php echo $i ?>" index="<?php echo $i ?>">
                                                                    <i class="fa fa-edit"></i></a>

                                                            </div>

                                                        </td>

                                                        <td style="width: 8%;" hidden>
                                                            <br>
                                                            <select champ="unite_id" id="unite_id<?php echo $i; ?>"
                                                                index="<?php echo $i; ?>"
                                                                name="data[lignecommandeclients][<?php echo $i; ?>][unite_id]"
                                                                table="lignecommandeclients" class="form-control select2">
                                                                <option value=""></option>
                                                                <?php foreach ($unites as $key => $unit) {

                                                                    ?>
                                                                    <option value="<?php echo $unit['id'] ?>" <?php if ($unit['id'] == $res['unite_id']) {
                                                                           echo "selected";
                                                                       } ?>>
                                                                        <?php echo $unit['name'] ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>

                                                        </td>
                                                        <td style="width: 6%;" align="center">
                                                            <?php echo $this->Form->input('qte', array('label' => '', 'value' => $res['qte'], 'name' => 'data[lignecommandeclients][' . $i . '][qte]', 'type' => 'text', 'id' => 'qte' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtdupp ')); ?>
                                                        </td>
                                                        <td style="width: 8%;" align="center">
                                                            <?php echo $this->Form->input('coutrevient', array('label' => '', 'champ' => 'coutrevient', 'value' => $res['coutrevient'], 'name' => 'data[lignecommandeclients][' . $i . '][coutrevient]', 'type' => 'text', 'id' => 'coutrevient' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  calculprix')); ?>
                                                            <?php echo $this->Form->input('coutrevientt', array('label' => '', 'champ' => 'coutrevientt', 'value' => $res['coutrevient'], 'name' => 'data[lignecommandeclients][' . $i . '][coutrevientt]', 'type' => 'hidden', 'id' => 'coutrevientt' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtdupp')); ?>

                                                        </td>
                                                        <td align="center">
                                                            <?php echo $this->Form->input('coutrevientdev', array('label' => '', 'champ' => 'coutrevientdev', 'value' => sprintf("%01." . $commandeclient->nbfergule . "f", $res['coutrevient'] * $tauxchan), 'name' => 'data[lignecommandeclients][' . $i . '][coutrevientdev]', 'type' => 'text', 'id' => 'coutrevientdev' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  number  calculprix')); ?>
                                                        </td>
                                                        <?php if ($parametretaus->tauxdemarge == 1) { ?>
                                                            <td style="width: 8%;" align="center">
                                                                <?php echo $this->Form->input('tauxdemarge', array('label' => '', 'champ' => 'tauxdemarge', 'value' => $res['tauxdemarge'], 'name' => 'data[lignecommandeclients][' . $i . '][tauxdemarge]', 'type' => 'text', 'id' => 'tauxdemarge' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  getprixhtdupp')); ?>
                                                            </td>
                                                        <?php }
                                                        if ($parametretaus->tauxmarque == 1) { ?>
                                                            <td style="width: 8%;" align="center">
                                                                <?php echo $this->Form->input('tauxdemarque', array('label' => '', 'champ' => 'tauxdemarque', 'value' => $res['tauxdemarque'], 'name' => 'data[lignecommandeclients][' . $i . '][tauxdemarque]', 'type' => 'text', 'id' => 'tauxdemarque' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  getprixhtdupp')); ?>
                                                            </td>
                                                        <?php } ?>
                                                        <!-- <td style="width: 8%;" align="center"> -->
                                                        <!-- <?php echo $this->Form->input('prixht', array('label' => '', 'value' => $res['prixht'], 'name' => 'data[lignecommandeclients][' . $i . '][prixht]', 'type' => 'text', 'id' => 'prixht' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtdup ')); ?> -->
                                                        <!-- </td> -->
                                                        <td align="center">
                                                            <?php if ($res['tauxdemarge'] !== null) {

                                                                echo $this->Form->input('prixht', array('label' => '', 'champ' => 'prixht', 'value' => intval($res['prixht']), 'name' => 'data[lignecommandeclients][' . $i . '][prixht]', 'type' => 'text', 'id' => 'prixht' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtdupp '));
                                                            } else {
                                                                echo $this->Form->input('prixht', array('label' => '', 'champ' => 'prixht', 'value' => sprintf("%01.3f", $res['prixht']), 'name' => 'data[lignecommandeclients][' . $i . '][prixht]', 'type' => 'text', 'id' => 'prixht' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtdupp '));
                                                            }
                                                            ?>

                                                        </td>
                                                        <td>
                                                            <div style="display:flex">
                                                                <div>
                                                                    <?php
                                                                    echo $this->Form->control('typeremise_id', ['label' => '', 'id' => 'typeremise_id' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'value' => $res['typeremise_id'], 'name' => 'data[lignecommandeclients][' . $i . '][typeremise_id]', 'class' => "form-control select2 typeremise_idl", 'options' => $typeremises]);
                                                                    ?>
                                                                </div>

                                                                <div id="divremise<?php echo $i; ?>"
                                                                    table="lignecommandeclients" index="<?php echo $i; ?>"
                                                                    style="display:<?php if ($res['typeremise_id'] == 1) {
                                                                        echo "block";
                                                                    } else {
                                                                        echo "none";
                                                                    } ?> ">
                                                                    <?php echo $this->Form->input('remise', array('label' => '', 'value' => $res['remise'], 'name' => 'data[lignecommandeclients][' . $i . '][remise]', 'type' => 'text', 'id' => 'remise' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtdupp testremise')); ?>
                                                                </div>
                                                                <div id="divremiseval<?php echo $i; ?>"
                                                                    table="lignecommandeclients" index="<?php echo $i; ?>"
                                                                    style="display:<?php if ($res['typeremise_id'] == 2) {
                                                                        echo "block";
                                                                    } else {
                                                                        echo "none";
                                                                    } ?> ">
                                                                    <?php echo $this->Form->input('remiseval', array('label' => '', 'value' => $res['remiseval'], 'name' => 'data[lignecommandeclients][' . $i . '][remiseval]', 'type' => 'text', 'id' => 'remiseval' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtdupp testremise')); ?>

                                                                </div>
                                                            </div>

                                                        </td>

                                                        <!-- <td style="width: 8%;" align="center">
                                                            <?php echo $this->Form->input('remise', array('label' => '', 'value' => $res['remise'], 'name' => 'data[lignecommandeclients][' . $i . '][remise]', 'type' => 'text', 'id' => 'remise' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtdupp ')); ?>
                                                        </td> -->
                                                        <td style="width: 8%;" align="center" hidden>
                                                            <?php echo $this->Form->input('punht', array('label' => '', 'value' => $res['punht'], 'name' => 'data[lignecommandeclients][' . $i . '][punht]', 'type' => 'text', 'id' => 'punht' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtdupp ')); ?>
                                                        </td>
                                                        <td champ="tdtva" table="tablelignetva" id="tdtva<?php echo $i; ?>"
                                                            name="data[ligner]['<?php echo $i; ?>'][tdtva]"
                                                            index="<?php echo $i; ?>"
                                                            style=" display:<?php echo ($commandeclient->tvaOnOff == 1) ? 'table-cell' : 'none'; ?>"
                                                            align="center">
                                                            <?php echo $this->Form->input('tva', array('label' => '', 'value' => $res->tva, 'name' => 'data[lignecommandeclients][' . $i . '][tva]', 'type' => 'text', 'id' => 'tva' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtdupp ')); ?>
                                                        </td>

                                                        <!-- <td style="width: 12%;" align="center">
                                                                <?php echo $this->Form->input('fodec', array('label' => '', 'value' => $res->fodec, 'name' => 'data[lignecommandeclients][' . $i . '][fodec]', 'type' => 'text', 'id' => 'fodec' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtdupp ')); ?>
                                                            </td> -->
                                                        <td style="width: 8%;" align="center">
                                                            <?php echo $this->Form->input('ttc', array('readonly', 'label' => '', 'value' => $res['ttc'], 'name' => 'data[lignecommandeclients][' . $i . '][ttc]', 'type' => 'text', 'id' => 'ttc' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtdupp '));
                                                            $totalttc = $totalttc + $res['ttc']; ?>
                                                        </td>
                                                        <td style="width:2%" align="center"><i index="<?php echo $i ?>"
                                                                class="fa fa-times supLigne"
                                                                style="color: #C9302C;font-size: 22px;"></td>
                                                    </tr>
                                                <?php endforeach; ?>

                                                <tr class='tr' style="display: none !important">
                                                    <td style="width: 15%;" align="center">
                                                        <?php echo $this->Form->input('id', array('champ' => 'id', 'label' => '', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                        <?php
                                                        echo $this->Form->input('type', array('name' => '', 'id' => '', 'champ' => 'type', 'value' => '2', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden'));
                                                        echo $this->Form->input('sup0', array('name' => '', 'id' => '', 'champ' => 'sup0', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden'));
                                                        echo $this->Form->control('article_id', ['options' => $articleservises, 'empty' => 'Veuillez choisir !!', 'label' => '', 'table' => 'lignecommandeclients', 'champ' => 'article_id', 'class' => 'form-control getprixarticle']); ?>
                                                    </td>
                                                    <td style="width: 15%;">
                                                        <br>

                                                        <div style="display:flex">

                                                            <input type="text" champ="description"
                                                                table="lignecommandeclients" class="form-control  ">
                                                            <a class="btn btn-primary description " champ="buttondesc"
                                                                table="lignecommandeclients">
                                                                <i class="fa fa-edit"></i></a>

                                                        </div>
                                                        <?php //echo $this->Form->input('description', array('champ' => 'description', 'label' => '', 'name' => '', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  ')); ?>
                                                    </td>
                                                    <td style="width: 8%;" hidden>
                                                        <br>
                                                        <select champ="unite_id" table="lignecommandeclients"
                                                            class="form-control " id="">
                                                            <option value=""></option>
                                                            <?php foreach ($unites as $key => $unit) {

                                                                ?>
                                                                <option value="<?php echo $unit['id'] ?>">
                                                                    <?php echo $unit['name'] ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>

                                                    </td>

                                                    <td align="center" style="width: 6%;">
                                                        <?php echo $this->Form->input('qte', array('champ' => 'qte', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtdupp ')); ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('coutrevient', array('champ' => 'coutrevient', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  calculprix')); ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('coutrevientdev', array(/* 'readonly', */ 'champ' => 'coutrevientdev', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number  calculprix ')); ?>
                                                    </td>
                                                    <?php if ($parametretaus->tauxdemarge == 1) { ?>
                                                        <td align="center">
                                                            <?php echo $this->Form->input('tauxdemarge', array('champ' => 'tauxdemarge', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  calculprix')); ?>
                                                        </td>
                                                    <?php }
                                                    if ($parametretaus->tauxmarque == 1) { ?>
                                                        <td align="center">
                                                            <?php echo $this->Form->input('tauxdemarque', array('champ' => 'tauxdemarque', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  calculprix')); ?>
                                                        </td>
                                                    <?php } ?>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('prixht', array('champ' => 'prixht', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtdupp ')); ?>
                                                    </td>

                                                    <td>
                                                        <div style="display:flex">
                                                            <div>
                                                                <?php
                                                                echo $this->Form->control('typeremise_id', ['champ' => 'typeremise_id', 'label' => '', 'name' => '', 'table' => 'lignecommandeclients', 'class' => "form-control  typeremise_idl ", 'options' => $typeremises]); ?>

                                                            </div>

                                                            <div champ="divremise" table="lignecommandeclients">
                                                                <?php echo $this->Form->input('remise', array('champ' => 'remise', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtdupp testremise')); ?>
                                                            </div>
                                                            <div champ="divremiseval" table="lignecommandeclients"
                                                                style="display:none">
                                                                <?php echo $this->Form->input('remiseval', array('champ' => 'remiseval', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtdupp testremise')); ?>

                                                            </div>
                                                        </div>
                                                    </td>
                                         
                                                    <td align="center" hidden>
                                                        <?php echo $this->Form->input('punht', array('champ' => 'punht', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtdupp ')); ?>
                                                    </td>
                                                    <td champ="tdtva" table="tablelignetva" id="" name="" index=""
                                                        style="display:none;" align="center">
                                                        <?php echo $this->Form->input('tva', array('champ' => 'tva', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtdupp ')); ?>
                                                    </td>
                                                    <!-- <td align="center">
                                                          <?php echo $this->Form->input('fodec', array('champ' => 'fodec', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtdupp ')); ?>
                                                        </td> -->
                                                    <td align="center">

                                                        <?php echo $this->Form->input('ttc', array('champ' => 'ttc', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtdupp ')); ?>
                                                    </td>
                                                    <td style="width:2%" align="center"><i id=""
                                                            class="fa fa-times supLigne"
                                                            style="color: #C9302C;font-size: 22px;"></td>

                                                </tr>
                                            </tbody>
                                        </table><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <input type="hidden" value="<?php echo $i ?>" id="indexoffreggb">
                    <div class="col-md-6">
                        <?php
                        echo $this->Form->control('typeremise_id', ['id' => 'typeremise_id', 'class' => "form-control select2 getprixhtdupp", 'options' => $typeremises]);
                        ?>
                    </div>
                    <div class="col-md-6">
                        <div id="remisetotaldiv"   style="display: <?php if ($commandeclient->typeremise_id == 1) { ?>block<?php } else { ?>none<?php } ?>">
                            <?php echo $this->Form->control('remisetotal', ['id' => 'remisetotal', 'value' => $commandeclient->remisetotal, 'label' => 'Remise relative sur le total en %', 'type' => 'text', 'min' => 0, 'max' => 100, 'class' => 'form-control number getprixhtdupp testremise']); ?>

                        </div>
                        <div id="remisetotalvaldiv" style="display: <?php if ($commandeclient->typeremise_id == 2) { ?>block<?php } else { ?>none<?php } ?>">
                            <?php echo $this->Form->control('remisetotalval', ['id' => 'remisetotalval', 'value' => $commandeclient->remisetotalval, 'label' => 'Remise relative sur le total en valeur', 'type' => 'text', 'class' => 'form-control number getprixhtdupp testremise']); ?>

                        </div>

                    </div>
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                        <?php echo $this->Form->control('totalht', ['readonly' => true, 'value' => sprintf("%01." . $commandeclient->nbfergule . "f", $commandeclient->totalht)]); ?>
                    </div>
                    <div id="divtva" class="col-xs-3"
                        style="display:<?php echo ($commandeclient->tvaOnOff == 1) ? 'block' : 'none'; ?>">
                        <?php echo $this->Form->control('totaltva'); ?>
                    </div>
                    <?php if ($parametretaus->tauxmarque == 1) { ?>
                        <div class="col-md-6">
                            <?php echo $this->Form->control('totalfodec', ['readonly' => true, 'label' => 'Total Taux de Marque', 'id' => 'totalmarque']); ?>
                        </div>
                    <?php }
                    if ($parametretaus->tauxdemarge == 1) { ?>
                        <div class="col-md-6">
                            <?php echo $this->Form->control('totalmarge', ['readonly' => true, 'label' => 'Total Taux de Marge', 'value' => $commandeclient->totalmarge, 'id' => 'totalmarge']); ?>
                        </div>
                    <?php } ?>
                    <div class="col-md-6">
                        <?php echo $this->Form->control('totalremise', ['readonly' => true, 'value' => sprintf("%01." . $commandeclient->nbfergule . "f", $commandeclient->totalremise)]); ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $this->Form->control('totalttc', ['readonly' => true, 'value' => sprintf("%01." . $commandeclient->nbfergule . "f",  $commandeclient->totalttc)]) ?>
                        <?php
                        echo $this->Form->control('totalttcdl', ['id' => 'totalttcdl', 'type' => 'hidden', 'value' => sprintf("%01.3f", $commandeclient->totalttcdl), 'table' => 'tablecommandeclient', 'label' => 'Total TTC', 'readonly' => true]); ?>

                    </div>
                    <div align="center" class="btnEditCmdClient" id="e1">
                        <button type="submit" class="pull-right btn btn-success btn-sm" id="pointv"
                            style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
</section>

<div id="popupOverlay" class="overlay-container">
    <div class="popup-box">
        <!-- <h2 style="color: green;">Envoyer vers le fournisseur</h2> -->
        <div class="form-container">

            <input type="hidden" id="idligne">
            <?php echo $this->Form->control('description', ['rows' => 15, 'id' => 'descriptionlong']); ?>

            <button type="button" class="btn-envoyer appliquedes">
                Enregistrer
            </button>
        </div>

        <button class="btn-close-popup" onclick="togglePopup()">
            Close
        </button>
    </div>
</div>
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
    function togglePopup() {
        //console.log(id)
        $("#idligne").val("");
        $("#descriptionlong").val("");
        const overlay = document.getElementById('popupOverlay');
        overlay.classList.toggle('show');
    }
    function calcullll() {
        // index1 = $("#indexa").val();
        index = $("#indexoffreggb").val();
        taux = 1;
        tauxChange2 = $("#tauxChange").val();
        if (tauxChange2 != '' && Number(tauxChange2) != 0) {
            taux = $("#tauxChange").val();
        }
        // indexl = $("#indexa" + index).val();
        nbfergule = $("#nbfergule").val();
        // indexl = $("#indexa" + index).val();
        ferg = 3;
        if (nbfergule != '' && Number(nbfergule) != 0) {
            ferg = $("#nbfergule").val();

        }
        prixMG = 0;
        prixMQ = 0;
        total = 0;
        totalmarge = 0;
        totalmarque = 0;

        for (i = 0; i <= Number(index); i++) {
            sup = $("#sup0" + i).val() || 0;
            if (Number(sup) != 1) {
                coutrevient = $("#coutrevient" + i).val(); //alert(prixrevient)
                MG = $("#tauxdemarge" + i).val() || 0; //alert(MG)
                MQ = $("#tauxdemarque" + i).val() || 0; //alert(MQ)
                prixrevient = Number(coutrevient) * Number(taux);
                $("#coutrevientdev" + i).val(Number(prixrevient).toFixed(ferg));
                console.log('mg ' + MG);
                if (MG && MQ) {
                    alert("Veuillez saisir uniquement un taux de marge ou un taux de marque.");
                    $("#tauxdemarge" + i).val('');
                    $("#tauxdemarque" + i).val('');
                    $("#prixht" + i).val('');
                    // $("#punht" + i).val('');
                } else if (MQ && Number(prixrevient) != 0) {
                    marque = 100 - Number(MQ);

                    //prixMG = Number(prixrevient) + (Number(MQ) * Number(prixrevient) / 100)
                    prixMG = ((Number(prixrevient) * 100) / Number(marque));//*Number(taux);
                    // prixMG = Math.floor(prixMG); // Conversion en entier
                    $("#prixht" + i).val(Number(prixMG).toFixed(ferg));
                    //$("#prixht" + i).val(prixMG);
                    //$("#punht" + i).val(prixMG);
                    margel = Number(prixMG) * Number(MQ / 100);//*Number(taux);
                    totalmarque = (Number(totalmarque) + Number(margel)).toFixed(ferg);

                } else if (MG && Number(prixrevient) != 0) {
                    prixMQ = (Number(prixrevient) + (Number(MG) * Number(prixrevient) / 100));///Number(taux); //alert(prixMQ)
                    // alert(Number(prixMQ).toFixed(3));
                    $("#prixht" + i).val(Number(prixMQ).toFixed(ferg));
                    marquel = Number(prixMQ) * Number(MG / 100) * Number(taux);
                    totalmarge = (Number(totalmarge) + Number(marquel)).toFixed(ferg);
                    // $("#punht" + i).val(prixMG);
                } else {
                    if (Number(prixrevient) != 0) {
                        $("#prixht" + i).val(Number(Number(prixrevient)/* *Number(taux)  */).toFixed(ferg));
                    }

                }
            }
        }
        //   $("#totalmarge").val(Number(totalmarge).toFixed(ferg));
        //   $("#totalmarque").val(Number(totalmarque).toFixed(ferg));
        getprixhtdupia();

    }

    $(document).ready(function () {
        $('#typeremise_id').on('change', function () {
            typeremise_id = $(this).val();
            if (typeremise_id == 1) {
                $('#remisetotaldiv').show();
                $('#remisetotal').val('');
                $('#remisetotalval').val('');
                $('#remisetotalvaldiv').hide();

            } else if (typeremise_id == 2) {
                $('#remisetotaldiv').hide();
                $('#remisetotalvaldiv').show();
                $('#remisetotalval').val('');
                $('#remisetotal').val('');
            }
        });
        $('.typeremise_idl').on('change', function () {
            typeremise_id = $(this).val();
            i = $(this).attr("index");
            if (typeremise_id == 1) {
                $('#divremise' + i).show();
                $('#remiseval' + i).val('');
                $('#remise' + i).val('');
                $('#divremiseval' + i).hide();

            } else if (typeremise_id == 2) {
                $('#divremise' + i).hide();
                $('#divremiseval' + i).show();
                $('#remise' + i).val('');
                $('#remiseval' + i).val('');
            }
        });
        $("#tauxachat").on("keyup", function () {
            devise_id = $('#devis_id').val();
            index = $("#indexoffreggb").val();
            nbfergule = $("#nbfergule").val();
            deviseprojet = $("#deviseprojet").val();
            taux = 1;
            tauxChange2 = $("#tauxChange").val();
            if (tauxChange2 != '' && Number(tauxChange2) != 0) {
                taux = $("#tauxChange").val();
            }
            //getTauxdevise(devise_id,deviseprojet)

            tauxChange = $("#tauxachat").val() || 1;

            // indexl = $("#indexa" + index).val();
            ferg = 3;
            if (nbfergule != '' && Number(nbfergule) != 0) {
                ferg = $("#nbfergule").val();

            }

            prixMG = 0;
            prixMQ = 0;
            total = 0;
            totalmarge = 0;
            totalmarque = 0;
            for (i = 0; i <= Number(index); i++) {
                sup = $("#sup0" + i).val() || 0;
                if (Number(sup) != 1) {
                    coutrevientt = $("#coutrevientt" + i).val() || 0;
                    cout = Number(coutrevientt) * Number(tauxChange);
                    $("#coutrevient" + i).val(Number(Number(cout)).toFixed(3));
                    coutrevient = $("#coutrevient" + i).val(); //alert(prixrevient)
                    MG = $("#tauxdemarge" + i).val() || 0; //alert(MG)
                    MQ = $("#tauxdemarque" + i).val() || 0; //alert(MQ)

                    prixrevient = Number(coutrevient) * Number(taux);
                    $("#coutrevientdev" + i).val(Number(prixrevient).toFixed(ferg));

                    if (MG && MQ) {
                        alert("Veuillez saisir uniquement un taux de marge ou un taux de marque.");
                        $("#tauxdemarge" + i).val('');
                        $("#tauxdemarque" + i).val('');
                        $("#prixht" + i).val('');
                        // $("#punht" + i).val('');
                    } else if (MQ && Number(prixrevient) != 0) {

                        marque = 100 - Number(MQ);
                        //console.log('marque '+prixMG);
                        //prixMG = Number(prixrevient) + (Number(MQ) * Number(prixrevient) / 100)
                        prixMG = ((Number(prixrevient) * 100) / Number(marque));//*Number(taux);
                        //console.log('prixMG '+prixMG);
                        // prixMG = Math.floor(prixMG); // Conversion en entier

                        $("#prixht" + i).val(Number(prixMG).toFixed(ferg));
                        //$("#prixht" + i).val(prixMG);
                        //$("#punht" + i).val(prixMG);
                        // margel = Number(prixMG) * Number(MQ / 100);//*Number(taux);

                    } else if (MG && Number(prixrevient) != 0) {

                        prixMQ = (Number(prixrevient) + (Number(MG) * Number(prixrevient) / 100));//*Number(taux); //alert(prixMQ)
                        $("#prixht" + i).val(Number(prixMQ).toFixed(ferg));
                    } else {
                        if (Number(prixrevient) != 0) {
                            $("#prixht" + i).val(Number(Number(prixrevient)/* /Number(taux) */).toFixed(ferg));
                        }

                    }
                }
            }

            getprixhtduplicate();
        });
        $(".calculprix").on("keyup", function () {
            // index = $("#index").val();
            // index1 = $("#indexa").val();
            devise_id = $('#devis_id').val();
            index = $("#indexoffreggb").val();
            nbfergule = $("#nbfergule").val();
            deviseprojet = $("#deviseprojet").val();
            taux = 1;
            tauxChange2 = $("#tauxChange").val();
            if (tauxChange2 != '' && Number(tauxChange2) != 0) {
                taux = $("#tauxChange").val();
            }
            tauxa = $("#tauxachat").val() || 1;
            i = $(this).attr('index');


            // indexl = $("#indexa" + index).val();
            ferg = 3;
            if (nbfergule != '' && Number(nbfergule) != 0) {
                ferg = $("#nbfergule").val();

            }
            champ = $(this).attr('champ');

            // virg = 2;
            // //nbvirgule = $("#nbvirgule"+i).val();
            // nbvirgule = $("#nbfergule").val();
            // if (nbvirgule != '' && Number(nbvirgule) != 0) {
            //     virg = Number(nbvirgule);

            // }
            virg = ferg;
            MG = $("#tauxdemarge" + i).val() || 0; //alert(MG)
            MQ = $("#tauxdemarque" + i).val() || 0; //alert(MQ)

            if (champ != "coutrevientdev") {
                // coutrevientt = $("#coutrevientt" + i).val() || 0;
                // cout = Number(coutrevientt) * Number(tauxChange);
                // $("#coutrevient" + i).val(Number(Number(cout)).toFixed(3));
                coutrevient = $("#coutrevient" + i).val(); //alert(prixrevient)


                prixrevient = Number(coutrevient) * Number(taux);
                $("#coutrevientdev" + i).val(Number(prixrevient).toFixed(virg));

            } else {
                prixrevient = $("#coutrevientdev" + i).val();
                coutrevient = Number(prixrevient) / Number(taux);
                $("#coutrevient" + i).val(Number(coutrevient).toFixed(virg));
            }
            if (MG && MQ) {
                alert("Veuillez saisir uniquement un taux de marge ou un taux de marque.");
                $("#tauxdemarge" + i).val('');
                $("#tauxdemarque" + i).val('');
                $("#prixht" + i).val('');
                // $("#punht" + i).val('');
            } else if (MQ && Number(prixrevient) != 0) {

                marque = 100 - Number(MQ);
                prixMG = ((Number(prixrevient) * 100) / Number(marque)); //*Number(taux);
                $("#prixht" + i).val(Number(prixMG).toFixed(virg));
            } else if (MG && Number(prixrevient) != 0) {
                prixMQ = (Number(prixrevient) + (Number(MG) * Number(prixrevient) / 100)); //*Number(taux); //alert(prixMQ)
                $("#prixht" + i).val(Number(prixMQ).toFixed(virg));
            } else {
                if (Number(prixrevient) != 0) {
                    $("#prixht" + i).val(Number(Number(prixrevient) /* /Number(taux) */).toFixed(virg));
                }

            }
            getprixhtduplicate();

        });
        $(".calculprix111102024").on("keyup", function () {
            // index = $("#index").val();
            // index1 = $("#indexa").val();
            devise_id = $('#devis_id').val();
            index = $("#indexoffreggb").val();
            nbfergule = $("#nbfergule").val();
            deviseprojet = $("#deviseprojet").val();
            taux = 1;
            tauxChange2 = $("#tauxChange").val();
            if (tauxChange2 != '' && Number(tauxChange2) != 0) {
                taux = $("#tauxChange").val();
            }
            //getTauxdevise(devise_id,deviseprojet)



            // indexl = $("#indexa" + index).val();
            ferg = 3;
            if (nbfergule != '' && Number(nbfergule) != 0) {
                ferg = $("#nbfergule").val();

            }

            prixMG = 0;
            prixMQ = 0;
            total = 0;
            totalmarge = 0;
            totalmarque = 0;
            for (i = 0; i <= Number(index); i++) {
                sup = $("#sup0" + i).val() || 0;
                if (Number(sup) != 1) {
                    coutrevient = $("#coutrevient" + i).val(); //alert(prixrevient)
                    MG = $("#tauxdemarge" + i).val() || 0; //alert(MG)
                    MQ = $("#tauxdemarque" + i).val() || 0; //alert(MQ)

                    prixrevient = Number(coutrevient) * Number(taux);
                    $("#coutrevientdev" + i).val(Number(prixrevient).toFixed(ferg));
                    console.log('mg ' + MG);
                    if (MG && MQ) {
                        alert("Veuillez saisir uniquement un taux de marge ou un taux de marque.");
                        $("#tauxdemarge" + i).val('');
                        $("#tauxdemarque" + i).val('');
                        $("#prixht" + i).val('');
                        // $("#punht" + i).val('');
                    } else if (MQ && Number(prixrevient) != 0) {

                        marque = 100 - Number(MQ);

                        //prixMG = Number(prixrevient) + (Number(MQ) * Number(prixrevient) / 100)
                        prixMG = ((Number(prixrevient) * 100) / Number(marque));//*Number(taux);
                        // prixMG = Math.floor(prixMG); // Conversion en entier

                        $("#prixht" + i).val(Number(prixMG).toFixed(ferg));
                        //$("#prixht" + i).val(prixMG);
                        //$("#punht" + i).val(prixMG);
                        // margel = Number(prixMG) * Number(MQ / 100);//*Number(taux);
                        prixMQ = (Number(prixrevient) + (Number(MG) * Number(prixrevient) / 100));//*Number(taux); //alert(prixMQ)
                        $("#prixht" + i).val(Number(prixMQ).toFixed(ferg));
                    } else {
                        if (Number(prixrevient) != 0) {
                            $("#prixht" + i).val(Number(Number(prixrevient)/* /Number(taux) */).toFixed(ferg));
                        }

                    }
                }
            }

            getprixhtduplicate();

        });
        $(".calcull").on("keyup", function () {
            index = $("#index").val(); //nombre de ligne total
            index1 = $("#indexa").val();
            index = $("#index").val();
            indexl = $("#indexoffreggb").val();
            tt = 0;
            total = 0;

            for (i = 0; i <= Number(indexl); i++) {
                sup = $("#sup" + i).val() || 0;
                if (Number(sup) != 1) {
                    qte = $("#qte" + j + "-" + i).val();
                    prix = $("#prix" + j + "-" + i).val();
                    tot = Number(qte) * Number(prix);
                    total = Number(total) + Number(tot);
                    $("#total" + j + "-" + i).val(Number(tot).toFixed(3)); ///('afef')
                }

                tt = Number(tt) + Number(total);
                $("#t" + j).val(Number(tt).toFixed(3));
            }
        });
        $('.description').on('click', function () {
            //alert('description')
            idligne = $(this).attr("index");
            $("#idligne").val(idligne);
            $("#descriptionlong").val($("#description" + idligne).val());
            const overlay = document.getElementById('popupOverlay');
            overlay.classList.toggle('show');

        });
        $('.appliquedes').on('click', function () {
            //alert('description')
            idligne = $("#idligne").val();
            $("#description" + idligne).val($("#descriptionlong").val());
            const overlay = document.getElementById('popupOverlay');
            overlay.classList.toggle('show');

        });
        $(".calculprixxx").on("keyup", function () {
            // index = $("#index").val();
            // index1 = $("#indexa").val();
            index = $("#indexoffreggb").val();
            // indexl = $("#indexa" + index).val();

            prixMG = 0;
            prixMQ = 0;
            total = 0;
            totalmarge = 0;
            totalmarque = 0;
            taux = 1;
            tauxChange2 = $("#tauxChange").val();
            if (tauxChange2 != '' && Number(tauxChange2) != 0) {
                taux = $("#tauxChange").val();
            }
            //getTauxdevise(devise_id,deviseprojet)



            // indexl = $("#indexa" + index).val();
            ferg = 3;
            if (nbfergule != '' && Number(nbfergule) != 0) {
                ferg = $("#nbfergule").val();

            }
            for (i = 0; i <= Number(index); i++) {
                sup = $("#sup0" + i).val() || 0;
                if (Number(sup) != 1) {
                    prixrevient = $("#coutrevient" + i).val(); //alert(prixrevient)
                    MG = $("#tauxdemarge" + i).val() || 0; //alert(MG)
                    MQ = $("#tauxdemarque" + i).val() || 0; //alert(MQ)
                    console.log('mg ' + MG);
                    if (MG && MQ) {
                        alert("Veuillez saisir uniquement un taux de marge ou un taux de marque.");
                        $("#tauxdemarge" + i).val('');
                        $("#tauxdemarque" + i).val('');
                        $("#prixht" + i).val('');
                        // $("#punht" + i).val('');
                    } else if (MG && Number(prixrevient) != 0) {
                        prixMG = Number(prixrevient) + (Number(MG) * Number(prixrevient) / 100)
                        prixMG = Math.floor(prixMG); // Conversion en entier
                        $("#prixht" + i).val(prixMG);
                        //$("#punht" + i).val(prixMG);
                        margel = Number(prixMG) * Number(MG / 100);
                        totalmarge = (Number(totalmarge) + Number(margel)).toFixed(3);
                    } else if (MQ && Number(prixrevient) != 0) {
                        prixMQ = Number(prixrevient) + (Number(MQ) * Number(prixrevient) / 100); //alert(prixMQ)
                        $("#prixht" + i).val(Number(prixMQ).toFixed(3));
                        marquel = Number(prixMQ) * Number(MQ / 100);
                        totalmarque = (Number(totalfodec) + Number(marquel)).toFixed(3);
                        // $("#punht" + i).val(prixMG);
                    } else {
                        if (Number(prixrevient) != 0) {
                            $("#prixht" + i).val(Number(prixrevient).toFixed(3));
                        }

                    }
                }
            }
            $("#totalmarge").val(Number(totalmarge).toFixed(3));
            $("#totalmarque").val(Number(totalmarque).toFixed(3));
            getprixhtdupia();

        });
    });
</script>
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    ;

    input[type="number"] {
        -moz-appearance: textfield;
    }
</style>
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

<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<!-- DataTables -->
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<!-- <script>
    $(document).ready(function () {
        $(".calculprix").on("keyup", function () {
            // index = $("#index").val();
            // index1 = $("#indexa").val();
            index = $("#indexoffreggb").val();
            // indexl = $("#indexa" + index).val();

            prixMG = 0;
            prixMQ = 0;
            total = 0;
            for (i = 0; i <= Number(index); i++) {
                sup = $("#sup0" + i).val() || 0;
                if (Number(sup) != 1) {
                    prixrevient = $("#coutrevient" + i).val();// alert(prixrevient)
                    MG = $("#tauxdemarge" + i).val(); //alert(MG)
                    MQ = $("#tauxdemarque" + i).val(); //alert(MQ)
                    if (MG && MQ) {
                        alert("Veuillez saisir uniquement un taux de marge ou un taux de marque.");
                        $("#tauxdemarge" + i).val('');
                        $("#tauxdemarque" + i).val('');
                        $("#prixht" + i).val('');
                        // $("#punht" + i).val('');
                    } else if (MG) {
                        prixMG = Number(prixrevient) + (Number(MG) * Number(prixrevient) / 100)
                        prixMG = Math.floor(prixMG); // Conversion en entier
                        $("#prixht" + i).val(prixMG);
                        $("#punht" + i).val(prixMG);
                    } else if (MQ) {
                        prixMQ = Number(prixrevient) + (Number(MQ) * Number(prixrevient) / 100); //alert(prixMQ)
                        $("#prixht" + i).val(Number(prixMQ).toFixed(3));
                        // $("#punht" + i).val(prixMG);
                    }
                }
            }

        });
    });
</script> -->
<script type="text/javascript">
    $(function () {
        $('.gettvas').on('change', function () {
            // alert('hello');
            index = $(this).attr("index");
            id = $('#tva_id').val();
            // alert(id)
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Commandeclients', 'action' => 'gettvas']) ?>",
                dataType: "json",
                data: {
                    id: id,

                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (data) {
                    $('#tva' + index).val(data.val);


                }

            })

        });
    });

</script>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
        // $("#verifenr").on("mouseover", function () {
        //   client_id = $("#client_id").val();//alert(client_id)
        //   opportunite_id = $("#opportunite_id").val();
        //   datedebut = $("#datedebut").val();
        //   datefin = $("#datefin").val();
        //   if (client_id == "") {
        //     alert("Veuillez choisir un tier !!", function () { });
        //     return false;
        //   } if (datedebut == "") {
        //     alert("Veuillez entrer la date de debut !!", function () { });
        //     return false;
        //   }if (datefin == "") {
        //     alert("Veuillez entrer la date fin !!", function () { });
        //     return false;
        //   }if (opportunite_id == "") {
        //     alert("Veuillez choisir une Statut opportunit� !!", function () { });
        //     return false;
        //   }
        // });
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
            function (start, end) {
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
<style>
    .select2-selection__rendered {
        line-height: 25px !important;
    }

    .select2-container .select2-selection--single {
        height: 35px !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        border-color: #D2D6DE !important;
    }

    .select2-selection__arrow {
        height: 34px !important;
    }

    .select2-selection__choice {
        height: 24px !important;
        color: black !important;
        background-color: white !important;
        font-size: 18px !important;
    }

    .select2-container {
        display: block;
        /* width: auto !important; */
    }
</style>
<script>
    function openWindow(h, w, url) {
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }
</script>
<script>
    // if ($('#codetauxdechange').val() != '-1') {
    //     devise = $('#codetauxdechange').val();
    //     const apiKey = 'fba6e8ad2ac7e46125bc58df';
    //     const url = `https://v6.exchangerate-api.com/v6/${apiKey}/latest/${devise}`;
    //     fetch(url)
    //         .then(response => {
    //             if (!response.ok) {
    //                 throw new Error('Erreur lors de la récupération des données');
    //             }
    //             return response.json();
    //         })
    //         .then(data => {
    //             const tauxTND = data.conversion_rates.TND;
    //             document.getElementById('tauxChange').value = tauxTND;
    //             document.getElementById('message').textContent = '';
    //         })
    //         .catch(error => {
    //             document.getElementById('message').textContent = 'Erreur: Impossible de récupérer le taux de change.';
    //             document.getElementById('tauxChange').value = '';

    //         });

    // }

    function getTauxChange2(devise) {
        const apiKey = 'fba6e8ad2ac7e46125bc58df';
        const url = `https://v6.exchangerate-api.com/v6/${apiKey}/latest/${devise}`;
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erreur lors de la récupération des données');
                }
                return response.json();
            })
            .then(data => {
                const tauxTND = data.conversion_rates.TND;
                document.getElementById('tauxChange2').value = tauxTND;
                document.getElementById('message2').textContent = '';
            })
            .catch(error => {
                document.getElementById('message2').textContent = 'Erreur: Impossible de récupérer le taux de change.';
                document.getElementById('tauxChange2').value = '';

            });
    }

    function getTauxChange(devise) {
        const apiKey = 'fba6e8ad2ac7e46125bc58df';
        const url = `https://v6.exchangerate-api.com/v6/${apiKey}/latest/${devise}`;
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erreur lors de la récupération des données');
                }
                return response.json();
            })
            .then(data => {
                const tauxTND = data.conversion_rates.TND;
                document.getElementById('tauxChange').value = tauxTND;
                document.getElementById('message').textContent = '';
            })
            .catch(error => {
                document.getElementById('message').textContent = 'Erreur: Impossible de récupérer le taux de change.';
                document.getElementById('tauxChange').value = '';

            });
    }
    $(document).ready(function () {
        $('#deviseSelect2').on('change', function () {
            // var devise_id = $(this).val();
            devise_id = $('#devis_id2').val();
            // var devise = mapDevise(devise_id);

            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Projets', 'action' => 'getdevise']) ?>",
                dataType: "json",
                data: {
                    devise_id: devise_id,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (data) {
                    console.log(data)
                    var devis = data.code;
                    getTauxChange2(devis);
                }

            })
        });
        $('.deviseSelect').on('change', function () {
            // var devise_id = $(this).val();
            devise_id = $('#devis_id').val();
            projet_id = $('#projet-id').val();
            //alert(projet_id);
            devisachat_id = $('#devisachat_id').val();
            // var devise = mapDevise(devise_id);

            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Projets', 'action' => 'getdevise']) ?>",
                dataType: "json",
                data: {
                    devise_id: devise_id,
                    projet_id: projet_id,
                    devisachat_id: devisachat_id,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (data) {
                    console.log(data)
                    var devis = data.code;
                    //alert(data.taux);
                    document.getElementById('tauxChange').value = data.taux;
                    getprixhtduplicate()
                    // $('.deviseprojet2').html( data.codeachat);
                    // $('#diviseachat').html( data.code);

                }

            })
        });

    });
</script>
<?php $this->end(); ?>
<style>
    .table>tbody>tr>td,
    .table>tbody>tr>th,
    .table>tfoot>tr>td,
    .table>tfoot>tr>th {
        padding: 0px !important;
    }
</style>