<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('controle_frs');

use Cake\Datasource\ConnectionManager;

$connection = ConnectionManager::get('default');

?>

<section class="content-header">
    <h1>
        Passer bande commande
        <small><?php echo __(''); ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'vieww', $project_id]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box">
                <div class="box-header with-border">

                    <section>
                        <?php echo $this->Form->create($commande, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-6">
                                    <?php
                                    echo $this->Form->control('date', ['name' => 'date', 'readonly' => 'readonly', 'value' => $date, 'label' => 'Date', 'id' => 'datecommande', 'class' => "form-control pull-right"]);
                                    //                    echo $this->Form->control('date', ['empty' => true]);
                                    //debug($demandes);die;
                                    ?>
                                </div>

                                <div class="col-xs-6">
                                    <?php
                                    echo $this->Form->control('projet_id', ['name' => 'projet_id', 'disabled' => true, 'empty' => 'Veuillez choisir !!', 'label' => 'Projet', 'value' => $pp]);
                                    ?>
                                </div>
                                <div class="col-xs-6">
                                    <?php
                                    echo $this->Form->control('mm', ['name' => 'numero', 'label' => 'Numero', 'value' => $c, 'readonly' => 'readonly']);
                                    ?>
                                </div>
                            </div>
                        </div>










                        <section class="content-header" style="margin-left:20px">
                            <h1 class="box-title"><?php echo __('Table comparatif par total'); ?></h1>
                        </section>


                        <section class="content" style="width:93%">
                            <div class="row">
                                <div class="box box">
                                    <div class="box-header with-border">
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive ls-table">

                                            <table class="table table-bordered table-striped " id="addtablea">
                                                <thead>
                                                    <tr>
                                                        <td align="center" style="width: 20%"><strong>Fournisseur</strong></td>
                                                        <td align="center" style="width: 60%"><strong>Article</strong></td>
                                                        <td align="center" style="width: 20%"><strong>Classement</strong></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($lignefs as $j => $lig) {
                                                        $ddd = $connection->execute('SELECT * FROM `lignelignebandeconsultations` WHERE lignelignebandeconsultations.nameF = "' . $lig['nameF'] . '" AND lignelignebandeconsultations.demandeoffredeprix_id = ' . $lig['demandeoffredeprix_id'])->fetchAll('assoc');
                                                        $paies = $connection->execute('SELECT * FROM `fournisseurpaiements` WHERE fournisseurpaiements.lignelignebandeconsultation_id = ' . $ddd[0]['id'])->fetchAll('assoc');
                                                        $pid = '0';
                                                        $pname = '0';
                                                        //debug($paies);die;
                                                        foreach ($paies as  $paie) {
                                                            if ($paie['paiement_id'] != null) {
                                                                $paiement = $connection->execute('SELECT * FROM `paiements` WHERE paiements.id = ' . $paie['paiement_id'])->fetchAll('assoc');
                                                                $pname .=  ', ' . $paiement[0]['name'];
                                                                $pid .= ',' . $paie['paiement_id'];
                                                            }
                                                        }

                                                    ?>


                                                        <tr>
                                                            <td align="center">
                                                                <?php echo $this->Form->input('id', array('value' => $lig['fournisseur_id'], 'label' => '', 'id' => 'id' . $j, 'name' => 'data[fligne][' . $j . '][id]', 'champ' => 'id', 'table' => 'fligne', 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control', 'type' => 'hidden')); ?>
                                                                <?php echo $this->Form->input('nameF', array('label' => '', 'readonly' => 'readonly', 'value' => $lig['nameF'], 'id' => 'nameF' . $j, 'name' => 'data[fligne][' . $j . '][nameF]', 'champ' => 'nameF', 'table' => 'fligne', 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                                <?php echo $this->Form->input('devise_id', array('type' => 'hidden', 'value' => $ddd[0]['devise_id'], 'label' => 'Devise', 'empty' => 'Veuillez choisir !!!', 'id' => 'devise_id' . $j, 'name' => 'data[fligne][' . $j . '][devise_id]', 'champ' => 'devise_id', 'index' => $j, 'table' => 'fligne', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                                <?php echo $this->Form->input('conditionreglement_id', array('type' => 'hidden', 'value' => $ddd[0]['conditionreglement_id'], 'label' => 'Condition de reglement', 'empty' => 'Veuillez choisir !!!', 'id' => 'conditionreglement_id' . $j, 'name' => 'data[fligne][' . $j . '][conditionreglement_id]', 'champ' => 'conditionreglement_id', 'index' => $j, 'table' => 'fligne', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                                <?php echo $this->Form->input('methodeexpedition_id', array('type' => 'hidden', 'value' => $ddd[0]['methodeexpedition_id'], 'label' => 'Méthode d`expédition', 'empty' => 'Veuillez choisir !!!', 'id' => 'methodeexpedition_id' . $j, 'name' => 'data[fligne][' . $j . '][methodeexpedition_id]', 'champ' => 'methodeexpedition_id', 'index' => $j, 'table' => 'fligne', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                                <?php echo $this->Form->input('paim', array('type' => 'hidden', 'value' => $pname, 'label' => '', 'empty' => false, 'id' => 'paim' . $j, 'name' => 'data[fligne][' . $j . '][paim]', 'champ' => 'paim', 'index' => $j, 'table' => 'fligne', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => "form-control ",  'type' => 'hidden')); ?>

                                                            </td>




                                                            <td align="center">


                                                                <table class="table table-bordered table-striped table-bottomless" id="addtableaa<?php echo $j; ?>" style="width:100%" align="center">
                                                                    <thead>
                                                                        <tr style="background-color: white;">
                                                                            <td align="center" style="width: 5%;"><strong><?php echo ('Nom du article'); ?></strong></td>
                                                                            <td align="center" style="width: 5%;"><strong><?php echo ('Quantité'); ?></strong></td>
                                                                            <td align="center" style="width: 5%;"><strong><?php echo ('Prix'); ?></strong></td>
                                                                            <td align="center" style="width: 5%;"><strong><?php echo ('Total'); ?></strong></td>
                                                                        </tr>
                                                                    <tbody>
                                                                        <?php

                                                                        $i = -1;
                                                                        foreach ($d[$j] as $i => $ligne) {


                                                                        ?>
                                                                            <tr>
                                                                                <?php if ($ligne['nameF'] == $lig['nameF']) {
                                                                                ?>
                                                                                    <td align="center" style="vertical-align:inherit;">

                                                                                        <?php echo $this->Form->input('id', array('value' => $ligne['article_id'], 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][id]', 'id' => 'id' . $j . '-' . $i, 'champ' => 'id', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                                                        ?>
                                                                                        <?php echo $this->Form->input('article_id', array('value' => $ligne['article_id'], 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][article_id]', 'id' => 'article_id' . $j . '-' . $i, 'champ' => 'article_id', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                                                        ?>
                                                                                        <?php echo $this->Form->input('bande_id', array('value' => $ligne['bandeconsultation_id'], 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][bande_id]', 'id' => 'bande_id' . $j . '-' . $i, 'champ' => 'bande_id', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                                                                                        <?php echo $this->Form->input('ligne_id', array('value' => $ligne['id'], 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][ligne_id]', 'id' => 'ligne_id' . $j . '-' . $i, 'champ' => 'ligne_id', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                                                        ?>
                                                                                        <?php echo $this->Form->input('designiationA', array('value' => $ligne['designiationA'], 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][designiationA]', 'id' => 'designiationA' . $j . '-' . $i, 'champ' => 'designiationA', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                                                                                        <?php echo $ligne['designiationA']; ?>


                                                                                    </td>

                                                                                    <td align="center">
                                                                                        <?php echo $this->Form->input('qte', array('value' => $ligne['qte'], 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][qte]', 'id' => 'qte' . $j . '-' . $i, 'champ' => 'qte', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                                                                                        <?php echo $ligne['qte']; ?>

                                                                                    </td>
                                                                                    <td align="center">
                                                                                        <?php echo $this->Form->input('prix', array('value' => $ligne['prix'], 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][prix]', 'id' => 'prix' . $j . '-' . $i, 'champ' => 'prix', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                                                                                        <?php echo $ligne['prix']; ?>
                                                                                    </td>
                                                                                    <td align="center">
                                                                                        <?php echo $this->Form->input('ht', array('value' => $ligne['ht'], 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][ht]', 'id' => 'ht' . $j . '-' . $i, 'champ' => 'ht', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                                                                                        <?php echo $ligne['ht']; ?>
                                                                                    </td>
                                                                                <?php  } ?>
                                                                            </tr>
                                                                        <?php }
                                                                        ?>
                                                                        <tr>
                                                                            <td align="center" colspan="5">
                                                                                <input type="hidden" value="<?php echo $i; ?>" id="indexa<?php echo $j; ?>" />

                                                                                <div class="col-lg-9 col-lg-offset-3">
                                                                                    <?php echo $this->Form->input('t', array('value' => $lig['t'], 'readonly' => 'readonly', 'label' => 'total des prix des articles', 'id' => 't' . $j, 'name' => 'data[fligne][' . $j . '][t]', 'champ' => 'total', 'table' => 'fligne', 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-4" >', 'after' => '</div>', 'class' => 'form-control total')); ?>
                                                                                </div>
                                                                            </td>
                                                                        </tr>






                                                                    </tbody>
                                                                </table>
                                                            </td>

                                                            <td style="vertical-align:inherit;">
                                                                <div class="col-lg-9 col-lg-offset-4" id="cercle<?php echo $j; ?>" index="<?php echo $j; ?>"></div>
                                                                <div class="col-lg-9 col-lg-offset-4" id="box<?php echo $j; ?>" index="<?php echo $j; ?>">
                                                                    <input table="fligne" name="data[fligne][<?php echo $j; ?>][check]" type="checkbox" id="check<?php echo $j; ?>" value="0" index="<?php echo $j; ?>" class="check ">
                                                                </div>
                                                            </td>

















                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>


                                            <div align="center" id="enr5">
                                                <?php echo $this->Form->submit(__('validation')); ?>
                                            </div>
                                            <input type="hidden" value="<?php echo $j; ?>" id="index">
                                            <br><br>



                                        </div>





                                    </div>
                                </div>
                            </div>

                        </section>










                        <?php echo $this->Form->end(); ?>
                    </section>











































                    <section>
                        <?php echo $this->Form->create($commande, ['role' => 'form']); ?>

                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-6">
                                    <?php
                                    echo $this->Form->control('date', ['type' => 'hidden', 'readonly' => 'readonly', 'value' => $date, 'label' => 'Date', 'id' => 'datecommande', 'class' => "form-control pull-right"]);
                                    //                    echo $this->Form->control('date', ['empty' => true]);
                                    //echo $this->Form->input('id', array('value' => $demandes['id'], 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'hidden'));
                                    //debug($demandes);die;
                                    ?>
                                </div>

                                <div class="col-xs-6">
                                    <?php
                                    // echo $this->Form->control('numero',['label'=>'Numero','required' => 'off','id'=>'datecommande','div'=>'form-group','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control ','type'=>'','readonly'=>'readonly']); 
                                    echo $this->Form->control('mm', ['type' => 'hidden', 'label' => 'Numero', 'value' => $c, 'readonly' => 'readonly']);
                                    ?>
                                </div>



                            </div>
                        </div>





















































                        <section class="content-head²er" style="margin-left:20px">
                            <h1 class="box-title"><?php echo __('Table comparatif par prix'); ?></h1>
                        </section>
                        <section class="content" style="width:93%">
                            <div class="row">
                                <div class="box box">
                                    <div class="box-header with-border">
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive ls-table">

                                            <table class="table table-bordered table-striped " id="addtablea">
                                                <thead>
                                                    <tr>
                                                        <td align="center" style="width: 20%"><strong>Article/Fournisseur</strong></td>
                                                        <?php
                                                        $a = 0;
                                                        foreach ($fournisseurs as $j => $fournisseur) {  //debug($tabjours);
                                                            //debug($fournisseur['nameF']);die;
                                                            $ddd = $connection->execute('SELECT * FROM `lignelignebandeconsultations` WHERE lignelignebandeconsultations.nameF = "' . $fournisseur['nameF'] . '" AND lignelignebandeconsultations.demandeoffredeprix_id = ' . $fournisseur['demandeoffredeprix_id'])->fetchAll('assoc');
                                                            $paies = $connection->execute('SELECT * FROM `fournisseurpaiements` WHERE fournisseurpaiements.lignelignebandeconsultation_id = ' . $ddd[0]['id'])->fetchAll('assoc');
                                                            $pid = '0';
                                                            $pname = '';
                                                            foreach ($paies as  $paie) {
                                                                if ($paie['paiement_id'] != null) {
                                                                    $paiement = $connection->execute('SELECT * FROM `paiements` WHERE paiements.id = ' . $paie['paiement_id'])->fetchAll('assoc');
                                                                    $pname .= $paiement[0]['name'] . ', ';
                                                                    $pid .= ',' . $paie['paiement_id'];
                                                                }
                                                            }
                                                        ?>
                                                            <td>
                                                                <?php echo $this->Form->input('id', array('label' => '', 'value' => $fournisseur['fournisseur_id'], 'id' => 'id' . $j, 'name' => 'data[lignefourn][' . $j . '][id]', 'champ' => 'id', 'table' => 'lignefourn', 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control', 'type' => 'hidden')); ?>

                                                                <?php echo $this->Form->input('nameF', array('label' => '', 'value' => $fournisseur['nameF'], 'id' => 'nameF' . $j, 'name' => 'data[lignefourn][' . $j . '][nameF]', 'champ' => 'nameF', 'table' => 'lignefourn', 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control', 'type' => 'hidden')); ?>
                                                                <?php echo $this->Form->input('devise_id', array('type' => 'hidden', 'value' => $ddd[0]['devise_id'], 'label' => 'Devise', 'empty' => 'Veuillez choisir !!!', 'id' => 'devise_id' . $j, 'name' => 'data[lignefourn][' . $j . '][devise_id]', 'champ' => 'devise_id', 'index' => $j, 'table' => 'lignefourn', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                                <?php echo $this->Form->input('conditionreglement_id', array('type' => 'hidden', 'value' => $ddd[0]['conditionreglement_id'], 'label' => 'Condition de reglement', 'empty' => 'Veuillez choisir !!!', 'id' => 'conditionreglement_id' . $j, 'name' => 'data[lignefourn][' . $j . '][conditionreglement_id]', 'champ' => 'conditionreglement_id', 'index' => $j, 'table' => 'lignefourn', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                                <?php echo $this->Form->input('methodeexpedition_id', array('type' => 'hidden', 'value' => $ddd[0]['methodeexpedition_id'], 'label' => 'Méthode d`expédition', 'empty' => 'Veuillez choisir !!!', 'id' => 'methodeexpedition_id' . $j, 'name' => 'data[lignefourn][' . $j . '][methodeexpedition_id]', 'champ' => 'methodeexpedition_id', 'index' => $j, 'table' => 'lignefourn', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                                <?php echo $this->Form->input('paim', array('type' => 'hidden', 'value' => $pname, 'label' => '', 'empty' => false, 'id' => 'paim' . $j, 'name' => 'data[lignefourn][' . $j . '][paim]', 'champ' => 'paim', 'index' => $j, 'table' => 'lignefourn', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => "form-control ",  'type' => 'hidden')); ?>

                                                                <input table="lignefourn" type="hidden" name="data[lignefourn][<?php echo @$j ?>][c]" id="c<?php echo @$j ?>">
                                                                <?php echo ($fournisseur['nameF']); ?>
                                                            <?php
                                                            $a++;
                                                        }
                                                            ?>
                                                            </td>
                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <?php
                                                        $a = 0;
                                                        foreach ($articles as $h => $article) {
                                                            //debug($article);die;   
                                                        ?>

                                                    <tr>
                                                        <td style="width: 10%">

                                                            <?php echo $this->Form->input('bande_id', array('value' => $article['id'], 'name' => 'data[lignefourn][' . $j . '][ligneart][' . $h . '][bande_id]', 'id' => 'bande_id' . $j . '-' . $h, 'champ' => 'bande_id', 'table' => 'lignefourn', 'tableligne' => 'ligneart', 'indexligne' => $h, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>

                                                            <?php echo ($article['designiationA']); ?></td>
                                                        <?php $a++; ?>
                                                        <?php
                                                            $a = 0;
                                                            foreach ($fournisseurs as $j => $fournisseur) {
                                                                //debug($fournisseur['nameF']);die;
                                                        ?>
                                                            <td style="width: 10%">
                                                                <?php
                                                                $art = $article['article_id'];
                                                                $four = $fournisseur['fournisseur_id'];
                                                                $tab[$four][$art];
                                                                $tab1[$four][$art];
                                                                //debug($tab1[$four][$art]);die; 
                                                                $k = 0;
                                                                foreach ($tab1[$four][$art] as $k => $pr) {
                                                                    $t[] = array();
                                                                    $t[$k] = $pr;
                                                                    //debug($k);
                                                                } //die;
                                                                ?>
                                                                <div class="col-lg-9 col-lg-offset-4">
                                                                    <?php
                                                                    $m = -1;
                                                                    foreach ($tab[$four][$art] as $m => $donn) {
                                                                        //                                                                            debug($donn['ht']);die;
                                                                    }
                                                                    ?>
                                                                    <?php echo $this->Form->input('ligne_id', array('value' => $donn['id'], 'name' => 'data[lignefourn][' . $j . '][ligneart][' . $h . '][ligne_id]', 'id' => 'ligne_id' . $j . '-' . $h, 'champ' => 'ligne_id', 'table' => 'lignefourn', 'tableligne' => 'ligneart', 'indexligne' => $h, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                                                                    <?php echo $this->Form->input('article_id', array('value' => $donn['article_id'], 'name' => 'data[lignefourn][' . $j . '][ligneart][' . $h . '][article_id]', 'id' => 'article_id' . $j . '-' . $h, 'champ' => 'article_id', 'table' => 'lignefourn', 'tableligne' => 'ligneart', 'indexligne' => $h, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                                                                    <?php echo $this->Form->input('designiationA', array('value' => $donn['designiationA'], 'name' => 'data[lignefourn][' . $j . '][ligneart][' . $h . '][designiationA]', 'id' => 'designiationA' . $j . '-' . $h, 'champ' => 'designiationA', 'table' => 'lignefourn', 'tableligne' => 'ligneart', 'indexligne' => $h, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                                                                    <?php echo $this->Form->input('qte', array('value' => $donn['qte'], 'name' => 'data[lignefourn][' . $j . '][ligneart][' . $h . '][qte]', 'id' => 'qte' . $j . '-' . $h, 'champ' => 'qte', 'table' => 'lignefourn', 'tableligne' => 'ligneart', 'indexligne' => $h, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                                                                    <?php echo $this->Form->input('prix', array('value' => $donn['prix'], 'name' => 'data[lignefourn][' . $j . '][ligneart][' . $h . '][prix]', 'id' => 'prix' . $j . '-' . $h, 'champ' => 'prix', 'table' => 'lignefourn', 'tableligne' => 'ligneart', 'indexligne' => $h, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                                                                    <?php echo $this->Form->input('ht', array('value' => $donn['ht'], 'name' => 'data[lignefourn][' . $j . '][ligneart][' . $h . '][ht]', 'id' => 'ht' . $j . '-' . $h, 'champ' => 'ht', 'table' => 'lignefourn', 'tableligne' => 'ligneart', 'indexligne' => $h, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                                                                    <input type="hidden" value="<?php echo @$h ?>" id="hh">
                                                                    <input type="hidden" value="<?php echo @$j ?>" id="jj">
                                                                    <?php
                                                                    if ($donn['ht'] == $t['0']['ht']) {
                                                                    ?>
                                                                        <strong style="color:#04ff00;">
                                                                            <?php echo $donn['ht'];
                                                                            ?>
                                                                        </strong>
                                                                    <?php
                                                                    } elseif ($donn['ht'] == $t['1']['ht']) {
                                                                    ?>
                                                                        <strong style="color:#ff7600ad;">
                                                                            <?php echo $donn['ht']; ?>
                                                                        </strong>
                                                                    <?php } elseif ($donn['ht'] == $t['2']['ht']) { ?>
                                                                        <strong style="color:#ff00009e;">
                                                                            <?php echo $donn['ht']; ?>
                                                                        </strong>
                                                                    <?php } else { ?>
                                                                        <strong>
                                                                            <?php echo $donn['ht']; ?>
                                                                        </strong>
                                                                    <?php } ?>
                                                                    <div class="" id="box<?php echo $h; ?>" index="<?php echo $h; ?>">
                                                                        <input h="<?php echo $h; ?>" j="<?php echo $j; ?>" table="lignefourn" tableligne="ligneart" name="data[lignefourn][<?php echo $j; ?>][ligneart][<?php echo $h; ?>][check2]" type="checkbox" id="check2<?php echo $j; ?>-<?php echo $h; ?>" index="<?php echo $j; ?>-<?php echo $h; ?> " class="check2">
                                                                    </div>

                                                                <?php } ?>




                                                                </div>

                                                            </td>

                                                        <?php } ?>
                                                    </tr>




































                                                </tbody>
                                                <input type="hidden" value="<?php echo @$h ?>" id="h" class="h">
                                                <input type="hidden" value="<?php echo @$j ?>" id="j">
                                                <input type="hidden" class="index" id="index<?php echo @$h ?>-<?php echo @$j ?>">
                                            </table>
                                            <div class="form-group" align="center">
                                                <div class="">
                                                    <button id="enr6" type="submit" class="btn btn-success">validation</button>
                                                </div>






                                            </div>
                                        </div>
                                    </div>
                                </div>

                        </section>

















                        <?php echo $this->Form->end(); ?>
                    </section>









                </div>
            </div>
        </div>
    </div>
</section>