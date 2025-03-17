

<?php

// Configuration de la mise en page
$this->layout = 'AdminLTE.print';

?>

<?php echo $this->Html->script('AdminLTE./bower_components/summernote/summernote.min', ['block' => 'script']); ?>
<?= $this->Html->css('AdminLTE./bower_components/bootstrap/dist/css/bootstrap.min.css') ?>
<?php echo $this->Html->css('select2'); ?>


<style>
    body {
        font-size: 10px;
    }

    table {
        font-size: 13px;
    }

    .page-break {
        page-break-before: always;
    }

    @media print {

        /* Masquer l'en-tête et le pied de page sur chaque page */
        .content {
            display: block !important;
            /* Afficher normalement */
            page-break-inside: avoid;
            /* Éviter les sauts de page à l'intérieur du contenu */
        }

        .page-break {
            page-break-before: always;
            /* Forcer un saut de page avant chaque section */
        }

        .table-container {
        max-height: 500px; 
        overflow-y: auto; 
         }
    }
</style>
<section class="content">

    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="col-md-12">
                        <div class="col-xs-6">
                            <?php echo $this->Html->image('logoSMBM.png', array('width' => '250px', 'height' => '110px')); ?>
                        </div>
                        <div class="col-xs-6">
                            <h1 class="box-title" style="color:#3C386E!important;margin-top:5%;"><strong>Consultation Formulaire Consultation Client</strong></h1>

                        </div>
                    </div>
                    <!-- <h3 class="box-title">Formulaire Consultation Client</h3> -->
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?php echo $this->Form->create(null, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
                <div class="box box-primary">
                    <section class="content-header">
                        <h1 class="box-title"><strong><?php echo __('Civilité'); ?></strong></h1>
                        <br>
                    </section>
                    <div class="row">
                        <div class="row">


                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('Code', ['value' => $clients->Code, 'readonly', 'label' => 'Code Client', 'name', 'required' => 'off']); ?>
                                </div>

                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('responsable', ['value' => '', 'label' => 'responsable']) ?>
                                </div>
                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('Adresse', ['value' => $clients->Adresse, 'label' => 'Adresse']) ?>
                                </div>
                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('fax', ['value' => $clients->Fax, 'label' => 'Fax']) ?>
                                </div>
                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('Raison_Sociale', ['value' => $clients->Raison_Sociale, 'label' => 'Client', 'name', 'required' => 'off']); ?>
                                </div>

                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('mail', ['value' => $clients->Email, 'label' => 'Mail']) ?>
                                </div>
                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('tel', ['value' => $clients->Tel, 'label' => 'Tél']) ?>
                                </div>
                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('portable', ['value' => $clients->Contact, 'label' => 'Portable']) ?>
                                </div>
                            </div>
                        </div>


                        <section class="content-header">
                            <div class="box box-primary">
                                <h3 class="box-title"><strong><?php echo __('Demande Client'); ?></strong></h3><br>
                                <div class="row">


                                    <div class="row" style="gap: 20px; display: flex; flex-wrap: wrap;">
                                        <div style="margin: 0 auto; margin-left: 20px; margin-right: 20px; position: static; width: 100%;">
                                            <div class="col-xs-3" style="margin-bottom: 20px;">
                                                <?php echo $this->Form->control('dateconsulation', ['label' => 'Date Consultation', 'value' => $demandeclient->dateconsulation, 'type' => 'datetime', 'name', 'required' => 'off']); ?>
                                            </div>

                                            <div class="col-xs-3" style="margin-bottom: 20px;">
                                                <?php echo $this->Form->control('delaivoulu', ['label' => 'Délai voulu Conception', 'value' => $demandeclient->delaivoulu, 'type' => 'datetime']); ?>
                                            </div>

                                            <div class="col-xs-3" style="margin-bottom: 20px;">
                                                <?php echo $this->Form->control('delaireponse', ['type' => 'datetime', 'value' => $demandeclient->delaireponse, 'label' => 'Délai de Réponse']); ?>
                                            </div>

                                            <div class="col-xs-3" style="margin-bottom: 20px;">
                                                <?php echo $this->Form->control('delaiapprov', ['type' => 'datetime', 'value' => $demandeclient->delaiapprov, 'label' => 'Délai d`approvisionnement']); ?>
                                            </div>



                                            <div class="col-xs-12">
                                                <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                                                    <?php foreach ($typedemandes as $id => $name): ?>
                                                        <label style="display: flex; align-items: center; gap: 5px;">
                                                            <input
                                                                type="checkbox"
                                                                class="typedemande-checkbox"
                                                                name="typedemandes[]"
                                                                value="<?= $id; ?>"
                                                                <?= in_array($id, $listetypedemandeIds) ? 'checked' : ''; ?>>
                                                            <?= h($name); ?>
                                                        </label>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </section>
                        <section class="content" style="width: 99%">
                            <div class="row">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                     
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive ls-table">
                                            <table border="1px" class="table table-bordered table-striped table-bottomless" id="addtable">

                                                <thead>
                                                    <tr>


                                                        <td align="center" style="width: 12%; font-size: 16px;">
                                                            <strong>N° boite</strong>
                                                        </td>

                                                        <td align="center" style="width: 14%;font-size: 16px;"><strong>Famille </strong></td>
                                                        <td align="center" style="width: 14%;font-size: 16px;"><strong>Sous-Famille </strong></td>
                                                        <td align="center" style="width: 15%;font-size: 16px;"><strong>Réf produit</strong></td>
                                                        <td align="center" style="width: 8%;font-size: 16px;"><strong>Qte</strong></td>

                                                        <td align="center" style="width: 10%;font-size: 16px;"><strong>Unité</strong></td>

                                                        <td align="center" style="width: 20%;font-size: 16px;"><strong>Exigence</strong></td>

                                                      
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($lignedemandeclients as $i => $res) :

                                                    ?>
                                                        <tr>
                                                            <td align="center">

                                                                <?php echo $this->Form->input('numboite', array('label' => '', 'value' => $res->numboite, 'name' => 'data[ligner][' . $i . '][numboite]', 'type' => 'text', 'id' => 'numboite' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>

                                                            </td>
                                                            <td align="center">
                                                                <div>
                                                                  
                                                                    <select  name="<?php echo "data[ligner][" . $i . "][famille_id]" ?>" id="<?php echo 'famille_id' . $i ?>" table="ligner" index="<?php echo $i ?>" champ="famille_id" class="form-control familles">
                                                                        <option disabled="true" disabled>Veuillez choisir !!</option>
                                                                        <?php foreach ($familles as $id => $fam) {
                                                                        ?>
                                                                            <option <?php if ($res->famille_id == $fam->id) { ?> selected="selected" <?php } ?> value="<?php echo $fam->id; ?>"><?php echo $fam->Nom ?></option>
                                                                        <?php } ?>
                                                                    </select>

                                                                </div>
                                                            </td>
                                                            <td align="center">
                                                                <div   champ="divunite"  index="<?= $i ?>" id="divsous<?= $i ?>">
                                                                  
                                                                    <select  name="<?php echo "data[ligner][" . $i . "][sousfamille1_id]" ?>" id="<?php echo 'sousfamille1_id' . $i ?>"  table="ligner" index="<?php echo $i ?>" champ="sousfamille1_id" class="form-control   single">
                                                                        <option disabled="true" disabled>Veuillez choisir !!</option>
                                                                        <?php foreach ($sousfamille1s as $id => $sous) {
                                                                        ?>
                                                                            <option <?php if ($res->sousfamille1_id == $sous->id) { ?> selected="selected" <?php } ?> value="<?php echo $sous->id; ?>"><?php echo $sous->name ?></option>
                                                                        <?php } ?>
                                                                    </select>

                                                                </div>
                                                            </td>
                                                            <td align="center">
                                                                <?php echo $this->Form->input('sup', array('name' => "data[ligner][" . $i . "][sup]", 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => '', 'class' => 'form-control', 'type' => 'hidden')); ?>
                                                                <?php
                                                                echo $this->Form->input('id', array(
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
                                                                ));
                                                                ?>
                                                                <div champ="divart"  index="<?= $i ?>" id="divart<?=  $i ?>">
                                                                  
                                                                    <select  name="<?php echo "data[ligner][" . $i . "][article_id]" ?>" id="<?php echo 'article_id' . $i ?>" table="ligner" index="<?php echo $i ?>" champ="article_id" class="form-control articleidbl1 Testdep single">
                                                                        <option disabled="true" disabled>Veuillez choisir !!</option>
                                                                        <?php foreach ($articles as $id => $article) {
                                                                        ?>
                                                                            <option <?php if ($res->article_id == $article->id) { ?> selected="selected" <?php } ?> value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                                                                        <?php } ?>
                                                                    </select>

                                                                </div>



                                                            </td>
                                                            <td align="center">

                                                                <?php echo $this->Form->input('qte', array('label' => '', 'value' => $res->qte, 'name' => 'data[ligner][' . $i . '][qte]', 'type' => 'number', 'id' => 'qte' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculligne qte ', 'index')); ?>

                                                            </td>
                                                            <td align="center">
                                                                <div  champ="divunite"  index="<?= $i ?>" id="divunite<?= $i ?>">
                                                                  
                                                                    <select readonly name="<?php echo "data[ligner][" . $i . "][unite_id]" ?>" id="<?php echo 'unite_id' . $i ?>" style="pointer-events:none" table="ligner" index="<?php echo $i ?>" champ="unite_id" class="form-control articleidbl1 Testdep single">
                                                                        <option disabled="true" disabled>Veuillez choisir !!</option>
                                                                        <?php foreach ($unites as $id => $unite) {
                                                                        ?>
                                                                            <option <?php if ($res->unite_id == $unite->id) { ?> selected="selected" <?php } ?> value="<?php echo $unite->id; ?>"><?php echo $unite->name ?></option>
                                                                        <?php } ?>
                                                                    </select>

                                                                </div>



                                                            </td>



                                                            <td align="center">
                                                                <?php echo $this->Form->input('exigence', array('readonly', 'label' => '', 'value' => $res->exigence, 'name' => 'data[ligner][' . $i . '][exigence]', 'type' => 'text', 'id' => 'exigence' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  ', 'index')); ?>
                                                            </td>

                                                            <!-- <td align="center">
                                                            
                                                                <i index="<?php echo $i ?>" class="fa fa-times supLigne0ch" style="color: #C9302C;font-size: 22px;">
                                                            </td> -->

                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    <tr class="tr afef" style="display: none;">
                                                        <td align="center" table="ligner">
                                                            <input type="hidden" id="" champ="sup" name="" table="ligner" index="" class="form-control ">

                                                            <input table="ligner" champ="numboite" type="text" class="form-control " index>
                                                        </td>
                                                        <td align="center">
                                                            <select table="ligner" index champ="famille_id" class="form-control js-example-responsive   familles">
                                                                <option value="" selected="selected" disabled>Veuillez
                                                                    choisir !!</option>
                                                                <?php foreach ($familles as $id => $fam) {
                                                                ?>
                                                                    <option value="<?php echo $fam->id; ?>">
                                                                        <?php echo $fam->Nom ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>

                                                        </td>
                                                        <td align="center">
                                                            <div champ="divsous" id="divsous<?= $index ?>">
                                                                <select table="ligner" index champ="sousfamille1_id" class="form-control js-example-responsive   ">
                                                                    <option value="" selected="selected" disabled>Veuillez
                                                                        choisir !!</option>
                                                                    <?php foreach ($sousfamille1s as $id => $sous) {
                                                                    ?>
                                                                        <option value="<?php echo $sous->id; ?>">
                                                                            <?php echo $sou->name ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>

                                                        </td>
                                                        <td align="center" table="ligner">
                                                            <div champ="divart" id="divart<?= $index ?>">
                                                                <select table="ligner" index champ="article_id" class="form-control js-example-responsive   ">
                                                                    <option value="" selected="selected" disabled>Veuillez
                                                                        choisir !!</option>
                                                                    <?php foreach ($articles as $id => $article) {
                                                                    ?>
                                                                        <option value="<?php echo $article->id; ?>">
                                                                            <?php echo $article->Code . ' ' . $article->Dsignation ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>

                                                        </td>
                                                        <td align="center" table="ligner">
                                                            <input table="ligner" champ="qte" type="text" class="form-control " index>
                                                        </td>
                                                        <td align="center" table="ligner">
                                                            <div champ="divunite" id="divunite<?= $index ?>">

                                                                <select readonly table="ligner" index champ="unite_id" class=" form-control ">
                                                                    <option value="" selected="selected" disabled>Veuillez
                                                                        choisir !!</option>
                                                                    <?php //debug($unitearticles);
                                                                    foreach ($unites as $id => $unite) {
                                                                    ?>
                                                                        <option value="<?php echo $unite->id; ?>">
                                                                            <?php echo $unite->name ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </td>


                                                        <td align="center" table="ligner">
                                                            <input table="ligner" champ="exigence" type="text" class="form-control " index>
                                                        </td>
                                                        <td align="center" table="ligner">
                                                            <i id="" class="fa fa-times getmontant pourcentescompte supLigne0ch" style="color: #c9302c;font-size: 22px;" table="ligner" name=""></i>
                                                            <input type='hidden' table="ligner" champ="suptest" class="form-control" index name='' id="">
                                                        </td>
                                                    </tr>
                                                    <input type="hidden" value="<?php echo $i ?>" id="index">
                                                </tbody>

                                            </table>
                                            <br />
                                           
                                        </div>


                                    </div>
                                </div>
                            </div>


                        </section>

                    </div>
                </div>

                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</section>

