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
<?php echo $this->Html->script('function'); ?>

<?php echo $this->Html->script('js_vieww_projet');

$connection = ConnectionManager::get('default');?>

<section class="content-header">
    <h1>
        Modification Offre GGB
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
                            <?php echo $this->Form->control('deviseprojet', ['type' => 'hidden', 'id' => 'deviseprojet', 'value' => $deviseprojet]); ?>
                            <?php echo $this->Form->control('tauxdeviseprojet', ['type' => 'hidden', 'id' => 'tauxdeviseprojet']); ?>
                            <?php echo $this->Form->control('id', ['type' => 'hidden']); ?>

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
                            echo $this->Form->control('date');
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
                            <?php echo $this->Form->input('incoterm_id', ['value' => $commandeclient->incoterm_id, 'class' => 'form-control', 'id' => 'incoterm_id', 'label' => 'Incoterm en Total', 'empty' => 'Veuillez choisir !!']); ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->input('incotermpdf_id', ['value' => $commandeclient->incotermpdf_id, 'class' => 'form-control', 'id' => 'incotermpdf_id', 'label' => 'Incoterm Pdf', 'empty' => 'Veuillez choisir !!']); ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->input('pay', ['type' => 'text', 'class' => 'form-control ', 'id' => 'pay_id', 'label' => 'Destination']); ?>
                        </div>



                        <div class="col-md-6 deviseSelect">
                            <?php echo $this->Form->input('devisachat_id', ['value' => $commandeclient->devisachat_id, 'empty' => 'Veuillez choisir !!', 'class' => 'form-control', 'id' => 'devisachat_id', 'label' => 'Devises Achat ', 'options' => $devises]); ?>
                        </div>
                        <div class="col-md-6">

                            <?php echo $this->Form->input('modetransport_id', ['value' => $commandeclient->modetransport_id, 'class' => 'form-control select2', 'id' => 'modetransport_id', 'label' => 'Mode transports', 'empty' => 'Veuillez choisir !!']); ?>

                        </div>

                        <div class="col-md-6 deviseSelect">
                            <?php echo $this->Form->input('devis_id', ['value' => $commandeclient->devis_id, 'empty' => 'Veuillez choisir !!', 'class' => 'form-control', 'id' => 'devis_id', 'label' => 'Devises Vente', 'options' => $devises]); ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->control('tauxdechange', ['label' => 'Taux de change de devise', 'value' => $commandeclient->tauxdechange, 'id' => 'tauxChange', 'class' => 'form-control  '/* , 'readonly' */]); ?>
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
                        <div class="col-md-6">
                            <?php //echo $this->Form->control('banque_id', ['required' => 'off', 'empty' => 'Veuillez choisir !!!! ', 'id' => 'banque_id', 'class' => 'form-control select2', 'label' => 'Banque']); 
                            ?>
                        </div>

                        <div class="col-md-6">
                            <?php echo $this->Form->control('nbfergule', ['value' => $commandeclient->nbfergule, 'label' => 'Nombre de chiffre aprés le firgule', 'id' => 'nbfergule', 'min' => 0, 'max' => 5, 'type' => 'number', 'class' => 'form-control number']); ?>
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
                                    <a class="btn btn-primary  ajoutfrart" table='addtable' index='index' id='ajouter_ligne33s'
                                        style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                                        <i class="fa fa-plus-circle "></i> Ajouter ligne produit</a>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive ls-table">
                                        <table class="table table-bordered  table-bottomless" id="tabligne3">
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
                                                <tr>
                                                    <td align="center" nowrap="nowrap" hidden>
                                                        <strong>Nbre de <br> chiffre </strong>
                                                    </td>
                                                    <td align="center" nowrap="nowrap">
                                                        <strong>&thinsp; &thinsp; &thinsp;&thinsp; &thinsp; &thinsp;&thinsp; &thinsp; &thinsp;&thinsp; &thinsp; &thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;Fournisseur&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp; &thinsp; &thinsp;&thinsp; &thinsp; &thinsp;&thinsp; &thinsp; &thinsp;&thinsp; &thinsp; &thinsp;</strong>
                                                    </td>

                                                    <td align="center" nowrap="nowrap">
                                                        <strong>&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;Produit
                                                            &thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;</strong>
                                                    </td>
                                                    <td align="center" nowrap="nowrap">
                                                        <strong>&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;Description&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;</strong>
                                                    </td>
                                                    <td align="center" nowrap="nowrap" hidden><strong>Unité</strong>
                                                    </td>
                                                    <td align="center" nowrap="nowrap"><strong>Quantite</strong> </td>
                                                    <td align="center" nowrap="nowrap"><strong>Prix d'achat
                                                            <!-- <span id="diviseachat">      <?php echo $deviseprojet ?></span>  -->
                                                        </strong></td>
                                                    <td align="center" nowrap="nowrap"><strong>Prix de revient
                                                            <!-- <span class="deviseprojet2"> <?php echo $deviseprojet2 ?></span> -->
                                                        </strong></td>
                                                    <?php if ($parametretaus->tauxdemarge == 1) { ?>
                                                        <td align="center" nowrap="nowrap"><strong>Taux de marge</strong>
                                                        </td>
                                                    <?php }
                                                    if ($parametretaus->tauxmarque == 1) { ?>
                                                        <td align="center" nowrap="nowrap"><strong>Taux de marque</strong>
                                                        </td>
                                                    <?php } ?>

                                                    <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp;
                                                            &thinsp; &thinsp; &thinsp; Prix de vente&thinsp; &thinsp;
                                                            &thinsp;
                                                            &thinsp; &thinsp; </strong></td>
                                                    <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp;
                                                            &thinsp; &thinsp; &thinsp; Type remise&thinsp; &thinsp;
                                                            &thinsp;
                                                            &thinsp; &thinsp; </strong></td>
                                                    <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp;
                                                            &thinsp; &thinsp; &thinsp; Remise &thinsp; &thinsp;
                                                            &thinsp;
                                                            &thinsp; &thinsp; </strong></td>

                                                    <!-- <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp;
                                                            &thinsp; &thinsp; &thinsp; Remise en valeur&thinsp; &thinsp;
                                                            &thinsp;
                                                            &thinsp; &thinsp; </strong></td> -->
                                                    <!-- <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp;
                                                            &thinsp; PUNHT&thinsp; &thinsp; &thinsp; </strong></td> -->
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
                                                    $virg = 3;
                                                    if ($commandeclient->nbfergule) {
                                                        $virg = $commandeclient->nbfergule;
                                                    }
                                                    $articles = $connection->execute("SELECT id,Dsignation,Description FROM articles where typearticle=1 ")->fetchAll('assoc');
                                                 
                                                    if($res->fournisseur_id){ 
                                                        $articles = $connection->execute("SELECT id,Dsignation,Description FROM articles WHERE fournisseur_id=" .$res->fournisseur_id . " and  typearticle=1")->fetchAll('assoc');
                                                    }

                                                    ?>
                                                    <tr>
                                                        <td align="center" hidden>
                                                            <?php echo $this->Form->input('nbvirgule', array('label' => '', 'value' => $res['nbvirgule'], 'name' => 'data[lignecommandeclients][' . $i . '][nbvirgule]', 'type' => 'text', 'id' => 'nbvirgule' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number calculprix ')); ?>
                                                        </td>
                                                        <td align="center">
                                                            <div style="display:flex">

                                                            <?php
                                                            echo $this->Form->control('fournisseur_id', ['empty' => 'Veuillez choisir !!!', 'index' => $i, 'id' => 'fournisseur_id' . $i, 'options' => $fournisseurs, 'value' => $res['fournisseur_id'], 'name' => 'data[lignecommandeclients][' . $i . '][fournisseur_id]', 'label' => '', 'table' => 'lignecommandeclients', 'champ' => 'fournisseur_id', 'class' => 'form-control select2 frarticle ']); ?>
                                                       
                                                                    <i style="color:#3c8dbc;font-size: 25px;    margin-top: 11%;" id="frsarticles<?php echo $i ?>" index="<?php echo $i ?>" class="fa fa fa-plus frsarticles"></i>&thinsp; &thinsp; &thinsp;&thinsp; &thinsp; &thinsp;&thinsp; &thinsp; &thinsp;&thinsp; &thinsp; &thinsp;&thinsp; &thinsp; &thinsp;
                                                       </div>
                                                    </td>
                                                        <td align="center">

                                                            <?php
                                                            echo $this->Form->input('type', array('value' => 1, 'name' => 'data[lignecommandeclients][' . $i . '][type]', 'id' => 'type' . $i, 'champ' => 'type', 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));

                                                            echo $this->Form->input('sup0', array('name' => 'data[lignecommandeclients][' . $i . '][sup0]', 'id' => 'sup0' . $i, 'champ' => 'sup0', 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                            echo $this->Form->input('id', array('label' => '', 'value' => $res['id'], 'name' => 'data[lignecommandeclients][' . $i . '][id]', 'type' => 'hidden', 'id' => 'id' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                            //echo $this->Form->control('article_id', ['empty' => 'Veuillez choisir !!!', 'index' => $i, 'id' => 'article_id' . $i, 'options' => $articles, 'value' => $res['article_id'], 'name' => 'data[lignecommandeclients][' . $i . '][article_id]', 'label' => '', 'table' => 'lignecommandeclients', 'champ' => 'article_id', 'class' => 'form-control select2 getprixarticle Testdep getprixhtson ']); ?>
                                                       <br>
                                                       <select name="data[lignecommandeclients][<?php echo $i ?>][article_id]" id="article_id<?php echo $i ?>" index="<?php echo $i ?>" class="form-control select2 getprixarticle Testdep getprixhtson">
                                                            <option value="">Veuillez choisir !!!</option>
                                                            <?php foreach ($articles as $key => $art) {
                                                               
                                                           ?>
                                                            <option value="<?php echo $art['id'] ?>" <?php if ($art['id']==$res['article_id']) {?>selected<?php } ?>><?php echo $art['Dsignation'].' '.$art['Description'] ?></option>
                                                            <?php  }  ?>

                                                        </select>
                                                    
                                                    </td>
                                                        <td>
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
                                                            <?php //echo $this->Form->input('description', array('label' => '', 'value' => $res['description'], 'name' => 'data[lignecommandeclients][' . $i . '][description]', 'id' => 'description' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  ')); ?>


                                                        </td>

                                                        <td hidden>
                                                            <?php echo $this->Form->control('unite_id', ['empty' => 'Veuillez choisir !!!', 'index' => $i, 'id' => 'unite_id' . $i, 'options' => $unites, 'value' => $res['unite_id'], 'name' => 'data[lignecommandeclients][' . $i . '][unite_id]', 'label' => '', 'table' => 'lignecommandeclients', 'champ' => 'unite_id', 'class' => 'form-control select2']); ?>
                                                            <input type="hidden" value="<?php echo $res['unite_id'] ?>"
                                                                id="unite_idd<?php echo $i; ?>" champ="unite_idd"
                                                                table="lignecommandeclients"
                                                                name="data[lignecommandeclients][<?php echo $i; ?>][unite_idd]">
                                                            <!-- <br>
                                                            <select champ="unite_id" id="unite_id<?php echo $i; ?>"
                                                                index="<?php echo $i; ?>"
                                                                name="data[lignecommandeclients][<?php echo $i; ?>][unite_id]"
                                                                table="lignecommandeclients" class="form-control select2"
                                                                style="top: 10%;">
                                                                <option value=""></option>
                                                                <?php //foreach ($unites as $key => $unit) {
                                                                
                                                                    ?>
                                                                    <option value="<?php //echo $unit['id'] ?>" <?php //if ($unit['id'] == $res['unite_id']) {
                                                                         echo "selected";
                                                                         //} ?>>
                                                                        <?php //echo $unit['name'] ?></option>
                                                                <?php //} ?>
                                                            </select> -->

                                                        </td>
                                                        <td align="center">
                                                            <?php echo $this->Form->input('qte', array('label' => '', 'value' => $res['qte'], 'name' => 'data[lignecommandeclients][' . $i . '][qte]', 'type' => 'text', 'id' => 'qte' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson ')); ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php echo $this->Form->input('coutrevient', array('label' => '', 'value' => $res['coutrevient'], 'name' => 'data[lignecommandeclients][' . $i . '][coutrevient]', 'type' => 'text', 'id' => 'coutrevient' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  number  calculprix')); ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php echo $this->Form->input('coutrevientdev', array('champ' => 'coutrevientdev', 'label' => '', 'value' => sprintf("%01." . $virg . "f", $res['coutrevient'] * $tauxchan), 'name' => 'data[lignecommandeclients][' . $i . '][coutrevientdev]', 'type' => 'text', 'id' => 'coutrevientdev' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  number  calculprix')); ?>
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


                                                        <td align="center">
                                                            <?php
                                                            // if ($res['tauxdemarge'] !== null) {
                                                        
                                                            //     echo $this->Form->input('prixht', array('label' => '', 'value' => intval($res['prixht']), 'name' => 'data[lignecommandeclients][' . $i . '][prixht]', 'type' => 'text', 'id' => 'prixht' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson  number '));
                                                            // } else {
                                                            echo $this->Form->input('prixht', array('label' => '', 'value' => sprintf("%01." . $virg . "f", $res['prixht']), 'name' => 'data[lignecommandeclients][' . $i . '][prixht]', 'type' => 'text', 'id' => 'prixht' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  number calculinversep'));
                                                            // }
                                                            ?>

                                                        </td>
                                                        <td>
                                                            <?php echo $this->Form->control('typeremise_id', ['label' => '', 'value' => $res['typeremise_id'], 'name' => 'data[lignecommandeclients][' . $i . '][typeremise_id]', 'id' => 'typeremise_id' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'class' => "form-control select2 typeremise_idl", 'options' => $typeremises]);
                                                            ?>
                                                        </td>
                                                        <td align="center">
                                                            <div id="divremise<?php echo $i; ?>"
                                                                style="display:<?php if ($res['typeremise_id'] == 1) {
                                                                    echo "flex";
                                                                } else {
                                                                    echo "none";
                                                                } ?> "
                                                                table="lignecommandeclients" index="<?php echo $i; ?>">
                                                                <?php echo $this->Form->input('remise', array('label' => '', 'value' => $res['remise'], 'name' => 'data[lignecommandeclients][' . $i . '][remise]', 'type' => 'text', 'id' => 'remise' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson number testremise')); ?>
                                                                <i style="    margin-top: 26%;font-size: 18px;" class="fa fa-percent"></i>&thinsp;&thinsp;&thinsp;
                                                        
                                                            </div>
                                                            <div id="divremiseval<?php echo $i; ?>"
                                                                style="display:<?php if ($res['typeremise_id'] == 2) {
                                                                    echo "block";
                                                                } else {
                                                                    echo "none";
                                                                } ?> "
                                                                table="lignecommandeclients" index="<?php echo $i; ?>">
                                                                <?php echo $this->Form->input('remiseval', array('label' => '', 'value' => $res['remiseval'], 'name' => 'data[lignecommandeclients][' . $i . '][remiseval]', 'type' => 'text', 'id' => 'remiseval' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson number testremiseval')); ?>
                                                            </div>
                                                        </td>

                                                        <td align="center" hidden>
                                                            <?php echo $this->Form->input('punht', array('label' => '', 'value' => $res['punht'], 'name' => 'data[lignecommandeclients][' . $i . '][punht]', 'type' => 'text', 'id' => 'punht' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson number ')); ?>
                                                        </td>
                                                        <td champ="tdtva" table="tablelignetva" id="tdtva<?php echo $i; ?>"
                                                            name="data[ligner]['<?php echo $i; ?>'][tdtva]"
                                                            index="<?php echo $i; ?>"
                                                            style="display:<?php echo ($commandeclient->tvaOnOff == 1) ? 'table-cell' : 'none'; ?>"
                                                            align="center">
                                                            <?php echo $this->Form->input('tva', array('label' => '', 'value' => $res->tva, 'name' => 'data[lignecommandeclients][' . $i . '][tva]', 'type' => 'text', 'id' => 'tva' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson number ')); ?>
                                                        </td>


                                                        <td align="center">
                                                            <?php echo $this->Form->input('ttc', array('readonly', 'label' => '', 'value' => $res['ttc'], 'name' => 'data[lignecommandeclients][' . $i . '][ttc]', 'type' => 'text', 'id' => 'ttc' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson '));
                                                            $totalttc = $totalttc + $res['ttc']; ?>
                                                        </td>
                                                        <td align="center"><i index="<?php echo $i ?>"
                                                                class="fa fa-times supLigne"
                                                                style="color: #C9302C;font-size: 22px;"></td>
                                                    </tr>
                                                <?php endforeach; ?>

                                                <tr class='tr' style="display: none !important">
                                                    <td align="center" hidden>
                                                        <?php echo $this->Form->input('nbvirgule', array('champ' => 'nbvirgule', 'value' => 2, 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculprix number')); ?>
                                                    </td>
                                                    <td style="width: 20%;" align="center">
                                                        <?php
                                                        echo $this->Form->input('type', array('value' => 1, 'name' => '', 'id' => '', 'champ' => 'type', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));?>
                                                    <div style="display:flex;width:100%">
                                                        <div style="width:85%">
                                                       <?php echo $this->Form->control('fournisseur_id', ['options' => $fournisseurs, 'empty' => 'Veuillez choisir !!', 'label' => '', 'table' => 'lignecommandeclients', 'champ' => 'fournisseur_id', 'class' => 'form-control  frarticle']); ?>
                                                       </div>
                                                       <i style="color:#3c8dbc;font-size: 25px;    margin-top: 11%;" champ="frsarticles" table="lignecommandeclients" class="fa fa fa-plus frsarticles"></i>
                                                       </div>
                                                    </td>
                                                    <td style="width: 10%;" align="center">
                                                        <?php echo $this->Form->input('id', array('champ' => 'id', 'label' => '', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                        <?php
                                                        echo $this->Form->input('sup0', array('name' => '', 'id' => '', 'champ' => 'sup0', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden'));
                                                        //echo $this->Form->control('article_id', ['options' => $articlessss, 'empty' => 'Veuillez choisir !!', 'label' => '', 'table' => 'lignecommandeclients', 'champ' => 'article_id', 'class' => 'form-control getprixarticle']); ?>
                                                  
                                                  <br>
                                                       <select table="lignecommandeclients" champ="article_id"  class="form-control  getprixarticle Testdep getprixhtson">
                                                            <option value="">Veuillez choisir !!!</option>
                                                          

                                                        </select>
                                                </td>
                                                    <td style="width: 10%;">
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
                                                    <td style="width: 5%;" hidden>

                                                        <?php echo $this->Form->control('unite_id', ['options' => $unites, 'empty' => '', 'label' => '', 'table' => 'lignecommandeclients', 'champ' => 'unite_id', 'class' => 'form-control ']); ?>
                                                        <input type="hidden" champ="unite_idd"
                                                            table="lignecommandeclients">
                                                        <!-- <select champ="unite_id" table="lignecommandeclients"
                                                            class="form-control " style="top: 10%;">
                                                            <option value=""></option>
                                                            <?php foreach ($unites as $key => $unit) {

                                                                ?>
                                                                <option value="<?php //echo $unit['id'] ?>">
                                                                    <?php //echo $unit['name'] ?></option>
                                                            <?php } ?>
                                                        </select> -->

                                                    </td>

                                                    <td align="center" style="width: 7%;">
                                                        <?php echo $this->Form->input('qte', array('champ' => 'qte', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson number')); ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('coutrevient', array('champ' => 'coutrevient', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number  calculprix ')); ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('coutrevientdev', array('champ' => 'coutrevientdev', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number  calculprix ')); ?>
                                                    </td>
                                                    <?php if ($parametretaus->tauxdemarge == 1) { ?>
                                                        <td align="center">
                                                            <?php echo $this->Form->input('tauxdemarge', array('champ' => 'tauxdemarge', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number  calculprix')); ?>
                                                        </td>
                                                    <?php }
                                                    if ($parametretaus->tauxmarque == 1) { ?>
                                                        <td align="center">
                                                            <?php echo $this->Form->input('tauxdemarque', array('champ' => 'tauxdemarque', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number  calculprix')); ?>
                                                        </td>
                                                    <?php } ?>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('prixht', array('champ' => 'prixht', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  number calculinversep')); ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo $this->Form->control('typeremise_id', ['champ' => 'typeremise_id', 'label' => '', 'name' => '', 'table' => 'lignecommandeclients', 'class' => "form-control  typeremise_idl", 'options' => $typeremises]);
                                                        ?>
                                                    </td>
                                                    <td align="center">
                                                        <div champ="divremise" table="lignecommandeclients" style="display:flex">
                                                            <?php echo $this->Form->input('remise', array('champ' => 'remise', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson number testremise ')); ?>
                                                          
                                                            <i style="    margin-top: 26%;font-size: 18px;" class="fa fa-percent"></i>&thinsp;&thinsp;&thinsp;
                                                        
                                                        </div>
                                                        <div champ="divremiseval" style="display:none"
                                                            table="lignecommandeclients">
                                                            <?php echo $this->Form->input('remiseval', array('champ' => 'remiseval', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson number  testremiseval')); ?>

                                                        </div>
                                                    </td>

                                                    <td align="center" hidden>
                                                        <?php echo $this->Form->input('punht', array('champ' => 'punht', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson number')); ?>
                                                    </td>
                                                    <td champ="tdtva" table="tablelignetva" id="" name="" index=""
                                                        style="display:none;" align="center">
                                                        <?php echo $this->Form->input('tva', array('champ' => 'tva', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson number')); ?>
                                                    </td>

                                                    <td align="center">

                                                        <?php echo $this->Form->input('ttc', array('champ' => 'ttc', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson number ')); ?>
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
                                                    <td align="center" nowrap="nowrap" hidden>
                                                        <strong>Nbre de <br> chiffre </strong>
                                                    </td>

                                                    <td align="center" nowrap="nowrap">
                                                        <strong>&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;
                                                            &thinsp; &thinsp;
                                                            Service&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;
                                                            &thinsp; &thinsp; </strong>
                                                    </td>
                                                    <td align="center" nowrap="nowrap">
                                                        <strong>&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;Description&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;</strong>
                                                    </td>
                                                    <td align="center" nowrap="nowrap">
                                                        <strong>&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;Unité&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;&thinsp;</strong>
                                                    </td>
                                                    <td align="center" nowrap="nowrap"><strong>Quantite</strong>
                                                    </td>
                                                    <td align="center" nowrap="nowrap"><strong>Prix d'achat
                                                            <!-- <span id="diviseachat">
                                                            <?php echo $deviseprojet ?> </span> -->
                                                        </strong></td>
                                                    <td align="center" nowrap="nowrap"><strong>Prix de revient
                                                            <!-- <span class="deviseprojet2"> <?php echo $deviseprojet2 ?></span> -->
                                                        </strong></td>
                                                    <?php if ($parametretaus->tauxdemarge == 1) { ?>
                                                        <td align="center" nowrap="nowrap"><strong>Taux de marge</strong>
                                                        </td>
                                                    <?php }
                                                    if ($parametretaus->tauxmarque == 1) { ?>
                                                        <td align="center" nowrap="nowrap"><strong>Taux de marque</strong>
                                                        </td>
                                                    <?php } ?>
                                                    <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp;
                                                            &thinsp; &thinsp; &thinsp; Prix de vente&thinsp; &thinsp;
                                                            &thinsp;
                                                            &thinsp; &thinsp; </strong></td>
                                                    <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp;
                                                            &thinsp; &thinsp; &thinsp;Type remise&thinsp; &thinsp;
                                                            &thinsp;
                                                            &thinsp; &thinsp; </strong></td>

                                                    <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp;
                                                            &thinsp; &thinsp; &thinsp; Remise &thinsp; &thinsp;
                                                            &thinsp;
                                                            &thinsp; &thinsp; </strong></td>
                                                    <!-- <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp;
                                                            &thinsp; &thinsp; &thinsp; Remise en valeur &thinsp;
                                                            &thinsp; &thinsp;
                                                            &thinsp; &thinsp; </strong></td> -->
                                                    <!-- <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp;
                                                            &thinsp; &thinsp; &thinsp; PUNHT&thinsp; &thinsp; &thinsp;
                                                            &thinsp; &thinsp; </strong></td> -->
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
                                                    $virg = 3;
                                                    // $virg=$res['nbvirgule'];
                                                    if ($commandeclient->nbfergule) {
                                                        $virg = $commandeclient->nbfergule;
                                                    }


                                                    ?>
                                                    <tr>
                                                        <td align="center" hidden>
                                                            <?php echo $this->Form->input('nbvirgule', array('label' => '', 'value' => $res['nbvirgule'], 'name' => 'data[lignecommandeclients][' . $i . '][nbvirgule]', 'type' => 'text', 'id' => 'nbvirgule' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number calculprix ')); ?>
                                                        </td>
                                                        <td style="width: 15%;" align="center">

                                                            <?php
                                                            echo $this->Form->input('type', array('value' => 2, 'name' => 'data[lignecommandeclients][' . $i . '][type]', 'id' => 'type' . $i, 'champ' => 'type', 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));

                                                            echo $this->Form->input('sup0', array('name' => 'data[lignecommandeclients][' . $i . '][sup0]', 'id' => 'sup0' . $i, 'champ' => 'sup0', 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                            echo $this->Form->input('id', array('label' => '', 'value' => $res['id'], 'name' => 'data[lignecommandeclients][' . $i . '][id]', 'type' => 'hidden', 'id' => 'id' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                            echo $this->Form->control('article_id', ['empty' => 'Veuillez choisir !!!', 'index' => $i, 'id' => 'article_id' . $i, 'options' => $articleservises, 'value' => $res['article_id'], 'name' => 'data[lignecommandeclients][' . $i . '][article_id]', 'label' => '', 'table' => 'lignecommandeclients', 'champ' => 'article_id', 'class' => 'form-control select2 getprixarticle Testdep getprixhtson ']); ?>
                                                        </td>
                                                        <td style="width: 10%;">
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
                                                        </td>

                                                        <td style="width: 8%;">
                                                            <!-- <?php echo $this->Form->control('unite_id', ['options' => $unites, 'value' => $res['unite_id'], 'id' => 'unite_id' . $i, 'empty' => '', 'name' => 'data[lignecommandeclients][' . $i . '][unite_id]', 'label' => '', 'table' => 'lignecommandeclients', 'champ' => 'unite_id', 'class' => 'form-control ']); ?>
                                                            <input type="hidden" value="<?php echo $res['unite_id'] ?>"
                                                                id="unite_idd<?php echo $i; ?>" champ="unite_idd"
                                                                table="lignecommandeclients"
                                                                name="data[lignecommandeclients][<?php echo $i; ?>][unite_idd]"> -->
                                                            <br>
                                                            <select champ="unite_id" id="unite_id<?php echo $i; ?>"
                                                                index="<?php echo $i; ?>"
                                                                name="data[lignecommandeclients][<?php echo $i; ?>][unite_id]"
                                                                table="lignecommandeclients" class="form-control select2"
                                                                style="top: 10%;">
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
                                                            <?php echo $this->Form->input('qte', array('label' => '', 'value' => $res['qte'], 'name' => 'data[lignecommandeclients][' . $i . '][qte]', 'type' => 'text', 'id' => 'qte' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson ')); ?>
                                                        </td>
                                                        <td style="width: 8%;" align="center">
                                                            <?php echo $this->Form->input('coutrevient', array('label' => '', 'value' => $res['coutrevient'], 'name' => 'data[lignecommandeclients][' . $i . '][coutrevient]', 'type' => 'text', 'id' => 'coutrevient' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number   calculprix')); ?>
                                                        </td>
                                                        <td style="width: 7%;" align="center">
                                                            <?php echo $this->Form->input('coutrevientdev', array('champ' => 'coutrevientdev', 'label' => '', 'value' => sprintf("%01.3f", $res['coutrevient'] * $tauxchan), 'name' => 'data[lignecommandeclients][' . $i . '][coutrevientdev]', 'type' => 'text', 'id' => 'coutrevientdev' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  number  calculprix')); ?>
                                                        </td>
                                                        <?php if ($parametretaus->tauxdemarge == 1) { ?>
                                                            <td style="width: 5%;" align="center">
                                                                <?php echo $this->Form->input('tauxdemarge', array('label' => '', 'value' => $res['tauxdemarge'], 'name' => 'data[lignecommandeclients][' . $i . '][tauxdemarge]', 'type' => 'text', 'id' => 'tauxdemarge' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number   calculprix ')); ?>
                                                            </td>
                                                        <?php }
                                                        if ($parametretaus->tauxmarque == 1) { ?>
                                                            <td style="width: 5%;" align="center">
                                                                <?php echo $this->Form->input('tauxdemarque', array('label' => '', 'value' => $res['tauxdemarque'], 'name' => 'data[lignecommandeclients][' . $i . '][tauxdemarque]', 'type' => 'text', 'id' => 'tauxdemarque' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number   calculprix')); ?>
                                                            </td>
                                                        <?php } ?>
                                                        <!-- <td style="width: 8%;" align="center"> -->
                                                        <!-- <?php echo $this->Form->input('prixht', array('label' => '', 'value' => $res['prixht'], 'name' => 'data[lignecommandeclients][' . $i . '][prixht]', 'type' => 'text', 'id' => 'prixht' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson ')); ?> -->
                                                        <!-- </td> -->
                                                        <td align="center">
                                                            <?php
                                                            // if ($res['tauxdemarge'] !== null) {
                                                        
                                                            //     echo $this->Form->input('prixht', array('label' => '', 'value' => intval($res['prixht']), 'name' => 'data[lignecommandeclients][' . $i . '][prixht]', 'type' => 'text', 'id' => 'prixht' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson '));
                                                            // } else {
                                                            echo $this->Form->input('prixht', array('label' => '', 'value' => sprintf("%01.3f", $res['prixht']), 'name' => 'data[lignecommandeclients][' . $i . '][prixht]', 'type' => 'text', 'id' => 'prixht' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number  calculinversep'));
                                                            //}
                                                            ?>

                                                        </td>

                                                        <td>
                                                            <?php
                                                            echo $this->Form->control('typeremise_id', ['label' => '', 'id' => 'typeremise_id' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'value' => $res['typeremise_id'], 'name' => 'data[lignecommandeclients][' . $i . '][typeremise_id]', 'class' => "form-control select2 typeremise_idl", 'options' => $typeremises]);
                                                            ?>
                                                        </td>
                                                        <td style="width: 8%;" align="center">
                                                            <div id="divremise<?php echo $i; ?>"
                                                                table="lignecommandeclients" index="<?php echo $i; ?>"
                                                                style="display:<?php if ($res['typeremise_id'] == 1) {
                                                                    echo "flex";
                                                                } else {
                                                                    echo "none";
                                                                } ?> ">
                                                                <?php echo $this->Form->input('remise', array('label' => '', 'value' => $res['remise'], 'name' => 'data[lignecommandeclients][' . $i . '][remise]', 'type' => 'text', 'id' => 'remise' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson testremise')); ?>
                                                                <i style="    margin-top: 26%;font-size: 18px;" class="fa fa-percent"></i>&thinsp;&thinsp;&thinsp;
                                                        
                                                          
                                                            </div>
                                                            <div id="divremiseval<?php echo $i; ?>"
                                                                table="lignecommandeclients" index="<?php echo $i; ?>"
                                                                style="display:<?php if ($res['typeremise_id'] == 2) {
                                                                    echo "block";
                                                                } else {
                                                                    echo "none";
                                                                } ?> ">
                                                                <?php echo $this->Form->input('remiseval', array('label' => '', 'value' => $res['remiseval'], 'name' => 'data[lignecommandeclients][' . $i . '][remiseval]', 'type' => 'text', 'id' => 'remiseval' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson testremiseval')); ?>

                                                            </div>
                                                        </td>

                                                        <td style="width: 8%;" align="center" hidden>
                                                            <?php echo $this->Form->input('punht', array('label' => '', 'value' => $res['punht'], 'name' => 'data[lignecommandeclients][' . $i . '][punht]', 'type' => 'text', 'id' => 'punht' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson ')); ?>
                                                        </td>
                                                        <td champ="tdtva" table="tablelignetva" id="tdtva<?php echo $i; ?>"
                                                            name="data[ligner]['<?php echo $i; ?>'][tdtva]"
                                                            index="<?php echo $i; ?>"
                                                            style=" display:<?php echo ($commandeclient->tvaOnOff == 1) ? 'table-cell' : 'none'; ?>"
                                                            align="center">
                                                            <?php echo $this->Form->input('tva', array('label' => '', 'value' => $res->tva, 'name' => 'data[lignecommandeclients][' . $i . '][tva]', 'type' => 'text', 'id' => 'tva' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson ')); ?>
                                                        </td>

                                                        <!-- <td style="width: 12%;" align="center">
                                                                <?php echo $this->Form->input('fodec', array('label' => '', 'value' => $res->fodec, 'name' => 'data[lignecommandeclients][' . $i . '][fodec]', 'type' => 'text', 'id' => 'fodec' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson ')); ?>
                                                            </td> -->
                                                        <td style="width: 8%;" align="center">
                                                            <?php echo $this->Form->input('ttc', array('readonly', 'label' => '', 'value' => $res['ttc'], 'name' => 'data[lignecommandeclients][' . $i . '][ttc]', 'type' => 'text', 'id' => 'ttc' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson '));
                                                            $totalttc = $totalttc + $res['ttc']; ?>
                                                        </td>
                                                        <td style="width:2%" align="center"><i index="<?php echo $i ?>"
                                                                class="fa fa-times supLigne"
                                                                style="color: #C9302C;font-size: 22px;"></td>
                                                    </tr>
                                                <?php endforeach; ?>

                                                <tr class='tr' style="display: none !important">
                                                    <td align="center" hidden>
                                                        <?php echo $this->Form->input('nbvirgule', array('champ' => 'nbvirgule', 'label' => '', 'value' => 2, 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculprix number')); ?>
                                                    </td>
                                                    <td style="width: 15%;" align="center">
                                                        <?php echo $this->Form->input('id', array('champ' => 'id', 'label' => '', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                        <?php
                                                        echo $this->Form->input('type', array('value' => 2, 'name' => '', 'id' => '', 'champ' => 'type', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));

                                                        echo $this->Form->input('sup0', array('name' => '', 'id' => '', 'champ' => 'sup0', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden'));
                                                        echo $this->Form->control('article_id', ['options' => $articleservises, 'empty' => 'Veuillez choisir !!', 'label' => '', 'table' => 'lignecommandeclients', 'champ' => 'article_id', 'class' => 'form-control  getprixhtson getprixarticle']); ?>
                                                    </td>
                                                    <td style="width: 10%;">
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
                                                    <td style="width: 5%;">
                                                        <?php //echo $this->Form->control('unite_id', ['options' => $unites, 'empty' => '', 'label' => '', 'table' => 'lignecommandeclients', 'champ' => 'unite_id', 'class' => 'form-control ']); ?>

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
                                                        <?php echo $this->Form->input('qte', array('champ' => 'qte', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson ')); ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('coutrevient', array('champ' => 'coutrevient', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number  calculprix')); ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('coutrevientdev', array('champ' => 'coutrevientdev', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number  calculprix ')); ?>
                                                    </td>
                                                    <?php if ($parametretaus->tauxdemarge == 1) { ?>
                                                        <td align="center">
                                                            <?php echo $this->Form->input('tauxdemarge', array('champ' => 'tauxdemarge', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number  calculprix')); ?>
                                                        </td>
                                                    <?php }
                                                    if ($parametretaus->tauxmarque == 1) { ?>
                                                        <td align="center">
                                                            <?php echo $this->Form->input('tauxdemarque', array('champ' => 'tauxdemarque', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number   calculprix')); ?>
                                                        </td>
                                                    <?php } ?>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('prixht', array('champ' => 'prixht', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number  calculinversep')); ?>
                                                    </td>
                                                    <td>
                                                    
                                                        <?php
                                                        echo $this->Form->control('typeremise_id', ['champ' => 'typeremise_id', 'label' => '', 'name' => '', 'table' => 'lignecommandeclients', 'class' => "form-control  typeremise_idl ", 'options' => $typeremises]); ?>
                                                    </td>
                                                    <td align="center">
                                                        <div champ="divremise" style="display:flex" table="lignecommandeclients">
                                                            <?php echo $this->Form->input('remise', array('champ' => 'remise', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson testremise')); ?>
                                                            <i style="    margin-top: 26%;font-size: 18px;" class="fa fa-percent"></i>&thinsp;&thinsp;&thinsp;
                                                        
                                                       
                                                        </div>
                                                        <div champ="divremiseval" table="lignecommandeclients"
                                                            style="display:none">
                                                            <?php echo $this->Form->input('remiseval', array('champ' => 'remiseval', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson testremiseval')); ?>

                                                        </div>
                                                    </td>

                                                    <td align="center" hidden>
                                                        <?php echo $this->Form->input('punht', array('champ' => 'punht', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson ')); ?>
                                                    </td>
                                                    <td champ="tdtva" table="tablelignetva" id="" name="" index=""
                                                        style="display:none;" align="center">
                                                        <?php echo $this->Form->input('tva', array('champ' => 'tva', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson ')); ?>
                                                    </td>
                                                    <!-- <td align="center">
                                                          <?php echo $this->Form->input('fodec', array('champ' => 'fodec', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson ')); ?>
                                                        </td> -->
                                                    <td align="center">

                                                        <?php echo $this->Form->input('ttc', array('champ' => 'ttc', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson ')); ?>
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
                        echo $this->Form->control('typeremise_id', ['id' => 'typeremise_id','value'=>$commandeclient->typeremise_id, 'class' => "form-control select2 getprixhtson", 'options' => $typeremises]);
                        ?>
                    </div>
                    <div class="col-md-6">
                        <div id="remisetotaldiv" style="display: <?php if($commandeclient->typeremise_id==1){ ?>block<?php }else{ ?>none<?php } ?>">
                            <?php echo $this->Form->control('remisetotal', ['id' => 'remisetotal', 'value' => $commandeclient->remisetotal, 'label' => 'Remise relative sur le total en %', 'type' => 'text', 'min' => 0, 'max' => 100, 'class' => 'form-control number getprixhtson testremise']); ?>

                        </div>
                        <div id="remisetotalvaldiv" style="display: <?php if($commandeclient->typeremise_id==2){ ?>block<?php }else{ ?>none<?php } ?>">
                            <?php echo $this->Form->control('remisetotalval', ['id' => 'remisetotalval', 'value' => $commandeclient->remisetotalval, 'label' => 'Remise relative sur le total en valeur', 'type' => 'text', 'class' => 'form-control number getprixhtson testremiseval']); ?>

                        </div>

                    </div>
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                        <?php echo $this->Form->control('totalht', ['readonly' => true, 'value' => $commandeclient->totalht]); ?>
                    </div>
                    <div id="divtva" class="col-xs-3"
                        style="display:<?php echo ($commandeclient->tvaOnOff == 1) ? 'block' : 'none'; ?>">
                        <?php echo $this->Form->control('totaltva', ['readonly' => true, 'value' => sprintf("%01." . $commandeclient->nbfergule . "f", $commandeclient->totaltva)]); ?>
                    </div>
                    <?php if ($parametretaus->tauxmarque == 1) { ?>

                        <div class="col-md-6">
                            <?php echo $this->Form->control('totalfodec', ['readonly' => true, 'label' => 'Total Taux de Marque', 'id' => 'totalmarque', 'value' => $commandeclient->totalfodec]); ?>
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
                        <?php echo $this->Form->control('totalttc', ['readonly' => true, 'value' => $commandeclient->totalttc]) ?>
                        <?php
                        echo $this->Form->control('totalttcdl', ['readonly' => true, 'id' => 'totalttcdl', 'type' => 'hidden', 'value' => $commandeclient->totalttcdl, 'table' => 'tablecommandeclient', 'label' => 'Total TTC', 'readonly' => true]); ?>

                    </div>
                    <div align="center" class="btnEditCmdClient ">
                        <button type="submit" class="pull-right btn btn-success btn-sm" id="poi1ntv"
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

    function getTauxdevise(devise, devprojet) {
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
                const tauxTND = data.conversion_rates.devprojet;
                document.getElementById('tauxdeviseprojet').value = tauxTND;
                // document.getElementById('message2').textContent = '';
                return tauxTND;
            })
            .catch(error => {
                // document.getElementById('message2').textContent = 'Erreur: Impossible de récupérer le taux de change.';
                // document.getElementById('tauxChange2').value = '';

            });
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
            //virg = $("#nbvirgule"+i).val()||2;
            virg = ferg;

            if (Number(sup) != 1) {
                coutrevient = $("#coutrevient" + i).val(); //alert(prixrevient)
                MG = $("#tauxdemarge" + i).val() || 0; //alert(MG)
                MQ = $("#tauxdemarque" + i).val() || 0; //alert(MQ)
                prixrevient = Number(coutrevient) * Number(taux);
                $("#coutrevientdev" + i).val(Number(prixrevient).toFixed(virg));
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
                    prixMG = ((Number(prixrevient) * 100) / Number(marque)); //*Number(taux);
                    // prixMG = Math.floor(prixMG); // Conversion en entier
                    $("#prixht" + i).val(Number(prixMG).toFixed(virg));
                    //$("#prixht" + i).val(prixMG);
                    //$("#punht" + i).val(prixMG);
                    margel = Number(prixMG) * Number(MQ / 100); //*Number(taux);
                    totalmarque = (Number(totalmarque) + Number(margel)).toFixed(virg);

                } else if (MG && Number(prixrevient) != 0) {
                    prixMQ = (Number(prixrevient) + (Number(MG) * Number(prixrevient) / 100)); ///Number(taux); //alert(prixMQ)
                    // alert(Number(prixMQ).toFixed(3));
                    $("#prixht" + i).val(Number(prixMQ).toFixed(virg));
                    marquel = Number(prixMQ) * Number(MG / 100) * Number(taux);
                    totalmarge = (Number(totalmarge) + Number(marquel)).toFixed(virg);
                    // $("#punht" + i).val(prixMG);
                } else {
                    if (Number(prixrevient) != 0) {
                        $("#prixht" + i).val(Number(Number(prixrevient) /* *Number(taux)  */).toFixed(virg));
                    }

                }
            }
        }
        //   $("#totalmarge").val(Number(totalmarge).toFixed(ferg));
        //   $("#totalmarque").val(Number(totalmarque).toFixed(ferg));
        getprixhtsonia();

    }

    $(document).ready(function () {
        $('#tauxChange').on('keyup', function () {
            calcullll();

        });

        $('#banque_id').on('change', function () {

            id = $('#banque_id').val();
            //  alert(id);
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Banques', 'action' => 'getcomptebanks']) ?>",
                dataType: "json",
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (data) {

                    $('#Compteee_id').html(data.select);


                }
            });
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
            getprixhtsonia();

        });

        $(".calculprix1309204").on("keyup", function () {
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

            champ = $(this).attr('champ');
            alert(champ);

            // indexl = $("#indexa" + index).val();
            ferg = 3;
            if (nbfergule != '' && Number(nbfergule) != 0) {
                ferg = $("#nbfergule").val();

            }
            champ = $(this).attr('champ');
            alert(champ)
            prixMG = 0;
            prixMQ = 0;
            total = 0;
            totalmarge = 0;
            totalmarque = 0;
            for (i = 0; i <= Number(index); i++) {
                sup = $("#sup0" + i).val() || 0;
                if (Number(sup) != 1) {
                    MG = $("#tauxdemarge" + i).val() || 0; //alert(MG)
                    MQ = $("#tauxdemarque" + i).val() || 0; //alert(MQ)
                    if (champ != "coutrevientdev") {
                        coutrevient = $("#coutrevient" + i).val(); //alert(prixrevient)


                        prixrevient = Number(coutrevient) * Number(taux);
                        $("#coutrevientdev" + i).val(Number(prixrevient).toFixed(3));

                        console.log('mg ' + MG);
                        if (MG && MQ) {
                            alert("Veuillez saisir uniquement un taux de marge ou un taux de marque.");
                            $("#tauxdemarge" + i).val('');
                            $("#tauxdemarque" + i).val('');
                            $("#prixht" + i).val('');
                            // $("#punht" + i).val('');
                        } else if (MQ && Number(prixrevient) != 0) {

                            marque = 100 - Number(MQ);
                            prixMG = ((Number(prixrevient) * 100) / Number(marque)); //*Number(taux);
                            $("#prixht" + i).val(Number(prixMG).toFixed(ferg));
                        } else if (MG && Number(prixrevient) != 0) {
                            prixMQ = (Number(prixrevient) + (Number(MG) * Number(prixrevient) / 100)); //*Number(taux); //alert(prixMQ)
                            $("#prixht" + i).val(Number(prixMQ).toFixed(ferg));
                        } else {
                            if (Number(prixrevient) != 0) {
                                $("#prixht" + i).val(Number(Number(prixrevient) /* /Number(taux) */).toFixed(ferg));
                            }

                        }
                    } else {
                        prixrevient = $("#coutrevientdev" + i).val();
                    }
                }
            }
            getprixhtsonia();

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
        $('.appliquedes').on('click', function () {
            //alert('description')
            idligne = $("#idligne").val();
            $("#description" + idligne).val($("#descriptionlong").val());
            const overlay = document.getElementById('popupOverlay');
            overlay.classList.toggle('show');

        });
        $('.description').on('click', function () {
            //alert('description')
            idligne = $(this).attr("index");
            $("#idligne").val(idligne);
            $("#descriptionlong").val($("#description" + idligne).val());
            const overlay = document.getElementById('popupOverlay');
            overlay.classList.toggle('show');

        });
        $(".dwdxfghjkl").on("keyup", function () {
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
        $(".").on("keyup", function () {
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
        $('.select2').select2({
    width: "100%", // need to override the changed default
  })
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
                    // alert(devis)
                    getTauxChange2(devis);

                }

            })
        });
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
                    calcullll()
                    // if (data.taux != 0) {
                    //     document.getElementById('tauxChange').value = data.taux;
                    //     calcullll()
                    // } else {

                    //     getTauxChange(devis);
                    //     calcullll()
                    // }
                    $('.deviseprojet2').html(data.codeachat);
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