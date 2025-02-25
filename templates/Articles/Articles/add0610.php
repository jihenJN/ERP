<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fournisseur $fournisseur
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<?php echo $this->Html->script('salma'); ?>



<?php echo $this->fetch('script'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>


        Ajout
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
                <?php echo $this->Form->create($article, ['role' => 'form', 'type' => 'file', 'onkeypress' => "return event.keyCode!=13"]);
                //debug ($article);
                // die;
                ?>



                <div class="box-body">
                    <div class="row">

                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('Code', ['label' => 'Code', 'required' => 'off', 'id' => 'code', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => '', 'name' => 'Code']); ?>
                                </div>



                                <div class="col-xs-6">
                                    <label>Code a barre</label>

                                    <div class="input-group" style="width:60%;">
                                        <span name="codepaysproducteur" class="input-group-addon" style="width:20%"><?php echo $val ?></span>
                                        <input name="codearticle" type="number" id="codearticle" class="form-control" style="width:30%;">

                                    </div>
                                </div>






                            </div>






                        </div>



                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">



                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('Dsignation', ['label' => 'Désignation', 'id' => 'Dsignation']); ?>


                                </div>
                                <div class="col-xs-6">



                                    <label> Prix hors taxe</label>


                                    <input placeholder="0.00" step="0.01" type="number" class="form-control calculprixarticle" name='Prix_LastInput' id="Prix_LastInput">




                                </div>




                            </div>
                        </div>




                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">





                                <div class=" col-xs-6">
                                    <?php echo $this->Form->control('unitearticle_id', ['label' => 'Unité article', 'options' => $unites, 'empty' => 'Veuillez choisir !!', 'class' => ' form-control select2 control-label tva  calculprixarticle', 'id' => 'u', 'required' => 'off']); ?>
                                </div>

                                <div class=" col-xs-2 form-group input text required">
                                    <?php echo $this->Form->control('tva_id', ['label' => 'Catégorie Tva', 'options' => $tvas, 'empty' => 'Veuillez choisir !!', 'class' => ' form-control select2 control-label tva  calculprixarticle', 'id' => 'tvaselect', 'required' => 'off']); ?>
                                </div>
                                <div class="  col-xs-2">


                                    <?php echo $this->Form->control('tva', ['readonly' => 'readonly', 'id' => 'tva', 'class' => 'form-control  control-label', 'label' => "Valeur TVA:"]); ?>


                                </div>






                            </div>
                        </div>
                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">




                                <div class="col-xs-6">
                                    <div class="form-group input text required">
                                        <?php echo $this->Form->control('famille_id', ['empty' => 'Veuillez choisir SVP !!', 'options' => $familles, 'class' => 'form-control select2 control-label famille1', 'id' => 'salma']); ?>

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
                                        <?php echo $this->Form->control('sousfamille1', ['name' => 'sousfamille1_id', 'empty' => 'Veuillez choisir SVP !!', 'class' => 'form-control select2 control-label sousfamille1', 'label' => 'Sous famille']); ?>

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
                                        <?php echo $this->Form->control('sousfamille1', ['empty' => 'Veuillez choisir SVP !!', 'class' => 'form-control select2 control-label', 'label' => 'Sous sous famille']); ?>


                                    </div>

                                </div>



                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('unite_id', ['options' => $unites, 'empty' => 'Veuillez choisir SVP !!', 'class' => 'form-control select2 control-label', 'label' => 'Unités']); ?>
                                </div>


                            </div>
                        </div>




                        <div class="row">

                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('nombrepiece', ['type' => 'number', 'class' => 'form-control  control-label', 'label' => "Nombre de pièces par carton:"]); ?>
                                </div>



                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('poidsbrut', ['class' => 'form-control  control-label', 'label' => 'Poids brut']); ?>
                                </div>




                            </div>
                        </div>



                        <div class="row">

                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">




                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('nbpiecepalette', ['type' => 'number', 'class' => 'form-control  control-label', 'label' => "Nombre de carton par palette:"]); ?>
                                </div>



                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('remise', ['class' => 'form-control  control-label', 'label' => "Remise %:"]); ?>
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
                                    <div class="form-group input number">
                                        <label style="font-size:30px;color:rgb(255, 0, 0);margin-right:20px"> Prix TTC :</label>

                                        <input style="color:rgb(255, 0, 0);height: 50px;font-size:30px;width:150px;text-align:center" readonly='readonly' type="text" name="prixttc" id="prixttc">

                                    </div>
                                </div>

                            </div>

                        </div>




                        <div class="row">

                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">







                                <div class="col-xs-6" style="margin-top: 20px ;">
                                    <label class="control-label" for="unipxte-id" style="margin-right: 20px"> Etat :</label>

                                    Activé <input type="radio" name="etat" value="0" id="active" class="" style="margin-right: 20px">
                                    Désactivé <input type="radio" name="etat" value="1" id="desactive" class="">


                                </div>








                            </div>
                        </div>





                        <div class="row">

                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">








                                <div class="col-xs-6" style="margin-top: 20px ;">
                                    <label class="control-label" for="unipxte-id" style="margin-right: 20px">Fodec :</label>

                                    OUI <input type="radio" name="fodec" value="<?php echo $fodec ?>" id="OUI" class="calculprixarticle" style="margin-right: 20px">
                                    NON <input type="radio" name="fodec" value="0" id="NON" class="calculprixarticle">


                                </div>


                            </div>
                        </div>




                        <div class="row">

                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">








                                <div class="col-xs-6" style="margin-top: 20px ;">
                                    <label class="control-label" for="unipxte-id" style="margin-right: 20px">Tpe (%):</label>

                                    OUI <input type="radio" name="TXTPE" value="<?php echo $tpe ?>" id="OUItpe" class="calculprixarticle" style="margin-right: 20px">
                                    NON <input type="radio" name="TXTPE" value="0" id="NONtpe" class="calculprixarticle">


                                </div>


                            </div>
                        </div>



                        <div class="row" style="text-align: center;margin-top:20px">

                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">


                                <div class="col-xs-6">

                                    <?php echo $this->Html->image('imgart/' . $article->image, ['style' => 'max-width:100px;height:100px;']); ?>
                                </div>





                            </div>
                        </div>



                        <br />


                        <!-- /.box-header -->
                        <div align="center" class="row">
                            <table style="width: 50%;" class="table table-bordered table-striped table-bottomless" id="tab">



                                <tr>
                                    <th> Mois</th>
                                    <th style="text-align: center;">Minimum stock</th>
                                    <th style="text-align: center;">Maximum stock</th>
                                    <th style="text-align: center;">Alert</th>

                                </tr>
                                <tr style="height:20px">

                                    <td width="15px" style="text-align: center;">Janvier</td>
                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" index="1" name="data[seuil][1][minimum]" type="number" class="seuil form-control" name="" id="min1">
                                    </td>

                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" index="1" name="data[seuil][1][maximum]" type="number" class="seuil form-control" name="" id="max1">
                                    </td>

                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" index="1" name="data[seuil][1][alert]" type="number" class="seuil form-control" name="" id="alert1">
                                    </td>



                                </tr>

                                <tr style="height:20px">

                                    <td style="text-align: center;" width="15px">Février</td>
                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" index="2" name="data[seuil][2][minimum]" type="number" class="seuil form-control" id="min2">
                                    </td>

                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" index="2" name="data[seuil][2][maximum]" table="quantite" type="number" class="seuil form-control" id="max2">
                                    </td>

                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" index="2" name="data[seuil][2][alert]" table="quantite" type="number" class="seuil form-control" id="alert2">
                                    </td>



                                </tr>
                                <tr style="height:20px">

                                    <td style="text-align: center;" width="15px">Mars</td>
                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" index="3" name="data[seuil][3][minimum]" type="number" class="seuil form-control" id="min3">
                                    </td>

                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" index="3" name="data[seuil][3][maximum]" type="number" class="seuil form-control" id="max3">
                                    </td>

                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" index="3" name="data[seuil][3][alert]" type="number" class="seuil form-control" id="alert3">
                                    </td>



                                </tr>
                                <tr style="height:20px">

                                    <td style="text-align: center;" width="15px">Avril</td>
                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" name="data[seuil][4][minimum]" table="quantite" type="number" class="seuil form-control" id="min4" index="4">
                                    </td>

                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" name="data[seuil][4][maximum]" table="quantite" type="number" class="seuil form-control" id="max4" index="4">
                                    </td>

                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" name="data[seuil][4][alert]" table="quantite" type="number" class="seuil form-control" id="alert4" index="4">
                                    </td>



                                </tr>
                                <tr style="height:20px">

                                    <td style="text-align: center;" width="15px">Mai</td>
                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" name="data[seuil][5][minimum]" index="5" type="number" class="seuil form-control" id="min5">
                                    </td>

                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" name="data[seuil][5][maximum]" index="5" type="number" class="seuil form-control" id="max5">
                                    </td>

                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" name="data[seuil][5][alert]" index="5" type="number" class="seuil form-control" id="alert5">
                                    </td>



                                </tr>
                                <tr style="height:20px">

                                    <td style="text-align: center;" width="15px">Juin</td>
                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" name="data[seuil][6][minimum]" index="6" type="number" class="seuil form-control" id="min6">
                                    </td>

                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" name="data[seuil][6][maximum]" index="6" type="number" class="seuil form-control" id="max6">
                                    </td>

                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" name="data[seuil][6][alert]" index="6" type="number" class="seuil form-control" id="alert6">
                                    </td>



                                </tr>
                                <tr style="height:20px">

                                    <td style="text-align: center;" width="15px">Juillet</td>
                                    <td>
                                        <input style="height:30px;width:80px" name="data[seuil][7][minimum]" index="7" type="number" class="seuil form-control" id="min7">
                                    </td>

                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" name="data[seuil][7][maximum]" index="7" type="number" class="seuil form-control" id="max7">
                                    </td>

                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" name="data[seuil][7][alert]" index="7" type="number" class="seuil form-control" ids="alert7">
                                    </td>



                                </tr>
                                <tr style="height:20px">

                                    <td style="text-align: center;" width="15px">Aout</td>
                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" name="data[seuil][8][minimum]" index="8" type="number" class="seuil form-control" id="min8">
                                    </td>

                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" name="data[seuil][8][maximum]" index="8" type="number" class="seuil form-control" id="max8">
                                    </td>

                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" name="data[seuil][8][alert]" index="8" type="number" class="seuil form-control" id="alert8">
                                    </td>



                                </tr>



                                <tr style="height:20px">

                                    <td style="text-align: center;" width="15px">Septembre</td>
                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" name="data[seuil][9][minimum]" index="9" type="number" class="seuil form-control" id="min9">
                                    </td>

                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" name="data[seuil][9][maximum]" index="9" type="number" class="seuil form-control" id="max9">
                                    </td>

                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" name="data[seuil][9][alert]" index="9" type="number" class="seuil form-control" id="alert9">
                                    </td>



                                </tr>
                                <tr style="height:20px">

                                    <td style="text-align: center;" width="15px">Octobre</td>
                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" name="data[seuil][10][minimum]" index="10" type="number" class="seuil form-control" id="min10">
                                    </td>

                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" name="data[seuil][10][maximum]" index="10" type="number" class="seuil form-control" id="max10">
                                    </td>

                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" name="data[seuil][10][alert]" index="10" type="number" class="seuil form-control" id="alert10">
                                    </td>



                                </tr>
                                <tr style="height:20px">

                                    <td style="text-align: center;" width="15px">Novembre</td>
                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" name="data[seuil][11][minimum]" index="11" type="number" class="seuil form-control" id="min11">
                                    </td>

                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" name="data[seuil][11][maximum]" index="11" type="number" class="seuil form-control" id="max11">
                                    </td>

                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" name="data[seuil][11][alert]" index="11" type="number" class="seuil form-control" id="alert11">
                                    </td>



                                </tr>
                                <tr style="height:20px">

                                    <td style="text-align: center;" width="15px">Décembre</td>
                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" name="data[seuil][12][minimum]" index="12" type="number" class="seuil form-control" id="min12">
                                    </td>

                                    <td style="text-align: center;">
                                        <input style="height:30px;width:80px" name="data[seuil][12][maximum]" index="12" type="number" class="seuil form-control" id="max11">
                                    </td>

                                    <td style="text-align: center;">
                                        <input style="height:30px;width: 80px;" name="data[seuil][12][alert]" index="12" type="number" class="seuil form-control" id="alert11">
                                    </td>



                                </tr>

                            </table>



                        </div>

                    </div>







                    <?php echo $this->Form->end(); ?>





                    <!-- /.box -->
                    <!-- table ajout unité -->


                    <div align="center">
                        <?php echo $this->Form->submit(__('Enregistrer'), ['id' => 'ajouarticle']); ?></div>

                    <?php echo $this->Form->end(); ?>
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->

</section>




<script type="text/javascript">
    $(function() {
        $('.famille1').on('change', function() {
            // alert('hello');
            id = $('#salma').val();
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
                success: function(data) {
                    // alert(data.select1);
                    $('#divsous').html(data.select);
                    // uniform_select('divsous');


                    $('#divsoussous').html(data.select1);
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
        });
    });




    $(function() {
        $('.tva').on('change', function() {
            // alert('hello');
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
                    //    alert(data);
                    $('#tva').val(data['ligne']["valeur"]);

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
            alert('hello');
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
        $('#codearticle').on('blur', function() {
            // alert('hello');
            codearticle = $('#codearticle').val();
            //alert(codearticle)


            //  alert(codearticle);

            length = codearticle.length;
            //
            if (length != 4) {
                alert("Veuillez entrer un code de longueur 4 SVP !! ");
                $("#codearticle").val("");
            }
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
                    //alert(data.select);
                    //  $('#divsous').html(data.select);
                    // uniform_select('divsous');

                    if (data.codeexistant.length != 0) {
                        alert("Code article déja reservé !!");
                        $('#codearticle').val("");
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