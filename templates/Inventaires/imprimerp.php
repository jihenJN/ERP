<?php $this->layout = 'AdminLTE.print'; ?>
<?php

use Cake\Core\Configure;
use Cake\I18n\FrozenTime;
use Cake\Datasource\ConnectionManager;
?>

<?php $connection = ConnectionManager::get('default'); ?>
<br>

<style type="text/css" media="print">
  html,
  body {
    height: auto;
  }

  @media print {
    body {
      -webkit-print-color-adjust: exact;
    }
  }
</style>
<style>
  body {
    font-size: 11px;
  }

  table {
    font-size: 12px;
  }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<?php echo $this->Html->script('hechem'); ?>
<?php echo $this->Html->script('salma'); ?>
<div>
  <div>
    <?php
    echo $this->Html->image('mm.png', ['alt' => 'CakePHP', 'height' => '110px', 'width' => '200px']); ?>
  </div>
  <div align="left">
    Société CODIFA <br>
    Rte Fouchana 1.8 km 1135 naassen <br>
    Phone : (+216) 71 398 404 / (+216) 71 398 158 <br>
    Mail : codifa@gnet.tn <br>
  </div>
</div>
<br><br><br>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th width="10%" align="center"> Reference </th>
              <th width="10%" align="center"> Designation </th>
              <th width="10%" align="center"> Besoin </th>
              <th width="10%" align="center"> Stock </th>
              <th width="10%" align="center"> Total besoin achat </th>
            </tr>
          </thead>
          <tbody>
            <?php $j = 0;
            $quantitestock = 0;
            $quantitestockk = 0;
            $quantitestockktotal = 0;
            if ($query != null) { {
                foreach ($query as $qq) :
                  //debug($art);


                  if ($qq['article_id'] != null) {

                    $article = $connection->execute('SELECT * from articles where id=' . $qq['article_id'] . ';')->fetchAll('assoc');
                    //debug($article);
                  }

                  if ($mois_debut != null && $mois_fin != null) {
                    $qte1 = $connection
                      ->execute('SELECT SUM(ligneprevisionachats.qte) AS q1 from ligneprevisionachats where article_id=' . $qq['article_id'] . ' AND moi_id >= ' . $mois_debut . ' AND moi_id <= ' . $mois_fin . ' ;')
                      ->fetchAll('assoc');
                  }
                  if ($article_id != null) {
                    $conarticle_id = '(article_id1=' . $article_id . ' OR article_id2=' . $article_id . ' OR article_id3=' . $article_id . ')';
                  } else {
                    $conarticle_id = '1=1';
                  }

                  //   debug($q['article_id'])  ; 
                  // debug($conarticle_id)  ; 
                  if ($qq['article_id'] != null) {
                    $qte2 = $connection
                      ->execute("SELECT SUM(fichearticles.qte) AS q2 from fichearticles where 
article_id=" . $qq['article_id'] . " AND " . $conarticle_id . " ;")
                      ->fetchAll('assoc');
                  }
                  //debug($qte1);
                  //debug($qte2);

                  $time = new FrozenTime('now', 'Africa/Tunis');
                  $date = $time->i18nFormat('yyyy-MM-dd HH:mm:ss');

                  $qteStock = $connection->execute("select stockbassem(" . $qq['article_id'] . ",'" . $date . "','0','0') as v")->fetchAll('assoc');


            ?>
                  <tr style="background:#C0C0C0">

                    <td><?php {
                          echo $article[0]['Code'];;
                        } ?></td>
                    <td><?php {
                          echo $article[0]['Dsignation'];;
                        } ?></td>

                    <td>
                    </td>
                    <td></td>
                    <td></td>




                  </tr>
                  <?php

                  $idstockart = "";
                  $test = 0;
                  $i = 0;
                  foreach ($queryy as $q) :
                    //debug($art);


                    if ($article_id == null) {
                      if ($q['article_id1'] != '') {

                        if (mb_ereg($q['article_id1'], ($idstockart)) || mb_ereg($q['article_id2'], ($idstockart)) || mb_ereg($q['article_id3'], ($idstockart))) {
                          $test = 1;
                        }
                        $idstockart = $idstockart . $q['article_id1'] . ',';

                        $article = $connection->execute('SELECT * from articles where id=' . $q['article_id1'] . ';')->fetchAll('assoc');
                        $art = $q['article_id1'];
                        //  debug($qq['article_id']);
                        //     debug($art);
                        $at = $qq['article_id'];
                        $condat = ' article_id=' . $at . ' AND 
       (article_id1=' . $art . ' OR article_id2=' . $art . ' OR article_id3=' . $art . ')';
                        // debug($condat);//die;

                        $qte2 = $connection
                          ->execute("select SUM(fichearticles.qte) AS q2 from fichearticles where 
" . $condat)
                          ->fetchAll('assoc');
                        //echo "select SUM(fichearticles.qte) AS q2 from fichearticles where 
                        //'.$condat.'";
                        //  debug($qte2);//die;
                        //debug($article);
                      } else if ($q['article_id2'] != '') {
                        $artt = $q['article_id2'];
                        if (mb_ereg($q['article_id1'], ($idstockart)) || mb_ereg($q['article_id2'], ($idstockart)) || mb_ereg($q['article_id3'], ($idstockart))) {
                          $test = 1;
                        }
                        $idstockart = $idstockart . $q['article_id2'] . ',';

                        $article = $connection->execute('SELECT * from articles where id=' . $q['article_id2'] . ';')->fetchAll('assoc');
                        $at = $qq['article_id'];
                        $condat = ' article_id=' . $at . ' AND 
       (article_id1=' . $artt . ' OR article_id2=' . $artt . ' OR article_id3=' . $artt . ')';
                        // debug($condat);//die;

                        $qte2 = $connection
                          ->execute("select SUM(fichearticles.qte) AS q2 from fichearticles where 
" . $condat)->fetchAll('assoc');
                        //debug($article);

                      } else {
                        if (mb_ereg($q['article_id1'], ($idstockart)) || mb_ereg($q['article_id2'], ($idstockart)) || mb_ereg($q['article_id3'], ($idstockart))) {
                          $test = 1;
                        }
                        $idstockart = $idstockart . $q['article_id3'] . ',';
                        $arttt = $q['article_id2'];
                        $article = $connection->execute('SELECT * from articles where id=' . $q['article_id3'] . ';')->fetchAll('assoc');
                        $at = $qq['article_id'];
                        $condat = ' article_id=' . $at . ' AND 
       (article_id1=' . $arttt . ' OR article_id2=' . $arttt . ' OR article_id3=' . $arttt . ')';
                        //  debug($condat);//die;

                        $qte2 = $connection
                          ->execute("select SUM(fichearticles.qte) AS q2 from fichearticles where 
" . $condat)->fetchAll('assoc');
                      }
                      //  debug($qte2);

                    } else {

                      $ar = $article_id;
                      //debug($article);die;
                      //debug('ffffff');
                      if (mb_ereg($q['article_id1'], ($idstockart)) || mb_ereg($q['article_id2'], ($idstockart)) || mb_ereg($q['article_id3'], ($idstockart))) {
                        $test = 1;
                      }
                      $idstockart = $idstockart . $q['article_id2'] . ',';

                      $article = $connection->execute('SELECT * from articles where id=' . $ar . ';')->fetchAll('assoc');
                      $at = $qq['article_id'];
                      $condat = ' article_id=' . $at . ' AND 
       (article_id1=' . $ar . ' OR article_id2=' . $ar . ' OR article_id3=' . $ar . ')';
                      //debug($condat);//die;

                      $qte2 = $connection
                        ->execute("select SUM(fichearticles.qte) AS q2 from fichearticles where 
" . $condat)->fetchAll('assoc');
                      //debug($article); 
                    }
                    // debug($qte1);
                    //   debug($q['article_id'])  ; 
                    // debug($conarticle_id)  ; 
                    if ($q['article_id'] != null) {
                    }
                    if ($mois_debut != null && $mois_fin != null) {
                      //   debug($q['article_id']);
                      $qte1 = $connection
                        ->execute('SELECT SUM(ligneprevisionachats.qte) AS q1 from ligneprevisionachats where article_id=' . $qq['article_id'] . ' AND moi_id >= ' . $mois_debut . ' AND moi_id <= ' . $mois_fin . ' ;')
                        ->fetchAll('assoc');
                    }
                    //debug($qte2);

                    $time = new FrozenTime('now', 'Africa/Tunis');
                    $date = $time->i18nFormat('yyyy-MM-dd HH:mm:ss');

                    $qteStock = $connection->execute("select stockbassem(" . $q['article_id'] . ",'" . $date . "','0','0') as v")->fetchAll('assoc');

                    if ($test == 0) {
                      $quantitestock = $quantitestock + ($qte1[0]['q1'] * $qte2[0]['q2']);
                      $quantitestockk = $quantitestockk + ($qteStock[0]['v']);
                      $quantitestockktotal = $quantitestockktotal + (($qte1[0]['q1'] * $qte2[0]['q2']) - $qteStock[0]['v']);
                  ?>
                      <tr>

                        <td><?php if ($q['article_id'] != null) {
                              echo $article[0]['Code'];
                            } ?></td>
                        <td><?php if ($q['article_id'] != null) {
                              echo $article[0]['Dsignation'];
                            } ?></td>

                        <td>
                          <?php

                          if ($mois_debut != null && $mois_fin != null && $q['article_id'] != null) {

                            $quantite = $qte1[0]['q1'] * $qte2[0]['q2'];
                            echo $quantite;
                          } ?></td>
                        <td><?php echo $qteStock[0]['v']; ?></td>
                        <td><?php echo $quantite - $qteStock[0]['v'] ?></td>



                      </tr>

              <?php }
                    $i++;
                  endforeach;
                  $j++;
                endforeach;
              }
            }
            if ($article_id != '') { ?>
          <tfoot style="background:#FF000080">
            <td colspan="2"> Total</td>
            <td><?php echo number_format($quantitestock, 3, '.', ' '); ?></td>
            <td><?php echo number_format($quantitestockk, 3, '.', ' '); ?></td>
            <td><?php echo number_format($quantitestockktotal, 3, '.', ' '); ?></td>
          </tfoot>
        <?php } ?>
        </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</div>