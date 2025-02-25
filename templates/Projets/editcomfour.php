<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Commande $commande
 */

use Cake\Datasource\ConnectionManager;

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<?php echo $this->Html->script('controle_frs'); ?>
<?php echo $this->Html->script('hechem'); ?>
<?php //echo $this->Html->script('js_vieww_projet'); ?>
<?php echo $this->Html->css('select2'); ?>
<section class="content-header">
    <h1>
        Modification commande fournisseur
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
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <?php echo __(''); ?>
                    </h3>
                </div>
                <?php echo $this->Form->create($commande, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]);

                ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <?php echo $this->Form->control('numero', ['readonly' => 'readonly']); ?>
                            <?php echo $this->Form->control('id', ['type' => 'hidden']); ?>

                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->input('date', ['readonly' => 'readonly', 'div' => 'form-group', 'value' => $this->Time->format('now', 'd/m/Y'), 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control']); ?>
                        </div>
                        <div class="col-md-6">
                            <?php
                            echo $this->Form->control('fournisseur_id', ['id' => 'fournisseur_id', 'empty' => 'Veuillez choisir !!', 'empty' => 'Veuillez choisir !!', 'class' => 'select2 form-control', 'options' => $fournisseurs]); ?>
                        </div>
                        <div class="col-md-6" hidden>
                            <?php
                            echo $this->Form->control('depot_id', ['empty' => 'Veuillez choisir !!', 'class' => 'select2 form-control', 'options' => $depots]); ?>
                        </div>

                        <div class="col-md-6">
                            <?php echo $this->Form->control('projet_id', ['id' => 'projet_id', 'empty' => 'Veuillez choisir !!', 'class' => 'select2 form-control', 'value' => $project_id]); ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->control('conditionreglement_id', ['empty' => 'Veuillez choisir !!', 'class' => 'select2 form-control']); ?>
                        </div>

                        <div class="col-md-6">
                            <?php
                            echo $this->Form->control('dateprev', ['label' => 'Date prévue de livraison', 'type' => 'date', 'id' => 'dateprev', 'class' => "form-control"]); ?>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6" id="deviseSelect">
                                    <?php echo $this->Form->control('devise_id', ['label' => 'Devise', 'empty' => 'Veuillez choisir !!', 'id' => 'devise_id', 'class' => 'select2 form-control']); ?>
                                </div>
                                <div class="col-md-6">
                                    <?php echo $this->Form->control('tauxdechange', ['label' => 'Taux de change', 'id' => 'tauxChange', 'class' => 'form-control', 'readonly']); ?>
                                    <div id="message"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <?php echo $this->Form->control('incoterm_id', ['label' => 'Incoterm', 'empty' => 'Veuillez choisir !!', 'class' => 'select2 form-control', 'options' => $incoterms]); ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->control('incotermpdf_id', ['label' => 'Incoterm PDF', 'empty' => 'Veuillez choisir !!', 'class' => 'select2 form-control', 'options' => $incoterms]); ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->input('pay', ['table' => 'tablecommandeclient', 'type' => 'text', 'class' => 'form-control ', 'id' => 'pay_id', 'label' => 'Pay']); ?>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label" for="unipxte-id" style="margin-top: 25px;">TVA:</label>
                            OUI <input type="radio" name="tvaOnOff" value="1" id="OUI" class="toggleEditComFour" <?php if ($commande->tvaOnOff == 1)
                                                                                                                        echo "checked"; ?>>
                            NON <input type="radio" name="tvaOnOff" value="0" id="NON" class="toggleEditComFour" <?php if ($commande->tvaOnOff == 0)
                                                                                                                        echo "checked"; ?>>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php
                                    $connection = ConnectionManager::get('default');

                                    $paies = $connection->execute('SELECT * FROM `fournisseurpaiementcommandes` WHERE fournisseurpaiementcommandes.commandefournisseur_id = ' . $commande->id)->fetchAll('assoc');
                                    if (!empty($paies)) {
                                        $pid = '0';
                                        $pname = '';
                                        foreach ($paies as  $paie) {
                                            if ($paie['paiement_id']) {
                                                $paiement = $connection->execute('SELECT * FROM `paiements` WHERE paiements.id = ' . $paie['paiement_id'])->fetchAll('assoc');
                                                $pname .= $paiement[0]['name'] . ', ';
                                                $pid .= ',' . $paie['paiement_id'];
                                            }
                                            
                                        }
                                    }

                                    echo $this->Form->input('paiement_id', array('title' => $pname, 'label' => 'Mode de reglement', 'empty' => false, 'id' => 'paiement_id', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => "form-control selectpicker helloselect", 'multiple', 'data-live-search' => "true", 'onchange' => 'hello()', 'label' => 'Mode de reglèment', 'options' => $paiements)); ?>
                                    <?php echo $this->Form->input('paim', array('value' => $pname, 'label' => '', 'empty' => false, 'id' => 'paim', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => "form-control ",  'type' => 'hidden')); ?>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label" for="detailmontantpdf" style="margin-top: 25px;">Détail des montants de transport en pdf:</label>
                                    OUI <input type="radio" name="detailmontantpdf" value="1" id="OUI" class="toggleEditComFour" <?php if ($commande->detailmontantpdf == 1)
                                                                                                                                        echo "checked"; ?>>
                                    NON <input type="radio" name="detailmontantpdf" value="0" id="NON" class="toggleEditComFour" <?php if ($commande->detailmontantpdf == 0)
                                                                                                                                        echo "checked"; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->control('methodeexpedition_id', ['empty' => 'Veuillez choisir !!', 'label' => 'Méthode d`expedition',  'class' => 'form-control select2']); ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->control('nbfergule', ['label' => 'Nombre de chiffre après la virgule',  'class' => 'form-control']); ?>
                        </div>
                    </div>
                    <section class="content-header">
                        <h1 class="box-title">
                            <?php echo __('Les produits commandes'); ?>
                        </h1>
                    </section>
                    <section class="content" style="width: 99%">
                        <div class="row">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <a class="btn btn-primary " table='addtable' index='index' id='ajouter_ligne_com_four' style="float: right; margin-bottom: 5px;">

                                        <!-- <a class="btn btn-primary " table='addtable' index='index' id='ajouter_ligne0' style="float: right; margin-bottom: 5px;"> -->
                                        <i class="fa fa-plus-circle "></i> Ajouter produit</a>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive ls-table">
                                        <table class="table table-bordered table-striped table-bottomless" id="tabligne0">
                                            <thead>
                                                <tr>
                                                    <td align="center" style="width: 35%;"><strong>Produit</strong></td>
                                                    <td align="center" style="width: 10%;"><strong>Quantite</strong>
                                                    </td>
                                                    <td align="center" style="width: 10%;"><strong>PrixHt</strong></td>
                                                    <td align="center" style="width: 10%;"><strong>PUNHT</strong></td>
                                                    <td align="center" style="width: 5%;"><strong>Remise</strong></td>
                                                    <td hidden align="center" style="width: 5%;"><strong>Fodec</strong>
                                                    </td>
                                                    <td id='thtva' align="center" style="display:<?php echo ($commande->tvaOnOff == 1) ? 'table-cell' : 'none'; ?>">
                                                        <strong>Tva</strong>
                                                    </td>
                                                    <td align="center" style="width: 10%;"><strong>TTC</strong></td>
                                                    <td align="center" style="width: 10%;"><strong></strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($lignecommandes as $i => $res) :
                                                ?>
                                                    <tr>
                                                        <td align="center">
                                                            <div class="form-group input text required">
                                                                <?php echo $this->Form->input('sup0', ['name' => 'data[ligner][' . $i . '][sup0]', 'id' => 'sup0' . $i, 'champ' => 'sup0' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control']);
                                                                echo $this->Form->control('article_id', array('value' => $res['article_id'], 'name' => 'data[ligner][' . $i . '][article_id]', 'champ' => 'article_id', 'label' => '', 'table' => 'ligner', 'index' => $i, 'class' => 'form-control  select2', 'id' => 'article_id' . $i)); ?>
                                                            </div>
                                                        </td>
                                                        <td align="center">
                                                            <?php
                                                            echo $this->Form->input('qte', array('value' => $res['qte'], 'label' => '', 'name' => 'data[ligner][' . $i . '][qte]', 'id' => 'qte' . $i, 'champ' => 'qte', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control vali htbc'));
                                                            ?>
                                                        </td>
                                                        <td align="center" champ='tt'>
                                                            <?php
                                                            echo $this->Form->input('prix', array('value' => $res['prix'], 'label' => '', 'name' => 'data[ligner][' . $i . '][prix]', 'id' => 'prix' . $i, 'champ' => 'prix', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc vali number', 'type' => 'text'));
                                                            ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php
                                                            echo $this->Form->input('punht', array('value' => $res['ht'], 'readonly' => 'readonly', 'label' => '', 'name' => 'data[ligner][' . $i . '][punht]', 'id' => 'punht' . $i, 'champ' => 'punht', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc', 'type' => 'text'));
                                                            ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php
                                                            echo $this->Form->input('remise', array('value' => $res['remise'], 'label' => '', 'name' => 'data[ligner][' . $i . '][remise]', 'id' => 'remise' . $i, 'champ' => 'remise', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc', 'type' => 'text'));
                                                            ?>
                                                        </td>

                                                        <td align="center" hidden>
                                                            <?php
                                                            echo $this->Form->input('fodec', array('value' => $res['fodec'], 'label' => '', 'name' => 'data[ligner][' . $i . '][fodec]', 'id' => 'fodec' . $i, 'champ' => 'fodec' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc', 'type' => 'text'));
                                                            ?>

                                                        </td>

                                                        <td champ="tdtva" table="tablelignetva" id="tdtva<?php echo $i; ?>" name="data[ligner]['<?php echo $i; ?>'][tdtva]" index="<?php echo $i; ?>" style=" display:<?php echo ($commande->tvaOnOff == 1) ? 'table-cell' : 'none'; ?>" align="center">
                                                            <?php echo $this->Form->input('tva', array('value' => $res['tva'], 'label' => '', 'name' => 'data[ligner][' . $i . '][tva]', 'id' => 'tva' . $i, 'champ' => 'tva', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc', 'type' => 'text')); ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php
                                                            echo $this->Form->input('ttc', array('value' => $res['ttc'], 'readonly' => 'readonly', 'label' => '', 'name' => 'data[ligner][' . $i . '][ttc]', 'id' => 'ttc' . $i, 'champ' => 'ttc', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc', 'type' => 'text'));
                                                            ?>
                                                        </td>
                                                        <td align="center"><i index="<?php echo $i ?>" id="" class="fa fa-times supLigne20" style="color: #c9302c;font-size: 22px;"></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                <tr class='tr' style="display: none !important">
                                                    <td align="center">
                                                        <div class="form-group input text required">
                                                            <?php echo $this->Form->input('sup0', ['name' => '', 'id' => '', 'champ' => 'sup0', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control']);
                                                            echo $this->Form->control('article_id', ['name' => '', 'champ' => 'article_id', 'label' => '', 'table' => 'ligner', 'index' => '', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control  ', 'id' => '']); ?>
                                                        </div>
                                                    </td>
                                                    <td align="center">
                                                        <?php
                                                        echo $this->Form->input('qte', array('value' => '', 'label' => '', 'name' => '', 'id' => '', 'champ' => 'qte', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control vali htbc'));
                                                        ?>
                                                    </td>
                                                    <td align="center" champ='tt'>
                                                        <?php
                                                        echo $this->Form->input('prix', array('label' => '', 'name' => '', 'id' => '', 'champ' => 'prix', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc vali number', 'type' => 'text'));
                                                        ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php
                                                        echo $this->Form->input('punht', array('readonly' => 'readonly', 'label' => '', 'name' => '', 'id' => '', 'champ' => 'punht', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc', 'type' => 'text'));
                                                        ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php
                                                        echo $this->Form->input('remise', array('label' => '', 'name' => '', 'id' => '', 'champ' => 'remise', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc', 'type' => 'text'));
                                                        ?>
                                                    </td>

                                                    <td align="center" hidden>
                                                        <?php
                                                        echo $this->Form->input('fodec', array('label' => '', 'name' => '', 'id' => '', 'champ' => 'fodec', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc', 'type' => 'text'));
                                                        ?>
                                                    </td>
                                                    <td champ="tdtva" table="tablelignetva" id="" name="" index="" style="display:none;" align="center">
                                                        <?php
                                                        echo $this->Form->input('tva', array('label' => '', 'name' => '', 'id' => '', 'champ' => 'tva', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc', 'type' => 'text'));
                                                        ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php
                                                        echo $this->Form->input('ttc', array('readonly' => 'readonly', 'label' => '', 'name' => '', 'id' => '', 'champ' => 'ttc', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc', 'type' => 'text'));
                                                        ?>
                                                    </td>
                                                    <td align="center"><i index="" id="" class="fa fa-times supLigne20" style="color: #c9302c;font-size: 22px;"></td>
                                                </tr>
                                                <input type="hidden" value="<?php echo $i ?>" id="index0">
                                            </tbody>
                                        </table>
                                        <div class="col-md-4">
                                            <?php echo $this->Form->input('remise', array('readonly' => 'readonly', 'value' => sprintf('%.3f', $commande->remise), 'id' => 'remise', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'text')); ?>
                                        </div>
                                        <div class="col-xs-4" hidden>
                                            <?php echo $this->Form->input('fodec', array('readonly' => 'readonly', 'value' => sprintf('%.3f', $commande->fodec), 'id' => 'fodec', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'text')); ?>
                                        </div>
                                        <div class="col-xs-4">
                                            <?php echo $this->Form->input('ht', array('readonly' => 'readonly', 'id' => 'ht', 'value' => sprintf('%.3f', $commande->ht), 'label' => 'HT', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'text')); ?>
                                        </div>

                                        <div id="divtva" class="col-xs-4" style="display:<?php echo ($commande->tvaOnOff == 1) ? 'block' : 'none'; ?>">
                                            <?php echo $this->Form->input('tva', array('readonly' => 'readonly', 'value' => sprintf('%.3f', $commande->tva), 'id' => 'tva', 'label' => 'TVA', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'text')); ?>
                                        </div>
                                        <div class="col-md-4">
                                            <?php echo $this->Form->input('ttc', array('readonly' => 'readonly', 'value' => sprintf('%.3f', $commande->ttc), 'id' => 'ttc', 'label' => 'TTC', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'text')); ?>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div align="center" class="addcmd" id="e1">
                            <?php echo $this->Form->submit(__('Enregistrer')); ?>
                        </div>
                        <?php echo $this->Form->end(); ?>
                    </section>













                    <!--                        echo $this->Form->control('valide');
                        echo $this->Form->control('remise');
                        echo $this->Form->control('tva');
                        echo $this->Form->control('fodec');
                        echo $this->Form->control('ttc');
                        echo $this->Form->control('ht');
                       ;
                        ?>-->
                </div>
                <!-- /.box-body -->



                <?php echo $this->Form->end(); ?>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
</section>
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
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<!-- Select2 -->
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
    $('.select2').select2();
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
    function hello() {
        var button = document.querySelector('button[data-id="paiement_id"]');
        var title = button.getAttribute('title');
        // alert(title)
        $('#paim').val(title);
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
    function ajouter_ligne_avec_condition_tva(table, index) {
      //alert(index)
      ind = Number($("#" + index).val()) + 1; //alert(ind)
      $ttr = $("#" + table)
        .find(".tr")
        .clone(true);
      $ttr.attr("class", "");
      i = 0;
      tabb = [];
      $ttr.find("input,select,textarea,tr,td,div").each(function() {
        tab = $(this).attr("table");
        champ = $(this).attr("champ");
        $(this).attr("index", ind);
        $(this).attr("id", champ + ind);
        $(this).attr("name", "data[" + tab + "][" + ind + "][" + champ + "]");
        $(this).attr(
          "data-bv-field",
          "data[" + tab + "][" + ind + "][" + champ + "]"
        );
        $type = $(this).attr("type");
        $(this).val("");
        if ($type == "radio") {
          $(this).attr("name", "data[" + champ + "]");
          $(this).val(ind);
        }
        if (champ == "datedebut" || champ == "datefin") {
          $(this).attr("onblur", "nbrjour(" + ind + ")");
        }
        $(this).removeClass("anc");
        if ($(this).is("select")) {
          tabb[i] = champ + ind;
          i = Number(i) + 1;
        }
        if ($("#OUI").prop("checked")) {
          $ttr.find("td[champ='tdtva']").css("display", "table-cell");
        } else {
          $ttr.find("td[champ='tdtva']").css("display", "none");
        }
      });
      $ttr.find("i").each(function() {
        $(this).attr("index", ind);
      });
      $("#" + table).append($ttr);
      $("#" + index).val(ind);
      $("#" + table)
        .find("tr:last")
        .show();
      for (j = 0; j <= i; j++) {}
      $("#matierepremiere_id" + ind).select2();
      $("#article_id" + ind).select2();
      $("#unite_id" + ind).select2();
      $("#depot_id" + ind).select2();
      $("#fonction_id" + ind).select2();
      $("#typepf_id" + ind).select2();
    }


    $(document).ready(function() {
        $("#ajouter_ligne_com_four").on("click", function() {
      index = Number($("#index0").val()); //alert(index)

      ajouter_ligne_avec_condition_tva("tabligne0", "index0");
    });

 
        $('#deviseSelect').on('change', function() {
            // var devise_id = $(this).val();
            devise_id = $('#devise_id').val(); //alert(devise_id)
            projet_id = $('#projet_id').val(); //alert(projet_id)
            // var devise = mapDevise(devise_id);

            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Projets', 'action' => 'getdevise']) ?>",
                dataType: "json",
                data: {
                    devise_id: devise_id,
                    projet_id: projet_id,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function(data) {
                    console.log(data)
                    var devis = data.code;
                    document.getElementById('tauxChange').value = data.taux;
                    //getTauxChange(devis);
                }

            })
        });
    });
    // function mapDevise(devise_id) {
    //     // alert(devise_id)
    //     var devisesMapping = {
    //         '3': 'EUR',
    //         '1': 'TND',
    //         '2': 'USD',
    //     };
    //     if (devise_id in devisesMapping) {
    //         return devisesMapping[devise_id];
    //     }
    // }
</script>

<?php $this->end(); ?>