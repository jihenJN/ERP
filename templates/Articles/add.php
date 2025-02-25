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



                <div class="row">

                    <div class="row">
                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">




                            <div class="col-xs-6">
                                <div class="form-group input text required">
                                    <?php echo $this->Form->control('famille_id', ['empty' => 'Veuillez choisir SVP !!', 'options' => $familles, 'class' => 'form-control select2 control-label famille famille1', 'required' => false, 'id' => 'salma']); ?>

                                </div>

                            </div>
                            <div class="col-xs-6" hidden>
                                <?php echo $this->Form->control('Poids', ['class' => 'form-control  control-label', 'label' => 'Poids net']); ?>
                            </div>


                            <div class="col-xs-6">
                                <div class="form-group input text required" id="divsous">
                                    <?php echo $this->Form->control('sousfamille1', ['id' => 'sous', 'name' => 'sousfamille1_id', 'empty' => 'Veuillez choisir SVP !!', 'class' => 'form-control select2 control-label sousfamille1', 'required' => false, 'label' => 'Sous famille']); ?>


                                </div>

                            </div>








                        </div>
                    </div>


                    <div class="row">
                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                            <div class="col-xs-6">
                                <?php echo $this->Form->control('unite_id', ['options' => $unites, 'value' => 1, 'empty' => 'Veuillez choisir SVP !!', 'class' => 'form-control select2 control-label', 'label' => 'Unite article']); ?>
                            </div>




                            <div class="col-xs-6">
                                <?php echo $this->Form->control('Dsignation', ['label' => 'Designation', 'id' => 'Dsignation']); ?>


                            </div>


                            <div class="col-xs-6" hidden>
                                <div class="form-group input text required" id="divsoussous">
                                    <?php echo $this->Form->control('sousfamille2s', ['id' => 'soussous', 'empty' => 'Veuillez choisir SVP !!', 'class' => 'form-control select2 control-label', 'label' => 'Sous sous famille', 'required' => false]); ?>
                                </div>
                            </div>

                            <div class="col-xs-6" hidden>
                                <?php echo $this->Form->control('contenance', ['class' => 'form-control  control-label', 'label' => 'Contenance']); ?>
                            </div>













                        </div>





                    </div>



                    <div class="row">

                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">





                            <div class=" col-xs-6" hidden>
                                <?php echo $this->Form->control('unitearticle_id', ['label' => 'Unite article', 'options' => $unitearticles, 'empty' => 'Veuillez choisir !!', 'class' => ' form-control select2 control-label  ', 'id' => 'u', 'required' => false]); ?>
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

                                    <input name="Code" id="code" class="form-control">
                                </div>
                            </div>



                            <?php echo $this->Form->control('codeabr', ['type' => 'hidden', 'label' => '', 'value' => str_replace(' ', '', $val), 'id' => 'codeabr', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ']); ?>


                            <div hidden class="col-xs-3" id="codeabr">
                                <label>Code a barre</label>


                                <div class="input-group">
                                    <span name="codepaysproducteur" class="input-group-addon" style="width:10%"><?php echo $val ?></span>
                                    <input name="codearticle" readonly type="text" id="codearticle" class="form-control" style="width:50%;">

                                </div>

                            </div>


                            <div style="width: 20px;" class="aff col-xs-4  ">
                            </div>
                            <div class="col-xs-6">
                                <?php echo $this->Form->control('codeancienne', ['label' => 'Code Ancienne', 'id' => 'codeancienne']); ?>


                            </div>
                            <div class="col-xs-6" hidden>
                                <?php echo $this->Form->control('refBureauEtude', ['label' => 'Ref bureau d\'étude', 'required' => 'off', 'id' => 'refBureauEtude', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'text', 'name' => 'refBureauEtude']);
                                ?>
                            </div>




                        </div>






                    </div>



                    <div class="row">
                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">



                            <div class="col-xs-6">
                                <?php echo $this->Form->control('prixachat', ['label' => 'Prix Achat HT', 'placeholder' => "0.000", 'step' => "0.001", 'id' => 'prixachat']); ?>


                            </div>
                            <div class="col-xs-6">



                                <label> Prix Vente HT</label>


                                <input placeholder="0.000" step="0.001" value="<?php echo number_format(abs($article->prixttc), 4, ',', ' '); ?>" type="number" class="form-control calculprixarticlefinal" name='Prix_LastInput' id="Prix_LastInput">




                            </div>




                        </div>
                    </div>




                    <div class="row">
                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">







                            <div class=" col-xs-3 form-group input text required">
                                <?php echo $this->Form->control('tva_id', ['label' => 'Categorie Tva', 'options' => $tvas, 'value' => 5, 'empty' => 'Veuillez choisir !!', 'class' => ' form-control select2 control-label tva calculprixarticle', 'id' => 'tvaselect', 'required' => 'off']); ?>
                            </div>
                            <div class="  col-xs-3">


                                <?php echo $this->Form->control('tvaa', ['readonly' => 'readonly','name'=>'tva', 'id' => 'tva', 'value' => 19, 'class' => 'form-control  control-label', 'label' => "Valeur TVA:"]); ?>


                            </div>

                            <div class="col-xs-6">
                                <?php echo $this->Form->control('remise', ['class' => 'form-control  control-label', 'label' => "Remise %:"]); ?>
                            </div>

                            <div hidden class=" col-xs-6 pull-right form-group input text required">
                                <?php echo $this->Form->control('ml', ['label' => 'mètre linéaire', 'class' => ' form-control  control-label ', 'id' => 'ml', 'required' => 'off']); ?>
                            </div>




                        </div>
                    </div>




                    <div class="row">
                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                            <div id="nombrepiece">
                                <!-- <div class="col-xs-6">
                <?php //echo $this->Form->control('nombrepiece', ['type' => 'number', 'class' => 'form-control  control-label', 'label' => "Nombre de pieces par carton:"]); 
                ?>
            </div> -->


                                <!-- 
            <div class="col-xs-6">

                <label> Poids brut</label>
                <input placeholder="0.000" step="0.001" type="number" class="form-control" name='poidsbrut' id="poidsbrut">
            </div> -->




                            </div>
                        </div>
                    </div>



                    <!-- <div class="row">

    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
        <div class="col-xs-6" style="display:true;" id="coefficient">
            <?php //echo $this->Form->control('coefficient', ['type' => 'number', 'class' => 'form-control  control-label', 'label' => "Coefficient nouveau article(%):"]); 
            ?>

        </div>



        <div class="col-xs-6" id="nbpiecepalette" style="display:true;">
            <?php echo $this->Form->control('nbpiecepalette', ['type' => 'number', 'class' => 'form-control  control-label', 'label' => "Nombre de carton par palette:"]); ?>
        </div>









    </div>
</div> -->







                    <!-- <div class="row">

    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">


        <div class="col-xs-6" id="nbjour">
            <?php //echo $this->Form->control('nbjour', ['type' => 'number', 'class' => 'form-control  control-label', 'label' => "Nombre de jour (nouveau article):"]); 
            ?>

        </div>




        <div class="col-xs-6" style="display:true;" id="nbpoint">
            <?php //echo $this->Form->control('nbpoint', ['type' => 'number', 'class' => 'form-control  control-label', 'label' => "Nombre de points:"]); 
            ?>

        </div>

    </div>

</div> -->

                    <div class="row">

                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">







                            <div class="col-xs-6">
                                <label> Image </label>
                                <input type="file" name="image_file" class="form-control" id="ArticleImage">
                            </div>





                            <div class=" col-xs-6">
                                <?php echo $this->Form->control('marque_id', ['label' => 'Marque', 'options' => $marques, 'empty' => 'Veuillez choisir !!', 'class' => ' form-control select2 control-label  ', 'id' => 'marque_id', 'required' => false]); ?>
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
                                <label class="control-label" for="unipxte-id" style="margin-right: 20px"> Destine a la vente :</label>

                                <input type="checkbox" id="vente" name="vente" value="0">
                            </div>
                            <div style="margin-top:20px" id="mobile" class="col-xs-8">
                                <!-- <label class="control-label" for="unipxte-id" style="margin-right: 20px"> Mobile </label>

                                <input type="checkbox" id="mobilee" name="mobile" value="1"> -->
                            </div>
                            <div style="width:90%; margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <label class="control-label" for="unipxte-id" style="margin-right: 20px"> Etat :</label>

                                Activ&eacute; <input type="radio" name="etat" checked value="0" id="active" class="" style="margin-right: 20px">
                                D&eacute;sactiv&eacute; <input type="radio" name="etat" value="1" id="desactive" class="">






                                <br>





                                <label hidden class="control-label" for="unipxte-id" style="margin-right: 20px">Fodec :</label>

                                <input hidden type="radio" name="fodec" value="<?php echo $fodec ?>" id="OUI" class="calculprixarticle" style="margin-right: 20px">
                                <input hidden type="radio" name="fodec" value="0" id="NON" class="calculprixarticle" checked>






                                <br>


                                <?php //echo $tpe 
                                ?>
                                <label hidden class="control-label" for="unipxte-id" style="margin-right: 20px">Tpe (%):</label>

                                <input hidden type="radio" name="TXTPE" value="0" id="OUItpe" class="calculprixarticle" style="margin-right: 20px">
                                <input hidden type="radio" name="TXTPE" value="0" id="NONtpe" class="calculprixarticle">
                            </div>
                        </div>




                        <div style="display:flex;">

                            <div style="width:80%;margin-left: 30%; margin-right: 20px; position: static; ">
                                <div align="center">
                                    <div class="form-group input number">
                                        <label style="font-size:30px;color:rgb(255, 0, 0);margin-right:20px"> Prix TTC :</label>

                                        <input style="color:rgb(255, 0, 0);height: 80px;font-size:50px;width:50%;text-align:center" type="text" value="<?php echo number_format(abs($article->prixttc), 3, ',', ' '); ?>" name="prixttc" id="prixttc">

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



                    <br />






                    <!-- /.box-header -->




                </div>


                <div align="center">
                    <button type="submit" class="pull-right btn btn-success " id="ajouarticle" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>

                    <!-- <?php echo $this->Form->submit(__('Enregistrer'), ['id' => 'ajouarticle']); ?> -->
                </div>
            </div>

        </div>


        <?php echo $this->Form->end(); ?>
    </div>
    <!-- /.box -->
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