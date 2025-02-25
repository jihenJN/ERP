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
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<?php echo $this->Html->script('js_vieww_projet'); ?>

<section class="content-header">
    <h1>
    Consultation Commandes Client
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
                ?>
                <div class="box-body">
                    <div class="row">

                        <div class="col-md-6">
                            <?php echo $this->Form->control('id', ['type' => 'hidden']); ?>

                            <?php echo $this->Form->control('code', ['readonly',  'disabled' => true]); ?>
                        </div>
                        <div class="col-md-6">
                            <input type="hidden" id="codetauxdechange" value="<?php echo $code; ?>">
                            <?php
                            echo $this->Form->control('client_id', [ 'disabled' => true,'id' => 'client_id', 'empty' => 'Veuillez choisir !!!', 'class' => "form-control select2", 'options' => $clients]);
                            ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->input('datedecreation', array( 'disabled' => true,'value' => $this->Time->format('now', 'd/MM/y'), 'label' => 'Date de creation', 'type' => 'date', 'placeholder' => '',  'class' => 'form-control', 'required')); ?>

                        </div>
                        <div class="col-md-6">
                            <?php
                            echo $this->Form->control('date', ['disabled'=>true]);
                            ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->control('commentaire', ['readonly'=>true,'rows' => 1]); ?>
                        </div>
                        <div class="col-md-6">
                            <?php
                            echo $this->Form->control('projet_id', ['disabled' => true,'empty' => 'Veuillez choisir !!!', 'class' => "form-control select2",]);

                            ?>
                        </div>
                        <div hidden class="col-md-6">
                            <?php
                            echo $this->Form->control('depot_id', ['disabled' => true,'options' => $depots, 'empty' => 'Veuillez choisir !!!', 'class' => "form-control select2",]);

                            ?>
                        </div>
                        <div class="col-md-6">
                            <div height="60px">
                                <label class="control-label" for="unipxte-id">TVA:</label>
                                OUI <input type="radio" disabled id="1" id="OUI" name='tvaOnOff' class="toggleEditcomclient" <?php if ($commandeclient->tvaOnOff == 1)
                                                                                                                            echo "checked"; ?>>
                                NON <input type="radio" disabled value="0" id="NON" class="toggleEditcomclient" name='tvaOnOff' <?php if ($commandeclient->tvaOnOff == 0)
                                                                                                                            echo "checked"; ?>>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <?php echo $this->Form->input('paiement_id', ['disabled' => true,'value' => $gg, 'name' => 'paiement_id', 'class' => 'form-control select2 ', 'multiple' => 'multiple', 'id' => 'paiement_id', 'label' => 'Mode de reglèment', 'options' => $paiements, 'empty' => false]); ?>
                        </div>

                        <div class="col-md-6">
                            <?php echo $this->Form->input('duree_validite', ['readonly' => true,'type' => 'number', 'value' => '15', 'class' => 'form-control', 'id' => 'duree_validite', 'label' => 'Duree de validite en Jours']); ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->input('pay', ['readonly' => true,'type' => 'text', 'class' => 'form-control ', 'id' => 'pay_id', 'label' => 'Pay']); ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->input('incoterm_id', ['disabled' => true,'value' => $commandeclient->incoterm_id, 'class' => 'form-control', 'id' => 'incoterm_id', 'label' => 'Incoterm en Total', 'empty' => 'Veuillez choisir !!']); ?>
                        </div>
                       
                        <div class="col-md-6">
                            <?php echo $this->Form->input('incotermpdf_id', ['disabled' => true,'value' => $commandeclient->incotermpdf_id, 'class' => 'form-control', 'id' => 'incotermpdf_id', 'label' => 'Incoterm Pdf', 'empty' => 'Veuillez choisir !!']); ?>
                        </div>




                        <div class="col-md-6" id="">
                            <?php echo $this->Form->input('devis_id', ['disabled' => true,'value' => $commandeclient->devis_id, 'class' => 'form-control', 'id' => 'devis_id', 'label' => 'Devises', 'options' => $devises]); ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->control('tauxdechange', ['disabled' => true,'label' => 'Taux de change de devise', 'value' => $commandeclient->tauxdechange, 'id' => 'tauxChange', 'class' => 'form-control', 'readonly']); ?>
                            <div id="message"></div>
                        </div>
                        <div class="col-xs-6" id="">
                            <?php echo $this->Form->input('devis2_id', ['disabled' => true,'value' => $commandeclient->devis2_id,   'class' => 'form-control', 'id' => 'devis_id2', 'label' => 'Devises en dinar ', 'options' => $devises, 'empty' => 'Veuillez choisir !!']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('tauxdechange2', ['readonly' => true,'value' => $commandeclient->tauxdechange2, 'label' => 'Taux de change de devise  en dinar ', 'id' => 'tauxChange2', 'class' => 'form-control', 'readonly']); ?>
                            <div id="message2"></div>
                        </div>


                        <div class="col-md-6">
                            <?php echo $this->Form->input('conditionreglement_id', ['disabled' => true,'value' => $commandeclient->conditionreglement_id, 'class' => 'form-control select2', 'id' => 'conditionreglement_id', 'label' => 'Condition de reglement', 'empty' => 'Veuillez choisir !!']); ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->input('delailivraison_id', ['disabled' => true,'value' => $commandeclient->delailivraison_id, 'class' => 'form-control select2', 'id' => 'delailivraison_id', 'label' => 'Délai de livraison', 'empty' => 'Veuillez choisir !!']); ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->input('methodeexpedition_id', ['disabled' => true,'value' => $commandeclient->methodeexpedition_id, 'class' => 'form-control select2', 'id' => 'methodeexpedition_id', 'label' => 'Méthode d`expédition', 'empty' => 'Veuillez choisir !!']); ?>
                        </div>

                        <div class="col-md-6">
                            <?php echo $this->Form->input('datelivraison', array('disabled' => true,'value' => $commandeclient->datelivraison, 'type' => 'date',  'label' => 'Date de livraison', 'id' => 'datelivraison', 'div' => 'form-group ', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control')); ?>
                        </div>

                        <div class="col-md-6">
                            <?php echo $this->Form->control('remisetotal', ['readonly' => true,'value' => $commandeclient->remisetotal, 'label' => 'Remise relative sur le total', 'id' => 'remisetotal', 'type' => 'nombre', 'class' => 'form-control']); ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->control('nbfergule', ['readonly' => true,'value' => $commandeclient->nbfergule,  'label' => 'Nombre de chiffre aprés le firgule', 'id' => 'nbfergule', 'type' => 'nombre', 'class' => 'form-control']); ?>
                        </div>
                        <div class="col-md-6">

                            <?php echo $this->Form->input('modetransport_id', ['disabled' => true,'value' => $commandeclient->modetransport_id, 'class' => 'form-control select2', 'id' => 'modetransport_id', 'label' => 'Mode transports', 'empty' => 'Veuillez choisir !!']); ?>

                        </div>
                        <div class="col-md-6">
                            <div height="60px">
                                <label class="control-label" style="margin-top: 25px;">Détait des montant de transport en pdf:</label>
                                OUI <input type="radio" disabled name="detaittransport" value="1" id="OUItransport" class="toggleOffreGGBtransport " <?php if ($commandeclient->detaittransport == 1) echo "checked"; ?> style="margin-right: 17px">
                                NON <input type="radio" disabled name="detaittransport" value="0" id="NONtransport" class="toggleOffreGGBtransport " <?php if ($commandeclient->detaittransport == 0) echo "checked"; ?>>
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
                                
                                <div class="panel-body">
                                    <div class="table-responsive ls-table">
                                        <table class="table table-bordered table-striped table-bottomless" id="tabligne3">
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

                                                    <td align="center" nowrap="nowrap"><strong>Produit</strong></td>
                                                    <td align="center" nowrap="nowrap"><strong>Description</strong>
                                                    </td>
                                                    <td align="center" nowrap="nowrap"><strong>Unité</strong></td>
                                                    <!-- <td align="center" nowrap="nowrap"><strong>Quantité stock</strong></td> -->
                                                    <td align="center" nowrap="nowrap"><strong>Quantite</strong>
                                                    </td>
                                                    <td align="center" nowrap="nowrap"><strong>Prix de revient achat
                                                    <!-- <span id="diviseachat">      <?php echo $deviseprojet ?></span>  -->
                                                </strong></td>
                                                    <td align="center" nowrap="nowrap"><strong>Prix de revient vente
                                                    <!-- <span class="deviseprojet2"> <?php echo $deviseprojet2 ?></span> -->
                                                </strong></td>
                                                <?php if ($parametretaus->tauxdemarge == 1) { ?>
                                                        <td align="center" nowrap="nowrap"><strong>Taux
                                                                de<br>marge</strong></td>
                                                    <?php }
                                                    if ($parametretaus->tauxmarque == 1) { ?>
                                                        <td align="center" nowrap="nowrap"><strong>Taux
                                                                de<br>marque</strong></td>
                                                    <?php } ?>

                                                    <td align="center" nowrap="nowrap"><strong>PrixHT</strong></td>

                                                    <td align="center" nowrap="nowrap"><strong>Remise</strong></td>
                                                    <td align="center" hidden nowrap="nowrap"><strong>PUNHT</strong></td>
                                                    <td nowrap="nowrap" id='thtva' align="center" style="display:<?php echo ($commandeclient->tvaOnOff == 1) ? 'table-cell' : 'none'; ?>">
                                                        <strong>Tva</strong>
                                                    </td>
                                                    <!-- <td align="center" nowrap="nowrap"><strong>
                                                                <?php echo $margemarque ?>
                                                            </strong></td> -->
                                                    <td align="center" nowrap="nowrap"><strong>TTC</strong></td>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = -1;
                                                // $margemarque = "";
                                                foreach ($lignecommandeclients as $res) :
                                                    $i++;
                                                    // debug($res);

                                                ?>
                                                    <tr>
                                                        <td style="width: 10%;" align="center">

                                                            <?php
                                                            echo $this->Form->control('fournisseur_id', ['disabled' => true,'empty' => 'Veuillez choisir !!!', 'index' => $i, 'id' => 'fournisseur_id' . $i, 'options' => $fournisseurs, 'value' => $res['fournisseur_id'], 'name' => 'data[lignecommandeclients][' . $i . '][fournisseur_id]', 'label' => '', 'table' => 'lignecommandeclients', 'champ' => 'fournisseur_id', 'class' => 'form-control select2  ']); ?>
                                                        </td>
                                                        <td style="width: 10%;" align="center">

                                                            <?php
                                                            echo $this->Form->input('sup0', array('name' => 'data[lignecommandeclients][' . $i . '][sup0]', 'id' => 'sup0' . $i, 'champ' => 'sup0', 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                            echo $this->Form->input('id', array('label' => '', 'value' => $res['id'], 'name' => 'data[lignecommandeclients][' . $i . '][id]', 'type' => 'hidden', 'id' => 'id' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                            echo $this->Form->control('article_id', ['disabled' => true,'empty' => 'Veuillez choisir !!!', 'index' => $i, 'id' => 'article_id' . $i, 'options' => $articles, 'value' => $res['article_id'], 'name' => 'data[lignecommandeclients][' . $i . '][article_id]', 'label' => '', 'table' => 'lignecommandeclients', 'champ' => 'article_id', 'class' => 'form-control select2 getprixarticle Testdep getprixhtson ']); ?>
                                                        </td>
                                                        <td style="width: 10%;">
                                                            <?php echo $this->Form->input('description', array('readonly' => true,'label' => '', 'value' => $res['description'], 'name' => 'data[lignecommandeclients][' . $i . '][description]',  'id' => 'description' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  ')); ?>


                                                        </td>

                                                        <td style="width: 5%;">
                                                            <br>
                                                            <select champ="unite_id" id="unite_id<?php echo $i; ?>" disabled index="<?php echo $i; ?>" name="data[lignecommandeclients][<?php echo $i; ?>][unite_id]" table="lignecommandeclients" class="form-control select2">
                                                                <option value=""></option>
                                                                <?php foreach ($unites as $key => $unit) {

                                                                ?>
                                                                    <option value="<?php echo $unit['id'] ?>" <?php if ($unit['id'] == $res['unite_id']) {
                                                                                                                    echo "selected";
                                                                                                                } ?>><?php echo $unit['name'] ?></option>
                                                                <?php  } ?>
                                                            </select>

                                                        </td>
                                                        <td style="width: 6%;" align="center">
                                                            <?php echo $this->Form->input('qte', array('readonly' => true,'label' => '', 'value' => $res['qte'], 'name' => 'data[lignecommandeclients][' . $i . '][qte]', 'type' => 'number', 'id' => 'qte' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson ')); ?>
                                                        </td>
                                                        <td style="width: 8%;" align="center">
                                                            <?php echo $this->Form->input('coutrevient', array('readonly' => true,'label' => '', 'value' => $res['coutrevient'], 'name' => 'data[lignecommandeclients][' . $i . '][coutrevient]', 'type' => 'number', 'id' => 'coutrevient' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson getprixarticle calculprix')); ?>
                                                        </td>
                                                        <td style="width: 7%;" align="center">
                                                            <?php echo $this->Form->input('coutrevientdev', array('readonly','label' => '', 'value' => sprintf("%01.3f", $res['coutrevient'] * (float) $commandeclient->tauxdechange), 'name' => 'data[lignecommandeclients][' . $i . '][coutrevientdev]', 'type' => 'text', 'id' => 'coutrevientdev' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  number  calculprix')); ?>
                                                        </td>
                                                        <?php if ($parametretaus->tauxdemarge == 1) { ?>
                                                            <td style="width: 8%;" align="center">
                                                                <?php echo $this->Form->input('tauxdemarge', array('readonly' => true, 'label' => '', 'value' => $res['tauxdemarge'], 'name' => 'data[lignecommandeclients][' . $i . '][tauxdemarge]', 'type' => 'number', 'id' => 'tauxdemarge' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson getprixarticle calculprix')); ?>
                                                            </td>
                                                        <?php }
                                                        if ($parametretaus->tauxmarque == 1) { ?>
                                                            <td style="width: 8%;" align="center">
                                                                <?php echo $this->Form->input('tauxdemarque', array('readonly' => true, 'label' => '', 'value' => $res['tauxdemarque'], 'name' => 'data[lignecommandeclients][' . $i . '][tauxdemarque]', 'type' => 'number', 'id' => 'tauxdemarque' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson getprixarticle calculprix')); ?>
                                                            </td>
                                                        <?php } ?>
                                                      <!--  <td style="width: 8%;" align="center">
                                                            <?php echo $this->Form->input('tauxdemarge', array('readonly' => true,'label' => '', 'value' => $res['tauxdemarge'], 'name' => 'data[lignecommandeclients][' . $i . '][tauxdemarge]', 'type' => 'number', 'id' => 'tauxdemarge' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson getprixarticle calculprix')); ?>
                                                        </td>
                                                        <td style="width: 8%;" align="center">
                                                            <?php echo $this->Form->input('tauxdemarque', array('readonly' => true,'label' => '', 'value' => $res['tauxdemarque'], 'name' => 'data[lignecommandeclients][' . $i . '][tauxdemarque]', 'type' => 'number', 'id' => 'tauxdemarque' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson getprixarticle calculprix')); ?>
                                                        </td>-->
                                                        <!-- <td style="width: 8%;" align="center"> -->
                                                        <!-- <?php echo $this->Form->input('prixht', array('readonly' => true,'label' => '', 'value' => $res['prixht'], 'name' => 'data[lignecommandeclients][' . $i . '][prixht]', 'type' => 'text', 'id' => 'prixht' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson getprixarticle')); ?> -->
                                                        <!-- </td> -->
                                                        <td align="center">
                                                            <?php if ($res['tauxdemarge'] !== null) {

                                                                echo $this->Form->input('prixht', array('readonly' => true,'label' => '', 'value' => intval($res['prixht']), 'name' => 'data[lignecommandeclients][' . $i . '][prixht]', 'type' => 'text', 'id' => 'prixht' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson getprixarticle'));
                                                            } else {
                                                                echo $this->Form->input('prixht', array('readonly' => true,'label' => '', 'value' => sprintf("%01.".$commandeclient->nbfergule."f", $res['prixht']), 'name' => 'data[lignecommandeclients][' . $i . '][prixht]', 'type' => 'text', 'id' => 'prixht' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson getprixarticle'));
                                                            }
                                                            ?>

                                                        </td>
                                                        <td style="width: 8%;" align="center">
                                                            <?php echo $this->Form->input('remise', array('readonly' => true,'label' => '', 'value' => $res['remise'], 'name' => 'data[lignecommandeclients][' . $i . '][remise]', 'type' => 'text', 'id' => 'remise' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson ')); ?>
                                                        </td>
                                                        <td hidden style="width: 8%;" align="center">
                                                            <?php echo $this->Form->input('punht', array('readonly' => true,'label' => '', 'value' => $res['punht'], 'name' => 'data[lignecommandeclients][' . $i . '][punht]', 'type' => 'text', 'id' => 'punht' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson ')); ?>
                                                        </td>
                                                        <td  champ="tdtva" table="tablelignetva" id="tdtva<?php echo $i; ?>" name="data[ligner]['<?php echo $i; ?>'][tdtva]" index="<?php echo $i; ?>" style=" display:<?php echo ($commandeclient->tvaOnOff == 1) ? 'table-cell' : 'none'; ?>" align="center">
                                                            <?php echo $this->Form->input('tva', array('readonly' => true,'label' => '', 'value' => $res->tva, 'name' => 'data[lignecommandeclients][' . $i . '][tva]', 'type' => 'number', 'id' => 'tva' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson ')); ?>
                                                        </td>

                                                        <!-- <td style="width: 12%;" align="center">
                                                                <?php echo $this->Form->input('fodec', array('readonly' => true,'label' => '', 'value' => $res->fodec, 'name' => 'data[lignecommandeclients][' . $i . '][fodec]', 'type' => 'number', 'id' => 'fodec' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson ')); ?>
                                                            </td> -->
                                                        <td style="width: 8%;" align="center">
                                                            <?php echo $this->Form->input('ttc', array('readonly', 'label' => '', 'value' => $res['ttc'], 'name' => 'data[lignecommandeclients][' . $i . '][ttc]', 'type' => 'number', 'id' => 'ttc' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson '));
                                                            $totalttc = $totalttc + $res['ttc']; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>

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
                                
                                <div class="panel-body">
                                    <div class="table-responsive ls-table">
                                        <table class="table table-bordered table-striped table-bottomless" id="tabligne3m">
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

                                                    <td align="center" nowrap="nowrap"><strong>Service</strong></td>
                                                    <td align="center" nowrap="nowrap"><strong>Description</strong>
                                                    </td>
                                                    <td align="center" nowrap="nowrap"><strong>Unité</strong></td>
                                                    <!-- <td align="center" nowrap="nowrap"><strong>Quantité stock</strong></td> -->
                                                    <td align="center" nowrap="nowrap"><strong>Quantite</strong>
                                                    </td>
                                                    <td align="center" nowrap="nowrap"><strong>Prix de revient  <br>  en <?php echo $deviseprojet ?></strong></td>
                                                    <td align="center" nowrap="nowrap"><strong>Prix de revient  <br>  en devise</strong></td>
                                                    <?php if ($parametretaus->tauxdemarge == 1) { ?>
                                                        <td align="center" nowrap="nowrap"><strong>Taux
                                                                de<br>marge</strong></td>
                                                    <?php }
                                                    if ($parametretaus->tauxmarque == 1) { ?>
                                                        <td align="center" nowrap="nowrap"><strong>Taux
                                                                de<br>marque</strong></td>
                                                    <?php } ?>

                                                    <td align="center" nowrap="nowrap"><strong>PrixHT</strong></td>

                                                    <td align="center" nowrap="nowrap"><strong>Remise</strong></td>
                                                    <td align="center" nowrap="nowrap"><strong>PUNHT</strong></td>
                                                    <td nowrap="nowrap" id='thtva' align="center" style="display:<?php echo ($commandeclient->tvaOnOff == 1) ? 'table-cell' : 'none'; ?>">
                                                        <strong>Tva</strong>
                                                    </td>
                                                    <!-- <td align="center" nowrap="nowrap"><strong>
                                                                <?php echo $margemarque ?>
                                                            </strong></td> -->
                                                    <td align="center" nowrap="nowrap"><strong>TTC</strong></td>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = -1;
                                                // $margemarque = "";
                                                foreach ($lignecommandeclient2s as $res) :
                                                    $i++;
                                                    // debug($res);

                                                ?>
                                                    <tr>
                                                       
                                                        <td style="width: 15%;" align="center">

                                                            <?php
                                                            echo $this->Form->input('sup0', array('name' => 'data[lignecommandeclients][' . $i . '][sup0]', 'id' => 'sup0' . $i, 'champ' => 'sup0', 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                            echo $this->Form->input('id', array('label' => '', 'value' => $res['id'], 'name' => 'data[lignecommandeclients][' . $i . '][id]', 'type' => 'hidden', 'id' => 'id' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                            echo $this->Form->control('article_id', ['disabled' => true,'empty' => 'Veuillez choisir !!!', 'index' => $i, 'id' => 'article_id' . $i, 'options' => $articleservises, 'value' => $res['article_id'], 'name' => 'data[lignecommandeclients][' . $i . '][article_id]', 'label' => '', 'table' => 'lignecommandeclients', 'champ' => 'article_id', 'class' => 'form-control select2 getprixarticle Testdep getprixhtson ']); ?>
                                                        </td>
                                                        <td style="width: 15%;">
                                                            <?php echo $this->Form->input('description', array('readonly' => true,'label' => '', 'value' => $res['description'], 'name' => 'data[lignecommandeclients][' . $i . '][description]',  'id' => 'description' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  ')); ?>


                                                        </td>

                                                        <td style="width: 8%;">
                                                            <br>
                                                            <select champ="unite_id" id="unite_id<?php echo $i; ?>" disabled index="<?php echo $i; ?>" name="data[lignecommandeclients][<?php echo $i; ?>][unite_id]" table="lignecommandeclients" class="form-control select2">
                                                                <option value=""></option>
                                                                <?php foreach ($unites as $key => $unit) {

                                                                ?>
                                                                    <option value="<?php echo $unit['id'] ?>" <?php if ($unit['id'] == $res['unite_id']) {
                                                                                                                    echo "selected";
                                                                                                                } ?>><?php echo $unit['name'] ?></option>
                                                                <?php  } ?>
                                                            </select>

                                                        </td>
                                                        <td style="width: 6%;" align="center">
                                                            <?php echo $this->Form->input('qte', array('readonly' => true,'label' => '', 'value' => $res['qte'], 'name' => 'data[lignecommandeclients][' . $i . '][qte]', 'type' => 'number', 'id' => 'qte' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson ')); ?>
                                                        </td>
                                                        <td style="width: 8%;" align="center">
                                                            <?php echo $this->Form->input('coutrevient', array('readonly' => true,'label' => '', 'value' => $res['coutrevient'], 'name' => 'data[lignecommandeclients][' . $i . '][coutrevient]', 'type' => 'number', 'id' => 'coutrevient' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson getprixarticle calculprix')); ?>
                                                        </td>
                                                        <td style="width: 7%;" align="center">
                                                            <?php echo $this->Form->input('coutrevientdev', array('readonly','label' => '', 'value' => sprintf("%01.3f", $res['coutrevient'] * (float) $commandeclient->tauxdechange), 'name' => 'data[lignecommandeclients][' . $i . '][coutrevientdev]', 'type' => 'text', 'id' => 'coutrevientdev' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  number  calculprix')); ?>
                                                        </td>
                                                        <?php if ($parametretaus->tauxdemarge == 1) { ?>
                                                            <td align="center">
                                                                <?php echo $this->Form->input('tauxdemarge', array('label' => '', 'value' => $res['tauxdemarge'], 'name' => 'data[lignecommandeclients][' . $i . '][tauxdemarge]', 'type' => 'text', 'id' => 'tauxdemarge' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number  calculprix')); ?>
                                                            </td>
                                                        <?php }
                                                        if ($parametretaus->tauxmarque == 1) { ?>
                                                            <td align="center">
                                                                <?php echo $this->Form->input('tauxdemarque', array('label' => '', 'value' => $res['tauxdemarque'], 'name' => 'data[lignecommandeclients][' . $i . '][tauxdemarque]', 'type' => 'text', 'id' => 'tauxdemarque' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number  calculprix')); ?>
                                                            </td>
                                                        <?php } ?>
                                                       <!-- <td style="width: 8%;" align="center">
                                                            <?php echo $this->Form->input('tauxdemarge', array('readonly' => true,'label' => '', 'value' => $res['tauxdemarge'], 'name' => 'data[lignecommandeclients][' . $i . '][tauxdemarge]', 'type' => 'number', 'id' => 'tauxdemarge' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson getprixarticle calculprix')); ?>
                                                        </td>
                                                        <td style="width: 8%;" align="center">
                                                            <?php echo $this->Form->input('tauxdemarque', array('readonly' => true,'label' => '', 'value' => $res['tauxdemarque'], 'name' => 'data[lignecommandeclients][' . $i . '][tauxdemarque]', 'type' => 'number', 'id' => 'tauxdemarque' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson getprixarticle calculprix')); ?>
                                                        </td>-->
                                                        <!-- <td style="width: 8%;" align="center"> -->
                                                        <!-- <?php echo $this->Form->input('prixht', array('readonly' => true,'label' => '', 'value' => $res['prixht'], 'name' => 'data[lignecommandeclients][' . $i . '][prixht]', 'type' => 'text', 'id' => 'prixht' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson getprixarticle')); ?> -->
                                                        <!-- </td> -->
                                                        <td align="center">
                                                            <?php if ($res['tauxdemarge'] !== null) {

                                                                echo $this->Form->input('prixht', array('readonly' => true,'label' => '', 'value' => intval($res['prixht']), 'name' => 'data[lignecommandeclients][' . $i . '][prixht]', 'type' => 'text', 'id' => 'prixht' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson getprixarticle'));
                                                            } else {
                                                                echo $this->Form->input('prixht', array('readonly' => true,'label' => '', 'value' => sprintf("%01.".$commandeclient->nbfergule."f", $res['prixht']), 'name' => 'data[lignecommandeclients][' . $i . '][prixht]', 'type' => 'text', 'id' => 'prixht' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson getprixarticle'));
                                                            }
                                                            ?>

                                                        </td>
                                                        <td style="width: 8%;" align="center">
                                                            <?php echo $this->Form->input('remise', array('readonly' => true,'label' => '', 'value' => $res['remise'], 'name' => 'data[lignecommandeclients][' . $i . '][remise]', 'type' => 'text', 'id' => 'remise' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson ')); ?>
                                                        </td>
                                                        <td style="width: 8%;" align="center">
                                                            <?php echo $this->Form->input('punht', array('readonly' => true,'label' => '', 'value' => $res['punht'], 'name' => 'data[lignecommandeclients][' . $i . '][punht]', 'type' => 'text', 'id' => 'punht' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson ')); ?>
                                                        </td>
                                                        <td champ="tdtva" table="tablelignetva" id="tdtva<?php echo $i; ?>" name="data[ligner]['<?php echo $i; ?>'][tdtva]" index="<?php echo $i; ?>" style=" display:<?php echo ($commandeclient->tvaOnOff == 1) ? 'table-cell' : 'none'; ?>" align="center">
                                                            <?php echo $this->Form->input('tva', array('readonly' => true,'label' => '', 'value' => $res->tva, 'name' => 'data[lignecommandeclients][' . $i . '][tva]', 'type' => 'number', 'id' => 'tva' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson ')); ?>
                                                        </td>

                                                        <!-- <td style="width: 12%;" align="center">
                                                                <?php echo $this->Form->input('fodec', array('readonly' => true,'label' => '', 'value' => $res->fodec, 'name' => 'data[lignecommandeclients][' . $i . '][fodec]', 'type' => 'number', 'id' => 'fodec' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson ')); ?>
                                                            </td> -->
                                                        <td style="width: 8%;" align="center">
                                                            <?php echo $this->Form->input('ttc', array('readonly', 'label' => '', 'value' => $res['ttc'], 'name' => 'data[lignecommandeclients][' . $i . '][ttc]', 'type' => 'number', 'id' => 'ttc' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson '));
                                                            $totalttc = $totalttc + $res['ttc']; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <div class="col-md-6">
                        <?php echo $this->Form->control('totalht', ['readonly' => true,'value' => sprintf("%01.".$commandeclient->nbfergule."f", $totalttc)]); ?>
                    </div>
                    <div id="divtva" class="col-xs-3" style="display:<?php echo ($commandeclient->tvaOnOff == 1) ? 'block' : 'none'; ?>">
                        <?php echo $this->Form->control('totaltva',['readonly' => true,'value' => sprintf("%01.".$commandeclient->nbfergule."f", $commandeclient->totaltva)]); ?>
                    </div>
                    <?php if ($parametretaus->tauxmarque == 1) { ?>
                    <div class="col-md-6">
                        <?php echo $this->Form->control('totalfodec', ['readonly' => true,'label' => 'Total Taux de Marque', 'id' => 'totalmarque','value' => sprintf("%01.".$commandeclient->nbfergule."f", $commandeclient->totalfodec)]); ?>
                    </div>
                    <?php } if ($parametretaus->tauxdemarge == 1) { ?>
                    <div class="col-md-6">
                        <?php echo $this->Form->control('totalmarge', ['readonly' => true,'label' => 'Total Taux de Marge','value' => sprintf("%01.".$commandeclient->nbfergule."f", $commandeclient->totalmarge), 'id' => 'totalmarge']); ?>
                    </div>
                    <?php }  ?>
                    <div class="col-md-6">
                        <?php echo $this->Form->control('totalremise',['readonly' => true,'value' => sprintf("%01.".$commandeclient->nbfergule."f", $commandeclient->totalremise)]); ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $this->Form->control('totalttc', ['readonly' => true,'value' => sprintf("%01.".$commandeclient->nbfergule."f", $totalttc)]) ?>
                        <?php
                        echo $this->Form->control('totalttcdl', ['readonly' => true,'id' => 'totalttcdl', 'type' => 'hidden', 'value' => sprintf("%01.".$commandeclient->nbfergule."f", $commandeclient->totalttcdl), 'table' => 'tablecommandeclient', 'label' => 'Total TTC', 'readonly' => true]); ?>

                    </div>
                  
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
</section>
<script>
    $(document).ready(function() {
        $(".calcull").on("keyup", function() {
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
        $(".calculprix").on("keyup", function() {
            // index = $("#index").val();
            // index1 = $("#indexa").val();
            index = $("#indexoffreggb").val();
            // indexl = $("#indexa" + index).val();

            prixMG = 0;
            prixMQ = 0;
            total = 0;
            totalmarge = 0;
            totalmarque = 0;
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
                    } else if (MG) {
                        prixMG = Number(prixrevient) + (Number(MG) * Number(prixrevient) / 100)
                        prixMG = Math.floor(prixMG); // Conversion en entier
                        $("#prixht" + i).val(prixMG);
                        //$("#punht" + i).val(prixMG);
                        margel = Number(prixMG) * Number(MG / 100);
                        totalmarge = (Number(totalmarge) + Number(margel)).toFixed(3);
                    } else if (MQ) {
                        prixMQ = Number(prixrevient) + (Number(MQ) * Number(prixrevient) / 100); //alert(prixMQ)
                        $("#prixht" + i).val(Number(prixMQ).toFixed(3));
                        marquel = Number(prixMQ) * Number(MQ / 100);
                        totalmarque = (Number(totalfodec) + Number(marquel)).toFixed(3);
                        // $("#punht" + i).val(prixMG);
                    } else {
                        $("#prixht" + i).val(Number(prixrevient).toFixed(3));
                    }
                }
            }
            $("#totalmarge").val(Number(totalmarge).toFixed(3));
            $("#totalmarque").val(Number(totalmarque).toFixed(3));

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
    $(function() {
        $('.gettvas').on('change', function() {
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
                success: function(data) {
                    $('#tva' + index).val(data.val);


                }

            })

        });
    });
    nouveau_client
</script>
<script>
    $(function() {
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
    $(document).ready(function() {
        $('#deviseSelect2').on('change', function() {
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
                success: function(data) {
                    console.log(data)
                    var devis = data.code;
                    getTauxChange2(devis);
                }

            })
        });
        $('#deviseSelect').on('change', function() {
            // var devise_id = $(this).val();
            devise_id = $('#devis_id').val();
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
                success: function(data) {
                    console.log(data)
                    var devis = data.code;
                    getTauxChange(devis);
                }

            })
        });
    });
</script>
<?php $this->end(); ?>