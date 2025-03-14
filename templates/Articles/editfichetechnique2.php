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


<?php //echo $this->Html->script('ajouterarticlematrice'); 
?>


<?php echo $this->fetch('script'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Fiche article 2
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i>
                <?php echo __('Retour'); ?>
            </a></li>
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



                <div class="box-body">

                    <?php if ($article['dateft2']) {
                        # code...
                        ?>
                        <div align="center">
                            <h4 style="   color: crimson;"> Cette fiche technique a été modifiée à la date
                                <?php echo $article['dateft2']->format("Y-m-d H:i:s") ?> depuis la fiche technique de
                                l'article <?php echo $article['Dsignation'] ?>
                            </h4>
                        </div>
                        <br>
                    <?php } ?>
                    <div class="row">
                        <div class="col-xs-6 ">
                            <?php echo $this->Form->control('commentaire2', ['class' => 'form-control  control-label', 'type' => "textarea", 'label' => 'Commentaire']); ?>

                        </div>
                    </div>

                    <br><br>

                    <div class=" tab-content" id="fichart" style="display: ">
                        <div align="center" class="row " style="display:none;" id="showhide00">
                            <strong style="font-size: 20px ;"> Fiche technique</strong>
                            <i class="fa fa-eye-slash HideShow00  text-blue"></i>

                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <?php echo __('Fiche Article'); ?>
                                </h3>
                                <a class="btn btn-primary ajouterlignematriceee " table='addtablea' index='index'
                                    tr="tra" style="
                                   float: right; 
                                   position: relative;
                                   top: -25px;
                                   "><i class="fa fa-plus-circle"></i></a>
                            </div>
                            <div class="panel-body">
                                <table class="table table-bordered table-striped table-bottomless" id="addtablea"
                                    style="width:100%" align="center">
                                    <thead>
                                        <tr bgcolor="#EDEDED">
                                            <td width="" align="center">Composant1</td>
                                            <td width="" align="center">Qte1</td>
                                            <td width="" align="center">Unite</td>
                                            <td width="" align="center" id='tdcomp' hidden>Coefficient</td>
                                            <td width="" align="center"></td>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr champ="tra" class="tra" style="display:none;">
                                            <td align="left">
                                                <?php echo $this->Form->input('sup', array('name' => '', 'id' => '', 'champ' => 'sup', 'table' => 'Ofsfligne', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                                                <div style="margin-top:10px">
                                                    <?php echo $this->Form->input('article_id', array('empty' => 'Veuillez choisir', 'label' => '', 'id' => 'article_id', 'name' => '', 'table' => 'Ofsfligne', 'champ' => 'article_id', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => '')); ?>
                                                </div>
                                            </td>

                                            <td align="center">
                                                <?php
                                                echo $this->Form->input('qte', array('id' => 'qte', 'label' => '', 'name' => '', 'table' => 'Ofsfligne', 'champ' => 'qte', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control comp'));
                                                echo $this->Form->input('qt', array('type' => 'hidden', 'id' => 'qt', 'label' => '', 'name' => '', 'table' => 'Ofsfligne', 'champ' => 'qt', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control comp'));
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $this->Form->input('unite_id', array('empty' => 'Veuillez choisir', 'label' => '', 'id' => 'unite_id', 'name' => '', 'table' => 'Ofsfligne', 'champ' => 'unite_id', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>

                                            </td>
                                            <td hidden champ='tdcomp' index='' table='Ofsfligne'>
                                                <?php echo $this->Form->input('coeff', array('label' => '', 'id' => '', 'name' => '', 'table' => 'Ofsfligne', 'champ' => 'coeff', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>

                                            </td>
                                            <td align="center">
                                                <i index="" class="fa fa-times supor"
                                                    style="color: #c9302c;font-size: 22px;">
                                            </td>
                                        </tr>
                                        <tr class="traa" champ='traa' style="display:none">
                                            <td width='30%'></td>
                                            <td champ="afef" class="afef" colspan="3" id="" index="">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title">
                                                            <?php echo __('Composant2'); ?>
                                                        </h3>
                                                        <a class="btn btn-primary ajouterligne1 " tabletype='addtableaa'
                                                            indexlignetype='indexa' trtype="traaa" style="
                                                           float: right; 
                                                           position: relative;
                                                           top: -25px;
                                                           "><i class="fa fa-plus-circle"></i> </a>
                                                    </div>
                                                    <div class="panel-body">
                                                        <table
                                                            class="table table-bordered table-striped table-bottomless"
                                                            index="" indexligne='indexa' champ="addtableaa" id=""
                                                            style="width:100%" align="center">
                                                            <thead>
                                                                <tr bgcolor="#EDEDED">
                                                                    <td align="center">Composant</td>
                                                                    <td align="center">Qte</td>
                                                                    <td align="center">Unite</td>
                                                                    <td align="center" id='tdcompp' hidden>Coefficient
                                                                    </td>

                                                                    <td align="center"></td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr class="traaa" style="display:none;" id="traaa"
                                                                    champ='traaa' index="">
                                                                    <td>
                                                                        <?php echo $this->Form->input('supp2', array('name' => '', 'type' => 'hidden', 'label' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'supp2', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                                        <div style="margin-top:5px">
                                                                            <?php echo $this->Form->input('article_id', array('name' => '', 'label' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'article_idt', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => '', 'empty' => 'Veuillez Choisir !!', "style" => "width:100% ; height:32px"));
                                                                            ?>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $this->Form->input('qte', array('name' => '', 'label' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'qte', 'id' => 'qte', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $this->Form->input('unite_id', array('name' => '', 'label' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'unite_idt', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => '', 'empty' => 'Veuillez Choisir !!', 'class' => 'form-control'));
                                                                        ?>
                                                                    </td>
                                                                    <td hidden champ='tdcompp' index='' indexligne=''
                                                                        table='Ofsfligne' tableligne='Phaseofsf'>
                                                                        <?php echo $this->Form->input('coeff', array('name' => '', 'label' => '', 'indexligne' => '0', 'index' => '0', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'coeff', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => '', 'class' => 'form-control'));
                                                                        ?>
                                                                    </td>
                                                                    <td align="center">
                                                                        <i indexligne="" index=""
                                                                            class="fa fa-times supor2"
                                                                            style="color: #c9302c;font-size: 22px;">
                                                                    </td>
                                                                </tr>
                                                                <tr class="traaligne" index="" champ='traaligne'
                                                                    style="display:none">
                                                                    <td width='30%'></td>
                                                                    <td champ="afefligne" class="afefligne" colspan="3"
                                                                        id="" index="">
                                                                        <div class="panel panel-default">
                                                                            <div class="panel-heading">
                                                                                <h3 class="panel-title">
                                                                                    <?php echo __('Composant3'); ?>
                                                                                </h3>
                                                                                <a class="btn btn-primary ajouterligne1ligne "
                                                                                    index="" indexligne=""
                                                                                    tabletypeligne='addtableaaligne'
                                                                                    indexligneligne='indexaligne'
                                                                                    indexlignetypeligne='indexaligne'
                                                                                    trtypeligne="traaaligne" style="
                                                                                   float: right; 
                                                                                   position: relative;
                                                                                   top: -25px;
                                                                                   "><i
                                                                                        class="fa fa-plus-circle"></i></a>
                                                                            </div>
                                                                            <div class="panel-body">
                                                                                <table
                                                                                    class="table table-bordered table-striped table-bottomless"
                                                                                    index="" indexligne=""
                                                                                    indexligneligne='indexaligne'
                                                                                    champ="addtableaaligne" id=""
                                                                                    style="width:100%" align="center">
                                                                                    <thead>

                                                                                        <tr bgcolor="#EDEDED">
                                                                                            <td width="30%"
                                                                                                align="center">
                                                                                                Composant</td>
                                                                                            <td width="30%"
                                                                                                align="center">
                                                                                                Qte</td>
                                                                                            <td width="30%"
                                                                                                align="center">
                                                                                                Unite</td>
                                                                                            <td width="10%"
                                                                                                align="center"
                                                                                                id='tdcomppp' hidden>
                                                                                                Coefficient</td>

                                                                                            <td width="10%"
                                                                                                align="center">
                                                                                            </td>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr class="traaaligne"
                                                                                            style="display:none;" id=""
                                                                                            champ='traaaligne' index="">
                                                                                            <td>
                                                                                                <?php
                                                                                                echo $this->Form->input('supp3', array('name' => '', 'type' => 'hidden', 'label' => '', 'indexligneligne' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'supp3', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control', ));
                                                                                                echo $this->Form->input('article_id', array('name' => '', 'label' => '', 'indexligneligne' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'article_idd', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => '', 'empty' => 'Veuillez Choisir !!', "style" => "width:100% ; height:32px"));
                                                                                                ?>
                                                                                            </td>
                                                                                            <td>
                                                                                                <?php echo $this->Form->input('qte', array('name' => '', 'label' => '', 'indexligneligne' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'qte', 'id' => 'qte', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                                                ?>
                                                                                            </td>

                                                                                            <td>
                                                                                                <?php echo $this->Form->input('unite_id', array('name' => '', 'label' => '', 'indexligneligne' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'unite_idd', 'id' => 'unite_idd', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control', 'empty' => 'Veuillez Choisir !!'));
                                                                                                ?>
                                                                                            </td>
                                                                                            <td hidden champ='tdcomp2'
                                                                                                index='' indexligne=''
                                                                                                indexligneligne=''
                                                                                                table='Ofsfligne'
                                                                                                tableligne='Phaseofsf'
                                                                                                tableligneligne='Phaseofsfligne'>
                                                                                                <?php echo $this->Form->input('coeff', array('value' => '1', 'name' => '', 'label' => '', 'indexligneligne' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'coeff', 'id' => 'coeff', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                                                ?>
                                                                                            </td>
                                                                                            <td align="center">
                                                                                                <i indexligneligne=""
                                                                                                    indexligne=""
                                                                                                    index=""
                                                                                                    class="fa fa-times supor3"
                                                                                                    style="color: #c9302c;font-size: 22px;">
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                                <input type="hidden" value="0" class=""
                                                                                    id="" champ="indexaligne" />
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <input type="hidden" value="-1" class="" id="" champ="indexa" />
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <?php
                                        //    debug($dat)
                                        //    echo 
                                        $i = -1;
                                        foreach ($dat1 as $fech) {
                                            $i++;
                                            //debug($fech);
                                            ?>
                                            <tr>

                                                <td align="left">
                                                    <?php
                                                    echo $this->Form->input('sup', array('name' => 'data[Ofsfligne][' . $i . '][sup]', 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'Ofsfligne', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'type' => 'hidden', 'after' => '</div>', 'class' => 'form-control'));
                                                    echo $this->Form->input('article_id', array('value' => $fech['article_id'], 'style' => 'width:250px', 'label' => '', 'id' => 'article_id' . $i, 'label' => '', 'name' => 'data[Ofsfligne][' . $i . '][article_id]', 'table' => 'Ofsfligne', 'champ' => 'article_id', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  select2', 'empty' => 'Veuillez choisir'));
                                                    ?>
                                                </td>
                                                <td align="center">
                                                    <?php
                                                    echo $this->Form->input('qte', array('value' => $fech['qte'], 'id' => 'qte' . $i, 'label' => '', 'name' => 'data[Ofsfligne][' . $i . '][qte]', 'table' => 'Ofsfligne', 'champ' => 'qte', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control comp'));
                                                    ?>
                                                </td>

                                                <td>
                                                    <select name="<?php echo "data[Ofsfligne][" . $i . "][unite_id]" ?>"
                                                        width="200px" id="<?php echo 'unite_id' . $i ?>" style="width:200px"
                                                        table="ligner" index="<?php echo $i ?>" champ="unite_id"
                                                        class="js-example-responsive select2 ">
                                                        <option value="" selected="selected" disabled>Veuillez choisir
                                                            !!</option>

                                                        <?php foreach ($unit as $u) {
                                                            ?>
                                                            <option <?php if ($fech['unite_id'] == $u->id) { ?>
                                                                    selected="selected" <?php } ?> value="<?php echo $u->id; ?>">
                                                                <?php echo $u->name ?>
                                                            </option>
                                                        <?php }


                                                        ?>
                                                    </select>
                                                </td>
                                                <td hidden align="center" <?php if (empty($fech['Ligne'])) { ?> hidden <?php } ?> id="tdcomp<?php echo $i ?>" index="<?php echo $i ?>" champ="tdcomp"
                                                    table="Ofsfligne" name="data[Ofsfligne][<?php echo $i ?>][tdcomp]">
                                                    <?php
                                                    echo $this->Form->input('coeff', array('value' => $fech['coeff'], 'id' => 'coeff' . $i, 'label' => '', 'name' => 'data[Ofsfligne][' . $i . '][coeff]', 'table' => 'Ofsfligne', 'champ' => 'coeff', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                    ?>
                                                </td>
                                                <td align="center"><i index="<?php echo $i; ?>" class="fa fa-times supor"
                                                        style="color: #c9302c;font-size: 22px;"></td>

                                            </tr>

                                            <tr index="<?php echo $i; ?>" class="tr" align="centre">
                                                <td width='30%'></td>
                                                <td champ="afef" class="afef" id="afef<?php echo $i; ?>" colspan="3"
                                                    index="<?php echo $i; ?>">
                                                    <div class="panel panel-default" width="50%">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">
                                                                <?php echo __('Composant'); ?>
                                                            </h3>
                                                            <a class="btn btn-primary ajouterligne1 "
                                                                table='addtableaa<?php echo $i; ?>'
                                                                index='<?php echo $i; ?>'
                                                                indexligne='indexa<?php echo $i; ?>'
                                                                tr="traa<?php echo $i; ?>" style="
                                                                   float: right; 
                                                                   position: relative;
                                                                   top: -25px;
                                                                   "><i class="fa fa-plus-circle"></i></a>
                                                        </div>
                                                        <div class="panel-body">
                                                            <table
                                                                class="table table-bordered table-striped table-bottomless"
                                                                id="addtableaa<?php echo $i; ?>" style="width:100%"
                                                                align="center">
                                                                <thead>
                                                                    <tr bgcolor="#EDEDED">
                                                                        <td align="center">Composant</td>
                                                                        <td align="center">Qte</td>
                                                                        <td align="center">Unite</td>
                                                                        <td align="center" hidden id='tdcompp' hidden>
                                                                            Coefficient</td>

                                                                        <td></td>
                                                                    </tr>
                                                                <tbody>
                                                                    <tr class="traa<?php echo $i; ?>" style="display:none;"
                                                                        d="traa<?php echo $i; ?>">
                                                                        <td>
                                                                            <?php
                                                                            echo $this->Form->input('supp2', array('label' => '', 'type' => 'hidden', 'div' => 'form-group', 'name' => '', 'indexligne' => '0', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'index' => $i, 'id' => 'supp', 'champ' => 'supp2', 'indextype' => '', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                            echo $this->Form->input('article_id', array('name' => '', 'label' => '', 'indexligne' => '0', 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'article_idt', 'id' => 'article_idt', 'indextype' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'empty' => 'Veuillez Choisir !!'));
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                            echo $this->Form->input('qte', array('name' => '', 'label' => '', 'indexligne' => '0', 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'qte', 'id' => 'qte', 'indextype' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control '));
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo $this->Form->input('unite_id', array('name' => '', 'label' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'unite_idt', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => '', 'empty' => 'Veuillez Choisir !!', 'class' => 'form-control'));
                                                                            ?>
                                                                        </td>

                                                                        <td hidden champ='tdcompp' index='' indexligne=''
                                                                            table='Ofsfligne' tableligne='Phaseofsf'>
                                                                            <?php
                                                                            echo $this->Form->input('coeff', array('name' => '', 'label' => '', 'indexligne' => '0', 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'coeff', 'id' => 'coeff', 'indextype' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control '));
                                                                            ?>
                                                                        </td>
                                                                        <td align="center">
                                                                            <i indexligne="0" index="<?php echo $i; ?>"
                                                                                class="fa fa-times supor2"
                                                                                style="color: #c9302c;font-size: 22px;">
                                                                        </td>


                                                                    </tr>
                                                                    <tr class="traaligne" index="" champ='traaligne'
                                                                        style="display:none">
                                                                        <td width='30%'></td>
                                                                        <td champ="afefligne" class="afefligne" colspan="3"
                                                                            id="" index="">
                                                                            <div class="panel panel-default">
                                                                                <div class="panel-heading">
                                                                                    <h3 class="panel-title">
                                                                                        <?php echo __('Composant'); ?>
                                                                                    </h3>
                                                                                    <a class="btn btn-primary ajouterligne1ligne "
                                                                                        tabletypeligne='addtableaaligne'
                                                                                        indexligneligne='indexaligne'
                                                                                        trtypeligne="traaaligne" style="
                                                                                   float: right; 
                                                                                   position: relative;
                                                                                   top: -25px;
                                                                                   "><i class="fa fa-plus-circle"></i>
                                                                                    </a>
                                                                                </div>
                                                                                <div class="panel-body">

                                                                                    <table
                                                                                        class="table table-bordered table-striped table-bottomless"
                                                                                        index=""
                                                                                        indexligneligne='indexaligne'
                                                                                        champ="addtableaaligne" id=""
                                                                                        style="width:100%" align="center">
                                                                                        <thead>
                                                                                            <tr bgcolor="#EDEDED">
                                                                                                <td align="center">
                                                                                                    Composant</td>
                                                                                                <td align="center">Qte
                                                                                                </td>
                                                                                                <td align="center">Unite
                                                                                                </td>
                                                                                                <td align="center" hidden>
                                                                                                    Coefficient
                                                                                                </td>

                                                                                                <td align="center"></td>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr class="traaaligne"
                                                                                                style="display:none;" id=""
                                                                                                champ='traaaligne' index="">

                                                                                                <td>
                                                                                                    <?php
                                                                                                    echo $this->Form->input('supp3', array('name' => '', 'type' => 'hidden', 'label' => '', 'indexligneligne' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'supp3', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control', ));


                                                                                                    echo $this->Form->input('article_id', array('name' => '', 'label' => '', 'indexligneligne' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'article_idd', 'id' => 'article_idd', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => '', 'empty' => 'Veuillez Choisir !!', "style" => "width:100% ; height:32px"));
                                                                                                    ?>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <?php echo $this->Form->input('qte', array('name' => '', 'label' => '', 'indexligneligne' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'qte', 'id' => 'qte', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                                                    ?>
                                                                                                </td>
                                                                                                <td hidden>
                                                                                                    <?php echo $this->Form->input('coeff', array('name' => '', 'label' => '', 'indexligneligne' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'coeff', 'id' => 'coeff', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                                                    ?>
                                                                                                </td>
                                                                                                <td align="center">
                                                                                                    <i indexligneligne=""
                                                                                                        indexligne=""
                                                                                                        index=""
                                                                                                        class="fa fa-times supor3"
                                                                                                        style="color: #c9302c;font-size: 22px;">
                                                                                                </td>

                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                    <input type="hidden" value="0" class=""
                                                                                        id="" champ="indexaligne" />
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <?php foreach ($fech['Ligne'] as $j => $fech1) {
                                                                        // debug($fech1['unite_id']) ;                                                                     
                                                                        ?>
                                                                        <tr>
                                                                            <td>
                                                                                <?php
                                                                                echo $this->Form->input('supp2', array('name' => 'data[Ofsfligne][' . $i . '][Phaseofsf][' . $j . '][supp2]', 'label' => '', 'type' => 'hidden', 'div' => 'form-group', 'indexligne' => $j, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'index' => $i, 'id' => 'supp2' . $i . '-' . $j, 'champ' => 'supp', 'indextype' => '', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                                echo $this->Form->input('id', array('value' => $fech1['id'], 'name' => 'data[Ofsfligne][' . $i . '][Phaseofsf][' . $j . '][id]', 'type' => 'hidden', 'label' => '', 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'personnel_id', 'id' => 'id' . $i . '-' . $j, 'indextype' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => ''));
                                                                                echo $this->Form->input('article_id', array('value' => $fech1['article_id'], 'name' => 'data[Ofsfligne][' . $i . '][Phaseofsf][' . $j . '][article_idt]', 'label' => '', 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'article_idt', 'id' => 'article_idt' . $i . '-' . $j, 'indextype' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control select2', 'empty' => 'Veuillez Choisir !!'));
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                echo $this->Form->input('qte', array('value' => $fech1['qte'], 'name' => 'data[Ofsfligne][' . $i . '][Phaseofsf][' . $j . '][qte]', 'label' => '', 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'qte', 'id' => 'qte' . $i . '-' . $j, 'indextype' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control '));
                                                                                ?>
                                                                            </td>

                                                                            <td>
                                                                                <select
                                                                                    name="<?php echo "data[Ofsfligne][" . $i . "][Phaseofsf][" . $j . "][unite_idt]" ?>"
                                                                                    width="200px"
                                                                                    id="<?php echo 'unite_idt' . $i ?>"
                                                                                    style="width:200px" table="ligner"
                                                                                    index="<?php echo $i ?>" champ="unite_idt"
                                                                                    class="js-example-responsive select2 ">
                                                                                    <option value="" selected="selected"
                                                                                        disabled>Veuillez choisir !!
                                                                                    </option>

                                                                                    <?php foreach ($unit as $u) {
                                                                                        ?>
                                                                                        <option <?php if ($fech1['unite_id'] == $u->id) { ?>
                                                                                                selected="selected" <?php } ?>
                                                                                            value="<?php echo $u->id; ?>">
                                                                                            <?php echo $u->name ?>
                                                                                        </option>
                                                                                    <?php }
                                                                                    ?>
                                                                                </select>
                                                                            </td>
                                                                            <td <?php if (empty($fech['ligneligne'])) { ?>
                                                                                    hidden <?php } ?>
                                                                                id="tdcompp<?php echo $i ?>-<?php echo $j ?>"
                                                                                champ="tdcompp" table="Ofsfligne"
                                                                                indexligne="<?php echo $j ?>"
                                                                                index="<?php echo $i ?>"
                                                                                name="data[Ofsfligne][<?php echo $i ?>][Phaseofsf][<?php echo $j ?>][tdcompp]">
                                                                                <?php
                                                                                echo $this->Form->input('coeff', array('value' => $fech1['coeff'], 'name' => 'data[Ofsfligne][' . $i . '][Phaseofsf][' . $j . '][coeff]', 'label' => '', 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'coeff', 'id' => 'coeff' . $i . '-' . $j, 'indextype' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control '));
                                                                                ?>
                                                                            </td>
                                                                            <td align="center">
                                                                                <i indexligne="<?php echo $j; ?>"
                                                                                    index="<?php echo $i; ?>"
                                                                                    class="fa fa-times supor2"
                                                                                    style="color: #c9302c;font-size: 22px;">
                                                                            </td>


                                                                        </tr>
                                                                        <tr id="traaligne<?php echo $i ?>-<?php echo $j ?>"
                                                                            champ='traaligne'>
                                                                            <td width='30%'></td>
                                                                            <td id="afefligne<?php echo $i ?>-<?php echo $j ?>"
                                                                                champ="afefligne"
                                                                                class="afefligne <?php echo $i ?>-<?php echo $j ?>"
                                                                                colspan="3"
                                                                                id="afefligne<?php echo $i ?>-<?php echo $j ?>"
                                                                                index="<?php echo $i ?>">
                                                                                <div class="panel panel-default">
                                                                                    <div class="panel-heading">
                                                                                        <h3 class="panel-title">
                                                                                            <?php echo __('Composant'); ?>
                                                                                        </h3>
                                                                                        <a class="btn btn-primary ajouterligne1ligne"
                                                                                            table="addtableaaligne<?php echo $i ?>-<?php echo $j ?>"
                                                                                            tr="traaaligne<?php echo $i ?>-<?php echo $j ?>"
                                                                                            tabletypeligne='addtableaaligne'
                                                                                            trtypeligne="traaaligne"
                                                                                            tabletypeligne='addtableaaligne<?php echo $i ?>-<?php echo $j ?>'
                                                                                            indexligneligne='indexaligne<?php echo $i ?>-<?php echo $j ?>'
                                                                                            indexlignetypeligne='indexaligne<?php echo $i ?>-<?php echo $j ?>'
                                                                                            trtypeligne="traaaligne<?php echo $i ?>-<?php echo $j ?>"
                                                                                            style="
                                                                                               float: right; 
                                                                                               position: relative;
                                                                                               top: -25px;
                                                                                               "><i
                                                                                                class="fa fa-plus-circle"></i>
                                                                                        </a>
                                                                                    </div>
                                                                                    <div class="panel-body">
                                                                                        <table
                                                                                            class="table table-bordered table-striped table-bottomless"
                                                                                            index="<?php echo $i ?>"
                                                                                            indexligneligne='<?php echo $j ?>'
                                                                                            champ="addtableaaligne"
                                                                                            id="addtableaaligne<?php echo $i ?>-<?php echo $j ?>"
                                                                                            style="width:100%" align="center">
                                                                                            <thead>
                                                                                                <tr bgcolor="#EDEDED">
                                                                                                    <td align="center">
                                                                                                        Composant</td>
                                                                                                    <td align="center">Qte
                                                                                                    </td>
                                                                                                    <td align="center">Unite
                                                                                                    </td>
                                                                                                    <td align="center" hidden>
                                                                                                        Coefficient
                                                                                                    </td>

                                                                                                    <td align="center"></td>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                <tr style="display:none;"
                                                                                                    class="traaaligne<?php echo $i ?>-<?php echo $j ?>"
                                                                                                    id="traaaligne<?php echo $i ?>-<?php echo $j ?>"
                                                                                                    champ='traaaligne'
                                                                                                    index="<?php echo $i ?>"
                                                                                                    indexligne="<?php echo $j ?>">

                                                                                                    <td>
                                                                                                        <?php
                                                                                                        echo $this->Form->input('supp3', array('name' => '', 'type' => 'hidden', 'label' => '', 'indexligneligne' => '', 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'supp3', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));


                                                                                                        echo $this->Form->input('article_id', array('name' => '', 'label' => '', 'indexligneligne' => '', 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'article_idd', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => '', 'empty' => 'Veuillez Choisir !!', "style" => "width:100% ; height:32px"));
                                                                                                        ?>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <?php echo $this->Form->input('qte', array('name' => '', 'label' => '', 'indexligneligne' => '', 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'qte', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                                                        ?>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <?php echo $this->Form->input('unite_id', array('name' => '', 'label' => '', 'indexligneligne' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'unite_idd', 'id' => 'unite_id', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control', 'empty' => 'Veuillez Choisir !!'));
                                                                                                        ?>
                                                                                                    </td>
                                                                                                    <td hidden>
                                                                                                        <?php echo $this->Form->input('coeff', array('name' => '', 'label' => '', 'indexligneligne' => '', 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'coeff', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                                                        ?>
                                                                                                    </td>
                                                                                                    <td align="center">
                                                                                                        <i indexligneligne=""
                                                                                                            indexligne="<?php echo $j ?>"
                                                                                                            index="<?php echo $i ?>"
                                                                                                            class="fa fa-times supor3"
                                                                                                            style="color: #c9302c;font-size: 22px;">
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <?php foreach ($fech1['ligneligne'] as $k => $fech2) {
                                                                                                    ///debug($fech2);
                                                                                                    ?>
                                                                                                    <tr>
                                                                                                        <td>
                                                                                                            <?php
                                                                                                            echo $this->Form->input('supp3', array('name' => 'data[Ofsfligne][' . $i . '][Phaseofsf][' . $j . '][Phaseofsfligne][' . $k . '][supp3]', 'type' => 'hidden', 'label' => '', 'indexligneligne' => $k, 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'supp3', 'id' => 'supp3' . $i . '-' . $j . '-' . $k, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));


                                                                                                            echo $this->Form->input('article_id', array('value' => $fech2['article_id'], 'name' => 'data[Ofsfligne][' . $i . '][Phaseofsf][' . $j . '][Phaseofsfligne][' . $k . '][article_idd]', 'label' => '', 'indexligneligne' => $k, 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'article_idd', 'id' => 'article_idd' . $i . '-' . $j . '-' . $k, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control select2', 'empty' => 'Veuillez Choisir !!', "style" => "width:100% ; height:32px"));
                                                                                                            ?>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <?php echo $this->Form->input('qte', array('value' => $fech2['qte'], 'name' => 'data[Ofsfligne][' . $i . '][Phaseofsf][' . $j . '][Phaseofsfligne][' . $k . '][qte]', 'label' => '', 'indexligneligne' => $k, 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'qte', 'id' => 'qte' . $i . '-' . $j . '-' . $k, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                                                            ?>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <select
                                                                                                                name="<?php echo "data[Ofsfligne][" . $i . "][Phaseofsf][" . $j . "][Phaseofsfligne][" . $k . "][unite_idd]" ?>"
                                                                                                                width="200px"
                                                                                                                id="<?php echo 'unite_idd' . $i ?>"
                                                                                                                style="width:200px"
                                                                                                                table="ligner"
                                                                                                                index="<?php echo $i ?>"
                                                                                                                champ="unite_idd"
                                                                                                                class="js-example-responsive select2 ">
                                                                                                                <option value=""
                                                                                                                    selected="selected"
                                                                                                                    disabled>
                                                                                                                    Veuillez
                                                                                                                    choisir !!
                                                                                                                </option>

                                                                                                                <?php foreach ($unit as $u) {
                                                                                                                    ?>
                                                                                                                    <option <?php if ($fech2['unite_id'] == $u->id) { ?>
                                                                                                                            selected="selected"
                                                                                                                        <?php } ?>
                                                                                                                        value="<?php echo $u->id; ?>">
                                                                                                                        <?php echo $u->name ?>
                                                                                                                    </option>
                                                                                                                <?php }
                                                                                                                ?>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                        <td hidden>
                                                                                                            <?php echo $this->Form->input('coeff', array('value' => $fech2['coeff'], 'name' => 'data[Ofsfligne][' . $i . '][Phaseofsf][' . $j . '][Phaseofsfligne][' . $k . '][coeff]', 'label' => '', 'indexligneligne' => $k, 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'coeff', 'id' => 'coeff' . $i . '-' . $j . '-' . $k, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                                                            ?>
                                                                                                        </td>
                                                                                                        <td align="center">
                                                                                                            <i indexligneligne="<?php echo $k ?>"
                                                                                                                indexligne="<?php echo $j ?>"
                                                                                                                index="<?php echo $i ?>"
                                                                                                                class="fa fa-times supor3"
                                                                                                                style="color: #c9302c;font-size: 22px;">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                <?php } ?>
                                                                                            </tbody>
                                                                                        </table>
                                                                                        <input type="hidden"
                                                                                            value="<?php echo $k ?>" class=""
                                                                                            id="indexaligne<?php echo $i ?>-<?php echo $j ?>"
                                                                                            champ="indexaligne" />
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                    <input type="hidden" value="<?php echo $j ?>"
                                                                        id="indexa<?php echo $i ?>" />
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <input type="hidden" value="<?php echo $i ?>" id="index" />
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div align="center">
                    <?php echo $this->Form->submit(__('Enregistrer'), ['id' => 'ajouarticle']); ?>
                </div>
                <?php echo $this->Form->end(); ?>




            </div>
        </div>
    </div>
    </div>
</section>




<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('[data-toggle="tab"]');
        buttons.forEach(button => {
            button.addEventListener('click', function () {

                // Désactiver tous les boutons
                buttons.forEach(btn => {
                    btn.classList.remove('active');
                });

                // Activer le bouton cliqué
                button.classList.add('active');
            });
        });

        // Gestionnaire d'événements global pour maintenir le bouton actif lors de clics en dehors
        document.addEventListener('click', function (event) {
            if (!event.target.matches('[data-toggle="tab"]')) {
                const activeButton = document.querySelector('.btn.active');
                if (activeButton) {
                    activeButton.classList.add('active');
                }
            }
        });
    });

    function afficherDiv(id) {
        // Masquer tous les divs
        const divs = document.getElementsByClassName('tab-content');

        for (let i = 0; i < divs.length; i++) {
            divs[i].style.display = 'none';
        }

        // Afficher le div correspondant
        document.getElementById(id).style.display = 'block';

    }
    $(function () {
        $('.rang').on('change', function () {
            index = $(this).attr("index");
            i = Number(index) + 1;
            //   $('#rang'+index).val(i); //alert(id)
            //   alert(id+'id')
            inde = $('#indexe').val();
            k = 0;
            for (i = 0; i <= inde; i++) {
                sup = $('#sup0' + i).val(); //alert(sup)
                if (Number(sup) != 1) {
                    k++;

                    $('#rang' + i).val(k);
                }
            }
        });
        $('.famille1').on('change', function () {

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
                document.getElementById("code").maxLength = 4;
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

            if (id == 2 || id == 1) {
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
                    success: function (data) {
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
            } else {
                document.getElementById('soussous').disabled = true;
                document.getElementById('sous').disabled = true;
            }



        });


    });




    $(function () {
        $('.tva').on('change', function () {
            //alert('hello');
            id = $('#tvaselect').val();
            //alert(id)
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
                success: function (data) {
                    //alert(data['ligne']['valeur']);

                    $('#tva').val(data['ligne']['valeur']);

                    prix = Number($('#Prix_LastInput').val());
                    tva = Number($('#tva').val());
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

                        mpontanttpe = Number($('#Prix_LastInput').val()) * tpe /
                            100; //alert(mpontanttpe);
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
            success: function (data) {
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






    $(function () {
        $('.sousfamille1').on('change', function () {
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
                success: function (data) {
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





    $(function () {
        $('#code').on('blur', function () {

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
                success: function (data) {
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
<!-- fichearticle2s -->

<script>
    $(".ajouterlignematriceeefiche").on('click', function () {
        // alert();
        table = $(this).attr('table'); //id table
        index = $(this).attr('index') || 0; // id max compteur
        tr = $(this).attr('tr'); //class class type
        // alert(tr);
        // alert(table);
        // alert(index);
        ind = Number($('#' + index).val()) + 1;
        $('#' + index).val(ind);
        $ttr = $('#' + table).find('.' + tr).clone(true); //console.log($ttr);
        $ttr.attr('class', '');
        i = 0;
        tabb = [];
        vc = 0;
        tabd = [];
        $ttr.find('input,select,div,td,textarea,tr,a,table,i').each(function () {
            tab = $(this).attr('table');
            champ = $(this).attr('champ'); //console.log(champ);

            $(this).attr('index', ind);
            $(this).attr('id', champ + ind);
            $(this).attr('name', 'data[' + tab + '][' + ind + '][' + champ + ']');
            $(this).attr('data-bv-field', 'data[' + tab + '][' + ind + '][' + champ + ']');
            if (tab == 'Ligneinventaire' && champ == 'article_id') {
                $(this).attr('onchange', 'artcilecode(this.value,' + ind + ')');
            }
            $(this).removeClass('anc');
            if ($(this).is('select')) {
                tabb[i] = champ + ind;
                // alert(tabb[i]);
                i = Number(i) + 1;
            }
            if ($(this).hasClass('ajouterligne1fiche')) {
                tabletype = $(this).attr('tabletype');
                indexlignetype = $(this).attr('indexlignetype');

                trtype = $(this).attr('trtype');
                // tabletype='addtablea' index ='' indexlignetype='indexa' trtype="tra"
                $(this).attr('table', tabletype + ind);
                $(this).attr('indexligne', indexlignetype + ind);
                $(this).attr('tr', trtype + ind);

            }

            if ($(this).hasClass('indexa1')) {

                indextype = $(this).attr('indextype');
                $(this).attr('id', indextype + ind);
            }
            if ($(this).hasClass('traafiche')) {





                $(this).attr('id', 'traafiche' + ind);
                // $(this).attryle','display:none;');
            }
            if ($(this).hasClass('traaafiche')) {


                $(this).attr('id', 'traaafiche' + ind);
                $(this).attr('style', 'display:none;');
            }

            // alert($(this).attr('class')); tra
            if ($(this).hasClass('date')) {
                tabd[vc] = champ + ind;
                //alert(tabd[vc]);
                vc = Number(vc) + 1;
            }
            //  $(this).val('');

        })
        $ttr.find('i').each(function () {
            $(this).attr('index', ind);
        });
        $ttr.attr('style', '');
        $('#' + table).append($ttr);
        $('#' + index).val(ind);
        $('#' + table).find('tr:last').show();
        $("#article_id" + ind).select2({
            width: '100%' // need to override the changed default
        });
        $("#unite" + ind).select2({
            width: '100%' // need to override the changed default
        });

        //                $("#article_id" +ind+'0').select2({
        //            width: '100%' // need to override the changed default
        //        });
        //    alert(index+'ggindex')
        //        alert(ind+'ind')
        //        console.log("#article_id" +ind+'-'+'0');
        //       $("#article_id" +ind+'-'+'0').select2({
        //            width: '100%' // need to override the changed default
        //        });
        for (j = 0; j <= i; j++) {
            //  uniform_select(tabb[j]);
        }

        // alert('#date_debut'+ind);
        //                 $('#date_debut'+ind).datetimepicker({
        //        timepicker: false,
        //        datepicker:true,
        //        mask:'39/19/9999',
        //        format:'d/m/Y'});
        //        for (k = 0; k <= vc; k++) {
        //            // alert(tabd[k])
        //            $('#' + tabd[k]).datetimepicker({
        //                timepicker: false,
        //                datepicker: true,
        //                mask: '39/19/9999',
        //                format: 'd/m/Y'});
        //        }
        // ajouter  desueimme ligne

        $ttr = $('#' + table).find('.traafiche').clone(true); //console.log($ttr);
        $ttr.attr('class', '');
        i = 0;
        tabb = [];
        vc = 0;
        tabd = [];
        $ttr.find('input,select,div,td,textarea,tr,a,table,i').each(function () {
            tab = $(this).attr('table');
            champ = $(this).attr('champ'); //console.log(champ);
            $(this).attr('index', ind);
            $(this).attr('id', champ + ind);
            $(this).attr('name', 'data[' + tab + '][' + ind + '][' + champ + ']');
            $(this).attr('data-bv-field', 'data[' + tab + '][' + ind + '][' + champ + ']');
            ////article_id
            if (champ == 'article_id') {

                $(this).attr('indexligne', 0);
                $(this).attr('index', ind);
                $(this).attr('id', champ + ind + '-' + '0');
                tabb[i] = champ + ind + '-' + '0';
                i = Number(i) + 1;
                // data[Ligneordrefab][0][Phaseordrefabrication][1][personnel_id]
                $(this).attr('name', ' data[premierefiche][' + ind + '][deuxiemefiche][0][' + champ + ']');
                $(this).attr('data-bv-field', 'data[premierefiche][' + ind + '][deuxiemefiche][0][' +
                    champ +
                    ']');

            }


            if (champ == 'qte') {

                $(this).attr('indexligne', 0);
                $(this).attr('index', ind);
                $(this).attr('id', champ + ind + '-' + '0');
                tabb[i] = champ + ind + '-' + '0';
                i = Number(i) + 1;
                // data[Ligneordrefab][0][Phaseordrefabrication][1][personnel_id]
                $(this).attr('name', ' data[premierefiche][' + ind + '][deuxiemefiche][0][' + champ + ']');
                $(this).attr('data-bv-field', 'data[premierefiche][' + ind + '][deuxiemefiche][0][' +
                    champ +
                    ']');
            }

            if (champ == 'coeff') {

                $(this).attr('indexligne', 0);
                $(this).attr('index', ind);
                $(this).attr('id', champ + ind + '-' + '0');
                tabb[i] = champ + ind + '-' + '0';
                i = Number(i) + 1;
                // data[Ligneordrefab][0][Phaseordrefabrication][1][personnel_id]
                $(this).attr('name', ' data[premierefiche][' + ind + '][deuxiemefiche][0][' + champ + ']');
                $(this).attr('data-bv-field', 'data[premierefiche][' + ind +
                    '][deuxiemefiche][0][' + champ +
                    ']');
            }


            if (champ == 'phaseproduction_id') {
                $(this).attr('indexligne', 0);
                $(this).attr('index', ind);
                $(this).attr('id', champ + ind + '-' + '0');
                tabb[i] = champ + ind + '-' + '0';
                i = Number(i) + 1;
                $(this).attr('name', ' data[premierefiche][' + ind + '][deuxiemefiche][0][' + champ + ']');
                $(this).attr('data-bv-field', 'data[premierefiche][' + ind +
                    '][deuxiemefiche][0][' + champ +
                    ']');
            }
            if (champ == 'supp') {
                $(this).attr('indexligne', 0);
                $(this).attr('index', ind);
                $(this).attr('id', champ + ind + '-' + '0');
                tabb[i] = champ + ind + '-' + '0';
                i = Number(i) + 1;
                $(this).attr('name', ' data[premierefiche][' + ind + '][deuxiemefiche][0][' + champ + ']');
                $(this).attr('data-bv-field', 'data[premierefiche][' + ind + '][deuxiemefiche][0][' +
                    champ + ']');
            }
            if (tab == 'Ligneinventaire' && champ == 'article_id') {
                $(this).attr('onchange', 'artcilecode(this.value,' + ind + ')');
            }
            //            $(this).removeClass('anc');
            //            if ($(this).is('select')) {
            //                tabb[i] = champ + ind;
            //                // alert(tabb[i]);
            //                i = Number(i) + 1;
            //            }
            if ($(this).hasClass('ajouterligne1fiche')) {
                tabletype = $(this).attr('tabletype');
                indexlignetype = $(this).attr('indexlignetype');
                trtype = $(this).attr('trtype');
                // tabletype='addtablea' index ='' indexlignetype='indexa' trtype="tra"
                $(this).attr('table', tabletype + ind);
                $(this).attr('indexligne', indexlignetype + ind);
                $(this).attr('tr', trtype + ind);
            }
            if ($(this).hasClass('traafiche')) {
                $(this).attr('id', 'traafiche' + ind);
                // $(this).attr('style','display:none;');
            }
            if ($(this).hasClass('traaafiche')) {
                $(this).attr('id', 'traaafiche' + ind);
                $(this).attr('class', 'traaafiche' + ind);
                $(this).attr('style', 'display:none;');
            }
            if ($(this).hasClass('indexa1')) {

                indextype = $(this).attr('indextype');
                $(this).attr('id', indextype + ind);
            }
            //              if ($(this).hasClass('traaa')) {
            //                
            //                 $(this).attr('class','traaa'+ind);
            //                 $(this).attr('id','traaa'+ind);
            //             }

            //  $(this).val('');

        })
        $ttr.find('i').each(function () {
            $(this).attr('index', ind);

        });
        $ttr.attr('style', '');
        $('#' + table).append($ttr);
        $('#' + index).val(ind);
        $('#' + table).find('tr:last').show();
        // alert(ind)
        $("#article_id" + ind).select2({
            width: '100%' // need to override the changed default
        });
        //$('#' + table).find('tr:last .traa').attr('style', 'display:none');
        for (j = 0; j <= i; j++) {
            // uniform_select(tabb[j]);

        }


    });
    //////////////////////////////////// ajouter ligne ////////
    $(".ajouterligne1fichee").on('click', function () {
        // console.log("Click event triggered!"); // Check if this message appears in the console

        table = $(this).attr('table'); //alert("table "+table);
        index = $(this).attr('indexligne');
        alert(index);
        // alert(table);
        itd = $(this).attr('index');
        // alert(itd);
        //console.log(itd);
        $('#tdcomp').show();
        $('#tdcomp' + itd).show();
        tr = $(this).attr('trtype');
        // / alert(tr);
        ind = Number($('#' + index).val()) + 1;
        // alert(ind);
        $('#' + index).val(ind);
        $ttr = $('#' + table).find('.' + tr + itd).clone(true);
        // alert($ttr.html()); // or console.log($ttr) for more detailed output


        // console.log($ttr);
        $ttr.attr('class', '');
        i = 0;
        tabb = [];
        vc = 0;
        tabd = [];

        $ttr.find('a,input,select,div,td,textarea,tr,table,i').each(function () {
            //alert($ttr.find('a'));
            tab = $(this).attr('table');
            // alert(tab);
            champ = $(this).attr('champ'); // console.log(champ);
            tableligne = $(this).attr('tableligne'); //alert(tableligne);
            tableligneligne = $(this).attr('tableligneligne'); //alert(tableligneligne);
            index = $(this).attr('index');
            alert('index' + index);
            indexligne = $(this).attr('indexligne');
            indexligneligne = $(this).attr('indexligneligne');
            if (champ == 'article_id') {
                //              alert(index+'index');
                //              alert(ind+'indexligne');

                //    alert(champ)
                //alert('index'+index);alert('tableligne'+tableligne)
                //alert(index+'inddexx')
                //alert(ind+'inddds')
                $(this).attr('indexligne', ind); // alert( $(this).attr('indexligne'));
                $(this).attr('index', index); //alert( $(this).attr('index'));
                $(this).attr('id', champ + index + '-' + ind); //alert( $(this).attr('id'));
                $(this).attr('name', 'data[' + tab + '][' + index + '][' + tableligne + '][' + ind + '][' +
                    champ + ']');
                $(this).attr('data-bv-field', 'data[' + tab + '][' + index + '][' + tableligne + '][' +
                    ind + '][' + champ + ']');
                $(this).removeClass('anc');
            }
            if (champ == 'qte') {


                $(this).attr('indexligne', ind); // alert( $(this).attr('indexligne'));
                $(this).attr('index', index); //alert( $(this).attr('index'));
                $(this).attr('id', champ + index + '-' + ind); //alert( $(this).attr('id'));
                $(this).attr('name', 'data[' + tab + '][' + index + '][' + tableligne + '][' + ind + '][' +
                    champ + ']');
                $(this).attr('data-bv-field', 'data[' + tab + '][' + index + '][' + tableligne + '][' +
                    ind + '][' + champ + ']');
                $(this).removeClass('anc');
            }

            if (champ == 'coeff') {


                $(this).attr('indexligne', ind); // alert( $(this).attr('indexligne'));
                $(this).attr('index', index); //alert( $(this).attr('index'));
                $(this).attr('id', champ + index + '-' + ind); //alert( $(this).attr('id'));
                $(this).attr('name', 'data[' + tab + '][' + index + '][' + tableligne + '][' + ind + '][' +
                    champ + ']');
                $(this).attr('data-bv-field', 'data[' + tab + '][' + index + '][' + tableligne + '][' +
                    ind + '][' + champ + ']');
                $(this).removeClass('anc');
            }
            if (champ == 'unite_id') {

                $(this).attr('indexligne', ind); // alert( $(this).attr('indexligne'));
                $(this).attr('index', index); //alert( $(this).attr('index'));
                $(this).attr('id', champ + index + '-' + ind); //alert( $(this).attr('id'));
                $(this).attr('name', 'data[' + tab + '][' + index + '][' + tableligne + '][' + ind + '][' +
                    champ + ']');
                $(this).attr('data-bv-field', 'data[' + tab + '][' + index + '][' + tableligne + '][' +
                    ind + '][' + champ + ']');
                $(this).removeClass('anc');
            }
            if (champ == 'article_idt') {


                $(this).attr('indexligne', ind); // alert( $(this).attr('indexligne'));
                $(this).attr('index', index); //alert( $(this).attr('index'));
                $(this).attr('id', champ + index + '-' + ind); //alert( $(this).attr('id'));
                $(this).attr('name', 'data[' + tab + '][' + index + '][' + tableligne + '][' + ind + '][' +
                    champ + ']');
                $(this).attr('data-bv-field', 'data[' + tab + '][' + index + '][' + tableligne + '][' +
                    ind + '][' + champ + ']');
                $(this).removeClass('anc');
            }
            if (champ == 'suppmm') {

                $(this).attr('indexligne', ind); // alert( $(this).attr('indexligne'));
                $(this).attr('index', index); //alert( $(this).attr('index'));
                $(this).attr('id', champ + index + '-' + ind); //alert( $(this).attr('id'));
                $(this).attr('name', 'data[' + tab + '][' + index + '][' + tableligne + '][' + ind + '][' +
                    champ + ']');
                $(this).attr('data-bv-field', 'data[' + tab + '][' + index + '][' + tableligne + '][' +
                    ind + '][' + champ + ']');
                $(this).removeClass('anc');
            }



            if ($(this).is('select')) {
                tabb[i] = champ + index + '-' + ind;
                // alert(tabb[i]);
                i = Number(i) + 1;
            }

            if ($(this).hasClass('ajouterligne1lignefiche')) {
                tabletypeligne = $(this).attr('tabletypeligne'); //alert(tabletypeligne+"tabletypeligne")
                indexlignetypeligne = $(this).attr(
                    'indexlignetype'); //alert(indexlignetypeligne+"tabletypeligne")
                trtypeligne = $(this).attr('trtypeligne'); //alert(trtypeligne+"trtypeligne")
                // tabletype='addtablea' index ='' indexlignetype='indexa' trtype="tra"
                $(this).attr('table', tabletypeligne + index + '-' + ind);
                $(this).attr('indexligneligne', indexligneligne + index + '-' + ind);
                $(this).attr('tr', trtypeligne + index + '-' + ind);

            }


            if ($(this).hasClass('indexaligne1fiche')) {
                indextype = $(this).attr('indextype');
                $(this).attr('id', indextypeligne + index + '-' + ind);
            }
            if ($(this).hasClass('traalignefiche')) {
                $(this).attr('id', 'traalignefiche' + index + '-' + ind);
                // $(this).attryle','display:none;');
            }
            // alert(champ+"champ");
            if ($(this).hasClass('traaalignefiche')) {
                //  alert(afefef)
                $(this).attr('id', 'traaalignefiche' + index + '-' + ind);
                $(this).attr('style', 'display:none;');
            }


        })
        $ttr.find('i').each(function () {
            $(this).attr('indexligne', ind);
        });
        $ttr.attr('style', '');





        $('#' + table).append($ttr);


        for (j = 0; j <= i; j++) {

        }
        $ttr = $('#' + table).find('.traalignefiche').clone(true); //console.log($ttr);
        $ttr.attr('class', '');
        i = 0;
        tabb = [];
        vc = 0;
        tabd = [];
        $ttr.find('input,select,div,td,textarea,tr,a,table,i').each(function () {
            tab = $(this).attr('table'); //alert(tab+"rabb")
            champ = $(this).attr('champ'); //console.log(champ); 
            index = $(this).attr('index'); //console.lfog(champ);
            $(this).attr('index', ind);
            $(this).attr('id', champ + ind);
            $(this).attr('name', 'data[' + tab + '][' + ind + '][' + champ + ']');
            $(this).attr('data-bv-field', 'data[' + tab + '][' + ind + '][' + champ + ']');
            if (champ == 'article_id') {
                //   $(this).attr('indexligne', 0);
                $(this).attr('indexligneligne', 0);
                $(this).attr('indexligne', ind);
                $(this).attr('index', index);
                // alert(champ+'champ')
                // alert(index+'index')
                //alert(ind+'ind')
                $(this).attr('id', champ + index + '-' + ind + '-0');
                tabb[i] = champ + index + '-' + ind + '-0';
                i = Number(i) + 1;
                // data[Ligneordrefab][0][Phaseordrefabrication][1][personnel_id]
                $(this).attr('name', ' data[premierefiche][' + index + '][deuxiemefiche][' + ind +
                    '][troisemefiche][0][' + champ + ']');
                $(this).attr('data-bv-field', 'data[premierefiche][' + index + '][deuxiemefiche][' + ind +
                    '][troisemefiche][0][' + champ + ']');
            }
            if (champ == 'addtableaalignefiche') {
                $(this).attr('indexligneligne', 0);
                $(this).attr('indexligne', 0);
                $(this).attr('index', ind);
                $(this).attr('id', champ + index + '-' + ind);
                tabb[i] = champ + index + '-' + ind + '-0';
                i = Number(i) + 1;
            }


            if (champ == 'qte') {
                $(this).attr('indexligneligne', 0);
                $(this).attr('indexligne', ind); //alert($(this).attr('indexligne'));
                $(this).attr('index', index);
                // alert(champ+'champ')
                // alert(index+'index')
                //alert(ind+'ind')

                $(this).attr('id', champ + index + '-' + ind + '-0');
                tabb[i] = champ + index + '-' + ind + '-0';
                i = Number(i) + 1;
                // data[Ligneordrefab][0][Phaseordrefabrication][1][personnel_id]
                $(this).attr('name', ' data[premierefiche][' + index + '][deuxiemefiche][' + ind +
                    '][troisemefiche][0][' + champ + ']'); //alert($(this).attr('name'));
                $(this).attr('data-bv-field', 'data[premierefiche][' + index + '][deuxiemefiche][' + ind +
                    '][troisemefiche][0][' + champ + ']');
            }
            if (champ == 'coeff') {
                $(this).attr('indexligneligne', 0);
                $(this).attr('indexligne', ind); //alert($(this).attr('indexligne'));
                $(this).attr('index', index);
                // alert(champ+'champ')
                // alert(index+'index')
                //alert(ind+'ind')

                $(this).attr('id', champ + index + '-' + ind + '-0');
                tabb[i] = champ + index + '-' + ind + '-0';
                i = Number(i) + 1;
                // data[Ligneordrefab][0][Phaseordrefabrication][1][personnel_id]
                $(this).attr('name', ' data[premierefiche][' + index + '][deuxiemefiche][' + ind +
                    '][troisemefiche][0][' + champ + ']'); //alert($(this).attr('name'));
                $(this).attr('data-bv-field', 'data[premierefiche][' + index + '][deuxiemefiche][' + ind +
                    '][troisemefiche][0][' + champ + ']');
            }
            if (champ == 'unite_id') {
                $(this).attr('indexligneligne', 0);
                $(this).attr('indexligne', ind); //alert($(this).attr('indexligne'));
                $(this).attr('index', index);
                // alert(champ+'champ')
                // alert(index+'index')
                //alert(ind+'ind')

                $(this).attr('id', champ + index + '-' + ind + '-0');
                tabb[i] = champ + index + '-' + ind + '-0';
                i = Number(i) + 1;
                // data[Ligneordrefab][0][Phaseordrefabrication][1][personnel_id]
                $(this).attr('name', ' data[premierefiche][' + index + '][deuxiemefiche][' + ind +
                    '][troisemefiche][0][' + champ + ']'); //alert($(this).attr('name'));
                $(this).attr('data-bv-field', 'data[premierefiche][' + index +
                    '][deuxiemefiche][' + ind +
                    '][troisemefiche][0][' + champ + ']');
            }
            if (champ == 'article_idd') {
                $(this).attr('indexligneligne', 0);
                $(this).attr('indexligne', ind); //alert($(this).attr('indexligne'));
                $(this).attr('index', index);
                // alert(champ+'champ')
                // alert(index+'index')
                //alert(ind+'ind')

                $(this).attr('id', champ + index + '-' + ind + '-0');
                tabb[i] = champ + index + '-' + ind + '-0';
                i = Number(i) + 1;
                // data[Ligneordrefab][0][Phaseordrefabrication][1][personnel_id]
                $(this).attr('name', ' data[premierefiche][' + index + '][deuxiemefiche][' + ind +
                    '][troisemefiche][0][' + champ + ']'); //alert($(this).attr('name'));
                $(this).attr('data-bv-field', 'data[premierefiche][' + index + '][deuxiemefiche][' + ind +
                    '][troisemefiche][0][' + champ + ']');
            }


            if ($(this).hasClass('supordd')) {
                //alert('afefefef')
                // tabletype='addtablea' index ='' indexlignetype='indexa' trtype="tra"
                $(this).attr('indexligne', ind);
                $(this).attr('index', index);
            }



            if (champ == 'suppmm') {
                $(this).attr('indexligneligne', 0);
                $(this).attr('indexligne', ind);
                $(this).attr('index', index);


                $(this).attr('id', champ + index + '-' + ind + '-0');
                tabb[i] = champ + index + '-' + ind + '-0';
                i = Number(i) + 1;
                // data[Ligneordrefab][0][Phaseordrefabrication][1][personnel_id]
                $(this).attr('name', ' data[premierefiche][' + index + '][deuxiemefiche][' + ind +
                    '][troisemefiche][0][' + champ + ']');
                $(this).attr('data-bv-field', 'data[premierefiche][' + index +
                    '][deuxiemefiche][' + ind +
                    '][troisemefiche][0][' + champ + ']');
            }
            if ($(this).hasClass('suppf')) {
                //alert('ind')
                //alert('afefefef')
                // tabletype='addtablea' index ='' indexlignetype='indexa' trtype="tra"
                $(this).attr('indexligneligne', 0);
                $(this).attr('indexligne', ind);
                $(this).attr('index', index);
            }

            //            $(this).removeClass('anc');
            //            if ($(this).is('select')) {
            //                tabb[i] = champ + ind;
            //                // alert(tabb[i]);
            //                i = Number(i) + 1;
            //            }
            //alert($(this).hasClass('ajouterligne1ligne'))
            /////////////////////////////////////////
            if ($(this).hasClass('ajouterligne1lignefiche')) {
                tabletypeligne = $(this).attr('tabletypeligne'); //alert(tabletypeligne+"tabletypeligne")
                indexlignetypeligne = $(this).attr(
                    'indexlignetypeligne'); //alert(indexlignetypeligne+"tabletypeligne")

                trtypeligne = $(this).attr('trtypeligne'); //alert(trtypeligne+"trtypeligne")
                // tabletype='addtablea' index ='' indexlignetype='indexa' trtype="tra"
                $(this).attr('table', tabletypeligne + index + '-' + ind);
                $(this).attr('indexligneligne', indexlignetypeligne + index + '-' + ind);
                $(this).attr('tr', trtypeligne + index + '-' + ind);

            }

            if (champ == 'indexalignefiche') {
                // if ($(this).hasClass('indexaligne')) {
                indextypeligne = $(this).attr('indexligneligne');
                //alert(indextypeligne+'jjjjjjj')
                $(this).attr('id', champ + index + '-' + ind);
            }
            //alert(champ)
            if ($(this).hasClass('traalignefiche')) {
                $(this).attr('id', 'traalignefiche' + index + '-' + ind);
                // $(this).attr('style','display:none;');
            }
            // alert($(this).hasClass)
            if ($(this).hasClass('traaalignefiche')) {

                $(this).attr('id', 'traaalignefiche' + index + '-' + ind);
                $(this).attr('class', 'traaalignefiche' + index + '-' + ind);
                // $("#traaaligne"+index+'-'+ind).parent().hide();
                //  $("#traaaligne" +index+'-'+ind).parent().hide();
                $(this).attr('style', "display:none;important");
            }
            /////////////////////////////////

            /////////////////
            //              if ($(this).hasClass('traaa')) {
            //                
            //                 $(this).attr('class','traaa'+ind);
            //                 $(this).attr('id','traaa'+ind);
            //             }
            //  $(this).val('');
        })
        $ttr.find('i').each(function () {
            $(this).attr('index', ind);
        });
        $ttr.attr('style', '');
        $('#' + table).append($ttr);
        $('#' + index).val(ind);
        index = $(this).attr('index'); //alert(index)
        indexligne = $(this).attr('indexligne');
        $('#' + table).find('tr:last').show();
        // alert(index)
        //  alert(ind)
        //   console.log("#article_id" +index+'-'+'0')
        //           $('select').select2({
        //            width: '100%' // need to override the changed default
        //        });addClass('sirine');

        $("#article_idt" + index + '-' + ind).
            select2({
                width: '100%' // need to override the changed default
            });


        $("#unite_id" + index + '-' + ind).
            select2({
                width: '100%' // need to override the changed default
            });
        sup33(index, ind)
        //  $("#article_idd" +index+'-'+ind+'-0').
        //                select2({
        //            width: '100%' // need to override the changed default
        //        });
        // for (j = 0; j <= i; j++) {
        //  uniform_select(tabb[j]);
        //     }
        // alert('#date_debut'+ind);
        //                 $('#date_debut'+ind).datetimepicker({
        //        timepicker: false,
        //        datepicker:true,
        //        mask:'39/19/9999',
        //        format:'d/m/Y'});
        //        for (k 
        //        = 0; k <= vc; k++) {
        //            // alert(tabd[k])
        //            $('#' + tabd[k]).datetimepicker({
        //                timepicker: false,
        //                datepicker: true,
        //                mask: '39/19/9999',
        //                format: 'd/m/Y'});
        //        }
    });


    $('.suporaa').on('click', function () {
        index = $(this).attr('index'); //alert(index);
        indexligne = $(this).attr('indexligne'); //alert(indexligne);
        //ind = $(this).attr('index');//alert(ind+'ind')
        //            if (ind == index) {
        $(this).parent().parent().hide();
        $('#supa' + index).val(1);

        $("#traafiche" + index).parent().hide();
        //$("#tra" +index).parent().hide();
        $("#traaafiche" + index).parent().hide();
        $("#afeffiche" + index).parent().hide();
        //            }

    })




    ///////// ajout ligne 3 //////////////////
    $(".ajouterligne1lignefichee").on('click', function () {
        table = $(this).attr('table'); //alert(table+" table");
        index = $(this).attr('indexligneligne');



        itd = $(this).attr('index');
        itd1 = $(this).attr('indexligne');

        $('#tdcompp').show();
        $('#tdcompp' + itd + '-' + itd1).show();


        tr = $(this).attr('tr'); //alert(tr+" tr") ;    

        ind = Number($('#' + index).val()) + 1; //alert(ind+" ind");
        $('#' + index).val(ind);

        $ttr = $('#' + table).find('.' + tr).clone(true); //alert(tr)
        //     $ttr = $('#traaligne1-0' ).find('.traaaligne').clone(true);console.log($ttr);
        $ttr.attr('class', '');
        i = 0; //alert(i)
        tabb = []; //alert(tabb)
        vc = 0;
        tabd = [];
        //  alert( $ttr.find())
        $ttr.find('input,select,div,td,textarea,a,tr,table,i').each(function () {


            tab = $(this).attr('table'); //alert(tab+"tab")
            champ = $(this).attr('champ'); // alert(champ+"champ")
            tableligneligne = $(this).attr('tableligneligne'); //alert(tableligneligne+"tableligneligne")
            tableligne = $(this).attr('tableligne'); //alert(tableligne+"tableligne")
            index = $(this).attr('index'); //alert(index)
            indexligne = $(this).attr('indexligne');
            //alert(indexligne+"indexligne")
            indexligneligne = $(this).attr('indexligneligne');
            if (champ == 'article_idd') {
                //              alert(index+'index');
                //              alert(ind+'indexligne');
            }
            //alert('index'+index);alert('tableligne'+tableligne)
            $(this).attr('indexligneligne', ind);
            $(this).attr('id', champ + index + '-' + indexligne + '-' + ind);
            $(this).attr('name', 'data[' + tab + '][' + index + '][' + tableligne + '][' + indexligne +
                '][' + tableligneligne + '][' + ind + '][' + champ + ']');
            $(this).attr('data-bv-field', 'data[' + tab + '][' + index + '][' + tableligne + '][' +
                indexligne + '][' + tableligneligne + '][' + ind + '][' + champ + ']');
            $(this).removeClass('anc');
            if ($(this).is('select')) {

                tabb[i] = champ + index + '-' + indexligne + '-' + ind;
                // alert(tabb[i]);
                i = Number(i) + 1;

            }

            // alert($(this).attr('class'));

            //  $(this).val('');
        })
        index = $(this).attr('index'); //alert(index);
        indexligne = $(this).attr('indexligne'); //alert(indexligne);
        ///  alert(indexligne)
        $ttr.find('i').each(function () {
            $(this).attr('index', index);
        });
        $ttr.find('i').each(function () {

            $(this).attr('indexligne', indexligne);
            $(this).attr('indexligneligne', ind);
            //alert(indexligne);
        });

        //   $("#article_idd" +index+'-'+indexligne+'-'+ ind).data('select2').destroy();

        $ttr.attr('style', '');
        $('#' + table).append($ttr);
        $('#' + index).val(ind);
        $('#' + table).find('tr:last').show();

        index = $(this).attr('index'); //alert(index+'index');
        indexligne = Number($('#indexafiche' + index).val()); //alert(indexligne+'indexligne');


        $ttr.find('i').each(function () {
            $(this).attr('indexligneligne', ind);
        });
        index = Number($('#index').val()); //alert(index+'index');
        indexligne = Number($('#indexafiche' + index).val());

        $("#article_idd" + index + '-' + indexligne + '-' + ind).select2({
            width: '100%' // need to override the changed default
        })


        $("#unite_id" + index + '-' + indexligne + '-' + ind).select2({
            width: '100%' // need to override the changed default
        })

        $ttr.attr('style', '');
        $('#' + table).append($ttr);

        for (j = 0; j <= i; j++) {
            // uniform_select(tabb[j]);
            // uniform_select(tabd[j]);      
        }

    });


    ////////////////////////////////////////: supp 2 //////////////

    $('.supordde').on('click', function () {
        // alert('hechem')
        index = $(this).attr('index');
        /// alert('index '+index);
        indexligne = $(this).attr('indexligne');
        //alert('indexligne '+indexligne);
        $('.supordd').each(function () {
            id = $(this).attr('index');
            // console.log('id'+ind)
            ind = $(this).attr('indexligne');
            /// console.log('ind'+ind)
            if (ind == indexligne) {
                if (id == index) {
                    $(this).parent().parent().hide();
                    $('#suppdd' + index + '-' + indexligne).val(1);
                    //alert($('#supp2'+index+'-'+ind).val());
                    indexligneligne = $('#indexalignefiche' + index + '-' + indexligne).val();
                    //alert('indexligneligne '+indexligneligne)
                    for (j = 0; j <= indexligneligne; j++) {
                        //    alert();


                        $('#supp33' + index + '-' + ind + '-' + j).val(1);
                        $("#traaalignefiche" + id + '-' + ind).parent().hide();
                        $("#traalignefiche" + id).parent().hide();




                    }







                }
            }
        })
    });
    /////////////////////////////// supp 3 ////////////////////
    $('.suppfe').on('click', function () {
        index = $(this).attr('index');
        alert('index ' + index);
        indexligne = $(this).attr('indexligne');
        indexligneligne = $(this).attr('indexligneligne');
        alert('indexligne ' + indexligne);
        $('.suppf').each(function () {
            ind = $(this).attr('indexligneligne');
            inde = $(this).attr('indexligne');
            alert(inde);
            if (ind == indexligneligne) {
                if (inde == indexligne) {

                    // $(this).parent().parent().hide();
                    $('#suppf' + index + '-' + indexligne + '-' + indexligneligne).val(1);

                    $("#traaalignefiche" + index + '-' + indexligne + '-' + ind).parent().hide();
                    //$("#afefligne" + index).parent().hide();

                }
            }
        })



    })
    ///////////////////////////////////////::: suppp kbira //////////////////
    function sup333(index, indexligne) {

        indexligneligne = 0; //alert('indexligneligne '+indexligneligne);

        /// console.log(indexligne)

        $('.suppf').each(function () {
            ind = $(this).attr('indexligneligne');
            inde = $(this).attr('indexligne');
            // console.log('ind' , ind);
            // console.log('inde' , inde);
            if (ind == indexligneligne) {
                if (inde == indexligne) {

                    $(this).parent().parent().hide();
                    // $('#supp3'+index+'-'+indexligne+'-'+indexligneligne).val(1);

                    $("#traaalignefiche" + index + '-' + indexligne + '-' + ind).parent().hide();


                }
            }
        })

    }
</script>


<?php $this->end(); ?>