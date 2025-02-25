<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Commandeclient $commandeclient
 * @var string[]|\Cake\Collection\CollectionInterface $clients
 * @var string[]|\Cake\Collection\CollectionInterface $pointdeventes
 * @var string[]|\Cake\Collection\CollectionInterface $depots
 * @var string[]|\Cake\Collection\CollectionInterface $cartecarburants
 * @var string[]|\Cake\Collection\CollectionInterface $materieltransports
 * @var string[]|\Cake\Collection\CollectionInterface $bonlivraisons
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<section class="content-header">
    <h1>
        Commande Client
        <small><?php echo __(''); ?></small>
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
                <?php echo $this->Form->create($commandeclient, ['role' => 'form']); ?>
                <div class="box-body">
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('code', ['disabled']);
                        ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('client_id', ['options' => $clients]);
                        ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('date');
                        ?>

                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('pointdevente_id', ['options' => $pointdeventes]);
                        ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('depot_id', ['options' => $depots]);
                        ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('numero réference');
                        ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('commentaire');
                        ?>

                    </div>
                    <!-- /.box -->
                    <div class="col-md-12">
                        <section class="content-header">
                            <h1 class="box-title"><?php echo __('Ligne commande client'); ?></h1>
                        </section>
                        <section class="content" style="width: 99%">
                            <div class="row">
                                <div class="box">
                                    <div class="box-header with-border">
                                        <a class="btn btn-primary  " table='addtable' index='index3' id='ajouter_ligne33' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                                            <i class="fa fa-plus-circle "></i> ajouter Ligne commande client</a>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive ls-table">
                                            <table class="table table-bordered table-striped table-bottomless" id="tabligne3">
                                                <thead>
                                                    <tr width:20px>
                                                        <td align="center" nowrap="nowrap"><strong>Article</strong></td>
                                                        <td align="center" nowrap="nowrap"><strong>Quantité stock</strong></td>
                                                        <td align="center" nowrap="nowrap"><strong>quantite</strong></td>
                                                        <td align="center" nowrap="nowrap"><strong>prixht</strong></td>
                                                        <td align="center" nowrap="nowrap"><strong>Remise</strong></td>
                                                        <td align="center" nowrap="nowrap"><strong>PUNHT</strong></td>
                                                        <td align="center" nowrap="nowrap"><strong>Tva</strong></td>
                                                        <td align="center" nowrap="nowrap"><strong>Fodec</strong></td>
                                                        <td align="center" nowrap="nowrap"><strong>Ttc</strong></td>

                                                        <td align="center" nowrap="nowrap"></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class='tr' style="display: none !important">
                                                        <td style="width: 8%;" align="center">
                                                            <?php echo $this->Form->input('sup0', array('name' => '', 'id' => '', 'champ' => 'sup0', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                            ?>
                                                            <?php echo $this->Form->input('id', array('champ' => 'article_id', 'label' => '', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                            <?php echo $this->Form->input('article_id', array('champ' => 'article_id', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixarticle Testdep getprixht single')); ?>


                                                        </td>
                                                        <td align="center">

                                                            <?php echo $this->Form->input('qtestock', array('champ' => 'qtestock', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht getprixarticle')); ?>
                                                        </td>
                                                        <td align="center">

                                                            <?php echo $this->Form->input('qte', array('champ' => 'qte', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht ')); ?>
                                                        </td>
                                                        <td align="center">

                                                            <?php echo $this->Form->input('prixht', array('champ' => 'prixht', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht getprixarticle')); ?>
                                                        </td>
                                                        <td align="center">

                                                            <?php echo $this->Form->input('remise', array('champ' => 'remise', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht ')); ?>
                                                        </td>
                                                        <td align="center">

                                                            <?php echo $this->Form->input('punht', array('champ' => 'punht', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht ')); ?>
                                                        </td>
                                                        <td align="center">

                                                            <?php echo $this->Form->input('tva', array('champ' => 'tva', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht ')); ?>
                                                        </td>
                                                        <td align="center">

                                                            <?php echo $this->Form->input('fodec', array('champ' => 'fodec', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht ')); ?>
                                                        </td>
                                                        <td align="center">

                                                            <?php echo $this->Form->input('ttc', array('champ' => 'ttc', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht ')); ?>
                                                        </td>
                                                        <td align="center"><i index="" id="" class="fa fa-times supLigne" style="color: #C9302C;font-size: 22px;"></td>
                                                    </tr>
                                                    <?php 
                                                    //debug($lignecommandeclients);die;
                                                    $i=-1;
                                                    foreach ($lignecommandeclients as $res) : 
                                                    $i++;
                                                    ?> 
                                                    
                                                    <tr >
                                                        <td style="width: 15%;" align="center">

                                                            <?php
                                                            echo $this->Form->input('sup0', array('name' => 'data[lignecommandeclients][' . $i . '][sup0]', 'id' => 'sup0' . $i, 'champ' => 'sup0', 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                            echo $this->Form->input('id', array('label' => '', 'value' => $res->id, 'name' => 'data[lignecommandeclients][' . $i . '][id]', 'type' => 'hidden', 'id' => 'id' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); 
                                                            echo $this->Form->control('article_id', ['options' => $articles,'value'=>$res->article_id,'name' => 'data[lignecommandeclients][' . $i . '][article_id]', 'empty' => true, 'label' => '', 'table' => 'lignecommandeclients', 'champ' => 'article_id', 'class' => 'form-control select getprixarticle Testdep getprixht single']); ?>

                                                        </td>
                                                        <td style="width: 10%;" align="center">
                                                            <?php echo $this->Form->input('qtestock', array('label' => '', 'value' => $res->qtestock, 'name' => 'data[lignecommandeclients][' . $i . '][qtestock]', 'type' => 'text', 'id' => 'qtestock' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht getprixarticle')); ?>
                                                        </td>
                                                        <td style="width: 8%;" align="center">
                                                        <?php echo $this->Form->input('qte', array('label' => '', 'value' => $res->qte, 'name' => 'data[lignecommandeclients][' . $i . '][qte]', 'type' => 'text', 'id' => 'qte' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht ')); ?>
                                                        </td>
                                                        <td style="width: 8%;" align="center">
                                                        <?php echo $this->Form->input('prixht', array('label' => '', 'value' => $res->prixht, 'name' => 'data[lignecommandeclients][' . $i . '][prixht]', 'type' => 'text', 'id' => 'prixht' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht getprixarticle')); ?>
                                                        </td>
                                                        <td style="width: 8%;" align="center">
                                                        <?php echo $this->Form->input('remise', array('label' => '', 'value' => $res->remise, 'name' => 'data[lignecommandeclients][' . $i . '][remise]', 'type' => 'text', 'id' => 'remise' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht ')); ?>
                                                        </td>
                                                        <td style="width: 8%;" align="center">
                                                        <?php echo $this->Form->input('punht', array('label' => '', 'value' => $res->punht, 'name' => 'data[lignecommandeclients][' . $i . '][punht]', 'type' => 'text', 'id' => 'punht' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht ')); ?>
                                                        </td>
                                                        <td style="width: 10%;" align="center">
                                                        <?php echo $this->Form->input('tva', array('label' => '', 'value' => $res->tva, 'name' => 'data[lignecommandeclients][' . $i . '][tva]', 'type' => 'text', 'id' => 'tva' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht ')); ?>
                                                        </td>
                                                        <td style="width: 12%;" align="center">
                                                        <?php echo $this->Form->input('fodec', array('label' => '', 'value' => $res->fodec, 'name' => 'data[lignecommandeclients][' . $i . '][fodec]', 'type' => 'text', 'id' => 'fodec' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht ')); ?>
                                                        </td>
                                                        <td style="width: 12%;" align="center">
                                                        <?php echo $this->Form->input('ttc', array('label' => '', 'value' => $res->ttc, 'name' => 'data[lignecommandeclients][' . $i . '][ttc]', 'type' => 'text', 'id' => 'ttc' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht ')); ?>
                                                        </td>
                                                        <td style="width: 5%;" align="center"><i class="fa fa-times supLigne" style="color: #C9302C;font-size: 22px;"></td>

                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table><br>
                                            <input type="hidden" value="<?php echo $i ?>" id="index3">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </section>
                    </div>

                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('totalht'); ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('totaltva'); ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('totalfodec'); ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('totalremise'); ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('totalttc'); ?>
                    </div>
                    <button type="submit" class="pull-right btn btn-success btn-sm" id="pointv" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>

        </div>

    </div>

</section>

</div>


<!-- /.row -->

</section>


<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<!-- DataTables -->
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<?php $this->end(); ?>
<script>
   
</script>
