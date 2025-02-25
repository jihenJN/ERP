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


        Ajout bon de transfert
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
                <?php echo $this->Form->create($bondetransfert, ['role' => 'form']);
                //debug ($article);
                // die;
                ?>



                <div class="box-body">
                    <div class="row">

                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('numero', ['label' => 'Numero', 'value' => $numero, 'required' => 'off', 'id' => 'numero', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => '', 'readonly' => 'readonly', 'name' => 'numero']); ?>
                                </div>


                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('date', ['label' => 'Date',]); ?>


                                </div>

                            </div>
                        </div>


                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                                <div class="col-xs-6">






                                    <?php echo $this->Form->control('pointdevente_id', ['options' => $pointdeventes, 'value' => $bondechargement->pointdevente_id, 'empty' => 'Veuillez choisir !!',  'required' => 'off', 'label' => 'Point de vente', 'class' => 'form-control select2 control-label']); ?>



                                </div>



                                <div class="col-xs-6">



                                    <div class="form-group input text required">
                                        <label class="control-label" for="name">Chauffeurs</label>
                                        <select class="form-control select2" name="chauffeur_id" id="chauffeur_id">
                                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                            <?php foreach ($chauffeurs as $id => $chauffeur) { ?>
                                                <option value="<?php echo $chauffeur->id; ?>"><?php echo $chauffeur->code . ' ' . $chauffeur->nom . ' ' . $chauffeur->prenom ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>





                                </div>
                            </div>
                        </div>




                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="col-xs-6">


                                    <?php echo $this->Form->control('depot_id', ['options' => $depots, 'value' => $bondechargement->depot_id, 'empty' => 'Veuillez choisir !!',  'required' => 'off', 'label' => 'Dépot arrivé', 'class' => 'form-control select2 control-label']); ?>


                                </div>








                                <div class="col-xs-6">
                                    <div class="form-group input text required" id="divsous">
                                        <?php echo $this->Form->control('depotsortie_id', ['id' => 'depotsortie_id', 'options' => $depotsorties, 'name' => 'depotsortie_id', 'label' => 'Depot de sortie', 'class' => 'form-control select2', 'empty' => 'Veuillez choisir !!']); ?>

                                        </select>
                                    </div>

                                </div>














                            </div>
                        </div>


                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                                <div class="col-xs-6">

                                    <div class="form-group input text required">
                                        <label class="control-label" for="name">Conffaieur</label>
                                        <select class="form-control select2" name="convoyeur_id" id="convoyeur_id">
                                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                            <?php foreach ($conffaieurs as $id => $conffaieur) {
                                            ?>

                                                <option value="<?php echo $conffaieur->id; ?>"><?php echo $conffaieur->code . ' ' . $conffaieur->nom . ' ' . $conffaieur->prenom ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-xs-6">

                                    <div class="form-group input text required">
                                        <label class="control-label" for="name">Carte carburant</label>
                                        <select class="form-control select2" name="cartecarburant_id" id="cartecarburant_id">
                                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                            <?php foreach ($cartecarburants as $id => $carte) {
                                            ?>

                                                <option value="<?php echo $id; ?>"><?php echo $carte ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>









                            </div>



                        </div>


                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="col-xs-6">

                                    <div class="form-group input text required">
                                        <label class="control-label" for="name">Materiel de transport
                                        </label>
                                        <select class="form-control select2" name="materieltransport_id" id="materieltransport_id">
                                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                            <?php foreach ($materieltransports as $id => $m) {
                                            ?>

                                                <option value="<?php echo $id; ?>"><?php echo $m ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>


                        </div>




                        <br />





                        <section class="content-header">
                            <h1 class="box-title"><?php echo __('Ligne bon de chargement'); ?></h1>
                        </section>

                        <section class="content" style="width: 99%">
                            <div class="row">
                                <div class="box box-primary">
                                    <div class="box-header with-border">

                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive ls-table">
                                            <table class="table table-bordered table-striped table-bottomless" id="addtable">



                                                <thead>
                                                    <tr width:20px>
                                                        <td align="center" style="width: 20%;"><strong>Article</strong></td>

                                                        <td align="center" style="width: 20%;"><strong>Quantite</strong></td>

                                                        <td align="center" style="width: 20%;"><strong>Quantité livrée </strong></td>

                                                    </tr>
                                                </thead>
                                                <tbody>


                                                    <?php if (!empty($lignebonchargementss)) :  ?>
                                                        <?php
                                                        $i = -1;
                                                        foreach ($lignebonchargementss as $i => $lignebonchargements) : 
                                                           // debug($lignebonchargements);
                                                            //  foreach ($lignebonchargements as $i => $ligne) :  debug($ligne->article->Dsignation);
                                                        ?>
                                                            <tr>
                                                                <td>

                                                                    <?php echo $this->Form->input('sup', array('name' => 'data[ligner][' . $i . '][sup]', 'id' => '', 'champ' => 'sup1', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                                    ?>

                                                                    <?php echo $this->Form->input('id', array('value' => $lignebonchargements->id, 'name' => 'data[ligner][' . $i . '][id_ligne]', 'id' => '', 'champ' => 'id_ligne', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                    ?>




                                                                    <?php  echo $this->Form->control('article_id', array(
                                                                        'label' => '',
                                                                        'options' => $articles,
                                                                        'value' => $lignebonchargements->article_id,


                                                                        'name' => 'data[ligner][' . $i . '][article_id]',
                                                                        'id' => 'banque_id' . $i, 'table' => 'ligner', 'index' => $i,
                                                                        'div' => 'form-group', 'between' => '<div class="col-sm-12">',
                                                                        'after' => '</div>', 'class' => 'form-control'
                                                                    )); ?>
                                                                </td>




                                                                <td align="center" table="ligner">
                                                                    <?php echo $this->Form->input('qte', ['label' => '', 'value' => $lignebonchargements->qte - $lignebonchargements->qteliv, 'type' => 'number',  'name' => 'data[ligner][' . $i . '][qte]', 'id' => 'qte' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control']); ?>
                                                                </td>
                                                                <td align="center" table="ligner">
                                                                    <?php echo $this->Form->input('quantite_liv', array('label' => '', 'type' => 'number',  'name' => 'data[ligner][' . $i . '][qteliv]', 'type' => 'number', 'id' => 'qteliv' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control verifqtelivre1 ')); ?>
                                                                </td>




                                                            </tr>
                                                        <?php endforeach; ?>

                                                    <?php endif; ?>
                                                    </tr>







                                                    <tr class="tr" style="display: none ">
                                                        <td align="center">

                                                            <input type="hidden" id="" champ="sup1" name="" table="ligner" index="" class="form-control">

                                                            <select table="ligner" index champ="article_id" class="form-control articleidbl1 select selectized">
                                                                <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                                                <?php foreach ($articles as $id => $article) {


                                                                ?>
                                                                    <option value="<?php echo $id; ?>"><?php echo  $article ?></option>
                                                                <?php } ?>
                                                            </select>

                                                        </td>
                                                        <td align="center" table="ligner">
                                                            <input table="ligner" name="" champ="qteStock" id="" type="text" class="form-control ">
                                                        </td>
                                                        <td align="center" table="ligner">
                                                            <input table="ligner" name="" champ="qte" type="text" id="" class="form-control gettotal">
                                                        </td>
                                                        <td align="center" table="ligner">
                                                            <input table="ligner" type="text" champ="prix" id="" class="form-control">
                                                        </td>
                                                        <td align="center" table="ligner">
                                                            <input table="ligner" type="text" name="" champ="total" id="" class="form-control gettotal">
                                                        </td>

                                                        <td align="center">
                                                            <i index="0" id="" class="fa fa-times supLigne0" style="color: #c9302c;font-size: 22px;"></i>
                                                        </td>
                                                    </tr>









                                                    <input type="text" value="<?php echo $i ?>" id="index" hidden>

                                                </tbody>
                                            </table><br>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </section>




                    </div>



                    <?php echo $this->Form->end(); ?>





                    <!-- /.box -->
                    <!-- table ajout unité -->


                    <div align="center">
                        <?php echo $this->Form->submit(__('Enregistrer'), ['id' => 'addbontransfert']); ?></div>

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
                    //alert(data.select);
                    $('#divsous').html(data.select);
                    uniform_select('sous');


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