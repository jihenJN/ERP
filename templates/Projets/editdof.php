<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Demandeoffredeprix $demandeoffredeprix
 */
//dd($demandeoffredeprix['typeoffredeprix']);
error_reporting(E_ERROR | E_PARSE);
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('controle_frs'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Demandeoffredeprix
        <small><?php echo __(''); ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'vieww', $project_id]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">

        <div class="box-body">
            <div class="row">
                <?php
                //dd($demandeoffredeprix);
                ?>
                <?php echo $this->Form->create($demandeoffredeprix, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13",]); ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('date', ["readonly" => true, 'label' => 'Date', 'empty' => true, 'id' => 'date', 'class' => "form-control pull-right"]); ?>
                            <?php echo $this->Form->control('id', ["readonly" => true, 'label' => 'id', 'empty' => true, 'id' => 'id', 'type' => 'hidden', 'class' => "form-control pull-right"]); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('numero', ['readonly' => 'readonly']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('projet_id', ['champ' => 'projet_id', 'style' => "pointer-events: none;",  'readonly', 'options' => $projets, 'value' => $demandeoffredeprix->projet_id, 'empty' => 'Veuillez choisir un projet !!!']); ?>
                        </div>
                    </div>
                    <!-- /.box-body -->




                    <section class="content-header">
                        <h1 class="box-title"><?php echo __('Les articles'); ?></h1>
                    </section>

                    <section class="content" style="width: 99%">
                        <div class="row">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <a class="btn btn-primary al" table='addtable' index='index0' id='ajouter_ligne_article' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                                        <i class="fa fa-plus-circle "></i> Ajouter article</a>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive ls-table">
                                        <?php //if (!empty($demandeoffredeprix->lignedemandeoffredeprixes)): 
                                        ?>
                                        <table class="table table-bordered table-striped table-bottomless" id="tabligne0">
                                            <thead>
                                                <tr width:20px">
                                                    <!--                                                  <td align="center" style="width: 5%;" type="hidden" ><strong></strong></td>-->
                                                    <td align="center" style="width: 40%;"><strong>Nom du article</strong></td>
                                                    <td align="center" style="width: 20%;"></td>

                                                    <td align="center" style="width: 40%;"><strong>Quantité</strong></td>
                                                    <td align="center" style="width: 20%;"></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($ligneas as $i => $ligneas) :
                                                ?>
                                                    <tr style="">
                                                        <!-- <td align="center" style="width:111px; opacity: 1; position: relative; left: 0px;">
                                                            <div id=""  champ='' >
                                                                <?php
                                                                //if (!empty($ligneas['article_id']) ) {
                                                                ?>
                                                                    <div id="ar1<?php echo $i ?>" index="<?php echo $i ?>" champ='ar1' style="display:true"  >
                                                                        <?php
                                                                        echo $this->Form->input('article_id', array('label' => '', 'value' => $ligneas->article_id, 'name' => 'data[lignea][' . $i . '][article_id]', 'id' => 'article_id' . $i, 'champ' => 'article_id' . $i, 'table' => 'lignea', 'index' => $i, 'class' => 'form-control select2 '));
                                                                        ?>
                                                                    </div>                                                                       
                                                                    <?php
                                                                    //} else {
                                                                    //echo $this->Form->control('designiationA', array('label' => '', 'value' => $ligneas->designiationA, 'champ' => 'designiationA'.$i, 'name' => 'data[lignea][' . $i . '][designiationA]', 'id' => 'designiationA' . $i, 'table' => 'lignea', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                    // }
                                                                    ?>
                                                            <?php // endforeach;  
                                                            ?>
                                                        </td>    -->
                                                        <td align="center">
                                                            <?php echo $this->Form->input('sup0', array('name' => 'data[lignea][' . $i . '][sup0]', 'id' => 'sup0' . $i, 'champ' => 'sup0' . $i, 'table' => 'lignea', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                            ?>
                                                            <?php echo $this->Form->input('id', array('value' => $ligneas->id, 'name' => 'data[lignea][' . $i . '][id]', 'id' => 'id' . $i, 'champ' => 'id' . $i, 'table' => 'lignea', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                            ?>
                                                            <?php echo $this->Form->input('article_id', array('label' => '', 'value' => $ligneas->article_id, 'name' => 'data[lignea][' . $i . '][article_id]', 'empty' => 'Veuillez choisissez !!!', 'id' => 'article_id' . $i, 'table' => 'lignea', 'champ' => 'article_id' . $i, 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control select2')); ?>
                                                        </td>
                                                        <td align="center">
                                                            <div style="position: static; margin-top: 30px;">
                                                                <a><i class="fa fa fa-plus urlarticle" style="color: success; font-size: 20px;"></i></a>
                                                            </div>
                                                        </td>
                                                        <td align="center">
                                                            <?php echo $this->Form->input('qte', array('label' => '', 'value' => $ligneas->qte, 'name' => 'data[lignea][' . $i . '][qte]', 'type' => 'text', 'id' => 'qte' . $i, 'table' => 'lignea', 'champ' => 'qte' . $i, 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control enr80')); ?>
                                                        </td>
                                                        <td align="center">
                                                            <i index="<?php echo $i ?>" id="<?php echo $i ?>" class="fa fa-times supLigneart " style="color: #c9302c;font-size: 22px; margin-top: 30px;"></i>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                <tr class='tr' style="display: none !important">
                                                    <td align="center">
                                                        <div id="">
                                                            <?php echo $this->Form->input('sup0', array('name' => '', 'id' => '', 'champ' => 'sup0', 'table' => 'lignea', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                                                            <?php echo $this->Form->input('article_id', array('label' => '', 'options' => $articles, 'name' => '', 'id' => '', 'champ' => 'article_id', 'table' => 'lignea', 'empty' => 'Veuillez choisir !!', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'empty' => 'Veuillez Choisir !!')); ?>
                                                            <?php echo $this->Form->input('designiationA', array('type' => 'hidden', 'label' => '', 'name' => '', 'id' => 'designiationA', 'champ' => 'designiationA', 'table' => 'lignea', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'empty' => 'Veuillez Choisir !!')); ?>
                                                            <?php echo $this->Form->input('article_idd', array('label' => '', 'value' => '', 'name' => '', 'id' => '', 'champ' => 'article_idd', 'table' => 'lignea', 'index' => '', 'type' => 'hidden', 'class' => 'form-control select2 ')); ?>
                                                        </div>
                                                        <!-- <div id=""  champ='ar2' style="display: none !important" class="col-md-10">
                                                            <input table="lignea" type='text'  id=""  champ='designiationA'  class='form-control' class='input'>
                                                        </div>                   -->
                                                        <!-- <span title="ajout article"> <a index="" href="javascript:;" class="btn btn-primary b1" champ="b" id=""><i class='fa fa fa-plus'></i></a></span> -->
                                                    </td>
                                                    <td align="center">
                                                        <div style="position: static; margin-top: 6px;">
                                                            <a><i class="fa fa fa-plus urlarticle" style="color: success; font-size: 20px; margin-top: 30px;"></i></a>
                                                        </div>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $this->Form->control('qte', ['label' => '', 'name' => '', 'champ' => 'qte', 'table' => 'lignea', 'id' => 'qte', 'class' => 'form-control  enr80']); ?>
                                                    </td>




                                                    <td align="center"><i index="" id="" class="fa fa-times supLigneart" style="color: #C9302C;font-size: 22px; margin-top: 30px;"></td>
                                                </tr>
                                                <input type="hidden" value="<?php echo $i ?>" id="index0">
                                            </tbody>
                                        </table>
                                        <?php ?>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="content-header">
                        <h1 class="box-title"><?php echo __('Fournisseurs'); ?></h1>
                    </section>
                    <section class="content" style="width: 99%">
                        <div class="row">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <a class="btn btn-primary al" table='addtable' index='index1' id='ajouter_ligne11' style="
                                       float:right;
                                       margin-bottom: 5px;
                                       ">
                                        <i class="fa fa-plus-circle "></i> Ajouter fournisseur</a>

                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive ls-table">
                                        <table class="table table-bordered table-striped table-bottomless" id="tabligne11">
                                            <thead>
                                                <tr width:20px">
                                                    <td align="center" style="width: 50%;"><strong>Nom du fournisseur</strong></td>
                                                    <td align="center" style="width: 10%;"></td>

                                                    <td align="center" style="width: 400%;"><strong>Mail</strong></td>

                                                    <td align="center" style="width: 10%;"></td>
                                                </tr>
                                            </thead>
                                            <?php
                                            foreach ($lignefs as $j => $lignefs) :
                                                //     debug($lignefs);
                                            ?>
                                                <tbody>
                                                    <tr class="" style="">
                                                        <td align="center" style="width:111px; opacity: 1; position: relative; left: 0px;">
                                                            <?php echo $this->Form->input('sup1', array('name' => 'data[lignef][' . $j . '][sup1]', 'id' => 'sup1' . $j, 'champ' => 'sup1' . $j, 'table' => 'lignef', 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                                                            <?php echo $this->Form->input('id', array('value' => $lignefs->id, 'name' => 'data[lignef][' . $j . '][id]', 'id' => '', 'champ' => 'id' . $j, 'table' => 'lignef', 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => ' getmailfrns form-control')); ?>
                                                            <?php
                                                            if (!empty($lignefs['fournisseur_id'])) {
                                                            ?>
                                                                <div id="f1<?php echo $j ?>" index="<?php echo $j ?>" champ='f1' style="display:true">
                                                                    <?php echo $this->Form->control('fournisseur_id', array('label' => '', 'options' => $fournisseurs, 'value' => $lignefs->fournisseur_id, 'champ' => 'fournisseur_id' . $j, 'name' => 'data[lignef][' . $j . '][fournisseur_id]',   'id' => 'fournisseur_id' . $j, 'table' => 'lignef', 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'getmailfrns form-control')); ?>
                                                                </div>

                                                            <?php
                                                            } else {
                                                                echo $this->Form->control('nameF', array('champ' => 'nameF' . $j, 'type' => 'text', 'label' => '', 'value' => $lignefs->nameF, 'name' => 'data[lignef][' . $j . '][nameF]', 'id' => 'nameF' . $j, 'table' => 'lignef', 'index' => $j, 'class' => 'form-control select2 '));
                                                            }
                                                            ?>
                                                        </td>
                                                        <td align="center">
                                                            <div style="position: static; margin-top: 30px;">
                                                                <a><i class="fa fa fa-plus urlfournisseur" style="color: success; font-size: 20px;"></i></a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <?php echo $this->Form->control('mail', ['label' => '', 'value' => h($lignefs->mail),  'id' => 'mail' . $j,  'index' => $j, 'name' => 'data[lignef][' . $j . '][mail]', 'champ' => 'mail', 'table' => 'lignef']); ?>
                                                        </td>
                                                        <td align="center">
                                                            <i index="<?php echo $j ?>" id="" class="fa fa-times supLigneFournisseur " style="color: #c9302c;font-size: 22px; margin-top: 30px;"></i>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                <tr class="tr" style="display: none">
                                                    <td align="center" style="width:111px; opacity: 1; position: relative; left: 0px;">
                                                        <?php echo $this->Form->input('sup1', array('name' => '', 'id' => '', 'champ' => 'sup1', 'table' => 'lignef', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                                                        <div id="" index="" champ='f1'>
                                                            <?php echo $this->Form->input('nameF', array('name' => '', 'id' => '', 'champ' => 'nameF', 'table' => 'lignef', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                                                            <?php echo $this->Form->input('fournisseur_id', array('label' => '', 'options' => $fournisseurs, 'class' => 'form-control getmailfrns', 'name' => '', 'id' => '', 'champ' => 'fournisseur_id', 'table' => 'lignef', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'empty' => 'Veuillez Choisir !!')); ?>
                                                        </div>
                                                        <div id='' index='' name='' table='tablef2' champ='f2' style="display: none" class="col-md-10">
                                                            <?php echo $this->Form->input('nameF', array('label' => '', 'champ' => 'nameF', 'id' => '', 'name' => '', 'index' => '', 'table' => 'lignef', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'text', 'class' => 'form-control')); ?>
                                                        </div>
                                                        <!-- <span title="ajout fournisseur"> <a href="javascript:;" class="btn btn-primary ajofournisseur"><i class='fa fa fa-plus'></i></a></span> -->
                                                    </td>

                                                    <td align="center">
                                                        <div style="position: static; margin-top: 6px;">
                                                            <a><i class="fa fa fa-plus urlfournisseur" style="color: success; font-size: 20px; margin-top: 30px;"></i></a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?php echo $this->Form->input('a', array('label' => '', 'name' => '', 'class' => 'form-control', 'champ' => 'mail', 'table' => 'lignef', 'div' => 'form-group', 'between' => '<div class="col-sm-12 " >', 'after' => '</div>')); ?>
                                                    </td>


                                                    <td align="center">
                                                        <i index="" id="" class="fa fa-times supLigneFournisseur" style="color: #c9302c;font-size: 22px; margin-top: 30px;"></i>
                                                    </td>
                                                    <input type="hidden" value="<?php echo $j ?>" id="index1">
                                                </tbody>
                                        </table><br>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </section>

                    <div align="center" id="enreg">
                        <?php echo $this->Form->submit(__('Enregistrer')); ?>
                    </div>

                    <?php echo $this->Form->end(); ?>
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->
</section>
<script>
    $(document).ready(function() {
        $('.urlarticle').on('click', function() {
            var index = $(this).attr('index');
            var currentUrl = window.location.href;
            var parentUrl = currentUrl.split('/').slice(0, -3).join('/');
            var link = parentUrl + "/demandeoffredeprixes/addarticle/" + index;
            // alert(link);
            window.open(link, "_blank", "width=1000,height=1000");
        });
        $('.urlfournisseur').on('click', function() {
            var index = $(this).attr('index');
            var currentUrl = window.location.href;
            var parentUrl = currentUrl.split('/').slice(0, -3).join('/');
            var link = parentUrl + "/demandeoffredeprixes/addfournisseur/" + index;
            // alert(link);
            window.open(link, "_blank", "width=1000,height=1000");
        });
        $(".getmailfrns").on("change", function() {
            //alert("dhouha");
            ind = $(this).attr("index");
            index = $("#index1").val(); //alert(index)
            fournisseur_id = $("#fournisseur_id" + ind).val();
            // alert(fournisseur_id);
            if (fournisseur_id != "") {
                $.ajax({
                    method: "GET",
                    url: "<?= $this->Url->build(['controller' => 'Demandeoffredeprixes', 'action' => 'getmail']) ?>",
                    dataType: "json",
                    data: {
                        fournisseur_id: fournisseur_id,
                    },
                    headers: {
                        "X-CSRF-Token": $('meta[name="csrfToken"]').attr("content"),
                    },
                    success: function(data) {
                        // alert(data.mail);
                        $('#mail' + ind).val(data.mail);
                        // $('#gouvernorat').select2();
                        // // uniform_select('sousfamille1_id');
                    },
                });
            } else {
                $('#mail' + ind).val("");
            }
        });

        $("#ajouter_ligne11").on("click", function() {
            index = Number($("#index1").val()); //alert(index);
            coffre = $("#fournisseur" + index).val();
            if (coffre == "") {
                alert("Veuillez remplir la ligne  " + "" + (index + 1));
                // bootbox.alert('Veuillez remplir la premiere ligne', function () {});
            } else {
                ajouter("tabligne11", "index1");
            }
        });
        var clickCounter2 = 0;
        $(".ajofournisseur").on("click", function() {
            clickCounter2++;
            index = $("#index1").val();
            ind = $(this).attr("index");
            t2 = clickCounter2 % 2;
            console.log(t2);
            if (t2 == 1) {
                $("#mail" + ind).val("");
                $("#f1" + ind).val(0);
                $("#inputfour" + ind).val("");
                $("#f1" + ind).attr("style", "display:none;");
                $("#inputfour" + ind).attr("style", "display:true;");
            } else if (t2 == 0) {
                $("#mail" + ind).val("");
                $("#f1" + ind).val("");
                $("#inputfour" + ind).val("");
                $("#f1" + ind).attr("style", "display:true;");
                $("#inputfour" + ind).attr("style", "display:none;");
            }
        });
    });

    function ajouter(table, index) {
        //  alert("hh");
        //  alert(index);
        ind = Number($("#" + index).val()) + 1;
        $ttr = $("#" + table)
            .find(".tr")
            .clone(true);
        $ttr.attr("class", "");
        i = 0;
        tabb = [];
        $ttr.find("div,input,select,textarea,tr,td,ul,li,a").each(function() {
            tab = $(this).attr("table"); // alert(tab);
            champ = $(this).attr("champ");
            $(this).attr("index", ind);
            $(this).attr("id", champ + ind); //alert(champ);
            if (champ == "marchandisetype_id") {
                //alert(champ)
                $(this).attr("name", "data[" + tab + "][" + ind + "][" + champ + "][]");
                $(this).attr(
                    "data-bv-field",
                    "data[" + tab + "][" + ind + "][" + champ + "]"
                );
            } else {
                $(this).attr("name", "data[" + tab + "][" + ind + "][" + champ + "]");
                $(this).attr(
                    "data-bv-field",
                    "data[" + tab + "][" + ind + "][" + champ + "]"
                );
            }
            $type = $(this).attr("type");
            $(this).val("");
            if ($type == "radio") {
                $(this).attr("name", "data[" + champ + "]");
                //$(this).attr('value',ind);
                $(this).val(ind);
            }
            if (champ == "datedebut" || champ == "datefin") {
                $(this).attr("onblur", "nbrjour(" + ind + ")");
            }
            $(this).removeClass("anc");
            if ($(this).is("select", "multiple")) {
                //alert(champ);
                //alert(ind);
                tabb[i] = champ + ind; //alert(tabb[i]);
                i = Number(i) + 1;
            }
            // $(this).val('');
        });
        $ttr.find("i").each(function() {
            $(this).attr("index", ind);
        });
        $("#" + table).append($ttr);
        $("#" + index).val(ind);

        $("#" + table)
            .find("tr:last")
            .show();
        $("#article_id" + ind).select2({
            width: "100%", // need to override the changed default
        });
        $("#article" + ind).select2({
            width: "100%", // need to override the changed default
        });
        $("#article_id" + ind).select2({
            width: "100%", // need to override the changed default
        });
        $("#banque_id" + ind).select2({
            width: "100%", // need to override the changed default
        });
        $("#typeexon_id" + ind).select2({
            width: "100%", // need to override the changed default
        });

        for (j = 0; j <= i; j++) {
            // alert(tabb[j]);
            //  $('marchandisetype_id1').attr('class','select2');
            //  uniform_select(tabb[j]); jareb
            //$('#'+tabb[j]).select2({ });
        }
    }
</script>