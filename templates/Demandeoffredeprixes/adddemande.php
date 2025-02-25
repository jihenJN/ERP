<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Demandeoffredeprix $demandeoffredeprix
 */
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('controle_frs'); ?>
<?php echo $this->Html->css('select2'); ?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Demande offre de prix
        <small><?php echo __(''); ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index', 'controller' => 'Besionachats']); ?>"><i class="fa fa-reply"></i>
                <?php echo __('Retour'); ?></a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <?php echo $this->Form->create($demandeoffredeprix, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13",]); ?>
        <div class="box-body">
            <div class="row">


                <div class="box-body">
                    <div class="col-xs-6">
                        <?php echo $this->Form->control('date', ['label' => 'Date', 'id' => 'date', 'class' => "form-control pull-right"]); ?>

                        <?php echo $this->Form->control('id', ["readonly" => true, 'value' => $firstbesoins->id, 'label' => 'id', 'empty' => true, 'id' => 'id', 'type' => 'hidden', 'class' => "form-control pull-right"]); ?>




                    </div>
                    <div class="col-xs-6">
                        <?php echo $this->Form->control('numero', ['readonly' => 'readonly', 'value' => $b]); ?> 
                    </div>

                    <div class="col-xs-6" hidden>
                            <?php
                            echo $this->Form->control('service_id', [
                                'label' => 'Service',
                                'value' => $firstbesoins->service_id,
                                'required' => 'off',
                                'empty' => 'Veuillez choisir!!!',
                                'class' => 'form-control select2 ',
                                'type' => 'select',
                                'options' => $services

                            ]);
                            ?>
                        </div>
                        <div class="col-xs-6" hidden>
                            <?php
                            echo $this->Form->control('machine_id', [
                                'label' => 'Machine',
                                'value' => $firstbesoins->machine_id,
                                'required' => 'off',
                                'empty' => 'Veuillez choisir!!!',
                                'class' => 'form-control select2 ',
                                'type' => 'select',
                                'options' => $machines

                            ]);
                            ?>
                        </div>

                        <div class="col-xs-6">
                                    <?php echo $this->Form->control('observation', ['label' => 'Commentaire', 'class' => 'form-control', 'type' => 'textarea']); ?>
                                </div>

                     

                </div>

                    <!-- /.box-body -->

                </div>
            </div>
            <section class="content-header">
                <h1 class="box-title"><?php echo __('Les articles'); ?></h1>
            </section>


            <section class="content" style="width: 99%">
                <div class="row">
                    <div class="box box-primary">

                        <div class="panel-body">
                            <div class="table-responsive ls-table">
                                <?php //if (!empty($demandeoffredeprix->lignedemandeoffredeprixes)): 
                                ?>
                                <table class="table table-bordered table-striped table-bottomless" id="tabligne0">
                                    <thead>
                                        <tr width:20px>
                                           
                                            <td align="center" style="width: 40%;"><strong>Nom du
                                                    article</strong></td>
                                            <td align="center" style="width: 40%;"><strong>Quantité</strong>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($lignes as $i => $ligners) :
                                            //  debug($ligners['desginationA']);
                                           // debug($ligners);
                                        ?>

                                            <tr style="">
                                                <td align="center" style="width:111px; opacity: 1; position: relative; left: 0px;">
                                                    <div id="" champ=''>
                                                        <?php echo $this->Form->input('sup0', array('name' => 'data[ligner][' . $i . '][sup0]', 'id' => 'sup0' . $i, 'champ' => 'sup0' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                        ?>
                                                        <?php echo $this->Form->input('id', array('value' => $ligners['id'], 'name' => 'data[ligner][' . $i . '][id]', 'id' => 'id' . $i, 'champ' => 'id' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                        ?>
                                                        <?php
                                                        if (!empty($ligners->article_id)) {
                                                        ?>

                                                            <div id="ar1<?php echo $i ?>" index="<?php echo $i ?>" champ='ar1' style="display:true">
                                                                <?php
                                                                echo $this->Form->control('article_id', array('label' =>false, 'value' => $ligners->article_id,'options'=>$articles, 'name' => 'data[ligner][' . $i . '][article_id]', 'id' => 'article_id' . $i, 'champ' => 'article_id' . $i, 'table' => 'ligner', 'index' => $i, 'class' => 'form-control select2 '));
                                                                ?>
                                                            </div>
                                                        <?php
                                                        } else {
                                                            echo $this->Form->control('designiationA', array('label' => '', 'value' => $ligners->desginationA, 'champ' => 'designiationA' . $i, 'name' => 'data[ligner][' . $i . '][designiationA]', 'id' => 'designiationA' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                        }
                                                        ?>
                                                        <?php // endforeach;  
                                                        ?>

                                                </td>
                                                <td align="center">
                                                    <?php echo $this->Form->input('qte', array('label' => '', 'value' => $ligners->total_qte, 'name' => 'data[ligner][' . $i . '][qte]', 'type' => 'text', 'id' => 'qte' . $i, 'table' => 'ligner', 'champ' => 'qte' . $i, 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control enr80')); ?>
                                                </td>

                                            </tr>
                                        <?php endforeach; ?>


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
                <h1 class="box-title">
                    <?php echo __('Fournisseurs'); ?>
                </h1>
            </section>

            <section class="content" style="width: 99%">
                <div class="row">
                    <div class="box">
                        <div class="box-header with-border">
                            <a class="btn btn-primary al" table='addtable' index='index1' id='ajouter_ligne14' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                                <i class="fa fa-plus-circle "></i> Ajouter fournisseur</a>

                        </div>
                        <div class="panel-body">
                            <div class="table-responsive ls-table">
                                <table class="table table-bordered table-striped table-bottomless" id="tabligne1">
                                    <thead>
                                        <tr width:20px">
                                            <td align="center" style="width: 50%;"><strong>Nom du
                                                    fournisseur</strong></td>

                                            <td align="center" style="width: 50%;"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="tr" style="display: none !important">


                                            <td align="center">
                                                <?php echo $this->Form->input('sup1', array('name' => '', 'id' => '', 'champ' => 'sup1', 'table' => 'lignef', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                ?>

                                                <div id="" champ='f1' index="" name="" table="lignef" class="col-md-10">
                                                    <?php echo $this->Form->control('a', array('label' => '', 'options' => $fournisseurs, 'name' => '', 'id' => 'id', 'champ' => 'fournisseur_id', 'table' => 'lignef', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'empty' => 'Veuillez Choisir !!')); ?>
                                                </div>


                                                <div id="" champ='f2' index="" name="" table="lignef" style="display: none !important" class="col-md-10">
                                                    <input table="lignef" type='text' id='id' name='' champ='fournisseur_idd' class='form-control ' class='input'>
                                                </div>
                                                <!-- <span title="ajout fournisseur"> <a href="javascript:;" class="btn btn-primary b2"><i class='fa fa fa-plus'></i></a></span> -->




                                            <td align="center">
                                                <i index="0" id="" class="fa fa-times supLigneFournisseur" style="color: #c9302c;font-size: 22px;"></i>
                                            </td>
                                        </tr>


                                        <input type="hidden" value="-1" id="index1">
                                    </tbody>
                                </table><br>
                            </div>
                        </div>
                    </div>
                </div>


            </section>



            <div align="center">
                <?= $this->Form->button('Enregistrer', ['type' => 'submit', 'id' => 'enr3', 'class' => 'btn btn-success']) ?>
            </div>

            <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
    </div>
    </div>
    </div>
    <!-- /.row -->
</section>

<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>

<script>
     $(function () {
      $('.select2').select2();
     })
</script>