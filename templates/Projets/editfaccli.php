<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fournisseur $fournisseur
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->script('hechem'); ?>
<?php echo $this->Html->script('alert'); ?>
<?php echo $this->fetch('script'); ?>



<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Modifier facture client
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
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?php echo $this->Form->create($factureclient, ['role' => 'form']); ?>


                <div class="box-body">
                    <div class="row">
                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('numero', ['readonly' => 'readonly', 'value' => $factureclient->numero, 'label' => 'Numero', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('date', ["value" => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime(date('Y-m-d H:i:s'))))]); ?>
                                </div>
                            </div>
                        </div>
                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                            <div class="row">
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('client_id', ['value' => $factureclient->client_id, 'id' => 'client', 'options' => $clients, 'empty' => 'Veuillez choisir !!', 'label' => 'Clients', 'class' => 'form-control select2 control-label']); ?>
                                </div>
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('depot_id', ['value' => $factureclient->depot_id, 'options' => $depots, 'empty' => 'Veuillez choisir !!', 'required' => 'off', 'label' => 'Dépot', 'class' => 'form-control select2 control-label']); ?>
                                </div>
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('projet_id', ['value' => $factureclient->projet_id, 'options' => $projets, 'empty' => 'Veuillez choisir !!', 'required' => 'off', 'label' => 'Projet', 'class' => 'form-control select2 control-label']); ?>
                                </div>
                                <div class="col-xs-6">
                                    <?php

                                    //debug( $commandeclient);
                                    echo $this->Form->control('remisetotal', ['value' => $factureclient->remisetotal, 'id' => 'remisetotal', 'label' => 'Remise relative sure le total', 'class' => 'form-control getprixhtson number']); ?>
                                </div>
                                <div class="col-xs-6">
                                    <?php

                                    //debug( $commandeclient);
                                    echo $this->Form->control('remisetotalval', ['value' => $factureclient->remisetotalval, 'id' => 'remisetotalval', 'label' => 'Remise relative sure le total par valeur', 'class' => 'form-control getprixhtson number']); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-2">
                                    <?php echo $this->Form->control('incoterm_id', ['options' => $incoterms, 'empty' => 'Veuillez choisir !!', 'id' => 'incoterm_id', 'class' => 'form-control select2']); ?>
                                </div>
                                <div class="col-xs-2">
                                    <?php echo $this->Form->control('location_incoterms', ['empty' => 'Veuillez choisir !!', 'id' => 'location_incoterms', 'class' => 'form-control']); ?>
                                </div>
                                <div class="col-xs-2">
                                    <?php echo $this->Form->control('options_incotermtotalpdf', ['options' => $incoterms, 'label' => 'Incoterm du total en pdf', 'empty' => 'Veuillez choisir !!', 'id' => 'options_incotermtotalpdf', 'class' => 'form-control select2']); ?>
                                </div>
                                <div class="col-xs-6">
                                    <?php $options_istotaltransportdetaille = [1  => 'Oui', 2 => 'Non'];
                                    echo $this->Form->control('options_istotaltransportdetaille', ['options' => $options_istotaltransportdetaille, 'label' => 'Détail des montants de transport en pdf ', 'empty' => 'Veuillez choisir !!', 'id' => 'options_incotermtotalpdf', 'class' => 'form-control select2']); ?>
                                </div>
                                <div class="col-xs-12">
                                    <?php echo $this->Form->control('options_indicationenpdf', ['type' => 'textarea', 'label' => 'Transports incoterm entre le port d embarquement et le port de destination', 'empty' => 'Veuillez choisir !!', 'id' => 'options_indicationenpdf', 'class' => 'form-control']); ?>
                                </div>
                                <div class="col-xs-6">
                            <div height="60px">
                                <label class="control-label" for="unipxte-id">TVA:</label>
                                OUI <input type="radio"  id="1" id="OUI" name='tvaOnOff' class="toggleEditcomclient" <?php if ($factureclient->tvaOnOff == 1)
                                                                                                                            echo "checked"; ?>>
                                NON <input type="radio"  value="0" id="NON" class="toggleEditcomclient" name='tvaOnOff' <?php if ($factureclient->tvaOnOff == 0)
                                                                                                                            echo "checked"; ?>>
                            </div>
                        </div>
                            </div>
                        </div>
                    </div>
                    <?php foreach ($bonlivraison as $key => $v) { ?>
                        <div style=" position: static;">
                            <div class="col-xs-3">
                                <?php echo $this->Form->control('nbligne', ['value' => $v->commande->nbligne, 'nbligne' => 'Poids', 'readonly' => 'readonly', 'label' => 'Ligne bon de commande', 'name', 'required' => 'off']); ?>
                            </div>
                            <div class="col-xs-3">
                                <?php echo $this->Form->control('Poids', ['id' => 'Poids', 'value' => $v->commande->Poids, 'readonly' => 'readonly', 'label' => 'Poids', 'name', 'required' => 'off']); ?>
                            </div>
                            <div class="col-xs-3">
                                <?php echo $this->Form->control('Coeff', ['id' => 'Coeff', 'value' => $v->commande->Coeff, 'readonly' => 'readonly', 'label' => 'NB Palette', 'name', 'required' => 'off']); ?>
                            </div>
                            <div class="col-xs-3">
                                <?php echo $this->Form->control('pallette', ['id' => 'pallette', 'value' => $v->commande->pallette, 'readonly' => 'readonly', 'label' => 'Poids Par palette', 'name', 'required' => 'off']); ?>
                            </div>
                        </div>
                    <?php } ?>
                    <section class="content-header">
                        <h1 class="box-title">
                            <?php echo __('Ligne facture client Produit'); ?>
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

                                                    <td align="center" nowrap="nowrap"><strong>Fournisseur</strong></td>

                                                    <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp; &thinsp; Produit&thinsp; &thinsp; &thinsp; </strong></td>
                                                    <td align="center" nowrap="nowrap"><strong>Description</strong> </td>
                                                    <td align="center" nowrap="nowrap"><strong>Unité</strong></td>
                                                    <td align="center" nowrap="nowrap"><strong>Quantite</strong> </td>
                                                    <td align="center" nowrap="nowrap"><strong>Prix de revient</strong></td>
                                                    <td align="center" nowrap="nowrap"><strong>Taux de marge</strong></td>
                                                    <td align="center" nowrap="nowrap"><strong>Taux de marque</strong></td>

                                                    <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; PrixHT&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; </strong></td>

                                                    <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; Remise&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; </strong></td>
                                                    <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp; &thinsp; PUNHT&thinsp; &thinsp; &thinsp; </strong></td>
                                                    <td nowrap="nowrap" id='thtva' align="center" style="display:<?php echo ($factureclient->tvaOnOff == 1) ? 'table-cell' : 'none'; ?>">
                                                        <strong>&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; Tva&thinsp; &thinsp; &thinsp;&thinsp; &thinsp; </strong>
                                                    </td>
                                                    <!-- <td align="center" nowrap="nowrap">
                                                        <strong>&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; Fodec&thinsp; &thinsp; &thinsp;&thinsp; &thinsp; </strong>
                                                    </td> -->
                                                    <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; TTC&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; </strong></td>

                                                    <td align="center" nowrap="nowrap"></td>


                                                </tr>
                                            </thead>
                                            <tbody>




                                                <?php
                                                //debug($commande);
                                                $i = 0;
                                                $totalttc=0;
                                                foreach ($lignefactureclients as $res) :
                                                    //debug($res);
                                                    //die; //debug($ligne) 
                                                    $i++;
                                                ?>
                                                    <tr>
                                                        <td style="width: 10%;" align="center">

                                                            <?php
                                                            echo $this->Form->control('fournisseur_id', ['type' => 'hidden', 'index' => $i, 'id' => 'fournisseur_id' . $i,  'value' => $res['fournisseur_id'], 'name' => 'data[ligner][' . $i . '][fournisseur_id]', 'label' => '', 'table' => 'ligner', 'champ' => 'fournisseur_id', 'class' => 'form-control   ']);
                                                            echo $this->Form->control('fournisseur_id', ['disabled' => true, 'empty' => 'Veuillez choisir !!!', 'index' => $i, 'id' => 'fournisseur_id' . $i, 'options' => $fournisseurs, 'value' => $res['fournisseur_id'], 'name' => 'data[ligner][' . $i . '][fournisseurr_id]', 'label' => '', 'table' => 'ligner', 'champ' => 'fournisseur_id', 'class' => 'form-control select2 frarticle ']); ?>
                                                        </td>
                                                        <td style="width: 10%;" align="center">

                                                            <?php
                                                            echo $this->Form->input('type', array('value' => 1, 'name' => 'data[ligner][' . $i . '][type]', 'id' => 'type' . $i, 'champ' => 'type', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));

                                                            echo $this->Form->input('sup0', array('name' => 'data[ligner][' . $i . '][sup0]', 'id' => 'sup0' . $i, 'champ' => 'sup0', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                            echo $this->Form->input('id', array('label' => '', 'value' => $res['id'], 'name' => 'data[ligner][' . $i . '][id]', 'type' => 'hidden', 'id' => 'id' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                            echo $this->Form->control('article_id', ['type' => 'hidden', 'index' => $i, 'id' => 'article_id' . $i, 'value' => $res['article_id'], 'name' => 'data[ligner][' . $i . '][article_id]', 'label' => '', 'table' => 'ligner', 'champ' => 'article_id', 'class' => 'form-control  ']);
                                                            echo $this->Form->control('article_id', ['disabled' => true, 'empty' => 'Veuillez choisir !!!', 'index' => $i, 'id' => 'article_id' . $i, 'options' => $articles, 'value' => $res['article_id'], 'name' => 'data[ligner][' . $i . '][articlee_id]', 'label' => '', 'table' => 'ligner', 'champ' => 'article_id', 'class' => 'form-control select2 getprixarticle Testdep getprixhtson ']); ?>

                                                        </td>
                                                        <td style="width: 10%;">
                                                            <?php echo $this->Form->input('description', array('label' => '', 'value' => $res['description'], 'name' => 'data[ligner][' . $i . '][description]',  'id' => 'description' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  ')); ?>


                                                        </td>

                                                        <td style="width: 5%;">
                                                            <?php echo $this->Form->control('unite_id', ['empty' => 'Veuillez choisir !!!', 'index' => $i, 'id' => 'unite_id' . $i, 'options' => $unites, 'value' => $res['unite_id'], 'name' => 'data[ligner][' . $i . '][unite_id]', 'label' => '', 'table' => 'ligner', 'champ' => 'unite_id', 'class' => 'form-control select2 ']); ?>


                                                        </td>
                                                        <td style="width: 5%;" align="center">
                                                            <?php echo $this->Form->input('qte', array('label' => '', 'value' => $res['qte'], 'name' => 'data[ligner][' . $i . '][qte]', 'type' => 'text', 'id' => 'qte' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson ')); ?>
                                                        </td>
                                                        <td style="width: 7%;" align="center">
                                                            <?php echo $this->Form->input('coutrevient', array('label' => '', 'value' => $res['coutrevient'], 'name' => 'data[ligner][' . $i . '][coutrevient]', 'type' => 'text', 'id' => 'coutrevient' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  number getprixhtson getprixarticle calculprix')); ?>
                                                        </td>
                                                        <td style="width: 5%;" align="center">
                                                            <?php echo $this->Form->input('tauxdemarge', array('label' => '', 'value' => $res['tauxdemarge'], 'name' => 'data[ligner][' . $i . '][tauxdemarge]', 'type' => 'text', 'id' => 'tauxdemarge' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson getprixarticle calculprix')); ?>
                                                        </td>
                                                        <td style="width: 5%;" align="center">
                                                            <?php echo $this->Form->input('tauxdemarque', array('label' => '', 'value' => $res['tauxdemarque'], 'name' => 'data[ligner][' . $i . '][tauxdemarque]', 'type' => 'text', 'id' => 'tauxdemarque' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson getprixarticle calculprix')); ?>
                                                        </td>

                                                        <td align="center" style="width: 7%;">
                                                            <?php if ($res['tauxdemarge'] !== null) {

                                                                echo $this->Form->input('prixht', array('label' => '', 'value' => intval($res['prixht']), 'name' => 'data[ligner][' . $i . '][prixht]', 'type' => 'text', 'id' => 'prixht' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson getprixarticle number calculprix'));
                                                            } else {
                                                                echo $this->Form->input('prixht', array('label' => '', 'value' => sprintf("%01.3f", $res['prixht']), 'name' => 'data[ligner][' . $i . '][prixht]', 'type' => 'text', 'id' => 'prixht' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson number getprixarticle calculprix'));
                                                            }
                                                            ?>

                                                        </td>
                                                        <td style="width: 5%;" align="center">
                                                            <?php echo $this->Form->input('remise', array('label' => '', 'value' => $res['remise'], 'name' => 'data[ligner][' . $i . '][remise]', 'type' => 'text', 'id' => 'remise' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson number calculprix')); ?>
                                                        </td>
                                                        <td style="width: 7%;" align="center">
                                                            <?php echo $this->Form->input('punht', array('label' => '', 'value' => $res['punht'], 'name' => 'data[ligner][' . $i . '][punht]', 'type' => 'text', 'id' => 'punht' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson number calculprix')); ?>
                                                        </td>
                                                        <td style="width: 5%;display:<?php echo ($factureclient->tvaOnOff == 1) ? 'table-cell' : 'none'; ?>" champ="tdtva" table="tablelignetva" id="tdtva<?php echo $i; ?>" name="data[ligner]['<?php echo $i; ?>'][tdtva]" index="<?php echo $i; ?>" align="center">
                                                            <?php echo $this->Form->input('tva', array('label' => '', 'value' => $res->tva, 'name' => 'data[ligner][' . $i . '][tva]', 'type' => 'text', 'id' => 'tva' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson number calculprix')); ?>
                                                        </td>
                                                        <!-- <td style="width: 5%;" align="center">
                                                            <?php echo $this->Form->input('fodec', array('label' => '', 'value' => $res['fodec'], 'name' => 'data[ligner][' . $i . '][fodec]', 'type' => 'text', 'id' => 'fodec' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson number calculprix')); ?>
                                                        </td> -->

                                                        <td style="width: 10%;" align="center">
                                                            <?php echo $this->Form->input('ttc', array('readonly', 'label' => '', 'value' => $res['ttc'], 'name' => 'data[ligner][' . $i . '][ttc]', 'type' => 'text', 'id' => 'ttc' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson '));
                                                            $totalttc = $totalttc + $res['ttc']; ?>
                                                        </td>
                                                        <td style="width:2%" align="center"><i index="<?php echo $i ?>" class="fa fa-times supLigne" style="color: #C9302C;font-size: 22px;"></td>
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
                            <?php echo __('Ligne facture client Service'); ?>
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

                                                        <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp; &thinsp; Service&thinsp; &thinsp; &thinsp; </strong></td>
                                                        <td align="center" nowrap="nowrap"><strong>Description</strong>
                                                        </td>
                                                        <td align="center" nowrap="nowrap"><strong>Unité</strong></td>
                                                        <td align="center" nowrap="nowrap"><strong>Quantite</strong>
                                                        </td>
                                                        <td align="center" nowrap="nowrap"><strong>Prix de revient</strong></td>
                                                        <td align="center" nowrap="nowrap"><strong>Taux de marge</strong></td>
                                                        <td align="center" nowrap="nowrap"><strong>Taux de marque</strong></td>

                                                        <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; PrixHT&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; </strong></td>

                                                        <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; Remise&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; </strong></td>
                                                        <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; PUNHT&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; </strong></td>
                                                        <td nowrap="nowrap" id='thtva' align="center" >
                                                            <strong>&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; Tva&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; </strong>
                                                        </td>

                                                        <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; TTC&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; </strong></td>

                                                        <td align="center" nowrap="nowrap"></td>
                                                    </tr>
                                                </thead>
                                            <tbody>




                                                <?php
                                                //debug($commande);

                                                foreach ($lignefactureclient2s as $res) :
                                                    //debug($res);
                                                    //die; //debug($ligne) 
                                                    $i++;
                                                ?>

                                                    <tr>

                                                        <td style="width: 15%;" align="center">

                                                            <?php
                                                            echo $this->Form->input('type', array('value' => 2, 'name' => 'data[ligner][' . $i . '][type]', 'id' => 'type' . $i, 'champ' => 'type', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));

                                                            echo $this->Form->input('sup0', array('name' => 'data[ligner][' . $i . '][sup0]', 'id' => 'sup0' . $i, 'champ' => 'sup0', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                            echo $this->Form->input('id', array('label' => '', 'value' => $res['id'], 'name' => 'data[ligner][' . $i . '][id]', 'type' => 'hidden', 'id' => 'id' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                            echo $this->Form->control('article_id', ['type' => 'hidden', 'index' => $i, 'id' => 'article_id' . $i, 'value' => $res['article_id'], 'name' => 'data[ligner][' . $i . '][article_id]', 'label' => '', 'table' => 'ligner', 'champ' => 'article_id', 'class' => 'form-control  ']);

                                                            echo $this->Form->control('article_id', ['disabled' => true, 'empty' => 'Veuillez choisir !!!', 'index' => $i, 'id' => 'article_id' . $i, 'options' => $articleservises, 'value' => $res['article_id'], 'name' => 'data[ligner][' . $i . '][articlee_id]', 'label' => '', 'table' => 'ligner', 'champ' => 'article_id', 'class' => 'form-control select2 getprixarticle Testdep getprixhtson ']); ?>
                                                        </td>
                                                        <td style="width: 10%;">
                                                            <?php echo $this->Form->input('description', array('label' => '', 'value' => $res['description'], 'name' => 'data[ligner][' . $i . '][description]',  'id' => 'description' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  ')); ?>


                                                        </td>

                                                        <td style="width: 5%;">
                                                            <?php echo $this->Form->control('unite_id', ['empty' => 'Veuillez choisir !!!', 'index' => $i, 'id' => 'unite_id' . $i, 'options' => $unites, 'value' => $res['unite_id'], 'name' => 'data[ligner][' . $i . '][unite_id]', 'label' => '', 'table' => 'ligner', 'champ' => 'unite_id', 'class' => 'form-control select2 ']); ?>


                                                        </td>
                                                        <td style="width: 6%;" align="center">
                                                            <?php echo $this->Form->input('qte', array('label' => '', 'value' => $res['qte'], 'name' => 'data[ligner][' . $i . '][qte]', 'type' => 'text', 'id' => 'qte' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson ')); ?>
                                                        </td>
                                                        <td style="width: 8%;" align="center">
                                                            <?php echo $this->Form->input('coutrevient', array('label' => '', 'value' => $res['coutrevient'], 'name' => 'data[ligner][' . $i . '][coutrevient]', 'type' => 'text', 'id' => 'coutrevient' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson getprixarticle calculprix')); ?>
                                                        </td>
                                                        <td style="width: 8%;" align="center">
                                                            <?php echo $this->Form->input('tauxdemarge', array('label' => '', 'value' => $res['tauxdemarge'], 'name' => 'data[ligner][' . $i . '][tauxdemarge]', 'type' => 'text', 'id' => 'tauxdemarge' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson getprixarticle calculprix')); ?>
                                                        </td>
                                                        <td style="width: 8%;" align="center">
                                                            <?php echo $this->Form->input('tauxdemarque', array('label' => '', 'value' => $res['tauxdemarque'], 'name' => 'data[ligner][' . $i . '][tauxdemarque]', 'type' => 'text', 'id' => 'tauxdemarque' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson getprixarticle calculprix')); ?>
                                                        </td>
                                                        <!-- <td style="width: 8%;" align="center"> -->
                                                        <!-- <?php echo $this->Form->input('prixht', array('label' => '', 'value' => $res['prixht'], 'name' => 'data[ligner][' . $i . '][prixht]', 'type' => 'text', 'id' => 'prixht' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson getprixarticle')); ?> -->
                                                        <!-- </td> -->
                                                        <td align="center">
                                                            <?php if ($res['tauxdemarge'] !== null) {

                                                                echo $this->Form->input('prixht', array('label' => '', 'value' => intval($res['prixht']), 'name' => 'data[ligner][' . $i . '][prixht]', 'type' => 'text', 'id' => 'prixht' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson getprixarticle'));
                                                            } else {
                                                                echo $this->Form->input('prixht', array('label' => '', 'value' => sprintf("%01.3f", $res['prixht']), 'name' => 'data[ligner][' . $i . '][prixht]', 'type' => 'text', 'id' => 'prixht' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson getprixarticle'));
                                                            }
                                                            ?>

                                                        </td>
                                                        <td style="width: 8%;" align="center">
                                                            <?php echo $this->Form->input('remise', array('label' => '', 'value' => $res['remise'], 'name' => 'data[ligner][' . $i . '][remise]', 'type' => 'text', 'id' => 'remise' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson ')); ?>
                                                        </td>
                                                        <td style="width: 8%;" align="center">
                                                            <?php echo $this->Form->input('punht', array('label' => '', 'value' => $res['punht'], 'name' => 'data[ligner][' . $i . '][punht]', 'type' => 'text', 'id' => 'punht' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson ')); ?>
                                                        </td>
                                                        <td champ="tdtva" table="tablelignetva" id="tdtva<?php echo $i; ?>" name="data[ligner]['<?php echo $i; ?>'][tdtva]" index="<?php echo $i; ?>"  align="center">
                                                            <?php echo $this->Form->input('tva', array('label' => '', 'value' => $res->tva, 'name' => 'data[ligner][' . $i . '][tva]', 'type' => 'text', 'id' => 'tva' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson ')); ?>
                                                        </td>


                                                        <td style="width: 10%;" align="center">
                                                            <?php echo $this->Form->input('ttc', array('readonly', 'label' => '', 'value' => $res['ttc'], 'name' => 'data[ligner][' . $i . '][ttc]', 'type' => 'text', 'id' => 'ttc' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson '));
                                                            $totalttc = $totalttc + $res['ttc']; ?>
                                                        </td>
                                                        <td style="width:2%" align="center"><i index="<?php echo $i ?>" class="fa fa-times supLigne" style="color: #C9302C;font-size: 22px;"></td>
                                                    </tr>

                                                <?php endforeach; ?>



                                            </tbody>
                                        </table><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" value="<?php echo $i ?>" id="indexoffreggb">


                    </section>




                </div>







                <section class="content" style="width: 99%">
                <div class="col-md-6">
                        <?php
                        
                        $totalttc=$totalttc-(($totalttc*$commandeclient->remisetotal)/100);
                        echo $this->Form->control('totalht', ['label' => 'Total HT', 'readonly' => true, 'value' => sprintf("%01.3f", $factureclient->totalht)]); ?>
                    </div>
                    <div id="divtva" class="col-xs-3" style="display:<?php echo ($factureclient->tvaOnOff == 1) ? 'block' : 'none'; ?>">
                        <?php echo $this->Form->control('totaltva', ['label' => 'Total TVA', 'readonly' => true, 'value' => sprintf("%01.3f", $factureclient->totaltva)]); ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $this->Form->control('totalmarque', ['readonly' => true, 'label' => 'Total Taux de Marque', 'id' => 'totalmarque', 'value' => sprintf("%01.3f", $factureclient->totalmarque)]); ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $this->Form->control('totalmarge', ['readonly' => true, 'label' => 'Total Taux de Marge', 'value' => sprintf("%01.3f", $factureclient->totalmarge), 'id' => 'totalmarge']); ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $this->Form->control('totalremise', ['label' => 'Total remise', 'readonly' => true, 'value' => sprintf("%01.3f", $factureclient->totalremise)]); ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $this->Form->control('totalttc', ['label' => 'Total TTC', 'readonly' => true, 'value' => sprintf("%01.3f", $factureclient->totalttc)]) ?>
                        <?php
                        echo $this->Form->control('totalttcdl', ['label' => 'Total TTC en Dinar', 'readonly' => true, 'id' => 'totalttcdl', 'type' => 'hidden', 'value' => sprintf("%01.3f", $factureclient->totalttcdl), 'table' => 'tablecommandeclient', 'label' => 'Total TTC', 'readonly' => true]); ?>

                    </div>
                    <!-- <div class="row">
                        <div class="row">
                            <div style=" position: static;">
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('brut', ['id' => 'brutHT', 'value' => sprintf("%01.3f", $factureclient->totalht + $factureclient->totalremise), 'readonly' => 'readonly', 'label' => 'Brut HT', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('totalremise', ['id' => 'totalremise', 'readonly' => 'readonly', 'value' => $factureclient->totalremise, 'label' => 'Total remise', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4 pull-right">
                                    <?php echo $this->Form->control('netapayer', ['id' => 'netapayer', 'value' => sprintf("%01.3f", $factureclient->totalttc + $timbre * 1000), 'readonly' => 'readonly', 'label' => 'Net à payé', 'name', 'required' => 'off']); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div style=" position: static;">
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('total', ['value' => $factureclient->totalht, 'id' => 'total', 'readonly' => 'readonly', 'label' => 'Net HT', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('fod', ['value' => $factureclient->totalfodec, 'id' => 'fod', 'readonly' => 'readonly', 'label' => 'Taux de marque', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4">
                                    <?php
                                    
                                    $totalttc=$totalttc-(($totalttc*$factureclient->remisetotal)/100)-$factureclient->remisetotalval;

                                    echo $this->Form->control('totalttc', ['value' => $totalttc, 'id' => 'totalttccommande', 'readonly' => 'readonly', 'label' => 'TTC', 'name', 'required' => 'off']); ?>
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





                    </div> -->


                </section>







                <div align="center">
                    <button type="submit" class="pull-right btn btn-success btn-sm Testqtestock chauff" id="boutonlivraison" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>

                </div>
                <?php echo $this->Form->end(); ?>

            </div>



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



                    //    alert(response['ligne']["Code"]);
                    //   qtestockx = response['qtestockx'];
                    //alert('hh');

                    //   $('#pourcentageescompte' + index).val(response['remise']);

                    /// $('#qteStock' + index).val(qtestockx);
                    //$('#prix' + index).val(response['ligne']["Prix_LastInput"]);
                    // $('#ttc' + index).val(response['ligne']["PTTC"]);
                    //   //$('#exofodec').val(response['ligne']["FODEC"]);
                    // $('#prixht' + index).val(response['ligne']["PHT"]);

                    // $('#tva' + index).val(response['ligne']["tva"]["valeur"]);
                    //$('#tpe' + index).val(response['ligne']["TXTPE"]);
                    // $('#fodec' + index).val(response['ligne']["fodec"]);
                    // $('#remisearticle' + index).val(response['ligne']["remise"]);

                    // pourcentageescompte = $('#pourcentageescompte' + i).val(); //alert(pourcentageescompte);
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
                    //   alert("hh");
                    // alert("tva recup?r? apr?s if");
                    // alert(netht);

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
            //   alert(montantescompte+"esc");
            $('#escompte').val(Number(montantescompte).toFixed(3));
        }
        //
        //
        //                maxpourcentage = response.tab[numbers.length - 1]['pourcentage'];
        //                maxqte = response.tab[numbers.length - 1]['qtemax'];




        //                    brutHT=totalescom+remisecommande;
        //             
        //                    baseHT=totalescom+fod+tpecmd;
        // ttcfinal=baseHT+tvacomd;
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








<!--    -->



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