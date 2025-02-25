<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Besionachat $besionachat
 */
?>

<?php echo $this->Html->script('controle_frs'); ?>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('o'); ?>
<?php echo $this->fetch('script'); ?>
<!-- Content Header (Page header) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<section class="content-header">
    <section class="content-header">
        <h1>
            Consultation Besoin achat
            <small>
                <?php echo __(''); ?>
            </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i>
                    <?php echo __('Retour'); ?>
                </a></li>
        </ol>
    </section>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">


                <?php echo $this->Form->create($besionachat, ['role' => 'form']); ?>


                <div class="box-body">

                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('numero', ['label' => ' Numéro ', 'readonly' => 'readonly']);
                        ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('date', ['label' => ' Date ', 'readonly' => 'readonly']);
                        ?>
                    </div>
                    <div class="col-xs-6">
                        <?php echo $this->Form->control('personnel_id', ['label' => 'Demandeur', 'empty' => 'Veuillez choisir !!', 'options' => $personnels, 'class' => 'form-control select2 ', 'id' => 'personnel_id', 'required' => 'off', 'disabled' => true]); ?>
                    </div>

                    <div class="col-xs-6">
                        <?php echo $this->Form->control('echeance', ['readonly', 'label' => 'Echéance', 'empty' => true, 'id' => 'date', 'class' => "form-control"]);
                        ?>
                    </div>
                    <div class="col-xs-6" hidden>
                        <?php echo $this->Form->control('service_id', ['disabled'=>true,'label' => 'Service', 'empty' => 'Veuillez choisir !!', 'options' => $services, 'class' => 'form-control select2 ', 'id' => 'service_id', 'required' => 'off']); ?>
                    </div>
                    <div class="col-xs-6" hidden>
                        <?php echo $this->Form->control('machine_id', ['disabled'=>true,'label' => 'Machine', 'empty' => 'Veuillez choisir !!', 'options' => $machines, 'class' => 'form-control select2 ', 'id' => 'machine_id', 'required' => 'off']); ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('remarque', ['label' => 'Besoin d`achat', 'readonly' => 'readonly']);
                        ?>
                    </div>

                </div>

                <section class="content-header">
                    <h1 class="box-title"><?php echo __('Les articles'); ?></h1>
                </section>
                <section class="content" style="width: 99%">
                    <div class="row">
                        <div class="box">
                            <div class="box-header with-border">


                            </div>
                            <div class="panel-body">
                                <div class="table-responsive ls-table">
                                    <table class="table table-bordered table-striped table-bottomless" id="tabligne2">
                                        <thead>
                                            <tr width:20px>
                                                <td align="center" style="width: 20%;"><strong>Article</strong></td>
                                                <td align="center" style="width: 20%;"><strong>Quantité</strong>
                                                </td>



                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="tr" style="display: none !important">


                                                <td align="center">
                                                    <input type="hidden" name="sup2" id="" champ="sup2" table="lignes" index="" class="form-control">

                                                    <div id="" champ='f1' index="" name="" table="lignea" class="col-md-10">
                                                        <select champ="article_id" class="form-control " table="lignes">
                                                            <option value="">Veuillez choisir !!</option>
                                                            <?php
                                                            foreach ($articles as $article) : ?>
                                                                <option value="<?= h($article->id) ?>">
                                                                    <?php echo $article->Code . ' ' . $article->Dsignation ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>

                                                    </div>
                                                    <span title="ajout article" index=""> <a href="javascript:;" index="" class="btn btn-primary b2"><i id="" index="" name="" champ="btnajo" table="lignea" class='fa fa fa-plus'></i></a></span>


                                                    <div id="" champ='f2' index="" name="" table="lignea" style="display: none !important" class="col-md-10">
                                                        <input table="lignea" type='text' id='id' name='' champ='article_id' class='form-control ' class='input' empty='Veuillez choisir !!'>
                                                    </div>

                                                </td>
                                                <td align=" center" table="lignes">

                                                    <input table="lignea" name="" index="" name="qte" champ="qte" id="qte" type="text" class="form-control ">
                                                </td>

                                            </tr>
                                            <?php
                                            $i = -1;

                                            foreach ($lignebesionachats as $i => $article) :
                                            ?>
                                                <tr>
                                                    <td style="width: 8%;" align="center">
                                                        <?php echo $this->Form->input('sup2', array('name' => 'data[lignea][' . $i . '][sup2]', 'id' => 'sup2' . $i, 'champ' => 'sup2', 'table' => 'lignea', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                        ?>
                                                        <?php echo $this->Form->input('id', array('label' => false, 'value' => $article->id, 'name' => 'data[lignea][' . $i . '][id]', 'type' => 'hidden', 'id' => '' . $i, 'table' => 'lignea', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>

                                                        <?php echo $this->Form->control('article_id', array('label' => False, 'options' => $art, 'value' => $article->article_id, 'name' => 'data[lignea][' . $i . '][article_id]', 'id' => 'article_id' . $i, 'table' => 'lignea', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control select2', 'disabled' => true)); ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('qte', array('label' => false, 'value' => $article->qte, 'name' => 'data[lignea][' . $i . '][qte]', 'type' => 'text', 'id' => 'qte' . $i, 'table' => 'lignea', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control', 'readonly' => 'readonly')); ?>
                                                        <?php echo $this->Form->input('besionachat_id', array('value' => $article->besionachat_id, 'champ' => 'besionachat_id', 'label' => '', 'name' => 'data[lignea][' . $i . '][besionachat_id]', 'type' => 'hidden', 'id' => 'id' . $i, 'table' => 'lignea', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                    </td>

                                                </tr>
                                            <?php endforeach; ?>

                                        </tbody>
                                    </table><br />
                                    <input type="hidden" value="<?php echo $i ?>" id="index2">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
            <?php echo $this->Form->end() ?>
        </div>
    </div>
    </div>
</section>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>

<?php $this->start('scriptBottom'); ?>

<script>
    $('.select2').select2();
</script>


<script>
    $(document).ready(function() {

        var clickCounter2 = 0;
        $(".b2").on("click", function() {
            clickCounter2++;
            index = $("#index0").val();
            ind = $(this).attr("index");
            t2 = clickCounter2 % 2;
            console.log(t2);
            if (t2 == 1) {


                $("#f1" + ind).attr("style", "display:none;");
                $("#f2" + ind).attr("style", "display:true;");
            } else if (t2 == 0) {


                $("#f1" + ind).attr("style", "display:true;");
                $("#f2" + ind).attr("style", "display:none;");
            }
        });
        $('#ajouter_ligne2').on('click', function() {

            index = Number($('#index2').val());
            coffre = $('#article_id' + index).val();
            ajouter('tabligne2', 'index2');

        });

        $('.supLignemelek').on('click', function() {
            index = $('#index2').val();
            ind = $(this).attr('index');
            $('#sup2' + ind).val('1');
            $(this).parent().parent().hide();

        });


        function ajouter(table, index) {

            ind = Number($('#' + index).val()) + 1;
            $ttr = $('#' + table).find('.tr').clone(true);
            $ttr.attr('class', '');
            i = 0;
            tabb = [];
            $ttr.find('input,select,textarea,tr,td,div,ul,li,span,a,i').each(function() {
                tab = $(this).attr('table');
                champ = $(this).attr('champ');
                $(this).attr('index', ind);
                $(this).attr('id', champ + ind);
                if (champ == 'marchandisetype_id') {

                    $(this).attr('name', 'data[' + tab + '][' + ind + '][' + champ + '][]');
                    $(this).attr('data-bv-field', 'data[' + tab + '][' + ind + '][' + champ + ']');
                } else {
                    $(this).attr('name', 'data[' + tab + '][' + ind + '][' + champ + ']');
                    $(this).attr('data-bv-field', 'data[' + tab + '][' + ind + '][' + champ + ']');
                }
                $type = $(this).attr('type');
                $(this).val('');
                if ($type == 'radio') {
                    $(this).attr('name', 'data[' + champ + ']');

                    $(this).val(ind);
                }
                if ((champ == 'datedebut') || (champ == 'datefin')) {
                    $(this).attr('onblur', 'nbrjour(' + ind + ')')
                }
                $(this).removeClass('anc');
                if ($(this).is('select', 'multiple')) {

                    tabb[i] = champ + ind;
                    i = Number(i) + 1;
                }

            })
            $ttr.find('i').each(function() {
                $(this).attr('index', ind);
            });
            $('#' + table).append($ttr);
            $('#' + index).val(ind);

            $('#' + table).find('tr:last').show();
            $("#article_id" + ind).select2({
                width: '100%'
            });
            $("#article" + ind).select2({
                width: '100%'
            });
            $("#article_id" + ind).select2({
                width: '100%'
            });
            $("#banque_id" + ind).select2({
                width: '100%'
            });
            $("#typeexon_id" + ind).select2({
                width: '100%'
            });



            for (j = 0; j <= i; j++) {

            }
        }

    });
</script>
<?php $this->end(); ?>