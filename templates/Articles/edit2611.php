<?php
$session = $this->request->getSession();
$id = $session->read('Users'); //debug($id);


$comm = $session->read('comm');
echo($comm);
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fournisseur $fournisseur
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->script('ajouterlignematrice'); ?>


<?php echo $this->fetch('script'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Modification article
    </h1> 
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i>
                <?php echo __('Retour'); ?></a></li>
    </ol>

</section>

<!-- Main content -->
<!--<label>
    <input type="checkbox"  id="check"  class="afficherfichetechnique"  <?php // if ($article->vente) {      ?> value="TRUE" <?php // } else {       ?>
        value="FALSE"
<?php //}  ?>>
    Afficher fiche technique 
</label>-->

<!-- general form elements -->

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box ">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>
                </div>

<!--                 <input type="radio" id="check" value="TRUE" class="afficherfichetechnique" margin-right="200px">-->



                <?php
                echo $this->Form->create($article, ['role' => 'form', 'type' => 'file', 'onkeypress' => "return event.keyCode!=13"]);
// debug($article->vente);
// die;
                ?>

                <div class="box-body">

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
                                        <?php echo $this->Form->control('sousfamille1_id', ['id' => 'sous', 'name' => 'sousfamille1_id', 'empty' => 'Veuillez choisir SVP !!', 'class' => 'form-control select2 control-label sousfamille1', 'label' => 'Sous famille']); ?>
                                        </select>
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
                                        <?php echo $this->Form->control('sousfamille_id', ['value' => $article->sousfamille2_id, 'options' => $sousfamille2s, 'id' => 'sous', 'name' => 'sousfamille2_id', 'empty' => 'Veuillez choisir SVP !!', 'class' => 'form-control select2 control-label sousfamille1', 'label' => 'Sous famille 2']); ?>
                                    </div>
                                </div>












                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('unite_id', ['options' => $unites, 'empty' => 'Veuillez choisir SVP !!', 'class' => 'form-control select2 control-label', 'label' => 'UnitÃ©s']); ?>
                                </div>




                            </div>
                        </div>

                    
                    
                    
                    
                    <div class="col-md-12" id ="contenu_article" style="display:true;">

                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('codeabr', ['type' => 'hidden', 'label' => '', 'value' => str_replace(' ', '', $val), 'id' => 'codeabr', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ']); ?>
                                    <div class="form-group input text">
                                        <label>Code</label>
                                        <input maxlength="4" value="<?php echo $article->Code ?>" name="Code" type="tel" id="code" class="form-control">
                                    </div>
                                    <input value="<?php echo $article->id ?>" readonly  type="hidden" id="idarticle" class="form-control" style="width:34%;">
                                </div>
                                <div class="col-xs-3">
                                    <label>Code a barre</label>
                                    <div class="input-group">
                                        <span name="codepaysproducteur" class="input-group-addon" style="width:10%"><?php echo $val ?></span>
                                        <input value="<?php echo $codeart ?>" readonly name="codearticle" type="text" id="codearticle" class="form-control" style="width:38%;">
                                    </div>
                                </div>

                                <?php
//debug($codeart);
                                if ($codeart != '') {
                                    $url = 'https://barcode.tec-it.com/barcode.ashx?data=' . str_replace(' ', '', $val) . $codeart . '&code=EAN13&translate-esc=true';
                                } else {
                                    $url = '';
                                }//debug($url);
                                ?>

                                <div style="width: 20px;" class="aff col-xs-4 ">

                                    <img id="img" style='width:150px'        <?php if ($url != '') { ?> src="<?php echo $url ?>" <?php } ?>  >


                                </div>






                            </div>






                        </div>



                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">



                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('Dsignation', ['label' => 'DÃ©signation', 'id' => 'Dsignation']); ?>


                                </div>
                                <div class="col-xs-6">



                                    <label> Prix hors taxe</label>


                                    <input value="<?php echo  sprintf('%0.3f', $article->Prix_LastInput)  ?>" placeholder="0.00" step="0.001" type="number" class="form-control calculprixarticle" name='Prix_LastInput' id="Prix_LastInput">




                                </div>




                            </div>
                        </div>




                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                                <div class=" col-xs-6">
                                    <?php echo $this->Form->control('unitearticle_id', ['label' => 'UnitÃ© article', 'options' => $unitearticles, 'empty' => 'Veuillez choisir !!', 'class' => ' form-control select2 control-label  calculprixarticle', 'id' => 'b', 'required' => 'off']); ?>
                                </div>




                                <div class=" col-xs-2 form-group input text required">
                                    <?php echo $this->Form->control('tva_id', ['label' => ' CatÃ©gorie Tva', 'options' => $tvas, 'empty' => 'Veuillez choisir !!', 'class' => ' form-control select2 control-label tva calculprixarticlee', 'id' => 'tvaselect', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-2">
                                    <?php
// debug($article->tva->valeur);
                                    if ($article->tva->valeur != null) {
                                        $tva = $article->tva->valeur;
                                    } else {
                                        $tva = 0;
                                    }
                                    echo $this->Form->control('tva', ['class' => 'form-control  control-label', 'label' => "Valeur TVA:", 'value' => $tva, 'readonly' => 'readonly', 'id' => 'tva']);
                                    ?>
                                </div>



                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('test', ['class' => 'form-control  control-label', 'id' => 'vente', 'value' => $article->vente, 'type' => 'hidden']); ?>
                                </div>
                            </div>
                        </div>
                     



                        <div class="row">

                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">



                                <div class="col-xs-6" id="nombrepiece" 
                                    <?php if ($article->famille_id == 2 ) { ?> style='display:none' <?php }  else  { ?> style='display:true' <?php } ?>>
                                    
                                    <?php echo $this->Form->control('nombrepiece', ['type' => 'number', 'class' => 'form-control  control-label', 'label' => "Nombre de piÃ¨ces par carton:"]); ?>
                                </div>







                                <div class="col-xs-6">
                                        <label> Poids brut</label>
                                 <input value="<?php echo $article->poidsbrut ?>" placeholder="0.000" step="0.001" type="number" class="form-control" name='poidsbrut' id="poidsbrut">

                                </div>




                            </div>
                        </div>



                        <div class="row">

                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">




                                <div class="col-xs-6" id="nbpiecepalette"   <?php if ($article->famille_id == 2 ) { ?> style='display:none' <?php }  else  { ?> style='display:true' <?php } ?>>
                                    <?php echo $this->Form->control('nbpiecepalette', ['type' => 'number', 'class' => 'form-control  control-label', 'label' => "Nombre de carton par palette:"]); ?>
                                </div>

                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('remise', ['class' => 'form-control  control-label', 'label' => "Remise %:"]); ?>
                                </div>
                            </div>
                        </div>




                        <div class="row">

                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                                <div class="col-xs-6" id="nbjour"   <?php if ($article->famille_id == 2 ) { ?> style='display:none' <?php }  else  { ?> style='display:true' <?php } ?>>
                                    <?php echo $this->Form->control('nbjour', ['type' => 'number', 'class' => 'form-control  control-label', 'label' => "Nombre de jour:"]); ?>

                                </div>




                                <div class="col-xs-6" id="nbpoint"   <?php if ($article->famille_id == 2 ) { ?> style='display:none' <?php }  else  { ?> style='display:true' <?php } ?>>
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


                                <div class="col-xs-6" id="coefficient"   <?php if ($article->famille_id == 2 ) { ?> style='display:none' <?php }  else  { ?> style='display:true' <?php } ?>>
                                    <?php echo $this->Form->control('coefficient', ['type' => 'number', 'class' => 'form-control  control-label', 'label' => "Coefficient:"]); ?>

                                </div>












                            </div>

                        </div>





                        <div class="row">

                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">



                                <div class="col-xs-6" id="frotation"    <?php if ($article->famille_id == 2 ) { ?> style='display:none' <?php }  else  { ?> style='display:true' <?php } ?>>
                                    <?php echo $this->Form->control('famillerotation_id', ['empty' => 'Veuillez choisir !!', 'options' => $famillerotations, 'class' => 'form-control select2 control-label', 'label' => "Famille rotation:"]); ?>

                                </div>

                                <div style="margin-top:20px" class="col-xs-6">
                                    <label class="control-label" for="unipxte-id" style="margin-right: 20px"> DestinÃ©e &agrave; la vente :</label>

                                    <input  type="hidden" id="vente" name="vente" >

                                    <input class="afficherfiche" type="checkbox" id="ventee" name="vente" value="1" <?php if ($article->vente == 1) { ?>   checked="true"    <?php } ?>>
                                </div>












                            </div>

                        </div>


                        <br>

                        <div style="display:flex;">

                            <div style="width:80%; margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">




                                <div class="col-xs-6" align="center">

                                    <?php echo $this->Html->image('imgart/' . $article->image, ['style' => 'max-width:100px;height:100px;']); ?>
                                </div>



                            </div>


                            <div style="width:80%; margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                                <label class="control-label" for="unipxte-id" style="margin-right: 20px"> Etat :</label>

                                ActivÃ© <input type="radio" name="etat" value="0" id="active" class="" style="margin-right: 20px" <?php if ($article->etat == 0) { ?> checked="checked" <?php } ?>>
                                DÃ©sactivÃ© <input type="radio" name="etat" value="1" id="desactive" class="" <?php if ($article->etat == 1) { ?> checked="checked" <?php } ?>>






                                <br>




                                <label class="control-label" for="unipxte-id" style="margin-right: 20px">Fodec :</label>

                                OUI <input type="radio" name="fodec" value="<?php echo $fodec ?>" id="OUI" class="calculprixarticle" style="margin-right: 20px" <?php if ($article->fodec != 0) { ?> checked="checked" <?php } ?>>
                                NON <input type="radio" name="fodec" value="0" id="NON" class="calculprixarticle" <?php if ($article->fodec == 0) { ?> checked="checked" <?php } ?>>






                                <br>


                                <label class="control-label" for="unipxte-id" style="margin-right: 20px">Tpe (%):</label>

                                OUI <input type="radio" name="TXTPE" value="<?php echo $tpe ?>" id="OUItpe" class="calculprixarticle" style="margin-right: 20px" class="" style="margin-right: 20px" <?php if ($article->TXTPE != 0) { ?> checked="checked" <?php } ?>>
                                NON <input type="radio" name="TXTPE" value="0" id="NONtpe" class="calculprixarticle" <?php if ($article->TXTPE == 0) { ?> checked="checked" <?php } ?>>



                            </div>





                        </div>




                        <br />



                        <div class="row" style="text-align: center;margin-top:20px">

                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                                <div class="col-xs-6">





                                </div>


                                <div class="col-xs-6">
                                    <div class="form-group input number">
                                        <label style="font-size:30px;color:rgb(255, 0, 0);margin-right:20px"> Prix TTC :</label>

                                        <input value="<?php echo $article->prixttc ?>" style="color:rgb(255, 0, 0);height: 80px;font-size:40px;width:50%;text-align:center" readonly='readonly' type="text" name="prixttc" id="prixttc">

                                    </div>

                                </div>

                            </div>
                        </div>


                        



                        <br />

                        <br />


<!--                        <div align="center" style="display:none;"class="row famille1" id="qteminmax">-->
                        <div id="qteminmax"  class="col-md-12 " <?php if ($article->famille_id == 1 ) { ?> style='display:true' <?php }  else  { ?> style='display:none' <?php } ?>>

                            
                            <table style="width: 50%;" class="table table-bordered table-striped table-bottomless" id="tab">



                                <tr>
                                    <th> Mois</th>
                                    <th style="text-align: center;">stock Min</th>
                                    <th style="text-align: center;">stock Max</th>
                                    <th style="text-align: center;">Alert</th>

                                </tr>


                                <?php
                                $i = 1;
//debug($i);
                                foreach ($seuil as $s) :
                                    ?>

                                    <tr style="height:20px">

                                        <td width="15px" style="text-align: center;"><?php
                                            echo
                                            $s->mois->name
                                            ?></td>
                                        <td style="text-align: center;">
                                            <input id="<?php echo "min" . $i ?>" index="<?php echo $i ?>" value="<?php echo $s->min ?>" style="height:30px;width:80px" name="<?php echo 'data[seuil][' . $i . '][minimum]' ?>" type="number" class=" seuil form-control">
                                            <input name="<?php echo 'data[seuil][' . $i . '][id]' ?>" value="<?php echo $s->id ?>" style="height:30px;width:80px" table="quantite" type="hidden" class="form-control">


                                        </td>

                                        <td style="text-align: center;">
                                            <input id="<?php echo "max" . $i ?>" index="<?php echo $i ?>" name="<?php echo 'data[seuil][' . $i . '][maximum]' ?>" value="<?php echo $s->max ?>" style="height:30px;width:80px" table="quantite" type="number" class=" seuil form-control">
                                        </td>

                                        <td style="text-align: center;">
                                            <input id="<?php echo "alert" . $i ?>" index="<?php echo $i ?>" name="<?php echo 'data[seuil][' . $i . '][alert]' ?>" value="<?php echo $s->alert ?>" style="height:30px;width:80px" table="quantite" type="number" class=" seuil  form-control">
                                        </td>



                                    </tr>
                                    <?php $i++; ?>

                                    <?php
                                endforeach;
                                foreach ($mois as $m) : if ($i == $m['id']) {
                                        $fin = $m['id'];
                                    }
                                endforeach;

                                $tab = [];
                                $c = 1;
                                foreach ($mois as $moii) {
                                    //   debug($moii["id"]);
                                    $tab[$c]['id'] = $moii["id"];
                                    $tab[$c]['name'] = $moii["name"];
                                    $c++;
                                }


                           //   debug($seuil);



                                if ($i != 12) {
                                    for ($jj = $fin; $jj <= 12; $jj++) {
                                        ?>


                                        <tr style="height:20px">


                                            <td width="15px"> <?php echo $tab[$jj]['name'] ?></td>
                                            <td style="text-align: center;">
                                                <input style="height:30px;width:80px" index="<?php echo $jj ?>" name="<?php echo 'data[seuil][' . $jj . '][minimum]' ?>" type="number" class="seuil form-control" name="" id="min1">
                                            </td>

                                            <td style="text-align: center;">
                                                <input style="height:30px;width:80px" index="<?php echo $jj ?>" name="<?php echo 'data[seuil][' . $jj . '][maximum]' ?>" type="number" class="seuil form-control" name="" id="max1">
                                            </td>

                                            <td style="text-align: center;">
                                                <input style="height:30px;width:80px" index="<?php echo $jj ?>" name="<?php echo 'data[seuil][' . $jj . '][alert]' ?>" type="number" class="seuil form-control" name="" id="alert1">
                                            </td>



                                        </tr>


                                    <?php
                                    }
                                }
                                ?>
                            </table>

                            <br>
                            <br>
                            <table align="center" style="width: 50%;" class="table table-bordered table-striped table-bottomless" id="tab">
                                <tr>
                                    <th style="width:10% ;"> </th>
                                    <?php
//   $i = 1;
//debug($i);
                                    foreach ($mois as $m) :
                                        ?>
                                        <th style="width: 1%;"> <?php echo $m->name ?> </th>
<?php endforeach; ?>

                                </tr>


                                <?php
                                $i = 1;
                                foreach ($commercials as $s) :
                                    ?>

                                    <tr style="height:20px">

                                        <td> <?php echo $s->name ?>
                                        </td>
                                        <?php foreach ($mois as $mm) : //debug($m); 
                                            ?>
                                            <?php //for  ($a=0;$a<=12;$a++) {  
                                            ?>


                                            <?php //for  ($a=0;$a<=12;$a++) {  
                                            ?>

        <?php //foreach ($objectifrepresentants as $obj) :          ?>


                                            <td style="width: 10px;">
                                                <input value="<?php echo $mm->id ?>" id="<?php echo "mois" . $i ?>" index="<?php echo $i ?>" name="<?php echo 'data[objectifrep][' . $i . '][mois]' ?>" style="height:30px;width:50px" type="hidden" class="form-control">




                                                <input value="<?php echo $s->id ?>" id="<?php echo "commercial" . $i ?>" index="<?php echo $i ?>" name="<?php echo 'data[objectifrep][' . $i . '][commercial]' ?>" style="height:30px;width:50px" type="hidden" class="form-control">


                                                <input <?php { ?> value="<?php echo @$tab[@$s->id][$mm->id] ?>" <?php } ?> id="<?php echo "objectif" . $i ?>" index="<?php echo $i ?>" name="<?php echo 'data[objectifrep][' . $i . '][objectif]' ?>" style="height:35px;width:80px" type="number" class="form-control">
                                            </td>
                                            <?php // } 
                                            ?>
                                            <?php //$i++ 
                                            ?>
                                            <?php $i++ ?>
    <?php endforeach; ?>


    <?php //endforeach;         ?>


                                    </tr>
                                    <?php $i + 1 ?>
<?php endforeach; ?>

                            </table>



                        </div>
<?php echo $comm; ?>
                        <div id="fiche"  class="col-md-12 " <?php if ($article->famille_id == 1 && $comm == 0) { ?> style='display:true' <?php }  else  { ?> style='display:none' <?php } ?>>
                            <div class="panel panel-default" >
                                <div class="panel-heading">
                                    <h3 class="panel-title"><?php echo __('Fiche Article'); ?></h3>
                                    <a class="btn btn-primary ajouterlignematriceee " table='addtablea'  index='index' tr="tra"  style="
                                       float: right; 
                                       position: relative;
                                       top: -25px;
                                       "><i class="fa fa-plus-circle"  ></i> </a>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped table-bottomless" id="addtablea" style="width:100%" align="center" >
                                        <thead>
                                            <tr bgcolor="#EDEDED">
                                                <td width=""  align="center">Composant1</td>
                                                <td width="" align="center">Qte</td>
                                                <td width="" align="center"></td>



                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tr champ="tra" class="tra" style="display:none;">

<td align="left" > <?php echo $this->Form->input('sup', array('name' => '', 'id' => '', 'champ' => 'sup', 'table' => 'Ofsfligne', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
    <div style="margin-top:10px"> 
    <?php echo $this->Form->input('article_id', array('empty' => 'Veuillez choisir', 'label' => '', 'id' => 'article_id', 'name' => '', 'table' => 'Ofsfligne', 'champ' => 'article_id', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => '')); ?></td>
</div>
<td align="center"> <?php
    echo $this->Form->input('qte', array('id' => 'qte', 'label' => '', 'name' => '', 'table' => 'Ofsfligne', 'champ' => 'qte', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control comp'));
    echo $this->Form->input('qt', array('type' => 'hidden', 'id' => 'qt', 'label' => '', 'name' => '', 'table' => 'Ofsfligne', 'champ' => 'qt', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control comp'));
    ?></td>                                  
<td align="center">
    <i index=""  class="fa fa-times supor" style="color: #c9302c;font-size: 22px;"></td>
</tr>
                                            <tr class="traa"   champ='traa' style="display:none">
                                                <td width='25%'></td>  <td  champ="afef" class="afef" colspan="3" id="" index="" >
                                                    <div class="panel panel-default" >
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title"><?php echo __('Composant2'); ?></h3>
                                                            <a class="btn btn-primary ajouterligne1 "  tabletype='addtableaa'  indexlignetype='indexa' trtype="traaa" style="
                                                               float: right; 
                                                               position: relative;
                                                               top: -25px;
                                                               "><i class="fa fa-plus-circle"  ></i> </a>
                                                        </div>
                                                        <div class="panel-body">
                                                            <table class="table table-bordered table-striped table-bottomless"   index="" indexligne='indexa' champ="addtableaa" id="" style="width:100%" align="center" >
                                                                <thead>
                                                                    <tr bgcolor="#EDEDED">
                                                                        <td  align="center">Composant</td>
                                                                        <td  align="center">Qte</td>
                                                                        <td  align="center"></td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr class="traaa" style="display:none;" id="traaa"  champ='traaa' index="">
                                                                    <td> <?php echo $this->Form->input('supp2', array('name' => '', 'type' => 'hidden
                                        ', 'label' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'supp2', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>

                                                                        <div style="margin-top:5px"> 
                                                                            <?php echo $this->Form->input('article_id', array('name' => '', 'label' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'article_id', 'id' => 'article_id', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => '', 'empty' => 'Veuillez Choisir !!', "style" => "width:100% ; height:32px"));
                                                                            ?>    </div>                                </td>
                                                                    <td>
                                                                        <?php echo $this->Form->input('qte', array('name' => '', 'label' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'qte', 'id' => 'qte', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                        ?>
                                                                    </td>
                                                                    <td align="center">
                                                                        <i indexligne="" index="" class="fa fa-times supor2" style="color: #c9302c;font-size: 22px;">
                                                                    </td>
                                                                </tr>

                                                                <tr class="traaligne"  index="" champ='traaligne' style="display:none">
                                                                    <td width='25%'></td>      <td  champ="afefligne" class="afefligne" colspan="3" id="" index="" >
                                                                        <div class="panel panel-default" >
                                                                            <div class="panel-heading">
                                                                                <h3 class="panel-title"><?php echo __('Composant3'); ?></h3>
                                                                                <a class="btn btn-primary ajouterligne1ligne "  tabletypeligne='addtableaaligne' indexligneligne='indexaligne' indexlignetypeligne='indexaligne' trtypeligne="traaaligne" style="
                                                                                   float: right; 
                                                                                   position: relative;
                                                                                   top: -25px;
                                                                                   "><i class="fa fa-plus-circle"  ></i> </a>
                                                                        </div>
                                                                            <div class="panel-body">
                                                                                <table class="table table-bordered table-striped table-bottomless"   index="" trtypeligne="traaaligne"  indexligneligne='indexaligne' champ="addtableaaligne" id="" style="width:100%" align="center" >-->

                                                                                <thead>
                                                                                        <tr bgcolor="#EDEDED">
                                                                                            <td  align="center">Composant</td>
                                                                                            <td  align="center">Qte</td>
                                                                                            <td  align="center"></td>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr class="traaaligne" style="display:none;" id=""  champ='traaaligne' index="">
                                                                                            <td> <?php
                                                                                                echo $this->Form->input('supp3', array('name' => '', 'type' => 'hidden', 'label' => '', 'indexligneligne' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'supp3', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control',));

                                                                                                echo $this->Form->input('article_id', array('name' => '', 'label' => '', 'indexligneligne' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'article_id', 'id' => 'article_id', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => '', 'empty' => 'Veuillez Choisir !!', "style" => "width:100% ; height:32px"));
                                                                                                ?>                                    </td>
                                                                                            <td>
                                                                                                <?php echo $this->Form->input('qte', array('name' => '', 'label' => '', 'indexligneligne' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'qte', 'id' => 'qte', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
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










                                            <?php
//    debug($dat)
//    echo 
                                            $i = -1;
                                            foreach ($dat as $fech) {
                                                $i++;
                                                //  debug($fech);die;
                                                ?>
                                                <tr > 

                                                    <td align="left"> <?php
                                                        echo $this->Form->input('sup', array('name' => 'data[Ofsfligne][' . $i . '][sup]', 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'Ofsfligne', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'type' => 'hidden', 'after' => '</div>', 'class' => 'form-control'));
                                                        echo $this->Form->input('article_id', array('value' => $fech['article_id'], 'style' => 'width:250px', 'label' => '', 'id' => 'article_id' . $i, 'label' => '', 'name' => 'data[Ofsfligne][' . $i . '][article_id]', 'table' => 'Ofsfligne', 'champ' => 'article_id', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  select', 'empty' => 'Veuillez choisir'));
                                                        ?></td>
                                                    <td align="center"> <?php
                                                        echo $this->Form->input('qte', array('value' => $fech['qte'], 'id' => 'qte' . $i, 'label' => '', 'name' => 'data[Ofsfligne][' . $i . '][qte]', 'table' => 'Ofsfligne', 'champ' => 'qte', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control comp'));
                                                        ?></td>

                                                    <td align="center"><i index="<?php echo $i; ?>"  class="fa fa-times supor" style="color: #c9302c;font-size: 22px;"></td>

                                                </tr>  

                                                <tr   index="<?php echo $i; ?>" class="tr" align="centre" ><td width='25%'></td> <td champ="afef" class="afef" id="afef<?php echo $i; ?>" colspan="3"  index="<?php echo $i; ?>">
                                                        <div class="panel panel-default" width="50%" >
                                                            <div class="panel-heading">
                                                                <h3 class="panel-title"><?php echo __('Composant'); ?></h3>
                                                                <a class="btn btn-primary ajouterligne1 " table='addtableaa<?php echo $i; ?>' index ='<?php echo $i; ?>' indexligne='indexa<?php echo $i; ?>' tr="traa<?php echo $i; ?>" style="
                                                                   float: right; 
                                                                   position: relative;
                                                                   top: -25px;
                                                                   "><i class="fa fa-plus-circle"  ></i></a>
                                                            </div>
                                                            <div class="panel-body">
                                                                <table class="table table-bordered table-striped table-bottomless" id="addtableaa<?php echo $i; ?>" style="width:100%" align="center" >
                                                                    <thead>
                                                                        <tr bgcolor="#EDEDED">
                                                                            <td  align="center">Composant</td>
                                                                            <td  align="center">Qte</td>

                                                                            <td></td>
                                                                        </tr>
                                                                    <tbody>
                                                                        <tr class="traa<?php echo $i; ?>" style="display:none;" d="traa<?php echo $i; ?>">
                                                                            <td> <?php
                                                                                echo $this->Form->input('supp2', array('label' => '', 'type' => 'hidden', 'div' => 'form-group', 'name' => '', 'indexligne' => '0', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'index' => $i, 'id' => 'supp', 'champ' => 'supp2', 'indextype' => '', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                                echo $this->Form->input('article_id', array('name' => '', 'label' => '', 'indexligne' => '0', 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'article_id', 'id' => 'article_id', 'indextype' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'empty' => 'Veuillez Choisir !!'));
                                                                                ?>                                    </td>
                                                                            <td> <?php
                                                                                echo $this->Form->input('qte', array('name' => '', 'label' => '', 'indexligne' => '0', 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'qte', 'id' => 'qte', 'indextype' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control '));
                                                                                ?> 
                                                                            </td>
                                                                            <td align="center">
                                                                                <i indexligne="0"  index="<?php echo $i; ?>" class="fa fa-times supor2" style="color: #c9302c;font-size: 22px;">
                                                                            </td>


                                                                        </tr>
                                                                        <tr class="traaligne"  index="" champ='traaligne' style="display:none">
                                                                            <td width='25%'></td>      <td  champ="afefligne" class="afefligne" colspan="3" id="" index="" >
                                                                                <div class="panel panel-default" >
                                                                                    <div class="panel-heading">
                                                                                        <h3 class="panel-title"><?php echo __('Composant'); ?></h3>
                                                                                        <a class="btn btn-primary ajouterligne1ligne "  tabletypeligne='addtableaaligne' indexligneligne='indexaligne'  trtypeligne="traaaligne" style="
                                                                                   float: right; 
                                                                                   position: relative;
                                                                                   top: -25px;
                                                                                   "><i class="fa fa-plus-circle"  ></i> </a>
                                                                                    </div>
                                                                                    <div class="panel-body">
                                                                                        
                                                                                    <table class="table table-bordered table-striped table-bottomless"   index="" indexligneligne='indexaligne' champ="addtableaaligne" id="" style="width:100%" align="center" >
                                                                                            <thead>
                                                                                                <tr bgcolor="#EDEDED">
                                                                                                    <td  align="center">Composant</td>
                                                                                                    <td  align="center">Qte</td>

                                                                                                    <td  align="center"></td>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                <tr class="traaaligne" style="display:none;" id=""  champ='traaaligne' index="">

                                                                                                    <td> <?php
                                                                                                        echo $this->Form->input('supp3', array('name' => '', 'type' => 'hidden', 'label' => '', 'indexligneligne' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'supp3', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control',));


                                                                                                        echo $this->Form->input('article_id', array('name' => '', 'label' => '', 'indexligneligne' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'article_id', 'id' => 'article_id', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => '', 'empty' => 'Veuillez Choisir !!', "style" => "width:100% ; height:32px"));
                                                                                                        ?>                                    </td>
                                                                                                    <td>
                                                                                                        <?php echo $this->Form->input('qte', array('name' => '', 'label' => '', 'indexligneligne' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'qte', 'id' => 'qte', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                                                        ?>
                                                                                                    </td>

                                                                                                    <td align="center">
                                                                                                        <i indexligneligne="" indexligne="" index="" class="fa fa-times supor3" style="color: #c9302c;font-size: 22px;">
                                                                                                    </td>

                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                        <input type="text" value="0" class="" id="" champ="indexaligne" />
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
    <?php foreach ($fech['Ligne'] as $j => $fech1) { ?>  
                                                                            <tr>
                                                                                <td> 
                                                                                    <?php
                                                                                    echo $this->Form->input('supp2', array('name' => 'data[Ofsfligne][' . $i . '][Phaseofsf][' . $j . '][supp2]', 'label' => '', 'type' => 'text', 'div' => 'form-group', 'indexligne' => $j, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'index' => $i, 'id' => 'supp2' . $i . '-' . $j, 'champ' => 'supp', 'indextype' => '', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                                    echo $this->Form->input('id', array('value' => $fech1['id'], 'name' => 'data[Ofsfligne][' . $i . '][Phaseofsf][' . $j . '][id]', 'type' => 'hidden', 'label' => '', 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'personnel_id', 'id' => 'id' . $i . '-' . $j, 'indextype' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => ''));
                                                                                    echo $this->Form->input('article_id', array('value' => $fech1['article_id'], 'name' => 'data[Ofsfligne][' . $i . '][Phaseofsf][' . $j . '][article_id]', 'label' => '', 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'article_id', 'id' => 'article_id' . $i . '-' . $j, 'indextype' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control', 'empty' => 'Veuillez Choisir !!'));
                                                                                    ?>                                    </td>
                                                                                <td> <?php
                                                                                    echo $this->Form->input('qte', array('value' => $fech1['qte'], 'name' => 'data[Ofsfligne][' . $i . '][Phaseofsf][' . $j . '][qte]', 'label' => '', 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'qte', 'id' => 'qte' . $i . '-' . $j, 'indextype' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control '));
                                                                                    ?> 
                                                                                </td>

                                                                                <td align="center">
                                                                                    <i indexligne="<?php echo $j; ?>" index="<?php echo $i; ?>"  class="fa fa-times supor2" style="color: #c9302c;font-size: 22px;">
                                                                                </td>


                                                                            </tr>
                                                                            <tr  id="traaligne<?php echo $i ?>-<?php echo $j ?>"  champ='traaligne'>
                                                                                <td width='25%'></td>      <td id="afefligne<?php echo $i ?>-<?php echo $j ?>" champ="afefligne" class="afefligne <?php echo $i ?>-<?php echo $j ?>" colspan="3" id="afefligne<?php echo $i ?>-<?php echo $j ?>" index="<?php echo $i ?>" >
                                                                                    <div class="panel panel-default" >
                                                                                        <div class="panel-heading">
                                                                                            <h3 class="panel-title"><?php echo __('Composant'); ?></h3>
                                                                                            <a class="btn btn-primary ajouterligne1ligne" table="addtableaaligne<?php echo $i ?>-<?php echo $j ?>"tr="traaaligne<?php echo $i ?>-<?php echo $j ?>" tabletypeligne='addtableaaligne'  trtypeligne="traaaligne" tabletypeligne='addtableaaligne<?php echo $i ?>-<?php echo $j ?>' indexligneligne='indexaligne<?php echo $i ?>-<?php echo $j ?>' indexlignetypeligne='indexaligne<?php echo $i ?>-<?php echo $j ?>' trtypeligne="traaaligne<?php echo $i ?>-<?php echo $j ?>" style="
                                                                                               float: right; 
                                                                                               position: relative;
                                                                                               top: -25px;
                                                                                               "><i class="fa fa-plus-circle"  ></i> </a>
                                                                                        </div>
                                                                                        <div class="panel-body">
                                                                                            <table class="table table-bordered table-striped table-bottomless"   index="<?php echo $i ?>" indexligneligne='<?php echo $j ?>' champ="addtableaaligne" id="addtableaaligne<?php echo $i ?>-<?php echo $j ?>" style="width:100%" align="center" >
                                                                                                <thead>
                                                                                                    <tr bgcolor="#EDEDED">
                                                                                                        <td  align="center">Composant</td>
                                                                                                        <td  align="center">Qte</td>
                                                                                                        <td  align="center"></td>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <tr style="display:none;" class="traaaligne<?php echo $i ?>-<?php echo $j ?>"  id="traaaligne<?php echo $i ?>-<?php echo $j ?>"  champ='traaaligne' index="<?php echo $i ?>" indexligne="<?php echo $j ?>">

                                                                                                        <td> <?php
                                                                                                            echo $this->Form->input('supp3', array('name' => '', 'type' => 'hidden', 'label' => '', 'indexligneligne' => '', 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'supp3', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));


                                                                                                            echo $this->Form->input('article_id', array('name' => '', 'label' => '', 'indexligneligne' => '', 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'article_id', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => '', 'empty' => 'Veuillez Choisir !!', "style" => "width:100% ; height:32px"));
                                                                                                            ?>                                    </td>
                                                                                                        <td>
                                                                                                            <?php echo $this->Form->input('qte', array('name' => '', 'label' => '', 'indexligneligne' => '', 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'qte', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                                                            ?>
                                                                                                        </td>

                                                                                                        <td align="center">
                                                                                                            <i indexligneligne="" indexligne="<?php echo $j ?>" index="<?php echo $i ?>" class="fa fa-times supor3" style="color: #c9302c;font-size: 22px;">
                                                                                                        </td>
                                                                                                    </tr>
        <?php foreach ($fech1['ligneligne'] as $k => $fech2) { ?>
                                                                                                        <tr>
                                                                                                            <td> <?php
                                                                                                                echo $this->Form->input('supp3', array('name' => 'data[Ofsfligne][' . $i . '][Phaseofsf][' . $j . '][Phaseofsfligne][' . $k . '][supp3]', 'type' => 'text', 'label' => '', 'indexligneligne' => $k, 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'supp3', 'id' => 'supp3' . $i . '-' . $j . '-' . $k, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));


                                                                                                                echo $this->Form->input('article_id', array('value' => $fech2['article_id'], 'name' => 'data[Ofsfligne][' . $i . '][Phaseofsf][' . $j . '][Phaseofsfligne][' . $k . '][article_id]', 'label' => '', 'indexligneligne' => $k, 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'article_id', 'id' => 'article_id' . $i . '-' . $j . '-' . $k, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => '', 'empty' => 'Veuillez Choisir !!', "style" => "width:100% ; height:32px"));
                                                                                                                ?>                                    </td>
                                                                                                            <td>
                                                                                                                <?php echo $this->Form->input('qte', array('value' => $fech2['qte'], 'name' => 'data[Ofsfligne][' . $i . '][Phaseofsf][' . $j . '][Phaseofsfligne][' . $k . '][qte]', 'label' => '', 'indexligneligne' => $k, 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'qte', 'id' => 'qte' . $i . '-' . $j . '-' . $k, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                                                                ?>
                                                                                                            </td>

                                                                                                            <td align="center">
                                                                                                                <i indexligneligne="<?php echo $k ?>" indexligne="<?php echo $j ?>" index="<?php echo $i ?>" class="fa fa-times supor3" style="color: #c9302c;font-size: 22px;">
                                                                                                            </td>
                                                                                                        </tr>
        <?php } ?>
                                                                                                </tbody>
                                                                                            </table>
                                                                                            <input type="hidden" value="<?php echo $k ?>" class="" id="indexaligne<?php echo $i ?>-<?php echo $j ?>" champ="indexaligne" />
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
    <?php } ?>
                                                                    <input type="hidden" value="<?php echo $j ?>" id="indexa<?php echo $i ?>" />
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </td></tr>
<?php } ?>
                                        <input type="hidden" value="<?php echo $i ?>" id="index"  />     
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>




                <!--                    <div id="fichetechnique"    
                <?php if ($article->vente == 1) { ?> style='display:true' <?php } ?>
<?php if ($article->vente == 0) { ?> style='display:none' <?php } ?>
                                    >
                                    
                                    
                                        <div class="col-md-12 ">
                                            <div class="panel panel-default" >
                                                <div class="panel-heading">
                                                    <h3 class="panel-title"><?php echo __('Article'); ?></h3>
                                                    <a class="btn btn-primary ajouterlignematriceee " table='addtablea' index='index' tr="tra" style="
                                                       float: right;
                                                       position: relative;
                                                       top: -25px;
                                                       "><i class="fa fa-plus-circle"  ></i> Ajouter article</a>
                                                </div>
                                                <div class="panel-body">
                
                                                    <table class="table table-bordered table-striped table-bottomless" id="addtablea" style="width:100%" align="center" >
                                                        <thead>
                                                            <tr bgcolor="#EDEDED">
                                                                <td width=""  align="center">Article</td>
                                                                <td width="" align="center"></td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr champ="tra" class="tra" style="display:none; " width='100%'>
                                                                <td width='100%'><table width='100%'>
                                                                        <tr>
                                                                            <td align="left" > <?php
                echo $this->Form->input('sup', array('name' => '', 'id' => '', 'champ' => 'sup', 'table' => 'Ofsfligne', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                echo $this->Form->input('articlee_id', array('style' => 'width:500px', 'empty' => 'Veuillez choisir', 'label' => '', 'id' => 'articlee_id', 'name' => '', 'table' => 'Ofsfligne', 'champ' => 'articlee_id', 'index' => '', 'class' => 'select form-control'));
                ?></td>
                                                                            <td align="center"><i index=""  class="fa fa-times supor" style="color: #c9302c;font-size: 22px;"></td>
                                                                        </tr>
                                                                        <tr class="traa"champ='traa' style="display:">
                                                                            <td  champ="afef" class="afef" colspan="7" id="" index="" >
                                                                                <div class="panel panel-default" >
                                                                                    <div class="panel-heading">
                                                                                        <h3 class="panel-title"><?php echo __('Personnel'); ?></h3>
                                                                                        <a class="btn btn-primary ajouterligne1" tabletype='addtableaa'  indexlignetype='indexa' trtype="traaa" style="
                                                                                           float: right;
                                                                                           position: relative;
                                                                                           top: -25px;
                                                                                           "><i class="fa fa-plus-circle"  ></i> Ajouter Personnel</a>
                                                                                    </div>
                                                                                    <div class="panel-body">
                                                                                        <table class="table table-bordered table-striped table-bottomless"   index="" indexligne='indexa' champ="addtableaa" id="" style="width:100%" align="center" >
                                                                                            <thead>
                                                                                                <tr bgcolor="#EDEDED">
                                                                                                    <td  align="center">Personnel</td>
                                                                                                    <td  align="center">Qte</td>
                                                                                                    <td  align="center"></td>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                <tr class="traaa" style="display:none;" id="traaa"  champ='traaa' index="">
                
                                                                                                    <td> <?php
                echo $this->Form->input('supp', array('name' => '', 'type' => 'hidden', 'label' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'supp', 'id' => 'supp', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));

                echo $this->Form->input('personnel_id', array('name' => '', 'label' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'personnel_id', 'id' => 'personnel_id', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => '', 'empty' => 'Veuillez Choisir !!', "style" => "width:100% ; height:32px"));
                ?>                                    </td>
                                                                                                         <td> <?php
                echo $this->Form->input('qte', array('name' => '', 'label' => '', 'indexligne' => '0', 'index' => '0', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'qte', 'id' => 'qte', 'indextype' => '', 'class' => 'form-control '));
                ?> 
                                                                                        </td>
                
                                                                                                    <td align="center"><i indexligne="" index="" class="fa fa-times supor1" style="color: #c9302c;font-size: 22px;"></td>
                
                                                                                                </tr>
                
                
                                                                                            </tbody>
                                                                                        </table>
                                                                                        <input type="hidden" value="0" class="" id="indexa" champ="indexa" />
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </table></td>
                                                            </tr>
                
                
                
                
                
                
                
                
                
                
                                                            <tr > 
                                                                <td align="left"> <?php
                echo $this->Form->input('sup', array('name' => 'data[Ofsfligne][0][sup]', 'id' => 'sup0', 'champ' => 'sup', 'table' => 'Ofsfligne', 'index' => '0', 'type' => 'hidden', 'class' => 'form-control'));
                echo $this->Form->input('articlee_id', array('style' => 'width:500px', 'label' => '', 'id' => 'articlee_id0', 'label' => '', 'name' => 'data[Ofsfligne][0][articlee_id]', 'table' => 'Ofsfligne', 'champ' => 'articlee_id', 'index' => '0', 'class' => 'form-control  select', 'empty' => 'Veuillez choisir'));
                ?></td>
                                                                <td align="center"><i index="0"  class="fa fa-times supor" style="color: #c9302c;font-size: 22px;"></td>
                                                            </tr>  
                                                            <tr   index="0" > <td champ="afef" class="afef" id="afef0" colspan="7"  index="0">
                                                                    <div class="panel panel-default" >
                                                                        <div class="panel-heading">
                                                                            <h3 class="panel-title"><?php echo __('Personnel'); ?></h3>
                                                                            <a class="btn btn-primary ajouterligne1 " table='addtableaa0' index ='0' indexligne='indexa0' tr="traa0" style="
                                                                               float: right;
                                                                               position: relative;
                                                                               top: -25px;
                                                                               "><i class="fa fa-plus-circle"  ></i> Ajouter personnel</a>
                                                                        </div>
                                                                        <div class="panel-body">
                                                                            <table class="table table-bordered table-striped table-bottomless" id="addtableaa0" style="width:100%" align="center" >
                                                                                <thead>
                                                                                    <tr bgcolor="#EDEDED">
                                                                                        <td  align="center">Personnel</td>
                                                                                        <td  align="center">Qte</td>
                
                                                                                        <td></td>
                                                                                    </tr>
                                                                                <tbody>
                                                                                    <tr class="traa0" style="display:none;" id="traa0">
                                                                                        <td> <?php
                echo $this->Form->input('supp', array('label' => '', 'type' => 'hidden', 'name' => '', 'indexligne' => '0', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'index' => '0', 'id' => 'supp', 'champ' => 'supp', 'indextype' => '', 'class' => 'form-control'));

                echo $this->Form->input('personnel_id', array('name' => '', 'label' => '', 'indexligne' => '0', 'index' => '0', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'personnel_id', 'id' => 'personnel_id', 'indextype' => '', 'class' => 'form-control', 'empty' => 'Veuillez Choisir !!'));
                ?>                                    </td>
                                                                                        <td> <?php
                echo $this->Form->input('qte', array('name' => '', 'label' => '', 'indexligne' => '0', 'index' => '0', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'qte', 'id' => 'qte', 'indextype' => '', 'class' => 'form-control '));
                ?> 
                                                                                        </td>
                                                                                        <td align="center"><i indexligne="0"  index="0" class="fa fa-times supor1" style="color: #c9302c;font-size: 22px;"></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <input type="hidden" value="0" id="indexa0" />
                                                                        </div>
                                                                    </div>
                                                                </td></tr>
                                                        </tbody>
                                                    </table>
                                                    <input type="hidden" value="0" id="index"  />
                                                </div>
                                            </div>
                                        </div>
                                    </div>-->


                <!-- /.box -->
                <!-- table ajout unitÃ© -->

                <div align="center">
                <?php echo $this->Form->submit(__('Enregistrer'), ['id' => 'ajouarticle']); ?></div>
<?php echo $this->Form->end(); ?>
            </div>
            <!-- /.box -->
        </div>
    </div>
</div>
</section>
</div>


</section>















<script type="text/javascript">
    $(function () {
        $('.famille1').on('change', function () {
            // alert('hello');
            id = $('#salma').val();
//            
//
            if (id == 1) {
                document.getElementById("code").maxLength=4;
                  $('#fiche').attr('style', "display:true;");
                 $('#qteminmax').attr('style', "display:true;"); 
            }
            else{
                  $('#fiche').attr('style', "display:none;");  
                  $('#qteminmax').attr('style', "display:none;");
                //  $('.aff').html("<img style='width:150px' src=" + url + ">");
                document.getElementById('img').setAttribute('src', ''); 
              //   document.getElementById("code").maxLength=0;
              //alert(id);
                 document.getElementById('code').removeAttribute('maxLength');
                  if (id==2)
                {
                    $('#nombrepiece').attr('style', "display:none;");          
                    $('#nbpiecepalette').attr('style', "display:none;");          
                    $('#nbjour').attr('style', "display:none;");   
                    $('#frotation').attr('style', "display:none;");   
                    $('#nbpoint').attr('style', "display:none;");   
                    $('#coefficient').attr('style', "display:none;");   
                }
                else{
                     $('#nombrepiece').attr('style', "display:true;");          
                    $('#nbpiecepalette').attr('style', "display:true;");          
                    $('#nbjour').attr('style', "display:true;");   
                    $('#frotation').attr('style', "display:true;");   
                    $('#nbpoint').attr('style', "display:true;");   
                    $('#coefficient').attr('style', "display:true;");
                }
            }
           

            // alert(id)
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
                success: function (data) {
                    //alert(data.select);
                    $('#divsous').html(data.select);
                    //  uniform_select('divsous');
                    $('#divsoussous').html(data.select1);
                    const vente = document.getElementById('vente');
                    if (data.vente == 1) {
                        // ? Set radio button to checked
                        ventee.checked = true;
                        $('#vente').val(1);
                    } else {
                        ventee.checked = false;
                        $('#vente').val(0);
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
    $(function () {
        $('.tva').on('change', function () {
            // alert('hello');
            id = $('#tvaselect').val();//alert(id)
            //   alert(id+'id')
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
                success: function (data) {
                    //  alert(data);
                    $('#tva').val(data.valeur);
                    prix = Number($('#Prix_LastInput').val());
                    tva = Number($('#tva').val());
                    TXTPE = Number($('#TXTPE').val());
                    if (prix < 0) {
                        alert("Veuillez entrer un prix valide SVP!!");
                        $('#Prix_LastInput').val('');
                    }
                    if ($('#OUI').is(':checked')) {
                        // alert("cbon");
                        fodec = Number($('#OUI').val());
                        montantfodec = prix * fodec / 100;
                        prix = prix + montantfodec; // alert(prix);
                        //alert(prix);
                        // alert(remisepayementmontant);
                    }
                    if ($('#OUItpe').is(':checked')) {
                        //   alert("hh");
                        tpe = Number($('#OUItpe').val());
                        mpontanttpe = prix * tpe / 100;
                        prix = prix + mpontanttpe;
                        //alert(netht);
                        // alert(remisepayementmontant);
                    }
                    if (tva != "") {
                        montanttva = prix * tva / 100;
                        prix = prix + montanttva;
                    }
                    $('#prixttc').val(Number(prix).toFixed(3));
                }
            })
        });
    });
    function getsousfamille2(param) {
        // alert('hello');
        id = $('#sous').val();
        //  alert(id)
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
            success: function (data) {
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
    $(function () {
        $('.sousfamille1').on('change', function () {
            //    alert('hello');
            id = $('#sous').val();
            //  alert(id)
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
                success: function (data) {
                    //alert(data.select);
                    $('#divsoussous').html(data.select);
                    //  uniform_select('divsoussous');
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
        });
    });
    $(function () {
        $('#code').on('blur', function () {
            codearticle = $('#codearticle').val();
            idarticle = $('#idarticle').val();
            //alert(codearticle)
            //  alert(codearticle);
            //
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'verifcodearticle']) ?>",
                dataType: "json",
                data: {
                    idfam: codearticle,
                    idarticle: idarticle,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (data) {
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

















<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    $(function () {
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

<!-- daterange picker -->
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

<?php $this->start('scriptBottom'); ?>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'})
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {'placeholder': 'mm/dd/yyyy'})
        //Money Euro
        $('[data-mask]').inputmask()

        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'})
        //Date range as a button
        $('#daterange-btn').daterangepicker(
                {
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
<?php $this->end(); ?>
