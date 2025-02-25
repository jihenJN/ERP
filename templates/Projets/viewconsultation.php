<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Demandeoffredeprix $demandeoffredeprix
 */

use Cake\Datasource\ConnectionManager;

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('controle_frs'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Consultation Demande offre de prix
        <small>
            <?php echo __(''); ?>
        </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'viewww/' . $typeof]); ?>"><i
                    class="fa fa-reply"></i>
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

                <section class="content" style="width: 93%">
                    <div class="row">
                        <div class="box box">
                            <div class="box-header with-border">
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive ls-table">

                                    <table class="table table-bordered table-striped " id="tabligne0">
                                        <thead>
                                            <tr width:20px">
                                                <td align="center" style="width: 20%;"><strong>Fournisseur</strong></td>
                                                <td align="center" style="width: 80%;"><strong>Article</strong></td>
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
                                                        <?php echo $this->Form->input('fournisseur_id', array('value' => $idf, 'label' => '', 'id' => 'fournisseur_id' . $j, 'name' => 'data[fligne][' . $j . '][fournisseur_id]', 'champ' => 'fournisseur_id', 'index' => $j, 'table' => 'fligne', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control', 'type' => 'hidden')); ?>
                                                    </td>
                                                    <td style="background-color: white">

                                                        <table class="table table-bordered table-striped table-bottomless"
                                                            id="tabligne1">
                                                            <thead>
                                                                <tr width:20px"="">
                                                                    <td align="center" style="width: 20%;"><strong>Nom du
                                                                            article</strong></td>
                                                                    <td align="center" style="width: 25%;"><strong>Code
                                                                            article/frs</strong></td>
                                                                    <td align="center" style="width: 20%;">
                                                                        <strong>Quantit�</strong>
                                                                    </td>
                                                                    <td align="center" style="width: 20%;">
                                                                        <strong>Prix</strong>
                                                                    </td>
                                                                    <td align="center" style="width: 25%;">
                                                                        <strong>Total</strong>
                                                                    </td>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                <?php
                                                                //   debug($ligneas);die;
                                                                foreach ($ligneas as $i => $ligne) {
                                                                    //   debug($ligne['article_id']);//die;
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
                                                                            <td align="center" style="background-color: white">
                                                                                <?php echo $this->Form->input('article_id', array('name' => 'data[fligne][' . $j . '][aligne][' . $i . '][article_id]', 'value' => $article_id, 'id' => 'article_id' . $j . '-' . $i, 'champ' => 'article_id', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                                                                                <?php echo $this->Form->input('ligne_id', array('value' => $ligne['lignedemandeoffredeprix_id'], 'label' => '', 'id' => 'ligne_id' . $j . '-' . $i, 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][ligne_id]', 'champ' => 'ligne_id', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control', 'type' => 'hidden')); ?>
                                                                                <?php echo $this->Form->input('designiationA', array('readonly' => 'readonly', 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][designiationA]', 'value' => $ligne['designiationA'], 'label' => '', 'id' => 'designiationA' . $j . '-' . $i, 'champ' => 'designiationA', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                                            </td>
                                                                            <td align="center" table=""
                                                                                style="background-color: white">
                                                                                <?php echo $this->Form->input('codefrs', array('readonly', 'value' => $ligne['codefrs'], 'label' => '', 'id' => 'codefrs' . $j . '-' . $i, 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][codefrs]', 'champ' => 'codefrs', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control codefrs')); ?>
                                                                            </td>
                                                                            <td align="center">
                                                                                <?php echo $this->Form->input('qte', array('readonly', 'value' => $ligne['qte'], 'readonly' => 'readonly', 'label' => '', 'id' => 'qte' . $j . '-' . $i, 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][qte]', 'champ' => 'qte', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control calcull')); ?>
                                                                            </td>
                                                                            <td align="center">
                                                                                <?php
                                                                                if ($ligne['prix'] !== null) {
                                                                                    echo $this->Form->input('prix', array('readonly', 'value' => sprintf("%01.3f", str_replace(",", ".", ($ligne['prix']))), 'label' => '', 'step' => 'any', 'id' => 'prix' . $j . '-' . $i, 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][prix]', 'champ' => 'prix', 'table' => 'fligne', 'tableligne' => 'aligne', 'empty' => true, 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control number prix calculll'));
                                                                                } else {
                                                                                    echo $this->Form->input('prix', array('readonly', 'value' => '', 'label' => '', 'step' => 'any', 'id' => 'prix' . $j . '-' . $i, 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][prix]', 'champ' => 'prix', 'table' => 'fligne', 'tableligne' => 'aligne', 'empty' => true, 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control number prix calculll'));
                                                                                }
                                                                                ?>
                                                                            </td>
                                                                            <td align="center">
                                                                                <?php
                                                                                echo $this->Form->input(
                                                                                    'total',
                                                                                    array(
                                                                                        'value' => ($ligne['prix'] !== null) ? sprintf("%01.3f", str_replace(",", ".", $ligne['ht'])) : '',
                                                                                        'label' => '',
                                                                                        'readonly',
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
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </tbody>


                                                        </table>
                                                        <input type="hidden" value="<?php echo $i; ?>"
                                                            id="indexa<?php echo $j; ?>" />
                                                        <div class="col-lg-9 col-lg-offset-3">
                                                            <?php echo $this->Form->input('t', array('readonly', 'value' => sprintf("%01.3f", str_replace(",", ".", $total_articles[0]['t'])), 'label' => 'total des prix des articles', 'id' => 't' . $j, 'name' => 'data[fligne][' . $j . '][t]', 'champ' => 'total', 'table' => 'fligne', 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-4" >', 'after' => '</div>', 'class' => 'form-control total')); ?>
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
                        <div class="form-group">
                            <div align="center" id="enr4" class="  alert testvalidation" class="btn btn-primary">
                                <?php echo $this->Form->submit(__('Enregistrer')) ?>
                            </div>
                            <!--                                
                                            <div class="col-lg-9 col-lg-offset-3 alert">
                                                <button id="enr4" type="submit" class="btn btn-primary">Enregistrer</button>
                                            </div>
                                      
                            -->
                        </div>
                        <?php echo $this->Form->end(); ?>
                    </div>
            </div>
        </div>
    </div>
    <script>
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
    </script>