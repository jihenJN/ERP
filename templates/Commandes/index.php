<section class="content-header">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
</section>

<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->css('select2'); ?>
<?php

use Cake\Datasource\ConnectionManager;
?>

<section class="content-header">
    <header>
        <h1 style="text-align:center;">Bon de commande</h1>
    </header>
</section>


<?php

$add = "";
$edit = "";
$delete = "";
$view = "";
$session = $this->request->getSession();
$abrv = $session->read('abrvv');
$lien = $session->read('lien_vente' . $abrv);
foreach ($lien as $k => $liens) {
    if (@$liens['lien'] == 'commandes') {
        $add = $liens['ajout'];
        $edit = $liens['modif'];
        $delete = $liens['supp'];
        $valide = $liens['valide'];
        $imp = $liens['imprimer'];
    }
}


if ($add == 1) {
?>
    <div class="pull-left" style="margin-left:25px;margin-top: 20px">
        <?php echo $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
    </div>
<?php } ?>
<br> <br>





<section class="content-header">
    <h1>
        Recherche
    </h1>

</section>
<section class="content" style="width: 99%" style="background-color: white ;">
    <div class="box">
        <div class="box-body">
            <?php echo $this->Form->create($commandes, ['id' => 'searchForm', 'type' => 'get']); ?>

            <div class="row">




                <div class="col-xs-2">

                    <?php
                    echo $this->Form->control('datedebut', array('required' => 'off', 'label' => 'Date début', 'value' =>  $this->request->getQuery('datedebut'), 'id' => 'datedebut', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'date'));
                    ?>

                </div>
                <div class="col-xs-2">

                    <?php
                    echo $this->Form->control('datefin', array('required' => 'off', 'label' => 'Date fin', 'value' =>  $this->request->getQuery('datefin'), 'id' => 'datefin', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'date'));
                    ?>
                </div>



                <div class="col-xs-3">


                    <label class="control-label" for="name">Code Client
                    </label>
                    <select class="form-control select2" id="idclient" name="client_id">
                        <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                        <?php foreach ($clients as $id => $client) {
                        ?>

                            <option <?php if ($this->request->getQuery('client_id') == $client->id) echo 'selected="selected"' ?> value="<?php echo $client->id; ?>"><?php
                                                                                                                                                                        echo $client->Code ?></option>
                        <?php } ?>
                    </select>
                </div>


                <div class="col-xs-3">


                    <label class="control-label" for="name">Nom Client
                    </label>
                    <select class="form-control select2" id="idclient1" name="client_id1">
                        <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                        <?php foreach ($clients as $id => $client) {
                        ?>

                            <option <?php if ($this->request->getQuery('client_id') == $client->id) echo 'selected="selected"' ?> value="<?php echo $client->id; ?>"><?php
                                                                                                                                                                        echo $client->Raison_Sociale ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-xs-2">

                    <?php echo $this->Form->control('numero', ['label' => 'Numero', 'label' => 'Numéro ', 'class' => 'form-control ', 'value' => $this->request->getQuery('numero'), 'required' => 'off']); ?>
                </div>

                <div class="col-xs-2 ">

                    <?php echo $this->Form->control('etatliv', ['value' => $this->request->getQuery('etatliv'), 'options' => [1 => 'Livrée', 2 => 'Non Livrée'], 'name' => 'etatliv', 'id' => 'etatliv', 'label' => 'Etat livraison', 'class' => 'form-control select2', 'empty' => 'Veuillez choisir !!']); ?>

                </div>

                <div class="col-xs-1">
                    <button type="submit" style="margin-top: 25px;" class="btn btn-default custom-width-button">
                        <i class="fa fa-search"></i>
                    </button>

                </div>
                <div class="col-xs-1" style="text-align: center; margin-top: 25px;">
                    <?php echo $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-default btn-large fa fa-remove', 'style' => 'width: 37px; height: 35px; display: flex; justify-content: center; align-items: center;']) ?>
                </div>

                <?php echo $this->Form->end(); ?>


                <!-- <input id="etat" value="<?php echo $etat ?>" type="hidden"> -->









                <!-- <div class="pull-right" style="margin-right:44%;margin-top: 20px;">
                <button type="submit" class="btn btn-primary btn-sm">Afficher</button>
                <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
                      <a onclick="openWindow(1000, 1000, 'http://localhost:8765/commandes/imprimerrecherche?commercial_id=<?= $commercial_id ?>&client_id=<?= $client_id ?>&numero=<?= $numero ?>');"><button class="btn btn-primary btn-sm">Imprimer Recherche</button></a>
                 </div> -->
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
    <br>
    <!-- </section>
<section class="content-header">
    <div style="display:flex ; align-items:center ;  justify-content: space-between;">
        <h1>
            Commandes
        </h1>



    </div>
</section>
<section class="content"> -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <h3 class="box-title">Commandes</h3>

                <div class="box-body">
                    <table width="100%" id="example2" class="table table-bordered table-striped">

                        <!-- <table id="example1" class="table-fixed table table-bordered table-striped" style=' display: block;overflow-x: auto;white-space: nowrap;height:500px'> -->
                        <thead style='position: sticky;top: 0; background-color: #3c8dbc;'>
                            <tr style="font-size: 16px;">

                                <th width="7%" align="center"> <?= ('Date') ?> </th>
                                <th width="8%" align="center"> <?= ('N°') ?> </th>
                                <th width="7%" align="center"> <?= ('Code') ?> </th>
                                <th width="10%" align="center"> <?= ('Raison Sociale') ?> </th>
                                <!-- <th align="center">  <?= ('N° Offre Prix') ?>  </th> -->
                                <th hidden width="8%" align="center"> <?= ('Dépot') ?> </th>

                                <th width="8%" align="center"> <?= ('Personnel') ?> </th>
                                <!-- <th align="center">  <?= ('Etat transport') ?>  </th> -->
                                <th width="11%" align="center"> <?= ('Total') ?> </th>
                                <!-- <th align="center">  <?= ('Réglement') ?>  </th> -->
                                <th width="8%" align="center"> <?= ('Etat') ?> </th>
                                <th width="13%" align="center"> <?= ('Bon de livraison') ?> </th>
                                <th width="7%" align="center"> <?= ('Actions') ?> </th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($commandes as $i => $commande) :

                                /// debug($commande->type);


                                if ($commande->etatliv == 0) {

                                    $connection = ConnectionManager::get('default');

                                    $lignes = [];
                                    //   $lignes = $connection->execute('SELECT * FROM lignecommandes where lignecommandes.commande_id=' . $commande['id'] . ' ;')->fetchAll('assoc');


                                    $test1 = 0;
                                    $test2 = 0;
                                    $test3 = 0;
                                    $test = 0;
                                    foreach ($lignes as $j => $l) {

                                        /// debug($l);
                                        $connection = ConnectionManager::get('default');

                                        date_default_timezone_set('Africa/Tunis');
                                        $date = $commande->date;
                                        $depotid = $commande->depot_id;
                                        $articleid = $l['article_id'];
                                        //debug($articleid);
                                        $date = date("Y-m-d H:i:s", strtotime(str_replace('-', '/', $date)));
                                        ///debug($date);
                                        $dateff = date("Y-m-d H:i:s");
                                        // debug($dateff);
                                        if ($commande['depot_id']) {
                                            $inventaires = $connection->execute("select stockbassem(" . $l['article_id'] . ",'" . $date . "','0'," . $commande['depot_id'] . " ) as v")->fetchAll('assoc');
                                        }
                                        $bc = $connection->execute("select stockbassemseuil(" . $articleid . ",'" . $date . "','0'," . $depotid . " ) as q ")->fetchAll('assoc');
                                        $stock = $inventaires[0]['v'];
                                        $qtecommande = $bc[0]['q'];
                                        //    debug($stock);
                                        //    debug($qtecommande);


                                        //debug($stock);//die;
                                        $month = (int)date('m');
                                        $seuil = $connection->execute('SELECT * FROM `seuilmois` WHERE article_id="' . $l['article_id'] . '" and moi_id="' . $month . '" ')->fetchAll('assoc');
                                        //debug($seuil);//die;
                                        //debug($l['qte']);
                                        if (empty($seuil))
                                            $alert = 0;
                                        else
                                            $alert = (int)$seuil['0']['alert'];
                                        // debug($alert);//die;
                                        $seuill = $stock  + $alert;
                                        $st = $stock - $qtecommande -  $alert;

                                        ///debug($st);
                                        $val = $st + 1;
                                        ///debug($val);
                                        $x = (int)$l['qte'];
                                        /// debug($x);
                                        $cond1 = $x > $val;
                                        $cond2 = $x > $stock + 1 && $x < $st;
                                        $cond3 =  $x <= $stock;

                                        // debug($cond1);
                                        // debug($cond2);
                                        // debug($cond3);
                                        //die;
                                        // debug($x);
                                        if ($cond1) {
                                            $test1 += 1;
                                        }
                                        ///debug($test1);
                                        if ($cond2) {
                                            $test2 += 1;
                                        }
                                        if ($cond3) {
                                            $test3 += 1;
                                        }


                                        /// debug($test1);
                                    }
                                }


                                /////////////////////////////////////////////////////////


                                $connection = ConnectionManager::get('default');

                                $id = $commande->id;
                                // debug($id);

                                $commandeTotQte = 0;
                                $BLTotQte = 0;
                                $connection = ConnectionManager::get('default');
                                if (!empty($id)) {
                                    $commandeTotQte = $connection->execute('SELECT SUM(qte) AS sommeqtecmd FROM lignecommandes WHERE commande_id = :commande_id', ['commande_id' => $id])
                                        ->fetch('assoc');
                                    //  debug($commandeTotQte);
                                }
                                if (!empty($id)) {
                                    $bls = $connection->execute('SELECT * FROM bonlivraisons WHERE bonlivraisons.commande_id = ' . $id . ' AND bonlivraisons.typebl=1;')->fetchAll('assoc');

                                    if (!empty($bls)) {
                                        $blsIds = [];
                                        foreach ($bls as $bl) {
                                            $blsIds[] = $bl['id'];
                                        }

                                        $blsIdsString = implode(',', $blsIds);

                                        $BLTotQte = $connection
                                            ->execute('SELECT SUM(qte) AS sommeqtebl FROM lignebonlivraisons WHERE bonlivraison_id IN (' . $blsIdsString . ')')
                                            ->fetch('assoc');

                                        //debug($BLTotQte);
                                    }
                                    if ($commande->user_id != null) {
                                        $uu = $connection->execute('SELECT * FROM personnels WHERE personnels.id = ' . $commande->user->personnel_id . ';')->fetchAll('assoc');

                                        //  debug($bonlivraison->user->personnel_id);
                                    }
                                    if ($uu) {
                                        $mm = $uu[0]['code'] . '' . $uu[0]['nom'];
                                    } else {
                                        $mm;
                                    }
                                }
                                $articlesId = $connection->execute('SELECT article_id FROM lignebonlivraisons WHERE lignebonlivraisons.bonlivraison_id = ' . $id . ';')->fetchAll('assoc');

                                // $bll = $connection->execute('SELECT * FROM bonlivraisons WHERE bonlivraisons.commande_id = ' . $id . ';')->fetchAll('assoc');

                                //////////////////


                            ?>
                                <tr style="font-size: 16px;">


                                    <?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id' . $i, 'value' => $commande->id, 'label' => '', 'champ' => 'id', 'type' => 'hidden', 'class' => 'form-control']); ?>
                                    <?php echo $this->Form->control('tre', ['index' => $i, 'id' => 'validationTransport' . $i, 'value' => $commande->validationTransport, 'label' => '', 'champ' => 'validationTransport', 'type' => 'hidden', 'class' => 'form-control']); ?>
                                    <?php echo $this->Form->control('aut', ['index' => $i, 'id' => 'autorisationEnlevement' . $i, 'value' => $commande->autorisationEnlevement, 'label' => '', 'champ' => 'autorisationEnlevement', 'type' => 'hidden', 'class' => 'form-control']); ?>

                                    </td>
                                    <td width="10%"><?=
                                                    $this->Time->format(
                                                        $commande->date,
                                                        'dd/MM/y'
                                                    );
                                                    ?></td>

                                    <?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id' . $i, 'value' => $commande->id, 'label' => '', 'champ' => 'id', 'type' => 'hidden', 'class' => 'form-control']); ?>

                                    <td width="8%">&nbsp;&nbsp;<?= h($commande->numero) ?> </td>
                                    <?php if ($commande->client_id == 12) { ?>
                                        <td width="7%">&nbsp;&nbsp;<?php echo $commande->client->Code ?></td>
                                        <td  width="12%">&nbsp;&nbsp;<?php echo $commande->nomprenom ?></td>

                                    <?php } else { ?>
                                        <td width="7%">&nbsp;&nbsp;<?php echo $commande->client->Code ?></td>
                                        <td  width="12%">&nbsp;&nbsp;<?php echo $commande->client->Raison_Sociale ?></td>
                                    <?php } ?>
                                    <!-- <td width="9%"> &nbsp;&nbsp;<?php if ($bll[0]['numero']) {
                                                                            echo ($bll[0]['numero']);
                                                                        } else echo ''; ?></td> -->

                                    <td hidden width="9%"> &nbsp;&nbsp;<?= h($commande->depot->name) ?></td>
                                    <td width="9%"> &nbsp;&nbsp;<?php echo $mm; ?></td>


                                    <!-- <td width="7%"><?= h($commande->etattransport->name) ?></td> -->
                                    <td width="15%" align="center"><?= h($commande->totalttc) ?></td>
             
                                    <td width="14%" align="center">
                                        <?php
                                        if (is_array($commandeTotQte) && is_array($BLTotQte)) {
                                            if ($BLTotQte['sommeqtebl'] == $commandeTotQte['sommeqtecmd'] && $BLTotQte['sommeqtebl'] != 0) {
                                                echo '<button class="btn btn-sm custom-button custom-button" style="background-color: #54A74D; color: white;">Livré</button>';
                                            } elseif ($BLTotQte['sommeqtebl'] == 0) {
                                                echo '<button class="btn btn-sm custom-button custom-button" style="background-color: #F55C43; color: white;">En cours</button>';
                                            } elseif ($BLTotQte['sommeqtebl'] < $commandeTotQte['sommeqtecmd']) {
                                                echo '<button class="btn btn-sm custom-button custom-button" style="background-color: #F99048; color: white;">Livré Partiel</button>';
                                            }
                                        } else {
                                            echo '<button class="btn btn-sm custom-button custom-button" style="background-color: #F55C43; color: white;">En cours</button>';
                                        }
                                        ?>
                                    </td>


                                    <td width="10%" align="center">
                                        <div>
                                            <?php //echo($BLTotQte['sommeqtebl'] .' != '. $commandeTotQte['sommeqtecmd']);
                                            // if ($commande->confirme == 0) {
                                            //if ($validationcommande==1){
                                            ?>
                                            <!-- <button style="background-color:black" class="btn btn-success btn-xs glyphicon glyphicon-edit opendialogcycle" index=<?php echo $i ?> id="<?php echo '' ?>"></button> -->
                                            <?php //}
                                            /// } else {
                                            if ($BLTotQte['sommeqtebl'] != $commandeTotQte['sommeqtecmd']) {
                                            ?>
                                                <input type="checkbox" id="check<?php echo $i; ?>" value="<?php echo $commande['id'] ?>" name="checkbox[]" ligne="<?php echo $i; ?>" class="blfbre" />
                                                <input id="poids<?= $i ?>" ligne="<?php echo $i; ?>" class="poidhidden" type="hidden" value="<?= $commande->Poids ?>">
                                                <input id="client_id<?= $i ?>" ligne="<?php echo $i; ?>" class="" type="hidden" value="<?= $commande->client_id ?>">
                                                <input id="bl_id<?= $i ?>" ligne="<?php echo $i; ?>" class="" type="hidden" value="<?= $commande->bl ?>">
                                                <input id="payementcomptant_id<?= $i ?>" ligne="<?php echo $i; ?>" class="" type="hidden" value="<?= $commande->payementcomptant ?>">
                                            <?php  }
                                            //  } 
                                            ?>

                                        </div>


                                        <?php //|| $commande->valide == 0; //  $this->Number->format($bondechargement->bondetransfert_id) 
                                        ?>
                                    </td>




                                    <td class="actions text" align="center">
                                        <div style="display: flex;" align="center">
                                            <div>
                                                <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $commande->id), array('escape' => false));
                                                ?>

                                            </div>


                                            <?php if ($edit == 1) { ?>
                                                <?php if ($commande->bonlivraison_id == 0) { //if ($BLTotQte['sommeqtebl'] != $commandeTotQte['sommeqtecmd']) { 
                                                ?>
                                                    <div style="margin-right:2px ;">
                                                        <?php echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $commande->id), array('escape' => false)); ?>
                                                    </div>
                                                <?php }
                                            }
                                            if ($imp == 1) { ?>
                                                <!-- <div style="margin-right:2px ;">
                                                    <a onclick="openWindow(1000, 1000, 'Commandes/imprimeview/<?php echo $commande->id; ?>')"><button class='btn btn-xs btn-primary'><i class='fa fa-print'></i> PDF</button></a>
                                                </div> -->
                                                <div style="margin-right:2px ;">
                                                    <a onclick="openWindow(1000, 1000, wr+'Commandes/imprimesans/<?php echo $commande->id; ?>')"><button class='btn btn-xs btn-success' style="background-color:purple;color:white;"><i class='fa fa-print'></i></button></a>
                                                </div>

                                            <?php }
                                            if ($delete == 1) { ?>
                                                <?php if ($commande->bonlivraison_id == 0) { //if ($BLTotQte['sommeqtebl'] != $commandeTotQte['sommeqtecmd']) { 
                                                ?>
                                                    <div>
                                                        <?php //echo $this->Form->postLink("<button class='deleteConfirm btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $commande->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $commande->id)); 

                                                        echo ("<button type=button index= '" . $i . "' id='delete" . $i . "' class='btn btn-xs btn-danger deleteverif'><i class='fa fa-trash-o'></i></button>");

                                                        ?>
                                                    </div>
                                            <?php }
                                            } ?>
                                        </div>

                                    </td>
                                </tr>




                            <?php endforeach; ?>

                        </tbody>
                        <!-- <tfoot >

                            <tr >
                                <th   colspan="6"></th>
                                <td  style=" border: 2px solid #fff;"> <b > Poids total</b>  </td>
                                <td  style=" border: 2px solid #fff;" >
                                    <input  class="form-control" id="poids-id"  value="0" >
                                </td>
                            </tr>
                            </tfoot> -->

                    </table>

                    <input type="hidden" value="<?php echo $i; ?>" id="index" />



                    <table>

                        <tr>
                            <td align="center">

                                <div class="col-md-12  testcheck" style="display:none;">
                                    <input type="hidden" name="tes" value="0" class="tespv" />
                                    <input type="hidden" name="tes" value="0" class="tes" />
                                    <input type="hidden" name="tes" value="99" class="testbl" />
                                    <input type="hidden" name="tes" value="55" class="testp" />
                                    <input type="hidden" name="nombre" value="<?php echo @$i; ?>" class="nombre" />
                                    <a class="btn btn btn-danger btnbl" id="bonliv"> <i class="fa fa-plus-circle"></i> Créer un bon de livraison </a>
                                </div>

                            </td>


                            <td>

                                <div class="col-xs-12  preparatif" style="display:none;">
                                    <input type="hidden" name="tes" value="0" />
                                    <input type="hidden" name="tes" value="0" />
                                    <input type="hidden" name="nombre" value="<?php echo @$i; ?>" class="nombre" />
                                    <a class="btn btn btn-primary prep "> <i class="fa fa-plus-circle"></i> Créer un préparatif </a>
                                </div>

                            </td>


                        </tr>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>

<!-- 
<div id="dialogcycle" title="Confirmation">
    <section class="content" style="width: 99%">
        <?php echo $this->Form->create($suivi, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]);
        ?>


        <div align=center class="col-xs-12">
            <?php
            echo $this->Form->control('validationTransport', [
                'type' => 'checkbox',
                'id' => 'checkboxvalidation',
                'label' => 'Validation de Transport'
            ]);
            ?>
        </div>

        <div align=center class="col-xs-12">
            <?php
            echo $this->Form->control('autorisationEnlevement', [
                'type' => 'checkbox',
                'id' => 'checkboxautorisation',

                'label' => 'Autorisation d`enlèvement'
            ]);
            echo $this->Form->control('iddialog', ['label' => false, 'class' => 'form-control', 'required' => 'off', 'type' => 'hidden']); ?>

        </div>


    </section>

    <div class="dialog-footer" align="center">
        <?php echo $this->Form->submit(__('Enregistrer'), ['id' => 'dialogbutton']); ?>
        <?php //echo $this->Html->link("<button index= '" . $i . "' id='view" . $i . "' class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $bonlivraisonusine->id), array('escape' => false)); 
        ?>

    </div>
    <?php echo $this->Form->end(); ?>


</div> -->




<style type="text/css">
    .ui-dialog {
        z-index: 4000;

    }

    #dialogcycle {
        position: relative;
    }

    .dialog-footer {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 10px;
    }
</style>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sélectionner les éléments du formulaire et initialiser Select2
        const numeroInput = document.querySelector('input[name="numero"]');
        const datedebutInput = document.getElementById('datedebut');
        const datefinInput = document.getElementById('datefin');
        const clientcIdSelect = $('#idclient');
        const clientnIdSelect = $('#idclient1');
        const etatlivv = document.getElementById('etatliv');
        const searchForm = document.getElementById('searchForm');

        console.log('DOM entièrement chargé');

        // Initialiser Select2 sur les dropdowns
        clientcIdSelect.select2();
        clientnIdSelect.select2();

        // Fonction pour soumettre le formulaire
        function submitForm() {
            searchForm.submit();
        }

        // Écouteur d'événements pour les changements sur les dropdowns clients
        clientcIdSelect.on('change', function() {
            clientnIdSelect.val(clientcIdSelect.val()).trigger('change.select2');
        });

        clientnIdSelect.on('change', function() {
            clientcIdSelect.val(clientnIdSelect.val()).trigger('change.select2');
        });

        // Écouteur d'événements pour soumettre le formulaire lors de la pression sur Entrée
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                const activeElement = document.activeElement;

                // Vérifier si l'élément actif est l'un des éléments spécifiés ou un champ Select2
                if (
                    activeElement === numeroInput ||
                    activeElement === datedebutInput ||
                    activeElement === datefinInput ||
                    activeElement === etatlivv ||
                    $(activeElement).hasClass('select2-search__field') || // Champ de recherche Select2
                    $(activeElement).closest('.select2-container').length // Conteneur Select2
                ) {
                    return; // Permettre le comportement par défaut si le focus est sur ces éléments
                }

                // Empêcher le comportement par défaut de la touche Entrée et soumettre le formulaire
                e.preventDefault();
                submitForm();
            }
        });
    });
</script>

<script>
    // document.addEventListener('DOMContentLoaded', function() {
    //     const numeroInput = document.querySelector('input[name="numero"]');
    //     const datedebutInput = document.getElementById('datedebut'); //alert(datedebutInput)
    //     const datefinInput = document.getElementById('datefin');
    //     const clientcIdSelect = document.getElementById('idclient');
    //     const clientnIdSelect = document.getElementById('idclient1');
    //     const etatlivv = document.getElementById('etatliv');

    //     const searchForm = document.getElementById('searchForm');

    //     console.log('DOM entièrement chargé');

    //     if (numeroInput && datedebutInput && datefinInput && clientcIdSelect && clientnIdSelect && etatlivv && searchForm) {
    //         console.log('Éléments de formulaire trouvés');

    //         // Fonction pour soumettre le formulaire
    //         function submitForm() {
    //             searchForm.submit();
    //         }

    //         // Événement pour soumettre le formulaire lorsqu'Entrée est pressé
    //         searchForm.addEventListener('keydown', function(e) {
    //             if (e.key === 'Enter' && (e.target !== numeroInput || e.target !== datedebutInput || e.target !== datefinInput || e.target !== etatlivv)) {
    //                 e.preventDefault();
    //                 submitForm();
    //             }
    //         });

    //         // Événement pour soumettre le formulaire lorsqu'un changement est apporté au fournisseurIdSelect
    //         clientcIdSelect.addEventListener('change', function() {
    //             submitForm();
    //         });
    //         clientnIdSelect.addEventListener('change', function() {
    //             submitForm();
    //         });
    //     } else {
    //         console.log('Éléments de formulaire non trouvés');
    //     }
    // });
</script>
<script>
    $(document).ready(function() {

        $('#idclient1').change(function() {
            var selectedcodename = $(this).val();
            $("#idclient").select2('destroy');
            $("#idclient").val(selectedcodename);
            $("#idclient").select2();

        });
        $('#idclient').change(function() {
            var selectedcodename = $(this).val();
            $("#idclient1").select2('destroy');
            $("#idclient1").val(selectedcodename);
            $("#idclient1").select2();

        });
    });
</script>
<script>
    $(function() {
        $('.deleteverif').on('click', function() {
            ind = $(this).attr('index');
            id = $('#id' + ind).val();

            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Commandes', 'action' => 'verif']) ?>",
                dataType: "json",
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function(data) {
                    if (data.lignereg != 0) {
                        alert('Commande déjà existe dans un règlement');
                    } else {
                        if (confirm('Voulez-vous vraiment supprimer cet enregistrement')) {
                            window.location = "<?= $this->Url->build(['controller' => 'Commandes', 'action' => 'delete']) ?>/" + id;
                        }
                    }
                }
            })
        });
    });
    $(function() {

        $('#example2').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': false,
            'info': true,
            'autoWidth': false
        })
    })
    $('.select2').select2()
</script>
<?php $this->end(); ?>


<script>
    function openWindow(h, w, url) {
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }
</script>
<script type="text/javascript">
    $(function() {


        // $("form").submit(function() {
        //     $('#dialogbutton').attr('disabled', 'disabled');
        // })
        // etat = $('#etat').val();
        ///alert(etat)

        // if (etat == 0) {
        //     $("#etatliv").val("0").change();
        // }

        // if (etat == 1) {
        //     $("#etatliv").val("1").change();
        // }


        // if (etat == '') {
        //     $("#etatliv").val("").change();
        // }


        $("#bonliv").on("click", function() {
            /// alert("hello");
            var tab = new Array();

            conteur = $(".nombre").val();
            // alert(conteur);
            for (var i = 0; i <= conteur; i++) {
                val = $("#check" + i).attr("checked");
                //var x = ($('#check'+(i)).checked;
                v = $("#check" + i).val();

                //alert(cl)
                if ($("#check" + i).is(":checked")) {
                    //alert(v);
                    tab[i] = v;

                }
            }
            var removeItem = undefined;
            tab = jQuery.grep(tab, function(value) {
                return value != removeItem;
            });



            client = $(".tes").val();
            window.open(wr + "Bonlivraisons/addbonlivraison/" + tab);

            // $(this).attr("href", "Bonlivraisons/addbonlivraison/" + tab);
        });



        tabe = [];
        tabeminus = [];
        $('#poids-id').val(0);


        $('.getpoids').on('click', function(event) {

            event.stopPropagation();


            p = $('#poids-id').val();
            //alert(p);

            ligne = $(this).attr('ligne'); // alert(ligne);
            index = $('#index').val(); //alert(index)

            if ($('#checkbox' + ligne).is(':checked')) {

                //alert(index) ;
                test = 0;

                for (i = 0; i <= Number(index); i++) {
                    if ($('#checkbox' + i).is(':checked')) {

                        test = test + 1;


                    }
                    if (test >= 1) {
                        $('.preparatif').show();


                    }
                }
                commande_id = $('#checkbox' + ligne).val();

                valpoid = $('#poids' + ligne).val() || 0;
                somme = Number($('#poids-id').val()) + Number(valpoid);

                $('#poids-id').val(somme.toFixed(2));
                $('#nb-id').val(Math.ceil($('#poids-id').val() / 450));


            } else {
                poidtotal = $('#poids-id').val();

                valpoid = $('#poids' + ligne).val() || 0;
                spoids = Number(poidtotal) - Number(valpoid);

                $('#poids-id').val(spoids.toFixed(2));
                $('#nb-id').val(Math.ceil($('#poids-id').val() / 450));



            }



            if (test == 0) {
                $('.preparatif').hide();
            }









        });


        $('.prep').on('click', function() {

            var tab = new Array;
            conteur = $('.nombre').val();
            //alert(conteur) ;

            for (var i = 0; i <= conteur; i++) {
                val = ($('#checkbox' + i).attr('checked'));

                v = $('#checkbox' + i).val();
                if ($('#checkbox' + i).is(':checked')) {

                    tab[i] = v;




                }
            }
            var removeItem = undefined;
            tab = jQuery.grep(tab, function(value) {
                return value != removeItem;
            });
            //alert(tab);

            $(this).attr("href", "Bonlivraisons/addpreparatif/" + tab)
        });



        $('.blfbre').on('click', function() {

            ligne = $(this).attr('ligne');
            index = $('#index').val();
            test = 0;
            client = $('#client_id' + ligne).val();
            cont = 0;

            for (i = 0; i <= Number(index); i++) {
                if ($('#check' + i).is(':checked')) {
                    test = 1;
                    cont += 1;

                }

            }
            if (test == 1) {

                // alert(cont)
                $.ajax({

                    method: "GET",
                    url: "<?= $this->Url->build(['controller' => 'Commandes', 'action' => 'getClientmarch']) ?>",
                    dataType: "json",
                    data: {
                        client: client,
                    },
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                    },
                    success: function(data, status, settings) {

                        if (data.valid == 'TRUE') {


                            // $('.tes').val(0);
                            // $('.testbl').val(99);

                            alert('Ce client a des bon de commandes marchandises !!');
                            // if (test != 1 || cont == 1) {
                            //     $('.testcheck').hide();
                            // }

                            // $('#check' + ligne).prop("checked", false);

                        }



                    }



                })
                $('.testcheck').show();
                //alert(test)
                //alert(client);       
                bl = $('#bl_id' + ligne).val();
                pay = $('#payementcomptant_id' + ligne).val();


                if ($('.tes').val() == 0) {
                    $('.tes').val(client);
                }

                if ($('.testbl').val() == 99) {
                    ///// alert('hechem')
                    $('.testbl').val(bl);
                }

                if ($('.testp').val() == 55) {
                    ///// alert('hechem')
                    $('.testp').val(pay);
                }



                if (($('.testbl').val() != bl)) {

                    alert('Il faut choisir des bon commandes de meme type BL !!');
                    return false;

                }

                if (($('.testp').val() != pay)) {

                    alert('Il faut choisir des bon commandes de meme type payement comptant  !!');
                    return false;

                }

                if (($('.tes').val() != client) && $('.tes').val() != 0) {

                    alert('Il faut choisir des bon commandes pour un meme client SVP !!');
                    return false;

                }

            }
            if (test == 0) {
                //alert("fera8");
                $('.tes').val(0);
                $('.tespv').val(0);
                $('.testbl').val(99);
                $('.testp').val(55);
                $('.testcheck').hide();

            }
        });

    });
</script>



<script type="text/javascript">
    $j = jQuery.noConflict();

    $(document).ready(function() {


        // $j("#dialogcycle").dialog({
        //     autoOpen: false,
        //     width: 500,
        //     modal: true,

        //     open: function(event, ui) {
        //         originalContent = $("#dialogcycle").html();
        //         $j('.ui-widget-overlay').bind('click', function() {

        //             $j("#dialogcycle").dialog('close');
        //             $("#dialogcycle").html(originalContent);

        //         });
        //     }

        // });
        // $j('.opendialogcycle').on('click', function() {

        //     index = $(this).attr('index');
        //     id = $('#id' + index).val();
        //     validation = $('#validationTransport' + index).val();
        //     autorisation = $('#autorisationEnlevement' + index).val();

        //     // alert(validation);
        //     // alert(autorisation);


        //     if (validation == 1) {
        //         $('#checkboxvalidation').prop('checked', true);
        //     } else {
        //         $('#checkboxvalidation').prop('checked', false);
        //     }

        //     if (autorisation == 1) {
        //         $('#checkboxautorisation').prop('checked', true);
        //     } else {
        //         $('#checkboxautorisation').prop('checked', false);
        //     }


        //     $('#iddialog').val(id);
        //     $j("#dialogcycle").dialog('open');




        // });
    });
</script>