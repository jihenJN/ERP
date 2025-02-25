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
                        echo $this->Form->control('client_id', ['options' => $clients,'disabled']);
                        ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('date', ['disabled']);
                        ?>

                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('pointdevente_id', ['options' => $pointdeventes,'disabled']);
                        ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('depot_id', ['options' => $depots,'disabled']);
                        ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('numero réference', ['disabled']);
                        ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('commentaire', ['disabled']);
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
                                                    
                                                    <?php 
                                                    //debug($lignecommandeclients);die;
                                                    foreach ($lignecommandeclients as $i => $res) : 
                                                    ?> 
                                                    
                                                    <tr class="tr">
                                                        <td style="width: 15%;" align="center">

                                                            <?php
                                                            echo $this->Form->input('sup0', array('name' => 'data[lignecommandeclients][' . $i . '][sup0]', 'id' => 'sup0' . $i, 'champ' => 'sup0', 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                           // echo $this->Form->input('id', array('label' => '', 'value' => $res->id, 'name' => 'data[lignecommandeclients][' . $i . '][id]', 'type' => 'hidden', 'id' => 'id' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); 
                                                            echo $this->Form->control('article_id', ['options' => $articles,'value'=>$res->article_id,'name' => 'data[lignecommandeclients][' . $i . '][article_id]', 'empty' => true, 'label' => '', 'table' => 'lignecommandeclients', 'champ' => 'article_id', 'class' => 'form-control select getprixarticle Testdep single','disabled']); ?>

                                                        </td>
                                                        <td style="width: 10%;" align="center">
                                                            <?php echo $this->Form->input('qtestock', array('label' => '', 'value' => $res->qtestock, 'name' => 'data[lignecommandeclients][' . $i . '][qtestock]', 'type' => 'text', 'id' => 'qtestock' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ','disabled')); ?>
                                                        </td>
                                                        <td style="width: 8%;" align="center">
                                                        <?php echo $this->Form->input('qte', array('label' => '', 'value' => $res->qte, 'name' => 'data[lignecommandeclients][' . $i . '][qte]', 'type' => 'text', 'id' => 'qte' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ','disabled')); ?>
                                                        </td>
                                                        <td style="width: 8%;" align="center">
                                                        <?php echo $this->Form->input('prixht', array('label' => '', 'value' => $res->prixht, 'name' => 'data[lignecommandeclients][' . $i . '][prixht]', 'type' => 'text', 'id' => 'prixht' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ','disabled')); ?>
                                                        </td>
                                                        <td style="width: 8%;" align="center">
                                                        <?php echo $this->Form->input('remise', array('label' => '', 'value' => $res->remise, 'name' => 'data[lignecommandeclients][' . $i . '][remise]', 'type' => 'text', 'id' => 'remise' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ','disabled')); ?>
                                                        </td>
                                                        <td style="width: 8%;" align="center">
                                                        <?php echo $this->Form->input('punht', array('label' => '', 'value' => $res->punht, 'name' => 'data[lignecommandeclients][' . $i . '][punht]', 'type' => 'text', 'id' => 'punht' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ','disabled')); ?>
                                                        </td>
                                                        <td style="width: 10%;" align="center">
                                                        <?php echo $this->Form->input('tva', array('label' => '', 'value' => $res->tva, 'name' => 'data[lignecommandeclients][' . $i . '][tva]', 'type' => 'text', 'id' => 'tva' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ','disabled')); ?>
                                                        </td>
                                                        <td style="width: 12%;" align="center">
                                                        <?php echo $this->Form->input('fodec', array('label' => '', 'value' => $res->fodec, 'name' => 'data[lignecommandeclients][' . $i . '][fodec]', 'type' => 'text', 'id' => 'fodec' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ','disabled')); ?>
                                                        </td>
                                                        <td style="width: 12%;" align="center">
                                                        <?php echo $this->Form->input('ttc', array('label' => '', 'value' => $res->ttc, 'name' => 'data[lignecommandeclients][' . $i . '][ttc]', 'type' => 'text', 'id' => 'ttc' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ','disabled')); ?>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table><br>
                                            <input type="hidden" value="<?php echo $i ?>" id="index0">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </section>
                    </div>

                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('totalht', ['disabled']); ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('totaltva', ['disabled']); ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('totalfodec', ['disabled']); ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('totalremise', ['disabled']); ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('totalttc', ['disabled']); ?>
                    </div>
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
    function ajouter_ligne(table, index) {
        ind = Number($('#' + index).val()) + 1;

        $ttr = $('#' + table).find('.tr').clone(true);
        $ttr.attr('class', '');
        i = 0;
        tabb = [];
        $ttr.find('input,select,textarea,tr,td,div').each(function() {
            tab = $(this).attr('table'); //alert(tab)
            champ = $(this).attr('champ');
            $(this).attr('index', ind);
            $(this).attr('id', champ + ind);
            $(this).attr('name', 'data[' + tab + '][' + ind + '][' + champ + ']');
            $(this).attr('data-bv-field', 'data[' + tab + '][' + ind + '][' + champ + ']');
            $type = $(this).attr('type');
            $(this).val('');
            if ($type == 'radio') {
                $(this).attr('name', 'data[' + champ + ']');
                //$(this).attr('value',ind);
                $(this).val(ind);
            }
            if ((champ == 'datedebut') || (champ == 'datefin')) {
                $(this).attr('onblur', 'nbrjour(' + ind + ')')
            }

            $(this).removeClass('anc');
            if ($(this).is('select')) {
                tabb[i] = champ + ind;
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
        for (j = 0; j <= i; j++) {
            //  uniform_select(tabb[j]);
        }
        /*$('#datedebut'+ind).datetimepicker({
    timepicker: false,
    datepicker:true,
    mask:'39/19/9999',
    format:'d/m/Y'});
   $('#datefin'+ind).datetimepicker({
    timepicker: false,
    datepicker:true,
    mask:'39/19/9999',
    format:'d/m/Y'});
$('#date'+ind).datetimepicker({
    timepicker: false,
    datepicker:true,
    mask:'39/19/9999',
    format:'d/m/Y'});
           
   */
    }
</script>
