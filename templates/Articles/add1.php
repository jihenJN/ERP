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
        Ajouter article
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i>
                <?php echo __('Retour'); ?></a></li>
    </ol>
    <div class="choisir" align="center">


<button type="button" style="width: 160px;" data-toggle="tab" class="btn btn-primary btn-sm active " onclick="afficherDiv('articles')">Données Article</button>


<button type="button"  style="width: 160px;" data-toggle="tab" class="btn btn-primary btn-sm" onclick="afficherDiv('prixclient')">Prix Clients</button>


<button type="button" style="width: 160px;" data-toggle="tab" class="deduction btn btn-primary btn-sm" onclick="afficherDiv('unitcont')">Unite/Contenance</button>

<button type="button"  style="width: 160px;" data-toggle="tab" class="btn btn-primary btn-sm" onclick="afficherDiv('artetape')">Article Etape</button>


<button type="button"  style="width: 160px;" data-toggle="tab" class="btn btn-primary btn-sm" onclick="afficherDiv('fichart')">Fiche Article</button>




</div>
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
                //debug ($article);
                // die;
                ?>



                <div class="box-body">
                
                    <div class="row">
                    
                        <div class="tab-content active" id="articles" >
                            <div class="row">
                                <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                                    <div class="col-xs-6">
                                        <div class="form-group input text required">
                                            <?php echo $this->Form->control('famille_id', ['empty' => 'Veuillez choisir SVP !!', 'options' => $familles, 'class' => 'form-control select2 control-label famille famille1', 'id' => 'salma']); ?>

                                        </div>

                                    </div>
                                    <div class="col-xs-6">
                                        <?php echo $this->Form->control('Poids', ['class' => 'form-control  control-label', 'label' => 'Poids net']); ?>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">


                                    <div class="col-xs-6">
                                        <div class="form-group input text required" id="divsous">
                                            <?php echo $this->Form->control('sousfamille1', ['id' => 'sous', 'name' => 'sousfamille1_id', 'empty' => 'Veuillez choisir SVP !!', 'class' => 'form-control select2 control-label sousfamille1', 'label' => 'Sous famille']); ?>

                                        </div>

                                    </div>


                                    <div class="col-xs-6">
                                        <?php echo $this->Form->control('contenance', ['class' => 'form-control  control-label', 'label' => 'Contenance']); ?>
                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                                    <div class="col-xs-6">
                                        <div class="form-group input text required" id="divsoussous">
                                            <?php echo $this->Form->control('sousfamille2s', ['id' => 'soussous', 'empty' => 'Veuillez choisir SVP !!', 'class' => 'form-control select2 control-label', 'label' => 'Sous sous famille']); ?>
                                        </div>
                                    </div>
                                    <div class=" col-xs-6">
                                        <?php echo $this->Form->control('unitearticle_id', ['label' => 'Unite article', 'options' => $unitearticles, 'empty' => 'Veuillez choisir !!', 'class' => ' form-control select2 control-label  ', 'id' => 'u', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-6">
                                        <?php echo $this->Form->control('unite_id', ['options' => $unitearticles, 'empty' => 'Veuillez choisir SVP !!', 'class' => 'form-control select2 control-label', 'label' => 'Unite contenance']); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                                    <div class="col-xs-6">
                                        <div class="form-group input text">

                                            <label>Code</label>
                                            <?php //echo $this->Form->control('Code', ['label' => 'Code', 'required' => 'off', 'id' => 'code', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'number', 'name' => 'Code']); 
                                            ?>

                                            <input readonly name="Code" type="tel" id="code" class="form-control">
                                        </div>
                                    </div>



                                    <?php echo $this->Form->control('codeabr', ['type' => 'hidden', 'label' => '', 'value' => str_replace(' ', '', $val), 'id' => 'codeabr', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ']); ?>


                                    <div class="col-xs-3" id="codeabr">
                                        <label>Code a barre</label>


                                        <div class="input-group">
                                            <span name="codepaysproducteur" class="input-group-addon" style="width:10%"><?php echo $val ?></span>
                                            <input name="codearticle" readonly type="text" id="codearticle" class="form-control" style="width:50%;">

                                        </div>

                                    </div>


                                    <div style="width: 20px;" class="aff col-xs-4  "></div>






                                </div>






                            </div>
                            <div class="row">
                                <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">



                                    <div class="col-xs-6">
                                        <?php echo $this->Form->control('Dsignation', ['label' => 'Designation', 'id' => 'Dsignation']); ?>


                                    </div>
                                    <div class="col-xs-6">



                                        <label> Prix hors taxe</label>


                                        <input placeholder="0.000" step="0.001" type="number" class="form-control calculprixarticle" name='Prix_LastInput' id="Prix_LastInput">




                                    </div>




                                </div>
                            </div>
                            <div class="row">
                                <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">







                                    <div class=" col-xs-2 form-group input text required">
                                        <?php echo $this->Form->control('tva_id', ['label' => 'Categorie Tva', 'options' => $tvas, 'empty' => 'Veuillez choisir !!', 'class' => ' form-control select2 control-label tva calculprixarticle', 'id' => 'tvaselect', 'required' => 'off']); ?>
                                    </div>
                                    <div class="  col-xs-2">


                                        <?php echo $this->Form->control('tva', ['readonly' => 'readonly', 'id' => 'tva', 'class' => 'form-control  control-label', 'label' => "Valeur TVA:"]); ?>


                                    </div>






                                </div>
                            </div>
                            <div class="row">
                                <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                                    <div id="nombrepiece">
                                        <div class="col-xs-6">
                                            <?php echo $this->Form->control('nombrepiece', ['type' => 'number', 'class' => 'form-control  control-label', 'label' => "Nombre de pieces par carton:"]); ?>
                                        </div>



                                        <div class="col-xs-6">

                                            <label> Poids brut</label>
                                            <input placeholder="0.000" step="0.001" type="number" class="form-control" name='poidsbrut' id="poidsbrut">
                                        </div>




                                    </div>
                                </div>
                            </div>
                            <div class="row">

                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="col-xs-6" style="display:true;" id="coefficient">
                                    <?php echo $this->Form->control('coefficient', ['type' => 'number', 'class' => 'form-control  control-label', 'label' => "Bonification nouveau article(%):"]); ?>

                                </div>



                                <div class="col-xs-6" id="nbpiecepalette" style="display:true;">
                                    <?php echo $this->Form->control('nbpiecepalette', ['type' => 'number', 'class' => 'form-control  control-label', 'label' => "Nombre de carton par palette:"]); ?>
                                </div>

                            </div>
                            </div>
                            <div class="row">

                                <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">


                                    <div class="col-xs-6" id="nbjour">
                                        <?php echo $this->Form->control('nbjour', ['type' => 'number', 'class' => 'form-control  control-label', 'label' => "Nombre de jour (nouveau article):"]); ?>

                                    </div>




                                    <div class="col-xs-6" style="display:true;" id="nbpoint">
                                        <?php echo $this->Form->control('nbpoint', ['type' => 'number', 'class' => 'form-control  control-label', 'label' => "Nombre de points:"]); ?>

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">







                                    <div class="col-xs-6">
                                        <label> Image </label>
                                        <input type="file" name="image_file" class="form-control" id="ArticleImage">
                                    </div>


                                    <div class="col-xs-6">
                                        <?php echo $this->Form->control('remise', ['class' => 'form-control  control-label', 'label' => "Remise %:"]); ?>
                                    </div>






                                </div>

                            </div>
                            <div class="row">

                                <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                    <div class="col-xs-6" id="densite">
                                        <?php echo $this->Form->control('densite', ['class' => 'form-control  control-label', 'label' => "Densite:"]); ?>
                                    </div>



                                    <div class="col-xs-6">
                                        <label> Poids brut</label>
                                        <input placeholder="0.000" step="0.001" type="number" class="form-control" name='poidsbrut' id="poidsbrut">

                                    </div>




                                </div>
                            </div>

                            <div class="row">
                                <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                                    <div class="col-xs-6">
                                        <?php echo $this->Form->control('qteoptimalmelange', ['class' => 'form-control  control-label', 'label' => "Quantité optimal mélange "]); ?>
                                    </div>


                                    <div class="col-xs-6">
                                        <?php echo $this->Form->control('qteoptimalproduction', ['class' => 'form-control  control-label', 'label' => "Quantité optimal production"]); ?>
                                    </div>

                                
                                    <div class="col-xs-6">

                                        <label class="control-label" for="stockable" style="margin-right: 20px">Stockable :</label>

                                        OUI <input type="radio" name="stockable" value="0" id="OUI" checked class="" style="margin-right: 20px">
                                        NON <input type="radio" name="stockable" value="1" id="NON" class="">

                                    </div>
                                </div>

                            </div><br><br>

                             <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">


                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('nbjoursarticlenonacheter', ['label' => 'Nombre de jours (Article non acheté)', 'required' => 'off', 'id' => 'nbjoursarticlenonacheter', 'div' => 'form-group', 'class' => 'form-control']); ?>
                                </div>
                                <div class="col-xs-6" style="display:true;" id="frotation">
                                    <?php echo $this->Form->control('famillerotation_id', ['empty' => 'Veuillez choisir !!', 'options' => $famillerotations, 'class' => 'form-control select2 control-label', 'label' => "Famille rotation:"]); ?>

                                </div>

                                <div class="col-xs-6" style="display:none;" id="device">
                                    <?php echo $this->Form->control('devise', ['name' => 'devise_id', 'empty' => 'Veuillez choisir !!', 'options' => $devices, 'class' => 'form-control select2 control-label', 'label' => "Devise:"]); ?>
                                </div>
                                <br><br><br>
                                <div style="margin-top:20px" class="col-xs-8">
                                    <label class="control-label" for="unipxte-id" style="margin-right: 20px"> Destine a la vente :</label>

                                    <input type="checkbox" id="vente" name="vente" value="1">
                                </div>
                                <div style="margin-top:20px" id="mobile" class="col-xs-8">
                                    <label class="control-label" for="unipxte-id" style="margin-right: 20px"> Mobile </label>

                                    <input type="checkbox" id="mobilee" name="mobile" value="1">
                                </div>
                                <div style="width:80%; margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                    <label class="control-label" for="unipxte-id" style="margin-right: 20px"> Etat :</label>

                                    Activ&eacute; <input type="radio" name="etat" value="0" id="active" class="" style="margin-right: 20px">
                                    D&eacute;sactiv&eacute; <input type="radio" name="etat" value="1" id="desactive" class="">






                                    <br>





                                    <label class="control-label" for="unipxte-id" style="margin-right: 20px">Fodec :</label>

                                    OUI <input type="radio" name="fodec" value="<?php echo $fodec ?>" id="OUI" class="calculprixarticle" style="margin-right: 20px">
                                    NON <input type="radio" name="fodec" value="0" id="NON" class="calculprixarticle">






                                    <br>



                                    <label class="control-label" for="unipxte-id" style="margin-right: 20px">Tpe (%):</label>

                                    OUI <input type="radio" name="TXTPE" value="<?php echo $tpe ?>" id="OUItpe" class="calculprixarticle" style="margin-right: 20px">
                                    NON <input type="radio" name="TXTPE" value="0" id="NONtpe" class="calculprixarticle">
                                </div>
                            </div>
                            <br><br>
                            


                            <div style="display:flex;">

                                <div style="width:80%;margin-left: 30%; margin-right: 20px; position: static; ">
                                    <div align="center">
                                        <div class="form-group input number">
                                            <label style="font-size:30px;color:rgb(255, 0, 0);margin-right:20px"> Prix TTC :</label>

                                            <input style="color:rgb(255, 0, 0);height: 80px;font-size:50px;width:50%;text-align:center" readonly='readonly' type="text" name="prixttc" id="prixttc">

                                        </div>
                                    </div>


                                </div>

                            </div>
                            </div>
                        </div>
                        <div class="row tab-content" id="prixclient"  style="display: none">
                                <div align='center' class="box content" style="width: 96%" id="fichee" style="display:none;">
                                    <section class="content-header">
                                        <h1 class="box-title"><?php echo __('prix client'); ?></h1>
                                    </section>
                                    <section class="content" style="width: 99%">
                                        <div class="row box">
                                            <a class="btn btn-primary " data-toggle="modal" data-target="#modal-default" table='addtable' index='index' id='ajouter_ligne333' style="float: right;margin-bottom: 20px;">
                                                ajouter prix client <i class="fa fa-plus-circle "></i></a>
                                            <table class="table table-bordered table-striped table-bottomless" id="tabligne4">
                                                <thead>
                                                    <th>Client</th>
                                                    <th>Prix</th>
                                                    <th></th>
                                                </thead>
                                                <tbody>
                                                    <tr class="tr" style="display: none !important">

                                                        <td align="left" width="45%">
                                                            <div style="margin-top:1%">
                                                                <input type="hidden" name="" id="" champ="sup1" table="clientarticles" index="" class="form-control">
                                                                <select table="clientarticles" index champ="client_id" name="client_id" id="client_id" class="form-control control-label ">
                                                                    <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                                                    <?php foreach ($clients as $id => $client) {
                                                                        ?>
                                                                                                <option value="<?php echo $client->id; ?>"><?php echo $client->Code . ' ' . $client->Raison_Sociale ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td align="left" width="45%">
                                                            <input style="margin-top: 3% ;" table="clientarticles" type="text" class="form-control " index="" name="" id="" champ="prix" value="">
                                                        </td>
                                                        <td align="center" width="10%">
                                                            <i index="" id="" class="fa fa-times asupLigne" style="color: #c9302c;font-size: 22px;"></i>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <input type="hidden" value=0 id="indexxaa">
                                        </div>


                                    </section>
                                </div>
                                <br><br><br>
                        </div>
                        <div class="row tab-content" id="unitcont"  style="display: none" >
                                <div align='center' class="box content" style="width: 96%">
                                    <section class="content-header">
                                        <h1 class="box-title"><?php echo __('Unite/Contenance'); ?></h1>
                                    </section>
                                    <section class="content" style="width: 99%">
                                        <div class="row box">
                                            <a class="btn btn-primary " data-toggle="modal" data-target="#modal-default" table='addtable' index='index' id='ajouter_ligne33' style="float: right;margin-bottom: 20px;">
                                                Ajouter Unite/Contenance <i class="fa fa-plus-circle "></i></a>
                                            <table class="table table-bordered table-striped table-bottomless" id="tabligne3">
                                                <thead>
                                                    <tr>
                                                        <th width="45%"><?= ('Unite') ?></th>
                                                        <th width="45%"><?= ('Correspand') ?></th>
                                                        <th width="10%"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="tr" style="display: none !important">

                                                        <td align="left" width="45%">
                                                            <div style="margin-top:1%">
                                                                <input type="hidden" name="" id="" champ="sup0" table="uaprincipals" index="" class="form-control">

                                                                <?php echo $this->Form->control('unitearticle_id', array('empty' => 'Veuillez choisir !!', 'options' => $unitearticless, 'champ' => 'unitearticle_id', 'label' => '', 'name' => '', 'id' => '', 'table' => 'uaprincipals', 'index' => '', 'div' => 'form-group ', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ')); ?>
                                                            </div>
                                                        </td>
                                                        <td align="left" width="45%">
                                                            <input style="margin-top: 3% ;" table="uaprincipals" type="text" class="form-control " index="" name="" id="" champ="Correspand" value="">
                                                        </td>
                                                        <td align="center" width="10%">
                                                            <i index="" id="" class="fa fa-times supLigne" style="color: #c9302c;font-size: 22px;"></i>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <input type="hidden" value=-1 id="indexxa">
                                        </div>
                                    </section>
                                </div>
                      
                        </div>

                        <div class="tab-content" id="artetape"  style="display: none">
                                    <div align='center' class="box content" style="width: 96%">
                                        <section class="content-header">
                                            <h1 class="box-title"><?php echo __(' Article Etape'); ?></h1>
                                        </section>
                                        <section class="content" style="width: 99%">
                                            <div class="row box">
                                                <a class="btn btn-primary ajouter_etape " data-toggle="modal" data-target="#modal-default" table='tabligne' index='indexe' id='' style="float: right;margin-bottom: 20px;">
                                                    Ajouter Article/Etape <i class="fa fa-plus-circle "></i></a>
                                                <table class="table table-bordered table-striped table-bottomless" id="tabligne">
                                                    <thead>
                                                        <tr>
                                                            <th align="center" width="45%"><?= ('Etape') ?></th>
                                                            <th align="center" width="45%"><?= ('Rang') ?></th>
                                                            <th align="center" width="10%"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="tr" style="display: none !important">

                                                            <td align="center" width="45%">
                                                                <input type="hidden" name="" id="" champ="sup0" table="etapes" index="" class="form-control">

                                                                <label></label>
                                                                <select champ="etape_id" table="etapes" name="" id="" class="form-control rang">
                                                                    <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                                                    <?php foreach ($etapes as $e) {
                                                                        ?>
                                                                                                <option value="<?php echo $e->id; ?>"><?php echo $e->name ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </td>
                                                            <td align="center" width="45%">
                                                                <input style="margin-top: 3% ;" table="etapes" type="text" class="form-control verif" index="" name="" id="" champ="rang" value="">
                                                            </td>
                                                            <td align="center" width="10%">
                                                                <i index="" id="" class="fa fa-times supLigne" style="color: #c9302c;font-size: 22px;"></i>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <input type="hidden" value=-1 id="indexe">

                                            </div>
                                        </section>
                                    </div>

                        </div>
                         




                            <div class="row" style="text-align: center;margin-top:20px">

                                <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">


                                    <div class="col-xs-6">

                                        <?php echo $this->Html->image('imgart/' . $article->image, ['style' => 'max-width:100px;height:100px;']); ?>
                                    </div>





                                </div>
                            </div>


                        <!-- /.box-header -->
                        <div align="center" class="row " style="display:none;" id="showhide">
                            <strong style="font-size: 20px ;">Alert Stock</strong>
                            <i class="fa fa-eye-slash HideShow  text-blue"></i>

                        </div>
                        <div align="center" class="row " style="display:none;" id="qteminmax">
                            <table style="width: 30%;" class="table table-bordered table-striped table-bottomless" id="tab">



                                <tr>
                                    <th style="width: 10%"> Mois</th>
                                    <th style="text-align: center; width: 10%"> Stock min</th>
                                    <th style="text-align: center;width: 10%">Stock max</th>
                                    <th style="text-align: center;width: 10%">Alert</th>

                                </tr>


                                <?php
                                $i = 1;

                                foreach ($mois as $m):
                                    ?>



                                                            <tr style="height:20px">


                                                                <td width="15px"> <?php echo $m->name ?></td>
                                                                <td style="text-align: center;">
                                                                    <input style="height:30px;width:80px" index="<?php echo $i ?>" name="<?php echo 'data[seuil][' . $i . '][minimum]' ?>" type="text" class="seuil form-control" name="" id="min1">
                                                                </td>

                                                                <td style="text-align: center;">
                                                                    <input style="height:30px;width:80px" index="<?php echo $i ?>" name="<?php echo 'data[seuil][' . $i . '][maximum]' ?>" type="text" class="seuil form-control" name="" id="max1">
                                                                </td>

                                                                <td style="text-align: center;">
                                                                    <input style="height:30px;width:80px" index="<?php echo $i ?>" name="<?php echo 'data[seuil][' . $i . '][alert]' ?>" type="text" class="seuil form-control" name="" id="alert1">
                                                                </td>



                                                            </tr>
                                                            <?php $i++; ?>
                                <?php endforeach; ?>

                            </table>


                        </div>


                        <div align="center" class="row " style="display:none;" id="showhide0">
                            <strong style="font-size: 20px ;"> Objectifs representants</strong>
                            <i class="fa fa-eye-slash HideShow0  text-blue"></i>
                        </div>
                        <div style="display:none;" id="qteminmax2">

                            <table align="center" style="width: 70%;" class="table table-bordered table-striped table-bottomless" id="tab">



                                <tr>
                                    <th style="width:10% ;"> </th>
                                    <?php
                                    //   $i = 1;
                                    //debug($i);
                                    foreach ($mois as $m):
                                        ?>
                                                                <th style="width: 1%;"> <?php echo $m->name ?> </th>
                                    <?php endforeach; ?>

                                </tr>


                                <?php
                                $i = 1;
                                foreach ($commercials as $s):
                                    ?>

                                                            <tr style="height:20px">

                                                                <td> <?php echo $s->name ?>
                                                                </td>
                                                                <?php
                                                                //  $i = 1;
                                                                foreach ($mois as $m):
                                                                    ?>



                                                                                            <td style="width: 10px;">
                                                                                                <input value="<?php echo $m->id ?>" id="<?php echo "mois" . $i ?>" index="<?php echo $i ?>" name="<?php echo 'data[objectifrep][' . $i . '][mois]' ?>" style="height:30px;width:50px" type="hidden" class="form-control">




                                                                                                <input value="<?php echo $s->id ?>" id="<?php echo "commercial" . $i ?>" index="<?php echo $i ?>" name="<?php echo 'data[objectifrep][' . $i . '][commercial]' ?>" style="height:30px;width:50px" type="hidden" class="form-control">

                                                                                                <input id="<?php echo "objectif" . $i ?>" index="<?php echo $i ?>" name="<?php echo 'data[objectifrep][' . $i . '][objectif]' ?>" style="height:30px;width:50px" type="text" class="form-control">
                                                                                            </td>

                                                                                            <?php $i++ ?>
                                                                <?php endforeach; ?>


                                                            </tr>
                                                            <?php $i + 1 ?>
                                <?php endforeach; ?>

                            </table>



                        </div>

                    

                        <div id="prixfr" style="display:none;">
                            <section class="content-header">
                                <h1 class="box-title"><?php //debug($ar);die
                                echo __('Article Fournisseur'); ?></h1>
                            </section>
                            <section class="content" style="width: 99%">
                                <div class="row">
                                    <div class="box">
                                        <div class="box-header with-border">
                                            <a class="btn btn-primary  " table='addtable' index='index' id='ajouter_ligne60' style="
                                        float: right;
                                        margin-bottom: 5px;
                                        ">
                                                <i class="fa fa-plus-circle "></i> Ajouter article au fournisseur</a>
                                        </div>
                                        <div class="panel-body">
                                            <div class="table-responsive ls-table">
                                                <table class="table table-bordered table-striped table-bottomless" id="tabligne6">

                                                    <thead>
                                                        <tr width:20px">
                                                            <td align="center" style="width: 25%;"><strong>Fournisseur</strong></td>
                                                            <td align="center" style="width: 25%;"><strong>Code</strong></td>
                                                            <td align="center" style="width: 25%;"><strong>Prix</strong></td>
                                                            <td align="center" style="width: 25%;"></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class='tr' style="display: none !important">
                                                            <td>
                                                                <?php // debug($articles); 
                                                                ?>
                                                                <?php echo $this->Form->input('supfr', array('name' => '', 'id' => '', 'champ' => 'supfr', 'table' => 'articlefr', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                                ?>
                                                                <div style="margin-top: 22px ;">
                                                                    <?php echo $this->Form->control('fournisseur_id', array('empty' => 'Veuillez choisir !!', 'options' => $frs, 'champ' => 'fr_id', 'label' => '', 'name' => '', 'id' => '', 'table' => 'articlefr', 'index' => '', 'div' => 'form-group ', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'js-example-responsive form-control ')); ?>

                                                                </div>

                                                            </td>
                                                            <td>
                                                                <?php echo $this->Form->input('code', array('label' => '', 'champ' => 'code', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'articlefr', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ')); ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $this->Form->input('prix', array('step' => '0.001', 'label' => '', 'champ' => 'prix', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'articlefr', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control four1 ')); ?>
                                                            </td>

                                                            <td><i index="" id="" class="fa fa-times supfr" style="color: #C9302C;font-size: 22px;"></td>
                                                        </tr>
                                                    </tbody>
                                                </table><br />
                                                <input type="hidden" value="-1" id="indexfr">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </section>
                        </div>

                        <div class="tab-content" id="fichart"   style="display: none">
                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div align="center" class="row " style="display:none;" id="showhide00">
                                    <strong style="font-size: 20px ;"> Fiche technique</strong>
                                    <i class="fa fa-eye-slash HideShow00  text-blue"></i>

                                </div>

                                <div class="panel panel-default " >
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><?php echo __('Fiche Article'); ?></h3>
                                        <a class="btn btn-primary ajouterlignematriceee " table='addtablea' index='index' tr="tra" style="
                                            float: right; 
                                            position: relative;
                                            top: -25px;
                                            "><i class="fa fa-plus-circle"></i></a>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-bordered table-striped table-bottomless" id="addtablea" style="width:100%" align="center">
                                            <thead>
                                                <tr bgcolor="#EDEDED">
                                                    <td width="" align="center">Composant1</td>
                                                    <td width="" align="center">Qte1</td>
                                                    <td width="" align="center">Unite</td>
                                                    <td width="" align="center" id='tdcomp' hidden>Coefficient</td>
                                                    <td width="" align="center"></td>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr champ="tra" class="tra" style="display:none;">
                                                    <td align="left"> <?php echo $this->Form->input('sup', array('name' => '', 'id' => '', 'champ' => 'sup', 'table' => 'Ofsfligne', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                                                        <div style="margin-top:10px">
                                                            <?php echo $this->Form->input('article_id', array('empty' => 'Veuillez choisir', 'label' => '', 'id' => 'article_id', 'name' => '', 'table' => 'Ofsfligne', 'champ' => 'article_id', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => '')); ?>
                                                        </div>
                                                    </td>

                                                    <td align="center"> <?php
                                                    echo $this->Form->input('qte', array('id' => 'qte', 'label' => '', 'name' => '', 'table' => 'Ofsfligne', 'champ' => 'qte', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control comp'));
                                                    echo $this->Form->input('qt', array('type' => 'hidden', 'id' => 'qt', 'label' => '', 'name' => '', 'table' => 'Ofsfligne', 'champ' => 'qt', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control comp'));
                                                    ?></td>
                                                    <td>
                                                        <?php echo $this->Form->input('unite_id', array('empty' => 'Veuillez choisir', 'label' => '', 'id' => 'unite', 'name' => '', 'table' => 'Ofsfligne', 'champ' => 'unite', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>

                                                    </td>
                                                    <td hidden champ='tdcomp' index='' table='Ofsfligne'>
                                                        <?php echo $this->Form->input('coeff', array('label' => '', 'id' => '', 'name' => '', 'table' => 'Ofsfligne', 'champ' => 'coeff', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>

                                                    </td>
                                                    <td align="center">
                                                        <i index="" class="fa fa-times supor" style="color: #c9302c;font-size: 22px;">
                                                    </td>
                                                </tr>
                                                <tr class="traa" champ='traa' style="display:none">
                                                    <td width='30%'></td>
                                                    <td champ="afef" class="afef" colspan="3" id="" index="">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h3 class="panel-title"><?php echo __('Composant2'); ?></h3>
                                                                <a class="btn btn-primary ajouterligne1 " tabletype='addtableaa' indexlignetype='indexa' trtype="traaa" style="
                                                                    float: right; 
                                                                    position: relative;
                                                                    top: -25px;
                                                                    "><i class="fa fa-plus-circle"></i> </a>
                                                            </div>
                                                            <div class="panel-body">
                                                                <table class="table table-bordered table-striped table-bottomless" index="" indexligne='indexa' champ="addtableaa" id="" style="width:100%" align="center">
                                                                    <thead>
                                                                        <tr bgcolor="#EDEDED">
                                                                            <td align="center">Composant</td>
                                                                            <td align="center">Qte</td>
                                                                            <td align="center">Unite</td>
                                                                            <td align="center" id='tdcompp' hidden>Coefficient</td>

                                                                            <td align="center"></td>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr class="traaa" style="display:none;" id="traaa" champ='traaa' index="">
                                                                            <td> <?php echo $this->Form->input('supp2', array('name' => '', 'type' => 'hidden', 'label' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'supp2', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                                                <div style="margin-top:5px">
                                                                                    <?php echo $this->Form->input('article_id', array('name' => '', 'label' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'article_idt', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => '', 'empty' => 'Veuillez Choisir !!', "style" => "width:100% ; height:32px"));
                                                                                    ?> </div>
                                                                            </td>
                                                                            <td>
                                                                                <?php echo $this->Form->input('qte', array('name' => '', 'label' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'qte', 'id' => 'qte', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php echo $this->Form->input('unite_id', array('name' => '', 'label' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'unite_id', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => '', 'empty' => 'Veuillez Choisir !!', 'class' => 'form-control'));
                                                                                ?>
                                                                            </td>
                                                                            <td hidden champ='tdcompp' index='' indexligne='' table='Ofsfligne' tableligne='Phaseofsf'>
                                                                                <?php echo $this->Form->input('coeff', array('name' => '', 'label' => '', 'indexligne' => '0', 'index' => '0', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'coeff', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => '', 'class' => 'form-control'));
                                                                                ?>
                                                                            </td>
                                                                            <td align="center">
                                                                                <i indexligne="" index="" class="fa fa-times supor2" style="color: #c9302c;font-size: 22px;">
                                                                            </td>
                                                                        </tr>
                                                                        <tr class="traaligne" index="" champ='traaligne' style="display:none">
                                                                            <td width='30%'></td>
                                                                            <td champ="afefligne" class="afefligne" colspan="3" id="" index="">
                                                                                <div class="panel panel-default">
                                                                                    <div class="panel-heading">
                                                                                        <h3 class="panel-title"><?php echo __('Composant3'); ?></h3>
                                                                                        <a class="btn btn-primary ajouterligne1ligne " index="" indexligne="" tabletypeligne='addtableaaligne' indexligneligne='indexaligne' indexlignetypeligne='indexaligne' trtypeligne="traaaligne" style="
                                                                                            float: right; 
                                                                                            position: relative;
                                                                                            top: -25px;
                                                                                            "><i class="fa fa-plus-circle"></i></a>
                                                                                    </div>
                                                                                    <div class="panel-body">
                                                                                        <table class="table table-bordered table-striped table-bottomless" index="" indexligne="" indexligneligne='indexaligne' champ="addtableaaligne" id="" style="width:100%" align="center">
                                                                                            <thead>

                                                                                                <tr bgcolor="#EDEDED">
                                                                                                    <td width="30%" align="center">Composant</td>
                                                                                                    <td width="30%" align="center">Qte</td>
                                                                                                    <td width="30%" align="center">Unite</td>
                                                                                                    <td width="10%" align="center" id='tdcomppp' hidden>Coefficient</td>

                                                                                                    <td width="10%" align="center"></td>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                <tr class="traaaligne" style="display:none;" id="" champ='traaaligne' index="">
                                                                                                    <td> <?php
                                                                                                    echo $this->Form->input('supp3', array('name' => '', 'type' => 'hidden', 'label' => '', 'indexligneligne' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'supp3', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control', ));
                                                                                                    echo $this->Form->input('article_id', array('name' => '', 'label' => '', 'indexligneligne' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'article_idd', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => '', 'empty' => 'Veuillez Choisir !!', "style" => "width:100% ; height:32px"));
                                                                                                    ?> </td>
                                                                                                    <td>
                                                                                                        <?php echo $this->Form->input('qte', array('name' => '', 'label' => '', 'indexligneligne' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'qte', 'id' => 'qte', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                                                        ?>
                                                                                                    </td>

                                                                                                    <td>
                                                                                                        <?php echo $this->Form->input('unite_id', array('name' => '', 'label' => '', 'indexligneligne' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'unite_id', 'id' => 'unite_id', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control', 'empty' => 'Veuillez Choisir !!'));
                                                                                                        ?>
                                                                                                    </td>
                                                                                                    <td hidden champ='tdcomp2' index='' indexligne='' indexligneligne='' table='Ofsfligne' tableligne='Phaseofsf' tableligneligne='Phaseofsfligne'>
                                                                                                        <?php echo $this->Form->input('coeff', array('value' => '1', 'name' => '', 'label' => '', 'indexligneligne' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'coeff', 'id' => 'coeff', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                                                        ?>
                                                                                                    </td>
                                                                                                    <td align="center">
                                                                                                        <i indexligneligne="" indexligne="" index="" class="fa fa-times supor3" style="color: #c9302c;font-size: 22px;">
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                        <input type="hidden" value="0" class="" id="" champ="indexaligne" />
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

                                            </tbody>
                                        </table>
                                        <input type="hidden" value="-1" id="index" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div align="center">
                    <?php echo $this->Form->submit(__('Enregistrer'), ['id' => 'ajouarticle']); ?></div>

                <?php echo $this->Form->end(); ?>
            </div>
            <!-- /.box -->
        </div>
    </div>


</section>




<script type="text/javascript">
    $(function() {
        $('.rang').on('change', function() {
            index = $(this).attr("index");
            i = Number(index) + 1;
            //   $('#rang'+index).val(i); //alert(id)
            //   alert(id+'id')
            inde = $('#indexe').val();
            k = 0;
            for (i = 0; i <= inde; i++) {
                sup = $('#sup0' + i).val(); //alert(sup)
                if (Number(sup) != 1) {
                    k++;

                    $('#rang' + i).val(k);
                }
            }
        });
        $('.famille1').on('change', function() {

            id = $('#salma').val();
            // alert(id);            
            // alert(idd);
            if (id) {
                document.getElementById('code').removeAttribute('readonly');
                //$('#code').val('');




            } else {
                document.getElementById('code').readOnly = true;
            }
            if (id == 1) {
                document.getElementById("code").maxLength = 4;
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
                //   document.getElementById("code").maxLength=0;
                document.getElementById('code').removeAttribute('maxLength');

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

            if (id == 2 || id == 1) {
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
                        // uniform_select('divsous');


                        $('#divsoussous').html(data.select1);
                        const vente = document.getElementById('vente');

                        if (data.vente == 1) {

                            // ? Set radio button to checked
                            vente.checked = true;
                        } else {
                            vente.checked = false;
                        }

                        //    $('#vente').checked = true ;
                        // uniform_select('divsoussous');


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
            } else {
                document.getElementById('soussous').disabled = true;
                document.getElementById('sous').disabled = true;
            }



        });


    });




    $(function() {
        $('.tva').on('change', function() {
            //alert('hello');
            id = $('#tvaselect').val();
            //alert(id)
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

                    $('#tva').val(data['ligne']['valeur']);

                    prix = Number($('#Prix_LastInput').val());
                    tva = Number($('#tva').val());
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

                        mpontanttpe = Number($('#Prix_LastInput').val()) * tpe / 100; //alert(mpontanttpe);
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
                //alert(data.select);
                $('#divsoussous').html(data.select);
                uniform_select('divsoussous');


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

        });



    }






    $(function() {
        $('.sousfamille1').on('change', function() {
            //  alert('hello');
            id = $('#sous').val();
            alert(id)
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
                    //alert(data.select);
                    //  $('#divsous').html(data.select);
                    // uniform_select('divsous');


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
                            alert("Code article dÃ©ja reservÃ© !!");
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



















<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
  const buttons = document.querySelectorAll('[data-toggle="tab"]');
  buttons.forEach(button => {
    button.addEventListener('click', function() {
    
      // Désactiver tous les boutons
      buttons.forEach(btn => {
        btn.classList.remove('active');
      });

      // Activer le bouton cliqué
      button.classList.add('active');
    });
  });

  // Gestionnaire d'événements global pour maintenir le bouton actif lors de clics en dehors
  document.addEventListener('click', function(event) {
    if (!event.target.matches('[data-toggle="tab"]')) {
      const activeButton = document.querySelector('.btn.active');
      if (activeButton) {
        activeButton.classList.add('active');
      }
    }
  });
});
    function afficherDiv(id) {
  // Masquer tous les divs
  const divs = document.getElementsByClassName('tab-content');
  
  for (let i = 0; i < divs.length; i++) {
    divs[i].style.display = 'none';
  }

  // Afficher le div correspondant
  document.getElementById(id).style.display = 'block';

}
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