<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Compte $compte
 * @var \Cake\Collection\CollectionInterface|string[] $agences
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<section class="content-header">
    <h1>
        Compte
        <small><?php echo __('Ajouter'); ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box ">

                <!-- /.box-header -->
                <!-- form start -->
                <?php echo $this->Form->create($compte, ['role' => 'form']); ?>
                <div class="box-body">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        
                    
                    <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('numero', ['label' => 'Numéro']);
                            ?>
                        </div>
                        <div class="col-xs-6">
                                    <?php echo $this->Form->control('date', ["value" => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime(date('Y-m-d H:i:s'))))]) ?>
                                </div>
                        <div class="col-md-6">
                            <?php

                            echo $this->Form->control('agence_id', array(
                                'empty' => 'Veuillez choisir !!', 'options' => $agences, 'class' => ' form-control ', 'name' => 'agence_id', 'label' => 'Agence', 'id' => 'agence_id', 'type' => '', 'class' => 'form-control select2'
                            ));
                            ?>

                        </div>
                        <div class="col-md-6">
                            <?php

                            echo $this->Form->control('banque_id', array(
                                'empty' => 'Veuillez choisir !!', 'options' => $banques, 'class' => ' form-control ', 'name' => 'banque_id', 'label' => 'Banque', 'id' => 'banque_id', 'type' => '', 'class' => 'form-control select2'
                            ));
                            ?>

                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('montant', ['label' => 'Solde']);
                            ?>
                        </div>
                    </div>
                    <br>


                    <div class="col-md-12">
                        <div class="box-header with-border">
                            <a class="btn btn-primary btn " table="addtable" id="ajouter_lignecompte" index="index" style="
             float: right;
             margin-bottom: 5px;
             ">
                                <i class="fa fa-plus-circle "></i> Ajouter ligne</a>

                        </div>
                    </div>

                    <div class="box-body" style="background-color: white ;">
                        <table id="idtable2" class="table table-bordered table-striped">


                            <thead>
                                <tr>
                                    <td align="center" style="width: 10%; font: size 20px;"><strong>Type Crédit</strong></td>




                                    <td align="center" style="width: 7%;"></td>
                                </tr>

                            </thead>
                            <tbody>

                                <tr class="tr" style="display: none !important">

                                    <td align="center" table="ligner">

                                        <?php
                                        echo $this->Form->control('typecredit_id', array('class' => ' form-control select2 ','options'=>$typecredits, 'label' => '', 'index' => '', 'champ' => 'typecredit_id', 'table' => 'ligner', 'name' => '', 'empty' => 'Veuillez choisir !!', 'id' => ''));
                                        ?>



                                        <input type="hidden" id="" champ="sup" name="" table="ligner" index="" class="form-control">
                                    </td>









                                    <td align="center">
                                        <i index class="fa fa-times supLigne2" style="color: #c9302c;font-size: 22px;"></i>
                                    </td>
                                </tr>

                            </tbody>


                        </table>
                        <input value="-1" id="index" type="hidden">

                        <br>
                        <button type="submit" class="pull-right btn btn-success" id="controlecompte" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
                        <?php echo $this->Form->end(); ?>
                    </div>

                    <!-- /.box-body -->


                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->
</section>


<script>
    function openWindow(h, w, url) {
        // alert('tre');
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }
</script>
<script>
    $(document).ready(function() {

        $('#ajouter_lignecompte').on('click', function() {
            // alert('click') ;
            index = Number($('#index').val());
            // alert(index);
            ajouter('idtable2', 'index');
        });

        $('.supLigne2').on('click', function() {

            index = $('#index').val();
            ind = $(this).attr('index');
            ///alert(ind);
            // alert(index);
            $('#sup' + ind).val('1');
            $(this).parent().parent().hide();


        });

        function ajouter(table, index) {


            ind = Number($('#' + index).val()) + 1;
            $ttr = $('#' + table).find('.tr').clone(true);
            $ttr.attr('class', '');
            i = 0;
            tabb = [];
            $ttr.find('input,select,textarea,tr,td,div,ul,li').each(function() {
                tab = $(this).attr('table'); //alert(tab)
                champ = $(this).attr('champ');
                $(this).attr('index', ind);
                $(this).attr('id', champ + ind); //alert(champ);
                if (champ == 'marchandisetype_id') {
                    //alert(champ)
                    $(this).attr('name', 'data[' + tab + '][' + ind + '][' + champ + '][]');
                    $(this).attr('data-bv-field', 'data[' + tab + '][' + ind + '][' + champ + ']');
                } else {
                    $(this).attr('name', 'data[' + tab + '][' + ind + '][' + champ + ']');
                    $(this).attr('data-bv-field', 'data[' + tab + '][' + ind + '][' + champ + ']');
                }
                $type = $(this).attr('type');
                if (champ !== 'tva' && champ !== 'fodec' && champ !== 'remise') {
                    $(this).val('');
                }
                // if (champ !== 'tva') {
                //     $(this).val('');
                // } else if (champ !== 'fodec') {
                //     $(this).val('');
                // } else if (champ !== 'remise') {
                //     $(this).val('');
                // }

                // $(this).val('');
                if ($type == 'radio') {
                    $(this).attr('name', 'data[' + champ + ']');
                    //$(this).attr('value',ind);
                    $(this).val(ind);
                }
                if ((champ == 'datedebut') || (champ == 'datefin')) {
                    $(this).attr('onblur', 'nbrjour(' + ind + ')')
                }
                $(this).removeClass('anc');
                if ($(this).is('select', 'multiple')) {
                    //alert(champ);
                    //alert(ind);
                    tabb[i] = champ + ind; //alert(tabb[i]);
                    i = Number(i) + 1;
                }
                // $(this).val('');
            })
            $ttr.find('i').each(function() {
                $(this).attr('index', ind);
            });
            $('#' + table).append($ttr);
            $('#' + index).val(ind);
            $('#' + table).find('tr:last').show();

            $("#compte_id" + ind).select2({
                width: '100%' // need to override the changed default
            });
            $("#article" + ind).select2({
                width: '100%' // need to override the changed default
            });
            $("#article_id" + ind).select2({
                width: '100%' // need to override the changed default
            });
            $("#banque_id" + ind).select2({
                width: '100%' // need to override the changed default
            });
            $("#typeexon_id" + ind).select2({
                width: '100%' // need to override the changed default
            });
            $("#gouvernorat_id" + ind).select2({
                width: '75%' // need to override the changed default
            });
            for (j = 0; j <= i; j++) {
                // alert(tabb[j]);
                //  $('marchandisetype_id1').attr('class','select2');
                //  uniform_select(tabb[j]); jareb
                //$('#'+tabb[j]).select2({ });
            }
            $("#article_id" + ind).select2({
                width: '75%' // need to override the changed default
            });
            $("#categorie_id" + ind).select2({
                width: '100%' // need to override the changed default
            });
            // $("#categorie_id" + ind).select2({
            //   width: '100%' // need to override the changed default
            // });
            // $("#quantite" + ind).select2({
            //   width: '100%' // need to override the changed default
            // });
            $("#unitescontenaire_id" + ind).select2({
                width: '100%' // need to override the changed default
            });

        }




        // $('.urlarticle').on('click', function() {
        // /// alert('dfgdfgdrg');
        // var index = $(this).attr('index');
        // var currentUrl = window.location.href;
        // var parentUrl = currentUrl.split('/').slice(0, -2).join('/');
        // var link = parentUrl + "/comptes/addcompte/" + index;
        // // alert(link);
        // window.open(link, "_blank", "width=1000,height=1000");
        // });
    });
</script>
<?php $this->end(); ?>
<?php echo $this->Html->script('alert'); ?>