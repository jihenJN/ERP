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


        Modification article
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
                echo $this->Form->create($article, ['role' => 'form', 'type' => 'file', 'onkeypress' => "return event.keyCode!=13"]);
                //debug ($article);
                // die;
                ?>



                <div class="box-body">
                    <div class="row">

                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('codeabr', ['type' => 'hidden', 'label' => '', 'value' => str_replace(' ', '', $val), 'id' => 'codeabr', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ']); ?>

                                    <div class="form-group input text">

                                        <label>Code</label>

                                        <input maxlength="4" value="<?php echo $article->Code   ?>" name="Code" type="tel" id="code" class="form-control">
                                    </div>

                                    <input value="<?php echo $article->id ?>" readonly  type="hidden" id="idarticle" class="form-control" style="width:34%;">



                                </div>



                                <div class="col-xs-3">
                                    <label>Code a barre</label>

                                    <div class="input-group">
                                        <span name="codepaysproducteur" class="input-group-addon" style="width:10%"><?php echo $val ?></span>
                                        <input value="<?php echo $codeart ?>" readonly name="codearticle" type="text" id="codearticle" class="form-control" style="width:34%;">

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

                                    <img style='width:150px'        <?php if ($url != '') { ?> src="<?php echo $url ?>" <?php } ?>  >


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


                                    <input value="<?php echo $article->Prix_LastInput ?>" placeholder="0.00" step="0.01" type="number" class="form-control calculprixarticle" name='Prix_LastInput' id="Prix_LastInput">




                                </div>




                            </div>
                        </div>




                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                                <div class=" col-xs-6">
                                    <?php echo $this->Form->control('unitearticle_id', ['label' => 'Unité article', 'options' => $unitearticles, 'empty' => 'Veuillez choisir !!', 'class' => ' form-control select2 control-label  calculprixarticle', 'id' => 'b', 'required' => 'off']); ?>
                                </div>




                                <div class=" col-xs-2 form-group input text required">
                                    <?php echo $this->Form->control('tva_id', ['label' => ' Catégorie Tva', 'options' => $tvas, 'empty' => 'Veuillez choisir !!', 'class' => ' form-control select2 control-label tva calculprixarticlee', 'id' => 'tvaselect', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-2">
                                    <?php
                                    if ($article->tva->valeur != null) {
                                        $tva = $article->tva->valeur;
                                    } else {
                                        $tva = 0;
                                    }
                                    echo $this->Form->control('tva', ['class' => 'form-control  control-label', 'label' => "Valeur TVA:", 'value' => $tva, 'readonly' => 'readonly', 'id' => 'tva']);
                                    ?>
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
                                        <?php echo $this->Form->control('sousfamille1_id', ['name' => 'sousfamille1_id', 'empty' => 'Veuillez choisir SVP !!', 'class' => 'form-control select2 control-label sousfamille1', 'label' => 'Sous famille']); ?>

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
                                        <?php echo $this->Form->control('sousfamille_id', ['id' => 'sous', 'name' => 'sousfamille2_id', 'empty' => 'Veuillez choisir SVP !!', 'class' => 'form-control select2 control-label sousfamille1', 'label' => 'Sous famille 2']); ?>

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
                                    <?php echo $this->Form->control('nbjour', ['type' => 'number', 'class' => 'form-control  control-label', 'label' => "Nombre de jour:"]); ?>

                                </div>




                                <div class="col-xs-6">
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
                                    <?php echo $this->Form->control('coefficient', ['type' => 'number', 'class' => 'form-control  control-label', 'label' => "Coefficient:"]); ?>

                                </div>












                            </div>

                        </div>





                        <div class="row">

                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">



                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('famillerotation_id', ['empty' => 'Veuillez choisir !!', 'options' => $famillerotations, 'class' => 'form-control select2 control-label', 'label' => "Famille rotation:"]); ?>

                                </div>

                                <div style="margin-top:20px" class="col-xs-6">
                                    <label class="control-label" for="unipxte-id" style="margin-right: 20px"> Destinée &agrave; la vente :</label>

                                    <input  type="hidden" id="vente" name="vente" >

                                    <input  type="checkbox" id="ventee" name="vente" value="1" <?php if ($article->vente == 1) { ?>   checked="true"    <?php } ?>>
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

                                Activé <input type="radio" name="etat" value="0" id="active" class="" style="margin-right: 20px" <?php if ($article->etat == 0) { ?> checked="checked" <?php } ?>>
                                Désactivé <input type="radio" name="etat" value="1" id="desactive" class="" <?php if ($article->etat == 1) { ?> checked="checked" <?php } ?>>






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


                        <div align="center" class="row">
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

                                <?php endforeach; ?>
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

                                            <?php //foreach ($objectifrepresentants as $obj) :        ?>


                                            <td style="width: 10px;">
                                                <input value="<?php echo $mm->id ?>" id="<?php echo "mois" . $i ?>" index="<?php echo $i ?>" name="<?php echo 'data[objectifrep][' . $i . '][mois]' ?>" style="height:30px;width:50px" type="hidden" class="form-control">




                                                <input value="<?php echo $s->id ?>" id="<?php echo "commercial" . $i ?>" index="<?php echo $i ?>" name="<?php echo 'data[objectifrep][' . $i . '][commercial]' ?>" style="height:30px;width:50px" type="hidden" class="form-control">


                                                <input <?php { ?> value="<?php echo @$tab[@$s->id][$mm->id] ?>" <?php } ?> id="<?php echo "objectif" . $i ?>" index="<?php echo $i ?>" name="<?php echo 'data[objectifrep][' . $i . '][objectif]' ?>" style="height:35px;width:80px" type="text" class="form-control">
                                            </td>
                                            <?php // } 
                                            ?>
                                            <?php //$i++ 
                                            ?>
                                            <?php $i++ ?>
                                        <?php endforeach; ?>


                                        <?php //endforeach;      ?>


                                    </tr>
                                    <?php $i + 1 ?>
                                <?php endforeach; ?>

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
    $(function () {
        $('.famille1').on('change', function () {
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
            //   alert(id)
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