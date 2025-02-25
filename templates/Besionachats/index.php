<?php

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Besionachat> $besionachats
 */
?>
<!-- Content Header (Page header) -->

<?php echo $this->Html->script('o'); ?>
<?php echo $this->fetch('script'); ?>
<?php echo $this->fetch('script'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php echo $this->Html->script('controle_frs'); ?>



<section class="content-header">
    <h1>
        <center> Besoin achat </center>
        <!--<div class="pull-right"><?php echo $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'btn btn-success btn-xs']) ?></div>
  </h1>-->
    </h1><br>
    <div class="pull-left">
        <?php echo $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
    </div>
</section>
<br>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <?php echo $this->Form->create($besionachats, ['type' => 'get']); ?>
                    <section class="content-header">
                        <h1>
                            Recherche
                        </h1>
                    </section>
                    <br>

                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('numero', ['label' => 'Numéro ', 'value' => $this->request->getQuery('numero')]); ?>
                    </div>

                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('date', ['label' => 'Date ','type'=>'date', 'value' => $this->request->getQuery('date')]); ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('personnel_id', ['label' => 'Personnel ', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 ', 'value' => $this->request->getQuery('personnel_id')]); ?>
                    </div>

                    <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
                        <button type="submit" class="btn btn-primary btn-sm">Chercher</button>
                        <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="background-color: white ;">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>

                            <th width="10%" align="center">
                                <?= __('Numéro') ?>
                            </th>
                            <th width="10%" align="center">
                                <?= __('Date') ?>
                            </th>
                            <th width="10%" align="center">
                                <?= __('Demandeur') ?>
                            </th>
                            <th  width="10%" align="center">
                                <?= __('Besoin achat') ?>
                            </th>
                            <th  width="10%" align="center">
                                <?= __(' Demande offre de prix ') ?>
                            </th>

                            <th  width="10%" align="center">
                                <?= __('Actions') ?>
                            </th>
                            
                        </tr>
                        <!-- <tr>
                            <th width="10%" align="center">
                                <?= __('Local') ?>
                            </th>
                            <th width="10%" align="center">
                                <?= __('Etranger') ?>
                            </th>

                        </tr> -->
                    </thead>
                    <?php $i = 0; ?>
                    <tbody>

                        <?php
                        foreach ($besionachats as $i => $besionachat) :

                        ?>

                            <tr>
                                <td hidden>
                                    <?= $this->Number->format($besionachat->id) ?>
                                </td>
                                <td>
                                    <?= h($besionachat->numero) ?>
                                </td>
                                <td><?php
                                    if (isset($besionachat->date)) {
                                        echo $this->Time->format(
                                            $besionachat->date,
                                            'dd/MM/y'
                                        );
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?= h($besionachat->personnel->nom) ?>
                                </td>
                                <td>
                                    <?= h($besionachat->remarque) ?>
                                </td>


                                <td align="center">
                                    <?php if ($besionachat->demandeoffredeprixe_id == 0) {
                                    ?>
                                        <input class="besach" type="checkbox" id="check<?php echo $i; ?>" value="<?php echo $besionachat['id'] ?>" name="checkbox[]" ligne="<?php echo $i; ?>" />
                                    <?php } ?>
                                </td>
                                <!-- <td align="center">
                                    <?php if ($besionachat->demandeoffredeprixe_id == 0) {
                                    ?>
                                        <input class="besach2" type="checkbox" id="checktype2<?php echo $i; ?>" value="<?php echo $besionachat['id'] ?>" name="checkbox[]" ligne="<?php echo $i; ?>" />
                                    <?php } ?>
                                </td> -->

                                <td class="actions text-left">
                                    <?= $this->Html->link(__(''), ['action' => 'view', $besionachat->id], ['class' => 'btn btn-xs btn-success  fa fa-search']) ?>
                                    <?php if ($besionachat->demandeoffredeprixe_id == 0) {
                                    ?>
                                    <?= $this->Html->link(__(''), ['action' => 'edit', $besionachat->id], ['class' => 'btn btn-warning btn-xs   fa fa-edit']) ?>
                                    <?= $this->Form->postLink(__(''), ['action' => 'delete', $besionachat->id], ['confirm' => __('Veuillez vraiment supprimer cette enregistrement ? # {0}?', $besionachat->id), 'class' => 'btn btn-danger btn-xs  fa fa-trash-o']) ?>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php ?>
                    </tbody>
                </table>
                <table>
                    <input type="hidden" value="<?php echo $i; ?>" id="index" />
                    <tr>
                        <td align="center">
                            <?php
                            ?>
                            <div class="col-md-12  testcheck" style="display:none;">

                                <input type="hidden" name="tes" value="0" class="tes" />
                                <input type="hidden" name="nombre" value="<?php echo @$i; ?>" class="nombre" />
                                <a class="btn btn btn-danger btnbl" id="demandeoffredeprixeadd"> <i class="fa fa-plus-circle"></i>
                                    Demande offre de prix (Locale)</a>
                            </div>

                            <div class="col-md-12  testcheck2" style="display:none;">

                                <input type="hidden" name="tes" value="0" class="tes2" />
                                <input type="hidden" name="nombre" value="<?php echo @$i; ?>" class="nombre2" />
                                <a class="btn btn btn-success btnbl" id="demandeoffredeprixeadd2"> <i class="fa fa-plus-circle"></i>
                                    Demande offre de prix (Etrangère)</a>
                            </div>
                            <?php
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
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

        $(".besach").on("click", function() {
            ligne = $(this).attr("ligne");
            index = $("#index").val();
            // alert(index);
            test = 0;
            for (i = 0; i <= Number(index); i++) {
                if ($("#check" + i).is(":checked")) {
                    test = test + 1;
                }
            }
            // if (test == 2) {
            //     alert("choisir un seul demande offre de prix", function () { });
            // }
            // if (test == 1) {
            $('.testcheck').show();
            fournisseur = $('#fournisseur_id' + ligne).val();
            article = $('#article_id').val();
            if ($('.tes').val() == 0) {
                $('.tes').val(fournisseur);
                $('.tes').val(article);
            }
            // }
            if (test == 0) {
                $('.tes').val(0);
                $('.testcheck').hide();
            }
        });


        $(".besach2").on("click", function() {
            ligne = $(this).attr("ligne");
            index = $("#index").val();
            // alert(index);
            test = 0;
            for (i = 0; i <= Number(index); i++) {
                if ($("#checktype2" + i).is(":checked")) {
                    test = test + 1;
                }
            }
            // if (test == 2) {
            //     alert("choisir un seul demande offre de prix", function () { });
            // }
            // if (test == 1) {
            $('.testcheck2').show();
            fournisseur = $('#fournisseur_id' + ligne).val();
            article = $('#article_id').val();
            if ($('.tes2').val() == 0) {
                $('.tes2').val(fournisseur);
                $('.tes2').val(article);
            }
            // }
            if (test == 0) {
                $('.tes2').val(0);
                $('.testcheck2').hide();
            }
        });
        $('#demandeoffredeprixeadd').on('click', function() {
            var tab = new Array;
            conteur = $('.nombre').val();
            for (var i = 0; i <= conteur; i++) {
                val = ($('#check' + i).attr('checked'));
                v = $('#check' + i).val();
                if ($('#check' + i).is(':checked')) {
                    tab[i] = v;
                }
            }
            var removeItem = undefined;
            tab = jQuery.grep(tab, function(value) {
                return value != removeItem;
            });
            client = $('.tes').val();

            window.open("/ERP/demandeoffredeprixes/adddemande/" + tab+"/1")
        });



        $('#demandeoffredeprixeadd2').on('click', function() {
            var tab = new Array;
            conteur = $('.nombre2').val();
            for (var i = 0; i <= conteur; i++) {
                val = ($('#checktype2' + i).attr('checked'));
                v = $('#checktype2' + i).val();
                if ($('#checktype2' + i).is(':checked')) {
                    tab[i] = v;
                }
            }
            var removeItem = undefined;
            tab = jQuery.grep(tab, function(value) {
                return value != removeItem;
            });
            client = $('.tes2').val();

            window.open("/ERP/demandeoffredeprixes/adddemande/" + tab+"/2")
        });

    });
</script>

<?php $this->end(); ?>