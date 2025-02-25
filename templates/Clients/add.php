<style>
    .hidden {
        display: none;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->script('hechem'); ?>
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


        Ajout client
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
                echo $this->Form->create($client, ['role' => 'form', 'type' => 'file', 'onkeypress' => "return event.keyCode!=13"]);
                //debug ($article);
                // die;
                ?>

                <div class="box-body">
                    <div class="row">

                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="col-xs-6">

                                    <?php echo $this->Form->control('Code', ['value' => $code, 'name' => 'Code', 'readonly' => 'readonly', 'id' => 'Code', 'label' => 'Code', 'class' => ' form-control']); ?>

                                </div>
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('codeancienne', ['label' => 'Code Ancienne', 'id' => 'codeancienne']); ?>


                                </div>

                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('Raison_Sociale', ['id' => 'raisonsoc']); ?>
                                </div>
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('registre', ['label' => 'Registre de commerce', 'type' => 'text', 'class' => ' control-label form-control']); ?>
                                </div>
                                <div class="col-xs-6" hidden>
                                    <?php echo $this->Form->control('pay_id', ['label' => 'Pays', 'id' => 'pay_id', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 pays']); ?>


                                </div>


                            </div>
                        </div>

                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="col-xs-6" hidden>
                                    <?php echo $this->Form->control('commercial_id', ['id' => 'com', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 control-label']); ?>
                                </div>
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('type_id', ['id' => 'type_id', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 control-label']); ?>
                                </div>
                                <div class="col-xs-6" id="mat">
                                    <?php echo $this->Form->control('Matricule_Fiscale', ['id' => 'matriculefis','label'=>'Matricule Fiscale', 'class' => ' form-control verifiermatriculefiscale ', 'placeholder' => "0000000XXX000"]); ?>
                                </div>
                                <div class="col-xs-6" id="iden">
                                    <?php echo $this->Form->control('numidentite', ['id' => 'numidentite', 'label'=>'Num Identité','class' => ' form-control  ', 'placeholder' => "00 00 00 00"]); ?>
                                </div>
                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('Tel', ['id' => 'tel', 'label' => 'Télèphone 1', 'class' => 'validationLengthChampTel form-control control-label', 'type' => 'text']); ?>
                                </div>
                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('Tel1', ['id' => 'tel', 'label' => 'Télèphone 2', 'class' => 'validationLengthChampTel form-control control-label', 'type' => 'text']); ?>
                                </div>
                            </div>
                        </div>




                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="col-xs-6">
                                    <div class="form-group input text " id="delegation" hidden>
                                        <?php echo $this->Form->control('delegation_id', ['id' => 'deleg', 'name' => 'delegation_id', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 control-label deleg']); ?>



                                    </div>
                                </div>

                                <div class="col-xs-6">
                                    <div class="form-group input text " id="localite" hidden>
                                        <?php echo $this->Form->control('localite_id', ['name' => 'localite_id', 'id' => 'loc', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 control-label loc']); ?>

                                    </div>

                                </div>







                            </div>
                        </div>


                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                                <div class="col-xs-6" hidden>
                                    <?php echo $this->Form->control('codedouane', ['label' => 'Code en douane', 'type' => 'text', 'class' => ' control-label form-control']); ?>
                                </div>


                            </div>
                        </div>

                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('Email', ['id' => 'email', 'class' => 'form-control  control-label validationChampMaill']); ?>
                                </div>
                                <div class="col-xs-6">
                                    <?php
                                    echo $this->Form->control('date_ajout', ['class' => 'form-control ', 'readonly' => 'readonly', 'type' => 'date', 'value' => $this->Time->format(
                                        'now',
                                    )]);
                                    ?>
                                </div>


                                <div class="col-xs-6" hidden>
                                    <?php echo $this->Form->control('Contact', ['id' => 'contact']); ?>
                                </div>

                                <div class="col-xs-6" hidden>
                                    <?php echo $this->Form->control('compteclient', ['id' => 'compte', 'label' => 'Compte client', 'type' => 'text']); ?>
                                </div>


                                <?php echo $this->Form->control('gouvadresse', ['label' => '', 'type' => 'hidden']); ?>
                                <?php echo $this->Form->control('delegationadr', ['label' => '', 'type' => 'hidden']); ?>

                                <?php echo $this->Form->control('localiteadrresse', ['label' => '', 'type' => 'hidden']); ?>







                            </div>
                        </div>







                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">






                                <div class="col-xs-6" hidden>
                                    <?php echo $this->Form->control('Fax', ['id' => 'fax']); ?>
                                </div>










                            </div>
                        </div>




                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static;display:flex ">





                                <div class=" col-xs-6">
                                    <?php echo $this->Form->control('paiement_id', ['options' => $paiements, 'label' => 'Mode paiement', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 control-label   afficher_date ', 'id' => 'paiement_id', 'required' => 'off']); ?>

                                    <div id="date" class=" afficher_date" style="display:none">

                                        <div class=" col-xs-6 " align="center">
                                            <?php
                                            echo $this->Form->input('nbr_jours', array('name' => 'nbr_jours', 'label' => 'Nombre jours echeance', 'id' => 'nbr_jours', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'text'));
                                            ?>
                                        </div>

                                        <div id="finmois" class="col-xs-6" style="margin-left:10px;">
                                            <label class="control-label" for="unite-id"> Fin mois :</label>
                                            Oui <input type="radio" name="finmois" value=1 id="oui" class="" style="margin-right: 20px">
                                            Non <input type="radio" name="finmois" value=0 id="non" class="">
                                        </div>




                                    </div>



                                </div>
                                <!-- <div class="  col-xs-2" style="margin-top: 22px; width: 60px; margin-right: 25px;">
                                    <span title="ajout paiement"> <a onClick="openWindow(1000, 1000, wr+'paiements/add');" champ="orderr" value="0" class="btn btn-primary"><i class="fa fa fa-plus"></i></a> </span>
                                </div> -->
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('typeexoneration_id', ['label' => 'Exoneration', 'value' => 2, 'empty' => 'Veuillez choisir !!', 'options' => $typeexonerations, 'class' => 'form-control select2 control-label typeexoneration', 'id' => 'exonerations', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-6" >
                                    <?php echo $this->Form->control('responsable', ['id' => 'responsable','label'=>'Responsable']); ?>
                                </div>

                            </div>
                        </div>





                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">









                                <div class="col-xs-6" hidden>
                                    <?php echo $this->Form->control('typeclient_id', ['label' => 'Type client', 'empty' => 'Veuillez choisir !!', 'options' => $typeclients, 'class' => 'form-control select2 control-label', 'id' => 'typeclient_id']); ?>

                                </div>






                            </div>
                        </div>









                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                                <div class="col-xs-6" hidden>
                                    <?php echo $this->Form->control('adresse1', ['label' => 'Adresse 1', 'class' => 'form-control adresse control-label validationMail', 'id' => 'adr']); ?>
                                </div>



                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('ct', ['id' => 'adress', 'type' => 'hidden']); ?>
                                </div>

                                <div class="col-xs-6" hidden>
                                    <?php echo $this->Form->control('Adresse', ['readonly' => 'readonly', 'class' => 'form-control  control-label validationMail', 'id' => 'adresses']); ?>
                                </div>
                                <div class="col-xs-12">
                                    <i class="fa fa-eye-slash fa-2x close" aria-hidden="true"></i>

                                    <table class="tableclose table table-bordered">
                                        <tr hidden>
                                            <td><b>Remise %</b> </td>
                                            <td><?php echo $this->Form->control('remise', ['label' => false, 'class' => 'form-control  control-label ', 'id' => 'rem', 'required' => 'off', 'type' => 'text']); ?></td>
                                            <td style="text-align:center ;"><b>
                                                    Palier :</b>
                                            </td>
                                            <td colspan="2">
                                                Remise aver palier <input type="radio" name="typeremise" value="1" id="" class="choix1" style="margin-right: 20px ">
                                                Remise sans palier <input checked type="radio" name="typeremise" value="0" id="" class="choix2 ">
                                                <?php //echo $this->Form->control('typeremise', ['type'=>'hidden','value' => 1,'label' => '', 'id' => 'palier','required'=>'off', 'div' => 'form-group',   'class' => 'form-control ']); 
                                                ?>

                                            </td>
                                            <!--  <td> 
                                                        <i class="fa fa-eye-slash fa-2x close" aria-hidden="true"></i>

                                                        
                                                        </td> -->


                                        </tr>
                                        <tr hidden>
                                            <td><b>Escompte :</b> </td>
                                            <td><?php echo $this->Form->control('escompte', ['label' => false, 'class' => 'form-control  control-label ', 'id' => 'escom', 'required' => 'off', 'step' => '0.1', 'type' => 'text']); ?></td>
                                            <td style="text-align:center ;"><b>
                                                    Palier :</b>
                                            </td>
                                            <td colspan="2"> Escompte avec palier <input type="radio" name="typeescompte" value="1" id="" class="choix1" style="margin-right: 20px ">

                                                Escompte sans palier <input checked type="radio" name="typeescompte" value="0" id="" class="choix2">
                                                <?php //cho $this->Form->control('typeescompte', ['type'=>'hidden','value' => 1,'label' => '', 'id' => 'es','required'=>'off', 'div' => 'form-group',   'class' => 'form-control ']); 
                                                ?>
                                            </td>
                                            <!-- <td>
                                                        <i class="fa fa-eye-slash fa-2x close" aria-hidden="true"></i>

                                                        </td> -->
                                        </tr>
                                        <tr hidden>
                                            <td><b>Prix:</b> </td>
                                            <td>
                                                <input type="radio" name="prix" value="PHT" class="livraison" style="margin-right:10px" checked='checked'>PHT
                                            </td>
                                            <td>
                                                <input type="radio" name="prix" value="PHT+Fodec" class="livraison" style="margin-right:10px"> PHT+Fodec
                                            </td>

                                            <td>
                                                <input type="radio" name="prix" value="(PHT-Remise)+Fodec" class="livraison" style="margin-right:10px"> (PHT-Remise)+Fodec
                                            </td>
                                            <td>
                                                <input type="radio" name="prix" value="((PHT-Remise)-Escompte)+Fodec" class="livraison" style="margin-right:10px">((PHT-Remise)-Escompte)+Fodec


                                            </td>

                                        </tr>
                                        <tr hidden>
                                            <td>
                                                <b>Autorisation Livraison : </b>
                                            </td>
                                            <td colspan="3">
                                                Oui <input type="radio" name="Autorisation_Livraison" value="TRUE" id="oui" class="livraison" style="margin-right: 20px" checked='checked'>
                                                Non <input type="radio" name="Autorisation_Livraison" value="FALSE" id="nom" class="livraison">

                                            </td>
                                        </tr>
                                        <tr hidden>
                                            <td>
                                                <b>
                                                    Nouveau client :</b>
                                            </td>
                                            <td>
                                                Oui <input checked type="radio" name="nouveau_client" value="TRUE" id="oui" style="margin-right: 20px">
                                                Non <input class="afficherancienclient" type="radio" name="nouveau_client" value="FALSE" id="non" style="margin-right: 20px">
                                            </td>

                                            <td class=" hidden closerow hiderow ">
                                                <b>
                                                    Ancien clients </b>
                                            </td>

                                            <td class="hidden closerow hiderow" colspan="2">
                                                <?php echo $this->Form->control('cli', ['label' => false, 'name' => 'client_id', 'empty' => 'Veuillez choisir !!', 'options' => $cli, 'class' => 'form-control  select2 control-label', 'id' => 'ancien_client']); ?>

                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <b>
                                                    Etat :</b>
                                            </td>
                                            <td>
                                                Actif <input type="radio" name="etat" value="TRUE" id="actif" class="observation" style="margin-right: 20px" checked='checked'>
                                                Non actif <input type="radio" name="etat" value="FALSE" id="nonactif" class="observation">


                                            </td>
                                            <td class="hiddenob">
                                                <b>
                                                    Observation :</b>
                                            </td>
                                            <td class="hiddenob" colspan="3">
                                                <textarea id="observationtext" name="observation" class="form-control" rows="3" placeholder="Enter ..."></textarea>

                                            </td>

                                        </tr>
                                        <tr>
                                            <!-- <td>
                                                <b>BL : </b>
                                            </td>
                                            <td>
                                                Oui <input type="radio" name="bl" value="1" id="" class="livraison" style="margin-right: 20px" checked='checked'>
                                                Non <input type="radio" name="bl" value="0" id="" class="livraison">

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
                                            <td class="hiddenob" >
                                                <?php echo $this->Form->control('soldedebut', ['label' => '', 'class' => 'form-control', 'id' => 'soldedebut']); ?>


                                            </td>

                                        </tr>
                                    </table>
                                </div>



                                <!--***************************************************************-->



                                <!--****************************************************************-->
                                <!--   <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                              
                                <div class="col-xs-12" style="display:flex ;justify-content: space-between;">
                            <div  style="position:relative;border:1px solid blue;padding:20px; width: 48%;" >
                                        <div style="position: absolute;top:0;right:0">
                                        <i class="close fa fa-window-close fa-2x " aria-hidden="true"></i>

                                        </div>
  
                                <?php echo $this->Form->control('remise', ['label' => 'Remise % :', 'class' => 'form-control  control-label ', 'id' => 'rem', 'required' => 'off']); ?>
                                
                                <div>
                                <label class="control-label"  style="margin-right: 20px;"> Palier :</label>
                                Remise aver palier <input type="radio" name="radio" value="1" id="active" class="choix1" style="margin-right: 20px ">
                                Remise sans palier <input checked type="radio" name="radio" value="0" id="desactive" class="choix2 ">
                               <?php echo $this->Form->control('typeremise', ['type' => 'hidden', 'value' => 1, 'label' => '', 'id' => 'palier', 'required' => 'off', 'div' => 'form-group',   'class' => 'form-control ']); ?>
                                </div>
                            </div>
                                
                             <div style="position:relative ;width: 48%;border:1px solid blue;padding:20px" >
                             <div style="position: absolute;top:0;right:0">
                                        <i class="close fa fa-window-close fa-2x " aria-hidden="true"></i>

                                        </div>
                             <?php echo $this->Form->control('escompte', ['label' => 'Escompte :', 'class' => 'form-control  control-label ', 'id' => 'escom', 'required' => 'off']); ?>
                             <div>
                             <label class="control-label"  style="margin-right: 20px"> Palier :</label>
                               Escompte avec palier <input type="radio" name="box" value="1" id="on" class="choix1" style="margin-right: 20px ">
                               Escompte sans palier <input checked type="radio" name="box" value="0" id="off" class="choix2">
                               <?php echo $this->Form->control('typeescompte', ['type' => 'hidden', 'value' => 1, 'label' => '', 'id' => 'es', 'required' => 'off', 'div' => 'form-group',   'class' => 'form-control ']); ?>
                             </div>
                            </div>
                            </div>

                            </div>
                            </div>
                            <br> -->

                                <!--****************************************************************-->
                                <!--    <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="col-xs-6" style="margin-bottom:2.5%;">
                                <label class="control-label"  style="margin-right: 20px"> Palier :</label>
                                Remise aver palier <input type="radio" name="radio" value="1" id="active" class="choix1" style="margin-right: 20px ">
                                Remise sans palier <input checked type="radio" name="radio" value="0" id="desactive" class="choix2 ">
                               <?php echo $this->Form->control('typeremise', ['type' => 'hidden', 'value' => 1, 'label' => '', 'id' => 'palier', 'required' => 'off', 'div' => 'form-group',   'class' => 'form-control ']); ?>
                            </div>

                            <div class="col-xs-6" style="margin-bottom:2.5%;">
                                <label class="control-label"  style="margin-right: 20px"> Palier :</label>
                               Escompte avec palier <input type="radio" name="box" value="1" id="on" class="choix1" style="margin-right: 20px ">
                               Escompte sans palier <input checked type="radio" name="box" value="0" id="off" class="choix2">
                               <?php echo $this->Form->control('typeescompte', ['type' => 'hidden', 'value' => 1, 'label' => '', 'id' => 'es', 'required' => 'off', 'div' => 'form-group',   'class' => 'form-control ']); ?>
                             </div>

                            </div>
                            </div> -->

                                <!--****************************************************************-->





                            </div>
                        </div>

                        <!--   <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                               

                                <div  style="position:relative ; border:1px solid blue ;padding:20px ; margin-left:20px;    width: 46.5%;" >
                                <div style="position: absolute;top:0;right:0">
                                        <i class="close fa fa-window-close fa-2x " aria-hidden="true"></i>

                                        </div>
                                    <label class="control-label" for="unite-id" style="margin-right: 20px"> Prix:</label>
                                    <br>
                                    <table>
                                        <tr>   
                                            <td>
                                                <input type="radio" name="prix" value="PHT" class="livraison" style="margin-right:10px" checked='checked'>PHT</td>
                                            <td>  <input type="radio" name="prix" value="PHT+Fodec" class="livraison" style="margin-right:10px"> PHT+Fodec </td>
                                        </tr> 
                                        <tr> 
                                        <td>    <input type="radio" name="prix" value="(PHT-Remise)+Fodec" class="livraison" style="margin-right:10px">  (PHT-Remise)+Fodec </td>
                                        <td>   <input type="radio" name="prix" value="((PHT-Remise)-Escompte)+Fodec" class="livraison" style="margin-right:10px">((PHT-Remise)-Escompte)+Fodec </td>
                                     </tr>
                                    </table>
                                </div>


                            </div>
                        </div>
 -->

                        <br>

                        <!--   <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static;display:flex ">




                                        
                                <div class="col-xs-6" style="margin-left:10px;">

                                    <label class="control-label" for="unite-id" style="margin-right: 20px"> Autorisation Livraison :</label>

                                    Oui <input type="radio" name="Autorisation_Livraison" value="TRUE" id="oui" class="livraison" style="margin-right: 20px" checked='checked'>
                                    Non <input type="radio" name="Autorisation_Livraison" value="FALSE" id="nom" class="livraison">


                                </div>







                                <div class="col-xs-6" style="margin-left:10px;">
                                    <label class="control-label" for="unite-id" style="margin-right: 20px"> Etat :</label>
                                    Actif <input type="radio" name="etat" value="TRUE" id="actif" class="observation" style="margin-right: 20px" checked='checked'>
                                    Non actif <input type="radio" name="etat" value="FALSE" id="nonactif" class="observation">
                                </div>
                            </div>
                        </div>
                       --> <!--  <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static;display:flex ">



                                            

                                <div class="col-xs-6 " style="margin-left:10px;">

                                    <label class="control-label" for="unite-id" style="margin-right: 20px"> Nouveau client :</label>
                                    Oui <input class="afficherancienclient" checked type="radio" name="nouveau_client" value="TRUE" id="oui" style="margin-right: 20px">
                                    Non <input class="afficherancienclient" type="radio" name="nouveau_client" value="FALSE" id="non" style="margin-right: 20px">



                                </div>
                            </div>
                            <br><br>
                            <div id ="afficher"  style="display:none">
                                <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static;display:flex ">

                                    <div class="col-xs-6">
                                        <?php echo $this->Form->control('cli', ['label' => 'Ancien clients ', 'name' => 'client_id', 'empty' => 'Veuillez choisir !!', 'options' => $cli, 'class' => 'form-control  select2 control-label', 'id' => 'ancien_client']); ?>
                                    </div>  
                                </div>    
                            </div>
                        </div>
 -->


                        <!-- <div class="row">
                         
                            <div style="margin-left:46%; position: static;display:flex;margin-bottom:10px ">


                                <div class="col-xs-6 obs" style="margin-left:60px;width: 80%;display:none" type="">
                                    <div class="form-group">
                                        <label>Observation</label>
                                        <textarea name="observation" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <br />
                    </div>
                    <section class="content-header" hidden>
                        <h1 class="box-title"><?php
                                                //debug($ar);die
                                                echo __('Prix Client');
                                                ?></h1>
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
                                                    <td align="center" style="width: 25%;"></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class='tr' style="display: none !important">
                                                    <td style="width: 8%;" align="center">

                                                        <?php // debug($articles); 
                                                        ?>
                                                        <?php echo $this->Form->input('supprix', array('name' => '', 'id' => '', 'champ' => 'supprix', 'table' => 'prixarticle', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                        ?>
                                                        <div style="margin-top:6%">
                                                            <!--                                                        <?php // echo $this->Form->control('article', array( 'empty' => 'Veuillez choisir !!','options' => $ar, 'champ' => 'article', 'label' => '', 'name' => '', 'id' => '', 'table' => 'prixarticle', 'index' => '', 'div' => 'form-group ', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control '));      
                                                                                                                        ?> -->




                                                            <select table="prixarticle" index champ="article" class="">
                                                                <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                                                <?php
                                                                foreach ($ar as $id => $ar) {
                                                                ?>
                                                                    <option value="<?php echo $ar->id; ?>"><?php echo $ar->Code . ' ' . $ar->Dsignation ?></option>
                                                                <?php } ?>
                                                            </select>




                                                        </div>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('prix', array('label' => '', 'champ' => 'prix', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'prixarticle', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control four1 ')); ?>
                                                    </td>
                                                    <td align="center"><i index="" id="" class="fa fa-times supresponsable" style="color: #C9302C;font-size: 22px;"></td>
                                                </tr>






                                            </tbody>
                                        </table><br />
                                        <input type="hidden" value="-1" id="indexprix">
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
                                                <?php echo $this->Form->input('sup', array('name' => '', 'id' => '', 'champ' => 'supadresse', 'table' => 'adresse', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                ?><strong>Adresse</strong>
                                            </td>

                                            <td align="center">

                                                <input table="adresse" type="text" class="form-control" name="" id="" champ="adresse">
                                            </td>
                                            <td align="center">
                                                <i index="" id="" champ='sup0' class="fa fa-times supadresse" style="color: #c9302c;font-size: 22px;"></i>
                                            </td>
                                        </tr>




                                    </tbody>
                                </table><br>
                                <input type="hidden" value="-1" id="indexadresse">
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
                                                    <td align="center" style="width: 10%;"></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class='tr' style="display: none !important">
                                                    <td style="width: 8%;" align="center">
                                                        <?php
                                                        echo $this->Form->input('sup', array('name' => '', 'id' => '', 'champ' => 'supbanque', 'table' => 'banque', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                        ?>
                                                        <div>
                                                            <?php echo $this->Form->control('banque_id', ['style' => 'margin-top:10%', 'name' => '', 'champ' => 'banque_id', 'options' => $banques, 'label' => '', 'table' => 'banque', 'index' => '', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control  control-label', 'id' => '']);
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
                                                    <td align="center" hidden>

                                                        <?php echo $this->Form->input('code swift', array('champ' => 'swift', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'banque', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                    </td>
                                                    <td align="center" hidden>

                                                        <?php echo $this->Form->input('compte', array('champ' => 'compte', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'banque', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                    </td>
                                                    <td align="center">

                                                        <?php echo $this->Form->input('rib', array('champ' => 'rib', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'banque', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                    </td>
                                                    <td align="center" table="banque">
                                                        <input style="margin-top:1%" type="file" table="banque" champ="documen" name="documen" class="form-control" id="">
                                                    </td>







                                                    <td align="center"><i index="" id="" class="fa fa-times supbanque" style="color: #C9302C;font-size: 22px;"></td>
                                                </tr>





                                            </tbody>
                                        </table><br />
                                        <input type="hidden" value="-1" id="indexbanque">
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
                                                <tr width:20px">
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


                                                        <?php echo $this->Form->input('name', array('champ' => 'name', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'responsable', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>


                                                    </td>
                                                    <td align="center">

                                                        <?php echo $this->Form->input('mail', array('champ' => 'mail', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'responsable', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control validationChampMail')); ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('tel', array('label' => '', 'champ' => 'télèphone', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'responsable', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control four1 validationLengthChampTel')); ?>
                                                    </td>
                                                    <td align="center">

                                                        <?php echo $this->Form->input('poste', array('champ' => 'poste', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'responsable', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                    </td>
                                                    <td align="center"><i index="" id="" class="fa fa-times supresponsable" style="color: #C9302C;font-size: 22px;"></td>
                                                </tr>






                                            </tbody>
                                        </table><br />
                                        <input type="hidden" value="-1" id="indexresponsable">
                                    </div>
                                </div>
                            </div>
                        </div>


                    </section>









                    <div id="exon" style="display:none">

                        <section class="content-header">
                            <h1 class="box-title"><?php echo __('Suspension des droits et taxe '); ?></h1>
                        </section>





                        <section class="content" style="width: 99%">
                            <div class="row">
                                <div class="box ">
                                    <div class="box-header with-border">
                                        <a class="btn btn-primary al" table='addtable' index='index2' id='ajouter_ligne2' style="
                                           float: right;
                                           margin-bottom: 5px;
                                           ">
                                            <i class="fa fa-plus-circle "></i> Ajouter suspension</a>

                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive ls-table">
                                            <table class="table table-bordered table-striped table-bottomless" id="tabligne2">
                                                <thead>
                                                    <tr width:20px">

                                                        <td align="center" style="width: 20%;"><strong>Type</strong></td>
                                                        <td align="center" style="width: 20%;"><strong>N attestatin </strong></td>
                                                        <td align="center" style="width: 20%;"><strong>Date debut</strong></td>
                                                        <td align="center" style="width: 20%;"><strong>Date fin </strong></td>
                                                        <td align="center" style="width: 20%;"><strong>Document</strong></td>


                                                        <td align="center" style="width: 20%;"></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="tr" style="display: none !important">


                                                        <td align="center">
                                                            <input type="hidden" name="" id="" champ="sup2" table="lignes" index="" class="form-control">
                                                            <div style="margin-top:1%">
                                                                <?php echo $this->Form->control('typeexon_id', array('style' => 'margin-top:10%', 'empty' => 'Veuillez choisir !!', 'div' => 'form-group', 'options' => $type, 'between' => '<div class="col-sm-4">', 'after' => '</div>', 'class' => ' form-control ', 'label' => '', 'index' => 0, 'champ' => 'typeexon_id', 'table' => 'lignes', 'name' => '', 'id' => 'typeexon_id')); ?>
                                                            </div>
                                                        </td>

                                                        <td align="center">
                                                            <?php
                                                            echo $this->Form->input('num_att_taxes', array('label' => '', 'table' => 'lignes', 'champ' => 'num_att_taxes', 'id' => 'num_att_taxes', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                                            ?>

                                                        </td>
                                                        <td align="center">
                                                            <?php
                                                            echo $this->Form->input('date_debut', array('label' => '', 'table' => 'lignes', 'champ' => 'date_debut', 'id' => 'date_debut', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'date'));
                                                            ?>

                                                        </td>
                                                        <td align="center">
                                                            <?php
                                                            echo $this->Form->input('date_fin', ['label' => '', 'table' => 'lignes', 'champ' => 'date_fin', 'id' => 'date_fin', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'date']);
                                                            ?>
                                                        </td>

                                                        <td align="center" table="ligner">
                                                            <input style="margin-top:1%" type="file" table="lignes" champ="documenttt" name="documenttt" class="form-control" id="">
                                                        </td>
                                                        <td align="center">
                                                            <i index="0" id="" class="fa fa-times supLigne0" style="color: #c9302c;font-size: 22px;"></i>
                                                        </td>
                                                    </tr>
                                                    <input type="hidden" value="-1" id="index2">
                                                </tbody>
                                            </table><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>


                    <section class="content-header">
                        <h1 class="box-title"><?php echo __('Documents'); ?></h1>
                    </section>

                    <section class="content" style="width: 99%">
                        <div class="row">
                            <div class="box">
                                <div class="box-header with-border">
                                    <a class="btn btn-primary  " table='addtable' index='index' id='ajouter_ligne_doc' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                                        <i class="fa fa-plus-circle "></i> Ajouter document</a>

                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive ls-table">
                                        <table class="table table-bordered table-striped table-bottomless" id="tabligneDoc">

                                            <thead>
                                                <tr width:20px">
                                                    <td align="center" style="width: 40%;"><strong>Nom du document</strong></td>
                                                    <td align="center" style="width: 40%;"><strong>Fichier</strong></td>
                                                    <td align="center" style="width: 20%;"></td>
                                                </tr>
                                            </thead>
                                            <tbody>
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






                                            </tbody>
                                        </table><br />
                                        <input type="hidden" value="-1" id="indexdoc">
                                    </div>
                                </div>
                            </div>
                        </div>


                    </section>








                    <div align="center">
                        <!-- <button type="submit" class="pull-right btn btn-success verifier_nbr verifierexoneration verifier_date_echance  addclient alertcode" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button> -->

                        <button type="submit" class="pull-right btn btn-success" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
                    </div>
                    <?php /* echo $this->Form->submit(__('Enregistrer')); */ ?>

                    <?php echo $this->Form->end(); ?>
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->
</section>












<script type="text/javascript">
    $('#code').on('keyup', function() {
        code = $('#code').val();
        $('#compte').val(code);
    })




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
    });
    nouveau_client
</script>












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
    function gouv(id) {
        // $(function () {
        //     $('.gouv').on('change', function () {
        //         id = $('#gouvernorat').val();
        //         $('#gouv').val((id));

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

                // $('#code').val(response.queryyy);
                $('#compte').val(response.queryyy);
                $('#delegation').html(response.select);
                $('#deleg').select2();
                // uniform_select('delegation');



                //$('#adresses').val((id));

            }
        })
    }

    function localite(id) {
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
                idgouv: idgouv,
                iddeleg: iddeleg,


            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
            },
            success: function(response, status, settings) {
                // alert(response.query);
                $('#bureauposte').val(response.query);
                valeur = $('#adresses').val();

                $('#localiteadrresse').val(response.name);

                $('#adresses').val($('#localiteadrresse').val() + ' ' + $('#delegationadr').val() + ' ' + $('#gouvadresse').val() + ' ' + $('#bureauposte').val());
                $('#adress').val($('#localiteadrresse').val() + ' ' + $('#delegationadr').val() + ' ' + $('#gouvadresse').val() + ' ' + $('#bureauposte').val());

                $('#adresse0').val($('#localiteadrresse').val() + ' ' + $('#delegationadr').val() + ' ' + $('#gouvadresse').val() + ' ' + $('#bureauposte').val());
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
    $(document).ready(function() {

        $('#type_id').change(function() {

            $('#matriculefis').closest('#mat').hide();
            $('#numidentite').closest('#iden').hide();
            var selectedType = $(this).val();


            if (selectedType == 1) {
                $('#matriculefis').closest('#mat').show(); // Afficher le champ Matricule Fiscale
            } else if (selectedType == 2) {
                $('#numidentite').closest('#iden').show(); // Afficher le champ Numéro d'identité
            }
        });


    });
</script>
<script>
    $(function() {
        // $('.afficherancienclient').on('click', function () {
        //     //alert('alert')
        //     if ($('#non').is(':checked')) { 
        //         //alert('oui is checked');
        //         $('#afficher').attr('style', "display:true;");
        //     } else {
        //         $('#afficher').attr('style', "display:none;");
        //         $('#client_id').val(' ');
        //     }
        // });

        $('input[type=radio][name=nouveau_client]').click(function() {

            if (this.value == 'FALSE') {

                $('.closerow').attr('style', "display:true;");
                $(".closerow").removeClass("hidden");

            } else if (this.value == 'TRUE') {

                $('.closerow').attr('style', "display:none;");
                $(".closerow").addClass("hidden");

                $('#client_id').val(' ');

            }

        });
        $('input[type=radio][name=etat]').click(function() {

            if (this.value == 'FALSE') {

                /*     $('.closerow').attr('style', "display:true;");
                 */
                $(".hiddenob").addClass("hidden");
                $('#observationtext').val(' ');


            } else if (this.value == 'TRUE') {

                $('.closerow').attr('style', "display:none;");
                $(".hiddenob").removeClass("hidden");


            }

        });



    });
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
    $(function() {
        // $(".alertcode").on("mouseover", function() {

        //     code = $("#code").val();
        //      //alert(code)
        //     $.ajax({
        //         type: "GET",
        //         method: "GET",
        //         url: "<?= $this->Url->build(['controller' => 'Clients', 'action' => 'gtcode']) ?>",
        //         dataType: "json",
        //         data: {
        //             code:code,
        //         },
        //         success: function(data) {

        //             res = data.codes;
        //             if (res == 1) {
        //                 alert(
        //                     " code est déjà utilisé , Veuillez vous choisir une autre code"
        //                 );
        //                 return false;
        //             }
        //         },
        //     });
        // });

        $('.close').on('click', function() {

            $(".tableclose").toggle();

        })
    });


    $(function() {
        $(".alertcode").on("mouseover", function() {
            //alert('')
            tel = $("#tel").val();
            $.ajax({
                type: "GET",
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Clients', 'action' => 'checktel']) ?>",
                dataType: "JSON",
                data: {
                    tel: tel,
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
            $.ajax({
                type: "GET",
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Clients', 'action' => 'checktel']) ?>",
                dataType: "JSON",
                data: {
                    tel: tel,
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
</script>