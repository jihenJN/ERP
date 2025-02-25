<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->fetch('script'); ?>
<?php echo $this->Html->script('khouloud'); ?>
<?php echo $this->Html->script('ajouterlignematrice'); ?>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('hechem'); ?>


<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ordrefabrication $ordrefabrication
 * @var \Cake\Collection\CollectionInterface|string[] $depots
 * @var \Cake\Collection\CollectionInterface|string[] $pointdeventes
 * @var \Cake\Collection\CollectionInterface|string[] $articles
 */
?>

<section class="content-header">
    <h1>


        Ajout ordre de fabrication

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i>
                <?php echo __('Retour'); ?></a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <?php echo $this->Form->create($ordrefabrication, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>

    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box ">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->



                <div class="box-body">
                    <div class="row">
                        


                        <div class="col-xs-6">
                            <?php echo $this->Form->control('numero', ['label' => 'Numero', 'required' => 'off', 'id' => 'code', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => '', 'readonly' => 'readonly', 'value' => $mm]); ?>




                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('date', ["value" => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime(date('Y-m-d H:i:s'))))]) ?>

                        </div>

                        <div class="col-xs-6">

                            <?php echo $this->Form->control('pointdevente_id', ['required' => 'off', 'id' => 'pointdevente_id', 'label' => 'Site', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 depot']); ?>
                        </div>


                        <div class="col-xs-6">

                            <?php echo $this->Form->control('depot_id', ['required' => 'off', 'id' => 'depot_id', 'label' => 'Dépot', 'div' => 'form-group', 'between' => '<div class="col-sm-10" >', 'after' => '</div>', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2']); ?>
                        </div>


                    </div>

                    <section class="content-header">
                        <h1 class="box-title"><?php echo __('Ligne ordre de fabrication'); ?></h1>
                    </section>

                    <section class="content" style="width: 99%">
                        <div class="row">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <a class="btn btn-primary  alertB" id="ajouter_ordre" table="addtable" index="index" style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                                        <i class="fa fa-plus-circle "></i> Ajouter ligne</a>

                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive ls-table">
                                        <table class="table table-bordered table-striped table-bottomless" id="addtable">



                                            <thead>
                                                <tr width:20px>
                                                    <td align="center" style="width: 35%;"><strong>Article</strong></td>
                                                    <td align="center" style="width: 10%;"><strong>Quantité</strong></td>
                                                    <td align="center" style="width: 50%;"><strong></strong></td>

                                                    <td align="center" style="width: 5%;"></td>
                                                </tr>
                                            </thead>
                                            <tbody>


                                                <tr class="tr" style="display: none!important; ">
                                                    <td align="center">

                                                        <input type="hidden" id="" champ="supp" name="" table="ligner" index="" class="form-control">

                                                        <select table="ligner" index="" name="" champ="article_id" class="form-control  fiche ">

                                                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                                            <?php foreach ($articles as $id => $article) {
                                                                ?>
                                                                <option value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                                                            <?php } ?>
                                                        </select>

                                                    </td>

                                                    <td align="center" table="ligner">
                                                        <input table="ligner" name="" champ="qte" type="text" id="" class="form-control focus calculeqte">
                                                        
                                                        <input table="ligner" name="" champ="quantite" type="hidden" id="" class="form-control ">
                                                        <input table="ligner" name="" champ="quantitee" type="hidden" id="" class="form-control ">
                                                        <input table="ligner" name="" champ="quantiteee" type="hidden" id="" class="form-control ">



                                                    </td>

                                                    <td align="center" table="ligner" champ="divmp" index="" id=""></td>

                                                    <td align="center">
                                                        <i index="" id="" class="fa fa-times supLigne0ch" style="color: #c9302c;font-size: 22px;"></i>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                        <input type="hidden" value="-1" id="index"><br>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </section>





                    <div align="center">
                        <button type="submit" class="pull-right btn btn-success btn-sm  alertOrdre "  style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
                    </div>

                    <?php echo $this->Form->end(); ?>
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->
</section>

<!-- <style>
    .select2-selection__rendered {
        line-height: 25px !important;
    }
    .select2-container
    .select2-selection--single{
        height: 35px !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        border-color: #D2D6DE !important;
    }
    .select2-selection__arrow {
        height: 34px !important;
    }
    .select2-selection__choice{
        height: 24px !important;
        color: black !important;
        background-color: white !important;
        font-size: 18px !important;
    }
    .select2-container
    {
        display: block;
        width:auto !important;
    }
</style> -->

<!-- Select2 -->
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
    })
</script>


<script>
    $(document).ready(function () {

        $('.fiche').on('change', function () {
            //  alert('hello');
            index = $(this).attr('index');//alert(index)
            article_id = $('#article_id' + index).val() || 0;
            //alert(article_id);

            //    alert(id);
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Ordrefabrications', 'action' => 'getFiche']) ?>",
                dataType: "json",
                data: {
                    id: article_id,
                    index: index,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (data, status, settings) {
                    // alert(data.res);

                    $('#divmp' + index).html(data.res);
                    $('#qte'+index).focus();

                },
                error:
                        function (data) {
                            //alert(data.res);
                            $('#divmp' + index).html(null);

                        }
            })
        });

 $('.calculeqte').on('keyup', function () {
            //  alert('hello');
            index = $(this).attr('index');//alert(index)
            article_id = $('#article_id' + index).val() || 0;
            indexx = $('#indexx' + index).val() || 0;//alert(indexx);
            indexligne = $('#indexligne' + index).val() || 0;//alert(indexligne);
            indexligneligne = $('#indexligneligne' + index + '-' + indexx + '-' + indexligne).val() || 0;//alert(indexligneligne);
            qte = Number($("#qte" + index).val());//alert(qte)
            //alert(article_id);

            //    alert(id);
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Ordrefabrications', 'action' => 'getQteval']) ?>",
                dataType: "json",
                data: {
                    id: article_id,
                  
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (data, status, settings) {
                    // alert(data.res);

                   $('#quantite'+ index ).val(data.qte1);//alert(data.qte1)
                   $('#quantitee'+ index ).val(data.qte2);
                   $('#quantiteee'+ index ).val(data.qte3);
                    qteee1 = Number($("#quantite"+index).val());//alert(qteee1);
                    qteee2 = Number($("#quantitee"+index).val());
                    qteee3 = Number($("#quantiteee"+index).val());
           
                     
            for (i = 0; i <= index; i++) {
                //indexx = $('#indexx' + i).val() || 0;
                qtecompcalu = qteee1 * qte;//alert(qtecompcalu);
                qtecompcalula = qtecompcalu * qteee2;//alert(qtecompcalu);
                qtecompcalulable = qtecompcalula * qteee3;

            }
            Number($("#qte1comp" + index + '-' + indexx).val(qtecompcalu));
            Number($("#qte2comp" + index + '-' + indexx + '-' + indexx).val(qtecompcalula));
            Number($("#qte3comp" + index + '-' + indexx + '-' + indexligne + '-' + indexligneligne).val(qtecompcalulable));
              },
                
            })
            });

        $('.depot').on('change', function () {
            //  alert('hello');

            id = $("#pointdevente_id").val();
            //alert(id)
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Ordrefabrications', 'action' => 'getDepot']) ?>",
                dataType: "json",
                data: {
                    id: id,

                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (data) {

                    $('#depot_id').html(data.select);

                }

            })
        });



       
        
    });







</script>

<?php $this->end(); ?>
