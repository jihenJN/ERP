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
<?php echo $this->Html->script('function'); ?>

<?php echo $this->Html->script('js_vieww_projet'); ?>
<?php echo $this->fetch('script'); ?>
<section class="content-header">
    <h1>
        Ajout Facture
        <small>
            <?php echo __(''); ?>
        </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'vieww/' . $project_id]); ?>"><i class="fa fa-reply"></i>
                <?php echo __('Retour'); ?>
            </a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
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
                                    <?php echo $this->Form->control('numero', ['readonly' => 'readonly', 'value' => $mm, 'label' => 'Numero', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group input select required">
                                        <label class="control-label" for="depot-id">Clients</label>
                                        <input type="hidden" name="client_id" value="<?php echo $client_id; ?>">
                                        <select name="client_id" id="client" class="form-control select2 control-label" disabled>
                                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                            <?php foreach ($clients as $id => $client) { ?>
                                                <option <?php if ($client_id == $client->id) { ?> selected="selected" <?php } ?> value="<?php echo $client->id; ?>">
                                                    <?php echo $client->Code . ' ' . $client->Raison_Sociale; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                            <div class="row">
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('date', ['readonly' => true, "value" => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime(date('Y-m-d H:i:s'))))]); ?>
                                </div>
                                <div hidden class="col-xs-6">
                                    <input type="hidden" name="depot_id" value="<?php echo $depot_id; ?>">
                                    <?php echo $this->Form->control('depot_id', ['disabled' => true, 'value' => $depot_id, 'options' => $depots, 'empty' => 'Veuillez choisir !!', 'required' => 'off', 'label' => 'Dépot', 'class' => 'form-control select2 control-label']); ?>
                                </div>

                                <div class="col-xs-6">
                                    <input type="hidden" name="projet_id" value="<?php echo $projet_id ?>">
                                    <?php echo $this->Form->control('projet_id', ['disabled' => true, 'value' => $projet_id, 'options' => $projets, 'empty' => 'Veuillez choisir !!', 'required' => 'off', 'label' => 'Projets', 'class' => 'form-control select2 control-label']); ?>
                                </div>
                                <div class="col-xs-6">
                                    <?php

                                    //debug( $commandeclient);
                                    echo $this->Form->control('remisetotal', ['value' => $commandeclient->remisetotal, 'id' => 'remisetotal', 'label' => 'Remise relative sure le total par pourcentage', 'class' => 'form-control getprixhtson number']); ?>
                                </div>
                                <div class="col-xs-6">
                                    <?php

                                    //debug( $commandeclient);
                                    echo $this->Form->control('remisetotalval', [ 'id' => 'remisetotalval', 'label' => 'Remise relative sure le total par valeur', 'class' => 'form-control getprixhtson number']); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-2">
                                    <?php echo $this->Form->control('incoterm_id', ['value' => $commandeclient->incoterm_id, 'options' => $incoterms, 'empty' => 'Veuillez choisir !!', 'id' => 'incoterm_id', 'class' => 'form-control select2']); ?>
                                </div>
                                <div class="col-xs-2">
                                    <?php echo $this->Form->control('location_incoterms', ['empty' => 'Veuillez choisir !!', 'id' => 'location_incoterms', 'class' => 'form-control']); ?>
                                </div>
                                <div class="col-xs-2">
                                    <?php echo $this->Form->control('options_incotermtotalpdf', ['value' => $commandeclient->incotermpdf_id, 'options' => $incoterms, 'label' => 'Incoterm du total en pdf', 'empty' => 'Veuillez choisir !!', 'id' => 'options_incotermtotalpdf', 'class' => 'form-control select2']); ?>
                                </div>
                                <div class="col-xs-6">
                                    <?php $options_istotaltransportdetaille = [0 => 'Non', 1 => 'Oui'];
                                    echo $this->Form->control('options_istotaltransportdetaille', ['value' => $commandeclient->detaittransport, 'options' => $options_istotaltransportdetaille, 'label' => 'Détail des montants de transport en pdf ', 'empty' => 'Veuillez choisir !!', 'id' => 'options_incotermtotalpdf', 'class' => 'form-control select2']); ?>
                                </div>
                                <div class="col-xs-12">
                                    <?php echo $this->Form->control('options_indicationenpdf', ['type' => 'textarea', 'label' => 'Transports incoterm entre le port d embarquement et le port de destination', 'empty' => 'Veuillez choisir !!', 'id' => 'options_indicationenpdf', 'class' => 'form-control']); ?>
                                </div>
                                <div class="col-xs-6">
                            <div height="60px">
                                <label class="control-label" for="unipxte-id">TVA:</label>
                                OUI <input type="radio"  id="1" id="OUI" name='tvaOnOff' class="toggleEditcomclient" <?php if ($commandeclient->tvaOnOff == 1)
                                                                                                                            echo "checked"; ?>>
                                NON <input type="radio"  value="0" id="NON" class="toggleEditcomclient" name='tvaOnOff' <?php if ($commandeclient->tvaOnOff == 0)
                                                                                                                            echo "checked"; ?>>
                            </div>
                        </div>
                            </div>
                        </div>

                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                            <div class="row">
                            </div>
                            <br>
                            <br>
                            <div class="col-md-12" id="blocclient" style="display: true;">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            <?php echo __('Info de client'); ?>
                                        </h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-xs-6">
                                            <?php
                                            echo $this->Form->input('name', array('value' => $clientc->Raison_Sociale, 'readonly' => 'readonly', 'label' => 'Raison Sociale', 'id' => 'name', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                                        <td nowrap="nowrap" id='thtva' align="center" style="display:<?php echo ($commandeclient->tvaOnOff == 1) ? 'table-cell' : 'none'; ?>">
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
                                                    $i = 0;
                                                    $totalttc = 0;
                                                    foreach ($lignebonlivraisons as $res) : // debug($res);
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
                                                                <?php echo $this->Form->input('coutrevient', array('label' => '', 'value' => $res['coutrevient'], 'name' => 'data[ligner][' . $i . '][coutrevient]', 'type' => 'text', 'id' => 'coutrevient' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  number   calculprix')); ?>
                                                            </td>
                                                            <td style="width: 5%;" align="center">
                                                                <?php echo $this->Form->input('tauxdemarge', array('label' => '', 'value' => $res['tauxdemarge'], 'name' => 'data[ligner][' . $i . '][tauxdemarge]', 'type' => 'text', 'id' => 'tauxdemarge' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number   calculprix')); ?>
                                                            </td>
                                                            <td style="width: 5%;" align="center">
                                                                <?php echo $this->Form->input('tauxdemarque', array('label' => '', 'value' => $res['tauxdemarque'], 'name' => 'data[ligner][' . $i . '][tauxdemarque]', 'type' => 'text', 'id' => 'tauxdemarque' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number   calculprix')); ?>
                                                            </td>

                                                            <td align="center" style="width: 7%;">
                                                                <?php if ($res['tauxdemarge'] !== null) {

                                                                    echo $this->Form->input('prixht', array('label' => '', 'value' => intval($res['prixht']), 'name' => 'data[ligner][' . $i . '][prixht]', 'type' => 'text', 'id' => 'prixht' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson getprixarticle number '));
                                                                } else {
                                                                    echo $this->Form->input('prixht', array('label' => '', 'value' => sprintf("%01.3f", $res['prixht']), 'name' => 'data[ligner][' . $i . '][prixht]', 'type' => 'text', 'id' => 'prixht' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson number getprixarticle '));
                                                                }
                                                                ?>

                                                            </td>
                                                            <td style="width: 5%;" align="center">
                                                                <?php echo $this->Form->input('remise', array('label' => '', 'value' => $res['remise'], 'name' => 'data[ligner][' . $i . '][remise]', 'type' => 'text', 'id' => 'remise' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson number ')); ?>
                                                            </td>
                                                            <td style="width: 7%;" align="center">
                                                                <?php echo $this->Form->input('punht', array('label' => '', 'value' => $res['punht'], 'name' => 'data[ligner][' . $i . '][punht]', 'type' => 'text', 'id' => 'punht' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson number ')); ?>
                                                            </td>
                                                            <td champ="tdtva" table="tablelignetva" id="tdtva<?php echo $i; ?>" name="data[ligner]['<?php echo $i; ?>'][tdtva]" index="<?php echo $i; ?>" style=" width: 5%;display:<?php echo ($commandeclient->tvaOnOff == 1) ? 'table-cell' : 'none'; ?>" align="center">
                                                                <?php echo $this->Form->input('tva', array('label' => '', 'value' => $res->tva, 'name' => 'data[ligner][' . $i . '][tva]', 'type' => 'text', 'id' => 'tva' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson number ')); ?>
                                                            </td>
                                                            <!-- <td style="width: 5%;" align="center">
                                                                <?php echo $this->Form->input('fodec', array('label' => '', 'value' => $res['fodec'], 'name' => 'data[ligner][' . $i . '][fodec]', 'type' => 'text', 'id' => 'fodec' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson number ')); ?>
                                                            </td> -->

                                                            <td style="width: 10%;" align="center">
                                                                <?php echo $this->Form->input('ttc', array('readonly', 'label' => '', 'value' => $res['ttc'], 'name' => 'data[ligner][' . $i . '][ttc]', 'type' => 'text', 'id' => 'ttc' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson '));
                                                                $totalttc = $totalttc + $res['ttc']; ?>
                                                            </td>
                                                            <td style="width:2%" align="center"><i index="<?php echo $i ?>" class="fa fa-times supLigne" style="color: #C9302C;font-size: 22px;"></td>
                                                        </tr>
                                                        <?php //endif; 
                                                        ?>
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
                                                        <td nowrap="nowrap" id='thtva' align="center" style="display:<?php echo ($commandeclient->tvaOnOff == 1) ? 'table-cell' : 'none'; ?>">
                                                            <strong>&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; Tva&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; </strong>
                                                        </td>

                                                        <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; TTC&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; </strong></td>

                                                        <td align="center" nowrap="nowrap"></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($lignebonlivraison2s as $res) : // debug($res); 
                                                        $i++;
                                                    ?>
                                                        <tr>

                                                            <td style="width: 15%;" align="center">

                                                                <?php
                                                                echo $this->Form->input('type', array('value' => 2, 'name' => 'data[ligner][' . $i . '][type]', 'id' => 'type' . $i, 'champ' => 'type', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));

                                                                echo $this->Form->input('sup0', array('name' => 'data[ligner][' . $i . '][sup0]', 'id' => 'sup0' . $i, 'champ' => 'sup0', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                                echo $this->Form->control('article_id', ['type' => 'hidden', 'index' => $i, 'id' => 'article_id' . $i, 'value' => $res['article_id'], 'name' => 'data[ligner][' . $i . '][article_id]', 'label' => '', 'table' => 'ligner', 'champ' => 'article_id', 'class' => 'form-control  ']);

                                                                echo $this->Form->control('article_id', ['disabled' => true, 'empty' => 'Veuillez choisir !!!', 'index' => $i, 'id' => 'article_id' . $i, 'options' => $articleservises, 'value' => $res['article_id'], 'name' => 'data[ligner][' . $i . '][articlee_id]', 'label' => '', 'table' => 'ligner', 'champ' => 'article_id', 'class' => 'form-control select2 getprixarticle Testdep getprixhtson ']); ?>
                                                            </td>
                                                            <td style="width: 15%;">
                                                                <?php echo $this->Form->input('description', array('label' => '', 'value' => $res['description'], 'name' => 'data[ligner][' . $i . '][description]',  'id' => 'description' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  ')); ?>


                                                            </td>

                                                            <td style="width: 8%;">
                                                                <?php echo $this->Form->control('unite_id', ['empty' => 'Veuillez choisir !!!', 'index' => $i, 'id' => 'unite_id' . $i, 'options' => $unites, 'value' => $res['unite_id'], 'name' => 'data[ligner][' . $i . '][unite_id]', 'label' => '', 'table' => 'ligner', 'champ' => 'unite_id', 'class' => 'form-control select2 ']); ?>


                                                            </td>
                                                            <td style="width: 6%;" align="center">
                                                                <?php echo $this->Form->input('qte', array('label' => '', 'value' => $res['qte'], 'name' => 'data[ligner][' . $i . '][qte]', 'type' => 'text', 'id' => 'qte' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson ')); ?>
                                                            </td>
                                                            <td style="width: 8%;" align="center">
                                                                <?php echo $this->Form->input('coutrevient', array('label' => '', 'value' => $res['coutrevient'], 'name' => 'data[ligner][' . $i . '][coutrevient]', 'type' => 'text', 'id' => 'coutrevient' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number   calculprix')); ?>
                                                            </td>
                                                            <td style="width: 8%;" align="center">
                                                                <?php echo $this->Form->input('tauxdemarge', array('label' => '', 'value' => $res['tauxdemarge'], 'name' => 'data[ligner][' . $i . '][tauxdemarge]', 'type' => 'text', 'id' => 'tauxdemarge' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number   calculprix')); ?>
                                                            </td>
                                                            <td style="width: 8%;" align="center">
                                                                <?php echo $this->Form->input('tauxdemarque', array('label' => '', 'value' => $res['tauxdemarque'], 'name' => 'data[ligner][' . $i . '][tauxdemarque]', 'type' => 'text', 'id' => 'tauxdemarque' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number   calculprix')); ?>
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
                                                            <td champ="tdtva" table="tablelignetva" id="tdtva<?php echo $i; ?>" name="data[ligner]['<?php echo $i; ?>'][tdtva]" index="<?php echo $i; ?>" style=" display:<?php echo ($commandeclient->tvaOnOff == 1) ? 'table-cell' : 'none'; ?>" align="center">
                                                                <?php echo $this->Form->input('tva', array('label' => '', 'value' => $res->tva, 'name' => 'data[ligner][' . $i . '][tva]', 'type' => 'text', 'id' => 'tva' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson ')); ?>
                                                            </td>


                                                            <td style="width: 8%;" align="center">
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

                        <input type="hidden" value="<?php echo $i ?>" id="indexoffreggb">


                    </div>





                    <!-- 
                    <section class="content" style="width: 99%">
                        <div class="row">
                            <div class="row">
                                <div style=" position: static;">
                                    <div class="col-xs-4">
                                        <?php echo $this->Form->control('brut', ['id' => 'brutHT', 'value' => sprintf("%01.3f", $bonlivraison->totalht + $bonlivraison->totalremise), 'readonly' => 'readonly', 'label' => 'Brut HT', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4">
                                        <?php echo $this->Form->control('totalremise', ['id' => 'totalremise', 'readonly' => 'readonly', 'value' => $bonlivraison->totalremise, 'label' => 'Total remise', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4 pull-right">
                                        <?php echo $this->Form->control('netapayer', ['id' => 'netapayer', 'value' => sprintf("%01.3f", $bonlivraison->totalttc + $timbre), 'readonly' => 'readonly', 'label' => 'Net à payé', 'name', 'required' => 'off']); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div style=" position: static;">
                                    <div class="col-xs-4">
                                        <?php echo $this->Form->control('total', ['value' => $bonlivraison->totalht, 'id' => 'total', 'readonly' => 'readonly', 'label' => 'Net HT', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4">
                                        <?php echo $this->Form->control('fod', ['value' => $bonlivraison->totalfodec, 'id' => 'fod', 'readonly' => 'readonly', 'label' => 'Total Taux de marque', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4">
                                        <?php echo $this->Form->control('totalttc', ['value' => sprintf("%01.3f", $bonlivraison->totalttc), 'id' => 'totalttccommande', 'readonly' => 'readonly', 'label' => 'TTC', 'name', 'required' => 'off']); ?>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div style=" position: static;">
                                    <div class="col-xs-4">
                                        <?php echo $this->Form->control('base', ['id' => 'baseHT', 'value' => sprintf("%01.3f", $bonlivraison->totalht + $bonlivraison->totalfodec), 'readonly' => 'readonly', 'label' => 'Base HT', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4">
                                        <?php echo $this->Form->control('tvacommande', ['value' => $bonlivraison->totaltva, 'id' => 'tvacommande', 'readonly' => 'readonly', 'label' => 'TVA', 'name', 'required' => 'off']); ?>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xs-5">
                                <?php echo $this->Form->control('remise', ['value' => $bonlivraison->client->remise, 'type' => 'hidden', 'id' => 'remise', 'readonly' => 'readonly', 'label' => '', 'name', 'required' => 'off']); ?>




                            </div>
                            <div class="col-xs-5">


                                <?php echo $this->Form->control('comptant', ['type' => 'hidden', 'id' => 'comptant', 'readonly' => 'readonly', 'label' => '', 'name', 'required' => 'off']); ?>




                                <?php echo $this->Form->control('fodeccommande', ['type' => 'hidden', 'id' => 'fodeccommande', 'readonly' => 'readonly', 'label' => '', 'name', 'required' => 'off']); ?>

                                <?php echo $this->Form->control('basetva', ['type' => 'hidden', 'id' => 'basetva', 'readonly' => 'readonly', 'label' => '', 'name', 'required' => 'off']); ?>


                            </div>
                        </div>
                    </section>
 -->
                    <div class="col-md-6">
                        <?php
                        
                        $totalttc=$totalttc-(($totalttc*$commandeclient->remisetotal)/100);
                        echo $this->Form->control('totalht', ['label' => 'Total HT', 'readonly' => true, 'value' => sprintf("%01." . $commandeclient->nbfergule . "f", $totalttc)]); ?>
                    </div>
                    <div id="divtva" class="col-xs-3" style="display:<?php echo ($commandeclient->tvaOnOff == 1) ? 'block' : 'none'; ?>">
                        <?php echo $this->Form->control('totaltva', ['label' => 'Total TVA', 'readonly' => true, 'value' => sprintf("%01." . $commandeclient->nbfergule . "f", $commandeclient->totaltva)]); ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $this->Form->control('totalmarque', ['readonly' => true, 'label' => 'Total Taux de Marque', 'id' => 'totalmarque', 'value' => sprintf("%01." . $commandeclient->nbfergule . "f", $commandeclient->totalfodec)]); ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $this->Form->control('totalmarge', ['readonly' => true, 'label' => 'Total Taux de Marge', 'value' => sprintf("%01." . $commandeclient->nbfergule . "f", $commandeclient->totalmarge), 'id' => 'totalmarge']); ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $this->Form->control('totalremise', ['label' => 'Total remise', 'readonly' => true, 'value' => sprintf("%01." . $commandeclient->nbfergule . "f", $commandeclient->totalremise)]); ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $this->Form->control('totalttc', ['label' => 'Total TTC', 'readonly' => true, 'value' => sprintf("%01." . $commandeclient->nbfergule . "f", $totalttc)]) ?>
                        <?php
                        echo $this->Form->control('totalttcdl', ['label' => 'Total TTC en Dinar', 'readonly' => true, 'id' => 'totalttcdl', 'type' => 'hidden', 'value' => sprintf("%01." . $commandeclient->nbfergule . "f", $commandeclient->totalttcdl), 'table' => 'tablecommandeclient', 'label' => 'Total TTC', 'readonly' => true]); ?>

                    </div>



                    <div align="center">
                        <button type="submit" class="pull-right btn btn-success btn-sm Testqtestock chauff" id="boutonlivraison" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
                    </div>
                    <?php echo $this->Form->end(); ?>

                </div>



            </div>
        </div>
</section>




<!-- Ajout ajax recupération select -->
<script type="text/javascript">
    $(function() {
        var filterFloat = function(value) {
            if (/^(\-|\+)?([0-9]+(\.[0-9]+)?|Infinity)$/
                .test(value))
                return Number(value);
            return NaN;
        }
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
          } else if (MG &&  Number(prixrevient)!=0) {
            prixMG = Number(prixrevient) + (Number(MG) * Number(prixrevient) / 100)
            prixMG = Math.floor(prixMG); // Conversion en entier
            $("#prixht" + i).val(prixMG);
            //$("#punht" + i).val(prixMG);
            margel = Number(prixMG) * Number(MG / 100);
            totalmarge = (Number(totalmarge) + Number(margel)).toFixed(3);
          } else if (MQ &&  Number(prixrevient)!=0) {
            prixMQ = Number(prixrevient) + (Number(MQ) * Number(prixrevient) / 100); //alert(prixMQ)
           // alert(Number(prixMQ).toFixed(3));
            $("#prixht" + i).val(Number(prixMQ).toFixed(3));
            marquel = Number(prixMQ) * Number(MQ / 100);
            totalmarque = (Number(totalfodec) + Number(marquel)).toFixed(3);
            // $("#punht" + i).val(prixMG);
          } else {
            if ( Number(prixrevient)!=0) {
              $("#prixht" + i).val(Number(prixrevient).toFixed(3));
            }
           
          }
        }
      }
      $("#totalmarge").val(Number(totalmarge).toFixed(3));
      $("#totalmarque").val(Number(totalmarque).toFixed(3));
      getprixhtsonia();

    });
  });
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
                    valnot = Number(data.not);
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
        setInterval(function() {
            $(".calculjs").trigger("keyup").trigger("change").trigger("mouseover");
        }, 1000);

        $(".calculjs").on("keyup change mouseover", function() {
            calculhtmelek();
        });

        function calculhtmelek() {
            // alert();
            index = $("#index").val();
            //alert(index)
            exontva = $("#exontva").val() || 0;
            taux = $("#taux").val();
            exonfodec = $("#exonfodec").val() || 0;
            totalremise = 0;
            totalht = 0;
            totalfodec = 0;
            totaltva = 0;
            totalttc = 0;
            for (i = 0; i <= index; i++) {
                sup = $("#sup0" + i).val() || 0;

                if (Number(sup) != 1) {
                    fodecl = 0;
                    ht = 0;
                    tval = 0;
                    ttcl = 0;
                    if ($("#qteliv" + i).val()) {
                        qte = $("#qteliv" + i).val() || 0; //alert(qte);
                    } else {
                        qte = $("#qte" + i).val() || 0;
                        //alert(qte);
                    }
                    prix = $("#prix" + i).val() || 0; //alert(prix);
                    remise = $("#remise" + i).val() || 0; //alert(remise);
                    //alert(remise);

                    fodec = $("#fodec" + i).val() || 0;

                    //tva = $('#tva' + i).val() || 0;
                    // alert(tva)
                    //alert(fodec)
                    remisel = Number(qte) * Number(prix) * Number(remise / 100);
                    totalremise = Number(totalremise) + Number(remisel);
                    ht = Number(qte) * Number(prix) - Number(remisel);
                    $("#ht" + i).val(Number(ht).toFixed(3));
                    // alert(ht);
                    totalht = Number(totalht) + Number(ht);
                    fodecl = Number(ht) * Number(fodec / 100);
                    totalfodec = Number(totalfodec) + Number(fodecl);
                    htfodec = Number(ht) + Number(fodecl);
                    var elt = document.querySelector("#tva_id" + i); //alert(elt)
                    /* tvai = Number($('#tva_id' + i).val()); 
                     //alert(tvai)
                     tva=elt.options[tvai-1].label; */
                    tva = Number($("#tva" + i).val()) || 0;
                    /// alert(tva)
                    if (exonfodec == "0") $("#fodec" + i).val();
                    else $("#fodec" + i).val(0);
                    if (exontva == "0") $("#tva" + i).val();
                    else $("#tva" + i).val(3);
                    tval = Number(htfodec) * Number(tva / 100);
                    totaltva = Number(totaltva) + Number(tval);
                    // alert(htfodec);
                    // alert(tval);
                    ttcl = Number(htfodec) + Number(tval);
                    // alert(ttcl);
                    // $("#ttc" + i).val(Number(ttcl).toFixed(3));
                    totalttc = Number(totalttc) + Number(ttcl);
                    // alert(totalttc);
                    // alert(totaltva);
                    // alert(totalttc);
                    totaldevise = Number(totalttc) / Number(taux);
                }
            }

            $("#remise").val(Number(totalremise).toFixed(3));
            $("#ht").val(Number(totalht).toFixed(3));
            $("#fodec").val(Number(totalfodec).toFixed(3));
            $("#tva").val(Number(totaltva).toFixed(3));
            $("#totttc").val(Number(totalttc).toFixed(3));
            $("#totaldevise").val(Number(totaldevise).toFixed(3));
        }

        $('#client').on('change', function() {
            //alert('hello');
            id = $('#client').val();
            // alert(id)
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Bonlivraisons', 'action' => 'getadresselivraison']) ?>",
                dataType: "json",
                data: {
                    idfam: id,

                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function(data) {
                    // alert(data.ligne.Fodec);
                    $('#adresselivraison-id').html(data.select);
                    // uniform_select('adresse');
                    $('#exofodec').val(data.ligne.Fodec);
                    $('#exotva').val(data.ligne.R_TVA);




                }

            })
        });
    });

    $(function() {
        $('.pourcentescompte').on('blur', function() {

            index = $(this).attr('index');
            indexattr = $(this).attr('index');
            ind = Number($('#index').val());
            // $('#remisearticle' + index).val(0);
            //            if (ind != index) {
            //                indexpre = Number(index) + 1;
            //                // alert(indexpre+"indexpre");
            //                if ($('#articlee' + indexpre).val() != "") {
            //                    $('#sup' + indexpre).val('1');
            //                    $('#trart' + indexpre).hide();
            //                    //         $(this).parent().parent().hide();
            //                }
            //            }
            i = $(this).attr('index');
            // alert(index);

            qte = $('#qte' + index).val();
            formule = $('#formule').val();

            //alert(article_id);

            //alert(qte);
            test = 0;
            if (qte.match(/^(?:[1-9]\d*|0)?(?:\.\d+)?$/)) {
                test = 1;
            }
            if (test == 0) {
                $("#qte" + index).val("");
            }

            //alert(depot_id);
            //            $.ajax({
            //                method: "GET",
            //                type: "GET",
            //                async: false,
            //
            //                url: "<?= $this->Url->build(['controller' => 'Commandes', 'action' => 'getescompte']) ?>",
            //                dataType: "JSON",
            //                data: {
            //                    qte: qte,
            //
            //                },
            //                success: function(response) {
            //                    // alert(response);die;
            //                    //  alert(response.tab[0]['qtemax']);
            //                    numbers = response.tab;

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




            escompte = 0;
            nb = 0;
            index = $('#index').val();
            //                    for (j = 0; j <= index; j++) {
            //                        // alert(j);
            //                        sup = $('#sup' + j).val(); // alert(sup);
            //
            //                        nb++;
            //
            //                        if (Number(sup) != 1) {
            //                            tpe = $('#tpe' + j).val() || 0;
            //                            tva = Number($('#tva' + j).val()) || 0; // alert(tva);
            //                            fodec = $('#fodec' + j).val() || 0; //alert(tpe);        
            //                            fodecclientexo = $('#fodecclientexo').val();
            //                            tpeclientexo = $('#tpeclientexo').val();
            //                            tvaclientexo = $('#tvaclientexo').val();
            //                            qte = ($('#qte' + j).val()) * 1; //alert(qte);
            //                            poids = ($('#poids' + j).val()) * 1; //alert(qte);
            //                            totalpoids = Number(qte) * Number(poids);
            //                            totalpoidsfin += Number(totalpoids);
            //                            prix = $('#prix' + j).val(); // alert(prix);
            //                            qteStock = ($('#qteStock' + j).val()) * 1; //alert(qteStock);
            //
            //                            remisearticle = $('#remisearticle' + j).val() || 0; //alert(remisearticle);
            //
            //
            //                            netbrut = (Number(qte) * Number(prix)); // alert(netbrut+"montcal");
            //                            //   alert(netbrut);
            //                            totalremise = Number(remisearticle); //alert(totalremise+'totalremise')
            //                            montremise = Number(netbrut) * Number(totalremise) / 100;
            //                            montcal = Number(netbrut) - Number(montremise); //alert(montcal+"montcal")
            //                            totbrut += Number(prix) * Number(qte); //alert(totbrut+'totbrut')
            //
            //                           // calculbcr( indexattr);
            //
            //                        }
            //                    }


            calculbc(index);
            //}
            // })
        });

        $('.articleidbl1').on('change', function() {
            index = $(this).attr('index');
            // alert(inde);
            article_id = $('#article_id' + index).val();
            // alert(article_id);
            datecreation = $('#date').val();
            depot_id = $('#depot-id').val();
            //alert(depot_id);
            $.ajax({
                method: "GET",
                type: "GET",
                url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'getquantite']) ?>",
                dataType: "JSON",
                data: {
                    idarticle: article_id,
                    idadepot: depot_id,
                },
                success: function(response) {
                    //  alert(response['ligne']["Prix_LastInput"]);
                    qtestockx = response['qtestockx'];
                    // alert(qtestockx);

                    $('#qteStock' + index).val(qtestockx);
                    $('#prix' + index).val(response['ligne']["Prix_LastInput"]);
                    $('#ttc' + index).val(response['ligne']["PTTC"]);
                    //$('#exofodec').val(response['ligne']["FODEC"]);
                    $('#prixht' + index).val(response['ligne']["PHT"]);

                    $('#tva' + index).val(response['ligne']["tva"]["Taux"]);

                }
            })
        });

        function calculbc(index) { //alert(index+'index')
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
            articleid = $('#article_id' + index).val(); //alert(articleid)
            qte = $('#qte' + index).val();

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
            //
            //                //alert(numbers);



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
                        getescompte(total);
                        valeurescompte = $('#valeurescompte').val(); //alert(valeurescompte+"valeurescompte");
                        montantescompte = total * Number(valeurescompte) / 100; //alert(montantescompte);
                        //  $('#valeurescompte').val(montantescompte);
                        //  alert(montantescompte+"esc");
                        //    $('#escompte').val(Number(montantescompte).toFixed(3));
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
                        //  $('#escompte').val(Number(montantescompte).toFixed(3));
                        montantescompteligne = Number(totaltotal) * Number(valeurescompte) / 100;
                        totalmontantescompteligne += Number(montantescompteligne);
                        montantescomptelignee = Number(totaltotal) - Number(montantescompteligne);
                        totalmontantescomptelignee += Number(montantescomptelignee);
                        montantescompte += Number(montantescompteligne);
                        $('#escompte' + j).val(Number(montantescomptelignee).toFixed(3));
                    }
                    //  alert(valeurescompte+"valeurescompte");
                    //  prixavecformulclient(prix, j, formule, fodec, tva, tpe, valeurescompte, remiseclient, remisearticle)
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
                        montanttpe = motanttotal * tpe / 100; //alert(montanttpe);
                        motanttotaltpe += montanttpe;
                        $('#tpecommandeclient' + j).val(Number(montanttpe));
                        tpecommandeclient = Number(motanttotal) + Number(montanttpe); //alert(tpecommandeclient);
                        totaltpecommandeclient += Number(tpecommandeclient);

                    } else {
                        montanttpe = 0 //alert(montanttpe);
                        motanttotaltpe += montanttpe;
                        $('#tpecommandeclient' + j).val(Number(montanttpe));
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
                getescompte(total);
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




            //
            //            }
            //        })
        }
    });
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
<?php $this->end(); ?>