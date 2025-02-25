<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ville $ville
 */
?>
<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->css('select2'); ?>

<section class="content-header">
    <h1>
        Commande retour marchandise
        <small><?php echo __(''); ?></small>
    </h1>



    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'indexm']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
    </ol>

</section>




<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box ">
                <?php
                //debug($commande);
                echo $this->Form->create($commande, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13",]);
                //  debug(str_replace(",", ".",$commande->total));
                //die;
                ?>
                <div class="box-body">

                    <div class="row">

                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                            <div class="col-xs-6">
                                <?php
                                echo $this->Form->control('numero', ['readonly' => 'readonly']);
                                ?>
                            </div>

                            <div class="col-xs-6">
                                <?php


                                echo $this->Form->control('date');
                                //  debug($commande->client_id);
                                ?>
                            </div>





                        </div>
                    </div>

                    <div class="row">

                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">


                            <div class="col-xs-6">
                                <div class="form-group input select required">

                                    <label class="control-label" for="depot-id">Clients</label>

                                    <select disabled name="client_id" id="client" class="form-control select2 control-label ">
                                        <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                        <?php foreach ($clients as $id => $client) {

                                        ?>
                                            <option <?php if ($commande->client_id == $client->id) { ?> selected="selected" <?php } ?> value="<?php echo $client->id; ?>"><?php echo $client->Code . ' ' . $client->Raison_Sociale ?></option>
                                        <?php } ?>
                                    </select>


                                </div>

                            </div>
                            <div class="col-xs-6" id="com_id">
                                <?php
                                echo $this->Form->control('commercial_id', ['class' => 'form-control select2 control-label', 'empty' => 'Veuillez choisir !!', 'required' => 'off', 'disabled' => true]);
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">


                            <div class="col-xs-6">
                                <?php
                                // echo 'tt'.$commande;
                                echo $this->Form->control('depot_id', ['value' => $commande->depot_id, 'class' => 'form-control select2 control-label', 'required' => 'off', 'disabled' => true]);
                                ?>
                            </div>


                            <div class="col-xs-6" style="float: right;">
                            <?php
                            echo $this->Form->control('observation', ['label' => 'Observation', 'class' => 'form-control', 'type' => 'textarea', 'value' => $commande->observation  , 'readonly']); ?>
                        </div>


                        </div>
                    </div>






                    <div class="col-md-12">


                        <section class="content" style="width: 99%">
                            <div class="row">
                                <div class="box">


                                    <div class="panel-body">
                                        <div class="table-responsive ls-table">
                                            <table class="table table-bordered table-striped table-bottomless" id="addtable">
                                                <thead>
                                                <tr>
                                                <td align="center" style="width: 45%; font-size: 12px;"><strong>Article</strong></td>
                                                <td align="center" style="width: 15%;font-size: 12px;"><strong>Quantité réceptionnelle </strong></td>
                                                <td align="center" style="width: 15%;font-size: 12px;"><strong>Quantité livrée </strong></td>
                                                <td align="center" style="width: 15%;font-size: 12px;"><strong>Prix</strong></td>

                                            </tr>
                                                </thead>
                                                <tbody>


                                                    <?php if (!empty($commande)) : // debug($commande);  
                                                    ?>
                                                        <?php
                                                        foreach ($lignecommandes as $i => $res) :
                                                              debug($res);
                                                              

                                                        ?>
                                                            <tr>
                                                                <td>



                                                                    <div>
                                                                        <label></label>
                                                                        <select disabled name="<?php echo "data[ligner][" . $i . "][article_id]" ?>" width="200px" id="<?php echo 'article_id' . $i ?>" style="width:200px" table="ligner" index="<?php echo $i ?>" champ="article_id" class="js-example-responsive select2 articleQtest">
                                                                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                                                            <?php foreach ($articles as $id => $article) {
                                                                            ?>
                                                                                <option <?php if ($res->article_id == $article->id) { ?> selected="selected" <?php } ?> value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                                                                            <?php }
                                                                            

                                                                            ?>

                                                                        </select>

                                                                    </div>
                                                                    <?php echo $this->Form->input('sup', array('name' => "data[ligner][" . $i . "][sup]", 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'type' => 'hidden')); ?>




                                                                    <?php
                                                                    echo $this->Form->input('id', array(
                                                                        'champ' => 'id', 'label' => '', 'name' => 'data[ligner][' . $i . '][id]',
                                                                        'value' => $res->id,
                                                                        'type' => 'hidden', 'id' => '', 'table' => 'ligner', 'index' => '', 'div' => 'form-group',
                                                                        'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'
                                                                    ));
                                                                    ?>

                                                                </td>



                                                                <td align="center" table="ligner" id='q<?php echo $i ?>'>
                                                                    <?php echo $this->Form->input('qte', array('index' => $i, 'label' => '', 'value' => $res->qte, 'name' => 'data[ligner][' . $i . '][qte]', 'type' => 'text', 'id' => 'qte' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculHT focus', 'index', 'readonly' => 'readonly',)); ?>





                                                                </td>




                                                                <td align="center" table="ligner" id='qs<?php echo $i ?>'>

                                                                    <?php echo $this->Form->control('quantiteliv', ['id' => 'quantiteliv' . $i, 'index' => $i, 'value' => $res->quantiteliv, 'name' => 'data[ligner][' . $i . '][quantiteliv]', 'empty' => true, 'label' => '', 'table' => 'lignecommandes', 'champ' => 'quantiteliv', 'class' => 'form-control select ', 'index','readonly' => 'readonly']); ?>

                                                                </td>
                                                                <td align="center" table="ligner" id='p<?php echo $i ?>'>
                                                                    <?php echo $this->Form->input('prix', array('index' => $i, 'label' => '', 'value' => $res->prix, 'name' => 'data[ligner][' . $i . '][prix]', 'type' => 'text', 'id' => 'prix' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index', 'readonly')); ?>
                                                                </td>


                                                            </tr>

                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                    </tr>



                                                    <input type="" value="<?php echo $i ?>" id="index" hidden>

                                                </tbody>

                                            </table>


                                        </div>
                                    </div>
                                </div>
                            </div>


                        </section>


                        <section class="content" style="width: 99%">

                            <div class="row">
                                <div class="row">
                                    <div style=" position: static;">
                                        <div class="col-xs-6 pull-left">
                                            <?php echo $this->Form->control('total', ['id' => '', 'readonly' => 'readonly', 'label' => 'Total HT réceptionnelle', 'name', 'required' => 'off']); ?>
                                        </div>

                                        <div class="col-xs-6 pull-left">
                                            <?php echo $this->Form->control('totalliv', ['id' => 'ht', 'readonly' => 'readonly', 'label' => 'Total HT livrés', 'name', 'required' => 'off']); ?>
                                        </div>


                                    </div>
                                </div>

                            </div>
                        </section>

                    </div><br>
                    <!-- <input type="hidden" value="<?php echo $i ?>" id="index0"> -->
                </div>
            </div>
        </div>
    </div>





    </div>
    <?php echo $this->Form->end(); ?>
    </div>
    <!-- /.box -->
    </div>
    </div>
    <!-- /.row -->
</section>


<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
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

        $('.articleQtest').on('change', function() {

            index = $(this).attr('index');
            article_id = $('#article_id' + index).val();
            date = $('#date').val();
            depot = $('#depot-id').val();
            client = $('#client').val();


            $.ajax({
                method: "GET",
                type: "GET",
                url: "<?= $this->Url->build(['controller' => 'Bonsortiestocks', 'action' => 'getquantite']) ?>",
                dataType: "JSON",
                data: {
                    idarticle: article_id,
                    date: date,
                    depot: depot,
                    client: client,

                },
                success: function(data) {
                    //  alert(data.qtes)

                    $('#qtestock' + index).val(data.qtes);
                    $('#prix' + index).val(data.prix);
                    $('#remiseclient' + index).val(data.remise);
                    $('#tva' + index).val(data.tva);
                    $('#fodec' + index).val(data.fodec);
                    $('#remisearticle' + index).val(data.remiseart);
                    $('#qteStock' + index).focus();
                    $('#qte' + index).val('');


                }

            })

        })
        $('.calculHT').on('keyup', function() {
            Calcul();
        })


        $('.supp').on('click', function() {

            i = $(this).attr('index');
            index = $('#index').val();

            $('#sup' + i).val('1');
            $(this).parent().parent().hide();

            Calcul(i);


        });






    })

    function Calcul() {
        ///  alert('hechem')


        index = $('#index').val();

        totalht = 0;

        /// alert(ht)


        for (i = 0; i <= index; i++) {
            sup = $('#sup' + i).val() || 0;

            if (Number(sup) != 1) {

                prix = $('#prix' + i).val() || 0;
                ///alert(prix); 
                qte = $('#qte' + i).val() || 0;

                tot = Number(prix) * Number(qte);
                /// alert(tot)
                totalht = Number(tot) + Number(totalht);
                // alert(totalht)



            }
        }

        $('#ht').val(Number(totalht).toFixed(3));


    }
    $('.select2').select2();
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
<?php echo $this->Html->css('select2'); ?>


<?php $this->end(); ?>