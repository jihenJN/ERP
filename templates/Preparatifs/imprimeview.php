<?php $this->layout = 'AdminLTE.print'; ?>
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
<br>


  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          <table  style="width: 100%;border-collapse: collapse;border-radius: 15px;">
            <thead>
              <tr>
                <th width="10%" align="center">  Numero </th>
                <th width="10%" align="center">  Date </th>
                <th width="10%" align="center">   Camion  </th>
                <th width="10%" align="center"> Chauffeur  </th>
                <th width="10%" align="center"> Convoyeur </th>
                <th width="10%" align="center"> Poids </th>
                <th width="10%" align="center"> Nb de cartons </th>
             


              
              </tr>
            </thead>
            <tbody>
            <?php    
   
   foreach ($preparatif as $i  => $pre   )

             //    debug($pre) ; die ; 
  
                      {  
                       ?>
                <tr>

                 <td width="10%" align="center">  <?php echo $pre['numero']  ?>   </td>
                 <td width="10%" align="center">  <?php echo $pre['date']  ?>  </td>
                 <td width="10%" align="center">  <?php echo $pre['materieltransport']['matricule']  ?>  </td>
                 <td width="10%" align="center">  <?php echo $chauff?> </td>
                 <td width="10%" align="center"> <?php echo $conv?>  </td>
                 <td width="10%" align="center"> <?php echo $pre['poidstotal']  ?>  </td>
                 <td width="10%" align="center"> <?php echo $pre['nbcartons']  ?>  </td>


                
   
                 
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
