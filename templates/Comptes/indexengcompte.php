<?php

error_reporting(E_ERROR | E_PARSE);
echo $this->Html->css('select2');
?>
<?php

use Cake\Datasource\ConnectionManager;
use Cake\I18n\Number;


$connection = ConnectionManager::get('default'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<section class="content-header">
    <h1>Recherche </h1>
    <br>
    <ol class="breadcrumb">
        <li>
            <a href="<?php echo $this->Url->build(['action' => 'index']); ?>">
                <i class="fa fa-reply"></i> <?php echo __('Retour'); ?>
            </a>
        </li>
    </ol>
</section>
<section>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-body">
                    <?php echo $this->Form->create($historiquecomptes, ['type' => 'get']);
                    //debug($cout);   
                    ?>

                    <div class="row">
                        <div class="col-xs-6">
                            <?php

                            echo $this->Form->control('date1', array('value'=>$this->request->getQuery('date1'), 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control datePickerOnly ', 'type' => 'date', 'label' => 'Date de'));
                            ?>

                        </div>


                        <div class="col-xs-6">

                            <?php
                            echo $this->Form->control('date2', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control datePickerOnly', 'type' => 'date', 'label' => "Jusqu'à ", 'value'=>$this->request->getQuery('date2')));

                            ?>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6">
                            <?php
                            //  echo $this->Form->input('compte_id', array('id' => 'compte_id', 'empty' => 'veuillez choisir', 'div' => 'form-group', 'label' => 'Compte', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control select2', 'options' => $comptes, 'value' => $this->request->getQuery('compte_id'),));
                            ?>
                            <label>Compte</label>
                            <select class="form-control select2" name="compte_id" id="compte_id" value='<?php $this->request->getQuery('compte_id') ?>'>
                                <option value="" selected="selected">Veuillez choisir !!</option>
                                <?php foreach ($comptes as $j => $art) {
                                ?>
                                    <option <?php if ($art->id == $compteid) { ?> selected="selected" <?php } ?> value="<?php echo $art->id; ?>"><?php echo $art->agence->name . ' ' . $art->numero ?></option>
                                <?php } ?>

                            </select>
                        </div>

                        <div class="col-xs-6">

                        </div>


                    </div>





                    <div class="form-group">
                        <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
                            <button type="submit" class="btn btn-primary  alertHisto" id="">Afficher</button>

                            <?php   
                            //debug($count);
                            if ($count != 0) { ?>
                                <a onclick="openWindow(1000, 1000, wr+'comptes/imprimeeng?date1=<?php echo @$date1; ?>date2=<?php echo @$date2;  ?>compteid=<?php echo @$compteid;  ?>')"><button class="btn btn-primary ">Imprimer</button></a>
                            <?php } ?>
                            <?php echo $this->Html->link(__('Actualiser'), ['action' => '/indexengcompte'], ['class' => 'btn btn-primary']) ?>

                        </div>
                    </div>

                    <?php echo $this->Form->end(); ?>

                </div>

                <br>


                <h3 style="margin-left: 5px ;">
                    Engagement Compte
                </h3><br>

                <div class="box-body">


                    <table id="example1" class="table table-bordered  table-striped" style="border-spacing: 0 8px;">

                        <tr>
                            <td align="center" colspan="4" style="color:#3c8dbc;"><strong>solde Créditeur </strong></td>
                            <td colspan="2" style="background-color:#3c8dbc;" align="center"><strong> <?php echo $soldetc ?></strong></td>
                        </tr>
                        <tr style="background-color:#3c8dbc;">
                            <th width="10%" class="actions text-center "><?php echo ('Date'); ?></th>
                            <!-- <th width="10%" class="actions text-center "><?php echo ('Compte'); ?></th> -->
                            <th width="10%" class="actions text-center "><?php echo ('Action'); ?></th>
                            <th width="10%" class="actions text-center "><?php echo ('Type'); ?></th>
                            <th width="10%" class="actions text-center "><?php echo ('Montant'); ?></th>
                            <th width="10%" class="actions text-center"><?php echo ('Débit'); ?></th>
                            <th width="10%" class="actions text-center "><?php echo ('Crédit'); ?></th>

                        </tr>

                        <?php
                        $mnt = $soldetc;
                        $i = 0;
                        $totalMontantCheque = 0;
                        // $tt = 0; 
                        //debug($historiquecomptes->toArray());
                        foreach ($historiquecomptes as $historiquearticle) :
                            //   foreach ($piecereglements  as $i => $dataItem) :

                            $mnt += $historiquearticle->debit;

                            $mnt -= $historiquearticle->credit;

                            // if ($historiquearticle->mode == 'Chèque') {
                            //     $totalMontantCheque += $historiquearticle->montant;
                            // }


                        ?>

                            <tr>

                                <td align="center"><?=
                                                    $this->Time->format(
                                                        $historiquearticle->date,
                                                        'dd/MM/y'
                                                    );
                                                    ?><?php //echo $historiquearticle->date; 
                                                        ?></td>
                                <td align="center">
                                    <?= h($historiquearticle->mode . ' ' . $historiquearticle->numero) ?>
                                </td>

                                <td align="center">
                                    <?php echo $historiquearticle->type; ?>

                                </td>
                                <td align="center"><?php
                                                    echo sprintf("%01.3f", abs($historiquearticle->montant));
                                                    ?></td>

                                <td align="center"><?php if ($historiquearticle->debit != 0) {
                                                        echo sprintf("%01.3f", abs($historiquearticle->debit));
                                                        // echo $historiquearticle->debit;
                                                    } ?>

                                </td>
                                <td align="center"><?php //if ($historiquearticle->mode == 'Chèque') {
                                                    //echo $historiquearticle->credit;
                                                    if ($historiquearticle->credit != 0) {
                                                        echo sprintf("%01.3f", abs($historiquearticle->credit));
                                                    }
                                                    //} else {
                                                    //} 
                                                    ?>

                                </td>


                            </tr>
                        <?php
                        endforeach; ?>
                        <tr>
                            <td align="center" colspan="4" style="color:#3c8dbc;"><strong>solde Créditeur </strong></td>
                            <td colspan="2" align="center" style="background-color:#3c8dbc;"><strong><?php echo sprintf("%01.3f", abs($mnt));
                                                                                                        //echo $mnt; 
                                                                                                        ?></strong></td>


                        </tr>
                    </table>

                </div>
            </div>
        </div>
    </div>
</section>


<!-- Reste du code HTML -->

<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<!-- Reste des inclusions CSS et JS -->

<?php $this->end(); ?>


<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<!-- DataTables -->
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    $(function() {
        $('#example2').DataTable()
        $('#example1').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': true,
            'ordering': false,
            'info': true,
            'autoWidth': false
        })
    })
    $('.select2').select2()
</script>

<script>
    function openWindow(h, w, url) {
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }
</script>
<?php $this->end(); ?>