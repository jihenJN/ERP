<?php $this->layout = 'AdminLTE.print'; ?>

<?php use Cake\Core\Configure;
use Cake\I18n\FrozenTime;
use Cake\Datasource\ConnectionManager;
 ?> 
<?php $connection = ConnectionManager::get('default'); ?>


<br>
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


<div >
    <div >
        <?php
        echo $this->Html->image('mm.png', ['alt' => 'CakePHP', 'height' => '110px', 'width' => '200px']); ?>
    </div>
    <div  align="left">
        Société CODIFA <br>
        Rte Fouchana 1.8 km 1135 naassen <br>
        Phone : (+216) 71 398 404 / (+216) 71 398 158 <br>
        Mail : codifa@gnet.tn <br>
    </div>
</div>  
<br><br><br>
<h2>Liste des articles</h2>
<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          <table  class="table table-bordered table-striped">
            <thead>
              <tr>
              <th   width="20%"  class="actions text-center">  <?php echo('Reference ') ;?></th>
                  <th   width="35%"   class="actions text-center "><?php echo('Designation') ;?></th>
                  <th   width="15%"   class="actions text-center "><?php echo('Qte Théorique') ;?></th>
                  <th   width="15%"   class="actions text-center "><?php echo('Total Besoin') ;?></th>
                  <th   width="15%"   class="actions text-center "><?php echo('Total Besoin Achat') ;?></th>


              
              </tr>
            </thead>
            <tbody>
            <?php    
   
          foreach ($articles as $i  => $art   )

                      { 
                        
          $time = new FrozenTime('now', 'Africa/Tunis'); 
          $date=$time->i18nFormat('yyyy-MM-dd HH:mm:ss');
        
          $qtebesoin = $connection->execute('SELECT SUM(ligneprevisionachats.qte) as q from ligneprevisionachats where article_id='.$art->id.'  AND   moi_id>='.$moi_debut.'  AND  moi_id <='.$moi_fin.'    ' )->fetchAll('assoc');
          $qtestock = $connection->execute("select stockbassem(" . $art->id . ",'" . $date . "','0','0') as v")->fetchAll('assoc');
          $total =  $qtebesoin[0]['q'] -  $qtestock[0]['v'] ; 

                    ?>
                
                <tr>
                  
                    <td align="center">  
                    <?= h($art->Code) ?>
                    </td>

                    <td align="center">
                    <?= h($art->Dsignation) ?>  
                    </td> 

                    <td align="center">
                    <?= h($qtestock[0]['v']) ?>  
                    </td>

                    <td align="center">
                    <?= h( $qtebesoin[0]['q']) ?>  
                    </td>

                    <td align="center">
                    <?php if (  $total <= 0) {
                            echo '0' ;
                    }  else { 
                      echo $total ; 
                     }
                      ?> 
                    </td>
                    
                    
                     
                </tr>

                <?php } ?>

            </tbody>  
          </table>
         


        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
