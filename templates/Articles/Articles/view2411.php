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


        Consultation article
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
                // debug($article);
                // die;
                ?>



                <div class="box-body">
                    <div class="row">

                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('Code', ['readonly' => 'readonly', 'label' => 'Code', 'required' => 'off', 'id' => 'code', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => '', 'name' => 'Code']); ?>
                                </div>



                                <div class="col-xs-3">
                                    <label>Code a barre</label>

                                    <div class="input-group">
                                        <span name="codepaysproducteur" class="input-group-addon" style="width:10%"><?php echo $val ?></span>
                                        <input value="<?php echo $codeart ?>" readonly name="codearticle" type="text" id="codearticle" class="form-control" style="width:34%;">

                                    </div>
                                </div>
                                    <?php //debug($codeart);
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
                                    <?php echo $this->Form->control('Dsignation', ['readonly' => 'readonly', 'label' => 'Désignation', 'id' => 'Dsignation']); ?>


                                </div>
                                <div class="col-xs-6">



                                    <label> Prix hors taxe</label>


                                    <input readonly value="<?php echo $article->Prix_LastInput ?>" placeholder="0.00" step="0.01" type="number" class="form-control calculprixarticle" name='Prix_LastInput' id="Prix_LastInput">




                                </div>




                            </div>
                        </div>




                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                                <div class=" col-xs-6">
                                    <?php echo $this->Form->control('unitearticle_id', ['disabled' => true, 'label' => 'Unité article', 'options' => $unites, 'empty' => 'Veuillez choisir !!', 'class' => ' form-control select2 control-label tva  calculprixarticle', 'id' => 'tvaselect', 'required' => 'off']); ?>
                                </div>



                                <div class=" col-xs-2 form-group input text required">
                                    <?php echo $this->Form->control('tva_id', ['disabled' => true, 'label' => ' Catégorie Tva', 'options' => $tvas, 'empty' => 'Veuillez choisir !!', 'class' => ' form-control select2 control-label tva calculprixarticle', 'id' => 'tvaselect', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-2">
                                    <?php if ($article->tva->valeur != null) {
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
<?php echo $this->Form->control('famille_id', ['disabled' => true, 'empty' => 'Veuillez choisir SVP !!', 'options' => $familles, 'class' => 'form-control select2 control-label famille1', 'id' => 'salma']); ?>

                                    </div>
                                </div>


                                <div class="col-xs-6">
<?php echo $this->Form->control('Poids', ['readonly', 'class' => 'form-control  control-label', 'label' => 'Poids net']); ?>
                                </div>









                            </div>
                        </div>


                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                                <div class="col-xs-6">
                                    <div class="form-group input text required" id="divsous">
<?php echo $this->Form->control('sousfamille1_id', ['disabled' => true, 'name' => 'sousfamille1_id', 'empty' => 'Veuillez choisir SVP !!', 'class' => 'form-control select2 control-label sousfamille1', 'label' => 'Sous famille']); ?>

                                        </select>
                                    </div>

                                </div>




                                <div class="col-xs-6">
<?php echo $this->Form->control('contenance', ['readonly', 'class' => 'form-control  control-label', 'label' => 'Contenance']); ?>
                                </div>



                            </div>


                        </div>









                        <div class="row">

                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">


                                <div class="col-xs-6">
                                    <div class="form-group input text required" id="divsoussous">
<?php if($article->sousfamille2_id != 0) {
echo $this->Form->control('sousfamille2_id', ['value' => $article->sousfamille2_id, 'disabled' => true, 'empty' => 'Veuillez choisir SVP !!', 'class' => 'form-control select2 control-label', 'label' => 'Sous sous famille']);
}
 else {
    echo $this->Form->control('sousfamille_id', ['disabled' => true, 'empty' => 'Veuillez choisir SVP !!', 'class' => 'form-control select2 control-label', 'label' => 'Sous sous famille']);

}
?>


                                    </div>
                                </div>













                                <div class="col-xs-6">
<?php echo $this->Form->control('unite_id', ['disabled' => true, 'options' => $unites, 'empty' => 'Veuillez choisir SVP !!', 'class' => 'form-control select2 control-label', 'label' => 'Unités']); ?>
                                </div>




                            </div>
                        </div>




                        <div class="row">

                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">



                                <div class="col-xs-6">
<?php echo $this->Form->control('nombrepiece', ['readonly', 'type' => 'number', 'class' => 'form-control  control-label', 'label' => "Nombre de pièces par carton:"]); ?>
                                </div>







                                <div class="col-xs-6">
<?php echo $this->Form->control('poidsbrut', ['readonly', 'class' => 'form-control  control-label', 'label' => 'Poids brut']); ?>
                                </div>




                            </div>
                        </div>



                        <div class="row">

                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">




                                <div class="col-xs-6">
<?php echo $this->Form->control('nbpiecepalette', ['readonly', 'type' => 'number', 'class' => 'form-control  control-label', 'label' => "Nombre de carton par palette:"]); ?>
                                </div>




                                <div class="col-xs-6">
<?php echo $this->Form->control('remise', ['readonly', 'class' => 'form-control  control-label', 'label' => "Remise %:"]); ?>
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

                                        <input readonly='readonly' value="<?php echo $article->prixttc ?>" style="color:rgb(255, 0, 0);height: 50px;font-size:30px;width:150px;text-align:center" readonly='readonly' type="text" name="prixttc" id="prixttc">

                                    </div>
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


                        <div class="row" style="text-align: center;margin-top:20px">

                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                                <div class="col-xs-6">

                                    <label class="control-label" for="unipxte-id" style="margin-right: 20px">Fodec :</label>

                                    OUI <input type="radio" name="fodec" value="<?php echo $fodec ?>" id="OUI" class="" style="margin-right: 20px" <?php if ($article->fodec != 0) { ?> checked="checked" <?php } ?>>
                                    NON <input type="radio" name="fodec" value="0" id="NON" class="" <?php if ($article->fodec == 0) { ?> checked="checked" <?php } ?>>



                                </div>



                            </div>
                        </div>

                        <div class="row" style="text-align: center;margin-top:20px">

                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                                <div class="col-xs-6">
                                    <label class="control-label" for="unipxte-id" style="margin-right: 20px"> Etat :</label>

                                    Activé <input type="radio" name="etat" value="0" id="active" class="" style="margin-right: 20px" <?php if ($article->etat == 0) { ?> checked="checked" <?php } ?>>
                                    Désactivé <input type="radio" name="etat" value="1" id="desactive" class="" <?php if ($article->etat == 1) { ?> checked="checked" <?php } ?>>


                                </div>
                            </div>
                        </div>



                        <div class="row" style="text-align: center;margin-top:20px">

                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                                <div class="col-xs-6">
                                    <label class="control-label" for="unipxte-id" style="margin-right: 20px">Tpe (%):</label>

                                    OUI <input type="radio" name="TXTPE" value="<?php echo $tpe ?>" id="OUItpe" class="calculprixarticle" style="margin-right: 20px" class="" style="margin-right: 20px" <?php if ($article->TXTPE != 0) { ?> checked="checked" <?php } ?>>
                                    NON <input type="radio" name="TXTPE" value="0" id="NONtpe" class="calculprixarticle" <?php if ($article->TXTPE == 0) { ?> checked="checked" <?php } ?>>


                                </div>
                            </div>
                        </div>

                        <br />


                        <div align="center" class="row">
                            <table style="width: 50%;" class="table table-bordered table-striped table-bottomless" id="tab">



                                <tr>
                                    <th> Mois</th>
                                    <th style="text-align: center;">Minimum stock</th>
                                    <th style="text-align: center;">Maximum stock</th>
                                    <th style="text-align: center;">Alert</th>

                                </tr>


<?php
$i = 1;
//debug($i);
foreach ($seuil as $s) :
    ?>
                                    <tr style="height:20px">

                                        <td width="15px" style="text-align: center;"><?php
                                            if ($s->mois == 1)
                                                echo "Janvier";
                                            if ($s->mois == 2)
                                                echo "Février";
                                            if ($s->mois == 3)
                                                echo "Mars";
                                            if ($s->mois == 4)
                                                echo "Avril";
                                            if ($s->mois == 5)
                                                echo "Mai";
                                            if ($s->mois == 6)
                                                echo "Juin";
                                            if ($s->mois == 7)
                                                echo "Juillet";
                                            if ($s->mois == 8)
                                                echo "Aout";
                                            if ($s->mois == 9)
                                                echo "Septembre";
                                            if ($s->mois == 10)
                                                echo "Octobre";
                                            if ($s->mois == 11)
                                                echo "Novembre";
                                            if ($s->mois == 12)
                                                echo "Décembre";
                                            ?></td>
                                        <td style="text-align: center;">
                                            <input readonly id="<?php echo "min" . $i ?>" index="<?php echo $i ?>" value="<?php echo $s->min ?>" style="height:30px;width:80px" name="<?php echo 'data[seuil][' . $i . '][minimum]' ?>" type="number" class=" seuil form-control">
                                            <input readonly name="<?php echo 'data[seuil][' . $i . '][id]' ?>" value="<?php echo $s->id ?>" style="height:30px;width:80px" table="quantite" type="hidden" class="form-control">


                                        </td>

                                        <td style="text-align: center;">
                                            <input readonly id="<?php echo "max" . $i ?>" index="<?php echo $i ?>" name="<?php echo 'data[seuil][' . $i . '][maximum]' ?>" value="<?php echo $s->max ?>" style="height:30px;width:80px" table="quantite" type="number" class=" seuil form-control">
                                        </td>

                                        <td style="text-align: center;">
                                            <input readonly id="<?php echo "alert" . $i ?>" index="<?php echo $i ?>" name="<?php echo 'data[seuil][' . $i . '][alert]' ?>" value="<?php echo $s->alert ?>" style="height:30px;width:80px" table="quantite" type="number" class=" seuil  form-control">
                                        </td>



                                    </tr>
    <?php $i++; ?>

<?php endforeach; ?>
                            </table>



                        </div>



                        <br />



                    </div>



<?php echo $this->Form->end(); ?>





                    <!-- /.box -->
                    <!-- table ajout unité -->




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
                    uniform_select('divsous');


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