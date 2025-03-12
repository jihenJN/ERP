<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fournisseur $fournisseur
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->script('hechem'); ?>
<?php echo $this->Html->css('select2'); ?>


<?php echo $this->Html->script('ajouterlignematrice'); ?>

<?php echo $this->fetch('script'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Modification article
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index/' . $type]); ?>"><i class="fa fa-reply"></i>
                <?php echo __('Retour'); ?></a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box ">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?php
                echo $this->Form->create($article, ['role' => 'form', 'type' => 'file', 'onkeypress' => "return event.keyCode!=13"]);
                
                ?>



                <div class="row" style="padding:3px">



                    <div class="col-xs-6">
                        <div class="form-group input text required">
                            <?php echo $this->Form->control('typearticle_id', ['label' => 'Type Article', 'empty' => 'Veuillez choisir !!', 'options' => $typearticles, 'class' => 'form-control select2 control-label ', 'required' => false, 'id' => 'typearticle']); ?>
                        </div>

                    </div>

                    <?php
                    $style = '';
                    $readonly = '';
                    $select2 = 'select2';

                    //  debug($article->typearticle_id);
                    if ($article->typearticle_id == 1 || $article->typearticle_id == 2) {

                        $style = 'pointer-events:none';
                        $readonly = 'readonly';
                        $select2 = '';
                    } ?>
                    <div class="col-xs-6">
                        <div id="divselect" class="form-group input text required">
                            <?php echo $this->Form->control('article_id', ['style' => $style, 'readonly' => $readonly, 'label' => 'Article Parent', 'empty' => 'Veuillez choisir !!',  'class' => 'form-control ' . $select2 . ' control-label ', 'required' => false, 'id' => 'artid']); ?>
                        </div>

                    </div>
                    <?php
                    $stylefamille = '';
                    $readonlyfamille = '';
                    $select2famille = 'select2';

                    //  debug($article->typearticle_id);
                    if ($article->typearticle_id == 2 || $article->typearticle_id == 3  || $article->typearticle_id == 4) {

                        $stylefamille = 'pointer-events:none';
                        $readonlyfamille = 'readonly';
                        $select2famille = '';
                    } ?>

                    <div class="col-xs-6">
                        <div class="form-group input text required">
                            <?php echo $this->Form->control('famille_id', ['style' => $stylefamille, 'readonly' => $readonlyfamille, 'empty' => 'Veuillez choisir !!', 'options' => $familles, 'class' => 'form-control ' . $select2famille . ' control-label famille famille1', 'required' => false, 'id' => 'salma']); ?>

                        </div>

                    </div>
                    <div class="col-xs-6" hidden>
                        <div class="form-group input text required">

                            <?php echo $this->Form->control('Poids', ['class' => 'form-control  control-label', 'label' => 'Poids net']); ?>
                        </div>

                    </div>

                    <div class="col-xs-6">
                        <div class="form-group input text required" id="divsous">
                            <?php echo $this->Form->control('sousfamille1', ['style' => $stylefamille, 'readonly' => $readonlyfamille, 'value' => $article->sousfamille1_id, 'id' => 'sous', 'name' => 'sousfamille1_id', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control ' . $select2famille . '  control-label sousfamille1', 'required' => false, 'label' => 'Sous Famille']); ?>


                        </div>

                    </div>














                    <div class="col-xs-6">
                        <div class="form-group input text">

                            <label>Code</label>
                            <?php //echo $this->Form->control('Code', ['label' => 'Code', 'required' => 'off', 'id' => 'code', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'number', 'name' => 'Code']); 
                            ?>

                            <input value="<?php echo $article->Code ?>" readonly name="Code" id="code"
                                class="form-control">
                        </div>
                    </div>




                    <div class="col-xs-6">
                        <div class="form-group input text required">

                            <?php echo $this->Form->control('Dsignation', ['label' => 'Designation', 'id' => 'Dsignation']); ?>
                        </div>

                    </div>

                    <div class="col-xs-6">
                        <div class="form-group input text required">

                            <?php echo $this->Form->control('unite_id', ['options' => $unites, 'value' => 1, 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 control-label', 'label' => 'Unite article']); ?>
                        </div>
                    </div>


                    <div class="col-xs-6" hidden>
                        <div class="form-group input text required" id="divsoussous">
                            <?php echo $this->Form->control('sousfamille2s', ['id' => 'soussous', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 control-label', 'label' => 'Sous sous famille', 'required' => false]); ?>
                        </div>
                    </div>

                    <div class="col-xs-6" hidden>
                        <div class="form-group input text required">

                            <?php echo $this->Form->control('contenance', ['class' => 'form-control  control-label', 'label' => 'Contenance']); ?>
                        </div>
                    </div>





















                    <div class=" col-xs-6" hidden>
                        <div class="form-group input text required">

                            <?php echo $this->Form->control('unitearticle_id', ['label' => 'Unite article', 'options' => $unitearticles, 'empty' => 'Veuillez choisir !!', 'class' => ' form-control select2 control-label  ', 'id' => 'u', 'required' => false]); ?>
                        </div>
                    </div>













                    <?php echo $this->Form->control('codeabr', ['type' => 'hidden', 'label' => '', 'value' => str_replace(' ', '', $val), 'id' => 'codeabr', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ']); ?>


                    <div hidden class="col-xs-3" id="codeabr">
                        <label>Code a barre</label>


                        <div class="input-group">
                            <span name="codepaysproducteur" class="input-group-addon"
                                style="width:10%"><?php echo $val ?></span>
                            <input name="codearticle" readonly type="text" id="codearticle" class="form-control"
                                style="width:50%;">

                        </div>

                    </div>



                    <!-- <div class="col-xs-6">
                        <div class="form-group input text required">

                            <?php echo $this->Form->control('codeancienne', ['label' => 'Code Ancienne', 'id' => 'codeancienne']); ?>
                        </div>

                    </div> -->
                    <!-- <div class="col-xs-6" hidden>
                        <div class="form-group input text required">

                            <?php echo $this->Form->control('refBureauEtude', ['label' => 'Ref bureau d\'étude', 'required' => 'off', 'id' => 'refBureauEtude', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'text', 'name' => 'refBureauEtude']);
                            ?>
                        </div>
                    </div> -->









                    <div class="col-xs-6">
                        <div class="form-group input text required">

                            <?php echo $this->Form->control('prixachat', ['label' => 'Prix Achat HT', 'placeholder' => "0.000", 'step' => "0.001", 'id' => 'prixachat']); ?>

                        </div>
                    </div>
                    <div class="col-xs-6">

                        <div class="form-group input text required">


                            <label> Prix Vente HT</label>


                            <input placeholder="0.000" step="0.001" value="<?php echo ($article->Prix_LastInput); ?>"
                                type="number" class="form-control calculprixarticlefinal" name='Prix_LastInput'
                                id="Prix_LastInput">

                        </div>


                    </div>















                    <div class=" col-xs-3 form-group input text required">
                        <?php echo $this->Form->control('tva_id', ['label' => 'Categorie Tva', 'options' => $tvas, 'value' => $article->tva_id, 'empty' => 'Veuillez choisir !!', 'class' => ' form-control select2 control-label tva calculprixarticle', 'id' => 'tvaselect', 'required' => 'off']); ?>
                    </div>
                    <div class="  col-xs-3">

                        <div class="form-group input text required">

                            <?php echo $this->Form->control('tvaa', ['readonly' => 'readonly', 'name' => 'tva', 'id' => 'tva', 'value' => $article->tva->valeur, 'class' => 'form-control  control-label', 'label' => "Valeur TVA:"]); ?>

                        </div>
                    </div>

                    <div class="col-xs-6">
                        <div class="form-group input text required">

                            <?php echo $this->Form->control('remise', ['class' => 'form-control  control-label', 'label' => "Remise %:"]); ?>
                        </div>
                    </div>

                    <div hidden class=" col-xs-6 pull-right form-group input text required">
                        <?php echo $this->Form->control('ml', ['label' => 'mètre linéaire', 'class' => ' form-control  control-label ', 'id' => 'ml', 'required' => 'off']); ?>
                    </div>




















                    <div class="row">

                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">







                            <div class="col-xs-6">
                                <div class="form-group input text required">

                                    <label> Image </label>
                                    <input type="file" name="image_file" class="form-control" id="ArticleImage">
                                </div>
                            </div>






                        </div>

                    </div>








                    <div class="row">
                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                            <div class="col-xs-6" hidden style="display:true;" id="frotation">
                                <?php echo $this->Form->control('famillerotation_id', ['empty' => 'Veuillez choisir !!', 'options' => $famillerotations, 'class' => 'form-control select2 control-label', 'label' => "Famille rotation:"]); ?>

                            </div>

                            <div class="col-xs-6" style="display:none;" id="device">
                                <?php echo $this->Form->control('devise', ['name' => 'devise_id', 'empty' => 'Veuillez choisir !!', 'options' => $devices, 'class' => 'form-control select2 control-label', 'label' => "Devise:"]); ?>
                            </div>
                            <br><br><br>
                            <div style="margin-top:20px" class="col-xs-8" hidden>
                                <label class="control-label" for="unipxte-id" style="margin-right: 20px"> Destine a la
                                    vente :</label>

                                <input type="checkbox" id="vente" name="vente" value="0">
                            </div>
                            <div style="margin-top:20px" id="mobile" class="col-xs-8">
                                <!-- <label class="control-label" for="unipxte-id" style="margin-right: 20px"> Mobile </label>

                                <input type="checkbox" id="mobilee" name="mobile" value="1"> -->
                            </div>
                            <div
                                style="width:90%; margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <label class="control-label" for="unipxte-id" style="margin-right: 20px"> Etat :</label>

                                Activ&eacute; <input type="radio" name="etat" checked value="0" id="active" class=""
                                    style="margin-right: 20px">
                                D&eacute;sactiv&eacute; <input type="radio" name="etat" value="1" id="desactive"
                                    class="">






                                <br>





                                <label hidden class="control-label" for="unipxte-id" style="margin-right: 20px">Fodec
                                    :</label>

                                <input hidden type="radio" name="fodec" value="<?php echo $fodec ?>" id="OUI"
                                    class="calculprixarticle" style="margin-right: 20px">
                                <input hidden type="radio" name="fodec" value="0" id="NON" class="calculprixarticle"
                                    checked>






                                <br>


                                <?php //echo $tpe 
                                ?>
                                <label hidden class="control-label" for="unipxte-id" style="margin-right: 20px">Tpe
                                    (%):</label>

                                <input hidden type="radio" name="TXTPE" value="0" id="OUItpe" class="calculprixarticle"
                                    style="margin-right: 20px">
                                <input hidden type="radio" name="TXTPE" value="0" id="NONtpe" class="calculprixarticle">
                            </div>
                        </div>




                        <div style="display:flex;">

                            <div style="width:80%;margin-left: 30%; margin-right: 20px; position: static; ">
                                <div align="center">
                                    <div class="form-group input number">
                                        <label style="font-size:30px;color:rgb(255, 0, 0);margin-right:20px"> Prix TTC
                                            :</label>

                                        <input
                                            style="color:rgb(255, 0, 0);height: 80px;font-size:50px;width:50%;text-align:center"
                                            type="number" step="any" value="<?php echo $article->prixttc ?>"
                                            name="prixttc" id="prixttc">

                                    </div>
                                </div>


                            </div>

                        </div>



                        <br>

                    </div>


                    <br>




                    <div class="row" style="text-align: center;margin-top:20px">

                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">


                            <div class="col-xs-6">

                                <?php echo $this->Html->image('imgart/' . $article->image, ['style' => 'max-width:100px;height:100px;']); ?>
                            </div>





                        </div>
                    </div>




                    <div id="fiche" class="col-md-12 ">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <?php echo __('Fiche Article'); ?>
                                </h3>
                                <a class="btn btn-primary ajouterlignematriceee " table='addtablea' index='index'
                                    tr="tra" style="
                                       float: right; 
                                       position: relative;
                                       top: -25px;
                                       "><i class="fa fa-plus-circle"></i> </a>
                            </div>
                            <div class="panel-body">
                                <table class="table table-bordered table-striped table-bottomless" id="addtablea"
                                    style="width:100%" align="center">
                                    <thead>
                                        <tr bgcolor="#EDEDED">
                                            <td width="" align="center">Composant1</td>
                                            <td width="" align="center">Qte</td>
                                            <td align="center">Unite</td>
                                            <!-- <td align="center" id='tdcomp'>Coefficient</td> -->

                                            <td width="" align="center"></td>



                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr champ="tra" class="tra" style="display:none;">

                                            <td align="left">
                                                <?php echo $this->Form->input('sup', array('name' => '', 'id' => '', 'champ' => 'sup', 'table' => 'Ofsfligne', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                                                <div style="margin-top:10px">
                                                    <?php echo $this->Form->control('article_id', array('options' => $articlescomp, 'empty' => 'Veuillez choisir', 'label' => '', 'id' => 'article_id', 'name' => '', 'table' => 'Ofsfligne', 'champ' => 'article_id', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => '')); ?>
                                            </td>

                                            <td align="center">
                                                <?php
                                                echo $this->Form->input('qte', array('id' => 'qte', 'label' => '', 'name' => '', 'table' => 'Ofsfligne', 'champ' => 'qte', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control comp'));
                                                echo $this->Form->input('qt', array('type' => 'hidden', 'id' => 'qt', 'label' => '', 'name' => '', 'table' => 'Ofsfligne', 'champ' => 'qt', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control comp'));
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $this->Form->control('unite_id', array('empty' => 'Veuillez choisir', 'label' => '', 'id' => 'unite', 'name' => '', 'table' => 'Ofsfligne', 'champ' => 'unite', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>

                                            </td>
                                            <!-- <td align="center" hidden champ='tdcomp' index='' table='Ofsfligne'>
                                                <?php
                                                echo $this->Form->input('coeff', array('id' => 'coeff', 'label' => '', 'name' => '', 'table' => 'Ofsfligne', 'champ' => 'coeff', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                ?>
                                            </td> -->
                                            <td align="center">
                                                <i index="" class="fa fa-times supor"
                                                    style="color: #c9302c;font-size: 22px;">
                                            </td>
                                        </tr>



                                        <tr class="traa" champ='traa' style="display:none">
                                            <td width='30%'></td>
                                            <td champ="afef" class="afef" colspan="3" id="" index="">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title">
                                                            <?php echo __('Composant2'); ?>
                                                        </h3>
                                                        <a class="btn btn-primary ajouterligne1 " tabletype='addtableaa'
                                                            indexlignetype='indexa' trtype="traaa" style="
                                                           float: right; 
                                                           position: relative;
                                                           top: -25px;
                                                           "><i class="fa fa-plus-circle"></i> </a>
                                                    </div>
                                                    <div class="panel-body">
                                                        <table
                                                            class="table table-bordered table-striped table-bottomless"
                                                            index="" indexligne='indexa' champ="addtableaa" id=""
                                                            style="width:100%" align="center">
                                                            <thead>
                                                                <tr bgcolor="#EDEDED">
                                                                    <td align="center">Composant</td>
                                                                    <td align="center">Qte</td>
                                                                    <td align="center">Unite</td>
                                                                    <!-- <td align="center" id="tdcompp" hidden>
                                                                        Coefficient</td> -->

                                                                    <td align="center"></td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <tr class="traaa" style="display:none;" id="traaa"
                                                                    champ='traaa' index="">
                                                                    <td>
                                                                        <?php echo $this->Form->input(
                                                                            'supp2',
                                                                            array(
                                                                                'name' => '',
                                                                                'type' => 'hidden',
                                                                                'label' => '',
                                                                                'indexligne' => '',
                                                                                'index' => '',
                                                                                'table' => 'Ofsfligne',
                                                                                'tableligne' => 'Phaseofsf',
                                                                                'champ' => 'supp2',
                                                                                'id' => '',
                                                                                'div' => 'form-group',
                                                                                'between' => '<div class="col-sm-12">',
                                                                                'after' => '</div>',
                                                                                'class' => 'form-control'
                                                                            )
                                                                        ); ?>

                                                                        <div style="margin-top:5px">
                                                                            <?php echo $this->Form->control('article_id', array('options' => $articlescomp, 'name' => '', 'label' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'article_idt', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => '', 'empty' => 'Veuillez Choisir !!', "style" => "width:100% ; height:32px"));
                                                                            ?>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $this->Form->input('qte', array('name' => '', 'label' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'qte', 'id' => 'qte', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $this->Form->control('unite_id', array('name' => '', 'label' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'unite_idt', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => '', 'empty' => 'Veuillez Choisir !!', 'class' => 'form-control'));
                                                                        ?>
                                                                    </td>
                                                                    <!-- <td hidden champ='tdcompp' index='' indexligne='' table='Ofsfligne' tableligne='Phaseofsf'>
                                                                        <?php echo $this->Form->input('coeff', array('name' => '', 'label' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'coeff', 'id' => 'coeff', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                        ?>
                                                                    </td> -->
                                                                    <td align="center">
                                                                        <i indexligne="" index=""
                                                                            class="fa fa-times supor2"
                                                                            style="color: #c9302c;font-size: 22px;">
                                                                    </td>
                                                                </tr>

                                                                <tr class="traaligne" index="" champ='traaligne'
                                                                    style="display:none">
                                                                    <td width='30%'></td>
                                                                    <td champ="afefligne" class="afefligne" colspan="3"
                                                                        id="" index="">
                                                                        <div class="panel panel-default">
                                                                            <div class="panel-heading">
                                                                                <h3 class="panel-title">
                                                                                    <?php echo __('Composant3'); ?>
                                                                                </h3>
                                                                                <a class="btn btn-primary ajouterligne1ligne "
                                                                                    index="" indexligne=""
                                                                                    tabletypeligne='addtableaaligne'
                                                                                    indexligneligne='indexaligne'
                                                                                    indexlignetypeligne='indexaligne'
                                                                                    trtypeligne="traaaligne" style="
                                                                                   float: right; 
                                                                                   position: relative;
                                                                                   top: -25px;
                                                                                   "><i
                                                                                        class="fa fa-plus-circle"></i></a>
                                                                            </div>
                                                                            <div class="panel-body">
                                                                                <table
                                                                                    class="table table-bordered table-striped table-bottomless"
                                                                                    index=""
                                                                                    indexligneligne='indexaligne'
                                                                                    champ="addtableaaligne" id=""
                                                                                    style="width:100%" align="center">
                                                                                    <thead>
                                                                                        <tr bgcolor="#EDEDED">
                                                                                            <td align="center">
                                                                                                Composant</td>
                                                                                            <td align="center">Qte
                                                                                            </td>
                                                                                            <td align="center">Unite
                                                                                            </td>
                                                                                            <!-- <td align="center" hidden>
                                                                                                Coefficient
                                                                                            </td> -->

                                                                                            <td align="center"></td>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>

                                                                                        <tr class="traaaligne"
                                                                                            style="display:none;" id=""
                                                                                            champ='traaaligne' index="">
                                                                                            <td>
                                                                                                <?php
                                                                                                echo $this->Form->input('supp3', array('name' => '', 'type' => 'hidden', 'label' => '', 'indexligneligne' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'supp3', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control',));


                                                                                                echo $this->Form->control('article_id', array('options' => $articlescomp, 'name' => '', 'label' => '', 'indexligneligne' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'article_idd', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => '', 'empty' => 'Veuillez Choisir !!', "style" => "width:100% ; height:32px"));
                                                                                                ?>
                                                                                            </td>
                                                                                            <td>
                                                                                                <?php echo $this->Form->input('qte', array('name' => '', 'label' => '', 'indexligneligne' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'qte', 'id' => 'qte', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                                                ?>
                                                                                            </td>
                                                                                            <td>
                                                                                                <?php echo $this->Form->control('unite_id', array('name' => '', 'label' => '', 'indexligneligne' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'unite_idd', 'id' => 'unite_idd', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control', 'empty' => 'Veuillez Choisir !!'));
                                                                                                ?>
                                                                                            </td>
                                                                                            <!-- <td hidden>
                                                                                                <?php echo $this->Form->input('coeff', array('name' => '', 'label' => '', 'indexligneligne' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'coeff', 'id' => 'coeff', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                                                ?>
                                                                                            </td> -->
                                                                                            <td align="center">
                                                                                                <i indexligneligne=""
                                                                                                    indexligne=""
                                                                                                    index=""
                                                                                                    class="fa fa-times supor3"
                                                                                                    style="color: #c9302c;font-size: 22px;">
                                                                                            </td>

                                                                                        </tr>


                                                                                    </tbody>
                                                                                </table>
                                                                                <input type="hidden" value="0" class=""
                                                                                    id="" champ="indexaligne" />
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <input type="hidden" value="-1" class="" id="" champ="indexa" />
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                         debug($dat);
                                        //    echo 
                                        $i = -1;
                                        foreach ($dat as $fech) {
                                            $i++;
                                            //debug($fech);
                                        ?>
                                        <tr>

                                            <td align="left">
                                                <?php
                                                    echo $this->Form->input('sup', array('name' => 'data[Ofsfligne][' . $i . '][sup]', 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'Ofsfligne', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'type' => 'hidden', 'after' => '</div>', 'class' => 'form-control'));
                                                    echo $this->Form->control('article_id', array('options' => $articlescomp, 'value' => $fech['article_id'], 'style' => 'width:250px', 'label' => '', 'id' => 'article_id' . $i, 'label' => '', 'name' => 'data[Ofsfligne][' . $i . '][article_id]', 'table' => 'Ofsfligne', 'champ' => 'article_id', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  select2', 'empty' => 'Veuillez choisir'));
                                                    ?>
                                            </td>
                                            <td align="center">
                                                <?php
                                                    echo $this->Form->input('qte', array('value' => $fech['qte'], 'id' => 'qte' . $i, 'label' => '', 'name' => 'data[Ofsfligne][' . $i . '][qte]', 'table' => 'Ofsfligne', 'champ' => 'qte', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control comp'));
                                                    ?>
                                            </td>

                                            <td>
                                                <select name="<?php echo "data[Ofsfligne][" . $i . "][unite_id]" ?>"
                                                    width="200px" id="<?php echo 'unite_id' . $i ?>" style="width:200px"
                                                    table="ligner" index="<?php echo $i ?>" champ="unite_id"
                                                    class="js-example-responsive select2 ">
                                                    <option value="" selected="selected">Veuillez choisir
                                                        !!</option>

                                                    <?php foreach ($unit as $u) {
                                                        ?>
                                                    <option <?php if ($fech['unite_id'] == $u->id) { ?>
                                                        selected="selected" <?php } ?> value="<?php echo $u->id; ?>">
                                                        <?php echo $u->name ?>
                                                    </option>
                                                    <?php }


                                                        ?>
                                                </select>
                                            </td>
                                            <!-- <td align="center" <?php if (empty($fech['Ligne'])) { ?> hidden <?php } ?> id="tdcomp<?php echo $i ?>" index="<?php echo $i ?>" champ="tdcomp" table="Ofsfligne" name="data[Ofsfligne][<?php echo $i ?>][tdcomp]">
                                                    <?php
                                                    echo $this->Form->input('coeff', array('value' => $fech['coeff'], 'id' => 'coeff' . $i, 'label' => '', 'name' => 'data[Ofsfligne][' . $i . '][coeff]', 'table' => 'Ofsfligne', 'champ' => 'coeff', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                    ?>
                                                </td> -->
                                            <td align="center"><i index="<?php echo $i; ?>" class="fa fa-times supor"
                                                    style="color: #c9302c;font-size: 22px;"></td>

                                        </tr>

                                        <tr index="<?php echo $i; ?>" class="tr" align="centre">
                                            <td width='30%'></td>
                                            <td champ="afef" class="afef" id="afef<?php echo $i; ?>" colspan="3"
                                                index="<?php echo $i; ?>">
                                                <div class="panel panel-default" width="50%">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title">
                                                            <?php echo __('Composant'); ?>
                                                        </h3>
                                                        <a class="btn btn-primary ajouterligne1 "
                                                            table='addtableaa<?php echo $i; ?>'
                                                            index='<?php echo $i; ?>'
                                                            indexligne='indexa<?php echo $i; ?>'
                                                            tr="traa<?php echo $i; ?>" style="
                                                                   float: right; 
                                                                   position: relative;
                                                                   top: -25px;
                                                                   "><i class="fa fa-plus-circle"></i></a>
                                                    </div>
                                                    <div class="panel-body">
                                                        <table
                                                            class="table table-bordered table-striped table-bottomless"
                                                            id="addtableaa<?php echo $i; ?>" style="width:100%"
                                                            align="center">
                                                            <thead>
                                                                <tr bgcolor="#EDEDED">
                                                                    <td align="center">Composant</td>
                                                                    <td align="center">Qte</td>
                                                                    <td align="center">Unite</td>
                                                                    <!-- <td align="center" hidden id='tdcompp'>
                                                                            Coefficient</td> -->

                                                                    <td></td>
                                                                </tr>
                                                            <tbody>
                                                                <tr class="traa<?php echo $i; ?>" style="display:none;"
                                                                    d="traa<?php echo $i; ?>">
                                                                    <td>
                                                                        <?php
                                                                            echo $this->Form->input('supp2', array('label' => '', 'type' => 'hidden', 'div' => 'form-group', 'name' => '', 'indexligne' => '0', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'index' => $i, 'id' => 'supp', 'champ' => 'supp2', 'indextype' => '', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                            echo $this->Form->control('article_id', array('options' => $articlescomp, 'name' => '', 'label' => '', 'indexligne' => '0', 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'article_idt', 'id' => 'article_idt', 'indextype' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'empty' => 'Veuillez Choisir !!'));
                                                                            ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                            echo $this->Form->input('qte', array('name' => '', 'label' => '', 'indexligne' => '0', 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'qte', 'id' => 'qte', 'indextype' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control '));
                                                                            ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $this->Form->control('unite_id', array('name' => '', 'label' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'unite_idt', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => '', 'empty' => 'Veuillez Choisir !!', 'class' => 'form-control'));
                                                                            ?>
                                                                    </td>

                                                                    <!-- <td hidden champ='tdcompp' index='' indexligne='' table='Ofsfligne' tableligne='Phaseofsf'>
                                                                            <?php
                                                                            echo $this->Form->input('coeff', array('name' => '', 'label' => '', 'indexligne' => '0', 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'coeff', 'id' => 'coeff', 'indextype' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control '));
                                                                            ?>
                                                                        </td> -->
                                                                    <td align="center">
                                                                        <i indexligne="0" index="<?php echo $i; ?>"
                                                                            class="fa fa-times supor2"
                                                                            style="color: #c9302c;font-size: 22px;">
                                                                    </td>


                                                                </tr>
                                                                <tr class="traaligne" index="" champ='traaligne'
                                                                    style="display:none">
                                                                    <td width='30%'></td>
                                                                    <td champ="afefligne" class="afefligne" colspan="3"
                                                                        id="" index="">
                                                                        <div class="panel panel-default">
                                                                            <div class="panel-heading">
                                                                                <h3 class="panel-title">
                                                                                    <?php echo __('Composant'); ?>
                                                                                </h3>
                                                                                <a class="btn btn-primary ajouterligne1ligne "
                                                                                    tabletypeligne='addtableaaligne'
                                                                                    indexligneligne='indexaligne'
                                                                                    trtypeligne="traaaligne" style="
                                                                                   float: right; 
                                                                                   position: relative;
                                                                                   top: -25px;
                                                                                   "><i class="fa fa-plus-circle"></i>
                                                                                </a>
                                                                            </div>
                                                                            <div class="panel-body">

                                                                                <table
                                                                                    class="table table-bordered table-striped table-bottomless"
                                                                                    index=""
                                                                                    indexligneligne='indexaligne'
                                                                                    champ="addtableaaligne" id=""
                                                                                    style="width:100%" align="center">
                                                                                    <thead>
                                                                                        <tr bgcolor="#EDEDED">
                                                                                            <td align="center">
                                                                                                Composant</td>
                                                                                            <td align="center">Qte
                                                                                            </td>
                                                                                            <td align="center">Unite
                                                                                            </td>
                                                                                            <!-- <td align="center" hidden>
                                                                                                    Coefficient
                                                                                                </td> -->

                                                                                            <td align="center"></td>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr class="traaaligne"
                                                                                            style="display:none;" id=""
                                                                                            champ='traaaligne' index="">

                                                                                            <td>
                                                                                                <?php
                                                                                                    echo $this->Form->input('supp3', array('name' => '', 'type' => 'hidden', 'label' => '', 'indexligneligne' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'supp3', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control',));


                                                                                                    echo $this->Form->control('article_id', array('options' => $articlescomp, 'name' => '', 'label' => false, 'indexligneligne' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'article_idd', 'id' => 'article_idd', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => '', 'empty' => 'Veuillez Choisir !!', "style" => "width:100% ; height:32px"));
                                                                                                    ?>
                                                                                            </td>
                                                                                            <td>
                                                                                                <?php echo $this->Form->input('qte', array('name' => '', 'label' => '', 'indexligneligne' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'qte', 'id' => 'qte', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                                                    ?>
                                                                                            </td>
                                                                                            <!-- <td hidden>
                                                                                                    <?php echo $this->Form->input('coeff', array('name' => '', 'label' => '', 'indexligneligne' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'coeff', 'id' => 'coeff', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                                                    ?>
                                                                                                </td> -->
                                                                                            <td align="center">
                                                                                                <i indexligneligne=""
                                                                                                    indexligne=""
                                                                                                    index=""
                                                                                                    class="fa fa-times supor3"
                                                                                                    style="color: #c9302c;font-size: 22px;">
                                                                                            </td>

                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                                <input type="hidden" value="0" class=""
                                                                                    id="" champ="indexaligne" />
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <?php foreach ($fech['Ligne'] as $j => $fech1) {
                                                                        // debug($fech1['unite_id']) ;                                                                     
                                                                    ?>
                                                                <tr>
                                                                    <td>
                                                                        <?php
                                                                                echo $this->Form->input('supp2', array('name' => 'data[Ofsfligne][' . $i . '][Phaseofsf][' . $j . '][supp2]', 'label' => false, 'type' => 'hidden', 'div' => 'form-group', 'indexligne' => $j, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'index' => $i, 'id' => 'supp2' . $i . '-' . $j, 'champ' => 'supp', 'indextype' => '', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                                echo $this->Form->input('id', array('value' => $fech1['id'], 'name' => 'data[Ofsfligne][' . $i . '][Phaseofsf][' . $j . '][id]', 'type' => 'hidden', 'label' => false, 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'personnel_id', 'id' => 'id' . $i . '-' . $j, 'indextype' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => ''));
                                                                                echo $this->Form->control('article_id', array('options' => $articlescomp, 'value' => $fech1['article_id'], 'name' => 'data[Ofsfligne][' . $i . '][Phaseofsf][' . $j . '][article_idt]', 'label' => false, 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'article_idt', 'id' => 'article_idt' . $i . '-' . $j, 'indextype' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control select2', 'empty' => 'Veuillez Choisir !!'));
                                                                                ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                                echo $this->Form->input('qte', array('value' => $fech1['qte'], 'name' => 'data[Ofsfligne][' . $i . '][Phaseofsf][' . $j . '][qte]', 'label' => '', 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'qte', 'id' => 'qte' . $i . '-' . $j, 'indextype' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control '));
                                                                                ?>
                                                                    </td>

                                                                    <td>
                                                                        <select
                                                                            name="<?php echo "data[Ofsfligne][" . $i . "][Phaseofsf][" . $j . "][unite_id]" ?>"
                                                                            width="200px"
                                                                            id="<?php echo 'unite_idt' . $i ?>"
                                                                            style="width:200px" table="ligner"
                                                                            index="<?php echo $i ?>" champ="unite_idt"
                                                                            class="js-example-responsive select2 ">
                                                                            <option value="" selected="selected">
                                                                                Veuillez choisir !!
                                                                            </option>

                                                                            <?php foreach ($unit as $u) {
                                                                                    ?>
                                                                            <option
                                                                                <?php if ($fech1['unite_id'] == $u->id) { ?>
                                                                                selected="selected" <?php } ?>
                                                                                value="<?php echo $u->id; ?>">
                                                                                <?php echo $u->name ?>
                                                                            </option>
                                                                            <?php }
                                                                                    ?>
                                                                        </select>
                                                                    </td>
                                                                    <!-- <td <?php if (empty($fech['ligneligne'])) { ?> hidden <?php } ?> id="tdcompp<?php echo $i ?>-<?php echo $j ?>" champ="tdcompp" table="Ofsfligne" indexligne="<?php echo $j ?>" index="<?php echo $i ?>" name="data[Ofsfligne][<?php echo $i ?>][Phaseofsf][<?php echo $j ?>][tdcompp]">
                                                                                <?php
                                                                                echo $this->Form->input('coeff', array('value' => $fech1['coeff'], 'name' => 'data[Ofsfligne][' . $i . '][Phaseofsf][' . $j . '][coeff]', 'label' => '', 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'coeff', 'id' => 'coeff' . $i . '-' . $j, 'indextype' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control '));
                                                                                ?>
                                                                            </td> -->
                                                                    <td align="center">
                                                                        <i indexligne="<?php echo $j; ?>"
                                                                            index="<?php echo $i; ?>"
                                                                            class="fa fa-times supor2"
                                                                            style="color: #c9302c;font-size: 22px;">
                                                                    </td>


                                                                </tr>
                                                                <tr id="traaligne<?php echo $i ?>-<?php echo $j ?>"
                                                                    champ='traaligne'>
                                                                    <td width='30%'></td>
                                                                    <td id="afefligne<?php echo $i ?>-<?php echo $j ?>"
                                                                        champ="afefligne"
                                                                        class="afefligne <?php echo $i ?>-<?php echo $j ?>"
                                                                        colspan="3"
                                                                        id="afefligne<?php echo $i ?>-<?php echo $j ?>"
                                                                        index="<?php echo $i ?>">
                                                                        <div class="panel panel-default">
                                                                            <div class="panel-heading">
                                                                                <h3 class="panel-title">
                                                                                    <?php echo __('Composant'); ?>
                                                                                </h3>
                                                                                <a class="btn btn-primary ajouterligne1ligne"
                                                                                    table="addtableaaligne<?php echo $i ?>-<?php echo $j ?>"
                                                                                    tr="traaaligne<?php echo $i ?>-<?php echo $j ?>"
                                                                                    tabletypeligne='addtableaaligne'
                                                                                    trtypeligne="traaaligne"
                                                                                    tabletypeligne='addtableaaligne<?php echo $i ?>-<?php echo $j ?>'
                                                                                    indexligneligne='indexaligne<?php echo $i ?>-<?php echo $j ?>'
                                                                                    indexlignetypeligne='indexaligne<?php echo $i ?>-<?php echo $j ?>'
                                                                                    trtypeligne="traaaligne<?php echo $i ?>-<?php echo $j ?>"
                                                                                    style="
                                                                                               float: right; 
                                                                                               position: relative;
                                                                                               top: -25px;
                                                                                               "><i
                                                                                        class="fa fa-plus-circle"></i>
                                                                                </a>
                                                                            </div>
                                                                            <div class="panel-body">
                                                                                <table
                                                                                    class="table table-bordered table-striped table-bottomless"
                                                                                    index="<?php echo $i ?>"
                                                                                    indexligneligne='<?php echo $j ?>'
                                                                                    champ="addtableaaligne"
                                                                                    id="addtableaaligne<?php echo $i ?>-<?php echo $j ?>"
                                                                                    style="width:100%" align="center">
                                                                                    <thead>
                                                                                        <tr bgcolor="#EDEDED">
                                                                                            <td align="center">
                                                                                                Composant</td>
                                                                                            <td align="center">Qte
                                                                                            </td>
                                                                                            <td align="center">Unite
                                                                                            </td>
                                                                                            <!-- <td align="center" hidden>
                                                                                                        Coefficient
                                                                                                    </td> -->

                                                                                            <td align="center"></td>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr style="display:none;"
                                                                                            class="traaaligne<?php echo $i ?>-<?php echo $j ?>"
                                                                                            id="traaaligne<?php echo $i ?>-<?php echo $j ?>"
                                                                                            champ='traaaligne'
                                                                                            index="<?php echo $i ?>"
                                                                                            indexligne="<?php echo $j ?>">

                                                                                            <td>
                                                                                                <?php
                                                                                                        echo $this->Form->input('supp3', array('name' => '', 'type' => 'hidden', 'label' => '', 'indexligneligne' => '', 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'supp3', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));


                                                                                                        echo $this->Form->control('article_id', array('options' => $articlescomp, 'name' => '', 'label' => false, 'indexligneligne' => '', 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'article_idd', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => '', 'empty' => 'Veuillez Choisir !!', "style" => "width:100% ; height:32px"));
                                                                                                        ?>
                                                                                            </td>
                                                                                            <td>
                                                                                                <?php echo $this->Form->input('qte', array('name' => '', 'label' => '', 'indexligneligne' => '', 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'qte', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                                                        ?>
                                                                                            </td>
                                                                                            <td>
                                                                                                <?php echo $this->Form->control('unite_id', array('name' => '', 'label' => '', 'indexligneligne' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'unite_idd', 'id' => 'unite_idd', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control', 'empty' => 'Veuillez Choisir !!'));
                                                                                                        ?>
                                                                                            </td>
                                                                                            <!-- <td hidden>
                                                                                                        <?php echo $this->Form->input('coeff', array('name' => '', 'label' => '', 'indexligneligne' => '', 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'coeff', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                                                        ?>
                                                                                                    </td> -->
                                                                                            <td align="center">
                                                                                                <i indexligneligne=""
                                                                                                    indexligne="<?php echo $j ?>"
                                                                                                    index="<?php echo $i ?>"
                                                                                                    class="fa fa-times supor3"
                                                                                                    style="color: #c9302c;font-size: 22px;">
                                                                                            </td>
                                                                                        </tr>
                                                                                        <?php foreach ($fech1['ligneligne'] as $k => $fech2) {
                                                                                                    ///debug($fech2);
                                                                                                ?>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <?php
                                                                                                            echo $this->Form->input('supp3', array('name' => 'data[Ofsfligne][' . $i . '][Phaseofsf][' . $j . '][Phaseofsfligne][' . $k . '][supp3]', 'type' => 'hidden', 'label' => '', 'indexligneligne' => $k, 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'supp3', 'id' => 'supp3' . $i . '-' . $j . '-' . $k, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));


                                                                                                            echo $this->Form->control('article_id', array('options' => $articlescomp, 'value' => $fech2['article_id'], 'name' => 'data[Ofsfligne][' . $i . '][Phaseofsf][' . $j . '][Phaseofsfligne][' . $k . '][article_idd]', 'label' => false, 'indexligneligne' => $k, 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'article_idd', 'id' => 'article_idd' . $i . '-' . $j . '-' . $k, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control select2', 'empty' => 'Veuillez Choisir !!', "style" => "width:100% ; height:32px"));
                                                                                                            ?>
                                                                                            </td>
                                                                                            <td>
                                                                                                <?php echo $this->Form->input('qte', array('value' => $fech2['qte'], 'name' => 'data[Ofsfligne][' . $i . '][Phaseofsf][' . $j . '][Phaseofsfligne][' . $k . '][qte]', 'label' => '', 'indexligneligne' => $k, 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'qte', 'id' => 'qte' . $i . '-' . $j . '-' . $k, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                                                            ?>
                                                                                            </td>
                                                                                            <td>
                                                                                                <select
                                                                                                    name="<?php echo "data[Ofsfligne][" . $i . "][Phaseofsf][" . $j . "][Phaseofsfligne][" . $k . "][unite_idd]" ?>"
                                                                                                    width="200px"
                                                                                                    id="<?php echo 'unite_idd' . $i ?>"
                                                                                                    style="width:200px"
                                                                                                    table="ligner"
                                                                                                    index="<?php echo $i ?>"
                                                                                                    champ="unite_idd"
                                                                                                    class="js-example-responsive select2 ">
                                                                                                    <option value=""
                                                                                                        selected="selected">
                                                                                                        Veuillez
                                                                                                        choisir !!
                                                                                                    </option>

                                                                                                    <?php foreach ($unit as $u) {
                                                                                                                ?>
                                                                                                    <option
                                                                                                        <?php if ($fech2['unite_id'] == $u->id) { ?>
                                                                                                        selected="selected"
                                                                                                        <?php } ?>
                                                                                                        value="<?php echo $u->id; ?>">
                                                                                                        <?php echo $u->name ?>
                                                                                                    </option>
                                                                                                    <?php }
                                                                                                                ?>
                                                                                                </select>
                                                                                            </td>
                                                                                            <!-- <td hidden>
                                                                                                            <?php echo $this->Form->input('coeff', array('value' => $fech2['coeff'], 'name' => 'data[Ofsfligne][' . $i . '][Phaseofsf][' . $j . '][Phaseofsfligne][' . $k . '][coeff]', 'label' => '', 'indexligneligne' => $k, 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'coeff', 'id' => 'coeff' . $i . '-' . $j . '-' . $k, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                                                            ?>
                                                                                                        </td> -->
                                                                                            <td align="center">
                                                                                                <i indexligneligne="<?php echo $k ?>"
                                                                                                    indexligne="<?php echo $j ?>"
                                                                                                    index="<?php echo $i ?>"
                                                                                                    class="fa fa-times supor3"
                                                                                                    style="color: #c9302c;font-size: 22px;">
                                                                                            </td>
                                                                                        </tr>
                                                                                        <?php } ?>
                                                                                    </tbody>
                                                                                </table>
                                                                                <input type="hidden"
                                                                                    value="<?php echo $k ?>" class=""
                                                                                    id="indexaligne<?php echo $i ?>-<?php echo $j ?>"
                                                                                    champ="indexaligne" />
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <?php } ?>
                                                                <input type="hidden" value="<?php echo $j ?>"
                                                                    id="indexa<?php echo $i ?>" />
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        <input type="hidden" value="<?php echo $i ?>" id="index" />
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>



                </div>


                <div align="center">
                    <button type="submit" class="pull-right btn btn-success testobgarticle " id="ajouarticle"
                        style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>

                    <!-- <?php echo $this->Form->submit(__('Enregistrer'), ['id' => 'ajouarticle']); ?> -->
                </div>
            </div>

        </div>


        <?php echo $this->Form->end(); ?>
    </div>
    <!-- /.box -->
    </div>
    </div>


    <!-- Bootstrap Modal for Famille and Sous Famille -->
    <div class="modal fade" id="popupModal" tabindex="-1" role="dialog" aria-labelledby="popupModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="popupModalLabel">Erreur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalBody">
                    <!-- The content will be dynamically inserted here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
</section>




<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    $('.testobgarticle').on('mouseover', function() {
        var articleId = <?= json_encode($article->id) ?>;
        // alert('fff')
        famille = $('#salma').val();
        sousfamille = $('#sous').val();
        unite = $('#unite-id').val();
        Dsignation = $('#Dsignation').val();
        code = $('#code').val();
        prixachat = $('#prixachat').val();
        Prix = $('#Prix_LastInput').val();
         // Check if famille is empty
         if (famille === "") {
            $('#modalBody').text("Veuillez choisir une Famille !");
            $('#popupModal').modal('show'); 
            return false; 
        } else
           // Check if sousfamille is empty
           if (sousfamille === "") {
            $('#modalBody').text("Veuillez choisir une sous Famille !");
            $('#popupModal').modal('show'); 
            return false; 

        } else
       
        if (unite === "") {
            alert("Veuillez choisir une unite !");
            return false;
        } else
        if (Dsignation === "") {
            alert("Veuillez saisir la Désignation !");
            return false;
        } else
        if (code === "") {
            alert("Veuillez saisir le code  !");
            return false;
        } else

        if (prixachat === "") {
            alert("Veuillez saisir le prix d`achat !");
            return false;
        } else
        if (Prix === "") {
            alert("Veuillez saisir le prix de vente !");
            return false;
        }


        $.ajax({
            method: "GET",
            url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'checkDesignation']) ?>",
            dataType: "json",
            data: {
                Dsignation: Dsignation,
                id: articleId
            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
            },
            success: function(data) {
                if (data.testt == 1) {
                  //  alert("Designation existante !");
                  $('#modalBody').text("Designation existante!");
                  $('#popupModal').modal('show'); 
                }
                return false;
            }
        })

    });
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

<script type="text/javascript">
$(function() {
    $('.famille1').on('change', function() {

        id = $('#salma').val();

        if (id == 1) {
            //document.getElementById("code").maxLength = 4;
            $('#fichee').attr('style', "display:true;");
            $('#fiche').attr('style', "display:true;");
            $('#qteminmax').attr('style', "display:true;");
            $('#qteminmax2').attr('style', "display:true;");
            $('#showhide').attr('style', "display:true;");
            $('#showhide0').attr('style', "display:true;");
            $('#showhide00').attr('style', "display:true;");
            $('#showhide').attr('style', "font-size: 25px;");
            $('#showhide0').attr('style', "font-size: 25px;");
            $('#showhide00').attr('style', "font-size: 25px;");
        } else {
            //  $('.aff').html("<img style='width:150px' src=" + url + ">");
            $('#fichee').attr('style', "display:none;");
            $('#fiche').attr('style', "display:none;");
            $('#qteminmax').attr('style', "display:none;");
            $('#qteminmax2').attr('style', "display:none;");
            $('#showhide').attr('style', "display:none;");
            $('#showhide0').attr('style', "display:none;");
            $('#showhide00').attr('style', "display:none;");

            if (document.getElementById('img')) {
                document.getElementById('img').setAttribute('src', '');
            }

            if (id == 2) {
                $('#mobile').attr('style', "display:none;");
                $('#nombrepiece').attr('style', "display:none;");
                $('#nbpiecepalette').attr('style', "display:none;");
                $('#nbjour').attr('style', "display:none;");
                $('#frotation').attr('style', "display:none;");
                $('#nbpoint').attr('style', "display:none;");
                $('#coefficient').attr('style', "display:none;");
            } else {
                $('#mobile').attr('style', "display:none;");
                $('#nombrepiece').attr('style', "display:true;");
                $('#nbpiecepalette').attr('style', "display:true;");
                $('#nbjour').attr('style', "display:true;");
                $('#frotation').attr('style', "display:true;");
                $('#nbpoint').attr('style', "display:true;");
                $('#coefficient').attr('style', "display:true;");
            }

        }





        //alert(id);

        // if (id == 2 || id == 1) {
        if (document.getElementById('divsous'))
            document.getElementById('divsous').disabled = false;
        if (document.getElementById('sou'))
            document.getElementById('sous').disabled = false;
        $.ajax({
            method: "GET",
            url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'getsousfamille1']) ?>",
            dataType: "json",
            data: {
                idfam: id,

            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
            },
            success: function(data) {
                // alert(data.vente);
                $('#divsous').html(data.select);

                if ($.fn.select2 && $('#sous').hasClass('select2-hidden-accessible')) {
                    $('#sous').select2('destroy');
                }

                $('#sous').select2();









            }

        })
        // } 
        // else {
        //     document.getElementById('soussous').disabled = true;
        //     document.getElementById('sous').disabled = true;
        // }



    });


});


$('.tva').trigger('change');
$(function() {
    $('.tva').on('change', function() {
        //alert('hello');
        id = $('#tvaselect').val();
        // alert(id)
        $.ajax({
            method: "GET",
            url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'getvaleurtva']) ?>",
            dataType: "json",
            data: {
                idfam: id,

            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
            },
            success: function(data) {
                //alert(data['ligne']['valeur']);

                $('#tva').val(data['valeur']);
                // $('#tva').val(id);

                prix = Number($('#Prix_LastInput').val());
                tva = Number($('#tva').val());
                // alert(tvas);
                // if (tvas == 5) {
                //     tva = 19;
                // } else if (tvas == 6) {
                //     tva = 7;
                // } else {
                //     tva = 0;
                // }
                //  alert(tva);
                TXTPE = Number($('#TXTPE').val());


                if (prix < 0) {
                    alert("Veuillez entrer un prix valide SVP!!");
                    $('#Prix_LastInput').val('');
                }
                if ($('#OUI').is(':checked')) {
                    // alert("cbon");
                    fodec = Number($('#OUI').val());



                    montantfodec = Number($('#Prix_LastInput').val()) * fodec / 100;
                    prix = prix + montantfodec; // alert(prix);
                    //alert(prix);
                    // alert(remisepayementmontant);
                }
                // $('#prixttc').val(Number(prix).toFixed(3));

                if ($('#OUItpe').is(':checked')) {
                    //   alert("hh");
                    tpe = Number($('#OUItpe').val()); //alert(tpe);

                    mpontanttpe = Number($('#Prix_LastInput').val()) * tpe /
                    100; //alert(mpontanttpe);
                    prix = prix + mpontanttpe;
                    //alert(netht);
                    // alert(remisepayementmontant);
                }
                // $('#prixttc').val(Number(prix).toFixed(3));

                // alert(prix);
                if (tva != "") {
                    montanttva = prix * tva / 100;
                    //  alert(montanttva);
                    prix = prix + montanttva;
                    // $('#prixttc').val(Number(prix).toFixed(3));



                }





                $('#prixttc').val(Number(prix).toFixed(3));



            }

        })
    });
});
$(".calculprixarticlefinal").on("change", function() {
    // alert('hh');
    prix = Number($("#Prix_LastInput").val());
    // alert(prix);
    let tva = Number($("#tva").val());
    // alert(tva);
    // if (tvas == 5) {
    //     tva = 19;
    // } else if (tvas == 6) {
    //     tva = 7;
    // } else {
    //     tva = 0;
    // }

    if (prix < 0) {
        alert("Veuillez entrer un prix valide SVP!!");
        $("#Prix_LastInput").val("");
    }
    if (tva != "") {
        montanttva = (prix * tva) / 100;

    } else {
        montanttva = 0;
    }

    prixttc = prix + montanttva;

    $("#prixttc").val(Number(prixttc).toFixed(3));
});
//////
$(function() {
    $('#prixttc').on('change', function() {
        /// alert('dddd');
        var prixttc = Number($('#prixttc').val());
        tva = Number($('#tva').val());
        remise = Number($('#remise').val());
        // alert(tva);
        // Reverse calculation for TVA
        if (tva != "") {
            var mm = prixttc / (1 + tva / 100);
            // var montanttva = prixttc - mm;
            $('#Prix_LastInput').val(Number(mm).toFixed(3));

        }


    });

    // Trigger the change event initially
    $('.prixttc').trigger('change');
});


function getsousfamille2(param) {

    //alert('hello');
    id = $('#sous').val();
    // alert(id)
    $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'getsousf']) ?>",
        dataType: "json",
        data: {
            idfam: id,

        },
        headers: {
            'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data) {

            finalCode = data.finalCode;
            if (finalCode) {
                $('#code').val(finalCode);
            }
        }

    });



}

function getdonnee(param) {

    article_id = $('#article_id').val();
    $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'getdonnee']) ?>",
        dataType: "json",
        data: {
            article_id: article_id,

        },
        headers: {
            'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data) {

            $('#divsous').html(data.select);

            if ($.fn.select2 && $('#salma').hasClass('select2-hidden-accessible')) {
                $('#salma').select2('destroy');
            }

            if ($.fn.select2 && $('#sous').hasClass('select2-hidden-accessible')) {
                $('#sous').select2('destroy');
            }

            $('#salma').removeAttr('readonly');
            $('#salma').css('pointer-events', '');
            $('#sous').removeAttr('readonly');
            $('#sous').css('pointer-events', '');


            $('#salma').val(data.famille_id);
            $('#sous').val(data.sousfamille1_id);
            $('#salma').attr('readonly', 'readonly');
            $('#salma').css('pointer-events', 'none');
            $('#sous').attr('readonly', 'readonly');
            $('#sous').css('pointer-events', 'none');
            // $('#salma').select2();
            // $('#sous').select2();

            finalCode = data.finalCode;
            if (finalCode) {
                $('#code').val(finalCode);
            }





        }

    });



}




$(function() {
    $('.sousfamille1').on('change', function() {
        //  alert('hello');
        id = $('#sous').val();
        // alert(id)
        $.ajax({
            method: "GET",
            url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'getsousf']) ?>",
            dataType: "json",
            data: {
                idfam: id,

            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
            },
            success: function(data) {





            }

        })
    });
});

$(function() {
    $('#typearticle').on('change', function() {
        typearticle_id = $('#typearticle').val();
        //produit fini

        //accessoires




        $.ajax({
            method: "GET",
            url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'typearticle']) ?>",
            dataType: "json",
            data: {
                typearticle_id: typearticle_id,

            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
            },
            success: function(data) {

                $('#divselect').html(data.select);
                if (data.disabled == "") {
                    setTimeout(function() {
                        $('#article_id').select2();
                    }, 100);
                }



                // Reset the values and trigger change (without the AJAX call)
                $('#salma').val('').trigger('change');
                $('#sous').val('').trigger('change');



                if (typearticle_id == 1) {

                    if ($.fn.select2 && $('#salma').hasClass('select2-hidden-accessible')) {
                        $('#salma').select2('destroy');
                    }

                    if ($.fn.select2 && $('#sous').hasClass('select2-hidden-accessible')) {
                        $('#sous').select2('destroy');
                    }
                    $('#salma').removeAttr('readonly');
                    $('#salma').css('pointer-events', '');
                    $('#sous').removeAttr('readonly');
                    $('#sous').css('pointer-events', '');


                    $('#salma').select2();
                    $('#sous').select2();

                    $('#code').val('');



                }


                if (typearticle_id == 2) {
                    setTimeout(function() {


                        if ($.fn.select2 && $('#salma').hasClass(
                                'select2-hidden-accessible')) {
                            $('#salma').select2('destroy');
                        }

                        if ($.fn.select2 && $('#sous').hasClass(
                                'select2-hidden-accessible')) {
                            $('#sous').select2('destroy');
                        }


                        $('#salma').attr('readonly', 'readonly');
                        $('#salma').css('pointer-events', 'none');
                        $('#sous').attr('readonly', 'readonly');
                        $('#sous').css('pointer-events', 'none');




                        $('#code').val(data.code);


                    }, 200);
                } else {
                    $('#code').val('');

                }





            }

        })
    });
});



$(function() {
    $('#code').on('blur', function() {

        codearticle = $('#codearticle').val();
        //    alert(codearticle)


        //  alert(codearticle);

        $.ajax({
            method: "GET",
            url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'verifcodearticle']) ?>",
            dataType: "json",
            data: {
                idfam: codearticle,

            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
            },
            success: function(data) {
                // alert('hello');
                //alert(data.select);
                //  $('#divsous').html(data.select);
                // uniform_select('divsous');
                if (codearticle != '') {
                    if (data.codeexistant.length != 0) {
                        alert("Code article déja reservé !!");
                        $('#codearticle').val("");
                        $("#code").val("");
                    }
                }


                //  $.each(data, function(index) {
                // alert(data[index].name);
                // $('#sous').append('<option value="' + data[index].name + '">' + data[index].name + '</option>');


                //   alert(d[index].TEST2);
                //  });





                //  var opts = $.parseJSON(data);
                // alert(opts);
                //   alert("hh");


                // $('#sousfamille1').html(data.select);
                // uniform_select('sousfamille1_id');
                /*  $.each(opts, function(i, d) {
                 //You will need to alter the below to get the right values from your json object.  Guessing that d.id /d.modelName are columns in your carModels data
                 $('#emptyDropdown').append('<option value="' + d.ModelID + '">' + d.ModelName + '</option>');
                 });*/

            }

        })
    });
});
</script>