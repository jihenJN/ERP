<!-- Content Header (Page header) -->
<?php

use Cake\Core\Configure;
use Cake\I18n\FrozenTime;
use Cake\Datasource\ConnectionManager;
?>
<?php echo $this->Html->script('mahdi'); ?>
<?php echo $this->Html->css('select2'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php

$imprimer = "";
$session = $this->request->getSession();
$abrv = $session->read('abrvv');
$lien = $session->read('lien_prévisionnement' . $abrv);
//debug($lien);die;
foreach ($lien as $k => $liens) {
  if (@$liens['lien'] == 'inventaires') {

    $imprimer = $liens['imprimer'];
  }
  //debug($liens);die;
} { ?>

<?php  } ?>
<?php echo $this->fetch('script'); ?>

<?php $connection = ConnectionManager::get('default'); ?>

<section class="content-header">
  <header>
    <h1 style="text-align:center;">Prévision achat</h1>
  </header>
</section>




<br> <br><br>


<section class="content" style="width: 99%">
  <div class="box">
    <div class="box-header">
    </div>

    <div class="box-body">
      <div class="row">

        <?php echo $this->Form->create($listearts, ['type' => 'get']); ?>



        <div class="col-xs-6">
          <?php
          echo $this->Form->input('mois_debut', array('label' => 'Du', 'options' => $mois, 'value' => $this->request->getQuery('mois_debut'), 'empty' => 'Veuillez choisir !!', 'id' => 'mois_debut', 'div' => 'form-group', 'class' => 'form-control select2'));
          ?>
        </div>

        <div class="col-xs-6">
          <?php
          echo $this->Form->input('mois_fin', array('label' => 'Au', 'options' => $mois, 'value' => $this->request->getQuery('mois_fin'), 'empty' => 'Veuillez choisir !!', 'id' => 'mois_fin', 'div' => 'form-group', 'class' => 'form-control select2'));

          ?>
        </div>
<!--        <div class="col-xs-6">
          <?php
          echo $this->Form->input('article_id', array('label' => 'MP', 'value' => $this->request->getQuery('article_id'), 'empty' => 'Veuillez choisir !!', 'id' => 'article_id', 'div' => 'form-group', 'class' => 'form-control select2'));
          ?>
        </div>-->
          <div class="col-xs-6">
          <label> MP </label>
        <select   class="form-control select2" name="article_id" id="article_id" value='<?php $this->request->getQuery('article_id') ?>'>
                   <option value="" selected="selected">Veuillez choisir !!</option>
               <?php foreach ($articles as $j => $art) {
                    ?>
                     <option <?php if ($art->id == $article_id) { ?> selected="selected" <?php } ?> value="<?php echo $art->id; ?>"><?php echo $art->Code . ' ' . $art->Dsignation ?></option>
                              <?php } ?>
                   
        </select>
        </div>
<!--        <div class="col-xs-6">
          <?php
          echo $this->Form->input('articlepf_id', array('label' => 'PF', 'value' => $this->request->getQuery('articlepf_id'), 'empty' => 'Veuillez choisir !!', 'id' => 'articlepf_id', 'div' => 'form-group', 'class' => 'form-control select2'));
          ?>
        </div>-->
   <div class="col-xs-6">
          <label> Article </label>
        <select   class="form-control select2" name="articlepf_id" id="articlepf_id" value='<?php $this->request->getQuery('articlepf_id') ?>'>
                   <option value="" selected="selected">Veuillez choisir !!</option>
               <?php foreach ($articlepfs as $j => $art) {
                    ?>
                     <option <?php if ($art->id == $article_id) { ?> selected="selected" <?php } ?> value="<?php echo $art->id; ?>"><?php echo $art->Code . ' ' . $art->Dsignation ?></option>
                              <?php } ?>
                   
        </select>
        </div>
<!--        <div class="col-xs-6">
          <?php
          echo $this->Form->input('famillemp_id', array('label' => 'Famille MP', 'value' => $this->request->getQuery('famillemp_id'), 'empty' => 'Veuillez choisir !!', 'id' => 'famillemp_id', 'div' => 'form-group', 'class' => 'form-control select2'));
          ?>
        </div>-->
 <div class="col-xs-6">
        <label> Familles </label>
        <select name="famille_id" id="famille_id" class="form-control select2" value='<?php $this->request->getQuery('famillemp_id') ?>'>
                   <option value="" selected="selected">Veuillez choisir !!</option>
               <?php foreach ($famillemps as $id => $fa) {
                    ?>
                     <option <?php if ($fa->id == $famillemp_id) { ?> selected="selected" <?php } ?> value="<?php echo $fa->id; ?>"><?php echo $fa->Nom ?></option>
                              <?php } ?>
                   
        </select>
        </div>
<div class="col-xs-6">
        <div id="divsousfam1" class="form-group input text required">
                        <label class="control-label" for="name">Sous famille</label>
                        <select class="form-control select2" name="sousfamille1_id" id="sousfamille1_id" value='<?php $this->request->getQuery('sousfamille1_id') ?>'>
                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                            <?php foreach ($sousfamille1s as $id => $sousfamille) {   
                              ?>
                                <option <?php if($this->request->getQuery('sousfamille1_id')==$id){?> selected="selected"<?php } ?> value="<?php echo $id; ?>"><?php echo $sousfamille ?></option>
                            <?php } ?>
                        </select>
                    </div>
        </div>


        
        <div class="col-xs-6">
        <div id="divsousfam2" class="form-group input text required">
                        <label class="control-label" for="name">Sous sous famille</label>
                        <select class="form-control select2" name="sousfamille2_id" id="sousfamille2_id" value='<?php $this->request->getQuery('sousfamille2_id') ?>'>
                            <option value="" selected="selected" disabled>Veuillez choisir !! </option>
                            <?php foreach ($sousfamille2s as $id => $ssousfamille) { ?>
                                <option <?php if($this->request->getQuery('sousfamille2_id')==$id){?> selected="selected"<?php } ?> value="<?php echo $id; ?>"><?php echo $ssousfamille ?></option>
                            <?php } ?>
                        </select>
                    </div>
        </div>


        <div class="pull-right" style="margin-right:50%;margin-top: 20px;">

          <button type="submit" id='afficher' class="btn btn-primary btn-sm">Afficher</button>

          <?php if ($imprimer != 0) { ?>
            <a onclick="openWindow(1000, 1000, 'https://codifaerp.isofterp.com/demo/inventaires/imprimerp/?mois_debut=<?php echo @$mois_debut; ?>&mois_fin=<?php echo @$mois_fin; ?>&article_id=<?php echo @$article_id; ?>&articlepf_id=<?php echo @$articlepf_id; ?>&famille_id=<?php echo @$famillemp_id; ?>')"><button id="imprimerp" class="btn btn-primary btn-sm">Imprimer</button></a>
          <?php } ?>
          <?php echo $this->Html->link(__('Actualiser'), ['action' => 'indexp'], ['class' => 'btn btn-primary btn-sm']) ?>
          <!-- <button type="submit"  class="btn btn-primary btn-sm imprimerp">Imprimer</button> -->
        </div>




      </div>







      <?php echo $this->Form->end(); ?>
    </div>
  </div>
</section>
<!-- Main content -->
<section class="content-header">
  <h1>
    Articles </h1>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">


          <!-- /.box-header -->
          <div class="box-body table-responsive ">
            <table id="example1" class="table table-hover">
              <thead>
                <tr>
                  <th scope="col"><?= h('Reference') ?></th>
                  <th scope="col"><?= h('Designation') ?></th>
                  <th scope="col"><?= h('Besoin') ?></th>
                  <th scope="col"><?= h('Stock') ?></th>
                  <th scope="col"><?= h('Total besoin achat ') ?></th>

                </tr>
              </thead>
              <tbody>
                <?php $j = 0;
                $i = 0;
                $ii = 0;
                $iii = 0;

                $quantitestock = 0;
                $quantitestockk = 0;
                $quantitestockktotal = 0;
                 if ($article_id != '') {
          $articlemp = $connection->execute('SELECT * from articles where id=' . $article_id . ';')->fetchAll('assoc');
                    $selectmp1 = $connection->execute('select fichearticles.qte AS q1 from fichearticles where  ' .$condmp . '  group by fichearticles.article_id1,fichearticles.article_id2,fichearticles.article_id3 ;')->fetchAll('assoc');
          debug($selectmp1);die;
                    $time = new FrozenTime('now', 'Africa/Tunis');
                    $date = $time->i18nFormat('yyyy-MM-dd HH:mm:ss');

                    $qteStockmp = $connection->execute("select stockbassem(" . $article_id . ",'" . $date . "','0','0') as v")->fetchAll('assoc');

  ?>
                   <tr style="background:#DCDCDC">

                      <td><?php {
                            echo $articlemp[0]['Code'];;
                          } ?></td>
                      <td><?php {
                            echo $articlemp[0]['Dsignation'];;
                          } ?></td>

                      <td>
                      </td>
                      <td></td>
                      <td></td>
                      <td>
                        <?php if (count($selectmp1) != 0); ?>
                        <button class='btn btn-xs btn-success affichermp1' index="<?php echo $j; ?>"><i class='fa fa-eye'></i></button>

                      </td>



                    </tr>
              <?php   }
                else if ($articlepf_id != '') {
                if ($query != null) {
                  foreach ($query as $qq) :
                    //debug($cond2f);die;

                    $selectmp1 = $connection->execute('select fichearticles.qte AS q1,article_id1 as art1,id as id from fichearticles where article_id=' . $qq['article_id'] . ' and ' . $cond2 . ' and ' . $cond2f . ' group by fichearticles.article_id1 ;')->fetchAll('assoc');
                    //  debug($selectmp1);//die;
                    if ($qq['article_id'] != null) {

                      $articlepf = $connection->execute('SELECT * from articles where id=' . $qq['article_id'] . ';')->fetchAll('assoc');
                      //debug($article);
                      $qte1 = $connection
                        ->execute('SELECT SUM(ligneprevisionachats.qte) AS q1 from ligneprevisionachats where article_id=' . $qq['article_id'] . ' AND moi_id >= ' . $mois_debut . ' AND moi_id <= ' . $mois_fin . ' ;')
                        ->fetchAll('assoc');
                    }
                    $time = new FrozenTime('now', 'Africa/Tunis');
                    $date = $time->i18nFormat('yyyy-MM-dd HH:mm:ss');

                    $qteStock = $connection->execute("select stockbassem(" . $qq['article_id'] . ",'" . $date . "','0','0') as v")->fetchAll('assoc');






                ?>
                    <tr style="background:#DCDCDC">

                      <td><?php {
                            echo $articlepf[0]['Code'];;
                          } ?></td>
                      <td><?php {
                            echo $articlepf[0]['Dsignation'];;
                          } ?></td>

                      <td>
                      </td>
                      <td></td>
                      <td></td>
                      <td>
                        <?php if (count($selectmp1) != 0); ?>
                        <button class='btn btn-xs btn-success affichermp1' index="<?php echo $j; ?>"><i class='fa fa-eye'></i></button>

                      </td>



                    </tr>
                    <tr style="" align="center" class='montreg' id="montreg<?php echo $j; ?>">
                      <td width="1%"></td>
                      <td colspan="4">
                        <table class="table table-hover">

                          <?php
                          $i = 0;
                          if (count($selectmp1) != 0)
                            foreach ($selectmp1 as $mp1) :
                              // debug($mp1);
                              //  debug($cond21);//die;
                              if ($article_id != null) {
                                $condid = '1=1';
                              } else {
                                $condid = 'id!=' . $mp1['id'];
                              }
                              //      debug($condid);//die;
                              $selectmp2 = $connection->execute('select fichearticles.qte AS q2,article_id2 as art2,id as id from fichearticles where article_id=' . $qq['article_id'] . ' and article_id1=' . $mp1['art1'] . ' and ' . $condid . ' and ' . $cond21 . ' and ' . $cond22f . ' group by fichearticles.article_id2 order by id ;')->fetchAll('assoc');
                              //  $selectmp2= $connection->execute('select count() from fichearticles where article_id='.$qq['article_id'].' and article_id1='.$mp1['art1'].' and '.$condid.' and '.$cond21.' and '.$cond22f.' group by fichearticles.article_id2 order by id ;')->fetchAll('assoc');
                              //echo('tt'.count($selectmp2)); 
                              if ($qq['article_id'] != null) {

                                $articlemp2 = $connection->execute('SELECT * from articles where id=' . $mp1['art1'] . ';')->fetchAll('assoc');
                                //debug($article);
                              }
                              //                
                              //           debug($mp1['q1']);
                              //            debug($qte1[0]['q1']);die;

                          ?>
                            <tr style="background:#C0C0C0">

                              <td><?php {
                                    echo $articlemp2[0]['Code'];;
                                  } ?></td>
                              <td><?php {
                                    echo $articlemp2[0]['Dsignation'];;
                                  } ?></td>

                              <td>
                                <?php



                                $quantite = $qte1[0]['q1'] * $mp1['q1'];
                                echo $quantite; ?>
                              </td>
                              <td><?php echo $qteStock[0]['v']; ?></td>
                              <td><?php echo $quantite - $qteStock[0]['v'] ?></td>

                              <td>
                                <?php
                                if (count($selectmp2) != 0); ?>
                                <button class='btn btn-xs btn-success affichermp2' index="<?php echo $j; ?>" index1="<?php echo $i; ?>"><i class='fa fa-eye'></i></button>

                              <td>


                            </tr>
                            <tr style="display: none !important" align="center" class='montreg' id="montreg<?php echo $j; ?>-<?php echo $i; ?>">
                              <td width="1%"></td>
                              <td colspan="4">
                                <table class="table table-hover">

                                  <?php




                                  $ii = 0;
                                  if (count($selectmp2) != 0)
                                    foreach ($selectmp2 as $mp2) :
                                      //debug($cond222f);//die;

                                      $selectmp3 = $connection->execute('select fichearticles.qte AS q3,article_id3 as art3,id as id from fichearticles where article_id=' . $qq['article_id'] . ' and article_id1=' . $mp1['art1'] . ' and article_id2=' . $mp2['art2'] . ' and id!=' . $mp2['id'] . ' and ' . $cond22 . '  and  ' . $cond222f . ' group by fichearticles.article_id3 ;')->fetchAll('assoc');
                                      // debug($selectmp3);//die;


                                      $articlemp3 = $connection->execute('SELECT * from articles where id=' . $mp2['art2'] . ';')->fetchAll('assoc');


                                      //                


                                  ?>
                                    <tr style="background:#A9A9A9">

                                      <td><?php {
                                            echo $articlemp3[0]['Code'];;
                                          } ?></td>
                                      <td><?php {
                                            echo $articlemp3[0]['Dsignation'];;
                                          } ?></td>

                                      <td>
                                        <?php



                                        $quantite = $qte1[0]['q1'] * ($mp1['q1'] * $mp2['q2']);
                                        echo $quantite; ?>
                                      </td>
                                      <td><?php echo $qteStock[0]['v']; ?></td>
                                      <td><?php echo $quantite - $qteStock[0]['v'] ?></td>


                                      <td>
                                        <?php //echo ('tt'.count($selectmp3));
                                        if ((count($selectmp3)) != 0); { ?>
                                          <button class='btn btn-xs btn-success affichermp3' index="<?php echo $j; ?>" index1="<?php echo $i; ?>" index2="<?php echo $ii; ?>"><i class='fa fa-eye'></i></button>
                                        <?php } ?>
                                      </td>

                                    </tr>
                                    <tr style="display: none !important" align="center" class='montreg' id="montreg<?php echo $j; ?>-<?php echo $i; ?>-<?php echo $ii; ?>">
                                      <td width="1%"></td>
                                      <td colspan="4">
                                        <table class="table table-hover">

                                          <?php
                                          $iii = 0;
                                          if (count($selectmp3) != 0)
                                            foreach ($selectmp3 as $mp3) :
                                              // debug($mp3);die;




                                              $articlemp4 = $connection->execute('SELECT * from articles where id=' . $mp3['art3'] . ';')->fetchAll('assoc');


                                              //                


                                          ?>
                                            <tr style="background:#808080">

                                              <td><?php {
                                                    echo $articlemp4[0]['Code'];;
                                                  } ?></td>
                                              <td><?php {
                                                    echo $articlemp4[0]['Dsignation'];;
                                                  } ?></td>

                                              <td>
                                                <?php



                                                $quantite = $qte1[0]['q1'] * ($mp1['q1'] * ($mp2['q2'] * $mp2['q2']));
                                                echo $quantite; ?>
                                              </td>
                                              <td><?php echo $qteStock[0]['v']; ?></td>
                                              <td><?php echo $quantite - $qteStock[0]['v'] ?></td>




                                            </tr>
                                          <?php


                                              $iii++;
                                            endforeach;
                                          ?>
                                        </table>
                                      </td>
                                      <td></td>
                                    </tr>
                                  <?php
                                      $ii++;
                                    endforeach; ?>
                                </table>
                              </td>
                              <td></td>
                            </tr>
                          <?php $i++;
                            endforeach; ?>

                        </table>
                      </td>
                      <td></td>
                    </tr>

                  <?php $j++;
                  endforeach;
                }}
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
</section>

<script>
  function openWindow(h, w, url) {
    leftOffset = (screen.width / 2) - w / 2;
    topOffset = (screen.height / 2) - h / 2;
    window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
  }
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
    $('#example2').DataTable()
    $('#example1').DataTable({
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
<script>
  $(function() {
$('#famille_id').on('change', function() {
//  alert('hh')
        idfam = $('#famille_id').val();
        $.ajax({
            method: "GET",
            url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'getsousfamille1']) ?>",
            dataType: "json",
            data: {
                idfam: idfam,

            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
            },
            success: function(data) {
                $('#divsousfam1').html(data.select);
      }


        })

    });
});






function getsousfamille2(param) {

//alert('hello');
id = $('#sous').val();
// alert(id)
$.ajax({
    method: "GET",
    url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'getsousf']) ?>",
    dataType: "json",
    data: {
        idfam: id,

    },
    headers: {
        'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
    },
    success: function(data) {


      $('#divsousfam2').html(data.select);
       
  

    }

});



}
</script>
<?php $this->end(); ?>