<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php


echo $this->Html->script('hechem'); ?>
<?php echo $this->Html->css('select2'); ?>

<?php

use Cake\Datasource\ConnectionManager;
?>
<section class="content-header">
  <h1 style="margin-top: 18px;">
    Ajouter préparatif
    <small><?php echo __(''); ?></small>
  </h1>

  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['controller' => 'commandes',  'action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
</section>
<?php echo $this->Form->create($bonlivraison, ['role' => 'form']); ?>
<section class="content" style="width: 99%">
  <div class="row">
    <div class="box box-primary">
      <div class="box-header with-border">

      </div>
      <div class="panel-body">
        <div class="table-responsive ls-table">
          <?php foreach ($dat as $i  => $com) {
            $date = date("Y-m-d H:i:s", strtotime(str_replace('-', '/',  $com['date'])));          ?>

            <?php if ($com['etatliv'] != '2') { ?>


              <table class="table table-bordered table-striped table-bottomless" style="width:100%" align="center" id="addtable">
                <thead>
                  <th width="20%">Numero</th>
                  <th width="20%">Date</th>
                  <th width="20%">Client</th>
                  <th width="20%">Commercial</th>
                  <th width="20%">Depot</th>
                </thead>

                <tbody>

                  <tr>
                    <input type="hidden" id="<?php echo 'id' . $i ?>" name="<?php echo 'dat[ligner][' . $i . '][id]' ?>" value="<?php echo $com['id']  ?>" table="ligner" name="" champ="id" class="form-control" index="<?php echo  $i ?>">
                    <input type="hidden" id="<?php echo '' . $i ?>" name="<?php echo 'dat[ligner][' . $i . '][etatliv]' ?>" value="<?php echo $com['etatliv']  ?>" table="ligner" name="" champ="" class="form-control" index="<?php echo  $i ?>">
                    <input readonly type="hidden" id="<?php echo 'nouv_client' . $i ?>" name="<?php echo 'dat[ligner][' . $i . '][nouv_client]'  ?>" value="<?php echo $com['nouv_client']  ?>" table="ligner" champ="nouv_client" class="form-control  " index="<?php echo  $i ?>">



                    <td table="ligner">

                      <input readonly id="<?php echo 'numero' . $i ?>" name="<?php echo 'dat[ligner][' . $i . '][numero]'  ?>" value="<?php echo $com['numero']  ?>" table="ligner" type="text" name="" champ="numero" class="form-control" index="<?php echo  $i ?>">
                    </td>
                    <td table="ligner">

                      <input readonly id="<?php echo 'date' . $i ?>" name="<?php echo 'dat[ligner][' . $i . '][date]'  ?>" value="<?php echo $date  ?>" table="ligner" type="text" name="" champ="date" class="form-control " index="<?php echo  $i ?>">
                    </td>
                    <td table="ligner">

                      <input readonly id="<?php echo 'client' . $i ?>" name="<?php echo 'dat[ligner][' . $i . '][Raison_Sociale]'  ?>" value="<?php echo $com['Raison_Sociale']  ?>" table="ligner" type="text" name="" champ="Raison_Sociale" class="form-control " index="<?php echo  $i ?>">
                    </td>

                    <td table="ligner">

                      <input readonly id="<?php echo 'comm' . $i ?>" name="<?php echo 'dat[ligner][' . $i . '][commercial]'  ?>" value="<?php echo $com['commercial']  ?>" table="ligner" type="text" name="" champ="Raison_Sociale" class="form-control " index="<?php echo  $i ?>">
                    </td>
                    <td table="ligner">

                      <input readonly type="text" id="<?php echo 'depot' . $i ?>" name="<?php echo 'dat[ligner][' . $i . '][depot]'  ?>" value="<?php echo $com['depot']  ?>" table="ligner" champ="depot" class="form-control  " index="<?php echo  $i ?>">


                    </td>

                    <div class="col-xs-3">
                      <input type="hidden" id="<?php echo 'client_id' . $i ?>" name="<?php echo 'dat[ligner][' . $i . '][client_id]'  ?>" value="<?php echo $com['client_id']  ?>" table="ligner" champ="client_id" class="form-control  " index="<?php echo  $i ?>">
                      <input type="hidden" id="<?php echo 'commercial_id' . $i ?>" name="<?php echo 'dat[ligner][' . $i . '][commercial_id]'  ?>" value="<?php echo $com['commercial_id']  ?>" table="ligner" champ="commercial_id" class="form-control  " index="<?php echo  $i ?>">
                      <input type="hidden" id="<?php echo 'depot_id' . $i ?>" name="<?php echo 'dat[ligner][' . $i . '][depot_id]'  ?>" value="<?php echo $com['depot_id']  ?>" table="ligner" champ="depot_id" class="form-control  " index="<?php echo  $i ?>">


                    </div>



                    <td table="ligner">

                      <input type="hidden" id="<?php echo 'commercial' . $i ?>" name="<?php echo 'dat[ligner][' . $i . '][name]'  ?>" value="<?php echo $com['name']  ?>" table="ligner" type="text" name="" champ="name" class="form-control " index="<?php echo  $i ?>">
                    </td>


                    <input type="hidden" id="<?php echo 'valeurdepts' . $i ?>" name="<?php echo 'dat[ligner][' . $i . '][valeurdepts]'  ?>" value="<?php echo $com['valeurdepts']  ?>" table="ligner" name="" champ="valeurdepts" class="form-control " index="<?php echo  $i ?>">



                    <input type="hidden" id="<?php echo 'palette' . $i ?>" name="<?php echo 'dat[ligner][' . $i . '][pallette]'  ?>" value="<?php echo $com['pallette']  ?>" table="ligner" name="" champ="name" class="form-control " index="<?php echo  $i ?>">
                    <input type="hidden" id="<?php echo 'Poids' . $i ?>" name="<?php echo 'dat[ligner][' . $i . '][Poids]'  ?>" value="<?php echo $com['Poids']  ?>" table="ligner" name="" champ="name" class="form-control " index="<?php echo  $i ?>">
                    <input type="hidden" id="<?php echo 'coeff' . $i ?>" name="<?php echo 'dat[ligner][' . $i . '][Coeff]'  ?>" value="<?php echo $com['Coeff']  ?>" table="ligner" name="" champ="name" class="form-control " index="<?php echo  $i ?>">
                    <input type="hidden" id="<?php echo 'nbligne' . $i ?>" name="<?php echo 'dat[ligner][' . $i . '][nbligne]'  ?>" value="<?php echo $com['nbligne']  ?>" table="ligner" name="" champ="name" class="form-control " index="<?php echo  $i ?>">

                  </tr>


                  <?php
                  $nbCarton = 0;
                  $totalCarton = 0;
                  $totalPoids = 0;

                  error_reporting(E_ERROR | E_PARSE);
                  foreach ($dat[$i]['Ligne'] as $k => $ligne) {

                    $qte = $ligne['qte'];
                    $np = $ligne['nombrepiece'];
                    $poids = $ligne['Poids'];

                    $poidsCommande = $qte * $poids;
                    //debug($poidsCommande) ; die ; 
                    if ($qte) {
                      $nbCarton = $np / $qte;
                    }

                    //debug($nb_carte) ; die ; 
                    $totalCarton =  sprintf("%.3f", $totalCarton + $nbCarton);


                    $totalPoids = sprintf("%.3f", $totalPoids + $poidsCommande);
                    //debug($totalPoids) ; 


                  ?>
                  <?php }
                  ?>


                  <input type="hidden" class=" form-control calculnbcarton" id="<?php echo 'nbcarton' . $i ?>" value="<?php echo $totalCarton ?>" name="<?php echo 'dat[ligner][' . $i . '][nbcartons]'  ?>">
                  <input type="hidden" class=" form-control gettotalpoids " id="<?php echo 'poids_commande' . $i ?>" value="<?php echo $totalPoids ?>" name="<?php echo 'dat[ligner][' . $i . '][poidstotal]'  ?>">



        </div>
      </div>



      </tbody>


      <tbody>

        <table class="table table-bordered table-striped table-bottomless" style="width:100%" align="center">

          <tbody>

            <th width="35%">Article</th>
            <th width="15%">Qte stock</th>
            <th width="15%">Quantité</th>
            <th width="15%">Quantité livrée</th>
            <th width="10%">Poids</th>
            <th width="10%">Nb Pieces</th>


            <?php
              $k = -1;

              $totalfodec = 0;
              $totaltva = 0;
              $totalremise = 0;
              $totalht = 0;

              $commission =  0;

              error_reporting(E_ERROR | E_PARSE);
              foreach ($dat[$i]['Ligne'] as $ligne)


              //debug($ligne);
              {
                //debug($ligne);
                $lignecid = $ligne['lignecommande_id'];
                // debug($lignecid);

                $qte = $ligne['qte'];


                $np = $ligne['nombrepiece'];

                $poids = $ligne['Poids'];

                $qp = $qte * $poids;

                if ($qte != 0) {
                  $nbCarton = $np / $qte;
                }

                $somme =  sprintf("%.3f", $qp + $somme);



                $sommeCarton =  sprintf("%.3f", $sommeCarton + $nbCarton);

                $totalfodec = $totalfodec  + $ligne['fodec'];
                $totaltva = $totaltva  + $ligne['tva'];
                $totalremise = $totalremise  + $ligne['totremiseclient'];

                $totalht = $totalht  + $ligne['montantht'];

                $articleid =  $ligne['article_id'];
                //debug($articleid);
                $depotid = $com['depot_id'];

                //debug($articleid);
                date_default_timezone_set('Africa/Tunis');
                $date = date('Y-m-d H:i:s');


                $connection = ConnectionManager::get('default');
                $qtel = $connection->execute('SELECT SUM(lignebonlivraisons.quantiteliv)  as q FROM lignebonlivraisons where lignebonlivraisons.lignecommande_id=' . $ligne['lignecommande_id'] . ' ;')->fetchAll('assoc');
                $inv = $connection->execute("select stockbassem(" . $articleid . ",'" . $date . "','0'," . $depotid . " ) as v")->fetchAll('assoc');
                $stockk = $inv[0]['v'];
                $q = $qtel[0]['q'];
                //debug($q);
                if ($q == null) {
                  $q = 0;
                }

                $liv = ($qte - $q);






                $nbpts = $ligne['nbpoint'];
                $valpts =  $ligne['categorieclient'];

                /// debug($valpts);


                $commission = $qte * $nbpts *  $valpts;

                $nv_client =  $com['nouv_client'];

                ///debug($bonus);
                /// debug( $nv_client);
                if ($nv_client == 'TRUE') {
                  $valeurtaux = $commission * $bonus / 100;
                  $commission = $commission + $valeurtaux;
                }

                ////debug($commission);



            ?>

              <?php if ($liv > 0) {
                  $k++;
              ?>
                <tr>

                  <td align="center" table="ligner">
                    <input readonly id="<?php echo 'article' . $i  . '-' . $k   ?>" indexligne="<?php echo  $k ?>" index="<?php echo  $i ?>" name="<?php echo 'dat[ligner][' . $i . '][article][' . $k . '][Dsignation]'  ?>" value="<?php echo $ligne['Dsignation'] ?>" table="ligner" type="text" name="" champ="Dsignation" class="form-control">
                    <input type="hidden" id="<?php echo 'article' . $i  . '-' . $k   ?>" indexligne="<?php echo  $k ?>" index="<?php echo  $i ?>" name="<?php echo 'dat[ligner][' . $i . '][article][' . $k . '][Dsignation]'  ?>" value="<?php echo $ligne['Dsignation'] ?>" table="ligner" type="text" name="" champ="Dsignation" class="form-control">
                    <input type="hidden" id="<?php echo '' . $i  . '-' . $k   ?>" indexligne="<?php echo  $k ?>" index="<?php echo  $i ?>" name="<?php echo 'dat[ligner][' . $i . '][article][' . $k . '][ligneid]'  ?>" value="<?php echo $ligne['lignecommande_id'] ?>" table="ligner" type="text" name="" champ="" class="form-control">


                  </td>
                  <td>
                    <input readonly type="text" id="<?php echo 'qtestock' . $i . '-' . $k ?>" indexligne="<?php echo  $k ?>" index="<?php echo  $i ?>" name="<?php echo 'dat[ligner][' . $i . '][article][' . $k . '][qtestock]'  ?>" value="<?php echo $stockk; ?>" table="ligner" type="text" name="" champ="qtestock" class="form-control">

                  </td>
                  <td align="center" table="ligner">
                    <input type="hidden" id="<?php echo 'article_id' . $i  . '-' . $k   ?>" indexligne="<?php echo  $k ?>" index="<?php echo  $i ?>" name="<?php echo 'dat[ligner][' . $i . '][article][' . $k . '][article_id]'  ?>" value="<?php echo $ligne['article_id'] ?>" table="ligner" type="text" name="" champ="article_id" class="form-control">

                    <input type="hidden" index="<?php echo  $i ?>" indexligne="<?php echo  $k ?>" id="<?php echo 'poids' . $i . '-' . $k  ?>" name="<?php echo 'dat[ligner][' . $i . '][article][' . $k . '][Poids]'  ?>" value="<?php echo $ligne['Poids'] ?>" table="ligner" type="text" name="" champ="Poids" class="form-control">

                    <input readonly id="<?php echo 'qte' . $i . '-' . $k ?>" indexligne="<?php echo  $k ?>" index="<?php echo  $i ?>" name="<?php echo 'dat[ligner][' . $i . '][article][' . $k . '][qte]'  ?>" value="<?php echo $ligne['qte'] ?>" table="ligner" type="number" name="" champ="qte" class="form-control ">
                  </td>
                  <td align="center" table="ligner">
                    <input id="<?php echo 'qteliv' . $i . '-' . $k ?>" indexligne="<?php echo  $k ?>" index="<?php echo  $i ?>" name="<?php echo 'dat[ligner][' . $i . '][article][' . $k . '][quantiteliv]'  ?>" value="<?php if ($liv >= 0) {
                                                                                                                                                                                                                            echo $liv;
                                                                                                                                                                                                                          } else {
                                                                                                                                                                                                                            echo '0';
                                                                                                                                                                                                     } ?>" table="ligner" type="number" name="" champ="quantiteliv" class="form-control  calculcommiss 	 calculnbcarton gettotal gettotalpoids ">
                  </td>
                  <td align="center" table="ligner">
                    <input readonly id="<?php echo 'poids' . $i . '-' . $k ?>" indexligne="<?php echo  $k ?>" index="<?php echo  $i ?>" name="<?php echo 'dat[ligner][' . $i . '][article][' . $k . '][poid]'  ?>" value="<?php echo $ligne['Poids'] ?>" table="ligner" name="" champ="poid" class="form-control  ">


                    <input type="hidden" id="<?php echo 'prix' . $i . '-' . $k ?>" indexligne="<?php echo  $k ?>" index="<?php echo  $i ?>" name="<?php echo 'dat[ligner][' . $i . '][article][' . $k . '][prix]'  ?>" value="<?php echo $ligne['prix'] ?>" table="ligner" name="" champ="prix" class="form-control gettotal ">

                    <input type="hidden" id="<?php echo 'remise_client' . $i . '-' . $k ?>" indexligne="<?php echo  $k ?>" index="<?php echo  $i ?>" name="<?php echo 'dat[ligner][' . $i . '][article][' . $k . '][remise]'  ?>" value="<?php echo $com['remise'] ?>" table="ligner" name="" champ="remise_client" class="form-control gettotal ">

                    <input type="hidden" id="<?php echo 'remise_article' . $i . '-' . $k ?>" indexligne="<?php echo  $k ?>" index="<?php echo  $i ?>" name="<?php echo 'dat[ligner][' . $i . '][article][' . $k . '][remise]'  ?>" value="<?php echo $ligne['remise'] ?>" table="ligner" name="" champ="remise_article" class="form-control gettotal ">

                    <input type="hidden" id="<?php echo 'tva' . $i . '-' . $k ?>" indexligne="<?php echo  $k ?>" index="<?php echo  $i ?>" name="<?php echo 'dat[ligner][' . $i . '][article][' . $k . '][tva]'  ?>" value="<?php echo $ligne['tva'] ?>" table="ligner" type="text" name="" champ="tva" id='tva' class="form-control">
                    <input type="hidden" id="<?php echo 'ttc' . $i . '-' . $k ?>" indexligne="<?php echo  $k ?>" index="<?php echo  $i ?>" name="<?php echo 'dat[ligner][' . $i . '][article][' . $k . '][ttc]'  ?>" value="<?php echo $ligne['ttc'] ?>" table="ligner" type="text" name="" champ="total" id='tva' class="form-control ">

                    <input type="hidden" id="<?php echo 'totalttc' . $i . '-' . $k ?>" indexligne="<?php echo  $k ?>" index="<?php echo  $i ?>" name="<?php echo 'dat[ligner][' . $i . '][article][' . $k . '][totalttc]'  ?>" value="<?php echo $ligne['totalttc'] ?>" table="ligner" type="text" name="" champ="totalttc" class="form-control ">


                    <input type="hidden" id="<?php echo 'fodec' . $i . '-' . $k ?>" indexligne="<?php echo  $k ?>" index="<?php echo  $i ?>" name="<?php echo 'dat[ligner][' . $i . '][article][' . $k . '][fodec]'  ?>" value="<?php echo $ligne['fodec'] ?>" table="ligner" type="text" name="" champ="fodec" class="form-control">

                    <input type="hidden" id="<?php echo 'TXTPE' . $i . '-' . $k ?>" indexligne="<?php echo  $k ?>" index="<?php echo  $i ?>" name="<?php echo 'dat[ligner][' . $i . '][article][' . $k . '][TXTPE]'  ?>" value="<?php echo $ligne['TXTPE'] ?>" table="ligner" type="text" name="" champ="TXTPE" class="form-control">

                    <input type="hidden" id="<?php echo 'montantht' . $k . '-' . $i ?>" indexligne="<?php echo  $k ?>" index="<?php echo  $i ?>" name="<?php echo 'dat[ligner][' . $i . '][article][' . $k . '][montantht]'  ?>" value="<?php echo $ligne['montantht'] ?>" table="ligner" type="text" name="" champ="montantht" class="form-control">

                    <input type="hidden" id="<?php echo 'remise' . $k . '-' . $i ?>" indexligne="<?php echo  $k ?>" index="<?php echo  $i ?>" name="<?php echo 'dat[ligner][' . $i . '][article][' . $k . '][remiseclient]'  ?>" value="<?php echo $ligne['remiseclient'] ?>" table="ligner" type="text" name="" champ="remise" id='' class="form-control">
                    <input type="hidden" id="<?php echo 'totremiseclient' . $k . '-' . $i ?>" indexligne="<?php echo  $k ?>" index="<?php echo  $i ?>" name="<?php echo 'dat[ligner][' . $i . '][article][' . $k . '][totremiseclient]'  ?>" value="<?php echo $ligne['totremiseclient'] ?>" table="ligner" type="text" name="" champ="remise" id='' class="form-control">

                    <input type="hidden" id="<?php echo 'escompte' . $k . '-' . $i ?>" indexligne="<?php echo  $k ?>" index="<?php echo  $i ?>" name="<?php echo 'dat[ligner][' . $i . '][article][' . $k . '][escompte]'  ?>" value="<?php echo $ligne['escompte'] ?>" table="ligner" type="text" name="" champ="" id='' class="form-control">
                    <input type="hidden" id="<?php echo 'pourcentageescompte' . $k . '-' . $i ?>" indexligne="<?php echo  $k ?>" index="<?php echo  $i ?>" name="<?php echo 'dat[ligner][' . $i . '][article][' . $k . '][pourcentageescompte]'  ?>" value="<?php echo $ligne['pourcentageescompte'] ?>" table="ligner" type="text" name="" champ="remise" id='' class="form-control">

                  </td>
                  <td align="center" table="ligner">
                    <input readonly id="<?php echo 'nbrepiece' . $i  . '-' . $k   ?>" indexligne="<?php echo  $k ?>" index="<?php echo  $i ?>" name="<?php echo 'dat[ligner][' . $i . '][article][' . $k . '][nombrepiece]'  ?>" value="<?php echo $ligne['nombrepiece'] ?>" table="ligner" type="text" name="" champ="nombrepiece" class="form-control ">
                    <input  readonly id="<?php echo 'nbpoint' . $i  . '-' . $k   ?>" indexligne="<?php echo  $k ?>" index="<?php echo  $i ?>" name="<?php echo 'dat[ligner][' . $i . '][article][' . $k . '][nbpoint]'  ?>" value="<?php echo $ligne['nbpoint'] ?>" table="ligner" type="hidden" name="" champ="nbpoint" class="form-control ">
                    <input  type="hidden" readonly id="<?php echo 'categorieclient' . $k . '-' . $i ?>" indexligne="<?php echo  $k ?>" index="<?php echo  $i ?>" name="<?php echo 'dat[ligner][' . $i . '][article][' . $k . '][categorieclient]'  ?>" value="<?php echo $ligne['categorieclient'] ?>" table="ligner" champ="categorieclient" class="form-control">


                    <input type="hidden"  readonly id="<?php echo 'montantcommission' . $i  . '-' . $k   ?>" indexligne="<?php echo  $k ?>" index="<?php echo  $i ?>" name="<?php echo 'dat[ligner][' . $i . '][article][' . $k . '][montantcommission]'  ?>" value="<?php echo $commission ?>" table="ligner"  name="" champ="montantcommission" class="form-control ">

                  </td>

                <?php } ?>



                </tr>
              <?php  }    ?>

        </table>
        <div>
          <input type="hidden" value="<?php echo $k; ?>" id="indexa<?php echo $i; ?>" />



          <div class="col-xs-3">

            <input type="hidden" id="<?php echo 'totalc' . $i ?>" name="<?php echo 'dat[ligner][' . $i . '][total]'  ?>" value="<?php echo $com['total']  ?>" table="ligner" type="text" name="" champ="total" class="form-control gettotal " index="<?php echo  $i ?>">
          </div>
          <div class="col-xs-3">

            <input type="hidden" id="<?php echo 'ttc' . $i ?>" name="<?php echo 'dat[ligner][' . $i . '][totalttc]'  ?>" value="<?php echo $com['totalttc']  ?>" table="ligner" type="text" name="" champ="totalttc" class="form-control gettotal" index="<?php echo  $i ?>">
            <input type="hidden" id="<?php echo 'escompte' . $i ?>" name="<?php echo 'dat[ligner][' . $i . '][escompte]'  ?>" value="<?php echo $com['escompte']  ?>" table="ligner" type="text" name="" champ="" class="form-control " index="<?php echo  $i ?>">

          </div>
          <div class="col-xs-3">

            <input type="hidden" id="<?php echo 'totalremise' . $i ?>" name="<?php echo 'dat[ligner][' . $i . '][totalremise]'  ?>" value="<?php echo $totalremise  ?>" table="ligner" type="text" name="" champ="remise" class="form-control" index="<?php echo  $i ?>">
          </div>
          <div class="col-xs-3">

            <input type="hidden" id="<?php echo 'totaltva' . $i ?>" name="<?php echo 'dat[ligner][' . $i . '][totaltva]'  ?>" value="<?php echo $totaltva  ?>" table="ligner" type="text" name="" champ="totaltva" class="form-control" index="<?php echo  $i ?>">
          </div>
          <div class="col-xs-3">

            <input type="hidden" id="<?php echo 'totalfodec' . $i ?>" name="<?php echo 'dat[ligner][' . $i . '][totalfodec]'  ?>" value="<?php echo $totalfodec  ?>" table="ligner" type="text" name="" champ="totalfodec" class="form-control" index="<?php echo  $i ?>">
          </div>
          <div class="col-xs-3">

            <input type="hidden" id="<?php echo 'totalht' . $i ?>" name="<?php echo 'dat[ligner][' . $i . '][totalht]'  ?>" value="<?php echo $totalht  ?>" table="ligner" type="text" name="" champ="totalht" class="form-control" index="<?php echo  $i ?>">
          </div>

        </div>
      <?php } ?>

    <?php } ?>

    </div>

    </tbody>
    </table>


    <div class="row" style="float: right;">
      <div class="col-xs-6">
        <label>Poids total </label>
        <input readonly class=" form-control gettotalpoids  " id="somme_id" name='dat[poids]' value="<?php echo $somme ?>">

      </div>
      <div class="col-xs-6">
        <label>Nbr total du cartons</label>
        <input readonly class=" form-control calculnbcarton  " id="totalcarton" name='dat[nbcarton]' value="<?php echo $sommeCarton   ?>">

      </div>
    </div>

    <br><br><br>
    <input readonly type="hidden"  id="bonus"  value="<?php echo $bonus?>">


    <section class="content" style="width: 100% ;">

      <div class="row">

        <div class="col-xs-6">
          <label> Materiel de transport</label>
          <select table="ligner" index id="matricule_id" champ="matricule" class="form-control materielpoids verifpoids select2 " name="<?php echo 'dat[materieltransport_id]'  ?>">
            <option value="" selected="selected">Veuillez choisir !!</option>
            <?php foreach ($materieltransports as $id => $materieltransport) {
            ?>
              <option value="<?php echo $id; ?>"><?php echo  $materieltransport ?></option>
            <?php } ?>
          </select>

        </div>

        <div class="col-xs-6">
          <label> Poids </label>
          <input type="text" class="form-control" readonly id="poids-materiel">

        </div>
        <br>

      </div>
      <br><br>

      <div class="row">
        <div class="col-xs-6">
          <label> Chauffeur </label>
          <select table="ligner" index id="chauffeur_id" class="form-control select2  " name="<?php echo 'dat[chauffeur_id]'  ?>">
            <option value="" selected="selected">Veuillez choisir !!</option>
            <?php foreach ($chauffeurs as $id => $chauffeur) {
            ?>
              <option value="<?php echo  $chauffeur->id; ?>"><?php echo  $chauffeur->nom ?> </option>
            <?php } ?>
          </select>
        </div>

        <div class="col-xs-6">
          <label> Convoyeur </label>
          <select table="ligner" index id="convoyeur_id" class="form-control select2" name="<?php echo 'dat[convoyeur_id]'  ?>">
            <option value="" selected="selected">Veuillez choisir !!</option>
            <?php foreach ($conffaieurs as $id => $conffaieur) {
            ?>
              <option value="<?php echo  $conffaieur->id; ?>"><?php echo  $conffaieur->nom ?> </option>
            <?php } ?>
          </select>
        </div>

      </div>



    </section>

    <input type="hidden" value="<?php echo $i ?>" id="index">
    <div align="center">
      <button type="submit" class="pull-right btn btn-success  verifqtelivre" id="boutonpreparatif" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>

    </div>
    <?php echo $this->Form->end(); ?>

  </div>

  </div>
  </div>

  </div>

</section>


<script type="text/javascript">
  $(function() {

   




    $('.materielpoids').on('change', function() {
      // alert('gg') ;


      matricule_id = $('#matricule_id').val() || 0;
      //alert(matricule_id) ; 



      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Bonlivraisons', 'action' => 'getpoidsmarticule']) ?>",
        dataType: "json",
        data: {
          idMarticule: matricule_id,
        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data, status, settings) {

          $('#poids-materiel').val(data["poids"]);
          poidsMat = $('#poids-materiel').val();
          poidsCommande = $('#somme_id').val();
          //alert(poidsMat) ; 
          // alert(poidsCommande) ; 
          if ((Number(poidsCommande) > Number(poidsMat))) {

            alert('Le poids du bonde commande  doit etre inferieur au poids du materiel de transport ')

          }

        }


      })

    });




    $('#boutonpreparatif').on('mousemove', function() {
      matricule = $('#matricule_id').val() || 0;

      chauffeur = $('#chauffeur_id').val() || 0;

      conffaieur = $('#convoyeur_id').val() || 0;

      poidsMat = $('#poids-materiel').val() || 0;

      poidsCom = $('#somme_id').val() || 0;
      if (matricule == '') {
        alert('choisir un materiel de transport SVP', function() {});
      } else if (chauffeur == '') {
        alert('choisir un chauffeur SVP', function() {});

      } else if (conffaieur == '') {
        alert('choisir un convoyeur SVP', function() {});

      } else if ((Number(poidsCom) > Number(poidsMat))) {
        alert(' vérifier le poids du votre commande SVP', function() {});
      }


    });





  });
</script>


<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
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
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-daterangepicker/daterangepicker', ['block' => 'css']); ?>
<!-- bootstrap datepicker -->
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min', ['block' => 'css']); ?>
<!-- iCheck for checkboxes and radio inputs -->
<?php echo $this->Html->css('AdminLTE./plugins/iCheck/all', ['block' => 'css']); ?>
<!-- Bootstrap Color Picker -->
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min', ['block' => 'css']); ?>
<!-- Bootstrap time Picker -->
<?php echo $this->Html->css('AdminLTE./plugins/timepicker/bootstrap-timepicker.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<!-- InputMask -->
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask.date.extensions', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask.extensions', ['block' => 'script']); ?>
<!-- date-range-picker -->
<?php echo $this->Html->script('AdminLTE./bower_components/moment/min/moment.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-daterangepicker/daterangepicker', ['block' => 'script']); ?>
<!-- bootstrap datepicker -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min', ['block' => 'script']); ?>
<!-- bootstrap color picker -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min', ['block' => 'script']); ?>
<!-- bootstrap time picker -->
<?php echo $this->Html->script('AdminLTE./plugins/timepicker/bootstrap-timepicker.min', ['block' => 'script']); ?>
<!-- iCheck 1.0.1 -->
<?php echo $this->Html->script('AdminLTE./plugins/iCheck/icheck.min', ['block' => 'script']); ?>

<?php $this->start('scriptBottom'); ?>
<script>
  $(function() {
    //Initialize Select2 Elements
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
    //Date range as a button
    $('#daterange-btn').daterangepicker({
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
      },
      function(start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
<?php $this->end(); ?>