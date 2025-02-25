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


<h1  style="text-align:center ;"> Etat des livraisons   </h1>
<br>
<?php    
   
    foreach ($preparatif as $i  => $pre   )
   
                       {  
                        ?>
                        
                        <?php } ?>
<h3  style="text-align:center ;">  Voyage N°   <span>   <?php echo $pre['numero']?></span>     Du     <span>  <?php echo $pre['date']?></span>      </h3>
  <br> <br>

  
<div style="display:flex" align="center">


    <div style="display:flex;width: 1000%;">
  
        <div style="width: 10000%;"  align="left">
       
            <b> Zone : </b> <br> <br>
            <?php    foreach ($preparatif as $i  => $pre   )   
          
          {               
               ?>
           
            <?php } ?>
            <b> Camion : <b>  <?= h($pre->materieltransport->matricule) ?> </b> </b> 
          
        </div>
    </div>



    <div style="display:flex ;width:1000%;margin-left:10%">

        <div style="width: 10000%;"  align="left">
    

       
            <b> Chauffeur :  </b>     <?php echo $chauff?>  </b> <br> <br>
            <b> Conffaieur: </b> <b>   <?php echo $conv?></b>
           

        </div>
    </div>
    <div style="display:flex;width: 1000%;">

        <div style="width: 10000%;"  align="left">
        <?php    foreach ($preparatif as $i  => $pre   )   
          
          {               
               ?>
           
            <?php } ?>
            <b> Edité Le : </b>  <b>  <?php echo $pre['date']?> </b>     <br> <br>
     
          
        </div>
    </div>

</div>
<br>
<br>


<table   class="table table-striped"  style="width:100%" align="center" >
    <thead   >
        <th width="10%"></th>
      
         <th  width="10%"></th>
        <th  width="10%" >N° Cde </th>
        <th  width="10%" >Date Cde </th>
        <th width="10%" > Raison social</th>
        <th width="20%" > Adresse de livraison   </th>
        <th  width="10%"> Poids(Kg)   </th>
        <th  width="10%"> Nb.Carton   </th>
        <th  width="10%"> Nb.Vrac  </th>

    </thead>
    <?php    
    $sommePoids = 0 ; 
    $sommeCartons = 0 ; 
     $l = 0 ; 
    foreach ($preparatif as $i  => $pre   )
   // debug($pre) ;

                       { 
      //  debug($pre);die;
                           $l++ ;
                   
                        $poids =  $pre->poidstotal ;
                        $nbCarton =  $pre->nbcartons ; 
                        $sommePoids += $poids ;
                        $sommeCartons += $nbCarton ; 
                  // debug($nbCarton) ; die ;



                            ?>
    
    <tbody>
    
       <tr>
       <td width="10%">   <?php echo $l  ?>   </td>
       <td width="10%">C</td>
       <td width="10%" align="center" >  <?php echo $pre['numero']  ?> </td>
       <td width="10%" align="center" >  <?php echo $pre['date']  ?> </td>
       <td width="10%"  align="center">  <?php echo $pre['client']['Raison_Sociale']  ?> </td>
       <td width="20%" align="center" >  <?php echo $pre['client']['Adresse']  ?> </td>
       <td width="10%"  align="center">  <?php echo $pre['poidstotal']  ?> </td>
       <td width="10%" align="center" >  <?php echo $pre['nbcartons']  ?> </td>
       <td width="10%" align="center" >  0 </td>

                       
       </tr>
       <?php  } ?>
    
       
    </tbody>
    
    <tfoot  >
    
                    <tr >
                          <th style=" padding-left: 50%;"  width="10%"  colspan="6">  Total </th>
                   <td  width="10%" align="center"> 
                   <?php echo $sommePoids?>
                    </td>
                    <td   width="10%" align="center" >
                    <?php echo $sommeCartons?>
                      </td>
                    </tr>
                   </tfoot> 

</table>
