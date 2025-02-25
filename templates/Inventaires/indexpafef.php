<!-- Content Header (Page header) -->
<?php use Cake\Core\Configure;
use Cake\I18n\FrozenTime;
use Cake\Datasource\ConnectionManager;
 ?>
<?php echo $this->Html->script('mahdi'); ?>
<?php echo $this->Html->css('select2'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<?php echo $this->fetch('script'); ?>

<?php $connection = ConnectionManager::get('default'); ?>

<section class="content-header">
<header>
    <h1 style="text-align:center;" >Prévision achat</h1>
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

       
       
        <div class="col-xs-6" >
             <?php
             echo $this->Form->input('mois_debut',array( 'label'=>'Du','options'=>$mois,'value' => $this->request->getQuery('mois_debut'),'empty'=>'Veuillez choisir !!','id'=>'mois_debut','div'=>'form-group','class'=>'form-control select2') );
             ?>
             </div>
          
              <div class="col-xs-6" >
              <?php
            echo $this->Form->input('mois_fin',array( 'label'=>'Au','options'=>$mois,'value' => $this->request->getQuery('mois_fin'),'empty'=>'Veuillez choisir !!','id'=>'mois_fin','div'=>'form-group','class'=>'form-control select2') );

               ?>
                  </div>
                  <div class="col-xs-6" >
         <?php
                            echo $this->Form->input('article_id',array( 'label'=>'MP','value' => $this->request->getQuery('article_id'),'empty'=>'Veuillez choisir !!','id'=>'article_id','div'=>'form-group','class'=>'form-control select2') );
               ?>
                  </div>
                  <div class="col-xs-6" >
         <?php
                            echo $this->Form->input('articlepf_id',array( 'label'=>'PF','value' => $this->request->getQuery('articlepf_id'),'empty'=>'Veuillez choisir !!','id'=>'articlepf_id','div'=>'form-group','class'=>'form-control select2') );
               ?>
                  </div>
                  <div class="col-xs-6" >
         <?php
                          // echo $this->Form->input('famillemp_id',array( 'label'=>'Famille MP','value' => $this->request->getQuery('famillemp_id'),'empty'=>'Veuillez choisir !!','id'=>'famillemp_id','div'=>'form-group','class'=>'form-control select2') );
               ?>
                  </div>

         
     
        <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
          <button type="submit" id='afficher' class="btn btn-primary btn-sm">Afficher</button>
    
         <a onclick="openWindow(1000, 1000, 'https://codifaerp.isofterp.com/demo/inventaires/imprimerp/?mois_debut=<?php echo @$mois_debut; ?>&mois_fin=<?php echo @$mois_fin; ?>&article_id=<?php echo @$article_id; ?>&articlepf_id=<?php echo @$articlepf_id; ?>&famille_id=<?php echo @$famillemp_id; ?>')"><button id="imprimerp" class="btn btn-primary btn-sm">Imprimer</button></a>
          
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
Articles  </h1>
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
              <?php $j=0;
              $quantitestock=0;
              $quantitestockk=0;
              $quantitestockktotal=0;
              if ($query!=null){

              {
                  foreach ($query as $qq):
                //debug($art);
                  
               
                if($qq['article_id']!=null )
                {
                  
               $article = $connection->execute('SELECT * from articles where id='.$qq['article_id'].';')->fetchAll('assoc');
                //debug($article);
                }
                
                if( $mois_debut!=null && $mois_fin!=null ){
$qte1 = $connection
->execute('SELECT SUM(ligneprevisionachats.qte) AS q1 from ligneprevisionachats where article_id='.$qq['article_id'].' AND moi_id >= '.$mois_debut.' AND moi_id <= '.$mois_fin.' ;')
->fetchAll('assoc');
                }
                if($article_id!=null){
                 $conarticle_id='(article_id1='.$article_id.' OR article_id2='.$article_id.' OR article_id3='.$article_id.')';
                }
                else{
                $conarticle_id='1=1';
   
                }
              
      //   debug($q['article_id'])  ; 
        // debug($conarticle_id)  ; 
if($qq['article_id']!=null ){
$qte2 = $connection
->execute("SELECT SUM(fichearticles.qte) AS q2 from fichearticles where 
article_id=".$qq['article_id']." AND ".$conarticle_id." ;")
->fetchAll('assoc');}

//debug($qte2);

$time = new FrozenTime('now', 'Africa/Tunis');
                $date=$time->i18nFormat('yyyy-MM-dd HH:mm:ss');

$qteStock = $connection->execute("select stockbassem(" . $qq['article_id'] . ",'" . $date . "','0','0') as v")->fetchAll('assoc');


                ?>
                <tr style="background:#C0C0C0">

                    <td  ><?php 
                  {
                   echo $article[0]['Code'] ; ;} ?></td>
                  <td  ><?php 
                  {
                   echo $article[0]['Dsignation'] ; ;} ?></td>

                  <td>
                   </td>
                  <td></td>
                  <td></td>
                  
                
                 
                 
                </tr>
                <?php
               
                $idstockart="";
                $idstockart2="";
                $idstockart3="";
                $test=0;
                $i=0;
                foreach ($queryy as $q):
                //debug($art);
                 
               
                if($article_id==null )
                {
                    echo mb_ereg($q['article_id1'],($idstockart)). mb_ereg($q['article_id1'],($idstockart2)) . mb_ereg($q['article_id1'],($idstockart3));
                  if($q['article_id1']!=0 && !(mb_ereg($q['article_id1'],($idstockart))|| mb_ereg($q['article_id1'],($idstockart2)) || mb_ereg($q['article_id1'],($idstockart3)))){
                    // debug($q['article_id1']);die;
                       if(!mb_ereg($q['article_id1'],($idstockart))|| !mb_ereg($q['article_id2'],($idstockart2)) || !mb_ereg($q['article_id3'],($idstockart3)))
                  {
                      $test=1;
                             $art=$q['article_id1'];
            // debug($article);
                         //     debug($art);
$at=$qq['article_id'];
$condat=' article_id='.$at.' AND 
       (article_id1='.$art.' OR article_id2='.$art.' OR article_id3='.$art.')';
             // debug($condat);//die;
             
$qte2 = $connection
->execute("select SUM(fichearticles.qte) AS q2 from fichearticles where 
".$condat)
->fetchAll('assoc');
                  }
                $idstockart=$idstockart.$q['article_id1'].',';
                 
               $article = $connection->execute('SELECT * from articles where id='.$q['article_id1'].';')->fetchAll('assoc');
        
//echo "select SUM(fichearticles.qte) AS q2 from fichearticles where 
//'.$condat.'";
             //  debug($qte2);//die;
                //debug($article);
                }
                
                     else if($q['article_id2']!=0  && !(mb_ereg($q['article_id2'],($idstockart))|| mb_ereg($q['article_id2'],($idstockart2)) || mb_ereg($q['article_id2'],($idstockart3)))){
                     //debug('') ;//die;
                      $artt=$q['article_id2'];
                     // echo  $q['article_id2'].($idstockart). !mb_ereg($q['article_id2'],($idstockart2)) . !mb_ereg($q['article_id2'],($idstockart3));
                           if(!mb_ereg($q['article_id2'],($idstockart))|| !mb_ereg($q['article_id2'],($idstockart2)) || !mb_ereg($q['article_id2'],($idstockart3)))
                  {
                      $test=1;
                  }
                  //die;
                      $idstockart2=$idstockart2.$q['article_id2'].',';
                 
               $article = $connection->execute('SELECT * from articles where id='.$q['article_id2'].';')->fetchAll('assoc');
                debug($article);
               $at=$qq['article_id'];
$condat=' article_id='.$at.' AND 
       (article_id1='.$artt.' OR article_id2='.$artt.' OR article_id3='.$artt.')';
             // debug($condat);//die;
             
$qte2 = $connection
->execute("select SUM(fichearticles.qte) AS q2 from fichearticles where 
".$condat)->fetchAll('assoc');
                //debug($article);
                              
                }
                else  if($q['article_id3']!=0 && !(mb_ereg($q['article_id3'],($idstockart))|| mb_ereg($q['article_id3'],($idstockart2)) || mb_ereg($q['article_id3'],($idstockart3)))){
                    if(!mb_ereg($q['article_id3'],($idstockart))|| !mb_ereg($q['article_id3'],($idstockart2)) || !mb_ereg($q['article_id3'],($idstockart3)))
                  {
                      $test=1;
                  }
                    $idstockart3=$idstockart3.$q['article_id3'].',';
                    $arttt=$q['article_id2'];
    $article = $connection->execute('SELECT * from articles where id='.$q['article_id3'].';')->fetchAll('assoc');
                                        $at=$qq['article_id'];
                                        debug($article);
$condat=' article_id='.$at.' AND 
       (article_id1='.$arttt.' OR article_id2='.$arttt.' OR article_id3='.$arttt.')';
            //  debug($condat);//die;
             
$qte2 = $connection
->execute("select SUM(fichearticles.qte) AS q2 from fichearticles where 
".$condat)->fetchAll('assoc');
                }
              //  debug($qte2);
              
                }
                else{

                   $ar=$article_id;
debug($ar);//die;
                   //debug('ffffff');
                           if(mb_ereg($q['article_id1'],($idstockart))|| mb_ereg($q['article_id2'],($idstockart)) || mb_ereg($q['article_id3'],($idstockart)))
                  {
                      $test=1;
                  }
                      $idstockart=$idstockart.$q['article_id2'].',';
                 
               $article = $connection->execute('SELECT * from articles where id='.$ar.';')->fetchAll('assoc');
                 $at=$qq['article_id'];
$condat=' article_id='.$at.' AND 
       (article_id1='.$ar.' OR article_id2='.$ar.' OR article_id3='.$ar.')';
              //debug($condat);//die;
             
$qte2 = $connection
->execute("select SUM(fichearticles.qte) AS q2 from fichearticles where 
".$condat)->fetchAll('assoc');
                //debug($article); 
                }
                
              //  $stockfinal=""
               // debug($qte1);
      //   debug($q['article_id'])  ; 
        // debug($conarticle_id)  ; 
if($q['article_id']!=null ){
}
  if( $mois_debut!=null && $mois_fin!=null ){
                 //   debug($q['article_id']);
$qte1 = $connection
->execute('SELECT SUM(ligneprevisionachats.qte) AS q1 from ligneprevisionachats where article_id='.$qq['article_id'].' AND moi_id >= '.$mois_debut.' AND moi_id <= '.$mois_fin.' ;')
->fetchAll('assoc');
                }
//debug($qte2);

$time = new FrozenTime('now', 'Africa/Tunis');
                $date=$time->i18nFormat('yyyy-MM-dd HH:mm:ss');

$qteStock = $connection->execute("select stockbassem(" . $q['article_id'] . ",'" . $date . "','0','0') as v")->fetchAll('assoc');

if($test==0)  {
    debug($article);
    $quantitestock=$quantitestock+($qte1[0]['q1']*$qte2[0]['q2']);
     $quantitestockk=$quantitestockk+($qteStock[0]['v']);
     $quantitestockktotal=$quantitestockktotal+(($qte1[0]['q1']*$qte2[0]['q2'])-$qteStock[0]['v']);
      {
  ?>
                <tr >

                <td><?php if ($q['article_id']!=null)
                  {
                   echo $article[0]['Code'] ;} ?></td>
                  <td><?php if ($q['article_id']!=null)
                  {
                   echo $article[0]['Dsignation'] ;} ?></td>

                  <td>
                    <?php 

                if($mois_debut!=null && $mois_fin!=null && $q['article_id']!=null ){

                  $quantite=$qte1[0]['q1']*$qte2[0]['q2'];
                  echo $quantite; }?></td>
                  <td><?php echo $qteStock[0]['v']; ?></td>
                  <td><?php echo $quantite-$qteStock[0]['v'] ?></td>
                
                 
                 
                </tr>
                
<?php } $i++;}
              endforeach;
               $j++;
              endforeach;
               }
              
                }  if($article_id!=''){?>
                  <tfoot style="background:#FF000080">
        <td colspan="2"> Total</td>
        <td><?php echo number_format($quantitestock,3, '.', ' '); ?></td>
        <td><?php echo number_format($quantitestockk,3, '.', ' '); ?></td>
           <td><?php echo number_format($quantitestockktotal,3, '.', ' '); ?></td>
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
<?php $this->end(); ?>