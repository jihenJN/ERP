<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fournisseur $fournisseur
 */
?>
<style>
    .hidden {
        display: none;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php
echo $this->Html->script('salma');
echo $this->Html->script('hechem');


?>
<?php echo $this->Html->css('select2'); ?>

<script>
    function openWindow(h, w, url) {
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }
</script>
<?php echo $this->fetch('script'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Modification client
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i>
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
                // debug($ar);
                //    foreach ($ar as $a){debug($a->id);}
                echo $this->Form->create($client, ['role' => 'form', 'type' => 'file', 'onkeypress' => "return event.keyCode!=13"]);
                // debug($client);
                //debug($client->nouveau_client);
                //debug($client->client_id);
                ?>
                <div class="box-body">
                    <div class="row">
                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('Code', ['readonly' => 'readonly']); ?>
                                </div>
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('codeancienne', ['label' => 'Code Ancienne', 'id' => 'codeancienne']); ?>


                                </div>

                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('Raison_Sociale'); ?>
                                </div>
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('Email', ['class' => 'validationMail control-label form-control']); ?>
                                </div>
                                <div class="col-xs-6" hidden>
                                    <?php echo $this->Form->control('idclient', ['type' => 'hidden', 'label' => '', 'id' => 'idclient', 'value' => $client->id, 'class' => 'form-control']); ?>

                                    <?php echo $this->Form->control('pay_id', ['label' => 'Pays', 'id' => 'pay_id', 'value' => $client->pay_id, 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 pays']); ?>


                                </div>

                            </div>
                        </div>


                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="col-xs-6">

                                    <div class="form-group input text " id="">
                                        <?php echo $this->Form->control('type_id', ['empty' => 'Veuillez choisir !!', 'options' => $types, 'Veuillez choisir !!', 'id' => 'type_id', 'name' => 'type_id', 'class' => 'form-control select2 control-label']); ?>
                                    </div>
                                </div>
                                <?php
                                $matStyle = ($client->type_id == 1) ? '' : 'style="display:none;"';
                                $idenStyle = ($client->type_id == 2) ? '' : 'style="display:none;"';
                                ?>
                                <div class="col-xs-6" id="mat" <?php echo $matStyle; ?>>
                                    <?php echo $this->Form->control('Matricule_Fiscale', [
                                        'id' => 'matriculefis',
                                        'label'=>'Matricule Fiscale',
                                        'class' => 'form-control verifiermatriculefiscale',
                                        'placeholder' => "0000000XXX000"
                                    ]); ?>
                                </div>

                                <div class="col-xs-6" id="iden" <?php echo $idenStyle; ?>>
                                    <?php echo $this->Form->control('numidentite', [
                                        'id' => 'numidentite',
                                        'label'=>'Num Identité',
                                        'class' => 'form-control',
                                        'placeholder' => "00 00 00 00"
                                    ]); ?>
                                </div>











                            </div>
                        </div>

                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                                <div class="col-xs-6" hidden>
                                    <?php echo $this->Form->control('Fax'); ?>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('registre', ['label' => 'Registre de commerce', 'type' => 'text', 'class' => ' control-label form-control']); ?>
                                </div>
                                <div class="col-xs-6" hidden>
                                    <?php echo $this->Form->control('codedouane', ['label' => 'Code en douane', 'type' => 'text', 'class' => ' control-label form-control']); ?>
                                </div>
                                <!-- <div class="col-xs-6">
                                    <?php echo $this->Form->control('Tel', ['label' => 'Telephone', 'type' => 'text', 'class' => 'validationLengthChampTel control-label form-control']); ?>
                                </div> -->
                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('Tel', ['id' => 'tel', 'label' => 'Télèphone 1', 'class' => 'validationLengthChampTel form-control control-label', 'type' => 'text']); ?>
                                </div>
                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('Tel1', ['id' => 'tel', 'label' => 'Télèphone 2', 'class' => 'validationLengthChampTel form-control control-label', 'type' => 'text']); ?>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static;display:flex ">

                                <div class=" col-xs-6 form-group input text ">

                                    <?php echo $this->Form->control('paiement_id', ['empty' => 'Veuillez choisir SVP!!', 'options' => $paiements, 'label' => 'Mode paiement', 'class' => 'form-control select2   afficher_date', 'id' => 'paiement_id', 'required' => 'off']); ?>
                                </div>
                                <!-- <div class=" col-xs-1" style="margin-top: 2.2%;">
                                            <span title="ajout paiement"> <a onclick="openWindow(1000, 1000, 'http://localhost:8765/paiements/add');" champ="orderr" value="0" class="btn btn-primary"><i class="fa fa fa-plus"></i></a> </span>
                                        </div> -->
                                <!-- 
                                        <div class="col-xs-6">
                                            <?php echo $this->Form->control('compteclient', ['id' => 'compte', 'label' => 'Compte client', 'type' => 'text']); ?>
                                        </div> -->
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('typeexoneration_id', ['label' => 'Exoneration', 'empty' => 'Veuillez choisir !!', 'options' => $typeexonerations, 'class' => 'form-control select2 control-label typeexoneration', 'id' => 'exonerations', 'required' => 'off']); ?>

                                </div>
                                <?php $val = 0;
                                if ($client['nbr_jours'] != '') {
                                    $val = $client['nbr_jours'];
                                } ?>



                                <!-- <div class=" col-xs-6 " id="date" <?php if ($val != 0) { ?> style="display:true" <?php } else { ?> style="display:none" <?php } ?>>
                                            <?php
                                            echo $this->Form->input('nbr_jours', array('name' => 'nbr_jours', 'label' => 'Nombre jours echeance', 'id' => 'nbr_jours', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'text'));
                                            ?>
                                        </div>
 -->

                                <br>
                                <?php $v = 0;
                                if ($client->finmois == null) {
                                    $v = $client->finmois;
                                } ?>
                                <!-- <div id="finmois" <?php if ($v != null) { ?> style="display:true" <?php } else { ?> style="display:none" <?php } ?> class="col-xs-6" style="margin-left:10px;">

                                            <label class="control-label" for="unite-id"> Fin mois :</label>

                                            Oui <input type="radio" name="finmois" value=1 id="oui" class="" style="margin-right: 20px" <?php if ($client->finmois == 1) { ?> checked="checked" <?php } ?>>
                                            Non <input type="radio" name="finmois" value=0 id="non" class="" style="margin-right: 20px" <?php if ($client->finmois  != NULL && $client->finmois == 0) { ?> checked="checked" <?php } ?>>
                                        </div> -->
                                <?php ?>



                            </div>







                        </div>
                    </div>


                    <!--                            
                            <div class="row">
                                <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static;display:flex ">
                                    <?php //if ($client->paiement_id != 0) { 
                                    ?>
                                        <div class=" col-xs-6 form-group input text " style="width:43%;">
                                            <?php //echo $this->Form->control('paiement_id', ['options' => $paiements, 'label' => 'Mode paiement', 'class' => 'form-control select2   afficher_date', 'id' => 'paiement_id', 'required' => 'off']); 
                                            ?>
                                            <?php //if ($client['datedebut_echeance'] != '')  
                                            ?>
                                            <div class=" col-xs-6 ">
                                                <?php
                                                // echo $this->Form->input('nbr_jours', array('name' => 'nbr_jours', 'label' => 'Nombre jours echeance', 'id' => 'nbr_jours', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control afficher_date', 'type' => 'text'));
                                                ?>
                                            </div>
                                        </div>
                                    <?php //} else { 
                                    ?>
                                        <div class=" col-xs-4 form-group input text " style="width:43%">
                                            <?php //echo $this->Form->control('paiement_id', ['options' => $paiements, 'label' => 'Mode paiement', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 control-label   afficher_date ', 'id' => 'paiement_id', 'required' => 'off']); 
                                            ?>
                                            <div  id="date" class=" afficher_date"style="display:none">
                                                <div class=" col-xs-6 " align="center">
                                                    <?php
                                                    //echo $this->Form->input('nbr_jours', array('name' => 'nbr_jours', 'label' => 'Nombre jours', 'id' => 'nbr_jours', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'text'));
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php // } 
                                    ?>
                                    <div class=" col-xs-2" style="margin-top: 22px; width: 60px;margin-right: 25px;">
                                        <span title="ajout paiement"> <a onclick="openWindow(1000, 1000, 'http://localhost:8765/paiements/add');" champ="orderr" value="0" class="btn btn-primary"><i class="fa fa fa-plus"></i></a> </span>
                                    </div>
                                    <div class="col-xs-6">
                                        <?php //echo $this->Form->control('Tel',['label' => 'Telephone', 'type'=>'text','class' => 'validationLengthChampTel control-label form-control']); 
                                        ?>
                                    </div>
                                </div>
                            </div>

-->












                    <div class="row">
                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">


                            <div class="col-xs-6" hidden>
                                <?php echo $this->Form->control('typeclient_id', ['label' => 'Type client', 'empty' => 'Veuillez choisir !!', 'options' => $typeclients, 'class' => 'form-control select2 control-label', 'id' => 'typeclient_id', 'required' => 'off']); ?>

                            </div>






                        </div>
                    </div>




                    <!--*************************************************************************************************-->


                    <div class="row">
                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                            <div class="col-xs-6" hidden>
                                <?php echo $this->Form->control('adresse1', ['label' => 'Adresse 1', 'class' => 'form-control  adresse control-label validationMail', 'id' => 'adr']); ?>



                            </div>
                            <div class="col-xs-6" hidden>
                                <?php echo $this->Form->control('ct', ['id' => 'adress', 'type' => 'hidden']); ?>
                            </div>
                            <div class="col-xs-6" hidden>
                                <?php echo $this->Form->control('Adresse', ['readonly' => 'readonly', 'class' => 'form-control  control-label validationMail', 'id' => 'adresses']); ?>
                            </div>

                            <?php if ($client->date_ajout != null) { ?>
                                <div class="col-xs-6">
                                    <?php
                                    echo $this->Form->control('date_ajout', ['empty' => true, 'readonly' => 'readonly', 'type' => 'date', 'class' => 'form-control ']);
                                    ?>
                                </div>
                            <?php } else { ?>
                                <div class="col-xs-6">
                                    <?php
                                    echo $this->Form->control('date_ajout', ['empty' => true, 'type' => 'date', 'class' => 'form-control ']);
                                    ?>
                                </div>
                            <?php } ?>
                            <div class="col-xs-6" >
                                    <?php echo $this->Form->control('responsable', ['id' => 'responsable','label'=>'Responsable']); ?>
                                </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12">
                    <i class="fa fa-eye-slash fa-2x close" aria-hidden="true"></i>

                    <table class="tableclose table table-bordered">
                        <tr hidden>
                            <td><b>Remise %</b> </td>
                            <td><?php echo $this->Form->control('remise', ['label' => false, 'class' => 'form-control  control-label ', 'id' => 'rem', 'type' => 'text']); ?></td>
                            <td style="text-align:center ;"><b>
                                    Palier :</b>
                            </td>



                            <td colspan="2">
                                Remise avec palier : <input type="radio" value="1" <?php if ($client->typeremise == 1) { ?> checked="checked" <?php } ?> id="" class="choix1" name="typeremise" style="margin-right: 20px  ">
                                Remise sans palier : <input type="radio" value="0" <?php if ($client->typeremise == 0) { ?> checked="checked" <?php } ?>id="" class="choix2" name="typeremise" style="margin-right: 20px  ">

                            </td>
                        </tr>



                        <tr hidden>
                            <td><b>Escompte :</b> </td>

                            <td><?php echo $this->Form->control('escompte', ['label' => false, 'class' => 'form-control  control-label ', 'id' => 'escom', 'type' => 'text']); ?>
                            </td>
                            <td style="text-align:center ;"><b>
                                    Palier :</b>

                            </td>

                            <td colspan="2">
                                escompte avec palier <input type="radio" name="typeescompte" style="margin-right: 20px  " id="" class="choix1" value="1" <?php if ($client->typeescompte == 1) { ?> checked="checked" <?php } ?>>
                                escompte sans palier <input type="radio" name="typeescompte" value="0" id="" class="choix2" <?php if ($client->typeescompte == 0) { ?> checked="checked" <?php } ?>>

                            </td>


                        </tr>
                        <tr hidden>
                            <td><b>Prix:</b> </td>
                            <td>
                                <input type="radio" name="prix" value="PHT" class="livraison" style="margin-right:10px" <?php if ($client->prix == 'PHT') { ?> checked="checked" <?php } ?>>PHT
                            </td>
                            <td> <input type="radio" name="prix" value="PHT+Fodec" class="livraison" style="margin-right:10px" <?php if ($client->prix == 'PHT+Fodec') { ?> checked="checked" <?php } ?>> PHT+Fodec
                            </td>


                            <td> <input type="radio" name="prix" value="(PHT-Remise)+Fodec" class="livraison" style="margin-right:10px" <?php if ($client->prix == '(PHT-Remise)+Fodec') { ?> checked="checked" <?php } ?>> (PHT-Remise)+Fodec

                            </td>
                            <td>
                                <input type="radio" name="prix" value="((PHT-Remise)-Escompte)+Fodec" class="livraison" style="margin-right:10px" <?php if ($client->prix == '((PHT-Remise)-Escompte)+Fodec') { ?> checked="checked" <?php } ?>>((PHT-Remise)-Escompte)+Fodec
                            </td>



                        </tr>
                        <tr hidden>
                            <td>
                                <b>Autorisation Livraison : </b>
                            </td>
                            <td colspan="3">
                                Oui <input type="radio" name="Autorisation_Livraison" value="TRUE" id="actif" class="choixcollisage" style="margin-right: 20px" <?php if ($client->Autorisation_Livraison == "TRUE") { ?> checked="checked" <?php } ?>>
                                Non <input type="radio" name="Autorisation_Livraison" value="FALSE" id="nonactif" class="choixcollisage" <?php if ($client->Autorisation_Livraison == "FALSE") { ?> checked="checked" <?php }   ?>>

                            </td>
                        </tr>
                        <tr hidden>
                            <td>
                                <b>
                                    Nouveau client :</b>
                            </td>
                            <td>
                                Oui <input class=" afficherancienclient" type="radio" name="nouveau_client" value="TRUE" id="oui" style="margin-right: 20px" <?php if ($client->nouveau_client == 'TRUE') { ?> checked="checked" <?php } ?>>
                                Non <input class=" afficherancienclient" type="radio" name="nouveau_client" value="FALSE" id="non" style="margin-right: 20px" <?php if ($client->nouveau_client == 'FALSE') { ?> checked="checked" <?php }
                                                                                                                                                                                                                                    ?>>
                            </td>

                            <td class="afficher" id="afficher" <?php if ($client->nouveau_client == 'FALSE') { ?> style='display:' <?php } ?> <?php if ($client->nouveau_client == 'TRUE') { ?> style='display:none' <?php } ?>>
                                <b>
                                    Ancien clients </b>
                            </td>

                            <td id="afficher" <?php if ($client->nouveau_client == 'FALSE') { ?> style='display:block' <?php } ?> <?php if ($client->nouveau_client == 'TRUE') { ?> style='display:none' <?php } ?> class="afficher" colspan="2">
                                <?php echo $this->Form->control('client_id', ['label' => '', 'empty' => 'Veuillez choisir !!', 'name' => 'client_id', 'options' => $cli, 'class' => 'form-control  select2 control-label', 'id' => 'ancien_client']); ?>

                            </td>

                        </tr>
                        <tr>
                            <td>
                                <b>
                                    Etat :</b>
                            </td>
                            <td>
                                Actif
                                <input type="radio" name="etat" value="TRUE" id="observation" class="observation" style="margin-right: 20px" <?php if ($client->etat == 'TRUE') { ?> checked="checked" <?php } else if ($client->etat == null)  ?> checked="checked">

                                Non actif <input type="radio" name="etat" value="FALSE" id="observation" class="observation" <?php if ($client->etat == 'FALSE') { ?> checked="checked" <?php } ?>>

                            </td>
                            <td class="afficher1" <?php if ($client->etat == "true") { ?> style='display:block' <?php } ?> <?php if ($client->etat == 'FALSE') { ?> style='display:none' <?php } ?>>
                                <b>
                                    Observation :</b>
                            </td>
                            <td colspan="3" <?php if ($client->etat == 'true') { ?> style='display:block' <?php } ?> <?php if ($client->etat == 'FALSE') { ?> style='display:none' <?php } ?> class="afficher1">
                                <textarea id="observationtext" name="observation" class="form-control" rows="3" placeholder="Enter ..."> <?php echo $client->observation ?></textarea>

                            </td>

                        <tr>
                            <!-- <td>
                                <b> BL : </b>
                            </td>
                            <td>
                                Oui <input type="radio" name="bl" value="1" id="" class="choixcollisage" style="margin-right: 20px" <?php if ($client->bl == 1) { ?> checked="checked" <?php } ?>>
                                Non <input type="radio" name="bl" value="0" id="" class="choixcollisage" <?php if ($client->bl == 0) { ?> checked="checked" <?php }   ?>>

                            </td> -->

                            <td class="hiddenob">
                                <b>
                                    platfond théorique :</b>
                            </td>
                            <td class="hiddenob" colspan="3">
                                <?php echo $this->Form->control('plafontheorique', ['label' => '', 'class' => 'form-control', 'id' => '']); ?>


                            </td>
                            <td class="hiddenob">
                                <b>
                                    Solde Début:</b>
                            </td>
                            <td class="hiddenob">
                                <?php echo $this->Form->control('soldedebut', ['label' => '', 'class' => 'form-control', 'id' => 'soldedebut']); ?>


                            </td>
                        </tr>

                        </tr>
                    </table>
                </div>



                <!--        <div class="row">
                                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                        <div class="col-xs-6 ">
                                        <?php echo $this->Form->control('remise', ['label' => 'Remise%', 'class' => 'form-control  control-label ', 'id' => 'rem']); ?>
                                        </div>

                                        
                                        <div class="col-xs-6 ">
                                        <label>Escomptes :</label><input class='form-control' value="<?php echo sprintf("%.3f", ['escompte']) ?>" type="text"  id='escom'>
                                        
                                    </div>
                                       
                                        </div> -->
                <!--                                         </div>
 --> <!--**************************************************************************************-->
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <!--  <?php if ($client->typeremise == 1) { ?>
                                        <div class="col-xs-6" style="margin-bottom:2.5%;">
                                            <label class="control-label"  style="margin-right: 20px">Palier</label>
                                         Remise avec palier : <input type="radio" name="radio" value="0" id="active" class="choix1" style="margin-right: 20px  " >
                                         Remise sans palier <input type="radio" name="radio" value="1" id="desactive" class="choix2" checked="checked">
                                          <?php echo $this->Form->control('typeremise', ['type' => 'hidden', 'label' => '', 'id' => 'palier', 'required' => 'off', 'div' => 'form-group',   'class' => 'form-control ']); ?>
                                        </div>
                                          <?php } ?>
                                        <?php if ($client->typeremise == 0) { ?>
                                        <div class="col-xs-6" style="margin-bottom:2.5%;">
                                            <label class="control-label"  style="margin-right: 20px">palier</label>
                                            Remise avec palier : <input type="radio" name="radio" value="1" id="active" class="choix1" style="margin-right: 20px " checked="checked">
                                            Remise sans palier<input type="radio" name="radio" value="0" id="desactive" class="choix2" >
                                        <?php echo $this->Form->control('typeremise', ['type' => 'hidden', 'label' => '', 'id' => 'palier', 'required' => 'off', 'div' => 'form-group',   'class' => 'form-control ']); ?>
                                        </div>
                                        <?php } ?> -->




                        <!--  
                                        <?php if ($client->typeescompte == 1) { ?>
                                        <div class="col-xs-6" style="margin-bottom:2.5%;" >
                                            <label class="control-label"  style="margin-right: 20px">palier</label>
                                            escompte avec palier <input type="radio" name="box" value="0" id="on" class="choix1" style="margin-right: 20px  " >
                                            escompte sans palier <input type="radio" name="box" value="1" id="off" class="choix2" checked="checked">
                                          <?php echo $this->Form->control('typeescompte', ['type' => 'hidden', 'label' => '', 'id' => 'es', 'required' => 'off', 'div' => 'form-group',   'class' => 'form-control ']); ?>
                                        </div>
                                          <?php } ?>
                                        <?php if ($client->typeescompte == 0) { ?>
                                        <div class="col-xs-6" style="margin-bottom:2.5%;">
                                            <label class="control-label"  style="margin-right: 20px">palier</label>
                                            escompte avec palier <input type="radio" name="box" value="1" id="on" class="choix1" style="margin-right: 20px " checked="checked">
                                            escompte sans palier <input type="radio" name="box" value="0" id="off" class="choix2" >
                                        <?php echo $this->Form->control('typeescompte', ['type' => 'hidden', 'label' => '', 'id' => 'es', 'required' => 'off', 'div' => 'form-group',   'class' => 'form-control ']); ?>
                                        </div>
                                        <?php } ?> -->



                    </div>
                </div>
                <!--*********************************************************************************************-->


                <!--  <div class="row">
                                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                        <div class="col-xs-6">
                                            <?php echo $this->Form->control('Email', ['class' => 'validationMail control-label form-control']); ?>
                                        </div>
                                        <?php if ($client->date_ajout != null) { ?>
                                            <div class="col-xs-6">
                                                <?php
                                                echo $this->Form->control('date_ajout', ['empty' => true, 'readonly' => 'readonly', 'type' => 'date', 'class' => 'form-control ']);
                                                ?>
                                            </div>
                                        <?php } else { ?>
                                            <div class="col-xs-6">
                                                <?php
                                                echo $this->Form->control('date_ajout', ['empty' => true, 'type' => 'date', 'class' => 'form-control ']);
                                                ?>
                                            </div>
                                        <?php } ?> -->

                <!--
                                        <div class="col-xs-6">
                                            <label class="control-label" for="unite-id" style="margin-right: 20px"> Prix:</label>
                                            <br>
                                         <table>
                                                <tr>
                                                    <td>
                                                        <input type="radio" name="prix" value="PHT" class="livraison" style="margin-right:10px" <?php if ($client->prix == 'PHT') { ?> checked="checked" <?php } ?>>PHT
                                                    </td>
                                                    <td> <input type="radio" name="prix" value="PHT+Fodec" class="livraison" style="margin-right:10px" <?php if ($client->prix == 'PHT+Fodec') { ?> checked="checked" <?php } ?>> PHT+Fodec </td>
                                                </tr>
                                                <tr>
                                                    <td> <input type="radio" name="prix" value="(PHT-Remise)+Fodec" class="livraison" style="margin-right:10px" <?php if ($client->prix == '(PHT-Remise)+Fodec') { ?> checked="checked" <?php } ?>> (PHT-Remise)+Fodec </td>
                                                    <td> <input type="radio" name="prix" value="((PHT-Remise)-Escompte)+Fodec" class="livraison" style="margin-right:10px" <?php if ($client->prix == '((PHT-Remise)-Escompte)+Fodec') { ?> checked="checked" <?php } ?>>((PHT-Remise)-Escompte)+Fodec </td>
                                                </tr>
                                            </table> -->
                <!--                                         </div>
 -->





                <br>









                <!-- 
                                <div class="row">
                                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static;display:flex "> -->
                <!-- <div class="col-xs-6" style="margin-left:10px;">

                                            <label class="control-label" for="unite-id" style="margin-right: 20px"> Autorisation Livraison :</label>
                                            Oui <input type="radio" name="Autorisation_Livraison" value="TRUE" id="actif" class="choixcollisage" style="margin-right: 20px" <?php if ($client->Autorisation_Livraison == "TRUE") { ?> checked="checked" <?php } ?>>
                                            Non <input type="radio" name="Autorisation_Livraison" value="FALSE" id="nonactif" class="choixcollisage" <?php if ($client->Autorisation_Livraison == "FALSE") { ?> checked="checked" <?php }   ?>>



                                        </div> -->




                <!--    <div class="col-xs-6" style="margin-left:10px;">

                                            <label class="control-label" for="unite-id" style="margin-right: 20px"> Etat :</label>

                                            Actif <input type="radio" name="etat" value="TRUE" id="observation" class="observation" style="margin-right: 20px" <?php if ($client->etat == 'TRUE') { ?> checked="checked" <?php } else if ($client->etat == null)  ?> checked="checked">








                                            Non actif <input type="radio" name="etat" value="FALSE" id="observation" class="observation" <?php if ($client->etat == 'FALSE') { ?> checked="checked" <?php } ?>>


                                        </div> -->
                <!--     </div>
                                </div> -->


                <!-- 
                                <div class="row">
                                    <div style="margin-left:46%; position: static;display:flex;margin-bottom:10px ">


                                        <div class="col-xs-6 obs" c type="">
                                            <div class="form-group">
                                                <label>Observation</label>
                                                <textarea name="observation" class="form-control" rows="3" placeholder="Enter ..."> <?php echo $client->observation ?></textarea>
                                            </div>


                                        </div>





                                    </div>
                                </div> -->

                <!--          <div class="row">
                                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static;display:flex ">





                                        <div class="col-xs-6" style="margin-left:10px;">

                                            <label class="control-label" for="unite-id" style="margin-right: 20px"> Nouveau client :</label>
                                            <?php
                                            // debug($client->nouveau_client);
                                            //debug($client->client_id);
                                            ?>

                                            Oui <input class=" afficherancienclient" type="radio" name="nouveau_client" value="TRUE" id="oui" style="margin-right: 20px" <?php if ($client->nouveau_client == 'TRUE') { ?> checked="checked" <?php } ?>>
                                            Non <input class=" afficherancienclient" type="radio" name="nouveau_client" value="FALSE" id="non" style="margin-right: 20px" <?php if ($client->nouveau_client == 'FALSE') { ?> checked="checked" <?php }
                                                                                                                                                                                                                                                ?>>
 

                                        </div>
                                        <div class="col-xs-6" style="margin-left:10px;">
                                        </div>
                                    </div>
                                </div> -->


                <!--   <div class="row">
                                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static;display:flex ">
                                        <div class="col-xs-6" style="margin-left:10px;">

                                            <div id="afficher" <?php if ($client->nouveau_client == 'FALSE') { ?> style='display:' <?php } ?> <?php if ($client->nouveau_client == 'TRUE') { ?> style='display:none' <?php } ?>>
                                                <?php echo $this->Form->control('client_id', ['label' => '', 'empty' => 'Veuillez choisir !!', 'name' => 'client_id', 'options' => $cli, 'class' => 'form-control  select2 control-label', 'id' => 'ancien_client']); ?>
                                            </div>
                                        </div>



                                    </div>
                                </div> -->























                <br />




                <section class="content-header" hidden>
                    <h1 class="box-title"><?php echo __('Prix Client'); ?></h1>
                </section>
                <section class="content" style="width: 99%" hidden>
                    <div class="row">
                        <div class="box">
                            <div class="box-header with-border">
                                <a class="btn btn-primary  " table='addtable' index='index' id='ajouter_ligne6' style="
                                           float: right;
                                           margin-bottom: 5px;
                                           ">
                                    <i class="fa fa-plus-circle "></i> Ajouter prix au client</a>

                            </div>
                            <div class="panel-body">
                                <div class="table-responsive ls-table">
                                    <table class="table table-bordered table-striped table-bottomless" id="tabligne6">

                                        <thead>
                                            <tr width:20px">
                                                <td align="center" style="width: 25%;"><strong>Article</strong></td>
                                                <td align="center" style="width: 25%;"><strong>Prix</strong></td>
                                                <td hidden align="center" style="width: 25%;"><strong>inserted</strong></td>
                                                <td hidden align="center" style="width: 25%;"><strong>updated</strong></td>
                                                <td align="center" style="width: 25%;"></td>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $i = 0;
                                            $ca = array();
                                            foreach ($clientarticles as $i => $ca) :
                                                //debug($ca);
                                            ?>
                                                <tr class=''>
                                                    <td style="width: 8%;" align="center">

                                                        <?php
                                                        echo $this->Form->input('id', array('label' => '', 'value' => $ca['id'], 'champ' => 'id', 'name' => 'data[prixarticle][' . $i . '][id]', 'type' => 'hidden', 'id' => 'id' . $i, 'table' => 'prixarticle', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));

                                                        echo $this->Form->input('supprix', array('name' => 'data[prixarticle][' . $i . '][supprix]', 'id' => 'supprix' . $i, 'champ' => 'supprix', 'table' => 'prixarticle', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                        ?>
                                                        <div style="margin-top:4%;">
                                                            <!--                                                        <?php //debug($ar);
                                                                                                                        // echo $this->Form->control('article', array( 'empty' => 'Veuillez choisir !!','options' => $ar, 'champ' => 'article', 'label' => '', 'name' => '', 'id' => '', 'table' => 'prixarticle', 'index' => '', 'div' => 'form-group ', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ')); 
                                                                                                                        ?> -->



                                                            <select style="width:100%" name="<?php echo "data[prixarticle][" . $i . "][article_id]" ?>" width="200px" id="<?php echo 'article' . $i ?>" style="width:200px" table="ligner" index="<?php echo $i ?>" champ="article_id" class="js-example-responsive select2 articleidbl1 article">
                                                                <option value="" disabled>Veuillez choisir !!</option>
                                                                <?php
                                                                foreach ($articless as $id => $a) {
                                                                    //debug($ar);
                                                                ?>
                                                                    <option <?php if ($ca->article_id == $a->id) { ?> selected="selected" <?php } ?> value="<?php echo $a->id; ?>"><?php echo $a->Code . ' ' . $a->Dsignation ?></option>
                                                                <?php } ?>
                                                            </select>





                                                        </div>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('prix', array('value' => $ca['prix'], 'label' => '', 'champ' => 'prix', 'name' => 'data[prixarticle][' . $i . '][prix]', 'type' => 'text', 'id' => 'prix' . $i, 'table' => 'prixarticle', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control four1 prix')); ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('inserted', array('value' => $ca['inserted'], 'label' => '', 'champ' => 'inserted', 'name' => 'data[prixarticle][' . $i . '][inserted]', 'type' => 'text', 'id' => 'inserted' . $i, 'table' => 'prixarticle', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                    </td>

                                                    <td align="center">
                                                        <?php echo $this->Form->input('updated', array('value' => $ca['updated'], 'label' => '', 'champ' => 'updated', 'name' => 'data[prixarticle][' . $i . '][updated]', 'type' => 'text', 'id' => 'updated' . $i, 'table' => 'prixarticle', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                    </td>

                                                    <td align="center"><i index="<?php echo $i ?>" id="" class="fa fa-times supprix" style="color: #C9302C;font-size: 22px;"></td>
                                                </tr>


                                            <?php endforeach;
                                            $i++ ?>



                                            <tr class='tr' style="display: none !important">
                                                <td style="width: 8%;" align="center">

                                                    <?php // debug($articles);    
                                                    ?>

                                                    <?php echo $this->Form->input('supprix', array('name' => '', 'id' => '', 'champ' => 'supprix', 'table' => 'prixarticle', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                    ?>
                                                    <?php echo $this->Form->input('id', array('label' => '', 'champ' => 'id', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'prixarticle', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                    <div style="margin-top:7%">
                                                        <select table="prixarticle" index champ="article_id">
                                                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                                            <?php foreach ($articless as $id => $article) {
                                                            ?>
                                                                <option value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td align="center">

                                                    <?php echo $this->Form->input('prix', array('label' => '', 'champ' => 'prix', 'name' => '', 'id' => '', 'table' => 'prixarticle', 'index' => '', 'div' => 'form-group', 'type' => 'text', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'required' => 'off', 'class' => 'form-control four1 ')); ?>
                                                </td>
                                                <td align="center">

                                                    <?php echo $this->Form->input('inserted', array('label' => '', 'champ' => 'inserted', 'name' => '', 'id' => '', 'table' => 'prixarticle', 'index' => '', 'div' => 'form-group', 'type' => 'text', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'required' => 'off', 'class' => 'form-control')); ?>
                                                </td>
                                                <td align="center">

                                                    <?php echo $this->Form->input('updated', array('label' => '', 'value' => '0', 'champ' => 'updated', 'name' => '', 'id' => '', 'table' => 'prixarticle', 'index' => '', 'div' => 'form-group', 'type' => 'text', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'required' => 'off', 'class' => 'form-control')); ?>
                                                </td>
                                                <td align="center"><i index="" id="" champ="supprix" class="fa fa-times supprix" style="color: #C9302C;font-size: 22px;"></td>
                                            </tr>



                                        </tbody>
                                    </table><br />
                                    <input type="hidden" value="<?php echo $i ?>" id="indexprix">
                                </div>
                            </div>
                        </div>
                    </div>


                </section>


                <section class="content-header">
                    <h1 class="box-title"><?php echo __('Adresse de livraison'); ?></h1>
                </section>

                <section class="content" style="width: 99%">

                    <div class="box box">
                        <div class="box-header with-border">
                            <a class="btn btn-primary al " data-toggle="modal" data-target="#modal-default" table='addtable' index='index' id='ajouter_ligne3' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                                <i class="fa fa-plus-circle "></i> Ajouter adresse de livraison</a>
                            <table class="table table-bordered table-striped table-bottomless" id="tab">
                                <tbody>
                                    <tr class="tr" style="display: none !important">


                                        <td style="width: 8%;" align="center">
                                            <?php echo $this->Form->input('supadresse', array('name' => '', 'id' => '', 'champ' => 'supadresse', 'table' => 'adresse', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                            ?><strong>Adresse</strong>
                                        </td>
                                        <td align="center">
                                            <input table="adresse" type="text" class="form-control" name="" id="" champ="adresse">
                                        </td>
                                        <td align="center">
                                            <i index="" id="" champ='supadresse' class="fa fa-times supadresse" style="color: #c9302c;font-size: 22px;"></i>
                                        </td>
                                    </tr>



                                    <!--                                            <tr class="tr" style="display:true">


                                                <td style="width: 8%;" align="center">
                                            <?php //echo $this->Form->input('sup', array('name' => 'data[adresse][0][supadresse]', 'id' => 'supadresse0' . $i, 'champ' => 'supadresse', 'table' => 'adresse', 'index' => 0, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                            ?><strong>Adresse</strong>
                                                </td>

                                                <td align="center">

                                            <?php //echo $this->Form->input('adresse', array('label' => '', 'value' => $client->Adresse, 'champ' => 'adresse', 'name' => 'data[adresse][0][adresse]', 'type' => 'text', 'class' => 'input', 'id' => 'adresse0', 'table' => 'adresse', 'index' => 0, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                            ?>                                                </td>
                                                <td align="center">
                                                    <i index="" id="" champ='sup' class="fa fa-times supadresse" style="color: #c9302c;font-size: 22px;"></i>
                                                </td>
                                            </tr>-->


                                    <?php
                                    $i = -1;
                                    foreach ($adressees as $adr) :
                                    ?>
                                        <tr>

                                            <td style="width: 8%;" align="center">
                                                <?php echo $this->Form->input('supadresse', array('name' => 'data[adresse][' . $i . '][supadresse]', 'id' => 'supadresse' . $i, 'champ' => 'supadresse', 'table' => 'adresse', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                ?>
                                                <strong><?php echo ('Adresse'); ?></strong>
                                            </td>
                                            <td align="center">
                                                <?php echo $this->Form->input('id', array('label' => '', 'value' => $adr->id, 'champ' => 'id', 'name' => 'data[adresse][' . $i . '][id]', 'type' => 'hidden', 'id' => 'id' . $i, 'table' => 'adresse', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                ?>
                                                <?php echo $this->Form->input('adresse', array('label' => '', 'value' => $adr->adresse, 'champ' => 'adresse', 'name' => 'data[adresse][' . $i . '][adresse]', 'type' => 'text', 'class' => 'input', 'id' => 'adresse' . $i, 'table' => 'adresse', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                ?>

                                            </td>
                                            <td align="center"><i index="<?php echo $i ?>" class="fa fa-times supadresse" style="color: #C9302C;font-size: 22px;"></td>
                                        </tr>
                                    <?php endforeach; ?>





                                </tbody>
                            </table><br>
                            <input type="hidden" value="<?php echo $i ?>" id="indexadresse">
                        </div>
                    </div>
                </section>















                <section class="content-header">
                    <h1 class="box-title"><?php echo __('Les comptes bancaires'); ?></h1>
                </section>







                <section class="content" style="width: 99%">
                    <div class="row">
                        <div class="box">
                            <div class="box-header with-border">
                                <a class="btn btn-primary al" table='addtable' index='index1' id='ajouter_ligne1' style="
                                           float: right;
                                           margin-bottom: 5px;
                                           ">
                                    <i class="fa fa-plus-circle "></i> Ajouter compte bancaire</a>

                            </div>
                            <div class="panel-body">
                                <div class="table-responsive ls-table">
                                    <table class="table table-bordered table-striped table-bottomless" id="tabligne1">
                                        <thead>
                                            <tr width:20px>
                                                <td align="center" style="width: 10%;"><strong>Banque</strong></td>
                                                <!-- <td align="center" style="width: 20%;"><strong>Code agence</strong></td>
                                                <td align="center" style="width: 10%;"><strong>Code banque</strong></td>
                                                <td align="center" style="width: 10%;"><strong>Code SWIFT</strong></td>
                                                <td align="center" style="width: 10%;"><strong>Compte</strong></td> -->
                                                <td align="center" style="width: 10%;"><strong>RIB</strong></td>
                                                <td align="center" style="width: 25%;"><strong>Document</strong></td>
                                                <td align="center" style="width: 5%;"></td>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class='tr' style="display: none !important">
                                                <td style="width: 8%;" align="center">


                                                    <?php echo $this->Form->input('supbanque', array('name' => '', 'id' => '', 'champ' => 'supbanque', 'table' => 'banque', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                                                    <div>
                                                        <?php echo $this->Form->control('banque_id', ['name' => '', 'champ' => 'banque_id', 'options' => $banques, 'label' => '', 'table' => 'banque', 'index' => '', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control  control-label ', 'id' => '']);
                                                        ?>
                                                    </div>


                                                    <?php echo $this->Form->input('id', array('champ' => 'name', 'label' => '', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'banque', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                </td>
                                                <td align="center" hidden>
                                                    <?php echo $this->Form->input('code agence', array('champ' => 'agence', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'banque', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                </td>
                                                <td align="center" hidden>

                                                    <?php echo $this->Form->input('code banque', array('champ' => 'code_banque', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'banque', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                </td>
                                                <!-- <td align="center">

                                                    <?php echo $this->Form->input('code swift', array('champ' => 'swift', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'banque', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                </td> -->
                                                <td align="center" hidden>

                                                    <?php echo $this->Form->input('compte', array('champ' => 'compte', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'banque', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                </td>
                                                <td align="center">

                                                    <?php echo $this->Form->input('rib', array('champ' => 'rib', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'banque', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                </td>
                                                <td align="center">
                                                    <?php echo $this->Form->input('documen', array('champ' => 'documen', 'label' => '', 'name' => '', 'type' => 'file', 'id' => '', 'table' => 'banque', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                </td>







                                                <td align="center"><i index="" id="" class="fa fa-times supbanque" style="color: #C9302C;font-size: 22px;"></td>
                                            </tr>



                                            <?php
                                            $i = -1;
                                            foreach ($banquess as $i => $banque) :
                                                //    debug($banque);
                                            ?>
                                                <tr>
                                                    <td style="width: 8%;" align="center">
                                                        <?php echo $this->Form->input('supbanque', array('name' => 'data[banque][' . $i . '][supbanque]', 'id' => 'supbanque' . $i, 'champ' => 'supbanque', 'table' => 'banque', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                        ?>
                                                        <div style="margin-top: 1px;">
                                                            <?php echo $this->Form->input('id', array('label' => '', 'value' => $banque->id, 'name' => 'data[banque][' . $i . '][id]', 'type' => 'hidden', 'id' => 'name' . $i, 'table' => 'banque', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>

                                                            <div>
                                                                <?php echo $this->Form->control('banque_id', array('label' => '', 'options' => $banques, 'value' => $banque->banque_id, 'name' => 'data[banque][' . $i . '][banque_id]', 'id' => 'banque_id' . $i, 'table' => 'banque', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => ' select2 form-control ', 'empty' => 'Veuillez choisir !!')); ?>
                                                            </div>
                                                        </div>

                                                    </td>

                                                    <td align="center" hidden>
                                                        <?php echo $this->Form->input('agence', array('label' => '', 'value' => $banque->agence, 'name' => 'data[banque][' . $i . '][agence]', 'type' => 'text', 'id' => 'agence' . $i, 'table' => 'banque', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                    </td>
                                                    <td align="center" hidden>
                                                        <?php echo $this->Form->input('code banque', array('label' => '', 'value' => $banque->code_banque, 'name' => 'data[banque][' . $i . '][code_banque]', 'type' => 'text', 'id' => 'code_banque' . $i, 'table' => 'banque', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                    </td>
                                                    <td align="center" hidden>
                                                        <?php echo $this->Form->input('swift', array('label' => '', 'value' => $banque->swift, 'name' => 'data[banque][' . $i . '][swift]', 'type' => 'text', 'id' => 'swift' . $i, 'table' => 'banque', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>

                                                    </td>
                                                    <td align="center" hidden>
                                                        <?php echo $this->Form->input('compte', array('label' => '', 'value' => $banque->compte, 'name' => 'data[banque][' . $i . '][compte]', 'type' => 'text', 'id' => 'compte' . $i, 'table' => 'banque', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('rib', array('label' => '', 'value' => $banque->rib, 'name' => 'data[banque][' . $i . '][rib]', 'type' => 'text', 'id' => 'rib' . $i, 'table' => 'banque', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                    </td>
                                                    <td align="center">
                                                        <!-- <?php echo $this->Form->control('document'); ?> -->
                                                        <input type="file" table="banque" champ="documen" name="data[banque][<?php echo $i; ?>][documen]" class="form-control" id="documen">
                                                        <?php //echo $this->Html->link('' . $banque->document, ['style' => 'max-width:200px;height:200px;']); 
                                                        ?>
                                                        <?php echo $this->Html->link(
                                                            $banque->document, // Le texte ou le nom du lien
                                                            'https://sttp.mtd-erp.com/ERP/webroot/img/' . $banque->document, // L'URL du lien
                                                            ['target' => '_blank', 'style' => 'max-width:200px;height:200px;'] // Options supplémentaires
                                                        ); ?>


                                                    </td>
                                                    <td align="center"><i index="<?php echo $i ?>" class="fa fa-times supbanque" style="color: #C9302C;font-size: px;"></td>
                                                </tr>
                                            <?php endforeach; ?>




                                        </tbody>
                                    </table><br />
                                    <input type="hidden" value="<?php echo $i ?>" id="indexbanque">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>































                <section class="content-header">
                    <h1 class="box-title"><?php echo __('Les responsables'); ?></h1>
                </section>









                <section class="content" style="width: 99%">
                    <div class="row">
                        <div class="box">
                            <div class="box-header with-border">
                                <a class="btn btn-primary  " table='addtable' index='index' id='ajouter_ligne0' style="
                                           float: right;
                                           margin-bottom: 5px;
                                           ">
                                    <i class="fa fa-plus-circle "></i> Ajouter responsable</a>

                            </div>
                            <div class="panel-body">
                                <div class="table-responsive ls-table">
                                    <table class="table table-bordered table-striped table-bottomless" id="tabligne0">

                                        <thead>
                                            <tr width:20px>
                                                <td align="center" style="width: 25%;"><strong>Nom du responsable</strong></td>
                                                <td align="center" style="width: 25%;"><strong>Email</strong></td>
                                                <td align="center" style="width: 25%;"><strong>Telephone</strong></td>
                                                <td align="center" style="width: 25%;"><strong>Poste</strong></td>
                                                <td align="center" style="width: 25%;"></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class='tr' style="display: none !important">
                                                <td style="width: 8%;" align="center">



                                                    <?php echo $this->Form->input('sup', array('name' => '', 'id' => '', 'champ' => 'supresponsable', 'table' => 'responsable', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                    ?>


                                                    <?php echo $this->Form->input('id', array('champ' => 'id', 'label' => '', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'responsable', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                    <?php echo $this->Form->input('name', array('champ' => 'name', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'responsable', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>


                                                </td>
                                                <td align="center">

                                                    <?php echo $this->Form->input('mail', array('champ' => 'mail', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'responsable', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ')); ?>
                                                </td>
                                                <td align="center">

                                                    <?php echo $this->Form->input('tel', array('label' => '', 'champ' => 'tel', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'responsable', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ')); ?>
                                                </td>
                                                <td align="center">

                                                    <?php echo $this->Form->input('poste', array('champ' => 'poste', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'responsable', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                </td>
                                                <td align="center"><i index="" id="" class="fa fa-times supresponsable" style="color: #C9302C;font-size: 22px;"></td>
                                            </tr>





                                            <?php
                                            $i = -1;
                                            foreach ($responsable as $i => $res) :
                                            ?>
                                                <tr>
                                                    <td style="width: 8%;" align="center" background-color="white">

                                                        <?php echo $this->Form->input('sup', array('name' => 'data[responsable][' . $i . '][supresponsable]', 'id' => 'supresponsable' . $i, 'champ' => 'sup', 'table' => 'responsable', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                        ?>
                                                        <?php echo $this->Form->input('id', array('label' => '', 'value' => $res->id, 'name' => 'data[responsable][' . $i . '][id]', 'type' => 'hidden', 'id' => 'id' . $i, 'table' => 'responsable', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>

                                                        <?php echo $this->Form->input('name', array('label' => '', 'value' => $res->name, 'name' => 'data[responsable][' . $i . '][name]', 'type' => 'text', 'id' => 'name' . $i, 'table' => 'responsable', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                    </td>
                                                    <td align="center" background-color="white">
                                                        <?php echo $this->Form->input('mail', array('label' => '', 'value' => $res->mail, 'name' => 'data[responsable][' . $i . '][mail]', 'type' => 'text', 'id' => 'mail' . $i, 'table' => 'responsable', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ')); ?>

                                                    </td>
                                                    <td align="center" background-color="white">
                                                        <?php echo $this->Form->input('tel', array('label' => '', 'value' => $res->tel, 'name' => 'data[responsable][' . $i . '][tel]', 'type' => 'text', 'id' => 'tel' . $i, 'table' => 'responsable', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ')); ?>
                                                    </td>
                                                    <td align="center" align="center" background-color="white">
                                                        <?php echo $this->Form->input('poste', array('label' => '', 'value' => $res->poste, 'name' => 'data[responsable][' . $i . '][poste]', 'type' => 'text', 'id' => 'poste' . $i, 'table' => 'responsable', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                    </td>
                                                    <td align="center" background-color="white"><i index="<?php echo $i ?>" class="fa fa-times supresponsable" style="color: #C9302C;font-size: 22px;"></td>
                                                </tr>
                                            <?php endforeach; ?>






                                        </tbody>
                                    </table><br />
                                    <input type="hidden" value="<?php echo $i ?>" id="indexresponsable">
                                </div>
                            </div>
                        </div>
                    </div>


                </section>

                <?php //debug($exoner);
                ?>
                <div id="exon" <?php if ($client->typeexoneration_id == 1) { ?> style='display:true' <?php } else { ?> style='display:none' <?php } ?>>

                    <!-- <div id="exon" style="display:true"> -->

                    <section class="content-header">
                        <h1 class="box-title"><?php echo __('Suspension des droits et taxe '); ?></h1>
                    </section>
                    <section class="content" style="width: 99%">
                        <div class="row">
                            <div class="box ">
                                <div class="box-header with-border">
                                    <a class="btn btn-primary al" table='tabligne2' index='index' id='ajouter_ligne2' style="
                                           float: right;
                                           margin-bottom: 5px;
                                           ">
                                        <i class="fa fa-plus-circle "></i> Ajouter suspension</a>

                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive ls-table">
                                        <table class="table table-bordered table-striped table-bottomless" id="tabligne2">
                                            <thead>
                                                <tr width:20px>

                                                    <td align="center" style="width: 20%;"><strong>Type</strong></td>
                                                    <td align="center" style="width: 15%;"><strong>N attestatin </strong></td>
                                                    <td align="center" style="width: 20%;"><strong>Date debut</strong></td>
                                                    <td align="center" style="width: 20%;"><strong>Date fin </strong></td>
                                                    <td align="center" style="width: 30%;"><strong>Document</strong></td>


                                                    <td align="center" style="width: 5%;"></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!--                                                  <tr class='tr' style="display: none !important">
                                                        <td style="width: 8%;" align="center">
    
    
    
                                                    <?php echo $this->Form->input('sup', array('name' => '', 'id' => '', 'champ' => 'supresponsable', 'table' => 'responsable', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                    ?>
    
    
                                                    <?php echo $this->Form->input('id', array('champ' => 'id', 'label' => '', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'responsable', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                <div style="margin-top:7%">  
                                                    <?php echo $this->Form->input('name', array('champ' => 'name', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'responsable', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                  </div>
    
                                                        </td>
                                                        <td align="center">
    
                                                    <?php echo $this->Form->input('mail', array('champ' => 'mail', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'responsable', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control validationChampMail')); ?>
                                                        </td>
                                                        <td align="center">
    
                                                    <?php echo $this->Form->input('tel', array('label' => '', 'champ' => 'tel', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'responsable', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control validationChampTel')); ?>
                                                        </td>
                                                        <td align="center">
    
                                                    <?php echo $this->Form->input('poste', array('champ' => 'poste', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'responsable', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                        </td>
                                                        <td align="center"><i index="" id="" class="fa fa-times supresponsable" style="color: #C9302C;font-size: 22px;"></td>
                                                    </tr>-->













                                                <tr class='tr' style="display: none !important">

                                                    <td align="center">

                                                        <?php echo $this->Form->input('sup2', array('name' => '', 'id' => '', 'champ' => 'sup2', 'table' => 'lignes', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                        ?>


                                                        <?php echo $this->Form->input('id', array('champ' => 'id', 'label' => '', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'tables', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>



                                                        <div style="margin-top:1%">
                                                            <?php echo $this->Form->control('type_exoneration', array('empty' => 'Veuillez choisir !!', 'div' => 'form-group', 'options' => $type, 'between' => '<div class="col-sm-4">', 'after' => '</div>', 'class' => ' form-control ', 'label' => '', 'index' => '', 'champ' => 'typeexon_id', 'table' => 'lignes', 'name' => '', 'id' => '')); ?>
                                                        </div>
                                                    </td>

                                                    <td align="center">
                                                        <?php
                                                        echo $this->Form->input('num_att_taxes', array('label' => '', 'table' => 'lignes', 'name' => '', 'champ' => 'num_att_taxes', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                                        ?>

                                                    </td>
                                                    <td align="center">
                                                        <?php
                                                        echo $this->Form->input('date_debut', array('label' => '', 'table' => 'lignes', 'name' => '', 'champ' => 'date_debut', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'date'));
                                                        ?>

                                                    </td>
                                                    <td align="center">
                                                        <?php
                                                        echo $this->Form->input('date_fin', ['label' => '', 'table' => 'lignes', 'name' => '', 'champ' => 'date_fin', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'date']);
                                                        ?>
                                                    </td>

                                                    <td align="center" table="ligner">
                                                        <input type="file" table="lignes" champ="documenttt" name="documenttt" class="form-control" id="">
                                                    </td>

                                                    <td align="center"><i index="" id="" class="fa fa-times supLigne2" style="color: #C9302C;font-size: 22px;"></td>

                                                </tr>
                                                <?php
                                                foreach ($exoner as $i => $exoner) {
                                                    // debug($exoner);
                                                ?>

                                                    <tr class=''>
                                                        <td style="width: 8%;" align="center">
                                                            <?php echo $this->Form->input('sup2', array('name' => 'data[lignes][' . $i . '][sup2]', 'id' => 'sup2' . $i, 'champ' => 'sup2', 'table' => 'lignes', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                            ?>
                                                            <?php echo $this->Form->input('id', array('value' => $exoner->id, 'champ' => 'id', 'label' => '', 'name' => 'data[lignes][' . $i . '][id]', 'type' => 'hidden', 'id' => 'id' . $i, 'table' => 'lignes', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                            <div style="margin-top:1%">
                                                                <?php echo $this->Form->control('typeexon_id', array('label' => '', 'options' => $type, 'value' => $exoner->typeexon_id, 'class' => 'typeexoneration', 'id' => 'typeexon_id' . $i, 'name' => 'data[lignes][' . $i . '][typeexon_id]', 'table' => 'lignes', 'champ' => 'typeexon_id', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control select2', 'required' => 'off')); ?>
                                                            </div>

                                                        </td>


                                                        <td align="center">
                                                            <?php echo $this->Form->control('num_att_taxes', array('value' => $exoner->num_att_taxes, 'label' => '', 'table' => 'lignes', 'champ' => 'num_att_taxes', 'id' => 'num_att_taxes' . $i, 'index' => $i, 'name' => 'data[lignes][' . $i . '][num_att_taxes]', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php
                                                            echo $this->Form->control('date_debut', array('value' => $exoner->date_debut, 'label' => '', 'table' => 'lignes', 'champ' => 'date_debut', 'id' => 'date_debut' . $i, 'name' => 'data[lignes][' . $i . '][date_debut]', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'date'));
                                                            ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php
                                                            echo $this->Form->control('date_fin', ['value' => $exoner->date_fin, 'label' => '', 'table' => 'lignes', 'id' => 'date_fin' . $i, 'name' => 'data[lignes][' . $i . '][date_fin]', 'index' => $i, 'champ' => 'date_fin', 'id' => 'date_fin', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'date']);
                                                            ?>
                                                        </td>
                                                        <td align="center" style="margin-top:1%">
                                                            <!-- <?php echo $this->Form->control('document'); ?> -->
                                                            <input type="file" table="lignes" champ="documenttt" name="data[lignes][<?php echo $i; ?>][documenttt]" class="form-control" id="documenttt">
                                                            <?php //echo $this->Html->link('' . $exoner->document, ['style' => 'max-width:200px;height:200px;']); 
                                                            ?>
                                                            <?php echo $this->Html->link(
                                                                $exoner->document, // Le texte ou le nom du lien
                                                                'https://sttp.mtd-erp.com/ERP/webroot/img/'. $exoner->document, // L'URL du lien
                                                                ['target' => '_blank', 'style' => 'max-width:200px;height:200px;'] // Options supplémentaires
                                                            ); ?>


                                                        </td>

                                                        <td align="center"><i index="<?php echo $i ?>" class="fa fa-times supLigne2" style="color: #C9302C;font-size: 22px;"></td>
                                                    </tr>


                                                <?php } ?>



                                                <input type="hidden" value="<?php $i ?>" id="index2">
                                            </tbody>
                                        </table><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <?php //}
                    ?>
                </div>
                <section class="content-header">
                    <h1 class="box-title"><?php echo __('Les documents'); ?></h1>
                </section>


                <section class="content" style="width: 99%">
                    <div class="row">
                        <div class="box">
                            <div class="box-header with-border">

                                <div class="box-header with-border">
                                    <a class="btn btn-primary  " table='addtable' index='index' id='ajouter_ligne_doc' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                                        <i class="fa fa-plus-circle "></i> Ajouter document</a>

                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive ls-table">
                                    <table class="table table-bordered table-striped table-bottomless" id="tabligneDoc">

                                        <thead>
                                            <tr width:20px">
                                                <td align="center" style="width: 25%;"><strong>Nom du document</strong></td>
                                                <td align="center" style="width: 25%;"><strong>Fichier</strong></td>
                                                <td align="center" style="width: 25%;"><strong></strong></td>


                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php

                                            foreach ($clientdoc as $i => $res) :
                                                //debug($clientdoc) ; 
                                            ?>
                                                <tr class='tr' style="display: none !important">
                                                    <td align="center">

                                                        <?php echo $this->Form->input('sup', array('name' => '', 'id' => '', 'champ' => 'suprdoc', 'table' => 'document', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                        ?>


                                                        <?php echo $this->Form->input('name', array('champ' => 'name', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'document', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>


                                                    </td>
                                                    <td align="center">

                                                        <?php echo $this->Form->input('fichier', array('champ' => 'fichier', 'label' => '', 'name' => '', 'type' => 'file', 'id' => '', 'table' => 'document', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ')); ?>
                                                    </td>

                                                    <td align="center"><i index="" id="" class="fa fa-times suprdoc" style="color: #C9302C;font-size: 22px;"></td>
                                                </tr>

                                                <tr>
                                                    <td style="width: 8%;" align="center" background-color="white">

                                                        <?php echo $this->Form->input('name', array('label' => '', 'readonly', 'value' => $res->name, 'name' => 'data[document][' . $i . '][name]', 'type' => 'text', 'id' => 'name' . $i, 'table' => 'document', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                    </td>

                                                    <td align="center">
                                                        <?php $url = $_SERVER['HTTP_HOST']; ?>
                                                        <?php echo $this->Form->input('fichier', array('label' => '', 'readonly', 'name' => 'data[document][' . $i . '][fichier]', 'type' => 'file', 'id' => 'name' . $i, 'table' => 'document', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                        <a onclick="openWindow(1000, 1000,''https://sttp.mtd-erp.com/ERP/webroot/img/<?php echo $res->fichier; ?>');">
                                                            <i class="fa fa fa-file" style="color:success;font-size: 20px;"></i></a>
                                                    </td>
                                                    <td align="center"><i index="" id="" class="fa fa-times suprdoc" style="color: #C9302C;font-size: 22px;"></td>

                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <input type="hidden" value="<?php $i ?>" id="indexdoc">
                                    <br />
                                </div>
                            </div>
                        </div>
                    </div>


                </section>

                <?php //}  
                ?>
            </div>





            <div align="center">
                <button type="submit" class="pull-right btn btn-success    alertcode" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>

            </div>
            <?php /* echo $this->Form->submit(__('Enregistrer')); */ ?>
            <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
    </div>
    </div>
    </div>
    <!-- /.row -->
</section>


<script type="text/javascript">
    $(function() {
        $('.deleg').on('change', function() {
            id = $(this).val();
            //alert(id);
            gouvid = $('#gouvernorat').val();
            //alert(gouvid)
            delegation(id, gouvid);
        });
    });
    $(function() {
        $('.loc').on('change', function() {
            id = $(this).val();
            //alert(id);
            delegid = $('#deleg').val();
            //alert(delegid);
            gouvid = $('#gouvernorat').val();
            //alert(gouvid);
            localite(id, delegid, gouvid);
        });
    });


    $(function() {
        $('.pays').on('change', function() {
            // alert('hello');
            id = $('#pay_id').val();
            // alert(id)
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Clients', 'action' => 'getgouv']) ?>",
                dataType: "json",
                data: {
                    id: id,

                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function(data) {
                    //alert(data.select);
                    $('#divgouv').html(data.select);
                    $('#gouvernorat').select2();
                    // uniform_select('sousfamille1_id');


                }

            })

        });

        $('input[type=radio][name=nouveau_client]').click(function() {

            if (this.value == 'FALSE') {

                $(".afficher").removeClass("hidden");
                $('.afficher').attr('style', "display:true;");

            } else if (this.value == 'TRUE') {

                $(".afficher").addClass("hidden");
                $('.afficher').attr('style', "display:true;");

                $('#client_id').val(' ');

            }

        });
        $('input[type=radio][name=etat]').click(function() {

            if (this.value == 'FALSE') {
                /*     $(".afficher1").addClass("hidden");
                 */
                $('.afficher1').attr('style', "display:none;");
                $('#observationtext').val(' ');




            } else if (this.value == 'TRUE') {
                // $(".afficher1").removeClass("hidden");

                $('.afficher1').attr('style', "display:true;");



            }

        });
        $('.close').on('click', function() {


            $(".tableclose").toggle();

        })

    });
</script>

<script>
 $(document).ready(function() {
    $('#type_id').change(function() {
        $('#mat').hide();
        $('#iden').hide();

        var selectedType = $(this).val();

        if (selectedType == 1) {
            $('#mat').show(); 
            
        } else if (selectedType == 2) {
            $('#iden').show(); 
        }
    });
});

</script>



<!-- iCheck for checkboxes and radio inputs -->
<?php echo $this->Html->css('AdminLTE./plugins/iCheck/all', ['block' => 'css']); ?>

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


<!-- iCheck 1.0.1 -->
<?php echo $this->Html->script('AdminLTE./plugins/iCheck/icheck.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2() /
            //Date picker

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
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-datepicker/dist/js/bootstrap-d    a        t              epicker.min', ['block' => 'script']); ?>
<!-- bootstrap color picker -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min', ['block' => 'script']); ?>
<!-- bootstrap time picker -->
<?php echo $this->Html->script('AdminLTE./plugins/timepicker/bootstrap-timepicker.min', ['block' => 'script']); ?>
<!-- iCheck 1.0.1 -->
<?php echo $this->Html->script('AdminLTE./plugins/iCheck/icheck.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    $(function() {
        $(".alertcode").on("mouseover", function() {
            //alert('')
            tel = $("#tel").val();
            id = $("#idclient").val();
            $.ajax({
                type: "GET",
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Clients', 'action' => 'checktel']) ?>",
                dataType: "JSON",
                data: {
                    tel: tel,
                    id: id,
                },
                success: function(response) {
                    //  console.log(data);
                    //alert(response.ligne)
                    t = response.ligne;
                    if (t == 1) {
                        alert(
                            "Un client avec ce N° de téléphone déjà existe ! "
                        );
                        return false;
                    }
                },
            });
        });
    });

    $(function() {
        $("#tel").on("blur", function() {
            var tel = $(this).val();
            id = $("#idclient").val();
            $.ajax({
                type: "GET",
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Clients', 'action' => 'checktel']) ?>",
                dataType: "JSON",
                data: {
                    tel: tel,
                    id: id,
                },
                success: function(response) {
                    var t = response.ligne;
                    if (t == 1) {
                        alert("Un client avec ce N° de téléphone existe déjà !");
                        return false;
                    }
                },
            });
        });
    });

    $('#code').on('change', function() {
        code = $('#code').val();
        $('#compte').val(code);
    })





    function gouv(id) {
        // $(function () {
        //     $('.gouv').on('change', function () {
        idg = $('#gouvernorat').val();
        $('#gouv').val((idg));

        $.ajax({
            method: "GET",
            url: "<?= $this->Url->build(['controller' => 'Clients', 'action' => 'getbureaupostegouvs']) ?>",
            dataType: "json",
            data: {
                idgouv: id,
            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
            },
            success: function(response, status, settings) {
                //alert(response.query);
                //  alert(response.name);
                bureauposte = $('#bureauposte').val();
                $('#bureauposte').val(response.query);
                $('#gouvadresse').val(response.name);
                $('#adresses').val(response.name + ' ' + response.query);
                $('#adresse0').val(response.name + ' ' + response.query);


                $('#adress').val(response.name + ' ' + response.query);



                $('#compte').val(response.queryyy);
                // $('#code').val(response.queryyy);
                $('#delegation').html(response.select);
                $('#deleg').select2();
                // uniform_select('delegation');



                //$('#adresses').val((id));

            }
        })
    }

    function localite(id, iddeleg, idgouv) {
        //alert(id)
        idgouv = $('#gouvernorat').val();
        iddeleg = $('#deleg').val();
        $.ajax({
            method: "GET",
            // url: wr + "Clients/getbureaupostedelegs/",
            url: "<?= $this->Url->build(['controller' => 'Clients/getbureaupostelocs']) ?>",
            dataType: "json",
            data: {
                idloc: id,
                iddeleg: iddeleg,
                idgouv: idgouv,
            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
            },
            success: function(response, status, settings) {
                //alert(response.query);
                $('#bureauposte').val(response.query);
                valeur = $('#adresses').val();

                $('#localiteadrresse').val(response.name);
                $('#adresses').val($('#adr').val() + ' ' + $('#localiteadrresse').val() + ' ' + $('#delegationadr').val() + ' ' + $('#gouvadresse').val() + ' ' + $('#bureauposte').val());
                $('#adresse0').val($('#localiteadrresse').val() + ' ' + $('#delegationadr').val() + ' ' + $('#gouvadresse').val() + ' ' + $('#bureauposte').val());

                $('#adress').val($('#localiteadrresse').val() + ' ' + $('#delegationadr').val() + ' ' + $('#gouvadresse').val() + ' ' + $('#bureauposte').val());

            }
        })

    }







    function delegation(id) {
        //alert("yyy");

        //alert(id)
        //id = $('#deleg').val();
        // alert(id);
        idgouv = $('#gouvernorat').val();
        $.ajax({
            method: "GET",
            // url: wr + "Clients/getbureaupostedelegs/",
            url: "<?= $this->Url->build(['controller' => 'Clients/getbureaupostedelegs']) ?>",
            dataType: "json",
            data: {
                iddeleg: id,
                idgouv: idgouv
            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
            },
            success: function(response, status, settings) {
                // alert(response.query);
                // alert(response.name);
                bureauposte = $('#bureauposte').val();

                $('#bureauposte').val(response.query);
                $('#localite').html(response.select);
                $('#loc').select2();
                valeur = $('#adresses').val();
                //let v = valeur.substr(-4);
                //   let v = valeur.substr(valeur.length - 4);
                //alert(v);
                //  valeur.replace(v, bureauposte);
                //  alert(valeur);
                $('#delegationadr').val(response.name);

                $('#adresses').val($('#localiteadrresse').val() + ' ' + $('#delegationadr').val() + ' ' + $('#gouvadresse').val() + ' ' + $('#bureauposte').val());
                $('#adresse0').val($('#localiteadrresse').val() + ' ' + $('#delegationadr').val() + ' ' + $('#gouvadresse').val() + ' ' + $('#bureauposte').val());

                $('#adress').val($('#localiteadrresse').val() + ' ' + $('#delegationadr').val() + ' ' + $('#gouvadresse').val() + ' ' + $('#bureauposte').val());


                // uniform_select('localite');
            }
        })

    }
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
            format: ' MM/DD/YYYY h:mm A'
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

<script>
    const submitBtn = document.querySelector('button[type="submit"]');

    ///console.log(submitBtn)

    document.querySelector('form').addEventListener('submit', function() {

        submitBtn.disabled = true;
    });
</script>

<?php $this->end(); ?>

<script>
    $("#prix" + i).val(Number(prix).toFixed(3));
    $("#punht" + i).val(Number(punht).toFixed(3));
    $('.afficherancienclient').on('click', function() {
        if ($('#non').is(':checked')) { //alert('oui is checked');
            $('#afficher').attr('style', "display:true;");
        } else {
            $('#afficher').attr('style', "display:none;");
            $('#client_id').val(' ');
        }
    });
</script>