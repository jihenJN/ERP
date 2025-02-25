<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fournisseur $fournisseur
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->fetch('script'); ?>



<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Consultation bon de livraison marchandise 
        <small><?php echo __(''); ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index/' . $bonlivraison->typebl]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?php
                echo $this->Form->create($bonlivraison, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]);
                //   debug($bonlivraison->typebl); 
                ?>

                <div class="box-body">
                    <div class="row">
                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('numero', ['readonly' => 'readonly', 'value' => $bonlivraison->numero, 'label' => 'Numero', 'name', 'required' => 'off']); ?>
                                </div>

                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('date', ['readonly' => 'readonly', "value" => $bonlivraison->date]); ?>
                                </div>

                            </div>
                        </div>



                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">


                            <div class="row">


                                <div class="col-xs-6">
                                    <div class="form-group input select required">

                                        <label class="control-label" for="depot-id">Clients</label>

                                        <select disabled="" name="client_id" id="client" class="form-control select2 control-label " >
                                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                            <?php foreach ($clients as $id => $client) {
                                                ?>
                                                <option <?php if ($bonlivraison->client_id == $client->id) { ?> selected="selected" <?php } ?> value="<?php echo $client->id; ?>"><?php echo $client->Code . ' ' . $client->Raison_Sociale ?></option>
                                            <?php } ?>
                                        </select>


                                    </div>




                                </div>





                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('depot_id', ['disabled' => true, 'value' => $bonlivraison->depot_id, 'options' => $depots, 'empty' => 'Veuillez choisir !!', 'required' => 'off', 'label' => 'Dépot', 'class' => 'form-control select2 control-label']); ?>
                                </div>



                            </div>
                        </div>




                
                        <br>
                        <br>


                    </div>
                 

                    <section class="content-header">
                        <h1 class="box-title"><?php echo __('Ligne bon livraison marchandise'); ?></h1>
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



                                                    <td align="center" style="width: 12%; font: size 20px;"><strong>Article</strong></td>
                                                    <td align="center" style="width: 4%;"><strong>Qte stock </strong></td>
                                                    <td align="center" style="width: 4%;"><strong>Qte </strong></td>
                                                    <td align="center" style="width: 3%;"><strong> Qte liv </strong></td>
                                                    <td align="center" style="width: 3%;"><strong>Prix</strong></td>





                                                </tr>
                                            </thead>
                                            <tbody>



                                                <?php if (!empty($bonlivraison)) : // debug($bonlivraison);  
                                                    ?>
                                                    <?php
                                                    foreach ($lignebonlivraisons as $i => $res) :
                                                        ///debug($res); die ;// debug($lignebonchargements->id);
                                                        //  foreach ($lignebonchargements as $i => $ligne) :  debug($ligne->article->Dsignation);
                                                        // debug($res);
                                                        ?>


                                                        <tr>
                                                            <td align="center">







                                                                <?php echo $this->Form->input('sup', array('name' => "data[ligner][" . $i . "][sup]", 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => '', 'class' => 'form-control', 'type' => 'hidden')); ?>




                                                                <?php
                                                                echo $this->Form->input('id', array(
                                                                    'champ' => 'id', 'label' => '', 'name' => 'data[ligner][' . $i . '][id]',
                                                                    'value' => $res->id,
                                                                    'type' => 'hidden', 'id' => '', 'table' => 'ligner', 'index' => '', 'div' => 'form-group',
                                                                    'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'
                                                                ));
                                                                ?>

                                                                <div>
                                                                <label></label>
                                                                    <select disabled="true"  width="200px" id="<?php echo 'article_id' . $i ?>" style="width:200px" table="ligner" index="<?php echo $i ?>" champ="article_id" class="js-example-responsive select2 articleidbl1">
                                                                        <option disabled="true" value="" selected="selected" disabled>Veuillez choisir !!</option>

                                                                        <?php foreach ($articles as $id => $article) {
                                                                            ?>
                                                                            <option <?php if ($res->article_id == $article->id) { ?> selected="selected" <?php } ?> value="<?php echo $id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>                                                               
                                                             </td>


                                                            <!-- <td align="center">

                                                                <?php echo $this->Form->control('Code', ['readonly' => 'readonly', 'value' => $res->article->Code, 'name' => 'data[ligner][' . $i . '][codearticle]', 'empty' => true, 'label' => '', 'table' => 'lignecommandes', 'champ' => 'article_id', 'class' => 'form-control select Testdep single', 'index']); ?>

                                                            </td> -->


                                                            <td align="center">

                                                                <?php echo $this->Form->control('qtestock', ['readonly' => 'readonly', 'value' => $res->qtestock, 'name' => 'data[ligner][' . $i . '][qteStock]', 'empty' => true, 'label' => '', 'table' => 'lignecommandes', 'champ' => 'qteStock', 'class' => 'form-control select getprixarticle Testdep single', 'index']); ?>

                                                            </td>


                                                            <td align="center">
                                                                <?php echo $this->Form->input('qte', array('readonly' => 'readonly', 'label' => '', 'value' => $res->qte, 'name' => 'data[ligner][' . $i . '][qte]', 'type' => 'number', 'id' => 'qtecmd' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calcullignecommande ', 'index')); ?>
                                                            </td>

                                                            <?php if ($bonlivraison->typebl == 3) { ?>
                                                                <td align="center">
                                                                    <?php echo $this->Form->input('quantiteliv', array('readonly' => 'readonly', 'label' => '', 'value' => $res->quantiteliv, 'name' => 'data[ligner][' . $i . '][quantiteliv]', 'type' => 'number', 'id' => 'qte' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control verifqtelivre calcullignecommande', 'index')); ?>
                                                                </td>
                                                            <?php } ?>
                                                            <td align="center">
                                                                <?php echo $this->Form->input('prix', array('readonly' => 'readonly', 'label' => '', 'value' => $res->punht, 'name' => 'data[ligner][' . $i . '][prix]', 'type' => 'text', 'id' => 'prix' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>
                                                            </td>

                                            
                                                        </tr>

                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                                </tr>




                                            <input type="hidden" value="<?php echo $i ?>" id="index">
                                            </tbody>
                                        </table><br>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </section>







                </div>






                <section class="content" style="width: 99%">
                      
                           
                               
                                 <div class="row">
                                    <div style=" position: static;">

                                    <div class="col-xs-6">
                                        <?php echo $this->Form->control('total', ['value' => $bonlivraison->totalht, 'id' => 'total', 'readonly' => 'readonly', 'label' => 'Total HT livrés', 'name', 'required' => 'off']); ?>
                                    </div>
                                                

                                    </div>
                                 </div>
                               

        
                      
                    </section>






                <!--
                                <div align="center">
                                    <button type="submit" class="pull-right btn btn-success btn-sm Testqtestock chauff" id="boutonlivraison" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
                
                                </div>-->
                <?php echo $this->Form->end(); ?>

            </div>



        </div>
    </div>
</section>




<!-- Ajout ajax recupération select -->
<script type="text/javascript">
    $(function () {
        $('#client').on('change', function () {
            //alert('hello');
            id = $('#client').val();
            // alert(id)
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Bonlivraisons', 'action' => 'getadresselivraison']) ?>",
                dataType: "json",
                data: {
                    idfam: id,

                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (data) {
                    // alert(data.ligne.Fodec);
                    $('#adresselivraison-id').html(data.select);
                    // uniform_select('adresselivraison-id');
                    // $('#exofodec').val(data.ligne.Fodec);
                    // $('#exotva').val(data.ligne.R_TVA);




                }

            })
        });
    });

    $(function () {
        $('.articleidbl1').on('change', function () {
            index = $(this).attr('index');
            // alert(inde);
            article_id = $('#article_id' + index).val();
            // alert(article_id);
            datecreation = $('#date').val();
            depot_id = $('#depot-id').val();
            //alert(depot_id);
            $.ajax({
                method: "GET",
                type: "GET",
                url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'getquantite']) ?>",
                dataType: "JSON",
                data: {
                    idarticle: article_id,
                    idadepot: depot_id,
                },
                success: function (response) {
                    //  alert(response['ligne']["Prix_LastInput"]);
                    qtestockx = response['qtestockx'];
                    // alert(qtestockx);

                    $('#qteStock' + index).val(qtestockx);
                    $('#prix' + index).val(response['ligne']["Prix_LastInput"]);
                    $('#ttc' + index).val(response['ligne']["PTTC"]);
                    //$('#exofodec').val(response['ligne']["FODEC"]);
                    $('#prixht' + index).val(response['ligne']["PHT"]);

                    $('#tva' + index).val(response['ligne']["tva"]["Taux"]);

                }
            })
        });
    });
</script>
















<!--    -->



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
<script>
    function openWindow(h, w, url) {
        //alert()
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }
</script>
<?php $this->end(); ?>