<?php $this->layout = 'AdminLTE.print'; ?>
<br>
<style>
    body {
        font-size: 12px;
    }

    table {
        font-size: 12px;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert');

use Cake\Datasource\ConnectionManager; ?>
<?php
$connection = ConnectionManager::get('default');
//$count = $connection->execute('SELECT count(deductios.id) AS count FROM deductios;')->fetchAll('assoc');
?>
<div style="display:flex;margin-top:-10px">
    <div style="margin-left:1%">
        <?php
        echo $this->Html->image('mm.png', ['alt' => 'CakePHP', 'height' => '70px', 'width' => '110px']); ?>
    </div>
    <div style="width: 40%;margin-left:2% ;text-align:center" align="center">

        <br>

        <br><br>
        Comptoir de Diffusion et de Fabrication
        <br>
        de Produits d'entretien SARL
    </div>
    <div style="width: 50%;margin-left:8%" align="left">
        <h5>
            <b>Siége Social:</b>3 Rue Mustapha Sfar Tunis Bélvédére 1002 <br>
            <b>Usine:</b>Rte Fouchana Chebedda Naassen 1135 Tunisie <br>
            <b>Tel:</b>+216 71 398 404/<b>Fax:</b>+216 71 398 137<br>
            <b>E-mail:</b>codifa@gnet.tn/<b>WEB:</b> www.codifa.tn <br>
            <b>R.C:</b>B0128802005/<b>M.F:</b>02940/X/A/M/000<br>
            <b>CCB:</b>01100028110500554697 ATB Rue du Plastique-Mégrine
        </h5>
    </div>
</div>
<div style="display:flex;margin-bottom:3px;" align="center">
    <!-- <div style="display:flex;width: 1000%;">
        <div style="width: 10000%;border:1px solid black;border-radius: 15px;background-color:#e6ebe3;" align="left">
            <br>
            <b style="margin-left:7% ;"> Code: </b><?= h($bonlivraison->client->Code) ?> <br>
            <b style="margin-left:7% ;"> Matricule fiscale :</b><?= h($bonlivraison->client->Matricule_Fiscale) ?> <br>
            <b style="margin-left:7% ;"> Client : </b> <?php
                                                        if (isset($bonlivraison->client)) {
                                                            echo  h($bonlivraison->client->Raison_Sociale);
                                                        } ?><br>
            <b style="margin-left:7% ;"> Adresse :</b><?= h($bonlivraison->client->Adresse) ?> <br>
        </div>
    </div> -->
    <!-- <div style="display:flex ;width:1000%;margin-left:10%;">
        <div style="width: 10000%;border:1px solid black;border-radius: 15px;background-color:#e6ebe3;" align="left">
            <br>
            <b style="margin-left:7% ;"> BON DE Livraison N° : </b><?= h($bonlivraison->numero) ?> <br>
            <b style="margin-left:7% ;"> Date : </b><?= $this->Time->format(
                                                        $bonlivraison->date,
                                                        'dd/MM/y'
                                                    ); ?> <br>
        </div>
    </div> -->
</div>
<div align="center" class="row" <?php if ($article->famille_id == 1) { ?> style='display:true' <?php } else { ?> style='display:none' <?php } ?> id="showhide00">
    <strong style="font-size: 20px ;"> Fiche technique</strong><br>
    <strong>Produits finis : <?php echo $article->Dsignation; ?> </strong>
    <br>
    <strong>Dépôt stock : </strong>
    <?php
    $depotstock_id = $article->depotstock_id;

    if (!empty($depotstock_id)) {
        $connection = ConnectionManager::get('default');
        $depotstock = $connection->execute("SELECT name  FROM depots WHERE id = " . $depotstock_id . ";")->fetchAll('assoc');
    }

    ?>

    <?= h($depotstock[0]['name']) ?>
    </strong>

    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;




    <strong>Dépôt production : </strong>


    <?php
    $depotprod_id = $article->depotprod_id;

    if (!empty($depotprod_id)) {
        $connection = ConnectionManager::get('default');
        $depotprod = $connection->execute("SELECT name  FROM depots WHERE id = " . $depotprod_id . ";")->fetchAll('assoc');
    }

    ?>
    <?= h($depotprod[0]['name']) ?>

</div>
<br>
<div id="fiche" class="col-md-12 " <?php if ($article->famille_id == 1) { ?> style='display:true' <?php } else { ?> style='display:none' <?php } ?>>
    <div class="panel panel-default">
        <!-- <div class="panel-heading">
                                            <h3 class="panel-title"><?php echo __('Fiche Article'); ?></h3>
                                         
                                        </div> -->
        <div class="panel-body">
            <table class="table table-bordered table-striped table-bottomless" align="center" style="border:1px solid black;width: 95%;border-radius: 15px 15px 15px 15px;border-collapse: collapse;">
                <thead>
                    <tr bgcolor="#EDEDED">
                        <td align="center" colspan="3" style="width: 70%;border:1px solid black;background-color:#b5d6d3;">Composant</td>
                        <td align="center" style="width: 20%;border:1px solid black;background-color:#b5d6d3;">Dépôt stock</td>
                        <td align="center" style="width: 20%;border:1px solid black;background-color:#b5d6d3;">Dépôt production</td>




                    </tr>
                </thead>
                <tbody>


                    <?php
                    //    debug($dat)
                    //    echo 
                    $i = -1;
                    foreach ($dat as $fech) {
                        $i++;
                        //debug($fech);
                    ?>
                        <tr>

                            <td align="left" colspan="3" style="width: 70%;border:1px solid black"> <?php
                                                                                                    $fichearticles = $connection->execute('SELECT * FROM articles WHERE id=' . $fech['article_id'] . ';')->fetchAll('assoc');
                                                                                                    //debug($fichearticles);
                                                                                                    foreach ($fichearticles as $key => $fichearticle) {
                                                                                                        //debug($fichearticle);
                                                                                                        $Dsignation = $fichearticle['Dsignation'];
                                                                                                        $code = $fichearticle['Code'];
                                                                                                        $unite_id = $fichearticle['unite_id'];
                                                                                                    }
                                                                                                    echo $code . ' ' . $Dsignation;
                                                                                                    //echo $this->Form->input('sup', array('name' => 'data[Ofsfligne][' . $i . '][sup]', 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'Ofsfligne', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'type' => 'hidden', 'after' => '</div>', 'class' => 'form-control'));
                                                                                                    //echo $this->Form->input('article_id', array('value' => $fech['article_id'], 'style' => 'width:250px', 'label' => '', 'id' => 'article_id' . $i, 'label' => '', 'name' => 'data[Ofsfligne][' . $i . '][article_id]', 'table' => 'Ofsfligne', 'champ' => 'article_id', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  select2', 'empty' => 'Veuillez choisir'));
                                                                                                    ?></td>
                            <!--                                                                     <td style="border:1px solid black;vertical-align:top;"></td>
 -->


                            <td align="center" style="width: 20%;border:1px solid black;">

                                <?php
                                $depotstock_id = $article->depotstock_id;

                                if (!empty($depotstock_id)) {
                                    $connection = ConnectionManager::get('default');
                                    $depotstock = $connection->execute("SELECT name  FROM depots WHERE id = " . $depotstock_id . ";")->fetchAll('assoc');
                                }

                                $date = date('Y-m-d H:i:s');


                                $qtedisp = $connection->execute("select stockbassem('" . $fech['article_id1'] . "','" . $date . "','0','" . $dep['id'] . "') as q")->fetchAll('assoc');
                                $stock = $qtedisp[0]['q'];


                                ?>
                                <?= h($depotstock[0]['name']) ?>
                                <br>
                                <br>
                                <?php echo   $stock = $qtedisp[0]['q']; ?>


                            </td>
                            <td align="center" style="width: 20%;border:1px solid black;">

                                <?php
                                $depotprod_id = $article->depotprod_id;

                                if (!empty($depotprod_id)) {
                                    $connection = ConnectionManager::get('default');
                                    $depotprod = $connection->execute("SELECT name  FROM depots WHERE id = " . $depotprod_id . ";")->fetchAll('assoc');
                                }

                                $date = date('Y-m-d H:i:s');


                                $qtedisp = $connection->execute("select stockbassem('" . $fech['article_id1'] . "','" . $date . "','0','" . $dep['id'] . "') as q")->fetchAll('assoc');
                                $stock = $qtedisp[0]['q'];

                                ?>
                                <?= h($depotprod[0]['name']) ?>
                                <br>
                                <?php echo   $stock = $qtedisp[0]['q']; ?>

                            </td>

                            <!-- <td align="center" style="width: 5%;border:1px solid black;">
                                <?php // if ($fech['Ligne'] != null) {
                                // echo $fech['coeff'];
                                // } 
                                ?>
                            </td> -->




                        </tr>
                        <?php if ($fech['Ligne'] != null) { ?>
                            <tr index="<?php echo $i; ?>" class="tr" align="centre">
                                <!--                                                 <td colspan="1" style="border:1px solid black;vertical-align:top;"></td>
 -->
                                <td champ="afef" class="afef" id="afef<?php echo $i; ?>" colspan="6" index="<?php echo $i; ?>" style="border:1px solid black;vertical-align:top;">
                                    <div class="panel panel-default" width="50%">

                                        <div class="panel-body" style="margin-left: 10%;">
                                            <table class="table table-bordered table-striped table-bottomless" id="addtableaa<?php echo $i; ?>" align="center" style="border:1px solid black;width: 100%;border-radius: 15px 15px 15px 15px;border-collapse: collapse;">

                                                <tbody>


                                                    <?php foreach ($fech['Ligne'] as $j => $fech1) {
                                                        //debug($fech1) ;                                                                     
                                                    ?>
                                                        <tr>
                                                            <td align="left" colspan="3" style="width:60%;border:1px solid black;vertical-align:top;">
                                                                <?php
                                                                $articlesss = $connection->execute('SELECT * FROM articles WHERE id=' . $fech1['article_id'] . ';')->fetchAll('assoc');
                                                                //debug($fichearticles);
                                                                foreach ($articlesss as $key => $articleee) {
                                                                    $Dsignation_fech1 = $articleee['Dsignation'];
                                                                    $code_fech1 = $articleee['Code'];
                                                                    $unite_fech1 = $articleee['unite_id'];
                                                                }
                                                                echo $code_fech1 . ' ' . $Dsignation_fech1;
                                                                //echo $this->Form->input('supp2', array('name' => 'data[Ofsfligne][' . $i . '][Phaseofsf][' . $j . '][supp2]', 'label' => '', 'type' => 'hidden', 'div' => 'form-group', 'indexligne' => $j, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'index' => $i, 'id' => 'supp2' . $i . '-' . $j, 'champ' => 'supp', 'indextype' => '', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                //echo $this->Form->input('id', array('value' => $fech1['id'], 'name' => 'data[Ofsfligne][' . $i . '][Phaseofsf][' . $j . '][id]', 'type' => 'hidden', 'label' => '', 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'personnel_id', 'id' => 'id' . $i . '-' . $j, 'indextype' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => ''));
                                                                //echo $this->Form->input('article_id', array('value' => $fech1['article_id'], 'name' => 'data[Ofsfligne][' . $i . '][Phaseofsf][' . $j . '][article_idt]', 'label' => '', 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'article_idt', 'id' => 'article_idt' . $i . '-' . $j, 'indextype' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control select2', 'empty' => 'Veuillez Choisir !!'));
                                                                ?> </td>
                                                            <!--                                                                                 <td style="border:1px solid black;vertical-align:top;"></td>
 -->


                                                            <td align="center" style="width: 20%;border:1px solid black;">

                                                                <?php
                                                                $depotstock_id = $article->depotstock_id;

                                                                if (!empty($depotstock_id)) {
                                                                    $connection = ConnectionManager::get('default');
                                                                    $depotstock = $connection->execute("SELECT name  FROM depots WHERE id = " . $depotstock_id . ";")->fetchAll('assoc');
                                                                }



                                                                $date = date('Y-m-d H:i:s');


                                                                $qtedisp = $connection->execute("select stockbassem('" . $fech['article_id1'] . "','" . $date . "','0','" . $dep['id'] . "') as q")->fetchAll('assoc');
                                                                $stock = $qtedisp[0]['q'];

                                                                ?>
                                                                <?= h($depotstock[0]['name']) ?>
                                                                <br>
                                                                <?php echo   $stock = $qtedisp[0]['q']; ?>


                                                            </td>
                                                            <td align="center" style="width: 20%;border:1px solid black;">




                                                                <?php
                                                                $depotprod_id = $article->depotprod_id;

                                                                if (!empty($depotprod_id)) {
                                                                    $connection = ConnectionManager::get('default');
                                                                    $depotprod = $connection->execute("SELECT name  FROM depots WHERE id = " . $depotprod_id . ";")->fetchAll('assoc');
                                                                }

                                                                $date = date('Y-m-d H:i:s');


                                                                $qtedisp = $connection->execute("select stockbassem('" . $fech['article_id1'] . "','" . $date . "','0','" . $dep['id'] . "') as q")->fetchAll('assoc');
                                                                $stock = $qtedisp[0]['q'];

                                                                ?>
                                                                <?= h($depotprod[0]['name']) ?>
                                                                <br>
                                                                <?php echo   $stock = $qtedisp[0]['q']; ?>
                                                            </td>
                                                            <!-- <td align="center" style="width:0%;border:1px solid black;vertical-align:top;">
                                                                <?php // if ($fech1['ligneligne'] != null) {
                                                                // echo $fech1['coeff'];
                                                                //  } 
                                                                ?>
                                                            </td> -->


                                                        </tr>
                                                        <?php if ($fech1['ligneligne'] != null) { ?>
                                                            <tr id="traaligne<?php echo $i ?>-<?php echo $j ?>" champ='traaligne'>
                                                                <td style="border:1px solid black;vertical-align:top;" colspan="6" id="afefligne<?php echo $i ?>-<?php echo $j ?>" champ="afefligne" class="afefligne <?php echo $i ?>-<?php echo $j ?>" id="afefligne<?php echo $i ?>-<?php echo $j ?>" index="<?php echo $i ?>">
                                                                    <div class="panel panel-default">

                                                                        <div class="panel-body" style="margin-left: 31%;">
                                                                            <table class="table table-bordered table-striped table-bottomless" index="<?php echo $i ?>" indexligneligne='<?php echo $j ?>' champ="addtableaaligne" id="addtableaaligne<?php echo $i ?>-<?php echo $j ?>" align="center" style="border:1px solid black;width: 100%;border-radius: 15px 15px 15px 15px;border-collapse: collapse;">

                                                                                <tbody>

                                                                                    <?php foreach ($fech1['ligneligne'] as $k => $fech2) {
                                                                                        ///debug($fech2);
                                                                                    ?>
                                                                                        <tr>
                                                                                            <td align="left" style="width: 45%;border:1px solid black;vertical-align:top;"> <?php
                                                                                                                                                                            $articlefichesss = $connection->execute('SELECT * FROM articles WHERE id=' . $fech2['article_id'] . ';')->fetchAll('assoc');
                                                                                                                                                                            //debug($fichearticles);
                                                                                                                                                                            foreach ($articlefichesss as $key => $articleficheee) {
                                                                                                                                                                                $Dsignation_fech2 = $articleficheee['Dsignation'];
                                                                                                                                                                                $code_fech2 = $articleficheee['Code'];
                                                                                                                                                                                $unite_fech2 = $articleficheee['unite_id'];
                                                                                                                                                                            }
                                                                                                                                                                            echo $code_fech2 . ' ' . $Dsignation_fech2;
                                                                                                                                                                            // echo $this->Form->input('supp3', array('name' => 'data[Ofsfligne][' . $i . '][Phaseofsf][' . $j . '][Phaseofsfligne][' . $k . '][supp3]', 'type' => 'hidden', 'label' => '', 'indexligneligne' => $k, 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'supp3', 'id' => 'supp3' . $i . '-' . $j . '-' . $k, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));


                                                                                                                                                                            //echo $this->Form->input('article_id', array('value' => $fech2['article_id'], 'name' => 'data[Ofsfligne][' . $i . '][Phaseofsf][' . $j . '][Phaseofsfligne][' . $k . '][article_idd]', 'label' => '', 'indexligneligne' => $k, 'indexligne' => $j, 'index' => $i, 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'tableligneligne' => 'Phaseofsfligne', 'champ' => 'article_idd', 'id' => 'article_idd' . $i . '-' . $j . '-' . $k, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control select2', 'empty' => 'Veuillez Choisir !!', "style" => "width:100% ; height:32px"));
                                                                                                                                                                            ?> </td>

                                                                                            <td align="center" style="width: 20%;border:1px solid black;">

                                                                                                <?php
                                                                                                $depotstock_id = $article->depotstock_id;

                                                                                                if (!empty($depotstock_id)) {
                                                                                                    $connection = ConnectionManager::get('default');
                                                                                                    $depotstock = $connection->execute("SELECT name  FROM depots WHERE id = " . $depotstock_id . ";")->fetchAll('assoc');
                                                                                                }


                                                                                                $date = date('Y-m-d H:i:s');


                                                                                                $qtedisp = $connection->execute("select stockbassem('" . $fech1['article_id1'] . "','" . $date . "','0','" . $dep['id'] . "') as q")->fetchAll('assoc');
                                                                                                $stock = $qtedisp[0]['q'];

                                                                                                ?>
                                                                                                <?= h($depotstock[0]['name']) ?>
                                                                                                <br>
                                                                                                <?php echo   $stock  ?>
                                                                                            </td>
                                                                                            <td align="center" style="width: 20%;border:1px solid black;">
                                                                                                <?php
                                                                                                $depotprod_id = $article->depotprod_id;

                                                                                                if (!empty($depotprod_id)) {
                                                                                                    $connection = ConnectionManager::get('default');
                                                                                                    $depotprod = $connection->execute("SELECT name  FROM depots WHERE id = " . $depotprod_id . ";")->fetchAll('assoc');
                                                                                                }
                                                                                                $date = date('Y-m-d H:i:s');
                                                                                                $qtedisp = $connection->execute("select stockbassem('" . $fech['article_id1'] . "','" . $date . "','0','" . $dep['id'] . "') as q")->fetchAll('assoc');
                                                                                                $stock = $qtedisp[0]['q'];
                                                                                                ?>
                                                                                                <?= h($depotprod[0]['name']) ?>
                                                                                                <br>
                                                                                                <?php echo   $stock  ?>
                                                                                            </td>
                                                                                            <!-- <td align="center" style="width: 0%;border:1px solid black;vertical-align:top;"> -->

                                                                                            <!-- </td> -->

                                                                                        </tr>
                                                                                    <?php } ?>
                                                                                </tbody>
                                                                            </table>
                                                                            <input type="hidden" value="<?php echo $k ?>" class="" id="indexaligne<?php echo $i ?>-<?php echo $j ?>" champ="indexaligne" />
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <input type="hidden" value="<?php echo $j ?>" id="indexa<?php echo $i ?>" />
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                    <input type="hidden" value="<?php echo $i ?>" id="index" />
                </tbody>
            </table>
        </div>
    </div>