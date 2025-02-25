<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Demandeoffredeprix $demandeoffredeprix
 */

use Cake\Datasource\ConnectionManager;

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<?php echo $this->Html->script('controle_frs'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
       Consultation Demande offre de prix
        <small>
            <?php echo __(''); ?>
        </small>
    </h1>
    <?php //debug($id_projet); ?>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'vieww', $id_projet]); ?>"><i class="fa fa-reply"></i>
                <?php echo __('Retour'); ?>
            </a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <?php echo __(''); ?>
                    </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?php echo $this->Form->create($bandeconsultation, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
                <?php
                $datee = null;
                // debug($bandeconsultation);
                if (!empty($bandeconsultation->demandeoffredeprix->date)) {
                    $datee = $bandeconsultation->demandeoffredeprix->date->format('Y-m-d');
                }
                $numero = $bandeconsultation->demandeoffredeprix->numero;

                ?>

                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('date', ['readonly' => 'readonly', 'label' => 'Date', 'value' => $datee, 'empty' => true, 'id' => 'datecommande', 'class' => "form-control pull-right"]);
                            echo $this->Form->input('id', array('value' => $demandes['id'], 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'hidden'));
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('numero', ['readonly' => 'readonly', 'value' => $numero]); ?>
                        </div>
                    </div>
                </div>
                <section class="content-header" style="margin-left:20px">
                    <h1 class="box-title">
                        <?php echo __('Article'); ?>
                    </h1>
                </section>

                <section class="content" style="width: 100%">
                    <div class="row">
                        <div class="box box">
                            <div class="box-header with-border">
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive ls-table">

                                    <table class="table table-bordered table-striped " id="tabligne0">
                                        <thead>
                                            <tr width:20px">
                                                <td align="center" style="width: 15%;background-color: #F5F5F5 ;">
                                                    <strong>Fournisseur</strong>
                                                </td>
                                                <td align="center" style="width: 80%;background-color: #F5F5F5 ;">
                                                    <strong>Article</strong>
                                                </td>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $articlesFournisseur = [];
                                            foreach ($lignefs as $j => $ligiventaire) {
                                                $connection = ConnectionManager::get('default');
                                                $mn = $ligiventaire['nameF'];
                                                //  echo "SELECT * FROM lignebandeconsultations WHERE lignebandeconsultations.demandeoffredeprix_id =  $id_dm  and lignebandeconsultations.nameF = $mn  ;";
                                                $ligneas = $connection->execute("SELECT * FROM lignebandeconsultations WHERE lignebandeconsultations.demandeoffredeprix_id = $id_dm  and lignebandeconsultations.nameF = '$mn'  ;")->fetchAll('assoc');
                                                //debug($ligneas);die;
                                                $ddd = $connection->execute('SELECT * FROM `lignelignebandeconsultations` WHERE lignelignebandeconsultations.nameF = "' . $mn . '" AND lignelignebandeconsultations.demandeoffredeprix_id = ' . $id_dm)->fetchAll('assoc');
                                                $paies = $connection->execute('SELECT * FROM `fournisseurpaiements` WHERE fournisseurpaiements.lignelignebandeconsultation_id = ' . $ddd[0]['id'])->fetchAll('assoc');
                                                $pid = '0';
                                                $pname='';
                                                foreach ($paies as  $paie) {
                                                    $paiement = $connection->execute('SELECT * FROM `paiements` WHERE paiements.id = ' . $paie['paiement_id'])->fetchAll('assoc');
                                                    $pname .=$paiement[0]['name'].', ';
                                                    $pid .= ',' . $paie['paiement_id'];
                                                }
                                                //'value' => $pid,
                                                //debug($ddd);
                                                // echo  $ligiventaire['fournisseur_id'];
                                                // debug($ligiventaire['fournisseur_id']);
                                                if ($ligiventaire['fournisseur_id']) {
                                                    $idf = $ligiventaire['fournisseur_id'];
                                                } else {
                                                    $idf = '';
                                                }
                                            ?>
                                                <tr class="" style="">
                                                    <td align="center" style="background-color: white;">
                                                        <?php echo $this->Form->input('nameF', array('label' => '', 'readonly' => 'readonly', 'value' => $ligiventaire['nameF'], 'id' => 'nameF' . $j, 'name' => 'data[fligne][' . $j . '][nameF]', 'champ' => 'nameF', 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control'));
                                                        ?>
                                                        <?php echo $this->Form->input('fournisseur_id', array('disabled' => true,'value' => $idf, 'label' => '', 'id' => 'fournisseur_id' . $j, 'name' => 'data[fligne][' . $j . '][fournisseur_id]', 'champ' => 'fournisseur_id', 'index' => $j, 'table' => 'fligne', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control', 'type' => 'hidden')); ?>
                                                        <?php echo $this->Form->input('devise_id', array('disabled' => true,'value' => $ddd[0]['devise_id'], 'label' => 'Devise', 'empty' => 'Veuillez choisir !!!', 'id' => 'devise_id' . $j, 'name' => 'data[fligne][' . $j . '][devise_id]', 'champ' => 'devise_id', 'index' => $j, 'table' => 'fligne', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                        <?php echo $this->Form->input('conditionreglement_id', array('disabled' => true,'value' => $ddd[0]['conditionreglement_id'], 'label' => 'Condition de reglement', 'empty' => 'Veuillez choisir !!!', 'id' => 'conditionreglement_id' . $j, 'name' => 'data[fligne][' . $j . '][conditionreglement_id]', 'champ' => 'conditionreglement_id', 'index' => $j, 'table' => 'fligne', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                        <?php echo $this->Form->input('paiement_id', array('disabled' => true,'title'=>$pname,'label' => 'Mode de reglement', 'empty' => false, 'id' => 'paiement_id' . $j, 'name' => 'data[fligne][' . $j . '][paiement_id]', 'champ' => 'paiement_id', 'index' => $j, 'table' => 'fligne', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => "form-control selectpicker helloselect", 'multiple', 'data-live-search' => "true", 'onchange' => 'hello(' . $j . ')', 'label' => 'Mode de reglèment', 'options' => $paiements)); ?>
                                                        <?php echo $this->Form->input('methodeexpedition_id', array('disabled' => true,'value' => $ddd[0]['methodeexpedition_id'], 'label' => 'Méthode d`expédition', 'empty' => 'Veuillez choisir !!!', 'id' => 'methodeexpedition_id' . $j, 'name' => 'data[fligne][' . $j . '][methodeexpedition_id]', 'champ' => 'methodeexpedition_id', 'index' => $j, 'table' => 'fligne', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                        <?php echo $this->Form->input('paim', array('readonly' => true,'value'=>$pname,'label' => '', 'empty' => false, 'id' => 'paim' . $j, 'name' => 'data[fligne][' . $j . '][paim]', 'champ' => 'paim', 'index' => $j, 'table' => 'fligne', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => "form-control ",  'type' => 'hidden')); ?>

                                                    </td>
                                                    <td style="background-color: white">

                                                        <table class="table table-bordered table-striped table-bottomless" id="tabligne1">
                                                            <thead>
                                                                <tr>
                                                                    <td align="center" style="width: 28%;background-color: #F5F5F5;font-size: 13px;">
                                                                        <strong>Nom du
                                                                            article</strong>
                                                                    </td>
                                                                    <td align="center" style="width: 5%;background-color: #F5F5F5;font-size: 13px;">
                                                                        <strong>Code
                                                                            article/frs</strong>
                                                                    </td>
                                                                    <td align="center" style="width: 5%;background-color: #F5F5F5 ;font-size: 13px;">
                                                                        <strong>Quantité</strong>
                                                                    </td>
                                                                    <td align="center" style="width: 7%;background-color: #F5F5F5 ;font-size: 13px;">
                                                                        <strong>coût de
                                                                            revient</strong>
                                                                    </td>
                                                                    <td align="center" style="width: 7%;background-color: #F5F5F5;font-size: 13px;">
                                                                        <strong>Taux de marge</strong>
                                                                    </td>
                                                                    <td align="center" style="width: 7%;background-color: #F5F5F5;font-size: 13px;">
                                                                        <strong>Taux de marque</strong>
                                                                    </td>
                                                                    <td align="center" style="width: 7%;background-color: #F5F5F5 ;font-size: 13px;">
                                                                        <strong>prix de
                                                                            vente</strong>
                                                                    </td>
                                                                    <td align="center" style="width: 10%;background-color: #F5F5F5 ;font-size: 13px;">
                                                                        <strong>Total</strong>
                                                                    </td>
                                                                    <td align="center" style="width: 10%;background-color: #F5F5F5 ;font-size: 13px;">
                                                                        <strong>Date de livraison</strong>
                                                                    </td>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                <?php
                                                                //   debug($ligneas);die;
                                                                foreach ($ligneas as $i => $ligne) {
                                                                    // debug($ligne['arejeter']);
                                                                    //  debug($ligne);
                                                                    $connection = ConnectionManager::get('default');
                                                                    $id = $ligne['demandeoffredeprix_id'];
                                                                    $nameF = $ligne['nameF'];
                                                                    //$article_id = $ligne['article_id'];
                                                                    if ($ligne['article_id']) {
                                                                        $article_id = $ligne['article_id'];
                                                                    } else {
                                                                        $article_id = '';
                                                                    }
                                                                    //  echo $article_id;
                                                                    // R�cup�rez les d�tails de l'article si n�cessaire
                                                                    if ($ligne['article_id'] != 0 && $ligne['article_id'] != '') {
                                                                        $articles = $connection->execute('SELECT * FROM `articles` WHERE id=' . $ligne['article_id'] . ';')->fetchAll('assoc');
                                                                        $ligne['designiationA'] = $articles[0]['Dsignation'];
                                                                    }
                                                                    // debug($ligiventaire['fournisseur_id']);
                                                                    // debug($ligne['fournisseur_id']);
                                                                    // debug($ligiventaire['fournisseur_id'] == $ligne['fournisseur_id']);
                                                                    if ($ligiventaire['fournisseur_id'] == $ligne['fournisseur_id']) {
                                                                        //echo $ligne['article_id'];
                                                                        $total_articles = $connection->execute('SELECT t FROM `lignelignebandeconsultations` WHERE lignelignebandeconsultations.nameF = \'' . $nameF . '\' AND lignelignebandeconsultations.demandeoffredeprix_id = ' . $id)->fetchAll('assoc');
                                                                        // debug($ligne['codefrs']);
                                                                ?>
                                                                        <tr class="tr" style="">
                                                                            <td align="center" style="background-color: white;vertical-align:inherit;">
                                                                                <?php echo $this->Form->input('article_id', array('disabled' => true,'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][article_id]', 'value' => $article_id, 'id' => 'article_id' . $j . '-' . $i, 'champ' => 'article_id', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                                                                                <?php echo $this->Form->input('ligne_id', array('disabled' => true,'value' => $ligne['lignedemandeoffredeprix_id'], 'label' => '', 'id' => 'ligne_id' . $j . '-' . $i, 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][ligne_id]', 'champ' => 'ligne_id', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control', 'type' => 'hidden')); ?>
                                                                                <?php echo $this->Form->input('designiationA', array('readonly' => 'readonly', 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][designiationA]', 'value' => $ligne['designiationA'], 'label' => '', 'id' => 'designiationA' . $j . '-' . $i, 'champ' => 'designiationA', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'type' => 'hidden', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control', 'style' => 'font-size: 13px;')); ?>
                                                                                <?php echo $ligne['designiationA']; ?>
                                                                            </td>
                                                                            <td align="center" table="" style="background-color: white">
                                                                                <?php echo $this->Form->input('codefrs', array('readonly' => true,'value' => $ligne['codefrs'], 'label' => '', 'id' => 'codefrs' . $j . '-' . $i, 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][codefrs]', 'champ' => 'codefrs', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'style' => 'font-size: 13px;', 'class' => 'form-control codefrs')); ?>
                                                                            </td>
                                                                            <td align="center">
                                                                                <?php echo $this->Form->input('qte', array('readonly' => true,'value' => $ligne['qte'], 'readonly' => 'readonly', 'label' => '', 'id' => 'qte' . $j . '-' . $i, 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][qte]', 'champ' => 'qte', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'style' => 'font-size: 13px;', 'class' => 'form-control calcull')); ?>
                                                                            </td>
                                                                            <td align="center">
                                                                                <?php
                                                                                if ($ligne['prix'] !== null) {
                                                                                    echo $this->Form->input('prix', array('readonly' => true,'value' => sprintf("%01.3f", $ligne['prix']), 'type' => 'text', 'label' => '', 'step' => 'any', 'id' => 'prix' . $j . '-' . $i, 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][prix]', 'champ' => 'prix', 'table' => 'fligne', 'tableligne' => 'aligne', 'empty' => true, 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'style' => 'font-size: 13px;', 'class' => 'form-control number prix calculprix calcull calculll'));
                                                                                } else {
                                                                                    echo $this->Form->input('prix', array('readonly' => true,'value' => '', 'label' => '', 'step' => 'any', 'type' => 'text', 'id' => 'prix' . $j . '-' . $i, 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][prix]', 'champ' => 'prix', 'table' => 'fligne', 'tableligne' => 'aligne', 'empty' => true, 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'style' => 'font-size: 13px;', 'class' => 'form-control number prix calculprix calcull calculll'));
                                                                                }
                                                                                ?>
                                                                            </td>

                                                                            <td align="center">
                                                                                <?php echo $this->Form->input('tauxdemarge', array('readonly' => true,'value' => $ligne['tauxdemarge'], 'label' => '', 'id' => 'tauxdemarge' . $j . '-' . $i, 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][tauxdemarge]', 'champ' => 'tauxdemarge', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'style' => 'font-size: 13px;', 'class' => 'form-control calculprix')); ?>

                                                                            </td>
                                                                            <td align="center">
                                                                                <?php echo $this->Form->input('tauxdemarque', array('readonly' => true,'value' => $ligne['tauxdemarque'], 'label' => '', 'id' => 'tauxdemarque' . $j . '-' . $i, 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][tauxdemarque]', 'champ' => 'tauxdemarque', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'style' => 'font-size: 13px;', 'class' => 'form-control calculprix')); ?>

                                                                            </td>
                                                                            <td align="center">
                                                                                <?php if ($ligne['tauxdemarge'] !== null) {
                                                                                    echo $this->Form->input('coutrevient', array('readonly' => true,'value' => $ligne['coutrevient'], 'label' => '', 'id' => 'coutrevient' . $j . '-' . $i, 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][coutrevient]', 'champ' => 'coutrevient', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'style' => 'font-size: 13px;', 'class' => 'form-control'));
                                                                                } else {
                                                                                    echo $this->Form->input('coutrevient', array('readonly' => true,'value' => sprintf("%01.3f", $ligne['coutrevient']), 'label' => '', 'id' => 'coutrevient' . $j . '-' . $i, 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][coutrevient]', 'champ' => 'coutrevient', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'style' => 'font-size: 13px;', 'class' => 'form-control'));
                                                                                }
                                                                                ?>

                                                                            </td>
                                                                            <td align="center">
                                                                                <?php
                                                                                echo $this->Form->input(
                                                                                    'total',
                                                                                    array(
                                                                                        'value' => ($ligne['prix'] !== null) ? sprintf("%01.3f", $ligne['ht']) : '',
                                                                                        'label' => '',
                                                                                        'readonly' => true,
                                                                                        'id' => 'total' . $j . '-' . $i,
                                                                                        'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][total]',
                                                                                        'champ' => 'total',
                                                                                        'table' => 'fligne',
                                                                                        'tableligne' => 'aligne',
                                                                                        'indexligne' => $i,
                                                                                        'index' => $j,
                                                                                        'div' => 'form-group',
                                                                                        'between' => '<div class="col-sm-12" >',
                                                                                        'after' => '</div>',
                                                                                        'class' => 'form-control total'
                                                                                    )
                                                                                );
                                                                                ?>
                                                                            </td>
                                                                            <td align="center">
                                                                                <?php echo $this->Form->input('datelivraison', array('readonly' => true,'value' => $ligne['datelivraison'], 'label' => '', 'id' => 'datelivraison' . $j . '-' . $i, 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][datelivraison]', 'champ' => 'datelivraison', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'style' => 'font-size: 13px;', 'class' => 'form-control ', 'type' => 'date')); ?>

                                                                            </td>
                                                                            <!-- <td align="center" style="vertical-align: middle;">
                                                                                <input type="checkbox"
                                                                                    id="check<?php echo $j . '-' . $i; ?>" value=1
                                                                                    name="data[fligne][<?php echo $j; ?>][aligne][<?php echo $i; ?>][arejeter]" <?php if ($ligne['arejeter'] != 0) {
                                                                                                                                                                    echo 'checked';
                                                                                                                                                                } ?>
                                                                                    ligne="<?php echo $ligne['id']; ?>" />
                                                                            </td> -->
                                                                        </tr>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </tbody>


                                                        </table>
                                                        <input type="hidden" value="<?php echo $i; ?>" id="indexa<?php echo $j; ?>" />
                                                        <div class="col-lg-3 col-lg-offset-3 pull-right">
                                                            <?php echo $this->Form->input('t', array('readonly' => true,'value' => number_format($total_articles[0]['t'], 3, '.', ''), 'label' => 'total des prix des articles:', 'id' => 't' . $j, 'name' => 'data[fligne][' . $j . '][t]', 'champ' => 'total', 'table' => 'fligne', 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-4" >', 'after' => '</div>', 'class' => 'form-control total')); ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" value="<?php echo $j; ?>" id="index" />
                        
                        <?php echo $this->Form->end(); ?>
                    </div>
            </div>
        </div>
    </div>
    <script>
        function hello(ind) {
            var button = document.querySelector('button[data-id="paiement_id' + ind + '"]');
            var title = button.getAttribute('title');
            // alert(title)
            $('#paim' + ind).val(title);
        }
        $(document).ready(function() {
            $('.selectpicker').selectpicker();

            $(".calculprix").on("keyup", function() {
                // index = $("#index").val();
                index1 = $("#indexa").val();
                index = $("#index").val();
                indexl = $("#indexa" + index).val();
                for (j = 0; j <= Number(index); j++) {
                    prixMG = 0;
                    prixMQ = 0;
                    total = 0;
                    for (i = 0; i <= Number(indexl); i++) {
                        sup = $("#sup" + i).val() || 0;
                        if (Number(sup) != 1) {
                            prix = $("#prix" + j + "-" + i).val(); //alert(prix)
                            MG = $("#tauxdemarge" + j + "-" + i).val(); //alert(MG)
                            MQ = $("#tauxdemarque" + j + "-" + i).val(); //alert(MQ)
                            if (MG && MQ) {
                                alert("Veuillez saisir uniquement un taux de marge ou un taux de marque.");
                                $("#tauxdemarge" + j + "-" + i).val('');
                                $("#tauxdemarque" + j + "-" + i).val('');
                                $("#coutrevient" + j + "-" + i).val('');
                            } else if (MG) {
                                prixMG = Number(prix) + (Number(MG) * Number(prix) / 100);
                                prixMG = Math.floor(prixMG); // Conversion en entier
                                $("#coutrevient" + j + "-" + i).val(prixMG);
                            } else if (MQ) {
                                prixMQ = Number(prix) + (Number(MQ) * Number(prix) / 100);
                                $("#coutrevient" + j + "-" + i).val(Number(prixMQ).toFixed(3));
                            }
                        }
                    }
                }
            });
        });
    </script>
    <style>
        .bootstrap-select .dropdown-toggle .filter-option {
            position: relative !important;

        }
    </style>
    <!-- <script>
        $(document).ready(function () {
            $('.calculll').on('keyup', function () {
                index = $('#index').val(); //nombre de ligne total
                index1 = $('#indexa').val();
                calculeii();
                calculei();

                function calculeii() {
                    index = $('#index').val();
                    indexl = $('#indexa' + index).val();
                    for (j = 0; j <= Number(index); j++) {
                        tt = 0;
                        total = 0;
                        for (i = 0; i <= Number(indexl); i++) {
                            sup = $('#sup' + i).val() || 0;
                            if (Number(sup) != 1) {
                                qte = $('#qte' + j + '-' + i).val();
                                prix = $('#prix' + j + '-' + i).val();

                                // V�rifiez si qte et prix sont des nombres valides
                                if (!isNaN(qte) && !isNaN(prix)) {
                                    tot = Number(qte) * Number(prix);
                                    total = Number(total) + Number(tot);
                                    $('#total' + j + '-' + i).val(Number(tot).toFixed(3));
                                }
                            }
                        }
                        tt = Number(tt) + Number(total);
                        $('#t' + j).val(Number(tt).toFixed(3));
                    }
                }

                function calculei() {
                    index = $('#index0').val();
                    tt = 0;
                    total = 0;
                    for (j = 0; j <= Number(index); j++) {
                        sup = $('#sup0' + j).val() || 0;
                        if (Number(sup) != 1) {
                            qte = $('#qte' + j).val();
                            prix = $('#prix' + j).val();

                            // V�rifiez si qte et prix sont des nombres valides
                            if (!isNaN(qte) && !isNaN(prix)) {
                                tot = Number(qte) * Number(prix);
                                total = Number(total) + Number(tot);
                                $('#ht' + j).val(Number(tot).toFixed(3));
                            }
                        }
                    }
                    tt = Number(tt) + Number(total);
                    $('#t').val(Number(tt).toFixed(3));
                }
            });
        });
    </script> -->