<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Commande $commande
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('controle_frs'); ?>
<?php echo $this->Html->css('select2'); ?>

<section class="content-header">
    <h1>
        Modification Commande Achat
        <small><?php echo __(''); ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index/' . $type]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo __(''); ?></h3>
                </div>

                <?php echo $this->Form->create($commande, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]);
                //debug($commande);
                ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('numero', ['readonly' => 'readonly']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('date', ['readonly' => 'readonly', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control']); ?>



                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('fournisseur_id', ['disabled' => 'true', 'class' => 'select2 form-control']); ?>
                        </div>

                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('depot_id', ['disabled' => 'true', 'class' => 'select2 form-control']); ?>
                        </div>

                        <div class="col-xs-6" hidden>
                            <?php
                            echo $this->Form->control('service_id', [
                                'label' => 'Service',
                                'required' => 'off',
                                'empty' => 'Veuillez choisir!!!',
                                'class' => 'form-control select2 ',
                                'style' => 'text-align:right',
                                'type' => 'select',
                                'options' => $services,
                                'disabled' => true

                            ]);
                            ?>
                        </div>
                        <div class="col-xs-6" hidden>
                            <?php
                            echo $this->Form->control('machine_id', [
                                'label' => 'Machine',
                                'required' => 'off',
                                'empty' => 'Veuillez choisir!!!',
                                'class' => 'form-control select2 ',
                                'type' => 'select',
                                'options' => $machines,
                                'disabled' => true

                            ]);
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('observation', ['readonly', 'label' => 'Commentaire', 'class' => 'form-control', 'type' => 'textarea']); ?>
                        </div>
                    </div>
                    <section class="content-header">
                        <h1 class="box-title"><?php echo __('Les articles commandées'); ?></h1>
                    </section>



                    <section class="content" style="width: 99%">
                        <div class="row">
                            <div class="box box-primary">
                                <div class="box-header with-border">



                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive ls-table">
                                        <table class="table table-bordered table-striped table-bottomless" id="tabligne0">
                                            <thead>
                                                <tr>   
                                                    <td align="center" style="width: 15%;"><strong>Code</strong> </td>
                                                    <td align="center" style="width: 25%;"><strong>Designation</strong> </td>
                                                    <td align="center" style="width: 6%;"><strong> Qté</strong></td>
        
                                                    <td align="center" style="width: 10%;"><strong>PrixHt</strong></td>
                                                    <td align="center" style="width: 10%;"><strong>PUNHT</strong></td>
                                                    <td align="center" style="width: 5%;"><strong>Remise</strong></td>
                                                    <td align="center" hidden style="width: 5%;"><strong>Fodec</strong></td>
                                                    <td align="center" style="width: 5%;"><strong>Tva</strong></td>
                                                    <td align="center" style="width: 10%;"><strong>TTC</strong></td>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($lignecommandes as $i => $res) : // debug($lignebonchargements->id);

                                                ?>
                                                    <tr  style="font-size: 18px;font-weight: bold;">
                                                        <td>
                                                          
                                                            <input type="hidden" name="data[tabligne3][<?= h($i) ?>][sup]" id="sup<?= h($i) ?>" index="<?= h($i) ?>" class="form-control ">

                                                            <select name="data[tabligne3][<?= h($i) ?>][article_id]" disabled id="article_id<?= h($i) ?>" class="form-control" onchange="get_article(this.value,1)">
                                                                <option value="">Veuillez choisir !!</option>
                                                                <?php foreach ($articles as $article) : ?>
                                                                    <option value="<?= h($article->id) ?>" <?php if ($article->id == $res->article_id) {
                                                                                                                echo "selected";
                                                                                                            } ?>><?= h($article->Code) ?></option>
                                                                <?php endforeach; ?>

                                                            </select>
                                                        </td>

                                                        <td>
                                                            
                                                            <input type="hidden" name="data[tabligne3][<?= h($i) ?>][sup]" id="sup<?= h($i) ?>" index="<?= h($i) ?>" class="form-control ">

                                                            <select name="data[tabligne3][<?= h($i) ?>][article_id]" disabled id="article_id<?= h($i) ?>" class="form-control" onchange="get_article(this.value,1)">
                                                                <option value="">Veuillez choisir !!</option>
                                                                <?php foreach ($articles as $article) : ?>
                                                                    <option value="<?= h($article->id) ?>" <?php if ($article->id == $res->article_id) {
                                                                                                                echo "selected";
                                                                                                            } ?>><?= h($article->Dsignation) ?></option>   
                                                                <?php endforeach; ?>

                                                            </select>
                                                        </td>
                                                        
                                                        <td align="center">
                                                        <?php echo $this->Form->input('sup0', ['name' => 'data[ligner][' . $i . '][sup0]', 'id' => 'sup0' . $i, 'champ' => 'sup0' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control']);?>

                                                            <?php
                                                            echo $this->Form->input('qte', array('readonly' => 'readonly', 'value' => $res['qte'], 'label' => '', 'name' => 'data[ligner][' . $i . '][qte]', 'id' => 'qte' . $i, 'champ' => 'qte', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control vali htbc'));
                                                            ?>
                                                        </td>
                                                        <td align="center" champ='tt'>
                                                            <?php
                                                            echo $this->Form->input('prix', array('readonly' => 'readonly', 'value' => $res['prix'], 'label' => '', 'name' => 'data[ligner][' . $i . '][prix]', 'id' => 'prix' . $i, 'champ' => 'prix', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc vali', 'type' => 'text'));
                                                            ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php
                                                            echo $this->Form->input('punht', array('readonly' => 'readonly', 'value' => $res['ht'], 'readonly' => 'readonly', 'label' => '', 'name' => 'data[ligner][' . $i . '][punht]', 'id' => 'punht' . $i, 'champ' => 'punht', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc', 'type' => 'text'));
                                                            ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php
                                                            echo $this->Form->input('remisee', array('readonly' => 'readonly', 'value' => $res['remise'], 'label' => '', 'name' => 'data[ligner][' . $i . '][remise]', 'id' => 'remise' . $i, 'champ' => 'remise', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc', 'type' => 'text'));
                                                            ?>
                                                        </td>

                                                        <td align="center" hidden>
                                                            <?php
                                                            echo $this->Form->input('fodec', array('readonly' => 'readonly', 'value' => $res['fodec'], 'label' => '', 'name' => 'data[ligner][' . $i . '][fodec]', 'id' => 'fodec' . $i, 'champ' => 'fodec' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc', 'type' => 'text'));
                                                            ?>
                                                        </td>


                                                        <td align="center">
                                                            <?php
                                                            echo $this->Form->input('tva', array('readonly' => 'readonly', 'value' => $res['tva'], 'label' => '', 'name' => 'data[ligner][' . $i . '][tva]', 'id' => 'tva' . $i, 'champ' => 'tva', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc', 'type' => 'text'));
                                                            ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php
                                                            echo $this->Form->input('ttc', array('readonly' => 'readonly', 'value' => $res['ttc'], 'readonly' => 'readonly', 'label' => '', 'name' => 'data[ligner][' . $i . '][ttc]', 'id' => 'ttc' . $i, 'champ' => 'ttc', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc', 'type' => 'text'));
                                                            ?>
                                                        </td>


                                                    </tr>

                                                <?php endforeach; ?>




                                                <input type="hidden" value="<?php echo $i ?>" id="index0">

                                            </tbody>

                                        </table>

                                        <div class="col-md-6">
                                            <?php
                                            echo $this->Form->control('remise', array('readonly' => 'readonly', 'readonly' => 'readonly', 'value' => sprintf('%.3f', $commande->remise), 'id' => 'remise', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'text'));
                                            echo $this->Form->control('tva', array('readonly' => 'readonly', 'readonly' => 'readonly', 'value' => sprintf('%.3f', $commande->tva), 'id' => 'tva', 'label' => 'TVA', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'text'));
                                            echo $this->Form->control('fodec', array('readonly' => 'readonly', 'readonly' => 'readonly', 'value' => sprintf('%.3f', $commande->fodec), 'id' => 'fodec', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'hidden'));

                                            ?></div>
                                        <div class="col-md-6"><?php
                                                                echo $this->Form->control('ht', array('readonly' => 'readonly', 'readonly' => 'readonly', 'id' => 'ht', 'value' => sprintf('%.3f', $commande->ht), 'label' => 'HT', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'text'));

                                                                echo $this->Form->control('ttc', array('readonly' => 'readonly', 'readonly' => 'readonly', 'value' => sprintf('%.3f', $commande->ttc), 'id' => 'ttc', 'label' => 'TTC', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'text'));

                                                                ?>
                                        </div>


                                        <br>



                                    </div>
                                    <!--Table Wrapper Finish-->
                                </div>

                            </div>
                        </div>

                        <?php echo $this->Form->end(); ?>
                    </section>













                    <!--                        echo $this->Form->control('valide');
                        echo $this->Form->control('remise');
                        echo $this->Form->control('tva');
                        echo $this->Form->control('fodec');
                        echo $this->Form->control('ttc');
                        echo $this->Form->control('ht');
                       ;
                        ?>-->
                </div>
                <!-- /.box-body -->



                <?php echo $this->Form->end(); ?>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
</section>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    $(document).ready(function() {
        calculeachat();
    })
    $(function() {
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
    $('.select2').select2();
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
<?php $this->end(); ?>