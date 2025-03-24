<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Demandeoffredeprix $demandeoffredeprix
 */
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('controle_frs'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Consultation Demandeoffredeprix
        <small><?php echo __(''); ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index/' . $typeof]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">

        <div class="box-body">
            <div class="row">

                <?php echo $this->Form->create($demandeoffredeprix, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13",]); ?>
                <div class="box-body">
                    <div class="col-xs-6">
                        <?php echo $this->Form->control('date', ["readonly" => true, 'label' => 'Date', 'empty' => true, 'id' => 'date', 'class' => "form-control pull-right"]); ?>

                        <?php echo $this->Form->control('id', ["readonly" => true, 'label' => 'id', 'empty' => true, 'id' => 'id', 'type' => 'hidden', 'class' => "form-control pull-right"]); ?>




                    </div>
                    <div class="col-xs-6">
                        <?php echo $this->Form->control('numero', ['readonly' => 'readonly']); ?>

                    </div>

                    <div class="col-xs-6">
                        <?php echo $this->Form->control('observation', ['label' => 'Commentaire', 'class' => 'form-control', 'type' => 'textarea']); ?>
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

                            </div>
                            <div class="panel-body">
                                <div class="table-responsive ls-table">
                                    <?php //if (!empty($demandeoffredeprix->lignedemandeoffredeprixes)): 
                                    ?>
                                    <table class="table table-bordered table-striped table-bottomless" id="tabligne0">
                                        <thead>
                                            <tr width:20px>
                                                <!--                                                  <td align="center" style="width: 5%;" type="hidden" ><strong></strong></td>-->
                                                <td align="center" style="width: 40%;"><strong>Nom du article</strong></td>
                                                <td align="center" style="width: 40%;"><strong>Quantité</strong></td>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($ligneas as $i => $lignea) :
                                                //                                                    debug($ligneas);
                                            ?>
                                                <tr style="">
                                                    <td align="center" style="width:111px; opacity: 1; position: relative; left: 0px;">
                                                        <div id="" champ=''>
                                                            <?php echo $this->Form->input('sup0', array('name' => 'data[lignea][' . $i . '][sup0]', 'id' => 'sup0' . $i, 'champ' => 'sup0' . $i, 'table' => 'lignea', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                            ?>
                                                            <?php echo $this->Form->input('id', array('value' => $lignea->id, 'name' => 'data[lignea][' . $i . '][id]', 'id' => 'id' . $i, 'champ' => 'id' . $i, 'table' => 'lignea', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                            ?>
                                                            <?php
                                                            if (!empty($lignea['article_id'])) {
                                                            ?>
                                                                <div id="ar1<?php echo $i ?>" index="<?php echo $i ?>" champ='ar1' style="display:true">
                                                                    <?php
                                                                    echo $this->Form->input('article_id', array('label' => '', 'value' => $lignea->article_id, 'name' => 'data[lignea][' . $i . '][article_id]', 'id' => 'article_id' . $i, 'champ' => 'article_id' . $i, 'table' => 'lignea', 'index' => $i, 'class' => 'form-control select2 '));
                                                                    //echo $this->Form->input('article_idd', array('label' => '', 'value' => '', 'name' => 'data[lignea][' . $i . '][article_idd]', 'id' => 'article_idd', 'champ' => 'article_idd' . $i, 'table' => 'lignea', 'index' => $i, 'type' => 'hidden', 'class' => 'form-control select2 '));
                                                                    ?>


                                                                </div>

                                                            <?php
                                                            } else {
                                                                echo $this->Form->control('designiationA', array('label' => '', 'value' => $lignea['designiationA'], 'champ' => 'designiationA' . $i, 'name' => 'data[lignea][' . $i . '][designiationA]', 'id' => 'designiationA' . $i, 'table' => 'lignea', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                            }
                                                            ?>

                                                            <?php // endforeach;  
                                                            ?>

                                                    </td>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('qte', array('label' => '', 'value' => $lignea->qte, 'name' => 'data[lignea][' . $i . '][qte]', 'type' => 'text', 'id' => 'qte' . $i, 'table' => 'lignea', 'champ' => 'qte' . $i, 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control enr80')); ?>
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
                    <h1 class="box-title"><?php echo __('Fournisseurs'); ?></h1>
                </section>
                <section class="content" style="width: 99%">
                    <div class="row">
                        <div class="box box-primary">
                            <div class="box-header with-border">

                            </div>
                            <div class="panel-body">
                                <div class="table-responsive ls-table">
                                    <table class="table table-bordered table-striped table-bottomless" id="tabligne11">
                                        <thead>
                                            <tr width:20px>
                                                <td align="center" style="width: 50%;"><strong>Nom du fournisseur</strong></td>

                                            </tr>
                                        </thead>
                                        <?php
                                        foreach ($lignefs as $j => $lignefs) :
                                            //                                                debug($lignefs);
                                        ?>
                                            <tbody>
                                                <tr class="" style="">
                                                    <td align="center" style="width:111px; opacity: 1; position: relative; left: 0px;">
                                                        <?php echo $this->Form->input('sup1', array('name' => 'data[lignef][' . $j . '][sup1]', 'id' => 'sup1' . $j, 'champ' => 'sup1' . $j, 'table' => 'lignef', 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                                                        <?php echo $this->Form->input('id', array('value' => $lignefs->id, 'name' => 'data[lignef][' . $j . '][id]', 'id' => '', 'champ' => 'id' . $j, 'table' => 'lignef', 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                                                        <?php
                                                        if (!empty($lignefs['fournisseur_id'])) {
                                                        ?>
                                                            <div id="f1<?php echo $j ?>" index="<?php echo $j ?>" champ='f1' style="display:true">
                                                                <?php echo $this->Form->control('fournisseur_id', array('label' => '', 'options' => $fournisseurs, 'value' => $lignefs->fournisseur_id, 'champ' => 'fournisseur_id' . $j, 'name' => 'data[lignef][' . $j . '][fournisseur_id]', 'id' => 'fournisseur_id' . $j, 'table' => 'lignef', 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                            </div>

                                                        <?php
                                                        } else {
                                                            echo $this->Form->control('nameF', array('champ' => 'nameF' . $j, 'type' => 'text', 'label' => '', 'value' => $lignefs->nameF, 'name' => 'data[lignef][' . $j . '][nameF]', 'id' => 'nameF' . $j, 'table' => 'lignef', 'index' => $j, 'class' => 'form-control select2 '));
                                                        }
                                                        ?>
                                                    </td>

                                                </tr>
                                            <?php endforeach; ?>






                                            </tbody>
                                    </table><br>
                                </div>
                            </div>
                        </div>
                    </div>


                </section>




































                <?php echo $this->Form->end(); ?>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
</section>

<script>
    $(document).ready(function() {
        // Disable all input and select elements
        $('input, select , textarea').prop('disabled', true);
    });
</script>