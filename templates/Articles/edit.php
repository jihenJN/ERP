<?php
error_reporting(E_ERROR | E_PARSE);

use function PHPSTORM_META\type;

$session = $this->request->getSession();
$id = $session->read('Users'); //debug($id);


$comm = $session->read('comm');
echo ($comm);
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fournisseur $fournisseur
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->script('hechem'); ?>
<?php echo $this->Html->script('ajouterlignematrice'); ?>
<?php echo $this->Html->css('select2'); ?>



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
    <input type="checkbox"  id="check"  class="afficherfichetechnique"  <?php // if ($article->vente) {      
                                                                        ?> value="TRUE" <?php // } else {       
                                                                                        ?>
        value="FALSE"
<?php //}  
?>>
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
                <?php
                echo $this->Form->create($article, ['role' => 'form', 'type' => 'file', 'onkeypress' => "return event.keyCode!=13"]);
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
                                <div class="form-group input text required" id="divsous">
                                    <?php echo $this->Form->control('sousfamille1_id', ['id' => 'sous', 'name' => 'sousfamille1_id', 'empty' => 'Veuillez choisir SVP !!', 'class' => 'form-control select2 control-label sousfamille1', 'label' => 'Sous famille']); ?>
                                </div>
                            </div>
                            <!-- <div class="col-xs-6">
                                <?php echo $this->Form->control('Poids', ['class' => 'form-control  control-label', 'label' => 'Poids net']); ?>
                            </div> -->
                        </div>
                    </div>
                    <div class="row">
                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">


                            <div class=" col-xs-6">
                                <?php echo $this->Form->control('unite_id', ['label' => 'Unite article ', 'options' => $unites, 'empty' => 'Veuillez choisir !!', 'class' => ' form-control select2 control-label ', 'id' => 'u', 'required' => 'off']); ?>
                            </div>
                            <div class="col-xs-6">
                                <?php echo $this->Form->control('Dsignation', ['label' => 'Designation', 'id' => 'Dsignation']); ?>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                            <!-- <div class="col-xs-6">
                                <?php echo $this->Form->control('contenance', ['class' => 'form-control  control-label', 'label' => 'Contenance']); ?>
                            </div> -->
                        </div>
                    </div>
                    <div class="row">
                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                            <!-- <div class="col-xs-6">
                                < ?php echo $this->Form->control('unite_id', ['options' => $unitearticles, 'empty' => 'Veuillez choisir SVP !!', 'class' => 'form-control select2 control-label', 'label' => 'Unite']); ?>
                            </div> -->
                            <div class="col-xs-6">
                                <?php echo $this->Form->control('codeabr', ['type' => 'hidden', 'label' => '', 'value' => str_replace(' ', '', $val), 'id' => 'codeabr', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ']); ?>
                                <div class="form-group input text">
                                    <label>Code</label>
                                    <input maxlength="4" value="<?php echo $article->Code ?>" name="Code" type="tel" id="code" class="form-control">
                                </div>
                                <input value="<?php echo $article->id ?>" readonly type="hidden" id="idarticle" class="form-control">
                            </div>
                            <div class="col-xs-6">
                                <?php echo $this->Form->control('codeancienne', ['label' => 'Code Ancienne', 'id' => 'codeancienne']); ?>


                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-xs-6">
                                <div class="form-group input text required" id="divsoussous">
                                    < ?php if ($article->sousfamille2_id != null && $sousfamille2s != null) { ?>
                                        < ?php echo $this->Form->control('sousfamille_id', ['value' =>  $article->sousfamille2_id, 'options' => $sousfamille2s, 'id' => 'soussous', 'name' => 'sousfamille2_id', 'empty' => 'Veuillez choisir SVP !!', 'class' => 'form-control select2 control-label sousfamille1', 'label' => 'Sous famille 2']); ?>
                                    < ?php }
                                    ?>

                                    < ?php // } 
                                    ?>
                                </div>
                            </div> -->





                    <!-- < div class="col-md-12" id="contenu_article" style="display:true;"> -->
                    <!-- <div class="row">
                                <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                    <div class="col-xs-3">
                                        <label>Code a barre</label>
                                        <div class="input-group">
                                            <span name="codepaysproducteur" class="input-group-addon" style="width:10%">< ?php echo $val ?></span>
                                            <input value="< ?php echo $codeart ?>" readonly name="codearticle" type="text" id="codearticle" class="form-control" style="width:38%;">
                                        </div>
                                    </div>
                                    < ?php
                                    //debug($codeart);
                                    if ($codeart != '') {
                                        $url = 'https://barcode.tec-it.com/barcode.ashx?data=' . str_replace(' ', '', $val) . $codeart . '&code=EAN13&translate-esc=true';
                                    } else {
                                        $url = '';
                                    } //debug($url);
                                    ?>
                                    <div style="width: 20px;" class="aff col-xs-4 ">
                                        <img id="img" style='width:150px' < ?php if ($url != '') { ?> src="< ?php echo $url ?>" < ?php } ?>>
                                    </div>
                                </div>
                            </div> -->







                    <div class="row">
                        <div style=" margin-left: 20px; margin-right: 20px; ">

                            <div class="col-xs-6">
                                <?php echo $this->Form->control('prixachat', ['label' => 'Prix Achat HT', 'placeholder' => "0.000", 'step' => "0.001", 'id' => 'prixachat']); ?>


                            </div>
                            <div class="col-xs-6">
                                <label> Prix Vente HT</label>
                                <input value="<?php echo  sprintf('%0.3f', $article->Prix_LastInput)  ?>" placeholder="0.00" step="0.001" type="number" class="form-control calculprixarticlefinal" name='Prix_LastInput' id="Prix_LastInput">
                            </div>
                            <div class=" col-xs-6" hidden>
                                <?php echo $this->Form->control('machine_id', ['label' => ' Machine', 'options' => $machines, 'empty' => 'Veuillez choisir !!', 'class' => ' form-control select2 control-label', 'id' => 'machine_id', 'required' => 'off']); ?>
                            </div>


                            <div class="col-xs-6" hidden>
                                <?php echo $this->Form->control('refBureauEtude', ['label' => 'Ref bureau d\'étude', 'required' => 'off', 'id' => 'refBureauEtude', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'text', 'name' => 'refBureauEtude']);
                                ?>
                            </div>

                            <!-- <div class="col-xs-6">
                                    < ?php echo $this->Form->control('test', ['class' => 'form-control  control-label', 'id' => 'vente', 'value' => $article->vente, 'type' => 'hidden']); ?>
                                </div> -->
                        </div>
                    </div>


                    <div class="row">
                        <div style=" margin-left: 20px; margin-right: 20px; ">


                            <div class=" col-xs-6" hidden>
                                <?php echo $this->Form->control('machine_id', ['label' => ' Machine', 'options' => $machines, 'empty' => 'Veuillez choisir !!', 'class' => ' form-control select2 control-label', 'id' => 'machine_id', 'required' => 'off']); ?>
                            </div>
                            <div class=" col-xs-3">
                                <?php echo $this->Form->control('tva_id', ['label' => ' Categorie Tva', 'options' => $tvas, 'empty' => 'Veuillez choisir !!', 'class' => ' form-control select2 control-label tva calculprixarticlee', 'id' => 'tvaselect', 'required' => 'off']); ?>
                            </div>
                            <div class="col-xs-3">
                                <?php
                                if ($article->tva->valeur != null) {
                                    $tva = $article->tva->valeur;
                                } else {
                                    $tva = 0;
                                }
                                echo $this->Form->control('tvaa', ['class' => 'form-control  control-label', 'name' => 'tva', 'label' => "Valeur TVA:", 'value' => $tva, 'readonly' => 'readonly', 'id' => 'tva']);
                                ?>
                            </div>
                            <div class=" col-xs-6">
                                <?php echo $this->Form->control('marque_id', ['label' => 'Marque', 'options' => $marques, 'empty' => 'Veuillez choisir !!', 'class' => ' form-control select2 control-label  ', 'id' => 'marque_id', 'required' => false]); ?>
                            </div>
                            <div class="col-xs-6" hidden>
                                <?php echo $this->Form->control('refBureauEtude', ['label' => 'Ref bureau d\'étude', 'required' => 'off', 'id' => 'refBureauEtude', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'text', 'name' => 'refBureauEtude']);
                                ?>
                            </div>

                            <!-- <div class="col-xs-6">
                                    < ?php echo $this->Form->control('test', ['class' => 'form-control  control-label', 'id' => 'vente', 'value' => $article->vente, 'type' => 'hidden']); ?>
                                </div> -->
                        </div>
                    </div>
                    <div class="row">
                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                            <div class="col-xs-6">
                                <label> Image </label>
                                <input type="file" name="image_file" class="form-control" id="ArticleImage">
                            </div>
                            <!-- <div class="col-xs-6" id="frotation" <?php if ($article->famille_id == 2) { ?> style='display:none' <?php } else { ?> style='display:true' <?php } ?>>
                                <?php echo $this->Form->control('famillerotation_id', ['empty' => 'Veuillez choisir !!', 'options' => $famillerotations, 'class' => 'form-control select2 control-label', 'label' => "Famille rotation:"]); ?>
                            </div> -->
                            <div class="col-xs-6">
                                <?php echo $this->Form->control('remise', ['class' => 'form-control  control-label', 'label' => "Remise %:"]); ?>
                            </div>
                        </div>
                    </div>
                    <div hidden class="row">
                        <div hidden style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                            <div hidden class="col-xs-6" id="nombrepiece" <?php if ($article->famille_id == 2) { ?> style='display:none' <?php } else { ?> style='display:true' <?php } ?>>
                                <?php echo $this->Form->control('nombrepiece', ['type' => 'number', 'class' => 'form-control  control-label', 'label' => "Nombre de piece par carton:"]); ?>
                            </div>
                        </div>
                    </div>
                    <div hidden class="row">
                        <div hidden style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                            <div hidden class="col-xs-6" id="nbjour" <?php if ($article->famille_id == 2) { ?> style='display:none' <?php } else { ?> style='display:true' <?php } ?>>
                                <?php echo $this->Form->control('nbjour', ['type' => 'number', 'class' => 'form-control  control-label', 'label' => "Nombre de jour:"]); ?>
                            </div>
                            <div hidden class="col-xs-6" id="nbpoint" <?php if ($article->famille_id == 2) { ?> style='display:none' <?php } else { ?> style='display:true' <?php } ?>>
                                <?php echo $this->Form->control('nbpoint', ['type' => 'number', 'class' => 'form-control  control-label', 'label' => "Nombre de points:"]); ?>
                            </div>
                        </div>
                    </div>
                    <div hidden class="row">
                        <div hidden style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                            <div hidden class="col-xs-6" id="nbpiecepalette" <?php if ($article->famille_id == 2) { ?> style='display:none' <?php } else { ?> style='display:true' <?php } ?>>
                                <?php echo $this->Form->control('nbpiecepalette', ['type' => 'number', 'class' => 'form-control  control-label', 'label' => "Nombre de carton par palette:"]); ?>
                            </div>
                            <div hidden class="col-xs-6" id="coefficient" <?php if ($article->famille_id == 2) { ?> style='display:none' <?php } else { ?> style='display:true' <?php } ?>>
                                <?php echo $this->Form->control('coefficient', ['type' => 'number', 'class' => 'form-control  control-label', 'label' => "Coefficient:"]); ?>
                            </div>
                        </div>
                    </div>
                    <div hidden class="row">
                        <div hidden style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                            <div hidden class="col-xs-6" id="densite" <?php if ($article->famille_id == 2) { ?> style='display:true' <?php } else { ?> style='display:none' <?php } ?>>
                                <?php echo $this->Form->control('densite', ['class' => 'form-control  control-label', 'label' => "Densite:"]); ?>
                            </div>
                        </div>
                    </div>
                    <div hidden class="row">
                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                            <div class="col-xs-6">
                                <?php echo $this->Form->control('qteoptimalmelange', ['class' => 'form-control  control-label', 'label' => "Quantité optimal mélange "]); ?>
                            </div>


                            <div class="col-xs-6">
                                <?php echo $this->Form->control('qteoptimalproduction', ['class' => 'form-control  control-label', 'label' => "Quantité optimal production"]); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">







                            <div class="col-xs-6" id="devise" <?php if ($article->famille_id == 2) { ?> style='display:true' <?php } else { ?> style='display:none' <?php } ?>>

                                <?php echo $this->Form->control('devise', ['name' => 'devise_id', 'empty' => 'Veuillez choisir !!', 'options' => $devices, 'class' => 'form-control select2 control-label', 'label' => "Devise:"]); ?>
                            </div>

                        </div>
                    </div>
                    <br>
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div hidden style="margin-top:20px" class="col-xs-8">
                            <label class="control-label" for="unipxte-id" style="margin-right: 20px"> Destine a la vente :</label>

                            <input type="hidden" id="vente" name="vente">

                            <input class="afficherfiche" type="checkbox" id="ventee" name="vente" value="1" <?php if ($article->vente == 1) { ?> checked="true" <?php } ?> </div>
                        </div>
                        <div hidden style="margin-top:20px" id="mobile" class="col-xs-8" <?php if ($article->famille_id == 2) { ?> style='display:none' <?php } else { ?> style='display:true' <?php } ?>>
                            <div class="col-xs-6">

                                <label class="control-label" for="unipxte-id" style="margin-right: 20px"> Mobile </label>
                                <input type="hidden" id="mobile" name="mobile">
                                <input class="afficherfiche" type="checkbox" id="mobilee" name="mobile" value="1" <?php if ($article->mobile == 1) { ?> checked="true" <?php } ?>>
                            </div>


                        </div>

                        <div style="width:75%; margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                            <label class="control-label" for="unipxte-id" style="margin-right: 20px"> Etat :</label>

                            Activ&eacute <input type="radio" name="etat" value="0" id="active" class="" <?php if ($article->etat == 0) { ?> checked="checked" <?php } ?>>
                            D&eacute;sactiv&eacute <input type="radio" name="etat" value="1" id="desactive" class="" <?php if ($article->etat == 1) { ?> checked="checked" <?php } ?>>
                            <br>
                            <label hidden class="control-label" for="unipxte-id" style="margin-right: 20px">Fodec :</label>

                            <input hidden type="radio" name="fodec" value="<?php echo $fodec ?>" id="OUI" class="calculprixarticle" style="margin-right: 20px" <?php if ($article->fodec != 0) { ?> checked="checked" <?php } ?>>
                            <input hidden type="radio" name="fodec" value="0" id="NON" class="calculprixarticle" <?php if ($article->fodec == 0) { ?> checked="checked" <?php } ?>>
                            <br>

                            <label hidden class="control-label" for="unipxte-id" style="margin-right: 20px">Tpe (%):</label>

                            <!-- OUI  -->
                            <input hidden type="radio" name="TXTPE" value="<?php echo $tpe ?>" id="OUItpe" class="calculprixarticle" style="margin-right: 20px" class="" style="margin-right: 20px" <?php if ($article->TXTPE != 0) { ?> checked="checked" <?php } ?>>
                            <!-- NON  -->
                            <input hidden type="radio" name="TXTPE" value="0" id="NONtpe" class="calculprixarticle" <?php if ($article->TXTPE == 0) { ?> checked="checked" <?php } ?>>



                        </div>
                    </div>
                    <br><br>

                    <div class="row" class="col-md-12 ">
                        <br>
                        <div style="display:flex;">
                            <div style="width:80%; margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="col-xs-6" align="center">
                                    <?php echo $this->Html->image('imgart/' . $article->image, ['style' => 'max-width:100px;height:100px;']); ?>
                                </div>



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




                        <?php //echo $comm; 
                        ?>


                        <div align="center">
                            <button type="submit" class="pull-right btn btn-success " id="ajouarticle" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
                            <!-- <?php echo $this->Form->submit(__('Enregistrer'), ['id' => 'ajouarticle']); ?> -->
                        </div>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
</div>
</section>
<script type="text/javascript">
    $(function() {
        $(function() {
            $(".getunitearticle").on("change", function() {
                ind = $(this).attr("index");
                index = $("#index").val();
                article_id = $("#article_id" + ind).val();
                if (article_id != "") {
                    $.ajax({
                        method: "GET",
                        url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'getunite']) ?>",
                        dataType: "json",
                        data: {
                            article_id: article_id,
                        },
                        headers: {
                            "X-CSRF-Token": $('meta[name="csrfToken"]').attr("content"),
                        },
                        success: function(data) {
                            $('#unitearticle_id' + ind).val(data.unitearticle_id);
                        },
                    });
                } else {
                    $('#unitearticle_id' + ind).val("");
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
                // } 
                // else {
                //     document.getElementById('soussous').disabled = true;
                //     document.getElementById('sous').disabled = true;
                // }



            });


        });
    });
    $(function() {
        $('.tva').on('change', function() {
            // alert('hello');
            id = $('#tvaselect').val(); //alert(id)
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
                success: function(data) {
                    //  alert(data);
                    $('#tva').val(data.valeur);
                    prix = Number($('#Prix_LastInput').val());
                    tva = Number($('#tva').val());
                    // $('#tva').val(id);
                    // tvas = Number($('#tva').val());

                    // if (tvas == 5) {
                    //     tva = 19;
                    // } else if (tvas == 6) {
                    //     tva = 7;
                    // } else {
                    //     tva = 0;
                    // }


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
                success: function(data) {
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
    $(function() {
        $('#code').on('blur', function() {
            codearticle = $('#code').val();
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
                success: function(data) {
                    // alert('hello');
                    //alert(data.select);
                    //  $('#divsous').html(data.select);
                    // uniform_select('divsous');
                    if (codearticle != '') {
                        if (data.codeexistant.length != 0) {
                            alert("Code article deja reserve !!");
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
    $(function() {
        //Initialize Select2 Elements
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
        //Date range as a button
        $('#daterange-btn').daterangepicker({
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
            function(start, end) {
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